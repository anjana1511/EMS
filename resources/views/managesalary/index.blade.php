@if(Auth::user()->hasRole('admin'))
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
    <div class="col-md-6">
            <div class="card ">
              <div class="card-header">
                  <h5 class="card-title">Manage Salary</h5>
                <p class="card-category">Details</p>
              </div>
              <div class="card-body ">
                    <div class="col-md-12">
                       <form action="{{ route('show') }}" method="post" class="form-horizontal">
                                @csrf
                        <div class="form-group">
                            <label for="exampleInputlName">Employee Name</label>  
                            <select type="text" name="employee_id" class="form-control">
                                        <option value="0" disabled {{ old('user') ? '' : 'selected' }}>All</option>
                                        @foreach($users as $user)
                                        <option value="{{$user->emp_id}}" {{ old('user') ? 'selected' : '' }}>{{$user->firstname}}</option>
                                        @endforeach
                                    </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer ">
                   <div class="legend">
                        <div class="update ml-auto mr-auto">
                            <button type="submit" class="btn btn-dark">Go</button>
                        </div></form>
                    </div>
                </div>    
            </div>  
       </div>     <!-- md 6 end -->   
                        

     </div>
</div>                    
@endsection                    
@endif