@extends('front.layout.master')
@section('style_link')

@endsection
@section('style')
    <style>
        .li-blog-sidebar .li-recent-post .li-recent-post-thumb{
            border: none;
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
                    <li class="active">وبلاگ </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Li's Main Blog Page Area -->
    <div class="li-main-blog-page pt-60 pb-55">
        <div class="container">
            @if(@$_GET['title'])
                <h3 style="padding: 15px 0">
                    جستجو
                    <span>"{{$_GET['title']}}"</span>
                </h3>
            @endif
            <div class="row">
                <!-- Begin Li's Blog Sidebar Area -->
                <div class="col-lg-3 order-lg-1 order-2">
                    <div class="li-blog-sidebar-wrapper">
                        <div class="li-blog-sidebar">
                            <div class="li-sidebar-search-form pt-xs-30 pt-sm-30">
                                <form action="{{route('post_search')}}">
                                    <input name="title" type="text" class="li-search-field" placeholder="جستجو در اینجا">
                                    <button type="submit" class="li-search-btn"><i class="fa fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <div class="li-blog-sidebar pt-25">
                            <h4 class="li-blog-sidebar-title">دسته ها</h4>
                            <ul class="li-blog-archive">
                                @foreach($categories as $category)
                                <li><a href="/blog?cat={{$category->slug}}">{{$category->title}}</a></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="li-blog-sidebar">
                            <h4 class="li-blog-sidebar-title">آخرین پست</h4>
                            @foreach($last_posts as $post)
                            <div class="li-recent-post pb-30">
                                <div class="li-recent-post-thumb">
                                    <a href="/blog/{{$post->slug}}">
                                        <img class="img-full" src="{{asset($post->imgPath)}}" alt="{{$post->title}}">
                                    </a>
                                </div>
                                <div class="li-recent-post-des">
                                    <span><a href="/blog/{{$post->slug}}">{{str_limit($post->title,40)}}</a></span>
                                    <span class="li-post-date">{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        {{--<div class="li-blog-sidebar">
                            <h4 class="li-blog-sidebar-title">برچسب ها</h4>
                            <ul class="li-blog-tags">
                                <li><a href="#">گیمینگ</a></li>
                                <li><a href="#">کروم بوک</a></li>
                                <li><a href="#">مرمت شده</a></li>
                                <li><a href="#">صفحه لمسی</a></li>
                                <li><a href="#">اولترابوک ها</a></li>
                                <li><a href="#">کارت های صوتی</a></li>
                            </ul>
                        </div>--}}
                    </div>
                </div>
                <!-- Li's Blog Sidebar Area End Here -->
                <!-- Begin Li's Main Content Area -->
                <div class="col-lg-9 order-lg-2 order-1">
                    <div class="row li-main-content">
                        @foreach($posts as $post)
                            <div class="col-lg-6 col-md-6">
                                <div class="li-blog-single-item pb-25">
                                    <div class="li-blog-gallery-slider slick-dot-style">
                                        <div class="li-blog-banner">
                                            <a href="/blog/{{$post->slug}}"><img class="img-full" src="{{asset($post->imgPath)}}" alt="{{$post->title}}"></a>
                                        </div>
                                    </div>
                                    <div class="li-blog-content">
                                        <div class="li-blog-details">
                                            <h3 class="li-blog-heading pt-25"><a href="/blog/{{$post->slug}}">{{str_limit($post->title,40)}}</a></h3>
                                            <div class="li-blog-meta">
                                                <a class="author"><i class="fa fa-user"></i>مدیر</a>
                                                <a class="comment"><i class="fa fa-eye"></i> {{$post->view}} بازدید </a>
                                                <a class="post-time"><i class="fa fa-calendar"></i>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</a>
                                            </div>
                                            <p>{{str_limit($post->shortContent,300)}}</p>
                                            <a class="read-more" href="/blog/{{$post->slug}}">ادامه مطلب...</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- Li's Main Content Area End Here -->
            </div>
        </div>
    </div>
    <!-- Li's Main Blog Page Area End Here -->


@endsection
