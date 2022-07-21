<?php
namespace App\Repositories\Employee;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Project;
use App\Models\Salary;
use App\Models\WorkingDay;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class HomeRepository{

    /**
     * count all home report
     */
    public function index(){
        $data[] = '';
        $current_month_working_day_info= WorkingDay::where('year',Carbon::now()->format('Y'))->where('month',Carbon::now()->format('m'))->first();
        $data['current_month_working_day'] = 0;
        if($current_month_working_day_info != null){
            $data['current_month_working_day'] = $current_month_working_day_info->total_day;

        }
        $data['currrent_month_total_present'] = Attendance::where('employee_id',Auth::guard('employee')->User()->id)->whereYear('date_time',Carbon::now()->format('Y'))->whereMonth('date_time',Carbon::now()->format('m'))
                                                            ->where(function($query){
                                                                return $query->where('status','Present')
                                                                ->orWhere('status','Holiday')
                                                                ->orWhere('status','Leave');
                                                            })->count();
        $data['currrent_month_total_absent'] = Attendance::where('employee_id',Auth::guard('employee')->User()->id)->whereYear('date_time',Carbon::now()->format('Y'))->whereMonth('date_time',Carbon::now()->format('m'))
                                                            ->where('status','Absent')->count();
        $data['current_month_salary_info'] = Salary::where('employee_id',Auth::guard('employee')->User()->id)

                                                            ->whereYear('date',Carbon::now()->format('Y'))
                                                            ->whereMonth('date',Carbon::now()->format('m'))->first();

            $data['receivable_salary'] = 0;
            $data['punishment_salary'] = 0;
            $data['advanced_salary'] = Employee::where('id',Auth::guard('employee')->user()->id)->pluck('advanced_payment')->first();
            $data['remaining_advanced'] = Employee::where('id',Auth::guard('employee')->user()->id)->pluck('remaining_advanced_payment')->first();

            if($data['current_month_salary_info'] != null){

                $data['receivable_salary'] = $data['current_month_salary_info']->payable_salary;
                $data['punishment_salary'] = $data['current_month_salary_info']->punishment;
            }
        return $data;
    }
}