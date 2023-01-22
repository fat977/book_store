@extends('front.layout.layout')
@section('title','Books')
@section('content')
<?php
use App\Models\Book;
?>
<!-- Account-Page -->
<div class="container">
    <div class="row">
        <section>
            <h2 class="title text-center">Books</h2>
            <div class="sort_box col-sm-3 ">
                <select name="sort" class="sort" id="sort">
                    <option selected="" value="">Select</option>
                    <option value="book_oldest">Oldest Book </option>
                    <option value="book_newest">Newest Book</option>
                    <option value="price_highest">Highest Price</option>
                    <option value="price_lowest">Lowest Price</option>      
                    <option value="name_a_z">Name_A_Z</option>
                    <option value="name_z_a">Name_Z_A</option>                  
                </select>
            </div>  
            <div class="row col-sm-12 padding-right">
                <div class="features_items"><!--features_items-->
                    <div class="search_result">
                        <div class="content">
                            @foreach ($books as $book)
                                @if ($book['categories']['status']==1)
                                    <form action="" class="">
                                        <div class="col-sm-3">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <p id="cart-success"></p>
                                                        <p id="cart-error"></p>
                                                        @if (!empty($book['book_image']))
                                                            <a href="{{ url('book/'.$book['id']) }}"><img style="width: 100%; height:350px;" src="{{ asset('assets/admin/img/books/'.$book['book_image']) }}" alt="" /></a>
                                                        @else
                                                            <a href="{{ url('book/'.$book['id']) }}"><img style="width: 100%; height:350px;" href="{{ url('book/'.$book['id']) }}" src="{{ asset('assets/admin/img/books/no-img.png') }}" alt="" /></a>
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
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            @endforeach
                        </div>
                    </div> 
                             
                </div><!--features_items-->
            </div>            
        </section>
    </div>
</div>

<!-- Account-Page /- -->
@endsection
