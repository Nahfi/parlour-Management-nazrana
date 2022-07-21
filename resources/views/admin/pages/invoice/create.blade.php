@extends('layouts.admin.admin_app')
@section('invoice_active')
    mm-active
@endsection
@section('invoice_invoices_active')
    active
@endsection

@section('site_title')
   Create Invoice | Bir Beauty
@endsection
@section('admin_css_link')

<style>
    .margin{
        margin-bottom: 1.5px !important;
    }
    .t-align{
        text-align:start !important;
    }
    .btn-group-sm>.btn, .btn-sm {
    text-align: center !important
    padding: 0.15rem .4rem !important;
    font-size: .61094rem !important;
    border-radius: .1.2rem !important;
}
    .form-control {

    text-align: center;
    /* border: 1px solid #01c273 !important; */
    width: 100% !important;
    height: auto !important;
    color: rgb(63, 62, 62) !important;
    border-radius: 5px !important;
    padding: 0px 5px !important;
    margin-bottom: 0px !important;
    -webkit-box-shadow: none;
    box-shadow: none;
    -webkit-transition: 0.5s;
    transition: 0.5s;
}
 .form-control {
    width: 100%;
    height: auto;
    color: rgb(63, 62, 62);
    border-radius: 5px;
    padding: 0px 5px;
    margin-bottom: 0px;
    -webkit-box-shadow: none;
    box-shadow: none;
    -webkit-transition: 0.5s;
    transition: 0.5s;
}

    .pd{
        padding: 7px 5px !important;
    }

    textarea {
    display: block;
    width: 100%;
    padding: .47rem .75rem;
    font-size: .8125rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    border-radius: .25rem;
    -webkit-transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out, -webkit-box-shadow .15s ease-in-out;


    }
    textarea:focus{
      outline: none !important;
    }

    .bg-green {
    background-color: #A55FAA !important;
    }
    .btn-green {
    padding: 5px 5px !important;
    border-radius: 10px !important;
    background-color: #A55FAA !important;
    text-transform: uppercase !important;
    }
    #productImage{
        height: 35px !important;
        width: 35px !important;
        border-radius: 50% !important;
    }
    #loadImage{
        height: 35px !important;
        width: 35px !important;
        border-radius: 50% !important;
    }

</style>
  <link href="{{ asset('admin_assets') }}/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('admin_js_link')
     <!-- choices js -->
     <script src="{{ asset('admin_assets') }}/libs/choices.js/public/assets/scripts/choices.min.js"></script>
     <!-- init js -->
     <script src="{{ asset('admin_assets') }}/js/pages/form-advanced.init.js"></script>

