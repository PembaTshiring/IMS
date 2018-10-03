@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6" class="dashboard-link">
            <div class="panel panel-success">
                <div class="panel-heading" style="background-color:#245580">
                <h1 class="text-center"><a href="{{route('products.index')}}" style="color:white; text-decoration:none;">{{$products}}</a></h1>
                </div>
                <div>
                <h2 class="text-center">Total Products</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading" style="background-color:#00a038">
                <h1 class="text-center"><a href="{{route('orders.index')}}" style="color:white; text-decoration:none;">{{$orders}}</a></h1>
                </div>
                <div>
                <h2 class="text-center">Total Orders</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading" style="background-color:#e94441">
                <h1 class="text-center"><a href="{{route('products.index')}}" style="color:white; text-decoration:none;">1</a></h1>
                </div>
                <div>
                <h2 class="text-center">Low Stock</h2>
                </div>
            </div>
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
