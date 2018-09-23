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
        <div class="form-group">
            {!! Form::label('date', 'Date', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::email('date', $value = null, ['class' => 'form-control',]) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('client_name', 'Client Name', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::text('client_name', $value = null, ['class' => 'form-control', 'placeholder' => 'Client Name']) !!}
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('client_contact', 'Client Contact', ['class' => 'col-lg-2 control-label']) !!}
            <div class="col-lg-10">
                {!! Form::text('client_contact', $value = null, ['class' => 'form-control', 'placeholder' => 'Client Contact']) !!}
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
                @foreach ($products as $product)
                <tr>
                    <td>
                        <div class="form-group">
                            <div class="col-lg-10">
                                    {!! Form::select('product_name',[''=>'Choose Product'] + $products ,null,['class'=>'form-control'])!!}
                                </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <div class="col-lg-10">
                                {!! Form::text('rate', $value = null, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <div class="col-lg-10">
                                {!! Form::text('quantity', $value = null, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="form-group">
                            <div class="col-lg-10">
                                {!! Form::text('total', $value = null, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                        </div>
                    </td>
                    <td>
                            <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(1)"><i class="glyphicon glyphicon-trash"></i></button></i>
                    </td>
                </tr>
                @endforeach
            </tbody>    
        </table>

        
        <div class="col-md-6">
        <div class="form-group">
                {!! Form::label('sub_amount', 'Sub Amount', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('sub_amount', $value = null, ['class' => 'form-control col-md-9','disabled']) !!}
                </div>
        </div>
        <div class="form-group">
                {!! Form::label('vat', 'VAT 13%', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('vat', $value = null, ['class' => 'form-control col-md-9','disabled']) !!}
                </div>
        </div>
        <div class="form-group">
                {!! Form::label('total_amount', 'Total Amount', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('total_amount', $value = null, ['class' => 'form-control col-md-9','disabled']) !!}
                </div>
        </div>
        <div class="form-group">
                {!! Form::label('discount', 'Discount', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('discount', $value = null, ['class' => 'form-control col-md-9']) !!}
                </div>
        </div>
        <div class="form-group">
                {!! Form::label('grand_total', 'Grand Amount', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('grand_total', $value = null, ['class' => 'form-control col-md-9','disabled']) !!}
                </div>
        </div>
        </div>
        <div class="col-md-6">
        <div class="form-group">
                {!! Form::label('paid', 'Paid Amount', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('paid', $value = null, ['class' => 'form-control col-md-9']) !!}
                </div>
        </div>
        <div class="form-group">
                {!! Form::label('due', 'Due Amount', ['class' => 'col-lg-2 control-label']) !!}
                <div class="col-lg-10">
                    {!! Form::text('due', $value = null, ['class' => 'form-control col-md-9','disabled']) !!}
                </div>
        </div>
        <div class="form-group">
                {!! Form::label('payment_type', 'Payment Type', ['class' => 'col-lg-2 control-label'] )  !!}
                <div class="col-lg-10">
                    {!!  Form::select('payment_type', ['S' => 'Small', 'L' => 'Large', 'XL' => 'Extra Large', '2XL' => '2X Large'],  'S', ['class' => 'form-control' ]) !!}
                </div>
        </div>
        <div class="form-group">
                {!! Form::label('payment_status', 'Payment Status', ['class' => 'col-lg-2 control-label'] )  !!}
                <div class="col-lg-10">
                    {!!  Form::select('payment_status', ['S' => 'Small', 'L' => 'Large', 'XL' => 'Extra Large', '2XL' => '2X Large'],  'S', ['class' => 'form-control' ]) !!}
                </div>
        </div>
        </div>
        <div class="col-sm-offset-2 col-sm-10">
			    <button type="button" class="btn btn-default" id="addrow" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

			      <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

			      <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
		</div>
    </div>
    <!--/panel-->
</div>
</div>
@endsection
