@extends('adminbizness.layout.master')

@section('Admin_content')
    <div class="row">

        <div class="col-xs-12">
            @if(session('success_payment'))
                <div class="alert alert-dismissible" role="alert" style="background-color: #61c579;">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                    {{session('success_payment')}}
                </div>
            @endif

            <?php
            session()->forget('success_payment');
            ?>
        </div>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            {{--            <div class="card">--}}
            <div class="header">
                <div class="row"
                     style="display: flex;justify-content: space-between;margin-bottom: 15px">
                    <div class="col-lg-6" style="font-size: 15px;color: #666666">
                        لیست سفارشات
                    </div>
                    <div class="col-lg-6" align="left">
                        <a class="btn btn-success" href="{{route('orders.report')}}">خروجی اکسل از همه سفارشات</a>
                    </div>

                </div>
            </div>
            <div class="body table-responsive">
                <table class="table table-hover" style="text-align: center;background: white">
                    <tbody>
                    <tr style="background: #f7f7f7">
                        <td>شماره فاکتور</td>
                        <td>شماره ارجاع</td>
                        <td>شماره تراکنش</td>
                        <td>خریدار</td>
                        <td>تاریخ ثبت سفارش</td>
                        <td>وضعیت سفارش</td>
                        <td>مبلغ فاکتور</td>
                        <td>اقدامات</td>
                    </tr>
                    @foreach($orders as $itemm)
                        <?php
                        $user = App\User::find($itemm->user_id);
                        $item=App\Order::where('factor_number',$itemm->factor_number)->first();
                        ?>
                        <tr style="vertical-align: middle">
                            <td>{{$itemm->factor_number}}</td>
                            <td>{{$item->refId}}</td>
                            <td>{{$item->authority}}</td>
                            <td>{{$user->name.' '.$user->family}}</td>
                            <td>{{Verta($itemm->created_at)}}</td>
                            @if($itemm->pay_status == 'OK')
                                <td>
                                    پرداخت شد
                                </td>
                            @else
                                <td>
                                    پرداخت نشد
                                </td>
                            @endif
                            <td>{{number_format($item->total)}} تومان</td>

                            <td>
                                <a href="{{route('orders-product.show', $item->factor_number)}}"
                                   class="btn bg-blue waves-effect">
                                    مشاهده
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
