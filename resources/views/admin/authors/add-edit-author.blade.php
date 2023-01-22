@extends('admin.layout.layout')
@section('body')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h6 class="font-weight-normal">Categories</h6>
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

                        <form class="forms-sample"  method="POST" 
                            @if (empty($author['id']))
                                action="{{url('admin/add-edit-author')}}" 
                            @else
                                action="{{url('admin/add-edit-author/'.$author['id'])}}" 
                            @endif
                            enctype="multipart/form-data"> 
                            @csrf
                        
                            <div class="form-group">
                                <label for="name">Author Name</label>
                                <input type="text" class="form-control" id="name" 
                                    placeholder="Enter Author Name" name="name"
                                    @if (!empty($author['name']))
                                        value="{{ $author['name'] }}" 
                                    @else
                                        value="{{ old('name') }}" 
                                    @endif>

                                @error('name')
                                <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="category_id">Select Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($getCategories as $category)
                                        <option value="{{ $category['id'] }}"
                                            @if (!empty($author['category_id'])&& $author['category_id'] == $category['id'])
                                            selected @endif>
                                            {{ $category['category_name'] }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>

                            {{-- <div class="form-group">
                                <label for="image">Author Image</label>
                                <input type="file" class="form-control" id="image" name="image">
                                @if (!empty($author['image']))
                                    <img style="width: 70px; height: 70px;" src="{{ asset('assets/admin/img/authors/'.$author['image']) }}">
                                @else
                                    <img style="width: 70px; height: 70px;" src="{{ asset('assets/admin/img/no-img.png') }}">
                                @endif
                                @error('image')
                                    <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div> --}}
                            <div class="form-group">
                                <label for="image">Author Image (Recommended size : 1000x1000)</label>
                                <input type="file" class="form-control" id="image" name="image">
                                    @if (!empty($author['image']))
                                        <a target="_blank" href="{{ url('assets/admin/img/authors/'.$author['image']) }}">View Image </a> &nbsp;| &nbsp;
                                        <a href="javascript:void(0)" class="confirmDelete" module="author-image" moduleid="{{$author['id']}}">Delete Image</a>
                                    @endif
                                @error('image')
                                    <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="bio ">Author Bio</label>
                                <input type="text" class="form-control" id="bio" 
                                    placeholder="Enter Author Bio" name="bio"
                                    @if (!empty($author['bio']))
                                        value="{{ $author['bio'] }}" 
                                    @else
                                        value="{{ old('bio') }}" 
                                    @endif>
            
                                @error('bio')
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