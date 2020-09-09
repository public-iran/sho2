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
                                <a href="/blog">صفحه پست </a>
                            </li>
                        </ul>
                    </div>
                    <h1 class="page-title">صفحه پست </h1>
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
            <div class="row">
                <div class="col-lg-8">
                    <div class="single_blog blog--default">
                        <article>
                            <figure>
                                <img src="{{asset($post->imgPath)}}" alt="{{$post->title}}">
                            </figure>
                            <div class="blog__content">
                                <a href="#" class="blog__title">
                                    <h1>{{$post->title}}</h1>
                                </a>

                                <div class="blog__meta mt-3">
                                   {{-- <div class="author">
                                        <span class="lnr lnr-user"></span>
                                        <p>خرید از
                                            <a href="#">دامن دریا </a>
                                        </p>
                                    </div>--}}
                                    <div class="date_time">
                                        <i class="lnr lnr-clock"></i>
                                        <p>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}
                                        </p>
                                    </div>
                                    <div class="comment_view">
                                        <p class="comment">
                                            <i class="lnr lnr-bubble"></i>{{count($comments)}}</p>
                                        <p class="view">
                                            <i class="lnr lnr-eye"></i>{{$post->view}}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="single_blog_content">
                                <?= $post->content ?>
                            </div>
                        </article>
                    </div>
                    <!-- end /.single_blog -->

                   {{-- <div class="author_info">
                        <div class="author__img">
                            <img src="images/new/authi.jpg" alt="Auth Image">
                        </div>

                        <div class="author__info">
                            <h4>درباره نویسنه </h4>
                            <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.

                            </p>
                            <ul>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-facebook"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-twitter"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-google-plus"></span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <span class="fa fa-linkedin"></span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>--}}
                    <!-- end /.author_info -->

                    <div class="comment_area">
                        <div class="comment__title">
                            <h4>نظرات </h4>
                        </div>

                        <div class="comment___wrapper">
                            <ul class="media-list">
                                @foreach($comments as $comment)
                                <li class="depth-1">
                                    <div class="media">
                                        <div class="pull-right no-pull-xs">
                                            <a href="#" class="cmnt_avatar">
                                                <img src="{{asset('darya/images/new/comavatar2.jpg')}}" class="media-object" alt="Sample Image">
                                            </a>
                                        </div>
                                        <div class="media-body" >
                                            <div class="media_top">
                                                <div class="heading_left pull-right">
                                                    <a href="#">
                                                        <h4 class="media-heading">{{$comment->name}}</h4>
                                                    </a>
                                                    <span>{{Verta::instance($comment->created_at)->format(' %d %B %Y')}}</span>
                                                </div>
                                                {{--<a href="#" class="reply hidden-xs-m pull-left">پاسخ </a>--}}
                                            </div>
                                            <p>{{$comment->content}}</p>
                                         {{--   <a href="#" class="reply visible-xs-m  pull-left">پاسخ </a>--}}
                                        </div>
                                    </div>

                                    <ul class="children">
                                        <!-- Nested media object -->
                                        @php $comments_ansswers=App\Post_comments::where('parent',$comment->id)->get() @endphp
                                        @foreach($comments_ansswers as $comments_ansswer)
                                        <li class="depth-2">
                                            <div class="media">
                                                <div class="pull-right no-pull-xs">
                                                    <a href="#" class="cmnt_avatar">
                                                        <img src="{{asset('darya/images/new/comavatar.jpg')}}" class="media-object" alt="Sample Image">
                                                    </a>
                                                </div>
                                                <div class="media-body">
                                                    <div class="media_top">
                                                        <div class="heading_left pull-right">
                                                            <a href="#">
                                                                <h4 class="media-heading">مدیر</h4>
                                                            </a>
                                                            <span>{{Verta::instance($comments_ansswer->created_at)->format(' %d %B %Y')}}</span>
                                                        </div>
                                                       {{-- <a href="#" class="reply hidden-xs-m pull-left">
                                                            پاسخ
                                                        </a>--}}
                                                    </div>
                                                    <p>{{$comments_ansswer->content}}
                                                    </p>
                                                    {{--<a href="#" class="reply visible-xs-m pull-left">پاسخ </a>--}}
                                                </div>
                                            </div>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- end /.comment___wrapper -->
                    </div>
                    <!-- end /.col-md-8 -->

                    <div class="comment_area comment--form">
                        <!-- start reply_form -->
                        <div class="comment__title">
                            <h4>نظر خود را بنویسید </h4>
                        </div>
                        <div class="commnet_form_wrapper">
                            <div class="row">
                                <!-- start form -->
                                <form class="cmnt_reply_form" action="{{route('comment_post_store')}}" method="post">
                                    @csrf
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="input_field" name="name" type="text" placeholder="نام " required="">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input class="input_field" name="email" type="email" placeholder="ایمیل " required="">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <textarea class="input_field" name="content" placeholder="متن خود را بنویسید " rows="10" cols="80"></textarea>
                                            <input type="hidden" name="post" value="{{$post->id}}">
                                        </div>

                                        <button type="submit" class="btn btn--round btn--default" name="btn">ثبت نظر </button>
                                    </div>
                                </form>
                                <!-- end form -->
                            </div>
                        </div>
                        <!-- end /.commnet_form_wrapper -->
                    </div>
                    <!-- end /.comment_area_wrapper -->
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

            </div>
            <!-- end /.row -->
        </div>
        <!-- end /.container -->
    </section>
    <!--================================
            END LOGIN AREA
    =================================-->

@endsection

@section('script')
    @if(session('save_comment'))
        <script>
            alertify.set('notifier','position', 'bottom-left');
            alertify.success('نظر شما با موفقیت دخیره شده و بعد از تائید مدیر در سایت نمایش داده می شود');
        </script>
    @endif
    <script>
        view({{$post->id}})
        function view(id) {
        var CSRF_TOKEN = '{{ csrf_token() }}';
        var url = '{{route('view.set_view_post')}}';
        var data = {_token: CSRF_TOKEN,id:id};
        $.post(url, data, function (msg) {
        });
        }
    </script>
@endsection
@php
    Session::forget('save_comment');
@endphp
