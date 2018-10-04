@extends('layouts.app')

@section('content')
<div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
        
                <i class="glyphicon glyphicon-plus-sign"></i> Manage Order
        
            </div>
            <!--/panel-->
            <div class="panel-body">
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
                                            
                                            <li><a type="button" data-toggle="modal" id="paymentOrderModalBtn" data-target="#paymentOrderModal" onclick="paymentOrder()"> <i class="glyphicon glyphicon-save"></i> Payment</a></li>
                                    
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

@endsection