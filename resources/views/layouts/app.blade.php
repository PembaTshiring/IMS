<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.18/css/dataTables.bootstrap.min.css">
    {{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> --}}


    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        Inventory Management
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Register</a></li>
                            @else
                            <li id="navDashboard"><a href="{{route('dashboard')}}"><i class="glyphicon glyphicon-list-alt"></i>  Dashboard</a></li>        
        
                                        <li id="navBrand"><a href="{{route('brands.index')}}"><i class="glyphicon glyphicon-btc"></i>  Brand</a></li>        
                                
                                        <li id="navCategories"><a href="{{route('categories.index')}}"> <i class="glyphicon glyphicon-th-list"></i> Category</a></li>        
                                
                                        <li id="navProduct"><a href="{{route('products.index')}}"> <i class="glyphicon glyphicon-ruble"></i> Product </a></li>  
                                    <li class="dropdown" id="navOrder">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> <i class="glyphicon glyphicon-shopping-cart"></i> Orders <span class="caret"></span></a>
                                        <ul class="dropdown-menu">            
                                            <li id="topNavAddOrder"><a href="{{route('orders.create')}}"> <i class="glyphicon glyphicon-plus"></i> Add Orders</a></li>            
                                            <li id="topNavManageOrder"><a href="{{route('orders.index')}}"> <i class="glyphicon glyphicon-edit"></i> Manage Orders</a></li>            
                                        </ul>
                                    </li> 
                                    <li id="navReport"><a href="{{route('reports')}}"> <i class="glyphicon glyphicon-check"></i> Report </a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    
    @yield('content')
    
    <!-- Scripts -->
     {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.18/js/dataTables.bootstrap.min.js"></script>

    <script>
      $('#editBrandModel').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id=button.data('id') 
      var name = button.data('name') 
      var status = button.data('status') 
      var modal = $(this)
      modal.find('.modal-body #id').val(id);
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #status').val(status);
});

$('#editcategoryModel').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget)
      var id=button.data('id') 
      var name = button.data('name') 
      var status = button.data('status') 
      var modal = $(this)
      modal.find('.modal-body #id').val(id);
      modal.find('.modal-body #name').val(name);
      modal.find('.modal-body #status').val(status);
});

    </script>
    <script>
            $('#editProductModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id=button.data('id') 
            var image=button.data('image')
            var name = button.data('name') 
            var code = button.data('code') 
            var quantity = button.data('quantity') 
            var rate = button.data('rate') 
            var brand_id = button.data('brand_id') 
            var category_id = button.data('category_id') 
            var status = button.data('status') 
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #image').val(image);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #code').val(code);
            modal.find('.modal-body #quantity').val(quantity);
            modal.find('.modal-body #rate').val(rate);
            modal.find('.modal-body #brand_id').val(brand_id);
            modal.find('.modal-body #category_id').val(category_id);
            modal.find('.modal-body #status').val(status);
      });
    </script>
    <script>
        $(".delete").on("submit", function(){
            return confirm("Are you sure you want to delete?");
        });
    </script>
    <script>
        $(document).ready(function() {
        $('#product_table').DataTable();
        } );
    </script>
    <script>
        $(document).ready(function() {
        $('#manageCategoriesTable').DataTable();
        } );
    </script>
    <script>
        $(document).ready(function() {
        $('#manageBrandTable').DataTable();
        } );
    </script>
    <script>
        $(document).ready(function() {
        $('#manageOrderTable').DataTable();
        } );
    </script>

{{-- adding rows --}}
<script>
//     $(document).ready(function () {
//         $("#orderDate").datepicker({
//             dateFormat: 'yy-mm-dd'
//         });
//     var tableLength = $("#productTable tbody tr").length;
//     var counter = -1;

