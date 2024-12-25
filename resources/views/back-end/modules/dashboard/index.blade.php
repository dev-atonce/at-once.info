<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
        <meta name="author" content="Łukasz Holeczek">
        <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">

        <title>{{Config::get('app.name')}} | Webpanel</title>

        <base href="{{url('/')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon.ico">
        <link rel="stylesheet" href="back-end/fontawesome-5.15.4/css/all.css">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="theme-color" content="#ffffff">
        
        <link href="back-end/css/style.css" rel="stylesheet">
        {{-- <link href="back-end/bootstrap-4.3.1/css/bootstrap.css" rel="stylesheet"> --}}
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
        <style>
            #search-btn{
                position: fixed;
                top: 1em;
                right: 1em;
                background-color: rgba(0,0,0,0.8);
                padding: 10px;
                border-radius: 2px;
                color: #FFF;
            }

            #search-btn:hover{
                background-color: rgba(0,0,0,0.5);
                cursor: pointer;
            }
            #search-overlay{
                display:none;
            }
            #search-overlay.block {
                position: fixed;
                top: 0;
                right: 0;
                bottom: 0;
                left: 0;
                overflow: auto;
                text-align: center;
                background: rgb(181 181 181 / 70%);
                margin: 0;
                z-index: 9999;
                backdrop-filter: blur(8px);
            }

            #search-overlay.block:before {
                content: '';
                vertical-align: middle;
                /* Adjusts for spacing */
                /* For visualization 
                background: #808080; width: 5px;
                */
            }

            #search-overlay .centered {
                display: inline-block;
                vertical-align: middle;
                width: 50%;
                padding: 10px 15px;
                border: none;
                background: transparent;
                margin: 40px 0 0 0;
            }

            #search-box {
                position: relative;
                width: 100%;
                margin: 0;
                border-radius: 15px;
                overflow: hidden;
                border: 1px solid #e1e1e1;
            }

            #search-form {
                display: flex;
                height: 40px;
                
                -webkit-border-radius: 2px;
                -moz-border-radius: 2px;
                background-color: #fff;
                text-align: left;
            }

            #search-text {
                font-size: 14px;
                color: #ddd;
                border-width: 0;
                background: transparent;
            }
            #search-text[placeholder] {
                color: #dedede;
            }

            #search-box input[type="text"] {
                width: 90%;
                padding: 9px;
                color: #333;
                outline: none;
            }

            #reset-button {
                outline: none;
                border: none;
                padding: 9px;
                font-weight: 500;
                color: gray;
                /* position: absolute;
                top: 0;
                right: 0;
                height: 4.7em;
                width: 100px;
                font-size: 14px;
                color: #fff;
                text-align: center;
                line-height: 42px;
                border-width: 0;
                background-color: #4d90fe;
                -webkit-border-radius: 0 2px 2px 0;
                -moz-border-radius: 0 2px 2px 0;
                border-radius: 0 2px 2px 0;
                cursor: pointer; */
            }
            #close-btn{
                position: absolute;
                right: 15px;
                top: 15px;
                color: #3b3b3b;
                cursor: pointer;
            }
            #search-box .list-search {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-direction: column;
                flex-direction: column;
                margin-bottom: 0;
                padding: 0;
            }
            #search-box .list-search .list-search-item {
                position: relative;
                display: block;
                padding: 0.5rem 0.5rem;
                margin-bottom: -1px;
                border-top: 1px solid #e1e1e1;
                border-color: rgba(0, 0, 21, .125);
                text-align: left;
            }
            .list-search-item a{
                text-decoration: none;
            }
            #search-box .list-search .list-search-item:last-child {
                border-bottom: none;
            }
        </style>
    </head>
    <body class="c-app flex-row">
        <div id="search-overlay" class="block">
            <i id="close-btn" class="fa fa-times fa-2x"></i>
            <div class="centered">
                <div id="search-box">
                    <form action="" id="search-form" method="get" target="_top">
                        <i class="fas fa-search fa-lg text-dark ml-3" style="margin-block: auto;"></i>
                        <input id="search-text" name="q" type="text">
                        <button id="reset-button" type="reset" class="d-flex justify-content-between align-items-center">
                            <i class="fas fa-undo-alt mr-1"></i>Reset
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <script>let c=localStorage.getItem("theme"), tag=document.getElementsByTagName('body').item(0); if(c!=''&&c!=null)tag.classList.add(c);</script>
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