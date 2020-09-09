@extends('adminbizness.layout.master')

@section('Admin_content')
    <div class="row">

        <div class="col-xs-12">
            @if(session('delete_product'))
                <div class="alert alert-dismissible" role="alert" style="background-color: #61c579;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    {{session('delete_product')}}
                </div>
            @endif

            <?php
            session()->forget('delete_product');
            ?>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            {{--            <div class="card">--}}
            <div class="header">
                <div class="row" style="display: flex;justify-content: space-between;margin-bottom: 15px">
                    @if(Auth()->user()->role ==1)
                        <div class="col-lg-6" style="font-size: 15px;">
                            <div style="color: #ffffff; background: #dc838f; padding: 10px;">
                                لیست سفارش {{$orders[0]->name}} به شماره فاکتور {{$orders[0]->factor_number}}
                            </div>
                        </div>
                    @else
                        <div class="col-lg-6" style="font-size: 15px;">
                            <div style="color: #ffffff; background: #dc838f; padding: 10px;">
                                لیست سفارش شما به شماره فاکتور {{$orders[0]->factor_number}}
                            </div>
                        </div>
                    @endif
                    <?php
                    foreach ($orders as $order) {
                        $price[] = $order->payprice;
                    }
                    ?>
                    <div class="col-lg-6" style="font-size: 15px;">
                        <div style="color: #ffffff; background: #dc838f; padding: 10px;">
                            مجموع پرداختی : {{number_format(array_sum($price))}} تومان
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div style="background: #1589ee;color:#fff;padding: 10px;margin-bottom: 20px">آدرس پستی
                            : {{$orders[0]->address}}</div>
                    </div>
                </div>

            </div>
            <div class="body table-responsive">
                <table class="table table-hover" style="text-align: center;background: white;font-size: 12px">
                    <tbody>
                    <tr style="background: #f7f7f7">
                        <td>عنوان محصول</td>

                        <td>قیمت اصلی</td>
                        <td>تخفیف(درصد)</td>
                        <td>قیمت با تخفیف</td>
                        <td>تعداد</td>
                        <td>قیمت کل</td>
                        <td>نام خریدار</td>
                        <td>استان</td>
                        <td>شهر</td>
                        <td>شماره تماس</td>
                        <td>توضیحات</td>
                        <td>تاریخ</td>
                        <td>اقدامات</td>

                    </tr>
                    @foreach($orders as $item)
                        <?php
                        $product = App\Product::findorfail($item->product_id);
                        $seller = App\User::findorfail($item->seller_id);
                        ?>
                        <tr style="vertical-align: middle">
                            <td style="word-wrap: break-word;width: 200px">{{$product->title}}</td>
                            <td>{{number_format($product->price)}} تومان</td>
                            <td>%{{$product->discount}}</td>
                            <td>{{number_format(($product->price*(100-$product->discount)/100))}} تومان</td>
                            <td>{{$item->count .' '.$product->unit}}</td>
                            <td>{{number_format(($product->price*(100-$product->discount)/100)*$item->count)}} تومان</td>
                            @if(Auth()->user()->role ==1)
                                <td>{{$seller->name.' '.$seller->family}}</td>
                            @endif
                            <td>{{$item->state}}</td>
                            <td>{{$item->city}}</td>
                            <td>{{$item->mobile}}</td>
                            <td>{{$item->description}}</td>
                            <td>{{Verta($item->created_at)}}</td>
                            <td>
                                <a href="{{route('orders-product.show', $item->factor_number)}}"
                                   class="btn bg-blue waves-effect">
                                    آماده ارسال
                                </a>
                            </td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{--            </div>--}}
        </div>
    </div>
@endsection
