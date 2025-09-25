<!doctype html>
<html lang="en">

<head>
    @include("$prefix.analytics.googleAnalytics")
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $seo->seo_keyword ? $seo->seo_keyword : $seo->seo_keyword_th }}">
    <meta name="description" content="{{ $seo->seo_description ? $seo->seo_description :  $seo->seo_description_th }}">

    <title>{{ $seo->title ? $seo->title : $seo->title_th }}</title>

    <meta property="og:title" content="{{ $seo->title ? $seo->title : $seo->title_th }}">
    <meta property="og:description" content="{{ $seo->seo_description ? $seo->seo_description :  $seo->seo_description_th }}">
    <meta property="og:image" content="{{ url('img/logo-bg-white.jpg') }}">
    <meta property="og:url" content="{{ url('') . '/' . Session('lang') . '/contact' }}">

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/panel-box.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="slider/animate.min.css" media="all">
    <link rel="stylesheet" href="css/validate.css" media="all">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- 04/10/2023 -->
    <link rel="stylesheet" href="css/landing.css?v=0002">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css'>
    <link rel="stylesheet" href="css/animate.css">
    <link href="css/package.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<style type="text/css">
    section.page strong{
        font-family: "Prompt" !important;
    }
    .card-blue {
        /*  background-color: #1b497d!important;*/
        background-color: var(--v1-navy);
        box-shadow: var(--v1-sha01);
        border-radius: var(--v1-radius-lg);
        padding: 3rem !important;
    }

    .info-contact {
        background: rgb(255, 255, 254);
        border: var(--v1-border);
        box-sizing: border-box;
        box-shadow: var(--v1-sha01);
        border-radius: var(--v1-radius-lg);
        width: 100%;
    }

    input.invalid {
        border: 1px solid #ff5f5f;
    }

    /* input.invalid:focus{
    border:2px solid #fd6a6a;
    } */
    em.invalid {
        color: #ff5f5f;
    }

    .text-c-none {
        color: #1f1f1f;
    }

    h2 {
        line-height: 40px;
    }

    /*03/10/2023*/
    .title-landing {
        padding-top: 5px;
        padding-bottom: 50px;
    }

    .steps {
        padding-left: 81px;
    }

    .steps-item {
        position: relative;
        padding-bottom: 65px;
    }

    .steps-item.last {
        padding-bottom: 10px;
    }

    .steps-item-index {
        display: inline-block;
        margin-bottom: 24px;
        padding: 4px 16px;
        border-radius: 40px;
        background-color: #ff7700;

        color: #fffdfd;
        font-size: 16px;
        line-height: 130%;
        font-weight: 600;
        letter-spacing: 0em;
    }

    .steps-item-title {
        margin-bottom: 8px;
        /*color: #2d1653;*/
        font-size: 24px;
        line-height: 130%;
        font-weight: 300;
    }

    .steps-item-line._1 {
        background-image: url(../images/landing/line-1-new.png);
        background-position: 50% 50%;
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }

    .steps-item-line._2 {
        background-image: url(../images/landing/line-1-new.png);
        background-position: 50% 50%;
        background-size: 100% 100%;
    }

    .steps-item-line {
        position: absolute;
        left: -79px;
        top: 13px;
        bottom: -15px;
        width: 42px;
        max-width: 42px;
        min-width: 42px;
        background-image: url(https://d3e54v103j8qbb.cloudfront.net/img/background-image.svg);
        background-position: 0px 0px;
        background-size: auto;
    }

    .steps-images {
        position: relative;
    }


    /*form*/
    label {
        font-weight: 300;
    }

    .form-bg-package {
        border-radius: var(--v1-radius-lg);
        background-color: var(--v1-silver);
        border: solid 1px #dddddd;
        padding: 30px;
    }

    .form-contact-package {
        background-color: #ffffff;
        box-shadow: var(--v1-sha01);
        border-radius: var(--v1-radius-lg);
        border: var(--v1-border);
        padding: 30px;
    }

    .steps-item-index {
        background-color: var(--v1-orange);
    }

    .div-block {
        background-color: #ffffff;
    }
    .fs-16{
        font-size:16px !important;
    }
    .fs-18{
        font-size:18px !important;
    }
    .fs-20{
        font-size:20px !important;
    }
    .fs-22{
        font-size:22px !important;
    }
    .fs-24{
        font-size:24px !important;
    }
    .fs-26{
        font-size:26px !important;
    }
    .fs-28{ font-size:28px !important;}
    .fs-30{ font-size:30px !important;}
    .fs-34{ font-size:34px !important;}
    .ff-prompt{
        font-family: "Prompt" !important;
    }
    .fwb{
        font-size: bold;
    }
    .fwb-400{
        font-size: 400;
    }
    .bg-ultralight{
        background-color: #f6f6f6
    }
    .card-list{
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 15px;
        border:none;
    }
    .b-none{
        border: none;
    }
    .rounded-xl{
        border-radius: 1.5rem !important;
    }
    @media only screen and (max-width:430px)
    {
        .mt-xs-1{ margin-top: 5px }
        .mt-xs-2{ margin-top: 10px }
        .mt-xs-3{  margin-top: 15px }
        .mt-xs-4{ margin-top: 20px }
        .mt-xs-5{ margin-top: 25px }
    }
    .header-over{
        display: flex;
        align-items: center;
        position: absolute;
        top: -20px;
        left: 44px;
    }
    .header-over .over-logo{
        display: flex;
        justify-content: center;
        align-items: center;
        width: 33px;
        height: 33px;
        border-radius: 25px;
        border:2px solid;
        background-color: #FFF;
        z-index: 10;
    }
    .header-over .over-logo{
        border-color: #00aaf9;
    }
    .header-over.last .over-logo{
        border-color: #fe870a;
    }
    .header-over .over-title{
        height: 26px;
        overflow: hidden;
        border-top-right-radius: 15px;
        border-bottom-right-radius: 15px;
        margin: 5px 5px 5px -8px;
        z-index: 9;
        color: #FFF;
    }
    .header-over.first .over-title h3{
        background-color: #00aaf9;
    }
    .header-over.last .over-title h3{
        background-color: #fe870a;
    }
    .header-over h3{
        font-size: 20px;
        font-weight: bold;
    }
</style>
</head>

<body class="contact_page">
    @include("$prefix.header")
    {{-- <section style="background: linear-gradient( 180deg , #1A315F 0%, #0E2439 46.16%);"> --}}
    <section class="section-1">
        <div class="page p-0">
            <div class="title-landing">
                <h1 class="h2 mt-5 text-center" data-aos="fade-down" data-aos-delay="200">
                    <strong class="ff-prompt">ออกแบบเว็บไซต์</strong><strong class="v1-orange ml-2">อย่างโดดเด่นและทันสมัย</strong><br>
                    <span class="fs-22 ff-prompt fwb-400">ด้วยเว็บไซต์ดีไซน์ของเรา</span>
                </h1>

            </div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="" data-aos="zoom-in">
                            <center> <img src="split/1-3.webp" class="img-fluid mb-5"></center>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                    <div class="col-lg-12 text-center">
                        <button class="btn btn-orange">สำรวจเว็บไซต์ดีไซน์</button>
                    </div>
                </div>
            </div>
          \  
        </div> <!-- container -->
    </section> <!-- bg -->

    <section class="section-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center">
                        <strong class="v1-orange fs-24">บริการของเรา</strong>
                        <strong class="ml-2 fs-24">ไม่ได้มีแค่<br>เว็บไซต์ดีไซน์เท่านั้น</strong>
                    </h2>
                    <h2 class="text-center mt-5">
                        <strong class="fs-24">เราได้รวบรวมรายชื่อบริษัทในประเทศไทย</strong><br>
                        <strong class="ml-2 fs-24">มากกว่า <span class="fs-34 v1-orange">30,000</span> บริษัท</strong>
                    </h2>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-lg-2"></div>
                <div class="col-lg-8" style="height:5px; background:rgb(29,92,180); background: linear-gradient(90deg, rgba(29,92,180,1) 0%, rgba(238,108,128,1) 45%, rgba(255,202,100,1) 100%);">
                </div>
                <div class="col-lg-2"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <img src="split/2-1.webp" width="100%">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center">
                        <strong class="ff-prompt fs-26">มีหมวดหมู่มากกว่า <span class="v1-orange ff-prompt fs-34">130</span><span class="v1-orange ff-prompt fs-26 ml-2">หมวดหมู่</span></strong>
                        <br/>
                        <strong class="ff-prompt fs-26">ครอบคลุมทุกบริษัท</strong>
                    </h2>
                </div>
                <div class="col-lg-12 my-3">
                    <img src="split/2-2.webp" width="100%">
                </div>
                <div class="col-lg-12 mt-5">
                    <h2 class="text-center">
                        <strong class="ff-prompt fs-26">พร้อมให้บริการด้าน <span class="v1-orange ff-prompt">การตลาดออนไลน์</span><span class="ff-prompt fs-26 ml-2">แบบครบวงจร</span></strong>
                        <br/>
                        <strong class="ff-prompt fs-26">ที่จะช่วยเพิ่มการมองเห็นไปยังลูกค้า</strong>
                    </h2>
                </div>
                <div class="col-lg-12 my-3">
                    <img src="split/2-3.webp" width="100%">
                </div>
                <div class="col-lg-12 mt-5">
                    <h2 class="text-center">
                        <strong class="ff-prompt fs-26">เพียงฝาก <span class="v1-orange ff-prompt">รายชื่อและข้อมูลบริษัท</span><span class="ff-prompt fs-26 ml-2">บนเว็บไซต์ของเรา</span></strong>
                        <br/>
                        <strong class="ff-prompt fs-26">ลูกค้าจะพบเจอบริษัทของคุณได้อย่างง่ายดาย</strong>
                    </h2>
                </div>
                <div class="col-lg-12 my-3">
                    <img src="split/2-4.webp" width="100%">
                </div>
            </div> 
            <div class="row mt-5">
                <div class="col-lg-3 mt-xs-3">
                    <div class="card b-none">
                        <div class="card-body bg-ultralight card-list">
                            <img src="split/2-5.webp" width="60">
                            <strong class="fs-34 mt-3">89,990+</strong>
                            <strong style="color:#0c92e0">ลิสบริษัท</strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-xs-3">
                    <div class="card b-none">
                        <div class="card-body bg-ultralight card-list">
                            <img src="split/2-6.webp" width="60">
                            <strong class="fs-34 mt-3">130</strong>
                            <strong style="color:#0c92e0">หมวดหมู่</strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-xs-3">
                    <div class="card b-none">
                        <div class="card-body bg-ultralight card-list">
                            <img src="split/2-7.webp" width="60">
                            <strong class="fs-34 mt-3">49.9k</strong>
                            <strong style="color:#0c92e0">ยอดเข้าชม</strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-xs-3">
                    <div class="card b-none">
                        <div class="card-body bg-ultralight card-list">
                            <img src="split/2-8.webp" width="60">
                            <strong class="fs-34 mt-3">12</strong>
                            <strong style="color:#0c92e0">ภาษา</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center mt-5">
                        <strong>แพ็กเกจของเรา</strong>
                    </h2>
                </div>
                <div class="col-lg-12">
                    <div class="mt-3">
                        <img src="split/3-1.webp" width="100%">
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6">
                    <div class="card bg-ultralight rounded-xl">
                        <div class="card-body">
                            <div class="header-over first">
                                <div class="over-logo">
                                    <img src="split/3-2.webp" width="25">
                                </div>
                                <div class="over-title">
                                    <h3 class="fs-16 px-3">เว็บไซต์ใหม่ของคุณ</h3>
                                </div>
                            </div>
                            <ul>
                                <li>ออกแบบเว็บไซต์หน้า Home Page ใหม่
                                    ทั้งเวอร์ชั่น Desktop และ Mobile</li>
                                <li>เลือกเว็บไซต์ดีไซน์ที่เหมาะกับธุรกิจของคุณ</li>
                                <li>ลงข้อมูลประกอบเว็บไซต์ พร้อมใช้งาน</li>
                                <li>สามารถแก้ไขหน้าบ้านและหลังบ้านได้</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card bg-ultralight rounded-xl">
                        <div class="card-body">
                            <div class="header-over last">
                                <div class="over-logo">
                                    <img src="split/3-3.webp" width="25">
                                </div>
                                <div class="over-title">
                                    <h3 class="fs-16 px-3">บริการของ AT ONCE</h3>
                                </div>
                            </div>
                            <ul>
                                <li>รายชื่อและโปรไฟล์บริษัท</li>
                                <li>สามารถแก้ไขข้อมูลด้วยตัวเอง</li>
                                <li>พื้นที่ลงบทความ รีวิว โปรโมชั่น โปรโมทสินค้าและบริการ อื่นๆ</li>
                                <li>รายงานผลผู้เข้าชมโปรไฟล์ของท่านในทุกเดือน</li>
                                <li>การทำโฆษณาบน Google</li>
                                <li>ฟังก์ชั่นการติดต่อสุดพิเศษ</li>
                                <li>พื้นที่โดดเด่นบนหน้าเว็บไซต์ ลูกค้าสามารถเข้าถึงโปรไฟล์ของท่านได้ง่าย
                                    บริการช่วยเหลือจากทีมซัพพอร์ต</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="page mb-5">
        <div class="container">
            <div class="form-bg-package" id="formpackage" data-aos="zoom-in">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="h3 v1-orange mb-1" style="margin-bottom: -10px;"><strong>ทีมงานมืออาชีพของ At-Once</strong></h4>
                        <p class="">จะติดต่อกลับหาท่านภายใน 1 วัน</p>
                        <div class="owl-pagination-custom fd">
                            <div class="data-dots-custom active" data-owl-item="0"><img
                                    src="images/page-package/mk02.webp" alt="" width="179" height="89"
                                    class="img-fluid">
                            </div>
                            <div class="data-dots-custom" data-owl-item="1"><img src="images/page-package/mk01.webp"
                                    alt="" width="250" height="153" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class=" form-contact-package">
                            <form method="get" action="" id="formContactPackage">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>@lang('phrase.company-name')</label>
                                            <input type="text" class="form-control" name="company"
                                                id="company">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>@lang('phrase.name')</label>
                                            <input type="text" class="form-control" name="name"
                                                id="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>@lang('phrase.department')</label>
                                            <input type="text" class="form-control" name="department"
                                                id="department">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>@lang('phrase.telephone')</label>
                                            <input type="text" class="form-control" name="telephone"
                                                id="telephone">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>@lang('phrase.member.email')</label>
                                            <input type="email" class="form-control" name="email"
                                                id="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>@lang('phrase.contact-detail')</label>
                                            <textarea name="detail" class="form-control" rows="8" id="detail"></textarea>
                                            <input type="hidden" name="page" id="page"
                                                value="Form Contact Page">
                                            <input type="hidden" name="type" value="atonce">
                                        </div>
                                    </div>
                                </div>
                                <div style="display:flex; justify-content:center; margin:0 0 10px 0;">
                                    <div id="g-recaptcha" class="g-recaptcha"
                                        data-sitekey="6LcEE6ooAAAAAN8ZnN5uTezCAeCpAvB6fGuugnKB"
                                        data-callback='onSubmit'></div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="submit" value="ส่งข้อความ" class="message-send btn-block"
                                            disabled />
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("$prefix.footer")

    <script src="js/jquery.js"></script>
    <script src="js/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=0001"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en">
    </script>
    <script src="plugin/sweetalert2/sweetalert2.all.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js'></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- 04/10/2023 -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function onSubmit(token) {
            if (token) {
                document.getElementById('formContactPackage').querySelector('[type="submit"]').removeAttribute('disabled');
            }
        }
        var reRender = function() {
            grecaptcha.reset();
        };
        jQuery.validator.addMethod("letteronly", function(value, element, param) {
            return value.match(new RegExp("." + param + "$"));
        });
        $('#btnFacebook,#btnLine,#btnMail').click(function() {
            const url = $(this).data('href');
            window.open(url);
        })
        $('#formContactPackage').validate({
            ignor: [],
            errorElement: "em",
            errorClass: "invalid",
            rules: {
                company: {
                    required: true
                },
                name: {
                    required: true,
                    letteronly: "[a-zA-Zก-ฮฤฤๅฦฦๅะ ัา ำ ิ ี ึ ื ุ ูเแโใไ ็ ่ ้ ๊ ๋ ์]+"
                },
                department: {
                    required: true
                },
                telephone: {
                    required: true,
                    minlength: 9,
                    letteronly: "[0-9]+"
                },
                email: {
                    required: true
                },
                detail: {
                    required: true
                }
            },
            messages: {
                company: {
                    required: '{{ __('phrase.contact.validate.company') }}'
                },
                name: {
                    required: '{{ __('phrase.contact.validate.name') }}',
                    letteronly: 'กรุณากรอกตัวอักษร'
                },
                department: {
                    required: '{{ __('phrase.contact.validate.department') }}'
                },
                telephone: {
                    required: '{{ __('phrase.contact.validate.telephone') }}',
                    minlength: 'กรุณากรอกเบอร์โทรให้ถูกต้อง',
                    letteronly: 'กรุณากรอกตัวเลข'
                },
                email: {
                    required: '{{ __('phrase.contact.validate.email') }}',
                    email: 'กรุณากรอกอีเมลให้ถูกต้อง',
                },
                detail: {
                    required: '{{ __('phrase.contact.validate.detail') }}'
                }
            },
            submitHandler: function(form, e) {

                inputs = $('#formContactPackage').serialize();
                e.preventDefault();
                // fd = new FormData();
                // fd.append('company', $('input[name="company"]').val());
                // fd.append('name', $('input[name="name"]').val());
                // fd.append('telephone', $('input[name="telephone"]').val());
                // fd.append('email', $('input[name="email"]').val());
                // fd.append('department', $('input[name="department"]').val());
                // fd.append('detail', $('textarea[name="detail"]').val());
                // fd.append('page', $('input[name="page"]').val());
                // fd.append('type', 'atonce');

                axios({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'post',
                    url: 'api/package/sendmail',
                    data: inputs
                }).then((result) => {
                    Swal.fire({
                        icon: 'success',
                        title: 'ส่งอีเมลสำเร็จแล้ว',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        reRender();
                        document.querySelectorAll('.form-control').forEach(el => el.classList
                            .remove('valid'));
                        document.querySelectorAll('.form-control').forEach(el => el.value = '');
                    });
                }).catch((err) => {
                    Swal.fire({
                        icon: 'danger',
                        title: 'ไม่สามารถส่งได้ กรุณาลองใหม่อีกครั้ง',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            }
        })
        AOS.init({
            easing: 'ease-out-back',
            duration: 1800
        });
    </script>
    <script type="text/javascript">
        window.addEventListener('load', function() {
            var swiper = new Swiper("#carousel-brands", {
                slidesPerView: "auto",
                centeredSlides: true,
                autoplay: {
                    delay: 0,
                },
                loop: true,
                speed: 3000
            });
            let linksShowModal = document.querySelectorAll('[data-type="show-modal"]');

            if (linksShowModal) {
                linksShowModal.forEach(function(link) {
                    link.addEventListener('click', function(e) {
                        document.body.classList.add('hidden');
                    })
                })
            }
            let linksHideModal = document.querySelectorAll('[data-type="hide-modal"]');
            if (linksHideModal) {
                linksHideModal.forEach(function(link) {
                    link.addEventListener('click', function(e) {
                        document.body.classList.remove('hidden');
                    })
                })
            }
        })
    </script>
</body>

</html>
