<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Package extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [

    ];

    /**
     * count customer
     */
    public static function groupByStatusCount($status){
        $total = Product::where('type','package')->where('status',$status)->count();
        return $total;
    }
    /**
     * Get the user name who create this package
     */
    public function packageCreatedBy(){
        return $this->belongsTo(Admin::class,'created_by','id');
    }
    /**
     * Get the user name who edit this package
     */
    public function packageEditedBy(){
        return $this->belongsTo(Admin::class,'edited_by','id');
    }
}