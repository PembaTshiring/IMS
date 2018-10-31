@extends('layouts.app')

@section('content')
<div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
        
                <i class="glyphicon glyphicon-plus-sign"></i> Manage Order
        
            </div>
            <!--/panel-->
            
            <div class="panel-body">
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
                    @endif
                    <table class="table" id="manageOrderTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Date</th>
                                    <th>Client Name</th>
                                    <th>Contact</th>
                                    <th>Total Order Item</th>
                                    <th>Payment Status</th>
                                    <th>Option</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php 
                                $x=0; 
                                @endphp
                                @foreach ($orders as $order)                                  
                                <tr>
                                    <td></td>
                                    <td>{{$order->order_date}}</td>
                                    <td>{{$order->client_name}}</td>
                                    <td>{{$order->client_contact}}</td>
                                    <td>{{$item_count["$x"]}}</td>
                                    @if ($order->payment_status==1)
                                    <td><label class="label label-success">Full Payment</label></td>
                                    @elseif($order->payment_status==2)
                                    <td><label class="label label-info">Advance Payment</label></td>
                                    @else
                                    <td><label class="label label-warning">No Payment</label></td>
                                    @endif
                                    <td>
                                        <!-- Single button -->
                                        <div class="btn-group">
                                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Action <span class="caret"></span>
                                          </button>
                                          <ul class="dropdown-menu">
                                            <li><a href="{{route('orders.edit',$order->order_id)}}" id="editOrderModalBtn"> <i class="glyphicon glyphicon-edit"></i> Edit</a></li>
                                            
                                            <li><a type="button" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" data-due="{{$order->due}}" data-id="{{$order->order_id}}"> <i class="glyphicon glyphicon-save"></i> Payment</a></li>

                                            <li><a type="button" onclick="printOrder({{$order->order_id}})"> <i class="glyphicon glyphicon-print"></i> Print </a></li>
                                            
                                            
                                            <li><a href="{{route('orderDelete',$order->order_id)}}" type="button"> <i class="glyphicon glyphicon-trash"></i> Remove</a></li>       
                                          </ul>
                                        </div>
                                    </td>
                                </tr>
                                @php
                                $x++;
                                @endphp
                                @endforeach
                            </tbody>
                        </table>
            </div>
        </div>
</div>
<div class="modal fade in" tabindex="-1" role="dialog" id="paymentOrderModal" style="display: none; padding-left: 17px;">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
                <form action="{{route('payment.update')}}" class="form-horizontal" method="post">
                        {{csrf_field()}}
                        
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
              <h4 class="modal-title"><i class="glyphicon glyphicon-edit"></i> Edit Payment</h4>
            </div>      
      
            <div class="modal-body form-horizontal" style="max-height:500px; overflow:auto;">
      
                <div class="paymentOrderMessages"></div>
      
                                                       
                    <div class="form-group">
                        <input type="hidden" name="id" id="id">
                      <label for="due" class="col-sm-3 control-label">Due Amount</label>
                      <div class="col-sm-9">
                        <input type="text" class="form-control" id="due" name="due" disabled="true">					
                      </div>
                    </div> <!--/form-group-->		
                    <div class="form-group">
                      <label for="payAmount" class="col-sm-3 control-label">Pay Amount</label>
                      <div class="col-sm-9">
                        <input type="number" class="form-control" id="payAmount" name="payAmount" max="">					      
                      </div>
                    </div> <!--/form-group-->		
                    <div class="form-group">
                      <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="paymentType" id="paymentType" required>
                            <option value="">~~SELECT~~</option>
                            <option value="1">Cheque</option>
                            <option value="2">Cash</option>
                            <option value="3">Credit Card</option>
                        </select>
                      </div>
                    </div> <!--/form-group-->							  
                    <div class="form-group">
                      <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
                      <div class="col-sm-9">
                        <select class="form-control" name="paymentStatus" id="paymentStatus" required>
                            <option value="">~~SELECT~~</option>
                            <option value="1">Full Payment</option>
                            <option value="2">Advance Payment</option>
                            <option value="3">No Payment</option>
                        </select>
                      </div>
                    </div> <!--/form-group-->							  				  
                        
            </div> <!--/modal-body-->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                <button type="submit" class="btn btn-primary" id="updatePaymentOrderBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save changes</button>	
            </div>        
        </form>   
    </div><!-- /.modal-dialog -->
</div><!-- /.modal-content -->
</div>


@endsection