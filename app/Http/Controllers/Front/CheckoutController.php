<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    //
    public function checkout(){
        $oldCartItems = Cart::with('books')->where('user_id',Auth::id())->get();
        foreach($oldCartItems as $item){
            if(!Book::where('id',$item['book_id'])->where('stock','>=',$item['quantity'])->exists()){
                $removeItem = Cart::where('user_id',Auth::id())->where('user_id',$item['user_id'])->first();
                $removeItem->delete();
                $book = Book::where('stock',$item['quantity'])->first();
                $book->stock=0;
                $book->update();      
            }            
        }
        $cartItems = Cart::where('user_id',Auth::id())->get();
        return view('front.checkout.checkout',compact('cartItems'));
    }

    public function placeOrder(Request $request){

        $order = new Order();
        $order->user_id =Auth::id();
        $order->name =$request->input('name');
        $order->email =$request->input('email');
        $order->mobile =$request->input('mobile');
        $order->address =$request->input('address');
        $order->city =$request->input('city');
        $order->state =$request->input('state');
        $order->country =$request->input('country');
        $order->pincode =$request->input('pincode');
        $order->payment_mode =$request->input('payment_mode');
        $order->payment_id =$request->input('payment_id');

        // calculate price
        $total =0;
        $cartItems_totals = Cart::where('user_id',Auth::id())->get();
        foreach($cartItems_totals as $item){
            if($item['books']['book_discount']>0){
                $total += ($item['books']['book_price'] - ($item['books']['book_price']*$item['books']['book_discount']/100))*($item->quantity);
            }else{
                $total += $item->books->book_price * $item->quantity;
            }
            
        }
        $order->total_price = $total;
        $order->tracking_no =  $order->name.rand(1111,9999);
        $order->save();

        

        $cartItems = Cart::where('user_id',Auth::id())->get();
        foreach($cartItems as $item){
            OrderItem::create([
                'order_id'=> $order->id,
                'book_id'=> $item->book_id,
                'quantity' => $item->quantity,
                'price'=> $item->books->book_price
            ]);
            $book = Book::where('id',$item['book_id'])->first();
            $book->stock=$book->stock - $item['quantity'];
            $book->update();  

        }

        if(Auth::user()->address == null){
            $user = User::where('id',Auth::id())->first();
            $user->name =$request->input('name');
            //$user->email =$request->input('email');
            $user->mobile =$request->input('mobile');
            $user->address =$request->input('address');
            $user->city =$request->input('city');
            $user->state =$request->input('state');
            $user->country =$request->input('country');
            $user->pincode =$request->input('pincode');
            $user->update();
        }
        $cartItems = Cart::where('user_id',Auth::id())->get();
        Cart::destroy($cartItems);

        if($request->input('payment_mode')=='paid by paypal'){
            return response()->json(['status'=>'ordered placed successfully']);
        }

        return redirect('my-orders')->with(['success_message'=>'ordered placed successfully']);
    }
}
