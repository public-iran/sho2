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
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- viewport meta -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="MartPlace - Complete Online Multipurpose Marketplace HTML Template">
    <meta name="keywords" content="marketplace, easy digital download, digital product, digital, html5">


    <title>دریا </title>

    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('darya/css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('darya/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('darya/css/fontello.css')}}">
    <link rel="stylesheet" href="{{asset('darya/css/jquery-ui.css')}}">
    <link rel="stylesheet" href="{{asset('darya/css/lnr-icon.css')}}">
    <link rel="stylesheet" href="{{asset('darya/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('darya/css/slick.css')}}">
    <link rel="stylesheet" href="{{asset('darya/css/trumbowyg.min.css')}}">
    <link rel="stylesheet" href="{{asset('darya/css/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('darya/css/style.css')}}">
    <!-- endinject -->
    @yield('style_link')
    @yield('style')
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
</head>

<body class="preload home1 mutlti-vendor">

<!-- ================================
START MENU AREA
================================= -->
<!-- start menu-area -->
<div class="menu-area dir-rtl">
    <!-- start .top-menu-area -->
    <div class="top-menu-area">
        <!-- start .container -->
        <div class="container">
            <!-- start .row -->
            <div class="row">
                <!-- start .col-md-3 -->
                <div class="col-lg-3 col-md-3 col-6 v_middle">
                    <div class="logo">
                        <a href="index.html">
                            <img src="images/logo.png" alt="logo image" class="img-fluid">
                        </a>
                    </div>
                </div>
                <!-- end /.col-md-3 -->

                <!-- start .col-md-5 -->
                <div class="col-lg-8 offset-lg-1 col-md-9 col-6 v_middle">
                    <!-- start .author-area -->
                    <div class="author-area">
                        <a href="signup.html" class="author-area__seller-btn inline">تبدیل به یک فروشنده</a>

                        <div class="author__notification_area">
                            <ul>
                                <li class="has_dropdown">
                                    <div class="icon_wrap">
                                        <span class="lnr lnr-alarm"></span>
                                        <span class="notification_count noti">25</span>
                                    </div>

                                    <div class="dropdowns notification--dropdown">

                                        <div class="dropdown_module_header">
                                            <h4>اطلاعیه های من</h4>
                                            <a href="notification.html">نمایش همه </a>
                                        </div>

                                        <div class="notifications_module">
                                            <div class="notification">
                                                <div class="notification__info">
                                                    <div class="info_avatar">
                                                        <img src="images/notification_head.png" alt="">
                                                    </div>
                                                    <div class="info">
                                                        <p>
                                                            <span>اندرسون</span> اضافه شده به علاقه مندی های شما
                                                            <a href="#">قالب psd </a>
                                                        </p>
                                                        <p class="time">همین الان</p>
                                                    </div>
                                                </div>
                                                <!-- end /.notifications -->

                                                <div class="notification__icons ">
                                                    <span class="lnr lnr-heart loved noti_icon"></span>
                                                </div>
                                                <!-- end /.notifications -->
                                            </div>
                                            <!-- end /.notifications -->

                                            <div class="notification">
                                                <div class="notification__info">
                                                    <div class="info_avatar">
                                                        <img src="images/notification_head2.png" alt="">
                                                    </div>
                                                    <div class="info">
                                                        <p>
                                                            <span>به قالب شما </span> نظر داده شد
                                                            <a href="#">قالب فروشگاهی </a>
                                                        </p>
                                                        <p class="time">همین الان</p>
                                                    </div>
                                                </div>
                                                <!-- end /.notifications -->

                                                <div class="notification__icons ">
                                                    <span class="lnr lnr-bubble commented noti_icon"></span>
                                                </div>
                                                <!-- end /.notifications -->
                                            </div>
                                            <!-- end /.notifications -->

                                            <div class="notification">
                                                <div class="notification__info">
                                                    <div class="info_avatar">
                                                        <img src="images/notification_head3.png" alt="">
                                                    </div>
                                                    <div class="info">
                                                        <p>
                                                            <span>قالب  </span>خریداری شد
                                                            <a href="#"> قالب چند فروشندگی ورد پرس</a>
                                                        </p>
                                                        <p class="time">همین الان</p>
                                                    </div>
                                                </div>
                                                <!-- end /.notifications -->

                                                <div class="notification__icons ">
                                                    <span class="lnr lnr-cart purchased noti_icon"></span>
                                                </div>
                                                <!-- end /.notifications -->
                                            </div>
                                            <!-- end /.notifications -->

                                            <div class="notification">
                                                <div class="notification__info">
                                                    <div class="info_avatar">
                                                        <img src="images/notification_head4.png" alt="">
                                                    </div>
                                                    <div class="info">
                                                        <p>
                                                            <span>اندرسون</span> اضافه شده به علاقه مندی های شما
                                                            <a href="#">قالب psd </a>
                                                        </p>
                                                        <p class="time">همین الان</p>
                                                    </div>
                                                </div>
                                                <!-- end /.notifications -->

                                                <div class="notification__icons ">
                                                    <span class="lnr lnr-star reviewed noti_icon"></span>
                                                </div>
                                                <!-- end /.notifications -->
                                            </div>
                                            <!-- end /.notifications -->
                                        </div>
                                        <!-- end /.dropdown -->
                                    </div>
                                </li>

                                <li class="has_dropdown">
                                    <div class="icon_wrap">
                                        <span class="lnr lnr-envelope"></span>
                                        <span class="notification_count msg">6</span>
                                    </div>

                                    <div class="dropdowns messaging--dropdown">
                                        <div class="dropdown_module_header">
                                            <h4>پیام های من</h4>
                                            <a href="message.html">نمایش همه </a>
                                        </div>

                                        <div class="messages">
                                            <a href="message.html" class="message recent">
                                                <div class="message__actions_avatar">
                                                    <div class="avatar">
                                                        <img src="images/notification_head4.png" alt="">
                                                    </div>
                                                </div>
                                                <!-- end /.actions -->

                                                <div class="message_data">
                                                    <div class="name_time">
                                                        <div class="name">
                                                            <p>تم های عالی</p>
                                                            <span class="lnr lnr-envelope"></span>
                                                        </div>

                                                        <span class="time">همین الان</span>
                                                        <p>سلام رضا رضایی! حالا من سرمایه گذاری ...</p>
                                                    </div>
                                                </div>
                                                <!-- end /.message_data -->
                                            </a>
                                            <!-- end /.message -->

                                            <a href="message.html" class="message recent">
                                                <div class="message__actions_avatar">
                                                    <div class="avatar">
                                                        <img src="images/notification_head5.png" alt="">
                                                    </div>
                                                </div>
                                                <!-- end /.actions -->

                                                <div class="message_data">
                                                    <div class="name_time">
                                                        <div class="name">
                                                            <p>دیوانه رمز گذار
                                                                 
                                                            </p>
                                                            <span class="lnr lnr-envelope"></span>
                                                        </div>

                                                        <span class="time">همین الان</span>
                                                        <p>سلام! سرمایه گذاری حال حاضر برای من دوباره ذخیره کنید ...</p>
                                                    </div>
                                                </div>
                                                <!-- end /.message_data -->
                                            </a>
                                            <!-- end /.message -->

                                            <a href="message.html" class="message">
                                                <div class="message__actions_avatar">
                                                    <div class="avatar">
                                                        <img src="images/notification_head6.png" alt="">
                                                    </div>
                                                </div>
                                                <!-- end /.actions -->

                                                <div class="message_data">
                                                    <div class="name_time">
                                                        <div class="name">
                                                            <p>----------</p>
                                                        </div>

                                                        <span class="time">همین الان</span>
                                                        <p>سلام! سرمایه گذاری حال حاضر برای من دوباره ذخیره کنید ...</p>
                                                    </div>
                                                </div>
                                                <!-- end /.message_data -->
                                            </a>
                                            <!-- end /.message -->

                                            <a href="message.html" class="message">
                                                <div class="message__actions_avatar">
                                                    <div class="avatar">
                                                        <img src="images/notification_head3.png" alt="">
                                                    </div>
                                                </div>
                                                <!-- end /.actions -->

                                                <div class="message_data">
                                                    <div class="name_time">
                                                        <div class="name">
                                                            <p>تم X</p>
                                                        </div>

                                                        <span class="time">همین الان</span>
                                                        <p>سلام! سرمایه گذاری حال حاضر برای من دوباره ذخیره کنید ...</p>
                                                    </div>
                                                </div>
                                                <!-- end /.message_data -->
                                            </a>
                                            <!-- end /.message -->

                                            <a href="message.html" class="message">
                                                <div class="message__actions_avatar">
                                                    <div class="avatar">
                                                        <img src="images/notification_head4.png" alt="">
                                                    </div>
                                                </div>
                                                <!-- end /.actions -->

                                                <div class="message_data">
                                                    <div class="name_time">
                                                        <div class="name">
                                                            <p>NukeThemes</p>
                                                            <span class="lnr lnr-envelope"></span>
                                                        </div>

                                                        <span class="time">همین الان</span>
                                                        <p>سلام رضا رضایی! حالا من سرمایه گذاری ...</p>
                                                    </div>
                                                </div>
                                                <!-- end /.message_data -->
                                            </a>
                                            <!-- end /.message -->
                                        </div>
                                    </div>
                                </li>
                                <li class="has_dropdown">
                                    <div class="icon_wrap">
                                        <span class="lnr lnr-cart"></span>
                                        <span class="notification_count purch">2</span>
                                    </div>

                                    <div class="dropdowns dropdown--cart">
                                        <div class="cart_area">
                                            <div class="cart_product">
                                                <div class="product__info">
                                                    <div class="thumbn">
                                                        <img src="images/capro1.jpg" alt="cart product thumbnail">
                                                    </div>

                                                    <div class="info">
                                                        <a class="title" href="single-product.html">قالب ورد پرس
                                                            دریا </a>
                                                        <div class="cat">
                                                            <a href="#">
                                                                <img src="images/catword.png" alt="">ورد پرس </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="product__action">
                                                    <a href="#">
                                                        <span class="lnr lnr-trash"></span>
                                                    </a>
                                                    <p>60 تومان</p>
                                                </div>
                                            </div>
                                            <div class="cart_product">
                                                <div class="product__info">
                                                    <div class="thumbn">
                                                        <img src="images/capro2.jpg" alt="cart product thumbnail">
                                                    </div>

                                                    <div class="info">
                                                        <a class="title" href="single-product.html">قالب فروشگاهی</a>
                                                        <div class="cat">
                                                            <a href="#">
                                                                <img src="images/catword.png" alt="">ورد پرس </a>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="product__action">
                                                    <a href="#">
                                                        <span class="lnr lnr-trash"></span>
                                                    </a>
                                                    <p>60 تومان</p>
                                                </div>
                                            </div>
                                            <div class="total">
                                                <p>
                                                    <span>مجموع :</span>80 تومان</p>
                                            </div>
                                            <div class="cart_action">
                                                <a class="go_cart" href="cart.html">سبد خرید </a>
                                                <a class="go_checkout" href="checkout.html">باز بینی </a>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <!--start .author__notification_area -->

                        <!--start .author-author__info-->
                        <div class="author-author__info inline has_dropdown">
                            <div class="author__avatar">
                                <img src="images/usr_avatar.png" alt="user avatar">

                            </div>
                            <div class="autor__info">
                                <p class="name">
                                    رضا رضایی
                                </p>
                                <!--<p class="ammount">2000 تومان</p>-->
                            </div>

                            <div class="dropdowns dropdown--author">
                                <ul>
                                    <li>
                                        <a href="author.html">
                                            <span class="lnr lnr-user"></span>پروفایل </a>
                                    </li>
                                    <li>
                                        <a href="dashboard.html">
                                            <span class="lnr lnr-home"></span>داشبورد</a>
                                    </li>
                                    <li>
                                        <a href="dashboard-setting.html">
                                            <span class="lnr lnr-cog"></span> تنظیمات</a>
                                    </li>
                                    <li>
                                        <a href="cart.html">
                                            <span class="lnr lnr-cart"></span>خرید ها</a>
                                    </li>
                                    <li>
                                        <a href="favourites.html">
                                            <span class="lnr lnr-heart"></span> علاقه مندی ها </a>
                                    </li>
                                    <li>
                                        <a href="dashboard-add-credit.html">
                                            <span class="lnr lnr-dice"></span>کارت تخفیف</a>
                                    </li>
                                    <li>
                                        <a href="dashboard-statement.html">
                                            <span class="lnr lnr-chart-bars"></span>بیانیه فروش</a>
                                    </li>
                                    <li>
                                        <a href="dashboard-upload.html">
                                            <span class="lnr lnr-upload"></span>آپلود ایتم </a>
                                    </li>
                                    <li>
                                        <a href="dashboard-manage-item.html">
                                            <span class="lnr lnr-book"></span>مدیریت آیتم ها</a>
                                    </li>
                                    <li>
                                        <a href="dashboard-withdrawal.html">
                                            <span class="lnr lnr-briefcase"></span>برداشت ها </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="lnr lnr-exit"></span>خروج </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!--end /.author-author__info-->
                    </div>
                    <!-- end .author-area -->

                    <!-- author area restructured for mobile -->
                    <div class="mobile_content ">
                        <span class="lnr lnr-user menu_icon"></span>

                        <!-- offcanvas menu -->
                        <div class="offcanvas-menu closed">
                            <span class="lnr lnr-cross close_menu"></span>
                            <div class="author-author__info">
                                <div class="author__avatar v_middle">
                                    <img src="images/usr_avatar.png" alt="user avatar">
                                </div>
                                <div class="autor__info v_middle">
                                    <p class="name">
                                        رضا رضایی
                                    </p>
                                    <p class="ammount">2000 تومان</p>
                                </div>
                            </div>
                            <!--end /.author-author__info-->

                            <div class="author__notification_area">
                                <ul>
                                    <li>
                                        <a href="notification.html">
                                            <div class="icon_wrap">
                                                <span class="lnr lnr-alarm"></span>
                                                <span class="notification_count noti">25</span>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="message.html">
                                            <div class="icon_wrap">
                                                <span class="lnr lnr-envelope"></span>
                                                <span class="notification_count msg">6</span>
                                            </div>
                                        </a>
                                    </li>

                                    <li>
                                        <a href="cart.html">
                                            <div class="icon_wrap">
                                                <span class="lnr lnr-cart"></span>
                                                <span class="notification_count purch">2</span>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <!--start .author__notification_area -->

                            <div class="dropdowns dropdown--author">
                                <ul>
                                    <li>
                                        <a href="author.html">
                                            <span class="lnr lnr-user"></span>پروفایل </a>
                                    </li>
                                    <li>
                                        <a href="dashboard.html">
                                            <span class="lnr lnr-home"></span>داشبورد</a>
                                    </li>
                                    <li>
                                        <a href="dashboard-setting.html">
                                            <span class="lnr lnr-cog"></span> تنظیمات</a>
                                    </li>
                                    <li>
                                        <a href="cart.html">
                                            <span class="lnr lnr-cart"></span>خرید ها</a>
                                    </li>
                                    <li>
                                        <a href="favourites.html">
                                            <span class="lnr lnr-heart"></span> علاقه مندی ها </a>
                                    </li>
                                    <li>
                                        <a href="dashboard-add-credit.html">
                                            <span class="lnr lnr-dice"></span>کارت تخفیف</a>
                                    </li>
                                    <li>
                                        <a href="dashboard-statement.html">
                                            <span class="lnr lnr-chart-bars"></span>بیانیه فروش</a>
                                    </li>
                                    <li>
                                        <a href="dashboard-upload.html">
                                            <span class="lnr lnr-upload"></span>آپلود ایتم </a>
                                    </li>
                                    <li>
                                        <a href="dashboard-manage-item.html">
                                            <span class="lnr lnr-book"></span>مدیریت آیتم ها</a>
                                    </li>
                                    <li>
                                        <a href="dashboard-withdrawal.html">
                                            <span class="lnr lnr-briefcase"></span>برداشت ها </a>
                                    </li>
                                    <li>
                                        <a href="#">
                                            <span class="lnr lnr-exit"></span>خروج </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="text-center">
                                <a href="signup.html" class="author-area__seller-btn inline">تبدیل به فروشنده </a>
                            </div>
                        </div>
                    </div>
                    <!-- end /.mobile_content -->
                </div>
                <!-- end /.col-md-5 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </div>
    <!-- end  -->

    <!-- start .mainmenu_area -->
    <div class="mainmenu">
        <!-- start .container -->
        <div class="container">
            <!-- start .row-->
            <div class="row">
                <!-- start .col-md-12 -->
                <div class="col-md-12">
                    <div class="navbar-header">
                        <!-- start mainmenu__search -->
                        <div class="mainmenu__search">
                            <form action="#">
                                <div class="searc-wrap">
                                    <input type="text" placeholder="جستجوی محصول ">
                                    <button type="submit" class="search-wrap__btn">
                                        <span class="lnr lnr-magnifier"></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <!-- start mainmenu__search -->
                    </div>

                    <nav class="navbar navbar-expand-md navbar-light mainmenu__menu">
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                                aria-controls="navbarNav" aria-expanded="false"
                                aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <!-- Collect the nav links, forms, and other content for toggling -->
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="has_dropdown">
                                    <a href="index.html">خانه </a>
                                    <div class="dropdowns dropdown--menu">
                                        <ul>
                                            <li>
                                                <a href="index.html">خانه یک چند فروشندگی</a>
                                            </li>
                                            <li>
                                                <a href="index-single.html">خانه دو (تک کاربره)</a>
                                            </li>
                                            <li>
                                                <a href="index3.html">خانه سه (محصولات )</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="has_dropdown">
                                    <a href="all-products-list.html">همه محصولات</a>
                                    <div class="dropdowns dropdown--menu">
                                        <ul>
                                            <li>
                                                <a href="all-products.html">محصولات جدید </a>
                                            </li>
                                            <li>
                                                <a href="all-products.html">محصولات محبوب </a>
                                            </li>
                                            <li>
                                                <a href="index3.html">محصولات رایگان </a>
                                            </li>

                                        </ul>
                                    </div>
                                </li>
                                <li class="has_dropdown">
                                    <a href="#">دسته بندی ها </a>
                                    <div class="dropdowns dropdown--menu">
                                        <ul>
                                            <li>
                                                <a href="category-grid.html">محصولات محبوب </a>
                                            </li>
                                            <li>
                                                <a href="category-grid.html">پنل ادمین </a>
                                            </li>
                                            <li>
                                                <a href="category-grid.html">وبلاگ / مقالات / جدید ترین ها </a>
                                            </li>
                                            <li>
                                                <a href="category-grid.html">خلاق </a>
                                            </li>
                                            <li>
                                                <a href="category-grid.html">شرکتی </a>
                                            </li>
                                            <li>
                                                <a href="category-grid.html">رزومه /نمونه کار </a>
                                            </li>
                                            <li>
                                                <a href="category-grid.html">فروشگاهی </a>
                                            </li>
                                            <li>
                                                <a href="category-grid.html">سرگرمی</a>
                                            </li>
                                            <li>
                                                <a href="category-grid.html">صفحه intro </a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                <li class="has_megamenu">
                                    <a href="#">عناصر</a>
                                    <div class="dropdown_megamenu contained">
                                        <div class="megamnu_module">
                                            <div class="menu_items">
                                                <div class="menu_column">
                                                    <ul>
                                                        <li>
                                                            <a href="accordion.html">Accordion</a>
                                                        </li>
                                                        <li>
                                                            <a href="alert.html">هشدار </a>
                                                        </li>
                                                        <li>
                                                            <a href="brands.html">برند ها </a>
                                                        </li>
                                                        <li>
                                                            <a href="buttons.html">دکمه ها</a>
                                                        </li>
                                                        <li>
                                                            <a href="cards.html">کارت ها
                                                                 
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="charts.html">آمار (چارت ها )</a>
                                                        </li>
                                                        <li>
                                                            <a href="content-block.html">بلوک محتوا</a>
                                                        </li>
                                                        <li>
                                                            <a href="dropdowns.html">Drpdowns</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="menu_column">
                                                    <ul>
                                                        <li>
                                                            <a href="features.html">ویژگی ها </a>
                                                        </li>
                                                        <li>
                                                            <a href="footer.html">فوتر</a>
                                                        </li>
                                                        <li>
                                                            <a href="info-box.html">جعبه اطلاعات </a>
                                                        </li>
                                                        <li>
                                                            <a href="menu.html">منو</a>
                                                        </li>
                                                        <li>
                                                            <a href="modal.html">مودال</a>
                                                        </li>
                                                        <li>
                                                            <a href="pagination.html">(Pagination )صفحه بندی </a>
                                                        </li>
                                                        <li>
                                                            <a href="peoples.html">افراد </a>
                                                        </li>
                                                        <li>
                                                            <a href="products.html">محصولات</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="menu_column">
                                                    <ul>
                                                        <li>
                                                            <a href="progressbar.html">نوار پیشرفت</a>
                                                        </li>
                                                        <li>
                                                            <a href="social.html">اجتماعی</a>
                                                        </li>
                                                        <li>
                                                            <a href="tab.html">زبانه ها </a>
                                                        </li>
                                                        <li>
                                                            <a href="table.html">جدول </a>
                                                        </li>
                                                        <li>
                                                            <a href="testimonials.html">مشتریان </a>
                                                        </li>
                                                        <li>
                                                            <a href="timeline.html">گاهشمار</a>
                                                        </li>
                                                        <li>
                                                            <a href="typography.html">تایپوگرافی</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="has_megamenu">
                                    <a href="#">صفحه ها </a>
                                    <div class="dropdown_megamenu">
                                        <div class="megamnu_module">
                                            <div class="menu_items">
                                                <div class="menu_column">
                                                    <ul>
                                                        <li class="title">محصولات</li>
                                                        <li>
                                                            <a href="all-products.html">شبکه محصولات</a>
                                                        </li>
                                                        <li>
                                                            <a href="all-products-list.html">لیست محصولات</a>
                                                        </li>
                                                        <li>
                                                            <a href="category-grid.html">شبکه دسته بندی ها</a>
                                                        </li>
                                                        <li>
                                                            <a href="category-list.html">شبکه دسته بندی ها </a>
                                                        </li>
                                                        <li>
                                                            <a href="search-product.html">جستجوی محصولات</a>
                                                        </li>
                                                        <li>
                                                            <a href="single-product.html">یک محصول v1</a>
                                                        </li>
                                                        <li>
                                                            <a href="single-product-v2.html">تنها محصول V2</a>
                                                        </li>
                                                        <li>
                                                            <a href="single-product-v3.html">تنها محصول V3</a>
                                                        </li>
                                                        <li>
                                                            <a href="cart.html">سبد خرید </a>
                                                        </li>
                                                        <li>
                                                            <a href="checkout.html">بازبینی سفارش</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="menu_column">
                                                    <ul>
                                                        <li class="title">دیگر</li>
                                                        <li>
                                                            <a href="author.html">پروفایل </a>
                                                        </li>
                                                        <li>
                                                            <a href="author-items.html">دیگر آیتم ها </a>
                                                        </li>
                                                        <li>
                                                            <a href="author-reviews.html">نظرات مشتریان </a>
                                                        </li>
                                                        <li>
                                                            <a href="author-followers.html">دنبال کنندگان</a>
                                                        </li>
                                                        <li>
                                                            <a href="author-following.html">دنبال کردن </a>
                                                        </li>
                                                        <li>
                                                            <a href="notification.html">پیغام ها </a>
                                                        </li>
                                                        <li>
                                                            <a href="message.html">صندوق پیام</a>
                                                        </li>
                                                        <li>
                                                            <a href="message-compose.html">نوشتن پیام</a>
                                                        </li>
                                                        <li>
                                                            <a href="favourites.html">موارد مورد علاقه</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="menu_column">
                                                    <ul>
                                                        <li class="title">داشبورد</li>
                                                        <li>
                                                            <a href="dashboard.html">داشبورد</a>
                                                        </li>
                                                        <li>
                                                            <a href="dashboard-setting.html">تنظیمات حساب</a>
                                                        </li>
                                                        <li>
                                                            <a href="dashboard-purchase.html">دیگر خریدها </a>
                                                        </li>
                                                        <li>
                                                            <a href="dashboard-add-credit.html">اضافه کردن اعتبار</a>
                                                        </li>
                                                        <li>
                                                            <a href="dashboard-statement.html">بیانیه ها</a>
                                                        </li>
                                                        <li>
                                                            <a href="invoice.html">صورتحساب</a>
                                                        </li>
                                                        <li>
                                                            <a href="dashboard-upload.html"> آپلود فایل
                                                                 
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <a href="dashboard-manage-item.html">ویرایش آیتم</a>
                                                        </li>
                                                        <li>
                                                            <a href="dashboard-withdrawal.html">خروج</a>
                                                        </li>
                                                        <li>
                                                            <a href="dashboard-manage-item.html">مدیریت آیتم</a>
                                                        </li>
                                                        <li>
                                                            <a href="add-payment-method.html">افزودن روش پرداخت</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="menu_column">
                                                    <ul>
                                                        <li class="title">مشتریان</li>
                                                        <li>
                                                            <a href="support-forum.html">انجمن پشتیبانی</a>
                                                        </li>
                                                        <li>
                                                            <a href="support-forum-detail.html">جزئیات انجمن</a>
                                                        </li>
                                                        <li>
                                                            <a href="login.html">ورود </a>
                                                        </li>
                                                        <li>
                                                            <a href="signup.html">ثبت نام </a>
                                                        </li>
                                                        <li>
                                                            <a href="recover-pass.html">بازیابی رمز عبور</a>
                                                        </li>
                                                        <li>
                                                            <a href="customer-dashboard.html">داشبورد مشتری</a>
                                                        </li>
                                                        <li>
                                                            <a href="customer-downloads.html">دانلود مشتریان</a>
                                                        </li>
                                                        <li>
                                                            <a href="customer-info.html">اطلاعات مشتری</a>
                                                        </li>
                                                    </ul>

                                                    <ul>
                                                        <li class="title">وبلاگ</li>
                                                        <li>
                                                            <a href="blog1.html">وبلاگ V-1</a>
                                                        </li>
                                                        <li>
                                                            <a href="blog2.html">وبلاگ V-2</a>
                                                        </li>
                                                        <li>
                                                            <a href="single-blog.html">صفحه پست</a>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="menu_column">
                                                    <ul>
                                                        <li class="title">دیگر</li>
                                                        <li>
                                                            <a href="how-it-works.html">چگونه کار می کند</a>
                                                        </li>
                                                        <li>
                                                            <a href="about.html">درباره ما</a>
                                                        </li>
                                                        <li>
                                                            <a href="pricing.html">طرح قیمت گذاری</a>
                                                        </li>
                                                        <li>
                                                            <a href="testimonial.html">مشتریان</a>
                                                        </li>
                                                        <li>
                                                            <a href="faq.html">سوالات متداول</a>
                                                        </li>
                                                        <li>
                                                            <a href="affiliate.html">وابسته</a>
                                                        </li>
                                                        <li>
                                                            <a href="term-condition.html">شرایط</a>
                                                        </li>
                                                        <li>
                                                            <a href="event.html">رویداد</a>
                                                        </li>
                                                        <li>
                                                            <a href="event-detail.html">جزئیات رویداد</a>
                                                        </li>
                                                        <li class="has_badge">
                                                            <a href="badges.html">افتخارات </a>
                                                            <span class="badge">جدید</span>
                                                        </li>
                                                        <li>
                                                            <a href="404.html">ارور 404</a>
                                                        </li>
                                                        <li>
                                                            <a href="carieer.html">پست های کاری</a>
                                                        </li>
                                                        <li>
                                                            <a href="job-detail.html">جزئیات کار </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <a href="contact.html">تماس با ما</a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.navbar-collapse -->
                    </nav>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row-->
        </div>
        <!-- start .container -->
    </div>
    <!-- end /.mainmenu-->
