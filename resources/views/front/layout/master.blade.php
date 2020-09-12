@php
    $options=App\Setting::all();
    $setting = array();
        foreach ($options as $option) {
            $name = $option['setting'];
            $value = $option['value'];
            $setting[$name] = $value;
        }
        //dd(Auth::user())


$carts = Gloudemans\Shoppingcart\Facades\Cart::content();
$countcart = Gloudemans\Shoppingcart\Facades\Cart::content()->count();
$total_price = Gloudemans\Shoppingcart\Facades\Cart::subtotal(00);
if(!isset($countcart)){
    $countcart = 0;
}
if(!isset($total_price)){
    $total_price = 0;
}

@endphp
    <!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Home Version Four || limupa - Digital Products Store ECommerce Bootstrap 4 Template</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png">
    <!-- Material Design Iconic Font-V2.2.0 -->
    <link rel="stylesheet" href="{{asset('limupa/css/material-design-iconic-font.min.css/')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('limupa/css/font-awesome.min.css')}}">
    <!-- Font Awesome Stars-->
    <link rel="stylesheet" href="{{asset('limupa/css/fontawesome-stars.css')}}">
    <!-- Meanmenu CSS -->
    <link rel="stylesheet" href="{{asset('limupa/css/meanmenu.css')}}">
    <!-- owl carousel CSS -->
    <link rel="stylesheet" href="{{asset('limupa/css/owl.carousel.min.css')}}">
    <!-- Slick Carousel CSS -->
    <link rel="stylesheet" href="{{asset('limupa/css/slick.css')}}">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{asset('limupa/css/animate.css')}}">
    <!-- Jquery-ui CSS -->
    <link rel="stylesheet" href="{{asset('limupa/css/jquery-ui.min.css')}}">
    <!-- Venobox CSS -->
    <link rel="stylesheet" href="{{asset('limupa/css/venobox.css')}}">
    <!-- Nice Select CSS -->
    <link rel="stylesheet" href="{{asset('limupa/css/nice-select.css')}}">
    <!-- Magnific Popup CSS -->
    <link rel="stylesheet" href="{{asset('limupa/css/magnific-popup.css')}}">
    <!-- Bootstrap V4.1.3 Fremwork CSS -->
    <link rel="stylesheet" href="{{asset('limupa/css/bootstrap.min.css')}}">
    <!-- Helper CSS -->
    <link rel="stylesheet" href="{{asset('limupa/css/helper.css')}}">
    <!-- Main Style CSS -->
    <link rel="stylesheet" href="{{asset('limupa/css/style.css')}}">
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="{{asset('limupa/css/responsive.css')}}">
@yield('style_link')
    <!-- Modernizr js -->
    <script src="{{asset('limupa/js/vendor/modernizr-2.8.3.min.js')}}"></script>
    <style>
        .invalid-feedback{
            display: block;
            font-size: 12px;
            color: red;

        }
        .product_name{
            direction: rtl;
        }
        .product_desc .product_desc_info .price-box{
            text-align: center;
        }
        .product_desc .product_desc_info .price-box span{
            float: unset;
            display: block;
            padding: 0;
        }
        .product_desc .product_desc_info .product_name{
            text-align: center;
        }
        .result-search{
            width: 71%;
            height: 200px;
            background: #fff;
            margin-top: 43px;
            overflow-y: scroll;
            z-index: 106;
            position: absolute;
            box-shadow:1px 1px 3px 0px #ccc
            margin-right: 1px;
            display: none;
            overflow-x: hidden;
        }
    </style>
    @yield('style')

