<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BookingSystemStoreRequest;
use App\Http\Requests\BookingSystemUpdateRequest;
use App\Repositories\Admin\BookingSystemRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingSystemController extends Controller
{
  public $bookingSystemRepository,$user;
   public function __construct(BookingSystemRepository $bookingSystemRepository)
   {
        $this->middleware(function($request,$next){
            $this->user = Auth::guard('admin')->User();
            return $next($request);
        });
       $this->bookingSystemRepository = $bookingSystemRepository;
   }

   /***
    * show all list
    */
    public function index(){
        if(is_null($this->user) || !$this->user->can('booking.index')){
            abort(403,'Unauthorized access');
        }
        $bookinsSystems = $this->bookingSystemRepository->index();
        return view('admin.pages.booking_system.index',[
            'bookingSystems' => $bookinsSystems
        ]);
    }

    /**
     * show a form fore creatieng new item
     */
    public function create(){
        if(is_null($this->user) || !$this->user->can('booking.create')){
            abort(403,'Unauthorized access');
        }
        return view('admin.pages.booking_system.create');
    }

    /**
     * store a new item in specific storage
     */
    public function store(BookingSystemStoreRequest $request){
        if(is_null($this->user) || !$this->user->can('booking.create')){
            abort(403,'Unauthorized access');
        }
        $this->bookingSystemRepository->store($request);
        return back()->with('booking_added','Booked Successfully');
    }

    /**
     * show a form for editing a specific item
     */
    public function edit($id){
        if(is_null($this->user) || !$this->user->can('booking.edit')){
            abort(403,'Unauthorized access');
        }
        $bookingSystem = $this->bookingSystemRepository->getSpecificItem($id);
        return view('admin.pages.booking_system.edit',[
            'bookingSystem' => $bookingSystem
        ]);
    }
    /**
     * update  a specific item
     */
    public function update(BookingSystemUpdateRequest $request, $id){
        if(is_null($this->user) || !$this->user->can('booking.edit')){
            abort(403,'Unauthorized access');
        }
        $this->bookingSystemRepository->update($request,$id);
        return back()->with('booking_information_updated','Booking Information Updated successfully');
    }

    /**
     * show a specific booking item
     */
    public function show($id){
        $bookingSystem = $this->bookingSystemRepository->getSpecificItem($id);
        return view('admin.pages.booking_system.show',[
            'bookingSystem' => $bookingSystem
        ]);
    }

    /**
     * destroy a item
     */
    public function destroy($id){
        if(is_null($this->user) || !$this->user->can('booking.delete')){
            abort(403,'Unauthorized access');
        }
        $this->bookingSystemRepository->delete($id);
        return back()->with('booking_information_deleted','Booking Information Delted successfully');
    }
}
