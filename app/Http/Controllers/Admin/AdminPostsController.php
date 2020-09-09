<?php

namespace App\Http\Controllers\Admin;

use App\Post;
use App\Sgallery;
use App\Gallery;
use App\Postcategory;
use Gate;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests\ServiceRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use mysql_xdevapi\Session;

class AdminPostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('post_index'),403,'شما به این بخش دسترسی ندارید');
        $posts = Post::with('postcategories')->orderby('id','desc')->get();
        return view('adminbizness.posts.index',compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        abort_unless(Gate::allows('post_create'),403,'شما به این بخش دسترسی ندارید');
        $categories = Postcategory::all();
        return view('adminbizness.posts.create', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServiceRequest $request)
    {


        $post = new Post();

        if ($request->slug == "") {
            $temp = str_replace(" ", "-", $request->title);
            $post->slug = $temp;
        } else {
            $post->slug = $request->input('slug');
        }

        $post->title = $request->input('title');
        $post->shortContent = $request->input('shortContent');
        $post->Content = $request->input('content');
        $post->seoTitle = $request->input('seoTitle');
        $post->seoContent = $request->input('seoContent');

        $post->status = $request->input('status');
       // $post->lucre = $request->input('lucre'); //pricemargin

        $file = $request->file('image');
        if($file){
                $name = rand(1,99999).time().'_'.$file->getClientOriginalName();
                $image = Image::make($file);
                $image->resize(600, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                if(!is_dir('images/' . Auth::id())){
                    mkdir("images/". Auth::id());
                }
                $image->save('images/' . Auth::id() .'/'. $name);

                ///////////// save image in table /////////////
                $post->imgName = $file->getClientOriginalName();
                $post->imgPath = "images/".Auth::id().'/'.$name;
        }

        $post->save();

        //////////////////////////// upload image ///////////////////////////////

        //////////////////////////// upload image ///////////////////////////////

        $post->postcategories()->attach($request->checkbox);

        Session()->put('posts-create','مقاله شما با موفقیت ایجاد شد');
        return redirect('/admin/posts');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        abort_unless(Gate::allows('post_edit'),403,'شما به این بخش دسترسی ندارید');
        $images = Gallery::where(['product_id'=> $id,'type'=>'service'])->get();
        $post=Post::findorfail($id);
        $category_product = $post->postcategories;
        $categories = Postcategory::all();
        return view('adminbizness.posts.edit', compact(['post','categories','images','category_product']));
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

        $post =Post::findorfail($id);

        if ($request->slug == "") {
            $temp = str_replace(" ", "-", $request->title);
            $post->slug = $temp;
        } else {
            $post->slug = $request->input('slug');
        }

        $post->title = $request->input('title');
        $post->shortContent = $request->input('shortContent');
        $post->Content = $request->input('content');
        $post->seoTitle = $request->input('seoTitle');
        $post->seoContent = $request->input('seoContent');

        $post->status = $request->input('status');
        // $post->lucre = $request->input('lucre'); //pricemargin

        $file = $request->file('image');
        if($file){
            if ($post->imgName!=""){
                unlink(public_path($post->imgPath));
            }

            $name = rand(1,99999).time().'_'.$file->getClientOriginalName();
            $image = Image::make($file);
            $image->resize(600, null, function ($constraint) {
                $constraint->aspectRatio();
            });
            if(!is_dir('images/' . Auth::id())){
                mkdir("images/". Auth::id());
            }
            $image->save('images/' . Auth::id() .'/'. $name);

            ///////////// save image in table /////////////
            $post->imgName = $file->getClientOriginalName();
            $post->imgPath = "images/".Auth::id().'/'.$name;
        }

        $post->save();

        $post->postcategories()->sync($request->checkbox);

        Session()->put('posts-create','مقاله شما با موفقیت ویرایش شد');
        return redirect('/admin/posts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
