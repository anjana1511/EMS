@if(Auth::user()->hasRole('admin'))
@extends('layouts.app')
@section('content')

<div class="content">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Email</div>
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
                       <form method="post" action="{{url('sendemail/send')}}">
                        {{ csrf_field() }}

                        <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Name:</label>
                        <input type="text" class="form-control" name="user" id="user" value="">
                      </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Subject</label>
                        <input type="text" class="form-control" placeholder="Subject" name="sub" id="sub">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>From:</label>
                        <input type="text" class="form-control" name="fromemail" id="fromemail">
                      </div>
                    </div>
                
                    <div class="col-md-5 px-1">
                      <div class="form-group">
                        <label>To:</label>
                        <input type="text" class="form-control" name="toemail" id="toemail">
                      </div>
                    </div>
                </div>
                 <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Message</label>
                         <textarea name="editor1" class="form-control"></textarea>
                        <!-- <input type="text" class="form-control" placeholder="Message" name="msg" id="msg"> -->
                      </div>
                    </div>
                  </div>
                   <div class="row">
                    <div class="update ml-auto mr-auto">                            
                        <input type="submit" name="send" class="btn btn-info" value="Send" />
                            </div>
                    </form>
@endsection                    
<script type="text/javascript" src="{{ asset('js/nicEdit.js') }}"></script>
<script type="text/javascript">
  bkLib.onDomLoaded(function() { nicEditors.allTextAreas() });
</script>
@endif