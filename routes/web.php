<?php
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\BookingSystemController;
use App\Http\Controllers\Admin\ConfigSettingsController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\EmployeeAttendanceController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ExpenseCategoryController;
use App\Http\Controllers\Admin\ExpenseController;
use App\Http\Controllers\Admin\GeneralSettingsController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\Admin\InvoiceController;
use App\Http\Controllers\Admin\PacakageController;
use App\Http\Controllers\Admin\ProductBrandController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\RolesController;
use App\Http\Controllers\Admin\SalaryController;
use App\Http\Controllers\Admin\WorkingDayController;
use App\Models\BookingSystem;
use App\Repositories\Admin\PackageRepository;
use App\Http\Controllers\Employee\Auth\EmployeeForgotPasswordController;
use App\Http\Controllers\Employee\Auth\EmployeeLoginController;
use App\Http\Controllers\Employee\Auth\EmployeeResetPasswordController;
use App\Http\Controllers\Employee\EmployeeHomeController;
use  App\Http\Controllers\Employee\EmployeeProfileController;
use App\Http\Controllers\Employee\AttendanceController;
use App\Http\Controllers\Employee\EmployeeSalaryController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {

    if(Auth::guard('admin')->check()){
        return redirect()->route('admin.home');
    }
    elseif(Auth::guard('employee')->check()){
        return redirect()->route('employee.home');
    }
    return view('welcome');

});


Auth::routes(['register' => false,'login'=>false]);

