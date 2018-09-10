@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
            <div class="col-md-12">
    
                    <ol class="breadcrumb">
                      <li><a href="">Home</a></li>		  
                      <li>Order</li>
                      <li class="active">Manage Order</li>
                    </ol>
            
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Orders</div>
                        </div> <!-- /panel-heading -->
                        <div class="panel-body">
            
                            <div class="remove-messages"></div>
            
                            <div class="div-action pull pull-right" style="padding-bottom:20px;">
                                <button class="btn btn-default button1" data-toggle="modal" data-target="#addBrandModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Brand </button>
                            </div> <!-- /div-action -->				
                            
                            <table class="table" id="manageBrandTable">
                                <thead>
                                    <tr>							
                                        <th>#</th>
                                        <th>Order Date</th>
                                        <th>Client Name</th>
                                        <th>Contact</th>
                                        <th>Total Order Item</th>
                                        <th>Payment Status</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
    </div>
</div>
    

@endsection