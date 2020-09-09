<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Attribute_category;
use App\Attribute_product;
use App\Category_product;
use Illuminate\Http\Request;
use App\Http\Requests\ProductCreateRequest;
use App\Http\Requests\ProductEditRequest;
use App\Product;
use App\Gallery;
use App\Linkdownload;
use App\Category;
use App\Feature;
use Gate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;


class AdminProductsController extends Controller
{

    public function index()
    {
        abort_unless(Gate::allows('products_index'),403,'شما به این بخش دسترسی ندارید');
        $productItems = Product::with('categories')->orderby('id','desc')->get();
        return view('adminbizness.product.index',compact('productItems'));
    }


    public function attributes($slug)
    {
        abort_unless(Gate::allows('products_attr'),403,'شما به این بخش دسترسی ندارید');
        $product = Product::where('slug',$slug)->first();
        $categories=Category_product::where('product_id',$product->id)->get();

        foreach ($categories as $category){
            $category_ids[]=$category->category_id;
        }


        /*//$attributes=[];
        foreach ($categories as $category){
            $attributesss[]=Attribute_category::where('category_id',$category->category_id)->select('attribute_id', 'category_id')->distinct()->get();
        }*/


        return view('adminbizness.product.attribute',compact('product','category_ids'));
    }

    public function attribute_create(Request $request)
    {
        Attribute_product::where('product_id',$request->product_id)->delete();
        foreach ($request->attribute as $key=> $attr) {
            $attribute = new Attribute_product();
            $attribute->attribute_value_id = $attr;
            $attribute->attribute_id = $key;
            $attribute->product_id = $request->product_id;
            $attribute->save();
        }
        session()->put('insertProduct', 'ویژگی ها برای محصول مورد نظر ثبت شد');
        return redirect(route('products.index'));
    }


    public function create()
    {
        abort_unless(Gate::allows('products_create'),403,'شما به این بخش دسترسی ندارید');
        $categories = Category::all();
        return view('adminbizness.product.create', compact(['categories']));

    }

    public function store(ProductCreateRequest $request)
    {
        $product = new Product();
        $linkdownload = new Linkdownload();

        if($request->input('slug')){
            $product->slug = make_slug($request->input('slug'));
        }else{
            $product->slug = make_slug($request->input('title'));
        }

        $product->user_id = Auth::id();
        $product->title = $request->input('title');
        $product->title_seo = $request->input('seoTitle');
        $product->slug = $request->input('slug');
        $product->content = $request->input('content');
        $product->excerpt = $request->input('shortContent');
        $product->meta_description = $request->input('seoContent');
        $product->price = $request->input('mainPrice');
        if (!empty($request->input('discount'))){
            $product->discount = $request->input('discount');
        }else{
            $product->discount=0;
        }
        $product->marginprice = $request->input('marginprice');
        $product->depot = $request->input('depot');;
        $product->unit = $request->input('unit');;
        $product->special = $request->input('special');
        $product->status = $request->input('status');
        //$product->type = $request->input('type');
        $product->view = 0;


        //////////////////////////// upload image ///////////////////////////////
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
            $product->image = 'images/' . Auth::id().'/'.$name;
            ///////////// save image in table /////////////
        }
        //////////////////////////// upload image ///////////////////////////////

        //////////////////////////// upload video ///////////////////////////////
        $file = $request->file('video');
        if($file){
            $name = rand(1,99999).time().'_'.$file->getClientOriginalName();
            $path = 'videos/' . Auth::id() .'/'. $name;
            $file->move(public_path().'/videos/'. Auth::id(), $name);
            ///////////// save video in table /////////////
            $product->video = $path;
            ///////////// save video in table /////////////
        }
        //////////////////////////// upload video ///////////////////////////////


        $product->save();

        //////////////////////////// upload file ///////////////////////////////
        $file = $request->file('file');
        if($file){
            $name = rand(1,99999).time().'_'.$file->getClientOriginalName();
            $path = 'files/' . Auth::id() .'/'. $name;
            $file->move(public_path().'/files/'. Auth::id(), $name);
            ///////////// save file in table /////////////
            $linkdownload->path = $path;
            ///////////// save file in table /////////////
            $linkdownload->user_id = Auth::id();
            $linkdownload->product_id = $product->id;
            $linkdownload->save();
        }
        //////////////////////////// upload file ///////////////////////////////


        //////////////////////////// upload gallery ///////////////////////////////
        $files = $request->file('photo');
        if($files){
            foreach ($files as $file){
                $photos = new Gallery();
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
                $photos->name = $file->getClientOriginalName();
                $photos->path = 'images/' . Auth::id().'/'.$name;
                $photos->product_id = $product->id;
                $photos->user_id = Auth::id();
                $photos->save();
                ///////////// save image in table /////////////
            }
        }
        //////////////////////////// upload gallery ///////////////////////////////

        $product->categories()->attach($request->checkbox);

        if($request->feature[0]){
            for($i=0; $i<count($request->feature);$i++){
                $featur = new Feature();
                $featur->title = $request->feature[$i];
                $featur->content = $request->featureValue[$i];
                $featur->product_id = $product->id;
                $featur->save();
            }
        }
        session()->put('insertProduct', 'محصول مورد نظر با موفقیت ثبت شد.');
        return redirect(route('products.index'));
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        abort_unless(Gate::allows('products_edit'),403,'شما به این بخش دسترسی ندارید');
        $images = Gallery::where(['product_id'=>$id, 'type'=>'product'])->get();
        $features = Feature::where('product_id', $id)->get();

