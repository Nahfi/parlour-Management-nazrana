<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductBrandStoreRequest;
use App\Http\Requests\ProductBrandUpdateRequest;
use App\Models\ProductBrand;
use App\Repositories\Admin\ProductBrandRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductBrandController extends Controller
{
    /**
     * costructor
     */
    private $productBrandRepository;
    public $user;
    private $total_active_brand,$total_deactive_brand,$total_deleted_brand;
    
  
   public function __construct(ProductBrandRepository $productBrandRepository)
   {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
       $this->productBrandRepository = $productBrandRepository;
       $this->total_active_brand = ProductBrand::groupByStatusCount('Active');
       $this->total_deactive_brand = ProductBrand::groupByStatusCount('DeActive');
       $this->total_deleted_brand = ProductBrand::onlyTrashed()->count();
   }
   /**
     * Show all product brand
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('product.brand.index')){
            abort(403,'Unauthorized access');
        }
       $data['brands'] =  $this->productBrandRepository->index();
       $data['total_active_brand'] =   $this->total_active_brand;
       $data['total_deactive_brand'] =  $this->total_deactive_brand ;
       $data['total_deleted_brand'] = $this->total_deleted_brand;
        return view('admin.pages.product.brand.index',[
          'data'=> $data
        ]);
    }
    /**
     * Show all active brand
     */
    public function showActiveBrand(){
        if(is_null($this->user) || !$this->user->can('product.brand.index')){
            abort(403,'Unauthorized access');
        }
        $data['brands'] =  $this->productBrandRepository->activeBrand();
        $data['total_active_brand'] =   $this->total_active_brand;
        $data['total_deactive_brand'] =  $this->total_deactive_brand ;
        $data['total_deleted_brand'] = $this->total_deleted_brand;
        return view('admin.pages.product.brand.index',[
            'data' => $data
        ]);
    }
     /**
     * Show all Deactive brand
     */
    public function showDeActiveBrand(){
        if(is_null($this->user) || !$this->user->can('product.brand.index')){
            abort(403,'Unauthorized access');
        }
        $data['brands'] =  $this->productBrandRepository->deActiveBrand();
        $data['total_active_brand'] =   $this->total_active_brand;
        $data['total_deactive_brand'] =  $this->total_deactive_brand ;
        $data['total_deleted_brand'] = $this->total_deleted_brand;
        return view('admin.pages.product.brand.index',[
            'data' => $data
        ]);
    }

    /**
     * Show all deleted brand
     */
    public function showDeletedBrand(){
        if(is_null($this->user) || !$this->user->can('product.brand.index')){
            abort(403,'Unauthorized access');
        }
        $data['brands'] =  $this->productBrandRepository->showDeletedBrand();
        $data['total_active_brand'] =   $this->total_active_brand;
        $data['total_deactive_brand'] =  $this->total_deactive_brand ;
        $data['total_deleted_brand'] = $this->total_deleted_brand;
        return view('admin.pages.product.brand.index',[
            'data' => $data
        ]);
    }
    /**
     * Show a form of create new brand
     */
    public function create(){
        if(is_null($this->user) || !$this->user->can('product.brand.store')){
            abort(403,'Unauthorized access');
        }
        return view('admin.pages.product.brand.create');
    }
    /**
     * Store the newely created brand
     */
    public function store(ProductBrandStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('product.brand.store')){
            abort(403,'Unauthorized access');
        }
        $this->productBrandRepository->create($request);
        return back()->with('brand_create_success','Brand Created successfully');
    }
    /**
     * Show a edit form for a specefic brand
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('product.brand.edit')){
            abort(403,'Unauthorized access');
        }
        $brand = $this->productBrandRepository->getSpecficeBrand($id);
        return view('admin.pages.product.brand.edit',[
            'brand' => $brand
        ]);
    }
    /**
     * Update a specefice product brand
     */
    public function update(ProductBrandUpdateRequest $request,$id){
        if(is_null($this->user) || !$this->user->can('product.brand.edit')){
            abort(403,'Unauthorized access');
        }
        $this->productBrandRepository->update($request,$id);
        return back()->with('brand_update_success','Product Updated Successfully');
    }

    /**
     * 
     * Destroy a specefic brand
     * @param int $id
     */
    public function destroy($id){
        if(is_null($this->user) || !$this->user->can('product.brand.delete')){
            abort(403,'Unauthorized access');
        }
       $check =  $this->productBrandRepository->delete($id);
       if($check){
            return back()->with('brand_delete_unsuccess','Product Delete UnSuccessfull');
        }
        else{
            return back()->with('brand_delete_success','Product Deleted Successfully');
        }  
    }
    /**
     * Restore form trash
     */
    public function restore($id){
        if(is_null($this->user) || !$this->user->can('product.brand.delete')){
            abort(403,'Unauthorized access');
        }
        $this->productBrandRepository->restore($id);
        return back()->with('brand_restore_success','Product Restore Successfully');
    }
    /**
     * Parmanent Delete
     */
    public function parmanentDelete($id){
        if(is_null($this->user) || !$this->user->can('product.brand.parmanentDelete')){
            abort(403,'Unauthorized access');
        }
        $this->productBrandRepository->parmanentDelete($id);
        return back()->with('parmanent_delete_success','Parmanenet Delete Successfull');
    }
    /**
     * Mark  all selected brand
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
            if(is_null($this->user) || !$this->user->can('product.brand.edit')){
                abort(403,'Unauthorized access');
            }
            $this->productBrandRepository->markActive($ids);
            return back()->with('mark_active_success','All Brand Activated Successfully');
       }
       elseif($type == 'DeActive'){
            if(is_null($this->user) || !$this->user->can('product.brand.edit')){
                abort(403,'Unauthorized access');
            }
            $this->productBrandRepository->markDeActive($ids);
            return back()->with('mark_deactive_success','All Brand DeActivated Successfully');
       }
       elseif($type == 'Delete'){
            if(is_null($this->user) || !$this->user->can('product.brand.delete')){
                abort(403,'Unauthorized access');
            }
            $this->productBrandRepository->markDelete($ids);
            return back()->with('mark_delete_success','All Brand Deleted Successfully which has no expense');
       }
       elseif($type == 'ParmanentDelete'){
            if(is_null($this->user) || !$this->user->can('product.brand.parmanentDelete')){
                abort(403,'Unauthorized access');
            }
            $this->productBrandRepository->markParmanentlyDelete($ids);
            return back()->with('mark_parmanent_delete_success','All Brand Parmanently Deleted Successfully');
       }
       elseif($type == 'Restore'){
            if(is_null($this->user) || !$this->user->can('product.brand.delete')){
                abort(403,'Unauthorized access');
            }
            $this->productBrandRepository->markRestore($ids);
            return back()->with('mark_restore_success','All Brand Restore Successfully');
       } 
    }



}
