<!doctype html>
<html lang="th">
<head>
    @include("$prefix.analytics.googleAnalytics")
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="keywords" content="{{ $seo->seo_keyword }}">
    <meta name="description" content="{{ $seo->seo_description }}">
    <meta name="author" content="at-once.info">

    <title>{{ $seo->title }}</title>

    <!-- 既存のOrganization Schema（SearchAction削除版） -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "At-Once",
            "url": "https://at-once.info",
            "logo": {
                "@type": "ImageObject",
                "url": "https://at-once.info/img/at-once-tw.png"
            },
            "description": "แหล่งรวบรวมข้อมูลธุรกิจครบวงจรสำหรับค้นหารายชื่อบริษัทจากทุกอุตสาหกรรมในประเทศไทย ผู้ให้บริการเว็บไซต์รวมรายชื่อบริษัทอันดับหนึ่ง พร้อมข้อมูลสำคัญอย่างละเอียดถูกต้องและทันสมัย",
            "areaServed": {
                "@type": "Country",
                "name": "Thailand"
            }
            }
    </script>

    <!-- BreadcrumbList Schema -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                "@type": "ListItem",
                "position": 1,
                "name": "หน้าแรก",
                "item": "https://at-once.info/th"
                },
                {
                "@type": "ListItem",
                "position": 2,
                "name": "{{ $categoryName }}",
                "item": "https://at-once.info/th/{{ $module }}"
                }
            ]
        }
    </script>

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="SBEehLLGMBDzOMbSEIBIf15L3etk2d7P1_cYrwo97rk" />

    <meta property="og:title" content="{{ $seo->title }}">
    <meta property="og:description" content="{{ $seo->seo_description }}">
    <meta property="og:image" content="{{ url('img/logo-bg-white.jpg') }}">
    <meta property="og:url" content="{{ url(Session('lang')) }}">

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">

    <link rel="stylesheet" href="css/header-footer.css?v=0006">
    <link rel="stylesheet" href="css/style.css?v=0005">
    <link rel="stylesheet" href="css/card-list.css?v=0005">
    <link rel="stylesheet" href="css/filter.css?v=0004">
    <link rel="stylesheet" href="css/panel-box.css?v=07">
    <link rel="stylesheet" href="slick/slick.min.css">
    <link rel="stylesheet" href="slick/slick-custom.css?v=001">
    <link rel="stylesheet" href="css/detail.css">
    <link rel="stylesheet" href="css/hunterPopup.css">
    <link rel="stylesheet" href="css/validate.css">
    <link rel="stylesheet" href="css/gallery.css?v=002">
    <link rel="stylesheet" href="css/lightgallery.css">
    <script id="_bownow_ts">
        var _bownow_ts = document.createElement('script');
        _bownow_ts.charset = 'utf-8';
        _bownow_ts.src = 'https://contents.bownow.jp/js/UTC_b802ee958490cdec3853/trace.js';
        document.getElementsByTagName('head')[0].appendChild(_bownow_ts);
    </script>
</head>


<body class="main_page">
    {{-- Header --}}
    @include("$prefix.header")
    @include("$prefix.layout.filter")
    @include("$prefix.sponsor")
    {{-- Form contact in Desktop device --}}
    <section class="company-form">
        <div class="container">
            <div class="card-profile-company">
                <div class="row align-items-stretch form-content">
                    @include("$prefix.company-list")
                    @include('front-end.form-contact-right')
                </div>
            </div>
        </div>
    </section>
    {{-- Modal How to Send Form --}}
    <div class="modal fade" id="email-popup" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-body p-0">
                    <img src='images/popup-email.webp' class='img-fluid'>
                </div>
            </div>
        </div>
    </div>
    <br>
    {{-- Company list --}}
    <section class="mt-4">@include("$prefix.blog-company-list")</section>
    {{-- Blog list --}}
    <section class="mt-4">@include("$prefix.blog-list")</section>
    {{-- About this category section --}}
    @include('front-end.layout.about')
    {{-- {{$aboutThis}}
    @if(@$aboutThis) @include($aboutThis) @endif --}}
    {{-- More industry --}}
    {{-- <section class="page"><div class="container">@include("$prefix.category-relate")</div></section> --}}
    {{-- Form contact in mobile device --}}
    <section class="d-lg-none" style="position:fixed;z-index:102;">@include('front-end.mobile-form-contact')</section>
    {{-- Footer --}}
    
    @include("$prefix.analytics.gtagBody")
    @include("$prefix.footer")
    @include("$prefix.modal-cp-detail")

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Optional JavaScript -->
    <script src="js/jquery-popup.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.10.0/js/lightgallery.min.js" integrity="sha512-gDBgGPXSeC2hx1W3S1CfSHbAValtLI8OArTGf0UVX7Fwb9Ak7HUE3LK9UEZxKGYVrIe0CJUVZDk9B2dIPwJ6VQ==" crossorigin="anonymous"></script> --}}
    <script type="text/javascript" src="js/img-detect.js"></script>
    <script src="js/lightgallery.js"></script>
    <script src="js/lg-fullscreen.js"></script>
    <script src="js/lg-thumbnail.js"></script>

    <!-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script> -->

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script type="text/javascript" src="js/custom.js?v=00010"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    <script type="text/javascript" src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>

    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script type="text/javascript" src="slick/custom.js"></script>
    <script type="text/javascript" src="slick/main.js"></script>

    <script src="plugin/sweetalert2/sweetalert2.all.js"></script>
    <script type="text/javascript" src="js/banner.js"></script>
    {{-- <script type="text/javascript" src="js/filter.js"></script> --}}
    <script src="js/axios.min.js"></script>
    <script src="js/counter.js"></script>
    <script src="js/chatbox.js"></script>

    <script src="js/popup-category.js?v=0007"></script>
    <script src="js/contact-function.js?"></script>
    <script src="js/custom-form-contact.js?v=001"></script>
    {{-- <script src="js/blog.color.js"></script> --}}
    <script src="js/email-newtab.js"></script>
    <script src="js/build/more.query.js?v=0002"></script>
    <script>
        var category = window.location.pathname.split('/')[2];
        setTimeout(() => {
            let cookie = new Map(document.cookie.split('; ').map(v=>v.split(/=(.*)/s).map(decodeURIComponent)))
            if (!cookie.get('popUp')) {
                let date = new Date(Date.now() + 86400e3);
                date = date.toUTCString();
                document.cookie = "popUp=1; expires=" + date;
                $('#email-popup').modal('show');
            }
        }, 8000);

        var pathname = window.location.pathname;
        localStorage.removeItem('re');
        window.addEventListener('beforeunload', function(e) {
            localStorage.setItem('re', pathname);
        })
        $(document).ready(function() {
            if (window.location.search != '') {
                $('html,body').animate({
                    scrollTop: 720
                }, 800);
            }
        });

        function converseToJson(data) {
            if (data != null && typeof data === 'string') {
                if (typeof data === 'string') {
                    geoIp = data.replace('geoip', '');
                    geoIp = geoIp.replace('(', '');
                    geoIp = geoIp.replace(')', '');
                    geoIp = JSON.parse(geoIp);
                    return geoIp;
                } else {
                    return geoIp;
                }
            } else {
                return null;
            }
        }

        $(document).on('click', '.countOfClickBanner', function() {
            let geo = converseToJson(geoIp);
            axios({
                url: 'api/count-of-click-banner',
                method: 'post',
                data: {
                    company: $(this).attr('data-id'),
                    ip: geoIp.ip
                }
            })
        })
    </script>
</body>

</html>
