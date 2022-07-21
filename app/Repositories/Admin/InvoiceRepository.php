<?php
namespace App\Repositories\Admin;

use App\Models\Customer;

use App\Models\Employee;
use App\Models\Invoice;
use App\Models\Invoicinfo;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Admin\EmployeeRepository;

class InvoiceRepository{
    /**
     * constract a  method
     */
    protected $employeeRepository;
    public function __construct(EmployeeRepository $employeeRepository)
    {
        $this->employeeRepository = $employeeRepository;
    }
    /**
     * store newly created invoice into database
     * @param invoiceStroeRequest $request
     */
    public function store($request){
        $invCart = $this->getSessionData();
        if(!$invCart) {
           return false;
        }
        else{
            $grandTotal = floatval($this->calculateDiscount($this->subTotal(),$request->get('discount-type'),$request->discount));
            $totalTax = floatval($this->calculateTax($grandTotal,$request->tax));
            $totalGrandTotal = $grandTotal + $totalTax;
            if($grandTotal >= 1000){
                $this->customerRating($grandTotal/1000,$request ->customer_id );
            }
            $invoice = new Invoice();
            $invoice->invoice_id= $this->genarateInvoiceId();
            $invoice->customer_id = $request ->customer_id ;
            $invoice->subtotal = $this->subTotal();
            $invoice->discountType = $request->get('discount-type');
            $invoice->discount = $request->discount;
            $invoice->tax = $request->tax;
            $invoice->grandtotal = $totalGrandTotal;
            if(!$request->note){
                $note = 'thank you for gracing us with your presence.';
            }
            else{
                $note = $request->note ;
            }
            $invoice->note = $note ;
            $invoice->amountPaid = $request->paid;
            $invoice->payment_type = $request->payment_type;
            $invoice->totalDue = $totalGrandTotal - $request->paid;
            $invoice->save();
            if($invoice){
                $this->storeInvoiceInfo($invoice->id);
            }
            return $invoice;
        }
    }
    /**
     * calcaulate tax
     * @param $graundTotal,$tax
     * @return $totalAfterTax
     */
    public function calculateTax($graundTotal,$tax){
        if($tax == 0){
            return 0;
        }
        else{
            return ($graundTotal*($tax/100));
        }
    }

    /**
     * public function genrate invoice id
     * @param $totalInvoice
     */
    public function genarateInvoiceId(){
        return date('Ymd').rand(100,999);
    }

    /**
     * store invoiceInformation Data
     * @param $invoiceId
     */
    public function storeInvoiceInfo($invoiceId){
        $sessionData = $this-> getSessionData();
        foreach($sessionData as $items=>$value){
            $invoiceInfo = new Invoicinfo();
            $invoiceInfo->invoice_id = $invoiceId;
            $invoiceInfo->service_id = $value['productId'];
            $invoiceInfo->employee_id = $value['employeId'];
            $invoiceInfo->price = $value['price'];
            $invoiceInfo->save();
        }
    }

    /**
     * give customer points
     * @param $rating , customer_id
     */
    public function customerRating($point , $customer_id){
        $customer = $this->getSpecficeCustomer($customer_id);
        $points  = $point + $customer->point;
        $customer->point =  $points ;
        $customer ->save();
    }

    /**
     * update employee and service point
     * @param int $id , $request
     */
    public function updatePoint($request,$id){

        $invoiceIteam = $this->getSpecficeInvoiceIteam($id);

        if($request->get('service_ratings')){
            $invoiceIteam->service_ratings = $request->get('service_ratings');
            $this->incrementServiceRatings($request->service_id,$request->get('service_ratings'));
        }
        if($request->get('employee_ratings')){
            $invoiceIteam->employee_ratings = $request->get('employee_ratings');
            $this->incrementEmployeeRatings($request->employee_id,$request->get('employee_ratings'));
        }
        $invoiceIteam->save();
    }

