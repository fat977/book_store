@extends('admin.layout.layout')
@section('body')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin">
                <div class="row">
                    <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                        <h4 class="font-weight-normal">Products</h4>
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

                        <form class="forms-sample"  method="POST" @if (empty($book['id']))
                                action="{{url('admin/add-edit-book-downloaded')}}" 
                            @else
                                action="{{url('admin/add-edit-book-downloaded/'.$book['id'])}}" 
                            @endif
                            enctype="multipart/form-data"> 
                            @csrf
                        
                            <div class="form-group">
                                <label for="category_id">Select Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($categories as $category)
                                        <option @if (!empty($book['category_id']==$category['id']))
                                            selected
                                        @endif
                                         value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="author_id">Select Author</label>
                                <select name="author_id" id="author_id" class="form-control">
                                    <option value="">Select</option>
                                    @foreach ($authors as $author)
                                        <option @if (!empty($book['author_id']==$author['id']))
                                            selected
                                        @endif
                                         value="{{ $author['id'] }}">{{ $author['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('author_id')
                                    <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>
                        
                            <div class="form-group">
                                <label for="book_name">Book Name</label>
                                <input type="text" class="form-control" id="book_name" 
                                    placeholder="Enter book Name" name="book_name"
                                    @if (!empty($book['book_name']))
                                        value="{{ $book['book_name'] }}" 
                                    @else
                                        value="{{ old('book_name') }}" 
                                    @endif>
                                @error('book_name')
                                <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="language">Language</label>
                                <input type="text" class="form-control" id="language" 
                                    placeholder="Enter book Price" name="language"
                                    @if (!empty($book['language']))
                                        value="{{ $book['language'] }}" 
                                    @else
                                        value="{{ old('language') }}" 
                                    @endif>
                
                                @error('language')
                                    <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>
            
                            <div class="form-group">
                                <label for="book_image">book Image (Recommended size : 1000x1000)</label><br>
                                <br>
                                <input type="file" class="form-control" id="book_image" name="book_image">
                                @if (!empty($book['book_image']))
                                    <a target="_blank" href="{{ url('assets/admin/img/books/'.$book['book_image']) }}">View Image </a> &nbsp;| &nbsp;
                                    <a href="javascript:void(0)" class="confirmDelete" module="book-image" moduleid="{{$book['id']}}">Delete Image</a>
                                @endif
                                @error('book_image')
                                    <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="book_image">Book PDF (Recommended size : 20MB)</label><br>
                                <br>
                                <input type="file" class="form-control" id="file" name="file">
                                @if (!empty($book['file']))
                                    <a target="_blank" href="{{ url('assets/admin/downloads/'.$book['file']) }}">View File </a> &nbsp;| &nbsp;
                                    <a href="javascript:void(0)" class="confirmDelete" module="book-file" moduleid="{{$book['id']}}">Delete File</a>
                                @endif
                                @error('file')
                                    <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="description ">Book Discription</label>
                                <textarea type="text" class="form-control" id="description" 
                                placeholder="Enter Book description" name="description" rows="3">{{ $book['description'] }}</textarea>

                                @error('description')
                                <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="No_pages">No. Pages</label>
                                <input type="number" class="form-control" id="No_pages" 
                                    placeholder="Enter No_pages" name="No_pages"
                                    @if (!empty($book['No_pages']))
                                        value="{{ $book['No_pages'] }}" 
                                    @else
                                        value="{{ old('No_pages') }}" 
                                    @endif>
            
                                @error('No_pages')
                                <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="size">Size</label>
                                <input type="text" class="form-control" id="size" 
                                    placeholder="Enter Book Size" name="size"
                                    @if (!empty($book['size']))
                                        value="{{ $book['size'] }}" 
                                    @else
                                        value="{{ old('size') }}" 
                                    @endif>
                
                                @error('size')
                                <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="meta_title ">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" 
                                    placeholder="Enter Meta Title" name="meta_title"
                                    @if (!empty($book['meta_title']))
                                        value="{{ $book['meta_title'] }}" 
                                    @else
                                        value="{{ old('meta_title') }}" 
                                    @endif>
            
                                @error('meta_title')
                                <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="meta_description ">Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" 
                                placeholder="Enter Meta Description" name="meta_description"
                                    @if (!empty($book['meta_description']))
                                        value="{{ $book['meta_description'] }}" 
                                    @else
                                        value="{{ old('meta_description') }}" 
                                    @endif>
            
                                @error('meta_description')
                                <small class="form-text text-danger">{{$message}} </small>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="meta_keywords">Meta Keywords</label>
                                <input type="text" class="form-control" id="meta_keywords" 
                                    placeholder="Enter Meta Keywords" name="meta_keywords"
                                    @if (!empty($book['meta_keywords']))
                                        value="{{ $book['meta_keywords'] }}" 
                                    @else
                                        value="{{ old('meta_keywords') }}" 
                                    @endif>
            
                                @error('meta_keywords')
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