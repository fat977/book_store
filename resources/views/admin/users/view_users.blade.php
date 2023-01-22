@extends('admin.layout.layout')
@section('body')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">     
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="font-weight-normal">Users  Details</h4>
                        <a href="{{ url('admin/users') }}" class="btn btn-primary">Back</a>
                        @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success :</strong> {{Session::get('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="users">
                            <thead>
                                <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>City</th>
                                <th>State</th>
                                <th>Country</th>
                                <th>Zip Code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $users['name']}} </td>
                                    <td>{{ $users['email'] }} </td>
                                    <td>{{ $users['mobile'] }} </td>
                                    <td>{{ $users['address'] }} </td>
                                    <td>{{ $users['city'] }} </td>
                                    <td>{{ $users['state'] }} </td>
                                    <td>{{ $users['country'] }}</td> 
                                    <td>{{ $users['pincode'] }}</td> 
                                    {{-- <td>
                                        @if ($user['status']==1)
                                            <a class="updateuserStatus" 
                                            href="javascript:void(0)"
                                            id="user-{{$user['id']}}"
                                            user_id="{{ $user['id']}}">
                                                <i style="font-size: 20px" class="fas fa-usermark" status="active"></i>
                                            </a>
                                        @else
                                            <a class="updateuserStatus" 
                                            href="javascript:void(0)"
                                            id="user-{{$user['id']}}"
                                            user_id="{{ $user['id']}}">                                          
                                                <i style="font-size: 20px"  status="inactive" class="far fa-usermark"></i> 
                                            </a>
                                        @endif
                                    </td> --}}
                                 
                                </tr>
                            
                            </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>   
        </div>
    </div>
</div>
@endsection