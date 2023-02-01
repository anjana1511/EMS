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
              <div class="card-header ">
                <h5 class="card-title">Advance Payment</h5>
                <p class="card-category">advance</p>
              </div>
              <div class="card-body ">
                    <div class="col-md-12">
                    <form action="{{ route('makeAdvance')}}" method="post">
                      {{ csrf_field() }}
                        <div class="form-group">
                            <label for="exampleInputSlug">Employee</label>
                            <select id="emp_id" name="emp_id" class="form-control">
                            <option value="0">Select</option>
                              @foreach($emp as $item)
                            <option value="{{ $item->emp_id }}">{{ $item->firstname }}</option>
                            @endforeach
                            </select>
                          </div>
                      </div>      
                      <div class="col-md-12">               
                        <div class="form-group">
                            <label for="exampleInputRoleName">Date</label>
                            <input type="date" id="pdate" name="pdate" class="form-control">
                          </div>
                      </div>
                        <div class="col-md-12">
                          <div class="form-group">
                              <label for="exampleInputSlug">Amount</label>
                              <input type="text" id="amount" name="amount" class="form-control" placeholder="Amount">
                            </div>
                        </div>                    
                </div><!--card body end -->
                    <div class="card-footer ">
                        <div class="legend">
                            <div class="update ml-auto mr-auto">
                            <button type="submit" class="btn btn-primary btn-round">Submit</button>
                            </div> 
                          </form>
                        </div>
                          <hr>
                     </div><!-- card footer end -->      
                </div><!-- card end -->
              </div><!-- col-md-6 -->


<!-- Update Model   -->
<div id="dataModal" class="modal fade">  
      <div class="modal-dialog">  
           <div class="modal-content">  
                <div class="modal-header">  
                     <h4 class="modal-title">Update Advance Payment</h4>  
                </div>  
                <form action="{{ route('edit_advancepayment')}}" method="post">
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
                            <label>Amount</label> 
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
                            <label>Date</label> 
                            &nbsp; &nbsp;
                        </td>
                        <td> 
                            <input type="date" class="form-control" name="edate" id="edate" placeholder="date Here">
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
                                      <td align="center"><b>Amount</b></td>
                                      <td align="center"><b>Date</b></td>
                                      <td align="center"><b>Action</b></td>
                          </tr>
                          </thead>
                          <tbody></tbody>
                          </table>
                       </div>
                     </div>

          </div><!--  row end-->        
</div>

<script src="{{ asset('js/jquery.min.js') }} "></script>
<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
<script  type="application/javascript">

var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
$(document).ready(function(){
   
$.ajax({
     url: "{{ route('getadvancepayment') }}",
   
    success: function(response){
 console.log(response['data']);

            var len = 0;
           $('#user_table tbody').empty(); // Empty <tbody>
           if(response['data'] != null){
             len = response['data'].length;
           }

           if(len > 0){
             for(var i=0; i<len; i++){
               var hash_id = response['data'][i].id;
               var amount = response['data'][i].amount;
               var date= response['data'][i].date;
               var name= response['data'][i].firstname;
            

               var tr_str = "<tr>" +
                   "<td align='center'>" + (i+1) + "</td>" +
                   "<td align='center'>" + name + "</td>" +
                   "<td align='center'>" + amount + "</td>" +
                   "<td align='center'>" + date + "</td>" +
                   "<td align='center'><a class='update' data-id='"+hash_id+"' ><img src='{{ asset('assets/img/edit.png') }}' height='30' width='30' /></a>||<a class='delete' data-id='"+hash_id+"' ><img src='{{ asset('assets/img/delete.png') }}' height='30' width='30' /></a></td>"+
                
               "</tr>";

               $("#user_table tbody").append(tr_str);
             }
           }else if(response['data'] != null){
              var tr_str = "<tr>" +
                  "<td align='center'>1</td>" +
                  "<td align='center'>" + response['data'].name + "</td>" + 
                  "<td align='center'>" + response['data'].amount + "</td>" + 
                
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
    url: "{{ route('getdatabyid_advancepayment') }}",
    type: 'get',
    data: {_token: CSRF_TOKEN,edit_id: edit_id},
    success: function(response){

        $('#edit_id').val(response.data.id);
        $('#eamount').val(response.data.amount);  
        $('#edate').val(response.data.date);  
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
                url: "{{ route('deletedata_advancepayment') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id},
                success: function(response){
           
                    swal({title: "Success", text: "Advance Payment has been deleted!", type: "success"},
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