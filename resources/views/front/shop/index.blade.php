@extends('front.layout.master')

@section('content')
    <style>
        .product--list-small .product__details .product-desc {
            width: 445px;
        }
        .pagination-area .pagination {
             display: flex;
        }
        .product-purchase .price_love > span {
             background: unset !important;
             border-radius: unset !important;
        }
    </style>
    <!--================================
    START SEARCH AREA
=================================-->
    <section class="search-wrapper dir-rtl">
        <div class="search-area2 bgimage">
            <div class="bg_image_holder">
                <img src="images/new/search.jpg" alt="">
            </div>
            <div class="container content_above">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="search">
                            <div class="search__title">
                                <h3>
                                    <span>35,270</span>  قالب وب سایت از جامعه خلاق ما</h3>
                            </div>
                            <div class="search__field">
                                <form action="#">
                                    <div class="field-wrapper">
                                        <input class="relative-field rounded" type="text" placeholder="چستجو در محصولات ">
                                        <button class="btn btn--round" type="submit">جستجو </button>
                                    </div>
                                </form>
                            </div>
                            <div class="breadcrumb">
                                <ul>
                                    <li>
                                        <a href="#">خانه</a>
                                    </li>
                                    <li class="active">
                                        <a href="#">همه محصولات</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end /.row -->
            </div>
            <!-- end /.container -->
        </div>
        <!-- end /.search-area2 -->
    </section>
    <!--================================
        END SEARCH AREA
    =================================-->


    <!--================================
           START FILTER AREA
       =================================-->
    <div class="filter-area dir-rtl ">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="filter-bar filter--bar2">
                        <div class="pull-right">
                            <div class="filter__option filter--select">
                                <div class="select-wrap">
                                    <select name="sort" id="sort" onchange="doSearch()">
                                        <option value="new">جدید ترین</option>
                                        <option value="sell">پرفروش ترین</option>
                                        <option value="view">پرپازدیدترین</option>
                                        <option value="priceLow">ارزان ترین</option>
                                        <option value="priceHigh">گران ترین</option>
                                    </select>
                                    <span class="lnr lnr-chevron-down" style="font-family: 'Linearicons-Free' !important;"></span>
                                </div>
                            </div>
                            <div class="filter__option filter--select">
                                <div class="select-wrap">
                                    <select id="limit" name="limit" onchange="doSearch()">
                                        <option value="10">10 آیتم در هر صفحه</option>
                                        <option value="20">20 آیتم در هر صفحه</option>
                                        <option value="30">30 آیتم در هر صفحه</option>
                                    </select>
                                    <span class="lnr lnr-chevron-down" style="font-family: 'Linearicons-Free' !important;"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end filter-bar -->
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end filter-bar -->
        </div>
    </div>
    <!--================================
        END FILTER AREA
    =================================-->


    <!--================================
        START PRODUCTS AREA
    =================================-->
    <section class="products section--padding2 dir-rtl ">
        <!-- start container -->
        <div class="container">

            <!-- start .row -->
            <div class="row">
                <!-- start .col-md-3 -->
                <div class="col-lg-3">
                    <!-- start aside -->
                    <aside class="sidebar product--sidebar">
                        <div class="sidebar-card card--category">
                            <a class="card-title" href="#collapse1" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse1">
                                <h4>دسته بندی ها
                                    <span class="lnr lnr-chevron-down" style="font-family: 'Linearicons-Free' !important;"></span>
                                </h4>
                            </a>
                            <div class="collapse show collapsible-content" id="collapse1">
                                <ul class="card-content">
                                    @foreach ($categories as $item)
                                    <li>
                                        <a href="#">
                                            <span class="lnr lnr-chevron-right" style="font-family: 'Linearicons-Free' !important;"></span>{{$item->title}}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- end /.collapsible_content -->
                        </div>
                        <!-- end /.sidebar-card -->

                        <form id="form-filter-attribute" method="post" action="{{route('shop.doSearch')}}" enctype="multipart/form-data">
                        <?php $st=1; ?>
                        @foreach($attributes as $attribute)
                            <?php $st++ ?>
                            <div class="sidebar-card card--filter">
                                <a class="card-title" href="#collapse{{$st}}" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse{{$st}}">
                                    <h4>{{$attribute->title}}
                                        <span class="lnr lnr-chevron-down" style="font-family: 'Linearicons-Free' !important;"></span>
                                    </h4>
                                </a>
                                <div class="collapse show collapsible-content" id="collapse{{$st}}">
                                    <ul class="card-content">
                                        <?php $row=1; ?>
                                        @foreach($attribute->attribute_values as $attribute_value)
                                        <li>
                                            <div class="custom-checkbox2">
                                                <input type="checkbox" name="attr-<?=$attribute['id']?>[]" value="{{$attribute_value->id}}" id="basic_checkbox_{{$attribute->id.$row}}" class="filte_right">
                                                <label for="basic_checkbox_{{$attribute->id.$row}}">
                                                    <span class="circle"></span>{{$attribute_value->value}}
                                                </label>
                                            </div>
                                        </li>
                                                <?php $row++; ?>
                                            @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endforeach
                        </form>



                        <div class="sidebar-card card--slider">
                            <a class="card-title" href="#collapse33" role="button" data-toggle="collapse" aria-expanded="false" aria-controls="collapse33">
                                <h4>فیلتر قیمت
                                    <span class="lnr lnr-chevron-down" style="font-family: 'Linearicons-Free' !important;"></span>
                                </h4>
                            </a>
                            <div class="collapse show collapsible-content" id="collapse33">
                                <div class="card-content">
                                    <div class="range-slider price-range"></div>

                                    <div class="price-ranges">
                                        <span class="from rounded">30 تومان </span>
                                        <span class="to rounded">4000 تومان </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end /.sidebar-card -->
                    </aside>
                    <!-- end aside -->
                </div>
                <!-- end /.col-md-3 -->

                <!-- start col-md-9 -->
                <div class="col-lg-9">
                    <div id="products">
                    @foreach($productItems as $item)
                    <!-- start .single-product -->
                        <div class="product product--list product--list-small">

                            <div class="product__thumbnail">
                                <img class="img-fluid" style="max-height: 210px" src="{{asset($item->image)}}" alt="{{$item->title}}" title="{{$item->title}}">
                                <div class="prod_btn">
                                    <a href="/product/{{$item->slug}}" class="transparent btn--sm btn--round">اطلاعات بیشتر </a>
                                    <a href="/product/{{$item->slug}}" class="transparent btn--sm btn--round">مشاهده</a>
                                </div>
                                <!-- end /.prod_btn -->
                            </div>
                            <!-- end /.product__thumbnail -->

                            <div class="product__details">
                                <div class="product-desc">
                                    <a href="#" class="product_title">
                                        <h4>{{str_limit($item->title,40)}}</h4>
                                    </a>
                                    {{str_limit($item->excerpt,60)}}
                                    <ul class="titlebtm">
                                        <li class="product_cat">
                                            @foreach ($item->categories as $category)

                                                <a href="#">
                                                    <span style="font-size: 12px">{{$category->title}}</span>
                                                </a>
                                            @endforeach
                                        </li>
                                    </ul>
                                    <!-- end /.titlebtm -->
                                </div>
                                <!-- end /.product-desc -->