</head>
<body>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
<![endif]-->
<!-- Begin Body Wrapper -->
<div class="body-wrapper">
    <!-- Begin Header Area -->
    <header class="li-header-4">
        <!-- Begin Header Top Area -->
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <!-- Begin Header Top Left Area -->
                    <div class="col-lg-4 col-md-4">
                        <div class="header-top-left">
                            <ul class="phone-wrap" style="display: flex">
                                <li><i style="color: #fff" class="fa fa-envelope"></i><span> ایمیل : </span><a>{{$setting['email']}}</a></li>
                                <li style="margin-right: 15px"><i style="color: #fff;margin-left: 5px" class="fa fa-phone"></i><span>تلفن :</span><a>{{$setting['tell']}}</a></li>
                            </ul>
                        </div>
                    </div>
                    <!-- Header Top Left Area End Here -->
                    <!-- Begin Header Top Right Area -->
                    <div class="col-lg-8 col-md-8">
                        <div class="header-top-right">
                            <ul class="ht-menu">
                                <!-- Begin Setting Area -->
                                @if(Auth::check())
                                    <li>
                                        <a href="/panel">ورود به پروفایل</a>
                                    </li>
                            @else
                                    <li>
                                        <a href="/login">ورود</a>
                                    </li>
                                    <li>
                                        <a href="/register">ثبت نام</a>
                                    </li>
                                    @endif
                                <!-- Setting Area End Here -->
                                <!-- Begin Currency Area -->

                                <!-- Currency Area End Here -->
                                <!-- Begin Language Area -->

                                <!-- Language Area End Here -->
                            </ul>
                        </div>
                    </div>
                    <!-- Header Top Right Area End Here -->
                </div>
            </div>
        </div>
        <!-- Header Top Area End Here -->
        <!-- Begin Header Middle Area -->
        <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
            <div class="container">
                <div class="row">
                    <!-- Begin Header Logo Area -->
                    <div class="col-lg-3">
                        <div class="logo pb-sm-30 pb-xs-30">
                            <a href="/">
                                <img style="max-width: 200px;" src="{{asset($setting['logo'])}}" alt="">
                            </a>
                        </div>
                    </div>
                    <!-- Header Logo Area End Here -->
                    <!-- Begin Header Middle Right Area -->
                    <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                        <!-- Begin Header Middle Searchbox Area -->
                        <form class="hm-searchbox">
                            <input onkeyup="search_header()" type="text" name="search" placeholder="کلید جستجو خود را وارد کنید ...">
                            <button onclick="search_header()" class="li-btn"><i class="fa fa-search"></i></button>
                        </form>
                        <div class="result-search">

                        </div>
                        <!-- Header Middle Searchbox Area End Here -->
                        <!-- Begin Header Middle Right Area -->
                        <div class="header-middle-right">
                            <ul class="hm-menu">
                                <!-- Begin Header Middle Wishlist Area -->
                                <li class="hm-wishlist">
                                    <a href="/panel/favorites">
                                        @php $favorites=App\Favorite::with('product')->where('user_id',Auth::id())->get(); @endphp
                                        <span class="cart-item-count wishlist-item-count">{{count($favorites)}}</span>
                                        <i class="fa fa-heart-o"></i>
                                    </a>
                                </li>
                                <!-- Header Middle Wishlist Area End Here -->
                                <!-- Begin Header Mini Cart Area -->
                                <li class="hm-minicart">
                                    <div class="hm-minicart-trigger">
                                        <span class="item-icon"></span>
                                        <span  class="item-text"><span id="p-t">{{$total_price}} ت </span>
                                                    <span id="cart-total" class="cart-item-count">{{$countcart}}</span>
                                                </span>
                                    </div>
                                    <span></span>
                                    <div class="minicart">
                                        <ul class="minicart-product-list carts_table">
                                            @foreach($carts as $cart)
                                            <li>
                                                <a href="/product/{{$cart->options->product_slug}}" class="minicart-product-image">
                                                    <img src="{{$cart->options->image}}" alt="cart products">
                                                </a>
                                                <div class="minicart-product-details">
                                                    <h6><a href="/product/{{$cart->options->product_slug}}">{{$cart->name}} </a></h6>
                                                    <span>{{number_format($cart->price)}}  تومان x <span id="cartCount">{{$cart->qty}}</span></span>
                                                </div>
                                                <button onclick="removecart(this, '{{$cart->rowId}}')" class="close" title="Remove">
                                                    <i class="fa fa-close"></i>
                                                </button>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <p class="minicart-total">مجموع: <label style="padding: 0 5px 0 0;float: left"> تومان </label><span> {{$total_price}}</span>  </p>
                                        <div class="minicart-button">
                                           {{-- <a href="shopping-cart.html" class="li-button li-button-fullwidth li-button-dark">
                                                <span>مشاهده سبد خرید</span>
                                            </a>--}}
                                            <a href="/checkout" class="li-button li-button-fullwidth">
                                                <span>پرداخت</span>
                                            </a>
                                        </div>
                                    </div>
                                </li>
                                <!-- Header Mini Cart Area End Here -->
                            </ul>
                        </div>
                        <!-- Header Middle Right Area End Here -->
                    </div>
                    <!-- Header Middle Right Area End Here -->
                </div>
            </div>
        </div>
        <!-- Header Middle Area End Here -->
        <!-- Begin Header Bottom Area -->
        <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Header Bottom Menu Area -->
                        <div class="hb-menu">
                            <nav>
                                <ul>
                                    <li><a href="/">خانه</a></li>
                                    @php
                                        $categories = App\Category::where('parent', '0')->get();
                                    @endphp
                                    @foreach($categories as $category)
                                    <li class="dropdown-holder"><a href="/shop?cat={{$category->slug}}">{{$category->title}}</a>
                                        @php
                                            $categories2=App\Category::where('parent',$category->id)->get();
                                        @endphp
                                        @if(count($categories2))
                                        <ul class="hb-dropdown" >
                                            @foreach($categories2 as $category2)
                                                @php
                                                    $categories3=App\Category::where('parent',$category2->id)->get();
                                                @endphp
                                            <li @if(count($categories3)) class="sub-dropdown-holder" @endif><a href="/shop?cat={{$category2->slug}}">{{$category2->title}}</a>
                                                @if(count($categories3))
                                                <ul class="hb-dropdown hb-sub-dropdown">
                                                    @foreach($categories3 as $category3)
                                                    <li><a href="/shop?cat={{$category3->slug}}">{{$category3->title}}</a></li>
                                                    @endforeach
                                                </ul>
                                                    @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                            @endif
                                    </li>
                                    @endforeach
                                    <li><a href="/blog"> مقالات</a></li>
                                    <li><a href="/about">درباره ما</a></li>
                                    <li><a href="/contact">تماس با ما</a></li>
                                </ul>
                            </nav>
                        </div>
                        <!-- Header Bottom Menu Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Header Bottom Area End Here -->
        <!-- Begin Mobile Menu Area -->
        <div class="mobile-menu-area mobile-menu-area-4 d-lg-none d-xl-none col-12">
            <div class="container">
                <div class="row">
                    <div class="mobile-menu">
                    </div>
                </div>
            </div>
        </div>
        <!-- Mobile Menu Area End Here -->
    </header>
    <!-- Header Area End Here -->
