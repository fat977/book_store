@extends('front.layout.layout')
@section('title','checkout')
@section('content')
<?php
use App\Models\Book;
?>
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active">Check out</li>
            </ol>
        </div><!--/breadcrums-->

        {{-- <div class="step-one">
            <h2 class="heading">Step1</h2>
        </div>
        <div class="checkout-options">
            <h3>New User</h3>
            <p>Checkout options</p>
            <ul class="nav">
                <li>
                    <label><input type="checkbox"> Register Account</label>
                </li>
                <li>
                    <label><input type="checkbox"> Guest Checkout</label>
                </li>
                <li>
                    <a href=""><i class="fa fa-times"></i>Cancel</a>
                </li>
            </ul>
        </div><!--/checkout-options--> --}}

        <div class="register-req">
            <p>Please use Register And Checkout to easily get access to your order history</p>
        </div><!--/register-req-->

        <div class="shopper-informations">
            <div class="row">
             {{--    <div class="col-sm-3">
                    <div class="shopper-info">
                        <p>Shopper Information</p>
                        <form>
                            <input type="text" placeholder="Display Name">
                            <input type="text" placeholder="User Name">
                            <input type="password" placeholder="Password">
                            <input type="password" placeholder="Confirm password">
                        </form>
                        <a class="btn btn-primary" href="">Get Quotes</a>
                        <a class="btn btn-primary" href="">Continue</a>
                    </div>
                </div> --}}
                <div class="col-sm-12 clearfix">
                    <div class="bill-to">
                        <p>Bill To</p>
                        <div class="form-one">
                            <form action="{{ url('place-order') }}" method="POST">
                                @csrf
                                <input type="text" class="email" value="{{ Auth::user()->email }}" name="email" placeholder="Email*">
                                <input type="text" class="name" value="{{ Auth::user()->name }}" name="name" placeholder="Name *" readonly>
                                <input type="text" class="address" value="{{ Auth::user()->address }}" name="address" placeholder="Address *">
                                <input type="text" class="pincode" value="{{ Auth::user()->pincode }}" name="pincode" placeholder="Zip / Postal Code *">
                                <label for="country">Country</label>
                                <select value="{{ Auth::user()->country }}" name="country" class="country">
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                <br><br>
                                <label for="state">State</label>
                                <select value="{{ Auth::user()->state }}" name="state" class="state">
                                    <option>United States</option>
                                    <option>Bangladesh</option>
                                    <option>UK</option>
                                    <option>India</option>
                                    <option>Pakistan</option>
                                    <option>Ucrane</option>
                                    <option>Canada</option>
                                    <option>Dubai</option>
                                </select>
                                <br><br>
                                <label for="city">City</label>
                                <input value="{{ Auth::user()->city }}" type="text" class="city" name="city" placeholder="City">
                                <input value="{{ Auth::user()->mobile }}" type="text" class="mobile" name="mobile" placeholder="Mobile Phone">
                               
                                <input type="hidden" name="payment_mode">
                                <button class="btn btn-default check_out" style="margin-left: 0px" type="submit">Place Order</button>
                                <div id="paypal-button-container"></div>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- <div class="col-sm-4">
                    <div class="order-message">
                        <p>Shipping Order</p>
                        <textarea name="message"  placeholder="Notes about your order, Special Notes for Delivery" rows="16"></textarea>
                        <label><input type="checkbox"> Shipping to bill address</label>
                    </div>	
                </div>			 --}}		
            </div>
        </div>
        <div class="review-payment">
            <h2>Review & Payment</h2>
        </div>

        <div class="table-responsive cart_info">
            <table class="table table-condensed">
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
                    @foreach ($cartItems as $item)
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
                        <td class="cart_quantity">
                            {{ $item['quantity'] }}
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">
                                ${{ $getFinalPrice['final_price'] * $item['quantity'] }} 
                            </p>
                        </td>
                       
                    </tr>
                    @php $total = $total +( $getFinalPrice['final_price'] * $item['quantity']) @endphp
                    @endforeach
                    
                    <tr>
                        <td colspan="4">&nbsp;</td>
                        <td colspan="2">
                            <table class="table table-condensed total-result">
                                <tr>
                                    <td>Cart Sub Total</td>
                                    <td> 
                                        <span>{{ $total }}</span>
                                    </td>
                                </tr>
                                <tr class="shipping-cost">
                                    <td>Shipping Cost</td>
                                    <td>Free</td>										
                                </tr>
                                <tr>
                                    @php $total = $total @endphp
                                    <td>Total</td>
                                    <td><span>{{ $total }}</span></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="payment-options">
                <span>
                    <label><input type="checkbox"> Direct Bank Transfer</label>
                </span>
                <span>
                    <label><input type="checkbox"> Check Payment</label>
                </span>
                <span>
                    <label><input type="checkbox"> Paypal</label>
                </span>
            </div>
    </div>
</section> <!--/#cart_items-->

@endsection
<script src="https://www.paypal.com/sdk/js?client-id=Ae0D4uaq5n9adE58ilMXccvYNIwkj-2opuYzLCiFKAQoClnUm8BdZ0bR4YGpRj6JIkq4x72vzv3tsmGS"> // Replace YOUR_CLIENT_ID with your sandbox client ID
</script>
<script>
    paypal.Buttons({
        onClick: function() {

            // Show a validation error if the checkbox is not checked
            if (!document.getElementByClass('#check').value) {
            document.querySelector('#error').classList.remove('hidden');
            }
        }
      // Sets up the transaction when a payment button is clicked
      createOrder: (data, actions) => {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '77.44' // Can also reference a variable or function
            }
          }]
        });
      },
      // Finalize the transaction after payer approval
      onApprove: (data, actions) => {
        return actions.order.capture().then(function(orderData) {
          // Successful capture! For dev/demo purposes:
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
          const transaction = orderData.purchase_units[0].payments.captures[0];
          alert(`Transaction ${transaction.status}: ${transaction.id}\n\nSee console for all available details`);
          // When ready to go live, remove the alert and show a success message within this page. For example:
          // const element = document.getElementById('paypal-button-container');
          // element.innerHTML = '<h3>Thank you for your payment!</h3>';
          // Or go to another URL:  actions.redirect('thank_you.html');
        });
      }
    }).render('#paypal-button-container');
</script>
   