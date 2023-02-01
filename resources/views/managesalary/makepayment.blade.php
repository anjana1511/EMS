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
                <div class="card-header">Manage Salary Details</div>
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
                    </div>                    
                    <div class="row">
                         <div class="col-md-6">
                                <h3> &nbsp;<b class="text-danger">Invoice payment</b></h3>
                                <p class="text-muted m-l-5">
                                    <br/> Employee name:
                        </div>

                        <div class="col-md-6">
                            <br><br>
                                <p class="text-muted m-l-5">
                                    <br/> Designation:</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                                <h4 class="card-title">Earning</h4>

                                <div class="form-group row">
                                    <label class="col-sm-3 text-right control-label col-form-label">Basic salary</label>
                                    <div class="col-sm-5">
                                        <input type="text" name="basic_salary" id="basic_salary" class="form-control" value="" >
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="col-md-10">
                        <div class="pull-right m-t-30 text-right">
                            <p>Total amount: $13,848</p>
                            <p>Tax (10%) : $138 </p>
                            <hr>
                            <h3><b>Total :</b> $13,986</h3>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        {{--<div class="text-right">--}}
                            {{--<button class="btn btn-danger" type="submit"> Print </button>--}}
                        {{--</div>--}}
                    </div>
                </div>

                <div class="row no-print">
                    <div class="col-12">
                        {{--<a href="" id="pdffile" target="-_blank" class="btn btn-default"><i class="fa fa-print"></i>Print </a>--}}
                        <button class="btn btn-default" onclick="pdf()">Print</button>
                    </div>
                </div>                    
                <script>
                    function pdf() {
                        window.print();
                    }
                </script>



                    

        </div>
    </div>
</div>    
@endsection         