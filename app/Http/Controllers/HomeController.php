<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Product;
use App\Order;
use Illuminate\Support\Facades\DB;

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
        $revenue=Order::sum('paid');
        $lowstock=Product::where('product_quantity','<=',100)->count();
        return view('dashboard',compact('products','orders','revenue','lowstock'));
    }
    public function editProfile(){
        return view('editProfile');
    }
    public function updateProfile(Request $req)
    {
        $this->validate($req, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'password_confirmation' => 'required|same:password'
        ]);
        $password=bcrypt($req->password);
        DB::update("update users set name ='$req->name', email='$req->email', password='$password'  where id = ?", ['1']);
        return redirect()->back()->withInput();
    }
}