@yield('content')

<!-- Begin Footer Area -->
    <div class="footer">
        <!-- Begin Footer Static Top Area -->
        <div class="footer-static-top">
            <div class="container">
                <!-- Begin Footer Shipping Area -->
                <div class="footer-shipping pt-60 pb-25">
                    <div class="row">
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{asset('limupa/images/shipping-icon/1.png')}}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>تحویل رایگان</h2>
                                    <p>و بازده آزاد. مراجعه به تاریخ تحویل را مشاهده کنید.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-sm-55 pb-xs-55">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{asset('limupa/images/shipping-icon/2.png')}}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>پرداخت امن</h2>
                                    <p>پرداخت با روش های رایج ترین و مطمئن ترین روش های پرداخت در جهان.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{asset('limupa/images/shipping-icon/3.png')}}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>فروشگاه با اعتماد به نفس</h2>
                                    <p>محافظ خریدار ما خرید شما را از طریق کلیک بر روی تحویل پوشش می دهد.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                        <!-- Begin Li's Shipping Inner Box Area -->
                        <div class="col-lg-3 col-md-6 col-sm-6 pb-xs-30">
                            <div class="li-shipping-inner-box">
                                <div class="shipping-icon">
                                    <img src="{{asset('limupa/images/shipping-icon/4.png')}}" alt="Shipping Icon">
                                </div>
                                <div class="shipping-text">
                                    <h2>مرکز راهنمای 24/7</h2>
                                    <p>یک سؤال دارید؟ با یک متخصص یا چت آنلاین تماس بگیرید.</p>
                                </div>
                            </div>
                        </div>
                        <!-- Li's Shipping Inner Box Area End Here -->
                    </div>
                </div>
                <!-- Footer Shipping Area End Here -->
            </div>
        </div>
        <!-- Footer Static Top Area End Here -->
        <!-- Begin Footer Static Middle Area -->
        <div class="footer-static-middle">
            <div class="container">
                <div class="footer-logo-wrap pt-50 pb-35">
                    <div class="row">
                        <!-- Begin Footer Logo Area -->
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-logo">
                                <img style="max-width: 200px;" src="{{asset($setting['logo'])}}" alt="Footer Logo">
                            </div>
                            <ul class="des">
                                <li>
                                    <span>آدرس: </span>
                                    {{$setting['address']}}
                                </li>
                                <li>
                                    <span>تلفن: </span>
                                    <a href="callto://+123123321345">{{$setting['tell']}}</a>
                                </li>
                                <li>
                                    <span>موبایل: </span>
                                    <a href="callto://+123123321345">{{$setting['mobile']}}</a>
                                </li>
                                <li>
                                    <span>ایمیل: </span>
                                    <a href="mailto://info@yourdomain.com">{{$setting['email']}}</a>
                                </li>
                            </ul>
                        </div>
                        <!-- Footer Logo Area End Here -->
                        <!-- Begin Footer Block Area -->
                        <div class="col-lg-2 col-md-3 col-sm-6">
                            <div class="footer-block">
                                <h3 class="footer-block-title">دسترسی سریع</h3>
                                <ul>
                                    <li><a href="/">صفحه اصلی</a></li>
                                    <li><a href="/shop">فروشگاه</a></li>
                                    <li><a href="/blog">مقالات</a></li>
                                    <li><a href="/about">درباره ما</a></li>
                                    <li><a href="/contact">تماس با ما</a></li>
                                </ul>
                            </div>
                        </div>
                        <!-- Footer Block Area End Here -->
                        <!-- Begin Footer Block Area -->
                        <div class="col-lg-2 col-md-3 col-sm-6">
                            <div class="footer-block">
                                <h3 class="footer-block-title"> حساب من</h3>
                                <ul>
                                    <li><a href="/panel">حساب کاربری</a></li>
                                    <li><a href="/panel/orders">تاریخچه سفارشات</a></li>
                                    <li><a href="/panel/favorites">لیست علاقه مندی</a></li>
                                    <li><a href="/panel/profile">اطلاعات حساب</a></li>

                                </ul>
                            </div>
                        </div>
                        <!-- Footer Block Area End Here -->
                        <!-- Begin Footer Block Area -->
                        <div class="col-lg-4">
                            <div class="footer-block">
                                <h3 class="footer-block-title">دنبال کردن ما</h3>
                                <ul class="social-link">
                                    @if($setting['twitter']!="")
                                    <li class="twitter">
                                        <a href="{{$setting['twitter']}}" data-toggle="tooltip" target="_blank" title="توییتر">
                                            <i class="fa fa-twitter"></i>
                                        </a>
                                    </li>
                                    @endif
                                        @if($setting['facebook']!="")
                                    <li class="facebook">
                                        <a href="{{$setting['facebook']}}" data-toggle="tooltip" target="_blank" title="فیسبوک">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    </li>
                                        @endif
                                        @if($setting['instagram']!="")
                                    <li class="instagram">
                                        <a href="{{$setting['instagram']}}" data-toggle="tooltip" target="_blank" title="اینستاگرام">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    </li>
                                      @endif
                                        @if($setting['telegram']!="")
                                            <li class="telegram">
                                                <a href="{{$setting['telegram']}}" data-toggle="tooltip" target="_blank" title="اینستاگرام">
                                                    <i class="fa fa-telegram"></i>
                                                </a>
                                            </li>
                                        @endif
                                </ul>
                            </div>
                            <!-- Begin Footer Newsletter Area -->
                            <div class="footer-newsletter">
                                <h4>ثبت نام برای خبرنامه</h4>
                                <form action="http://devitems.us11.list-manage.com/subscribe/post?u=6bbb9b6f5827bd842d9640c82&amp;id=05d85f18ef" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="footer-subscribe-form validate" target="_blank" novalidate>
                                    <div id="mc_embed_signup_scroll">
                                        <div id="mc-form" class="mc-form subscribe-form form-group" >
                                            <input id="mc-email" type="email" autocomplete="off" placeholder="ایمیل خود را وارد کنید" />
                                            <button  class="btn" id="mc-submit">اشتراک</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Footer Newsletter Area End Here -->
                        </div>
                        <!-- Footer Block Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Static Middle Area End Here -->
        <!-- Begin Footer Static Bottom Area -->
        <div class="footer-static-bottom pt-55 pb-55">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Begin Footer Links Area -->

                        <!-- Footer Payment Area End Here -->
                        <!-- Begin Copyright Area -->
                        <div class="copyright text-center pt-25">
                            <span>2020 طراحی و توسعه توسط شرکت <a href="https://imtit.com/">فناوری ریزپردازنده فراهوش</a></span>
                        </div>
                        <!-- Copyright Area End Here -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer Static Bottom Area End Here -->
    </div>
    <!-- Footer Area End Here -->
    <!-- Begin Quick View | Modal Area -->
    <div class="modal fade modal-wrapper" id="exampleModalCenter" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="close" data-dismiss="modal" aria-label="بستن">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="modal-inner-area row">
                        <div class="col-lg-5 col-md-6 col-sm-6">
                            <!-- Product Details Left -->
                            <div class="product-details-left">
                                <div class="product-details-images slider-navigation-1">
                                    <div class="lg-image">
                                        <img src="images/product/large-size/1.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/2.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/3.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/4.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/5.jpg" alt="product image">
                                    </div>
                                    <div class="lg-image">
                                        <img src="images/product/large-size/6.jpg" alt="product image">
                                    </div>
                                </div>
                                <div class="product-details-thumbs slider-thumbs-1">
                                    <div class="sm-image"><img src="images/product/small-size/1.jpg" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/2.jpg" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/3.jpg" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/4.jpg" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/5.jpg" alt="product image thumb"></div>
                                    <div class="sm-image"><img src="images/product/small-size/6.jpg" alt="product image thumb"></div>
                                </div>
                            </div>
                            <!--// Product Details Left -->
                        </div>

                        <div class="col-lg-7 col-md-6 col-sm-6">
                            <div class="product-details-view-content pt-60">
                                <div class="product-info">
                                    <h2>امروز یک پوستر خوب روز طراحی شده است</h2>
                                    <span class="product-details-ref">مرجع: demo_15</span>
                                    <div class="rating-box pt-20">
                                        <ul class="rating rating-with-review-item">
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="no-star"><i class="fa fa-star-o"></i></li>
                                            <li class="review-item"><a href="#">دفعات بازدید: بررسی</a></li>
                                            <li class="review-item"><a href="#">نوشتن نظر</a></li>
                                        </ul>
                                    </div>
                                    <div class="price-box pt-20">
                                        <span class="new-price new-price-2">57.98 تومان</span>
                                    </div>
                                    <div class="product-desc">
                                        <p>
                                                    <span>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد.
                                                    </span>
                                        </p>
                                    </div>
                                    <div class="product-variants">
                                        <div class="produt-variants-size">
                                            <label>ابعاد</label>
                                            <select class="nice-select">
                                                <option value="1" title="S" selected="selected">40x60cm</option>
                                                <option value="2" title="M">60x90cm</option>
                                                <option value="3" title="L">80x120cm</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="single-add-to-cart">
                                        <form action="#" class="cart-quantity">
                                            <div class="quantity">
                                                <label>تعداد</label>
                                                <div class="cart-plus-minus">
                                                    <input class="cart-plus-minus-box" value="1" type="text">
                                                    <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                                    <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                                </div>
                                            </div>
                                            <button class="add-to-cart" type="submit">افزودن به سبد خرید</button>
                                        </form>
                                    </div>
                                    <div class="product-additional-info pt-25">
                                        <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>افزودن به علاقه مندی ها</a>
                                        <div class="product-social-sharing pt-25">
                                            <ul>
                                                <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>فیسبوک</a></li>
                                                <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>توییتر</a></li>
                                                <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>گوگل +</a></li>
                                                <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>اینستاگرام</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Quick View | Modal Area End Here -->
