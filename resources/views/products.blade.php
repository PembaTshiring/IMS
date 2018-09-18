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
                                <th>Product Code</th>
                                <th>Rate</th>							
                                <th>Quantity</th>
                                <th>Brand</th>
                                <th>Category</th>
                                <th>Status</th>
                                <th style="width:15%;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td><img height="50" src="{{$product->product_image ? 'images/'.$product->product_image :'https://via.placeholder.com/400x400'}} " alt="" srcset=""></td>							
                                    <td>{{$product->product_name}}</td>
                                    <td>{{$product->product_code}}</td>
                                    <td>{{$product->product_rate}}</td>							
                                    <td>{{$product->product_quantity}}</td>
                                    <td>{{$product->brand_id}}</td>
                                    <td>{{$product->category_id}}</td>
                                    @if ($product->product_status==1)
                                        <td><label class="label label-success">Available</label></td>
                                    @else
                                        <td><label class="label label-danger">Not Available</label></td>
                                    @endif
                                    <td>
                                    <div class="btn-group">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action <span class="caret"></span>
                                    </button>
                                        <ul class="dropdown-menu">
                                            <li><a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                                            <li><a type="button" data-toggle="modal" data-target="#removeProductModal" id="removeProductModalBtn"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <!-- /table -->
    
                </div> <!-- /panel-body -->
            </div> <!-- /panel -->		
        </div> <!-- /col-md-12 -->
    </div> <!-- /row -->
</div>
    

<!-- add product -->
<div class="modal fade" id="addProductModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
          <div class="modal-content">
                {!! Form::open(['method'=>'POST','action'=>'ProductController@store', 'files'=>true]) !!}
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"><i class="fa fa-plus"></i> Add Product</h4>
                </div>
      
                <div class="modal-body" style="max-height:450px; overflow:auto;">
      
                    <div id="add-product-messages"></div>
                        
                    <div class="form-group">
                            {!! Form::label('product_image','Name:')!!}
                            {!! Form::file('product_image',null,['class'=>'form-control'])!!}  
                    </div> <!-- /form-group-->	     	           	       
      
                <div class="form-group">
                        {!! Form::label('Product Name','Product Name:')!!}
                        {!! Form::text('product_name',null,['class'=>'form-control'])!!}
                </div> <!-- /form-group-->	    

                <div class="form-group">
                        {!! Form::label('Product Code','Product Code:')!!}
                        {!! Form::text('product_code',null,['class'=>'form-control'])!!}
                </div> <!-- /form-group-->
      
                <div class="form-group">
                        {!! Form::label('Quantity','Quantity:')!!}
                        {!! Form::text('product_quantity',null,['class'=>'form-control'])!!}
                </div> <!-- /form-group-->	        	 
      
                <div class="form-group">
                        {!! Form::label('Rate','Rate:')!!}
                        {!! Form::text('product_rate',null,['class'=>'form-control'])!!}
                </div> <!-- /form-group-->	     	        
      
                <div class="form-group">
                        {!! Form::label('Brand Name','Brand:')!!}
                        {!! Form::select('brand_id',[''=>'Choose Brand'] + $brands ,null,['class'=>'form-control'])!!} 
                </div> <!-- /form-group-->
      
                <div class="form-group">
                        {!! Form::label('Category Name','Category:')!!}
                        {!! Form::select('category_id',[''=>'Choose Category'] + $categories ,null,['class'=>'form-control'])!!} 
                </div> <!-- /form-group-->					        	         	       
      
                <div class="form-group">
                        {!! Form::label('Status','Status:')!!}
                        {!! Form::select('product_status',[''=>'~~SELECT~~','1' => 'Available', '2' => 'Not Available'],null,['class'=>'form-control'])!!}
                </div> <!-- /form-group-->	         	        
                
            </div> <!-- /modal-body -->
                
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                  
                  {!!Form::submit('Save Changes',['class'=>'btn btn-primary']) !!}
                </div> <!-- /modal-footer -->	      
                <!-- /.form -->	     
          </div> <!-- /modal-content -->    
        </div> <!-- /modal-dailog -->
      </div> 
      <!-- /add categories -->
      <!--Add modal -->      

@endsection