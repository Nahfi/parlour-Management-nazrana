<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Repositories\Admin\ProductRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
class ProductController extends Controller
{
    /**
     * costructor
     */
    private $productRepository;
    public $user;
    private $total_active_product,$total_deactive_product,$total_deleted_product;


   public function __construct(ProductRepository $productRepository)
   {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
       $this->productRepository = $productRepository;
       $this->total_active_product = Product::groupByStatusCount('Active');
       $this->total_deactive_product = Product::groupByStatusCount('DeActive');
       $this->total_deleted_product = Product::onlyTrashed()->where('type','service')->count();
   }

   /**
     * Show all product
     */
    public function index(){
        if(is_null($this->user) || !$this->user->can('product.index')){
            abort(403,'Unauthorized access');
        }
       $data['categories'] = ProductCategory::where('status','Active')->get();
       $data['brands'] = ProductBrand::where('status','Active')->get();
       $data['products'] =  $this->productRepository->index();
       $data['total_active_product'] =   $this->total_active_product;
       $data['total_deactive_product'] =  $this->total_deactive_product ;
       $data['total_deleted_product'] = $this->total_deleted_product;
        return view('admin.pages.product.products.index',[
          'data'=> $data
        ]);
    }

    /**
     * Show all active product
     */
    public function showActiveProduct(){
        if(is_null($this->user) || !$this->user->can('product.index')){
            abort(403,'Unauthorized access');
        }


        $data['products'] =  $this->productRepository->activeProduct();
        $data['total_active_product'] =   $this->total_active_product;
        $data['total_deactive_product'] =  $this->total_deactive_product ;
        $data['total_deleted_product'] = $this->total_deleted_product;
        return view('admin.pages.product.products.index',[
            'data' => $data
        ]);
    }
    /**
     * Show all Deactive product
     */
    public function showDeActiveProduct(){
        if(is_null($this->user) || !$this->user->can('product.index')){
            abort(403,'Unauthorized access');
        }
        $data['products']  = $this->productRepository->deActiveProduct();
        $data['total_active_product'] =   $this->total_active_product;
        $data['total_deactive_product'] =  $this->total_deactive_product ;
        $data['total_deleted_product'] = $this->total_deleted_product;
        return view('admin.pages.product.products.index',[
            'data' => $data
        ]);
    }

    /**
     * search expense category by year or months
     */
    public function search(Request $request){
        if(is_null($this->user) || !$this->user->can('product.index')){
            abort(403,'Unauthorized access');
        }
        if(!$request->category_id && !$request->brand_id ){
            return redirect()->route('admin.product.index')->with('search_failed','Please Select  A Category Or Brand or Ratings from SelectBox ');
        }
        else{
            $data['products']  = Product::with(['category','brand','createdBy','editedBy'])->where(function ($query) use ($request) {
                $query->filter($request);
            })->get();
            $data['categories'] = ProductCategory::where('status','Active')->get();
            $data['brands'] = ProductBrand::where('status','Active')->get();
            $data['total_active_product'] =   $this->total_active_product;
            $data['total_deactive_product'] =  $this->total_deactive_product ;
            $data['total_deleted_product'] = $this->total_deleted_product;
            return view('admin.pages.product.products.index',[
                'data' => $data
            ]);
        }
    }




