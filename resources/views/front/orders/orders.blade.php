<?php use App\Models\Book ; ?>
@extends('front.layout.layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Orders</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Tracking No</td>
                        <td class="price">Total Price</td>
                        <td class="price">Status</td>
                        <td class="total">Action</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                   @foreach ($orders as $item)
                       <tr>
                            <td>{{ $item['tracking_no'] }}</td>
                            <td>{{ $item['total_price'] }}</td>
                            <td>{{ $item['status']=='0' ? 'pending' : 'completed' }}</td>
                            <td><a href="{{ url('view-orders/'.$item['id']) }}" class="btn btn-primary">View</a></td>
                       </tr>   
                   @endforeach
                </tbody>
               
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->

@endsection