<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeStoreRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\Employee;
use App\Repositories\Admin\EmployeeRepository;

class EmployeeController extends Controller
{
    public $user;
    private $total_active_employee,$total_deactive_employee,$total_deleted_employee;
    private $employeeRepository;
    /**
     * Construct method
     */
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
        $this->employeeRepository = $employeeRepository;
        $this->total_active_employee = Employee::groupByStatusCount('Active');
        $this->total_deactive_employee = Employee::groupByStatusCount('DeActive');
        $this->total_deleted_employee = Employee::onlyTrashed()->count();
    }
    /**
     * Show all Employee
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('employee.index')){
            abort(403,'Unauthorized access');
        }
       $data['employees'] =  $this->employeeRepository->index();
       $data['total_active_employee'] =   $this->total_active_employee;
       $data['total_deactive_employee'] =  $this->total_deactive_employee ;
       $data['total_deleted_employee'] = $this->total_deleted_employee;

       return view('admin.pages.employee.index',[
            'data'=> $data
        ]);
    }
    /**
     * Show all Active employee
     */
    public function showActiveEmployee(){
        if(is_null($this->user) || !$this->user->can('employee.index')){
            abort(403,'Unauthorized access');
        }
        $data['employees'] =  $this->employeeRepository->activeEmployee();
        $data['total_active_employee'] =   $this->total_active_employee;
        $data['total_deactive_employee'] =  $this->total_deactive_employee ;
        $data['total_deleted_employee'] = $this->total_deleted_employee;

        return view('admin.pages.employee.index',[
            'data'=> $data
        ]);

    }
    /**
     * Show all Deactive employee
     */
    public function showDeActiveEmployee(){
        if(is_null($this->user) || !$this->user->can('employee.index')){
            abort(403,'Unauthorized access');
        }
        $data['employees'] =$this->employeeRepository->deActiveEmployee();
        $data['total_active_employee'] =   $this->total_active_employee;
        $data['total_deactive_employee'] =  $this->total_deactive_employee ;
        $data['total_deleted_employee'] = $this->total_deleted_employee;

        return view('admin.pages.employee.index',[
            'data'=> $data
        ]);
    }
    /**
     * Show all deleted employee
     */
    public function showDeletedEmployee(){
        if(is_null($this->user) || !$this->user->can('employee.index')){
            abort(403,'Unauthorized access');
        }
        $data['employees'] =$this->employeeRepository->showDeletedEmployee();
        $data['total_active_employee'] =   $this->total_active_employee;
        $data['total_deactive_employee'] =  $this->total_deactive_employee ;
        $data['total_deleted_employee'] = $this->total_deleted_employee;
        return view('admin.pages.employee.index',[
            'data' => $data
        ]);
    }
    /**
     * Show a form of create new employee
     */
    public function create(){
        if(is_null($this->user) || !$this->user->can('employee.store')){
            abort(403,'Unauthorized access');
        }
        return view('admin.pages.employee.create');
    }

    /**
     * Store the newely created employee
     */
    public function store(EmployeeStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('employee.store')){
            abort(403,'Unauthorized access');
        }
        $this->employeeRepository->create($request);
        return back()->with('employee_add_success','employee added successfully');
    }
    /**
     * Display the specific employee .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_null($this->user) || !$this->user->can('employee.index')){
            abort(403,'Unauthorized access');
        }
        $employee = $this->employeeRepository->getSpecficeEmployee($id);
        return view('admin.pages.employee.show',[
            'employee' => $employee,
        ]);
    }
     /**
     * Show a edit form for a specefic employee
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('employee.edit')){
            abort(403,'Unauthorized access');
        }
        $employee = $this->employeeRepository->getSpecficeEmployee($id);
        return view('admin.pages.employee.edit',[
            'employee' => $employee,
        ]);
    }
    /**
     * Update a specefice employee
     */
    public function update(EmployeeUpdateRequest $request,$id){

        if(is_null($this->user) || !$this->user->can('employee.edit')){
            abort(403,'Unauthorized access');
        }
        $this->employeeRepository->update($request,$id);
        return back()->with('employee_update_success','employee Updated Successfully');
    }

     /**
     *
     * Destroy a specefic employee
     * @param int $id
     */
    public function destroy($id){
        if(is_null($this->user) || !$this->user->can('employee.delete')){
            abort(403,'Unauthorized access');
        }
        $this->employeeRepository->delete($id);
        return back()->with('employee_delete_success','employee Deleted Successfully');
    }
    /**
     * Restore form trash
     */
    public function restore($id){
        if(is_null($this->user) || !$this->user->can('employee.delete')){
            abort(403,'Unauthorized access');
        }
        $this->employeeRepository->restore($id);
        return back()->with('employee_restore_success','employee Restore Successfully');
    }
    /**
     * Parmanent Delete
     */
    public function parmanentDelete($id){
        if(is_null($this->user) || !$this->user->can('employee.parmanentDelete')){
            abort(403,'Unauthorized access');
        }
        $this->employeeRepository->parmanentDelete($id);
        return back()->with('parmanent_delete_success','Parmanenet Delete Successfull');
    }
    /**
     * Mark  all selected employee
     *
     */
    public function mark(Request $request){
        $request->validate([
            'type' => 'required',
            'ids' => 'required'
        ]);
        $type = request()->get('type');
        $ids = request()->get('ids');

        if($type == 'Active'){
             if(is_null($this->user) || !$this->user->can('employee.edit')){
                 abort(403,'Unauthorized access');
             }
             $type = $this->employeeRepository->markActive($type,$ids);
             return back()->with('mark_active_success','All employee Activated Successfully');
        }
        elseif($type == 'DeActive'){
             if(is_null($this->user) || !$this->user->can('employee.edit')){
                 abort(403,'Unauthorized access');
             }
             $type = $this->employeeRepository->markDeActive($type,$ids);
             return back()->with('mark_deactive_success','All employee DeActivated Successfully');
        }
        elseif($type == 'Delete'){
             if(is_null($this->user) || !$this->user->can('employee.delete')){
                 abort(403,'Unauthorized access');
             }
             $type = $this->employeeRepository->markDelete($type,$ids);
             return back()->with('mark_delete_success','All employee Deleted Successfully');
        }
        elseif($type == 'ParmanentDelete'){
            if(is_null($this->user) || !$this->user->can('employee.parmanentDelete')){
                abort(403,'Unauthorized access');
            }
            $this->employeeRepository->markParmanentlyDelete($ids);
            return back()->with('mark_parmanent_delete_success','All employee Parmanently Deleted Successfully');
       }
        elseif($type == 'Restore'){
            if(is_null($this->user) || !$this->user->can('employee.delete')){
                abort(403,'Unauthorized access');
            }
            $type = $this->employeeRepository->markRestore($type,$ids);
            return back()->with('mark_restore_success','All employee Restore Successfully');
        }
    }
}