    /**
     * increment service ratings
     * @param $serviceId,$serviceRatings
     */
    public function incrementServiceRatings($serviceId,$serviceRatings){
        $service =  $this->getSpecficeProduct($serviceId);
        $service->service_ratings = $service->service_ratings + $serviceRatings;
        $service->service_rating_count = $service->service_rating_count +1;
        $service->save();
    }
    /**
     * increment employee ratings
     * @param
     */
    public function incrementEmployeeRatings($employeId,$employeRatings){
        $employee = $this->employeeRepository->getSpecficeEmployee($employeId);
        $employee->employee_ratings = $employee->employee_ratings + $employeRatings;
        $employee->employee_rating_count = $employee->employee_rating_count+1;
        $employee->save();
    }

    /**
     * @return a specefic Invoice Iteam
     */
    public function getSpecficeInvoiceIteam($id){
        return Invoicinfo::with(['service','employee'])->where('id',$id)->first();
    }

    /**
     * calculate GrandTotal
     * @param $subTotal,$discountType,$discount
     * @return $grandTotal
     */
    public function calculateDiscount($subTotal,$discountType,$discount){
        if($discountType == '%'){
            if($discount <=100){
                return $subTotal - ($subTotal*($discount/100));
            }
            else{
                return 'discount error';
            }
        }
        else{
            if($subTotal < $discount){
                return 'flat error';
            }
            else{
                return $subTotal - $discount;
            }
        }

    }

    /**
     * get a single productinfo
     * @param $id
     * @return $product
     */
    public function getSpecficeProduct($id){
        return Product::where("id",$id)->first();
    }

    /**
     * get a single customerInfo
     * @param $id
     * @return $customer
     */
    public function getSpecficeCustomer($id){
        return Customer::where("id",$id)->first();
    }

    /**
     * get all active products
     * @return $allProductallProduct
     */
    public function getAllActiveProduct(){
        return Product::where('status','Active')->get();
    }

    /**
     * get all active Employee
     * @return $allEmployee
     */
    public function getAllActiveEmployee(){
        return Employee::where('status','Active')->get();
    }

    /**
     * get all customer
     * @return $allCustomers
     */
    public function getAllCustomers(){
        return Customer::where('status','Active')->get();
    }

    /**
     * store data in session
     * @param $request
     */
    public function storeInSession($request){
        $invCart = $this->getSessionData();
        if(!$invCart) {
            $invCart[] = $this->sessionArray($request);
             $this->putDataInSession($invCart);
        }
        else{
            $invCart[] = $this->sessionArray($request);
             $this->putDataInSession($invCart);
        }

    }

    /**
     * create a session array
     * @param $request
     * @return Array
     */
    public function sessionArray($request){
        list($product['id'], $product['name']) = $this->stringToArray($request->product);
        list($employee['id'], $employee['name']) = $this->stringToArray($request->employee);
        return [
            "productId" => $product['id'],
            "productName" => $product['name'],
            "image" => $request->image,
            "price" => $request->price,
            "employeId" => $employee['id'],
            "employeName" => $employee['name'],
        ];

    }
    /**
     * delete product form session
     * @param id
     * @return boolean
     */

    public function deleteSpecificProductFormSession($id){
        if($id>-1) {
            $invCart = $this->getSessionData();
            if(isset($invCart[$id])) {
                unset($invCart[$id]);
                $this->putDataInSession($invCart);
                return true;
            }
        }
        else{
            return false;
        }
    }

    /**
     * convert string to array using explode function (separator='-')
     * @param $stringData
     * @return $array
     */
    public function stringToArray($stringData){
        return explode("+",$stringData);
    }

    /**
     * calculate subtotal form session
     * @return $subtotal
     */
    public function subTotal(){
        $subTotal = 0;
        $sessionData = $this->getSessionData();
        foreach($sessionData as $items=>$value){
            $subTotal = $subTotal + $value['price'];
        }
        return $subTotal;

    }
    /**
     * get all sessionData
     * @return $sessionData
     */
    public function getSessionData(){
        return session()->get('invCart');
    }
    /**
     * put data into session
     * @param Array
     */
    public function putDataInSession($data){
        session()->put('invCart', $data);
    }

