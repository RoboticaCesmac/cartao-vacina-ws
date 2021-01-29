<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Title Page-->
    <title>Login</title>

    <!-- Fontfaces CSS-->
    <link href="{{asset('css/font-face.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('others/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('others/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('others/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

    <!-- Bootstrap CSS-->
    <link href="{{asset('others/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

    <!-- others CSS-->
    <link href="{{asset('others/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('others/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('others/wow/animate.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('others/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('others/slick/slick.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('others/select2/select2.min.css')}}" rel="stylesheet" media="all">
    <link href="{{asset('others/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="{{asset('css/theme.css')}}" rel="stylesheet" media="all">

</head>

<body class="animsition">
    <div class="page-wrapper">
        <div class="page-content--bge5">
            <div class="container">
                <div class="login-wrap">
                    
                    @yield('conteudo_principal')

                </div>
            </div>
        </div>

    </div>

    <!-- Jquery JS-->
    <script src="{{asset('others/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('others/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('others/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- others JS       -->
    <script src="{{asset('others/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('others/wow/wow.min.js')}}"></script>
    <script src="{{asset('others/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('others/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('others/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('others/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('others/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('others/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('others/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('others/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{asset('js/main.js')}}"></script>

</body>

</html>
<!-- end document-->

