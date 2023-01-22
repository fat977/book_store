@extends('front.layout.layout')
@section('title',$title)
@section('content')
<?php
use App\Models\Category;
use App\Models\Book;
$getCategories = Category::categories();
?>
<section>
    <div class="col-sm-12 padding-right">
        <h2 class="title text-center" style="padding-top: 50px">
            {{$title}}   
       </h2>
            @foreach ($category_books as $book)   
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
                                <h5>{{ $book['book_name'] }}</h5>
                                @php
                                    $getDiscountPrice = Book::getDiscountPrice($book['id']);
                                @endphp
                                @if ($getDiscountPrice > 0)
                                    <div class="price-template">
                                        <div class="item-new-price">
                                           ${{ $getDiscountPrice }}
                                        </div>                                         
                                        <div class="item-old-price">
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
                            </div>
                           {{--  <div class="product-overlay">
                                <div class="overlay-content">
                                    <p>{{ $book['book_name'] }}</p>
                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            @endforeach
      
       
    </div>   
</section>

@endsection