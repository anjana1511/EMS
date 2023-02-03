@if(Auth::user()->hasRole('admin'))
@extends('layouts.app')
@section('content')
<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">District</div>
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
    <form action="{{ route('store_district')}}" method="post">
    {{ csrf_field() }}
        <table align="center" width="80%">
            <tr>
                <td colspan="2" align="center">
                <h4>Insert District</h4>
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
               <td  width="20%">
                   <label>State Name</label>
                   &nbsp; &nbsp;
               </td>
               <td>
                  <select name="state_name" id="state_name" class="form-control">
                  <option value="">Select State</option>
                  @foreach($statedata as $item)
                      <option value="{{ $item->state_id }}">{{ $item->state_name }}</option>
                  @endforeach
                  </select>
                  
               </td>
            </tr>
            <tr>
                <td width="20%">
                    <label>District Name</label> 
                    &nbsp; &nbsp;
                </td>
                <td> 
                    <input type="text" class="form-control" name="dist_name" id="dist_name" placeholder="District Name Here">
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
                     <h4 class="modal-title">Update District</h4>  
                </div>  
                <form action="{{ route('edit_district')}}" method="post">
                    {{ csrf_field() }}
                <div class="modal-body" id="district_detail">  
               
                        <table align="center" width="100%">
                            <tr>
                                <td width="20%">
                                    <label>State Name</label> 
                                    &nbsp; &nbsp;
                                </td>
								</tr>
								<tr>
                                <td> 
                                    <input type="hidden" class="form-control" name="edit_id" id="edit_id">
                                    <select id="state_id" name="state_id" class="form-control">
                                    @foreach($statedata as $item)
                                    <option value="{{ $item->state_id }}">{{ $item->state_name }}</option>
                                    @endforeach
                                    </select>                
                                </td>
                            </tr>
                            <tr>
                                <td  width="20%">
                                <br>
                                   <label>District Name</label>
                                   &nbsp; &nbsp;
                                </td>
								</tr>
								<tr>
                                <td>
                                <input type="text" class="form-control" name="edist_name" id="edist_name" placeholder="District Name Here">
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
       <td  align="center" width="5%"><b>ID</b></td>
                <td align="center"><b>District</b></td>
                <td align="center"><b>State</b></td>
                 @if($role==true)<td align="center"><b>Action</b></td>@endif 
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

    // getstate();

    $.ajax({
     url: "{{ route('getdistrict') }}",
   
    success: function(response){

            var len = 0;
           $('#user_table tbody').empty(); // Empty <tbody>
           if(response['data'] != null){
             len = response['data'].length;
           }

           if(len > 0){
             for(var i=0; i<len; i++){

               var hash_id = response['data'][i].hash_id;
               var district_name = response['data'][i].district_name;
               var state_id=response['data'][i].state_name;
               var sid=response['data'][i].state_id;
            

               var tr_str = "<tr>" +
                   "<td align='center'>" + (i+1) + "</td>" +
                   "<td align='center'>" + district_name + "</td>" +
                   "<td align='center'>" + state_id + "</td>"+
                   "<td align='center'> @if($role==true)<input type='button' value='Update' class='update btn btn-info' data-id='"+hash_id+"' >||<input type='button' value='Delete' class='delete btn btn-danger' data-id='"+hash_id+"' > @endif</td>"+
                
               "</tr>";

            //    $('select[name="state_name"]').append('<option value="'+ sid +'">'+ state_id +'</option>');
               $("#user_table tbody").append(tr_str);
             }
           }else if(response['data'] != null){
              var tr_str = "<tr>" +
                  "<td align='center'>1</td>" +
                  "<td align='center'>" + response['data'].district_name + "</td>" + 
                  "<td align='center'>" + response['data'].state_name + "</td>"+
                
              "</tr>";

            //   $('select[name="state_name"]').append('<option value="'+  response['data'].state_id  +'">'+  response['data'].state_name  +'</option>');
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
    url: "{{ route('getdatabyid_district') }}",
    type: 'get',
    data: {_token: CSRF_TOKEN,edit_id: edit_id},
    success: function(data){
     states=data.statedata;
    
        //  $.each(states, function(key, value) {
        //     //  console.log(value.state_id);
        //                     $('select[name="state_id"]').append('<option value="'+ value.state_id +'">'+ value.state_name +'</option>');
                        
        //    });

        $('#edit_id').val(data.distdata.hash_id);
        $('#edist_name').val(data.distdata.district_name);  
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
                url: "{{ route('deletedata_district') }}",
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

// function getstate()
// {
//     $.ajax({
//     url: "{{ route('getstatedata') }}",
//     type: 'get',
//     dataType: "json",
//     data: {_token: CSRF_TOKEN},
//     success: function(data){
  
//        console.log(data);
//       $.each(data, function(key, value) {
//                             $('select[name="state_name"]').append('<option value="'+ value.state_id +'">'+ value.state_name +'</option>');
//                         });

  
//     }
//   });


// }
</script>
@endsection
@endif