//     $("#addrow").on("click", function () {
//         if(tableLength > 0) {		
// 		tableRow = $("#productTable tbody tr:last").attr('id');
// 		arrayNumber = $("#productTable tbody tr:last").attr('class');
// 		count = tableRow.substring(3);	
// 		count = Number(count) + 1;
// 		arrayNumber = Number(arrayNumber) + 1;					
// 	    }
//         else {
// 		// no table row
// 		count = 1;
// 		arrayNumber = 0;
// 	    }   
        
//         $.ajax({
//             headers: {
//             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
// 		url: "{{route('fetchSelectedProductData')}}",
// 		type: 'post',
// 		dataType: 'json',
// 		success:function(response) {

//         var newRow = $("<tr id='row"+count+"' class="+arrayNumber+">");
//         var cols = "";
        
//         cols += '<td><div class="form-group"><div class="col-lg-10"><select class="form-control" id="selectedProduct'+count+'" onchange="getProductData('+count+')" name="product_name[]"><option value="" selected="selected">Choose Product</option>';
//                 // console.log(response);
//                     $.each(response, function(index, value) {
// 							cols += '<option value="'+value['product_id']+'">'+value['product_name']+'</option>';							
// 						});
//         cols +='</select></div></div></td>';        
//         cols += '<td><div class="form-group"><div class="col-lg-10"><input type="text" name="rate[]" id="productRate'+count+'" autocomplete="off" class="form-control" disabled="true"><input type="hidden" name="rateValue[]" id="rateValue'+count+'" autocomplete="off" class="form-control" /></div></div></td>';
//         cols += '<td><div class="form-group"><div class="col-lg-10"><input class="form-control" name="quantity[]" type="number" id="productQuantity'+count+'" onkeyup="getTotal('+count+')"></div></div></td>';
//         cols += '<td><div class="form-group"><div class="col-lg-10"><input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" disabled="true" /><input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" /></div></div></td>';
//         cols += '<td><button class="ibtnDel btn btn-default" type="button" id="ibtnDel"><i class="glyphicon glyphicon-trash"></i></button></i></td>';
        
//         newRow.append(cols);
//         $("table.order-list").append(newRow);
//         counter++;
        
//         }});
//     });

//     $("table.order-list").on("click", ".ibtnDel", function (event) {
//         $(this).closest("tr").remove();       
//         counter -= 1
//     });


// });
$(document).ready(function () {
        $("#orderDate").datepicker({
            dateFormat: 'yy-mm-dd'
        });
    });

function addRow() {
	// $("#addRowBtn").button("loading");
    
	var tableLength = $("#productTable tbody tr").length;

	var tableRow;
	var arrayNumber;
	var count;

	if(tableLength > 0) {		
		tableRow = $("#productTable tbody tr:last").attr('id');
		arrayNumber = $("#productTable tbody tr:last").attr('class');
		count = tableRow.substring(3);	
		count = Number(count) + 1;
		arrayNumber = Number(arrayNumber) + 1;					
	} else {
		// no table row
		count = 1;
		arrayNumber = 0;
	}

	$.ajax({
		headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
		url: "{{route('fetchSelectedProductData')}}",
		type: 'post',
		dataType: 'json',
		success:function(response) {
			// $("#addRowBtn").button("reset");			

			var tr = '<tr id="row'+count+'" class="'+arrayNumber+'">'+			  				

                '<td>'+
					'<div class="form-group"><div class="col-lg-10">'+

					'<select class="form-control" name="product_name[]" id="selectedProduct'+count+'" onchange="getProductData('+count+')" >'+
						'<option value="">Choose Product</option>';
						// console.log(response);
						$.each(response, function(index, value) {
                            tr += '<option value="'+value['product_id']+'">'+value['product_name']+'</option>';	
						});
													
					tr += '</select></div>'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;"">'+
					'<input type="text" name="rate[]" id="productRate'+count+'" autocomplete="off" disabled="true" class="form-control" />'+
					'<input type="hidden" name="rateValue[]" id="rateValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td style="padding-left:20px;">'+
				'<td style="padding-left:20px;">'+
					'<div class="form-group">'+
					'<input type="number" name="quantity[]" id="productQuantity'+count+'" onkeyup="getTotal('+count+')" autocomplete="off" class="form-control" min="1" />'+
					'</div>'+
				'</td>'+
				'<td style="padding-left:20px;">'+
					'<input type="text" name="total[]" id="total'+count+'" autocomplete="off" class="form-control" disabled="true" />'+
					'<input type="hidden" name="totalValue[]" id="totalValue'+count+'" autocomplete="off" class="form-control" />'+
				'</td>'+
				'<td>'+
					'<button class="btn btn-default removeProductRowBtn" type="button" onclick="removeProductRow('+count+')"><i class="glyphicon glyphicon-trash"></i></button>'+
				'</td>'+
			'</tr>';
			if(tableLength > 0) {							
				$("#productTable tbody tr:last").after(tr);
			} else {				
				$("#productTable tbody").append(tr);
			}		

		} // /success
	});	// get the product data

} // /add row

