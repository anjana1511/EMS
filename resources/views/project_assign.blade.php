@extends('layouts.app')
@section('content')
<div class="content">
    <div class="row justify-content-center">
    @if(Auth::user()->hasRole('admin'))
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Assign Project</div>
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
    <form action="{{ route('create')}}" method="post">
    {{ csrf_field() }}
        <table align="center" width="80%">
            <tr>
                <td colspan="2" align="center">
                <h4>Assign Project</h4>
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
                   <label>Department Name</label>
                   &nbsp; &nbsp;
               </td>
               <td>
                  <select name="dept_name" id="dept_name" class="form-control">
                  <option value="">Select Department</option>
                  @foreach($deptdata as $item)
                      <option value="{{ $item->dept_id }}">{{ $item->dept_name }}</option>
                  @endforeach
                  </select>
                  
               </td>
            </tr>
            <tr>
                <td width="20%">
                    <label>Select Project Name</label> 
                    &nbsp; &nbsp;
                </td>
                <td> 
                  <select name="pname" id="pname" class="form-control">
                    <option value="">Select Project</option>
                  
                  </select>
                
                </td>
            </tr>
            <tr>
                <td width="20%">
                    <label>Select Employee</label>
                    &nbsp;&nbsp;
                </td>
                <td>
                <select name="ename" id="ename" class="form-control">
                    <option value="">Select Employee</option>
                    </select>
                </td>    
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
                     <h4 class="modal-title">Update Project</h4>  
                </div>  
                <form action="{{ route('edit_project')}}" method="post">
                    {{ csrf_field() }}
                <div class="modal-body" id="project_detail">  
               
                        <table align="center" width="100%">
                            <tr>
                                <td width="20%">
                                    <label>Department Name</label> 
                                    &nbsp; &nbsp;
                                </td>
								</tr>
								<tr>
                                <td> 
                                    <input type="hidden" class="form-control" name="edit_id" id="edit_id">
                                    <select id="dept_id" name="dept_id" class="form-control">
                                    @foreach($deptdata as $item)
                                    <option value="{{ $item->dept_id }}">{{ $item->dept_name }}</option>
                                    @endforeach
                                    </select>                
                                </td>
                            </tr>
                            <tr>
                                <td  width="20%">
                                <br>
                                   <label>Project Name</label>
                                   &nbsp; &nbsp;
                                </td>
								</tr>
								<tr>
                                <td>
                                <input type="text" class="form-control" name="epname" id="epname" placeholder="Project Name Here">
                                </td>
                            </tr>
                            <tr>
                                <td  width="20%">
                                <br>
                                   <label>Project Details</label>
                                   &nbsp; &nbsp;
                                </td>
								</tr>
								<tr>
                                <td>
                                <textarea class="form-control" name="epdetails" id="epdetails" placeholder="Project Details Here"></textarea>
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
 @endif
<br />
   <div class="table-responsive">
    <table id="user_table" class="table table-bordered table-striped">
     <thead>
      <tr>
       <td  align="center" width="5%"><b>ID</b></td>
                <td align="center"><b>Employee Name</b></td>
                <td align="center"><b>Project Name</b></td>
                <td align="center"><b>Department</b></td>
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
     url: "{{ route('getprojects') }}",
   
    success: function(response){
        // console.log(response);
           var len = 0;
           
           $('#user_table tbody').empty(); // Empty <tbody>
           if(response['data'] != null){
             len = response['data'].length;
             
           }

           if(len > 0){
             for(var i=0; i<len; i++){
               var hash_id = response['data'][i].hash_id;
               var ename1=response['data'][i].firstname;
               var ename2=response['data'][i].middlename;
               var pname = response['data'][i].pname;
               var dept_id=response['data'][i].dept_name;
               var dpid=response['data'][i].dept_id;
            

               var tr_str = "<tr>" +
                   "<td align='center'>" + (i+1) + "</td>" +
                   "<td align='center'>" + ename1 +" " + ename2 + "</td>" +
                   "<td align='center'>" + pname + "</td>" +
                   "<td align='center'>" + dept_id + "</td>"+
                   "@if(Auth::user()->hasRole('admin'))<td align='center'><input type='button' value='Delete' class='delete btn btn-danger' data-id='"+hash_id+"' ></td>@endif"+
                
               "</tr>";

            //    $('select[name="state_name"]').append('<option value="'+ sid +'">'+ state_id +'</option>');
               $("#user_table tbody").append(tr_str);
             }
           }else if(response['data'] != null){
              var tr_str = "<tr>" +
                  "<td align='center'>1</td>" +
                  "<td align='center'>" + response['data'].firstname + " " + response['data'].middlename + "</td>" +
                  "<td align='center'>" + response['data'].pname + "</td>" + 
                  "<td align='center'>" + response['data'].dept_name + "</td>"+
                
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
                url: "{{ route('deletedata_project_assign') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id},
                success: function(response){
           
                    swal({title: "Success", text: "Project has been deleted!", type: "success"},
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
            jQuery('select[name="dept_name"]').on('change',function(){
               var deptID = jQuery(this).val();
               if(deptID)
               {
                  jQuery.ajax({
                     url : 'projectdata/getproject/' +deptID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="pname"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="pname"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });

                  jQuery.ajax({
                     url : 'empdata/getemp/' +deptID,
                     type : "GET",
                     dataType : "json",
                     success:function(data)
                     {
                        console.log(data);
                        jQuery('select[name="ename"]').empty();
                        jQuery.each(data, function(key,value){
                           $('select[name="ename"]').append('<option value="'+ key +'">'+ value +'</option>');
                        });
                     }
                  });
               }
               else
               {
                  $('select[name="ename"]').empty();
               }
            });
    });

</script>
@endsection