</div>

<!--//////////////////// JS GOES HERE ////////////////-->
<script src="{{asset('limupa/js/vendor/jquery-1.12.4.min.js')}}"></script>
<!-- Popper js -->
<script src="{{asset('limupa/js/vendor/popper.min.js')}}"></script>
<!-- Bootstrap V4.1.3 Fremwork js -->
<script src="{{asset('limupa/js/bootstrap.min.js')}}"></script>
<!-- Ajax Mail js -->
<script src="{{asset('limupa/js/ajax-mail.js')}}"></script>
<!-- Meanmenu js -->
<script src="{{asset('limupa/js/jquery.meanmenu.min.js')}}"></script>
<!-- Wow.min js -->
<script src="{{asset('limupa/js/wow.min.js')}}"></script>
<!-- Slick Carousel js -->
<script src="{{asset('limupa/js/slick.min.js')}}"></script>
<!-- Owl Carousel-2 js -->
<script src="{{asset('limupa/js/owl.carousel.min.js')}}"></script>
<!-- Magnific popup js -->
<script src="{{asset('limupa/js/jquery.magnific-popup.min.js')}}"></script>
<!-- Isotope js -->
<script src="{{asset('limupa/js/isotope.pkgd.min.js')}}"></script>
<!-- Imagesloaded js -->
<script src="{{asset('limupa/js/imagesloaded.pkgd.min.js')}}"></script>
<!-- Mixitup js -->
<script src="{{asset('limupa/js/jquery.mixitup.min.js')}}"></script>
<!-- Countdown -->
<script src="{{asset('limupa/js/jquery.countdown.min.js')}}"></script>
<!-- Counterup -->
<script src="{{asset('limupa/js/jquery.counterup.min.js')}}"></script>
<!-- Waypoints -->
<script src="{{asset('limupa/js/waypoints.min.js')}}"></script>
<!-- Barrating -->
<script src="{{asset('limupa/js/jquery.barrating.min.js')}}"></script>
<!-- Jquery-ui -->
<script src="{{asset('limupa/js/jquery-ui.min.js')}}"></script>
<!-- Venobox -->
<script src="{{asset('limupa/js/venobox.min.js')}}"></script>
<!-- Nice Select js -->
<script src="{{asset('limupa/js/jquery.nice-select.min.js')}}"></script>
<!-- ScrollUp js -->
<script src="{{asset('limupa/js/scrollUp.min.js')}}"></script>
<!-- Main/Activator js -->
<script src="{{asset('limupa/js/main.js')}}"></script>

