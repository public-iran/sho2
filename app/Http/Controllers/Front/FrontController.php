<?php

namespace App\Http\Controllers\Front;

use App\Attribute;
use App\Banner;
use App\Brand;
use App\Category;
use App\Contact;
use App\Feature;
use App\Gallery;
use App\Post_comments;
use App\Postcategory;
use App\Attribute_product;
use App\Setting;
use App\Slider;
use App\User;
use App\Favorite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Product;
use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use App\Comment;
use function Cassandra\Type;


class FrontController extends Controller
{
    public function index()
    {
        $products_new = Product::where('status', 'PUBLISHED')->orderby('id', 'desc')->take(11)->get();
        $products_view = Product::where('status', 'PUBLISHED')->orderby('view', 'desc')->take(11)->get();
        $products_discount = Product::where('status', 'PUBLISHED')->where('discount', '!=', '0')->take(11)->get();
        $spacial_product = Product::where(['special' => 'YES', 'status' => 'PUBLISHED'])->orderby('id', 'desc')->take(8)->get();
        $categories_image = Category::where('showindex', 'YES')->get();
        $categories = Category::where('parent', '0')->get();
        $posts = Post::where('status', 'PUBLISHED')->orderby('id', 'desc')->take(3)->get();
        $sliders = Slider::where('status', 'Show')->get();
        $banners = Banner::where('status', 'Show')->get();
        $brands = Brand::where('status', 'Show')->get();

        $options = Setting::all();
        $setting = array();
        foreach ($options as $option) {
            $name = $option['setting'];
            $value = $option['value'];
            $setting[$name] = $value;
        }


        return view('front.index.index', compact('categories_image', 'categories', 'products_new', 'products_view', 'spacial_product', 'products_discount', 'posts', 'sliders', 'banners', 'setting','brands'));
    }

    public function blog_index()
    {
        @$cat = $_GET['cat'];

        if ($cat) {
            $posts = Post::whereHas('postcategories', function ($q) use ($cat) {
                $q->where('postcategories.slug', $cat);
            })->paginate(4);
        } else {
            $posts = Post::where('status', 'PUBLISHED')->with('postcategories')->orderby('id', 'desc')->paginate(4);
        }
        $posts_rand = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw("RAND()")->take(3)->get();
        $last_posts = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw('id','desc')->take(4)->get();
        $posts_view = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw('view','desc')->take(4)->get();
        $categories = Postcategory::all();
        return view('front.blog.index', compact('posts', 'categories', 'posts_rand','last_posts','posts_view'));
    }

    public function blog($slug)
    {
        $posts_rand = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw("RAND()")->take(3)->get();
        $categories = Postcategory::all();

        $post = Post::where(['status' => 'PUBLISHED', 'slug' => $slug])->with('postcategories')->first();
        $comments=Post_comments::where(['post_id'=>$post->id,'status'=>'SEEN','parent'=>'0'])->get();
        $last_posts = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw('id','desc')->take(4)->get();
        $posts_view = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw('view','desc')->take(4)->get();
        return view('front.blog.show', compact('post', 'categories', 'posts_rand','last_posts', 'posts_view','comments'));
    }

    public function blog_search()
    {
        $title = Input::get('title');
        $posts = Post::where('status', 'PUBLISHED')->where('title', 'like', "%" . $title . "%")->with('postcategories')->orderby('id', 'desc')->paginate(6);
        $posts_rand = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw("RAND()")->take(3)->get();
        $last_posts = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw('id','desc')->take(4)->get();
        $posts_view = Post::where('status', 'PUBLISHED')->with('postcategories')->orderByRaw('view','desc')->take(4)->get();
        $categories = Postcategory::all();
        return view('front.blog.index', compact('posts', 'categories', 'posts_rand','last_posts','posts_view'));
    }
    public function comment_post(Request $request)
    {
        $comment=new Post_comments();
        $comment->name=$request->name;
        $comment->content=$request->input('content');
        $comment->user_id=Auth::id();
        $comment->post_id=$request->post;
        $comment->email=$request->email;
        $comment->save();
        session()->put('save_comment','نظر شما با موفقیت دخیره شده و بعد از تائید مدیر در سایت نمایش داده می شود');
        return redirect()->back();
    }

    public function contact()
    {
        $options = Setting::all();
        $setting = array();
        foreach ($options as $option) {
            $name = $option['setting'];
            $value = $option['value'];
            $setting[$name] = $value;
        }
        return view('front.contact.index', compact(['setting']));
    }

