<?php
use App\Models\Category;
use App\Models\Author;
$categories = Category::categories();
$authors = Author::authors();
?>
<div class="col-sm-3">
    <div class="left-sidebar">
        <h2>Category</h2>
        <div class="panel-group category-products" id="accordian"><!--category-productsr-->
            <div class="panel panel-default">
                <div class="panel-heading">
                    @foreach ($categories as $category)
                    <h4 class="panel-title">
                        <a onMouseOver="this.style.color='#FE980F'" onMouseOut="this.style.color='#696763'" data-toggle="collapse" data-parent="#accordian"
                         href="{{ url('/books/'.$category['category_name']) }}">
                            {{ $category['category_name'] }}
                        </a>
                    </h4>
                    @endforeach
                </div>
            </div>
        </div><!--/category-products-->
    
        <div class="brands_products"><!--brands_products-->
            <h2>Authors</h2>
            <div class="brands-name">
                <ul class="nav nav-pills nav-stacked">
                    <li class="panel-title">
                        @foreach ($authors as $author)
                            <a onMouseOver="this.style.color='#FE980F'" onMouseOut="this.style.color='#696763'" href="#">{{ $author['name'] }}</a>
                        @endforeach
                    </li>
                </ul>
            </div>
        </div><!--/brands_products-->
        
        <div class="price-range"><!--price-range-->
            <h2>Price Range</h2>
            <div class="well text-center">
                <input type="text" class="span2" value="" data-slider-min="0" data-slider-max="600" data-slider-step="5" data-slider-value="[250,450]" id="sl2" ><br />
                <b class="pull-left">$ 0</b> <b class="pull-right">$ 600</b>
            </div>
        </div><!--/price-range-->
        
        
    
    </div>
</div>

