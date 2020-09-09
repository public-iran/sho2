@extends('front.layout.master')
@section('style_link')
    <link rel="stylesheet" href="{{asset('front/css/userlogin.css')}}">
@endsection
@section('style')
    <style>
        h3{
            font-family: Vazir!important;
        }
        .button{
            background: #7fad39;
            border: 1px solid #7fad39;
            border-radius: 0;
        }
        .button:hover{
            border-color: #7fad39;
        }
        .login_box_area .login_box_img:before{
            background: #7fad39;
        }
        .form-control.is-invalid, .was-validated .form-control:invalid{
            background-position: right calc(23.375em + .1875rem) center;
        }
        .invalid-feedback{

            font-size: 12px;
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
                <div id="content" class="col-sm-9">
                    <h1 class="title">حساب کاربری ورود</h1>
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="subtitle">مشتری جدید</h2>
                            <p><strong>ثبت نام حساب کاربری</strong></p>
                            <p>با ایجاد حساب کاربری میتوانید سریعتر خرید کرده، از وضعیت خرید خود آگاه شده و تاریخچه ی سفارشات خود را مشاهده کنید.</p>
                            <a href="/register" class="btn btn-primary">ادامه</a> </div>
                        <form class="row login_form" method="POST" action="{{ route('login') }}">
                            @csrf
                        <div class="col-sm-6">
                            <h2 class="subtitle">مشتری قبلی</h2>
                            <p><strong>من از قبل مشتری شما هستم</strong></p>
                            <div class="form-group">
                                <label class="control-label" for="input-email">آدرس ایمیل</label>
                                <input type="text" name="email" placeholder="آدرس ایمیل" id="input-email" value="{{ old('email') }}" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" />
                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label class="control-label" for="input-password">رمز عبور</label>
                                <input type="password" name="password" value="" placeholder="رمز عبور" id="input-password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" />
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                                <br />
                               {{-- <a href="#">فراموشی رمز عبور</a></div>--}}
                            <input type="submit" value="ورود" class="btn btn-primary" />
                        </div>
                        </form>
                    </div>
                </div>
                <!--Middle Part End -->
                <!--Right Part Start -->
                <!--Right Part End -->
            </div>
        </div>
    </div>



@endsection
