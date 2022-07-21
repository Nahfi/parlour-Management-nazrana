@extends('layouts.admin.admin_app')
@section('customer_active')
    mm-active
@endsection
@section('site_title')
   Customer Show | Bir Beauty
@endsection
@section('admin_css_link')
    <!-- choices css -->
<link href="{{ asset('admin_assets') }}/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('admin_js_link')
     <!-- choices js -->
  <script src="{{ asset('admin_assets') }}/libs/choices.js/public/assets/scripts/choices.min.js"></script>
  <!-- init js -->
  <script src="{{ asset('admin_assets') }}/js/pages/form-advanced.init.js"></script>
@endsection
@section('admin_content')
<style>
    .inf-content{
    border:1px solid #DDDDDD;
    -webkit-border-radius:10px;
    -moz-border-radius:10px;
    border-radius:10px;
    box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);
}


</style>
<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Show Customer</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.customer.index') }}">All Customers</a></li>
                            <li class="breadcrumb-item active">Show Customer</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-lg-8 col-md-6 col-sm-12 col-12 m-auto">
                <div class="card">
                    <div class="card-body">
                         <div class="row align-items-center">  
                         
                              
                     
                              <div class="container bootstrap snippets bootdey mt-3">
                                <div class="panel-body inf-content">
                                    <div class="row ">
                                        <div class="col-md-4">
                                            <img alt="" style="width:200px; height:200px; border-radius:50%;"; title="" class="img-circle img-thumbnail isTooltip" src="{{asset('/admin_assets/images/customers/'.$customer->image)}}" data-original-title="Usuario"> 
                                           
                                        </div>
                                        <div class="col-md-6 mt-2">
                                            <strong class="ms-2" style="font-size: 20px">Customer Information</strong><br>
                                            <div class="table-responsive">
                                            <table class="table table-user-information">
                                                <tbody>
                                                    <tr>        
                                                        <td>
                                                            <strong>
                                                                <span class="glyphicon glyphicon-asterisk text-primary"></span>
                                                                Customer Name                                                
                                                            </strong>
                                                        </td>
                                                        <td class="text-primary">
                                                            {{$customer->name}}
                                                        </td>
                                                    </tr>
                                                    <tr>    
                                                        <td>
                                                            <strong>
                                                                <span class="glyphicon glyphicon-user  text-primary"></span>    
                                                                Card Number                                                
                                                            </strong>
                                                        </td>
                                                        <td class="text-primary">
                                                            {{$customer->cardNumber}}    
                                                        </td>
                                                    </tr>
                                                    <tr>        
                                                        <td>
                                                            <strong>
                                                                <span class="glyphicon glyphicon-cloud text-primary"></span>  
                                                                Email                                                
                                                            </strong>
                                                        </td>
                                                        <td class="text-primary">
                                                            {{$customer->email}} 
                                                        </td>
                                                    </tr>
                                
                                                    <tr>        
                                                        <td>
                                                            <strong>
                                                                <span class="glyphicon glyphicon-bookmark text-primary"></span> 
                                                                Phone Number                                                
                                                            </strong>
                                                        </td>
                                                        <td class="text-primary">
                                                            {{$customer->phone}}  
                                                        </td>
                                                    </tr>

                                                    <tr>        
                                                        <td>
                                                            <strong>
                                                                <span class="glyphicon glyphicon-bookmark text-primary"></span> 
                                                                Address                                               
                                                            </strong>
                                                        </td>
                                                        <td class="text-primary">
                                                            {{$customer->address}}  
                                                        </td>
                                                    </tr>
                                                    <tr>        
                                                        <td>
                                                            <strong>
                                                                <span class="glyphicon glyphicon-bookmark text-primary"></span> 
                                                                Customer Type                                               
                                                            </strong>
                                                        </td>
                                                        <td class="text-primary">
                                                            {{$customer->type}}  
                                                        </td>
                                                    </tr>
                                                    <tr>        
                                                        <td>
                                                            <strong>
                                                                <span class="glyphicon glyphicon-bookmark text-primary"></span> 
                                                                Status                                              
                                                            </strong>
                                                        </td>
                                                        <td class="text-primary">
                                                            {{$customer->status}}  
                                                        </td>
                                                    </tr>
                                                    <tr>        
                                                        <td>
                                                            <strong>
                                                                <span class="glyphicon glyphicon-bookmark text-primary"></span> 
                                                                Point                                              
                                                            </strong>
                                                        </td>
                                                        <td class="text-primary">
                                                            
                                                            {{$customer->point?$customer->point:"No Point Earned"}}  
                                                        </td>
                                                    </tr>
                                                    <tr>        
                                                        <td>
                                                            <strong>
                                                                <span class="glyphicon glyphicon-bookmark text-primary"></span> 
                                                                Created By                                              
                                                            </strong>
                                                        </td>
                                                        <td class="text-primary">
                                                            {{$customer->customerCreatedBy->name}}  
                                                        </td>
                                                    </tr>
                                                    <tr>        
                                                        <td>
                                                            <strong>
                                                                <span class="glyphicon glyphicon-bookmark text-primary"></span> 
                                                                Edited By                                              
                                                            </strong>
                                                        </td>
                                                        <td class="text-primary">
                                                            {{$customer->customerEditedBy?$customer->customerEditedBy->name:"Not edited yet"}}  
                                                        </td>
                                                    </tr>
                                                   
                                
                                
                                                    
                                                
                                                    
                                                                                       
                                                </tbody>
                                            </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div> 
                                
                         </div>
                         <!-- end row -->
                         <!-- end table responsive -->
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- container-fluid -->
</div>
@section('admin_js')
    @if (Session::has('customer_update_success'))
    <script>
            Toast.fire({
                icon: 'success',
                title: 'Customer Update Successfully'
            })
    </script>
    @endif
    @if ($errors->any())
    <script>
        Toast.fire({
            icon: 'error',
            title: 'Something wrong, Please try again!!'
        })
</script>
    @endif
@endsection
@endsection