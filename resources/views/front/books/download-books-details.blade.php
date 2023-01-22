@extends('front.layout.layout')
@section('title',$bookDetails['book_name'])
@section('content')
<?php
use App\Models\Book;
?>
<!-- Account-Page -->
<div class="container">
    <div class="row">
        <section class="book_data">
            <div class="col-sm-12 padding-right CartItems">
           
                <div class="product-details"><!--product-details-->
                    <div class="col-sm-5">
                        <div class="view-product">
                            <img src="{{ asset('assets/admin/img/books/'.$bookDetails['book_image']) }}" alt="" style="height: 400px; width:300px" />
                        </div>                       
                    </div>
                    <div class="col-sm-7">
                        @if (Session::has('success_message'))
                            <div class="alert alert-success alert-dismissible" role="alert">
                                <strong>Success :</strong> {{Session::get('success_message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        @if (Session::has('error_message'))
                            <div class="alert alert-danger alert-dismissible text-danger" role="alert">
                                <strong>error :</strong> {{Session::get('error_message')}}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="product-information downloads"><!--/product-information-->
                            <p id="cart-success"></p>                
                            <p id="cart-error"></p>
                            <p id="wishlist-success"></p>
                            <p id="wishlist-error"></p>
                            <table class="table table-borderless">
                                <tr>
                                    <td>Book Name</td>
                                    <td>{{ $bookDetails['book_name'] }}</td>
                                </tr>
                          
                                <tr>
                                    <td>Author Name</td>
                                    <td>{{ $bookDetails['authors']['name'] }}</td>
                                </tr>

                                <tr>
                                    <td>Category</td>
                                    <td>{{ $bookDetails['categories']['category_name'] }}</td>
                                </tr>

                                <tr>
                                    <td>Language</td>
                                    <td>{{ $bookDetails['language'] }}</td>
                                </tr>

                                <tr>
                                    <td>Size</td>
                                    <td>{{ $bookDetails['size'] }}</td>
                                </tr>

                                <tr>
                                    <td>No Pages</td>
                                    <td>{{ $bookDetails['No_pages'] }}</td>
                                </tr>

                                <tr>
                                    <td>No of Downloads</td>
                                    <td>{{ $bookDownloads }}</td>
                                </tr>
                               
                                @if (Auth::id())
                                <tr> 
                                    <input type="hidden" value="{{ $bookDetails['id'] }}" class="book_id">

                                    <td><button type="button" class="btn btn-success addToDownloads">                                        
                                           Download
                                        </button>                                      
                                    <td>
                                   {{--  <td>
                                        <p class="text-center" style="font-size: 20px">
                                            <input type="hidden" value="{{ $bookDetails['id'] }}" class="book_id">
                                            @if ($bookDetails['book_like']==1)
                                            <a class="updateBookLike" 
                                            href="javascript:void(0)"
                                            id="book-{{$bookDetails['id']}}"
                                            book_id="{{ $bookDetails['id']}}">
                                                <i style="font-size: 20px" class="fas fa-heart" book_like="active"></i>
                                            </a>
                                            <span class="book_like">{{$bookLikes}}</span>
                                            @else
                                                <a class="updateBookLike" 
                                                href="javascript:void(0)"
                                                id="book-{{$bookDetails['id']}}"
                                                book_id="{{ $bookDetails['id']}}">                                          
                                                    <i style="font-size: 20px"  book_like="inactive" class="far fa-heart"></i> 
                                                </a>
                                                <span class="book_like">{{$bookLikes}}</span>
                                            @endif
                                        </p>                                     
                                     <td> --}}
                                </tr>          
                                <tr> 
                                    <input type="hidden" value="{{ $bookDetails['id'] }}" class="book_id">
                                    <td>
                                        <div class="card-body pt-5">
                                            <div id="countdown"></div>
                                        </div>
                                        <button type="button" class="btn btn-success new_link" style="display: none">                                        
                                        <a href="{{ url('download/'.$bookDetails->file) }}" 
                                            style="text-decoration: none; color:aliceblue;"
                                            >Get Link</a>                                        
                                        </button>                                      
                                     <td>
                                </tr>            
                                @endif
                                                   
                            </table>

                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li  class="active"><a href="#details" data-toggle="tab">About Book</a></li>
                            <li><a href="#companyprofile" data-toggle="tab">About Author</a></li>
                            <li><a href="#tag" data-toggle="tab">Similar Books</a></li>
                        </ul>
                    </div>
                    <div class="tab-content">
                        <div class="tab-pane fade" id="details" >
                            <div class="col-sm-12">
                                
                                <p class="text-center">{{ $bookDetails['description'] }}</p>
                                           
                            </div>
                        </div>
                        
                        <div class="tab-pane fade" id="companyprofile" >
                            <div class="produnmct-details"><!--author-details-->
                                @if (!empty($bookDetails['authors']['bio']))
                                    <div class="col-sm-5">
                                        <div class="view-author">
                                            <img src="{{ asset('assets/admin/img/authors/'.$bookDetails['authors']['image']) }}" alt="" style="height: 400px; width:300px" />
                                        </div>                       
                                    </div>
                                    <div class="col-sm-7">
                                        <div class="author-information"><!--/author-information-->
                                            <div class="card">
                                                <div class="card-body">
                                                  <h3 class="card-title">{{ $bookDetails['authors']['name'] }}</h5>
                                                  <p class="card-text">{{ $bookDetails['authors']['bio'] }}</p>
                                                  <h5>Other Books for Authors</h5>
                                                  <div class="card" style="width: 28%;">
                                                    @if (count($otherBooks)>0)
                                                        @foreach ($otherBooks as $book)
                                                            @if (!empty($book['book_image']))
                                                                <a href="{{ url('book-download/'.$book['id']) }}"><img style="height:250px;" src="{{ asset('assets/admin/img/books/'.$book['book_image']) }}" alt="" /></a>
                                                            @else
                                                                <a href="{{ url('book-download/'.$book['id']) }}"><img style="width: 50%; height:350px;" href="{{ url('book/'.$book['id']) }}" src="{{ asset('assets/admin/img/books/no-img.png') }}" alt="" /></a>
                                                            @endif  
                                                            <div class="card-body">
                                                                <h5 class="text-center">{{ $book['book_name'] }}</h5>
                                                            </div>                                      
                                                                
                                                        @endforeach
                                                    @else
                                                        <p class="text-center text-danger">There is no Available Books</p>
                                                    @endif
                                                  </div>
                                                </div>
                                              </div>
                                        </div><!--/author-information-->
                                    </div>
                                @else
                                    <p class="text-center text-danger">There ie no bio</p>
                                @endif
                            </div><!--/author-details-->
                        </div>
                        
                        <div class="tab-pane fade" id="tag" >
                           @if (count($similarBooks)>0)
                           @foreach ($similarBooks as $book)
                                <div class="col-sm-3">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                @if (!empty($book['book_image']))
                                                    <a href="{{ url('book-download/'.$book['id']) }}"><img style="width: 100%; height:350px;" src="{{ asset('assets/admin/img/books/'.$book['book_image']) }}" alt="" /></a>
                                                @else
                                                    <img style="width: 100%; height:350px;" src="{{ asset('assets/admin/img/books/no-img.png') }}" alt="" />
                                                @endif
                                                <h4>{{ $book['authors']['name'] }}</h4>
                                                <h5>{{ $book['book_name'] }}</h5>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                           @else
                               <p class="text-center text-danger">There is no Available Books</p>
                           @endif
                        </div>
                        
                    </div>
                </div><!--/category-tab-->

              
            </div>            
        </section>
    </div>
</div>
<!-- Account-Page /- -->
@endsection
