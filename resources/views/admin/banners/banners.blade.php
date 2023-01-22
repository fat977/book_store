@extends('admin.layout.layout')
@section('body')

<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">     
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h3 class="font-weight-bold">Banners Management</h3>
                        <a href="{{url('admin/add-edit-banner')}}" class="btn btn-block btn-primary">Add Home Page Banner</a>
                        @if (Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success :</strong> {{Session::get('success')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="banners">
                                <thead>
                                    <tr>
                                    <th>Id</th>
                                    <th>Image</th>
                                    <th>Link</th>
                                    <th>Title</th>
                                    <th>Alt</th>
                                    <th> Status </th>
                                    <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>  
                                    <tr>
                                        @foreach ($banners as $banner)
                                            
                                        <td>{{ $banner['id']}} </td>
                                        <td><img style="width: 100px; height: 70px;" src="{{ asset('assets/front/images/banners/'.$banner['image']) }}">
                                        <td> {{ $banner['link']}} </td>
                                        <td>{{ $banner['title']}}</td>
                                        <td>{{ $banner['alt']}} </td>
                                        <td>
                                            @if ($banner['status']==1)
                                                <a class="updateBannerStatus" 
                                                href="javascript:void(0)"
                                                id="banner-{{$banner['id']}}"
                                                banner_id="{{ $banner['id']}}"
                                                >
                                                <i style="font-size: 20px" class="fas fa-bookmark" status="active"></i>
                                                </a>
                                            @else
                                                <a class="updateBannerStatus" 
                                                href="javascript:void(0)"
                                                id="banner-{{$banner['id']}}"
                                                banner_id="{{ $banner['id']}}"
                                                >
                                                <i style="font-size: 20px"  status="inactive" class="far fa-bookmark"></i> 
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            <a  href="{{ url('admin/add-edit-banner/'.$banner['id']) }}"><i style="font-size: 20px" class="fas fa-user-edit"></i></a>
                                            <a href="javascript:void(0)" class="confirmDelete" module="banner" moduleid="{{ $banner['id']}}"><i style="font-size: 20px; color:red" class="fas fa-trash-alt"></i></a>

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