    /**
     * find a specific invoice information
     * @param $invoicId
     * @return invoiceinfo
     */
    public function findSpecificInvoiceInfo($invoicId){
        $trashInvoice = $this->getSpecficeTrashInvoice($invoicId);
        if($trashInvoice){
            abort(403,'Unauthorized access');
        }
        else{
            return Invoicinfo::with(['service','employee'])->where('invoice_id',$invoicId)->get();
        }
    }

    /**
     * @return a specific trashed invoice
     * @param int $id
     */
    public function getSpecficeTrashInvoice($id){
        return Invoice::with('customer')->onlyTrashed()->where('id',$id)->first();
    }

    /**
     * find a specific invoice information
     *  @param $invoicId
     *  @return invoice
     */
    public function findSpecificInvoice($invoicId){
        return Invoice::with(['customer'])->where('id',$invoicId)->first();
    }


    /**
     * @return a specific service form invoiceInfo
     * @param int $id
     */
    public function findSpceficInvoiceService($id){
        return Invoicinfo::with(['service','employee'])->where('id',$id)->first();
    }

    /**
     * get all invoice
     * @return allInvoice
     */
    public function allInvoice(){
        return Invoice::with('customer')->latest()->get();
    }

    /**
     * get all deleted invoices
     * @return allDeletedInvoice
     */
    public function showDeletedInvoice(){
        return Invoice::with(['customer'])->onlyTrashed()->get();
    }


    /**
     * update invoice
     * @param $invoiceService
     */
    public function updateInvoice($invoiceService){
        $invoice = $this->findSpecificInvoice($invoiceService->invoice_id);
        $subTotal = $invoice->subtotal - $invoiceService->price;
        $invoice->subtotal = $subTotal;
        $grandTotal = floatval($this->calculateDiscount($invoice->subtotal,$invoice->discountType,$invoice->discount));
        $totalTax = floatval($this->calculateTax($grandTotal,$invoice->tax));
        $totalGrandTotal = $grandTotal +  $totalTax;
        $invoice->grandtotal = $totalGrandTotal;
        $invoice->totalDue = $totalGrandTotal  - $invoice->amountPaid;
        $invoice->save();
    }

    /**
     * delete a service form invoice
     * @param int $id , $request
     */
    public function deleteService($request,$id){
        $invoiceService = $this->findSpceficInvoiceService($id);
        $invoiceServices = $this->findSpecificInvoiceInfo($invoiceService->invoice_id)->toArray();
        if(count($invoiceServices) == 1){
            $this->deleteInvoice($invoiceService->invoice_id);
        }
        else{
            $this->updateInvoice($invoiceService);
        }

        if($invoiceService ->service_ratings){
            $this->decrementServiceRatings($invoiceService,$request->service_id);
        }
        if($invoiceService ->employee_ratings){
            $this->decrementEmployeeRatings($invoiceService,$request->employee_id);
        }
        $invoiceService->delete();


    }

    /**
     * update  a specific service ratings
     * @param $type , $invoiceService ,$service_id
     */
    public function decrementServiceRatings($invoiceService,$service_id){
        $service = $this->getSpecficeProduct($service_id);
        $service->service_ratings = $service->service_ratings - $invoiceService ->service_ratings;
        $service->service_rating_count = $service->service_rating_count - 1;
        $service->save();
    }

    /**
     * update  a specific employee ratings
     * @param $type , $invoiceService,$employee_id
     */
    public function decrementEmployeeRatings($invoiceService,$employee_id){
            $employee = $this->employeeRepository->getSpecficeEmployee($employee_id);
            $employee-> employee_ratings = $employee-> employee_ratings - $invoiceService ->employee_ratings;
            $employee-> employee_rating_count = $employee-> employee_rating_count - 1;
            $employee->save();
    }


