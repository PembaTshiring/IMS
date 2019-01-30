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
                    
                    <p> Show/Hide Column: </p>
                    <div style="padding-bottom:20px">
                          <div class="btn-group" data-toggle="buttons">
                            <label class="btn btn-default toggle-vis" data-column="1">
                                <input type="checkbox">Order Date
                              </label>
                              <label class="btn btn-default toggle-vis" data-column="2">
                                  <input type="checkbox">Client Name
                              </label>
                              <label class="btn btn-default toggle-vis" data-column="3">
                                  <input type="checkbox">Phone Number
                              </label>
                              <label class="btn btn-default toggle-vis" data-column="4">
                                <input type="checkbox">Order items
                            </label>
                            <label class="btn btn-default toggle-vis" data-column="5">
                                <input type="checkbox">Status
                            </label>
                            <label class="btn btn-default toggle-vis" data-column="6">
                                <input type="checkbox">Option
                            </label>
                          </div>
                    </div>

                    <table class="table table-condensed table-hover" id="manageOrderTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Order Date</th>
                                    <th><input type="text" id="client_name" class="form-control input-sm" placeholder="Name" autocomplete="off"></th>
                                    <th><input type="text" id="client_contact" class="form-control input-sm" placeholder="Contact" autocomplete="off"></th>
                                    <th>Total Order Item</th>
                                    <th>
                                        <select name="status" id="payment_status" class="form-control">
                                            <option value="">Payment Status</option>
                                            <option value="Full Payment">Full Payment</option>
                                            <option value="Advance Payment">Advance Payment</option>
                                            <option value="No Payment">No Payment</option>
                                           </select>
                                    </th>
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
                                    <td class="details-control">
                                        <button class="btn btn-info btn-xs" onclick="test()">
                                            <b>Items : </b> {{$item_count["$x"]}} 
                                        </button>
                                        {{-- Item Id: @for ($y = 0; $y < $item_count["$x"]; $y++)
                                                {{$item_list["$y"]->product_id}}
                                            @endfor --}}
                                        
                                        <!-- Split button -->
                                        <div class="btn-group">
                                            <button type="button" class="btn btn btn-info btn-xs"><b>Items : </b> {{$item_count["$x"]}}</button>
                                            <button type="button" class="btn dropdown-toggle btn btn-info btn-xs" data-toggle="collapse" data-target="#extra_info{{$x}}" aria-haspopup="true" aria-expanded="false">
                                            <span class="caret"></span>
                                            </button>
                                        </div>
                                        
                                        <div id="extra_info{{$x}}" class="collapse">
                                            @for ($y = 0; $y < $item_count["$x"]; $y++)
                                                @foreach ($products_data as $product)
                                                @if($item_list["$y"]->product_id==$product['product_id'])
                                                   <li> {{$product['product_name']}} </li>
                                                @endif
                                                @endforeach
                                            @endfor
                                              
                                        </div>                                                 
                                    </td>
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