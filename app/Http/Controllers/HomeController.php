<?php

namespace App\Http\Controllers;
use App\Product;
use App\Order;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products=Product::all()->count();
        $orders=Order::all()->count();
        return view('dashboard',compact('products','orders'));
    }
}