    public function shop()
    {
        @$cat = $_GET['cat'];

        if ($cat) {
            $productItems = Product::whereHas('categories', function ($q) use ($cat) {
                $q->where('categories.slug', $cat);
            })->paginate(20);
        } else {
            $productItems = Product::where('status', 'PUBLISHED')->with('categories')->orderby('id', 'desc')->paginate(20);
        }
        $spacial_product = Product::where(['special' => 'YES', 'status' => 'PUBLISHED'])->orderby('id', 'desc')->take(6)->get();

        $sales=Product::where('status','PUBLISHED')->orderby('sale','desc')->take(6)->get();
        $categories = Category::all();
        $products_new = Product::where('status', 'PUBLISHED')->orderby('id', 'desc')->take(11)->get();
        $products_discount = Product::where('status', 'PUBLISHED')->where('discount', '!=', '0')->take(11)->get();
        $attributes = Attribute::with('attribute_values')->where('inshop', 'YES')->get();

        return view('front.shop.index', compact('productItems', 'categories', 'products_new', 'products_discount', 'attributes','sales','spacial_product'));
    }

    public function product($slug)
    {
        $product = Product::where(['slug' => $slug])->first();
        $images = Gallery::where(['product_id' => $product->id, 'type' => 'product'])->get();
        $featurs = Feature::where('product_id', $product->id)->get();
        $comments=Comment::where(['product_id'=>$product->id,'status'=>'SEEN'])->get();
        $sales=Product::where('status','PUBLISHED')->orderby('sale','desc')->take(7)->get();
        $like_products = collect([]);
        foreach ($product->categories as $val) {
            $category_products = $val->products;
            foreach ($category_products as $product2) {
                if ($product->id != $product2->id) {
                    if (!$like_products->contains('id', $product2->id)) {
                        $like_products->push($product2);
                    }
                }

            }
        }
        $categories = Category::where('parent', '0')->get();

        return view('front.shop.show', compact('product', 'categories', 'images', 'like_products', 'featurs','comments','sales'));
    }

    public function comment_product(Request $request)
    {
        $comment=new Comment();
        $comment->title=$request->title;
        $comment->content=$request->input('content');
        $comment->user_id=Auth::id();
        $comment->product_id=$request->pro;
        $comment->rating=$request->rating;
        $comment->save();
        session()->put('save_comment','نظر شما با موفقیت دخیره شده و بعد از تائید مدیر در سایت نمایش داده می شود');
        return redirect()->back();
    }

    public function checkout()
    {
        $user = User::find(Auth::id());

        $options = Setting::all();
        $setting = array();
        foreach ($options as $option) {
            $name = $option['setting'];
            $value = $option['value'];
            $setting[$name] = $value;
        }
        if (Auth::check()) {
            return view('front.shop.checkout', compact(['user','setting']));
        } else {
            return redirect('/login');
        }

    }

    public function productAttrVal()
    {
        $attribute_products = Attribute_product::all();
        $productAttrVal = [];
        foreach ($attribute_products as $row) {
            $productId = $row['product_id'];
            $attrId = $row['attribute_id'];
            $attrValueId = $row['attribute_value_id'];
            if (!isset($productAttrVal[$productId])) {
                $productAttrVal[$productId] = [];
            }
            $productAttrVal[$productId][$attrId] = $attrValueId;
        }

        return $productAttrVal;
    }

