@extends('front.layout.master')
@section('style')

@endsection
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="index.html">خانه</a></li>
                    <li class="active">تماس</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Contact Main Page Area -->
    <div class="contact-main-page mt-60 mb-40 mb-md-40 mb-sm-40 mb-xs-40">
       {{-- <div class="container mb-60">
            <div id="google-map"></div>
        </div>--}}
        <div class="container">
            <div class="row">
                <div class="col-lg-5 offset-lg-1 col-md-12 order-1 order-lg-2">
                    <div class="contact-page-side-content">
                        <h3 class="contact-page-title">تماس با ما</h3>
                        <p class="contact-page-message mb-25">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف.</p>
                        <div class="single-contact-block">
                            <h4><i class="fa fa-fax"></i> آدرس</h4>
                            <p>{{$setting['address']}}</p>
                        </div>
                        <div class="single-contact-block">
                            <h4><i class="fa fa-phone"></i> تلفن</h4>
                            <p>موبایل: {{$setting['mobile']}} </p>
                            <p>خط تلفن: {{$setting['tell']}} </p>
                        </div>
                        <div class="single-contact-block last-child">
                            <h4><i class="fa fa-envelope-o"></i> ایمیل</h4>
                            <p>{{$setting['email']}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 order-2 order-lg-1">
                    <div class="contact-form-content pt-sm-55 pt-xs-55">
                        <h3 class="contact-page-title">پیام خود را به ما بگویید</h3>
                        <div class="contact-form">
                            <form id="contact-form" action="{{route('contact_store')}}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label>نام شما <span class="required">*</span></label>
                                    <input type="text" name="name" id="customername" placeholder="نام " required>
                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>نام خانوادگی شما <span class="required">*</span></label>
                                    <input type="text" name="family" id="customername" placeholder="نام خانوادگی " required>
                                    @if ($errors->has('family'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>ایمیل شما <span class="required">*</span></label>
                                    <input type="email" name="email" id="customerEmail" placeholder="ایمیل" required>
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group mb-30">
                                    <label>پیام شما</label>
                                    <textarea name="message" id="contactMessage" placeholder="متن خود را بنویسید "></textarea>
                                    @if ($errors->has('message'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="li-btn-3">ارسال</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Contact Main Page Area End Here -->
@endsection
@section('script')
    @if(session('save_comment'))
        <script>
            alertify.set('notifier','position', 'bottom-left');
            alertify.success('پیام شما با موفقیت ارسال شد!');
        </script>
    @endif
@endsection
@php
    Session::forget('save_comment');
@endphp