        $product = Product::find($id);
        $category_product = $product->categories;

        $categories = Category::all();
        return view('adminbizness.product.edit',compact('product', 'categories', 'category_product', 'images', 'features'));
    }

    public function update(ProductEditRequest $request, $id)
    {
        $product = Product::findorfail($id);
        $linkdownload = new Linkdownload();

        if($request->input('slug')){
            $product->slug = make_slug($request->input('slug'));
        }else{
            $product->slug = make_slug($request->input('title'));
        }

        $product->title = $request->input('title');
        $product->title_seo = $request->input('title_seo');
        $product->slug = $request->input('slug');
        $product->content = $request->input('content');
        $product->excerpt = $request->input('excerpt');
        $product->meta_description = $request->input('meta_description');
        $product->price = $request->input('price');
        if (!empty($request->input('discount'))){
            $product->discount = $request->input('discount');
        }else{
            $product->discount=0;
        }
        $product->marginprice = $request->input('marginprice');
        $product->depot = $request->input('depot');
        $product->unit = $request->input('unit');
        //$product->type = $request->input('type');
        $product->status = $request->input('status');
        $product->special = $request->input('special');
        $product->view = 0;


        //////////////////////////// upload image ///////////////////////////////
        $file = $request->file('image');
        if($file){
            if(file_exists(public_path() . '/' . $product->image)){
                unlink(public_path() . '/' . $product->image);
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
            $product->image = 'images/' . Auth::id().'/'.$name;
            ///////////// save image in table /////////////
        }
        //////////////////////////// upload image ///////////////////////////////

        //////////////////////////// upload video ///////////////////////////////
        $file = $request->file('video');
        if($file){
            if(!empty($product->video)){
                if(file_exists(public_path() . '/' . $product->video)){
                    unlink(public_path() . '/' . $product->video);
                }
            }
            $name = rand(1,99999).time().'_'.$file->getClientOriginalName();
            $path = 'videos/' . Auth::id() .'/'. $name;
            $file->move(public_path().'/videos/'. Auth::id(), $name);
            ///////////// save video in table /////////////
            $product->video = $path;
            ///////////// save video in table /////////////
        }
        //////////////////////////// upload video ///////////////////////////////

        if($request->feature){
            $featur_del = Feature::where('product_id', $id);
            if($featur_del->delete()){
                for($i=0; $i<count($request->feature);$i++){
                    $featur = new Feature();
                    $featur->title = $request->feature[$i];
                    $featur->content = $request->featureValue[$i];
                    $featur->product_id = $id;
                    $featur->save();
                }
            }
        }

        $product->save();

        //////////////////////////// upload file ///////////////////////////////
        $file = $request->file('file');
        if($file){
            if(!empty($product->video)){
                if(file_exists(public_path() . '/' . $product->video)){
                    unlink(public_path() . '/' . $product->video);
                }
            }
            $linkdownload_delete = Linkdownload::where('product_id', $id)->first();
            $linkdownload_delete->delete();

            $name = rand(1,99999).time().'_'.$file->getClientOriginalName();
            $path = 'files/' . Auth::id() .'/'. $name;
            $file->move(public_path().'/files/'. Auth::id(), $name);
            ///////////// save video in table /////////////
            $linkdownload->path = $path;
            ///////////// save video in table /////////////
            $linkdownload->user_id = Auth::id();
            $linkdownload->product_id = $product->id;
            $linkdownload->save();
        }
        //////////////////////////// upload file ///////////////////////////////

        //////////////////////////// upload gallery ///////////////////////////////
        $files = $request->file('photo');
        if($files){
            foreach ($files as $file){
                $photos = new Gallery();
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
                $photos->name = $file->getClientOriginalName();
                $photos->path = 'images/' . Auth::id().'/'.$name;
                $photos->product_id = $product->id;
                $photos->user_id = Auth::id();
                $photos->save();
                ///////////// save image in table /////////////
            }
        }
        //////////////////////////// upload gallery ///////////////////////////////

        $product->categories()->sync($request->checkbox);
        session()->put('insertProduct', 'محصول مورد نظر با موفقیت ویرایش شد.');
        return redirect(route('products.index'));
    }

    public function destroy(Product $product)
    {
        if(!empty($product->image)){
            if(file_exists(public_path() . '/' . $product->image)){
                unlink(public_path() . '/' . $product->image);
            }
        }

        if(!empty($product->video)){
            if(file_exists(public_path() . '/' . $product->video)){
                unlink(public_path() . '/' . $product->video);
            }
        }

        $gallery = Gallery::where('product_id', $product->id)->get();
        if(!empty($gallery)){
            foreach ($gallery as $val){
                if(file_exists(public_path() . '/' . $val->path)){
                    unlink(public_path() . '/' . $val->path);
                }
                $val->delete();
            }
        }

        $product->categories()->detach();

        $featur_del = Feature::where('product_id', $product->id);
        $featur_del->delete();

        $Linkdownload = Linkdownload::where('product_id', $product->id);
        $Linkdownload->delete();


            if($product->delete()){
            session()->put('delete_product', 'محصول مورد نظر با موفقیت حذف شد');
            return redirect()->back();
        }
    }

    public function deletegalleryproduct($id){

        $photo = Gallery::findOrFail($id);

        if(file_exists(public_path() . '/' . $photo->path)){
            unlink(public_path() . '/' . $photo->path);
        }

        if($photo->delete()){
            session()->put('delete_img', 'تصویر مورد نظر با موفقیت حذف شد');
            return redirect()->back();
        }
    }


}
