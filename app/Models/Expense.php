<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Expense extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded = [

    ];
    public static function groupByStatusCount($status){
        $total = Expense::where('status',$status)->count();
        return $total;
    }

    public static function allCategory(){
        return ExpenseCategory::all();
    }

    /**
     * Get expense category name
     */
    public function category(){
        return $this->belongsTo('App\Models\ExpenseCategory','category_id','id');
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
     * scope filtering
     */
    public function scopeFilter($query, $request ){
        // dd($request->all());
        if($request->category)
        {
            $query->where('category_id',$request->category);
        }
        if($request->month)
        {
            $query->whereMonth('created_at', $request->month);
        }
        if($request->year)
        {
            $query->whereYear('created_at', $request->year);
        }

        return $query;
    }

}