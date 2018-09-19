<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $products=Product::all();
        $categories=Category::pluck('category_name','category_id')->all();
        $brands=Brand::pluck('brand_name','brand_id')->all();
        return view('products',compact('categories','brands','products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $input=$request->all();
        if ($file=$request->file('product_image')) {
            $name=time().$file->getClientOriginalName();
            $file->move('images',$name);
            $input['product_image']=$name;
        }
        Product::create($input);
        return redirect()->back();
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function productUpdate(Request $request)
    {
        $input=Product::all();
        if ($file=$request->file('product_image')) {
            $name=time().$file->getClientOriginalName();
            $file->move('images',$name);
            $input['product_image']=$name;
        }
        product()->whereproduct_id($request->product_id)->update($input);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Product::whereproduct_id($id)->delete();
        return redirect()->back();
    }
}
