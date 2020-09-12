@extends('front.layout.master')
@section('style_link')
    <link rel="stylesheet" href="{{asset('front/css/userlogin.css')}}">
@endsection
@section('style')
    <style>
        .text-md-right{
            text-align: left!important;
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
                    <li class="active">ورود</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Login Content Area -->
    <div class="page-section">
        <div class="container">
            <div class="row">
                <div style="margin: 0 auto" class="col-sm-12 col-md-6 col-xs-12 col-lg-6">
                    <!-- Login Form s-->
                    <form class="row login_form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">ورود</h4>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>آدرس ایمیل*</label>
                                    <input class="mb-0" name="email" type="email" placeholder="آدرس ایمیل">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-12 mb-20">
                                    <label>رمزعبور</label>
                                    <input class="mb-0" name="password" type="password" placeholder="رمزعبور">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-4">
                                    <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                        <input type="checkbox" id="remember_me">
                                        <label for="remember_me">مرا به خاطر بسپار</label>
                                    </div>
                                </div>
                                <div class="col-md-8 mt-10 mb-20 text-left text-md-right">
                                    <a href="#"> رمز عبور را فراموش کرده اید؟</a>
                                    <a href="/register"> هنوز ثبت نام نکرده اید؟</a>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="register-button mt-0">ورود</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Login Content Area End Here -->





@endsection
