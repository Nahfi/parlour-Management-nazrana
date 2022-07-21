<?php
namespace App\Repositories\Admin;

use App\Models\Invoicinfo;
use App\Models\Package;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Services\ImageService;
class PackageRepository{
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
     * @return App\Models\Package
     *
     */
    public function index(){
        return Product::with(['category','brand','createdBy','editedBy'])->where('type','package')->orderby('id','desc')->get();
    }
     /**
     * @return App\Models\Package deleted
     */
    public function showDeletedPackages(){
        return Product::with(['category','brand','createdBy','editedBy'])->onlyTrashed()->where('type','package')->orderBy('id','desc')->get();
    }
       /**
     * @return App\Models\Package where status is Active
     */
    public function activePackages(){
        return Product::with(['category','brand','createdBy','editedBy'])->where('status','Active')->where('type','package')->orderBy('id','desc')->get();
    }
    /**
     * @return App\Models\Package where status is DeActive
     */
    public function deActivePackages(){
        return Product::with(['category','brand','createdBy','editedBy'])->where('status','DeActive')->where('type','package')->orderBy('id','desc')->get();
    }
     /**
     * @return a specefic package
     * @param int $id
     */
    public function getSpecficePackage($id){
        return Product::with(['category','brand','createdBy','editedBy'])->where('id',$id)->where('type','package')->first();
    }
    /**
     * @return a specific trashed package
     * @param int $id
     */
    public function getSpecficeTrashPackage($id){
        return Product::with(['category','brand','createdBy','editedBy'])->onlyTrashed()->where('id',$id)->where('type','package')->first();
    }
    /**
     * store new packages in specefice storage
     * @param \Rquests\PackageStoreRequest $request
     */
    public function create($request){

        $imageName='default.jpg';
        $product = new Product();
        $product->category_id = $request->category_id;
        $product->type = 'package';
        $product->brand_id = $request->brand_id;
        $product->name = $request->name;
        $product->details = $request->details;
        $product->price = $request->price;
        $product->status = $request->status;
        $product->created_by = Auth::guard('admin')->User()->id;
        if($request->hasFile('image')){
            $imageName= $this->imageService->upload('package',ProductRepository::imageLocation,$request->file('image'));
        }
        $product->photo = $imageName;
        $product->save();
        return $product;

    }
    /**
     * @param \Rquests\PackageUpdateRequest $request
     * @param int $id
     *
     */
    public function update($request,$id){
        $package = $this->getSpecficePackage($id);
        $package->category_id = $request->category_id;
        $package->brand_id = $request->brand_id;
        $package->name = $request->name;
        $package->type = 'package';
        $package->details = $request->details;
        $package->price = $request->price;
        $package->status = $request->status;
        $imageName = $package->photo;
        if($request->hasFile('image')){
            if($imageName!='default.jpg'){
                $this->imageService->delete($package->photo,ProductRepository::imageLocation);
            }
            $imageName= $this->imageService->upload('package',ProductRepository::imageLocation,$request->file('image'));
        }
        $package->photo = $imageName;
        $package->edited_by = Auth::guard('admin')->user()->id;
        $package->save();
        return $package;
    }

    /**
     * Destroy a specfic package
     * @param int $id
     */
    public function delete($id){
        if( $this->countServiceInvoice($id) > 0 ){
            return false;
        }
        else{
            $package =   $this->getSpecficePackage($id);
            $package->delete();
            return true;
        }
    }

    /**
     * count employee total invoice
     * @param $id
     */
    public function countServiceInvoice ($id){
        return Invoicinfo::where('service_id',$id)->count();
    }
    /**
     * Restore from trash
     */
    public function restore($id){
        $package = $this->getSpecficeTrashPackage($id);
        $package->restore();
    }
    /**
     * Parmanent Delete of a package
     * @param int $id
     */
    public function parmanentDelete($id){
        $this->unlinkImage($id)->forceDelete();
    }
    /**
     * mark active all selected package
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
     * mark deactive all selected package
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
     * mark delete all selected package
     * @param array $ids
     * @param string type
     *
     */
    public function markDelete($type,$ids){
        foreach($ids as $id){
            if( $this->countServiceInvoice($id) == 0 ){
                $employee =   $this->getSpecficePackage($id);
                $employee->delete();
            }
        }
        return $type;
    }
    /**
     * mark parmanent delete all selected package
     */
    public function markParmanentlyDelete($ids){
        foreach($ids as $key=>$id){
        $this->unlinkImage($id)->forceDelete();
        }

    }
    /**
     * mark restore all selected package
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
        $package = $this->getSpecficeTrashPackage($id);
        $imageName = $package->photo;
        if($imageName!='default.jpg'){
            $this->imageService->delete($package->photo,PackageRepository::imageLocation);
        }
        return $package;

    }


}
