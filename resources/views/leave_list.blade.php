@extends('layouts.app')
@section('content')

<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">All Leaves</div>
                <div class="card-body">
                    @if (session('status'))
                        <script  type="application/javascript">
                        swal("Good job!", "You clicked the button!", "success")
                        </script>
                     @endif

                    @if(session()->has('message'))
                        <script  type="application/javascript">
                        swal(" {{ session()->get('message') }}", "You clicked the button!", "success")
                        </script>

                    @endif
    
  </div>

<br />
   <div class="table-responsive">
    <table id="user_table" class="table table-bordered table-striped">
     <thead>
      <tr>
       <th>ID</th>
        <th>
            Emp Name
        </th>
        <th>Leave Type</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
     </thead>
     <tbody>
         @foreach($empdata as $data)
         <tr>
          <td>{{ $data->emp_id }}</td>
          <td>{{ $data->firstname }}&nbsp; {{ $data->middlename }}</td>
          <td>{{ $data->leave_type }}</td>
          <td><?php
               if($data->leave_status=="0"){
                echo "Pending";}
                elseif($data->leave_status=="1"){
                echo "Approved";}
                elseif($data->leave_status=="2"){
                echo "Rejected";}
                                
           ?></td>
          <td><a href="{{ route('Leave_detail', $data->hash_id) }}"><input type='button' value='Details' class='update btn btn-info' ></a>
            ||<input type='button' value='Delete' class='delete btn btn-danger' data-id="{{ $data->hash_id }}"></td>
         </tr>
         @endforeach

     </tbody>
    </table>
   </div>
        </div>
    </div>
</div>
<!-- <meta name="csrf-token" content="{{ csrf_token() }}"> -->
 <script src="{{ asset('js/jquery.min.js') }} "></script>
<script  type="application/javascript">
var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

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
                url: "{{ route('deleteemp_leave') }}",
                type: 'post',
                data: {_token: CSRF_TOKEN,id: id},
                success: function(response){
                  // console.log(response);
                    swal({title: "Success", text: "Leave has been deleted!", type: "success"},
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
