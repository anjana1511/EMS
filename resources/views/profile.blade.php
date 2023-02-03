@extends('layouts.app')

@section('content')
      <div class="content">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
				<h5 class="card-title">User Profile</h5>
				<hr>
				</div>

                <div class="card-body">
                 
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
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    You are logged in -->
                    <form action="{{ route('update_profile')}}" method="post"  enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <table align="center" width="80%" height="100%" border="0">
        <tbody>
         <tr>
            <td colspan="4" align="center">
                       
                <img src="{{ asset('images/users/').'/'.Auth::user()->image }}" alt="No Image Found" width="80px" height="80px">
              
            <br>
            </td>
        </tr>
        <tr>

           <td width="50%">
           <br>
           <input type="hidden" class="form-control" name="username" id="username" value="{{  Auth::user()->name  }}">
           </td>
           <td>
           <br>
           <input type="hidden" class="form-control" name="email" id="email" value="{{ Auth::user()->email }}" readonly="">
           </td>
        </tr>
        <tr>
           <td colspan="2">
           <br>
           <input type="file" name="image" id="image" class="form-control">
           </td>
        </tr>
        <tr>
           <td colspan="2" align="center">
           <br>
           <input type="submit" class="btn btn-primary" name="btnsubmit" value="Submit">
           </td>
        </tr>
    </tbody>
    </table>
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
