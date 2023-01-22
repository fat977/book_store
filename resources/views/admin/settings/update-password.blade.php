@extends('admin.layout.layout') 
@section('body')
<div class="main-panel">
    <div class="content-wrapper">
      <div class="row">
        <div class="col-md-12 grid-margin">
          <div class="row">
            <div class="col-12 col-xl-8 mb-4 mb-xl-0">
              <h3 class="font-weight-bold">Settings</h3>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Update Admin Password </h4>

              @if (Session::has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong>Error :</strong> {{Session::get('error')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif

              @if (Session::has('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success :</strong> {{Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
             
              <form class="forms-sample"  method="POST"
              name="updateAdminPasswordForm" id="updateAdminPasswordForm">
              @csrf
                <div class="form-group">
                  <label>Email Address</label>
                  <input class="form-control" value="{{ $adminDetails['email']}}" readonly>
                </div>
                <div class="form-group">
                  <label for="current_password">Current Password</label>
                  <input type="password" class="form-control" id="current_password" 
                  placeholder="Enter Current Password" name="current_password" required>
                  <span id="check_password"></span>
                </div>
                <div class="form-group">
                    <label for="new_password">New Password</label>
                    <input type="password" class="form-control" id="new_password"
                     placeholder="Enter New Password" name="new_password" >
                     @error('new_password')
                        <small class="form-text text-danger">{{$message}} </small>
                     @enderror
                </div>
                <div class="form-group">
                  <label for="confirm_password">Confirm Password</label>
                  <input type="password" class="form-control" id="confirm_password" placeholder="Confirm Password"
                  name="confirm_password" >
                  @error('confirm_password')
                      <small class="form-text text-danger">{{$message}} </small>
                  @enderror
                </div>
               
                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button  type="reset" class="btn btn-light">Cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
@endsection