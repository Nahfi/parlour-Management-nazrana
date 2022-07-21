<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isNull;
use Illuminate\Support\Carbon;
class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $employee = Employee::where('email','employee@example.com')->first();
        if(isNull($employee)){
           $employee =  Employee::create([
                'name' => 'Employee',
                'email' => 'employee@example.com',
                'phone' => '01515272338',
                'description' => Str::random(20),
                'identificationNumber' => '0123456789',
                'password' => Hash::make('123456789'),
                'address' => 'TestAddress',
                'salary' => '1000',
                'designation' => 'xyz',
                'joinDate' => Carbon::now(),
                'status' => 'Active',
                'created_by' => '1'
            ]);
        }
    }
}