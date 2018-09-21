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
       
        // Product::where('product_id',$request->id)->update([
        //     'product_code' => $request->product_code,
        //     'product_name' => $request->product_name,
        //     'product_quantity' => $request->product_quantity,
        //     'product_rate' => $request->product_rate,
        //     'brand_id' => $request->brand_id,
        //     'category_id' => $request->category_id,
        //     'product_image' => $request->product_image,
        //     'product_status' => $request->product_status
        //     ]);
        
    
        $data=Product::where('product_id',$request->id);

        if ($file=$request->file('product_image')) {
            $name=time().$file->getClientOriginalName();
            $file->move('images',$name);
            $input['product_image']=$name;
        }
        $data->update([
            'product_code' => $request->product_code,
            'product_name' => $request->product_name,
            'product_quantity' => $request->product_quantity,
            'product_rate' => $request->product_rate,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'product_image' => $name,
            'product_status' => $request->product_status
        ]);

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
