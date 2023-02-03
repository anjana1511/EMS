@if(Auth::user()->hasRole('admin'))
@extends('layouts.app')
@section('content')
      <div class="content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Leave Type</div>
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
    <form action="{{ route('store_leavetype')}}" method="post">
    {{ csrf_field() }}
        <table align="center" width="80%">
            <tr>
                <td colspan="2" align="center">
                <h4> Insert Leave Type</h4>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                <hr>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                    @endif
                </td>
            </tr>
            <tr>
                <td align="right" width="30%">
				<br>
                    <label>Enter Leave Type</label> 
                    &nbsp; &nbsp;
                </td>
                <td> 
                    <input type="text" class="form-control" name="leave_type" id="leave_type" placeholder="Leave Type Here">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <hr>
                </td>
            </tr>
            <tr>
            <td  colspan="2" align="center">
            <input type="reset" class="btn btn-primary" name="back" value="Reset"></button>
            <button type="submit" class="btn btn-primary">Submit</button>
            </td>
            </tr>
        </table>
    </form>
  </div>
</div>

<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <h4 class="modal-title">Update Leave Type</h4>  
                </div>  
                <form action="{{ route('edit_leavetype')}}" method="post">
                    {{ csrf_field() }}
                <div class="modal-body" id="employee_detail">  
               
                        <table align="center" width="100%">
                        <tr>
                        <td align="right" width="30%">
						
                            <label>Enter Leave Type</label> 
                            &nbsp; &nbsp;
                        </td>
                        <td> 
                            <input type="hidden" class="form-control" name="edit_id" id="edit_id">
                            <input type="text" class="form-control" name="ename" id="ename" placeholder="Leave Type Here">
                        </td>
                    </tr>               
                    </table>

                </div>  
                <div class="modal-footer"> 
                <button type="submit" class="btn btn-primary">Submit</button>
                     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>  
                </div>  
                </form>
           </div>  
      </div>  
     </div>
     <br />
             <div class="table-responsive">
            <table id="user_table" class="table table-bordered table-striped">
            <thead>
            <tr>
            <td align="center" width="5%"><b>ID</b></td>
                        <td align="center"><b>Leave Type</b></td>
                        <td align="center"><b>Action</b></td>
            </tr>
            </thead>
            <tbody></tbody>
            </table>
        </div>
     </div>
</div>
    <script src="{{ asset('js/jquery.min.js') }} "></script>
<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
<script  type="application/javascript">

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){
   
$.ajax({
     url: "{{ route('getleave') }}",
   
    success: function(response){
 console.log(response['data']);

            var len = 0;
           $('#user_table tbody').empty(); // Empty <tbody>
           if(response['data'] != null){
             len = response['data'].length;
           }

           if(len > 0){
             for(var i=0; i<len; i++){
               var hash_id = response['data'][i].hash_id;
               var leave_type = response['data'][i].leave_type;
            

               var tr_str = "<tr>" +
                   "<td align='center'>" + (i+1) + "</td>" +
                   "<td align='center'>" + leave_type + "</td>" +
                   "<td align='center'><input type='button' value='Update' class='update btn btn-info' data-id='"+hash_id+"' ><input type='button' value='Delete' class='delete btn btn-danger' data-id='"+hash_id+"' ></td>"+
                
               "</tr>";

               $("#user_table tbody").append(tr_str);
             }
           }else if(response['data'] != null){
              var tr_str = "<tr>" +
                  "<td align='center'>1</td>" +
                  "<td align='center'>" + response['data'].leave_type + "</td>" + 
                
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


$(document).on("click", ".update" , function() {
    var edit_id = $(this).data('id');

  $.ajax({
    url: "{{ route('getdatabyid_leave') }}",
    type: 'get',
    data: {_token: CSRF_TOKEN,edit_id: edit_id},
    success: function(response){
      console.log(response);
        $('#edit_id').val(response.data.hash_id);
        $('#ename').val(response.data.leave_type);  
        $('#dataModal').modal('show'); 
   
    }
  });


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
                url: "{{ route('deletedata_leavetype') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id},
                success: function(response){
           
                    swal({title: "Success", text: "Leave Type has been deleted!", type: "success"},
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
@endif