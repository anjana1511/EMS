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
           <div class="col-md-4">
             <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Assign Role-Permission</h5>
                <p class="card-category">roles</p>
              </div>
              <div class="card-body ">
                   <div class="col-md-12">
                        <form action="{{ route('assign_per')}}" method="post">
                        {{ csrf_field() }}
                            <div class="form-group">
                                <label for="exampleInputRoleid">Select Role</label>
                                <select id="role_id" name="role_id" class="form-control">
                                <option value="0">Select</option>
                                @foreach($roles as $item)
                                <option value="{{ $item->id }}">{{ $item->role_name }}</option>
                                @endforeach
                                </select>
                              </div>
                          </div>
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="exampleInputperid">Select Permission</label>
                                  <select id="per_id" name="per_id" class="form-control">
                                  <option value="0">Select</option>
                                  @foreach($per as $item1)
                                  <option value="{{ $item1->id }}">{{ $item1->per_name }}</option>
                                  @endforeach                        
                                  </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                              <div class="form-group">
                                  <label for="exampleInputperid">Select User</label>
                                  <select id="user_id" name="user_id" class="form-control">
                                  <option value="0">Select</option>
                                  @foreach($users as $item1)
                                  <option value="{{ $item1->id }}">{{ $item1->name }}</option>
                                  @endforeach                        
                                  </select>
                                </div>
                            </div>                            
                 </div>
              <div class="card-footer">
                <div class="chart-legend">
                   <div class="update ml-auto mr-auto">
                      <button type="submit"  value="assign_per" name="action" class="btn btn-primary btn-round">Submit</button>
                    </div>
                </div>
                <hr/>
                <div class="card-stats">
                  <!-- <i class="fa fa-check"></i> Data information certified -->
                </div>
              </div>
            </div>
            
          </div>
          <div class="col-md-8">
             <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">All Users </h5>
                <p class="card-category">Role-Permission</p>
              </div>
              <div class="card-body ">
                        <div class="table-responsive">
                        <table id="user_table" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                        <td align="center" width="5%"><b>ID</b></td>
                                    <td align="center"><b>Role</b></td>
                                    <td align="center"><b>Permission</b></td>
                                    <td align="center"><b>User</b></td>
                                    <td align="center"><b>Action</b></td>
                        </tr>
                        </thead>
                        <tbody></tbody>
                        </table>
                    </div>
              </div>
        </div>
</div>


<script src="{{ asset('js/jquery.min.js') }} "></script>
<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
<script  type="application/javascript">

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){
   
$.ajax({
     url: "{{ route('getdata') }}",
   
    success: function(response){
 console.log(response['data']);

            var len = 0;
           $('#user_table tbody').empty(); // Empty <tbody>
           if(response['data'] != null){
             len = response['data'].length;
           }

           if(len > 0){
             for(var i=0; i<len; i++){
               var role_name = response['data'][i].role_name;
               var per_name = response['data'][i].per_name;
               var uname=response['data'][i].name;
               var user_id=response['data'][i].user_id;

               var tr_str = "<tr>" +
                   "<td align='center'>" + (i+1) + "</td>" +
                   "<td align='center'>" + role_name + "</td>" +
                   "<td align='center'>" + per_name + "</td>" +
                   "<td align='center'>" + uname + "</td>" +                   
                   "<td align='center'><input type='button' value='Delete' class='delete btn btn-danger' data-id='"+user_id+"' ></td>"+
                
               "</tr>";

               $("#user_table tbody").append(tr_str);
             }
           }else if(response['data'] != null){
              var tr_str = "<tr>" +
                  "<td align='center'>1</td>" +
                  "<td align='center'>" + role_name + "</td>" +
                   "<td align='center'>" + per_name + "</td>" +
                   "<td align='center'>" + uname + "</td>" + 
                
              "</tr>";

              $("#userTable tbody").append(tr_str);
           }else{
              var tr_str = "<tr>" +
                  "<td align='center' colspan='4'>No record found.</td>" +
              "</tr>";

              $("#user_table tbody").append(tr_str);
           }
        }});
});

$(document).on("click",".delete", function()
{
        var id=$(this).data(id);
            swal({
        title: "Are you sure?",
        text: "You will not be able to recover this imaginary file!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
        cancelButtonText: "No, cancel!",
        closeOnConfirm: false,
        closeOnCancel: false
        },
            function(isConfirm){
            if (isConfirm) {
                
                $.ajax({
                url: "{{ route('deletedata_assign_role') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id},
                success: function(response){
           
                    swal({title: "Success", text: "State has been deleted!", type: "success"},
                            function(){ 
                                location.reload();
                            }
                        );
                // swal("Deleted!", "Your imaginary file has been deleted.", "success");
              
                }
            });
                
            } else {
                swal("Cancelled", "Your imaginary file is safe :)", "error");
            }

            // location.reload();
        });

});

</script>
@endsection