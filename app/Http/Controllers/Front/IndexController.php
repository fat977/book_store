<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Book;
use Illuminate\Http\Request;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class IndexController extends Controller
{
    //
    private $lang;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale() == 'en' ? 'en' : 'ar';
    }

    public function index(){
        $sliderBanners = Banner::where('status',1)->get()->toArray();
        $newBooks = Book::with('authors')->orderBy('id','Desc')->where('lang',$this->lang)->where('status',1)->limit(4)->get();
        $bestSellers = Book::with('authors')->where('lang',$this->lang)->where(['is_bestseller'=>'Yes','status'=>1])->limit(4)->inRandomOrder()->get();
        $discounted = Book::where('book_discount','>',0 )->where('status',1)->where('lang',$this->lang)->get();

        return view('front.index',compact('sliderBanners','newBooks','bestSellers','discounted'));
    }

    public function contact(){
        return view('front.contact.contact');
    }
}