function removeProductRow(row = null) {
	if(row) {
		$("#row"+row).remove();


		subAmount();
	} else {
		alert('error! Refresh the page again');
	}
}

</script>




<script type="text/javascript">
function getProductData(row = null) {
        var productid=$("#selectedProduct"+row).val();
        var _token = $('#_token').val();
        // if(productid==""){
        //     $("#productQuantity"+row).val("");
        // }
        // else{
        //     $("#productQuantity"+row).val(1);
        // }
        $.ajax({
				url: "{{route('fetchProductData')}}",
				type: 'POST',
				data: {'_token':_token,'productId' : productid},
				dataType: 'json',
				success:function(response) { 
                    // return alert(response[0].product_rate);
                    $("#productRate"+row).val(response[0].product_rate);
                    $("#rateValue"+row).val(response[0].product_rate);
                    $("#productQuantity"+row).val(1);
                    subAmount();
                }});
};

function getTotal(row = null) {
	if(row) {
		var total = Number($("#productRate"+row).val()) * Number($("#productQuantity"+row).val());
		total = total.toFixed(2);
		$("#total"+row).val(total);
		$("#totalValue"+row).val(total);
		
		subAmount();

	} else {
		alert('no row !! please refresh the page');
	}
}

function subAmount() {
	var tableProductLength = $("#productTable tbody tr").length;
	var totalSubAmount = 0;
	for(x = 0; x < tableProductLength; x++) {
		var tr = $("#productTable tbody tr")[x];
		var count = $(tr).attr('id');
		count = count.substring(3);

		totalSubAmount = Number(totalSubAmount) + Number($("#total"+count).val());
	} // /for

	totalSubAmount = totalSubAmount.toFixed(2);

	// sub total
	$("#subTotal").val(totalSubAmount);
	$("#subTotalValue").val(totalSubAmount);

	// vat
	var vat = (Number($("#subTotal").val())/100) * 13;
	vat = vat.toFixed(2);
	$("#vat").val(vat);
	$("#vatValue").val(vat);

	// total amount
	var totalAmount = (Number($("#subTotal").val()) + Number($("#vat").val()));
	totalAmount = totalAmount.toFixed(2);
	$("#totalAmount").val(totalAmount);
	$("#totalAmountValue").val(totalAmount);

	var discount = $("#discount").val();
	if(discount) {
		var grandTotal = Number($("#totalAmount").val()) - Number(discount);
		grandTotal = grandTotal.toFixed(2);
		$("#grandTotal").val(grandTotal);
		$("#grandTotalValue").val(grandTotal);
	} else {
		$("#grandTotal").val(totalAmount);
		$("#grandTotalValue").val(totalAmount);
	} // /else discount	

	var paidAmount = $("#paid").val();
	if(paidAmount) {
		paidAmount =  Number($("#grandTotal").val()) - Number(paidAmount);
		paidAmount = paidAmount.toFixed(2);
		$("#due").val(paidAmount);
		$("#dueValue").val(paidAmount);
	} else {	
		$("#due").val($("#grandTotal").val());
		$("#dueValue").val($("#grandTotal").val());
	} // else

} // /sub total amount

