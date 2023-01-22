
@extends('admin.layout.layout')
@section('body')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
    
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card p-5">
          <div class="card-body">
            <h4 class="font-weight-bold">Categories</h4>
            <a href="{{url('admin/add-edit-category')}}" class="btn btn-block btn-primary">Add Category</a>
            
            @if (Session::has('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success :</strong> {{Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <div class="table-responsive pt-3">
              <table class="table table-bordered" id="categories">
                <thead>
                  <tr>
                    <th>
                      Category Id
                    </th>
                    <th>
                      Name
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
                  @foreach ($categories as $category)
                  <tr>
                      <td>{{ $category['id']}} </td>
                      <td>{{ $category['category_name']}} </td>
                      <td>
                          @if ($category['status']==1)
                             <a class="updateCategoryStatus" 
                             href="javascript:void(0)"
                             id="category-{{$category['id']}}"
                             category_id="{{ $category['id']}}"
                             >
                              <i style="font-size: 20px" class="fas fa-bookmark" status="active"></i>
                            </a>
                          @else
                            <a class="updateCategoryStatus" 
                             href="javascript:void(0)"
                             id="category-{{$category['id']}}"
                             category_id="{{ $category['id']}}"
                            >
                             <i style="font-size: 20px"  status="inactive" class="far fa-bookmark"></i> 
                            </a>
                          @endif
                       </td>
                      <td>
                          <a  href="{{ url('admin/add-edit-category/'.$category['id']) }}"><i style="font-size: 20px" class="fas fa-user-edit"></i></a>
                          <a href="javascript:void(0)" class="confirmDelete" module="category" moduleid="{{ $category['id'] }}"><i style="color:red" class="fas fa-trash-alt"></i></a>

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