<?php

namespace App\Http\Controllers;
use App\Product;
use App\Order;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders=Order::all();
        return view('manageorders',compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products_data=Product::whereproduct_status(1)->pluck('product_name','product_id');
        $products=$products_data->toArray();
        // dd($products);
        return view('addOrders',compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $order_info=$request->all();
        Order::create($order_info);
        // return $request->all();
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
    public function update(Request $request, $id)
    {
        //
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
    public function addorder(){
        return view('addOrders');
    }
    public function fetchProductData(Request $request){
    $product_data=Product::where('product_id', $request->productId)->first()->toArray();
    return response()->json([$product_data]);
    
    }
    public function fetchSelectedProductData(){
        $selected_product_data=DB::select('SELECT product_id, product_name FROM products WHERE product_status = 1');
        return response()->json($selected_product_data);
        }
}