/**
 * admin  route start
 */
    Route::middleware('xssSanitizer')->prefix('admin')->as('admin.')->group(function(){

        /**
         * guest route with admin guard start
         */

        Route::middleware('guest:admin')->group(function(){

            //login controller
            Route::controller(LoginController::class)->group(function(){
                Route::get('/login','showLoginForm')->name('login');
                Route::post('/login/post','login')->name('login.post');
            });

            //forgetpassword controller
            Route::controller(ForgotPasswordController::class)->group(function(){
                Route::get('/reset-password','showLinkRequestForm')->name('resetPassword');
                Route::post('/reset-password/post','sendResetLinkEmail')->name('resetpassword.post');
            });

            //reset password controller
            Route::controller(ResetPasswordController::class)->group(function(){
                Route::get('/update-password/{token}','index')->name('updatePassword');
                Route::post('/update-password','update')->name('updatePassword.post');
            });

        });

        /**
         * guest route with admin guard end
         */


         /**
          * Authenticated with admin guard route start
          */
            Route::middleware(['auth:admin','checkStatus'])->group(function(){
                //logout
                Route::controller(LoginController::class)->group(function(){
                    Route::post('/logout','logout')->name('logout');
                });

                //home route
                Route::controller(HomeController::class)->group(function(){
                    Route::get('/dashboard','index')->name('home');
                });

                //roles route
                Route::controller(RolesController::class)->prefix('roles')->as('roles.')->group(function(){
                    Route::get('/index','index')->name('index');
                    Route::get('/create','create')->name('create');
                    Route::post('/store','store')->name('store');
                    Route::get('/edit/{id}','edit')->name('edit');
                    Route::post('/update/{id}','update')->name('update');
                    Route::get('/destroy/{id}','destroy')->name('destroy');

                });

                //admin route
                Route::controller(AdminController::class)->as('admin.')->group(function(){
                    Route::get('/index','index')->name('index');
                    Route::get('/create','create')->name('create');
                    Route::post('/store','store')->name('store');
                    Route::get('/edit/{id}','edit')->name('edit');
                    Route::post('/update/{id}','update')->name('update');
                    Route::get('/destroy/{id}','destroy')->name('destroy');
                });

                //settings route
                Route::prefix('settings')->as('settings.')->group(function(){
                    Route::controller(GeneralSettingsController::class)->group(function(){
                        Route::get('/general','generalSettings')->name('general');
                        Route::post('/general/post/{id}','generalSettingsUpdate')->name('general.post');
                    });
                    Route::controller(ConfigSettingsController::class)->group(function(){
                        Route::get('/config','configSettings')->name('config');
                        Route::get('/config-optimize-clear','optimizeClear')->name('config.optimize.clear');
                        Route::get('/config-optimize','optimize')->name('config.optimize');
                    });
                });


                //profile route
                Route::controller(ProfileController::class)->prefix('profile')->as('profile.')->group(function(){
                    Route::get('/','index')->name('index');
                    Route::post('/update','update')->name('update');
                    Route::post('/update-password','updatePassword')->name('password.update');
                });

                //expense  route
                Route::prefix('expense')->as('expense.')->group(function(){
                    //expense category route
                    Route::controller(ExpenseCategoryController::class)->prefix('category')->as('category.')->group(function(){
                        Route::get('/index','index')->name('index');
                        Route::get('/create','create')->name('create');
                        Route::post('/store','store')->name('store');
                        Route::get('/edit/{id}','edit')->name('edit');
                        Route::get('/show/{id}','show')->name('show');
                        Route::post('/update/{id}','update')->name('update');
                        Route::post('/search','search')->name('search');
                        Route::get('/destroy/{id}','destroy')->name('destroy');
                        Route::get('/restore/{id}','restore')->name('restore');
                        Route::get('/parmanent-delete/{id}','parmanentDelete')->name('parmanentDelete');
                        Route::get('/active','showActiveCategory')->name('active');
                        Route::get('/deactive','showDeActiveCategory')->name('deactive');
                        Route::get('/trash','showDeletedCategory')->name('trash');
                        Route::post('/mark','mark')->name('mark');
                    });

                    //expense route
                    Route::controller(ExpenseController::class)->group(function(){
                        Route::get('/index','index')->name('index');
                        Route::get('/create','create')->name('create');
                        Route::post('/store','store')->name('store');
                        Route::get('/show/{id}','show')->name('show');
                        Route::post('/search','search')->name('search');
                        Route::get('/edit/{id}','edit')->name('edit');
                        Route::post('/update/{id}','update')->name('update');
                        Route::get('/destroy/{id}','destroy')->name('destroy');
                        Route::get('/restore/{id}','restore')->name('restore');
                        Route::get('/parmanent-delete/{id}','parmanentDelete')->name('parmanentDelete');
                        Route::get('/active','showActiveExpense')->name('active');
                        Route::get('/deactive','showDeActiveExpense')->name('deactive');
                        Route::get('/trash','showDeletedExpense')->name('trash');
                        Route::post('/mark','mark')->name('mark');
                    });

                });

                  //customer route
                  Route::controller(CustomerController::class)->prefix('customer')->as('customer.')->group(function(){
                    Route::get('/index','index')->name('index');
                    Route::get('/create','create')->name('create');
                    Route::post('/store','store')->name('store');
                    Route::get('/show/{id}','show')->name('show');
                    Route::get('/edit/{id}','edit')->name('edit');
                    Route::post('/update/{id}','update')->name('update');
                    Route::get('/destroy/{id}','destroy')->name('destroy');
                    Route::get('/restore/{id}','restore')->name('restore');
                    Route::get('/parmanent-delete/{id}','parmanentDelete')->name('parmanentDelete');
                    Route::get('/active','showActiveCustomer')->name('active');
                    Route::get('/deactive','showDeActiveCustomer')->name('deactive');
                    Route::get('/trash','showDeletedCustomer')->name('trash');
                    Route::post('/mark','mark')->name('mark');
                });

                //employee route
                Route::controller(EmployeeController::class)->prefix('employee')->as('employee.')->group(function(){
                    Route::get('/index','index')->name('index');
                    Route::get('/create','create')->name('create');
                    Route::post('/store','store')->name('store');
                    Route::get('/show/{id}','show')->name('show');
                    Route::get('/edit/{id}','edit')->name('edit');
                    Route::post('/update/{id}','update')->name('update');
                    Route::get('/destroy/{id}','destroy')->name('destroy');
                    Route::post('/advanced-payment/{id}','advancedPayment')->name('advancedPayment');
                    Route::get('/restore/{id}','restore')->name('restore');
                    Route::get('/parmanent-delete/{id}','parmanentDelete')->name('parmanentDelete');
                    Route::get('/active','showActiveEmployee')->name('active');
                    Route::get('/deactive','showDeActiveEmployee')->name('deactive');
                    Route::get('/trash','showDeletedEmployee')->name('trash');
                    Route::post('/mark','mark')->name('mark');
                });

                //attendacne route
                Route::controller(EmployeeAttendanceController::class)->prefix('attendance')->as('attendance.')->group(function(){
                    Route::get('/list','index')->name('index');
                    Route::post('status-update/{id}','statusUpdate')->name('statusUpdate');
                });

                //working day route
                Route::controller(WorkingDayController::class)->prefix('working-day')->as('workingDay.')->group(function(){
                    Route::get('/index','index')->name('index');
                    Route::get('/create','create')->name('create');
                    Route::post('/store','store')->name('store');
                    Route::get('/edit/{id}','edit')->name('edit');
                    Route::post('/update/{id}','update')->name('update');
                    Route::get('/destroy/{id}','destroy')->name('destroy');
                });

            //salary route
            Route::controller(SalaryController::class)->prefix('salary')->as('salary.')->group(function(){
                Route::get('/view','index')->name('index');
                Route::get('/calculate-salary','calculateSalary')->name('calculateSalary');
                Route::get('/show/{id}','showSalary')->name('showSalary');
                Route::post('/update/{id}','update')->name('update');
                Route::get('/pay-slip/{id}','show')->name('show');
            });
                 //product route
                Route::prefix('product')->as('product.')->group(function(){
                    //product brand route
                    Route::controller(ProductBrandController::class)->prefix('brand')->as('brand.')->group(function(){
                        Route::get('/index','index')->name('index');
                        Route::get('/create','create')->name('create');
                        Route::post('/store','store')->name('store');
                        Route::get('/edit/{id}','edit')->name('edit');
                        Route::post('/update/{id}','update')->name('update');
                        Route::get('/destroy/{id}','destroy')->name('destroy');
                        Route::get('/restore/{id}','restore')->name('restore');
                        Route::get('/parmanent-delete/{id}','parmanentDelete')->name('parmanentDelete');
                        Route::get('/active','showActiveBrand')->name('active');
                        Route::get('/deactive','showDeActiveBrand')->name('deactive');
                        Route::get('/trash','showDeletedBrand')->name('trash');
                        Route::post('/mark','mark')->name('mark');
                    });

                    //product category controller
                    Route::controller(ProductCategoryController::class)->prefix('category')->as('category.')->group(function(){
                        Route::get('/index','index')->name('index');
                        Route::get('/create','create')->name('create');
                        Route::post('/store','store')->name('store');
                        Route::get('/edit/{id}','edit')->name('edit');
                        Route::post('/update/{id}','update')->name('update');
                        Route::get('/destroy/{id}','destroy')->name('destroy');
                        Route::get('/restore/{id}','restore')->name('restore');
                        Route::get('/parmanent-delete/{id}','parmanentDelete')->name('parmanentDelete');
                        Route::get('/active','showActiveCategory')->name('active');
                        Route::get('/deactive','showDeActiveCategory')->name('deactive');
                        Route::get('/trash','showDeletedCategory')->name('trash');
                        Route::post('/mark','mark')->name('mark');
                    });

                    //products route
                    Route::controller(ProductController::class)->group(function(){
                        Route::get('/index','index')->name('index');
                        Route::get('/create','create')->name('create');
                        Route::post('/store','store')->name('store');
                        Route::get('/show/{id}','show')->name('show');
                        Route::post('/search','search')->name('search');
                        Route::get('/edit/{id}','edit')->name('edit');
                        Route::post('/update/{id}','update')->name('update');
                        Route::get('/destroy/{id}','destroy')->name('destroy');
                        Route::get('/restore/{id}','restore')->name('restore');
                        Route::get('/parmanent-delete/{id}','parmanentDelete')->name('parmanentDelete');
                        Route::get('/active','showActiveProduct')->name('active');
                        Route::get('/deactive','showDeActiveProduct')->name('deactive');
                        Route::get('/trash','showDeletedProduct')->name('trash');
                        Route::post('/mark','mark')->name('mark');
                    });
                });
                Route::controller(PacakageController::class)->prefix('package')->as('package.')->group(function(){
                    Route::get('/index','index')->name('index');
                    Route::get('/create','create')->name('create');
                    Route::post('/store','store')->name('store');
                    Route::post('/search','search')->name('search');
                    Route::get('/show/{id}','show')->name('show');
                    Route::get('/edit/{id}','edit')->name('edit');
                    Route::post('/update/{id}','update')->name('update');
                    Route::get('/destroy/{id}','destroy')->name('destroy');
                    Route::get('/restore/{id}','restore')->name('restore');
                    Route::get('/parmanent-delete/{id}','parmanentDelete')->name('parmanentDelete');
                    Route::get('/active','showActivePackage')->name('active');
                    Route::get('/deactive','showDeActivePackage')->name('deactive');
                    Route::get('/trash','showDeletedPackage')->name('trash');
                    Route::post('/mark','mark')->name('mark');
                });

                //invoice route
                Route::controller(InvoiceController::class)->prefix('invoice')->as('invoice.')->group(function(){
                    Route::get('/create','create')->name('create');
                    Route::get('/index','index')->name('index');
                    Route::post('/store','store')->name('store');
                    Route::post('/search','search')->name('search');
                    Route::get('/invoice-show/{id}','show')->name('invoice-show');
                    Route::get('/invoice-show-pos/{id}','showPos')->name('invoiceShowPos');
                    Route::get('/invoice-show-chalan/{id}','showChalan')->name('invoiceShowChalan');
                    Route::get('/invoice-show-pos-chalan/{id}','showPosChalan')->name('invoiceShowPosChalan');
                    Route::get('/edit/{id}','edit')->name('edit');
                    Route::get('/edit-ratings/{id}','editRatings')->name('editRatings');
                    Route::post('/update/{id}','update')->name('update');
                    Route::post('/update-comment/{id}','updateComment')->name('updateComment');
                    Route::get('/delete/{id}','delete')->name('delete');
                    Route::get('/destroy/{id}','destroy')->name('destroy');
                    Route::get('/restore/{id}','restore')->name('restore');
                    Route::get('/parmanent-delete/{id}','parmanentDelete')->name('parmanentDelete');
                    Route::get('/trash','showDeletedInvoice')->name('trash');
                    Route::post('/mark','mark')->name('mark');
                    Route::post('/storeInSession','storeInSession')->name('storeInSession');
                    Route::get('/loadSessionData','loadSessionData')->name('loadSessionData');
                    Route::get('/find-Specific-Product/{id}','findSingleProduct')->name('findProduct');
                    Route::get('/find-Specific-Customer/{id}','findSingleCustomer')->name('findCustomer');

                });

                //report controller
                Route::controller(ReportController::class)->prefix('report')->as('report.')->group(function(){
                    Route::get('/index','index')->name('index');
                    Route::post('/filter','filter')->name('filter');
                });

                //booking system route
                Route::controller(BookingSystemController::class)->prefix('booking-system')->as('bookingSystem.')->group(function(){
                    Route::get('/index','index')->name('index');
                    Route::get('/create','create')->name('create');
                    Route::post('/store','store')->name('store');
                    Route::get('/edit/{id}','edit')->name('edit');
                    Route::post('/update/{id}','update')->name('update');
                    Route::get('/show/{id}','show')->name('show');
                    Route::get('/destroy/{id}','destroy')->name('destroy');
                });

            });

          /**
           * Authenticated with admin guard route end
           */

    });

