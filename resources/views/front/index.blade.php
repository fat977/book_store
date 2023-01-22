@extends('front.layout.layout')
@section('title','Home')
@section('content')
<?php
use App\Models\Book;
$getBooks = Book::books();
?>
<section id="slider">
    @if (Session::has('success_message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Success :</strong> {{Session::get('success_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (Session::has('error_message'))
        <div class="alert alert-danger alert-dismissible text-danger text-center" role="alert">
            <strong>error :</strong> {{Session::get('error_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    <div class="container mt-5">
          
{{--    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">       
            <div class="carousel-inner">
                @foreach ($sliderBanners as $key => $banner)
                    <div class="carousel-item {{ $key == 0 ? 'active' : ''}}">
                        <a @if (!empty($banner['link']))
                            href="{{ url($banner['link']) }}"
                            @else
                                href="javascript:;"
                            @endif>
                            <img  src="{{ asset('assets/front/images/banners/'.$banner['image']) }}" class="d-block w-100" title="{{ $banner['title'] }}" alt="{{ $banner['alt'] }}" />                                   
                        </a>
                        <div class="carousel-caption d-none d-md-block">
                            <h1>Book Store</h1>
                            <h3 style=" margin-left: 15px;">{{ $banner['title'] }}</h3>
                        </div>
                    </div>
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div> --}}
        <div class="row">
                <div class="owl-carousel owl-theme banner-carousel">
                    @foreach ($sliderBanners as $banner)
                    <div class="carousel-item">
                        <a @if (!empty($banner['link']))
                            href="{{ url($banner['link']) }}"
                            @else
                                href="javascript:;"
                            @endif>
                            <img  src="{{ asset('assets/front/images/banners/'.$banner['image']) }}" class="img-responsive" title="{{ $banner['title'] }}" alt="{{ $banner['alt'] }}" />                                   
                        </a>
                        
                        <div class="centered">
                            <h1>Book Store</h1>
                            <h3 style=" margin-left: 15px;">{{ $banner['title'] }}</h3>
                        </div>
                    </div>
                    @endforeach
                </div>             
        </div>
    </div>
</section>

<div class="container">
    <div class="row">
        <section>
            <div class="col-sm-12 padding-right">
                <div class="category-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs justify-content-center">
                            <li class="active"><a href="#tshirt" data-toggle="tab">New Arrivals</a></li>
                            <li><a href="#blazers" data-toggle="tab">Best Sellers</a></li>
                            <li><a href="#sunglass" data-toggle="tab">Discounted Books</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="tshirt" >
                            @foreach ($newBooks as $book)
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                @if (!empty($book['book_image']))
                                                    <a href="{{ url('book/'.$book['id']) }}"><img style="width: 100%; height:350px;" src="{{ asset('assets/admin/img/books/'.$book['book_image']) }}" alt="" /></a>
                                                @else
                                                    <a href="{{ url('book/'.$book['id']) }}"><img style="width: 100%; height:350px;" src="{{ asset('assets/admin/img/books/no-img.png') }}" alt="" /></a>
                                                @endif
                                                <h4>{{ $book['authors']['name'] }}</h4>
                                                <h5>
                                                    {{ $book['book_name'] }}
                                                </h5>
                                                @php
                                                    $getDiscountPrice = Book::getDiscountPrice($book['id']);
                                                @endphp
                                                @if ($getDiscountPrice > 0)
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                           ${{ $getDiscountPrice }}
                                                        </div>                                         
                                                        <div class="item-old-price" style="text-decoration: line-through; color:red;">
                                                           ${{ $book['book_price'] }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price-template">
                                                        <div class="item-price">
                                                           ${{ $book['book_price'] }}
                                                        </div>                                         
                                                    </div>
                                                @endif
                                                <br>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="tab-pane fade" id="blazers" >
                            @foreach ($bestSellers as $book)
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                @if (!empty($book['book_image']))
                                                    <a href="{{ url('book/'.$book['id']) }}"><img style="width: 100%; height:350px;" src="{{ asset('assets/admin/img/books/'.$book['book_image']) }}" alt="" /></a>
                                                @else
                                                    <a href="{{ url('book/'.$book['id']) }}"><img style="width: 100%; height:350px;" src="{{ asset('assets/admin/img/books/no-image') }}" alt="" /></a>
                                                @endif
                                                <h4>{{ $book['authors']['name'] }}</h4>
                                                <h5> {{ $book['book_name'] }} </h5>
                                                @php
                                                $getDiscountPrice = Book::getDiscountPrice($book['id']);
                                                @endphp
                                                @if ($getDiscountPrice > 0)
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                           ${{ $getDiscountPrice }}
                                                        </div>                                         
                                                        <div class="item-old-price" style="text-decoration: line-through; color:red;">
                                                           ${{ $book['book_price'] }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price-template">
                                                        <div class="item-price">
                                                           ${{ $book['book_price'] }}
                                                        </div>                                         
                                                    </div>
                                                @endif
                                                <br>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="tab-pane fade" id="sunglass" >
                            @foreach ($discounted as $book)
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                @if (!empty($book['book_image']))
                                                    <a href="{{ url('book/'.$book['id']) }}"><img style="width: 100%; height:350px;" src="{{ asset('assets/admin/img/books/'.$book['book_image']) }}" alt="" /></a>
                                                @else
                                                    <a href="{{ url('book/'.$book['id']) }}"><img style="width: 100%; height:350px;" src="{{ asset('assets/admin/img/books/no-image') }}" alt="" /></a>
                                                @endif
                                                <h4>{{ $book['authors']['name'] }}</h4>
                                                <h5> {{ $book['book_name'] }} </h5>
                                                @php
                                                    $getDiscountPrice = Book::getDiscountPrice($book['id']);
                                                @endphp
                                                @if ($getDiscountPrice > 0)
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                        ${{ $getDiscountPrice }}
                                                        </div>                                         
                                                        <div class="item-old-price" style="text-decoration: line-through; color:red;">
                                                        ${{ $book['book_price'] }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price-template text-center">
                                                        <div class="item-price">
                                                        ${{ $book['book_price'] }}
                                                        </div>                                         
                                                    </div>
                                                @endif
                                                <br>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                             @endforeach
                        </div>
                    </div>
                </div><!--/category-tab-->
                 
            </div>
             
        </section>
    </div>
</div>

@endsection 