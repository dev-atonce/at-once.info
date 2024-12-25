<!doctype html>
<html lang="en">

<head>
    @include("$prefix.analytics.googleAnalytics")
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $seo->seo_keyword ? $seo->seo_keyword : $seo->seo_keyword_th }}">
    <meta name="description" content="{{ $seo->seo_description ? $seo->seo_description : $seo->seo_description_th }}">

    <title>{{ $seo->title ? $seo->title : $seo->title_th }}</title>

    <meta property="og:title" content="{{ $seo->title ? $seo->title : $seo->title_th }}">
    <meta property="og:description"
        content="{{ $seo->seo_description ? $seo->seo_description : $seo->seo_description_th }}">


    <meta property="og:image" content="{{ url('img/logo-bg-white.jpg') }}">
    <meta property="og:url" content="{{ url('') . '/' . Session('lang') . '/contact' }}">

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/panel-box.css">
    <link rel="stylesheet" href="css/gallery.css?v=002">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="slider/animate.min.css" media="all">
    <link rel="stylesheet" href="slick/slick.min.css">
    <link rel="stylesheet" href="slick/slick-custom.css">
    <link rel="stylesheet" href="css/validate.css" media="all">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- 04/10/2023 -->
    {{-- <link rel="stylesheet" href="css/landing.css?v=0002"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css'>
    <link rel="stylesheet" href="css/animate.css">
    <link href="css/package.css" rel="stylesheet">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
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

        .review-item {
            border-radius: var(--v1-radius-curved);
            transition: all .3s;
        }
    </style>
</head>
<style type="text/css">
    :root {
        --c-orange: #f38424;
        --font: Montserrat, Roboto, Helvetica, Arial, sans-serif;
    }

    section.page strong {
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

    .fs-16 {
        font-size: 16px !important;
    }

    .fs-12 {
        font-size: 12px !important;
    }

    .fs-14 {
        font-size: 14px !important;
    }

    .fs-18 {
        font-size: 18px !important;
    }

    .fs-20 {
        font-size: 20px !important;
    }

    .fs-22 {
        font-size: 22px !important;
    }

    .fs-24 {
        font-size: 24px !important;
    }

    .fs-26 {
        font-size: 26px !important;
    }

    .fs-28 {
        font-size: 28px !important;
    }

    .fs-30 {
        font-size: 30px !important;
    }

    .fs-34 {
        font-size: 34px !important;
    }

    .fs-36 {
        font-size: 36px !important;
    }

    .fs-38 {
        font-size: 38px !important;
    }

    .fs-40 {
        font-size: 40px !important;
    }

    .fs-44 {
        font-size: 44px !important;
    }

    .fs-48 {
        font-size: 48px !important;
    }

    .fs-52 {
        font-size: 52px !important;
    }

    .ff-prompt {
        font-family: "Prompt" !important;
    }

    .fwb {
        font-size: bold;
    }

    .fwb-400 {
        font-size: 400;
    }

    .bg-ultralight {
        background-color: #f6f6f6
    }

    .card-list {
        display: flex;
        flex-direction: column;
        align-items: center;
        border: none;
        /* width: 250px; */
        /* height: 250px; */
    }

    .card-list:hover {
        background: #f3842429;
        transition: all ease 0.3s;
    }

    .b-none {
        border: none;
    }

    .rounded-xl {
        border-radius: 1.5rem !important;
    }

    @media only screen and (max-width:430px) {
        .mt-xs-1 {
            margin-top: 5px
        }

        .mt-xs-2 {
            margin-top: 10px
        }

        .mt-xs-3 {
            margin-top: 15px
        }

        .mt-xs-4 {
            margin-top: 20px
        }

        .mt-xs-5 {
            margin-top: 25px
        }
    }

    .header-over {
        display: flex;
        align-items: center;
        position: absolute;
        top: -20px;
        left: 44px;
    }

    .header-over .over-logo {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 45px;
        height: 45px;
        border-radius: 25px;
        border: 2px solid;
        background-color: #FFF;
        z-index: 10;
    }

    .header-over .over-logo {
        border-color: #00aaf9;
    }

    .header-over.last .over-logo {
        border-color: #fe870a;
    }

    .header-over .over-title {
        /* height: 26px; */
        overflow: hidden;
        border-top-right-radius: 25px;
        border-bottom-right-radius: 25px;
        margin: 5px 5px 5px -12px;
        z-index: 9;
        color: #FFF;
        background-color: #fe870a;
    }

    .header-over.first .over-title h3 {
        background-color: #00aaf9;
    }

    .header-over h3 {
        font-size: 20px;
        font-weight: bold;
    }

    .package-col {
        display: flex;
        justify-content: center;
    }

    .package-badge {
        position: absolute;
        margin-top: -20px;
    }

    .package-badge .package-content {
        border-bottom-left-radius: 10px;
        border-bottom-right-radius: 10px;
    }

    .my-package {
        display: flex;
        justify-content: center;
        margin-top: 40px;
    }

    .package-item {
        display: flex;
        justify-content: center;
        overflow: hidden;
        justify-items: center;
        position: relative;
        color: #fff;
        border-radius: 20px;
        min-height: 180px;
        min-width: 140px;

    }

    .package-item.first {
        background: rgb(12, 153, 247);
    }

    .package-item.last {
        background: rgb(254, 135, 9);
    }

    .package-detail {
        display: flex;
        position: relative;
        z-index: 10;
        flex-direction: column;
        align-items: center;
    }

    .package-item .title {
        font-weight: 500
    }

    .package-item .sub-title {
        margin-top: -10px;
    }

    .package-icon {
        margin: 10px 0;
    }

    .divider {
        display: flex;
        align-items: center;
        font-size: 30px;
        margin: 0 15px;
    }

    .swiper {
        width: 100%;
        padding-top: 50px;
        padding-bottom: 50px;
    }

    .swiper-slide {
        background-position: center;
        background-size: cover;
        width: 1000px;
    }

    .swiper-slide img {
        display: block;
        width: 100%;
    }

    button.btn-more {
        position: relative;
        outline: none;
        border: none;
        border-radius: 30px;
        background-color: antiquewhite;
    }

    button.btn-more:focus {
        outline: none;
    }

    button.learn-more {
        width: 11rem;
        height: auto;
        padding: 0;
    }

    button.learn-more .circle {
        transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
        position: relative;
        display: block;
        margin: 0;
        width: 3rem;
        height: 3rem;
        background: #f38424;
        border-radius: 1.625rem;
    }

    button.learn-more .circle .icon {
        transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
        position: absolute;
        top: 0;
        bottom: 0;
        margin: auto;
        background: #fff;
    }

    button.learn-more .circle .icon.arrow {
        transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
        left: 0.625rem;
        width: 1.125rem;
        height: 0.125rem;
        background: none;
    }

    button.learn-more .circle .icon.arrow::before {
        position: absolute;
        content: "";
        top: -0.25rem;
        right: 0.0625rem;
        width: 0.625rem;
        height: 0.625rem;
        border-top: 0.125rem solid #fff;
        border-right: 0.125rem solid #fff;
        transform: rotate(45deg);
    }

    button.learn-more .button-text {
        transition: all 0.45s cubic-bezier(0.65, 0, 0.076, 1);
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        padding: 0.75rem 0;
        margin: 0 0 0 1.85rem;
        color: #282936;
        font-weight: 700;
        line-height: 1.6;
        text-align: center;
        text-transform: uppercase;
    }

    button:hover .circle {
        width: 100%;
    }

    button:hover .circle .icon.arrow {
        background: #fff;
        transform: translate(1rem, 0);
    }

    button:hover .button-text {
        color: #fff;
    }

    .more-wraper {
        padding: 1.5rem 0;
        filter: url('#goo');
    }

    .more-website {
        border: none;
        display: inline-block;
        text-align: center;
        background: var(--v1-orange);
        color: #fff;
        font-weight: bold;
        padding: 1.18em 1.32em 1.03em;
        line-height: 1;
        border-radius: 1em;
        position: relative;
        min-width: 8.23em;
        text-decoration: none;
        /* font-family: var(--font); */
        font-size: 1.25rem;
    }

    .more-website:active,
    .more-website:focus {
        border: none;
        outline: none;
    }

    .more-website:before,
    .more-website:after {
        width: 4.4em;
        height: 2.95em;
        position: absolute;
        content: "";
        display: inline-block;
        background: var(--c-orange);
        border-radius: 50%;
        transition: transform 0.5s ease;
        transform: scale(0);
        z-index: -1;
    }

    .more-website:before {
        top: -25%;
        left: 20%;
    }

    .more-website:after {
        bottom: -25%;
        right: 20%;
    }

    .more-website:hover:before,
    .more-website:hover:after {
        transform: none;
    }

    .contact-button-function {
        position: fixed;
        top: 50%;
        right: 2%;
        z-index: 99;
    }

    .contact-button {
        border: none;
        border-radius: 30px;
        width: 45px;
        height: 45px;
        background-color: var(--c-orange);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
    }

    .contact-button:hover i {
        animation: rotate 150ms infinite;
    }

    .contact-button:focus {
        outline: none;
        border: none;
    }

    @keyframes rotate {
        50% {
            transform: rotate(15deg);
        }
    }

    .contact-list {
        position: absolute;
        right: 50px;
    }

    a.contact-list-item {
        display: block;
        width: max-content;
        background-color: #eee;
        padding: 5px 15px;
        border-radius: 20px;
    }

    a.contact-list-item:hover {
        text-decoration: none;
    }

    .sample-card div a img {
        transition: box-shadow 0.3s ease-in-out;
    }

    .sample-card div a img:hover {
        box-shadow: 2px 2px 4px rgb(243, 132, 38, 0.6);
        transition-delay: 0.1s;
        /* Add a delay before the transition starts */
    }

    .modal-bg {
        background: rgb(238, 188, 174);
        background: radial-gradient(circle, rgba(238, 188, 174, 1) 0%, rgba(73, 76, 235, 1) 100%);
    }

    .swiper-slide-prev img,
    .swiper-slide-next img {
        opacity: 0.1;
        filter: blur(4px);
    }

    .more-info:hover {
        cursor: pointer;
    }
</style>
</head>

<body class="contact_page">
    @include("$prefix.header")
    {{-- <section style="background: linear-gradient( 180deg , #1A315F 0%, #0E2439 46.16%);"> --}}
    <div class="contact-button-function">
        <div class="contact-list d-none">
            <a class="contact-list-item" href="tel:02-126-6624">02-126-6624</a>
        </div>
        <button class="contact-button"><i class="fas fa-phone"></i></button>
    </div>
    <section class="section-1 ">
        <div class="page p-0">
            <div class="title-landing">
                <h1 class="h2 mt-5 text-center" {{-- data-aos="fade-down" data-aos-delay="200" --}}>
                    <strong class="ff-prompt">บริการทำเว็บไซต์</strong><strong
                        class="v1-orange ml-2">"ออกแบบได้ดั่งใจ"</strong><br>
                    <span class="fs-22 ff-prompt fwb-400">สร้างเว็บไซต์พร้อมโปรไฟล์บริษัท
                        โปรโมทธุรกิจของคุณสู่ออนไลน์อย่างมืออาชีพ</span>
                </h1>
            </div>
            <div class="container">
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide" data-swiper-autoplay="3000"> <img src="split/1-1.webp"></div>
                        <div class="swiper-slide" data-swiper-autoplay="3000"> <img src="split/1-2.webp"></div>
                        <div class="swiper-slide" data-swiper-autoplay="3000"> <img src="split/1-3.webp"></div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p class="fs-20" style="text-indent: 40px;">บริษัทของเรามีความเชี่ยวชาญในการ <strong
                                class="v1-orange">สร้างเว็บไซต์</strong> ที่สวยงาม ทันสมัย
                            และตอบโจทย์ความต้องการของธุรกิจคุณอย่างครบถ้วน
                            เราให้ <strong class="v1-orange">บริการรับทำเว็บไซต์</strong> ทุกประเภท
                            ไม่ว่าจะเป็นเว็บไซต์บริษัท, เว็บไซต์แคตตาล็อก, เว็บไซต์บล็อก หรือเว็บไซต์พอร์ตโฟลิโอ
                            เราคัดสรรทีมงานมืออาชีพที่มีประสบการณ์และความเชี่ยวชาญในการออกแบบและพัฒนาเว็บไซต์
                            เพื่อนำเสนอผลงานที่มีคุณภาพสูงสุด</p>
                    </div>
                    <div class="col-lg-12 my-5 text-center">
                        <div class="more-wraper">
                            <button class="more-website" data-toggle="modal"
                                data-target=".bd-example-modal-lg">สำรวจเว็บไซต์ดีไซน์</button>
                        </div>
                        <svg style="visibility: hidden; position: absolute;" width="0" height="0"
                            xmlns="http://www.w3.org/2000/svg" version="1.1">
                            <defs>
                                <filter id="goo">
                                    <feGaussianBlur in="SourceGraphic" stdDeviation="10" result="blur" />
                                    <feColorMatrix in="blur" mode="matrix"
                                        values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 19 -9" result="goo" />
                                    <feComposite in="SourceGraphic" in2="goo" operator="atop" />
                                </filter>
                            </defs>
                        </svg>
                    </div>

                </div>
                <div class="row mb-5">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8"
                        style="height:5px; background:rgb(29,92,180); background: linear-gradient(90deg, rgba(29,92,180,1) 0%, rgba(238,108,128,1) 45%, rgba(255,202,100,1) 100%);">
                    </div>
                    <div class="col-lg-2"></div>
                </div>

            </div>

        </div> <!-- container -->


    </section> <!-- bg -->

    <section class="section-2">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="text-center">
                        <strong class="v1-orange fs-24">บริการของเรา</strong>
                        <strong class="ml-2 fs-24">ไม่ได้มีเพียงแค่ทำเว็บไซต์เท่านั้น</strong>
                    </h2>
                    <p class="fs-20" style="text-indent: 40px;">นอกจากในส่วนของการออกแบบ และ พัฒนาเว็บไซต์แล้วนั้น
                        ทางเรายังให้บริการ<strong class="v1-orange">สร้างโปรไฟล์บริษัทออนไลน์</strong>
                        ซึ่งข้อดีของการมีโปรไฟล์บริษัทออนไลน์นั้นคือ จะทำให้ลูกค้าที่มีความสนใจในตัวธุรกิจของคุณ
                        สามารถจดจำแบรนด์ของคุณ
                        ได้ง่ายมากยิ่งขึ้น และสามารถเข้าถึงข้อมูลการให้บริการธุรกิจของคุณได้อย่างสะดวก
                        เป็นการเพิ่มความน่าเชื่อถือและเพิ่มโอกาส
                        ให้กับธุรกิจ หรือ บริษัทของคุณได้</p>
                    <h3 class="text-center mt-5">
                        <strong class="fs-24">เราได้รวบรวมรายชื่อบริษัทในประเทศไทย</strong><br>
                        <strong class="ml-2 fs-24">มากกว่า <span class="fs-34 v1-orange">30,000</span>
                            รายชื่อ</strong>
                    </h3>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12 text-center">
                    <img src="split/2-1.webp" width="80%">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center">
                        <strong class="ff-prompt fs-26">มีหมวดหมู่มากกว่า <span
                                class="v1-orange ff-prompt fs-34">170</span><span
                                class="v1-orange ff-prompt fs-26 ml-2">หมวดหมู่</span></strong>
                        <br />
                        <strong class="ff-prompt fs-26">ครอบคลุมทุกธุรกิจ</strong>
                    </h3>
                </div>
                <div class="col-lg-12 text-center my-3">
                    <img src="split/2-2.webp" width="80%">
                </div>
                <div class="col-lg-12">
                    <p class="ff-prompt fs-20" style="text-indent: 40px;">
                        ด้วยความมุ่งมั่นและรู้ลึกถึงธุรกิจในแต่ละธุรกิจ ทาง AT-ONCE เองได้สร้าง <strong
                            class="v1-orange">ฐานข้อมูลธุรกิจที่ใหญ่ที่สุดในประเทศไทย</strong>
                        โดยประกอบไปด้วยข้อมูล รายละเอียดต่างๆ ของบริษัทชั้นนำ กว่า 30,000 บริษัท รวมด้วยบริษัทที่มี
                        ขนาดเล็ก ขนาดกลาง และขนาดใหญ่ หลากหลายสาขา ซึ่งผ่านกระบวนการคัดกรอง และตรวจสอบข้อมูลอย่างละเอียด
                        เพื่อให้ได้ข้อมูลที่ถูกต้อง และชัดเจน ซึ่งฐานข้อมูลดังกล่าวนั้น
                        เป็นแหล่งข้อมูลสำคัญของเหล่านักลงทุน หรือ ผู้ที่สนใจธุรกิจในประเทศไทย
                    </p>
                </div>
                <div class="col-lg-12 mt-5">
                    <h3 class="text-center">
                        <strong class="ff-prompt fs-26">พร้อมให้บริการด้าน <span
                                class="v1-orange ff-prompt">การตลาดออนไลน์ครบวงจร</span><span
                                class="ff-prompt fs-26 ml-2">เพื่อเพิ่มการมองเห็น</span></strong>
                        <br />
                        <strong class="ff-prompt fs-26">แบรนด์ของคุณ ด้วยกลยุทธ์ที่มีประสิทธิภาพ</strong>
                    </h3>
                </div>
                <div class="col-lg-12 text-center my-3">
                    <img src="split/2-3.webp" width="80%">
                </div>
                <div class="col-lg-12 mt-5">
                    <h3 class="text-center">
                        <strong class="ff-prompt fs-26">เพียงฝาก <span
                                class="v1-orange ff-prompt">รายชื่อและข้อมูลบริษัท</span><span
                                class="ff-prompt fs-26 ml-2">บนเว็บไซต์ของเรา</span></strong>
                        <br />
                        <strong class="ff-prompt fs-26">ลูกค้าจะพบเจอบริษัทของคุณได้อย่างง่ายดาย</strong>
                    </h3>
                </div>
                <div class="col-lg-12 text-center my-3">
                    <img src="split/2-4.webp" width="80%">
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-3 mt-xs-3 mb-2">
                    <div class="card b-none">
                        <div class="card-body bg-ultralight card-list rounded-xl">
                            <img src="split/2-5.webp" width="60">
                            <strong class="fs-34 mt-3">30,000+</strong>
                            <strong style="color:#0c92e0">ลิสบริษัท</strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-xs-3 mb-2">
                    <div class="card b-none">
                        <div class="card-body bg-ultralight card-list rounded-xl">
                            <img src="split/2-6.webp" width="60">
                            <strong class="fs-34 mt-3">177</strong>
                            <strong style="color:#0c92e0">หมวดหมู่</strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-xs-3 mb-2">
                    <div class="card b-none">
                        <div class="card-body bg-ultralight card-list rounded-xl">
                            <img src="split/2-7.webp" width="60">
                            <strong class="fs-34 mt-3">1M</strong>
                            <strong style="color:#0c92e0">ยอดเข้าชม</strong>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 mt-xs-3">
                    <div class="card b-none">
                        <div class="card-body bg-ultralight card-list rounded-xl">
                            <img src="split/2-8.webp" width="60">
                            <strong class="fs-34 mt-3">4</strong>
                            <strong style="color:#0c92e0">ภาษา</strong>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-12">
                    <p class="fs-20" style="text-indent:40px">บริการที่สำคัญของเราอีกหนึ่งอย่างก็คือ <strong
                            class="v1-orange">บริการทำ SEO</strong>
                        ให้กับทางเว็บไซต์ของลูกค้าทางเรามีเจ้าหน้าที่ระดับสูง
                        ที่คอยซัพพอร์ตในส่วนของการวิเคราะห์คีย์เวิร์ดที่เหมาะสม
                        และมีเทคนิคการเขียนเนื้อหาที่ถูกต้องตามหลักของ SEO มากที่สุด
                        ซึ่งบริการนี้จะช่วยให้เว็บไซต์ของคุณติดอันดับการค้นหาใน Search Engine และทางผู้ที่สนใจธุรกิจ
                        หรือ บริการของคุณ
                        จะสามารถเข้าถึงเว็บไซต์ของคุณได้ง่ายมากยิ่งขึ้น อีกทั้งยังรวมถึง <strong
                            class="v1-orange">บริการลงโฆษณาบน Google Ads</strong> และให้คำปรึกษา
                        วางแผนกลยุทธ์การตลาดออนไลน์ บริการนี้จะช่วยให้ธุรกิจของคุณมีความสำเร็จอย่างยั่งยืน</p>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-lg-2"></div>
                <div class="col-lg-8"
                    style="height:5px; background:rgb(29,92,180); background: linear-gradient(90deg, rgba(29,92,180,1) 0%, rgba(238,108,128,1) 45%, rgba(255,202,100,1) 100%);">
                </div>
                <div class="col-lg-2"></div>
            </div>
        </div>
    </section>

    <section class="section-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center mt-5">
                        <strong>แพ็กเกจของเรา</strong>
                    </h3>
                </div>
                <div class="col-lg-12">
                    <div class="mt-3">
                        <img src="split/3-1.webp" width="100%">
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6 stretch mb-4">
                    <div class="card b-none bg-ultralight rounded-xl">
                        <div class="card-body">
                            <div class="header-over first">
                                <div class="over-logo">
                                    <img src="split/3-2.webp" width="35">
                                </div>
                                <div class="over-title">
                                    <h3 class="px-4 m-0">เว็บไซต์ใหม่ของคุณ</h3>
                                </div>
                            </div>
                            <ul class="pt-4">
                                <li>ออกแบบเว็บไซต์หน้า Home Page ใหม่ ทั้งเวอร์ชั่น Desktop และ Mobile</li>
                                <li>เลือกเว็บไซต์ดีไซน์ที่เหมาะกับธุรกิจของคุณ</li>
                                <li>ลงข้อมูลประกอบเว็บไซต์ พร้อมใช้งาน</li>
                                <li>หน้าหลัก (Home Page)</li>
                                <li>เกี่ยวกับเรา (About Us Page)</li>
                                <li>หน้าแสดงสินค้า หรือ บริการ (Products Page / Service Page)</li>
                                <li>บทความ (Blog Page)</li>
                                <li>ติดต่อเรา (Contact Us Page)</li>
                                <li><strong class="v1-orange">ฟรี!</strong> ระบบแปลภาษาด้วย Google Translate (ราคา
                                    1,500 บาท)</li>
                                <li><strong class="v1-orange">ฟรี!</strong> ออกแบบรูปภาพ Banner Slide จำนวน 1-3 รูปภาพ
                                    (ราคา 1,990 บาท)</li>
                                <li><strong class="v1-orange">ฟรี!</strong> Google Report (ราคา 1,990 บาท)</li>
                                <li><strong class="v1-orange">ฟรี!</strong> Contact Social Media (Facebook, Instagram,
                                    YouTube และ TikTok) (ราคา 2,990 บาท)</li>
                                <li><strong class="v1-orange">ฟรี!</strong> SEO Optimization หรือ รองรับการทำ SEO และ
                                    การทำโฆษณา (ราคา 6,990 บาท)</li>
                                <li><strong class="v1-orange">ฟรี!</strong> 3 User/Admin (ราคา 4,000 บาท)</li>
                                <li><strong class="v1-orange">ฟรี!</strong> Maximum 6 Fill/ 1 Form (Contact Us Page)
                                    (ราคา 5,000 บาท)</li>
                                <li><strong class="v1-orange">ฟรี!</strong> Free Website Training</li>
                                <li>บริการแก้ไขข้อมูลจากทีมช่วยเหลือ เพิ่ม ลบ เนื้อหาสินค้าและบริการ เดือนละ 1 ครั้ง
                                </li>
                                <li>สามารถแก้ไขหน้าบ้าน และหลังบ้านได้</li>
                                <li>รายงานสถิติผู้เข้าชมเว็บไซต์</li>
                                <li>รายงานจำนวนผู้ใช้งานกรอกฟอร์มการติดต่อหน้า 'ติดต่อเรา'</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 mt-xs-5">
                    <div class="card b-none bg-ultralight rounded-xl h-100">
                        <div class="card-body">
                            <div class="header-over last">
                                <div class="over-logo">
                                    <img src="split/3-3.webp" width="35">
                                </div>
                                <div class="over-title">
                                    <h3 class="px-4 m-0">บริการของ AT-ONCE</h3>
                                </div>
                            </div>
                            <ul class="pt-4">
                                <li>รายชื่อและโปรไฟล์บริษัท</li>
                                <li>สามารถแก้ไขข้อมูลด้วยตัวเอง</li>
                                <li>พื้นที่ลงบทความ รีวิว โปรโมชั่น โปรโมทสินค้าและบริการ อื่นๆ</li>
                                <li>รายงานผลผู้เข้าชมโปรไฟล์ของท่านในทุกเดือน</li>
                                <li>การทำโฆษณาบน Google</li>
                                <li>ฟังก์ชันการติดต่อสุดพิเศษ</li>
                                <li>พื้นที่โดดเด่นบนหน้าเว็บไซต์</li>
                                <li>สามารถเข้าถึงโปรไฟล์ของท่านได้ง่าย บริการช่วยเหลือจากทีมซัพพอร์ต</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card b-none bg-ultralight rounded-xl mt-5">
                <div class="card-body d-flex justify-content-center ">
                    <div class="row " style="width: 80%;">
                        <div class="col-lg-6  col-xs-12 package-col position-relative">
                            <div class="package-badge">
                                <div class="package-content text-white py-1 px-3" style="background-color: #f38424;">
                                    <i class="far fa-thumbs-up"></i><span class="ml-1 ff-prompt">RECOMMEND</span>
                                </div>
                            </div>
                            <div class="my-package">
                                <div class="package-item first">
                                    <svg height="150" width="100%" xmlns="http://www.w3.org/2000/svg"
                                        style="position: absolute">
                                        <defs>
                                            <linearGradient id="grad1" x1="0" x2="0"
                                                y1="35%" y2="100%">
                                                <stop offset="0%" stop-color="#0479bb" />
                                                <stop offset="100%" stop-color="#1e3c72" />
                                            </linearGradient>
                                        </defs>
                                        <ellipse cx="75" cy="0" rx="200" ry="150"
                                            fill="url(#grad1)"></ellipse>
                                        Sorry, your browser does not support inline SVG.
                                    </svg>
                                    <div class="package-detail p-3 d-flex">
                                        <div class="package-icon"><img src="split/globe.png" width="40" />
                                        </div>
                                        <span class="ff-prompt fs-20 title">WEBSITE</span>
                                        <small class="ff-prompt fs-12 sub-title">HOMEPAGE</small>
                                    </div>
                                </div>
                                <div class="divider"><i class="fas fa-plus-circle"></i></div>
                                <div class="package-item last">
                                    <svg height="150" width="100%" xmlns="http://www.w3.org/2000/svg"
                                        style="position: absolute">
                                        <defs>
                                            <linearGradient id="grad2" x1="0" x2="0"
                                                y1="35%" y2="100%">
                                                <stop offset="0%" stop-color="#0479bb" />
                                                <stop offset="100%" stop-color="#1e3c72" />
                                            </linearGradient>
                                        </defs>
                                        <ellipse cx="75" cy="0" rx="200" ry="150"
                                            fill="url(#grad2)"></ellipse>
                                        Sorry, your browser does not support inline SVG.
                                    </svg>
                                    <div class="package-detail p-3 d-flex">
                                        <div class="package-icon"><img src="split/icon002.webp" width="40" />
                                        </div>
                                        <span class="ff-prompt fs-20 title">AT-ONCE</span>
                                        <small class="ff-prompt fs-12 sub-title">SERVICE</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6  col-xs-12 package-col align-items-center">
                            <div class="mt-4 text-center d-flex flex-column align-items-center">
                                <h2 class="ff-prompt fs-44 font-weight-bold"><span>แพ็กเกจสุดคุ้ม!</h2>
                                <div class="d-flex justify-content-center my-4 text-center">
                                    <div class="ff-prompt text-primary font-weight-bold fs-20 mr-4"
                                        style="margin-top: -20px">เพียง</div>
                                    <span class="ff-prompt v1-orange font-weight-bold fs-44">14,990 </span>
                                    <div class="ff-prompt v1-orange position-relative">
                                        <strong class="ml-2 fs-26" style="position:absolute; bottom:-5px;">฿</strong>
                                    </div>
                                </div>
                                {{-- <button class="btn btn-orange py-1"><i class="fas fa-shopping-basket fa-fw"></i> ซื้อเลย !</button> --}}
                                <div>
                                    <button class="btn-more learn-more">
                                        <span class="circle" aria-hidden="true">
                                            <span class="icon arrow"></span>
                                        </span>
                                        <span class="button-text">ซื้อเลย !</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center mt-5">
                        <strong>แพ็กเกจเสริม</strong>
                    </h3>
                </div>
                <div class="col-lg-12 mt-3 row ">

                    <div class=" col-lg-4 px-xl-3 px-lg-1 mb-2">
                        <div class=" overflow-hidden border border-3 "
                            style="border-radius: 25px 25px 25px 25px; background-color:#01A9F6 ; border-color:#D9D9D9">
                            <div class="d-flex flex-column align-items-center justify-content-between px-5  pb-3 pt-4"
                                style="border-radius: 0px 0px 50% 50%; width:200%; transform: translateX(-25%); background-color:#F7F7F7;">
                                <div style="width:80px; height:80px" class="mb-4">
                                    <img src="split/star.png" class="w-100 h-100" />
                                </div>
                                <div class="fs-26 mb-3">
                                    <h3><strong style="color:#01A9F6;">Domain & Host</strong></h3>
                                    <h3><strong style="color:#01A9F6;">Service Package</strong></h3>
                                </div>
                                <div>
                                    <ul>
                                        <li>พื้นที่เว็บไซต์ (Storage) <strong style="color:#01A9F6;">10 GB</strong>
                                        </li>
                                        <li>ได้ 1 Domain name (.com/.net)</li>
                                        <li>Data Transfer Unlimited (Bandwidth)</li>
                                        <li><strong style="color:#01A9F6;">ฟรี!</strong> SSL Certificate 1 ปี</li>
                                    </ul>
                                </div>
                            </div>
                            <div class=" w-100 pt-4 pb-2 text-center" style="background-color:#01A9F6;">
                                <a class=" text-white fs-14 more-info ">สอบถามเพิ่มเติมติดต่อได้ที่ช่องทางการติดต่อ</a>
                            </div>
                        </div>
                    </div>

                    <div class=" col-lg-4 px-xl-3 px-lg-1  mb-2">
                        <div class=" overflow-hidden border border-3 "
                            style="border-radius: 25px 25px 25px 25px; background-color:#01A9F6 ; border-color:#D9D9D9">
                            <div class="d-flex flex-column align-items-center justify-content-between px-5  pb-3 pt-4"
                                style="border-radius: 0px 0px 50% 50%; width:200%; transform: translateX(-25%); background-color:#F7F7F7;">
                                <div style="width:80px; height:80px" class="mb-4">
                                    <img src="split/star.png" class="w-100 h-100" />
                                </div>
                                <div class="fs-26 mb-3">
                                    <h3><strong style="color:#01A9F6;">Domain & Host</strong></h3>
                                    <h3><strong style="color:#01A9F6;">Service Package</strong></h3>
                                </div>
                                <div>
                                    <ul>
                                        <li>พื้นที่เว็บไซต์ (Storage) <strong style="color:#01A9F6;">15 GB</strong>
                                        </li>
                                        <li>ได้ 1 Domain name (.com/.net)</li>
                                        <li>Data Transfer Unlimited (Bandwidth)</li>
                                        <li><strong style="color:#01A9F6;">ฟรี!</strong> SSL Certificate 1 ปี</li>
                                    </ul>
                                </div>
                            </div>
                            <div class=" w-100 pt-4 pb-2 text-center" style="background-color:#01A9F6;">
                                <a class=" text-white fs-14 more-info ">สอบถามเพิ่มเติมติดต่อได้ที่ช่องทางการติดต่อ</a>
                            </div>
                        </div>
                    </div>

                    <div class=" col-lg-4 px-xl-3 px-lg-1  mb-2">
                        <div class=" overflow-hidden border border-3 "
                            style="border-radius: 25px 25px 25px 25px; background-color:#01A9F6 ; border-color:#D9D9D9">
                            <div class="d-flex flex-column align-items-center justify-content-between px-5  pb-3 pt-4"
                                style="border-radius: 0px 0px 50% 50%; width:200%; transform: translateX(-25%); background-color:#F7F7F7;">
                                <div style="width:80px; height:80px" class="mb-4">
                                    <img src="split/star.png" class="w-100 h-100" />
                                </div>
                                <div class="fs-26 mb-3">
                                    <h3><strong style="color:#01A9F6;">Domain & Host</strong></h3>
                                    <h3><strong style="color:#01A9F6;">Service Package</strong></h3>
                                </div>
                                <div>
                                    <ul>
                                        <li>พื้นที่เว็บไซต์ (Storage) <strong style="color:#01A9F6;">20 GB</strong>
                                        </li>
                                        <li>ได้ 1 Domain name (.com/.net)</li>
                                        <li>Data Transfer Unlimited (Bandwidth)</li>
                                        <li><strong style="color:#01A9F6;">ฟรี!</strong> SSL Certificate 1 ปี</li>
                                    </ul>
                                </div>
                            </div>
                            <div class=" w-100 pt-4 pb-2 text-center" style="background-color:#01A9F6;">
                                <a class=" text-white fs-14 more-info ">สอบถามเพิ่มเติมติดต่อได้ที่ช่องทางการติดต่อ</a>
                            </div>
                        </div>
                    </div>


                </div>

            </div>
            <div class="row mt-5">
                <div class="col-lg-2"></div>
                <div class="col-lg-8"
                    style="height:5px; background:rgb(29,92,180); background: linear-gradient(90deg, rgba(29,92,180,1) 0%, rgba(238,108,128,1) 45%, rgba(255,202,100,1) 100%);">
                </div>
                <div class="col-lg-2"></div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="text-center mt-5 ff-prompt">วิธีการสั่งซื้อและขั้นตอนการบริการ</h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-4 col-lx-6">
                    <div class="text-center py-3">
                        <img src="split/4-1.webp" width="140" />
                        <p class="fs-20">สั่งซื้อโดยกรอกข้อมูล<br>
                            บนฟอร์มของเรา</p>
                    </div>
                </div>
                <div class="col-lg-4 col-lx-6">
                    <div class="text-center py-3">
                        <img src="split/4-2.webp" width="140" />
                        <p class="fs-20">ฝ่ายบริการลูกค้า<br> จะติดต่อคุณ</p>
                    </div>
                </div>
                <div class="col-lg-4 col-lx-6">
                    <div class="text-center py-3">
                        <img src="split/4-3.webp" width="140" />
                        <p class="fs-20">รวบรวมเและวิเคราะห์<br> ข้อมูลธุรกิจของคุณ</p>
                    </div>
                </div>
                <div class="col-lg-4 col-lx-6">
                    <div class="text-center py-3">
                        <img src="split/4-4.webp" width="140" />
                        <p class="fs-20">ออกแบบเว็บไซต์<br> ที่เหมาะสมกับธุรกิจของคุณ</p>
                    </div>
                </div>
                <div class="col-lg-4 col-lx-6">
                    <div class="text-center py-3">
                        <img src="split/4-5.webp" width="140" />
                        <p class="fs-20">ตรวจสอบทุกรายละเอียด<br> ก่อนจัดส่งให้คุณ</p>
                    </div>
                </div>
                <div class="col-lg-4 col-lx-6">
                    <div class="text-center py-3">
                        <img src="split/4-6.webp" width="140" />
                        <p class="fs-20">จัดส่งเว็บไซต์<br> ดีไซน์ใหม่ให้คุณ</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <p class="fs-20" style="text-indent:40px">ด้วยประสบการณ์ ความเชี่ยวชาญและมืออาชีพของ AT-ONCE
                        และทีมงาน การ <strong class="v1-orange">บริการทำเว็บไซต์</strong> ของเราใช้
                        เทคโนโลยีล่าสุด เพื่อให้การออกแบบเป็นไปอย่างทันสมัย สามารถใช้งานได้ง่าย
                        และมีฟังก์ชันที่ครบถ้วนสมบูรณ์มากที่สุด จึงสามารถตอบโจทย์ให้กับทางลูกค้า
                        เพื่อให้มีประสบการณ์ใช้งานที่ดี และทำให้องค์กรหรือบริษัทของคุณมีภาพลักษณ์
                        ที่เป็นมืออาชีพมากยิ่งขึ้น</p>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-2"></div>
                <div class="col-lg-8"
                    style="height:5px; background:rgb(29,92,180); background: linear-gradient(90deg, rgba(29,92,180,1) 0%, rgba(238,108,128,1) 45%, rgba(255,202,100,1) 100%);">
                </div>
                <div class="col-lg-2"></div>
            </div>

        </div>
        <section>
            <section>
                <div class="container mb-5">
                    <div class="row">
                        <div class="col-lg-12 mt-5">
                            <h3 class="ff-prompt text-center">
                                <strong class="">ลูกค้าของเรา</strong><br>
                                <span class="fs-20">เว็บไซต์ดีไซน์จาก AT-ONCE</span>
                            </h3>
                        </div>
                    </div>
                    <div class="row sample-card">
                        <div class="col-lg-4 mb-4">
                            <a href="split/5-1-l.webp" data-fancybox="gallery1">
                                <img src="split/5-1.webp" class="img-fluid" />
                            </a>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <a href="split/5-2-l.webp" data-fancybox="gallery1">
                                <img src="split/5-2.webp" class="img-fluid" />
                            </a>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <a href="split/5-3-l.webp" data-fancybox="gallery1">
                                <img src="split/5-3.webp" class="img-fluid" />
                            </a>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <a href="split/5-4-l.webp" data-fancybox="gallery1">
                                <img src="split/5-4.webp" class="img-fluid" />
                            </a>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <a href="split/5-5-l.webp" data-fancybox="gallery1">
                                <img src="split/5-5.webp" class="img-fluid" />
                            </a>
                        </div>
                        <div class="col-lg-4 mb-4">
                            <a href="split/5-6-l.webp" data-fancybox="gallery1">
                                <img src="split/5-6.webp" class="img-fluid" />
                            </a>
                        </div>
                        {{-- <div class="col-lg-12 text-center">
                    <button class="btn btn-orange py-1">ดูเพิ่มเติม</button>
                </div> --}}
                    </div>
                </div>
                {{-- <div class="container">
            <div class="row">
                <div class="col-lg-12 mt-5">
                    <h3 class="ff-prompt text-center font-weight-bold">รีวิวจากลูกค้าของเรา</h3>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-lg-3"></div>
                <div class="col-lg-6">
                    <div class="card rounded-xl">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-flex">
                                        <div>
                                            <img src="split/6-8.webp">
                                        </div>
                                        <div class="p-3">
                                            <strong class="ff-prompt"><p>VANTHAI</p></strong>
                                            <div class="">“ เว็บไซต์ Atonce ออกแบบเว็บไซต์ได้สวย โดดเด่น ทันสมัยมาก พร้อมให้บริการด้านการตลอดออนไลน์ อีกทั้งฝ่ายบริการลูกค้าช่วยดูแลอย่างเต็มที่ ”</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3"></div>
            </div>
            <div class="row mt-3 review-customer">
                @foreach ($recommend as $k => $v)
                    <div class="col-lg-3 col-md-6 col-6 mb-4">
                        <div class="review-item p-4">
                            <a href="javascript:" data-href="{{ url("$lang/$v->categoryKey/cp/$v->companyUrl") }}" data-company="{{json_encode($v)}}">
                                <img src="{{ $v->logo }}" alt="{{ $v->companyName }}" class="img-fluid img-logo-cus">
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div> --}}
            </section>
            <section>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 text-center mt-5">
                            <h3 class="ff-prompt font-weight-bold ">FAQs</h3>
                        </div>
                        <div class="col-lg-12">
                            <div class="accordion">
                                <div class="accordion-item">
                                    <button id="accordion-button-1" aria-expanded="true"><span
                                            class="accordion-title">เว็บไซต์ที่พัฒนาสามารถรองรับการใช้งานบนมือถือได้หรือไม่?</span><span
                                            class="icon" aria-hidden="true"></span></button>
                                    <div class="accordion-content">
                                        <p class="mb-0">
                                            เว็บไซต์ทุกเว็บไซต์ที่เราพัฒนาจะเป็นเว็บไซต์ที่มีการออกแบบ แบบ
                                            <strong>Responsive</strong> หรือรองรับหน้าจอมือถือ (Mobile-Friendly)
                                            ทำให้ผู้ใช้งานสามารถเข้าชมและใช้งานเว็บไซต์ได้อย่างสะดวกบนอุปกรณ์ทุกประเภท
                                        </p>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button id="accordion-button-2" aria-expanded="false"><span
                                            class="accordion-title">ลูกค้าสามารถแก้ไขหรือปรับปรุงเว็บไซต์ด้วยตนเองได้หรือไม่?</span><span
                                            class="icon" aria-hidden="true"></span>
                                    </button>
                                    <div class="accordion-content">
                                        <p>
                                            เว็บไซต์ของเราจะมีระบบจัดการเนื้อหา (CMS)
                                            ที่ช่วยให้ลูกค้าสามารถจัดการและปรับปรุงเนื้อหาได้ด้วยตนเองผ่านหน้าเว็บแบบ
                                            User-friendly
                                        </p>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button id="accordion-button-3" aria-expanded="false">
                                        <span class="accordion-title">เว็บไซต์มีความปลอดภัยในระดับใด?</span><span
                                            class="icon" aria-hidden="true"></span>
                                    </button>
                                    <div class="accordion-content">
                                        <p>
                                            ทางเว็บไซต์ AT-ONCE จะไม่ได้สร้างเว็บไซต์ใหม่ให้กับบริษัทของท่าน
                                            แต่ทีมงานของเรา
                                            จะทำการสร้าง Company Profile
                                            ให้กับบริษัทของท่าน โดยอยู่ภายใต้ Domain name ของเว็บไซต์ AT-ONCE
                                        </p>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button id="accordion-button-4" aria-expanded="false">
                                        <span
                                            class="accordion-title">สามารถดูสถิติการเข้าชมเว็บไซต์และบริการของเราได้ที่ไหน</span>
                                        <span class="icon" aria-hidden="true"></span>
                                    </button>
                                    <div class="accordion-content">
                                        <p>
                                            เรามุ่งมั่นให้ความปลอดภัยกับเว็บไซต์เป็นสิ่งสำคัญ
                                            เว็บไซต์ทั้งหมดจะถูกพัฒนาด้วยมาตรฐานความปลอดภัยสูงสุด เช่น การใช้ SSL,
                                            การป้องกันการบุกรุก เป็นต้น เพื่อปกป้องข้อมูลของลูกค้าและผู้ใช้งาน
                                        </p>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <button id="accordion-button-5" aria-expanded="false">
                                        <span class="accordion-title">บริการรวมถึงการทำ SEO ด้วยหรือไม่?</span>
                                        <span class="icon" aria-hidden="true"></span></button>
                                    <div class="accordion-content">
                                        <p>
                                            เรามี <strong>บริการทำ SEO</strong>
                                            เว็บไซต์ด้วยการวิเคราะห์คีย์เวิร์ดที่เหมาะสม
                                            เพื่อช่วยให้เว็บไซต์ของคุณติดอันดับการค้นหาใน Search Engine
                                            และมีโอกาสในการเข้าถึงลูกค้าเป้าหมายได้ง่ายขึ้น
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="page mb-5 position-relative d-flex align-items-center">
                <div class="position-absolute" style="width:100%; background-color:#f6f6f6; height:500px;"></div>
                <div class="container position-relative">
                    <div class="" id="formpackage" {{-- data-aos="zoom-in" --}}>
                        <div class="row ">
                            <div class="col-lg-6 d-flex align-items-center justify-content-center flex-column flex-lg-row  "
                                style="gap:2rem">
                                <div class="">
                                    <div class=" overflow-hidden ">
                                        <img src="split/at_once.png" style=";border-radius:50%;" />
                                    </div>
                                </div>

                                <div class="">
                                    <div class="mb-1 fs-36"><strong>ติดต่อเรา</strong>
                                    </div>
                                    <p class="fs-20">ทีมงานมืออาชีพของ AT-ONCE จะติดต่อกลับหาท่านโดยเร็วที่สุด</p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-contact-package">
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
                                                <input type="submit" value="ส่งข้อความ"
                                                    class="message-send btn-block" disabled />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div class="modal fade bd-example-modal-lg w-100" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-xl ">
                    <div class="modal-content w-100  ">
                        <div class="d-flex justify-content-center flex-column p-2  w-100 h-100">
                            <div class="d-flex justify-content-end ">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            <div class="d-flex justify-content-center">
                                <div class="fs-36 mb-4 v1-orange">
                                    <i class="fas fa-drafting-compass"></i>
                                    <strong>
                                        ดีไซน์ของเรา
                                    </strong>
                                </div>
                            </div>
                            <div class="w-100">
                                <div class="row sample-card">
                                    <div class="col-lg-4 mb-2">
                                        <a href="split/5-1-f.webp" data-fancybox="gallery1"
                                            class="d-flex justify-content-center flex-column align-items-center ">
                                            <img src="split/5-1.webp" class="img-fluid" />
                                            <p class="v1-orange">
                                                <strong>
                                                    #1
                                                </strong>
                                            </p>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 mb-2 ">
                                        <a href="split/5-2-f.webp" data-fancybox="gallery1"
                                            class="d-flex justify-content-center flex-column align-items-center ">
                                            <img src="split/5-2.webp" class="img-fluid" />
                                            <p class="v1-orange"><strong>#2</strong></p>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 mb-2">
                                        <a href="split/5-3-f.webp" data-fancybox="gallery1"
                                            class="d-flex justify-content-center flex-column align-items-center ">
                                            <img src="split/5-3.webp" class="img-fluid" />
                                            <p class="v1-orange"><strong>#3</strong></p>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 mb-2">
                                        <a href="split/5-4-f.webp" data-fancybox="gallery1"
                                            class="d-flex justify-content-center flex-column align-items-center ">
                                            <img src="split/5-4.webp" class="img-fluid" />
                                            <p class="v1-orange"><strong>#4</strong></p>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 mb-2">
                                        <a href="split/5-5-f.webp" data-fancybox="gallery1"
                                            class="d-flex justify-content-center flex-column align-items-center ">
                                            <img src="split/5-5.webp" class="img-fluid" />
                                            <p class="v1-orange"><strong>#5</strong></p>
                                        </a>
                                    </div>
                                    <div class="col-lg-4 mb-2">
                                        <a href="split/5-6-f.webp" data-fancybox="gallery1"
                                            class="d-flex justify-content-center flex-column align-items-center ">
                                            <img src="split/5-6.webp" class="img-fluid" />
                                            <p class="v1-orange"><strong>#6</strong></p>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include("$prefix.analytics.gtagBody")
            @include("$prefix.footer")

            <script src="js/jquery.js"></script>
            <script src="js/axios.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
                integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
            </script>
            <script src="js/bootstrap.min.js"></script>
            <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
            <script type="text/javascript" src="js/custom.js?v=0001"></script>
            <script type="text/javascript" src="js/fancybox.js"></script>
            <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
            <script type="text/javascript" src="js/build/authentication.js"></script>
            <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en">
            </script>
            <script src="plugin/sweetalert2/sweetalert2.all.js"></script>
            <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js'></script>
            <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
            <!-- 04/10/2023 -->
            <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
            <script type="text/javascript" src="slick/slick.min.js"></script>
            <script src="https://www.google.com/recaptcha/api.js" async defer></script>
            <script>
                $(".more-info").each(function(index, element) {
                    $(element).on('click', () => {
                        document.getElementById('formpackage').scrollIntoView({
                            block: "start",
                            behavior: "smooth"
                        });
                    })
                });


                document.addEventListener('click', function(e) {
                    const contactButton = e.target.closest('.contact-button');
                    if (contactButton) {
                        let contactList = contactButton.closest('.contact-button-function').querySelector('.contact-list');
                        if (contactList.classList.contains('d-none')) {
                            contactList.classList.remove('d-none');
                        } else {
                            contactList.classList.add('d-none');
                        }
                    }




                    const learnMoreBtn = e.target.closest('.learn-more');




                    if (learnMoreBtn) {
                        document.getElementById('formpackage').scrollIntoView({
                            block: "start",
                            behavior: "smooth"
                        });
                    }
                })
                var swiper = new Swiper(".mySwiper", {
                    autoplay: true,
                    effect: "coverflow",
                    grabCursor: true,
                    loop: true,
                    centeredSlides: true,
                    slidesPerView: "auto",
                    coverflowEffect: {
                        rotate: 0,
                        stretch: 1,
                        depth: 100,
                        modifier: 5,
                        slideShadows: true,
                    },
                    pagination: {
                        el: ".swiper-pagination",
                    },
                });
                // const settings = {
                //     dots: true,
                //     infinite: true,
                //     slidesToShow: 5,
                //     slidesToScroll: 1,
                //     arrows: false,
                //     autoplay:true,
                //     // autoplaySpeed: 0,
                //     // speed: 4500,
                //     // cssEase: 'linear',
                //     pauseOnHover: true,
                //     responsive: [
                //         {
                //             breakpoint: 1200,
                //             settings: { slidesToShow: 4 }
                //         },
                //         {
                //             breakpoint: 1024,
                //             settings: { slidesToShow: 4 }
                //         },
                //         {
                //             breakpoint: 900,
                //             settings: { slidesToShow: 3 }
                //         },
                //         {
                //             breakpoint: 600,
                //             settings: { slidesToShow: 2 }
                //         },
                //         {
                //             breakpoint: 420,
                //             settings: { slidesToShow: 2 }
                //         }
                //     ]
                // };

                // const sl =  $('.review-customer').slick(settings);

                // $(window).on('resize', function() {
                //     if( $(window).width() > 420 &&  !sl.hasClass('slick-initialized')) {
                //         $('.review-customer').slick(settings);
                //     }
                // })

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

                const items = document.querySelectorAll(".accordion button");

                function toggleAccordion() {
                    const itemToggle = this.getAttribute('aria-expanded');
                    // for (i = 0; i < items.length; i++) {
                    //     items[i].setAttribute('aria-expanded', 'false');
                    // }
                    if (itemToggle == 'false') {
                        this.setAttribute('aria-expanded', true);
                    } else {
                        this.setAttribute('aria-expanded', false);
                    }
                }
                items.forEach(item => item.addEventListener('click', toggleAccordion));

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
