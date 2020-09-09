<?php

namespace App\Http\Controllers;

use App\Payment;
use App\Order;
use App\Setting;
use Hekmatinasser\Verta\Verta;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function verify(Request $request)
    {

        $this->validate($request, [
            'name' => 'required',
            'family' => 'required',
            'mobile' => 'required',
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'فیلد نام نمی تواند خالی باشد',
            'family.required' => 'فیلد نام خانوادگی نمی تواند خالی باشد',
            'mobile.required' => 'فیلد موبایل نمی تواند خالی باشد',
            'state.required' => 'فیلد استان نمی تواند خالی باشد',
            'city.required' => 'فیلد شهر نمی تواند خالی باشد',
            'address.required' => 'فیلد آدرس نمی تواند خالی باشد',

        ]);

        $carts = Cart::content();
        $v = new Verta();
        $factor = 'F'.$v->year.$v->month.$v->day.'-'.$v->second.Auth::id();


        /*foreach ($carts as $cart) {

            if ($cart->options->type == 'پیش خرید') {
                dd($request->all());
         $newPayment = new Order();
                $newPayment->authority = rand(000000000,999999999);;
                $newPayment->user_id = Auth::id();
                $newPayment->product_id = $cart->options->product_id;
                $newPayment->seller_id = $cart->options->seller_id;
                $newPayment->type = $cart->options->type;
                $newPayment->price = $cart->options->price;
                $newPayment->payprice = 0;
                $newPayment->sale = $cart->options->sale;
                $newPayment->count = $cart->qty;
                $newPayment->name = $request->name;
                $newPayment->family = $request->name;
                $newPayment->mobile = $request->mobile;
                $newPayment->state = $request->state;
                $newPayment->city = $request->city;
                $newPayment->total = 0;
                $newPayment->address = $request->address;
                $newPayment->description = $request->description;
                $newPayment->factor_number = $factor;
                $newPayment->save();
                Cart::remove($cart->rowId);
            }
        }*/

        $options = Setting::all();
        $setting = array();
        foreach ($options as $option) {
            $name = $option['setting'];
            $value = $option['value'];
            $setting[$name] = $value;
        }

        $price = Cart::subtotal(00, null, '');
        if ($price>=$setting['send_price_top']){
            $price=$price;
        }else{
            $price=$price+$setting['send_price'];
        }
        $payment = new payment($price,'payment-verify');
        $result = $payment->doPayment();

        if ($result->Status == 100) {

            foreach ($carts as $cart) {
                $newPayment = new Order();
                $newPayment->authority = ltrim($result->Authority, '0');;
                $newPayment->user_id = Auth::id();
                $newPayment->product_id = $cart->options->product_id;
                $newPayment->seller_id = $cart->options->seller_id;
                $newPayment->type = $cart->options->type;
                $newPayment->price = $cart->options->price;
                $newPayment->payprice = $cart->price;
                $newPayment->sale = $cart->options->sale;
                $newPayment->count = $cart->qty;
                $newPayment->name = $request->name;
                $newPayment->mobile = $request->mobile;
                $newPayment->state = $request->state;
                $newPayment->city = $request->city;
                $newPayment->total = Cart::subtotal(00, null, '');
                $newPayment->address = $request->address;
                $newPayment->description = $request->description;
                $newPayment->factor_number = $factor;
                $newPayment->save();
            }

//            return redirect()->to('https://zarinpal.com/pg/StartPay/' . $result->Authority);
            return redirect()->to('https://sandbox.zarinpal.com/pg/StartPay/' . $result->Authority);

        } else {
            echo 'ERR: ' . $result->Status;
        }



    }
}
