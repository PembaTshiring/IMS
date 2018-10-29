@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-md-12">
    
            <ol class="breadcrumb">
              <li><a href="">Home</a></li>		  
              <li class="active">Category</li>
            </ol>
    
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Categories</div>
                </div> <!-- /panel-heading -->
                <div class="panel-body">
    
                    <div class="remove-messages"></div>
    
                    <div class="div-action" style="padding-bottom:20px;">
                        <button class="btn btn-default button1" data-toggle="modal" id="addCategoriesModalBtn" data-target="#addCategoriesModal"> <i class="glyphicon glyphicon-plus-sign"></i> Add Categories </button>
                    </div> <!-- /div-action -->				
                    
                    <table class="table" id="manageCategoriesTable">
                        <thead>
                            <tr>							
                                <th>Categories Name</th>
                                <th>Status</th>
                                <th style="width:15%;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                                @foreach ($categories as $category)
                            <tr>
                                <td>{{$category->category_name}}</td>
                                
                                @if ($category->category_status==1)
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
                                            <a type="button" data-toggle="modal" data-target="#editcategoryModel" data-id="{{$category->category_id}}" data-name="{{$category->category_name}}" data-status="{{ $category->category_status }}"> 
                                            <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                        </li>
                                        <li>   
                                            {{-- {!! Form::open(['method'=>'DELETE', 'class'=>'delete','action'=>['CategoryController@destroy',$category->category_id]]) !!}
                                            {!!Form::submit('Delete',['class'=>'btn btn-danger btn-sm']) !!}
                                            {!!Form::close()!!} --}}
                                            <a class="delete" href="{{route('categoryDelete',$category->category_id)}}" type="button"> <i class="glyphicon glyphicon-trash"></i> Remove</a>
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

<!-- Add modal -->
<div class="modal fade in" id="addCategoriesModal" tabindex="-1" role="dialog" >
        <div class="modal-dialog">
          <div class="modal-content">
                <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="addcategoryModelLabel"><i class="fa fa-plus"></i> Add category</h4>
                      </div>
                <div class="modal-body">
                        {!! Form::open(['method' => 'POST', 'action'=>'CategoryController@store']) !!}
                        <div class="form-group">
                            {!! Form::label('Category Name','Category Name:')!!}
                            {!! Form::text('category_name',null,['class'=>'form-control','required'=>'true'])!!}    
                            </div>
                        
                            <div class="form-group">
                                {!! Form::label('status','Status:')!!}
                                {!! Form::select('category_status',[''=>'Choose Category','1'=>'Available','2'=>'Not Available'],null,['class'=>'form-control','required'=>'true'])!!}    
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      {!!Form::submit('Save Changes',['class'=>'btn btn-primary']) !!}
                    </div>
                    {!!Form::close()!!}
          </div> <!-- /modal-content -->    
        </div> <!-- /modal-dailog -->
      </div>
<!-- add modal -->

<!-- EDIT MODAL -->
<div class="modal fade" id="editcategoryModel" tabindex="-1" role="dialog" aria-labelledby="editcategoryModelLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('category.update')}}" class="form-horizontal" method="post">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="editcategoryModelLabel"><i class="fa fa-plus"></i> Edit Brand</h4>
                    </div>
    
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id">
                            <label for="editcategoryName" class="col-sm-3 control-label">category Name: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="category_name" required >
                            </div>
                        </div>
    
                        <div class="form-group">
                            <label for="editcategorystatus" class="col-sm-3 control-label">Status: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <select class="form-control" id="status" name="category_status" required>
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
