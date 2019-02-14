@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
        <div class="col-md-12">
    
            <ol class="breadcrumb">
              <li><a href="">Home</a></li>		  
              <li class="active">Customer</li>
            </ol>
    
            <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="page-heading"> <i class="glyphicon glyphicon-edit"></i> Manage Customer</div>
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
                        <button class="btn btn-default button1" data-toggle="modal" data-target="#addCustomerModel"> <i class="glyphicon glyphicon-plus-sign"></i> Add Customer </button>
                    </div> <!-- /div-action -->		

                    <p> Show/Hide Column: </p>
                    <div style="padding-bottom:20px">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default toggle-vis" data-column="1">
                                <input type="checkbox">Customer Name
                              </label>
                              <label class="btn btn-default toggle-vis" data-column="2">
                                  <input type="checkbox">Contact
                              </label>
                              <label class="btn btn-default toggle-vis" data-column="3">
                                  <input type="checkbox">Total Purchase
                              </label>
                              <label class="btn btn-default toggle-vis" data-column="4">
                                <input type="checkbox">Total Due
                            </label>
                            <label class="btn btn-default toggle-vis" data-column="5">
                                <input type="checkbox">Total Paid
                            </label>
                            <label class="btn btn-default toggle-vis" data-column="6">
                                <input type="checkbox">Options
                            </label>
                          </div>
                    </div>

                    <table class="table table-condensed table-hover" id="manageCustomerTable">
                        <thead>
                            <tr>
                                <th>#</th>							
                                <th><input type="text" id="customer_name" class="form-control input-sm" placeholder="Name" autocomplete="off"></th>
                                <th><input type="text" id="customer_contact" class="form-control input-sm" placeholder="Contact" autocomplete="off"></th>
                                <th>Total Purchase</th>
                                <th>Due</th>
                                <th>Paid</th>
                                <th style="width:15%;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($customer_list as $customer)
                            <tr>
                                <td></td>
                                <td>{{$customer->customer_name}}</td>
                                <td>{{$customer->contact}}</td>
                                <td>{{$customer->total_purchase}}</td>
                                <td>{{$customer->total_due}}</td>
                                <td>{{$customer->total_paid}}</td>
                                <td><!-- Single button -->
                                    <div class="btn-group">
                                      <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Action <span class="caret"></span>
                                      </button>
                                      <ul class="dropdown-menu">
                                        <li>
                                            <a type="button" data-toggle="modal" data-target="#editCustomerModel" data-id="{{$customer->id}}" data-name="{{$customer->customer_name}}" data-contact="{{$customer->contact}}" > 
                                            <i class="glyphicon glyphicon-edit"></i> Edit</a>
                                        </li>
                                        <li>   
                                            <a class="delete" href="{{route('customerDelete',$customer->id)}}" type="button" > <i class="glyphicon glyphicon-trash"></i> Remove</a>    
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
    {{-- <div class="row">
        <div class="col-md-6 col-md-offset-5">
            {{$customer->render()}}
        </div>
    </div> --}}
</div> <!-- container -->
                    
<!-- EDIT MODAL -->
<div class="modal fade" id="editCustomerModel" tabindex="-1" role="dialog" aria-labelledby="editCustomerModel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('customer.update')}}" class="form-horizontal" method="post" id="submitcustomerForm">
                    {{csrf_field()}}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="editcustomerModelLabel"><i class="fa fa-plus"></i> Edit customer</h4>
                    </div>
    
                    <div class="modal-body customer">
                        <div class="form-group">
                            <input type="hidden" name="id" id="id">
                            <label for="editcustomerName" class="col-sm-3 control-label">Customer Name: </label>
                            <label class="col-sm-1 control-label">: </label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="name" name="customer_name" required>
                            </div>
                        </div>
                        <div class="form-group">
                                <input type="hidden" name="contact" id="contact">
                                <label for="editcustomerContact" class="col-sm-3 control-label">Contact: </label>
                                <label class="col-sm-1 control-label">: </label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" id="contact" name="contact" required>
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

