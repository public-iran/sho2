<?php

namespace App\Http\Controllers\Front;

use App\Comment;
use App\Favorite;
use App\Post;
use App\Post_comments;
use App\Postcategory;
use App\Product;
use Cookie;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class FrontAjaxsController extends Controller
{
    public function deleteItem($id)
    {
//        $idd = $_POST['item'];
        session()->forget("product.$id");
//        return "dfg";
    }

    public function set_view_post(Request $request)
    {
        $view=Post::findorfail($request->id);
        $view->view=$view->view+1;
        $view->save();
    }

    public function set_view_product(Request $request)
    {
        $view=Product::findorfail($request->id);
        $view->view=$view->view+1;
        $view->save();
    }

    public function addProductCount(Request $request)
    {
        $id = $_POST['item'];
        $oldCount = session("product.$id.1");
        $newCount = $oldCount + 1;
        $productArray = array($id, $newCount);
        $request->session()->put("product.$id", $productArray);
//        return true;
    }

    public function minusProductCount(Request $request)
    {
        $id = $_POST['item'];
        $newCount=0;
        $oldCount = session("product.$id.1");
        if ($oldCount != 0)
            $newCount = $oldCount - 1;
        $productArray = array($id, $newCount);
        $request->session()->put("product.$id", $productArray);
//        return true;
    }

    public function commentStore()
    {
        $comment = new Comment();
        $comment->productId = $_POST['productId'];
        $comment->user_id = $_POST['userId'];
        $comment->content = $_POST['content'];
        $comment->parentId =  $_POST['parentId'];
        $comment->save();
    }

    public function comment_service_Store()
    {
        $comment = new Post_comments();
        $comment->service_id = $_POST['productId'];
        $comment->user_id = $_POST['userId'];
        $comment->content = $_POST['content'];
        $comment->save();
    }

    public function comment_product_Store()
    {
        $comment = new Comment();
        $comment->product_id = $_POST['productId'];
        $comment->user_id = $_POST['userId'];
        $comment->content = $_POST['content'];
        $comment->save();
    }
    function service_comment_like_dislike(Request $request)
    {
        $Cookie = Cookie::get('service_comment'.$request->id);
        if (!$Cookie){
            Cookie::queue('service_comment'.$request->id, $request->id, 27*24*60);
            $service=Post_comments::where('id',$request->id)->first();
            $value=$request->value;
            $service->$value=$service->$value+1;
            $service->save();
            echo 'ok';
        }else{
            echo 'onelike';
        }
    }
    function product_comment_like_dislike(Request $request)
    {
        $Cookie = Cookie::get('product_comment'.$request->id);
        if (!$Cookie){
//            session()->put('service_comment'.$request->id,$request->id);
            Cookie::queue('product_comment'.$request->id, $request->id, 27*24*60);
            $service=Comment::where('id',$request->id)->first();
            $value=$request->value;
            $service->$value=$service->$value+1;
            $service->save();
            echo 'ok';
        }else{
            echo 'onelike';
        }
    }

    public function add_remove_favorite(Request $request)
    {
        $Favorite = Favorite::where(['user_id'=>Auth::id(),'product_id'=>$request->id])->first();
        if (empty($Favorite)){
            $item=new Favorite();
            $item->user_id=Auth::id();
            $item->product_id=$request->id;
            $item->save();
            echo 'add';
        }else{
            $Favorite->delete();
            echo 'deleted';
        }

    }

    public function delete_favorite(Request $request)
    {
        $item = Favorite::findorfail($request->id);
        if ($item->delete()) {
            echo 'deleted';
        } else {
            echo 'Notdeleted';
        }
    }


    public function search(Request $request)
    {
        $products = Product::where('status', 'PUBLISHED')->where('title', 'like', "%" . $request->search . "%")->with('categories')->orderby('id', 'desc')->take(5)->get();
        foreach ($products as $product){?>
            <div class="col-12" style="">
                <div class="card" style="border: none">
                    <a href="/product/<?= $product->slug ?>">
                        <div class="card-body" style="padding: 0px 2px 12px 14px;">


                            <div class="row" style="margin-right: 0">
                                <div class="col-xs-1" style="padding-right: 0;padding-left: 0;margin-right: 13px;margin-top: 12px">
                                    <img width="50" src="<?= asset($product->image) ?>" alt="">
                                </div>
                                <div class="col-xs-9" style="padding-top: 13px;padding-right: 31px;">
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 style="font-size: 10px;text-align: right; line-height: 2;color: #555"><?= $product->title ?></h6>
                                        </div>
                                    </div>
                                    <!--<div class="row align-items-center">
                                        <div class="col-12" style="padding:0;text-align: left">
                                            <span style="font-size: 13px;color: #00ad9c">{{number_format($cart->price)}} تومان</span>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </a>

                </div>
            </div>
        <?php }
       /* return response([
            'msg'=>$products
        ]);*/

    }



}
