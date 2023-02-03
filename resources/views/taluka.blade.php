@if(Auth::user()->hasRole('admin'))
@extends('layouts.app')
@section('content')

<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Taluka</div>
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
    <form action="{{ route('store_taluka')}}" method="post">
    {{ csrf_field() }}
        <table align="center" width="80%">
            <tr>
                <td colspan="2" align="center">
                <h4> Insert Taluka</h4>
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
                <select name="dist_name" id="dist_name" class="form-control">
                  <option value="">Select District</option>
                </select>
                  
                </td>
            </tr>
            <tr>
                <td width="20%">
                    <label>Taluka Name</label> 
                    &nbsp; &nbsp;
                </td>
                <td> 
                    <input type="text" class="form-control" name="taluka_name" id="taluka_name" placeholder="Taluka Name Here">
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
                     <h4 class="modal-title">Update Taluka</h4>  
                </div>  
                <form action="{{ route('edit_taluka')}}" method="post">
                    {{ csrf_field() }}
                <div class="modal-body" id="district_detail">  
               
                        <table align="center" width="100%">
                            <tr>
                                <td width="20%">
                                    <label>State Name</label> 
                                    &nbsp; &nbsp;
                                  <br>
                                </td>
						     </tr>		
							<tr>	
                                <td> 
                                    <input type="hidden" class="form-control" name="edit_id" id="edit_id">
                                    <select id="state_name" name="state_name" class="form-control">
                                    <option value="">Select State</option>
                                    @foreach($statedata as $item)
                                        <option value="{{ $item->state_id }}">{{ $item->state_name }}</option>
                                    @endforeach
                                    </select>                
                                </td>
                            </tr>
                            <tr>
                                <td width="20%">
                                <label></label>
                                    <label>District Name</label> 
                                    &nbsp; &nbsp;
                                </td>
						    </tr>
                             <tr>							
                                <td> 
                                   <select id="dist_name" name="dist_name" class="form-control">
                                    <option value="1">Select</option>
                                    </select>                
                                </td>
                            </tr>
                            <tr>
                                <td  width="20%">
                              <br>
                               <label>Taluka Name</label>
                                   &nbsp; &nbsp;
                                </td>
							<tr>	
                                <td>
                                <input type="text" class="form-control" name="etaluka_name" id="etaluka_name" placeholder="District Name Here">
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
 </div>
<br />
          <div class="col-md-12">
   <div class="table-responsive">
    <table id="user_table" class="table table-bordered table-striped">
     <thead>
      <tr>
       <td align="center"><b>ID</b></td>
                <td align="center"><b>Taluka</b></td>
                <td align="center"><b>District</td>
                <td align="center"><b>State</b></td>
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
     url: "{{ route('gettaluka') }}",
   
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
               var taluka_name = response['data'][i].taluka_name;
               var dist_id=response['data'][i].district_name;
               var state_id=response['data'][i].state_name;
            

               var tr_str = "<tr>" +
                   "<td align='center'>" + (i+1) + "</td>" +
                   "<td align='center'>" + taluka_name + "</td>" +
                   "<td align='center'>" + dist_id + "</td>"+
                   "<td align='center'>" + state_id + "</td>"+
                   "<td align='center'><input type='button' value='Update' class='update btn btn-info' data-id='"+hash_id+"' >||<input type='button' value='Delete' class='delete btn btn-danger' data-id='"+hash_id+"' ></td>"+
                
               "</tr>";

               $("#user_table tbody").append(tr_str);
             }
           }else if(response['data'] != null){
              var tr_str = "<tr>" +
                  "<td align='center'>1</td>" +
                  "<td align='center'>" + response['data'].taluka_name + "</td>" + 
                  "<td align='center'>" + response['data'].district_name + "</td>"+
                  "<td align='center'>" + response['data'].state_name + "</td>"+
                
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
    url: "{{ route('getdatabyid_taluka') }}",
    type: 'get',
    data: {_token: CSRF_TOKEN,edit_id: edit_id},
    success: function(response){

        $('#edit_id').val(response.data.hash_id);
        $('#etaluka_name').val(response.data.taluka_name);  
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
                url: "{{ route('deletedata_taluka') }}",
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


jQuery(document).ready(function ()
    {
            jQuery('select[name="state_name"]').on('change',function(){
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
                        jQuery('select[name="dist_name"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="dist_name"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="dist_name"]').empty();
               }
            });
    });

</script>
@endsection
@endif