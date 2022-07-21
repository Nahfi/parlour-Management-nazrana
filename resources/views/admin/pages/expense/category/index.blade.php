@extends('layouts.admin.admin_app')
@section('expense_active')
    mm-active
@endsection
@section('expense_category_active')
    active
@endsection
@section('site_title')
    All Expense Category | Bir Beauty
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
                    <h4 class="mb-sm-0 font-size-18">Expense Category</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">ExpenseCategory</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="row  justify-content-center">
                        <div class="col-lg-10 justify-content-center">
                            <div class="card-body justify-content-center">
                                @if (Route::currentRouteName() == 'admin.expense.category.index' || Route::currentRouteName() == 'admin.expense.category.search')
                                    <form action="{{ route('admin.expense.category.search') }}" method="post">
                                        @csrf
                                        <div class="row align-items-center ">
                                            <div class="col-12 col-lg-7">
                                                <div class="row">
                                                    <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-2">
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
                                                <div class="col-12 col-lg-6 col-md-6 col-sm-12 mb-2">
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
                                            <div class="col-10 col-lg-5  col-sm-5 col-md-5">
                                                <div class="row ">
                                                    <div class="col-12 col-lg-8 col-md-10 col-sm-10 mt-4 ">
                                                        <button type="submit" class="btn btn-sm btn-primary me-2"> filter <i class=" fas fa-filter
                                                            "></i> </button>
                                                            <a href="{{ route('admin.expense.category.index') }}" class="btn btn-sm btn-primary "> <i style="font-size: 15px !important" class="bx bx-reset
                                                                "></i> Reset</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                                </div>
                        </div>
                    </div>
                    <form action="{{ route('admin.expense.category.mark') }}" method="post">
                        @csrf
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <h5 class="card-title me-4" style="float:left;margin-top:5px">Total Category <span class="text-muted fw-normal ms-2">({{ $data['categories']->count() }})</span></h5>
                                        @if (Auth::guard('admin')->User()->can('expense.category.edit')|| Auth::guard('admin')->User()->can('expense.category.delete')|| Auth::guard('admin')->User()->can('expense.category.parmanentDelete'))
                                            <div class="btn-group">
                                                <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Select an Action <i class="mdi mdi-chevron-down"></i></button>
                                                    <div class="dropdown-menu">
                                                        @if (Route::currentRouteName() != 'admin.expense.category.trash')
                                                            @if (Auth::guard('admin')->User()->can('expense.category.edit'))
                                                                @if (Route::currentRouteName() != 'admin.expense.category.active')
                                                                    <button class="dropdown-item" type="submit" value="Active" name="type">Active All</button>
                                                                @endif
                                                                @if (Route::currentRouteName() != 'admin.expense.category.deactive')
                                                                    <button class="dropdown-item" type="submit" value="DeActive" name="type">DeActive All</button>
                                                                @endif
                                                            @endif
                                                            @if (Auth::guard('admin')->User()->can('expense.category.delete'))
                                                                <button class="dropdown-item" type="submit" value="Delete" name="type">Delete All</button>
                                                            @endif
                                                        @endif
                                                        @if (Route::currentRouteName() == 'admin.expense.category.trash')
                                                            @if (Auth::guard('admin')->User()->can('expense.category.delete'))
                                                                <button class="dropdown-item" type="submit" value="Restore" name="type">Restore All</button>
                                                            @endif
                                                            @if (Auth::guard('admin')->User()->can('expense.category.parmanentDelete'))
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
                                            <a href="{{ route('admin.expense.category.index') }}" class="btn btn-sm btn-primary mb-2">All</a>

                                            <a href="{{ route('admin.expense.category.active') }}"  class="btn btn-sm mb-2 btn-primary">Active({{ $data['total_active_category'] }})</a>
                                            <a href="{{ route('admin.expense.category.deactive') }}"  class="btn btn-sm mb-2 btn-primary">DeActive({{ $data['total_deactive_category'] }})</a>

                                            <a href="{{ route('admin.expense.category.trash',) }}"  class="btn btn-sm mb-2 btn-danger">Trash({{ $data['total_deleted_category'] }})</a>
                                            @if (Auth::guard('admin')->User()->can('expense.category.store'))
                                                <a href="{{ route('admin.expense.category.create') }}" class="btn btn-primary mb-2 btn-sm"><i class="bx bx-plus me-1"></i> Add New</a>
                                            @endif

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
                                        <th>Name</th>
                                        <th>Total Expenses Amount </th>
                                        <th>Actions</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data['categories'] as $category)
                                            <tr>
                                                <input class="category_val_id" type="hidden" name="id" value="{{ $category->id }}">
                                                <th scope="row">
                                                    <div class="form-check font-size-16">
                                                        <input type="checkbox" name="ids[]" class="form-check-input" value="{{ $category->id }}">
                                                        <label class="form-check-label"></label>
                                                    </div>
                                                </th>
                                                <th>{{ $loop->iteration }}</th>
                                                <td>
                                                    {{ $category->name  }} [{{ ($category->expense->count()) }}]
                                                </td>

                                                <td>
                                                    @if ($category->expense->count() !=0)
                                                      @php
                                                            $sum = 0;
                                                            foreach($category->expense as $categoryData){
                                                                $sum  = $sum+$categoryData->amount;
                                                            }
                                                      @endphp
                                                      {{ $sum }} &#2547;

                                                    @else
                                                         0 &#2547;
                                                    @endif

                                                </td>

                                                <td>
                                                    @if (Route::currentRouteName() == 'admin.expense.category.index' || Route::currentRouteName() == 'admin.expense.category.active' || Route::currentRouteName() == 'admin.expense.category.deactive' ||Route::currentRouteName() == 'admin.expense.category.search'  )
                                                        @if (Auth::guard('admin')->User()->can('expense.category.edit'))
                                                            <a href="{{ route('admin.expense.category.edit',$category->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-user-edit" ></i></a>
                                                        @endif
                                                        @if (Auth::guard('admin')->User()->can('expense.category.index'))
                                                            <a href="{{ route('admin.expense.category.show',$category->id) }}" class="btn btn-sm btn-primary"><i class=" fas fa-eye
                                                                " ></i></a>
                                                        @endif
                                                        @if (Auth::guard('admin')->User()->can('expense.category.delete'))
                                                            <a href="{{ route('admin.expense.category.destroy',$category->id) }}" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                                        @endif
                                                    @endif

                                                    @if(Route::currentRouteName() == 'admin.expense.category.trash')
                                                        @if (Auth::guard('admin')->User()->can('expense.category.delete'))
                                                            <a href="{{ route('admin.expense.category.restore',$category->id) }}" class="btn btn-sm btn-primary"><i class="fas fa-trash-restore" ></i></a>
                                                        @endif

                                                        @if (Auth::guard('admin')->User()->can('expense.category.parmanentDelete'))
                                                            <button type="button" class="btn btn-sm btn-danger sweet_delete"><i class="fas fa-trash"></i></button>
                                                        @endif
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
                 var delete_id = $(this).closest("tr").find('.category_val_id').val();
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
                          url:'/admin/expense/category/parmanent-delete/'+delete_id,
                          data: data,
                          success: function (response){
                          Swal.fire(
                                'Deleted!',
                                'Expense Category deleted.',
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
    @if (Session::has('category_restore_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Catogory Restore Successfully'
              })
      </script>
    @endif
    @if (Session::has('mark_active_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Selected Category Activate Successfully'
              })
      </script>
    @endif
    @if (Session::has('mark_deactive_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Selected Category DeActivate Successfully'
              })
      </script>
    @endif
    @if (Session::has('mark_delete_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Selected Category Deleted Successfully, which has no expense.'
              })
      </script>
    @endif
    @if (Session::has('mark_restore_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Selected Category Restore Successfully'
              })
      </script>
    @endif
    @if (Session::has('category_delete_unsuccess'))
      <script>
              Toast.fire({
                  icon: 'error',
                  title: 'First Delete expenses under this category, then try!!'
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
    @if (Session::has('category_delete_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Category Successfully Deleted'
              })
      </script>
    @endif
    @if (Session::has('parmanent_delete_success'))
      <script>
              Toast.fire({
                  icon: 'success',
                  title: 'Category Successfully Deleted'
              })
      </script>
    @endif
@endsection
@endsection
