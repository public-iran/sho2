@extends('adminbizness.layout.master')
@section('style_link')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css"/>
@endsection
@section('style')
    <style>
        .card .card-inside-title{
            margin-top: 10px;
        }
        .setting{
            margin-bottom: 0!important;
        }
        [type="radio"]:not(:checked), [type="radio"]:checked{
            right: 0;
            left: auto;
        }
    </style>
@endsection

@section('Admin_content')

    <div class="col-xs-12 head" style="margin-bottom: 60px;display: flex;justify-content: space-between">
        <div style="min-width: 150px">
            <h2 style="margin-top: 0">
                <i style="float: right;font-size: 29pt;color: #555;" class="material-icons">settings_applications</i>
                <b style="color: #555;margin: 7px 5px 0 0;float: right;font-size: 18pt;">تنضیمات سایت</b>
            </h2>
        </div>

    </div>



    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <form method="POST" action="{{route('settings.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="body">
                            @foreach($settings as $setting)
                                @if($setting->type=="img")
                                    <h2 class="card-inside-title">{{$setting->title}}</h2>
                                    <div class="row clearfix">
                                        <div class="col-sm-12 setting">
                                            <div class="form-group">
                                                <img width="150" height="150" src="{{asset($setting->value)}}">
                                                <div class="form-line">
                                                    <input type="file" name="{{$setting->setting}}" class="form-control" value="{{$setting->value}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                    @if($setting->type=="text")
                                    <h2 class="card-inside-title">{{$setting->title}}</h2>
                                    <div class="row clearfix">
                                        <div class="col-sm-12 setting">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input type="text" name="{{$setting->setting}}" class="form-control" value="{{$setting->value}}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                    @if($setting->type=="enum")
                                    <h2 class="card-inside-title">{{$setting->title}}</h2>
                                    <div class="row clearfix">
                                        <div class="col-sm-12 setting">
                                            <div class="form-group">
                                                <div class="form-line">
                                                    <input name="{{$setting->setting}}" type="radio" id="radio_1" @if($setting->value=="true")checked="" @endif value="true">
                                                    <label for="radio_1">فعال</label>

                                                    <input name="{{$setting->setting}}" type="radio" id="radio_2" value="false" @if($setting->value=="false")checked="" @endif>
                                                    <label for="radio_2">غیر فعال</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                    @if($setting->type=="text_editor")
                                <h2 class="card-inside-title">{{$setting->title}}</h2>
                                <div class="row clearfix">
                                    <div class="col-sm-12 setting">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <textarea type="text" id="editor1" name="{{$setting->setting}}" class="form-control " value="">{{$setting->value}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    @endif
                                @endforeach
                                <div class="row clearfix">
                                    <div class="col-sm-12 setting">
                                        <div class="form-group">
                                            <button type="submit" style="float:left;" class="btn btn-success waves-effect">بروزرسانی</button>
                                        </div>
                                    </div>
                                </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection


@section('script_link')
@endsection

@section('script')

    <script>
        @if(session('change_setting'))
        $.notify({
            // options
            message: '<i style="float: right;margin-top: -3px;margin-left: 10px" class="material-icons">warning</i> <span style="float: right"> {{session('change_setting')}}</span>',
            icon: '',
        }, {
            // settings
            type: 'success',
            allow_dismiss:false,
            placement: {
                from: "top",
                align: "left"
            },
            animate: {
                enter: 'animated fadeIn',
                exit: 'animated fadeOut'
            }
        });
        @endif
    </script>
@endsection
<?php
Session::forget('change_setting');
?>

