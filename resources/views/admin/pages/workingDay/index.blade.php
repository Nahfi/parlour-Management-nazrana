@extends('layouts.admin.admin_app')
@section('working_day_active')
    mm-active
@endsection
@section('site_title')
    All Working Day List | Bir Beauty
@endsection
@section('admin_css_link')
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
                    <h4 class="mb-sm-0 font-size-18">Working Days</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Working Days</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form action="{{ route('admin.workingDay.store') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h5 class="card-title me-4" style="float:left;margin-top:5px">Total Working day list <span class="text-muted fw-normal ms-2">({{ $workingDays->count() }})</span></h5>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex flex-wrap align-items-center justify-content-end gap-2 mb-3">
                                        <div id="category_button">
                                            <a href="{{ route('admin.workingDay.index') }}" class="btn btn-sm btn-primary mb-2">All</a>
                                            @if (Auth::guard('admin')->User()->can('workingDay.create'))
                                     <a href="{{ route('admin.workingDay.create') }}" class="btn btn-primary mb-2 btn-sm"><i class="bx bx-plus me-1"></i> Add New</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div style="height: calc(100vh - 270px);overflow-y:scroll;overflow-x:hidden;">
                                <table id="datatable-buttons" class="table table-bordered dt-responsive  nowrap w-100" style="height: 10px;">
                                    <thead>
                                    <tr>
                                        <th>S\N</th>
                                        <th>Year</th>
                                        <th>Month</th>
                                        <th>Total Day</th>
                                        <th>Created By</th>
                                        <th>Edited By</th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($workingDays as $workingDay)
                                            <tr>
                                                <input class="working_day_val_id" type="hidden" name="id" value="{{ $workingDay->id }}">
                                                <th>{{ $loop->iteration }}</th>
                                                <th>{{ $workingDay->year }}</th>
                                                <th>
                                                    @if ($workingDay->month == '1')
                                                        {{ 'January' }}
                                                    @elseif ($workingDay->month == '2')
                                                        {{ 'February' }}
                                                    @elseif ($workingDay->month == '3')
                                                        {{ 'March' }}
                                                    @elseif ($workingDay->month == '4')
                                                        {{ 'April' }}
                                                    @elseif ($workingDay->month == '5')
                                                        {{ 'May' }}
                                                    @elseif ($workingDay->month == '6')
                                                        {{ 'June' }}
                                                    @elseif ($workingDay->month == '7')
                                                        {{ 'July' }}
                                                    @elseif ($workingDay->month == '8')
                                                        {{ 'August' }}
                                                    @elseif ($workingDay->month == '9')
                                                        {{ 'September' }}
                                                    @elseif ($workingDay->month == '10')
                                                        {{ 'October' }}
                                                    @elseif ($workingDay->month == '11')
                                                        {{ 'November' }}
                                                    @elseif ($workingDay->month == '12')
                                                        {{ 'December' }}
                                                    @endif
                                                </th>
                                                <td>
                                                    {{ $workingDay->total_day }}
                                                </td>

                                                <td>{{ $workingDay->createdBy->name }}</td>
                                                <td>
                                                    @if ($workingDay->edited_by != '')
                                                        {{ $workingDay->editedBy->name }}
                                                    @endif
                                                </td>
                                                <td>
                                                    @if (Auth::guard('admin')->User()->can('employee.edit'))
                                                        <a href="{{ route('admin.workingDay.edit',$workingDay->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-user-edit" ></i></a>
                                                    @endif
                                                    @if (Auth::guard('admin')->User()->can('employee.delete'))
                                                        <button type="button"  class="btn btn-sm btn-danger sweet_delete"> <i class="fas fa-trash-alt"></i></button>
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
                    </form>

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
                 var delete_id = $(this).closest("tr").find('.working_day_val_id').val();
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
                          url:'/admin/working-day/destroy/'+delete_id,
                          data: data,
                          success: function (response){
                          Swal.fire(
                                'Deleted!',
                                'WorkingDay deleted.',
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
    @if (Session::has('woking_day_delete_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: "{{ Session::get('woking_day_delete_success') }}"
              })
      </script>
    @endif
@endsection
@endsection
