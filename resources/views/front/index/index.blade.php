@extends('front.layout.master')
@section('style')
    <style>
        .single-slider .img-responsive{
            width: 100%;
            max-height: 420px;
        }
        .blog__item__pic img{
            width: 100%;
        }
        .from-blog .blog__item {
            margin-bottom: 30px;
        }
        .blog__item__text {
            text-align: right;
        }
        .blog__item__text ul {
            margin-bottom: 0;
            list-style: none;
            padding-right: 0;
        }
        .blog__item__text ul li {
            font-size: 14px;
            color: #b2b2b2;
            list-style: none;
            display: inline-block;
            margin-right: 10px;
        }
        .blog__item__text h5 {
            margin-bottom: 12px;
        }
        .blog__item__text p {
            margin-bottom: 25px;
        }
    </style>
@endsection
@section('content')

    <div id="container">

        <div class="container">
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-xs-12">
                    <!-- Slideshow Start-->
                    <div class="slideshow single-slider owl-carousel">
                        @foreach($sliders as $slider)
                        <div class="item"> <a href="{{$slider->link}}"><img class="img-responsive" src="{{$slider->imgPath}}" alt="{{$slider->imgName}}" /></a> </div>
                        @endforeach
                    </div>
                    <!-- Slideshow End-->
                    <!-- Banner Start-->
                    <div class="marketshop-banner">
                        <div class="row">
                            @foreach($categories_image as $category_image)
                            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12"><a href="{{$slider->link}}"><img src="{{$category_image->imgPath}}" alt="{{$category_image->imgName}}" title="{{$category_image->imgName}}" /></a></div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Banner End-->
                    <!-- محصولات Tab Start -->
                    <div id="product-tab" class="product-tab">
                        <ul id="tabs" class="tabs">
                            <li><a href="#tab-latest">جدیدترین</a></li>
                            <li><a href="#tab-bestseller">پربازدیدترین</a></li>
                            <li><a href="#tab-special">پیشنهادی</a></li>
                        </ul>

                        <div id="tab-latest" class="tab_content">
                            <div class="owl-carousel product_carousel_tab">
                               @foreach($products_new as $item)
                                <div class="product-thumb">
                                    <div class="image"><a href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}" title="{{$item->title}}" class="img-responsive" /></a></div>
                                    <div class="caption">
                                        <h4><a href="/product/{{$item->slug}}">{{str_limit($item->title,40)}}</a></h4>
                                        @if($item->discount>0)
                                        <p class="price"> <span class="price-new">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span> <span class="price-old">{{number_format($item->price)}} تومان</span> <span class="saving">-{{$item->discount}}%</span> </p>
                                        @else
                                            <p class="price"> {{number_format($item->price)}} تومان </p>
                                            @endif
                                    </div>
                                    <div class="button-group">
                                        <button class="btn-primary" onclick="addcart(this,'{{$item->id}}')" type="button"><span>افزودن به سبد</span></button>
                                        <div class="add-to-links">
                                            @php
                                                $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                            @endphp
                                            @if(empty($favorite))
                                                <button type="button" onclick="favorite(this,{{$item->id}})" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                            @else
                                                <button style="color: black" type="button" onclick="favorite(this,{{$item->id}})" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="tab-bestseller" class="tab_content">
                            <div class="owl-carousel product_carousel_tab">
                                @foreach($products_view as $item)
                                    <div class="product-thumb">
                                        <div class="image"><a href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}" title="{{$item->title}}" class="img-responsive" /></a></div>
                                        <div class="caption">
                                            <h4><a href="/product/{{$item->slug}}">{{str_limit($item->title,40)}}</a></h4>
                                            @if($item->discount>0)
                                                <p class="price"> <span class="price-new">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span> <span class="price-old">{{number_format($item->price)}} تومان</span> <span class="saving">-{{$item->discount}}%</span> </p>
                                            @else
                                                <p class="price"> {{number_format($item->price)}} تومان </p>
                                            @endif
                                        </div>
                                        <div class="button-group">
                                            <button class="btn-primary" onclick="addcart(this,'{{$item->id}}')" type="button"><span>افزودن به سبد</span></button>
                                            <div class="add-to-links">
                                                @php
                                                    $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                @endphp
                                                @if(empty($favorite))
                                                    <button type="button" onclick="favorite(this,{{$item->id}})" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                                @else
                                                    <button style="color: black" type="button" onclick="favorite(this,{{$item->id}})" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div id="tab-special" class="tab_content">
                            <div class="owl-carousel product_carousel_tab">
                                @foreach($spacial_product as $item)
                                    <div class="product-thumb">
                                        <div class="image"><a href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}" title="{{$item->title}}" class="img-responsive" /></a></div>
                                        <div class="caption">
                                            <h4><a href="/product/{{$item->slug}}">{{str_limit($item->title,40)}}</a></h4>
                                            @if($item->discount>0)
                                                <p class="price"> <span class="price-new">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span> <span class="price-old">{{number_format($item->price)}} تومان</span> <span class="saving">-{{$item->discount}}%</span> </p>
                                            @else
                                                <p class="price"> {{number_format($item->price)}} تومان </p>
                                            @endif
                                        </div>
                                        <div class="button-group">
                                            <button class="btn-primary" onclick="addcart(this,'{{$item->id}}')" type="button"><span>افزودن به سبد</span></button>
                                            <div class="add-to-links">
                                                @php
                                                    $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                @endphp
                                                @if(empty($favorite))
                                                    <button type="button" onclick="favorite(this,{{$item->id}})" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                                @else
                                                    <button style="color: black" type="button" onclick="favorite(this,{{$item->id}})" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>    <!-- محصولات Tab Start -->
                    <!-- Banner Start -->
                    <div class="marketshop-banner">
                        <div class="row">
                            @foreach($banners as $banner)
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12"><a href="{{$banner->link}}"><img src="{{asset($banner->imgPath)}}" alt="{{$banner->imgName}}" title="{{$banner->imgName}}" /></a></div>
                            @endforeach
                        </div>
                    </div>
                    <!-- Banner End -->
                    <!-- دسته ها محصولات Slider Start-->
                    <div class="category-module" id="latest_category">
                        <h3 class="subtitle">محصولات دارای تخفیف </h3>
                        <div class="category-module-content">

                                <div class="owl-carousel latest_category_tabs">
                                    @foreach($products_discount as $item)
                                    <div class="product-thumb">
                                        <div class="image"><a href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}" title="{{$item->title}}" class="img-responsive" /></a></div>
                                        <div class="caption">
                                            <h4><a href="{{$item->slug}}">{{str_limit($item->title,50)}}</a></h4>
                                            <p class="price"> <span class="price-new">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span> <span class="price-old">{{number_format($item->price)}} تومان</span> <span class="saving">-{{$item->discount}}%</span> </p>
{{--                                            <div class="rating"> --}}
{{--                                                <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span> --}}
{{--                                            </div>--}}
                                        </div>
                                        <div class="button-group">
                                            <button onclick="addcart(this,'{{$item->id}}')" class="btn-primary" type="button" onClick=""><span>افزودن به سبد</span></button>
                                            <div class="add-to-links">
                                                @php
                                                    $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$item->id])->first()
                                                @endphp
                                                @if(empty($favorite))
                                                <button type="button" onclick="favorite(this,{{$item->id}})" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                                @else
                                                    <button style="color: black" type="button" onclick="favorite(this,{{$item->id}})" data-toggle="tooltip" title="افزودن به علاقه مندی" onClick=""><i class="fa fa-heart"></i></button>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                    </div>
                    <!-- دسته ها محصولات Slider End-->

                        <!-- Blog Section Begin -->
                        <h3 class="subtitle">  مقالات </h3>
                        <section class="from-blog spad">
                            <div class="container">

                                <div class="row">
                                    @foreach($posts as $post)
                                        <div class="col-lg-4 col-md-4 col-sm-6">
                                            <div class="blog__item">
                                                <div class="blog__item__pic">
                                                    <img src="{{asset($post->imgPath)}}" alt="">
                                                </div>
                                                <div class="blog__item__text">
                                                    <ul>
                                                        <li><i class="fa fa-calendar-o"></i>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</li>
                                                        <li><i class="fa fa-comment-o"></i> 5</li>
                                                    </ul>
                                                    <h5><a href="/blog/{{$post->slug}}">{{str_limit($post->title,50)}}</a></h5>
                                                    <p>{{str_limit($post->shortContent,100)}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </section>
                        <!-- Blog Section End -->
                    <!-- برند Logo Carousel Start-->
                    <div id="carousel" class="owl-carousel nxt">
                        @foreach($brands as $brand)
                        <div class="item text-center"> <a href="{{$brand->link}}"><img style="width: 100px" src="{{asset($brand->imgPath)}}" alt="{{$brand->title}}" title="{{$brand->title}}" class="img-responsive" /></a> </div>
                        @endforeach
                    </div>
                    <!-- برند Logo Carousel End -->
                </div>
                <!--Middle Part End-->
            </div>
        </div>
    </div>
    <!-- Feature Box Start-->
    <div class="container">
        <div class="custom-feature-box row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="feature-box fbox_1">
                    <div class="title">ارسال رایگان</div>
                    <p>برای خرید های بیش از 100 هزار تومان</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="feature-box fbox_2">
                    <div class="title">پس فرستادن رایگان</div>
                    <p>بازگشت کالا تا 24 ساعت پس از خرید</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="feature-box fbox_3">
                    <div class="title">کارت هدیه</div>
                    <p>بهترین هدیه برای عزیزان شما</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="feature-box fbox_4">
                    <div class="title">امتیازات خرید</div>
                    <p>از هر خرید امتیاز کسب کرده و از آن بهره بگیرید</p>
                </div>
            </div>
        </div>
    </div>
    <!-- Feature Box End-->
    <!--Footer Start-->
@endsection
