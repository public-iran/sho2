@extends('front.layout.master')
@section('style_link')
    <link rel="stylesheet" href="{{asset('front/panel/css/AdminLTE.css')}}">
    <link rel="stylesheet" href="{{asset('front/panel/css/rtl.css')}}">

@endsection
@section('style')
    <style>
        main{
            position: relative;
        }
        .main-sidebar{
            text-align: right;
            padding-top: 0;
            right: auto;
            background: #ecf0f5;
        }
        .content-wrapper{
            background: #fff;
            text-align: right;
        }
        .sidebar-menu a{
            color: #000000;
        }
        .sidebar-menu a i{
            color: #555;
        }
        .box .box-body div{
            color: #bababa;
            font-size: 14px;
        }
        .box .box-body div h5{
            color: #bababa;
        }
        .box .box-body div.row{
            padding: 30px 20px;
        }
        .list-orders{
            width: 100%;
            display: block;
            text-align: center;
            padding: 11px 0;
            background: #fafafa;
        }
    </style>
@endsection


@section('content')
    <div id="container">
    <div class="container" style="position:relative;">
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <ul class="sidebar-menu" data-widget="tree">

                    <li><a href="/panel"><i class="fa fa-dashboard"></i> <span>داشبورد</span></a></li>
                    <li><a href="/panel/orders"><i class="fa fa-shopping-basket"></i> <span>سفارش های من</span></a></li>
                    <li><a href="/panel/favorites"><i class="fa fa-heart"></i><span>لیست مورد علاقه</span></a></li>
                    <li><a href="/panel/profile"><i style="margin-right: 11px" class="fa fa-user"></i><span>اطلاعات حساب</span></a></li>
                    <li><a href="/logout"><i class="fa fa-sign-out"></i> <span>خروج</span></a></li>

                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

    @yield('content_panel')

        </div>
    </div>
    </div>
@endsection


@section('script_link')
    <script src="{{asset('front/panel/js/adminlte.min.js')}}"></script>
    <script src="{{asset('front/panel/js/dashboard.js')}}"></script>
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
@endsection
