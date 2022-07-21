<?php
namespace App\Repositories\Admin;

use App\Models\BookingSystem;

class BookingSystemRepository{
    /**
     * show all booking list
     */
    public function index(){
        return BookingSystem::with(['createdBy','editedBy'])->orderBy('id','desc')->get();
    }

    /**
     * get specific booking
     */
    public function getSpecificItem($id){
        return BookingSystem::with(['createdBy','editedBy'])->where('id',$id)->first();
    }

    /**
     * store a booking into specific storage
     */
    public function store($request){

        $bookingSystem = new BookingSystem();
        $bookingSystem->customer_name = $request->customer_name;
        $bookingSystem->customer_phone = $request->customer_phone;
        $bookingSystem->customer_email = $request->customer_email;
        $bookingSystem->customer_address = $request->customer_address;
        $bookingSystem->booking_type = $request->booking_type;
        $bookingSystem->service_name = $request->service_name;
        $bookingSystem->booking_date = $request->booking_date;
        $bookingSystem->payment_type = $request->payment_type;
        $bookingSystem->total_amount = $request->total_amount;
        $bookingSystem->paid = $request->paid;
        $bookingSystem->due = $request->total_amount - $request->paid;
        $bookingSystem->notes = $request->notes;
        $bookingSystem->status = $request->status;
        $bookingSystem->save();
    }

    /**
     * update a specific booking item
     */
    public function update($request,$id){
        $bookingSystem = $this->getSpecificItem($id);
        $bookingSystem->customer_name = $request->customer_name;
        $bookingSystem->customer_phone = $request->customer_phone;
        $bookingSystem->customer_email = $request->customer_email;
        $bookingSystem->customer_address = $request->customer_address;
        $bookingSystem->booking_type = $request->booking_type;
        $bookingSystem->service_name = $request->service_name;
        if($request->booking_date != ''){
            $bookingSystem->booking_date = $request->booking_date;
        }
        $bookingSystem->payment_type = $request->payment_type;
        $bookingSystem->total_amount = $request->total_amount;
        $bookingSystem->paid = $request->paid;
        $bookingSystem->due = $request->total_amount - $request->paid;
        $bookingSystem->notes = $request->notes;
        $bookingSystem->status = $request->status;
        $bookingSystem->save();
    }

    /**
     * delete booking item
     */
    public function delete($id){
        $bookingSystem = $this->getSpecificItem($id);
        $bookingSystem->delete();
    }
}