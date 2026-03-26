<!doctype html>
<html lang="{{ Session('lang') }}">

<head>
    @include("$prefix.analytics.googleAnalytics")
    @if (Request::getHost() == 'uat.at-once.info')
        <meta name="robots" content="noindex, nofollow" />
    @endif
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $seo->seo_keyword ? $seo->seo_keyword : $seo->seo_keyword_th }}">
    <meta name="description" content="{{ $seo->seo_description ? $seo->seo_description : $seo->seo_description_th }}">

    <title>{{ $seo->title ? $seo->title : $seo->title_th }}</title>

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
    <!-- 新規追加するWebSite Schema -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "name": "At-Once Thailand Business Directory",
            "alternateName": "At-Once ไดเร็กทอรี่ธุรกิจไทย",
            "url": "https://at-once.info/th",
            "description": "ไดเร็กทอรี่ธุรกิจไทยที่ครอบคลุมที่สุด ค้นหาบริษัท ข้อมูลธุรกิจ และข่าวสารอุตสาหกรรมในภาษาไทยและอีก 18 ภาษา พร้อมข้อมูลที่ถูกต้องและทันสมัย",
            "inLanguage": "th",
            "publisher": {
                "@type": "Organization",
                "name": "At-Once",
                "logo": {
                "@type": "ImageObject",
                "url": "https://at-once.info/img/at-once-tw.png"
                }
            },
            "potentialAction": [
                {
                "@type": "SearchAction",
                "target": {
                    "@type": "EntryPoint",
                    "urlTemplate": "https://at-once.info/th/search?q={search_term_string}",
                    "actionPlatform": [
                    "http://schema.org/DesktopWebPlatform",
                    "http://schema.org/MobileWebPlatform"
                    ]
                },
                "query-input": "required name=search_term_string"
                }
            ]
        }
    </script>
    <!-- WebApplication Schema -->
    <script type="application/ld+json">
        {  
            "@context": "https://schema.org",  
            "@type": "WebApplication",  
            "name": "At-Once B2B Business Matching Platform",  
            "url": "https://at-once.info/th",  
            "description": "At-Once คือแพลตฟอร์มจับคู่ธุรกิจ B2B ที่ใหญ่ที่สุดในประเทศไทย เชื่อมโยงผู้ซื้อและผู้ให้บริการกว่า 160,000 รายใน 177 หมวดธุรกิจ",  
            "applicationCategory": "BusinessApplication",  
            "operatingSystem": "Web",  
            "offers": {    
                "@type": "Offer",    
                "price": "0",    
                "priceCurrency": "THB",    
                "description": "ลงทะเบียนฟรี — ค้นหาพันธมิตรธุรกิจได้ทันที"  
            },  
            "provider": {    
                "@type": "Organization",    
                "name": "1-CE WIND CO., LTD.",    
                "url": "https://at-once.info/th"  
            }
        }
    </script>
    <!-- Service Schema -->
    <script type="application/ld+json">
        {  
            "@context": "https://schema.org",  
            "@type": "Service",  
            "serviceType": "B2B Business Matching",  
            "name": "At-Once — บริการจับคู่ธุรกิจ B2B",  
            "description": "บริการเชื่อมโยงผู้ประกอบการและบริษัทในประเทศไทย ช่วยให้ธุรกิจพบกับลูกค้า คู่ค้า และพันธมิตรที่ตรงความต้องการ",  
            "provider": {    
                "@type": "Organization",    
                "name": "At-Once",    
                "url": "https://at-once.info/th"  
            },  
            "areaServed": { 
                "@type": "Country", 
                "name": "Thailand" 
            },  
            "audience": {    
                "@type": "BusinessAudience",    
                "audienceType": 
                "B2B Companies in Thailand"  
            }
        }
    </script>

    <meta property="og:title" content="{{ $seo->title ? $seo->title : $seo->title_th }}">
    <meta property="og:description"
        content="{{ $seo->seo_description ? $seo->seo_description : $seo->seo_description_th }}">
    <meta property="og:image" content="{{ url('img/logo-bg-white.jpg') }}">
    <meta property="og:url" content="{{ url(Session('lang')) }}">

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <!-- Preload notification image -->
    <link rel="preload" href="img/At-Once_warning.webp" as="image">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/filter-v2.css?v=30">
    <link rel="stylesheet" href="css/style.css?v=1">
    <link rel="stylesheet" href="css/panel-box.css?v=1">
    <link rel="stylesheet" href="css/card-list.css">
    <link rel="stylesheet" href="slick/slick.min.css">
    <link rel="stylesheet" href="slick/slick-custom.css">
    <link rel="stylesheet" href="css/hunterPopup.css">
    <link rel="stylesheet" href="css/validate.css">
    {{-- <link rel="stylesheet" href="css/news.css"> --}}
    <link rel="stylesheet" href="css/category-v2.css?v=1">
    <link rel="stylesheet" href="css/bootstrap-select-1.13.14/bootstrap-select.css">
    <style>
        .slick-dots button {
            display: block;
            background-color: #eaeaea !important;
            width: 15px !important;
            height: 15px !important;
            border-radius: 20px !important;
            color: transparent !important;
        }

        .slick-dots .slick-active button {
            background-color: #d3d3d3 !important;
            /* background-color: #aeaeae; */
        }

        .slick-dots li button:before {
            color: unset !important;
        }

        /* Notification Modal Styles */
        #notificationModal .modal-content {
            border: none;
            border-radius: 15px;
            overflow: visible;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            width: auto;
            background: transparent;
            position: relative;
        }

        #notificationModal .btn-close {
            position: absolute;
            top: 10px;
            right: 10px;
            background: rgba(0, 0, 0, 0.8);
            border-radius: 50%;
            width: 40px;
            height: 40px;
            border: 2px solid rgba(255, 255, 255, 0.9);
            font-size: 20px;
            color: #ffffff;
            z-index: 11;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        #notificationModal .btn-close:hover {
            background: rgba(255, 0, 0, 0.9);
            border-color: #ffffff;
            color: #ffffff;
            transform: scale(1.1);
        }

        #notification {
            font-size: 16px;
            padding: 2px 40px 2px 40px;
            line-height: 1.5;
            text-align: center;
        }

        /* Responsive */
        @media (max-width: 576px) {
            #notificationModal .modal-content {
                max-width: calc(100% - 20px);
            }
            
            #notificationModal .btn-close { 
                width: 35px;
                height: 35px;
                font-size: 18px;
                top: 5px;
                right: 5px;
            }

            #notification {
                font-size: 12px;
                padding: 2px 10px 2px 10px;
                line-height: 1.3;
                text-align: center;
            }
        }
    </style>
