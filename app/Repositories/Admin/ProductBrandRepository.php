<?php
namespace App\Repositories\Admin;

use App\Models\Product;
use App\Models\ProductBrand;
use Illuminate\Support\Facades\Auth;

class ProductBrandRepository{
    /**
     * @return App\Models\ProductBrand
     *
     */
    public function index(){
        return ProductBrand::with(['product','createdBy','editedBy'])->orderby('id','desc')->get();
    }

    /**
     * @return App\Models\ProductBrand deleted
     */
    public function showDeletedBrand(){
        return ProductBrand::with(['product','createdBy','editedBy'])->onlyTrashed()->orderBy('id','desc')->get();
    }
    /**
     * @return App\Models\ProductBrand where status is Active
     */
    public function activeBrand(){
        $brands = ProductBrand::with(['product','createdBy','editedBy'])->where('status','Active')->orderBy('id','desc')->get();
        return $brands;
    }
    /**
     * @return App\Models\ProductBrand where status is DeActive
     */
    public function deActiveBrand(){
        $brands = ProductBrand::with(['product','createdBy','editedBy'])->where('status','DeActive')->orderBy('id','desc')->get();
        return $brands;
    }

    /**
     * @return a specefic brand
     * @param int $id
     */
    public function getSpecficeBrand($id){
        return ProductBrand::with(['product','createdBy','editedBy'])->where('id',$id)->first();
    }
    /**
     * @param int $id
     */
    public function getSpecficeTrashBrand($id){
        return ProductBrand::with(['product','createdBy','editedBy'])->onlyTrashed()->where('id',$id)->first();
    }
    /**
     * store new product brand in specefice storage
     * @param \Rquests\ProductBrandStoreReqeust $request
     */
    public function create($request){
        $brand = new ProductBrand();
        $brand->name = str_replace(',', ' ', $request->name) ;
        $brand->status = $request->status;
        $brand->created_by = Auth::guard('admin')->User()->id;
        $brand->save();
        return $brand;
    }
    /**
     * @param \Rquests\ProductBrandUpdateReqeust $request
     * @param int $id
     *
     */
    public function update($request,$id){
        $brand = $this->getSpecficeBrand($id);
        $brand->name = str_replace(',', ' ', $request->name);
        $brand->status = $request->status;
        $brand->edited_by = Auth::guard('admin')->user()->id;
        $brand->save();
        return $brand;
    }
    /**
     * Destroy a specfic Brand
     * @param int $id
     */
    public function delete($id){
        $brand =   $this->getSpecficeBrand($id);
        $product = Product::withTrashed()->where('brand_id',$brand->id)->first();

        if($product != null){
            return true;
        }
        else{
           $brand->delete();
           return false;
        }
    }
    /**
     * Restore from trash
     */
    public function restore($id){
        $brand = $this->getSpecficeTrashBrand($id);
        $brand->restore();
    }
    /**
     * Parmanent Delete
     * @param string $name
     */
    public function parmanentDelete($id){
        $brand = ProductBrand::onlyTrashed()->where('id',$id)->first();
        $brand->forceDelete();
    }
    /**
     * mark active all selected brand
     * @param array $ids
     * @param string type
     *
     */
    public function markActive($ids){
        ProductBrand::whereIn('id',$ids)->update([
            'status' => 'Active',
        ]);
    }
    /**
     * mark deactive all selected product brand
     * @param array $ids
     * @param string type
     *
     */
    public function markDeActive($ids){
        ProductBrand::whereIn('id',$ids)->update([
            'status' => 'DeActive',
        ]);
    }
    /**
     * mark delete all selected brand
     * @param array $ids
     * @param string type
     *
     */
    public function markDelete($ids){
        $brands =  ProductBrand::whereIn('id',$ids)->get();
        foreach ($brands as $brand) {
            $check = Product::withTrashed()->where('brand_id',$brand->id)->first();
            if($check == null){
                $brand->delete();
            }
        }
    }
    /**
     * mark parmanent delete all selected brand
     */
    public function markParmanentlyDelete($ids){
        ProductBrand::withTrashed()->whereIn('id',$ids)->forceDelete();
    }

    /**
     * mark restore all selected brand
     * @param array $ids
     * @param string type
     *
     */
    public function markRestore($ids){
        ProductBrand::onlyTrashed()->whereIn('id',$ids)->restore();
    }

}