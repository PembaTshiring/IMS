@extends('layouts.app')

@section('content')
<div class="container">
<div class="panel panel-default">
    <div class="panel-heading">

        <i class="glyphicon glyphicon-plus-sign"></i> Add Order

    </div>
    <!--/panel-->
    <div class="panel-body">
        {!! Form::open(['method'=>'POST','action'=>'OrderController@store', 'files'=>true, 'class'=>'form-horizontal']) !!}
        <input type="hidden" name="_token" id="_token" value="{{csrf_token()}}"/>
        <div class="form-group">
            {!! Form::label('date', 'Date', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::text('order_date', null, ['class' => 'form-control', 'id'=>'orderDate','autocomplete'=>'off','required'=>'true' ]) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('client_name', 'Client Name', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::text('client_name', $value = null, ['class' => 'typeahead form-control', 'placeholder' => 'Client Name','autocomplete'=>'off','required'=>'true']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('client_contact', 'Client Contact', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::number('client_contact', $value = null, ['class' => 'form-control', 'placeholder' => 'Client Contact','required'=>'true']) !!}
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
                    $arrayNumber=0;    
                @endphp
                @for ($x = 1; $x <4; $x++)
                <tr id='row{{$x}}' class="{{$arrayNumber}}">
                    <td>
                        <div class="form-group">
                            <div class="col-lg-10">
                                    {!! Form::select('product_name[]',[''=>'Choose Product'] + $products ,null,['class'=>'form-control','id'=>"selectedProduct$x",'onChange'=>"getProductData($x)",'required'=>'true'])!!}
                                </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <div class="col-lg-10">
                                {{-- {!! Form::text('rate[]',$value="$value", ['class' => 'form-control', 'disabled','id'=>"productRate$x",]) !!} --}}
                                <input type="text" name="rate[]" id="productRate{{$x}}" autocomplete="off" class="form-control" disabled="true" required>
                                <input type="hidden" name="rateValue[]" id="rateValue{{$x}}" autocomplete="off" class="form-control" />
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <div class="col-lg-10">
                                {!! Form::number('quantity[]', $value = null, ['class' => 'form-control','min'=>'1','id'=>"productQuantity$x",'onkeyup'=>"getTotal($x)",'required'=>'true']) !!}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <div class="col-lg-10">
                                {{-- {!! Form::text('total', $value = null, ['class' => 'form-control', 'disabled']) !!} --}}
                                <input type="text" name="total[]" id="total{{$x}}" autocomplete="off" class="form-control" disabled="true" required />			  					
			  					<input type="hidden" name="totalValue[]" id="totalValue{{$x}}" autocomplete="off" class="form-control" />
                            </div>
                        </div>
                    </td>
                    <td>
                    <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow({{$x}})"><i class="glyphicon glyphicon-trash"></i></button>

                            {{-- <button class="btn btn-default ibtnDel" type="button" id="ibtnDel"><i class="glyphicon glyphicon-trash"></i></button></i> --}}
                    </td>
                </tr>
                @php
                    $arrayNumber++;
                @endphp
                @endfor
            </tbody>    
        </table>

        
        <div class="col-md-6">
        <div class="form-group">
                {!! Form::label('sub_amount', 'Sub Amount', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {{-- {!! Form::text('sub_amount', $value = null, ['class' => 'form-control col-md-9','disabled']) !!} --}}
                    <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
				    <input type="hidden" class="form-control" id="subTotalValue" name="sub_total" />
                </div>
        </div>
        <div class="form-group">
                {!! Form::label('vat', 'VAT 13%', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {{-- {!! Form::text('vat', $value = null, ['class' => 'form-control col-md-9','disabled']) !!} --}}
                    <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
				    <input type="hidden" class="form-control" id="vatValue" name="vat" />
                </div>
        </div>
        <div class="form-group">
                {!! Form::label('total_amount', 'Total Amount', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {{-- {!! Form::text('total_amount', $value = null, ['class' => 'form-control col-md-9','disabled']) !!} --}}
                    <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
				    <input type="hidden" class="form-control" id="totalAmountValue" name="total_amount" />
                </div>
        </div>
        <div class="form-group">
                {!! Form::label('discount', 'Discount', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {{-- {!! Form::text('discount', $value = null, ['class' => 'form-control col-md-9']) !!} --}}
                    <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" min="0" autocomplete="off" placeholder="0.00" value="0.00"/>
                </div>
        </div>
        <div class="form-group">
                {!! Form::label('grand_total', 'Grand Amount', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {{-- {!! Form::text('grand_total', $value = null, ['class' => 'form-control col-md-9','disabled']) !!} --}}
                    <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true" />
				    <input type="hidden" class="form-control" id="grandTotalValue" name="grand_total" />
                </div>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
                {!! Form::label('paid', 'Paid Amount', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {{-- {!! Form::text('paid', $value = null, ['class' => 'form-control col-md-9']) !!} --}}
                    <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()" placeholder="0.00" value="0.00"/>
                </div>
        </div>
        <div class="form-group">
                {!! Form::label('due', 'Due Amount', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {{-- {!! Form::text('due', $value = null, ['class' => 'form-control col-md-9','disabled']) !!} --}}
                    <input type="text" class="form-control" id="due" name="due" disabled="true" />
				    <input type="hidden" class="form-control" id="dueValue" name="due" />
                </div>
        </div>
        <div class="form-group">
                {!! Form::label('payment_type', 'Payment Type', ['class' => 'col-lg-2 control-label'] )  !!}
                <div class="col-lg-10">
                    <select class="form-control" name="payment_type" id="paymentType" required>
                        <option value="">~~SELECT~~</option>
                        <option value="1">Cheque</option>
                        <option value="2">Cash</option>
                        <option value="3">Credit Card</option>
                    </select>
                </div>
        </div>
        <div class="form-group">
                {!! Form::label('payment_status', 'Payment Status', ['class' => 'col-lg-2 control-label'] )  !!}
                <div class="col-lg-10">
                    <select class="form-control" name="payment_status" id="paymentStatus" required>
                        <option value="">~~SELECT~~</option>
                        <option value="1">Full Payment</option>
                        <option value="2">Advance Payment</option>
                        <option value="3">No Payment</option>
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
    <!--/panel-->
</div>
</div>
@endsection
