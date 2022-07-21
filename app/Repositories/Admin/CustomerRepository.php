<?php
namespace App\Repositories\Admin;
use App\Models\Customer;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Services\ImageService;
class CustomerRepository{
    /**
     * constract a method
     */
    const imageLocation = "/admin_assets/images/customers/";
    protected $imageService;
    public function __construct()
    {
        $this->imageService=new ImageService();
    }
    /**
     * @return App\Models\Customer
     *
     */
    public function index(){
        return Customer::with(['customerCreatedBy','customerEditedBy'])->orderby('id','desc')->get();
    }
    /**
     * @return App\Models\Customer deleted
     */
    public function showDeletedCustomer(){
        return Customer::with(['customerCreatedBy','customerEditedBy'])->onlyTrashed()->orderBy('id','desc')->get();
    }
       /**
     * @return App\Models\Customer where status is Active
     */
    public function activeCustomer(){
        return Customer::with(['customerCreatedBy','customerEditedBy'])->where('status','Active')->orderBy('id','desc')->get();
    }
    /**
     * @return App\Models\customer where status is DeActive
     */
    public function deActiveCustomer(){
        return Customer::with(['customerCreatedBy','customerEditedBy'])->where('status','DeActive')->orderBy('id','desc')->get();

    }
    /**
     * @return a specefic customer
     * @param int $id
     */
    public function getSpecficeCustomer($id){
        return Customer::with(['customerCreatedBy','customerEditedBy'])->where('id',$id)->first();
    }
    /**
     * @return a specific trashed customer
     * @param int $id
     */
    public function getSpecficeTrashCustomer($id){
        return Customer::with(['customerCreatedBy','customerEditedBy'])->onlyTrashed()->where('id',$id)->first();
    }
    /**
     * store new customer in specefice storage
     * @param \Rquests\CustomerStoreRequest $request
     */
    public function create($request){
        $customer = new Customer();
        $customer->name = $request->name;
        $customer->cardNumber = $request->cardNumber;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->type = $request->type;
        $customer->status = $request->status;
        $customer->created_by = Auth::guard('admin')->User()->id;

        $imageName = 'default.jpg';
        if($request->hasFile('image')){
            $imageName = $this->imageService->upload('customer',CustomerRepository::imageLocation,$request->file('image'));
        }
        $customer->image = $imageName;
        $customer->save();
        return $customer;
    }

    /**
     * @param \Rquests\CustomerUpdateRequest $request
     * @param int $id
     *
     */
    public function update($request,$id){
        $customer = $this->getSpecficeCustomer($id);
        $customer->name = $request->name;
        $customer->cardNumber = $request->cardNumber;
        $customer->phone = $request->phone;
        $customer->email = $request->email;
        $customer->address = $request->address;
        $customer->type = $request->type;
        $customer->status = $request->status;

        $imageName=$customer->image;
        if($request->hasFile('image')){
            if($imageName!='default.jpg'){
                $this->imageService->delete($customer->image,CustomerRepository::imageLocation);
            }
            $imageName = $this->imageService->upload('customer',CustomerRepository::imageLocation,$request->file('image'));
        }
        $customer->image =$imageName;
        $customer->edited_by = Auth::guard('admin')->user()->id;
        $customer->save();
        return $customer;
    }

    /**
     * Destroy a specfic customer
     * @param int $id
     */
    public function delete($id){

       if( $this->countCustomerInvoice($id) > 0 ){
           return  back()->with('customer_delete_failed','please delete all invoice under this customer then try again');
       }
       else{
        $customer =   $this->getSpecficeCustomer($id);
        $customer->delete();
       }
    }
    /**
     * count customer total invoice
     * @param $id
     */
    public function countCustomerInvoice($id){
        return Invoice::where('customer_id',$id)->count();
    }
    /**
     * Restore from trash
     */
    public function restore($id){
        $customer = $this->getSpecficeTrashCustomer($id);
        $customer->restore();
    }
    /**
     * Parmanent Delete
     * @param int $id
     */
    public function parmanentDelete($id){
        $this->unlinkImage($id)->forceDelete();
    }
    /**
     * mark active all selected customer
     * @param array $ids
     * @param string type
     *
     */
    public function markActive($type,$ids){
        Customer::whereIn('id',$ids)->update([
            'status' => 'Active',
        ]);
        return $type;
    }
     /**
     * mark deactive all selected customer
     * @param array $ids
     * @param string type
     *
     */
    public function markDeActive($type,$ids){
        Customer::whereIn('id',$ids)->update([
            'status' => 'DeActive',
        ]);
        return $type;
    }
    /**
     * mark delete all selected customer
     * @param array $ids
     * @param string type
     *
     */
    public function markDelete($type,$ids){
        foreach($ids as $id){
            if( $this->countCustomerInvoice($id) == 0 ){
                $customer =   $this->getSpecficeCustomer($id);
                $customer->delete();
            }
        }
        return $type;
    }
    /**
     * mark parmanent delete all selected customer
     */
    public function markParmanentlyDelete($ids){
        foreach($ids as $key=>$id){
            $this->unlinkImage($id)->forceDelete();
        }

    }
    /**
     * mark restore all selected customer
     * @param array $ids
     * @param string type
     *
     */
    public function markRestore($type,$ids){
        Customer::onlyTrashed()->whereIn('id',$ids)->restore();
        return $type;
    }
    /**
     * call image delete function
     * @param int $id
     */
    public function unlinkImage($id){
        $customer = $this->getSpecficeTrashCustomer($id);
        $imageName = $customer->image;
        if($imageName!='default.jpg'){
            $this->imageService->delete($customer->image,CustomerRepository::imageLocation);
        }
        return $customer;

    }
}