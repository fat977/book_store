<?php use App\Models\Book ; ?>
@extends('admin.layout.layout')
@section('body')

<div class="main-panel">
  <div class="content-wrapper">
    <div class="row">
    
      <div class="col-lg-12 grid-margin stretch-card">
        <div class="card p-5">
          <div class="card-body">
            <h4 class="font-weight-bold">Show Orders</h4>
            <a href="{{url('admin/orders')}}" class="btn btn-block btn-primary">Back</a>
            
            @if (Session::has('success'))
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success :</strong> {{Session::get('success')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
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
                                <td><img style="width: 60px; height:70px" src="{{ asset('assets/admin/img/books/'.$item['books']['book_image']) }}" alt=""></td>
                           </tr>   
                       @endforeach
                      
    
                    </tbody>
                   
                </table>
            </div>
            <h4>Total : {{ $orders->total_price }} </h4>
    
            <div class="table-responsive mb-5 cart_info">
               <div class="row">
                    <div class="col-md-12">
                        <label for="name">Name</label>
                        <div class="border p-2">{{ $orders->name }}</div>
                        <label for="email">email</label>
                        <div class="border p-2">{{ $orders['email'] }}</div>
                        <label for="mobile">mobile</label>
                        <div class="border p-2">{{ $orders['mobile'] }}</div>
                        <label for="shipping">Shipping Address</label>
                        <div class="border p-2">
                            {{ $orders['address'] }}
                            {{ $orders['city'] }}
                            {{ $orders['state'] }}
                            {{ $orders['country'] }}
                        </div>
                        <label for="pincode">Zip Code</label>
                        <div class="border p-2">{{ $orders['pincode'] }}</div>
                    </div>
               </div>
            </div>
            <label for="">Order Status</label>
            <form action="{{ url('admin/update-orders/'.$orders['id']) }}" method="POST">
                @csrf
                <select class="form-select" name="order_status">
                    <option {{ $orders->status == '0'?'selected':''}} value="0">Pending</option>
                    <option {{ $orders->status == '1'?'selected':''}} value="1">Completed</option>
                </select>
                <button type="submit" class="btn btn-primary mt-4">Update</button>
            </form>
          </div>
        </div>
      </div>

    
    </div>
  </div>
</div>
 
@endsection