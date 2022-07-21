<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;
    use HasFactory;

    protected $guarded = [
    ];

    public function employee(){
        return $this->belongsTo('App\Models\Employee','employee_id','id');
    }

    public function workingday(){
        return $this->belongsTo('App\Models\WorkingDay','working_day_id','id');
    }
}