<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.rtl.min.css"/>
<link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.rtl.min.css"/>
<!-- JS Part End-->
@yield('script_link')
@yield('script')
<script>
    function number_3_3(num, sep) {
        var number = typeof num === "number" ? num.toString() : num,
            separator = typeof sep === "undefined" ? ',' : sep;
        return number.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1" + separator);
    }

    function search_header() {
        var search=$('input[name=search]').val();
        $('.result-search').empty();
        if (search.length>=3){
            var CSRF_TOKEN = '{{ csrf_token() }}';
            var url = '{{route('search.search')}}';
            var data = {_token: CSRF_TOKEN,search:search};
            $.post(url, data, function (msg) {
                $('.result-search').show();
                $('.result-search').append(msg)
            });
        }else{
            $('.result-search').hide();
        }
    }
    $('main').click(function () {
        $('.result-search').empty();
        $('.result-search').hide();
    })
    $('.header').click(function () {
        $('.result-search').empty();
        $('.result-search').hide();
    })

    function header(header) {
        window.location.replace(header);
    }
</script>
<script>

    function openNav() {
        document.getElementById("mySidenav").style.width = "320px";
        $('.humberger__menu__overlay').addClass('active');
    }

    /* Set the width of the side navigation to 0 */
    function closeNav() {
        document.getElementById("mySidenav").style.width = "0";
        $('.humberger__menu__overlay').removeClass('active')
    }

    $('.humberger__menu__overlay').click(function () {
        document.getElementById("mySidenav").style.width = "0";
    })
    $("input[name='demo3']").TouchSpin({
        min: 1,
    });

