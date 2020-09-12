@extends('front.layout.master')
@section('style_link')
@endsection
@section('style')
    <style>
        .li-blog-sidebar .li-recent-post .li-recent-post-thumb{
            border: none!important;
        }
    </style>
@endsection
@section('content')
    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="index.html">خانه</a></li>
                    <li class="active">جزئیات وبلاگ با نوارکناری</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Li's Main Blog Page Area -->
    <div class="li-main-blog-page li-main-blog-details-page pt-60 pb-60 pb-sm-45 pb-xs-45">
        <div class="container">
            <div class="row">
                <!-- Begin Li's Blog Sidebar Area -->
                <div class="col-lg-3 order-lg-1 order-2">
                    <div class="li-blog-sidebar-wrapper">
                        <div class="li-blog-sidebar">
                            <div class="li-sidebar-search-form">
                                <form action="{{route('post_search')}}">
                                    <input type="text" name="title" class="li-search-field" placeholder="جستجو در اینجا">
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

                    </div>
                </div>
                <!-- Li's Blog Sidebar Area End Here -->
                <!-- Begin Li's Main Content Area -->
                <div class="col-lg-9 order-lg-2 order-1">
                    <div class="row li-main-content">
                        <div class="col-lg-12">
                            <div class="li-blog-single-item pb-30">
                                <div class="li-blog-banner">
                                    <a><img class="img-full" src="{{asset($post->imgPath)}}" alt="{{$post->title}}"></a>
                                </div>
                                <div class="li-blog-content">
                                    <div class="li-blog-details">
                                        <h3 class="li-blog-heading pt-35"><a>{{$post->title}}</a></h3>
                                        <div class="li-blog-meta">
                                            <a class="author" href="#"><i class="fa fa-user"></i>مدیر</a>
                                            <a class="comment" href="#"><i class="fa fa-comment-o"></i> {{count($comments)}} نظر</a>
                                            <a class="comment" href="#"><i class="fa fa-eye"></i> {{$post->view}} بازدید </a>
                                            <a class="post-time" href="#"><i class="fa fa-calendar"></i>{{Verta::instance($post->updated_at)->format(' %d %B %Y')}}</a>
                                        </div>
                                        <div> <?= $post->content ?></div>
                                        <!-- Begin Blog Blockquote Area -->

                                        <!-- Blog Blockquote Area End Here -->
                                     {{--   <div class="li-tag-line">
                                            <h4>برچسب:</h4>
                                            <a href="#">هدفون</a>,
                                            <a href="#">بازی های ویدئویی</a>,
                                            <a href="#">بلندگوهای بی سیم</a>
                                        </div>
                                        <div class="li-blog-sharing text-center pt-30">
                                            <h4>به اشتراک گذاری این پست:</h4>
                                            <a href="#"><i class="fa fa-facebook"></i></a>
                                            <a href="#"><i class="fa fa-twitter"></i></a>
                                            <a href="#"><i class="fa fa-pinterest"></i></a>
                                            <a href="#"><i class="fa fa-google-plus"></i></a>
                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            <!-- Begin Li's Blog Comment Section -->
                            <div class="li-comment-section">
                                <h3>{{count($comments)}} نظر</h3>
                                <ul>
                                    @foreach($comments as $comment)
                                    <li>
                                        <div class="author-avatar pt-15">
                                            <img src="{{asset('limupa/images/product-details/user.png')}}" alt="User">
                                        </div>
                                        <div class="comment-body pl-15">

                                            <h5 class="comment-author pt-15">{{$comment->name}}</h5>
                                            <div class="comment-post-date">
                                                {{Verta::instance($comment->created_at)->format(' %d %B %Y')}}
                                            </div>
                                            <p>{{$comment->content}}</p>
                                        </div>
                                    </li>
                                        @php $comments_ansswers=App\Post_comments::where('parent',$comment->id)->get() @endphp
                                        @foreach($comments_ansswers as $comments_ansswer)
                                    <li class="comment-children">
                                        <div class="author-avatar pt-15">
                                            <img src="{{asset('limupa/images/product-details/admin.png')}}" alt="Admin">
                                        </div>
                                        <div class="comment-body pl-15">

                                            <h5 class="comment-author pt-15">مدیر</h5>
                                            <div class="comment-post-date">
                                                {{Verta::instance($comments_ansswer->created_at)->format(' %d %B %Y')}}
                                            </div>
                                            <p>{{$comments_ansswer->content}}
                                            </p>
                                        </div>
                                    </li>
                                        @endforeach
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Li's Blog Comment Section End Here -->
                            <!-- Begin Blog comment Box Area -->
                            <div class="li-blog-comment-wrapper">
                                <h3>ارسال یک نظر</h3>
                                <p>آدرس ایمیل شما منتشر نخواهد شد. زمینه های مورد نیاز مشخص شده اند *</p>
                                <form class="cmnt_reply_form" action="{{route('comment_post_store')}}" method="post">
                                    @csrf
                                    <div class="comment-post-box">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>نظر</label>
                                                <textarea name="content" placeholder="یک نظر بنویسید"></textarea>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 mt-5 mb-sm-20 mb-xs-20">
                                                <label>نام</label>
                                                <input name="name" type="text" class="coment-field" placeholder="نام">
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-4 mt-5 mb-sm-20 mb-xs-20">
                                                <label>ایمیل</label>
                                                <input type="email" name="email" class="coment-field" placeholder="ایمیل">
                                                <input type="hidden" name="post" value="{{$post->id}}">
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="coment-btn pt-30 pb-sm-30 f-left">
                                                    <input class="li-btn-2" type="submit" name="submit" value="ارسال نظر">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- Blog comment Box Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Li's Main Content Area End Here -->
            </div>
        </div>
    </div>
    <!-- Li's Main Blog Page Area End Here -->



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
