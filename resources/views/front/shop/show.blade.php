@extends('front.layout.master')

@section('content')
    <!--================================
        START BREADCRUMB AREA
    =================================-->
    <section class="breadcrumb-area dir-rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="#">خانه</a>
                            </li>
                            <li>
                                <a href="#">محصولات</a>
                            </li>
                            <li class="active">
                                <a href="#">{{$product->title}}</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">{{$product->title}}</h1>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->



    <!--============================================
    START SINGLE PRODUCT DESCRIPTION AREA
==============================================-->
<section class="single-product-desc dir-rtl">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="item-preview">
                    <div class="item__preview-slider">
                        @foreach($images as $image)
                        <div class="prev-slide">
                            <img src="{{asset($image->path)}}" alt="{{$product->title}}">
                        </div>
                        @endforeach
                    </div>
                    <!-- end /.item--preview-slider -->

                    <div class="item__preview-thumb">
                        <div class="prev-thumb">
                            <div class="thumb-slider">
                                @foreach($images as $image)
                                <div class="item-thumb">
                                    <img src="{{asset($image->path)}}" alt="{{$product->title}}">
                                </div>
                                @endforeach
                            </div>
                            <!-- end /.thumb-slider -->

                            <div class="prev-nav thumb-nav">
                                <span class="lnr nav-right lnr-arrow-right"></span>

                                <span class="lnr nav-left lnr-arrow-left"></span>
                            </div>
                            <!-- end /.prev-nav -->
                        </div>

                        <div class="item-action">
                            <div class="action-btns">
                                <a href="#" class="btn btn--round btn--lg">مشاهده</a>
                                <a href="#" class="btn btn--round btn--lg btn--icon">
                                    <span class="lnr lnr-heart"></span>افزودن به علاقه مندی ها </a>
                            </div>
                        </div>
                        <!-- end /.item__action -->
                    </div>
                    <!-- end /.item__preview-thumb-->


                </div>
                <!-- end /.item-preview-->

                <div class="item-info">
                    <div class="item-navigation">
                        <ul class="nav nav-tabs">
                            <li>
                                <a href="#product-details" class="active" aria-controls="product-details" role="tab" data-toggle="tab">جزئیات</a>
                            </li>
                            <li>
                                <a href="#product-faq" aria-controls="product-faq" role="tab" data-toggle="tab">مشخصات فنی </a>
                            </li>
                            <li>
                                <a href="#product-comment" aria-controls="product-comment" role="tab" data-toggle="tab">نظرات </a>
                            </li>
                            <li>
                                <a href="#product-support" aria-controls="product-support" role="tab" data-toggle="tab">ارسال نظر</a>
                            </li>
                        </ul>
                    </div>
                    <!-- end /.item-navigation -->

                    <div class="tab-content">


                        <div class="fade show tab-pane product-tab active" id="product-details">
                            <div class="tab-content-wrapper">
                                <?= $product->content ?>
                            </div>
                        </div>
                        <!-- end /.tab-content -->

                        <div class="fade tab-pane product-tab" id="product-faq">
                            <div class="tab-content-wrapper">
                                <div class="panel-group accordion" role="tablist" id="accordion">
                                    <table class="table table-striped table-bordered">
                                        <tbody>
                                        @foreach($featurs as $featur)
                                            <tr>
                                                <td>{{$featur->title}}</td>
                                                <td>{{$featur->content}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <!-- end /.accordion -->
                            </div>

                        </div>
                        <!-- end /.product-faq -->

                        <div class="fade tab-pane product-tab" id="product-comment">
                            <div class="thread">
                                <ul class="media-list thread-list">
                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/new/m1.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="media-heading">
                                                        <a href="author.html">
                                                            <h4>علی</h4>
                                                        </a>
                                                        <span>9 ساعت پیش </span>
                                                    </div>
                                                    <span class="comment-tag buyer">خریدار</span>
                                                    <a href="#" class="reply-link">پاسخ </a>
                                                </div>
                                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.  </p>
                                            </div>
                                        </div>

                                        <!-- nested comment markup -->
                                        <ul class="children">
                                            <li class="single-thread depth-2">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="images/new/m2.png" alt="Commentator Avatar">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="media-heading">
                                                            <h4>رضا</h4>
                                                            <span>6 ساعت پیش</span>
                                                        </div>
                                                        <span class="comment-tag author">طراح</span>
                                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.  </p>
                                                    </div>
                                                </div>

                                            </li>
                                            <li class="single-thread depth-2">
                                                <div class="media">
                                                    <div class="media-left">
                                                        <a href="#">
                                                            <img class="media-object" src="images/new/m2.png" alt="Commentator Avatar">
                                                        </a>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="media-heading">
                                                            <h4>رضا</h4>
                                                            <span>6 ساعت پیش</span>
                                                        </div>
                                                        <span class="comment-tag author">طراح</span>
                                                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.  </p>
                                                    </div>
                                                </div>

                                            </li>

                                        </ul>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/new/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea class="bla" name="reply-comment" placeholder="Write your comment..."></textarea>
                                                    <button class="btn btn--md btn--round">Post Comment</button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->
                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/new/m3.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="media-heading">
                                                        <a href="author.html">
                                                            <h4>تقی</h4>
                                                        </a>
                                                        <span>5 ساعت پیش </span>
                                                    </div>
                                                    <a href="#" class="reply-link">پاسخ </a>
                                                </div>
                                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/new/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea name="reply-comment" placeholder="نظر خود را بنویسید "></textarea>
                                                    <button class="btn btn--sm btn--round">ارسال نظر </button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->
                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/new/m3.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="media-heading">
                                                        <a href="author.html">
                                                            <h4>تقی</h4>
                                                        </a>
                                                        <span>5 ساعت پیش </span>
                                                    </div>
                                                    <a href="#" class="reply-link">پاسخ </a>
                                                </div>
                                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/new/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea name="reply-comment" placeholder="نظر خود را بنویسید "></textarea>
                                                    <button class="btn btn--sm btn--round">ارسال نظر </button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->
                                    <li class="single-thread">
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/new/m3.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <div>
                                                    <div class="media-heading">
                                                        <a href="author.html">
                                                            <h4>تقی</h4>
                                                        </a>
                                                        <span>5 ساعت پیش </span>
                                                    </div>
                                                    <a href="#" class="reply-link">پاسخ </a>
                                                </div>
                                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                                            </div>
                                        </div>

                                        <!-- comment reply -->
                                        <div class="media depth-2 reply-comment">
                                            <div class="media-left">
                                                <a href="#">
                                                    <img class="media-object" src="images/new/m2.png" alt="Commentator Avatar">
                                                </a>
                                            </div>
                                            <div class="media-body">
                                                <form action="#" class="comment-reply-form">
                                                    <textarea name="reply-comment" placeholder="نظر خود را بنویسید "></textarea>
                                                    <button class="btn btn--sm btn--round">ارسال نظر </button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- comment reply -->
                                    </li>
                                    <!-- end single comment thread /.comment-->


                                </ul>
                                <!-- end /.media-list -->

                                <div class="pagination-area pagination-area2">
                                    <nav class="navigation pagination" role="navigation">
                                        <div class="nav-links">
                                            <a class="page-numbers current" href="#">1</a>
                                            <a class="page-numbers" href="#">2</a>
                                            <a class="page-numbers" href="#">3</a>
                                            <a class="prev page-numbers" href="#">
                                                <span class="lnr lnr-arrow-left"></span>
                                            </a>
                                        </div>
                                    </nav>
                                </div>
                                <!-- end /.comment pagination area -->

                                <div class="comment-form-area">
                                    <h4> پیام بگذارید</h4>
                                    <!-- comment reply -->
                                    <div class="media comment-form">
                                        <div class="media-left">
                                            <a href="#">
                                                <img class="media-object" src="images/new/m7.png" alt="Commentator Avatar">
                                            </a>
                                        </div>
                                        <div class="media-body">
                                            <form action="#" class="comment-reply-form">
                                                <textarea name="reply-comment" placeholder="نظر خود را بنویسید ..."></textarea>
                                                <button class="btn btn--sm btn--round">ارسال نظر </button>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- comment reply -->
                                </div>
                                <!-- end /.comment-form-area -->
                            </div>
                            <!-- end /.comments -->
                        </div>
                        <!-- end /.product-comment -->

                        <div class="fade tab-pane product-tab" id="product-support">
                            <div class="support">
                                <div class="support__title">
                                    <h3>با نویسنده تماس بگیرید</h3>
                                </div>
                                <div class="support__form">
                                    <div class="usr-msg">
                                        <p>لطفا برای ارسال نظر
                                            <a href="login.html">وارد </a>شوید.</p>

                                        <form action="#" class="پشتیبانی_form">
                                            <div class="form-group">
                                                <label for="subj">موضوع:</label>
                                                <input type="text" id="subj" class="text_field" placeholder="موضوع خود را وارد کنید ">
                                            </div>

                                            <div class="form-group">
                                                <label for="supmsg">متن : </label>
                                                <textarea class="text_field" id="supmsg" name="supmsg" placeholder="متن خود را وارد کنید ..."></textarea>
                                            </div>
                                            <button type="submit" class="btn btn--lg btn--round">ارسال </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end /.product-support -->

                    </div>
                    <!-- end /.tab-content -->
                </div>
                <!-- end /.item-info -->
            </div>
            <!-- end /.col-md-8 -->

            <div class="col-lg-4">
                <aside class="sidebar sidebar--single-product">
                    <div class="sidebar-card card-pricing">
                        <div class="price">
                            <h1>
                                20<sup>تومان</sup> -
                                60 <sup>تومان</sup></h1>
                        </div>
                        <ul class="pricing-options">
                            <li>
                                <div class="custom-radio">
                                    <input type="radio" id="opt1" class="" name="filter_opt" checked>
                                    <label for="opt1">
                                        <span class="circle"></span>مجوز یک سایت  –
                                        <span class="pricing__opt">100 تومان</span>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-radio">
                                    <input type="radio" id="opt2" class="" name="filter_opt">
                                    <label for="opt2">
                                        <span class="circle"></span>مجوز دو سایت –
                                        <span class="pricing__opt">400 تومان</span>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="custom-radio">
                                    <input type="radio" id="opt3" class="" name="filter_opt">
                                    <label for="opt3">
                                        <span class="circle"></span>مجوز چند سایت –
                                        <span class="pricing__opt">400 تومان</span>
                                    </label>
                                </div>
                            </li>
                        </ul>
                        <!-- end /.pricing-options -->

                        <div class="purchase-button">
                            <a href="#" class="btn btn--lg btn--round">هم اکنون بخرید</a>
                            <a href="#" class="btn btn--lg btn--round cart-btn">
                                <span class="lnr lnr-cart"></span> افودن به سبد خرید </a>
                        </div>
                        <!-- end /.purchase-button -->
                    </div>
                    <!-- end /.sidebar--card -->

                </aside>
                <!-- end /.aside -->
            </div>
            <!-- end /.col-md-4 -->
        </div>
        <!-- end /.row -->
    </div>
    <!-- end /.container -->
</section>
<!--===========================================
    END SINGLE PRODUCT DESCRIPTION AREA
===============================================-->

<!--============================================
    START MORE PRODUCT ARE
==============================================-->
<section class="more_product_area section--padding dir-rtl">
    <div class="container">
        <div class="row">
            <!-- start col-md-12 -->
            <div class="col-md-12">
                <div class="section-title">
                    <h1>محصولات بیشتر از
                        <span class="highlighted">دامن دریا </span>
                    </h1>
                </div>
            </div>
            <!-- end /.col-md-12 -->

            <!-- start .col-md-4 -->
            <div class="col-lg-4 col-md-6">
                <!-- start .single-product -->
                <div class="product product--card product--card2">

                    <div class="product__thumbnail">
                        <img src="images/new/p1.jpg" alt="Product Image">
                        <div class="prod_btn">
                            <a href="single-product.html" class="transparent btn--sm btn--round">اطلاعات بیشتر </a>
                            <a href="single-product.html" class="transparent btn--sm btn--round">مشاهده </a>
                        </div>
                        <!-- end /.prod_btn -->
                    </div>
                    <!-- end /.product__thumbnail -->

                    <div class="product-desc">
                        <a href="#" class="product_title">
                            <h4>قالب فروشگاهی حوملا </h4>
                        </a>

                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                    </div>
                    <!-- end /.product-desc -->

                    <ul class="titlebtm">
                        <li class="product_cat">
                            <a href="#">
                                <span class="lnr lnr-book"></span>افزونه ها </a>
                        </li>
                        <li class="rating product--rating">
                            <ul>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <div class="product-purchase">
                        <div class="price_love">
                            <span>10 تومان  - 50 تومان </span>
                            <p>
                                <span class="lnr lnr-heart"></span> 90</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart"></span>
                                <span>16</span></p>
                        </div>
                    </div>
                    <!-- end /.product-purchase -->
                </div>
                <!-- end /.single-product -->
            </div>
            <!-- end /.col-md-4 -->

            <!-- start .col-md-4 -->
            <div class="col-lg-4 col-md-6">
                <!-- start .single-product -->
                <div class="product product--card product--card2">

                    <div class="product__thumbnail">
                        <img src="images/new/p1.jpg" alt="Product Image">
                        <div class="prod_btn">
                            <a href="single-product.html" class="transparent btn--sm btn--round">اطلاعات بیشتر </a>
                            <a href="single-product.html" class="transparent btn--sm btn--round">مشاهده </a>
                        </div>
                        <!-- end /.prod_btn -->
                    </div>
                    <!-- end /.product__thumbnail -->

                    <div class="product-desc">
                        <a href="#" class="product_title">
                            <h4>قالب فروشگاهی حوملا </h4>
                        </a>

                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                    </div>
                    <!-- end /.product-desc -->

                    <ul class="titlebtm">
                        <li class="product_cat">
                            <a href="#">
                                <span class="lnr lnr-book"></span>افزونه ها </a>
                        </li>
                        <li class="rating product--rating">
                            <ul>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <div class="product-purchase">
                        <div class="price_love">
                            <span>10 تومان  - 50 تومان </span>
                            <p>
                                <span class="lnr lnr-heart"></span> 90</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart"></span>
                                <span>16</span></p>
                        </div>
                    </div>
                    <!-- end /.product-purchase -->
                </div>
                <!-- end /.single-product -->
            </div>
            <!-- end /.col-md-4 -->

            <!-- start .col-md-4 -->
            <div class="col-lg-4 col-md-6">
                <!-- start .single-product -->
                <div class="product product--card product--card2">

                    <div class="product__thumbnail">
                        <img src="images/new/p1.jpg" alt="Product Image">
                        <div class="prod_btn">
                            <a href="single-product.html" class="transparent btn--sm btn--round">اطلاعات بیشتر </a>
                            <a href="single-product.html" class="transparent btn--sm btn--round">مشاهده </a>
                        </div>
                        <!-- end /.prod_btn -->
                    </div>
                    <!-- end /.product__thumbnail -->

                    <div class="product-desc">
                        <a href="#" class="product_title">
                            <h4>قالب فروشگاهی حوملا </h4>
                        </a>

                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. </p>
                    </div>
                    <!-- end /.product-desc -->

                    <ul class="titlebtm">
                        <li class="product_cat">
                            <a href="#">
                                <span class="lnr lnr-book"></span>افزونه ها </a>
                        </li>
                        <li class="rating product--rating">
                            <ul>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                                <li>
                                    <span class="fa fa-star"></span>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <div class="product-purchase">
                        <div class="price_love">
                            <span>10 تومان  - 50 تومان </span>
                            <p>
                                <span class="lnr lnr-heart"></span> 90</p>
                        </div>
                        <div class="sell">
                            <p>
                                <span class="lnr lnr-cart"></span>
                                <span>16</span></p>
                        </div>
                    </div>
                    <!-- end /.product-purchase -->
                </div>
                <!-- end /.single-product -->
            </div>
            <!-- end /.col-md-4 -->

        </div>
        <!-- end /.container -->
    </div>
    <!-- end /.container -->
</section>
<!--============================================
    END MORE PRODUCT AREA
==============================================-->

@endsection

