<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Invoice extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [

    ];

    /**
     * get customer for a specific invoice
     */
    public function customer(){
        return $this->belongsTo(Customer::class,'customer_id','id');
    }

   /**
     * scope filtering
     */
    public function scopeFilter($query, $request ){

        if($request->payment_type)
        {
            $query->where('payment_type',$request->payment_type);
        }
        if($request->year)
        {
            $query->whereYear('created_at', $request->year);
        }
        if($request->month)
        {
            $query->whereMonth('created_at', $request->month);
        }
        return $query;
    }
}