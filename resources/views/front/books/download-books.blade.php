@extends('front.layout.layout')
@section('title','Books')
@section('content')
<?php
use App\Models\Book;
?>
<!-- Account-Page -->
<div class="container">
    <div class="row">
        <section>
            <h2 class="title text-center">Books For Downloading</h2>
            <div class="sort_box col-sm-3 ">
                <select name="sort" class="sort" id="sort">
                    <option selected="" value="">Select</option>
                    <option value="book_oldest">Oldest Book </option>
                    <option value="book_newest">Newest Book</option>
                    <option value="price_highest">Highest Price</option>
                    <option value="price_lowest">Lowest Price</option>      
                    <option value="name_a_z">Name_A_Z</option>
                    <option value="name_z_a">Name_Z_A</option>                  
                </select>
            </div>  
            <div class="row col-sm-12 padding-right book_data">
                <div class="features_items"><!--features_items-->
                    <div class="search_result">
                        <div class="content">
                            <p id="error"></p>
                            @foreach ($books as $book)
                                @if ($book['categories']['status']==1)
                                    <form action="" class="">
                                        <div class="col-sm-3">
                                            <div class="product-image-wrapper">
                                                <div class="single-products">
                                                    <div class="productinfo text-center">
                                                        <p id="cart-success"></p>
                                                        <p id="cart-error"></p>
                                                        <span id="count"></span>
                                                        @if (!empty($book['book_image']))
                                                            <a href="{{ url('book-download/'.$book['id']) }}"><img style="width: 100%; height:350px;" src="{{ asset('assets/admin/img/books/'.$book['book_image']) }}" alt="" /></a>
                                                        @else
                                                            <a href="{{ url('book-download/'.$book['id']) }}"><img style="width: 100%; height:350px;" href="{{ url('book/'.$book['id']) }}" src="{{ asset('assets/admin/img/books/no-img.png') }}" alt="" /></a>
                                                        @endif                                        
                                                        <h4>{{ $book['authors']['name'] }}</h4>
                                                        <h5>{{ $book['book_name'] }}</h5>
                                                      {{--   <p>
                                                            <input type="hidden" value="{{ $book['id'] }}" class="book_id">

                                                            <button type="button" class="addToLike btn btn-success">
                                                                <a href="">
                                                                    like
                                                                </a>
                                                                

                                                            </button>
                                                        </p>
                                                        <p class="likeItem"></p> --}}
                                                        {{--   <p class="text-center" style="font-size: 20px">
                                                            <input type="hidden" value="{{ $book['id'] }}" class="book_id">
                                                            @if ($book['book_like']==1)
                                                            <a class="updateBookLike" 
                                                            href="javascript:void(0)"
                                                            id="book-{{$book['id']}}"
                                                            book_id="{{ $book['id']}}">
                                                                <i style="font-size: 20px" class="fas fa-heart" book_like="active"></i>
                                                            </a>
                                                            <span>like</span>
                                                            @else
                                                                <a class="updateBookLike" 
                                                                href="javascript:void(0)"
                                                                id="book-{{$book['id']}}"
                                                                book_id="{{ $book['id']}}">                                          
                                                                    <i style="font-size: 20px"  book_like="inactive" class="far fa-heart"></i> 
                                                                </a>
                                                                <span>like</span>
                                                            @endif
                                                        </p> --}}

                                                        @php
                                                            $like_count = 0;
                                                            $dislike_count = 0;

                                                            $like_status = "btn-secondry";
                                                            $dislike_status = "btn-secondry";
                                                        @endphp

                                                        @foreach ($book->like as $like)
                                                            @php
                                                                if($like->book_like == 1){
                                                                    $like_count++;
                                                                }
                                                                if($like->book_like == 0){
                                                                    $dislike_count++;
                                                                }

                                                                if(Auth::check()){
                                                                    if($like->book_like == 1 && $like->user_id== Auth::user()->id ){
                                                                        $like_status = "btn-success";  
                                                                    }  
                                                                    if($like->book_like == 0 && $like->user_id== Auth::user()->id ){
                                                                        $dislike_status = "btn-danger";  
                                                                    } 
                                                                }
                                                            
                                                                                                                            
                                                            @endphp
                                                        @endforeach

                                                        <button data-like="{{ $like_status }}" book-id="{{  $book['id'] }}_l" type="button" 
                                                            class="like btn {{ $like_status }}">Like <i class="fas fa-thumbs-up"></i> 
                                                            <b><span class="like_count">{{ $like_count }}</span></b>
                                                        </button>
                                                        
                                                        <button  data-like="{{ $dislike_status }}"  book-id="{{  $book['id'] }}_d" type="button" 
                                                            class="dislike btn {{ $dislike_status }}">Dislike <i class="fas fa-thumbs-down"></i> 
                                                            <b><span class="dislike_count">{{ $dislike_count }}</span></b>
                                                        </button>
                                                       

                                                   
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                @endif
                            @endforeach
                        </div>
                    </div> 
                             
                </div><!--features_items-->
            </div>            
        </section>
    </div>
</div>

<!-- Account-Page /- -->
@endsection
