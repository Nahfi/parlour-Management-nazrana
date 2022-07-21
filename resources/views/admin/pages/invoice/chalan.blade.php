
@section('admin_content')
@extends('layouts.admin.admin_app')
@section('invoice_active')
    mm-active
@endsection
@section('invoice_show_active')
    active
@endsection

@section('site_title')
 Invoice | Bir Beauty
@endsection
@section('admin_css_link')

     <!-- DataTables -->
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
  <!-- Responsive datatable examples -->
  <link href="{{ asset('admin_assets') }}/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" /> 
  <link href="{{ asset('admin_assets') }}/libs/choices.js/public/assets/styles/choices.min.css" rel="stylesheet" type="text/css" />

@endsection
@section('admin_js_link')

     <script src="{{ asset('admin_assets') }}/js/printThis.js"></script>
 
 
@endsection
<section id="invoice-print" class="smt-50" style="margin-top:50px;">
    <div>
        <div
            style="width:796px; height:1120px; margin: 0 auto;text-transform:capitalize;color:#222; padding:20px;background: #fff;overflow: hidden;">
            <div class="print mt-3">
                <button id="print" class=" btn btn-success btn sm" style="margin-left: 50%; margin-top: 10px;">Print</button>
        
            </div>
            <div id="demo" style="width:756px; height:1080px;font-size:13px;">
                <div style="height:70px;">
                    <div style="width:606px;float:left;padding-top: 36px;">
                        <div
                            style="border-bottom:2px solid #f0674c;width:50px;float:left;padding-top:39px;margin-right:5px;">
                        </div>
                        <h1 style="text-transform:uppercase;letter-spacing: 12px;font-weight:600;">Invoice</h1>
                        <p style="margin-bottom:0;letter-spacing:2px">No. <span
                                style="font-weight: 700;font-size:15px;">{{$invoice->invoice_id}}</span> // <span>  {{ date("F j, Y",strtotime($invoice->created_at))}}</span>
                        </p>
                        <p style="margin-bottom:0;letter-spacing:2px">Bin No. <span
                            style="font-weight: 700;font-size:14px;">{{generalSettings()->bin_number}}</span> 
                        </p>
                    </div>
                    <div style="width:150px;float:left;">
                        <div>
                            <img src="{{ asset('photo/settings/general') }}/{{ generalSettings()->favicon }}" alt="company logo"
                                style="height:100px; width:100px; border-radius:50% !important;  margin: 15px 25px;">
                        </div>
                    </div>
                </div>
                <div style="height:100px;margin-top:80px;">
                    <div style="width:368px;float:left;overflow:hidden;margin-right:10px;">
                        <h3 style="font-size: 18px;font-weight: 600;margin-bottom:5px;">Billing From:</h3>
                        <p style="margin-bottom:0;">{{generalSettings()->name}} | {{generalSettings()->phone}} </p>
                        <p style="margin-bottom:0;">{{generalSettings()->address}}</p>
                    </div>
                    <div style="width:368px;float:left;overflow:hidden;margin-left:10px;">
                        <h3 style="font-size: 18px;font-weight: 600;margin-bottom:5px;">Billing To:</h3>
                        <p style="margin-bottom:0;">{{$invoice->customer->name}} | {{$invoice->customer->phone}}</p>
                        <p style="margin-bottom:0;">{{$invoice->customer->address}}</p>
                    </div>
                </div>
        
                <div style="position: relative;">
                    <table
                        style="border-top: 2px solid #999;text-align:center;border-bottom: 2px solid #999;border-collapse: collapse;width: 100%;margin-bottom: 1rem;">
                        <thead>
                            <tr style="text-transform:uppercase;font-weight: bold;border-bottom: 2px solid #999;">
                                <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">SN</td>
                                <td
                                    style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                    Service Information</td>
                                <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">Assigned Employee
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($invoiceInfo as $invoices )
                                <tr style="text-transform:capitalize;">
                                    <td style="padding: 1rem;vertical-align: top;border-top: 1px solid #dee2e6;">0{{$loop->iteration}}</td>
                                    <td style="padding: 1rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                        {{$invoices->service->name}}
                                    </td>
                                    <td style="padding: 0.75rem;vertical-align: top;border-top: 1px solid #dee2e6;">
                                        {{$invoices->employee->name}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($invoice->totalDue>0)
                    <img src="{{asset('admin_assets/images/invoice/payment/due.png')}}" alt="due.png"
                        style="position: absolute;top: 50%;opacity:0.5;left: 50%;height: 100px;width: 100px;">
                    @else
                    <img src="{{asset('admin_assets/images/invoice/payment/paid.png')}}" alt="paid.png"
                        style="position: absolute;top: 50%;opacity:0.5;left: 50%;height: 100px;width: 100px;">
                    @endif
                    
                </div>
                <div style="height:100px;">
                    <div style="width: 545px;float:left;padding-top:55px;">
                        <p style="margin-bottom:0;font-size:12px;padding-right:0px;"><b>Notes: </b>{{$invoice->note}}</p>
                    </div>
                    
                </div>
                <div>
                   
                  
                    
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('admin_js')

    <script>
  

   
     $(document).ready(function() {

        $(document).on('click','#print',function(e){
            $("#demo").printThis({
                pageTitle: "",    
                header: null,               
                footer: null,
            });

        e.preventDefault()
        })

     })
    </script>
    @endsection