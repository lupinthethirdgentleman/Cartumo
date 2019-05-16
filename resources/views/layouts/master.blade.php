<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="{{ asset('frontend/img/favicon.ico') }}" type="image/x-icon">
        <title>
            @section('title')
            | Cartumo
            @show
        </title>

        <link href="{{ asset('frontend/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/fonts.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/margins-min.css') }}" rel="stylesheet">
        <link href="{{ asset('frontend/css/responsive-style.css') }}" rel="stylesheet">

        <link href="https://fonts.googleapis.com/css?family=Poppins:400,500,600,700" rel="stylesheet">

        <!--page level css-->
        @yield('header_styles')
        <!--end of page level css-->

    </head>

    <body>
	<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/593f5e7db3d02e11ecc69941/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

        @yield('layout_content')

        <script type="text/javascript" src="{{ asset('frontend/js/jquery.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
        <!-- <script type="text/javascript" src="{{ asset('js/jquery.interactive_bg.js') }}"></script> -->

        <!-- begin page level js -->
        @yield('footer_scripts')
        <!-- end page level js -->
    </body>

    <script>
        $(window).scroll(function() {
            if ($(this).scrollTop() > 1){
                $('header').addClass("sticky");
            }
            else{
                $('header').removeClass("sticky");
            }
        });
    </script>

</html>
