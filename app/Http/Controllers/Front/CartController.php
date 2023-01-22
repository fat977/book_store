<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    //
    public function cart(){
        $getCartItems = Cart::where('user_id',Auth::id())->get();
        return view('front.cart.cart',compact('getCartItems'));
    }
    
    public function addToCart(Request $request){
        $book_id = $request->input('book_id');
        $book_qty = $request->input('book_qty');
          

        if(Auth::check()){
            $book_check = Book::where('id',$book_id)->first();
            if($book_check){
                if(Cart::where('book_id',$book_id)->where('user_id',Auth::id())->exists()){
                    return response()->json(['type'=>'error','message'=>$book_check->book_name.' '.'Already added to cart']);
                  /*   return redirect()->back()->with(['success_message' => $book_check->book_name.' '. 'already has been added in Cart
                    <a style="text-decoration:underline" href="/cart"> View Cart </a>']); */
                }else{
                    $cartItem = new Cart();
                    $cartItem->book_id =$book_id;
                    $cartItem->user_id =Auth::id();
                    $cartItem->quantity =$book_qty;
                    $cartItem->save();
                    return response()->json(['type'=>'success','message'=>$book_check->book_name.' '.'Added successfully to cart']);
                    /* return redirect()->back()->with(['success_message' => $book_check->book_name.' '.'has been added in Cart
                    <a style="text-decoration:underline" href="/cart"> View Cart </a>']); */
                }  
                if($book_qty>2) {
                    return response()->json(['type'=>'error','message'=>'quantity must be 2 or less']);
                }       
            }
        }else{
            return response()->json(['type'=>'error','message'=>'Login to continue']);
        }

    }

    public function deleteCartItem(Request $request){
            if(Auth::check()){
                $book_id = $request->input('book_id');
                if(Cart::where('book_id',$book_id)->where('user_id',Auth::id())->exists()){
                    $cartItem = Cart::where('book_id',$book_id)->where('user_id',Auth::id())->first();
                    $cartItem->delete();
                    return response()->json(['status'=>'Book is deleted successfully']);
                }
            }else{
                return response()->json(['status'=>'Login to continue']);
            }
        

    }

    public function updateCartItem(Request $request){
        if($request->ajax()){

        $book_id = $request->input('book_id');
        $book_qty = $request->input('book_qty');
        if(Auth::check()){
            if(Cart::where('book_id',$book_id)->where('user_id',Auth::id())->exists()){
                $cart = Cart::where('book_id',$book_id)->where('user_id',Auth::id())->first();
                $cart->quantity=$book_qty;
                $cart->update();
                return response()->json(['status'=>'Book quantity is updated successfully']);
            }
        }else{
            return response()->json(['status'=>'Login to continue']);
        }
    }

    }

    public function cartCount(){
   
        $cartCount = Cart::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$cartCount]);
        
    }
}
