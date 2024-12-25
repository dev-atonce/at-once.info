<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
        <meta name="author" content="Łukasz Holeczek">
        <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
        <meta name="csrf-token" content="{{csrf_token()}}">

        <title>{{Config::get('app.name')}} | Webpanel</title>

        <base href="{{url('/')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon.ico">
        <link rel="stylesheet" href="back-end/fontawesome-5.15.4/css/all.css">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="theme-color" content="#ffffff">
        
        <link href="back-end/css/style.css" rel="stylesheet">
        {{-- <link href="back-end/bootstrap-4.3.1/css/bootstrap.css" rel="stylesheet"> --}}
        <link href="css/docs.min.css" rel="stylesheet">
        <link href="back-end/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
        @if(@$css)
        @foreach($css as $css)
            <link href="{{$css}}" rel="stylesheet">
        @endforeach
        @endif
        @if(@$js)
            @foreach($js as $js)
                <script src="{{$js}}"></script>
            @endforeach
        @endif
    </head>
    <style>
        .text-danger {
            color: #dc3545!important;
        }
        .text-success {
            color: #28a745!important;
        }
    </style>
    <body class="c-app flex-row">    
        <script>var c=localStorage.getItem("theme"), tag=document.getElementsByTagName('body').item(0); if(c!=''&&c!=null)tag.classList.add(c);</script>
        <div class="c-sidebar c-sidebar-light c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
            @include('back-end.layout.left-menu')
        </div>
        <div class="c-wrapper">
            @include('back-end.layout.header')
            <div class="c-body">

                <main class="c-main">
                    <div class="container-fluid">
                        @include("back-end.modules.$folder.page-$page")
                    </div>
                </main>
            </div>
            <footer class="c-footer">
                <div><a href="https://coreui.io">CoreUI</a> © 2019 creativeLabs.</div>
                <div class="mfs-auto">Powered by&nbsp;<a href="https://coreui.io/pro/">CoreUI Pro</a></div>
            </footer>          
        </div>
        <script src="back-end/vendors/pace-progress/js/pace.min.js"></script>
        <script src="back-end/vendors/@coreui/js/coreui.bundle.min.js"></script>
        <script>
            var tooltipEl = document.getElementById('header-tooltip');
            var tootltip = new coreui.Tooltip(tooltipEl);
        </script>
        <script src="back-end/build/build.js"></script>
    </body>
</html>