</script>
<script>

    function addcart(item, id) {

        $('.carts_table').html('');
        $.ajax({
            type: "post",
            url: "/addcart",
            data: {
                id: id,
                _token: '{{csrf_token()}}',
            },
            dataType: 'json',
            success: function (data) {
                $('#cart-total').html(data.countcart);
                $('#cartCount').html(data.msg);
                $('.minicart-total span').html(data.total);
                $('#p-t').html(data.total+' ت ');
                $.each(data.msg, function (index, value) {
                    var rowId = "'" + value['rowId'].toString() + "'";
                    $('.carts_table').append(' <li>\n' +
                        '                                                <a href="/product/'+value['options']['product_slug']+'" class="minicart-product-image">\n' +
                        '                                                    <img src="' + value['options']['image'] + '" alt="cart products">\n' +
                        '                                                </a>\n' +
                        '                                                <div class="minicart-product-details">\n' +
                        '                                                    <h6><a href="/product/'+value['options']['product_slug']+'">' + value['name'] + ' </a></h6>\n' +
                        '                                                    <span>' + number_3_3(value['price']) + '  تومان x ' + value['qty'] + '</span>\n' +
                        '                                                </div>\n' +
                        '                                                <button onclick="removecart(this, ' + rowId + ')" class="close" title="Remove">\n' +
                        '                                                    <i class="fa fa-close"></i>\n' +
                        '                                                </button>\n' +
                        '                                            </li> ');
                });

             /*   $("input[name='demo3']").TouchSpin({
                    min: 1,
                });*/


                $('.input-group-btn button').on("click touchstart", function (event) {

                    var el = $(this).parents('.bootstrap-touchspin').find('.form-control');

                    var qyt = el.val();
                    var id = $(el).attr('data-product-id');

                    $.ajax({
                        type: "post",
                        url: "/updatecart",
                        data: {
                            qyt: qyt,
                            id: id,
                            _token: '{{csrf_token()}}',
                        },
                        dataType: 'json',
                        success: function (data) {
                            console.log(data.msg);
                            $('#cartCount').html(data.countcart);
                            $('#cartDiscountT').html(data.total);
                            alertify.set('notifier', 'position', 'bottom-left');
                            alertify.success('سبد خرید بروزرسانی شد');
                        },
                        error: function (err) {
                            if (err.status == 422) {
                                $('#error_user').slideDown(100);
                                $.each(err.responseJSON.errors, function (i, error) {
                                    $('#error_item').append($('<span style="color: white;">' + error[
                                            0] +
                                        '</span><br>'));
                                });
                            }
                        }
                    });
                });
                alertify.set('notifier', 'position', 'bottom-left');
                alertify.success('به سبد خرید اضافه شد');
            },
            error: function (err) {
                if (err.status == 422) {
                    $('#error_user').slideDown(100);
                    $.each(err.responseJSON.errors, function (i, error) {
                        $('#error_item').append($('<span style="color: white;">' + error[
                                0] +
                            '</span><br>'));
                    });
                }
            }
        });

    }
