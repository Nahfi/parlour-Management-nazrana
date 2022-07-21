<?php
namespace App\Repositories\Admin;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Invoicinfo;
use App\Models\Salary;
use Illuminate\Support\Facades\Auth;
use App\Services\ImageService;
use Illuminate\Support\Facades\Hash;
class EmployeeRepository{
    /**
     * constract a method
     */
    const imageLocation = "/admin_assets/images/employees/";
    protected $imageService;
    public function __construct()
    {
        $this->imageService = new ImageService();
    }
    /**
     * @return App\Models\Employee
     *
     */
    public function index(){
        return Employee::with(['employeeCreatedBy','employeeEditedBy'])->orderby('id','desc')->get();
    }
    /**
     * @return App\Models\Employee deleted
     */
    public function showDeletedEmployee(){
        return Employee::with(['employeeCreatedBy','employeeEditedBy'])->onlyTrashed()->orderBy('id','desc')->get();
    }
    /**
     * @return App\Models\Employee where status is Active
     */
    public function activeEmployee(){
        return Employee::with(['employeeCreatedBy','employeeEditedBy'])->where('status','Active')->orderBy('id','desc')->get();
    }
    /**
     * @return App\Models\Employee where status is DeActive
     */
    public function deActiveEmployee(){
        return Employee::with(['employeeCreatedBy','employeeEditedBy'])->where('status','DeActive')->orderBy('id','desc')->get();

    }
    /**
     * @return a specefic Employee
     * @param int $id
     */
    public function getSpecficeEmployee($id){
        return Employee::with(['employeeCreatedBy','employeeEditedBy'])->where('id',$id)->first();
    }
    /**
     * @return a specific trashed Employee
     * @param int $id
     */
    public function getSpecficeTrashEmployee($id){
        return Employee::with(['employeeCreatedBy','employeeEditedBy'])->onlyTrashed()->where('id',$id)->first();
    }
    /**
     * store new Employee in specefice storage
     * @param \Rquests\EmployeeStoreRequest $request
     */
    public function create($request){
        $employee = new Employee();
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->password =  Hash::make($request->password);
        $employee->description = $request->description;
        $employee->designation = $request->designation;
        $employee->salary = $request->salary;
        $employee->joinDate = $request->joinDate;
        $employee->identificationNumber = $request->identificationNumber;
        $employee->address = $request->address;
        $employee->status = $request->status;
        $employee->created_by = Auth::guard('admin')->User()->id;

        $imageName = 'default.jpg';
        if($request->hasFile('image')){
            $imageName = $this->imageService->upload('employee',EmployeeRepository::imageLocation,$request->file('image'));
        }
        $employee->image = $imageName;
        $employee->save();
        return $employee;
    }

    /**
     * @param \Rquests\EmployeeUpdateRequest $request
     * @param int $id
     */
    public function update($request,$id){

        $employee = $this->getSpecficeEmployee($id);
        $employee->name = $request->name;

        if($request->advanced_payment >= $employee->advanced_payment ){
            $increment = $request->advanced_payment - $employee->advanced_payment;
            $employee->remaining_advanced_payment  =    $employee->remaining_advanced_payment +  $increment ;
        }
        else if ($request->advanced_payment == 0 ){
            $employee->remaining_advanced_payment  =    $employee->remaining_advanced_payment  ;
        }
        else{
            $decrement = $employee->advanced_payment - $request->advanced_payment ;
            $employee->remaining_advanced_payment  =    $employee->remaining_advanced_payment
            -  $decrement ;
        }
        $employee->advanced_payment  =   $request->advanced_payment;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->description = $request->description;
        $employee->salary = $request->salary;
        $employee->joinDate = $request->joinDate;
        $employee->identificationNumber = $request->identificationNumber;
        $employee->address = $request->address;;
        $employee->status = $request->status;
        $employee->edited_by = Auth::guard('admin')->User()->id;
        $imageName=$employee->image;
        if($request->hasFile('image')){
            if($imageName!='default.jpg'){
                $this->imageService->delete('employee',EmployeeRepository::imageLocation);
            }
            $imageName = $this->imageService->upload($request->name,EmployeeRepository::imageLocation,$request->file('image'));
        }
        $employee->image =$imageName;
        $employee->save();
        return $employee;
    }

    /**
     * Destroy a specfic Employee
     * @param int $id
     */
    public function delete($id){
        if( $this->countEmployeeInvoice($id) > 0 || $this->countAttendance($id)>0 || $this->countSalary($id)>0  ){
            return redirect()->route('admin.employee.index')->with('employee_delete_failed','please delete all invoice ,attendance , salary report under this employee then try again');
        }
        else{
            $employee =   $this->getSpecficeEmployee($id);
            $employee->delete();
        }

    }
    /**
     * count employee total invoice
     * @param $id
     */
    public function countEmployeeInvoice ($id){
        return Invoicinfo::where('employee_id',$id)->count();
    }
    /**
     * count employee total attendance
     * @param $id
     */
    public function countAttendance ($id){
        return Attendance::where('employee_id',$id)->count();
    }
    /**
     * count employee total salary row
     * @param $id
     */
    public function countSalary ($id){
        return Salary::where('employee_id',$id)->count();
    }
    /**
     * Restore from trash
     */
    public function restore($id){
        $employee = $this->getSpecficeTrashEmployee($id);
        $employee->restore();
    }
    /**
     * Parmanent Delete
     * @param int $id
     */
    public function parmanentDelete($id){
        $this->unlinkImage($id)->forceDelete();
    }
    /**
     * mark active all selected Employee
     * @param array $ids
     * @param string type
     *
     */
    public function markActive($type,$ids){
        Employee::whereIn('id',$ids)->update([
            'status' => 'Active',
        ]);
        return $type;
    }
     /**
     * mark deactive all selected Employee
     * @param array $ids
     * @param string type
     *
     */
    public function markDeActive($type,$ids){
        Employee::whereIn('id',$ids)->update([
            'status' => 'DeActive',
        ]);
        return $type;
    }
    /**
     * mark delete all selected Employee
     * @param array $ids
     * @param string type
     *
     */
    public function markDelete($type,$ids){
        foreach($ids as $id){
            if( $this->countEmployeeInvoice($id) == 0 ){
                $employee =   $this->getSpecficeEmployee($id);
                $employee->delete();
            }
        }
        return $type;
    }
    /**
     * mark parmanent delete all selected Employee
     */
    public function markParmanentlyDelete($ids){
        foreach($ids as $key=>$id){
        $this->unlinkImage($id)->forceDelete();
        }

    }
    /**
     * mark restore all selected Employee
     * @param array $ids
     * @param string type
     *
     */
    public function markRestore($type,$ids){
        Employee::onlyTrashed()->whereIn('id',$ids)->restore();
        return $type;
    }
    /**
     * call image delete function
     * @param int $id
     */
    public function unlinkImage($id){
        $employee = $this->getSpecficeTrashEmployee($id);
        $imageName = $employee->image;
        if($imageName!='default.jpg'){
            $this->imageService->delete($employee->image,EmployeeRepository::imageLocation);
        }
        return $employee;
    }
}
