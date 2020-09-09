<?php

namespace App\Http\Controllers\Front;

use App\Favorite;
use App\Order;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PanelController extends Controller
{
    public function index()
    {
        $user=User::findorfail(Auth::id());
        $orders = Order::with('product')->where('user_id', Auth::id(), 'and')->take(4)->get();

        return view('front.panel.index',compact(['user','orders']));
    }
    public function orders()
    {
        $orders = Order::with('product')->where('user_id', Auth::id(), 'and')->paginate(15);

        return view('front.panel.orders',compact(['orders']));
    }
    public function favorites()
    {
        $favorites=Favorite::with('product')->where('user_id',Auth::id())->get();
        return view('front.panel.favorites',compact(['favorites']));
    }
    public function profile()
    {
        $user=User::findorfail(Auth::id());
        return view('front.panel.profile',compact(['user']));
    }

    public function edit_profile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'family' => 'required',
            'email' => 'required|email|unique:users,mobile,' . Auth::id(),
            'mobile' => 'required|regex:/(09)[0-9]{9}/|digits:11|unique:users,mobile,' . Auth::id(),
            'state' => 'required',
            'city' => 'required',
            'address' => 'required',
        ], [
            'name.required' => 'فیلد نام نمی تواند خالی باشد',
            'family.required' => 'فیلد نام خانوادگی نمی تواند خالی باشد',
            'email.required' => 'فیلد ایمیل نمی تواند خالی باشد',
            'email.unique' => 'ایمیل از قبل موجود است',
            'email.regex' => 'ایمیل صحیح نیست',
            'mobile.required' => 'فیلد موبایل نمی تواند خالی باشد',
            'mobile.unique' => 'شماره موبایل از قبل موجود است',
            'mobile.regex' => 'شماره موبایل صحیح نیست',
            'state.required' => 'فیلد استان نمی تواند خالی باشد',
            'city.required' => 'فیلد شهر نمی تواند خالی باشد',
            'address.required' => 'فیلد آدرس نمی تواند خالی باشد',

        ]);

        $user=User::findorfail(Auth::id());
        $user->name=$request->name;
        $user->family=$request->family;
        $user->mobile=$request->mobile;
        $user->email=$request->email;
        $user->ostan_id=$request->ostan_id;
        $user->city_id=$request->city_id;
        $user->ostan=$request->state;
        $user->city=$request->city;
        $user->address=$request->address;
        $user->postal_code=$request->postal_code;
        $user->save();

        session()->put('edit_profile','اطلاعات شما با موفقیت ویرایش شد');
        return redirect('panel/profile');
    }
}
