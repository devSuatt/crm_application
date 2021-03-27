<!doctype html>
<html lang="en">
<head>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v3.8.5">
    <title> @yield("head_title") </title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/dashboard/">

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.css" rel="stylesheet" >
    <link href="js/highcharts.js" rel="stylesheet">


    <style>

        .ui-controlgroup-vertical {
            width: 150px;
        }
        .ui-controlgroup.ui-controlgroup-vertical > button.ui-button,
        .ui-controlgroup.ui-controlgroup-vertical > .ui-controlgroup-label {
            text-align: center;
        }
        #car-type-button {
            width: 120px;
        }
        .ui-controlgroup-horizontal .ui-spinner-input {
            width: 20px;
        }

        .btn-label {position: relative;left: -12px;display: inline-block;padding: 6px 12px;background: rgba(0,0,0,0.15);border-radius: 3px 0 0 3px;}
        .btn-labeled {padding-top: 0;padding-bottom: 0;}
        .btn { margin-bottom:10px; }

        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://code.highcharts.com/highcharts.src.js"></script>
</head>
<body>
<nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">ST - CRM</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">

    @if (Route::has('login'))
        <div style="font-size: 15px" class="top-right links">
            @auth
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @else
                <a class="nav-link" href="{{ route('login') }}">Login</a>


            @endauth
        </div>
    @endif


</nav>

@php
$activeMenu = \App\Helpers\CustomHelpers::getActiveMenuName();
@endphp
<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul style="font-size: larger" class="nav flex-column">

                    @if(Auth::user()->role == 1)
                        <li class="nav-item">
                            <a class="nav-link {{ $activeMenu==""?"active":"" }}" href="/">
                                <span data-feather="home"></span>
                                Home
                            </a>
                        </li>

                    <li class="nav-item">
                        <a class="nav-link {{ $activeMenu=="product"?"active":"" }}" href="/product">
                            <span data-feather="shopping-cart"></span>
                            Products
                        </a>
                    </li>
                    <li class="nav-item">
                            <a class="nav-link {{ $activeMenu=="customer"?"active":"" }}" href="/customer">
                                <span data-feather="users"></span>
                                Customers
                            </a>
                        </li>
                    <li class="nav-item">
                            <a class="nav-link {{ $activeMenu=="customer_orders"?"active":"" }}" href="/customer_orders">
                                <span data-feather="list"></span>
                                Customer Orders
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link {{ $activeMenu==""?"active":"" }}" href="/">
                                <span data-feather="home"></span>
                                Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeMenu=="order"?"active":"" }}" href="/order">
                                <span data-feather="shopping-bag"></span>
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ $activeMenu=="product_order"?"active":"" }}" href="/product_order">
                                <span data-feather="shopping-cart"></span>
                                Orders History
                            </a>
                        </li>
                    @endif

                </ul>
            </div>
        </nav>

        <div role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">

            <div style="margin-top: 13px">

                @yield("add_btn")

            <h2 style="margin-left: 10px">@yield("page_title")</h2> </div>
            <div class="myContent">
                @yield("content")



            </div>

        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script src="/js/parsley.min.js"></script>
<script src="/js/parsley.js"></script>

<script src="js/bootstrap.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>
<script src="js/dashboard.js"></script>
<script src="js/highcharts.js"></script>
@yield("script")


<script>

    $(document).ready(function () {
        $('#formAddPost').parsley();
    });

    function SaveButtonClicked(){

        $("#formAddPost").submit();

    }

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
</body>
</html>
