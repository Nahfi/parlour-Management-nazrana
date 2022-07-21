<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use App\Repositories\Admin\CustomerRepository;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;

class CustomerController extends Controller
{

    public $user;
    private $total_active_customer,$total_deactive_customer,$total_deleted_customer;
    private $customerRepository;
    /**
     * Construct method
     */
    public function __construct(CustomerRepository $customerRepository)
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
        $this->customerRepository = $customerRepository;
        $this->total_active_customer = Customer::groupByStatusCount('Active');
        $this->total_deactive_customer = Customer::groupByStatusCount('DeActive');
        $this->total_deleted_customer = Customer::onlyTrashed()->count();
    }
    /**
     * Show all Customer
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('customer.index')){
            abort(403,'Unauthorized access');
        }
       $data['customers'] =  $this->customerRepository->index();
       $data['total_active_customer'] =   $this->total_active_customer;
       $data['total_deactive_customer'] =  $this->total_deactive_customer ;
       $data['total_deleted_customer'] = $this->total_deleted_customer;

       return view('admin.pages.customer.index',[
            'data'=> $data
        ]);
    }
    /**
     * Show all Active customers
     */
    public function showActiveCustomer(){
        if(is_null($this->user) || !$this->user->can('customer.index')){
            abort(403,'Unauthorized access');
        }
        $data['customers'] =  $this->customerRepository->activeCustomer();
        $data['total_active_customer'] =   $this->total_active_customer;
        $data['total_deactive_customer'] =  $this->total_deactive_customer ;
        $data['total_deleted_customer'] = $this->total_deleted_customer;

        return view('admin.pages.customer.index',[
            'data'=> $data
        ]);

    }
    /**
     * Show all Deactive customers
     */
    public function showDeActiveCustomer(){
        if(is_null($this->user) || !$this->user->can('customer.index')){
            abort(403,'Unauthorized access');
        }
        $data['customers'] =  $this->customerRepository->deActiveCustomer();
        $data['total_active_customer'] =   $this->total_active_customer;
        $data['total_deactive_customer'] =  $this->total_deactive_customer ;
        $data['total_deleted_customer'] = $this->total_deleted_customer;

        return view('admin.pages.customer.index',[
            'data'=> $data
        ]);
    }
    /**
     * Show all deleted customers
     */
    public function showDeletedCustomer(){
        if(is_null($this->user) || !$this->user->can('expense.index')){
            abort(403,'Unauthorized access');
        }
        $data['customers'] =  $this->customerRepository->showDeletedCustomer();
        $data['total_active_customer'] =   $this->total_active_customer;
        $data['total_deactive_customer'] =  $this->total_deactive_customer ;
        $data['total_deleted_customer'] = $this->total_deleted_customer;
        return view('admin.pages.customer.index',[
            'data' => $data
        ]);
    }
    /**
     * Show a form of create new customers
     */
    public function create(){
        if(is_null($this->user) || !$this->user->can('customer.store')){
            abort(403,'Unauthorized access');
        }
        return view('admin.pages.customer.create');
    }
    /**
     * Store the newely created customer
     */
    public function store(CustomerStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('customer.store')){
            abort(403,'Unauthorized access');
        }

        $this->customerRepository->create($request);
        return back()->with('customer_add_success','customer added successfully');
    }
    /**
     * Display the specific customer .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_null($this->user) || !$this->user->can('customer.index')){
            abort(403,'Unauthorized access');
        }
        $customer = $this->customerRepository->getSpecficeCustomer($id);
        return view('admin.pages.customer.show',[
            'customer' => $customer,
        ]);
    }
    /**
     * Show a edit form for a specefic customer
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('customer.edit')){
            abort(403,'Unauthorized access');
        }
        $customer = $this->customerRepository->getSpecficeCustomer($id);
        return view('admin.pages.customer.edit',[
            'customer' => $customer,
        ]);
    }

    /**
     * Update a specefice customer
     */
    public function update(CustomerUpdateRequest $request,$id){
        if(is_null($this->user) || !$this->user->can('customer.edit')){
            abort(403,'Unauthorized access');
        }
        $this->customerRepository->update($request,$id);
        return back()->with('customer_update_success','customer Updated Successfully');
    }
    /**
     *
     * Destroy a specefic customer
     * @param int $id
     */
    public function destroy($id){
        if(is_null($this->user) || !$this->user->can('customer.delete')){
            abort(403,'Unauthorized access');
        }
        $this->customerRepository->delete($id);
        return back()->with('customer_delete_success','customer Deleted Successfully');
    }
    /**
     * Restore form trash
     */
    public function restore($id){
        if(is_null($this->user) || !$this->user->can('customer.delete')){
            abort(403,'Unauthorized access');
        }
        $this->customerRepository->restore($id);
        return back()->with('customer_restore_success','customer Restore Successfully');
    }
    /**
     * Parmanent Delete
     */
    public function parmanentDelete($id){
        if(is_null($this->user) || !$this->user->can('customer.parmanentDelete')){
            abort(403,'Unauthorized access');
        }
        $this->customerRepository->parmanentDelete($id);
        return back()->with('parmanent_delete_success','Parmanenet Delete Successfull');
    }
    /**
     * Mark  all selected customer
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
             if(is_null($this->user) || !$this->user->can('customer.edit')){
                 abort(403,'Unauthorized access');
             }
             $type = $this->customerRepository->markActive($type,$ids);
             return back()->with('mark_active_success','All customer Activated Successfully');
        }
        elseif($type == 'DeActive'){
             if(is_null($this->user) || !$this->user->can('customer.edit')){
                 abort(403,'Unauthorized access');
             }
             $type = $this->customerRepository->markDeActive($type,$ids);
             return back()->with('mark_deactive_success','All customer DeActivated Successfully');
        }
        elseif($type == 'Delete'){
             if(is_null($this->user) || !$this->user->can('customer.delete')){
                 abort(403,'Unauthorized access');
             }
             $type = $this->customerRepository->markDelete($type,$ids);
             return back()->with('mark_delete_success','Some customer Deleted Successfully and others are not because they have invoices');
        }
        elseif($type == 'ParmanentDelete'){
            if(is_null($this->user) || !$this->user->can('customer.parmanentDelete')){
                abort(403,'Unauthorized access');
            }
            $this->customerRepository->markParmanentlyDelete($ids);
            return back()->with('mark_parmanent_delete_success','All customer Parmanently Deleted Successfully');
       }
        elseif($type == 'Restore'){
            if(is_null($this->user) || !$this->user->can('customer.delete')){
                abort(403,'Unauthorized access');
            }
            $type = $this->customerRepository->markRestore($type,$ids);
            return back()->with('mark_restore_success','All customer Restore Successfully');
        }
    }

}