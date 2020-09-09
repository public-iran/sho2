<?php

namespace App\Http\Controllers\Admin;

use App\Allreport;
use App\Package;
use App\Tree;
use App\User;
use App\Wallet;
use App\Walletsreport;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        abort_unless(Gate::allows('users_index'), 403, 'شما به این بخش دسترسی ندارید');
        $users = User::where('id','!=','1')->orderBy('id', 'desc')->get();
        return view('adminbizness.users.index', compact(['users']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('adminbizness.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255|min:3',
            'family' => 'required|string|max:255|min:3',
            'national_code' => 'nullable|max:10|min:10|unique:users,national_code',
            'mobile' => 'required|regex:/(09)[0-9]{9}/|digits:11|unique:users,mobile',
            'email' => 'required|email|unique:users,email',
            'address' => 'nullable|min:10',
            'password' => 'required|min:8|confirmed',
        ], [
            'name.required' => 'نام را وارد کنید',
            'name.min' => 'حداقل 3 کاراکتر می باشد',
            'family.required' => 'نام خانوادگی را وارد کنید',
            'family.min' => 'حداقل 3 کاراکتر می باشد',
            'national_code.unique' => 'کدملی از قبل موجود می باشد',
            'national_code.min' => 'کدملی نامعتبر است',
            'national_code.max' => 'کدملی نامعتبر است',
            'mobile.required' => 'شماره موبایل را وارد کنید',
            'mobile.unique' => 'شماره موبایل را وارد کنید',
            'mobile.regex' => 'شماره موبایل صحیح نیست',
            'email.required' => 'ایمیل  را وارد کنید',
            'email.email' => 'ایمیل صحیح نمی باشد',
            'address.min' => 'آدرس کوتاه می باشد',
            'password.required' => 'رمز عبور را وارد کنید',
            'password.min' => 'رمز عبور حداقل 8 کاراکتر می باشد',
            'password.confirmed' => 'رمز عبور و تکرار رمز عبور یکسان نیست',
            'password.regex' => 'رمز عبور باید ترکیبی از حروف لاتین و عدد باشد',
        ]);
        $user=new User();
        $user->name = $request->name;
        $user->family = $request->family;
        $user->mobile = $request->mobile;
        $user->sex = $request->sex;
        $user->ostan_id = $request->ostan_id;
        $user->ostan = $request->ostan;
        $user->city_id = $request->city_id;
        $user->city = $request->city;
        $user->email = $request->email;
        $user->address = $request->address;
        $user->password = bcrypt($request->input('password'));

        if ($request->active_user=="on"){
            $user->status = "ACTIVE";
        }
        $user->save();
        session()->put('user-create', 'کاربر جدید با موفقیت اضافه شد');
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::where('id', $id)->first();
        $users = $this->get_user($user->reference_code);


        //return view('adminbizness.users.show',compact(['users']));
    }

    public function get_user($reference_code)
    {
        $users = Tree::where('reference', $reference_code)->get();
        foreach ($users as $user) {
            $this->get_user($user->reference_code);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Gate::check('users_edit')) {
            abort_unless(Gate::allows('users_edit'), 403, 'شما به این بخش دسترسی ندارید');
        } elseif (Gate::check('users_Confirmation')) {
            abort_unless(Gate::allows('users_Confirmation'), 403, 'شما به این بخش دسترسی ندارید');
        } else {
            abort_unless(Gate::allows('users_Confirmation'), 403, 'شما به این بخش دسترسی ندارید');
            abort_unless(Gate::allows('users_edit'), 403, 'شما به این بخش دسترسی ندارید');
        }

        $user = User::where('id', $id)->first();
        $users = User::all();
        return view('adminbizness.users.edit', compact(['user', 'users']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findorfail($id);

            $this->validate($request, [
                'name' => 'required|string|max:255|min:3',
                'family' => 'required|string|max:255|min:3',
                'national_code' => 'nullable|max:10|min:10|unique:users,national_code,' . $id,
                'mobile' => 'required|regex:/(09)[0-9]{9}/|digits:11|unique:users,mobile,' . $id,
                'email' => 'required|email|unique:users,email,' . $id,
                'address' => 'nullable|min:10',
                'password' => 'nullable|min:8|confirmed',
            ], [
                'name.required' => 'نام را وارد کنید',
                'family.required' => 'نام خانوادگی را وارد کنید',
                'national_code.unique' => 'کدملی از قبل موجود می باشد',
                'national_code.min' => 'کدملی نامعتبر است',
                'national_code.max' => 'کدملی نامعتبر است',
                'mobile.required' => 'شماره موبایل را وارد کنید',
                'mobile.unique' => 'شماره موبایل از قیل وجود دارد',
                'mobile.regex' => 'شماره موبایل صحیح نیست',
                'email.required' => 'ایمیل  را وارد کنید',
                'email.email' => 'ایمیل صحیح نمی باشد',
                'address.min' => 'آدرس کوتاه می باشد',
                'password.min' => 'رمز عبور حداقل 8 کاراکتر می باشد',
                'password.confirmed' => 'رمز عبور و تکرار رمز عبور یکسان نیست',
                'password.regex' => 'رمز عبور باید ترکیبی از حروف لاتین و عدد باشد',
            ]);

                $user->name = $request->name;
                $user->family = $request->family;
                $user->mobile = $request->mobile;
                $user->sex = $request->sex;
                $user->ostan_id = $request->ostan_id;
                $user->ostan = $request->ostan;
                $user->city_id = $request->city_id;
                $user->city = $request->city;
                $user->email = $request->email;
                $user->address = $request->address;
                if ($request->password!=""){
                    $user->password = bcrypt($request->input('password'));
                }
                $user->save();
                session()->put('user_chagne', 'تغییرات با موفقیت ذخیره شده');

        return redirect(route('users.edit', $id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */

    public function move_user(Request $request)
    {
        if (!empty($request->user_id) and !empty($request->users_move) and !empty($request->move_type)) {
            if ($request->move_type=="majmoeh")
            {
                $reference_tree = Tree::where('reference_code', $request->users_move)->first();
                if ($reference_tree->right_hand == "") {
                    $tree = Tree::where('user_id', $request->user_id)->first();
                    $user = User::findorfail($request->user_id);

                    if ($tree!=null) {

                        $this->hand_count_minus($tree->reference_code, $tree->reference, $tree->left_count);
                        if ($reference_tree->left_hand == "") {
                            $this->hand_count_plus($reference_tree->reference_code, $reference_tree->reference, $tree->left_count);

                            $reference_tree->left_count=$reference_tree->left_count+$tree->left_count;
                            $reference_tree->left_hand = $tree->reference_code;
                        } else {
                            $this->hand_count_plus($reference_tree->reference_code, $reference_tree->reference, $tree->left_count);

                            $reference_tree->right_count=$reference_tree->right_count+$tree->right_count;
                            $reference_tree->right_hand = $tree->reference_code;
                        }
                        $reference_tree->save();

                        $tree_ref=Tree::where('reference_code', $tree->reference)->first();
                        if ($tree_ref->left_hand==$tree->reference_code){
                            $tree_ref->left_hand="";
                        }elseif ($tree_ref->right_hand==$tree->reference_code){
                            $tree_ref->right_hand="";
                        }
                        $tree_ref->save();

                        $tree->reference = $request->users_move;
                        $tree->save();


                        $user->reference = $request->users_move;
                        $user->save();
                        session()->put('user_chagne', 'کاربر مورد نظر با موفقیت انتقال یافت');
                    }


                } else {
                    session()->put('user_chagne_danger', 'کاربر مورد نظر محدودیت جایگاه دارد');
                    session()->put('tab_user_move', 'tab');
                }
            }elseif ($request->move_type=="taki") {
                $reference_tree = Tree::where('reference_code', $request->users_move)->first();
                if ($reference_tree->right_hand == "") {
                    $user = User::findorfail($request->user_id);
                    $user->reference=$request->users_move;
                    $user->save();
                    $newuser = $user->replicate();
                    $newuser->save();


                    $package_price = Package::all();
                    if ($user->package == 1) {
                        $this->package_one($package_price, $newuser->id);
                    } elseif ($user->package == 2) {
                        $this->package_three($package_price, $newuser->id);
                    } elseif ($user->package == 3) {
                        $this->package_five($package_price, $newuser->id);
                    } elseif ($user->package == 4) {
                        $this->package_eight($package_price, $newuser->id);
                    }
                    $wallet=new Wallet();
                    $wallet->user_id=$newuser->id;
                    $wallet->token=md5(uniqid(rand(), true)).$newuser->id;
                    $wallet->price=0;
                    $wallet->save();

                    $user->username = "moved";
                    $user->status = "INACTIVE";
                    $user->avatar = "";
                    $user->image_certificate = "";
                    $user->image_meli = "";
                    $user->documents_status = "Empty";
                    $user->save();

                } else {
                    session()->put('user_chagne_danger', 'کاربر مورد نظر محدودیت جایگاه دارد');
                    session()->put('tab_user_move', 'tab');
                }
                session()->put('user_chagne', 'کاربر مورد نظر با موفقیت انتقال یافت');
            }


        }
        return redirect(route('users.edit', $request->user_id));
    }

    public function destroy($id)
    {
        //
    }


    public function hand_count_minus($reference_code = '', $reference = '', $count = '')
    {
        $query = Tree::where('reference_code', $reference)->first();
        if ($query) {
            if ($reference_code == $query->left_hand) {
                $this->hand_count_minus($query->reference_code, $query->reference, $count);
                $query->left_count = $query->left_count - $count;
            }
            if ($reference_code == $query->right_hand) {
                $this->hand_count_minus($query->reference_code, $query->reference, $count);
                $query->right_count = $query->right_count - $count;
            }
            $query->save();
        }
    }

    public function hand_count_plus($reference_code = '', $reference = '', $count = '')
    {
        $query = Tree::where('reference_code', $reference)->first();
        if ($query) {
            if ($reference_code == $query->left_hand) {
                $this->hand_count_plus($query->reference_code, $query->reference, $count);
                $query->left_count = $query->left_count + $count;
            }
            if ($reference_code == $query->right_hand) {
                $this->hand_count_plus($query->reference_code, $query->reference, $count);
                $query->right_count = $query->right_count + $count;
            }
            $query->save();
        }
    }

    public function package_one($package_price,$user_id)
    {

        /********* Step 1 *********/
        $user = User::findorfail($user_id);
        $tree = new Tree();
        $tree->user_id = $user->id;
        $tree->reference_code = '';
        $tree->pin_code = $user->pin_code;
        $tree->reference = $user->reference;
        $tree->save();



        $v = Verta();
        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree->id;
        $tree->reference_code = $code;
        $tree->save();

        $reference_user = Tree::where('reference_code', $user->reference)->first();
        if ($reference_user->left_hand == '') {
            $reference_user->left_hand = $tree->reference_code;
        } else {
            $reference_user->right_hand = $tree->reference_code;
        }
        $reference_user->save();

        $user->reference_code = $tree->reference_code;
        $user->package = 1;
        $user->save();



        $direct_selling = Tree::where('reference_code', $user->pin_code)->first();
        $price_direct_selling = $package_price[0]->price * 20 / 100;
        $direct_selling->direct_selling = $direct_selling->direct_selling + $price_direct_selling;
        $direct_selling->direct_selling_save = $direct_selling->direct_selling_save + $price_direct_selling;
        $direct_selling->save();
        $this->insert_report_direct($user->pin_code,$price_direct_selling);

        $report=new Allreport();
        $report->user_id=$user->id;
        $report->reference_code=$tree->reference_code;
        $report->total_price=$package_price[0]->price+180000;
        $report->description='خرید پکیج';
        $report->save();

        $this->hand_count($tree->reference_code, $user->reference, 1);
        $this->hand_count_price($tree->reference_code, $user->reference, $package_price[0]->price);
        $this->hand_price($tree->reference_code, $user->reference, $package_price[0]->price);
        $this->report($tree->reference_code, $user->reference, $package_price[0]->price,1);
    }

    public function package_three($package_price,$user_id)
    {
        /********* Step 1 *********/
        $user = User::findorfail($user_id);
        $tree = new Tree();
        $tree->user_id = $user->id;
        $tree->reference_code = '';
        $tree->pin_code = $user->pin_code;
        $tree->reference = $user->reference;
        $tree->right_count = 1;
        $tree->left_count = 1;
        $tree->left_total_sell = $package_price[0]->price;
        $tree->left_price = $package_price[0]->price;
        $tree->right_total_sell = $package_price[0]->price;
        $tree->right_price = $package_price[0]->price;
        $tree->save();

        $v = Verta();
        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree->id;
        $tree->reference_code = $code;
        $tree->save();
        $user->reference_code = $tree->reference_code;
        $user->package = 2;
        $user->save();

        $reference_user = Tree::where('reference_code', $user->reference)->first();

        if ($reference_user->left_hand == '') {
            $reference_user->left_hand = $tree->reference_code;
        } else {
            $reference_user->right_hand = $tree->reference_code;
        }
        $reference_user->save();


        $direct_selling = Tree::where('reference_code', $user->pin_code)->first();
        $price_direct_selling = $package_price[1]->price * 20 / 100;
        $direct_selling->direct_selling = $direct_selling->direct_selling + $price_direct_selling;
        $direct_selling->direct_selling_save = $direct_selling->direct_selling_save + $price_direct_selling;
        $direct_selling->save();
        $this->insert_report_direct($user->pin_code,$price_direct_selling);
        /********* Step 2 *********/
        $tree2 = new Tree();
        $tree2->user_id = $user->id;
        $tree2->pin_code = $user->pin_code;
        $tree2->reference_code = '';
        $tree2->reference = $tree->reference_code;
        $tree2->save();

        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree2->id;
        $tree2->reference_code = $code;
        $tree2->save();

        $tree->left_hand = $tree2->reference_code;
        $tree->save();


        /********* Step 3 *********/
        $tree3 = new Tree();
        $tree3->user_id = $user->id;
        $tree3->pin_code = $user->pin_code;
        $tree3->reference_code = '';
        $tree3->reference = $tree->reference_code;
        $tree3->save();

        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree3->id;
        $tree3->reference_code = $code;
        $tree3->save();

        $tree->right_hand = $tree3->reference_code;
        $tree->save();

        $report=new Allreport();
        $report->user_id=$user->id;
        $report->reference_code=$tree->reference_code;
        $report->total_price=$package_price[1]->price+180000;
        $report->description='خرید پکیج';
        $report->save();


        $this->hand_count($tree->reference_code, $user->reference, 3);
        $this->hand_count_price($tree->reference_code, $user->reference, $package_price[1]->price);
        $this->hand_price($tree->reference_code, $user->reference, $package_price[1]->price);
        $this->report($tree->reference_code, $user->reference, $package_price[1]->price,3);
    }


    public function package_five($package_price,$user_id)
    {
        /********* Step 1 *********/
        $user = User::findorfail($user_id);
        $tree = new Tree();
        $tree->user_id = $user->id;
        $tree->reference_code = '';
        $tree->pin_code = $user->pin_code;
        $tree->reference = $user->reference;
        $tree->right_count = 2;
        $tree->left_count = 2;
        $tree->left_total_sell = $package_price[0]->price * 2;
        $tree->left_price = $package_price[0]->price * 2;
        $tree->right_total_sell = $package_price[0]->price * 2;
        $tree->right_price = $package_price[0]->price * 2;
        $tree->save();

        $v = Verta();
        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree->id;
        $tree->reference_code = $code;
        $tree->save();
        $user->reference_code = $tree->reference_code;
        $user->package = 3;
        $user->save();

        $reference_user = Tree::where('reference_code', $user->reference)->first();
        if ($reference_user->left_hand == '') {
            $reference_user->left_hand = $tree->reference_code;
        } else {
            $reference_user->right_hand = $tree->reference_code;
        }
        $reference_user->save();


        $direct_selling = Tree::where('reference_code', $user->pin_code)->first();
        $price_direct_selling = $package_price[2]->price * 20 / 100;
        $direct_selling->direct_selling = $direct_selling->direct_selling + $price_direct_selling;
        $direct_selling->direct_selling_save = $direct_selling->direct_selling_save + $price_direct_selling;
        $direct_selling->save();
        $this->insert_report_direct($user->pin_code,$price_direct_selling);

        /********* Step 2 left*********/
        $tree2 = new Tree();
        $tree2->user_id = $user->id;
        $tree2->pin_code = $user->pin_code;
        $tree2->reference_code = '';
        $tree2->reference = $tree->reference_code;
        $tree2->left_count = 1;
        $tree2->left_total_sell = $package_price[0]->price;
        $tree2->left_price = $package_price[0]->price;
        $tree2->save();

        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree2->id;
        $tree2->reference_code = $code;
        $tree2->save();

        $tree_hand = Tree::where('reference_code', $tree->reference_code)->first();
        $tree_hand->left_hand = $tree2->reference_code;
        $tree_hand->save();


        /********* Step 3 left*********/
        $tree3 = new Tree();
        $tree3->user_id = $user->id;
        $tree3->pin_code = $user->pin_code;
        $tree3->reference_code = '';
        $tree3->reference = $tree2->reference_code;
        $tree3->save();

        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree3->id;
        $tree3->reference_code = $code;
        $tree3->save();

        $tree_hand2 = Tree::where('reference_code', $tree2->reference_code)->first();
        $tree_hand2->left_hand = $tree3->reference_code;
        $tree_hand2->save();


        /********* Step 4 right*********/
        $tree4 = new Tree();
        $tree4->user_id = $user->id;
        $tree4->pin_code = $user->pin_code;
        $tree4->reference_code = '';
        $tree4->reference = $tree->reference_code;
        $tree4->right_count = 1;
        $tree4->right_total_sell = $package_price[0]->price;
        $tree4->right_price = $package_price[0]->price;
        $tree4->save();

        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree4->id;
        $tree4->reference_code = $code;
        $tree4->save();

        $tree_hand3 = Tree::where('reference_code', $tree->reference_code)->first();
        $tree_hand3->right_hand = $tree4->reference_code;
        $tree_hand3->save();


        /********* Step 5 right*********/
        $tree5 = new Tree();
        $tree5->user_id = $user->id;
        $tree5->pin_code = $user->pin_code;
        $tree5->reference_code = '';
        $tree5->reference = $tree4->reference_code;
        $tree5->save();

        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree5->id;
        $tree5->reference_code = $code;
        $tree5->save();

        $tree_hand4 = Tree::where('reference_code', $tree4->reference_code)->first();
        $tree_hand4->right_hand = $tree5->reference_code;
        $tree_hand4->save();

        $report=new Allreport();
        $report->user_id=$user->id;
        $report->reference_code=$tree->reference_code;
        $report->total_price=$package_price[2]->price+180000;
        $report->description='خرید پکیج';
        $report->save();

        $this->hand_count($tree->reference_code, $user->reference, 5);
        $this->hand_count_price($tree->reference_code, $user->reference, $package_price[2]->price);
        $this->hand_price($tree->reference_code, $user->reference, $package_price[2]->price);
        $this->report($tree->reference_code, $user->reference, $package_price[2]->price,5);
    }

    public function package_eight($package_price,$user_id)
    {
        $user = User::findorfail($user_id);
        /********* Step 1 *********/
        $tree1 = new Tree();
        $tree1->user_id = $user->id;
        $tree1->reference_code = '';
        $tree1->pin_code = $user->pin_code;
        $tree1->reference = $user->reference;
        $tree1->right_count = 0;
        $tree1->left_count = 7;
        $tree1->left_total_sell = $package_price[0]->price * 7;
        $tree1->left_price = $package_price[0]->price * 7;
        $tree1->right_total_sell = $package_price[0]->price* 7;
        $tree1->right_price = $package_price[0]->price* 7;
        $tree1->save();

        $v = Verta();
        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree1->id;
        $tree1->reference_code = $code;
        $tree1->save();
        $user->reference_code = $tree1->reference_code;
        $user->package = 4;
        $user->save();

        $reference_user = Tree::where('reference_code', $user->reference)->first();

        if ($reference_user->left_hand == '') {
            $reference_user->left_hand = $tree1->reference_code;
        } else {
            $reference_user->right_hand = $tree1->reference_code;
        }
        $reference_user->save();


        $direct_selling = Tree::where('reference_code', $user->pin_code)->first();
        $price_direct_selling = $package_price[3]->price * 20 / 100;
        $direct_selling->direct_selling = $direct_selling->direct_selling + $price_direct_selling;
        $direct_selling->direct_selling_save = $direct_selling->direct_selling_save + $price_direct_selling;
        $direct_selling->save();
        $this->insert_report_direct($user->pin_code,$price_direct_selling);

        /********* Step 2 left*********/
        $tree2 = new Tree();
        $tree2->user_id = $user->id;
        $tree2->pin_code = $user->pin_code;
        $tree2->reference_code = '';
        $tree2->reference = $tree1->reference_code;
        $tree2->right_count = 3;
        $tree2->left_count = 3;
        $tree2->left_total_sell = $package_price[1]->price;
        $tree2->left_price = $package_price[1]->price;
        $tree2->right_total_sell = $package_price[1]->price;
        $tree2->right_price = $package_price[1]->price;
        $tree2->save();

        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree2->id;
        $tree2->reference_code = $code;
        $tree2->save();

        $tree_hand = Tree::where('reference_code', $tree1->reference_code)->first();
        $tree_hand->left_hand = $tree2->reference_code;
        $tree_hand->save();


        /********* Step 3 left*********/
        $tree3 = new Tree();
        $tree3->user_id = $user->id;
        $tree3->pin_code = $user->pin_code;
        $tree3->reference_code = '';
        $tree3->reference = $tree2->reference_code;
        $tree3->right_count = 1;
        $tree3->left_count = 1;
        $tree3->left_total_sell = $package_price[0]->price;
        $tree3->left_price = $package_price[0]->price;
        $tree3->right_total_sell = $package_price[0]->price;
        $tree3->right_price = $package_price[0]->price;
        $tree3->save();

        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree3->id;
        $tree3->reference_code = $code;
        $tree3->save();

        $tree_hand2 = Tree::where('reference_code', $tree2->reference_code)->first();
        $tree_hand2->left_hand = $tree3->reference_code;
        $tree_hand2->save();


        /********* Step 4 right*********/
        $tree4 = new Tree();
        $tree4->user_id = $user->id;
        $tree4->pin_code = $user->pin_code;
        $tree4->reference_code = '';
        $tree4->reference = $tree2->reference_code;
        $tree4->right_count = 1;
        $tree4->left_count = 1;
        $tree4->left_total_sell = $package_price[0]->price;
        $tree4->left_price = $package_price[0]->price;
        $tree4->right_total_sell = $package_price[0]->price;
        $tree4->right_price = $package_price[0]->price;
        $tree4->save();

        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree4->id;
        $tree4->reference_code = $code;
        $tree4->save();

        $tree_hand3 = Tree::where('reference_code', $tree2->reference_code)->first();
        $tree_hand3->right_hand = $tree4->reference_code;
        $tree_hand3->save();


        /********* Step 5 left*********/
        $tree5 = new Tree();
        $tree5->user_id = $user->id;
        $tree5->pin_code = $user->pin_code;
        $tree5->reference_code = '';
        $tree5->reference = $tree3->reference_code;
        $tree5->save();

        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree5->id;
        $tree5->reference_code = $code;
        $tree5->save();

        $tree_hand4 = Tree::where('reference_code', $tree3->reference_code)->first();
        $tree_hand4->left_hand = $tree5->reference_code;
        $tree_hand4->save();

        /********* Step 6 right*********/
        $tree6 = new Tree();
        $tree6->user_id = $user->id;
        $tree6->pin_code = $user->pin_code;
        $tree6->reference_code = '';
        $tree6->reference = $tree3->reference_code;
        $tree6->save();

        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree6->id;
        $tree6->reference_code = $code;
        $tree6->save();

        $tree_hand5 = Tree::where('reference_code', $tree3->reference_code)->first();
        $tree_hand5->right_hand = $tree6->reference_code;
        $tree_hand5->save();

        /********* Step 7 left*********/
        $tree7 = new Tree();
        $tree7->user_id = $user->id;
        $tree7->pin_code = $user->pin_code;
        $tree7->reference_code = '';
        $tree7->reference = $tree4->reference_code;
        $tree7->save();

        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree7->id;
        $tree7->reference_code = $code;
        $tree7->save();

        $tree_hand7 = Tree::where('reference_code', $tree4->reference_code)->first();
        $tree_hand7->left_hand = $tree7->reference_code;
        $tree_hand7->save();

        /********* Step 8 right*********/
        $tree8 = new Tree();
        $tree8->user_id = $user->id;
        $tree8->pin_code = $user->pin_code;
        $tree8->reference_code = '';
        $tree8->reference = $tree4->reference_code;
        $tree8->save();

        $code = $v->year . '' . $v->month . '' . $v->day . '' . $tree8->id;
        $tree8->reference_code = $code;
        $tree8->save();

        $tree_hand8 = Tree::where('reference_code', $tree4->reference_code)->first();
        $tree_hand8->right_hand = $tree8->reference_code;
        $tree_hand8->save();

        $report=new Allreport();
        $report->user_id=$user->id;
        $report->reference_code=$tree1->reference_code;
        $report->total_price=$package_price[3]->price+180000;
        $report->description='خرید پکیج';
        $report->save();

        $this->hand_count($tree1->reference_code, $user->reference, 8);
        $this->hand_count_price($tree1->reference_code, $user->reference, $package_price[3]->price);
        $this->hand_price($tree1->reference_code, $user->reference, $package_price[3]->price);
        $this->report($tree1->reference_code, $user->reference, $package_price[3]->price,8);

    }

    public function hand_count($reference_code = '', $reference = '', $count = '')
    {
        $query = Tree::where('reference_code', $reference)->first();
        if ($query) {
            if ($reference_code == $query->left_hand) {
                $this->hand_count($query->reference_code, $query->reference, $count);
                $query->left_count = $query->left_count + $count;
            }
            if ($reference_code == $query->right_hand) {
                $this->hand_count($query->reference_code, $query->reference, $count);
                $query->right_count = $query->right_count + $count;
            }
            $query->save();
        }
    }

    public function hand_price($reference_code = '', $reference = '', $count = '')
    {
        $query = Tree::where('reference_code', $reference)->first();
        if ($query) {
            if ($reference_code == $query->left_hand) {
                $this->hand_price($query->reference_code, $query->reference, $count);
                $query->left_price = $query->left_price + $count;
            }
            if ($reference_code == $query->right_hand) {
                $this->hand_price($query->reference_code, $query->reference, $count);
                $query->right_price = $query->right_price + $count;
            }
            $query->save();
        }
    }

    public function hand_count_price($reference_code = '', $reference = '', $count = '')
    {
        $query = Tree::where('reference_code', $reference)->first();
        if ($query) {
            if ($reference_code == $query->left_hand) {
                $this->hand_count_price($query->reference_code, $query->reference, $count);
                $query->left_total_sell = $query->left_total_sell + $count;
            }
            if ($reference_code == $query->right_hand) {
                $this->hand_count_price($query->reference_code, $query->reference, $count);
                $query->right_total_sell = $query->right_total_sell + $count;
            }
            $query->save();
        }
    }


    public function report($reference_code = '', $reference = '', $price='',$count = '')
    {
        $query = Tree::where('reference_code', $reference)->first();

        if ($query) {
            $report=new Allreport();
            $report->reference_code=$reference;
            $report->user_id=$query->user_id;

            if ($reference_code == $query->left_hand) {
                $this->report($query->reference_code, $query->reference,$price, $count);
                $report->left_count=$count;
                $report->left_price=$price;
            }
            if ($reference_code == $query->right_hand) {
                $this->report($query->reference_code, $query->reference,$price, $count);
                $report->right_count=$count;
                $report->right_price=$price;
            }
            $report->description="بودجه آموزشی";
            $report->save();
        }
    }


    public function insert_report_direct($reference_code,$price)
    {
        $direct_selling = Tree::where('reference_code',$reference_code)->first();
        $report=new Allreport();
        $report->user_id=$direct_selling->user_id;
        $report->reference_code=$direct_selling->reference_code;
        $report->left_price='0';
        $report->direct_selling=$price;
        $report->description="بودجه آموزشیار";
        $report->save();
    }
}
