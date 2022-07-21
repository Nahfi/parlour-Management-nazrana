<?php
namespace App\Repositories\Admin;

use App\Models\Salary;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\WorkingDay;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class SalaryRepository{
    /**
     * show all salary sheet
     */
    public function index(){
        return Salary::with(['employee','workingday'])->orderBy('id','desc')->get();
    }

    /**
     * update salary status
     */
    public function update($request ,$id){
       $salary = $this->getSpecificSalary($id);
       $salary->status =  $request->status;
       $salary->save();
    }

    /**
     * get specific salarry
     * @param $id
     */
    public function getSpecificSalary($id){
        return Salary::with(['employee','workingday'])->where('id',$id)->first();
    }

    /**
     * calculate salary
     */
    public function calculateSalary(){

        $currentMonthWorkingDay = WorkingDay::where('year',Carbon::now()->format('Y'))->where('month',Carbon::now()->format('m'))->first();
        if (!$currentMonthWorkingDay) {
            return  redirect()->route('admin.salary.index')->with('salary_calucalte_failed','Please Insert Working Day Of Current Month');
        }

        $todayAttendances = Attendance::whereDate('date_time',Carbon::today())->get();
        $employees = Employee::where('status','Active')->get();
        foreach ($employees as $employee) {
            $flag1 = false;
            foreach ($todayAttendances as $todayAttendance) {
                if($todayAttendance->employee_id == $employee->id){
                    $flag1 = true;
                }
            }
            if(!$flag1){
                Attendance::insert([
                    'employee_id' => $employee->id,
                    'date_time' => Carbon::now(),
                    'ip' => request()->getClientIp(),
                    'status' => 'Absent',
                ]);
            }
        }
        $salaries = Salary::with('workingday')->whereYear('date',Carbon::now()->format('Y'))->whereMonth('date',Carbon::now()->format('m'))->get();
        $employees = Employee::where('status','Active')->get();
        foreach ($employees as $employee) {
            $flag2 = false;

            $currentMonthWorkingInfo = WorkingDay::where('year',Carbon::now()->format('Y'))->where('month',Carbon::now()->format('m'))->first();

            if ($currentMonthWorkingInfo !=  null) {
                $perDaySalary = round($employee->salary/$currentMonthWorkingInfo->total_day,2);

                $currentMonthTotalAbsent = Attendance::where('employee_id',$employee->id)->whereYear('date_time',Carbon::now()->format('Y'))->whereMonth('date_time',Carbon::now()->format('m'))->where('status','Absent')->count();
                $currentMonthTotalPresent = Attendance::where('employee_id',$employee->id)->whereYear('date_time',Carbon::now()->format('Y'))->whereMonth('date_time',Carbon::now()->format('m'))
                                                ->where(function($query){
                                                    return $query->where('status','Present')
                                                    ->orWhere('status','Holiday')
                                                    ->orWhere('status','Leave');
                                                })->count();

                foreach ($salaries as $salary) {
                    if($salary->employee_id == $employee->id && Carbon::parse($salary->date)->format('Y-m') == Carbon::now()->format('Y-m')){
                        $flag2 = true;

                        $previous_salary_info = Salary::where('employee_id',$employee->id)->whereYear('date',Carbon::now()->format('Y'))->whereMonth('date',Carbon::now()->format('m'))->first();

                        Salary::where('employee_id',$employee->id)->whereYear('date',Carbon::now()->format('Y'))->whereMonth('date',Carbon::now()->format('m'))->update([
                            'total_present' => $currentMonthTotalPresent,
                            'total_absent' => $currentMonthTotalAbsent,
                            'punishment' => round($perDaySalary * $currentMonthTotalAbsent),
                        ]);

                        $current_salary_info = Salary::where('employee_id',$employee->id)->whereYear('date',Carbon::now()->format('Y'))->whereMonth('date',Carbon::now()->format('m'))->first();

                        Salary::where('employee_id',$employee->id)->whereYear('date',Carbon::now()->format('Y'))->whereMonth('date',Carbon::now()->format('m'))->update([
                            'total_present' => $currentMonthTotalPresent,
                            'total_absent' => $currentMonthTotalAbsent,
                            'payable_salary' => round($previous_salary_info->payable_salary + ($perDaySalary * ($current_salary_info->total_present - $previous_salary_info->total_present)),2),
                            'punishment' => round($perDaySalary * $currentMonthTotalAbsent),
                        ]);
                    }
                }

                if(!$flag2){
                    //new entry insert
                    Salary::insert([
                        'employee_id' => $employee->id,
                        'working_day_id' => $currentMonthWorkingInfo->id,
                        'date' => Carbon::now(),
                        'basic_salary' => $employee->salary,
                        'per_day_salary' => $perDaySalary,
                        'total_present' => $currentMonthTotalPresent,
                        'total_absent' => $currentMonthTotalAbsent,
                        'payable_salary' => round($perDaySalary * $currentMonthTotalPresent,2),
                        'punishment' => round($perDaySalary * $currentMonthTotalAbsent),
                        'created_at' => Carbon::now()
                    ]);
            }
        }

      // advance reduction if have
       $salary = Salary::where('employee_id',$employee->id)->first();
       $todayDate = date('Y-m-d',strtotime(Carbon::now()));
        $lastUpdatedDate = date('Y-m-d',strtotime($employee ->update_date_time));
            if($lastUpdatedDate != $todayDate ){
                if($employee->advanced_payment != 0){
                    if($employee->remaining_advanced_payment > 0){
                        $remaining_advanced_payment =  $employee->remaining_advanced_payment - $salary->payable_salary;

                        if($remaining_advanced_payment == 0){
                            $employee->remaining_advanced_payment = 0;
                            $employee->advanced_payment = 0;
                            $salary->payable_salary = 0;

                        }
                        if($remaining_advanced_payment < 0){
                            $employee->remaining_advanced_payment = 0;
                            $employee->advanced_payment = 0;
                            $salary->payable_salary =  - ($remaining_advanced_payment) ;
                        }
                        else{
                            $employee->remaining_advanced_payment = $remaining_advanced_payment;

                        }
                        $employee->update_date_time =  Carbon::now();
                    }
                    $salary->save();
                    $employee->save();
                }
            }
        }
    }

}