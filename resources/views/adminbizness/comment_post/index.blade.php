@extends('adminbizness.layout.master')

@section('style')
    <style>
        .card .body {
            font-size: 14px;
            color: #555;
            padding: 20px;
            height: 160px;
            overflow-y: auto;
        }

        .comments > div {
            float: right;
        }
    </style>
@endsection

@section('Admin_content')
    @if(session('answer-success'))
        <div class="alert bg-green alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{session('answer-success')}}
        </div>
    @endif
    <?php
    Session::forget('answer-success');
    ?>

    <div class="block-header">
        <h2>مدیریت نظرات</h2>
    </div>
    <div class="row clearfix comments">
        @foreach($comments as $comment)
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 comment">
                <div class="card">
                    <div class="header">
                        <h2>
                            {{$comment->user->name}} <small>در
                                تاریخ {{Verta::instance($comment->created_at)->format(' %d %B %Y')}}
                                <span class="status">
                                 @if($comment->status=="SEEN")
                                        <a style="margin-right: 20px;color: green;">فعال</a>
                                    @else
                                        <a style="margin-right: 20px;color: red;">غیرفعال</a>
                                    @endif
                            </span>

                            </small>
                            <small><a href="/service/{{$comment->service->slug}}">مشاهده سرویس</a></small>
                        </h2>
                        <ul class="header-dropdown m-r--5">
                            <li class="dropdown">
                                <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"
                                   role="button" aria-haspopup="true" aria-expanded="false">
                                    <i class="material-icons">more_vert</i>
                                </a>
                                <ul class="dropdown-menu pull-right">

                                    @if($comment->status=="SEEN")
                                        <li class="status-seen"><a
                                                    onclick="comment_status(this,'UNSEEN',{{$comment->id}})"
                                                    href="javascript:void(0);">غیرفعال کردن</a></li>
                                    @else
                                        <li class="status-seen"><a
                                                    onclick="comment_status(this,'SEEN',{{$comment->id}})"
                                                    href="javascript:void(0);">فعال کردن</a></li>
                                    @endif
                                    <li onclick="answer('{{$comment->id}}','{{$comment->service_id}}')"><a href="javascript:void(0);" data-toggle="modal" data-target="#exampleModal">پاسخ</a>
                                    </li>
                                    <li onclick="comment_delete(this,{{$comment->id}})"><a href="javascript:void(0);">حذف</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="body">
                        <span style="float: right;width: 100%">
                            متن نظر: {{$comment->content}}
                        </span>

                         <?php
                            $answers=App\Post_comments::where('parent',$comment->id)->get();
                        ?>
                        @foreach ($answers as $answer)
                            <span style="margin-top: 10px;width: 100%;float: right">
                                پاسخ : {{$answer->content}}
                            </span>

                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>


    <div class="modal ali-modal" id="exampleModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="answer" action="{{route('comment-post.store')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input name="answer_id" type="hidden">
                        <input name="service_id" type="hidden">
                        <div class="form-group">
                            <label for="commentText" class="col-form-label">متن پاسخ:</label>
                            <textarea name="content" style="border: 1px solid #eee;padding:10px;border-radius: 5px;"
                                      class="form-control" id="commentText"></textarea>
                            <input type="hidden" class="form-control" id="parentId"/>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">لغو</button>
                        <button style="float: left" id="replycm" onclick="submit()" class="btn btn-primary" data-parentid=""
                                data-dismiss="modal">
                            ثبت نظر
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{$comments->links()}}
@endsection

@section('script')
    <script>

        function comment_status(tag, status, id) {
            $.ajax({
                url: '{{route('service-comment-ajax')}}',
                method: "POST",
                cache: false,
                data: {
                    "_token": "{{ csrf_token()}}",
                    status: status,
                    id: id,
                },
                success: function () {
                    if (status == "SEEN") {
                        $(tag).parents('.header').find('.status').html('<a style="margin-right: 20px;color: green;">فعال</a>');
                        $(tag).parents('ul').find('.status-seen').html('<a onclick="comment_status(this,\'UNSEEN\',' + id + ')" href="javascript:void(0);">غیرفعال کردن</a>');
                        $.notify({
                            // options
                            message: 'با موفقیت فعال شد'
                        }, {
                            // settings
                            type: 'success',
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                            animate: {
                                enter: 'animated bounceIn',
                                exit: 'animated bounceOut'
                            }
                        });
                    } else {
                        $(tag).parents('.header').find('.status').html('<a style="margin-right: 20px;color: red;">غیرفعال</a>');
                        $(tag).parents('ul').find('.status-seen').html('<a onclick="comment_status(this,\'SEEN\',' + id + ')" href="javascript:void(0);">فعال کردن</a>');
                        $.notify({
                            // options
                            message: 'با موفقیت غیرفعال شد'
                        }, {
                            // settings
                            type: 'success',
                            placement: {
                                from: "bottom",
                                align: "right"
                            },
                            animate: {
                                enter: 'animated bounceIn',
                                exit: 'animated bounceOut'
                            }
                        });
                    }


                },
                error: function () {

                }
            })
        }

        function comment_delete(tag, id) {
            Swal.fire({
                text: " آیا از حذف این مورد اطمینان دارید ؟",
                showClass: {
                    popup: 'animate__animated animate__fadeInDown'
                },
                hideClass: {
                    popup: 'animate__animated animate__fadeOutUp'
                },
                position: 'top',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: 'rgb(181, 178, 178)',
                confirmButtonText: 'بله حذف کن',
                cancelButtonText: 'لغو',

            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: '{{route('service-comment-ajax-delete')}}',
                        method: "POST",
                        cache: false,
                        data: {
                            "_token": "{{ csrf_token()}}",
                            status: status,
                            id: id,
                        },
                        success: function () {
                            $(tag).parents('.comment').remove();
                            $.notify({
                                // options
                                message: 'با موفقیت حذف شد'
                            }, {
                                // settings
                                type: 'success',
                                placement: {
                                    from: "bottom",
                                    align: "right"
                                },
                                animate: {
                                    enter: 'animated bounceIn',
                                    exit: 'animated bounceOut'
                                }
                            });
                        },
                        error: function () {

                        }
                    })
                }
            })

        }

        function answer(id,service_id) {
            $('input[name=answer_id]').val(id);
            $('input[name=service_id]').val(service_id);
        }
    </script>
@endsection
