<?php

namespace App\Http\Controllers;
use App\Customer;
use App\Order;
use Illuminate\Http\Request;
use Session;
use Illuminate\Support\Facades\DB;


class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customer_list=Customer::all();
        // dd($customer_list);
        return view('customer',compact('customer_list'));
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

    }

    public function customerUpdate(Request $request)
    {
       
       $customer = Customer::find($request->id);
       $order_client_update=Order::where('client_name',$customer->customer_name);
       $order_client_update->update([
            'client_name' => $request->customer_name,
            'client_contact' => $request->contact,
        ]);
    
       $customer->customer_name=$request->customer_name;
       $customer->contact=$request->contact;
       $customer->save();
    
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
        $customer=Customer::whereid($id)->delete();
        Session::flash('delete','Customer Successfully Deleted');
        return redirect()->back();
    }
}
