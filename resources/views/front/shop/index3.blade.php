
@extends('front.layout.master')
@section('style')
    <style>
        .product {
            padding-top: 30px;
            padding-bottom: 80px;
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

        .nav-link[data-toggle].collapsed:before {
            content: " ▾";
        }
        .nav-link[data-toggle]:not(.collapsed):before {
            content: " ▴";
        }
        .list-unstyled{

            padding-right: 10px!important;
            overflow-y: auto;
        }
        .hero__categories > ul{
            height: 453px;

        }
        @media (max-width: 991px){
            .hero__categories > ul{
                height: 220px;
            }
        }

        [type="checkbox"] + label {
            height: 25px;
            line-height: 21px;
            font-size: 13px;
            font-weight: normal;
            min-width: 150px;
            position: relative;
            padding-right: 7px;
            padding-left: 0;
            cursor: pointer;
            display: inline-block;
        }
        .sidebar__item__color {
            float: right;
            width: 100%;
            display: flex;
            padding-right: 15px;
        }
        .sidebar__item__color label:after{
            display: none;
        }
        input[type=checkbox], input[type=radio]{
            cursor: pointer;
        }
        .sidebar__item h4{
            font-size: 19px;
        }
        .filter__item .row{
            text-align: right;
        }
        .ptn-price{
            text-align: center;
            padding: 2px 6px;
            margin: 5px 0;
            width: 100%;
        }
        .product-list .image img{
            width: 220px;
            height: 230px;
        }
    </style>
@endsection
@section('content')

    <div id="container">
        <div class="container">

            <!-- Breadcrumb End-->
            <div class="row">
                <!--Left Part Start -->
                <aside id="column-left" class="col-sm-3 hidden-xs">
                    <h3 class="subtitle">دسته ها</h3>
                    <div class="box-category">
                        <ul id="cat_accordion">
                            @foreach($categories as $category)
                                @php $categories2=App\Category::where('parent',$category->id)->get(); @endphp
                            <li><a href="/shop?cat={{$category->slug}}">{{$category->title}}</a> @if(count($categories2))<span class="down"></span>@endif
                                <ul>
                                    @foreach($categories2 as $category2)
                                        @php $categories3=App\Category::where('parent',$category2->id)->get(); @endphp
                                    <li><a href="/shop?cat={{$category2->slug}}">{{$category2->title}}</a> @if(count($categories3))<span class="down"></span>@endif
                                        <ul>
                                            @foreach($categories3 as $category3)
                                            <li><a href="/shop?cat={{$category3->slug}}">{{$category3->title}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach
                                </ul>
                            </li>
                            @endforeach
                        </ul>
                    </div>

                    <h3 class="subtitle">جستجوی پیشرفته</h3>
                    <div class="side-item">
                        <form id="form-filter-attribute" method="post" action="{{route('shop.doSearch')}}"
                              enctype="multipart/form-data">

                            @foreach($attributes as $attribute)
                                <div class="sidebar__item sidebar__item__color--option">
                                    <h4>{{$attribute->title}}</h4>
                                    <?php $row=1; ?>
                                    @foreach($attribute->attribute_values as $attribute_value)
                                        <div class="sidebar__item__color sidebar__item__color--white">
                                            <input type="checkbox" name="attr-<?=$attribute['id']?>[]" value="{{$attribute_value->id}}" id="basic_checkbox_{{$attribute->id.$row}}" class="filled-in filte_right">
                                            <label for="basic_checkbox_{{$attribute->id.$row}}">{{$attribute_value->value}}</label>
                                        </div>
                                        <?php $row++; ?>
                                    @endforeach
                                </div>
                            @endforeach
                        </form>
                    </div>

                    <h3 style="margin-top: 20px;float: right; width: 100%;" class="subtitle">پرفروش ها</h3>
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
                    <h3 class="subtitle">ویژه</h3>
                    <div class="side-item">
                        @foreach($spacial_product as $sale)
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
                   {{-- <div class="banner owl-carousel">
                        <div class="item"> <a href="#"><img src="image/banner/small-banner1-265x350.jpg" alt="small banner" class="img-responsive" /></a> </div>
                        <div class="item"> <a href="#"><img src="image/banner/small-banner-265x350.jpg" alt="small banner1" class="img-responsive" /></a> </div>
                    </div>--}}
                </aside>
                <!--Left Part End -->
                <!--Middle Part Start-->
                <div id="content" class="col-sm-9">
                    @if(@$_GET['cat'])
                        @php $category=App\Category::where('slug',$_GET['cat'])->first() @endphp
                    <h1 class="title">{{$category->title}}</h1>
                    @endif


                    <div class="product-filter">
                        <div class="row">
                            <div class="col-md-3 col-sm-5">
                                <div class="btn-group">
                                    <button type="button" id="list-view" class="btn btn-default" data-toggle="tooltip" title="List"><i class="fa fa-th-list"></i></button>
                                    <button type="button" id="grid-view" class="btn btn-default" data-toggle="tooltip" title="Grid"><i class="fa fa-th"></i></button>
                                </div>
                               </div>
                            <div class="col-sm-2 text-right">
                                <label class="control-label" for="input-sort">مرتب سازی :</label>
                            </div>
                            <div class="col-md-3 col-sm-2 text-right">
                                <select name="sort" id="sort" onchange="doSearch()">
                                    <option value="new">جدید ترین</option>
                                    <option value="sell">پرفروش ترین</option>
                                    <option value="view">پرپازدیدترین</option>
                                    <option value="priceLow">ارزان ترین</option>
                                    <option value="priceHigh">گران ترین</option>
                                </select>
                            </div>
                            <div class="col-sm-2 text-right">
                                <label class="control-label" for="input-limit">نمایش :</label>
                            </div>
                            <div class="col-sm-2 text-right">
                                <select id="limit" name="limit" onchange="doSearch()">
                                    <option value="21">20</option>
                                    <option value="31">30</option>
                                    <option value="41">40</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <br />
                    <div id="products" class="row products-category">
                        @foreach($productItems as $item)
                        <div class="product-layout product-list col-xs-12">
                            <div class="product-thumb">
                                <div class="image"><a href="/product/{{$item->slug}}"><img src="{{asset($item->image)}}" alt=" {{$item->title}} " title=" {{$item->title}} " class="img-responsive" /></a></div>
                                <div>
                                    <div class="caption">
                                        <h4><a href="/product/{{$item->slug}}"> {{str_limit($item->title,40)}} </a></h4>
                                        <p class="description"> {{str_limit($item->excerpt,500)}}</p>
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
                                            @endif                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                   {{$productItems->links()}}
                </div>
                <!--Middle Part End -->
            </div>
        </div>
    </div>


@endsection

@section('script_link')
@endsection

@section('script')
    <script>
        $('.filte_right').click(function () {
            var tag=this;
            if ($(tag).is(':checked')){
                doSearch();
            }else{
                doSearch();
            }
        });
    </script>
    <script>
        function doSearch() {
            var dataval=$('#form-filter-attribute').serializeArray();
            var limit=$('#limit').val();
            var sort=$('#sort').val();
            var minamount=parseInt($('#minamount').val());
            var maxamount=parseInt($('#maxamount').val());
            $('#products').empty()
            var CSRF_TOKEN = '{{ csrf_token() }}';
            var url = '{{route('shop.doSearch')}}';
            var data = {_token: CSRF_TOKEN, dataval:dataval,limit:limit,sort:sort,minamount:minamount,maxamount:maxamount};
            $.post(url, data, function (msg) {
                $('#products').append(msg)
            })
            /*$.ajax({
                type: "post",
                url: "{{route('shop.doSearch')}}",
                data: {
                    data:dataval,
                    exist: "0",
                    _token: '{{csrf_token()}}',
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data.msg);

                },
                error: function (err) {
                    if (err.status == 422) {

                    }
                }
            });*/
        }

    </script>
    <script type="text/javascript">
        function ChangeUrl(page, url) {
                var obj = { Page: page, Url: url };
                history.pushState(obj, obj.Page, 'shop?'+obj.Url);
        }
        $(function () {
            $("#button1").click(function () {
                ChangeUrl('Page1', 'Page1.htm');
            });
            $("#button2").click(function () {
                ChangeUrl('Page2', 'Page2.htm');
            });
            $("#button3").click(function () {
                ChangeUrl('Page3', 'Page3.htm');
            });
        });
    </script>
@endsection
