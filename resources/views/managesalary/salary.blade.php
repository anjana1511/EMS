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
                    @if(session()->has('error'))
                        <script  type="application/javascript">
                        swal(" {{ session()->get('error') }}", "You clicked the button!", "success")
                        </script>

                    @endif
<div class="row">                    
     <div class="col-md-6">
        <div class="card">
            <div class="card-header">Salary</div>
              <div class="card-body">
                    <form action="{{ route('store_salary')}}" method="post">
                    {{ csrf_field() }}
                        <table align="center" width="90%">
                            <tr>
                                <td colspan="2" align="center">
                                <h4> Insert Salary</h4>
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
                                <td width="30%">
                                <br>
                                    <label>Employee Name</label> 
                                    &nbsp; &nbsp;
                                </td>
                                <td> 
                                <select name="emp_id" id="emp_id" class="form-control">
                                <option value="">Select Employee</option>
                                @foreach($emp as $item)
                                    <option value="{{ $item->emp_id }}">{{ $item->firstname }}</option>
                                @endforeach
                                </select>
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">
                                <br>
                                    <label>Gross Salary</label> 
                                    &nbsp; &nbsp;
                                </td>
                                <td> 
                                    <input type="text" class="form-control" name="amount" id="amount" placeholder="Gross Salary Here">
                                </td>
                            </tr>
                            <tr>
                                <td width="30%">
                                <br>
                                    <label>Tax</label> 
                                    &nbsp; &nbsp;
                                </td>
                                <td> 
                                    <input type="text" class="form-control" name="tax" id="tax" placeholder="Tax Here">
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
    </div>    

    <!-- Update Model   -->
    <div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <h4 class="modal-title">Update Salary</h4>  
                </div>  
                <form action="{{ route('edit_salary')}}" method="post">
                    {{ csrf_field() }}
                <div class="modal-body" id="employee_detail">  
               
                        <table align="center" width="100%">
                        <tr>
                            <td align="left" width="30%">
                           Select Employee
                            </td>
                            <td>
                            <select name="emp_id" id="emp_id" class="form-control">
                                <option value="">Select Employee</option>
                                @foreach($emp as $item)
                                    <option value="{{ $item->emp_id }}">{{ $item->firstname }}</option>
                                @endforeach
                                </select>
                            </td>
                        </tr>    
                        <tr>
                        <td align="left" width="30%">
						<br>
                            <label>Salary</label> 
                            &nbsp; &nbsp;
                        </td>
                        <td> 
                            <input type="hidden" class="form-control" name="edit_id" id="edit_id">
                            <input type="text" class="form-control" name="eamount" id="eamount" placeholder="Salary Here">
                        </td>
                    </tr>     
                    <tr>
                        <td align="left" width="30%">
						<br>
                            <label>Tax</label> 
                            &nbsp; &nbsp;
                        </td>
                        <td> 
                            <input type="text" class="form-control" name="etax" id="etax" placeholder="Tax Here">
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
     <div class="col-md-6">
     <br />
             <div class="table-responsive">
            <table id="user_table" class="table table-bordered table-striped">
            <thead>
            <tr>
            <td align="center" width="5%"><b>ID</b></td>
                        <td align="center"><b>Employee</b></td>
                        <td align="center"><b>Salary</b></td>
                        <td align="center"><b>Tax</b></td>
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
     url: "{{ route('getsalary') }}",
   
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
               var amount = response['data'][i].gross_salary;
               var tax= response['data'][i].tax;
               var name= response['data'][i].firstname;
            

               var tr_str = "<tr>" +
                   "<td align='center'>" + (i+1) + "</td>" +
                   "<td align='center'>" + name + "</td>" +
                   "<td align='center'>" + amount + "</td>" +
                   "<td align='center'>" + tax + "</td>" +
                   "<td align='center'><span class='update' data-id='"+hash_id+"' ><img src='{{ asset('assets/img/edit.png') }}' height='30' width='30' /></span>||<a class='delete' data-id='"+hash_id+"' ><img src='{{ asset('assets/img/delete.png') }}' height='30' width='30' /></a></td>"+
                
               "</tr>";

               $("#user_table tbody").append(tr_str);
             }
           }else if(response['data'] != null){
              var tr_str = "<tr>" +
                  "<td align='center'>1</td>" +
                  "<td align='center'>" + response['data'].name + "</td>" + 
                  "<td align='center'>" + response['data'].gross_salary + "</td>" + 
                
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
    url: "{{ route('getdatabyid_salary') }}",
    type: 'get',
    data: {_token: CSRF_TOKEN,edit_id: edit_id},
    success: function(response){

        $('#edit_id').val(response.data.hash_id);
        $('#eamount').val(response.data.gross_salary);  
        $('#etax').val(response.data.tax);  
        $()
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
                url: "{{ route('deletedata_salary') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id},
                success: function(response){
           
                    swal({title: "Success", text: "Salary has been deleted!", type: "success"},
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