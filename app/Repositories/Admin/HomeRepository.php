<?php
namespace App\Repositories\Admin;

use App\Models\Admin;
use App\Models\BookingSystem;
use App\Models\Customer;
use App\Models\Employee;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Package;
use App\Models\Product;
use App\Models\Salary;

class HomeRepository{
    public function index(){
        $data['total_admin'] = Admin::count();
        $data['total_employee'] = Employee::count();
        $data['total_customer'] = Customer::count();
        $data['total_service'] = Product::where('type','service')->count();
        $data['total_package'] = Product::where('type','package')->count();
        $data['total_invoice'] = Invoice::count();
        $data['general_expense'] = Expense::sum('amount');
        $data['invoice_income'] = Invoice::sum('grandtotal');
        $data['salary_expense'] = Salary::sum('payable_salary');
        $data['total_booking'] = BookingSystem::count();
        $data['booking_income'] = BookingSystem::sum('total_amount');
        return $data;
    }
}