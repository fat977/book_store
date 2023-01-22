@extends('front.layout.layout')
@section('title','categories')
@section('content')

<section>
    <div class="col-sm-12 padding-right p-5">
        <h2 class="text-center">Categories</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    @foreach ($categories as $category)
                    <h4 class="panel-title text-center" style="padding-bottom: 20px">                     
                        <a onMouseOver="this.style.color='#FE980F'" onMouseOut="this.style.color='#696763'"
                         href="{{ url('categories-books/'.$category['id']) }}">
                            <p>{{ $category['category_name'] }} <span>({{ $category->books()->count() }})</span></p>

                        </a>
                    </h4>
                       
                    @endforeach
                </div>
            </div>
        </div><!--/category-products-->
    </div>   
</section>

@endsection