function discountFunc() {
	var discount = $("#discount").val();
 	var totalAmount = Number($("#totalAmount").val());
 	totalAmount = totalAmount.toFixed(2);

 	var grandTotal;
 	if(totalAmount) { 	
 		grandTotal = Number($("#totalAmount").val()) - Number($("#discount").val());
 		grandTotal = grandTotal.toFixed(2);

 		$("#grandTotal").val(grandTotal);
 		$("#grandTotalValue").val(grandTotal);
 	} else {
 	}

 	var paid = $("#paid").val();

 	var dueAmount; 	
 	if(paid) {
 		dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
 		dueAmount = dueAmount.toFixed(2);

 		$("#due").val(dueAmount);
 		$("#dueValue").val(dueAmount);
 	} else {
 		$("#due").val($("#grandTotal").val());
 		$("#dueValue").val($("#grandTotal").val());
 	}

} // /discount function

function paidAmount() {
	var grandTotal = $("#grandTotal").val();

	if(grandTotal) {
		var dueAmount = Number($("#grandTotal").val()) - Number($("#paid").val());
		dueAmount = dueAmount.toFixed(2);
		$("#due").val(dueAmount);
		$("#dueValue").val(dueAmount);
	} // /if
} // /paid amount function
function printOrder(orderId = null) {
	if(orderId) {
		$.ajax({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
			url: "{{route('printOrder')}}",
			type: 'POST',
			data: {'orderId': orderId},
			dataType: 'text',
			success:function(response) {
				
				var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Order Invoice</title>');        
        mywindow.document.write('</head><body>');
        mywindow.document.write(response);
        mywindow.document.write('</body></html>');

        mywindow.document.close(); // necessary for IE >= 10
        mywindow.focus(); // necessary for IE >= 10

        mywindow.print();
        mywindow.close();
				
			}// /success function
		}); // /ajax function to fetch the printable order
    } // /if orderId
} // /print order function
</script>

<script>
$(document).ready(function() {
	// order date picker
	$("#startDate").datepicker({
        dateFormat: 'yy-mm-dd',
    });
	// order date picker
	$("#endDate").datepicker({
        dateFormat: 'yy-mm-dd'
    });

	$("#getOrderReportForm").unbind('submit').bind('submit', function() {
		
		var startDate = $("#startDate").val();
		var endDate = $("#endDate").val();

		if(startDate == "" || endDate == "") {
			if(startDate == "") {
				$("#startDate").closest('.form-group').addClass('has-error');
				$("#startDate").after('<p class="text-danger">The Start Date is required</p>');
			} else {
				$(".form-group").removeClass('has-error');
				$(".text-danger").remove();
			}

			if(endDate == "") {
				$("#endDate").closest('.form-group').addClass('has-error');
				$("#endDate").after('<p class="text-danger">The End Date is required</p>');
			} else {
				$(".form-group").removeClass('has-error');
				$(".text-danger").remove();
			}
		} else {
			$(".form-group").removeClass('has-error');
			$(".text-danger").remove();

			var form = $(this);

			$.ajax({
				url: "{{route('getOrderReport')}}",
				type: 'POST',
				data: {'_token':_token,'startDate' : startDate,'endDate': endDate},
				dataType: 'json',
				success:function(response) {
					var mywindow = window.open('', 'Stock Management System', 'height=400,width=600');
	        mywindow.document.write('<html><head><title>Order Report Slip</title>');        
	        mywindow.document.write('</head><body>');
	        mywindow.document.write(response);
	        mywindow.document.write('</body></html>');

	        mywindow.document.close(); // necessary for IE >= 10
	        mywindow.focus(); // necessary for IE >= 10

	        mywindow.print();
	        mywindow.close();
				} // /success
			});	// /ajax

		} // /else

		return false;
	});

});
</script>
    
</body>
</html>
