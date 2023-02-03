@extends('layouts.app')
@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-danger" onClick="PrintDiv();"><i class="fa fa-print"></i> Print</button>
                    <a href="{{ route('salarylist') }}" class="btn btn-md btn-danger">Back</a>

                </div>
                <div class="card-body">
                    @if (session('status'))
                        <!-- <div class="alert alert-success" role="alert"> -->
                       <script  type="application/javascript">
                        swal("Good job!", "You clicked the button!", "success")
                        </script>
                            <!-- {{ session('status') }}
                        </div> -->
                    @endif

                    @if(session()->has('message'))
                        <script  type="application/javascript">
                        swal(" {{ session()->get('message') }}", "You clicked the button!", "success")
                        </script>

                    @endif
                    <div id="print" class="page">
                    <table align="center" width="80%">
                    <tr height="100px" style="background-color:#363636;color:#ffffff;text-align:center;font-size:24px; font-weight:600;">
                    <td colspan="4">Daliyaspirants.com Design Limited</td>
                    </tr>
                    @foreach($data as $item)
                    <tr>
                        <td><strong>Name</strong></td>
                        <td>{{$item->firstname}}&nbsp;{{ $item->middlename}}</td>
                        <td><strong>DOB</strong></td>
                        <td>{{$item->dob}}</td>
                    </tr>
                    <tr>
                        <td><strong>Address</strong></td>
                        <td colspan="3">At.{{ $item->village_name }},Ta.{{ $item->taluka_name }},Dist.{{ $item->district_name }},{{ $item->state_name }}</td>
                    </tr>
                    <!------6 row---->
                    <tr>
                    <td><strong>Department</strong></td>
                    <td>{{ $item->dept_name }}</td>
                    <td><strong>Designation</strong></td>
                    <td>Designer</td>
                    </tr>
                    <tr>
                    <td><strong>Working Days</strong></td>
                    <td>30</td>
                    <td><strong>Leaves</strong></td>
                    <td>{{$item->total_leave}}</td>
                    </tr>                    
                    <tr>
                        <td colspan="4"><hr/></td>
                    </tr>
                    <tr>
                    <td><strong>Earnings</strong></td>
                    <td><strong>Amount</strong></td>
                    <td ><strong>Deductions</strong></td>
                    <td><strong>Amount</strong></td>
                    </tr>
                    <tr>
                    <td>Basic</td>
                    <td>{{$item->gross_salary}}</td>
                    <td>Provident fund</td>
                    <td>{{ $item->tax }}</td>
                    </tr>
                    <tr>
                    <td>House Rent Allowance</td>
                    <td>-</td>
                    <td>professional tax</td>
                    <td>-</td>
                    </tr>
                    <tr>
                    <td>special Allowance</td>
                    <td>-</td>
                    <td>Income tax</td>
                    <td>-</td>
                    </tr>
                    <tr>
                    <td>Advance Payment</td>
                    <td>{{ $item->advance }}</td>
                     <td>Unpaid leave</td>
                     <td>{{ $item->leave_pay }}</td>
                    </tr>
                    <tr>
                    <td>ADD Special allowance</td>
                    <td>-</td>
                    </tr>
                    <tr>
                    <td>shift Allowance</td>
                    <td>-</td>
                    </tr>
                    <tr>
                    <td>bonus</td>
                    <td>-</td>
                    </tr>
                    <tr>
                    <td>medical Allowance</td>
                    <td>-</td>
                    </tr>
                    <tr>
                    <td><strong>Gross Earnings</strong></td>
                    <td>{{$item->gross_salary}}</td>
                    <td><strong>Gross Deductions</strong></td>
                    <td>{{$item->tax}}</td>
                    </tr>
                    <tr>
                        <td colspan="4"><hr /></td>
                    </tr>
                    <tr>
                    <td align="right" colspan="4"><strong>NET PAY</strong></td>
                    </tr>
                    <tr>
                    <td align="right" colspan="4">Rs.{{$item->total}}</td>
                    </tr>
                    @endforeach
                 </table>
                  </div>

                    
                </div>  <!-- card-body -->
            </div>     <!-- card -->   
        </div> <!-- col-md-10 -->
    </div><!-- row justify-content-center -->
</div>       <!-- content -->               
{{--Start-For printing the screen--}}
<script type="text/javascript">     
          function PrintDiv() {    
           var divToPrint = document.getElementById('print');
           var popupWin = window.open('', '_blank');
           popupWin.document.open();
           popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
            popupWin.document.close();
                }
     </script>
     <style>
        @media print {
  .page {
    margin: 0;
    border: initial;
    border-radius: initial;
    width: initial;
    min-height: initial;
    box-shadow: initial;
    background: #ffffff;
    page-break-after: always;
  }}
     </style>
@endsection         