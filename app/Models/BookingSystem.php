<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingSystem extends Model
{
    use HasFactory;

    protected $guarded = [
        
    ];

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
}
