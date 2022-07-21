<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BookingSystem;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Invoice;
use App\Repositories\Admin\HomeRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Nette\Schema\Expect;

class HomeController extends Controller
{
    /**
     * constructor
     */
    public $user;
    private $homeRepository;
    /**
     * Construct method
     */
    public function __construct(HomeRepository $homeRepository)
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
        $this->homeRepository = $homeRepository;
    }
    public function index(){
        $data = $this->homeRepository->index();


        /**
         * calcualte total expense basend on day on this currenr month
         */
        $dailyExpenses = Expense::selectRaw('DATE(created_at) as day,sum(amount) as total_amount')
            ->orderBy('created_at','asc') 
            ->whereMonth('created_at',Carbon::now()->format('m'))
            ->groupBy('day')
            ->get();
            $graphDailyExpenseData = [];
            foreach($dailyExpenses as $row) {
                $graphDailyExpenseData['label'][] = $row->day;
                $graphDailyExpenseData['data'][] = (int) $row->total_amount;
            }
            $graphDailyExpenseData['daily_expense_data'] = json_encode($graphDailyExpenseData);

        /**
         * calculate total expense based on month on this current year
         */
       $expenses = Expense::selectRaw('monthname(created_at) as month,sum(amount) as total_amount')
       ->orderBy('created_at','asc')
       ->whereYear('created_at',Carbon::now()->format('Y'))
        ->groupBy('month')
        ->get();
        $graphExpenseData = [];
        foreach($expenses as $row) {
            $graphExpenseData['label'][] = $row->month;
            $graphExpenseData['data'][] = (int) $row->total_amount;
        }
        $graphExpenseData['expense_data'] = json_encode($graphExpenseData);

        /**
         * count total sales per day
         */
        $sales = Invoice::selectRaw('DATE(created_at) as day,count(id) as total')
        ->orderBy('created_at','asc') 
        ->whereMonth('created_at',Carbon::now()->format('m'))
        ->groupBy('day')
        ->get();
        $graphSalesData = [];
        foreach($sales as $row) {
            $graphSalesData['label'][] = $row->day;
            $graphSalesData['data'][] = (int) $row->total;
        }
        $graphSalesData['sales_data'] = json_encode($graphSalesData);

        /**
         * calcualte total number of sale per month in this current year
         */
        $monthlyServiceSales = Invoice::selectRaw('monthname(created_at) as month,count(id) as total')
        ->orderBy('created_at','asc') 
        ->whereYear('created_at',Carbon::now()->format('Y'))
        ->groupBy('month')
        ->get();
        $graphMonthlyServiceSalesData = [];
        foreach($monthlyServiceSales as $row) {
            $graphMonthlyServiceSalesData['label'][] = $row->month;
            $graphMonthlyServiceSalesData['data'][] = (int) $row->total;
        }
        $graphMonthlyServiceSalesData['monthlyServiceSalesData'] = json_encode($graphMonthlyServiceSalesData);


        /**
         * calcualte total income per day in this current month
         */
        $dailyServiceIncomes = Invoice::selectRaw('DATE(created_at) as day, sum(grandtotal) as total_amount')
        ->orderBy('created_at','asc')
        ->WhereMonth('created_at',Carbon::now()->format('m'))
        ->groupBy('day')
        ->get();
        // dd($dailyServiceIncomes);

        $graphDailyServiceIncomeData = [];
        foreach ($dailyServiceIncomes as $row) {
            $graphDailyServiceIncomeData['label'][] = $row->day;
            $graphDailyServiceIncomeData['data'][] = (int) $row->total_amount;
        }
        $graphDailyServiceIncomeData['daily_service_income_data'] = json_encode($graphDailyServiceIncomeData);


        /**
         * calcualte total income per month in this current year
         */
        $monthlyServiceIncomes = Invoice::selectRaw('monthname(created_at) as month, sum(grandtotal) as total_amount')
        ->orderBy('created_at','asc')
        ->WhereYear('created_at',Carbon::now()->format('Y'))
        ->groupBy('month')
        ->get();
        // dd($dailyServiceIncomes);

        $graphMonthlyServiceIncomeData = [];
        foreach ($monthlyServiceIncomes as $row) {
            $graphMonthlyServiceIncomeData['label'][] = $row->month;
            $graphMonthlyServiceIncomeData['data'][] = (int) $row->total_amount;
        }
        $graphMonthlyServiceIncomeData['monthly_service_income_data'] = json_encode($graphMonthlyServiceIncomeData);

        /**
         * count total number of per day booking in this current month
         */
        $dailyBookings = BookingSystem::selectRaw('DATE(booking_date) as day,count(id) as total')
            ->orderBy('booking_date','asc') 
            ->whereMonth('booking_date',Carbon::now()->format('m'))
            ->groupBy('day')
            ->get();
            $graphDailyBookingData = [];
            foreach($dailyBookings as $row) {
                $graphDailyBookingData['label'][] = $row->day;
                $graphDailyBookingData['data'][] = (int) $row->total;
            }
            $graphDailyBookingData['daily_booking_data'] = json_encode($graphDailyBookingData);

         /**
          * count total number of per month booking in this current year
          */
          $monthlyBookings = BookingSystem::selectRaw('monthname(booking_date) as month,count(id) as total')
            ->orderBy('booking_date','asc') 
            ->whereYear('booking_date',Carbon::now()->format('Y'))
            ->groupBy('month')
            ->get();
            $graphMonthlyBookingData = [];
            foreach($monthlyBookings as $row) {
                $graphMonthlyBookingData['label'][] = $row->month;
                $graphMonthlyBookingData['data'][] = (int) $row->total;
            }
            $graphMonthlyBookingData['monthly_booking_data'] = json_encode($graphMonthlyBookingData);

        return view('admin.pages.home.index',[
            'data' => $data,
            'graphDailyExpenseData' => $graphDailyExpenseData,
            'graphExpenseData' => $graphExpenseData,
            'graphSalesData' => $graphSalesData,
            'graphMonthlyServiceSalesData' => $graphMonthlyServiceSalesData,
            'graphDailyServiceIncomeData' => $graphDailyServiceIncomeData,
            'graphMonthlyServiceIncomeData' => $graphMonthlyServiceIncomeData,
            'graphDailyBookingData' => $graphDailyBookingData,
            'graphMonthlyBookingData' => $graphMonthlyBookingData
        ]);
    }
}