</div>
<!-- end /.menu-area -->
<!--================================
END MENU AREA
=================================-->
@yield('content')
<!--================================
START FOOTER AREA
=================================-->
<footer class="footer-area dir-rtl">
    <div class="footer-big section--padding">
        <!-- start .container -->
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="info-footer">
                        <div class="info__logo">
                            <img src="images/new/flogo.png" alt="footer logo">
                        </div>
                        <p class="info--text">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از
                            طراحان گرافیک است. </p>
                        <ul class="info-contact">
                            <li>
                                <span class="lnr lnr-phone info-icon"></span>
                                <span class="info">تلفن :324-34-32-98901+</span>
                            </li>
                            <li>
                                <span class="lnr lnr-envelope info-icon"></span>
                                <span class="info dir-rtl">amir.d79@yahoo.com</span>
                            </li>
                            <li>
                                <span class="lnr lnr-map-marker info-icon"></span>
                                <span class="info">ایران ،یزد ،اکرم آباد </span>
                            </li>
                        </ul>
                    </div>
                    <!-- end /.info-footer -->
                </div>
                <!-- end /.col-md-3 -->

                <div class="col-lg-5 col-md-6">
                    <div class="footer-menu">
                        <h4 class="footer-widget-title text--white">شرکت ما</h4>
                        <ul>
                            <li>
                                <a href="#">چگونه با ما بپیوندید</a>
                            </li>
                            <li>
                                <a href="#">چطور کار میکند</a>
                            </li>
                            <li>
                                <a href="#">خرید و فروش</a>
                            </li>
                            <li>
                                <a href="#">مشتریان</a>
                            </li>

                            <li>
                                <a href="#">سیاست بازپرداخت</a>
                            </li>

                        </ul>
                    </div>
                    <!-- end /.footer-menu -->

                    <div class="footer-menu">
                        <h4 class="footer-widget-title text--white">سوالات متداول</h4>
                        <ul>
                            <li>
                                <a href="#">چگونه با ما بپیوندید</a>
                            </li>
                            <li>
                                <a href="#">چطور کار میکند</a>
                            </li>
                            <li>
                                <a href="#">خرید و فروش</a>
                            </li>
                            <li>
                                <a href="#">مشتریان</a>
                            </li>

                            <li>
                                <a href="#">سیاست بازپرداخت</a>
                            </li>

                        </ul>
                    </div>
                    <!-- end /.footer-menu -->
                </div>
                <!-- end /.col-md-5 -->

                <div class="col-lg-4 col-md-12">
                    <div class="newsletter">
                        <h4 class="footer-widget-title text--white">خبر نامه</h4>
                        <p>مشترک شدن برای دریافت آخرین اخبار، به روز رسانی و ارائه اطلاعات. نگران نباشید، ما هرزنامه
                            ارسال نخواهیم کرد</p>
                        <div class="newsletter__form">
                            <form action="#">
                                <div class="field-wrapper">
                                    <input class="relative-field rounded" type="text" placeholder="ایمیل را وارد کنید ">
                                    <button class="btn btn--round" type="submit">ارسال</button>
                                </div>
                            </form>
                        </div>

                        <!-- start .social -->
                        <div class="social social--color--filled">
                            <ul>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-facebook"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-twitter"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-google-plus"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-pinterest"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-linkedin"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-dribbble"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!-- end /.social -->
                    </div>
                    <!-- end /.newsletter -->
                </div>
                <!-- end /.col-md-4 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </div>
    <!-- end /.footer-big -->

    <div class="mini-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="copyright-text">
                        <p>
                            <a href="#"></a>کپی رایت &copy; 2019. تمام حقوق برای طراح محفوظ است
                            <a target="_blank" href="http://damandarya.ir">دامن دریا </a>
                        </p>
                    </div>

                    <div class="go_top">
                        <span class="lnr lnr-chevron-up"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--================================
