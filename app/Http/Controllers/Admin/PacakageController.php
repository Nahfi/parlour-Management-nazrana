<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PackageStroeRequest;
use App\Http\Requests\PackageUpdateRequest;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\ProductCategory;
use App\Repositories\Admin\PackageRepository;

class PacakageController extends Controller
{
    public $user;
    private $total_active_package,$total_deactive_package,$total_deleted_package;
    private $packageRepository;
    /**
     * Construct method
     */
    public function __construct(packageRepository $packageRepository)
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
        $this->packageRepository = $packageRepository;
        $this->total_active_package = Package::groupByStatusCount('Active');
        $this->total_deactive_package = Package::groupByStatusCount('DeActive');
        $this->total_deleted_package = Product::where('type','package')->onlyTrashed()->count();
    }


    /**
     * search expense category by year or months
     */
    public function search(Request $request){
        if(is_null($this->user) || !$this->user->can('product.index')){
            abort(403,'Unauthorized access');
        }
        if(!$request->category_id && !$request->brand_id ){
            return redirect()->route('admin.package.index')->with('search_failed','Please Select  A Category Or Brand or Ratings from SelectBox ');
        }
        else{
            $data['packages']  = Product::with(['category','brand','createdBy','editedBy'])->where(function ($query) use ($request) {
                $query->package($request);
            })->get();
            $data['categories'] = ProductCategory::where('status','Active')->get();
            $data['brands'] = ProductBrand::where('status','Active')->get();
            $data['total_active_package'] =   $this->total_active_package;
            $data['total_deactive_package'] =  $this->total_deactive_package ;
            $data['total_deleted_package'] = $this->total_deleted_package;
            return view('admin.pages.packages.index',[
                'data'=> $data
            ]);
        }
    }




    /**
     * Show all package
     */
    public function index(){

        if(is_null($this->user) || !$this->user->can('package.index')){
            abort(403,'Unauthorized access');
        }
        $data['categories'] = ProductCategory::where('status','Active')->get();
        $data['brands'] = ProductBrand::where('status','Active')->get();
       $data['packages'] =  $this->packageRepository->index();
       $data['total_active_package'] =   $this->total_active_package;
       $data['total_deactive_package'] =  $this->total_deactive_package ;
       $data['total_deleted_package'] = $this->total_deleted_package;

       return view('admin.pages.packages.index',[
            'data'=> $data
        ]);
    }
     /**
     * Show all Active packages
     */
    public function showActivePackage(){
        if(is_null($this->user) || !$this->user->can('package.index')){
            abort(403,'Unauthorized access');
        }
        $data['packages'] =  $this->packageRepository->activePackages();
        $data['total_active_package'] =   $this->total_active_package;
        $data['total_deactive_package'] =  $this->total_deactive_package ;
        $data['total_deleted_package'] = $this->total_deleted_package;

        return view('admin.pages.packages.index',[
            'data'=> $data
        ]);

    }
    /**
     * Show all Deactive packages
     */
    public function showDeActivePackage(){
        if(is_null($this->user) || !$this->user->can('package.index')){
            abort(403,'Unauthorized access');
        }
        $data['packages'] =  $this->packageRepository->deActivePackages();
        $data['total_active_package'] =   $this->total_active_package;
        $data['total_deactive_package'] =  $this->total_deactive_package ;
        $data['total_deleted_package'] = $this->total_deleted_package;

        return view('admin.pages.packages.index',[
            'data'=> $data
        ]);
    }
    // /**
    //  * Show all deleted packages
    //  */
    public function showDeletedPackage(){
        if(is_null($this->user) || !$this->user->can('package.index')){
            abort(403,'Unauthorized access');
        }

        $data['packages'] =  $this->packageRepository->showDeletedPackages();
        $data['total_active_package'] =   $this->total_active_package;
        $data['total_deactive_package'] =  $this->total_deactive_package ;
        $data['total_deleted_package'] = $this->total_deleted_package;
        return view('admin.pages.packages.index',[
            'data' => $data
        ]);
    }
    // /**
    //  * Show a form of create new packages
    //  */
    public function create(){
        if(is_null($this->user) || !$this->user->can('package.store')){
            abort(403,'Unauthorized access');
        }
        $categories = ProductCategory::where('status','Active')->get();
        $brands = ProductBrand::where('status','Active')->get();
        return view('admin.pages.packages.create',[
            'categories' => $categories,
            'brands' => $brands
        ]);
    }
    /**
     * Store the newely created package
     */
    public function store(PackageStroeRequest $request){
        if(is_null($this->user) || !$this->user->can('package.store')){
            abort(403,'Unauthorized access');
        }
        $this->packageRepository->create($request);
        return back()->with('pakcages_add_success','package added successfully');
    }
    //  /**
    //  * Display the specific customer .
    //  *
    //  * @param  int  $id
    //  * @return \Illuminate\Http\Response
    //  */
    public function show($id)
    {
        if(is_null($this->user) || !$this->user->can('package.index')){
            abort(403,'Unauthorized access');
        }
        $product = $this->packageRepository->getSpecficePackage($id);
        if($product->category->status == 'DeActive'){
            return back();
        }
        $categories = ProductCategory::where('status','Active')->get();
        $brands = ProductBrand::where('status','Active')->get();
        return view('admin.pages.packages.show',[
            'product' => $product,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }


    /**
     * Show a edit form for a specefic package
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('package.edit')){
            abort(403,'Unauthorized access');
        }
        $package = $this->packageRepository->getSpecficePackage($id);
        $categories = ProductCategory::where('status','Active')->get();
        $brands = ProductBrand::where('status','Active')->get();
        return view('admin.pages.packages.edit',[
            'product' => $package,
            'categories' => $categories,
            'brands' => $brands
        ]);
    }

    /**
     * Update a specefice package
     */
    public function update(PackageUpdateRequest $request,$id){
        if(is_null($this->user) || !$this->user->can('package.edit')){
            abort(403,'Unauthorized access');
        }
        $this->packageRepository->update($request,$id);
        return back()->with('package_update_success','package Updated Successfully');
    }
    /**
     *
     * Destroy a specefic package
     * @param int $id
     */
    public function destroy($id){
        if(is_null($this->user) || !$this->user->can('package.delete')){
            abort(403,'Unauthorized access');
        }
        $response = $this->packageRepository->delete($id);
        if($response == false){
            return back()->with('package_delete_failed','please delete invoice under this package and try again');
        }
        return back()->with('package_delete_success','Package Deleted Successfully');
    }
    /**
     * Restore form trash
     */
    public function restore($id){
        if(is_null($this->user) || !$this->user->can('package.delete')){
            abort(403,'Unauthorized access');
        }
        $this->packageRepository->restore($id);
        return back()->with('package_restore_success','package Restore Successfully');
    }
    /**
     * Parmanent Delete
     */
    public function parmanentDelete($id){
        if(is_null($this->user) || !$this->user->can('package.parmanentDelete')){
            abort(403,'Unauthorized access');
        }
        $this->packageRepository->parmanentDelete($id);
        return back()->with('parmanent_delete_success','Parmanenet Delete Successfull');
    }
    /**
     * Mark  all selected package
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
             if(is_null($this->user) || !$this->user->can('package.edit')){
                 abort(403,'Unauthorized access');
             }
             $type = $this->packageRepository->markActive($type,$ids);
             return back()->with('mark_active_success','All package Activated Successfully');
        }
        else if($type == 'DeActive'){
             if(is_null($this->user) || !$this->user->can('package.edit')){
                 abort(403,'Unauthorized access');
             }
             $type = $this->packageRepository->markDeActive($type,$ids);
             return back()->with('mark_deactive_success','All package DeActivated Successfully');
        }
        else if($type == 'Delete'){
             if(is_null($this->user) || !$this->user->can('package.delete')){
                 abort(403,'Unauthorized access');
             }
             $type = $this->packageRepository->markDelete($type,$ids);
             return back()->with('mark_delete_success','All package Deleted Successfully');
        }
        else if($type == 'ParmanentDelete'){
            if(is_null($this->user) || !$this->user->can('package.parmanentDelete')){
                abort(403,'Unauthorized access');
            }
            $this->packageRepository->markParmanentlyDelete($ids);
            return back()->with('mark_parmanent_delete_success','All package Parmanently Deleted Successfully');
       }
        else if($type == 'Restore'){
            if(is_null($this->user) || !$this->user->can('package.delete')){
                abort(403,'Unauthorized access');
            }
            $type = $this->packageRepository->markRestore($type,$ids);
            return back()->with('mark_restore_success','All package Restore Successfully');
        }
    }

}