</head>

<body class="main_page">
    @include("$prefix.header")
    <div id="notification"> <span class="text-danger">โปรดระวัง!!</span> เนื่องจากมีมิจฉาชีพแอบอ้างชื่อบริษัท ซึ่งทางบริษัทไม่มีนโยบายเชิญชวนให้ทำงานหรือประกาศรับสมัครงานผ่านช่องทางออนไลน์ใดๆทั้งสิ้น</div>
    @include("$prefix.filter-main")

    {{-- @include("$prefix.bigcategory-v2") --}}
    <!-- update270423 -->
    <section class="page p-0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center mt-5 mb-3">
                        <strong>@lang('phrase.recommend.company')
                            <span class="v1-orange">At-Once</span>
                        </strong>
                    </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 recommend-customer">
                    @foreach ($recommend as $k => $v)
                        <div class="col-lg-3 col-md-6 col-6 mb-4">
                            <div class="reccommend-company p-4">
                                <a class="countOfClick" data-id="{{ $v->id }}" target="_blank"
                                    href="{{ url("$lang/$v->categoryKey/cp/$v->companyUrl") }}">
                                    <div class="rec-badge float-right">
                                        {{ $v->categoryName ? $v->categoryName : $v->categoryNameTH }}</div>
                                    <img src="{{ $v->logo }}"
                                        alt="{{ $v->companyName ? $v->companyName : $v->companyNameTH }}"
                                        class="img-fluid img-logo-cus">
                                    <div class="cp_name text-center skiptranslate"
                                        data-en="{{$v->companyNameEN}}"
                                        data-th="{{$v->companyNameTH}}"
                                    >
                                        {{ $v->companyName ? $v->companyName : $v->companyNameTH }}</div>
                                    <p class="text-center">
                                        {{ $v->companyDescription ? $v->companyDescription : $v->description_th }}</p>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <style type="text/css">
            @media (min-width: 320px) {

                .blog-list:nth-child(5),
                .blog-list:nth-child(6),
                .blog-list:nth-child(7),
                .blog-list:nth-child(8),
                .blog-list:nth-child(9),
                .blog-list:nth-child(10),
                .blog-list:nth-child(11),
                .blog-list:nth-child(12),
                .blog-list:nth-child(13),
                .blog-list:nth-child(14),
                .blog-list:nth-child(15) {
                    display: none !important;
                }
            }

            @media (min-width: 768px) {
                .blog-list:nth-child(15) {
                    display: none !important;
                }

                .blog-list:nth-child(5),
                .blog-list:nth-child(6) {
                    display: flex !important;
                }
            }

            @media (min-width: 992px) {

                .blog-list:nth-child(13),
                .blog-list:nth-child(14),
                .blog-list:nth-child(15) {
                    display: none !important;
                }

                .blog-list:nth-child(5),
                .blog-list:nth-child(6),
                .blog-list:nth-child(7),
                .blog-list:nth-child(8) {
                    display: flex !important;
                }
            }

            @media (min-width: 1200px) {
                .col-xl-2-5 {
                    -ms-flex: 0 0 20%;
                    flex: 0 0 20%;
                    max-width: 20%;
                }

                .blog-list:nth-child(5),
                .blog-list:nth-child(6),
                .blog-list:nth-child(7),
                .blog-list:nth-child(8),
                .blog-list:nth-child(9),
                .blog-list:nth-child(10),
                .blog-list:nth-child(11),
                .blog-list:nth-child(12),
                .blog-list:nth-child(13),
                .blog-list:nth-child(14),
                .blog-list:nth-child(15) {
                    display: flex !important;
                }
            }
        </style>

    </section>

    {{-- <section class="industry-recommend mt-3">
            @include('front-end.industry')
        </section> --}}
    <section id="section-categories" class="section-category py-3" style="background-color: #f3f3f3;">
        <div class="container">
            <div class="category-content">
                <div class="search-content">
                    @include("$prefix.bigcategory-v2")
                </div>

            </div>
        </div>
    </section>

    <section class="page bg-gray">
        <div class="container">
            <div class="title_site">
                <h3><strong>@lang('phrase.header.blog-company') @lang('phrase.header.company')</strong></h3>
                <div class="hashtags">#The Best Business Blogs You Should Actually Take the Time to Read (By Our
                    Customer)</div>
            </div>
            <div class="row">
                @foreach ($blogCustomer as $k => $v)
                    <div class="col-xl-2-5 col-lg-3 col-md-6 d-flex blog-list" data-key="{{ $v->key }}">
                        <div class="blog-container">
                            <div class="blog-header">
                                <div class="post-meta">
                                    @if ($v->by != '')
                                        <a class="company-logo" data-name="{{ $v->by }}"
                                            href="{{ Session('lang') }}/{{ $v->key }}/cp/{{ $v->by_url }}">
                                            <img src="{{ $v->by_logo }}" alt="">
                                        </a>
                                        <div class="createdby">
                                            <div>
                                                <a href="{{ Session('lang') }}/{{ $v->key }}/cp/{{ $v->by_url }}"
                                                    class="written-by">
                                                    @if ($v->by != '')
                                                        {{ $v->by }}
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="industry-name">
                                                <i class="fas fa-circle bullet --c-blue"></i>
                                                {{ $v->categoryName }}
                                            </div>
                                        </div>
                                    @else
                                        <a class="company-logo" href="{{ Session('lang') }}" data-name=""><img
                                                src="img/at-once.jpg">
                                        </a>
                                        <div class="createdby">
                                            <div class="written-by">
                                                {{ env('APP_NAME') }}
                                            </div>
                                            <div class="industry-name">
                                                <i class="fas fa-circle bullet --c-blue"></i>
                                                {{ $v->categoryName }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="blog-cover">
                                    <a href="{{ Session('lang') }}/blog/{{ $v->url }}">
                                        <img src="{{ str_replace('.', '-xs.', $v->images) }}" class=""
                                            alt="{{ $v->name }}" />
                                    </a>
                                </div>
                            </div>
                            <div class="blog-body">
                                <div>
                                    <ul class="published-date">
                                        <li class=""><i class="far fa-calendar-alt"></i>
                                            {{ date('d-m-y', strtotime($v->publish)) }}
                                        </li>
                                        <li class=""><i class="far fa-eye"></i> {{ $v->view }}</li>
                                    </ul>
                                </div>
                                <div class="blog-title">
                                    <a href="{{ Session('lang') }}/blog/{{ $v->url }}">
                                        <h4>{{ $v->name ? $v->name : $v->name_th }}</h4>
                                    </a>
                                </div>
                                <p>{{ $v->detail ? $v->detail : $v->detail_th }}</p>
                            </div>
                            <div class="blog-footer">
                                <div class="border-3x --border-blue"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    <center>
                        <a class="btn btn-orange"
                            href="{{ url(Session('lang')) }}/blog-company">@lang('phrase.see-all')</a>
                    </center>
                </div>
            </div>
        </div>
    </section>
    <section class="page">
        <div class="container">
            <div class="title_site">
                <h3><strong>@lang('phrase.header.at-once-blog')</strong></h3>
                <div class="hashtags">#The Best Business Blogs You Should Actually Take the Time to Read (By At-Once)
                </div>
            </div>
            <div class="row">
                @foreach ($blog as $k => $v)
                    <div class="col-xl-2-5 col-lg-3 col-md-6 d-flex blog-list" data-key="{{ $v->key }}">
                        <div class="blog-container">
                            <div class="blog-header">
                                <div class="post-meta">
                                    @if ($v->by != '')
                                        <a class="company-logo" data-name="{{ $v->by }}"
                                            href="{{ Session('lang') }}/{{ $v->key }}/cp/{{ $v->by_url }}">
                                            <img src="{{ $v->by_logo }}" alt="">
                                        </a>
                                        <div class="createdby">
                                            <div>
                                                <a href="{{ Session('lang') }}/{{ $v->key }}/cp/{{ $v->by_url }}"
                                                    class="written-by">
                                                    @if ($v->by != '')
                                                        {{ $v->by }}
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="industry-name">
                                                <i class="fas fa-circle bullet --c-skyblue"></i>
                                                {{ $v->categoryName }}
                                            </div>
                                        </div>
                                    @else
                                        <a class="company-logo" href="{{ Session('lang') }}" data-name="">
                                            <img src="img/at-once.jpg">
                                        </a>
                                        <div class="createdby">
                                            <div class="written-by">
                                                {{ env('APP_NAME') }}
                                            </div>
                                            <div class="industry-name">
                                                <i class="fas fa-circle bullet --c-skyblue"></i>
                                                {{ $v->categoryName }}
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="blog-cover">
                                    <a href="{{ Session('lang') }}/blog/{{ $v->url }}">
                                        <img src="{{ str_replace('.', '-xs.', $v->images) }}" class=""
                                            alt="{{ $v->name }}" />
                                    </a>
                                </div>
                            </div>
                            <div class="blog-body">
                                <div>
                                    <ul class="published-date">
                                        <li class=""><i class="far fa-calendar-alt"></i>
                                            {{ date('d-m-y', strtotime($v->publish)) }}</li>
                                        <li class=""><i class="far fa-eye"></i> {{ $v->view }}</li>
                                    </ul>
                                </div>
                                <div class="blog-title">
                                    <a href="{{ Session('lang') }}/blog/{{ $v->url }}">
                                        <h4>{{ $v->name ? $v->name : $v->name_th }}</h4>
                                    </a>
                                </div>
                                <p>{{ $v->detail ? $v->detail : $v->detail_th }}</p>
                            </div>
                            <div class="blog-footer">
                                <div class="border-3x --border-skyblue"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    <center>
                        <a class="btn btn-orange" href="{{ url(Session('lang')) }}/blog">@lang('phrase.see-all')</a>
                    </center>
                </div>
            </div>
        </div>
    </section>
    <section class="page bg-gray">
        <div class="container">
            <div class="title_site">
                <h3><strong>@lang('phrase.header.blog-marketing')</strong></h3>
                <div class="hashtags">#The Ways to Improve Your Business.</div>
            </div>
            <div class="row">
                @foreach ($blogMarketing as $k => $v)
                    <div class="col-xl-2-5 col-lg-3 col-md-6 d-flex blog-list" data-key="{{ $v->key }}">
                        <div class="blog-container">
                            <div class="blog-header">
                                <div class="post-meta">
                                    @if ($v->by != '')
                                        <a class="company-logo" data-name="{{ $v->by }}"
                                            href="{{ Session('lang') }}/{{ $v->key }}/cp/{{ $v->by_url }}">
                                            <img src="{{ $v->by_logo }}" alt="">
                                        </a>
                                        <div class="createdby">
                                            <div>
                                                <a href="{{ Session('lang') }}/{{ $v->key }}/cp/{{ $v->by_url }}"
                                                    class="written-by">
                                                    @if ($v->by != '')
                                                        {{ $v->by }}
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="industry-name">
                                                <i class="fas fa-circle bullet --c-orange"></i>
                                                @lang('phrase.header.marketing-blog')
                                            </div>
                                        </div>
                                    @else
                                        <a class="company-logo" href="{{ Session('lang') }}" data-name="">
                                            <img src="img/at-once.jpg">
                                        </a>
                                        <div class="createdby">
                                            <div class="written-by">
                                                {{ env('APP_NAME') }}
                                            </div>
                                            <div class="industry-name">
                                                <i class="fas fa-circle bullet --c-orange"></i>
                                                @lang('phrase.header.marketing-blog')
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="blog-cover">
                                    <a href="{{ Session('lang') }}/blog/{{ $v->url }}">
                                        <img src="{{ str_replace('.', '-xs.', $v->images) }}" class=""
                                            alt="{{ $v->name }}" />
                                    </a>
                                </div>
                            </div>
                            <div class="blog-body">
                                <div>
                                    <ul class="published-date">
                                        <li class=""><i class="far fa-calendar-alt"></i>
                                            {{ date('d-m-y', strtotime($v->publish)) }}</li>
                                        <li class=""><i class="far fa-eye"></i> {{ $v->view }}</li>
                                    </ul>
                                </div>
                                <div class="blog-title">
                                    <a href="{{ Session('lang') }}/blog/{{ $v->url }}">
                                        <h4>{{ $v->name ? $v->name : $v->name_th }}</h4>
                                    </a>
                                </div>
                                <p>{{ $v->detail ? $v->detail : $v->detail_th }}</p>
                            </div>
                            <div class="blog-footer">
                                <div class="border-3x --border-orange"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12">
                    <center>
                        <a class="btn btn-orange"
                            href="{{ url(Session('lang')) }}/blog-package">@lang('phrase.see-all')</a>
                    </center>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container">
            <div class="row mb-4 pt-4">
                <div class="col-lg-12">
                    <a href="https://www.at-once.info/th/promotion-package">
                        <img src="images/join-atonce.webp" class="img-fluid radius-lg"
                            alt="ร่วมเป็นส่วนหนึ่งกับเว็บไซต์ At Once เพิ่มโอกาสสร้างยอดขายให้กับธุรกิจของคุณได้ง่ายๆ"
                            width="100%">
                    </a>
                </div>
            </div>
        </div>
    </section>
    
    @include("$prefix.analytics.gtagBody")
    @include("$prefix.footer")

    <!-- Notification Modal -->
    <!-- <div class="modal fade d-flex justify-content-center align-items-center" id="notificationModal" tabindex="-1" aria-hidden="true" data-backdrop="true" data-keyboard="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content" onclick="closeModal()">
                <button type="button" class="btn-close" onclick="closeModal()" aria-label="Close">X</button>
                <img src="img/At-Once_warning.webp" alt="แจ้งเตือน" class="img-fluid" style="width: 100%; height: auto; max-height: 70vh; border-radius: 10px;">
            </div>
        </div>
    </div> -->

    <script src="js/jquery.js"></script>
    <!-- Optional JavaScript -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.10.0/js/lightgallery.min.js" integrity="sha512-gDBgGPXSeC2hx1W3S1CfSHbAValtLI8OArTGf0UVX7Fwb9Ak7HUE3LK9UEZxKGYVrIe0CJUVZDk9B2dIPwJ6VQ==" crossorigin="anonymous"></script> --}}
    <script src="js/lightgallery.js"></script>
    <script src="js/lg-fullscreen.js"></script>
    <script src="js/lg-thumbnail.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/filter-main.js?v=04"></script>
    <script src="js/jquery-popup.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en">
    </script>
    <script type="text/javascript" src="js/custom.js?v=0008"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    <script type="text/javascript" src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
    <script type="text/javascript" src="slick/slick.min.js"></script>
    <script type="text/javascript" src="slick/custom.js?v=001"></script>
    <script type="text/javascript" src="slick/main.js"></script>
    {{-- <script type="text/javascript" src="js/color.js"></script> --}}
    {{-- <script type="text/javascript" src="js/blog.color.js"></script> --}}
    <script type="text/javascript" src="js/bootstrap-select-1.13.14/bootstrap-select.js"></script>
    <script src="plugin/sweetalert2/sweetalert2.all.js"></script>
    <script src="js/axios.min.js"></script>

    <script type="text/javascript">

        
        const settings = {
            dots: true,
            infinite: true,
            slidesToShow: 5,
            slidesToScroll: 1,
            arrows: false,
            autoplay: true,
            autoplaySpeed: 0,
            speed: 4500,
            cssEase: 'linear',
            pauseOnHover: true,
            responsive: [{
                    breakpoint: 1200,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4
                    }
                },
                {
                    breakpoint: 900,
                    settings: {
                        slidesToShow: 3
                    }
                },
                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 2
                    }
                },
                {
                    breakpoint: 420,
                    settings: {
                        slidesToShow: 2
                    }
                }
            ]
        };

        const sl = $('.recommend-customer').slick(settings);

        $(window).on('resize', function() {
            if ($(window).width() > 420 && !sl.hasClass('slick-initialized')) {
                $('.recommend-customer').slick(settings);
            }
        })

        $('.select-picker').selectpicker({
            'liveSearch': true,
            'noneSelectedText': '{{ __('phrase.select-industry') }}',
            'liveSearchPlaceholder': '{{ __('phrase.select-industry') }}',
            'width': '100%',
            'style': 'btn-light'
        })

        $(document).ready(function() {
            var stickyToggle = function(sticky, stickyWrapper, scrollElement) {
                var stickyHeight = sticky.outerHeight();
                var stickyTop = stickyWrapper.offset().top;
                var $navbar = $(".industry-recommend");
                var y_pos = $navbar?.offset()?.top;
                var height = $navbar?.height();
                if (scrollElement.scrollTop() >= y_pos) {
                    stickyWrapper.height(stickyHeight);
                    sticky.addClass("is-sticky");
                } else {
                    sticky.removeClass("is-sticky");
                    stickyWrapper.height('auto');
                }
            };

            $('[data-toggle="sticky-onscroll"]').each(function() {
                var sticky = $(this);
                var stickyWrapper = $('<div>').addClass('sticky-wrapper');
                sticky.before(stickyWrapper);
                sticky.addClass('sticky');

                $(window).on('scroll.sticky-onscroll resize.sticky-onscroll', function() {
                    stickyToggle(sticky, stickyWrapper, $(this));
                });

            });
        });
        var d = $.fn.deviceDetector;
        if (d.isMobile()) {
            $('.sponsor').find('img').each(function() {
                $(this).attr('src', $(this).attr('data-xs'));
            });
        }
        if (d.isMobile()) {
            $('.sponsor').find('img').each(function() {
                $(this).attr('src', $(this).attr('data-xs'));
            });
        }

        // ================

        jQuery(document).ready(function($) {
            tab = $('.tabs h3 a');

            tab.on('click', function(event) {
                event.preventDefault();
                tab.removeClass('active');
                $(this).addClass('active');

                tab_content = $(this).attr('href');
                $('div[id$="tab-content"]').removeClass('active');
                $(tab_content).addClass('active');
            });
        });

        // ========================================
        $(".tabs a").on("click", function() {
            var id = $(this).attr("id");
            if (id == 1) {
                $(".big-category01").css("display", "block");
                $("#login").css("display", "none");
            } else {
                $(".big-category01").css("display", "none");
                $("#forgetP").css("display", "none");
                $("#login").css("display", "block");
            }
        });
        $(".reset").on("click", function() {
            $("#login").css("display", "block");
            $("#forgetP").css("display", "none");
        });
        $(".forget-password").on("click", function() {
            $(".big-category01").css("display", "none");
            $("#login").css("display", "none");
            $("#forgetP").css("display", "block");
        })

        function animationHover(element, animation) {
            element = $(element);
            element.hover(
                function() {
                    element.addClass('animated ' + animation);
                    //wait for animation to finish before removing classes
                    window.setTimeout(function() {
                        element.removeClass('animated ' + animation);
                    }, 2000);
                }
            );
        };
        animationHover("input[type=button]", "shake");

        $(".cards-industry").on("click", function() {

            if ($(".cards-industry").hasClass("active")) {
                $(".cards-industry").removeClass("active");
            }

            $(this).addClass("active");

        });

        $(document).on('click', '.countOfClick', function() {
            axios({
                url: 'api/count-of-click',
                method: 'post',
                data: {
                    company: $(this).attr('data-id'),
                    type: "recommend-to-cp"
                }
            })
        });
        const displayName = () => {
            setTimeout(()=>{
                const hl = document.getElementsByTagName('html')[0].getAttribute('lang');
                const allCompanyRecommend = document.querySelector('.recommend-customer').querySelectorAll('.col-lg-3');
                allCompanyRecommend.forEach((row,i)=>{
                    if (hl == 'th') row.querySelector('.cp_name').innerHTML = row.querySelector('.cp_name').getAttribute('data-th')
                    else row.querySelector('.cp_name').innerHTML = row.querySelector('.cp_name').getAttribute('data-en')
                })
            },1000);
        }
        displayName()
        document.addEventListener('change',function(e){
            console.log(e.target)
            const languageSwitch = e.target.closest('.goog-te-combo');
            if(languageSwitch) displayName();
        })

        // Simple close function
        function closeModal() {
            $('#notificationModal').modal('hide');
        }
        
        // Handle modal events properly
        $('#notificationModal').on('hidden.bs.modal', function () {
            // Remove modal backdrop if it remains
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open');
            $('body').css('padding-right', '');
            // Remove modal from DOM completely
            $('#notificationModal').remove();
        });
        
        // Auto show modal after 2 seconds
        setTimeout(function() {
            $('#notificationModal').modal('show');
        }, 2000);
        
    </script>
</body>

</html>
