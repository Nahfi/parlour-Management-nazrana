<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductBrand extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [

    ];

    public static function groupByStatusCount($status){
        $total = ProductBrand::where('status',$status)->count();
        return $total;
    }

    /**
     * Get the user name who create this brand
     */
    public function createdBy(){
        return $this->belongsTo('App\Models\Admin','created_by','id');
    }
    /**
     * Get the user name who edit this
     */
    public function editedBy(){
        return $this->belongsTo('App\Models\Admin','edited_by','id');
    }
    /**
     * Get the all product that use a specific brand
     */
    public function product(){
        return ($this->hasMany(Product::class,'brand_id','id'));
    }
}