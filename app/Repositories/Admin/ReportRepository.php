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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportRepository {
    public function index(){
        $data['total_admin'] =  Admin::whereDate('created_at' ,'>',  Carbon::today()->subDays(7))->count();
        $data['total_employee'] = Employee::whereDate('created_at' ,'>',  Carbon::today()->subDays(7))->count();
        $data['total_customer'] = Customer::whereDate('created_at' ,'>',  Carbon::today()->subDays(7))->count();

        $data['total_service'] = Product::whereDate('created_at' ,'>',  Carbon::today()->subDays(7))->where('type','service')->count();
        $data['total_package'] = Product::whereDate('created_at' ,'>',  Carbon::today()->subDays(7))->where('type','package')->count();
        $data['total_invoice'] = Invoice::whereDate('created_at' ,'>',  Carbon::today()->subDays(7))->count();

        $data['other_expenses'] = Expense::whereDate('created_at' ,'>',  Carbon::today()->subDays(7))->sum('amount');
        $data['salary_expenses'] = Salary::whereDate('created_at','>',Carbon::today()->subDays(7))->sum('payable_salary');

        $data['invoice_income'] = Invoice::whereDate('created_at' ,'>',  Carbon::today()->subDays(7))->sum('grandtotal');
        $data['booking_income'] = BookingSystem::whereDate('created_at' ,'>',  Carbon::today()->subDays(7))->sum('total_amount');
        return $data;
    }
    /**
     * rport filter
     */
    public function filter($request){
        $from = date('Y-m-d', strtotime($request->from));
        $to = date('Y-m-d', strtotime($request->to));

        $data['total_admin'] = Admin::where('created_at' ,'>',  $from)->where('created_at','<',$to)->count();
        $data['total_employee'] = Employee::where('created_at' ,'>',  $from)->where('created_at','<',$to)->count();
        $data['total_customer'] = Customer::where('created_at' ,'>',  $from)->where('created_at','<',$to)->count();

        $data['total_service'] = Product::where('created_at' ,'>',  $from)->where('created_at','<',$to)->count();
        $data['total_package'] = Package::where('created_at' ,'>',  $from)->where('created_at','<',$to)->count();
        $data['total_invoice'] = Invoice::where('created_at' ,'>',  $from)->where('created_at','<',$to)->count();

        $data['other_expenses'] = Expense::where('created_at' ,'>',  $from)->where('created_at','<',$to)->sum('amount');
        $data['salary_expenses'] = Salary::where('date' ,'>',  $from)->where('date','<',$to)->sum('payable_salary');

        $data['invoice_income'] = Invoice::where('created_at' ,'>',  $from)->where('created_at','<',$to)->sum('grandtotal');
        $data['booking_income'] = BookingSystem::where('booking_date' ,'>',  $from)->where('booking_date','<',$to)->sum('total_amount');

        return $data;
    }
}
