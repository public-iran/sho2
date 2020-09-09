
@extends('front.layout.master')

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('front/js/swipebox/src/css/swipebox.min.css')}}">
    <style>
        .hero__categories ul{
            height: 453px;
            overflow-y: auto;
        }
        @media (max-width: 991px){
            .hero__categories ul{
                height: 220px;
            }
        }
        .owl-stage-outer{
            max-height: 400px;
        }
        .blog__item__text{
            text-align: right;
        }
        .blog__item__pic img{
            height: 250px;
        }
        .sidebar{
            text-align: right;
        }
        .latest-product__item__text span{
            display: block;
        }
        .product__item__pic,.product__discount__item__pic{
            height: 200px;
        }
        .product__details__pic__item{
            height: 470px;
        }
        .product__details__pic__item img{
            height: 100%;
        }
        .product__details__text{
            text-align: right;
        }
        .pro-qty input{
            padding-right: 0;
        }
        .tab-pane{
            text-align: right;
        }
        .product__details__tab .nav-tabs li{
            margin-left: 60px;
            margin-right: 0;
        }
        .product__details__tab .nav-tabs:before{
            width: 420px;
        }
        .send_comment .name{
            padding-right: 0!important;
        }
        .send_comment .email{
            padding-left: 0!important;
        }
        .send_comment .name input,.send_comment .email input{
            width: 100%;
        }
        .btn-send-comment{
            float: left;
            background: #7fad39;
            padding: 10px 20px;
            color: #fff;
        }
        .product__discount__percent {
            height: 45px;
            width: 45px;
            background: #dd2222;
            border-radius: 50%;
            font-size: 14px;
            color: #ffffff;
            line-height: 45px;
            text-align: center;
            position: absolute;
            left: -60px;
            top: -20px;
        }

        @media (max-width: 411px){
            .product__details__pic__item {
                height: 380px;
            }
            .featured__item .set-bg {
                background-size: 56% 100%;
            }
            .product__details__tab .nav-tabs li{
                margin-left: 25px;
            }
        }
        @media (max-width: 767px) {
            .send_comment .name{
                padding-left: 0;
            }
            .send_comment .email{
                padding-right: 0;
                margin-top: 1rem;
            }
        }

        ul{
            list-style: none;
        }
        .comments-header {
            background: #eee;
            font-size: 13px;
            color: #555;
            padding: 4px 10px;
        }
        .comments-body{
            background: #eeeeee69;
            font-size: 15px;
        }
        .comments-body > div p{
            padding-top: 5px;
            padding-right: 17px;
            font-size: 15px;
        }
        .comments-answer{

        }
        .comments-answer-header{
            background: #eee;
            font-size: 13px;
            color: #555;
            padding: 4px 30px;

        }
        .comments-answer-body{
            background: #eeeeee69;
            font-size: 15px;
            padding: 4px 35px;
        }
    </style>
