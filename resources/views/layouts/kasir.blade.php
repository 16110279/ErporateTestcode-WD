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
    <title>Kasir</title>
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
                        <a href="{{ url('kasir/') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>



                  
                    <li <?php if($menu == 'Transaction') { echo "class='active'"; } ?>>
                        <a href="{{ url('kasir/transaction') }}"><i class="menu-icon fa fa-list"></i>Transaction</a>
                    </li>

                 

                  <li <?php if($menu == 'Manage Product') { echo "class='active'"; } ?>>
                        <a href="{{ url('kasir/manage-product') }}"><i class="menu-icon fa  fa-folder-o"></i>Manage Product </a>
                    </li>

                <li <?php if($menu == 'Add Product') { echo "class='active'"; } ?>>
                        <a href="{{ url('kasir/add-product') }}"><i class="menu-icon fa fa-plus"></i>Tambah Product </a>
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

                    {{-- {{ Auth::user()->name }} --}}
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
 <script>             
            function loadData(id){
                // var id = $id
                // id = id
                $.ajax({
                    url: "/api/v0/picture/"+id,

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
                    "<div class='col-md-4'>"
                        +"<div class='card'>"
                            +"<img class='card-img-top' src='../../../storage/img/"+value.picture_name+"'  alt='Card image cap'>"
                            +"<div class='card-bod'>"
                                      +"<div class='row form-group'>"
                                        +"<div class='col-12 col-md-9'><input type='file' id='file-input' name='file-input' class='form-control-file'></div>"
                                        +"<button class='btn btn-success'><li class='fa fa-upload'></li></button>"
                                        +"<button type='button' class='btn btn-danger' onclick='deleteAction(\"" + value.id + "\",\"" + id + "\")'>Delete</button>"

                                    +"</div>"
                            +"</div>"
                        +"</div>"
                    +"</div>";     
                        });

                        $("#content").html(html_content);

                        }
                });
            }

                function addAction(id){
                if(confirm("Are you sure?")){
                    $.ajax({
                        url: "/kasir/addpicture/"+id,
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

             $("#pariwisata_form").submit(function(e){
                 
                e.preventDefault();
                // console.log(api_url);
                console.log("Form is being submited, url is : "+$(this).attr('action'));
var id = $("#product_id").val();
                // Remove All Error
                $(".invalid-feedback").remove();
                $(".form-control").removeClass("is-invalid");

                var formData = new FormData(this);
                // console.log(formData);

                $.ajax({
                    url: $(this).attr('action'),
                    method: "POST",
                    contentType: "application/json",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(result){
                        console.log(result);
                        // $("#newMenuModal").modal('hide');
                        //    $('#newMenuModal').modal('toggle');

                        // console.log(id);
                        loadData(id);
                    },
                    error: function(jqXHR, textStatus, errorThrown){
                        console.log(jqXHR);

                        $.each(jqXHR.responseJSON.errors, function(key, result) {
                            //Append Error Field
                            $("#"+key).addClass('is-invalid');
                            //Append Error Message
                            $("#field-"+key).append("<div class='invalid-feedback'>"+result+"</div>");
                        });
                    }
                });
            });

               function deleteAction(id,idt){
                if(confirm("Are you sure?")){
                    console.log(id)
                    console.log(idt)
                    $.ajax({
                        url: "/api/v0/picture/"+id,
                        method: "POST",
                        data: {'id': id, '_token': "{{ csrf_token() }}", '_method': 'delete'},
                        success: function(result){
                            alert(result.message);
                            loadData(idt);
                        }
                    });
                }
            }



            </script>

</body>
</html>
