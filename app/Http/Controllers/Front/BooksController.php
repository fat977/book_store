<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Author;
use App\Models\Book;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Download;
use App\Models\DownloadedBook;
use App\Models\Like;
use App\Models\Order;
use App\Models\Rating;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class BooksController extends Controller
{
    //
    private $lang;

    public function __construct()
    {
        $this->lang = LaravelLocalization::getCurrentLocale() == 'en' ? 'en' : 'ar';
    }
    public function allBooks(){
        $books = Book::with(['authors','categories'])->where('status',1)->where('lang',$this->lang)->get();  
        return view('front.books.all-books',compact('books'));
    }

    public function detailsDownloaded($id){
        $bookDetails = DownloadedBook::with('categories')->where('status',1)->find($id);
        $bookDownloads = Download::where('book_id',$id)->sum('count');
        //$bookLikes = Like::sum('book_like');

        //similar books
        $similarBooks = DownloadedBook::with('categories')->where('category_id',$bookDetails['categories']['id'])
        ->where('id','!=',$id)->limit(6)->get();

        //$recommended =  Book::with('categories')->where('status',1)->get();

        //other books for author
        $otherBooks = DownloadedBook::with('authors')->where('author_id',$bookDetails['authors']['id'])
        ->where('id','!=',$id)->limit(6)->get();
        
        return view('front.books.download-books-details',compact('bookDetails','bookDownloads','similarBooks','otherBooks'));
    }

    public function downloadedBooks(){
        $books = DownloadedBook::with(['authors','categories'])->where('status',1)->get(); 

        return view('front.books.download-books',compact('books'));
    }


    /*  public function updateBookLike(Request $request){
        $book_id = $request->input('book_id');          
        if($request->ajax()){
            if(Auth::id()){
                $data = $request->all();
                    if($data['book_like']=='active'){
                        $book_like = 0;
                    }else{
                        $book_like= 1;
                    }
      
            }else{
                return response()->json(['type'=>'error','message'=>'login please ']);
            }
           
            Like::where('id',$data['book_id'])->update(['book_like'=>$book_like]);
            return response()->json(['book_like'=>$book_like,'id'=>$data['book_id']]);
        }
    } */
    

    public function download($file){
      
        return response()->download(public_path('assets/admin/downloads/'.$file));
    }

   
    public function addToDownload(Request $request){
        $book_id = $request->input('book_id');          

        if(Auth::check()){
            $book_check = DownloadedBook::where('id',$book_id)->first();
            if($book_check){
                    $downloadItem = new Download();
                    $downloadItem->book_id =$book_id;
                    $downloadItem->user_id =Auth::id();
                    if(Download::where('book_id',$book_id)->where('user_id',Auth::id())->exists()){
                        $downloadItem->count = 0;
                        $downloadItem->likes = 0 ;
                    }else{
                        $downloadItem->count = $downloadItem->count+1;
                        $downloadItem->likes = $downloadItem->likes+1 ;

                    }

                    $downloadItem->save();
                    return response()->json(['type'=>'success','message'=>'Get the link in seconds']);
                
            }
        }else{
            return response()->json(['type'=>'error','message'=>'Login to continue']);
        }

    }

    /*  public function addToLike(Request $request){
        $book_id = $request->input('book_id');          

        if(Auth::check()){
            $book_check = DownloadedBook::where('id',$book_id)->first();
            if($book_check){
                    $likeItem = new Like();
                    $likeItem->book_id =$book_id;
                    $likeItem->user_id =Auth::id();
                    if(like::where('book_id',$book_id)->where('user_id',Auth::id())->exists()){
                        $likeItem->likes = 0 ;
                    }else{
                        $likeItem->likes = $likeItem->likes+1 ;

                    }

                    $likeItem->save();
                    return response()->json(['type'=>'success','message'=>'Get the link in seconds']);
                
            }
        }else{
            return response()->json(['type'=>'error','message'=>'Login to continue']);
        }

    } */

    public function sort(Request $request){

        if($request->sort_by == 'book_oldest'){
            $books= Book::with(['authors','categories'])->orderBy('books.id','Asc')->where('status',1)->get();  
        }
        if($request->sort_by == 'book_newest'){
            $books= Book::with(['authors','categories'])->orderBy('books.id','Desc')->where('status',1)->get();  
        }
        if($request->sort_by == 'price_highest'){
            $books= Book::with(['authors','categories'])->orderBy('books.book_price','Desc')->where('status',1)->get();  
        }
        if($request->sort_by == 'price_lowest'){
            $books= Book::with(['authors','categories'])->orderBy('books.book_price','Asc')->where('status',1)->get();  
        }
        if($request->sort_by == 'name_a_z'){
            $books= Book::with(['authors','categories'])->orderBy('books.book_name','Asc')->where('status',1)->get();  
        }
        if($request->sort_by == 'name_z_a'){
            $books= Book::with(['authors','categories'])->orderBy('books.book_name','Desc')->where('status',1)->get();  
        }
        return view('front.books.all-books',compact('books'));

    }

    public function bookList(){
        $books = Book::select('book_name')->where('status',1)->get();
        $data = [];
        foreach($books as $book){
            $data[]= $book['book_name'];

        }
        return $data;
    }

    public function search(Request $request){
        $search_book = $request->book_name;
        if($search_book != " "){
            $book = Book::where("book_name","LIKE","%$search_book%")->first();

            if($book){
                return redirect('book/'.$book['id']);
            }else{
                return redirect()->back()->with('error_message','no book matched your search');
            }

        }else{
            return redirect()->back();
        }
    }

    public function allCategories(){
        $categories = Category::where('status',1)->where('lang',$this->lang)->get();
        //echo $total; die;
        return view('front.books.categories',compact('categories'));
    }

    public function categoryBooks($id){
        $category_books=Book::with(['categories','authors'])->where('category_id',$id)->get();
        $category_name = Category::select('category_name')->where('id',$id)->first();
        //echo $category_name; die; 
        
        foreach($category_books as $book){
            $title = $book['categories']['category_name'];
        }
        return view('front.books.books-categories',compact('category_books','title'));
    }

    public function details($id){
        $bookDetails = Book::with('categories')->where('status',1)->find($id);

         //rating
        $rating = Rating::where('book_id',$bookDetails['id'])->get();
        $rating_sum = Rating::where('book_id',$bookDetails['id'])->sum('stars_rated');

        if($rating->count() > 0){
            $rating_value = $rating_sum / $rating->count();
        }else{
            $rating_value=0;
        }

        $user_rating =  Rating::where('book_id',$bookDetails['id'])->where('user_id',Auth::id())->first();


        //reviews
        $book = Book::where('id',$bookDetails['id'])->where('status',1)->first();
        if($book){
            $book_id = $book->id;
           
            $verified_purchase = Order::where('orders.user_id',Auth::id())->
                join('order_items','orders.id','order_items.order_id')
                ->where('order_items.book_id',$book_id)->get();
            
            
        }else{
            return redirect()->back()->with('error','the link you follow is broken');
        }


        //$reviews = Review::where('book_id',$bookDetails['id'])->get();
        $ratings = Rating::where('book_id',$bookDetails['id'])->get();
        
        //similar books
        $similarBooks = Book::with('categories')->where('category_id',$bookDetails['categories']['id'])
        ->where('id','!=',$id)->limit(6)->get();

        $recommended =  Book::with('categories')->where('status',1)->get();

        //other books for author
        $otherBooks = Book::with('authors')->where('author_id',$bookDetails['authors']['id'])
        ->where('id','!=',$id)->limit(6)->get();
        
        return view('front.books.book-details',compact('bookDetails','recommended','similarBooks','otherBooks','ratings','verified_purchase','rating','rating_value','user_rating'));
    }

    
} 