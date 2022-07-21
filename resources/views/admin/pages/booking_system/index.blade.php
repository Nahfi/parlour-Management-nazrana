@extends('layouts.admin.admin_app')
@section('booking_active')
    mm-active
@endsection
@section('site_title')
   Booking List | Bir Beauty
@endsection
@section('admin_css_link')
<!-- choices css -->
<link href="{{ asset('admin_assets')}}/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
     <!-- DataTables -->
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- Responsive datatable examples -->
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('admin_js_link')
<!-- choices js -->
<script src="{{ asset('admin_assets') }}/libs/choices.js/public/assets/scripts/choices.min.js"></script>
<!-- init js -->
<script src="{{ asset('admin_assets') }}/js/pages/form-advanced.init.js"></script>
    <!-- Required datatable js -->
 <script src="{{ asset('admin_assets') }}/libs/datatables.net/js/jquery.dataTables.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
 <!-- Buttons examples -->
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/jszip/jszip.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/pdfmake/build/pdfmake.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/pdfmake/build/vfs_fonts.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>
 <!-- Responsive examples -->
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
 <script src="{{ asset('admin_assets') }}/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
 <!-- Datatable init js -->
 <script src="{{ asset('admin_assets') }}/js/pages/datatables.init.js"></script>
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
                            <li class="breadcrumb-item active">Booking System</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h5 class="card-title me-4" style="float:left;margin-top:5px">Total Booking <span class="text-muted fw-normal ms-2">({{ $bookingSystems->count() }})</span></h5>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                                        <div id="category_button">
                                            <a href="{{ route('admin.bookingSystem.create') }}" class="btn btn-primary mb-2 btn-sm"><i class="bx bx-plus me-1"></i> Add New</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="height: calc(100vh - 270px);overflow-y:scroll;overflow-x:hidden;">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100" style="height: 10px;">
                                    <thead>
                                    <tr>
                                        <th>S\N</th>
                                        <th>Booking Type</th>
                                        <th>Service Name</th>
                                        <th>Booking Date</th>
                                        <th>Total Amount</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($bookingSystems as $bookingSystem)
                                            <tr>
                                                <input class="booking_val_id" type="hidden" name="id" value="{{ $bookingSystem->id }}">
                                                <th>{{ $loop->iteration }}</th>
                                                <th>{{ $bookingSystem->booking_type }}</th>
                                                <td>{{ $bookingSystem->service_name }}</td>
                                                <td>{{ date('d-M-Y', strtotime($bookingSystem->booking_date)) }}</td>
                                                <td>{{ $bookingSystem->total_amount }}</td>
                                                <td>{{ $bookingSystem->paid }}</td>
                                                <td>{{ $bookingSystem->due }}</td>
                                                <td><span class="badge {{ $bookingSystem->status == 'Pending' ? 'bg-info':'bg-success' }} font-size-12">{{ $bookingSystem->status }}</span></td>
                                                <td>
                                                    @if (Auth::guard('admin')->User()->can('booking.edit'))
                                                        <a href="{{ route('admin.bookingSystem.edit',$bookingSystem->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-user-edit" ></i></a>
                                                    @endif
                                                    @if (Auth::guard('admin')->User()->can('booking.index'))
                                                        <a href="{{ route('admin.bookingSystem.show',$bookingSystem->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                                    @endif
                                                    @if (Auth::guard('admin')->User()->can('booking.delete'))
                                                        <a href="javascript:void(0)"  class="btn btn-sm btn-danger sweet_delete"> <i class="fas fa-trash-alt"></i></a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                                <!-- end table -->
                            <!-- end table responsive -->
                        </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>
@section('admin_js')
    <script>
        $(document).ready(function() {
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });
             $('.sweet_delete').click(function(){
                 var delete_id = $(this).closest("tr").find('.booking_val_id').val();
                 Swal.fire({
                   title: 'Are you sure?',
                   text: "You won't be able to revert this!",
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Yes, delete it!'
                 }).then((result) => {
                   if (result.isConfirmed) {
                       var data = {
                           "_token": $('input[name=_token]').val(),
                           "id": delete_id,
                       };
                       $.ajax({
                          type:"GET",
                          url:'/admin/booking-system/destroy/'+delete_id,
                          data: data,
                          success: function (response){
                          Swal.fire(
                                'Deleted!',
                                'Booking Information deleted.',
                                'success'
                              )
                              .then((result) =>{
                                 location.reload();
                              });
                          }
                       });
                   }
                 })
             });
         } );
     </script>
    @if (Session::has('expense_restore_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Expense Restore Successfully'
              })
      </script>
    @endif
    @if (Session::has('mark_active_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Selected Expenses Activate Successfully'
              })
      </script>
    @endif
    @if (Session::has('mark_deactive_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Selected Expenses DeActivate Successfully'
              })
      </script>
    @endif
    @if (Session::has('mark_delete_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Selected Expenses Deleted Successfully'
              })
      </script>
    @endif
    @if (Session::has('mark_restore_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Selected Expenses Restore Successfully'
              })
      </script>
    @endif
    @if (Session::has('parmanent_delete_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Expense Parmanently deleted'
              })
      </script>
    @endif
    @if (Session::has('mark_parmanent_delete_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'selected Expenses Parmanently deleted'
              })
      </script>
    @endif
    @if (Session::has('search_failed'))
    <script>
            Toast.fire({
                icon: 'error',
                title: '{{ Session::get('search_failed') }}'
            })
    </script>
  @endif
@endsection
@endsection