    /**
     * delete a specefic invoice form storage
     * @param int $invoiceId
     */
    public function deleteInvoice($invoiceId){
        $invoice = $this->findSpecificInvoice($invoiceId);
        $invoice->forceDelete();
    }

    /**
     * update invoice comment
     * @param $id ,$request
     */
    public function updateInvoiceInformation($request,$id){
        $request->validate([
          'type'=>'required',
          'discount'=>'numeric',
          'paid'=>'numeric',
          'tax'=>'numeric',
        ]);

        $invoice = $this->findSpecificInvoice($id);
        $discount = $request->discount ? $request->discount :0;
        $tax = $request->tax ? $request->tax :0;
        $grandTotal =($this->calculateDiscount($invoice->subtotal,$request->type,$discount));
        if($grandTotal == 'discount error' && gettype($grandTotal)=='string'){
            return 'discount error';
        }
        if($grandTotal =='flat error'  && gettype($grandTotal)=='string' ){
            return 'flat error';
        }
        else{
            $totalTax = floatval($this->calculateTax($grandTotal,$tax));
            $grandTotalWithTax =  floatval($grandTotal) +$totalTax;
            $invoice->grandtotal = $grandTotalWithTax;
            $invoice->discount = $discount;
            $invoice->tax = $tax;
            $invoice->discountType = $request->type;
            if($request->paid !='' ){
                $this->updatePaymentWithDiscount($invoice,$grandTotalWithTax,$request->paid);
            }
            else{
                $this->updatePaymentWithDiscount($invoice,$grandTotalWithTax,0);
            }
        }
        $invoice ->comments = $request->Comment;
        $invoice -> save();
    }

    /**
     * update a specif invoice payment with discount
     * @param $invoice,$grandTotal,$paid
     */
    public function updatePaymentWithDiscount($invoice,$grandTotal,$paid){
        $invoice->amountPaid = $paid;
        $invoice->totalDue = $grandTotal - $paid;
    }
    /**
     * update a specific invoice payment without discount
     * @param $invoice ,$amount
     */
    public function updatePayment($invoice ,$amount){
        $invoice->amountPaid = $amount;
        $invoice->totalDue = $invoice->grandtotal - $amount;
    }

    /**
     * Destroy a specfic invoice
     * @param int $id
     */
    public function delete($id){
        $invoice =   $this->findSpecificInvoice($id);
        $invoice->delete();
    }
     /**
     * Restore from trash
     */
    public function restore($id){
        $invoice = $this->getSpecficeTrashInvoice($id);
        $invoice->restore();
    }
     /**
     * mark delete all selected expense invoice
     * @param array $ids
     * @param string type
     *
     */
    public function markDelete($ids){
        Invoice::with(['customer'])->whereIn('id',$ids)->delete();
    }

    /**
     * mark restore all selected Invoice
     * @param array $ids
     * @param string type
     *
     */
    public function markRestore($ids){
        Invoice::with(['customer'])->onlyTrashed()->whereIn('id',$ids)->restore();
    }

    /**
     * mark parmanent delete all selected package
     */
    public function markParmanentlyDelete($ids){
        Invoice::with(['customer'])->onlyTrashed()->whereIn('id',$ids)->forceDelete();
        $this->markDeleteInvoiceInfo($ids);
    }
    /**
     * Parmanent Delete of a package
     * @param int $id
     */
    public function parmanentDelete($id){
        $this->getSpecficeTrashInvoice($id)->forceDelete();
        $this->deleteInvoiceInfo($id);
    }
    /**
     * delete invoice info for a specefic invoice
     * @param $invoiceId
     */
    public function deleteInvoiceInfo($invoiceId){
        Invoicinfo::with(['service','employee'])->where('invoice_id',$invoiceId)->delete();
    }

    /**
     * delete invoice info
     * @param $invoiceIds
     */
    public function markDeleteInvoiceInfo($invoiceIds){
        Invoicinfo::with(['service','employee'])->whereIn('invoice_id',$invoiceIds)->delete();
    }

}