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

    public function report(){
        return view('reports');
    }

    public function getOrderReport(Request $req){
        $startDate=$req->startDate;
        $endDate=$req->endDate;
        // $report=DB::select("SELECT * FROM orders WHERE order_date >= '$startDate' AND order_date <= '$endDate' AND order_status=1 ");
        $reports = DB::table('orders')->where([
            ['order_date', '>=', $startDate],
            ['order_date', '<=', $endDate],
            ['order_status', '=', 1]
        ])->get(['order_date','client_name','client_contact','grand_total'])->toArray();

        $table = '
	    <table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Order Date</th>
			<th>Client Name</th>
			<th>Contact</th>
			<th>Grand Total</th>
		</tr>

		<tr>';
		$totalAmount = "";
		foreach ($reports as $report){
			$table .= '<tr>
				<td><center>'.$report->order_date.'</center></td>
				<td><center>'.$report->client_name.'</center></td>
				<td><center>'.$report->client_contact.'</center></td>
				<td><center>'.$report->grand_total.'</center></td>
			</tr>';	
			$totalAmount += $report->grand_total;
		}
		$table .= '
		</tr>

		<tr>
			<td colspan="3"><center>Total Amount</center></td>
			<td><center>'.$totalAmount.'</center></td>
		</tr>
	</table>
	';	

	echo $table;
    }


    public function printOrder(Request $req){
        $id=$req->orderId;
        $reports = DB::table('orders')->whereorder_id($id)->get(['order_date','client_name','client_contact','sub_total','vat','total_amount','discount','grand_total','paid','due'])->toArray();
        $item_list=DB::table('order_item')->whereorder_id($id)->get();
        // dd($product_data);
        foreach ($reports as $report) {
        $table = '<table border="1" cellspacing="0" cellpadding="20" width="100%">
	<thead>
		<tr >
			<th colspan="5">

			<center>
				Order Date : '.$report->order_date.'
				<center>Client Name : '.$report->client_name.'</center>
				Contact : '.$report->client_contact.'
			</center>		
			</th>
				
		</tr>		
	</thead>
</table>
<table border="0" width="100%;" cellpadding="5" style="border:1px solid black;border-top-style:1px solid black;border-bottom-style:1px solid black;">

	<tbody>
		<tr>
			<th>S.no</th>
			<th>Product</th>
			<th>Rate</th>
			<th>Quantity</th>
			<th>Total</th>
		</tr>';

		$x = 1;
		foreach ($item_list as $item) {
            $product_data=DB::table('products')->whereproduct_id($item->product_id)->get()->toArray();
			$table .= '<tr>
				<th>'.$x.'</th>
				<th>'.$product_data[0]->product_name.'</th>
				<th>'.$item->rate.'</th>
				<th>'.$item->quantity.'</th>
				<th>'.$item->total.'</th>
			</tr>
			';
		$x++;
		} 

		$table .= '<tr>
			<th></th>
		</tr>

		<tr>
			<th></th>
		</tr>

		<tr>
			<th>Sub Amount</th>
			<th>'.$report->sub_total.'</th>			
		</tr>

		<tr>
			<th>VAT (13%)</th>
			<th>'.$report->vat.'</th>			
		</tr>

		<tr>
			<th>Total Amount</th>
			<th>'.$report->total_amount.'</th>			
		</tr>	

		<tr>
			<th>Discount</th>
			<th>'.$report->discount.'</th>			
		</tr>

		<tr>
			<th>Grand Total</th>
			<th>'.$report->grand_total.'</th>			
		</tr>

		<tr>
			<th>Paid Amount</th>
			<th>'.$report->paid.'</th>			
		</tr>

		<tr>
			<th>Due Amount</th>
			<th>'.$report->due.'</th>			
		</tr>
	</tbody>
</table>
 ';
        }
echo $table;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order_data=Order::whereorder_id($id)->first()->toArray();
        // $item_list=DB::select('select product_id, quantity, rate, total from order_item where order_id = ?', [$id]);
        $item_list=DB::table('order_item')->whereorder_id($id)->get()->toArray();
        $products_data=Product::all()->toArray();
        // dd($item_list);
        return view('editOrders', compact('order_data','item_list','products_data'));
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
        dd($id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function orderDelete($id)
    {
        // dd($id);
        $order=Order::whereorder_id($id)->delete();
        return redirect()->back();
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
