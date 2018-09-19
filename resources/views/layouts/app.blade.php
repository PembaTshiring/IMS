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
    {{-- <link href="{{ asset('css/custom.css') }}" rel="stylesheet"> --}}


    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<!-- Optional theme -->
{{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous"> --}}

    

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
                                    <li id="navReport"><a href=""> <i class="glyphicon glyphicon-check"></i> Report </a></li>
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
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> --}}
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
})
    </script>
    <script>
            $('#editProductModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var id=button.data('id') 
            var name = button.data('name') 
            var code = button.data('code') 
            var quantity = button.data('quantity') 
            var rate = button.data('rate') 
            var brandname = button.data('brandname') 
            var categoryname = button.data('categoryname') 
            var status = button.data('status') 
            var modal = $(this)
            modal.find('.modal-body #id').val(id);
            modal.find('.modal-body #name').val(name);
            modal.find('.modal-body #code').val(code);
            modal.find('.modal-body #quantity').val(quantity);
            modal.find('.modal-body #rate').val(rate);
            modal.find('.modal-body #brandname').val(brandname);
            modal.find('.modal-body #categoryname').val(categoryname);
            modal.find('.modal-body #status').val(status);
      })
    </script>
    <script>
    $(".delete").on("submit", function(){
        return confirm("Are you sure you want to delete?");
    });
    </script>
    


</body>
</html>
