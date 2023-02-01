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
                <h5 class="card-title">Add New Role</h5>
                <p class="card-category">roles</p>
              </div>
              <div class="card-body ">
                   <div class="col-md-12">
                   <form action="{{ route('store_role')}}" method="post">
                    {{ csrf_field() }}
                       <div class="form-group">
                          <label for="exampleInputRoleName">Role Name</label>
                          <input type="text" id="role_name" name="role_name" class="form-control" placeholder="Role Name">
                        </div>
                    </div>
                    <div class="col-md-12">
                       <div class="form-group">
                          <label for="exampleInputSlug">Slug</label>
                          <input type="text" id="rslug" name="rslug" class="form-control" placeholder="Slug">
                        </div>
                    </div>                    
               </div>
              <div class="card-footer ">
                <div class="legend">
                   <div class="update ml-auto mr-auto">
                      <button type="submit" name="action" value="add_role" class="btn btn-primary btn-round">Submit</button>
                    </div> </form>
                </div>
                <hr>
                <div class="stats">
                  <h5><i class="fa fa-trash"></i>  Delete Roles</h5>
                  <form action="{{ route('delete_role')}}" method="post">
                    {{ csrf_field() }}          
                    <div class="col-md-12">
                       <div class="form-group">
                         <select id="role_id" name="role_id" class="form-control">
                           <option value="0">Select</option>
                           @foreach($roles as $item)
                           <option value="{{ $item->id }}">{{ $item->role_name }}</option>
                           @endforeach
                          </select>
                       </div>
                      </div>
                          <div class="update ml-auto mr-auto">
                          <button name="action" value="del_role" class="btn btn-primary btn-round">Delete</button></div>
                  </form>        
                </div>
              </div>
            </div>
          </div> <!-- col-md-6 end Roles-->  
          <div class="col-md-6">
            <div class="card ">
              <div class="card-header ">
                <h5 class="card-title">Add New Permission</h5>
                <p class="card-category">permission</p>
              </div>
              <div class="card-body ">
                   <div class="col-md-12">
                   <form action="{{ route('store_per')}}" method="post">
                   {{ csrf_field() }}
                       <div class="form-group">
                          <label for="exampleInputRoleName">Permission Name</label>
                          <input type="text" id="per_name" name="per_name" class="form-control" placeholder="Permission Name">
                        </div>
                    </div>
                    <div class="col-md-12">
                       <div class="form-group">
                          <label for="exampleInputSlug">Slug</label>
                          <input type="text" id="slug" name="slug" class="form-control" placeholder="Slug">
                        </div>
                    </div>                    
               </div>
              <div class="card-footer ">
                <div class="legend">
                   <div class="update ml-auto mr-auto">
                      <button type="submit"  value="add_per" name="action" class="btn btn-primary btn-round">Submit</button>
                    </div></form>
                </div>
                <hr>
                <div class="stats">
                  <h5><i class="fa fa-trash"></i>  Delete Permissions</h5>
                  <form action="{{ route('delete_role')}}" method="post">
                    {{ csrf_field() }}                   
                      <div class="col-md-12">
                        <div class="form-group">
                          <select id="per_id" name="per_id" class="form-control">
                            <option value="0">Select</option>
                            @foreach($per as $item)
                            <option value="{{ $item->id }}">{{ $item->per_name }}</option>
                            @endforeach
                            </select>
                        </div>
                        </div>
                            <div class="update ml-auto mr-auto">
                            <button name="action" value="del_per" class="btn btn-primary btn-round">Delete</button></div>
                    </form> 
                </div>
              </div>
            </div>
          </div><!-- End Permissions -->
          
</div>
@endsection