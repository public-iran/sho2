@php

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
@extends('front.layout.master')
@section('style_link')

@endsection
@section('style')
    <style>
        .checkout__form {
            text-align: right;
        }

        .checkout h6 {
            margin-bottom: 0;
            border: none;
        }

        .card {
            background: none;
            border: none;
        }

        .form-control {
            display: block !important;
        }

        div.nice-select {
            display: none !important;
        }

        .invalid-feedback {
            display: block;
            font-size: 11px;
        }
        .invalid-feedback{
            color: red;
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
                @if($countcart!=0)
                <div id="content" class="col-sm-12">
                    <h1 class="title">تسویه حساب</h1>
                    <form action="/order-verify" method="post">
                        @csrf
                    <div class="row">
                        <div class="col-sm-4">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fa fa-user"></i> اطلاعات شخصی شما</h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset id="account">
                                        <div class="form-group required">
                                            <label for="input-payment-firstname" class="control-label">نام</label>
                                            <input type="text" class="form-control" id="input-payment-firstname"
                                                   placeholder="نام"
                                                   value="@if(old('name')==""){{$user->name}}@else{{old('name')}} @endif"
                                                   name="name">
                                            @if ($errors->has('name'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                        <div class="form-group required">
                                            <label for="input-payment-lastname" class="control-label">نام
                                                خانوادگی</label>
                                            <input type="text" class="form-control" id="input-payment-lastname"
                                                   placeholder="نام خانوادگی"
                                                   value="@if(old('family')==""){{$user->family}}@else{{old('family')}} @endif"
                                                   name="family">
                                            @if ($errors->has('family'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('family') }}</strong>
                                                 </span>
                                            @endif
                                        </div>

                                        <div class="form-group">
                                            <label for="input-payment-telephone" class="control-label">شماره
                                                تلفن</label>
                                            <input type="text" class="form-control" id="input-payment-telephone"
                                                   placeholder="شماره تلفن"
                                                   value="@if(old('tell')==""){{$user->tell}}@else{{old('tell')}} @endif"
                                                   name="tell">

                                        </div>
                                        <div class="form-group required">
                                            <label for="input-payment-fax" class="control-label">شماره موبایل</label>
                                            <input type="text" class="form-control" id="input-payment-fax"
                                                   placeholder="موبایل"
                                                   value="@if(old('mobile')==""){{$user->mobile}}@else{{old('mobile')}} @endif"
                                                   name="mobile">
                                            @if ($errors->has('mobile'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('mobile') }}</strong>
                                                 </span>
                                            @endif
                                        </div>
                                    </fieldset>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title"><i class="fa fa-book"></i> آدرس</h4>
                                </div>
                                <div class="panel-body">
                                    <fieldset id="address" class="required">


                                        <div class="form-group required">
                                            <label for="input-payment-zone" class="control-label"> استان</label>
                                            <select id="ostan" name="ostan_id"
                                                    class="selectpicker state ostan form-control show-tick"
                                                    data-live-search="true">
                                                <option>استان را انتخاب کنید</option>
                                            </select>
                                            @if ($errors->has('state'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('state') }}</strong>
                                                 </span>
                                            @endif
                                            <input name="state" type="hidden" value="{{$user->ostan}}">
                                        </div>
                                        <div class="form-group required">
                                            <label for="input-payment-country" class="control-label">شهر</label>
                                            <select id="city" name="city_id" onchange="set_state_name()"
                                                    class="selectpicker form-control show-tick city">
                                                <option>ابتدا استان را انتخاب کنید</option>
                                            </select>
                                            @if ($errors->has('city'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                 </span>
                                            @endif
                                            <input name="city" type="hidden" value="{{$user->city}}"></div>
                                        <div class="form-group required">
                                            <label for="input-payment-address-1" class="control-label">آدرس 1</label>
                                            <textarea type="text" class="form-control" id="input-payment-address-1"
                                                      placeholder="آدرس پستی مقصد"
                                                      name="address">@if(old('address')==""){{$user->address}}@else{{old('address')}} @endif</textarea>
                                            @if ($errors->has('address'))
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('address') }}</strong>
                                                 </span>
                                            @endif
                                        </div>

                                    </fieldset>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><i class="fa fa-truck"></i> شیوه ی تحویل</h4>
                                        </div>
                                        <div class="panel-body">
                                            <p>هزینه ازسال رایگان، خرید
                                                بالای {{number_format($setting['send_price_top'])}} تومان </p>

                                            <?php $tp = [] ?>
                                            @foreach($carts as $cart)
                                                @php
                                                $tp[]=$cart->price*$cart->qty;
                                            @endphp
                                            @endforeach
                                            @if(array_sum($tp)<$setting['send_price_top'])
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="Flat Shipping Rate" checked>
                                                    هزینه ی ثابت - {{$setting['send_price']}} تومان</label>
                                            </div>
                                            @else
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio"  checked> رایگان</label>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><i class="fa fa-credit-card"></i> شیوه پرداخت</h4>
                                        </div>
                                        <div class="panel-body">
                                            <p>لطفا یک شیوه پرداخت برای سفارش خود انتخاب کنید.</p>
                                            @if(@$setting['pay_home']=='true')
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="pay_home" value="true">
                                                        پرداخت هنگام تحویل</label>
                                                </div>
                                            @endif
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="pay_home" checked="checked"
                                                           value="Paypal">
                                                    زرین پال</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{--      <div class="col-sm-12">
                                          <div class="panel panel-default">
                                              <div class="panel-heading">
                                                  <h4 class="panel-title"><i class="fa fa-ticket"></i> استفاده از کوپن تخفیف</h4>
                                              </div>
                                              <div class="panel-body">
                                                  <label for="input-coupon" class="col-sm-3 control-label">کد تخفیف خود را وارد کنید</label>
                                                  <div class="input-group">
                                                      <input type="text" class="form-control" id="input-coupon" placeholder="کد تخفیف خود را در اینجا وارد کنید" value="" name="coupon">
                                                      <span class="input-group-btn">
                                <input type="button" class="btn btn-primary" data-loading-text="بارگذاری ..." id="button-coupon" value="اعمال کوپن">
                                </span></div>
                                              </div>
                                          </div>
                                      </div>
                                      <div class="col-sm-12">
                                          <div class="panel panel-default">
                                              <div class="panel-heading">
                                                  <h4 class="panel-title"><i class="fa fa-gift"></i> استفاده از کارت هدیه</h4>
                                              </div>
                                              <div class="panel-body">
                                                  <label for="input-voucher" class="col-sm-3 control-label">کد کارت هدیه خود را وارد کنید</label>
                                                  <div class="input-group">
                                                      <input type="text" class="form-control" id="input-voucher" placeholder="کد کارت هدیه خود را در اینجا وارد کنید" value="" name="voucher">
                                                      <span class="input-group-btn">
                                <input type="submit" class="btn btn-primary" data-loading-text="بارگذاری ..." id="button-voucher" value="اعمال کارت هدیه">
                                </span> </div>
                                              </div>
                                          </div>
                                      </div>--}}
                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><i class="fa fa-shopping-cart"></i> سبد خرید</h4>
                                        </div>
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                    <tr>
                                                        <td class="text-center">تصویر</td>
                                                        <td class="text-left">نام محصول</td>
                                                        <td class="text-left">تعداد</td>
                                                        <td style="text-align: center" class="text-right">قیمت واحد</td>
                                                        <td style="text-align: center" class="text-right">کل</td>
                                                    </tr>
                                                    </thead>
                                                    <tbody>


                                                    @foreach($carts as $cart)
                                                        <tr>
                                                            <td class="text-center"><a target="_blank" href="/product/{{$cart->options->product_slug}}"><img style="width: 130px"
                                                                        src="{{asset($cart->options->image)}}"
                                                                        alt="{{$cart->name}}" title="{{$cart->name}}"
                                                                        class="img-thumbnail"></a></td>
                                                            <td class="text-left"><a target="_blank" href="/product/{{$cart->options->product_slug}}">{{$cart->name}}</a></td>
                                                            <td class="text-left">{{$cart->qty}}</td>
                                                            <td style="min-width: 140px;text-align: center" class="text-right">{{number_format($cart->price)}} تومان</td>
                                                            <td style="min-width: 140px;text-align: center" class="text-right">{{number_format($cart->price*$cart->qty)}} تومان</td>
                                                        </tr>

                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <td class="text-right" colspan="4"><strong>جمع کل:</strong></td>
                                                        <td class="text-right">{{$total_price}} تومان</td>
                                                    </tr>
                                                    <tr>

                                                        <td class="text-right" colspan="4"><strong>هزینه ارسال ثابت
                                                                :</strong></td>
                                                            @if(array_sum($tp)<$setting['send_price_top'])
                                                        <td class="text-right">{{$setting['send_price']}} تومان</td>
                                                        @else
                                                            <td class="text-right">رایگان</td>
                                                        @endif
                                                    </tr>
                                                    {{-- <tr>
                                                         <td class="text-right" colspan="4"><strong>کسر هدیه:</strong></td>
                                                         <td class="text-right">4000 تومان</td>
                                                     </tr>--}}
                                                    {{--<tr>
                                                        <td class="text-right" colspan="4"><strong>مالیات:</strong></td>
                                                        <td class="text-right">15100 تومان</td>
                                                    </tr>--}}
                                                    <tr>
                                                        <td class="text-right" colspan="4"><strong>کل :</strong></td>
                                                        @php
                                                            $Total=filter_var($total_price, FILTER_SANITIZE_NUMBER_INT);
                                                              $Total=$Total+$setting['send_price'];
                                                        @endphp

                                                        <td class="text-right">{{number_format($Total)}} تومان</td>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><i class="fa fa-pencil"></i> افزودن توضیح برای
                                                سفارش.</h4>
                                        </div>
                                        <div class="panel-body">
                                            <textarea rows="4" class="form-control" id="confirm_comment"
                                                      name="description"></textarea>
                                            <br>
                                            <label class="control-label" for="confirm_agree">
                                                <input type="checkbox" checked="checked" value="1" required=""
                                                       class="validate required" id="confirm_agree"
                                                       name="confirm agree">
                                                <span><a class="agree" href="#"><b>شرایط و قوانین</b></a> را خوانده ام و با آنها موافق هستم.</span>
                                            </label>
                                            <div class="buttons">
                                                <div class="pull-right">
                                                    <input type="submit"  id="pay_price" class="btn btn-primary site-btn"
                                                           value="تایید سفارش">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <!--Middle Part End -->
                @else
                    <div class="checkout__form">
                        <h4>سبد خرید شما خالی می باشد!</h4>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Checkout Section End -->
@endsection



@section('script_link')
    <script src="{{asset(('js/frotel/ostan.js'))}}"></script>
    <script src="{{asset('js/frotel/city.js')}}"></script>
@endsection
@section('script')
    <script>
        $('#pay_home').click(function () {
            if (this.checked) {
                $('#pay_price').hide();
                $('#pay_home_price').show();
            } else {
                $('#pay_price').show();
                $('#pay_home_price').hide()
            }

        });
    </script>

    <script>

        loadOstan('ostan');
        $("#ostan").change(function () {
            var i = $(this).find('option:selected').val();
            ldMenu(i, 'city');
            $('.selectpicker').selectpicker('refresh');
        });

        function set_state_name() {
            var ostan_name = $('#ostan option:selected').text();
            var city_name = $('#city option:selected').text();
            $('input[name=city]').val(city_name);
            $('input[name=state]').val(ostan_name);
        }

        $('#ostan option').each(function (index) {

            var value_ostan = $(this).val();
            var state = '{{$user->ostan_id}}';
            if (value_ostan == state) {
                $(this).attr('selected', 'selected');
                ldMenu(value_ostan, 'city');

            }


        });

        $('.city option').each(function (index) {
            var city = '{{$user->city_id}}';
            var city_value = $(this).val();
            if (city_value == city) {
                $(this).attr('selected', 'selected');
                $('.selectpicker').selectpicker('refresh');
            }
        });

    </script>
@endsection