@endsection
@section('admin_content')
<div class="page-content">

    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Invoice</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Invoice</li>

                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <div class="card">
                    <div class="card-body">
                         <div class="row align-items-center">
                              <div class="container bootstrap snippets bootdey mt-3">
                                <div class="panel-body inf-content">
                    <div class="row mt-4">
                        <div class="col-6 col-lg-6 col-md-6 col-sm-6 pr-md-0 ">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <h5>
                                            Billing From
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-7 col-md-7 col-sm-7 col-lg-7 pr-lg-0">
                                        <div class="form-group">
                                            <input type="text" placeholder="Name" value="{{GeneralSettings()->name}}" class="t-align form-control pd ">
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-5 col-md-5 col-sm-5">
                                        <div class="form-group">
                                            <input type="text" placeholder="Phone" value="{{GeneralSettings()->phone}}" class="t-align form-control pd ">
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                <div class="col-lg-12 col-12 col-sm-12 col-md-12 ">
                                    <div class="form-group mt-3">
                                        <textarea name="" id="" >{{GeneralSettings()->address}}</textarea>
                                    </div>
                                </div>
                                </div>
                                </div>
                            </div>
                                <div class="col-lg-6 col-6 col-sm-6 col-md-6 pl-md-0">
                                    <div class="row">
                                        <div class="col-12 col-lg-12 col-md-12 col-sm-12">
                                            <div class="form-group">
                                                <h5>
                                                    Billing To
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-7 col-md-7 col-sm-7 col-lg-7 pr-lg-0">
                                            <select id="customerId"  class="t-align form-control select2" data-trigger id="choices-single-default" >
                                                <option  value=""> Customer</option>
                                                @foreach ($allCustomer as $customer)
                                                    <option  value="{{$customer->id}}">{{$customer->name}}</option>
                                                @endforeach
                                             </select>
                                        </div>
                                            <div class="col-lg-5 col-5 col-md-5 col-sm-5">
                                                <div class="form-group">
                                                    <input id="phoneNumber" type="text" placeholder="Phone" class="t-align form-control pd ">
                                                </div>
                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-12 col-sm-12 col-md-12 ">
                                                <div class="col-lg-12 col-12 col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <textarea id="billingAddress" name="address" placeholder="Address" cols="30" class="t-align form-control pd mt-3">
                                                        </textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                            </div>
                                        </div>
                                    </div>


                                    <div class="row mt-3">

                                        <div class="row">
                                            <div class="col-lg-4 col-4 col-md-4 col-sm-4 ">
                                                <div class="form-group">
                                                    <input disabled type="text" value="Service" class=" text-white form-control  bg-green border-0 p-1">
                                                </div>
                                            </div>
                                            <div class="col-lg-1 pr-lg-1 col-1 col-md-1 col-sm-1">
                                                <div class="form-group">
                                                    <input disabled type="text" value="img" class=" text-white form-control  bg-green border-0 p-1">

                                                </div>
                                            </div>

                                            <div class="col-lg-2 pr-lg-1 col-2 col-md-2 col-sm-2 ">

                                                    <input disabled type="text" value="price" class=" text-white form-control  bg-green border-0 p-1">

                                            </div>

                                            <div class="col-lg-4 pr-lg-1 col-4 col-md-4 col-sm-4 ">
                                                <div class="form-group">
                                                    <input disabled type="text" class="text-white form-control  bg-green border-0 p-1" value="Employe Name " >
                                                </div>
                                            </div>

                                            </div>
                                    </div>

                                    <div class="row mt-3" id="bodyData">

                                    </div>
                                    <form id="addInvoice" action="" enctype="multipart/form-data">
                                    <div class="row mt-3">
                                        <div class="row">
                                            <div class="col-4 col-md-4 col-sm-4 col-lg-4 pr-lg-1">
                                                <div class="form-group ">
                                                     <select name="product" class="form-control select2" id="productId"  data-trigger
                                                    id="choices-single-default">    >
                                                        <option  value=""> Service</option>
                                                        @foreach ($allProduct as $product)

                                                         <option value="{{$product->id }}+{{$product->name}}">{{$product->name}}

                                                        </option>

                                                        @endforeach

                                                        </select>

                                                </div>

                                            </div>
                                            <div class=" col-1 col-md-1 col-sm-1 pr-1 pl-1 col-lg-1 pr-lg-1 pl-lg-1">
                                                <div class="form-group text-center justify-content-center">
                                                    <img class=" text-center" id="productImage" src="" alt="" class="form-control avatar-sm rounded-circle me-2"/>
                                                    <input id="hiddenImg" type="hidden" name="image" value="">

                                                </div>
                                            </div>

                                            <div class=" col-sm-2 col-md-2 col-2 col-lg-2 pr-lg-1 pl-lg-1">
                                                <div class="form-group">
                                                    <input name="price" id="price" type="number" placeholder="0" class="price pd form-control">

                                                </div>
                                            </div>

                                            <div class="col-lg-4 pr-lg-1 col-4 col-md-4 col-sm-4">
                                                <div class="form-group ">
                                                    <select name="employee" id="employeeId" class="form-control select2" data-trigger
                                                    id="choices-single-default">
                                                        <option  value=""> Employee</option>
                                                        @foreach ($allEmployee as $employee)
                                                         <option  value="{{$employee->id}}+{{$employee->name}}">{{$employee->name}}</option>

                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            </div>
                                    </div>
                                    <div class="row mt-3">
                                        <div class="col-lg-12">
                                            <button   class="btn btn-primary pd mb-2 btn-sm"><i class="bx bx-plus me-1"></i> Add Service</button>

                                        </div>
                                    </div>
                                    </form>

                                <form action="{{route('admin.invoice.store')}}" method="post">

                                @csrf
                                    <div class="row">
                                        <input hidden value=" " id="customer_id" type="text" name="customer_id">

                                        <div class="col-lg-12">
                                            <div class="row align-items-center">
                                                <div class="col-lg-5 col-md-5">
                                                    <div class="col-lg-12 col-md-6 mt-4">

                                                         <div class="row">
                                                             <div class="col-4 col-lg-4"><p class="mr-2">Discount Type (<i id="icon" style="font-size: 12px !important" class="fas fa-percent">
                                                            </i>)</p>
                                                            </div>
                                                            <div class="col-8 col-lg-8">
                                                                <div class="form-group">
                                                                    <select id="discount" name="discount-type" class="form-control"><option selected="selected" value="%"><span>(%)</span></option>
                                                                         <option value="flat"><span>(&#2547;)</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                         </div>
                                                         <div class="row">
                                                             <div class="col-4 col-lg-4"><p class="mr-2">Payment Type </p>
                                                            </div>
                                                            <div class="col-8 col-lg-8">
                                                                <div class="form-group">
                                                                    <select  name="payment_type" class="form-control">
                                                                        <option selected value='cash'>
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
                                                         </div>
                                                         <div class="row">
                                                            <div class="col-4 col-lg-4"><p class="mr-2">Notes </p>

                                                           </div>
                                                           <div class="col-8 col-lg-8">
                                                               <div class="form-group">
                                                                <textarea name="note"  placeholder="thank you for gracing us with your presence. "  class="text-align-start "></textarea>
                                                               </div>
                                                           </div>
                                                        </div>
                                                        </div>
                                                </div>
                                                    <div class="col-lg-2 col-md-2">
                                                    </div>
                                                    <div class="col-lg-5 col-md-5 mt-2">
                                                    <div class="row">
                                                        <div class="col-lg-12 mt-3">
                                                            <div class="row">
                                                                <div class="col-6 col-lg-5 pl-lg-1 pr-1">
                                                                    <input type="text" disabled value="Subtotal" class="bg-green text-white form-control border-0" style="background-color: rgb(1, 194, 115);">
                                                                </div>
                                                                    <div class="col-6 col-lg-6 pl-1">
                                                                        <input disabled name="subTotal" id="subTotal" type="number" placeholder="0"  class="price form-control">

                                                                    </div>
                                                                </div>
                                                        </div>



                                                <div class="col-lg-12">
                                                    <hr style="margin-top: 10px; margin-bottom: 5px;">
                                                </div>
                                                <div class="col-lg-12 mt-1">
                                                    <div class="row">
                                                        <div class="col-6 col-lg-5 pl-lg-1 pr-1">
                                                            <input type="text" disabled value="Discount" class="bg-green text-white form-control border-0" style="background-color: rgb(1, 194, 115);">
                                                        </div>
                                                        <div class="col-6 col-lg-6 pl-1">
                                                            <input name="discount"  id="discountAmount" type="number" placeholder="0" class="price form-control">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-lg-12 mt-1">
                                                    <div class="row">
                                                        <div class="col-6 col-lg-5 pl-lg-1 pr-1">
                                                            <input type="text" disabled value="Tax (%)" class="bg-green text-white form-control border-0" style="background-color: rgb(1, 194, 115);">
                                                        </div>
                                                        <div class="col-6 col-lg-6 pl-1">
                                                            <input name="tax"  id="tax" type="number" placeholder="0" class="price form-control">
                                                            <input   hidden name="subtotaltax"  id="subtotaltax" type="text" placeholder="0" class="price form-control">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-lg-12">
                                                    <hr style="margin-top: 10px; margin-bottom: 5px;">
                                                </div>
                                                    <div class="col-lg-12 mt-1">
                                                        <div class="row">
                                                            <div class="col-6 col-lg-5 pl-lg-1 pr-1">
                                                                <input type="text" disabled value="Grand Total" class="bg-green text-white form-control border-0" style="background-color: rgb(1, 194, 115);">
                                                            </div>
                                                            <div class="col-6 col-lg-6 pl-1">
                                                                <input disabled name="GrandTotal" id='total'  type="number" placeholder="0"  class="price form-control"> </div>
                                                            </div>
                                                        </div>
                                                            <div class="col-lg-12 mt-1">
                                                                <div class="row">
                                                                    <div class="col-6 col-lg-5 pl-lg-1 pr-1">
                                                                        <input type="text" disabled value="Amount Paid" class="bg-green text-white form-control border-0" style="background-color: rgb(1, 194, 115);">
                                                                    </div>
                                                                    <div class="col-6 col-lg-6 pl-1 text-center">
                                                                        <input  name="paid" type="number" id="paid" placeholder="0" class="price text-center form-control"
                                                                        step="any"
                                                                        >

                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 mt-1">
                                                                <div class="row">
                                                                    <div class="col-6 col-lg-5 pl-lg-1 pr-1">
                                                                        <input type="text" disabled value="Total Due" class="bg-red text-white form-control border-0" style="background-color: rgb(218, 41, 28);">
                                                                    </div>
                                                                     <div class="col-6 col-lg-6 pl-1">
                                                                        <input disabled name="due" type="number" id="due" placeholder="0"  class="price form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                     </div>

                                     <div class="row mt-3 justify-content-center">
                                        <div class="col-lg-12 text-center justify-content-center">
                                            <button type="submit" class="btn btn-primary pd mb-2 btn-sm">Submit</button>
                                        </div>
                                    </div>

                                    </form>

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

    <script>
     $(document).ready(function() {
           loadSessionData()
            //ajax setup
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 }
             });

             //load session data when page is reloading
             function loadSessionData(){
                 $.ajax({
                   method:'get',
                   url:"/admin/invoice/loadSessionData",
                   async:false,
                   dataType:'json'
                 }).done(responseData=>{

                    if(responseData.invoiceData != null){
                   $('#bodyData').empty()
                    let totalPrice = 0;
                    for(const index in (responseData.invoiceData)){
                    let row=`<div class="row margin" >`;
                    row+=`<div class=" col-4 col-md-4 col-sm-4 col-lg-4 pr-lg-1">
                                <div class="form-group">
                                    <input id="" disabled type="text" value='${responseData.invoiceData[index]['productName']}'  class="price form-control">
                                </div>
                         </div>

                            <div class="col-1 col-md-1 col-sm-1  col-lg-1 pr-lg-1 pl-lg-1">
                                <div class="form-group text-center justify-content-center">
                                    <img sty class=" text-center" id="loadImage" src="/admin_assets/images/products/${responseData.invoiceData[index]['image']}" alt="" class="form-control avatar-sm rounded-circle me-2"/>

                                </div>
                            </div>

                            <div class="col-2 col-md-2 col-sm-2 col-lg-2 pr-lg-1 pl-lg-1">
                                <div class="form-group">
                                    <input id="" disabled type="number" value="${responseData.invoiceData[index]['price']}"  class="price  form-control">

                                </div>
                            </div>
                            <div class="col-4 col-md-4 col-sm-4  col-lg-4 pl-lg-1">
                                <div class="form-group  ">
                                    <input id="" disabled type="text" value="${responseData.invoiceData[index]['employeName']}"   class="price  form-control">

                                </div>
                            </div>
                            <div class="col-1 col-md-1 col-sm-1  col-lg-1 pl-lg-1">
                                <div class="form-group text-center justify-content-center ">
                                    <a  id="deleteSession" value="${index}" class="text-center btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </div>

                            `;
                        row+="</div>"
                        $('#bodyData').append(row)

                        totalPrice = totalPrice  + parseInt(responseData.invoiceData[index]['price'])
                    }
                        $('#subTotal').val((totalPrice));
                        $('#subtotaltax').val((totalPrice));
                        $('#tax').val(0);
                        const discountType=($('#discount').val());
                        $('#discountAmount').val(0);
                        $('#total').val(totalPrice);
                        const paid = $('#paid').val(0);
                        let due = totalPrice - paid;
                        $('#due').val(totalPrice);
                }

                })
             }

            //remove invoiceData from session
            $(document).on('click','#deleteSession',function(e){
                const id=$(this).attr('value');
                $.ajax({
                    method:'get',
                    url:`/admin/invoice/delete/${id}`,
                    dataType:'json',
                    async:false
                }).done(responseData=>{
                    if(responseData.success==true){
                        loadSessionData();
                    }

                })
                e.preventDefault()
            })

            //add invoiceData in session
            $(document).on('submit','#addInvoice',function(e){

                const productId=$('#productId').val()
                const price=$('#price').val()
                const employeeId=$('#employeeId').val()
                if(!employeeId || !productId || !price ){
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong, Please select all the input field then try again!!'
                    })

                }
                else{
                    $.ajax({
                        method:'post',
                        url:'/admin/invoice/storeInSession',
                        data: new FormData(this),
                        contentType:false,
                        processData:false,
                        async:false
                    }).done(responseData=>{
                        loadSessionData();
                    })
                }
                 e.preventDefault()
            })

            //tax calculation
            $(document).on('change','#tax',function(e){
                let tax = $('#tax').val();
                if(tax ==''){
                    $('#tax').val(0)
                }
                const gtotal=parseFloat($('#subtotaltax').val());
                let totalTax = (gtotal * (tax/100));

                if(tax == 0){
                    totalTax = 0;
                }
                const finalTotal = gtotal + totalTax ;
                $('#total').val(parseFloat(finalTotal).toFixed(2));
                const paid = $('#paid').val();
                const due = finalTotal - paid ;
                $('#due').val(parseFloat(due).toFixed(2));
                e.preventDefault()
            })

            //customer information find using ajax
             $(document).on('change','#customerId',function(e){

                let customerId=$(this).val();
                if(customerId !=''){

                    $.ajax({
                        method:'get',
                        url:`/admin/invoice/find-Specific-Customer/${customerId}`,
                        dataType:'json',
                        async:false
                    }).done(customerInfo=>{

                       $('#phoneNumber').val(
                        customerInfo.customer.phone)
                       $('#billingAddress').val(
                        customerInfo.customer.address)
                        $('#customer_id').val(customerInfo.customer.id)

                    })
                }
                else{
                    $('#phoneNumber').val(' ')
                    $('#billingAddress').val(' ')
                    $('#customer_id').val(' ')
                }

                e.preventDefault()

             })

            //discount icon change
            $(document).on('change','#discount',function(e){
                let discount=$(this).val()

                if(discount!='%'){
                    $('#icon').removeClass('fas fa-percent')
                    $('#icon').addClass(' fas fa-money-bill-alt')
                   const subtotal = $('#subTotal').val();
                   const discountAmount = $('#discountAmount').val();
                   const totalCal = subtotal - discountAmount;
                   if(totalCal<0){
                    $('#total').val(total);
                    $('#discountAmount').val(0);

                    $('#due').val(total);
                    Toast.fire({
                    icon: 'error',
                    title: 'Something went wrong, discount must be less than total'
                    })
                   }
                   else{
                   let tax = $('#tax').val();
                   let totalTax = (totalCal * (tax/100));
                   if(tax == 0){
                            totalTax = 0;
                    }
                   const finalTotal = totalCal + totalTax ;
                   $('#total').val(parseFloat(finalTotal).toFixed(2));
                   $('#subtotaltax').val(parseFloat(totalCal).toFixed(2));
                   const paid =  $('#paid').val();
                   const due = finalTotal - paid;
                   $('#due').val(parseFloat(due).toFixed(2));
                }
                }
                else{
                    $('#icon').removeClass('fas fa-money-bill-alt')
                    $('#icon').addClass('fas fa-percent')

                   const subtotal = $('#subTotal').val();
                   const discountAmount = $('#discountAmount').val();

                   if(discountAmount>100){
                    $('#discountAmount').val('0')
                    $('#total').val('0');
                    $('#paid').val('0');
                    $('#due').val(subtotal)
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong, % discount must be less than 100'
                    })
                   }
                   else{
                        const totalCal = subtotal -(subtotal * (discountAmount/100));
                        let tax = $('#tax').val();
                        let totalTax = (totalCal * (tax/100));
                        if(tax == 0){
                            totalTax = 0;
                        }
                        const finalTotal = totalCal + totalTax ;
                        $('#total').val(parseFloat(finalTotal).toFixed(2));
                        $('#subtotaltax').val(parseFloat(totalCal).toFixed(2));
                        const paid =  $('#paid').val();
                        const due = finalTotal - paid ;
                        $('#due').val(parseFloat(due).toFixed(2))
                   }
                }
                e.preventDefault()

            })


            $(document).on('change','#discountAmount',function(e){

                const discount=($(this).val());
                if(discount == ''){
                    $(this).val(0)
                }
                const total=parseFloat($('#subTotal').val());
                const discountType=($('#discount').val());
                if($(this).attr('type')!='number' || $('#paid').attr('type')!='number' ){
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong, All input field must be  Number'
                    })
                }
                if(discountType == 'flat'){
                    const grandTotal = total - discount ;
                    if(grandTotal<0){
                        $('#total').val(total);
                        $(this).val(0);
                        $('#paid').val(0)
                        $('#due').val(total);
                        Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong, discount must be less than total'
                        })
                    }
                    else{

                        let tax = $('#tax').val();
                        let totalTax = (grandTotal * (tax/100));
                        if(tax == 0){
                            totalTax = 0;
                        }
                        const finalTotal = grandTotal + totalTax ;
                        $('#total').val(parseFloat(finalTotal).toFixed(2));
                        $('#subtotaltax').val(parseFloat(grandTotal).toFixed(2));
                        const due = finalTotal - $('#paid').val();
                        $('#due').val(parseFloat(due).toFixed(2));
                    }

                }
                else if(discountType == '%'){
                    if(discount>100){
                        $(this).val(0);
                        Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong, % discount must be less than 100'
                    })
                    }
                    else{
                        $('#total').val(0);
                        const grandTotal = total -(total * (discount/100));
                        let tax = $('#tax').val();
                        let totalTax = (grandTotal * (tax/100));
                        if(tax == 0){
                            totalTax = 0;
                        }
                        const finalTotal = grandTotal + totalTax ;
                        $('#total').val(parseFloat(finalTotal).toFixed(2));
                        $('#subtotaltax').val(parseFloat(grandTotal).toFixed(2));
                        const paid = $('#paid').val();
                        const due = finalTotal - paid ;
                        $('#due').val(parseFloat(due).toFixed(2));
                    }
                }
                else{
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong, discount Type must be % or flat'
                    })
                }
                e.preventDefault()
            })

            $(document).on('change','#paid',function(e){
                if($(this).attr('type')!='number'  || $('#paid').attr('type')!='number'  ){
                    Toast.fire({
                        icon: 'error',
                        title: 'Something went wrong, All input field must be  Number'
                    })
                }
                else{
                    if($(this).val() == ''){
                        $(this).val(0)
                        $('#due').val(parseFloat($('#total').val()).toFixed(2))
                    }
                    else{
                        const due = parseFloat($('#total').val()).toFixed(2) - parseFloat($(this).val()).toFixed(2)
                        $('#due').val(parseFloat(due).toFixed(2))
                    }

                }
                e.preventDefault()
            })

            //product information find using ajax
            $('#productImage').hide();
            $(document).on("change",'#productId',function(e){
                let id=$(this).val()
                $.ajax({
                    method:'get',
                    url:`/admin/invoice/find-Specific-Product/${id}`,
                    dataType:'json',
                    async:false
                }).done(productInfo=>{
                   $('#price').val(productInfo.product.price)
                   $('#productImage').show();
                   $('#productImage').attr('src',`{{ asset('/admin_assets/images/products/${productInfo.product.photo}')}}`)
                   $('#hiddenImg').val(productInfo.product.photo)
                })
                e.preventDefault()
            })

         } );
     </script>
    @if (Session::has('no data in session'))
      <script>
              Toast.fire({
                  icon: 'error',
                  title: 'Something Went Wrong , No services are  added  '
              })
      </script>
    @endif
    @if ($errors->any())
      <script>
              Toast.fire({
                  icon: 'error',
                  title: 'Something went wrong, Please select billing to Customer Name'
              })
      </script>
    @endif

@endsection
@endsection
