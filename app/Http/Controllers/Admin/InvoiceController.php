<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\GeneralSettings;
use App\Repositories\Admin\InvoiceRepository;
use GrahamCampbell\ResultType\Success;
use App\Http\Requests\invoiceStroeRequest;
use App\Models\Invoice;

class InvoiceController extends Controller
{
    /**
     * Construct method
     */
    public $user;
    private $allProduct,$allEmployee,$allCustomer,$invoiceRepository,$deletedInvoiceCount;
    public function __construct(InvoiceRepository $invoiceRepository)
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
        $this->invoiceRepository = $invoiceRepository;
        $this->allEmployee = $this->invoiceRepository->getAllActiveEmployee();
        $this->allProduct = $this->invoiceRepository->getAllActiveProduct();
        $this->allCustomer = $this->invoiceRepository->getAllCustomers();
        $this->deletedInvoiceCount = count($this->invoiceRepository->showDeletedInvoice()->toArray());
    }

    /**
     * show all invoices
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('invoice.showAll')){
            abort(403,'Unauthorized access');
        }
        $deletedInvoice = $this->deletedInvoiceCount;
        $allInvoice = $this->invoiceRepository->allInvoice();
        return view('admin.pages.invoice.index',compact('allInvoice','deletedInvoice'));
    }

    /**
     * search expense category by year or months
     */
    public function search(Request $request){
        if(is_null($this->user) || !$this->user->can('invoice.showAll')){
            abort(403,'Unauthorized access');
        }

        if(!$request->payment_type && !$request->month &&  !$request->year){
            return redirect()->route('admin.invoice.index')->with('search_failed','Please Select  A Payment Type Or Year or Months from SelectBox ');
        }
        else{
            $deletedInvoice = $this->deletedInvoiceCount;
            $allInvoice =   Invoice::with(['customer'])->where(function ($query) use ($request) {
                    $query->filter($request);
                })->get();
            return view('admin.pages.invoice.index',compact('allInvoice','deletedInvoice'));
        }
    }
    /**
     * create an invoice
     */
    public function create(){
        if(is_null($this->user) || !$this->user->can('invoice.create')){
            abort(403,'Unauthorized access');
        }
        $generalSettings = GeneralSettings::latest()->first();
        return view('admin.pages.invoice.create',[
            'generalSettings' => $generalSettings,
            'allEmployee' =>  $this->allEmployee ,
            'allProduct' =>  $this->allProduct,
            'allCustomer' =>  $this->allCustomer
        ]);
    }

    /**
     * Store a newly created invoice  in storage.
     */
    public function store(invoiceStroeRequest $request){
        if(is_null($this->user) || !$this->user->can('invoice.create')){
            abort(403,'Unauthorized access');
        }
        $invoice = $this->invoiceRepository->store($request);
        if($invoice == false){
            return back()->with('no data in session','no data in session');
        }
        else{
            session()->forget('invCart');
            return redirect('admin/invoice/invoice-show-pos/'.$invoice->id);
        }
    }

    /**
     * show a specific invoice
     * @param $id
     */
    public function show($id){
        if(is_null($this->user) || !$this->user->can('invoice.showAll')){
            abort(403,'Unauthorized access');
        }
        $invoice = $this->invoiceRepository->findSpecificInvoice($id);
        $invoiceInfo = $this->invoiceRepository->findSpecificInvoiceInfo($id);
        return view('admin.pages.invoice.show',compact('invoice','invoiceInfo'));
    }
    /**
     * show a specific pos invoice
     */
    public function showPos($id){
        if(is_null($this->user) || !$this->user->can('invoice.showAll')){
            abort(403,'Unauthorized access');
        }
        $invoice = $this->invoiceRepository->findSpecificInvoice($id);
        $invoiceInfo = $this->invoiceRepository->findSpecificInvoiceInfo($id);
        return view('admin.pages.invoice.pos',compact('invoice','invoiceInfo'));
    }

    /**
     * show a specific chalan invoice
     */
    public function showChalan($id){
        if(is_null($this->user) || !$this->user->can('invoice.showAll')){
            abort(403,'Unauthorized access');
        }
        $invoice = $this->invoiceRepository->findSpecificInvoice($id);
        $invoiceInfo = $this->invoiceRepository->findSpecificInvoiceInfo($id);
        return view('admin.pages.invoice.chalan',compact('invoice','invoiceInfo'));
    }
    /**
     * show a specific pos chalan invoice
     */
    public function showPosChalan($id){
        if(is_null($this->user) || !$this->user->can('invoice.showAll')){
            abort(403,'Unauthorized access');
        }
        $invoice = $this->invoiceRepository->findSpecificInvoice($id);
        $invoiceInfo = $this->invoiceRepository->findSpecificInvoiceInfo($id);
        return view('admin.pages.invoice.posChalan',compact('invoice','invoiceInfo'));
    }

    /**
     * Show a edit form for a specefic invoice
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('invoice.editInformation')){
            abort(403,'Unauthorized access');
        }
        $invoice = $this->invoiceRepository->findSpecificInvoice($id);
        $invoiceInfo = $this->invoiceRepository->findSpecificInvoiceInfo($id);
        return view('admin.pages.invoice.edit',compact('invoiceInfo','invoice'));
    }
    /**
     * Show a rating edit form for a specefic invoice
     */
    public function editRatings($id){
        if(is_null($this->user) || !$this->user->can('invoice.editRatings')){
            abort(403,'Unauthorized access');
        }
        $invoice = $this->invoiceRepository->findSpecificInvoice($id);
        $invoiceInfo = $this->invoiceRepository->findSpecificInvoiceInfo($id);
        return view('admin.pages.invoice.editRatings',compact('invoiceInfo','invoice'));
    }

    /**
     * Update the specified invoice resource in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request ,$id){
        if(is_null($this->user) || !$this->user->can('invoice.update')){
            abort(403,'Unauthorized access');
        }
        if($request->get('save')){
            $request->validate([
                'service_ratings'=>'min:0|max:5',
                'employee_ratings'=>'min:0|max:5',
            ]);
            $this->invoiceRepository->updatePoint($request ,$id);
            return back()->with('point updated', 'point updated');
        }
        if($request->get('delete')){
           $this->invoiceRepository->deleteService($request,$id);
           return back()->with('service deleted', 'service deleted');
        }
        if($request->get('information')){
           $response = $this->invoiceRepository->updateInvoiceInformation($request,$id);
           if($response == 'discount error'){
                return redirect()->back()->with('% Discount can not be greater than 100','% Discount can not be greater than 100');
           }
           if($response == 'flat error'){
                return redirect()->back()->with('flat Discount can not be greater than total amount','flat Discount can not be greater than total amount');
           }
           else{
            return back()->with('Information updated', 'Information updated');
           }
        }

    }

    /**
     * Show all deleted invoices
     */
    public function showDeletedInvoice(){
        if(is_null($this->user) || !$this->user->can('invoice.showAll')){
            abort(403,'Unauthorized access');
        }
        $allInvoice =$this->invoiceRepository->showDeletedInvoice();
        $deletedInvoice = $this->deletedInvoiceCount;
        return view('admin.pages.invoice.index',compact('allInvoice','deletedInvoice'));
    }

    /**
     * find a specific product
     * @param $id
     * @return jsonData
     */

    public function findSingleProduct($id){
        if(is_null($this->user) || !$this->user->can('invoice.create')){
            abort(403,'Unauthorized access');
        }
        $product = $this->invoiceRepository->getSpecficeProduct($id);
        return json_encode([
            "product" => $product
        ]);
    }

    /**
     * find a specific Customer
     * @param $id
     * @return jsonData
     */

    public function findSingleCustomer($id){
        if(is_null($this->user) || !$this->user->can('invoice.create')){
            abort(403,'Unauthorized access');
        }

        $customer = $this->invoiceRepository->getSpecficeCustomer($id);
        return json_encode([
            "customer" => $customer
        ]);
    }

    /**
     * stroe data in session
     * @param Illuminate\Http\Request
     */

    public function storeInSession(Request $request){
        if(is_null($this->user) || !$this->user->can('invoice.create')){
            abort(403,'Unauthorized access');
        }
        $this->invoiceRepository->storeInSession($request);
        $invoiceData = session()->get('invCart');
        return json_encode([
            'invoiceData'=>$invoiceData
        ]);
    }
    /**
     * load all session data when browser is reloading
     * @return json_data
     */
    public function loadSessionData(){
        if(is_null($this->user) || !$this->user->can('invoice.create')){
            abort(403,'Unauthorized access');
        }
        $invoiceData= session()->get('invCart');
        return json_encode([
            'invoiceData'=>$invoiceData
        ]);
    }

    /**
     * delete a specific product form session
     * @param $id
     */
    public function delete($id){
        if(is_null($this->user) || !$this->user->can('invoice.create')){
            abort(403,'Unauthorized access');
        }
        $response=$this->invoiceRepository->deleteSpecificProductFormSession($id);
        if($response){
            $responseData = [
                'success'=>true
            ];
        }
        else{
            $responseData = [
                'success'=>false
            ];
        }
        return json_encode($responseData);
    }

    /**
     * Destroy a specefic package
     * @param int $id
     */
    public function destroy($id){
        if(is_null($this->user) || !$this->user->can('invoice.delete')){
            abort(403,'Unauthorized access');
        }
        $this->invoiceRepository->delete($id);
        return back()->with('delete_success',' invoice Deleted Successfully');
    }

    /**
     * Restore form trash
     */
    public function restore($id){
        if(is_null($this->user) || !$this->user->can('invoice.delete')){
            abort(403,'Unauthorized access');
        }
        $this->invoiceRepository->restore($id);
        return back()->with('restore_success',' invoice Restore Successfully');
    }

    /**
     * Parmanent Delete
     */
    public function parmanentDelete($id){
        if(is_null($this->user) || !$this->user->can('invoice.parmanentDelete')){
            abort(403,'Unauthorized access');
        }
        $this->invoiceRepository->parmanentDelete($id);
        return back()->with('parmanent_delete_success','Parmanenet Delete Successfull');
    }

    /**
     * Mark  all selected customer
     */
    public function mark(Request $request){

        $request->validate([
            'type' => 'required',
            'ids' => 'required'
        ]);
        $type = request()->get('type');
        $ids = request()->get('ids');
        if($type == 'Delete'){
             if(is_null($this->user) || !$this->user->can('invoice.delete')){
                 abort(403,'Unauthorized access');
             }
             $this->invoiceRepository->markDelete($ids);
             return back()->with('mark_delete_success','All invoice Deleted Successfully');
        }
        else if($type == 'Restore'){
            if(is_null($this->user) || !$this->user->can('invoice.delete')){
                abort(403,'Unauthorized access');
            }
            $this->invoiceRepository->markRestore($ids);
            return back()->with('mark_restore_success','All invoice Restore Successfully');
       }
       else if($type == 'ParmanentDelete'){
        if(is_null($this->user) || !$this->user->can('invoice.parmanentDelete')){
            abort(403,'Unauthorized access');
        }
        $this->invoiceRepository->markParmanentlyDelete($ids);
        return back()->with('mark_parmanent_delete_success','All invoice Parmanently Deleted Successfully');
       }

    }


}