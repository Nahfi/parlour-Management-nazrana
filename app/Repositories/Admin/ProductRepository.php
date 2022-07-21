<?php
namespace App\Repositories\Admin;

use App\Models\Invoicinfo;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Services\ImageService;

class ProductRepository{

    /**
     * constract a method
     */
    const imageLocation = "/admin_assets/images/products/";
    protected $imageService;
    public function __construct()
    {
        $this->imageService=new ImageService();
    }
    /**
     * @return App\Models\Product
     *
     */
    public function index(){
        return Product::with(['category','brand','createdBy','editedBy'])->where('type','service')->orderby('id','desc')->get();
    }
    /**
     * @return App\Models\Product deleted
     */
    public function showDeletedProduct(){
        return Product::with(['category','brand','createdBy','editedBy'])->where('type','service')->onlyTrashed()->orderBy('id','desc')->get();
    }
     /**
     * @return App\Models\Product where status is Active
     */
    public function activeProduct(){
        $products = Product::with(['category','brand','createdBy','editedBy'])->where('status','Active')->where('type','service')->orderBy('id','desc')->get();
        return $products;
    }
    /**
     * @return App\Models\Product where status is DeActive
     */
    public function deActiveProduct(){
        $products = Product::with(['category','brand','createdBy','editedBy'])->where('status','DeActive')->where('type','service')->orderBy('id','desc')->get();
        return $products;
    }
    /**
     * @return a specefic category
     * @param int $id
     */
    public function getSpecficeProduct($id){
        return Product::with(['category','brand','createdBy','editedBy'])->where('id',$id)->first();
    }
    /**
     * @param int $id
     */
    public function getSpecficeTrashProduct($id){
        return Product::with(['category','brand','createdBy','editedBy'])->onlyTrashed()->where('id',$id)->first();
    }
    /**
     * store new expense in specefice storage
     * @param \Rquests\ProductStoreRequest $request
     */
    public function create($request){

        $imageName='default.jpg';
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->type = 'service';
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->details = $request->details;
        $product->price = $request->price;
        $product->status = $request->status;

        $product->created_by = Auth::guard('admin')->User()->id;
        if($request->hasFile('image')){
            $imageName= $this->imageService->upload('service',ProductRepository::imageLocation,$request->file('image'));
        }
        $product->photo = $imageName;
        $product->save();
        return $product;
    }
    /**
     * @param \Rquests\ProductUpdateRequest $request
     * @param int $id
     *
     */
    public function update($request,$id){
        $product = $this->getSpecficeProduct($id);
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->type = 'service';
        $product->details = $request->details;
        $product->price = $request->price;
        $product->status = $request->status;
        $imageName = $product->photo;
        if($request->hasFile('image')){
            if($imageName!='default.jpg'){
                $this->imageService->delete($product->photo,ProductRepository::imageLocation);
            }
            $imageName= $this->imageService->upload('service',ProductRepository::imageLocation,$request->file('image'));
        }
        $product->photo = $imageName;
        $product->edited_by = Auth::guard('admin')->user()->id;
        $product->save();
        return $product;
    }
    /**
     * Destroy a specfic Category
     * @param int $id
     */
    public function delete($id){

        if( $this->countServiceInvoice($id) > 0 ){
            return false;
        }
        else{
            $product =   $this->getSpecficeProduct($id);
            $product->delete();
            return true;
        }

    }


   /**
     * count  total service invoice
     * @param $id
     */
    public function countServiceInvoice ($id){
        return Invoicinfo::where('service_id',$id)->count();
    }
    /**
     * Restore from trash
     */
    public function restore($id){
        $product = $this->getSpecficeTrashProduct($id);
        $product->restore();
    }

    /**
     * Parmanent Delete
     * @param int $id
     */
    public function parmanentDelete($id){
        $this->unlinkImage($id)->forceDelete();
    }
    /**
     * mark active all selected product
     * @param array $ids
     * @param string type
     *
     */
    public function markActive($type,$ids){
        Product::whereIn('id',$ids)->update([
            'status' => 'Active',
        ]);
        return $type;
    }
     /**
     * mark deactive all selected product
     * @param array $ids
     * @param string type
     *
     */
    public function markDeActive($type,$ids){
        Product::whereIn('id',$ids)->update([
            'status' => 'DeActive',
        ]);
        return $type;
    }
    /**
     * mark delete all selected product
     * @param array $ids
     * @param string type
     *
     */
    public function markDelete($type,$ids){
        foreach($ids as $id){
            if( $this->countServiceInvoice($id) == 0 ){
                $product =   $this->getSpecficeProduct($id);
                $product->delete();
            }
        }
    }
    /**
     * mark parmanent delete all selected product
     */
    public function markParmanentlyDelete($ids){
        foreach($ids as $key=>$id){
        $this->unlinkImage($id)->forceDelete();
        }

    }
    /**
     * mark restore all selected product
     * @param array $ids
     * @param string type
     *
     */
    public function markRestore($type,$ids){
        Product::onlyTrashed()->whereIn('id',$ids)->restore();
        return $type;
    }
    /**
     * call image delete function
     * @param int $id
     */
    public function unlinkImage($id){
        $product = $this->getSpecficeTrashProduct($id);
        $imageName = $product->photo;
        if($imageName!='default.jpg'){
            $this->imageService->delete($product->photo,ProductRepository::imageLocation);
        }
        return $product;

    }
}
