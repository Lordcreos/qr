
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" href="img/logo.svg">
    <title> {{$account_info != NULL ? $account_info->application_name:"Chef Digital Menu"}}</title>


    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="{{asset($account_info != NULL ? $account_info->application_logo:"http://placehold.it/144.png/000/fff")}}">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="{{asset($account_info != NULL ? $account_info->application_logo:"http://placehold.it/144.png/000/fff")}}">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="{{asset($account_info != NULL ? $account_info->application_logo:"http://placehold.it/144.png/000/fff")}}">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="{{asset($account_info != NULL ? $account_info->application_logo:"http://placehold.it/144.png/000/fff")}}">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="{{asset($account_info != NULL ? $account_info->application_logo:"http://placehold.it/144.png/000/fff")}}">
    <!-- Slick Slider -->
        <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.min.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick-theme.min.css')}}"/>
{{--    <link href="{{asset('css/app.css')}}" rel="stylesheet">--}}
<!-- Icofont Icon-->
    <link href="{{asset('vendor/icons/icofont.min.css')}}" rel="stylesheet" type="text/css">
    <!-- Bootstrap core CSS -->
    <link href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{asset('css/custom_style.css')}}" rel="stylesheet">
    <!-- Sidebar CSS -->
    <link href="{{asset('vendor/sidebar/demo.css')}}" rel="stylesheet">


    <!-- Required jquery and libraries -->

    <script src="{{asset('vendor/bootstrap/js/bootstrap.bundle.min.js')}}" type="a8991de296182f37e0c28854-text/javascript"></script>
    <!-- slick Slider JS-->
    <script type="a8991de296182f37e0c28854-text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>
    <!-- Sidebar JS-->
    <script type="a8991de296182f37e0c28854-text/javascript" src="{{asset('vendor/sidebar/hc-offcanvas-nav.js')}}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{asset('js/osahan.js')}}" type="a8991de296182f37e0c28854-text/javascript"></script>
    <script src="{{asset('js/rocket-loader.min.js')}}" data-cf-settings="a8991de296182f37e0c28854-|49" defer=""></script></body>
    <script src="{{ asset('js/app.js')}}" defer></script>



</head>

<body>

@yield('home_content')

</body>

<script>
    function myFunction() {
        var input = document.getElementById("Search");
        var filter = input.value.toLowerCase();
        var nodes = document.getElementsByClassName('search');
        for (i = 0; i < nodes.length; i++) {
            if (nodes[i].innerText.toLowerCase().includes(filter)) {
                nodes[i].style.display = "block";
            } else {
                nodes[i].style.display = "none";
            }
        }
    }
    function test() {
        var x = document.getElementById("snackbar");
        x.className = "show";
        setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
    }
</script>







</html>

