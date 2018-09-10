@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="col-md-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            
                            <a href="" style="text-decoration:none;color:black;">
                                Total Product
                                <span class="badge pull pull-right">1</span>	
                            </a>
                            
                        </div> <!--/panel-hdeaing-->
                    </div> <!--/panel-->
                </div> <!--/col-md-4-->
            
                    <div class="col-md-4">
                        <div class="panel panel-info">
                        <div class="panel-heading">
                            <a href="" style="text-decoration:none;color:black;">
                                Total Orders
                                <span class="badge pull pull-right">1</span>
                            </a>
                                
                        </div> <!--/panel-hdeaing-->
                    </div> <!--/panel-->
                    </div> <!--/col-md-4-->
            
                <div class="col-md-4">
                    <div class="panel panel-danger">
                        <div class="panel-heading">
                            <a href="" style="text-decoration:none;color:black;">
                                Low Stock
                                <span class="badge pull pull-right">1</span>	
                            </a>
                            
                        </div> <!--/panel-hdeaing-->
                    </div> <!--/panel-->
                </div> <!--/col-md-4-->
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-4">
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
