<?php

use App\Http\Controllers\Front\BooksController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\PaypalController;
use App\Http\Controllers\Front\RatingController;
use App\Http\Controllers\Front\UserController;
use App\Http\Controllers\Front\WishlistController;
use App\Http\Controllers\Front\ReviewController;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::namespace('front')->group(function(){
    Route::get('/',[IndexController::class,'index']);

    //user login/ register
    Route::get('user/login-register',[UserController::class,'loginRegister']);
    Route::post('user/register',[UserController::class,'userRegister']);
    Route::post('user/login',[UserController::class,'userLogin']);

    //contact
    Route::get('contact',[IndexController::class,'contact']);

    // forgot password
    Route::match(['get','post'],'user/forgot-password',[UserController::class,'forgotPassword']);
    
      //auth middleware
    Route::group(['middleware'=>['auth']],function(){
        //user account
        Route::match(['get','post'],'user/account',[UserController::class,'userAccount']);
        // update password
        Route::match(['get','post'],'user/update-password',[UserController::class,'userUpdatePassword']);

        // forgot password
        //Route::match(['get','post'],'user/forgot-password',[UserController::class,'forgotPassword']);

        //orders
        Route::get('my-orders', [UserController::class,'orders'])->name('orders');
        Route::get('view-orders/{id}', [UserController::class,'viewOrders']);

        //cart
        Route::get('/cart', [CartController::class,'cart'])->name('cart');

        //checkout
        Route::get('/checkout', [CheckoutController::class,'checkout'])->name('checkout');
        Route::post('place-order', [CheckoutController::class,'placeOrder']);

        //wishlist
        Route::get('/wishlist', [WishlistController::class,'wishlist'])->name('wishlist');

        //rating
        Route::post('add-rating', [RatingController::class,'add']);
        Route::get('edit-review/{id}', [RatingController::class,'edit']);
        Route::post('update-review', [RatingController::class,'update']);
        Route::post('delete-review', [RatingController::class,'delete']);

       /*  //review
        Route::post('add-review', [ReviewController::class,'add'])->name('review');
        Route::get('edit-review/{id}', [ReviewController::class,'edit']);
        Route::post('update-review', [ReviewController::class,'update']); */


        //payment
        Route::get('payment', [PaypalController::class,'payment'])->name('payment');
        Route::get('cancel', [PaypalController::class,'cancel'])->name('cancel');
        Route::get('success', [PaypalController::class,'success'])->name('success');

        //likes
        Route::post('book-like',[BooksController::class,'like']);

         //dislikes
         Route::post('book-dislike',[BooksController::class,'dislike']);


    });
    // wishlist
    Route::post('/add-to-wishlist', [WishlistController::class,'addToWishlist']);
    Route::post('delete-wishlist-item', [WishlistController::class,'deleteWishlistItem']);
    Route::get('load-wishlist-count', [WishlistController::class,'wishlistCount']);


     // cart
     Route::post('/add-to-cart', [CartController::class,'addToCart']);
     Route::post('delete-cart-item', [CartController::class,'deleteCartItem']);
     Route::post('update-cart-item', [CartController::class,'updateCartItem']);
     Route::get('load-cart-count', [CartController::class,'cartCount']);


    // user logout
    Route::get('user/logout',[UserController::class,'userLogout']);
    // confirm user
    Route::get('user/confirm/{code}',[UserController::class,'userConfirm']);

    //all books / categories
    Route::get('all-books',[BooksController::class,'allBooks'])->name('all.books');
    Route::get('books-download',[BooksController::class,'downloadedBooks'])->name('download.books'); 

    Route::get('all-categories',[BooksController::class,'allCategories'])->name('all.categories');

    Route::get('/sort-by',[BooksController::class,'sort']);


    // search
    Route::get('book-list',[BooksController::class,'bookList']);
    Route::post('search-book',[BooksController::class,'search']);


    //filter
    Route::get('/categories-books/{id}', [BooksController::class, 'categoryBooks'])->name('category.books');

    //book details
    Route::get('/book/{id}',[BooksController::class,'details']);

    // book download details
    Route::get('/book-download/{id}',[BooksController::class,'detailsDownloaded']);
    Route::get('/download/{file}', [BooksController::class, 'download']);
    Route::post('/add-to-download', [BooksController::class,'addToDownload']);


});

/*  Route::get('/', function () {
    return view('front.index');
});
 */
/*Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  */