@extends('layouts.app')
@section('content')

<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><a href="{{ route('emp') }}">Employee</a>>>>Edit Employee</div>
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
              <form action="{{ route('updateemp')}}" method="post">
              {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" value="{{ $data['firstname'] }}" placeholder="">
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="middlename" id="middlename" placeholder="Last Name" value="{{ $data['middlename'] }}">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Joining Date</label>
                        <input type="hidden" name="hash_id" value="{{ $data['hash_id'] }} ">
                        <input type="text" class="form-control" value="{{ $data['join_date'] }}" id="join_date" name="join_date" readonly>
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Department</label>
                        <select name="dept" class="form-control">
                        <option value="">Select Department</option>
                         @foreach($dept as $depts)
                            <option value="{{ $depts->dept_id }}">{{ $depts->dept_name }}</option>
                         @endforeach

                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Division</label>
                         <select name="divi" class="form-control">
                            <option value="0">Select Division</option>
                                  @foreach($division as $divi)
                                     <option value="{{ $divi->id }}">{{ $divi->name }}</option>
                                  @endforeach
                          </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Email:</label>
                           <input type="text" class="form-control"  id="email" name="email" value="{{ $data['email'] }}" readonly>
                      </div>
                    </div>
                     <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Mobile No:</label>
                           <input type="text" class="form-control" id="Mono" name="Mono" value="{{ $data['Mono'] }}" />
                      </div>
                    </div>
                     <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Salary:</label>
                                       <select name="Salary" class="form-control">
                        <option value="0">Select Salary</option>
                           @foreach($salary as $amounts)
                            <option value="{{ $amounts->id }}">{{ $amounts->amount }}</option>
                           @endforeach

                        </select>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>State</label>
                         <select name="state_id" id="state_id" class="form-control">
                           <option value="0">Select State</option>
                           @foreach($statedata as $item)
                            <option value="{{ $item->state_id }}">{{ $item->state_name }}</option>
                           @endforeach
                          </select>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>District</label>
                        <select name="dist_id" class="form-control">
                      <option value="">Select_dist</option>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Taluka</label>
                          <select name="taluka_id" class="form-control">
                        <option value="">Select_taluka</option>
                        </select>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                     <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>City</label>
                        <select name="village_id" class="form-control">
                      <option value="">Select_city</option>
                      </select>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Age</label>
                        <input type="text" name="age" id="age" class="form-control"  value="{{ $data['age'] }}">
                      </div>
                    </div>
                     <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>BirthDate</label>
                        <input type="text" name="dob" id="dob" class="form-control" value="{{ $data['dob'] }}">
                      </div>
                    </div>
                  </div>
                           <div class="row">
                    <div class="update ml-auto mr-auto">
                    <input type="reset" class="btn btn-primary" name="back" value="Reset"></button>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
                </div>
           
    </form>
  </div>
</div>
        </div>
    </div>
</div>  
<script src="{{ asset('js/jquery.min.js') }} "></script>
<script  type="application/javascript">

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
jQuery(document).ready(function ()
    {
            jQuery('select[name="state_id"]').on('change',function(){
               var stateID = jQuery(this).val();
               if(stateID)
               {
                  jQuery.ajax({
                     url : 'distdata/getdistrict/' +stateID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="dist_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="dist_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="dist_id"]').empty();
               }
            });


            jQuery('select[name="dist_id"]').on('change',function(){
               var stateID = jQuery(this).val();
               if(stateID)
               {
                  jQuery.ajax({
                     url : 'talukadata/gettaluka/' +stateID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="taluka_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="taluka_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="taluka_id"]').empty();
               }
            });

            
            jQuery('select[name="taluka_id"]').on('change',function(){
               var stateID = jQuery(this).val();
               if(stateID)
               {
                  jQuery.ajax({
                     url : 'villagedata/getvillage/' +stateID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="village_id"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="village_id"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="village_id"]').empty();
               }
            });
    });


</script>
@endsection
