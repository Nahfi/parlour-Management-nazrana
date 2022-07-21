<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\ReportRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * constructor
     */
    public $user;
    private $reportRepository;
    /**
     * Construct method
     */
    public function __construct(ReportRepository $reportRepository)
    {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
        $this->reportRepository = $reportRepository;
    }
    public function index(){
        if(is_null($this->user) || !$this->user->can('report.index')){
            abort(403,'Unauthorized access');
        }
        $data = $this->reportRepository->index();
        return view('admin.pages.report.index',[
            'data' => $data
        ]);
    }
    /**
     * report filter
     */
    public function filter(Request $request){
        if(is_null($this->user) || !$this->user->can('report.index')){
            abort(403,'Unauthorized access');
        }
        $data = $this->reportRepository->filter($request);
        return view('admin.pages.report.index',[
            'data' => $data
        ]);
    }
}
