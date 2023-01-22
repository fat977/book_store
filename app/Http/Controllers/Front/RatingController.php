<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    //
    public function add(Request $request){
        $stars = $request->input('product_rating');
        $user_review = $request->input('user_review');
        $book_id = $request->input('book_id');

        $book_check = Book::where('id',$book_id)->where('status',1)->first();
        if($book_check){
            $verified_purchase = Order::where('orders.user_id',Auth::id())->
            join('order_items','orders.id','order_items.order_id')
            ->where('order_items.book_id',$book_id)->get();

            if($verified_purchase->count() > 0){
                $existing_rating = Rating::where('user_id',Auth::id())->where('book_id',$book_id)->first();

                if($existing_rating){
                    return view('front.reviews.edit-review',compact('existing_rating'));
                }else{
                    Rating::create([
                        'user_id'=>Auth::id(),
                        'book_id'=>$book_id,
                        'stars_rated'=>$stars,
                        'user_review'=>$user_review
                    ]);
                }
                return redirect()->back()->with('success_message','thanks for rating this book');
               
            }else{
                return redirect()->back()->with('error_message','you can not rate this book without purchase');
            }
        }else{
            return redirect()->back()->with('error','the link you follow is broken');
        }
    }

    public function edit($id){
        $book = Book::where('id',$id)->where('status',1)->first();
        if($book){
            $book_id =$book->id;
            $existing_rating = Rating::where('user_id',Auth::id())->where('book_id',$book_id)->first();
            if($existing_rating){
                return view('front.reviews.edit-review',compact('existing_rating'));
            }
        }

    }

    public function update(Request $request){
        $user_review = $request->input('user_review');
        $stars = $request->input('product_rating');

        if($user_review != ''){
            $review_id = $request->input('review_id');
            $existing_rating = Rating::where('id',$review_id)->where('user_id',Auth::id())->first();
            if($existing_rating){
                $existing_rating->user_review = $request->input('user_review');
                $existing_rating->stars_rated = $request->input('product_rating');
                $existing_rating->update();
                return redirect('book/'.$existing_rating->book->id)->with('success_message','review is updated successfully');
            }else{
                return redirect()->back()->with('error_message','You follow un broken link');
            }
        }else{
            return redirect()->back()->with('error_message','You can not submit an empty review');
        }
    }

    public function delete(Request $request){

        if(Auth::check()){
            $book_id = $request->input('book_id');
            if(Rating::where('book_id',$book_id)->where('user_id',Auth::id())->exists()){
                $RatingItem = Rating::where('book_id',$book_id)->where('user_id',Auth::id())->first();
                $RatingItem->delete();
                return response()->json(['status'=>'Review is deleted successfully']);
            }
        }else{
            return response()->json(['status'=>'Login to continue']);
        }

    }
}
