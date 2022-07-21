<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Admin;

class Customer extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [
        
    ];

    /**
     * count customer
     */
    public static function groupByStatusCount($status){
        $total = Customer::where('status',$status)->count();
        return $total;
    }
    /**
     * Get the user name who create this customer
     */
    public function customerCreatedBy(){
        return $this->belongsTo(Admin::class,'created_by','id');
    }
    /**
     * Get the user name who edit this customer
     */
    public function customerEditedBy(){
        return $this->belongsTo(Admin::class,'edited_by','id');
    }

    /**
     * get invoice for a specific customer
     */
    public function invoice(){
        return $this->hasMany(Invoice::class,'customer_id','id');
    }
}
