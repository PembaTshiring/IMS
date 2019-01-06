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
                    @if(Session::has('store'))
                    <div class="alert alert-success alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong><i class="glyphicon glyphicon-ok-sign"></i></strong>
                            {{session('store')}}
                    </div>
                    @elseif(Session::has('delete'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong><i class="glyphicon glyphicon-ok-sign"></i></strong>
                            {{session('delete')}}
                    </div>
                    @elseif(Session::has('data_exists'))
                    <div class="alert alert-danger alert-dismissible" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <strong><i class="glyphicon glyphicon-ok-sign"></i></strong>
                            {{session('data_exists')}}
                    </div>
                    @endif
                    <div class="div-action" style="padding-bottom:20px;">
                        <button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Brand </button>
                    </div> <!-- /div-action -->		
                    Show/Hide Column:		
                    <div style="padding-bottom:20px"> 
                        <div class="btn-group" role="group" aria-label="...">
                        <button type="button" class="btn btn-default toggle-vis" data-column="1">Brand Name</button><button type="button" class="btn btn-default toggle-vis" data-column="2">Status</button><button type="button" class="btn btn-default toggle-vis" data-column="3">Option</button>
                        </div>        
                    </div>
                    
                    <table class="table table-condensed table-hover" id="manageBrandTable">
                        <thead>
                            <tr>
                                <th>#</th>							
                                <th>Brand Name</th>
                                <th>Status</th>
                                <th style="width:15%;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($brands as $brand)
                            <tr>
                                <td></td>
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
                                        <li>
                                            <a type="button" data-toggle="modal" data-target="#editBrandModel" data-id="{{$brand->brand_id}}" data-name="{{$brand->brand_name}}" data-status="{{ $brand->brand_status }}"> 
                                            <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                        </li>
                                        <li>   
                                            {{-- {!! Form::open(['method'=>'DELETE', 'class'=>'delete','action'=>['BrandController@destroy',$brand->brand_id]]) !!}
                                            {!!Form::submit('Delete',['class'=>'btn btn-danger btn-sm']) !!}
                                            {!!Form::close()!!} --}}
                                            <a class="delete" href="{{route('brandDelete',$brand->brand_id)}}" type="button" > <i class="glyphicon glyphicon-trash"></i> Remove</a>    
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
    <div class="row">
        <div class="col-md-6 col-md-offset-5">
            {{$brands->render()}}
        </div>
    </div>
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
                {!! Form::text('brand_name',null,['class'=>'form-control','required'=>'true','id'=>'brandName'])!!}    
                </div>
            
                <div class="form-group">
                    {!! Form::label('status','Status:')!!}
                    {!! Form::select('brand_status',[''=>'Choose Category','1'=>'Available','2'=>'Not Available'],null,['class'=>'form-control','required'=>'true'])!!}    
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
    <div class="modal fade" id="editBrandModel" tabindex="-1" role="dialog" aria-labelledby="editBrandModelLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('brand.update')}}" class="form-horizontal" method="post" id="submitBrandForm">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="editBrandModelLabel"><i class="fa fa-plus"></i> Edit Brand</h4>
                    </div>
    
                    <div class="modal-body brand">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id">
                            <label for="editBrandName" class="col-sm-3 control-label">Brand Name: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="brand_name" required>
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="editBrandStatus" class="col-sm-3 control-label">Status: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="status" name="brand_status" required>
                                    <option value="">~~SELECT~~</option>
                                    <option value="1">Available</option>
                                    <option value="2">Not Available</option>
                                </select>
                            </div>
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- EDIT MODAL -->



@endsection

