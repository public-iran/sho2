@extends('front.layout.master')

@section('style')
    <style>
        .product-details-view-content .product-info h1 {
            font-size: 18px;
            letter-spacing: -.025em;
            line-height: 24px;
            color: #0363cd;
            text-transform: capitalize;
            font-weight: 500;
            margin: 0 0 15px 0;
        }
        .wishlist-btn{
            cursor: pointer;
        }
        .product-description div,.product-description span,.product-description p,.product-description h3,.product-description h1,.product-description h4,.product-description h5,.product-description h6,.product-description h2{
            font-family: 'IRANSansDN','aviny', 'Rubik', sans-serif !important;
        }
    </style>
@endsection
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="/">خانه</a></li>
                    <li><a href="/shop">محصولات</a></li>
                    <li class="active">{{$product->title}}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- content-wraper start -->
    <div class="content-wraper">
        <div class="container">
            <div class="row single-product-area">
                <div class="col-lg-5 col-md-6">
                    <!-- Product Details Left -->
                    <div class="product-details-left">
                        <div class="product-details-images slider-navigation-1">
                            @foreach($images as $image)
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item" href="{{asset($image->path)}}" data-gall="myGallery">
                                    <img src="{{asset($image->path)}}" alt="product image">
                                </a>
                            </div>
                            @endforeach
                        </div>
                        <div class="product-details-thumbs slider-thumbs-1">
                            @foreach($images as $image)
                            <div class="sm-image"><img src="{{asset($image->path)}}" alt="{{asset($image->path)}}"></div>
                            @endforeach                        </div>
                    </div>
                    <!--// Product Details Left -->
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="product-details-view-content pt-60">
                        <div class="product-info">
                            <h1>{{$product->title}}</h1>
                            <span class="product-details-ref">منبع: demo_15</span>
                            <div class="rating-box pt-20">
                                <ul class="rating rating-with-review-item">
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li><i class="fa fa-star-o"></i></li>
                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                    <li class="no-star"><i class="fa fa-star-o"></i></li>
                                    <li class="review-item"><a href="#">دفعات بازدید: {{$product->view}}</a></li>
                                    <li class="review-item"><a href="#">نوشتن نظر</a></li>
                                </ul>
                            </div>
                            <ul class="list-unstyled description">
                                <li><b>کد محصول :</b> <span itemprop="mpn">محصولات {{$product->id}}</span></li>
                                <li><b>امتیازات خرید:</b> 700</li>
                                <li><b>وضعیت موجودی :</b>
                                    @if($product->depot>0)
                                        <span style="background: green;padding: 0px 10px 1px;color: #fff;" class="instock">موجود</span>
                                    @else
                                        <span style="background: red;padding: 0px 10px 1px;color: #fff;"  class="instock">نا موجود</span>
                                    @endif
                                </li>
                            </ul>
                            <div class="price-box pt-20">
                                @if($product->discount>0)
                                    <span class="price-old" style="text-decoration: line-through;">{{number_format($product->price)}} تومان</span> <span class="new-price new-price-2">{{number_format($product->price*(100-$product->discount)/100)}} تومان</span>
                                @else
                                    <span class="new-price new-price-2">{{number_format($product->price)}} تومان </span>
                                @endif
                            </div>
                            <div class="product-desc">
                                <p>
                                    <span>{{str_limit($product->excerpt,450)}}</span>
                                </p>
                            </div>
                            <div class="block-reassurance">
                                <ul>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-check-square-o"></i>
                                            </div>
                                            <p>سیاست امنیتی (ویرایش با ماژول اطمینان مشتری)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-truck"></i>
                                            </div>
                                            <p>سیاست تحویل (ویرایش با ماژول تأمین اعتبار مشتری)</p>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="reassurance-item">
                                            <div class="reassurance-icon">
                                                <i class="fa fa-exchange"></i>
                                            </div>
                                            <p> سیاست بازگشت (ویرایش با ماژول اطمینان مشتری)</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <div class="cart-quantity">
                                @if($product->depot>0)
                                <button onclick="addcart(this,'{{$product->id}}')" class="add-to-cart" type="submit">افزودن به سبد خرید</button>
                                @else
                                <button class="add-to-cart" type="submit" style="background: #ccc">ناموجود</button>
                                @endif
                            </div>

                            <div class="product-additional-info pt-25">

                                @php
                                    $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$product->id])->first()
                                @endphp
                                @if(empty($favorite))
                                    <a class="wishlist-btn" onclick="favorite(this,{{$product->id}})"><i class="fa fa-heart-o"></i>افزودن به علاقه مندی ها</a>
                                @else
                                    <a style="color: red" class="wishlist-btn" onclick="favorite(this,{{$product->id}})"><i class="fa fa-heart-o"></i>افزودن به علاقه مندی ها</a>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wraper end -->
    <!-- Begin Product Area -->
    <div class="product-area pt-35">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="li-product-tab">
                        <ul class="nav li-product-menu">
                            <li><a class="active" data-toggle="tab" href="#description"><span>توضیحات</span></a></li>
                            <li><a data-toggle="tab" href="#product-details"><span>مشخصات کالا</span></a></li>
                            <li><a data-toggle="tab" href="#reviews"><span>بررسی ها</span></a></li>
                        </ul>
                    </div>
                    <!-- Begin Li's Tab Menu Content Area -->
                </div>
            </div>
            <div class="tab-content">
                <div id="description" class="tab-pane active show" role="tabpanel">
                    <div class="product-description">
                        <span style="font-family: inherit!important;">
                            <?= $product->content ?>
                        </span>
                    </div>
                </div>
                <div id="product-details" class="tab-pane" role="tabpanel">
                    <div class="product-details-manufacturer">
                        <table class="table table-bordered">
                            <thead>

                            <tr>
                                <td colspan="2"><strong>مشخصات فنی</strong></td>
                            </tr>
                            </thead>
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
                </div>
                <div id="reviews" class="tab-pane" role="tabpanel">
                    <div class="product-reviews">
                        <div class="product-details-comment-block">
                            @if(Auth::check())
                            <div class="review-btn" style="margin-bottom: 21px">
                                <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">نظرتان را بنویسید!</a>
                            </div>
                            @else
                                <h5>
                                    برای ثبت نظر
                                    <a href="/login"> وارد شوید</a>
                                </h5>

                            @endif
                            <div class="li-comment-section">
                                <ul>
                                    @foreach($comments as $comment)
                                        <li>
                                            <div class="author-avatar pt-15">
                                                <img src="{{asset('limupa/images/product-details/user.png')}}" alt="User">
                                            </div>
                                            <div class="comment-body pl-15">

                                                <h5 class="comment-author pt-15">{{$comment->name}}</h5>
                                                <div class="comment-post-date">
                                                    {{Verta::instance($comment->created_at)->format(' %d %B %Y')}}
                                                </div>
                                                <p>{{$comment->content}}</p>
                                            </div>
                                        </li>
                                        @php $comments_ansswers=App\Comment::where('parent',$comment->id)->get() @endphp
                                        @foreach($comments_ansswers as $comments_ansswer)
                                            <li class="comment-children">
                                                <div class="author-avatar pt-15">
                                                    <img src="{{asset('limupa/images/product-details/admin.png')}}" alt="Admin">
                                                </div>
                                                <div class="comment-body pl-15">

                                                    <h5 class="comment-author pt-15">مدیر</h5>
                                                    <div class="comment-post-date">
                                                        {{Verta::instance($comments_ansswer->created_at)->format(' %d %B %Y')}}
                                                    </div>
                                                    <p>{{$comments_ansswer->content}}
                                                    </p>
                                                </div>
                                            </li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>



                            <!-- Begin Quick View | Modal Area -->
                            <div class="modal fade modal-wrapper" id="mymodal" >
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <h3 class="review-page-title">نظرتان را بنویسید</h3>
                                            <div class="modal-inner-area row">
                                                <div class="col-lg-6">
                                                    <div class="li-review-product">
                                                        <img src="images/product/large-size/3.jpg" alt="Li's Product">
                                                        <div class="li-review-product-desc">
                                                            <p class="li-product-name">{{$product->title}}</p>
                                                            <p>
                                                                <span>دوربین ساحل منحصر به فرد بسته نرم افزاری - شامل دو سامسونگ تابشی 360 بلندگو R3 وای فای بلوتوث. تمام اتاق را با صدای عالی از طریق فن آوری رادیاتور حلقه پر کنید. جریان و کنترل R3 بلندگو بی سیم با گوشی های هوشمند خود. پیشرفته، طراحی مدرن </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-6">
                                                    <div class="li-review-content">
                                                        <!-- Begin Feedback Area -->
                                                        <div class="feedback-area">
                                                            <div class="feedback">
                                                                <h3 class="feedback-title">بازخورد ما</h3>
                                                                <form action="#">
                                                                    <p class="your-opinion">
                                                                        <label>امتیاز شما</label>
                                                                        <span>
                                                                                    <select class="star-rating">
                                                                                      <option value="1">1</option>
                                                                                      <option value="2">2</option>
                                                                                      <option value="3">3</option>
                                                                                      <option value="4">4</option>
                                                                                      <option value="5">5</option>
                                                                                    </select>
                                                                                </span>
                                                                    </p>
                                                                    <p class="feedback-form">
                                                                        <label for="feedback">نظر شما</label>
                                                                        <textarea id="feedback" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                                                                    </p>
                                                                    <div class="feedback-input">
                                                                        <p class="feedback-form-author">
                                                                            <label for="author">نام<span class="required">*</span>
                                                                            </label>
                                                                            <input id="author" name="author" value="" size="30" aria-required="true" type="text">
                                                                        </p>
                                                                        <p class="feedback-form-author feedback-form-email">
                                                                            <label for="email">ایمیل<span class="required">*</span>
                                                                            </label>
                                                                            <input id="email" name="email" value="" size="30" aria-required="true" type="text">
                                                                            <span class="required"><sub>*</sub> فیلدهای مورد نیاز</span>
                                                                        </p>
                                                                        <div class="feedback-btn pb-15">
                                                                            <a href="#" class="close" data-dismiss="modal" aria-label="بستن">بستن</a>
                                                                            <a href="#">تایید</a>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                        <!-- Feedback Area End Here -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Quick View | Modal Area End Here -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Product Area End Here -->
    <!-- Begin Li's Laptop Product Area -->
    <section class="product-area li-laptop-product pt-30 pb-50">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Section Area -->
                <div class="col-lg-12">
                    <div class="li-section-title">
                        <h2>
                            <span>15 محصول دیگر در همان رده:</span>
                        </h2>
                    </div>
                    <div class="row">
                        <div class="product-active owl-carousel">
                            @foreach($like_products as $item)
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
                                                    <li class="add-cart active" onclick="addcart(this,'{{$item->id}}')"><a href="#">افزودن به سبد خرید</a></li>
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

@endsection

