<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    //
    public function wishlist(){
        $wishlist = Wishlist::where('user_id',Auth::id())->get();
        return view('front.wishlist.wishlist',compact('wishlist'));
    }

    public function addToWishlist(Request $request){
        $book_id = $request->input('book_id');
          
        if(Auth::check()){
            $book_check = Book::where('id',$book_id)->first();
            if($book_check){
                if(Wishlist::where('book_id',$book_id)->where('user_id',Auth::id())->exists()){
                    return response()->json(['type'=>'error','message'=>$book_check->book_name.' '.'Already added to wishlist']);
                  /*   return redirect()->back()->with(['success_message' => $book_check->book_name.' '. 'already has been added in Cart
                    <a style="text-decoration:underline" href="/cart"> View Cart </a>']); */
                }else{
                    $wishlist = new Wishlist();
                    $wishlist->book_id =$book_id;
                    $wishlist->user_id =Auth::id();
                    $wishlist->save();
                    return response()->json(['type'=>'success','message'=>$book_check->book_name.' '.'Added successfully to Wishlist']);
                    /* return redirect()->back()->with(['success_message' => $book_check->book_name.' '.'has been added in Cart
                    <a style="text-decoration:underline" href="/cart"> View Cart </a>']); */
                }   
            }
        }else{
            return response()->json(['type'=>'error','message'=>'Login to continue']);
        }

    }

    public function deleteWishlistItem(Request $request){
        if(Auth::check()){
            $book_id = $request->input('book_id');
            if(Wishlist::where('book_id',$book_id)->where('user_id',Auth::id())->exists()){
                $wishlistItem = Wishlist::where('book_id',$book_id)->where('user_id',Auth::id())->first();
                $wishlistItem->delete();
                return response()->json(['status'=>'Book is deleted successfully from wishlist']);
            }
        }else{
            return response()->json(['status'=>'Login to continue']);
        }

    }

    public function wishlistCount(){
        $wishlistCount = Wishlist::where('user_id',Auth::id())->count();
        return response()->json(['count'=>$wishlistCount]);
    }
}