</script>
<script>
    function removecart(item, id) {
        console.log(id);
        $.ajax({
            type: "post",
            url: "/removecart",
            data: {
                id: id,
                _token: '{{csrf_token()}}',
            },
            dataType: 'json',
            success: function (data) {
                $(item).parents('.minicart-product-list li').remove();
                $('#cart-total').html(data.countcart);
                $('#cartCount').html(data.countcart);
                $('.minicart-total span').html(data.total);
                $('#p-t').html(data.total+' ت ');
                alertify.set('notifier', 'position', 'bottom-left');
                alertify.success('محصول از سبد خرید حذف شد');
            },
            error: function (err) {
                if (err.status == 422) {
                    $('#error_user').slideDown(100);
                    $.each(err.responseJSON.errors, function (i, error) {
                        $('#error_item').append($('<span style="color: white;">' + error[
                                0] +
                            '</span><br>'));
                    });
                }
            }
        });
    }


    $('.input-group-btn button').on("click touchstart", function (event) {

        var el = $(this).parents('.bootstrap-touchspin').find('.form-control');

        var qyt = el.val();
        var id = $(el).attr('data-product-id');

        $.ajax({
            type: "post",
            url: "/updatecart",
            data: {
                qyt: qyt,
                id: id,
                _token: '{{csrf_token()}}',
            },
            dataType: 'json',
            success: function (data) {
                console.log(data.msg);
                $('#cartCount').html(data.countcart);
                $('#cartDiscountT').html(data.total);
                alertify.set('notifier', 'position', 'bottom-left');
                alertify.success('سبد خرید بروزرسانی شد');
            },
            error: function (err) {
                if (err.status == 422) {
                    $('#error_user').slideDown(100);
                    $.each(err.responseJSON.errors, function (i, error) {
                        $('#error_item').append($('<span style="color: white;">' + error[
                                0] +
                            '</span><br>'));
                    });
                }
            }
        });
    });

</script>
<script>


    function favorite(tag, id) {
            @if(Auth::check())
        var count = $('.openfavorites span').html();
        var CSRF_TOKEN = '{{ csrf_token() }}';
        var url = '{{route('panel.add_remove_favorite')}}';
        var data = {_token: CSRF_TOKEN, id: id};
        $.post(url, data, function (msg) {
            if (msg == "add") {
                $(tag).css('color', 'red');
                alertify.set('notifier', 'position', 'bottom-left');
                count=parseInt(count)+1;
                $('.openfavorites span').html(count);
                alertify.success('با موفقیت به لیست علاقه مندی اضافه شد');
            } else if (msg == "deleted") {
                $(tag).css('color', '#000000');
                count=parseInt(count)-1;
                $('.openfavorites span').html(count);
                alertify.set('notifier', 'position', 'bottom-left');
                alertify.success('با موفقیت از لیست علاقه مندی حذف شد');
            }
        });
        @else
            window.location = "/login";

        @endif
    }


</script>
</body>
</html>
