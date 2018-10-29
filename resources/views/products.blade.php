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
    
                    <div class="div-action" style="padding-bottom:20px;">
                        <button class="btn btn-default button1" data-toggle="modal" id="addProductModalBtn" data-target="#addProductModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Product </button>
                    </div> <!-- /div-action -->				
                    
                    <table class="table" id="product_table">
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
                                    <td>{{$product->brands->brand_name}}</td>
                                    <td>{{$product->categories->category_name}}</td>
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
                                            <li>
                                                <a type="button" data-toggle="modal" id="editProductModalBtn" data-target="#editProductModal" 
                                                data-image="{{$product->product_image}}"
                                                data-id="{{$product->product_id}}" 
                                                data-name="{{$product->product_name}}" 
                                                data-code="{{$product->product_code}}" 
                                                data-quantity="{{$product->product_quantity}}" 
                                                data-rate="{{$product->product_rate}}" 
                                                data-brand_id="{{$product->brand_id}}" 
                                                data-category_id="{{$product->category_id}}" 
                                                data-status="{{$product->product_status}}"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                                            <li>
                                                {{-- {!! Form::open(['method'=>'DELETE', 'class'=>'delete','action'=>['ProductController@destroy',$product->product_id]]) !!}
                                                {!!Form::submit('Delete',['class'=>'btn btn-danger btn-sm']) !!}
                                                {!!Form::close()!!} --}}
                                                <a class="delete" href="{{route('productDelete',$product->product_id)}}" type="button"> <i class="glyphicon glyphicon-trash"></i> Remove</a>    
                                            </li>       
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
                            {!! Form::file('product_image',null,['class'=>'form-control','required'=>'true'])!!}  
                    </div> <!-- /form-group-->	     	           	       
      
                <div class="form-group">
                        {!! Form::label('Product Name','Product Name:')!!}
                        {!! Form::text('product_name',null,['class'=>'form-control','required'=>'true'])!!}
                </div> <!-- /form-group-->	    

                <div class="form-group">
                        {!! Form::label('Product Code','Product Code:')!!}
                        {!! Form::text('product_code',null,['class'=>'form-control','required'=>'true'])!!}
                </div> <!-- /form-group-->
      
                <div class="form-group">
                        {!! Form::label('Quantity','Quantity:')!!}
                        {!! Form::number('product_quantity',null,['class'=>'form-control','required'=>'true'])!!}
                </div> <!-- /form-group-->	        	 
      
                <div class="form-group">
                        {!! Form::label('Rate','Rate:')!!}
                        {!! Form::number('product_rate',null,['class'=>'form-control','required'=>'true'])!!}
                </div> <!-- /form-group-->	     	        
      
                <div class="form-group">
                        {!! Form::label('Brand Name','Brand:')!!}
                        {!! Form::select('brand_id',[''=>'Choose Brand'] + $brands ,null,['class'=>'form-control','required'=>'true'])!!} 
                </div> <!-- /form-group-->
      
                <div class="form-group">
                        {!! Form::label('Category Name','Category:')!!}
                        {!! Form::select('category_id',[''=>'Choose Category'] + $categories ,null,['class'=>'form-control','required'=>'true'])!!} 
                </div> <!-- /form-group-->					        	         	       
      
                <div class="form-group">
                        {!! Form::label('Status','Status:')!!}
                        {!! Form::select('product_status',[''=>'~~SELECT~~','1' => 'Available', '2' => 'Not Available'],null,['class'=>'form-control','required'=>'true'])!!}
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


