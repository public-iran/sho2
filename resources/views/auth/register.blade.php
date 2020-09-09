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
    <div id="container">
        <div class="container">
            <!-- Breadcrumb Start-->

            <!-- Breadcrumb End-->
            <div class="row">
                <!--Middle Part Start-->
                <div class="col-sm-9" id="content">
                    <h1 class="title">ثبت نام حساب کاربری</h1>
                    <p>اگر قبلا حساب کاربریتان را ایجاد کرد اید جهت ورود به <a href="/login">صفحه لاگین</a> مراجعه کنید.</p>
                        <form class="form-horizontal row login_form" action="{{ route('register') }}" method="POST" id="register_form" >
                            @csrf
                        <fieldset id="account">
                            <legend>اطلاعات شخصی شما</legend>
                            <div style="display: none;" class="form-group required">
                                <label class="col-sm-2 control-label">گروه مشتری</label>
                                <div class="col-sm-10">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" checked="checked" value="1" name="customer_group_id">
                                            پیشفرض</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group required">
                                <label for="input-firstname" class="col-sm-2 control-label">نام</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" id="input-firstname" placeholder="نام" value="{{ old('name') }}" name="name">
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required">
                                <label for="input-lastname" class="col-sm-2 control-label">نام خانوادگی</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control{{ $errors->has('family') ? ' is-invalid' : '' }}" id="input-lastname" placeholder="نام خانوادگی" value="{{ old('family') }}" name="family">
                                    @if ($errors->has('family'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required">
                                <label for="input-email" class="col-sm-2 control-label">آدرس ایمیل</label>
                                <div class="col-sm-10">
                                    <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" id="input-email" placeholder="آدرس ایمیل" value="{{ old('email') }}" name="email">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                        </fieldset>

                        <fieldset>
                            <legend>رمز عبور شما</legend>
                            <div class="form-group required">
                                <label for="input-password" class="col-sm-2 control-label">رمز عبور</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" id="input-password" placeholder="رمز عبور" value="" name="password">
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group required">
                                <label for="input-confirm" class="col-sm-2 control-label">تکرار رمز عبور</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control" id="input-confirm" placeholder="تکرار رمز عبور" value="" name="password_confirmation">

                                </div>
                            </div>
                        </fieldset>

                        <div class="buttons">
                            <div class="pull-right">
                                <input type="checkbox" value="1" name="agree">
                                &nbsp;من <a class="agree" href=""><b>سیاست حریم خصوصی</b> را خوانده ام و با آن موافق هستم</a> &nbsp;
                                <input type="submit" class="btn btn-primary" value="ادامه">
                            </div>
                        </div>
                    </form>
                </div>
                <!--Middle Part End -->

            </div>
        </div>
    </div>

@endsection
