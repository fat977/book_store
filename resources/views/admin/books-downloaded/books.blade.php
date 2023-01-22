@extends('admin.layout.layout')
@section('body')
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">     
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="font-weight-normal">Books</h4>
                        <a href="{{url('admin/add-edit-book-downloaded')}}" class="btn btn-block btn-primary">Add Book</a>
                        @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success :</strong> {{Session::get('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="books">
                            <thead>
                                <tr>
                                <th>Book Id</th>
                                <th>Book Name</th>
                                <th>Book Image</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th> Status </th>
                                <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($books as $book)
                                <tr>
                                    <td>{{ $book['id']}} </td>
                                    <td>{{ $book['book_name']}} </td>
                                    <td>
                                        @if (!empty($book['book_image']))
                                            <img style="width: 70px; height: 70px;" src="{{ asset('assets/admin/img/books/'.$book['book_image']) }}">
                                        @else
                                            <img style="width: 70px; height: 70px;" src="{{ asset('assets/admin/img/no-img.png') }}">
                                        @endif
                                    </td>
                                    <td>{{ $book['authors']['name']}} </td>
                                    <td>
                                        @if (!empty($book['categories']['category_name']))
                                            {{ $book['categories']['category_name']}}
                                        @endif
                                    </td> 
                                    <td>
                                        @if ($book['status']==1)
                                            <a class="updateBookStatus" 
                                            href="javascript:void(0)"
                                            id="book-{{$book['id']}}"
                                            book_id="{{ $book['id']}}">
                                                <i style="font-size: 20px" class="fas fa-bookmark" status="active"></i>
                                            </a>
                                        @else
                                            <a class="updateBookStatus" 
                                            href="javascript:void(0)"
                                            id="book-{{$book['id']}}"
                                            book_id="{{ $book['id']}}">                                          
                                                <i style="font-size: 20px"  status="inactive" class="far fa-bookmark"></i> 
                                            </a>
                                        @endif
                                    </td>
                                    <td>
                                        <a  href="{{ url('admin/add-edit-book-downloaded/'.$book['id']) }}"><i style="font-size: 20px" class="fas fa-user-edit"></i></a>
                                        <a href="javascript:void(0)" class="confirmDelete" module="book" moduleid="{{ $book['id']}}"><i style="font-size: 20px; color:red" class="fas fa-trash-alt"></i></a>

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