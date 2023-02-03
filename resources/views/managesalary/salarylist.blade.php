@extends('layouts.app')
@section('content')
<div class="content">
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
    <div class="row">   
        <div class="col-md-12">
        <br />
                <div class="table-responsive">
                <table id="user_table" class="table table-bordered table-striped">
                <thead>
                <tr>
                            <th>ID</th>
                            <th>Employee</th>
                            <th>Gross Salary</th>
                            <th>Tax</th>
                            <th>Leaves</th>
                            <th>Advancepayment</th> 
                            <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse($salaryData as $data)
                <tr>
                            <td>{{$loop->index+1}}</td>
                            <td>{{ $data->firstname}}</td>
                            <td>{{ $data->gross_salary}}</td>
                            <td>{{ $data->tax}}</td>
                            <td>{{ $data->total_leave }}</td>
                            <td>{{ $data->total}}</td>
                            <td><a href="{{ route('generate_slip', $data->s_id) }}"><img src='{{ asset('assets/img/print.png') }}' height='30' width='30' /></a></td>

                </tr>
                @empty 
                <tr>
                <td align='center' colspan='5'>No record found.</td></tr>
                @endforelse  
               </tbody>
                </table>
            </div>
        </div> <!-- end col-md-6 -->
           

    </div>  
</div>
@endsection