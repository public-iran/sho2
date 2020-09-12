@extends('front.layout.master')

@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="/">خانه</a></li>
                    <li class="active">فروشگاه </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Li's Content Wraper Area -->
    <div class="content-wraper pt-60 pb-60 pt-sm-30">
        <div class="container">

            <div class="row">

                    <div class="col-lg-9 order-1 order-lg-2">
                        <!-- Begin Li's Banner Area -->
                    {{--       <div class="single-banner shop-page-banner">
                               <a href="#">
                                   <img src="images/bg-banner/2.jpg" alt="Li's Static Banner">
                               </a>
                           </div>--}}
                    <!-- Li's Banner Area End Here -->
                        <!-- shop-top-bar start -->
                        <div class="shop-top-bar mt-30">
                            <div class="shop-bar-inner">
                                <div class="product-view-mode">
                                    <!-- shop-item-filter-list start -->

                                    <!-- shop-item-filter-list end -->
                                </div>
                                <div class="toolbar-amount">
                                    <select id="limit" name="limit" onchange="doSearch()">
                                        <option value="10">10 آیتم در هر صفحه</option>
                                        <option value="20">20 آیتم در هر صفحه</option>
                                        <option value="30">30 آیتم در هر صفحه</option>
                                    </select>
                                </div>
                            </div>
                            <!-- product-select-box start -->
                            <div class="product-select-box">
                                <div class="product-short">
                                    <p style="    width: 210px;">مرتب سازی بر اساس:</p>
                                    <select name="sort" id="sort" onchange="doSearch()">
                                        <option value="new">جدید ترین</option>
                                        <option value="sell">پرفروش ترین</option>
                                        <option value="view">پرپازدیدترین</option>
                                        <option value="priceLow">ارزان ترین</option>
                                        <option value="priceHigh">گران ترین</option>
                                    </select>
                                </div>
                            </div>
                            <!-- product-select-box end -->
                        </div>
                        <!-- shop-top-bar end -->
                        <!-- shop-products-wrapper start -->
                        <div class="shop-products-wrapper">
                            <div class="tab-content">
                                <div id="grid-view" class="tab-pane fade active show" role="tabpanel">
                                    <div class="product-area shop-product-area">
                                        <div class="row" id="products">
                                            @foreach($productItems as $item)
                                                <div class="col-lg-4 col-md-4 col-sm-6 mt-40">
                                                    <!-- single-product-wrap start -->
                                                    <div class="single-product-wrap">
                                                        <div class="product-image" style="text-align: center">
                                                            <a href="/product/{{$item->slug}}">
                                                                <img style="width: 70%" src="{{asset($item->image)}}" alt="{{$item->title}}">
                                                            </a>
                                                            @if($item->discount>0)
                                                                <span class="sticker">{{$item->discount}}%</span>
                                                            @endif
                                                        </div>
                                                        <div class="product_desc">
                                                            <div class="product_desc_info">
                                                                <div class="product-review">
                                                                    {{--      <h5 class="manufacturer">
                                                                              <a href="/product/{{$item->slug}}">{{$item->title}}</a>
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
                                                                <h4><a class="product_name" href="/product/{{$item->slug}}">{{str_limit($item->title,50)}}</a></h4>
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
                                                                        <li class="add-cart active" style="background: #ccc"><a>افزودن به سبد خرید</a></li>
                                                                    @endif                                                                    @php
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
                                {{$productItems->links()}}

                            </div>
                        </div>
                        <!-- shop-products-wrapper end -->
                    </div>
                    <div class="col-lg-3 order-2 order-lg-1">

                        <!--sidebar-categores-box start  -->
                        <div class="sidebar-categores-box mt-sm-30 mt-xs-30">
                            <div class="sidebar-title">
                                <h2>لپ تاپ</h2>
                            </div>
                            <!-- category-sub-menu start -->
                            <div class="category-sub-menu">
                                <ul>
                                    @foreach($categories as $category)
                                        @php $categories2=App\Category::where('parent',$category->id)->get(); @endphp
                                    <li class="@if(count($categories2)) has-sub @endif"><a href="/shop?cat={{$category->slug}} ">{{$category->title}}</a>
                                        <ul>
                                            @foreach($categories2 as $category2)
                                                @php $categories3=App\Category::where('parent',$category2->id)->get(); @endphp
                                            <li class="@if(count($categories3)) has-sub @endif"><a href="/shop?cat={{$category2->slug}} ">{{$category2->title}}</a>
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
                            <!-- category-sub-menu end -->
                        </div>
                        <!--sidebar-categores-box end  -->
                        <!--sidebar-categores-box start  -->
                            <form id="form-filter-attribute" method="post">
                        <div class="sidebar-categores-box">
                            <div class="sidebar-title">
                                <h2>فیلتر بر اساس</h2>
                            </div>
                            <!-- btn-clear-all start -->
                        {{--   <button class="btn-clear-all mb-sm-30 mb-xs-30">پاک کردن همه</button>--}}
                        <!-- btn-clear-all end -->
                            <!-- filter-sub-area start -->
                            <?php $st=1; ?>
                            @foreach($attributes as $attribute)
                                <?php $st++ ?>
                                <div class="filter-sub-area">
                                    <h5 class="filter-sub-titel">{{$attribute->title}}</h5>
                                    <div class="categori-checkbox">
                                            <ul><?php $row=1; ?>
                                                @foreach($attribute->attribute_values as $attribute_value)
                                                    <li><input class="filte_right" name="attr-<?=$attribute['id']?>[]" value="{{$attribute_value->id}}" type="checkbox" ><a>{{$attribute_value->value}}</a></li>
                                                    <?php $row++; ?>
                                                @endforeach
                                            </ul>
                                    </div>
                                </div>
                        @endforeach
                        <!-- filter-sub-area end -->


                        </div>
                            </form>
                        <!--sidebar-categores-box end  -->
                        <!-- category-sub-menu start -->

                    </div>


            </div>

        </div>
    </div>
    <!-- Content Wraper Area End Here -->

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
