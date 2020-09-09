<?php

namespace App\Http\Controllers\Admin;

use App\Balanceprice;
use App\Directselling;
use App\Tree;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminCalculationController extends Controller
{
    public function calculation()
    {
        $refral_codes = Tree::where('right_price', '>=', 2000000)->where('left_price', '>=', 2000000)->get();
        foreach ($refral_codes as $refral_code) {
            if ($refral_code) {
                $right_pricr = $refral_code->right_price;
                $left_price = $refral_code->left_price;


                if ($right_pricr < $left_price) {
                    //right
                    $remaining = $right_pricr % 2000000;


                    $submultiple = (int)($right_pricr / 2000000);

                    $price_ceiling=104-$refral_code->price_ceiling;
                    if ($submultiple<$price_ceiling){
                        $price_ceiling=$submultiple;

                    }else if($submultiple>$price_ceiling){
                        $price_ceiling=104-$refral_code->price_ceiling;
                    }else{
                        $price_ceiling=$submultiple;
                    }

                    $balanceprice=Balanceprice::where('user_id',$refral_code->user_id)->first();
                    if (empty($balanceprice)){
                        $balanceprice=new Balanceprice();
                        $balanceprice->user_id=$refral_code->user_id;
                        $balanceprice->price=$price_ceiling*480000;
                        $balanceprice->save();
                    }else{
                        $balanceprice->price=$balanceprice->price+$price_ceiling*480000;
                        $balanceprice->save();
                    }



                    $refral_code->price_ceiling=$refral_code->price_ceiling+$price_ceiling;
                    $submultiple = $submultiple * 2000000;
                    $refral_code->right_price = $refral_code->right_price - $submultiple;
                    $refral_code->left_price = $refral_code->left_price - $submultiple;




                } elseif ($right_pricr > $left_price) {
                    //left
                    $remaining = $refral_code->right_price % 2000000;
                    $submultiple = (int)($refral_code->left_price / 2000000);

                    $price_ceiling=104-$refral_code->price_ceiling;
                    if ($submultiple<$price_ceiling){
                        $price_ceiling=$submultiple;

                    }else if($submultiple>$price_ceiling){
                        $price_ceiling=104-$refral_code->price_ceiling;
                    }else{
                        $price_ceiling=$submultiple;
                    }

                    $balanceprice=Balanceprice::where('user_id',$refral_code->user_id)->first();
                    if (empty($balanceprice)){
                        $balanceprice=new Balanceprice();
                        $balanceprice->user_id=$refral_code->user_id;
                        $balanceprice->price=$price_ceiling*480000;
                        $balanceprice->save();
                    }else{
                        $balanceprice->price=$balanceprice->price+$price_ceiling*480000;
                        $balanceprice->save();
                    }

                    $refral_code->price_ceiling=$refral_code->price_ceiling+$price_ceiling;
                    $submultiple = $submultiple * 2000000;
                    $refral_code->right_price = $refral_code->right_price - $submultiple;
                    $refral_code->left_price = $refral_code->left_price - $submultiple;
                } else {


                    //left_right
                    $remaining = $refral_code->right_price % 2000000;
                    $submultiple = (int)($refral_code->right_price / 2000000);

                    $price_ceiling=104-$refral_code->price_ceiling;
                    if ($submultiple<$price_ceiling){
                        $price_ceiling=$submultiple;

                    }else if($submultiple>$price_ceiling){
                        $price_ceiling=104-$refral_code->price_ceiling;
                    }else{
                        $price_ceiling=$submultiple;
                    }

                    $balanceprice=Balanceprice::where('user_id',$refral_code->user_id)->first();
                    if (empty($balanceprice)){
                        $balanceprice=new Balanceprice();
                        $balanceprice->user_id=$refral_code->user_id;
                        $balanceprice->price=$price_ceiling*480000;
                        $balanceprice->save();
                    }else{
                        $balanceprice->price=$balanceprice->price+$price_ceiling*480000;
                        $balanceprice->save();
                    }

                    $refral_code->price_ceiling=$refral_code->price_ceiling+$price_ceiling;
                    $submultiple = $submultiple * 2000000;
                    $refral_code->right_price = $refral_code->right_price - $submultiple;
                    $refral_code->left_price = $refral_code->left_price - $submultiple;

                }

                $refral_code->save();


            }
        }


        $refral_codes = Tree::where('direct_selling', '>', 0)->get();
        if ($refral_codes) {
            foreach ($refral_codes as $refral_code) {
                $direct=Directselling::where('user_id',$refral_code->user_id)->first();
                if (empty($direct)){
                    $direct=new Directselling();
                    $direct->user_id=$refral_code->user_id;
                    $direct->price=$refral_code->direct_selling;
                    $direct->save();
                }else{
                    $direct->price=$direct->price+$refral_code->direct_selling;
                    $direct->save();
                }
                if ($refral_code->direct_selling > 0) {
                    $refral_code->direct_selling = 0;
                    $refral_code->save();
                }
            }
        }

        session()->put('Commission','دستور محاسبه با موفقیت انجام شد');
        return redirect('adminb/dashboardb');
    }

}