END FOOTER AREA
=================================-->

<!--//////////////////// JS GOES HERE ////////////////-->

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA0C5etf1GVmL_ldVAichWwFFVcDfa1y_c"></script>
<!-- inject:js -->
<script src="{{asset('darya/js/vendor/jquery/jquery-1.12.3.js')}}"></script>
<script src="{{asset('darya/js/vendor/jquery/popper.min.js')}}"></script>
<script src="{{asset('darya/js/vendor/jquery/uikit.min.js')}}"></script>
<script src="{{asset('darya/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('darya/js/vendor/chart.bundle.min.js')}}"></script>
<script src="{{asset('darya/js/vendor/grid.min.js')}}"></script>
<script src="{{asset('darya/js/vendor/jquery-ui.min.js')}}"></script>
<script src="{{asset('darya/js/vendor/jquery.barrating.min.js')}}"></script>
<script src="{{asset('darya/js/vendor/jquery.countdown.min.js')}}"></script>
<script src="{{asset('darya/js/vendor/jquery.counterup.min.js')}}"></script>
<script src="{{asset('darya/js/vendor/jquery.easing1.3.js')}}"></script>
<script src="{{asset('darya/js/vendor/owl.carousel.min.js')}}"></script>
<script src="{{asset('darya/js/vendor/slick.min.js')}}"></script>
<script src="{{asset('darya/js/vendor/tether.min.js')}}"></script>
<script src="{{asset('darya/js/vendor/trumbowyg.min.js')}}"></script>
<script src="{{asset('darya/js/vendor/waypoints.min.js')}}"></script>
<script src="{{asset('darya/js/dashboard.js')}}"></script>
<script src="{{asset('darya/js/main.js')}}"></script>
<script src="{{asset('darya/js/map.js')}}"></script>

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
                $('#cart-total span').html(data.countcart);
                $('#cartCount span').html(data.countcart);
                $('#cartDiscountT span').html(data.total);
                $.each(data.msg, function (index, value) {
                    var rowId = "'" + value['rowId'].toString() + "'";
                    $('.carts_table').append('  <tr>\n' +
                        '                                            <td style="width: 60px" class="text-center"><a href="/product/'+value['options']['product_slug']+'"><img class="img-thumbnail" title="' + value['name'] + '" alt="' + value['name'] + '" src="' + value['options']['image'] + '"></a></td>\n' +
                        '                                            <td style="padding: 1px 10px;" class="text-left"><a href="/product/'+value['options']['product_slug']+'">' + value['name'] + '</a></td>\n' +
                        '                                            <td class="text-right">' + value['qty'] + '</td>\n' +
                        '                                            <td style="min-width: 105px;padding: 8px 0;" class="text-right">' + number_3_3(value['price']) + '  تومان</td>\n' +
                        '                                            <td class="text-center"><button onclick="removecart(this, ' + rowId + ')" class="btn btn-danger btn-xs remove" title="حذف" onClick="" type="button"><i class="fa fa-times"></i></button>' +
                        '                                            <input type="hidden" data-product-id="' + value['id'] + '" value="' + value['qty'] + '" name="demo3"></td>\n' +
                        '                                        </tr>');
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
                            $('#cartCount span').html(data.countcart);
                            $('#cartDiscountT span').html(data.total);
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
                $(item).parents('tr').remove();
                $('#cart-total span').html(data.countcart);
                $('#cartCount span').html(data.countcart);
                $('#cartDiscountT span').html(data.total);
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