/**
 * admin  route end
*/


/**
 * Emplopyee route start
 */
Route::prefix('employee')->as('employee.')->group(function(){

    /**
     * guest route with employee guard start
     */

    Route::middleware('guest:employee')->group(function(){

        //login controller
        Route::controller(EmployeeLoginController::class)->group(function(){
            Route::get('/login','showLoginForm')->name('login');
            Route::post('/login/post','login')->name('login.post');
        });

        //forgetpassword controller
        Route::controller(EmployeeForgotPasswordController::class)->group(function(){
            Route::get('/reset-password','showLinkRequestForm')->name('resetPassword');
            Route::post('/reset-password/post','sendResetLinkEmail')->name('resetpassword.post');
        });
        //reset password controller
        Route::controller(EmployeeResetPasswordController::class)->group(function(){
            Route::get('/update-password/{token}','index')->name('updatePassword');
            Route::post('/update-password','update')->name('updatePassword.post');
        });

    });

    /**
     * guest route with employee guard end
     */


     /**
      * Authenticated with employee guard route start
      */
        Route::middleware(['auth:employee','checkStatus'])->group(function(){

            //logout
            Route::controller(EmployeeLoginController::class)->group(function(){
                Route::post('/logout','logout')->name('logout');
            });

            //home route
            Route::controller(EmployeeHomeController::class)->group(function(){
                Route::get('/dashboard','index')->name('home');
            });

            //profile route
            Route::controller(EmployeeProfileController::class)->prefix('profile')->as('profile.')->group(function(){
                Route::get('/','index')->name('index');
                Route::post('/update','update')->name('update');
                Route::post('/update-password','updatePassword')->name('password.update');

            });



            // attendance route
            Route::controller(AttendanceController::class)->prefix('attendance')->as('attendance.')->group(function(){
                Route::get('/attendance-list','index')->name('index');
                Route::get('/give-attendance','sendRequest')->name('sendRequest');
            });

            //salary route
            Route::controller(EmployeeSalaryController::class)->prefix('salary')->name('salary.')->group(function(){
                Route::get('/index','index')->name('index');
                Route::get('/pay-slip/{id}','show')->name('show');
            });

        });
      /**
       * Authenticated with employee guard route end
       */

});












Route::fallback(function () {
    return redirect('admin/login');
});