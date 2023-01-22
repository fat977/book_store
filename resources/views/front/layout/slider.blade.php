<section id="slider">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="owl-carousel owl-theme banner-carousel">
                    @foreach ($sliderBanners as $banner)
                    <div class="item">
                        <a @if (!empty($banner['link']))
                            href="{{ url($banner['link']) }}"
                            @else
                                href="javascript:;"
                            @endif>
                            <img  src="{{ asset('assets/front/images/banners/'.$banner['image']) }}" class="img-responsive" title="{{ $banner['title'] }}" alt="{{ $banner['alt'] }}" />                                   
                        </a>
                        
                        <div class="centered">
                            <h1>Book Store</h1>
                            <h3>{{ $banner['title'] }}</h3>
                        </div>
                    </div>
                    @endforeach
                </div>             
            </div>
        </div>
    </div>
</section>