@endsection
@section('content')
    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->

            <!-- Breadcrumb End-->
            <div class="row">
                <!--Middle Part Start-->
                <div id="content" class="col-sm-9">

                        <div class="row product-info">
                            <div class="col-sm-6">
                                <div class="image"><img class="img-responsive" itemprop="image" id="zoom_01" src="{{asset($product->image)}}" title="{{$product->title}}" alt="{{$product->title}}" data-zoom-image="{{asset($product->image)}}" /> </div>
                                <div class="center-block text-center"><span class="zoom-gallery"><i class="fa fa-search"></i> برای مشاهده گالری روی تصویر کلیک کنید</span></div>
                                <div class="image-additional" id="gallery_01">
                                    @foreach($images as $image)
                                    <a class="thumbnail" href="#" data-zoom-image="{{asset($image->path)}}" data-image="{{asset($image->path)}}" title="{{$product->title}}">
                                        <img src="{{asset($image->path)}}" title="{{$product->title}}" alt = "{{$product->title}}"/>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <h1 class="title" style="font-size: 22px;font-weight: 700;" itemprop="name">{{$product->title}}</h1>
                                <ul class="list-unstyled description">
                                    <li><b>برند :</b> <a href="#"><span itemprop="brand">اپل</span></a></li>
                                    <li><b>کد محصول :</b> <span itemprop="mpn">محصولات {{$product->id}}</span></li>
                                    <li><b>امتیازات خرید:</b> 700</li>
                                    <li><b>وضعیت موجودی :</b>
                                        @if($product->depot>0)
                                            <span class="instock">موجود</span>
                                        @else
                                            <span style="background: red" class="instock">نا موجود</span>
                                        @endif
                                    </li>
                                </ul>
                                <ul class="price-box">
                                    <li class="price" itemprop="offers" itemscope itemtype="http://schema.org/Offer">
                                        @if($product->discount>0)
                                        <span class="price-old">{{number_format($product->price)}} تومان</span> <span itemprop="price">{{number_format($product->price*(100-$product->discount)/100)}} تومان<span itemprop="availability" content="موجود"></span></span>
                                        @else
                                            <span itemprop="price">{{number_format($product->price)}} تومان <span itemprop="availability" content="موجود"></span></span>
                                        @endif
                                    </li>
                                    <li></li>
                                </ul>
                                <div id="product">
                                    <h3 class="subtitle">{{--انتخاب های در دسترس--}}</h3>
                                    <div class="form-group required">
                                        {{--<label class="control-label">رنگ</label>
                                        <select class="form-control" id="input-option200" name="option[200]">
                                            <option value=""> --- لطفا انتخاب کنید --- </option>
                                            <option value="4">مشکی </option>
                                            <option value="3">نقره ای </option>
                                            <option value="1">سبز </option>
                                            <option value="2">آبی </option>
                                        </select>--}}
                                    </div>
                                    <div class="cart">
                                        <div>
                                            @php
                                                $favorite=App\Favorite::where(['user_id'=>Auth::id(),'product_id'=>$product->id])->first()
                                            @endphp
                                            @if(empty($favorite))
                                            <button type="button" class="wishlist" onclick="favorite(this,{{$product->id}})"><i class="fa fa-heart"></i> افزودن به علاقه مندی ها</button>
                                            @else
                                                <button type="button" class="wishlist" onclick="favorite(this,{{$product->id}})"><i style="color: red" class="fa fa-heart"></i> افزودن به علاقه مندی ها</button>
                                            @endif
                                        </div>
                                        <div>
                                            <button onclick="addcart(this,'{{$product->id}}')" type="button" id="button-cart" class="btn btn-primary btn-lg">افزودن به سبد</button>
                                        </div>

                                    </div>
                                </div>
                                <div class="rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
                                    <meta itemprop="ratingValue" content="0" />
                                    <p><span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star fa-stack-1x"></i><i class="fa fa-star-o fa-stack-1x"></i></span> <span class="fa fa-stack"><i class="fa fa-star-o fa-stack-1x"></i></span> <a onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;" href=""><span itemprop="reviewCount">{{count($comments)}} بررسی</span></a> / <a onClick="$('a[href=\'#tab-review\']').trigger('click'); return false;" href="">یک بررسی بنویسید</a></p>
                                </div>
                                <hr>
                                <!-- AddThis Button BEGIN -->
                                <!-- AddThis Button END -->
                            </div>
                        </div>

                </div>
                <!--Right Part Start -->
                <aside id="column-right" class="col-sm-3 hidden-xs">
                    <h3 class="subtitle">پرفروش ها</h3>
                    <div class="side-item">
                        @foreach($sales as $sale)
                        <div class="product-thumb clearfix">
                            <div class="image"><a href="/product/{{$sale->slug}}"><img src="{{asset($sale->image)}}" alt="{{$sale->title}}" title="{{$sale->title}}" class="img-responsive" /></a></div>
                            <div class="caption">
                                <h4><a href="/product/{{$sale->slug}}">{{$sale->title}}</a></h4>
                                @if($sale->discount>0)
                                    <p class="price"> <span class="price-new">{{number_format($sale->price*(100-$sale->discount)/100)}} تومان</span> <span class="price-old">{{number_format($sale->price)}} تومان</span> <span class="saving">-{{$sale->discount}}%</span> </p>
                                @else
                                    <p class="price"> {{number_format($sale->price)}} تومان </p>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>

                </aside>
                <!--Right Part End -->

                <div id="content" class="col-sm-12">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab-description" data-toggle="tab">توضیحات</a></li>
                        <li><a href="#tab-specification" data-toggle="tab">مشخصات</a></li>
                        <li><a href="#tab-review" data-toggle="tab">بررسی ({{count($comments)}})</a></li>
                    </ul>
                    <div class="tab-content">
                        <div itemprop="description" id="tab-description" class="tab-pane active">
                            <?= $product->content ?>
                        </div>
                        <div id="tab-specification" class="tab-pane">
                            <div id="tab-specification" class="tab-pane">
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
                        <div id="tab-review" class="tab-pane">
                            <div id="review">
                                <div>
                                    @if(count($comments) === 0)
                                        <ul class="list-unstyled">
                                            <li>
                                                اولین نفری باشید که نظر خود را ثبت میکند!
                                            </li>
                                            <li>

                                            </li>
                                        </ul>
                                    @else
                                        @foreach($comments as $commentItem)
                                            @if($commentItem->parent == 0)
                                                <table class="table table-striped table-bordered">
                                                    <tbody>
                                                    <tr>
                                                        <td style="width: 50%;"><strong><span>{{$commentItem->user->name}}</span></strong></td>
                                                        <td class="text-right"><span>{{Verta::instance($commentItem->created_at)->format(' %d %B %Y')}}</span></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2"><p>{{$commentItem->content}}</p>
                                                            <div class="rating">

                                                                <?php
                                                                if ($commentItem->rating and $commentItem->rating>0){
                                                                $half_star = 5 - $commentItem->rating;
                                                                for ($i = 1; $i <= $commentItem->rating; $i++) {  ?>
                                                                <span class="fa fa-stack">
                                                                <i class="fa fa-star fa-stack-2x"></i>
                                                                <i class="fa fa-star-o fa-stack-2x"></i>
                                                            </span>
                                                                <?php }

                                                                if ($half_star >= 1) {
                                                                for ($i = 1; $i <= $half_star; $i++) { ?>
                                                                <span class="fa fa-stack">
                                                                <i class="fa fa-star-o fa-stack-2x"></i>
                                                            </span>
                                                                <?php }
                                                                } ?>
                                                                <?php } else { ?>
                                                                 <?php } ?>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <div class="text-right"></div>
                            </div>
                            <h2>یک بررسی بنویسید</h2>
                            @if(Auth::check())
                                <form class="send_comment" method="post" action="{{route('comment_product_store')}}">
                                    @csrf
                                    <div class="form-group required">
                                        <div class="col-sm-12">
                                            <label for="input-name" class="control-label"> عنوان نظر</label>
                                            <input type="text" class="form-control" id="input-name" value="" required placeholder="عنوان نظر" name="title">
                                            <input name="pro" type="hidden" value="{{$product->id}}">
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-12">
                                            <label for="input-review" class="control-label">بررسی شما</label>
                                            <textarea class="form-control" id="input-review" required placeholder="نظر خود را وارد کنید" rows="5" name="content"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group required">
                                        <div class="col-sm-12">
                                            <label class="control-label">رتبه</label>
                                            &nbsp;&nbsp;&nbsp; بد&nbsp;
                                            <input type="radio" value="1" name="rating">
                                            &nbsp;
                                            <input type="radio" value="2" name="rating">
                                            &nbsp;
                                            <input type="radio" value="3" name="rating">
                                            &nbsp;
                                            <input type="radio" value="4" name="rating">
                                            &nbsp;
                                            <input type="radio" value="5" name="rating">
                                            &nbsp;خوب</div>
                                    </div>
                                    <div class="buttons">
                                        <div class="pull-right">
                                            <button class="btn btn-primary" id="button-review" type="submit">ادامه</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                برای ثبت نظر
                                <a href="/login"> وارد شوید</a>
                            @endif

                        </div>
                    </div>
                    <h3 class="subtitle">محصولات مرتبط</h3>
                    <div class="owl-carousel related_pro">
                        @foreach($like_products as $item)
                            <div class="product-thumb">
                                <div class="image"><a href="{{$item->slug}}"><img src="{{asset($item->image)}}" alt="{{$item->title}}" title="{{$item->title}}" class="img-responsive" /></a></div>
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
                <!--Middle Part End -->

            </div>
        </div>
    </div>