    public function doSearch(Request $request)
    {
        $productAttrVal = $this->productAttrVal();


        if ($request->limit) {
            $limit = $request->limit;
        } else {
            $limit = 21;
        }
        if ($request->sort) {

            if ($request->sort == "new") {
                $sort1 = 'id';
                $sort2 = 'desc';
            }
            if ($request->sort == "sell") {
                $sort1 = 'sale';
                $sort2 = 'desc';
            }
            if ($request->sort == "view") {
                $sort1 = 'view';
                $sort2 = 'desc';
            }
            if ($request->sort == "priceLow") {
                $sort1 = 'price';
                $sort2 = 'desc';
            }
            if ($request->sort == "priceHigh") {
                $sort1 = 'price';
                $sort2 = 'asc';
            }

        }

        $minamount=0;
        if ($request->minamount){
            if ($request->minamount!="NaN"){
                $minamount=trim($request->minamount);
            }else{
                $minamount=0;
            }

        }
        $maxamount=500000000;
        if ($request->minamount){
            if ($request->minamount!='NaN'){
                $maxamount=trim($request->maxamount);
            }else{
                $maxamount=500000000;
            }

        }

        $products = Product::where([['status','PUBLISHED'],['price','>',$minamount],['price','<',$maxamount]])->orderby($sort1, $sort2)->paginate($limit);

        $productTotal = [];

        // $data=['attr-3'=>['10','11'],'attr-4'=>'1'];

        if ($request->dataval) {
            foreach ($products as $productKey => $product) {
                foreach ($request->dataval as $key => $arrayValId) {

                    $attr = explode('-', $arrayValId['name']);
                    $attrId = $attr[1];
                    $attrId = explode('[', $attrId);
                    /*$attr = explode('-', $key);
                    @$attrId = $attr[1];
                    @$productVal = $productAttrVal[$product->id][$attrId];*/

                    @$productVal = $productAttrVal[$product->id][$attrId[0]];
                    if (isset($productVal)) {
                        if (!in_array($productVal, $arrayValId)) {
                            unset($products[$productKey]);
                        }
                    }
                }
            }
        }
        /* return response([
             'msg'=>$products
         ]);*/
        if (count($products)){
            foreach ($products as $item) {

                ?>
                <div class="product product--list product--list-small">

                    <div class="product__thumbnail">
                        <img class="img-fluid" style="max-height: 210px" src="<?= asset($item->image) ?>" alt="<?=$item->title ?>" title="<?= $item->title ?>">
                        <div class="prod_btn">
                            <a href="/product/<?= $item->slug ?>" class="transparent btn--sm btn--round">اطلاعات بیشتر </a>
                            <a href="/product/<?= $item->slug ?>" class="transparent btn--sm btn--round">مشاهده</a>
                        </div>
                        <!-- end /.prod_btn -->
                    </div>
                    <!-- end /.product__thumbnail -->

                    <div class="product__details">
                        <div class="product-desc">
                            <a href="#" class="product_title">
                                <h4><?= str_limit($item->title,40) ?></h4>
                            </a>
                            <?= str_limit($item->excerpt,60) ?>
                            <ul class="titlebtm">
                                <li class="product_cat">
                                    <?php foreach ($item->categories as $category): ?>

                                    <a href="#">
                                        <span style="font-size: 12px"><?= $category->title ?></span>
                                    </a>
                                   <?php endforeach; ?>
                                </li>
                            </ul>
                            <!-- end /.titlebtm -->
                        </div>
                        <!-- end /.product-desc -->


                        <div class="product-purchase">
                            <div class="price_love">
                                <?php if($item->discount>0): ?>
                                <span> <span class="price-new"><?= number_format($item->price*(100-$item->discount)/100) ?> تومان</span> <span class="price-old" style="text-decoration: line-through"><?= number_format($item->price) ?> تومان</span> <span class="saving"> تخفیف : <?= $item->discount ?>%</span> </span>
                                <?php else: ?>
                                <span> <?= number_format($item->price) ?> تومان </span>
                                <?php endif; ?>
                            </div>
                            <div class="love-comments d-flex justify-content-around">
                                <p>
                                    <span class="lnr lnr-heart" style="font-family: 'Linearicons-Free' !important;"></span> 90
                                </p>
                                <p>
                                    <span class="lnr lnr-cart" style="font-family: 'Linearicons-Free' !important;"></span>
                                    <span>16</span>
                                </p>
                            </div>

                        </div>
                        <!-- end /.product-purchase -->
                    </div>
                </div>
                <?php
            }
        }else{?>
            <div class="col-lg-4 col-md-6 col-sm-6">
                <h6 style="text-align: right;width: 100%">محصول مورد نظر یافت نشد!</h6>
            </div>

        <?php  }


        //$productTotal=array_filter($products);

    }

    public function about()
    {
        $options = Setting::all();
        $setting = array();
        foreach ($options as $option) {
            $name = $option['setting'];
            $value = $option['value'];
            $setting[$name] = $value;
        }
        return view('front.about.index', compact('setting'));
    }
    public function contact_store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'family' => 'required',
            'email' => 'required|email',
            'message' => 'required',

        ], [
            'name.required' => 'فیلد نام نمی تواند خالی باشد',
            'family.required' => 'فیلد نام خانوادگی نمی تواند خالی باشد',
            'email.required' => 'فیلد ایمیل نمی تواند خالی باشد',
            'email.email' => 'ایمیل نادرست است',
            'message.required' => 'فیلد متن نمی تواند خالی باشد',

        ]);
        $contact=new Contact();
        $contact->name=$request->name;
        $contact->family=$request->family;
        $contact->message=$request->message;
        $contact->mobile=$request->mobile;
        $contact->email=$request->email;
        $contact->save();
        session()->put('save_comment','پیام شما با موفقیت ارسال شد!');
        return redirect()->back();
    }
}
