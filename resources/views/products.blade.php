@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-md-12">
    
            <ol class="breadcrumb">
              <li><a href="">Home</a></li>		  
              <li class="active">Product</li>
            </ol>
    
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Product</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body">
    
                    <div class="remove-messages"></div>
    
                    <div class="div-action pull pull-right" style="padding-bottom:20px;">
                        <button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Product </button>
                    </div> <!-- /div-action -->				
                    
                    <table class="table" id="manageProductTable">
                        <thead>
                            <tr>
                                <th style="width:10%;">Photo</th>							
                                <th>Product Name</th>
                                <th>Product ID</th>
                                <th>Rate</th>							
                                <th>Quantity</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th style="width:15%;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                                <tr>
                                <td style="width:10%;">Photo</th>							
                                <td>Product Name</td>
                                <td>Product ID</td>
                                <td>Rate</td>							
                                <td>Quantity</td>
                                <td>Brand</td>
                                <td>Category</td>
                                <td>Status</td>
                                    <td><!-- Single button -->
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <span class="caret"></span>
                                          </button>
                                          <ul class="dropdown-menu">
                                            <li><a type="button" data-toggle="modal" data-target="#editBrandModel" onclick="editBrands(11)"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                                            <li><a type="button" data-toggle="modal" data-target="#removeMemberModal" onclick="removeBrands(11)"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
                                          </ul>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                    </table>
                    <!-- /table -->
    
                </div> <!-- /panel-body -->
            </div> <!-- /panel -->		
        </div> <!-- /col-md-12 -->
    </div> <!-- /row -->
</div>
    

    
@endsection
