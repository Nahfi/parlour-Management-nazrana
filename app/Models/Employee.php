<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\SoftDeletes;
class Employee extends Authenticatable
{
    use HasFactory,SoftDeletes,HasApiTokens, HasFactory, Notifiable;
    protected $guarded = [

    ];


    /**
     * encrypt password using hash
     */
    public function passwordEncrypt($value){
        return Hash::make($value);
    }

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * count employee
     */
    public static function groupByStatusCount($status){
        $total = Employee::where('status',$status)->count();
        return $total;
    }
    /**
     * Get the user name who create this employee
     */
    public function employeeCreatedBy(){
        return $this->belongsTo(Admin::class,'created_by','id');
    }
    /**
     * Get the user name who edit this employee
     */
    public function employeeEditedBy(){
        return $this->belongsTo(Admin::class,'edited_by','id');
    }

    /**
     * get invoice info
     */
    public function employeInvoice(){
        return $this->hasMany(Invoicinfo::class,'employee_id','id');
    }
}