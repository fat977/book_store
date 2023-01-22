<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthorController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BookDownloadController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UsersController;
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

/* Route::get('/', function () {
    return view('front.index');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
  */
Auth::routes();

Route::prefix('admin')->group(function(){

    //Route::match(['get', 'post'], '/login',[AdminController::class,'login'])->name('login');
    Route::get('login-view',[AdminController::class,'loginView'])->name('login');
    Route::post('login',[AdminController::class,'login'])->name('sign-in');

    Route::group(['middleware'=>['auth:admin']],function(){
        // Admin
        Route::get('dashboard',[AdminController::class,'dashboard'])->name('dashboard');
        Route::match(['get', 'post'], 'update-password',[AdminController::class,'updatePassword'])->name('update-password');
        Route::post('check-current-password',[AdminController::class,'checkCurrentPassword'])->name('check-password');
        Route::match(['get', 'post'], 'update-details',[AdminController::class,'updateDetails'])->name('update-details');
        Route::get('delete-admin-image/{id}',[AdminController::class,'deleteAdminImage']);
        Route::get('logout',[AdminController::class,'logout'])->name('logout');
        //Route::match(['get','post'],'forgot-password',[AdminController::class,'forgotPassword']);


        // Categories
        Route::get('categories',[CategoryController::class,'categories'])->name('categories');
        Route::post('update-category-status',[CategoryController::class,'updateCategoryStatus']);
        Route::match(['get', 'post'], 'add-edit-category/{id?}',[CategoryController::class,'AddEditCategory']);
        Route::get('delete-category/{id}',[CategoryController::class,'deleteCategory']);

        // Authors
        Route::get('authors',[AuthorController::class,'authors'])->name('authors');
        Route::post('update-author-status',[AuthorController::class,'updateAuthorStatus']);
        Route::get('delete-author/{id}',[AuthorController::class,'deleteAuthor']);
        Route::match(['get', 'post'], 'add-edit-author/{id?}',[AuthorController::class,'addEditAuthor']);

        // Books
        Route::get('books',[BookController::class,'books'])->name('books');
        Route::post('update-book-status',[BookController::class,'updateBookStatus']);
        Route::get('delete-book/{id}',[BookController::class,'deleteBook']);
        Route::get('delete-book-image/{id}',[BookController::class,'deleteBookImage']);
        Route::match(['get', 'post'], 'add-edit-book/{id?}',[BookController::class,'addEditBook']);

         // Books for downloading
         Route::get('books-downloaded',[BookDownloadController::class,'books_downloaded'])->name('books.download');
         Route::post('update-book-status',[BookDownloadController::class,'updateBookStatus']);
         Route::get('delete-book-downloaded/{id}',[BookDownloadController::class,'deleteBook']);
         Route::get('delete-book-downloaded-image/{id}',[BookDownloadController::class,'deleteBookImage']);
         Route::match(['get', 'post'], 'add-edit-book-downloaded/{id?}',[BookDownloadController::class,'addEditBook_downloaded']);
 
       /// Banners
       Route::get('banners',[BannerController::class,'banners'])->name('banners');
       Route::post('update-banner-status',[BannerController::class,'updateBannerStatus']);
       Route::get('delete-banner/{id}',[BannerController::class,'deleteBanner']);
       Route::get('delete-banner-image/{id}',[BannerController::class,'deleteBannerImage']);
       Route::match(['get', 'post'], 'add-edit-banner/{id?}',[BannerController::class,'addEditBanner']);

       //users
       Route::get('users',[UsersController::class,'users']);
       Route::get('view-users/{id}',[UsersController::class,'viewUsers']);

       //orders
       Route::get('orders',[OrderController::class,'orders']);
       Route::get('view-orders/{id}',[OrderController::class,'viewOrders']);
       Route::post('update-orders/{id}',[OrderController::class,'updateOrders']);
       Route::get('orders-history',[OrderController::class,'orderHistory']);

    });

});