<?php use App\Models\Book ; ?>
@extends('front.layout.layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Wishlist</li>
            </ol>
            <p id="cart-success"></p>
            <p id="cart-error"></p>
        </div>
        <div class="table-responsive cart_info WishlistItems">
            <table class="table table-condensed ">
                @if (count($wishlist) > 0)
                    <thead>
                        {{-- <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="price">Quantity</td>
                            <td class="price">Action</td>
                        </tr> --}}
                    </thead>
                    <tbody>
                        @foreach ($wishlist as $item)
                        <tr class="book_data">
                            <td class="cart_produc">
                                <a href=""><img src="{{ asset('assets/admin/img/books/'.$item['books']['book_image']) }}" style="width: 60px; height:70px" alt=""></a>
                            </td>
                            <td class="cart_descriptio col-md-2">
                                <h4><a href="">{{ $item['books']['book_name'] }}</a></h4>
                            </td>
                            <td class="cart_pric">
                                @php
                                $getFinalPrice = Book::getFinalPrice($item['books']['id']);
                                @endphp
                                @if ($getFinalPrice['discount'] > 0)
                                <div class="price-template">
                                    <div>
                                        <span class="new-price">
                                            ${{ $getFinalPrice['final_price'] }}
                                        </span> 
                                    </div>
                                    
                                </div>
                                @else
                                    <div class="price-template">
                                        <div class="price">
                                        ${{ $getFinalPrice['final_price'] }}
                                        </div>                                         
                                    </div>
                                @endif
                            </td>
                            <td class="cart_quantiy col-sm-4">
                                @if ($item['books']['stock']>=2)
                                    <input type="hidden" value="{{ $item['books']['id'] }}" class="book_id">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up" href=""> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                                        <a class="cart_quantity_down" href=""> - </a>    
                                        <span id="quantity_error" style="color: red"></span>                                
                                    </div>
                                @endif

                                @if ($item['books']['stock']<2 && !empty($item['books']['stock']))
                                    <input type="hidden" value="{{ $item['books']['id'] }}" class="book_id">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up_1" href=""> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2" required>
                                        <a class="cart_quantity_down" href=""> - </a>
                                        <span id="quantity_error" style="color: red"></span>
                                    </div> 
                                @endif

                                @if (empty($item['books']['stock']))
                                    <span class="text-danger">Out of stock</span>
                                @endif           
                            </td>
                            <td class="">
                                <a class="addToCart btn btn-success" href=""><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            </td>
                            <td class="">
                                <a class="btn btn-danger remove_item" href="">Remove</a>
                            </td>
                        </tr>
                        @endforeach
                                       
                    </tbody>
                @else
                    <h4 class="text-center">There is no items to show in your wishlist</h4>
                    <a href="{{ url('all-books') }}" style="margin-left: 500px" class="btn btn-primary">Browse Books</a>
                @endif              
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

@endsection