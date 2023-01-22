@extends('admin.layout.layout')
@section('body')
<div class="container-xxl">
    <div class="main-panel p-5">
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
                  <h4 class="card-title">Update Admin Details </h4>
    
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
                  name="updateAdminPasswordForm" id="updateAdminPasswordForm" enctype="multipart/form-data">
                  @csrf
                    <div class="form-group">
                      <label>Email Address</label>
                      <input class="form-control" value="{{ $adminDetails['email']}}" readonly>
                    </div>
                    <div class="form-group">
                        <label>Password </label>
                        <input class="form-control" value="{{ $adminDetails['password']}}" readonly>
                        <a href="{{ route('update-password') }}"> Change Password </a>
                      </div>
                    <div class="form-group">
                      <label for="name">Name</label>
                      <input type="text" class="form-control" id="name" 
                      placeholder="Enter Admin Name" name="name" value="{{ $adminDetails['name']}}">
       
                        @error('name')
                          <small class="form-text text-danger">{{$message}} </small>
                       @enderror
                    </div>
    
    
                    <div class="form-group">
                        <label for="mobile">Mobile Phone</label>
                        <input type="number" class="form-control" id="mobile"
                         placeholder="Enter Mobile Phone" name="mobile" value="{{ $adminDetails['mobile']}}" required>
                         @error('mobile')
                         <small class="form-text text-danger">{{$message}} </small>
                        @enderror
                    </div>
    
                    <div class="form-group">
                        <label for="image"> Image (Recommended size : 1000x1000)</label><br>
                        <img style="width: 100px; height:100px" src="{{asset('assets/admin/img/'.$adminDetails['image']) }}">
                        <input type="file" class="form-control" id="image" name="image">
                        @if (!empty($adminDetails['image']))
                            <a target="_blank" href="{{ url('assets/admin/img/'.$adminDetails['image']) }}">View Image </a> &nbsp;| &nbsp;
                            <a href="javascript:void(0)" class="confirmDelete" module="admin-image" moduleid="{{$adminDetails['id']}}">Delete Image</a>
                        @endif
                        @error('image')
                          <small class="form-text text-danger">{{$message}} </small>
                        @enderror
                    </div>
    
                 {{--     <div class="form-group">
                        <label for="image"> Image (Recommended size : 1000x1000)</label>
                        <br>
                        @if (!empty($adminDetails['image']))
                            <img  style="width:100px; height:100px" src="{{ asset('assets/admin/img/'.$adminDetails['image']) }}"> &nbsp;
                        @endif
                        <a target="_blank" href="{{ url('assets/admin/img/'.$adminDetails['image']) }}">View Image </a> &nbsp;| &nbsp;
                        <a href="{{ route('update-image') }}">Update Image </a> &nbsp;| &nbsp;
                        <a href="javascript:void(0)" class="confirmDelete" module="admin-image" moduleid="{{$adminDetails['id']}}">Delete Image</a>
                    </div> --}}
                    
                   
                    <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    <button type="reset" class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>
</div>
@endsection