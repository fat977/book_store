@extends('admin.layout.layout')
@section('body')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h3 class="font-weight-bold">Banner Management</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{$title}}</h4>

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

                        <form class="forms-sample"  method="POST" @if (empty($banner['id']))
                            action="{{url('admin/add-edit-banner')}}" 
                            @else
                                action="{{url('admin/add-edit-banner/'.$banner['id'])}}" 
                            @endif
                            enctype="multipart/form-data"> 
                            @csrf
                                           
                            <div class="form-group">
                                <label for="image">Banner Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                @if (!empty($banner['image']))
                                <a target="_blank" href="{{ url('assets/front/images/banners/'.$banner['image']) }}">View Image </a> &nbsp;| &nbsp;
                                <a href="javascript:void(0)" class="confirmDelete" module="banner-image" moduleid="{{$banner['id']}}">Delete Image</a> </a>
                                @endif
                                @error('image')
                                    <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="link">Banner Link</label>
                                <input type="text" class="form-control" id="link" 
                                     placeholder="Enter banner Name" name="link"
                                @if (!empty($banner['link']))
                                    value="{{ $banner['link'] }}" 
                                @else
                                    value="{{ old('link') }}" 
                                @endif>
            
                                @error('link')
                                    <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>
        
                            <div class="form-group">
                                <label for="title ">Banner Title</label>
                                <input type="text" class="form-control" id="title" 
                                    placeholder="Enter Banner Title" name="title"
                                @if (!empty($banner['title']))
                                    value="{{ $banner['title'] }}" 
                                @else
                                    value="{{ old('title') }}" 
                                @endif>
            
                                @error('title')
                                    <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="alt">Banner ALT</label>
                                <input type="text" class="form-control" id="alt" 
                                    placeholder="Enter Banner ALT" name="alt"
                                @if (!empty($banner['alt']))
                                    value="{{ $banner['alt'] }}" 
                                @else
                                    value="{{ old('alt') }}" 
                                @endif>
            
                                @error('alt')
                                    <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>
                        
                            <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            <button type="reset" class="btn btn-light">Cancel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection