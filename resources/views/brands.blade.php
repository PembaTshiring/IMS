@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-md-12">
    
            <ol class="breadcrumb">
              <li><a href="">Home</a></li>		  
              <li class="active">Brand</li>
            </ol>
    
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Brand</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body">
    
                    <div class="remove-messages"></div>
    
                    <div class="div-action pull pull-right" style="padding-bottom:20px;">
                        <button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Brand </button>
                    </div> <!-- /div-action -->				
                    
                    <table class="table" id="manageBrandTable">
                        <thead>
                            <tr>							
                                <th>Brand Name</th>
                                <th>Status</th>
                                <th style="width:15%;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                            <tr>
                                <td>{{$brand->brand_name}}</td>
                                
                                @if ($brand->brand_status==1)
                                <td><label class="label label-success">Available</label></td>
                                @else
                                <td><label class="label label-danger">Not Available</label></td>
                                @endif
                                
                                <td><!-- Single button -->
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu">
                                        <li><a type="button" data-toggle="modal" data-target="#editBrandModel{{$brand->id}}"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                                        <li><a type="button" data-toggle="modal" data-target="#removeMemberModal"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
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
</div> <!-- container -->


<!-- ADD MODAL -->
<div class="modal fade" id="addBrandModel" tabindex="-1" role="dialog" aria-labelledby="addBrandModelLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="addBrandModelLabel"><i class="fa fa-plus"></i> Add Brand</h4>
        </div>

        <div class="modal-body">
            {!! Form::open(['method' => 'POST', 'action'=>'BrandController@store']) !!}
            <div class="form-group">
                {!! Form::label('Brand Name','Brand Name:')!!}
                {!! Form::text('brand_name',null,['class'=>'form-control','required'=>'true'])!!}    
                </div>
            
                <div class="form-group">
                    {!! Form::label('status','Status:')!!}
                    {!! Form::select('brand_status',[''=>'Choose Category','1'=>'Available','2'=>'Not Available'],null,['class'=>'form-control'])!!}    
                </div>
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          {!!Form::submit('Save Changes',['class'=>'btn btn-primary']) !!}
        </div>
        {!!Form::close()!!}

      </div>
    </div>
  </div>
<!-- ADD MODAL -->

<!-- EDIT MODAL -->
<div class="modal fade" id="editBrandModel{{$brand->id}}" tabindex="-1" role="dialog" aria-labelledby="editBrandModelLabel">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="editBrandModelLabel"><i class="fa fa-plus"></i> Edit Brand</h4>
            </div>
    
            <div class="modal-body">
                {!! Form::model($brand,['method' => 'PATCH', 'action'=>['BrandController@update',$brand->id]]) !!}
                <div class="form-group">
                    {!! Form::label('Brand Name','Brand Name:')!!}
                    {!! Form::text('brand_name',null,['class'=>'form-control','required'=>'true'])!!}    
                    </div>
                
                    <div class="form-group">
                        {!! Form::label('status','Status:')!!}
                        {!! Form::select('brand_status',[''=>'Choose Category','1'=>'Available','2'=>'Not Available'],null,['class'=>'form-control'])!!}    
                    </div>
                
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            {!!Form::submit('Save Changes',['class'=>'btn btn-primary']) !!}
            </div>
            {!!Form::close()!!}
    
        </div>
        </div>
    </div>
<!-- EDIT MODAL -->


<!-- DELETE MODAL -->

<!-- DELETE MODAL -->



@endsection

