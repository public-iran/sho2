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
                    <li class="active"> ثبت نام</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Login Content Area -->
    <div class="page-section">
        <div class="container">
            <div class="row">
                <div style="margin: 0 auto" class="col-sm-12 col-md-6 col-lg-6 col-xs-12">
                    <form class="form-horizontal row login_form" action="{{ route('register') }}" method="POST" id="register_form" >
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">ثبت نام</h4>
                            <div class="row">
                                <div class="col-md-6 col-12 mb-20">
                                    <label>نام اصلی</label>
                                    <input name="name" class="mb-0" type="text" placeholder="نام اصلی">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6 col-12 mb-20">
                                    <label>نام خانوادگی</label>
                                    <input class="mb-0" name="family" type="text" placeholder="نام خانوادگی">
                                    @if ($errors->has('family'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-12 mb-20">
                                    <label>آدرس ایمیل*</label>
                                    <input class="mb-0" name="email" type="email" placeholder="آدرس ایمیل">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>رمزعبور</label>
                                    <input class="mb-0" name="password" type="password" placeholder="رمزعبور">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="col-md-6 mb-20">
                                    <label>تایید رمز عبور</label>
                                    <input class="mb-0" name="password_confirmation" type="password" placeholder="تایید رمز عبور">


                                </div>
                                <div class="col-12">
                                    <button type="submit" class="register-button mt-0">ثبت نام</button>
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
