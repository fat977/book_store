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
                        <div class="product-information"><!--/product-information-->
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
                                    @php
                                        $rate_num = number_format($rating_value)
                                    @endphp
                                    <td>
                                        @for ($i = 1; $i <= $rate_num; $i++)
                                            <i class="fa fa-star checked"></i>
                                        @endfor
                                        @for ($j = $rate_num; $j < 5; $j++)
                                            <i class="fa fa-star not-checked"></i>
                                        @endfor
                                        
                                    </td>
                                    <td>
                                        @if ($rating->count() > 0)
                                            <span>{{ $rating->count() }} Rating</span>
                                        @else
                                            No Rating
                                        @endif
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>Author Name</td>
                                    <td>{{ $bookDetails['authors']['name'] }}</td>
                                </tr>
                                @if (!empty($bookDetails['date']))
                                    <tr>
                                        <td>Publish Date</td>
                                        <td>{{ $bookDetails['date'] }}</td>
                                    </tr>
                                @endif

                                @php
                                    $getDiscountPrice = Book::getDiscountPrice($bookDetails['id']);
                                @endphp
                                @if ($getDiscountPrice > 0)
                                    <div class="price-template">
                                        <tr>
                                            <td>price</td>
                                            <td style="text-decoration: line-through; color:red;">
                                                ${{ $bookDetails['book_price'] }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>After discount</td> 
                                            <td>
                                                ${{ $getDiscountPrice }}
                                            </td> 
                                        </tr>
                                        
                                    </div>
                                @else
                                    <tr class="price-template">
                                        <td class="price">price </td>
                                        <td>
                                             ${{ $bookDetails['book_price'] }}
                                        </td>                                         
                                    </tr>
                                @endif
                                
                            </table>
                            <p><b>Availability:</b>
                                @if ($bookDetails['stock']>=2)
                                    <input type="hidden" value="{{ $bookDetails['id'] }}" class="book_id">
                                    In Stock -- <span class="text-success"> {{ $bookDetails['stock']}} available</span>
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up change_quantity" href=""> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2">
                                        <a class="cart_quantity_down change_quantity" href=""> - </a>                                    
                                    </div>
                                    <br><br>
                                    <p id="quantity_error" style="color: red"></p>
                                   <div style="margin-top:10px">
                                        <button type="button" class="btn btn-fefault cart addToCart">
                                            <i class="fa fa-shopping-cart"></i>
                                            <a href="">Add to cart</a>
                                        </button>
                                        <button type="button" class="float-right btn btn-fefault cart addToWishlist">
                                            <i class="fa fa-shopping-cart"></i>
                                            <a href="">Add to wishlist</a>
                                        </button>
                                    </div>
                                   
                                @endif

                                @if ($bookDetails['stock']<2 && !empty($bookDetails['stock']))
                                    <input type="hidden" value="{{ $bookDetails['id'] }}" class="book_id">
                                    In Stock -- <span class="text-success"> {{ $bookDetails['stock']}} available</span>
                                    <div class="cart_quantity_button">
                                        <a class="cart_quantity_up_1 change_quantity" href=""> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="1" autocomplete="off" size="2" required>
                                        <a class="cart_quantity_down change_quantity" href=""> - </a>
                                    </div> 
                                    <br><br>
                                    <p id="quantity_error" style="color: red"></p> 
                                    <div style="margin-top:10px">
                                        <button type="button" class="float-right btn btn-fefault cart addToCart">
                                            <i class="fa fa-shopping-cart"></i>
                                            <a href="">Add to cart</a>
                                        </button>
                                        <button type="button" class="float-right btn btn-fefault cart addToWishlist">
                                            <i class="fa fa-shopping-cart"></i>
                                            <a href="">Add to wishlist</a>
                                        </button>
                                    </div>               
                                    
                                
                                @endif
                                @if (empty($bookDetails['stock']))
                                    <span class="text-danger">Out of stock</span>
                                @endif

                            </p>

                        </div><!--/product-information-->
                    </div>
                </div><!--/product-details-->

                <div class="category-tab shop-details-tab"><!--category-tab-->
                    <div class="col-sm-12">
                        <ul class="nav nav-tabs">
                            <li><a href="#details" data-toggle="tab">About Book</a></li>
                            <li><a href="#companyprofile" data-toggle="tab">About Author</a></li>
                            <li><a href="#tag" data-toggle="tab">Similar Books</a></li>
                            <li class="active"><a href="#reviews" data-toggle="tab">Rating & Reviews</a></li>
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
                                                                <a href="{{ url('book/'.$book['id']) }}"><img style="height:250px;" src="{{ asset('assets/admin/img/books/'.$book['book_image']) }}" alt="" /></a>
                                                            @else
                                                                <a href="{{ url('book/'.$book['id']) }}"><img style="width: 50%; height:350px;" href="{{ url('book/'.$book['id']) }}" src="{{ asset('assets/admin/img/books/no-img.png') }}" alt="" /></a>
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
                                                    <a href="{{ url('book/'.$book['id']) }}"><img style="width: 100%; height:350px;" src="{{ asset('assets/admin/img/books/'.$book['book_image']) }}" alt="" /></a>
                                                @else
                                                    <img style="width: 100%; height:350px;" src="{{ asset('assets/admin/img/books/no-img.png') }}" alt="" />
                                                @endif
                                                <h4>{{ $book['authors']['name'] }}</h4>
                                                <h5>{{ $book['book_name'] }}</h5>
                                                @php
                                                $getDiscountPrice = Book::getDiscountPrice($book['id']);
                                                @endphp
                                                @if ($getDiscountPrice > 0)
                                                    <div class="price-template">
                                                        <div class="item-new-price">
                                                        ${{ $getDiscountPrice }}
                                                        </div>                                         
                                                        <div class="item-old-price" style="text-decoration: line-through; color:red;">
                                                        ${{ $book['book_price'] }}
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price-template">
                                                        <div class="item-price">
                                                        ${{ $book['book_price'] }}
                                                        </div>                                         
                                                    </div>
                                                @endif
                                                <br>
                                                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                           @else
                               <p class="text-center text-danger">There is no Available Books</p>
                           @endif
                        </div>
                        
                        <div class="tab-pane fade active in" id="reviews" >
                            <div class="col-sm-12">
                                @if($verified_purchase->count()>0 && !$user_rating)                    
                                    <form action="{{ url('/add-rating') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $bookDetails['id'] }}">
                                        <div class="rating-css">
                                            <div class="star-icon">
                                                <b style="color:black; font-size:15px">Rating: </b>   
                                                @if ($user_rating)
                                                    @for ($i = 1; $i <= $user_rating->stars_rated; $i++)
                                                        <input type="radio" value="{{ $i }}" name="product_rating" checked id="rating{{ $i }}">
                                                        <label for="rating{{ $i }}" class="fa fa-star"></label>
                                                    @endfor
                                                    @for ($j = $user_rating->stars_rated+1 ; $j <= 5; $j++)
                                                        <input type="radio" value="{{ $j }}" name="product_rating" id="rating{{ $j }}">
                                                        <label for="rating{{ $j }}" class="fa fa-star"></label>
                                                    @endfor
                                                @else
                                                    <input type="radio" value="1" name="product_rating" checked id="rating1">
                                                    <label for="rating1" class="fa fa-star"></label>
                                                    <input type="radio" value="2" name="product_rating" id="rating2">
                                                    <label for="rating2" class="fa fa-star"></label>
                                                    <input type="radio" value="3" name="product_rating" id="rating3">
                                                    <label for="rating3" class="fa fa-star"></label>
                                                    <input type="radio" value="4" name="product_rating" id="rating4">
                                                    <label for="rating4" class="fa fa-star"></label>
                                                    <input type="radio" value="5" name="product_rating" id="rating5">
                                                <label for="rating5" class="fa fa-star"></label>
                                                @endif
                                            </div>
                                        </div>
                                        <textarea name="user_review" ></textarea>
                                    
                                        <button type="submit" class="btn btn-default">
                                            Rate
                                        </button>
                                    </form>
                            
                                @else
                                    <div class="alert alert-danger">
                                        <h5>You are not eligible to review this book</h5>
                                        <p>For only Customers</p>
                                        <a href="{{ url('/') }}" class="btn btn-primary"> Go to Home</a>
                                    </div>
                                @endif
                                
                                <div class="col-md-12" style="margin-top:30px">
                                    <h3>Reviews</h3>
                                    @if (count($ratings) > 0)
                                        @foreach ($ratings as $rating)
                                            <div class="user-review">
                                                <label for="name"><i class="fa fa-user"></i> {{ $rating->user->name }}</label>
                                                @if ($rating->user_id == Auth::id())
                                                    <a class="text-primary" href="{{ url('edit-review/'.$bookDetails['id']) }}">Edit</a>
                                                    <a class="delete-review text-danger" href="">Delete</a>
                                                @endif
                                               <br>
                                               <label><i class="fa fa-calendar-o"></i> Review on {{ $rating->created_at->format('d M Y') }}</label>
                                                <br>
                                             
                                                    @php
                                                        $user_rated = $rating->stars_rated
                                                    @endphp
                                                    @for ($i = 1; $i <= $user_rated; $i++)
                                                        <i class="fa fa-star checked" style="margin-top:0"></i>
                                                    @endfor
                                                    @for ($j = $user_rated+1; $j <= 5; $j++)
                                                        <i class="fa fa-star not-checked" style="margin-top:0"></i>
                                                    @endfor
                                                <br>
                                            
                                                <P>{{ $rating->user_review }}</P>
                                            </div>
                                        @endforeach
                                    @else
                                        <h5 class="text-center">There is no reviews to show</h5>
                                    @endif

                                </div>
                            </div>
                           
                        </div>
                        
                    </div>
                </div><!--/category-tab-->
                
                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">recommended items</h2>                   
                    <div class="owl-carousel owl-theme recommended-carousel">                    
                        @if (count($recommended)>0)
                            @foreach ($recommended as $book)
                                <div class="item">
                                    <div class="col-sm-12">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    @if (!empty($book['book_image']))
                                                        <a href="{{ url('book/'.$book['id']) }}"><img style="width: 100%; height:350px;" src="{{ asset('assets/admin/img/books/'.$book['book_image']) }}" alt="" /></a>
                                                    @else
                                                        <img style="width: 100%; height:350px;" src="{{ asset('assets/admin/img/books/no-img.png') }}" alt="" />
                                                    @endif
                                                    <h4>{{ $book['authors']['name'] }}</h4>
                                                    <h5>{{ $book['book_name'] }}</h5>
                                                    @php
                                                    $getDiscountPrice = Book::getDiscountPrice($book['id']);
                                                    @endphp
                                                    @if ($getDiscountPrice > 0)
                                                        <div class="price-template">
                                                            <div class="item-new-price">
                                                            ${{ $getDiscountPrice }}
                                                            </div>                                         
                                                            <div class="item-old-price" style="text-decoration: line-through; color:red;">
                                                            ${{ $book['book_price'] }}
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="price-template">
                                                            <div class="item-price">
                                                            ${{ $book['book_price'] }}
                                                            </div>                                         
                                                        </div>
                                                    @endif
                                                    <br>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center text-danger">There is no Available Books</p>
                        @endif
                    </div>
                </div><!--/recommended_items-->
            </div>            
        </section>
    </div>
</div>
<!-- Account-Page /- -->
@endsection