{{--                                <div class="product-meta">--}}

{{--                                    <div class="love-comments d-flex justify-content-around">--}}
{{--                                        <p>--}}
{{--                                            <span class="lnr lnr-heart" style="font-family: 'Linearicons-Free' !important;"></span> 90--}}
{{--                                        </p>--}}
{{--                                        <p>--}}
{{--                                            <span class="lnr lnr-cart" style="font-family: 'Linearicons-Free' !important;"></span>--}}
{{--                                            <span>16</span>--}}
{{--                                        </p>--}}
{{--                                    </div>--}}
                                    <!-- end /.love-comments -->

                                {{--                                    <div class="rating product--rating">--}}
                                {{--                                        <ul>--}}
                                {{--                                            <li>--}}
                                {{--                                                <span class="fa fa-star"></span>--}}
                                {{--                                            </li>--}}
                                {{--                                            <li>--}}
                                {{--                                                <span class="fa fa-star"></span>--}}
                                {{--                                            </li>--}}
                                {{--                                            <li>--}}
                                {{--                                                <span class="fa fa-star"></span>--}}
                                {{--                                            </li>--}}
                                {{--                                            <li>--}}
                                {{--                                                <span class="fa fa-star"></span>--}}
                                {{--                                            </li>--}}
                                {{--                                            <li>--}}
                                {{--                                                <span class="fa fa-star-half-o"></span>--}}
                                {{--                                            </li>--}}
                                {{--                                        </ul>--}}
                                {{--                                        <span class="rating__count">(34)</span>--}}
                                {{--                                    </div>--}}
                                <!-- end /.rating -->
{{--                                </div>--}}
                                <!-- end /.product-meta -->

                                <div class="product-purchase">
                                    <div class="price_love">
                                        @if($item->discount>0)
                                            <span> <span class="price-new">{{number_format($item->price*(100-$item->discount)/100)}} تومان</span> <span class="price-old" style="text-decoration: line-through">{{number_format($item->price)}} تومان</span> <span class="saving"> تخفیف : {{$item->discount}}%</span> </span>
                                        @else
                                            <span> {{number_format($item->price)}} تومان </span>
                                        @endif
                                    </div>
                                    <div class="love-comments d-flex justify-content-around">
                                        <p>
                                            <span class="lnr lnr-heart" style="font-family: 'Linearicons-Free' !important;"></span> 90
                                        </p>
                                        <p>
                                            <span class="lnr lnr-cart" style="font-family: 'Linearicons-Free' !important;"></span>
                                            <span>16</span>
                                        </p>
                                    </div>

                                    {{--                                    <div class="sell">--}}
                                    {{--                                        <p>--}}
                                    {{--                                            <span class="lnr lnr-cart"></span>--}}
                                    {{--                                            <span>16</span>--}}
                                    {{--                                        </p>--}}
                                    {{--                                    </div>--}}
                                </div>
                                <!-- end /.product-purchase -->
                            </div>
                        </div>
                        <!-- end /.single-product -->
                    @endforeach
                    </div>
                </div>

                <!-- end /.col-md-9 -->
            </div>
            <!-- end /.row -->

            <div class="row">
                <div class="col-md-12">
                    <div class="pagination-area pull-left">
{{--                        <nav class="navigation pagination" role="navigation">--}}
{{--                            <div class="nav-links">--}}

                                {{$productItems->links()}}

                                {{--                                <a class="next page-numbers" href="#">--}}
{{--                                    <span class="lnr lnr-arrow-right" style="font-family: 'Linearicons-Free' !important;"></span>--}}
{{--                                </a>--}}

{{--                                <a class="page-numbers current" href="#">1</a>--}}
{{--                                <a class="page-numbers" href="#">2</a>--}}
{{--                                <a class="page-numbers" href="#">3</a>--}}
{{--                                <a class="prev page-numbers" href="#">--}}
{{--                                    <span class="lnr lnr-arrow-left" style="font-family: 'Linearicons-Free' !important;"></span>--}}
{{--                                </a>--}}

{{--                            </div>--}}
{{--                        </nav>--}}
                    </div>
                </div>
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END PRODUCTS AREA
    =================================-->

    <!--================================
        START SEARCH AREA
    =================================-->
    <section class="search-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                </div>
            </div>
        </div>
    </section>
    <!--================================
       END SEARCH AREA
    =================================-->
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
                console.log(msg)
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
