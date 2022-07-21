<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [

    ];
    public static function groupByStatusCount($status){
        $total = Product::where('status',$status)->where('type','service')->count();
        return $total;
    }
    /**
     * Get product category name
     */
    public function brand(){
        return $this->belongsTo('App\Models\ProductBrand','brand_id','id');
    }
    /**
     * Get product category name
     */
    public function category(){
        return $this->belongsTo('App\Models\ProductCategory','category_id','id');
    }

    /**
     * Get the user name who create this category
     */
    public function createdBy(){
        return $this->belongsTo('App\Models\Admin','created_by','id');
    }
    /**
     * Get the user name who edit this category
     */
    public function editedBy(){
        return $this->belongsTo('App\Models\Admin','edited_by','id');
    }

    /**
     * get invoice info
     */
    public function serviceInvoice(){
        return $this->hasMany(Invoicinfo::class,'service_id','id');
    }

    /**
     * scope filtering
     */
    public function scopeFilter($query, $request ){

        if($request->category_id)
        {
            $query->where('category_id',$request->category_id)->where('type','service');
        }
        if($request->brand_id)
        {
            $query->where('brand_id', $request->brand_id)->where('type','service');
        }
        return $query;
    }

    /**
     * scope filtering
     */
    public function scopePackage($query, $request ){
        // dd($request->all());
        if($request->category_id)
        {
            $query->where('category_id',$request->category_id)->where('type','package');
        }
        if($request->brand_id)
        {
            $query->where('brand_id', $request->brand_id)->where('type','package');
        }
        return $query;
    }
}