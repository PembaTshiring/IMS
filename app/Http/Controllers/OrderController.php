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
        foreach ($orders as $order) {
            // $item_count=Order::whereorder_id($order['order_id'])->count();
            $item_count[] = DB::table('order_item')->whereorder_id($order->order_id)->count();
        }
        return view('manageorders',compact('orders','item_count'));
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
        $create_order=Order::create($order_info);
        $insertedId = $create_order->id;
        for ($x=0; $x < count($request->product_name); $x++) { 
            DB::table('order_item')->insert(
                [
                    'order_id' => $insertedId,
                    'product_id'=>$request->product_name[$x],
                    'quantity'=>$request->quantity[$x],
                    'rate'=> $request->rateValue[$x],
                    'total'=>$request->totalValue[$x],
                ]
            );
        }
        return redirect()->action('OrderController@index');
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
