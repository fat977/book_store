
@extends('admin.layout.layout')
@section('body')

<div class="content-wrapper">
    <div class="main-panel">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="font-weight-bold">Authors</h4>
                        <a href="{{url('admin/add-edit-author')}}" class="btn btn-block btn-primary">Add Author</a>
                        @if (Session::has('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>Success :</strong> {{Session::get('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        @endif
                        <div class="table-responsive pt-3">
                            <table class="table table-bordered" id="authors">
                            <thead>
                                <tr>
                                    <th>
                                        Author Id
                                    </th>
                                    <th>
                                        Author Name
                                    </th>
                                    <th>
                                        Image
                                    </th>
                                    <th>
                                        Category Name
                                    </th>
                                    <th>
                                        Bio 
                                    </th>
                                    <th>
                                        Status
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($authors as $author)
                            <tr>
                                <td>{{ $author['id']}} </td>
                                <td>{{ $author['name']}} </td>
                                <td>
                                    @if (!empty($author['image']))
                                        <img style="width: 70px; height: 70px;" src="{{ asset('assets/admin/img/authors/'.$author['image']) }}">
                                    @else
                                        <img style="width: 70px; height: 70px;" src="{{ asset('assets/admin/img/no-img.png') }}">
                                    @endif
                                </td>
                                <td>{{ $author['categories']['category_name']}} </td>
                                <td>{{ $author['bio']}} </td>
                                <td>
                                    @if ($author['status']==1)
                                        <a class="updateAuthorStatus" 
                                            href="javascript:void(0)"
                                            id="author-{{$author['id']}}"
                                            author_id="{{ $author['id']}}">
                                            <i style="font-size: 20px" class="fas fa-bookmark" status="active"></i>
                                        </a>
                                    @else
                                        <a class="updateAuthorStatus" 
                                            href="javascript:void(0)"
                                            id="author-{{$author['id']}}"
                                            author_id="{{ $author['id']}}">
                                            <i style="font-size: 20px"  status="inactive" class="far fa-bookmark"></i> 
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a  href="{{ url('admin/add-edit-author/'.$author['id']) }}"><i style="font-size: 20px" class="fas fa-user-edit"></i></a>
                                    <?php /*<a title="author" class="confirmDelete" href="{{ url('admin/delete-author/'.$author['id']) }}"><i style="font-size: 25px" class="mdi mdi-file-excel-box"></i></a>*/?>
                                    <a href="javascript:void(0)" class="confirmDelete" module="author" moduleid="{{ $author['id']}}"><i  style="font-size: 20px; color:red" class="fas fa-trash-alt"></i></a>

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