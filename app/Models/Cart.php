<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Cart extends Model
{
    use HasFactory;
    public static function getCartItems(){
        if(Auth::check()){
            $getCartItem = Cart::with(['book'=>function($query){
                $query->select('id','category_id','book_name','book_image');
            }])->orderby('id','Desc')->where('user_id',Auth::user()->id)->get()->toArray();
        }else{
            $getCartItem = Cart::with(['book'=>function($query){
                $query->select('id','category_id','book_name','book_image');
            }])->orderby('id','Desc')->where('session_id',Session::get('session_id'))->get()->toArray();
        }
       //dd($getCartItem);
        return $getCartItem;
    }
    //book = cart
    public function books(){
        return $this->belongsTo(Book::class,'book_id');
    }
}
