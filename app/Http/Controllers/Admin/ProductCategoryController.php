<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryStoreRequest;
use App\Http\Requests\ProductCategoryUpdateRequest;
use App\Models\ProductCategory;
use App\Repositories\Admin\ProductCategoryRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductCategoryController extends Controller
{
    /**
     * costructor
     */
    private $productCategoryRepository;
    public $user;
    private $total_active_category,$total_deactive_category,$total_deleted_category;
    
   public function __construct(ProductCategoryRepository $productCategoryRepository)
   {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
       $this->productCategoryRepository = $productCategoryRepository;
       $this->total_active_category = ProductCategory::groupByStatusCount('Active');
       $this->total_deactive_category = ProductCategory::groupByStatusCount('DeActive');
       $this->total_deleted_category = ProductCategory::onlyTrashed()->count();
   }
    /**
     * Show all product Category
     */
    public function index(){
        
       $data['categories'] =  $this->productCategoryRepository->index();
       $data['total_active_category'] =   $this->total_active_category;
       $data['total_deactive_category'] =  $this->total_deactive_category ;
       $data['total_deleted_category'] = $this->total_deleted_category;
        return view('admin.pages.product.category.index',[
          'data'=> $data
        ]);
    }

    /**
     * Show all active product category
     */
    public function showActiveCategory(){
        if(is_null($this->user) || !$this->user->can('product.category.index')){
            abort(403,'Unauthorized access');
        }
        $data['categories'] = $this->productCategoryRepository->activeCategory();
        $data['total_active_category'] =   $this->total_active_category;
        $data['total_deactive_category'] =  $this->total_deactive_category ;
        $data['total_deleted_category'] = $this->total_deleted_category;
        return view('admin.pages.product.category.index',[
            'data' => $data
        ]);
    }
    /**
     * Show all Deactive product category
     */
    public function showDeActiveCategory(){
        if(is_null($this->user) || !$this->user->can('product.category.index')){
            abort(403,'Unauthorized access');
        }
        $data['categories']  = $this->productCategoryRepository->deActiveCategory();
        $data['total_active_category'] =   $this->total_active_category;
        $data['total_deactive_category'] =  $this->total_deactive_category ;
        $data['total_deleted_category'] = $this->total_deleted_category;
        return view('admin.pages.product.category.index',[
            'data' => $data
        ]);
    }

    /**
     * Show all deleted product Category
     */
    public function showDeletedCategory(){
        if(is_null($this->user) || !$this->user->can('product.category.index')){
            abort(403,'Unauthorized access');
        }
        $data['categories'] = $this->productCategoryRepository->showDeletedCategory();
        $data['total_active_category'] =   $this->total_active_category;
        $data['total_deactive_category'] =  $this->total_deactive_category ;
        $data['total_deleted_category'] = $this->total_deleted_category;
        return view('admin.pages.product.category.index',[
          'data' => $data
        ]);
    }

    /**
     * Show a form of create new product category
     */
    public function create(){
        if(is_null($this->user) || !$this->user->can('product.category.store')){
            abort(403,'Unauthorized access');
        }
        return view('admin.pages.product.category.create');
    }

    /**
     * Store the newely created product category
     */
    public function store(ProductCategoryStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('product.category.store')){
            abort(403,'Unauthorized access');
        }
        $this->productCategoryRepository->create($request);
        return back()->with('category_create_success','Category Created successfully');
    }

    /**
     * Show a edit form for a specefic product category
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('product.category.edit')){
            abort(403,'Unauthorized access');
        }
        $category = $this->productCategoryRepository->getSpecficeCategory($id);
        return view('admin.pages.product.category.edit',[
            'category' => $category
        ]);
    }

    /**
     * Update a specefice product category
     */
    public function update(ProductCategoryUpdateRequest $request,$id){
        if(is_null($this->user) || !$this->user->can('product.category.edit')){
            abort(403,'Unauthorized access');
        }
        $this->productCategoryRepository->update($request,$id);
        return back()->with('category_update_success','Category Updated Successfully');
    }

    /**
     * 
     * Destroy a specefic product category
     * @param int $id
     */
    public function destroy($id){
        if(is_null($this->user) || !$this->user->can('product.category.delete')){
            abort(403,'Unauthorized access');
        }
       $check =  $this->productCategoryRepository->delete($id);
       if($check){
            return back()->with('category_delete_unsuccess','Category Delete UnSuccessfull');
        }
        else{
            return back()->with('category_delete_success','Category Deleted Successfully');
        }
       
    }

    /**
     * Restore form trash
     */
    public function restore($id){
        if(is_null($this->user) || !$this->user->can('product.category.delete')){
            abort(403,'Unauthorized access');
        }
        $this->productCategoryRepository->restore($id);
        return back()->with('category_restore_success','Category Restore Successfully');
    }

    /**
     * Parmanent Delete
     */
    public function parmanentDelete($id){
        if(is_null($this->user) || !$this->user->can('product.category.parmanentDelete')){
            abort(403,'Unauthorized access');
        }
        $this->productCategoryRepository->parmanentDelete($id);
        return back()->with('parmanent_delete_success','Parmanenet Delete Successfull');
    }

    /**
     * Mark  all selected product category
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
            if(is_null($this->user) || !$this->user->can('product.category.edit')){
                abort(403,'Unauthorized access');
            }
            $this->productCategoryRepository->markActive($ids);
            return back()->with('mark_active_success','All Category Activated Successfully');
       }
       elseif($type == 'DeActive'){
            if(is_null($this->user) || !$this->user->can('product.category.edit')){
                abort(403,'Unauthorized access');
            }
            $this->productCategoryRepository->markDeActive($ids);
            return back()->with('mark_deactive_success','All Category DeActivated Successfully');
       }
       elseif($type == 'Delete'){
            if(is_null($this->user) || !$this->user->can('product.category.delete')){
                abort(403,'Unauthorized access');
            }
            $this->productCategoryRepository->markDelete($ids);
            return back()->with('mark_delete_success','All Category Deleted Successfully which has no product');
       }
       elseif($type == 'ParmanentDelete'){
            if(is_null($this->user) || !$this->user->can('product.category.parmanentDelete')){
                abort(403,'Unauthorized access');
            }
            $this->productCategoryRepository->markParmanentlyDelete($ids);
            return back()->with('mark_parmanent_delete_success','All Category Parmanently Deleted Successfully');
       }
       elseif($type == 'Restore'){
            if(is_null($this->user) || !$this->user->can('product.category.delete')){
                abort(403,'Unauthorized access');
            }
            $this->productCategoryRepository->markRestore($ids);
            return back()->with('mark_restore_success','All Category Restore Successfully');
       } 
    }

   
}