    /**
     * Show all deleted product
     */
    public function showDeletedProduct(){
        if(is_null($this->user) || !$this->user->can('product.index')){
            abort(403,'Unauthorized access');
        }
        $data['products'] = $this->productRepository->showDeletedProduct();
        $data['total_active_product'] =   $this->total_active_product;
        $data['total_deactive_product'] =  $this->total_deactive_product ;
        $data['total_deleted_product'] = $this->total_deleted_product;
        return view('admin.pages.product.products.index',[
            'data' => $data
        ]);
    }
    /**
     * Show a form of create new product
     */
    public function create(){
        if(is_null($this->user) || !$this->user->can('product.store')){
            abort(403,'Unauthorized access');
        }
        $categories = ProductCategory::where('status','Active')->get();
        $brands = ProductBrand::where('status','Active')->get();
        return view('admin.pages.product.products.create',[
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    /**
     * Store the newely created product category
     */
    public function store(ProductStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('product.store')){
            abort(403,'Unauthorized access');
        }
        if(is_null($this->user) || !$this->user->can('product.category.store')){
            abort(403,'Unauthorized access');
        }
        $this->productRepository->create($request);
          return back()->with('service_add_success','Service added successfully');

    }

     /**
     * Display the specific customer .
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(is_null($this->user) || !$this->user->can('product.index')){
            abort(403,'Unauthorized access');
        }
        $product = $this->productRepository->getSpecficeProduct($id);
        if($product->category->status == 'DeActive'){
            return back();
        }
        $categories = ProductCategory::where('status','Active')->get();
        $brands = ProductBrand::where('status','Active')->get();
        return view('admin.pages.product.products.show',[
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }



    /**
     * Show a edit form for a specefic product
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('product.edit')){
            abort(403,'Unauthorized access');
        }
        $product = $this->productRepository->getSpecficeProduct($id);
        if($product->category->status == 'DeActive'){
            return back();
        }
        $categories = ProductCategory::where('status','Active')->get();
        $brands = ProductBrand::where('status','Active')->get();
        return view('admin.pages.product.products.edit',[
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
    /**
     * Update a specefice product
     */
    public function update(ProductUpdateRequest $request,$id){
        if(is_null($this->user) || !$this->user->can('product.edit')){
            abort(403,'Unauthorized access');
        }
        $this->productRepository->update($request,$id);
        return back()->with('product_update_success','Product Updated Successfully');
    }
    /**
     *
     * Destroy a specefic product
     * @param int $id
     */
    public function destroy($id){
        if(is_null($this->user) || !$this->user->can('product.delete')){
            abort(403,'Unauthorized access');
        }
        $response = $this->productRepository->delete($id);
        if($response == false){
            return back()->with('product_delete_failed','please delete invoice under this Service and try again');
        }
        return back()->with('product_delete_success','Product Deleted Successfully');
    }
    /**
     * Restore from trash
     */
    public function restore($id){
        if(is_null($this->user) || !$this->user->can('product.delete')){
            abort(403,'Unauthorized access');
        }
        $this->productRepository->restore($id);
        return back()->with('product_restore_success','Product Restore Successfully');
    }

     /**
     * Parmanent Delete
     */
    public function parmanentDelete($id){
        if(is_null($this->user) || !$this->user->can('product.parmanentDelete')){
            abort(403,'Unauthorized access');
        }
        $this->productRepository->parmanentDelete($id);
        return back()->with('parmanent_delete_success','Parmanenet Delete Successfull');
    }
    /**
     * Mark  all selected product
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
             if(is_null($this->user) || !$this->user->can('product.edit')){
                 abort(403,'Unauthorized access');
             }
             $type = $this->productRepository->markActive($type,$ids);
             return back()->with('mark_active_success','All Product Activated Successfully');
        }
        elseif($type == 'DeActive'){
             if(is_null($this->user) || !$this->user->can('product.edit')){
                 abort(403,'Unauthorized access');
             }
             $type = $this->productRepository->markDeActive($type,$ids);
             return back()->with('mark_deactive_success','All Product DeActivated Successfully');
        }
        elseif($type == 'Delete'){
             if(is_null($this->user) || !$this->user->can('product.delete')){
                 abort(403,'Unauthorized access');
             }
             $type = $this->productRepository->markDelete($type,$ids);
             return back()->with('mark_delete_success','All Product Deleted Successfully');
        }
        elseif($type == 'ParmanentDelete'){
            if(is_null($this->user) || !$this->user->can('product.parmanentDelete')){
                abort(403,'Unauthorized access');
            }
            $this->productRepository->markParmanentlyDelete($ids);
            return back()->with('mark_parmanent_delete_success','All Product Parmanently Deleted Successfully');
       }
        elseif($type == 'Restore'){
            if(is_null($this->user) || !$this->user->can('product.delete')){
                abort(403,'Unauthorized access');
            }
            $type = $this->productRepository->markRestore($type,$ids);
            return back()->with('mark_restore_success','All Product Restore Successfully');
        }

    }
}