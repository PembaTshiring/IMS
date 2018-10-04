@extends('layouts.app') 
@section('content')
<div class="container">
    <div class="panel panel-default">
        <div class="panel-heading">

            <i class="glyphicon glyphicon-plus-sign"></i> Edit Order

        </div>
        <!--/panel-->
        <div class="panel-body">
            <form method="post" action="{{ action('OrderController@update',$order_data['order_id']) }}" class="form-horizontal">
            {{-- {!! Form::open($order_data,['method'=>'PATCH','action'=>['AdminPostsController@update',$order_data['order_id']],'class'=>'form-horizontal']) !!} --}}
            <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}" />
            <div class="form-group">
                {!! Form::label('date', 'Date', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('order_date',  $value = $order_data['order_date'], ['class' => 'form-control', 'id'=>'orderDate','autocomplete'=>'off' ]) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('client_name', 'Client Name', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('client_name', $value = $order_data['client_name'], ['class' => 'form-control', 'placeholder' => 'Client Name','autocomplete'=>'off']) !!}
                </div>
            </div>
            <div class="form-group">
                {!! Form::label('client_contact', 'Client Contact', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('client_contact', $value = $order_data['client_contact'], ['class' => 'form-control', 'placeholder' => 'Client Contact']) !!}
                </div>
            </div>
            <table class="table order-list" id="productTable">
                <thead>
                    <tr>
                        <th style="width:40%;">Product</th>
                        <th style="width:20%;">Rate</th>
                        <th style="width:15%;">Quantity</th>
                        <th style="width:15%;">Total</th>
                        <th style="width:10%;"></th>
                    </tr>
                </thead>
                <tbody>
                    @php 
                    $count=0;
                    $counter=1;
                    $x=1; 
                    @endphp
                    @while ($x <= count($item_list))
                    {{-- @for ($x = 0; $x < count($item_list); $x++)  --}}
                    <tr id='row{{$x}}' class={{$count}}>
                        <td>
                            <div class="form-group">
                                <div class="col-lg-10">
                                    {{-- {!! Form::select('product_name[]',[''=>'Choose Product'] + $products ,null,['class'=>'form-control','id'=>'selectedProduct1','onChange'=>"getProductData(1)"])!!} --}}
                                    <select class="form-control" name="product_name[]" onchange="getProductData({{$counter}})" id="selectedProduct{{$counter}}">
                                        {{-- @foreach ($item_list as $item) --}}
                                        <option value="">~~SELECT~~</option>
                                        {{-- @while ($row = count($products_data)) --}}
                                        @foreach ($products_data as $product)
                                        <option value="{{$product['product_id']}}" {{ $item_list[$count]->product_id == $product['product_id'] ? 'selected': '' }} >{{$product['product_name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="col-lg-10">
                                    {{-- {!! Form::text('rate[]',$value="$value", ['class' => 'form-control', 'disabled','id'=>"productRate$x",]) !!} --}}
                                    <input type="text" name="rate[]" id="productRate{{$counter}}" autocomplete="off" class="form-control" disabled="true" value={{$item_list[$count]->rate}}>
                                    <input type="hidden" name="rateValue[]" id="rateValue{{$counter}}" autocomplete="off" class="form-control" value="" />
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="col-lg-10">
                                    {!! Form::number('quantity[]', $value = $item_list[$count]->quantity, ['class' => 'form-control','min'=>'1','id'=>"productQuantity$counter",'onkeyup'=>"getTotal($counter)"]) !!}
                                </div>
                            </div>
                        </td>
                        <td>
                            <div class="form-group">
                                <div class="col-lg-10">
                                    {{-- {!! Form::text('total', $value = null, ['class' => 'form-control', 'disabled']) !!} --}}
                                    <input type="text" name="total[]" id="total{{$counter}}" autocomplete="off" class="form-control" disabled="true" value={{$item_list[$count]->total}} />
                                    <input type="hidden" name="totalValue[]" id="totalValue{{$counter}}" autocomplete="off" class="form-control" value={{$item_list[$count]->total}} />
                                </div>
                            </div>
                        </td>
                        <td>
                            <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow({{$counter}})"><i class="glyphicon glyphicon-trash"></i></button>
                            {{-- <button class="btn btn-default ibtnDel" type="button" id="ibtnDel"><i class="glyphicon glyphicon-trash"></i></button></i> --}}
                        </td>
                        </tr>
                        @php 
                        $count++;
                        $counter++;
                        $x++; 
                        @endphp 
                        @endwhile
                </tbody>
            </table>

            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('sub_amount', 'Sub Amount', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        {{-- {!! Form::text('sub_amount', $value = null, ['class' => 'form-control col-md-9','disabled']) !!} --}}
                        <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" value={{$order_data[ 'sub_total']}} />
                        <input type="hidden" class="form-control" id="subTotalValue" name="sub_total" value={{$order_data[ 'sub_total']}} />
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('vat', 'VAT 13%', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        {{-- {!! Form::text('vat', $value = null, ['class' => 'form-control col-md-9','disabled']) !!} --}}
                        <input type="text" class="form-control" id="vat" name="vat" disabled="true" value={{$order_data[ 'vat']}} />
                        <input type="hidden" class="form-control" id="vatValue" name="vat" value={{$order_data[ 'vat']}} />
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('total_amount', 'Total Amount', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        {{-- {!! Form::text('total_amount', $value = null, ['class' => 'form-control col-md-9','disabled']) !!} --}}
                        <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value={{$order_data[ 'total_amount']}} />
                        <input type="hidden" class="form-control" id="totalAmountValue" name="total_amount" value={{$order_data[ 'vat']}} />
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('discount', 'Discount', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        {{-- {!! Form::text('discount', $value = null, ['class' => 'form-control col-md-9']) !!} --}}
                        <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" min="0" autocomplete="off" value={{$order_data[ 'discount']}} />
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('grand_total', 'Grand Amount', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        {{-- {!! Form::text('grand_total', $value = null, ['class' => 'form-control col-md-9','disabled']) !!} --}}
                        <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" value={{$order_data[ 'grand_total']}} />
                        <input type="hidden" class="form-control" id="grandTotalValue" name="grand_total" value={{$order_data[ 'grand_total']}} />
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    {!! Form::label('paid', 'Paid Amount', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        {{-- {!! Form::text('paid', $value = null, ['class' => 'form-control col-md-9']) !!} --}}
                        <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" value={{$order_data[ 'paid']}} />
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('due', 'Due Amount', ['class' => 'col-lg-2 control-label']) !!}
                    <div class="col-lg-10">
                        {{-- {!! Form::text('due', $value = null, ['class' => 'form-control col-md-9','disabled']) !!} --}}
                        <input type="text" class="form-control" id="due" name="due" disabled="true" value={{$order_data[ 'due']}} />
                        <input type="hidden" class="form-control" id="dueValue" name="due" value={{$order_data[ 'due']}} />
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('payment_type', 'Payment Type', ['class' => 'col-lg-2 control-label'] ) !!}
                    <div class="col-lg-10">
                        <select class="form-control" name="payment_type" id="paymentType">
                            <option value="" {{ $order_data[ 'payment_type']=='' ? 'selected': '' }}>~~SELECT~~</option>
                            <option value="1" {{ $order_data[ 'payment_type']=='1' ? 'selected': '' }}>Cheque</option>
                            <option value="2" {{ $order_data[ 'payment_type']=='2' ? 'selected': '' }}>Cash</option>
                            <option value="3" {{ $order_data[ 'payment_type']=='3' ? 'selected': '' }}>Credit Card</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('payment_status', 'Payment Status', ['class' => 'col-lg-2 control-label'] ) !!}
                    <div class="col-lg-10">
                        <select class="form-control" name="payment_status" id="paymentStatus">
                            <option value="" {{ $order_data[ 'payment_status']=='' ? 'selected': '' }}>~~SELECT~~</option>
                            <option value="1" {{ $order_data[ 'payment_status']=='1' ? 'selected': '' }}>Full Payment</option>
                            <option value="2" {{ $order_data[ 'payment_status']=='2' ? 'selected': '' }}>Advance Payment</option>
                            <option value="3" {{ $order_data[ 'payment_status']=='3' ? 'selected': '' }}>No Payment</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-sm-offset-2 col-sm-10">
                {{-- <button type="button" class="btn btn-default" id="addrow" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button> --}}

                <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>
                <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

                <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
            </div>
        </div>
        </form>
        <!--/panel-->
    </div>
</div>
@endsection