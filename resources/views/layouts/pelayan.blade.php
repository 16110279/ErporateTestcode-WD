<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <menu>Ela kasir - HTML5 kasir Template</menu>
    <meta name="description" content="Ela kasir - HTML5 kasir Template">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pelayan</title>
    {{-- <link rel="apple-touch-icon" href="https://i.imgur.com/QRAUqs9.png"> --}}
    {{-- <link rel="shortcut icon" href="https://i.imgur.com/QRAUqs9.png"> --}}
     <script src="https://code.jquery.com/jquery-3.4.1.min.js"
            integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
            crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="{{ asset('assets/npm/normalize.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/npm/bootstrap.min.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">

    <link rel="stylesheet" href="{{ asset('assets/npm/pe-icon-7-stroke.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/cs-skin-elastic.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    {{-- <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet"> --}}

    {{-- <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" /> --}}
    {{-- <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" /> --}}

   <style>
    
    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    {{-- <li> --}}



                    <li <?php if($menu == 'Dashboard') { echo "class='active'"; } ?>>
                        <a href="{{ url('pelayan/') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>

                  
                    <li <?php if($menu == 'Transaction') { echo "class='active'"; } ?>>
                        <a href="{{ url('pelayan/transaction') }}"><i class="menu-icon fa fa- fa-file-text-o"></i>Transaction</a>
                    </li>
                  
                    <li <?php if($menu == 'Laporan') { echo "class='active'"; } ?>>
                        <a href="{{ url('pelayan/laporan') }}"><i class="menu-icon fa fa-print"></i>Laporan</a>
                    </li>

                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                    <a class="navbar-brand" href="./"><img src="{{ asset('images/logo.png') }}" alt="Logo"></a>
                    <a class="navbar-brand hidden" href="./"><img src="{{ asset('images/logo2.png') }}" alt="Logo"></a>
                    <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">

  <div class="dropdown for-notification">
                            <a href="{{ url('pelayan/cart') }}">
                            <button class="btn btn-secondary dropdown-toggle" type="button">
                                <i class="fa fa-shopping-cart"></i>
                                <span class="count bg-danger">{{ $count  }}</span>
                            </button>
                                                          </a>

                        </div>


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

                </div>
         </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="content">
            <!-- Animated -->
            <div class="animated fadeIn">
                @if(session('status'))
<div class="alert alert-success">
{{session('status')}}
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif
                @yield('content')
            </div>
        <div class="clearfix"></div>
    
    </div>
    <!-- /#right-panel -->
    <script>             
            function loadData(){
                $.ajax({
                    url: "{{ url('api/v0/product/active') }}",
                    method: "GET",
                    contentType: "application/json",
                    dataType: "json",
                    success: function(result){
                        // console.log(result);

                   let data = result.data;
                        let html_content = "";
                        $.each(data, function(index, value){
                            // console.log("Result : "+value);
                             console.log("Result : ", value)
                            html_content += 
                            "<div class='col-12 col-md-4'>"
                                +"<div class='card mb-2'>"
                                    +"<img src='../storage/img/"+value.picture[0].picture_name+"' class='card-img-top'>"
                                    +"<div class='card-body'>"
                                        +"<h1 class='card-title'>"+value.product_name+"</h1>"
                                        +"<p> Rp. "+value.product_price+"</p>"
                                      +"<button type='button' class='badge badge-primary' onclick='deleteAction("+value.id+")' data-toggle='modal' data-target='#newMenuModal-' data-id="+value.id+"> Add </button>"
                                      
                                    +"</div>"
                                +"</div>"
                            +"</div>";
                        });

                        $("#content").html(html_content);

                        }
                });
            }

            function loadData2(){
                $.ajax({
                    url: "{{ url('api/v0/product/active') }}",
                    method: "GET",
                    contentType: "application/json",
                    dataType: "json",
                    success: function(result){
                        // console.log(result);

                   let data = result.data;
                        let html_content = "";
                        $.each(data, function(index, value){
                            // console.log("Result : "+value);
                             console.log("Result : ", value)
                            html_content += 
                            "<div class='col-12 col-md-2'>"
                                +"<div class='card mb-2'>"
                                    +"<img src='../../storage/img/"+value.picture[0].picture_name+"' class='card-img-top'>"
                                    +"<div class='card-body'>"
                                        +"<h4 class='card-title'>"+value.product_name+"</h4>"
                                        +"<p> Rp. "+value.product_price+"</p>"
                                      +"<button type='button' class='badge badge-primary' onclick='addToTransCart("+value.id+")' data-toggle='modal' data-target='#newMenuModal-' data-id="+value.id+"> Add </button>"
                                      
                                    +"</div>"
                                +"</div>"
                            +"</div>";
                        });

                        $("#content").html(html_content);

                        }
                });
            }

                function deleteAction(id){
                if(confirm("Are you sure?")){
                    $.ajax({
                        url: "/pelayan/addtocart/"+id,
                        method: "POST",
                        data: {'id': id, '_token': "{{ csrf_token() }}"},
                        success: function(result){
                            alert(result.message);
                            // loadData();
                            window.location.href = "/pelayan";

                        }
                    });
                }
            }


                function addToTransCart(id){
                if(confirm("Are you sure?")){
                    $.ajax({
                        url: "/pelayan/addtotranscart/"+id,
                        method: "POST",
                        data: {'id': id, '_token': "{{ csrf_token() }}"},
                        success: function(result){
                            alert(result.message);
                            // loadData();
                            window.location.href = "/pelayan/transaction/"+id;

                        }
                    });
                }
            }

            
            </script>
  

    <!-- Scripts -->
    {{-- <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script> --}}
    <script src="{{ asset('assets/npm/popper.min.js')}}"></script>
    <script src="{{ asset('assets/npm/bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/npm//jquery.matchHeight.min.js')}}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>

<link rel="stylesheet" href="{{ asset('assets/bootstrap/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/datatable/jquery.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/datatable/datatables.min.css')}}">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="{{ asset('assets/datatable/jquery.dataTables.min.js')}}"></script>


</body>
</html>