<!-- edit product modal -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Product</h4>
            </div>
            <div class="modal-body" style="max-height:450px; overflow:auto;">
                <div class="div-result">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li>
                      <li role="presentation"><a href="#productInfo" aria-controls="profile" role="tab" data-toggle="tab">Product Info</a></li>    
                    </ul>
  
                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="photo">
                          <form action="{{route('product.update')}}" method="POST" id="updateProductImageForm" class="form-horizontal" enctype="multipart/form-data">
                            <br />
                          <div id="edit-product Photo-messages"></div>
  
                          <div class="form-group">
                          <label for="editProductImage" class="col-sm-3 control-label">Edit the Image: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">		   
                                <img src="" id="getProductImage" class="thumbnail img-responsive"/>
                            </div>
                            </div> <!-- /form-group-->
                            
                            
                          </form>
                        <!-- /form -->
                      </div>
                      <!-- product image -->


                      <div role="tabpanel" class="tab-pane" id="productInfo">
                            <form class="form-horizontal" id="editProductForm" action="{{route('product.update')}}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}<br />
                                <div id="edit-product-messages"></div>
                                <!-- /form-group-->
                                <div class="form-group">
                                        <label for="editProductImage" class="col-sm-3 control-label">Select Photo: </label>
                                        <label class="col-sm-1 control-label">: </label>
                                        <div class="col-sm-8">
                                            <!-- the avatar markup -->
                                            <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>
                                            <div class="kv-avatar center-block">
                                                <input type="file" id="editProductImage" placeholder="Product Name" name="product_image" class="file-loading" style="width:auto;" />
                                            </div>
                                
                                        </div>
                                    </div>

                                <div class="form-group">
                                        <input type="hidden" id="id" name="id">
                                    <label for="editProductName" class="col-sm-3 control-label">Product Name: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="name" placeholder="Product Name" name="product_name" autocomplete="off">
                                    </div>
                                </div>
                                <!-- /form-group-->
                            
                                <div class="form-group">
                                    <label for="editProductCode" class="col-sm-3 control-label">Product Code: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="code" placeholder="Product Code" name="product_code" autocomplete="off">
                                    </div>
                                </div>
                                <!-- /form-group-->
                            
                                <div class="form-group">
                                    <label for="editQuantity" class="col-sm-3 control-label">Quantity: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="quantity" placeholder="Quantity" name="product_quantity" autocomplete="off">
                                    </div>
                                </div>
                                <!-- /form-group-->
                            
                                <div class="form-group">
                                    <label for="editRate" class="col-sm-3 control-label">Rate: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" id="rate" placeholder="Rate" name="product_rate" autocomplete="off">
                                    </div>
                                </div>
                                <!-- /form-group-->
                            
                                <div class="form-group">
                                    <div class="col-sm-3 control-label">
                                        {!! Form::label('brand_id','Brand:')!!}
                                    </div>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-md-8">
                                        {!! Form::select('brand_id',[''=>'Choose Category'] + $brands ,null,['class'=>'form-control'])!!}
                                    </div>
                                </div>
                                <!-- /form-group-->
                            
                                <div class="form-group">
                                    <div class="col-sm-3 control-label">
                                        {!! Form::label('category_id','Category:')!!}
                                    </div>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-md-8">
                                        {!! Form::select('category_id',[''=>'Choose Category'] + $categories ,null,['class'=>'form-control'])!!}
                                    </div>
                                </div>
                                <!-- /form-group-->
                            
                                <div class="form-group">
                                    <label for="editProductStatus" class="col-sm-3 control-label">Status: </label>
                                    <label class="col-sm-1 control-label">: </label>
                                    <div class="col-sm-8">
                                        <select class="form-control" id="status" name="product_status">
                                            <option value="">~~SELECT~~</option>
                                            <option value="1">Available</option>
                                            <option value="2">Not Available</option>
                                        </select>
                                    </div>
                                </div>
                                <!-- /form-group-->
                            
                                <div class="modal-footer editProductFooter">
                                    <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                            
                                    <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                                </div>
                                <!-- /modal-footer -->
                            </form>
                            <!-- /.form -->				     	
                      </div>    
                      <!-- /product info -->
                    </div>
                  </div>
            </div> <!-- /modal-body -->
      </div>
      <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
  </div>
<!-- edit categories brand -->

@endsection