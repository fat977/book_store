@extends('admin.layout.layout')
@section('body')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">     
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="font-weight-normal">Users</h4>
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
                                <th> Id</th>
                                <th> Name</th>
                                <th> Email</th>
                                <th>Phone</th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user['id']}} </td>
                                    <td>{{ $user['name']}} </td>
                                    <td>{{ $user['email'] }} </td>
                                    <td>{{ $user['mobile'] }}
                                    </td> 
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
                                    <td>
                                        <a  href="{{ url('admin/view-users/'.$user['id']) }}">View</a>
                                    </td>
                                </tr>
                                @endforeach
                            
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