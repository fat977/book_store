<?php use App\Models\Book ; ?>
@extends('front.layout.layout')
@section('content')
 
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info CartItems Reviews">
            <span id="quantity_error" style="color: red"></span> 
            <table class="table table-condensed">
                @if (count($getCartItems) > 0)
                    <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
                            <td class="price">Price</td>
                            <td class="quantity">Quantity</td>
                            <td class="total">Total</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach ($getCartItems as $item)
                        <tr class="book_data">
                            <td class="cart_product">
                                <a href=""><img src="{{ asset('assets/admin/img/books/'.$item['books']['book_image']) }}" style="width: 60px; height:70px" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{ $item['books']['book_name'] }}</a></h4>
                            </td>
                            <td class="cart_price">
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
                            <td class="cart_quantity col-sm-4">
                                @if ($item['books']['stock']>=2)
                                    <input type="hidden" value="{{ $item['books']['id'] }}" class="book_id">
                                    <div class="cart_quantity_button">
                                        <a class="change_quantity cart_quantity_up" href=""> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="{{$item['quantity']}}" min="1" max="2" autocomplete="off" size="2">
                                        <a class="change_quantity cart_quantity_down" href=""> - </a>                                    
                                    </div>                              
                                @endif

                                @if ($item['books']['stock']<2 && !empty($item['books']['stock']))
                                    <input type="hidden" value="{{ $item['books']['id'] }}" class="book_id">
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up_1 change_quantity" href=""> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="{{$item['quantity']}}" autocomplete="off" size="2" required>
                                        <a class="cart_quantity_down change_quantity" href=""> - </a>
                                    </div>                                     
                                @endif

                                @if (empty($item['books']['stock']))
                                    <span class="text-danger">Out of stock</span>
                                @endif                      
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    ${{ $getFinalPrice['final_price'] * $item['quantity'] }} 
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @php $total = $total +( $getFinalPrice['final_price'] * $item['quantity']) @endphp
                        @endforeach
                                       
                    </tbody>
                    <section id="do_action">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="total_area">
                                        <ul>
                                            <li>Cart Sub Total
                                                 <span>
                                                    {{ $total }}
                                                 </span>
                                            </li>
                                            <li>Shipping Cost <span>Free</span></li>
                                            @php $total = $total  @endphp
                                            <li>Total <span>{{ $total }}</span></li>
                                        </ul>
                                        <a class="btn btn-default check_out" style="margin-left: 40px" href="{{ route('checkout') }}">Check Out</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!--/#do_action-->
                @else
                    <h4 class="text-center">There is no items to show</h4>
                    <a href="{{ url('all-books') }}" style="margin-left: 500px" class="btn btn-primary">Browse Books</a>
                @endif
               
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection