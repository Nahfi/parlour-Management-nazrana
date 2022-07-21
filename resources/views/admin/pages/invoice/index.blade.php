@extends('layouts.admin.admin_app')
@section('invoice_active')
    mm-active
@endsection
@section('invoice_show_active')
    active
@endsection
@section('site_title')
 ALL Invoice | Bir Beauty
@endsection
@section('admin_css_link')
<style>

</style>
     <!-- DataTables -->
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- Responsive datatable examples -->
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('admin_js_link')
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
                    <h4 class="mb-sm-0 font-size-18">All Invoice</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">ALL Invoice</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="row  justify-content-center">
                        <div class="col-lg-11 justify-content-center">
                            <div class="card-body justify-content-center">
                                @if (Route::currentRouteName() == 'admin.invoice.index' || Route::currentRouteName() == 'admin.invoice.search')
                                    <form action="{{ route('admin.invoice.search') }}" method="post">
                                        @csrf
                                        <div class="row align-items-center ">
                                            <div class=" col-12  col-lg-8 col-md-12 col-sm-12">
                                                <div class="row">
                                                    <div class="col-12 col-lg-4 col-md-12 col-sm-12">
                                                        <div class="form-group">
                                                            <label for="name"> Payment Type </label>
                                                            <select id="category" name="payment_type" class="form-select" >
                                                                <option value=""> payment type</option>
                                                                <option  value='cash'>
                                                                    Cash
                                                                </option>
                                                                 <option value="bkash">Bkash</option>
                                                                 <option value="nagad">Nagad</option>
                                                                 <option value="rocket">Rocket</option>
                                                                 <option value="bank">Bank</option>
                                                                 <option value="upay">Upay</option>


                                                            </select>
                                                        </div>
                                                   </div>
                                                   <div class="col-12 col-lg-4 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Select year </label>
                                                        <select id="year" name="year" class="form-select">

                                                            <option value="">select year</option>
                                                            <option value="2020" >2020</option>
                                                            <option value="2021">2021</option>
                                                            <option value="2022">2022</option>
                                                            <option value="2023">2023</option>
                                                            <option value="2024">2024</option>
                                                            <option value="2025">2025</option>
                                                            <option value="2026">2026</option>
                                                            <option value="2027">2027</option>
                                                            <option value="2028">2028</option>
                                                            <option value="2029">2029</option>
                                                            <option value="2030">2030</option>
                                                            <option value="2031">2031</option>
                                                        </select>
                                                    </div>
                                                 </div>
                                                 <div class="col-12 col-lg-4 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label for="name">Select Months </label>
                                                        <select name="month" class="form-select @error('month') is-invalid @enderror" id="">
                                                            <option value="">select month</option>
                                                            <option value="01">January</option>
                                                            <option value="02">February</option>
                                                            <option value="03">March</option>
                                                            <option value="04">April</option>
                                                            <option value="05">May</option>
                                                            <option value="06">June</option>
                                                            <option value="07">July</option>
                                                            <option value="08">August</option>
                                                            <option value="09">September</option>
                                                            <option value="10">October</option>
                                                            <option value="11">November</option>
                                                            <option value="12">December</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                </div>
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-4">
                                                <div class="row">
                                                    <div class="col-12 col-lg-10 col-sm-10 col-md-10  mt-4">
                                                        <button  type="submit" class="btn btn-sm btn-primary me-2"> filter <i class=" fas fa-filter
                                                            "></i> </button>
                                                            <a href="{{ route('admin.invoice.index') }}" class="btn btn-sm btn-primary "> <i style="font-size: 15px !important" class="bx bx-reset
                                                                "></i>reset  </a>
                                                    </div>


                                                </div>

                                            </div>

                                        </div>
                                    </form>
                                @endif
                                </div>
                        </div>
                    </div>

                    <form action="{{route('admin.invoice.mark')}}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h5 class="card-title me-4" style="float:left;margin-top:5px">Total Invoice <span class="text-muted fw-normal ms-2">({{$allInvoice->count()}})</span></h5>
                                        @if (Auth::guard('admin')->User()->can('invoice.edit')|| Auth::guard('admin')->User()->can('invoice.delete'))
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Select an Action <i class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu">
                                                        @if (Route::currentRouteName() == 'admin.invoice.index')

                                                            @if (Auth::guard('admin')->User()->can('invoice.delete'))
                                                                <button class="dropdown-item" type="submit" value="Delete" name="type">Delete All</button>
                                                            @endif
                                                        @endif

                                                        @if (Route::currentRouteName() == 'admin.invoice.trash')
                                                            @if (Auth::guard('admin')->User()->can('invoice.delete'))
                                                                <button class="dropdown-item" type="submit" value="Restore" name="type">Restore All</button>
                                                            @endif
                                                            @if (Auth::guard('admin')->User()->can('invoice.parmanentDelete'))
                                                                <button class="dropdown-item" type="submit" value="ParmanentDelete" name="type">Parmanent Delete All</button>
                                                            @endif
                                                        @endif
                                                    </div>
                                            </div><!-- /btn-group -->
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                                        <div id="category_button">
                                            <a href="{{ route('admin.invoice.index') }}" class="btn btn-sm btn-primary mb-2">All</a>

                                            <a href="{{ route('admin.invoice.trash') }}"  class="btn btn-sm mb-2 btn-danger">Trash({{$deletedInvoice}})</a>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="height: calc(100vh - 270px);overflow-y:scroll;overflow-x:hidden;">

                                <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100" style="height: 10px;">
                                    <thead>
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check font-size-16">

                                            </div>
                                        </th>
                                        <th>S\N</th>
                                        <th>Customer name</th>
                                        <th>Subtotal</th>
                                        <th>Discount</th>
                                        <th>Tax</th>
                                        <th>Grand Total</th>
                                        <th>Payment Type</th>
                                        <th>Action </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($allInvoice as $invoice )

                                    <tr>
                                        <th scope="row">
                                            <div class="form-check font-size-16">
                                                <input type="checkbox" name="ids[]" class="form-check-input" value="{{ $invoice->id }}">
                                                <label class="form-check-label"></label>
                                            </div>
                                        </th>
                                        <th>{{$invoice->invoice_id }}</th>
                                        <th>{{ $invoice->customer->name  }}</th>
                                        <th>{{ $invoice->subtotal }}</th>
                                        <th>{{ $invoice->discount  }} {{ $invoice->discountType == '%' ?'%':'tk'}} </th>
                                        <th>{{ $invoice->tax}}%</th>
                                        <th>{{ $invoice->grandtotal  }}</th>
                                        <th>{{ $invoice->payment_type  }}</th>
                                        <th>
                                            @if (Route::currentRouteName() == 'admin.invoice.trash')

                                                @if (Auth::guard('admin')->User()->can('invoice.delete'))
                                                <a href="{{ route('admin.invoice.restore',$invoice->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-trash-restore" ></i></a>
                                                @endif
                                                @if (Auth::guard('admin')->User()->can('invoice.parmanentDelete'))
                                                    <button type="button" value="{{$invoice->id}}"  class="btn btn-sm btn-danger sweet_delete"> <i class="fas fa-trash"></i></button>
                                                @endif
                                            @else

                                                @if (Auth::guard('admin')->User()->can('invoice.editInformation'))
                                                <a target="_blank"  href="{{ route('admin.invoice.edit',$invoice->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-user-edit" ></i></a>
                                                @endif

                                                @if (Auth::guard('admin')->User()->can('invoice.editRatings'))
                                                <a  target="_blank"  href="{{ route('admin.invoice.editRatings',$invoice->id) }}" class="btn btn-sm btn-primary"><i class="far fa-star" ></i></a>
                                                @endif

                                                @if (Auth::guard('admin')->User()->can('invoice.showAll'))
                                                <div class="btn-group">
                                                    <button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"> <i style="font-size:12px !important;" class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu dropdownmenu-success" style="">
                                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.invoice.invoice-show',$invoice->id) }}">Prtint A4 <i  class="ms-1 fas fa-download"></i></a>
                                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.invoice.invoiceShowPos',$invoice->id) }}">Prtint Pos<i  class="ms-1 fas fa-download"></i></a>
                                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.invoice.invoiceShowChalan',$invoice->id) }}">Chalan A4 <i  class="ms-1 fas fa-download"></i></a>
                                                        <a class="btn btn-sm btn-primary" href="{{ route('admin.invoice.invoiceShowPosChalan',$invoice->id) }}">Chalan Pos <i  class="ms-1 fas fa-download"></i></a>

                                                    </div>
                                                </div>
                                                {{-- <a href="{{ route('admin.invoice.invoice-show',$invoice->id) }}"  class="btn btn-sm btn-primary"> <i class=" fas fa-download"></i></a> --}}
                                                @endif

                                                @if (Auth::guard('admin')->User()->can('invoice.delete'))
                                                <a href="{{ route('admin.invoice.destroy',$invoice->id) }}"  class="btn btn-sm btn-danger"> <i class="fas fa-trash-alt"></i></a>
                                                @endif

                                            @endif

                                        </th>
                                    </tr>

                                    @endforeach


                                    </tbody>
                                </table>
                            </div>
                                <!-- end table -->
                            <!-- end table responsive -->
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>

@endsection
@section('admin_js')
<script>

    $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.sweet_delete').click(function(){

                var delete_id = $(this).val();

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
                         url:'/admin/invoice/parmanent-delete/'+delete_id,
                         data: data,
                         success: function (response){
                         Swal.fire(
                               'Deleted!',
                               'Invoice deleted.',
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
@if (Session::has('mark_delete_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Selected invoices Deleted Successfully'
              })
      </script>
@endif
@if (Session::has('delete_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: ' invoices Deleted Successfully'
              })
      </script>
@endif
@if (Session::has('mark_restore_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Selected invoices Restored Successfully'
              })
      </script>
@endif
@if (Session::has('restore_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: ' invoice Restored Successfully'
              })
      </script>
@endif
@if (Session::has('parmanent_delete_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Selected invoices Deleted'
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
