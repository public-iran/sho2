@extends('front.layout.master')
@section('style')

@endsection
@section('content')
    <!-- Begin Slider With Banner Area -->
    <div class="slider-with-banner">
        <div class="container">
            <div class="row">
                <!-- Begin Slider Area -->
                <div class="col-lg-8 col-md-8">
                    <div class="slider-area pt-sm-30 pt-xs-30">
                        <div class="slider-active owl-carousel">
                      @foreach($sliders as $slider)
                            <!-- Begin Single Slide Area -->
                            <div class="single-slide align-center-left animation-style-02 bg-2" style="background-image: url({{asset($slider->imgPath)}});background-size: cover">
                                <div class="slider-progress"></div>
                            </div>
                            <!-- Single Slide Area End Here -->
                          @endforeach
                        </div>
                    </div>
                </div>
                <!-- Slider Area End Here -->
                <!-- Begin Li Banner Area -->
                <div class="col-lg-4 col-md-4 text-center pt-sm-30 pt-xs-30">
                    <div class="li-banner">
                        <a href="#">
                            <img src="images/banner/1_1.jpg" alt="">
                        </a>
                    </div>
                    <div class="li-banner mt-15 mt-md-30 mt-xs-25 mb-xs-5">
                        <a href="#">
                            <img src="images/banner/1_2.jpg" alt="">
                        </a>
                    </div>
                </div>
                <!-- Li Banner Area End Here -->
            </div>
        </div>
    </div>
    <!-- Slider With Banner Area End Here -->
    <!-- Begin Static Top Area -->
{{--    <div class="static-top-wrap">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="static-top-content mt-sm-30">
                        هدیه ویژه: هدیه هر روز در آخر هفته ها - کد کوپن جدید "
                        <span>تخفیف فروش لیموپا</span>
                    </div>
                </div>
            </div>
        </div>
    </div>--}}
    <!-- Static Top Area End Here -->
    <!-- product-area start -->
    <div class="product-area pt-55 pb-25 pt-xs-50">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-product-tab">
                        <ul class="nav li-product-menu">
                            <li><a class="active" data-toggle="tab" href="#li-new-product"><span>محصولات جدید</span></a></li>
                            <li><a data-toggle="tab" href="#li-bestseller-product"><span>پربازدیدترین</span></a></li>
                            <li><a data-toggle="tab" href="#li-featured-product"><span>محصولات ویژه</span></a></li>
                        </ul>
                    </div>
                    <!-- Begin Li's Tab Menu Content Area -->
                </div>
            </div>
            <div class="tab-content">
                <div id="li-new-product" class="tab-pane active show" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach($products_new as $item)
                            <div class="col-lg-12">
                                <!-- single-product-wrap start -->
                                <div class="single-product-wrap">
                                    <div class="product-image">
                                        <a href="/product/{{$item->slug}}">
                                            <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                        </a>
                                        @if($item->discount>0)
                                        <span class="sticker">-{{$item->discount}}%</span>
                                            @endif
                                    </div>
                                    <div class="product_desc">
                                        <div class="product_desc_info">
                                            <div class="product-review">
                                              {{--  <h5 style="    margin-bottom: 22px;" class="manufacturer">
                                                    <a href="/product/{{$item->slug}}"></a>
                                                </h5>
                                                <div class="rating-box">
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                </div>--}}
                                            </div>
                                            <h4><a class="product_name" href="/product/{{$item->slug}}">{{str_limit($item->title,40)}}</a></h4>
                                            <div class="price-box">
                                                @if($item->discount>0)
                                                <span class="old-price">{{number_format($item->price)}} تومان</span>
                                                <span class="new-price new-price-2">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                                @else
                                                    <span class="new-price new-price-2">{{number_format($item->price)}} تومان</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul class="add-actions-link">
                                                @if($item->depot>0)
                                                    <li class="add-cart active" onclick="addcart(this,'{{$item->id}}')"><a>افزودن به سبد خرید</a></li>
                                                @else
                                                    <li class="add-cart active" style="background: #ccc"><a>ناموجود</a></li>
                                                @endif                                                @php
                                                    $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                @endphp
                                                @if(empty($favorite))
                                                <li><a class="links-details" onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه مندی"><i class="fa fa-heart-o"></i></a></li>
                                                @else
                                                    <li><a class="links-details" onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه مندی"><i style="color: red" class="fa fa-heart-o"></i></a></li>
                                                @endif
                                                <li><a href="/product/{{$item->slug}}" title="مشاهده " class="quick-view-btn" ><i class="fa fa-eye"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product-wrap end -->
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="li-bestseller-product" class="tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach($products_view as $item)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="/product/{{$item->slug}}">
                                                <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                            </a>
                                            @if($item->discount>0)
                                                <span class="sticker">-{{$item->discount}}%</span>
                                            @endif
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    {{--  <h5 style="    margin-bottom: 22px;" class="manufacturer">
                                                          <a href="/product/{{$item->slug}}"></a>
                                                      </h5>
                                                      <div class="rating-box">
                                                          <ul class="rating">
                                                              <li><i class="fa fa-star-o"></i></li>
                                                              <li><i class="fa fa-star-o"></i></li>
                                                              <li><i class="fa fa-star-o"></i></li>
                                                              <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                              <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                          </ul>
                                                      </div>--}}
                                                </div>
                                                <h4><a class="product_name" href="/product/{{$item->slug}}">{{str_limit($item->title,40)}}</a></h4>
                                                <div class="price-box">
                                                    @if($item->discount>0)
                                                        <span class="old-price">{{number_format($item->price)}} تومان</span>
                                                        <span class="new-price new-price-2">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                                    @else
                                                        <span class="new-price new-price-2">{{number_format($item->price)}} تومان</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    @if($item->depot>0)
                                                        <li class="add-cart active" onclick="addcart(this,'{{$item->id}}')"><a>افزودن به سبد خرید</a></li>
                                                    @else
                                                        <li class="add-cart active" style="background: #ccc"><a>ناموجود</a></li>
                                                    @endif
                                                    @php
                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                    @endphp
                                                    @if(empty($favorite))
                                                        <li><a class="links-details" onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه مندی"><i class="fa fa-heart-o"></i></a></li>
                                                    @else
                                                        <li><a class="links-details" onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه مندی"><i style="color: red" class="fa fa-heart-o"></i></a></li>
                                                    @endif
                                                    <li><a href="/product/{{$item->slug}}" title="مشاهده " class="quick-view-btn"><i class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div id="li-featured-product" class="tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach($spacial_product as $item)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="/product/{{$item->slug}}">
                                                <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                            </a>
                                            @if($item->discount>0)
                                                <span class="sticker">-{{$item->discount}}%</span>
                                            @endif
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    {{--  <h5 style="    margin-bottom: 22px;" class="manufacturer">
                                                          <a href="/product/{{$item->slug}}"></a>
                                                      </h5>
                                                      <div class="rating-box">
                                                          <ul class="rating">
                                                              <li><i class="fa fa-star-o"></i></li>
                                                              <li><i class="fa fa-star-o"></i></li>
                                                              <li><i class="fa fa-star-o"></i></li>
                                                              <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                              <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                          </ul>
                                                      </div>--}}
                                                </div>
                                                <h4><a class="product_name" href="/product/{{$item->slug}}">{{str_limit($item->title,40)}}</a></h4>
                                                <div class="price-box">
                                                    @if($item->discount>0)
                                                        <span class="old-price">{{number_format($item->price)}} تومان</span>
                                                        <span class="new-price new-price-2">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                                    @else
                                                        <span class="new-price new-price-2">{{number_format($item->price)}} تومان</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    @if($item->depot>0)
                                                        <li class="add-cart active" onclick="addcart(this,'{{$item->id}}')"><a>افزودن به سبد خرید</a></li>
                                                    @else
                                                        <li class="add-cart active" style="background: #ccc"><a>ناموجود</a></li>
                                                    @endif                                                    @php
                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                    @endphp
                                                    @if(empty($favorite))
                                                        <li><a class="links-details" onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه مندی"><i class="fa fa-heart-o"></i></a></li>
                                                    @else
                                                        <li><a class="links-details" onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه مندی"><i style="color: red" class="fa fa-heart-o"></i></a></li>
                                                    @endif
                                                    <li><a href="/product/{{$item->slug}}" title="مشاهده " class="quick-view-btn"><i class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- product-area end -->
    <!-- Begin Li's Static Banner Area -->
    <div class="li-static-banner li-static-banner-4 text-center pt-20">
        <div class="container">
            <div class="row">

                <!-- Begin Single Banner Area -->
                @foreach($banners as $banner)
                <div class="col-lg-6">
                    <div class="single-banner pb-sm-30 pb-xs-30">
                        <a href="{{$banner->link}}">
                            <img src="{{asset($banner->imgPath)}}" alt="{{$banner->imgName}}">
                        </a>
                    </div>
                </div>
                @endforeach
                <!-- Single Banner Area End Here -->

            </div>
        </div>
    </div>
    <!-- Li's Static Banner Area End Here -->
    <!-- Begin Li's Laptop Product Area -->
    <section class="product-area li-laptop-product pt-60 pb-45 pt-sm-50 pt-xs-60">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>محصولات دارای تخفیف </span>
                        </h2>

                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach($products_discount as $item)
                                <div class="col-lg-12">
                                    <!-- single-product-wrap start -->
                                    <div class="single-product-wrap">
                                        <div class="product-image">
                                            <a href="/product/{{$item->slug}}">
                                                <img src="{{asset($item->image)}}" alt="{{$item->title}}">
                                            </a>
                                            @if($item->discount>0)
                                                <span class="sticker">-{{$item->discount}}%</span>
                                            @endif
                                        </div>
                                        <div class="product_desc">
                                            <div class="product_desc_info">
                                                <div class="product-review">
                                                    {{--  <h5 style="    margin-bottom: 22px;" class="manufacturer">
                                                          <a href="/product/{{$item->slug}}"></a>
                                                      </h5>
                                                      <div class="rating-box">
                                                          <ul class="rating">
                                                              <li><i class="fa fa-star-o"></i></li>
                                                              <li><i class="fa fa-star-o"></i></li>
                                                              <li><i class="fa fa-star-o"></i></li>
                                                              <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                              <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                          </ul>
                                                      </div>--}}
                                                </div>
                                                <h4><a class="product_name" href="/product/{{$item->slug}}">{{str_limit($item->title,40)}}</a></h4>
                                                <div class="price-box">
                                                    @if($item->discount>0)
                                                        <span class="old-price">{{number_format($item->price)}} تومان</span>
                                                        <span class="new-price">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span>
                                                    @else
                                                        <span class="new-price">{{number_format($item->price)}} تومان</span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="add-actions">
                                                <ul class="add-actions-link">
                                                    @if($item->depot>0)
                                                    <li class="add-cart active" onclick="addcart(this,'{{$item->id}}')"><a>افزودن به سبد خرید</a></li>
                                                    @else
                                                        <li class="add-cart active" style="background: #ccc"><a>ناموجود</a></li>
                                                    @endif
                                                    @php
                                                        $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                    @endphp
                                                    @if(empty($favorite))
                                                        <li><a class="links-details" onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه مندی"><i class="fa fa-heart-o"></i></a></li>
                                                    @else
                                                        <li><a class="links-details" onclick="favorite(this,{{$item->id}})" title="افزودن به علاقه مندی"><i style="color: red" class="fa fa-heart-o"></i></a></li>
                                                    @endif
                                                    <li><a href="/product/{{$item->slug}}" title="مشاهده " class="quick-view-btn"><i class="fa fa-eye"></i></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- single-product-wrap end -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
    <!-- Li's Laptop Product Area End Here -->
    <!-- Begin Li's TV & Audio Product Area -->
    <section class="product-area li-laptop-product li-tv-audio-product pb-45">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>آخرین مطالب</span>
                        </h2>

                    </div>
                    <div class="row">
                        @foreach($posts as $post)
                        <div class="col-lg-4 col-md-6">
                            <div class="li-blog-single-item pb-25">
                                <div class="li-blog-banner">
                                    <a href="/blog/{{$post->slug}}"><img class="img-full" src="{{asset($post->imgPath)}}" alt=""></a>
                                </div>
                                <div class="li-blog-content">
                                    <div class="li-blog-details">
                                        <h3 class="li-blog-heading pt-25"><a href="/blog/{{$post->slug}}">{{str_limit($post->title,50)}}</a></h3>
                                        <div class="li-blog-meta">
                                            <a class="author" href="#"><i class="fa fa-user"></i>مدیر</a>
                                            <a class="comment" href="#"><i class="fa fa-eye"></i> {{$post->view}} بازدید</a>
                                            <a class="post-time" href="#"><i class="fa fa-calendar"></i> {{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</a>
                                        </div>
                                        <p>{{str_limit($post->shortContent,100)}}</p>
                                        <a class="read-more" href="/blog/{{$post->slug}}">ادامه مطلب...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- Li's Section Area End Here -->
            </div>
        </div>
    </section>
    <!-- Li's TV & Audio Product Area End Here -->

@endsection
