<?php

namespace App\Http\Controllers;
use App\Brand;
use Session;
use Validator;

use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands=Brand::paginate(10); 
        return view('brands',compact('brands'));
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

        $validator = Validator::make($request->all(), [
            'brand_name' => 'required|unique:brands|max:255',
        ]);

        if ($validator->fails()) {
            Session::flash('data_exists','Brand Already Exists');
            return redirect()->back()->withInput();
        }
        
        Brand::create($request->all());
        Session::flash('store','Brand Successfully Added');
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

    public function brandUpdate(Request $request)
    {
       Brand::where('brand_id',$request->id)->update(['brand_name' => $request->brand_name,'brand_status' => $request->brand_status]);
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
        $brand=Brand::wherebrand_id($id)->delete();
        Session::flash('delete','Brand Successfully Deleted');
        return redirect()->back();
    }
}
