<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-text-direction="ltr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Book Store | @yield('title')</title>
    <link href="{{ url('assets/front/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/front/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/front/css/prettyPhoto.css') }}" rel="stylesheet">
    <link href="{{ url('assets/front/css/price-range.css') }}" rel="stylesheet">
    <link href="{{ url('assets/front/css/animate.css') }}" rel="stylesheet">
	<link href="{{ url('assets/front/css/main.css') }}" rel="stylesheet">
	<link href="{{ url('assets/front/css/responsive.css') }}" rel="stylesheet">
    <link href="{{ url('assets/front/css/custom.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('assets/front/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/front/css/owl.carousel.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet"> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


  
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">

</head><!--/head-->

<body>
	<!--header-->
		@include('front.layout.header')
	<!--/header-->

    
        @yield('content')

	
    <div class="whatsapp-chat">
        <a href="https://wa.me/+2001153280679?text=I'm%20interested%20in%20your%20car%20for%20sale" target="_blank">
            <img src="{{ asset('assets/front/images/whatsapp.png') }}" height="50px" width="50px" alt="whatsapp-icon">
        </a>
    </div>
	<!-- footer -->
		@include('front.layout.footer')
	<!-- end footer -->
	

  
    
    <script src="{{ url('assets/front/js/jquery.js') }}"></script>
	<script src="{{ url('assets/front/js/bootstrap.min.js') }}"></script>
	<script src="{{ url('assets/front/js/jquery.scrollUp.min.js') }}"></script>
	<script src="{{ url('assets/front/js/price-range.js') }}"></script>
    <script src="{{ url('assets/front/js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ url('assets/front/js/main.js') }}"></script>
    <script src="{{ url('assets/front/js/custom.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/front/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('assets/front/js/owl.carousel.js') }}"></script>
   {{--  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
   
    <!-- search -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
    
    </script>

    <!-- tawk to-->
    <!--Start of Tawk.to Script-->
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/63c04c74c2f1ac1e202d20cd/1gmjilaju';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
    </script>
    <!--End of Tawk.to Script-->
   
    


</body>
</html>