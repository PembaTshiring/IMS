@extends('layouts.app')

@section('content')
<div class="container">
<div class="panel panel-default">
    <div class="panel-heading">

        <i class="glyphicon glyphicon-plus-sign"></i> Add Order

    </div>
    <!--/panel-->
    <div class="panel-body">

        <div class="success-messages"></div>
        <!--/success-messages-->

        <form class="form-horizontal" method="POST" action="php_action/createOrder.php" id="createOrderForm">

            <div class="form-group">
                <label for="orderDate" class="col-sm-2 control-label">Order Date</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control hasDatepicker" id="orderDate" name="orderDate" autocomplete="off">
                </div>
            </div>
            <!--/form-group-->
            <div class="form-group">
                <label for="clientName" class="col-sm-2 control-label">Client Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="clientName" name="clientName" placeholder="Client Name" autocomplete="off">
                </div>
            </div>
            <!--/form-group-->
            <div class="form-group">
                <label for="clientContact" class="col-sm-2 control-label">Client Contact</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="clientContact" name="clientContact" placeholder="Contact Number" autocomplete="off">
                </div>
            </div>
            <!--/form-group-->

            <table class="table" id="productTable">
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
                    <tr id="row1" class="0">
                        <td style="margin-left:20px;">
                            <div class="form-group">

                                <select class="form-control" name="productName[]" id="productName1" onchange="getProductData(1)">
                                    <option value="">~~SELECT~~</option>
                                    <option value="25" id="changeProduct25">Name 3</option>
                                </select>
                            </div>
                        </td>
                        <td style="padding-left:20px;">
                            <input type="text" name="rate[]" id="rate1" autocomplete="off" disabled="true" class="form-control">
                            <input type="hidden" name="rateValue[]" id="rateValue1" autocomplete="off" class="form-control">
                        </td>
                        <td style="padding-left:20px;">
                            <div class="form-group">
                                <input type="number" name="quantity[]" id="quantity1" onkeyup="getTotal(1)" autocomplete="off" class="form-control" min="1">
                            </div>
                        </td>
                        <td style="padding-left:20px;">
                            <input type="text" name="total[]" id="total1" autocomplete="off" class="form-control" disabled="true">
                            <input type="hidden" name="totalValue[]" id="totalValue1" autocomplete="off" class="form-control">
                        </td>
                        <td>

                            <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(1)"><i class="glyphicon glyphicon-trash"></i></button>
                        </td>
                    </tr>
                    <tr id="row2" class="1">
                        <td style="margin-left:20px;">
                            <div class="form-group">

                                <select class="form-control" name="productName[]" id="productName2" onchange="getProductData(2)">
                                    <option value="">~~SELECT~~</option>
                                    <option value="25" id="changeProduct25">Name 3</option>
                                </select>
                            </div>
                        </td>
                        <td style="padding-left:20px;">
                            <input type="text" name="rate[]" id="rate2" autocomplete="off" disabled="true" class="form-control">
                            <input type="hidden" name="rateValue[]" id="rateValue2" autocomplete="off" class="form-control">
                        </td>
                        <td style="padding-left:20px;">
                            <div class="form-group">
                                <input type="number" name="quantity[]" id="quantity2" onkeyup="getTotal(2)" autocomplete="off" class="form-control" min="1">
                            </div>
                        </td>
                        <td style="padding-left:20px;">
                            <input type="text" name="total[]" id="total2" autocomplete="off" class="form-control" disabled="true">
                            <input type="hidden" name="totalValue[]" id="totalValue2" autocomplete="off" class="form-control">
                        </td>
                        <td>

                            <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(2)"><i class="glyphicon glyphicon-trash"></i></button>
                        </td>
                    </tr>
                    <tr id="row3" class="2">
                        <td style="margin-left:20px;">
                            <div class="form-group">

                                <select class="form-control" name="productName[]" id="productName3" onchange="getProductData(3)">
                                    <option value="">~~SELECT~~</option>
                                    <option value="25" id="changeProduct25">Name 3</option>
                                </select>
                            </div>
                        </td>
                        <td style="padding-left:20px;">
                            <input type="text" name="rate[]" id="rate3" autocomplete="off" disabled="true" class="form-control">
                            <input type="hidden" name="rateValue[]" id="rateValue3" autocomplete="off" class="form-control">
                        </td>
                        <td style="padding-left:20px;">
                            <div class="form-group">
                                <input type="number" name="quantity[]" id="quantity3" onkeyup="getTotal(3)" autocomplete="off" class="form-control" min="1">
                            </div>
                        </td>
                        <td style="padding-left:20px;">
                            <input type="text" name="total[]" id="total3" autocomplete="off" class="form-control" disabled="true">
                            <input type="hidden" name="totalValue[]" id="totalValue3" autocomplete="off" class="form-control">
                        </td>
                        <td>

                            <button class="btn btn-default removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(3)"><i class="glyphicon glyphicon-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="subTotal" class="col-sm-3 control-label">Sub Amount</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true">
                        <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue">
                    </div>
                </div>
                <!--/form-group-->
                <div class="form-group">
                    <label for="vat" class="col-sm-3 control-label">VAT 13%</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="vat" name="vat" disabled="true">
                        <input type="hidden" class="form-control" id="vatValue" name="vatValue">
                    </div>
                </div>
                <!--/form-group-->
                <div class="form-group">
                    <label for="totalAmount" class="col-sm-3 control-label">Total Amount</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true">
                        <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue">
                    </div>
                </div>
                <!--/form-group-->
                <div class="form-group">
                    <label for="discount" class="col-sm-3 control-label">Discount</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="discount" name="discount" onkeyup="discountFunc()" autocomplete="off">
                    </div>
                </div>
                <!--/form-group-->
                <div class="form-group">
                    <label for="grandTotal" class="col-sm-3 control-label">Grand Total</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="grandTotal" name="grandTotal" disabled="true">
                        <input type="hidden" class="form-control" id="grandTotalValue" name="grandTotalValue">
                    </div>
                </div>
                <!--/form-group-->
            </div>
            <!--/col-md-6-->

            <div class="col-md-6">
                <div class="form-group">
                    <label for="paid" class="col-sm-3 control-label">Paid Amount</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="paid" name="paid" autocomplete="off" onkeyup="paidAmount()">
                    </div>
                </div>
                <!--/form-group-->
                <div class="form-group">
                    <label for="due" class="col-sm-3 control-label">Due Amount</label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" id="due" name="due" disabled="true">
                        <input type="hidden" class="form-control" id="dueValue" name="dueValue">
                    </div>
                </div>
                <!--/form-group-->
                <div class="form-group">
                    <label for="clientContact" class="col-sm-3 control-label">Payment Type</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="paymentType" id="paymentType">
                            <option value="">~~SELECT~~</option>
                            <option value="1">Cheque</option>
                            <option value="2">Cash</option>
                            <option value="3">Credit Card</option>
                        </select>
                    </div>
                </div>
                <!--/form-group-->
                <div class="form-group">
                    <label for="clientContact" class="col-sm-3 control-label">Payment Status</label>
                    <div class="col-sm-9">
                        <select class="form-control" name="paymentStatus" id="paymentStatus">
                            <option value="">~~SELECT~~</option>
                            <option value="1">Full Payment</option>
                            <option value="2">Advance Payment</option>
                            <option value="3">No Payment</option>
                        </select>
                    </div>
                </div>
                <!--/form-group-->
            </div>
            <!--/col-md-6-->

            <div class="form-group submitButtonFooter">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add Row </button>

                    <button type="submit" id="createOrderBtn" data-loading-text="Loading..." class="btn btn-success"><i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>

                    <button type="reset" class="btn btn-default" onclick="resetOrderForm()"><i class="glyphicon glyphicon-erase"></i> Reset</button>
                </div>
            </div>
        </form>

    </div>
    <!--/panel-->
</div>
</div>
@endsection
