<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoicinfo extends Model
{
    use HasFactory;
    protected $guarded = [
        
    ];

    /**
     * get service info
     */
    public function service(){
        return $this->belongsTo(Product::class,'service_id','id');
    }
    /**
     * get employee info
     */
    public function employee(){
        return $this->belongsTo(Employee::class,'employee_id','id');
    }
}
