<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Order;
use Gate;
use Illuminate\Support\Facades\Auth;
use App\Exports\OrderReportExcel;
use Maatwebsite\Excel\Facades\Excel;

class AdminOrdersController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('products_order'),403,'شما به این بخش دسترسی ندارید');
        if(Auth::user()->role == 1){
            $orders = Order::where('type', '!=' , 'پیش خرید')->select('factor_number', 'user_id', 'pay_status')->distinct()->get();

        }else{
            $orders = Order::where('user_id', Auth::id(), 'and')->where('type', '!=' , 'پیش خرید')->select('factor_number', 'user_id', 'pay_status')->distinct()->get();
        }
        return view('adminbizness.orders.index', compact(['orders']));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($factor_number)
    {
        if(Auth::user()->role == 1){
            $orders = Order::where(['factor_number' => $factor_number])->get();
        }else{
            $orders = Order::where(['factor_number' => $factor_number, 'user_id' => Auth::id()])->get();
        }

        return view('adminbizness.orders.show', compact(['orders']));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function report()
    {
        return Excel::download(new OrderReportExcel, 'OrderReport.xlsx');
    }
}
