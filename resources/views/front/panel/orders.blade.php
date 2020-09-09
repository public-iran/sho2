@extends('front.panel.layout')

@section('content_panel')
    @if(session('success_payment'))
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-check"></i>
        {{session('success_payment')}}
    </div>
    @endif
    @if(session('error_payment'))
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-ban"></i>
        {{session('error_payment')}}
    </div>
    @endif
            <section class="content-header">
                <h1>
                    لیست سفارش ها
                </h1>

            </section>

            <!-- Main content -->
            <section class="content">


                <div class="box">

                    <div class="box-body">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <tbody><tr>
                                    <th> تصویر </th>
                                    <th> عنوان </th>
                                    <th>شماره فاکتور</th>
                                    <th>تاریخ ثبت سفارش</th>
                                    <th>تعداد</th>
                                    <th>مبلغ کل</th>
                                    <th>عملیات پرداخت</th>
                                    <th>اطلاعات تحویل گیرنده</th>
                                    <th>وضعیت</th>
                                </tr>
                                @foreach($orders as $order)

                                    <tr>
                                        <td><img width="80" src="{{asset($order->product->image)}}"></td>
                                        <td><a target="_blank" href="product/{{$order->product->slug}}">{{str_limit($order->product->title,30)}}</a></td>
                                        <td>{{$order->factor_number}}</td>
                                        <td>{{Verta($order->created_at)}}</td>
                                        <td>{{$order->count}}</td>
                                        <td>{{number_format($order->total)}} تومان</td>
                                        <td>
                                            @if($order->pay_status == 'OK')
                                                <span class="label label-success">پرداخت شده</span>
                                            @else
                                                <span class="label label-danger">پرداخت نشده</span>
                                                {{-- <button type="submit" class="btn btn-default">پرداخت</button>--}}
                                            @endif
                                        </td>
                                        <td>
                                            <div>{{$order->name.' '.$order->family}}</div>
                                            <div>{{$order->state.' '.$order->city.' '.$order->address}}</div>
                                        </td>
                                        <td>
                                            @if($order->send_status=="NO")
                                                <span class="label">درحال برسی</span>
                                            @else
                                                <span class="label">ارسال شده</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody></table>
                        </div>
                        {{$orders->links()}}
                    </div>
                </div>
            </section>
            <!-- /.content -->

@endsection

