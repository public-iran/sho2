@extends('adminbizness.layout.master')


@section('Admin_content')
    @can('dashboard')
    <style>
        .info-box-2 .content h2{
            font-size: 20px!important;
        }
        .container-fluid .clearfix > div{
            float: right;
        }
        .container-fluid .icon{
            background: rgba(244, 248, 251, 0.6);
        }
        .container-fluid .icon i{
            color: #61c579;
        }
    </style>

    @if(session('buy_package'))
        <div class="alert bg-green alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{session('buy_package')}}
        </div>

    @endif
    @if(session('Commission'))
        <div class="alert bg-green alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{session('Commission')}}
        </div>

    @endif
    @if(session('buy_package_danger'))
        <div class="alert bg-red alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            {{session('buy_package_danger')}}
        </div>
    @endif
    @php
        Session::forget('buy_package');
        Session::forget('Commission');
        Session::forget('buy_package_danger');
    @endphp


        <div class="container-fluid">

            <!-- Widgets -->
            <div class="row clearfix">

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 bg-wheat hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">visibility</i>
                        </div>
                        <div class="content">
                            <h2 class="text">{{count($uservisits)}}</h2>
                            <div class="text">بازدید کنندگان کل</div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 bg-wheat hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">visibility</i>
                        </div>
                        <div class="content">
                            <h2 class="text">{{count($allvisits)}}</h2>
                            <div class="text">بازدید کل</div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 bg-wheat hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">visibility</i>
                        </div>
                        <div class="content">
                            <h2 class="text">{{count($uservisits_day)}}</h2>
                            <div class="text">بازدید کننده امروز</div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 bg-wheat hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">visibility</i>
                        </div>
                        <div class="content">
                            <h2 class="text">{{count($allvisits_day)}}</h2>
                            <div class="text">بازدید امروز</div>
                        </div>
                    </div>

                </div>


            </div>

            <div class="row clearfix">
                <!-- Task Info -->
                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                    <div class="card">
                        <div class="header">
                            <h2>آخرین پست ها فعال</h2>
                        </div>
                        <div class="body">
                            <div class="table-responsive">
                                <table class="table table-hover dashboard-task-infos">
                                    <thead>
                                    <tr>
                                        <th>عنوان</th>
                                        <th>بازدید</th>
                                        <th>دسته بندی</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($posts as $post)
                                    <tr>
                                        <td><a target="_blank" href="/post/{{$post->slug}}">{{$post->title}}</a></td>
                                        <td><span class="label bg-green">{{$post->view}}</span></td>
                                        <td>@foreach ($post->postcategories as $val)
                                                <span class="label label-primary">{{$val->title}}</span>
                                            @endforeach</td>

                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    @endcan
@endsection

