@extends('layouts.admin.admin_app')
@section('booking_active')
    mm-active
@endsection
@section('site_title')
   Edit Booking | Bir Beauty
@endsection
@section('admin_content')
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Booking System</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.bookingSystem.index') }}">All Booking List</a></li>
                            <li class="breadcrumb-item active">Update Booking</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('admin.bookingSystem.update',$bookingSystem->id) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Customer Name <span class="text-danger">*</span> </label>
                                        <input type="text" class="form-control @error('customer_name') is-invalid @enderror" name="customer_name" value="{{ $bookingSystem->customer_name }}">
                                        @error('customer_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Customer Phone </label>
                                        <input type="number" class="form-control @error('customer_phone') is-invalid @enderror" name="customer_phone" value="{{ $bookingSystem->customer_phone }}">
                                        @error('customer_phone')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Customer Email </label>
                                        <input type="email" class="form-control @error('customer_email') is-invalid @enderror" name="customer_email" value="{{ $bookingSystem->customer_email }}">
                                        @error('customer_email')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Customer Address </label>
                                        <input type="text" class="form-control @error('customer_address') is-invalid @enderror" name="customer_address" value="{{ $bookingSystem->customer_address }}">
                                        @error('customer_address')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Booking Type<span class="text-danger">*</span> </label>
                                        <select name="booking_type" class="form-select @error('booking_type') is-invalid @enderror" name="booking_type">
                                            <option value="">select booking type</option>
                                            <option value="Staff" {{ ($bookingSystem->booking_type == 'Staff' ? 'selected':'') }}>Staff</option>
                                            <option value="Owner" {{ ($bookingSystem->booking_type == 'Owner' ? 'selected':'') }}>Owner</option>
                                        </select>
                                        @error('booking_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Service Name<span class="text-danger">*</span> </label>
                                        <textarea name="service_name" class="form-control @error('service_name') is-invalid @enderror"  cols="30" rows="2">{{ $bookingSystem->service_name }}</textarea>
                                        @error('service_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Booking Date({{  date('d-M-Y H:i:s', strtotime($bookingSystem->booking_date))  }})  </label>
                                        <input type="datetime-local" class="form-control @error('booking_date') is-invalid @enderror" name="booking_date">
                                        @error('booking_date')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Payment Type<span class="text-danger">*</span> </label>
                                        <select name="payment_type" class="form-select @error('payment_type') is-invalid @enderror" name="payment_type">
                                            <option value="">select payment type</option>
                                            <option value="Cash" {{ ($bookingSystem->payment_type == 'Cash' ? 'selected':'') }}>Cash</option>
                                            <option value="Bkash" {{ ($bookingSystem->payment_type == 'Bkash' ? 'selected':'') }}>Bkash</option>
                                            <option value="Rocket" {{ ($bookingSystem->payment_type == 'Rocket' ? 'selected':'') }}>Rocket</option>
                                            <option value="Nagad" {{ ($bookingSystem->payment_type == 'Nagad' ? 'selected':'') }}>Nagad</option>
                                            <option value="Bank" {{ ($bookingSystem->payment_type == 'Bank' ? 'selected':'') }}>Bank</option>
                                        </select>
                                        @error('payment_type')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Total Amount<span class="text-danger">*</span> </label>
                                        <input id="total_amount" onchange="calculateDue()" type="number" class="form-control @error('total_amount') is-invalid @enderror" name="total_amount" value="{{ $bookingSystem->total_amount }}">
                                        @error('total_amount')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Paid<span class="text-danger">*</span> </label>
                                        <input id="paid" onchange="calculateDue()" type="number" class="form-control @error('paid') is-invalid @enderror" name="paid" value="{{ $bookingSystem->paid }}">
                                        @error('paid')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Due<span class="text-danger">*</span> </label>
                                        <input id="due" readonly  type="number" class="form-control @error('due') is-invalid @enderror" name="due" value="{{ $bookingSystem->due }}">
                                        @error('due')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Status<span class="text-danger">*</span> </label>
                                        <select name="status" class="form-select @error('status') is-invalid @enderror" name="status">
                                            <option value="">select status</option>
                                            <option value="Pending" {{ ($bookingSystem->status == 'Pending' ? 'selected':'') }}>Pending</option>
                                            <option value="Completed" {{ ($bookingSystem->status == 'Completed' ? 'selected':'') }}>Completed</option>
                                        </select>
                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 mb-2">
                                    <div class="form-group">
                                        <label>Notes</label>
                                        <textarea name="notes" class="form-control @error('notes') is-invalid @enderror"  cols="30" rows="3">{{ $bookingSystem->notes }}</textarea>
                                        @error('notes')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>


                            </div>
                            <button type="submit" class="btn btn-sm btn-primary">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div> <!-- container-fluid -->
</div>
@section('admin_js')

    <script>
        function calculateDue(){
            var total = document.getElementById("total_amount").value;
            var paid = document.getElementById("paid").value;
            document.getElementById("due").value = total - paid;
        }
    </script>

    @if (Session::has('booking_information_updated'))
        <script>
                Toast.fire({
                    icon: 'success',
                    title: 'Booking Updated!!!'
                })
        </script>
    @endif
@endsection
@endsection
