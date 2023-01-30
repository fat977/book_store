<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;
    public function authors(){
        return $this->belongsTo(Author::class,'author_id');
    }

    public function categories(){
        return $this->belongsTo(Category::class,'category_id')->select('id','category_name','status');
    }

  

    public function carts(){
        return $this->belongsTo(Cart::class,'book_id');
    }

    public static function books(){
       
        $getBooks = Book::with(['categories'=>function($query){
            $query->select('id');}])->where(['status'=>1])->get();
       //echo $getBooks; die;
        return $getBooks;
    }

    public static function getDiscountPrice($book_id){
        $bookDetails = Book::select('book_price','book_discount')->where('id',$book_id)->first();
        $bookDetails = json_decode(json_encode($bookDetails),true);
        if($bookDetails['book_discount']>0){
            $discount_price =$bookDetails['book_price'] - ($bookDetails['book_price']*$bookDetails['book_discount']/100);
        }else{
            $discount_price =0;
        }
        return $discount_price;

    }

    public static function getFinalPrice($book_id){
        $bookDetails = Book::select('book_price','book_discount')->where('id',$book_id)->first();
        $bookDetails = json_decode(json_encode($bookDetails),true);
    
        if($bookDetails['book_discount']>0){
            $final_price =$bookDetails['book_price']-($bookDetails['book_price']*
            $bookDetails['book_discount']/100);
            $discount = $bookDetails['book_price']-$final_price;

        }else{
            $final_price =$bookDetails['book_price'];
            $discount=0;
        }
        return array('book_price'=> $bookDetails['book_price'],'final_price' => $final_price, 'discount'
         => $discount);

    }

    public static function getBookStock($stock){
        $getBookStock = Book::select('stock')->where('stock',$stock)->first();
        return $getBookStock->stock;
    }
}
