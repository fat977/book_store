<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    //
    /* public function add($id){
       
        $book = Book::where('id',$id)->where('status',1)->first();
        if($book){
            $book_id = $book->id;

            $verified_purchase = Order::where('orders.user_id',Auth::id())->
                    join('order_items','orders.id','order_items.order_id')
                    ->where('order_items.book_id',$book_id)->get();
            return view('front.books.book-details',compact('book','verified_purchase'));

            if($verified_purchase->count() > 0){
                $existing_rating = Rating::where('user_id',Auth::id())->where('book_id',$book_id)->first();

                if($existing_rating){
                    $existing_rating->stars_rated=$stars;
                    $existing_rating->update();
                }else{
                    Rating::create([
                        'user_id'=>Auth::id(),
                        'book_id'=>$book_id,
                        'stars_rated'=>$stars
                    ]);
                }
                return redirect()->back()->with('success_message','thanks for rating this book');
               
            }else{
                return redirect()->back()->with('error_message','you can not rate this book without purchase');
            }
        }else{
            return redirect()->back()->with('error','the link you follow is broken');
        }
    } */

    public function add(Request $request){
        $book_id = $request->input('book_id');

        $book = Book::where('id',$book_id)->where('status',1)->first();
        if($book){
            $review = Review::where('book_id',$book_id)->where('user_id',Auth::id())->first();
            if($review){
                return view('front.reviews.edit-review',compact('review'));
            }
            $user_review = $request->input('user_review');
            Review::create([
                'user_id'=>Auth::id(),
                'book_id'=>$book_id,
                'user_review'=>$user_review,
            ]);

           // if($new_review){
                return redirect()->back()->with('success_message','thanks for review this book');
           // }
                     
        }else{
            return redirect()->back()->with('error','the link you follow is broken');
        }
    }

    public function edit($id){
        $book = Book::where('id',$id)->where('status',1)->first();
        if($book){
            $book_id =$book->id;
            $review = Review::where('user_id',Auth::id())->where('book_id',$book_id)->first();
            if($review){
                return view('front.reviews.edit-review',compact('review'));
            }
        }

    }

    public function update(Request $request){
        $user_review = $request->input('user_review');

        if($user_review != ''){
            $review_id = $request->input('review_id');
            $review = Review::where('id',$review_id)->where('user_id',Auth::id())->first();
            if($review){
                $review->user_review = $request->input('user_review');
                $review->update();
                return redirect('book/'.$review->book->id)->with('success_message','review is updated successfully');
            }else{
                return redirect()->back()->with('error_message','You follow un broken link');
            }
        }else{
            return redirect()->back()->with('error_message','You can not submit an empty review');
        }
    }
}