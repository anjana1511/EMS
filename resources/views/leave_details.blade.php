@extends('layouts.app')
@section('content')

<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><b>Leaves</b>>>>Leave Details</div>
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
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Employee Name</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" value="{{ $data->firstname}}  {{ $data->middlename }}" readonly>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Email:</label>
                           <input type="text" class="form-control"  id="email" name="email" value="{{ $data->email }}" readonly>
                      </div>
                    </div>
                     <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Mobile No:</label>
                           <input type="text" class="form-control" id="Mono" name="Mono" value="{{ $data->Mono }}" readonly>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>Leave Date</label>
                          <input type="hidden" value="{{ $data->hash_id }}" id="hash_id" name="hash_id">
                        <input type="text" class="form-control" value="{{ $data->leave_fromdate }} to {{ $data->leave_todate }}" id="leave_date" name="leave_date" readonly>
                      </div>

                    </div>
                      <div class="col-md-4 px-1">
                      <div class="form-group">
                         <label>Leave Type</label>
                          <input type="text" class="form-control" name="leave_type" id="leave_type" value="{{ $data->leave_type }}" readonly>
                      </div>
                    </div>
                      <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>Leave status </label>
                          <input type="text" class="form-control" name="leave_status" id="leave_status" value="<?php
                                if($data->leave_status=="0"){
                                echo "Pending";}
                                elseif($data->leave_status=="1"){
                              echo "Approved";}
                               elseif($data->leave_status=="2"){
                              echo "Rejected";}

                           ?>" readonly>
                           </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                         <label>Leave Description</label>
                        <textarea class="form-control" readonly>{{ $data->leave_description }}</textarea>
                       </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                          <label>Admin Remark</label>
                         <textarea class="form-control" readonly>{{ $data->admin_remark }}</textarea>
                      </div>
                    </div>
                    
                  </div>
                           <div class="row">
                    <div class="update ml-auto mr-auto">
                      <input type='button' value='Tack Action' class='change_status btn btn-info' data-id="{{ $data->hash_id }}" >
                    
                  </div>
                </div>
           
    </form>
  </div>
</div>
        </div>
    </div>
</div>  

<!-- Modal -->
  <div class="modal fade" id="dataModal" role="dialog">
    <div class="modal-dialog modal-sm">
          <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Leave Status</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
                              <form method="POST" action="{{ route('update_status') }}">
                                {{ csrf_field() }}
          <input type="hidden"  class="form-control" name="id" id="id">

                  <div class="row">
                    <div class="col-md-11 pr-1">
                      <div class="form-group">
                         <label>Select Status</label>
                         <select class="form-control" name="leave_status" id="leave_status">
                           <option value="1">Apprroved</option>
                           <option value="2">Rejected</option>
                           <option value="0">Pendding</option>
                         </select>
                       </div>
                    </div>                 
                  </div>
                  <div class="row">
                      <div class="col-md-11 pr-1">
                      <div class="form-group">
                          <label>Admin Remark</label>
                         <textarea class="form-control" name="remark" id="remark"></textarea>
                      </div>
                    </div>
                  </div>
                  
        </div>
        <div class="modal-footer">
          <input type="submit" class="btn btn-primary" name="btnupdate" value="Update" class="btnsub" onClick="return validation();"/>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>

<script src="{{ asset('js/jquery.min.js') }} "></script>
<script  type="application/javascript">
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

$(document).on("click", ".change_status" , function() {
    var edit_id = $(this).data('id');

  $.ajax({
    url: "{{ route('leavechange_status') }}",
    type: 'get',
    data: {_token: CSRF_TOKEN,edit_id: edit_id},
    success: function(response){
        $('#id').val(response.hash_id);
        $('#remark').val(response.admin_remark);

        $('#dataModal').modal('show'); 
   
    }
  });


});

</script>
@endsection