@endsection

@section('script_link')
    <script type="text/javascript" src="{{asset('front/js/jquery.elevateZoom-3.0.8.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/js/swipebox/lib/ios-orientationchange-fix.js')}}"></script>
    <script type="text/javascript" src="{{asset('front/js/swipebox/src/js/jquery.swipebox.min.js')}}"></script>
@endsection
@section('script')
    @if(session('save_comment'))
    <script>
        alertify.set('notifier','position', 'bottom-left');
        alertify.success('نظر شما با موفقیت دخیره شده و بعد از تائید مدیر در سایت نمایش داده می شود');
    </script>
    @endif
    <script>
        view({{$product->id}})
        function view(id) {
            var CSRF_TOKEN = '{{ csrf_token() }}';
            var url = '{{route('view.set_view_product')}}';
            var data = {_token: CSRF_TOKEN,id:id};
            $.post(url, data, function (msg) {
            });
        }
    </script>
    <script type="text/javascript">
        // Elevate Zoom for Product Page image
        $("#zoom_01").elevateZoom({
            gallery:'gallery_01',
            cursor: 'pointer',
            galleryActiveClass: 'active',
            imageCrossfade: true,
            zoomWindowFadeIn: 500,
            zoomWindowFadeOut: 500,
            zoomWindowPosition : 11,
            lensFadeIn: 500,
            lensFadeOut: 500,
            loadingIcon: 'image/progress.gif'
        });
        //////pass the images to swipebox
        $("#zoom_01").bind("click", function(e) {
            var ez =   $('#zoom_01').data('elevateZoom');
            $.swipebox(ez.getGalleryList());
            return false;
        });
    </script>
@endsection
@php
    Session::forget('save_comment');
@endphp
