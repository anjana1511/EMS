@extends('layouts.app')
@section('content')
<div class="content">
        <div class="row">
         <div class="col-md-10">
            <div class="card card-user">
              <div class="card-header">
                <h5 class="card-title">Employee Profile</h5>
              </div>
              <div class="card-body">
                <form>
                  <div class="row">
                    <div class="col-md-5 pr-1">
                      <div class="form-group">
                        <label>Joining Date</label>
                        <input type="hidden" name="hash_id" value="{{ $data['hash_id'] }} ">
                        <input type="text" class="form-control" value="{{ $data['join_date'] }}" id="join_date" name="join_date" readonly>
                      </div>
                    </div>
                    <div class="col-md-3 px-1">
                      <div class="form-group">
                        <label>Department</label>
                        <input type="text" class="form-control" placeholder="Department" id="dept" name="dept" value="{{ $dept['dept_name'] }}" readonly>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label for="exampleInputEmail1">Designation</label>
                        <input type="text" name="des" id="des" class="form-control"value="{{ $designation['name'] }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6 pr-1">
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control" name="firstname" id="firstname" value="{{ $data['firstname'] }}" placeholder="" readonly>
                      </div>
                    </div>
                    <div class="col-md-6 pl-1">
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control" name="middlename" id="middlename" placeholder="Last Name" value="{{ $data['middlename'] }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control"  name="village_id" id="village_id" placeholder="City" value="{{ $citydata['village_name'] }}" readonly>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Taluka</label>
                        <input type="text" name="taluka_id" id="taluka_id" class="form-control" placeholder="Taluka" value="{{ $talukadata['taluka_name'] }}" readonly>
                      </div>
                    </div>
                    <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>District</label>
                        <input type="text" name="dist_id" id="dist_id" class="form-control" value="{{ $distdata['district_name'] }}" readonly>
                      </div>
                    </div>

                  </div>
                  <div class="row">
                     <div class="col-md-4 pr-1">
                      <div class="form-group">
                        <label>State</label>
                        <input type="text" name="state_id" id="state_id" class="form-control"  value="{{ $statedata['state_name'] }}" readonly>
                      </div>
                    </div>
                    <div class="col-md-4 px-1">
                      <div class="form-group">
                        <label>Age</label>
                        <input type="text" name="age" id="age" class="form-control"  value="{{ $data['age'] }}" readonly>
                      </div>
                    </div>
                     <div class="col-md-4 pl-1">
                      <div class="form-group">
                        <label>BirthDate</label>
                        <input type="text" name="dob" id="dob" class="form-control" value="{{ $data['dob'] }}" readonly>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="update ml-auto mr-auto">
                      <a href="{{route('editemp', $data->hash_id) }}"><button type="button" class="btn btn-primary btn-round">Update Profile</button></a>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
@endsection
