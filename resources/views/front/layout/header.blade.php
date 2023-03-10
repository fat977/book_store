<header id="header">
    <div class="header_top"><!--header_top-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="contactinfo">
                        <ul class="nav nav-pills">
                            <li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
                            <li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                <li>
                                    <a rel="alternate" hreflang="{{ $localeCode }}" href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                        {{ $properties['native'] }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="social-icons pull-right">
                        <ul class="nav navbar-nav">
                            <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                            <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                            <li><a href="#"><i class="fab fa-linkedin"></i></a></li>
                            <li><a href="#"><i class="fab fa-dribbble"></i></a></li>
                            <li><a href="#"><i class="fab fa-google-plus"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header_top-->
    
    <div class="header-middle"><!--header-middle-->
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="logo pull-left">
                        <h3 href="index.html">Book Store</h3>
                    </div>
                </div>
                <div class="col-sm-8" style="margin-top: 10px">
                    <div class="user-menu" style="float: right">
                        <ul class="nav navbar-nav user-profile"> 
                            @if (Auth::check())   
                                <li class="dropdown"><a href="#"><i class="fa fa-user u-s-m-r-9"></i> {{Auth::user()->name}}<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                            <li><a href="{{ url('user/account') }}"><i class="fas fa-cog"></i> Settings</a></li>
                                            <li>
                                                <a href="{{ url('my-orders') }}">
                                                    <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                                    Orders</a>
                                            </li>
                                            <li>
                                                <a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i> Cart
                                                    <span class="badge badge-pill badge-danger cart-count">0</span>
                                                </a>
                                            </li>
                                            <li><a href="{{ route('wishlist') }}"><i class="fa fa-shopping-cart"></i> Wishlist
                                                    <span class="badge badge-pill badge-danger wishlist-count">0</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('user/logout') }}">
                                                    <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                                    Logout</a>
                                            </li>
                                                      
                                    </ul>
                                </li> 
                            @else
                                <li>
                                    <a href="{{ url('user/login-register') }}">
                                        <i class="fas fa-sign-in-alt u-s-m-r-9"></i>
                                        Login / Register
                                    </a>
                                </li>
                            @endif                                    
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div><!--/header-middle-->

    <div class="header-bottom"><!--header-bottom-->
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="mainmenu pull-left">
                        <ul class="nav navbar-nav collapse navbar-collapse">
                            <li><a href="/" class="active">{{__('custom.Home')}}</a></li>

                            <li class="dropdown"><a href="#">Store<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="{{ route('all.books') }}">All Books</a></li>
                                    <li><a href="{{ route('download.books') }}">Books to download</a></li>
                                    <li><a href="{{ route('all.categories') }}">Categories</a></li> 
                                </ul>
                            </li> 
                             
                           {{--  <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="shop.html">Products</a></li>
                                    <li><a href="product-details.html">Product Details</a></li> 
                                    <li><a href="checkout.html">Checkout</a></li> 
                                    <li><a href="cart.html">Cart</a></li> 
                                    <li><a href="login.html">Login</a></li> 
                                </ul>
                            </li>  --}}
                          {{--   <li class="dropdown"><a href="#">Blog<i class="fa fa-angle-down"></i></a>
                                <ul role="menu" class="sub-menu">
                                    <li><a href="blog.html">Blog List</a></li>
                                    <li><a href="blog-single.html">Blog Single</a></li>
                                </ul>
                            </li> --}} 
                            <li><a href="{{ url('contact') }}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-sm-3">
                    <form action="{{ url('search-book') }}" method="POST">
                        @csrf
                       
                        <div class="search_box pull-r ight">
							<input type="text" id="search_book" name="book_name" required placeholder="Search"/>
						</div>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/header-bottom-->
</header>