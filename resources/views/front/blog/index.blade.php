@extends('front.layout.master')
@section('style_link')

@endsection
@section('style')

@endsection
@section('content')
    <!--================================
    START BREADCRUMB AREA
=================================-->
    <section class="breadcrumb-area dir-rtl">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="breadcrumb">
                        <ul>
                            <li>
                                <a href="/">خانه</a>
                            </li>
                            <li class="active">
                                <a href="/blog">مقالات</a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">مقالات و دانستنی ها</h1>
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
            START LOGIN AREA
    =================================-->
    <section class="blog_area section--padding2 dir-rtl">
        <div class="container">
            @if(@$_GET['title'])
                <h3 style="padding: 15px 0">
                    جستجو
                    <span>"{{$_GET['title']}}"</span>
                </h3>
                @endif
            <div class="row">
                <div class="col-lg-8">
                    @foreach($posts as $post)
                    <div class="single_blog blog--default">
                        <figure>
                            <img src="{{asset($post->imgPath)}}" alt="{{$post->title}}">

                            <figcaption>
                                <div class="blog__content">
                                    <a href="/blog/{{$post->slug}}" class="blog__title">
                                        <h4>{{$post->title}}</h4>
                                    </a>

                                    <div class="blog__meta mt-3">
                                        {{--<div class="author">
                                            <span class="lnr lnr-user"></span>
                                            <p>خرید از
                                                <a href="#">دامن دریا </a>
                                            </p>
                                        </div>--}}
                                        <div class="date_time">
                                            <i class="lnr lnr-clock"></i>
                                            <p> {{Verta::instance($post->updated_at)->format(' %d %B %Y')}}
                                            </p>
                                        </div>
                                        <div class="comment_view">
                                           {{-- <p class="comment">
                                                <span class="lnr lnr-bubble"></span>45</p>--}}
                                            <p class="view">
                                                <i class="lnr lnr-eye"></i>{{$post->view}}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="btn_text">
                                    <p>{{str_limit($post->shortContent,300)}}
                                    </p>
                                    <a href="/blog/{{$post->slug}}" class="btn btn--md btn--round">اطلاعات بیشتر </a>
                                </div>
                            </figcaption>
                        </figure>
                    </div>
                    <!-- end /.single_blog -->
                    @endforeach

                </div>
                <!-- end /.col-md-8 -->


                <div class="col-lg-4">
                    <aside class="sidebar sidebar--blog">
                        <div class="sidebar-card card--search card--blog_sidebar">
                            <div class="card-title">
                                <h4>جستحو در مقالات </h4>
                            </div>
                            <!-- end /.card-title -->

                            <div class="card_content">
                                <form action="{{route('post_search')}}">
                                    <div class="searc-wrap">
                                        <input type="text" name="title" placeholder="عنوان مقاله را وارد کنید...">
                                        <button type="submit" class="search-wrap__btn">
                                            <i class="lnr lnr-magnifier"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!-- end /.card_content -->
                        </div>
                        <!-- end /.sidebar-card -->

                        <div class="sidebar-card sidebar--post card--blog_sidebar">
                            <div class="card-title">
                                <!-- Nav tabs -->
                                <ul class="nav post-tab" role="tablist">
                                    <li>
                                        <a href="#popular" class="active" id="popular-tab" aria-controls="popular" role="tab" data-toggle="tab" aria-selected="true">پربازدید ترین ها </a>
                                    </li>
                                    <li>
                                        <a href="#latest" id="latest-tab" aria-controls="latest" role="tab" data-toggle="tab" aria-selected="false">اخرین مقالات </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- end /.card-title -->

                            <div class="card_content">
                                <!-- Tab panes -->
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active fade show" id="popular" aria-labelledby="popular-tab">
                                        <ul class="post-list">
                                            @foreach($last_posts as $post)
                                            <li>
                                                <div class="thumbnail_img">
                                                    <img src="{{asset($post->imgPath)}}" alt="{{$post->title}}">
                                                </div>
                                                <div class="title_area">
                                                    <a href="#">
                                                        <h4>{{str_limit($post->title,40)}} </h4>
                                                    </a>
                                                    <div class="date_time">
                                                        <i class="lnr lnr-clock"></i>
                                                        <p>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</p>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                        </ul>
                                        <!-- end /.post-list -->
                                    </div>
                                    <!-- end /.tabpanel -->

                                    <div role="tabpanel" class="tab-pane fade" id="latest" aria-labelledby="latest-tab">
                                        <ul class="post-list">
                                            @foreach($posts_view as $post)
                                                <li>
                                                    <div class="thumbnail_img">
                                                        <img src="{{asset($post->imgPath)}}" alt="{{$post->title}}">
                                                    </div>
                                                    <div class="title_area">
                                                        <a href="#">
                                                            <h4>{{str_limit($post->title,40)}} </h4>
                                                        </a>
                                                        <div class="date_time">
                                                            <i class="lnr lnr-clock"></i>
                                                            <p>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>                                    <!-- end /.post-list -->
                                    </div>
                                    <!-- end /.tabpanel -->
                                </div>
                                <!-- end /.tab-content -->
                            </div>
                            <!-- end /.card_content -->
                        </div>
                        <!-- end /.sidebar-card -->

                        <div class="sidebar-card card--blog_sidebar card--category">
                            <div class="card-title">
                                <h4>دسته بندی </h4>
                            </div>
                            <div class="collapsible-content">
                                <ul class="card-content">
                                    @foreach($categories as $category)
                                    <li>
                                        <a href="/blog?cat={{$category->slug}}">
                                            <i class="lnr lnr-chevron-right"></i>{{$category->title}}
                                            {{--<span class="item-count">35</span>--}}
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- end /.collapsible_content -->
                        </div>
                        <!-- end /.sidebar-card -->

                        <!-- end /.sidebar-card -->


                        <!-- end /.banner -->
                    </aside>
                    <!-- end /.aside -->
                </div>
                <!-- end /.col-md-4 -->
                <div>
                    {{$posts->links()}}
                </div>

            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
            END LOGIN AREA
    =================================-->

@endsection
