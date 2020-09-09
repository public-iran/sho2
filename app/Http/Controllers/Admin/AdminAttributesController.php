<?php

namespace App\Http\Controllers\Admin;

use App\Attribute;
use App\Attribute_category;
use App\Attribute_value;
use App\Category;
use Gate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminAttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_unless(Gate::allows('products_comment'),403,'شما به این بخش دسترسی ندارید');
        $attributes=Attribute::with('category','attribute_values')->get();
        return view('adminbizness.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('adminbizness.attributes.create',compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute=new Attribute();
        $attribute->title=$request->title;
        $attribute->inshop=$request->inshop;
        $attribute->category_id=$request->category;
        $attribute->save();
        foreach ($request->value as $value){
            $attr_vall=new Attribute_value();
            $attr_vall->attribute_id=$attribute->id;
            $attr_vall->value=$value;
            $attr_vall->save();
        }

 /*       foreach ($request->checkbox as $category){
            $cat=new Attribute_category();
            $cat->attribute_id=$attribute->id;
            $cat->category_id=$category;
            $cat->save();
        }*/
        session()->put('attribute','ویژگی جدید با موفقیت اضافه شد');
        return redirect('/admin/attribute');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attribute=Attribute::findorfail($id);
        $attribute_values=Attribute_value::where('attribute_id',$attribute->id)->get();
        $categories = Category::all();
        $category_attribute = $attribute->categories;
        return view('adminbizness.attributes.edit',compact(['attribute','categories','category_attribute','attribute_values']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $attribute=Attribute::findorfail($id);
        $attribute->title=$request->title;
        $attribute->inshop=$request->inshop;
        $attribute->category_id=$request->category;
        Attribute_category::where('attribute_id',$attribute->id)->delete();
        $attribute->save();
        foreach ($request->value as $values){
            foreach ($values as $key=>$value){
                Attribute_value::where('id',$key)->update(['value'=>$value,'attribute_id'=>$attribute->id]);
            }
        }

 /*       foreach ($request->checkbox as $category){
            $cat=new Attribute_category();
            $cat->attribute_id=$attribute->id;
            $cat->category_id=$category;
            $cat->save();
        }*/
        session()->put('attribute','ویژگی با موفقیت ویرایش شد');
        return redirect('/admin/attribute');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
