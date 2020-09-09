<?php

namespace App\Http\Controllers;

use App\Allreport;
use App\Product;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use App\Payment;
use App\Order;
use Illuminate\Support\Facades\URL;

class PaymentController extends Controller
{
    public function verify(Request $request)
    {

        $price = Cart::subtotal(00, null, '');
        $payment = new Payment($price);
        $result = $payment->verifyPayment($request->Authority, $request->Status);

        if ($result) {

            $newPayments = Order::where('authority', ltrim($request->Authority, '0'))->get();

            foreach ($newPayments as $newPayment){
                if($newPayment->type == 'دانلودی'){
                    $newPayment->pay_status = $request->Status;
                    $newPayment->refId = $result->RefID;
                    $newPayment->linkdownload = URL::temporarySignedRoute('UserDownloadFile', now()->addMinutes(180), ['id' => $newPayment->product_id,'user' => Auth::id()]);
                    $newPayment->save();
                }else{
                    $newPayment->pay_status = $request->Status;
                    $newPayment->refId = $result->RefID;
                    $newPayment->save();
                }
            }

            $carts = Cart::content();
            foreach ($carts as $cart) {
                $newproduct = Product::findorfail($cart->options->product_id);
                $newproduct->depot = $newproduct->depot - $cart->qty;
                $newproduct->save();
            }

            Cart::destroy();
            session()->put('success_payment', 'پرداخت با موفقیت انجام شد.');
            return redirect('/panel/orders');

        } else {
            Cart::destroy();

            session()->put('error_payment', 'متاسفانه پرداخت شما انجام نشد! لطفا مجددا امتحان فرمایید.');
            return redirect('/panel/orders');
        }
    }

    public function payments()
    {
        $payments = Payment::where('user_id', Auth::id())->paginate(10);
        return view('admin.payments.index', compact(['payments']));
    }

    public function getprice(Request $request)
    {
        $order = Order::findorfail(2);
        return view('admin.payments.price', compact(['order']));
    }

    public function setprice(Request $request)
    {
        $order = Order::findorfail(2);
        $order->amount = $request->price;
        $order->save();
        return response()->json([
            'message' => $order->amount
        ]);
    }

}
