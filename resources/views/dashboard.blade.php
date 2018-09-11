@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6" class="dashboard-link">
            <a href="{{route('products.index')}}"><div class="panel panel-success">
                <div class="panel-heading">
                <h1 class="text-center">30</h1>
                </div>
                <div>
                <h2 class="text-center">Total Products</h2>
                </div>
            </div></a>
        </div>
        <div class="col-md-6">
            <a href="{{route('orders.index')}}"><div class="panel panel-info">
                <div class="panel-heading">
                <h1 class="text-center">3</h1>
                </div>
                <div>
                <h2 class="text-center">Total Orders</h2>
                </div>
            </div>
            </a>
        </div>
        <div class="col-md-6">
            <a href="{{route('products.index')}}"><div class="panel panel-danger">
                <div class="panel-heading">
                <h1 class="text-center">1</h1>
                </div>
                <div>
                <h2 class="text-center">Low Stock</h2>
                </div>
            </div></a>
        </div>
        <div class="col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading">
                <h1 class="text-center">Rs. 3000</h1>
                </div>
                <div>
                <h2 class="text-center">Total Revenue</h2>
                </div>
            </div>
        </div>    
    </div>
</div>

@endsection
