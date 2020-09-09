@extends('front.layout.master')
@section('style')
    <style>
        .invalid-feedback{
            display: block;
        }
    </style>
@endsection
@section('content')
    <!--================================
    START BREADCRUMB AREA
=================================-->
    <section class="breadcrumb-area breadcrumb--center breadcrumb--smsbtl dir-rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page_title">
                        <h3>ارتباط با ما</h3>
                        <p class="subtitle">جای درستی آمدی</p>
                    </div>
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="/">خانه</a>
                            </li>
                            <li class="active">
                                <a href="/contact">ارتباط با ما</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->

    <!--================================
        START AFFILIATE AREA
    =================================-->
    <section class="contact-area section--padding dir-rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <!-- start col-md-12 -->
                        <div class="col-md-12">
                            <div class="section-title">
                                <h1>چطور میتوانیم
                                    <span class="highlighted">کمک</span> کنیم؟
                                </h1>
                                {{--
                                                                <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</p>
                                --}}
                            </div>
                        </div>
                        <!-- end /.col-md-12 -->
                    </div>
                    <!-- end /.row -->

                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="contact_tile">
                                <i class="tiles__icon lnr lnr-map-marker"></i>
                                <h4 class="tiles__title">آدرس دفتر</h4>
                                <div class="tiles__content">
                                    <p>{{$setting['address']}} </p>
                                </div>
                            </div>
                        </div>
                        <!-- end /.col-lg-4 col-md-6 -->

                        <div class="col-lg-4 col-md-6">
                            <div class="contact_tile">
                                <i class="tiles__icon lnr lnr-phone"></i>
                                <h4 class="tiles__title">تلفن </h4>
                                <div class="tiles__content">
                                    <p>{{$setting['tell']}} </p>
                                    <p>{{$setting['mobile']}}</p>
                                </div>
                            </div>
                            <!-- end /.contact_tile -->
                        </div>
                        <!-- end /.col-lg-4 col-md-6 -->

                        <div class="col-lg-4 col-md-6">
                            <div class="contact_tile">
                                <i class="tiles__icon lnr lnr-inbox"></i>
                                <h4 class="tiles__title">ایمیل</h4>
                                <div class="tiles__content">
                                    <p>{{$setting['email']}}</p>

                                </div>
                            </div>
                            <!-- end /.contact_tile -->
                        </div>
                        <!-- end /.col-lg-4 col-md-6 -->

                        <div class="col-md-12">
                            <div class="contact_form cardify">
                                <div class="contact_form__title" id="send-message">
                                    <h3>پیغام خود را بنویسید </h3>
                                </div>

                                <div class="row">
                                    <div class="col-md-8 offset-md-2">
                                        <div class="contact_form--wrapper">
                                            <form action="{{route('contact_store')}}" method="post">
                                                @csrf
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input id="fname" name="name" type="text" class="{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                                                   placeholder="نام ">
                                                            @if ($errors->has('name'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input id="lname" name="family" type="text"
                                                                   placeholder="نام خانوادگی">
                                                            @if ($errors->has('family'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('family') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="email" name="email" placeholder="ایمیل">
                                                            @if ($errors->has('email'))
                                                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                                            @endif
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <input type="text" name="mobile" placeholder="تلفن ">

                                                        </div>
                                                    </div>
                                                </div>

                                                <textarea cols="30" rows="10" name="message"
                                                          placeholder="متن خود را بنویسید "></textarea>
                                                @if ($errors->has('message'))
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('message') }}</strong>
                                    </span>
                                                @endif

                                                <div class="sub_btn">
                                                    <button type="submit" class="btn btn--round btn--default">ارسال
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- end /.col-md-8 -->
                                </div>
                                <!-- end /.row -->
                            </div>
                            <!-- end /.contact_form -->
                        </div>
                        <!-- end /.col-md-12 -->
                    </div>
                    <!-- end /.row -->
                </div>
                <!-- end /.col-md-12 -->
            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
        END BREADCRUMB AREA
    =================================-->



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


