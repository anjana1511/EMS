@extends('layouts.app')
@section('content')

<style>
        @media print  {
            .page-breadcrumb{
                display: none;
            }
            .sidebar{
                display: none;
            }
            .no-print {
                display: none;
            }
            .text-center{
                display: none;
            }
            #advance-pay{
                display: none;
            }
        }
    </style>
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><a href="{{ route('managesalary') }}">Manage Salary</a>>>>Salary Details</div>
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
                    <form action="{{route('managesalary.store')}}" method="post" class="form-horizontal">
                            @csrf
                            <h4 class="card-title managesalary">{{ $username }} s'salary Details</h4>
                            <dl class="row employeedetails">
                                <dt class="col-sm-5">Employee name:</dt>
                                <dd class="col-sm-7" name="employee_name" id="employee_name"><strong>{{$username}}</strong></dd>
                                <input type="hidden" name="employee_name" value="{{ $username }}">
                                <input type="hidden" name="emp_id" value="{{ $id }}">
                                <dt class="col-sm-5">Gross Salary:</dt>
                                @foreach($amt as $item)
                                <dd class="col-sm-7" name="gross_salary" id="gross_salary">
                                <input type="hidden" name="gross_salary" value="{{ $item->gross_salary }}">
                                {{ $item->gross_salary }}
                                
                                <dt class="col-sm-5">Tax (1%): </dt>
                                <dd class="col-sm-7" name="tax" id="tax">
                                <input type="hidden" name="tax" value="{{ $item->tax }}">    
                                {{ $item->tax }}</dd>
                                @endforeach    
                                </dd>

                                <dt class="col-sm-5">Net Salary:</dt>
                                <dd class="col-sm-7" name="net_salary" id="grand-total">{{ $net_salary }} </dd>
                                <input type="hidden" name="net_salary" value="{{ $net_salary }}">
                                
                                <dt class="col-sm-5">Employee Count leave:</dt>
                                <dd class="col-sm-7" name="leave_count" id="leave_count">{{$total_leaves}}
                                    <span class='danger'>(If leave more than 15 then 5000 will be deducted )</span>
                                </dd>
                                <input type="hidden" name="leave_count" value="{{ $total_leaves }}">
                                
                                <dt class="col-sm-5">Employee leave Pay:</dt>
                                <dd class="col-sm-7" name="leave_count" id="leave_count">{{$leave_pay}}
                                 </dd>
                                <input type="hidden" name="leave_pay" value="{{ $leave_pay }}">


                                <dt class="col-sm-5">Advance payment:</dt>
                                <dd class="col-sm-7" name="advance" id="advance">{{$advancePayment}} </dd>
                                <input type="hidden" name="advance" value="{{ $advancePayment }}">

                                <dt class="col-sm-5">Total Payment:</dt>
                                <dd class="col-sm-7" name="total" id="total">{{$total}} </dd>
                                <input type="hidden" name="total" value="{{ $total}}">
                            </dl>

                            <div class="border-top no-print">
                                <div class="card-body">
                                 <button type="submit" class="btn btn-dark">Pay</button>
                                  <a href="{{route('managesalary')}}" class="btn btn-md btn-danger">Back</a>
                                  </div>
                           </div>
                        </form>
                    



                </div>                    
        </div>
    </div>
</div>    
@endsection         