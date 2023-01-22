<?php use App\Models\Book ; ?>
@extends('front.layout.layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Show Orders</li>
              <li><a href="{{ url('my-orders') }}">Back</a></li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Name</td>
                        <td class="price">Quantity</td>
                        <td class="price">Price</td>
                        <td class="total">image</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0; @endphp
                   @foreach ($orders['order_item'] as $item)
                       <tr>
                            <td>{{ $item['books']['book_name'] }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>
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
                            <td><a href="{{ url('book/'.$item['books']['id']) }}"><img style="width: 60px; height:70px;" src="{{ asset('assets/admin/img/books/'.$item['books']['book_image']) }}" alt="" /></a></td>

                       </tr>   
                   @endforeach
                  

                </tbody>
               
            </table>
        </div>
        <h4>Total : {{ $orders->total_price }} </h4>

        <table class="table table-borderless">
           <div class="row">
                <div class="col-sm-6">
                    <tr>
                        <td>Name</td>
                        <td>{{ $orders->name }}</td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td>{{ $orders['email'] }}</td>
                    </tr>
                    <tr>
                        <td>Mobile</td>
                        <td>{{ $orders['mobile'] }}</td>
                    </tr>
                    <tr>
                        <td>Shipping Address</td>
                        <td>{{ $orders['address'] }} / {{ $orders['city'] }} / {{ $orders['state'] }} / {{ $orders['country'] }}</td>
                    </tr>
                    <tr>
                        <td>Zip Code</td>
                        <td>{{ $orders['pincode'] }}</td>
                    </tr>
                </div>
           </div>
        </table>
    </div>
</section> <!--/#cart_items-->

@endsection