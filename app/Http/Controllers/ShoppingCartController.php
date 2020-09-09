<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShoppingCartController extends Controller
{
    public function addcart(Request $request)
    {

        $product = Product::findorfail($request->id);
        $content = Cart::content()->where('id', $request->id)->first();

        if(!empty($content->qty)) {
            if ($product->depot != $content->qty) {

                if ($product->discount<=0) {
                    $price = $product->price;
                    $old_price='';
                } else {
                    $price=$product->price*(100-$product->discount)/100;
                    $old_price=$product->price;
                }
                Cart::add($request->id, $product->title, 1, $price, [
                    'image' =>  asset($product->image),
                    'product_id' => $product->id,
                    'product_slug' => $product->slug,
                    'seller_id' => $product->user_id,
                    'type' => $product->type,
                    'marginprice' => $product->marginprice,
                    'sale' => $product->sale,
                    'price' => $price,
                    'old_price' => $old_price,
                ]);

                return response()->json([
                    'msg' => Cart::content(),
                    'countcart' => Cart::content()->count(),
                    'total' => Cart::subtotal(00)
                ]);
            } else {
                return response()->json([
                    'msg2' => 'notproduct',
                    'msg' => Cart::content(),
                    'countcart' => Cart::content()->count(),
                    'total' => Cart::subtotal(00)
                ]);
            }
        }else{
            if ($product->discount<=0) {
                $price = $product->price;
                $old_price='';
            } else {
                $price=$product->price*(100-$product->discount)/100;
                $old_price=$product->price;
            }
            Cart::add($request->id, $product->title, 1, $price, [
                'image' => asset($product->image),
                'product_id' => $product->id,
                'product_slug' => $product->slug,
                'seller_id' => $product->user_id,
                'type' => $product->type,
                'marginprice' => $product->marginprice,
                'sale' => $product->sale,
                'price' => $price,
                'old_price' => $old_price,
            ]);

            return response()->json([
                'msg' => Cart::content(),
                'countcart' => Cart::content()->count(),
                'total' => Cart::subtotal(00)
            ]);
        }

    }

    public function cart()
    {
//        return Cart::content();
//        return Cart::subtotal(00);

    }

    public function removecart(Request $request)
    {
//        $content = Cart::content()->where('id', $request->id)->first();
        Cart::remove($request->id);
        return response()->json([
            'countcart' =>  Cart::content()->count(),
            'total' =>  Cart::subtotal(00)
        ]);

    }

    public function updatecart(Request $request)
    {
        $product = Product::findorfail($request->id);
        $content = Cart::content()->where('id', $request->id)->first();
        if($product->depot != $content->qty){

            Cart::update($content->rowId, $request->qyt);
            return response()->json([
                'msg' =>  $request->qyt,
                'countcart' =>  Cart::content()->count(),
                'total' =>  Cart::subtotal(00)
            ]);

        }else{
            return response()->json([
                'msg3' =>  'notproduct',
                'msg' =>  $request->qyt,
                'countcart' =>  Cart::content()->count(),
                'total' =>  Cart::subtotal(00)
            ]);
        }

    }
}
