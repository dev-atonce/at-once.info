<!doctype html>
<html lang="{{ Session('lang') }}">

<head>
    @include("$prefix.analytics.googleAnalytics")
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $seo->seo_keyword ? $seo->seo_keyword : $seo->seo_keyword_th }}">
    <meta name="description" content="{{ $seo->seo_description ? $seo->seo_description : $seo->seo_description_th }}">

    <title>{{ $seo->title ? $seo->title : $seo->title_th }}</title>

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
            },
            "potentialAction": {
                "@type": "SearchAction",
                "target": "https://at-once.info/th/search?keywords={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
    </script>

    <meta property="og:title" content="{{ $seo->title ? $seo->title : $seo->title_th }}">
    <meta property="og:description"
        content="{{ $seo->seo_description ? $seo->seo_description : $seo->seo_description_th }}">
    <meta property="og:image" content="{{ url('img/logo-bg-white.jpg') }}">
    <meta property="og:url" content="{{ url('') . '/' . Session('lang') . '/about-us' }}">

    <title>เกี่ยวกับ At-Once - เว็บไซต์รวบรวมรายชื่อบริษัทในประเทศไทย</title>
    <base href="{{ url('/') }}">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link href="css/header-footer.css?v=0005" rel="stylesheet">
    <link href="css/style.css?v=0004" rel="stylesheet">
    <link href="css/panel-box.css" rel="stylesheet">
    <link href="slider/animate.min.css" rel="stylesheet" media="all">
    <link href="css/aos.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<style type="text/css">
    .wrapper h2 {
        font-size: 2.7rem;
        font-family: 'akrobatbold', 'db_heaventmed_cond', sans-serif;
        line-height: 1;
    }

    .ab-box01 .text-orange {
        font-size: 2rem;
    }

    .img_about {
        position: relative;
        display: inline-block;
        z-index: 2;
    }

    .img_about:before {
        content: '';
        position: absolute;
        width: 95%;
        height: 95%;
        background: #004181;
        top: -15px;
        left: -15px;
        z-index: -1;
    }

    .img_about img {
        max-width: 430px;
        width: 100%;
    }

    .thumbnail>img,
    .thumbnail a>img {
        display: block;
        max-width: 100%;
        width: auto;
        height: auto;
        margin-left: auto;
        margin-right: auto;
    }


    .img_about:after {
        content: '';
        position: absolute;
        width: 50%;
        height: 50%;
        background: #f15a2b;
        right: -15px;
        bottom: -15px;
        z-index: -1;
    }

    .img_about img {
        max-width: 430px;
        width: 100%;
    }

    .txtgreen {
        color: #A4C737 !important;
    }

    .txt .line.type2 {
        height: 3px;
        width: 35%;
        margin: 20px 0;
        background: #f15a2b;
        border-radius: 10px;
    }

    h2.ani-box01 {
        line-height: 44px;
    }

    .txt .type1 {
        height: 3px;
        width: 60%;
        margin: 20px 0;
        position: relative;
        left: -25%;
        background: #f15a2b;
        border-radius: 10px;
    }


    .cBigIW .wrapper-qoute {
        z-index: 2;
        position: relative;
        display: inline-flex;
        flex-direction: row;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: justify;
        justify-content: space-between;
        background: rgb(243, 245, 248);
        border-radius: 12px;
        padding: 16px;
    }

    .cBigIW {
        position: relative;
    }

    .cBigIW .gradient {
        z-index: 1;
        position: absolute;
        bottom: -20px;
        left: 0px;
        width: 100%;
        height: 40px;
        /*background: radial-gradient(50% 50% at 50% 50%, rgba(86, 104, 131, 0.16) 0%, rgba(86, 104, 131, 0) 100%);*/
    }


    .wrapper-qoute i {
        color: #bbb;
        font-size: 35px;
    }

    .wrapper-qoute .text {
        padding: 10px 40px 0px;
    }

    .box--about {
        background-color: #fff;
        border-radius: 30px;
        box-shadow: 0 1px 6px rgb(55 73 87 / 10%), 0 10px 20px rgb(55 73 87 / 15%);
        overflow: hidden;
        margin: 0 0 20px;
        height: 520px;
        min-height: 520px;
        display: block;
        transition: all .5s ease;
    }

    .box--about .box--text {
        padding: 40px;
        width: auto;
        flex: 0 1 300px;
    }

    .one-about span {
        color: #ff7601;
    }

    .text-orange {
        color: #ff7601;
    }

    .one-about h2 {
        line-height: 40px;
    }

    .page-section {
        padding-top: 60px;
        padding-bottom: 60px;
    }

    .one-about img {
        padding: 40px 0px 40px 0px;
    }

    .bg-about {
        background: linear-gradient(180deg, #1A315F 0%, #0E2439 46.16%);
        /* height: 100vh; */
        /*background-image: linear-gradient(180deg, #0f5fa9 0, #003b71 100%);*/
    }

    .benefits--list {
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-between;
        /*max-width: 700px;*/
        margin: 0 auto;
    }

    .benefits--list {
        display: flex;
        padding: 0;
        /*flex-direction: column;*/
    }

    .benefits--list .benefits--item {
        flex: 0 1 calc(33% - 15px);
    }

    .benefits--list li {
        list-style: none;
    }

    .benefits--item {
        position: relative;
        padding-left: 70px;
        margin-bottom: 30px;
    }

    .benefits--list .benefits--item {
        flex: 0 1 calc(33% - 15px);
    }

    .benefits--list .benefits--item .icon {
        width: 50px;
        height: 50px;
        position: absolute;
        top: 0;
        left: 0;
        background-color: #c7ebff;
        color: #1273eb;
        border-radius: 100px;
        font-size: 30px;
        line-height: 1;
    }

    @media only screen and (max-width: 900px) {
        .benefits--list .benefits--item {
            flex: 0 1 calc(100% - 15px);
        }
    }

    .landing-contributor-notice--stats {
        background: url(/dist/assets/7a629dc….webp) #044ea2 no-repeat;
        background-size: cover;
        min-height: 300px;
        padding: 0 0 0 175px;
    }

    .landing-contributor-notice {
        position: relative;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: calc(100% - 20px);
        min-height: 289px;
        overflow: hidden;
        border-radius: 16px;
        margin: 0 10px;
    }

    /*-----------------------*/
    .ads-marketing-box {
        position: relative;
        z-index: 100;
        display: -webkit-box;
        display: -webkit-flex;
        display: -ms-flexbox;
        display: flex;
        overflow: hidden;
        padding: 70px 0% 70px;
        -webkit-box-orient: vertical;
        -webkit-box-direction: normal;
        -webkit-flex-direction: column;
        -ms-flex-direction: column;
        flex-direction: column;
        -webkit-box-pack: center;
        -webkit-justify-content: center;
        -ms-flex-pack: center;
        justify-content: center;
        -webkit-box-align: center;
        -webkit-align-items: center;
        -ms-flex-align: center;
        align-items: center;
        border-bottom: 1px solid #2d3740;
        background-color: #000;
        background-image: url(images/about/wall-pack.jpg);
        background-position: 50% 50%;
        background-size: cover;
        border-radius: 30px;
    }

    .ads-marketing-box .content {
        position: relative;
        z-index: 2;
        width: 100%;
        max-width: 900px;
        margin-right: auto;
        margin-left: auto;
        background-color: transparent;
        text-align: center;
        color: #fff;
    }


    .w-button {
        display: inline-block;
        padding: 9px 50px;
        background-color: #ff7601;
        color: white;
        border: 0;
        line-height: inherit;
        text-decoration: none;
        cursor: pointer;
        border-radius: 100px;
    }

    .w-button:hover {
        background-color: #f38424;
        color: #fff;
        text-decoration: none;
    }
</style>

<body>
    @include("$prefix.header")
    <section class="bg-about">
        <div class="page-section">
            <div class="container ">
                <div class="text-white one-about mt-5">
                    <h1 class="text-center" data-aos="zoom-in" data-aos-duration="200"><strong>เว็บไซต์
                            <span>At-Once</span> เป็นเว็บสื่อกลาง<div class="mt-3">รวบรวมรายชื่อบริษัทในประเทศไทย
                            </div></strong></h1>
                    <div data-aos="fade-up" data-aos-duration="400">
                        <img src="images/about/about-gall.png" class="img-fluid"
                            alt="เว็บไซต์รวบรวมรายชื่อและข้อมูลของบริษัทที่ให้บริการในประเทศไทย">
                    </div>
                    <div data-aos="fade-up" data-aos-duration="600">
                        <h2 class="text-center h4">
                            At-once คือ แหล่งรวมรายชื่อบริษัท ครบวงจรที่ใหญ่ที่สุด<br>
                            เราเป็นเสมือนสื่อกลาง ที่ช่วยอำนวยความสะดวกในการ <strong>ค้นหาบริษัท</strong>
                            เพื่อการทำธุรกิจแบบ B2B <br> ด้วยฐานข้อมูล <strong>
                                รวมรายชื่อบริษัท</strong>
                            จากทุกภาคส่วน <strong>
                                เว็บไซต์รวมรายชื่อบริษัท
                            </strong> ของเราจึงเป็น <br> <strong> แหล่งรวมรายชื่อบริษัท
                            </strong> ที่ครบถ้วนและน่าเชื่อถือ
                            เรารวมข้อมูลสำคัญทุกอย่างที่เกี่ยวกับแต่ละบริษัทเอาไว้ให้ในที่เดียว <br>
                            เช่น ข้อมูลการติดต่อ, ประเภทธุรกิจ, ผลิตภัณฑ์และบริการ ฯลฯ ด้วยฐานข้อมูลที่ครบครันของเรา
                            <br>
                            จึงทำให้การค้นหาและติดต่อบริษัทต่างๆ เป็นเรื่องง่าย คุณสามารถเริ่มใช้บริการได้ทันที <strong
                                class="text-orange">ฟรีไม่มีค่าใช้จ่าย !</strong>
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section">
        <div class="container">
            <div class="d-flex justify-content-center row">
                <div class="col-lg-5">
                    <div class="box--about" data-aos="fade-up" data-aos-offset="200" data-aos-duration="800">
                        <div class="box--text">
                            <h3><strong>ผู้ใช้งานที่ต้องการเข้ามาหาข้อมูล</strong></h3>
                            <p>หากคุณเป็นผู้ใช้งานที่ต้องการเข้ามาหาข้อมูล คุณจะสามารถหารายชื่อบริษัทได้ในที่เว็บไซต์
                                At-Once และสามารถติดต่อกับบริษัทที่คุณสนใจได้โดยตรงและรวดเร็ว</p>
                        </div>
                        <img src="images/about/cp01.png" class="img-fluid" width="100%"
                            alt="หากคุณเป็นผู้ใช้งานที่ต้องการเข้ามาหาข้อมูล คุณจะสามารถหารายชื่อบริษัทได้ในที่เว็บไซต์ At-Once และสามารถติดต่อกับบริษัทที่คุณสนใจได้โดยตรงและรวดเร็ว">
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="box--about" data-aos="fade-up" data-aos-offset="400" data-aos-duration="1000">
                        <div class="box--text">
                            <h3><strong>บริษัทที่ให้บริการ</strong></h3>
                            <p>หากคุณเป็นบริษัทที่ให้บริการคุณจะสามารถติดต่อกับลูกค้าได้โดยตรงและรวดเร็วด้วยเช่นกัน
                                เป้าหมายของเราคือทำให้ผู้ที่ต้องการหาบริการและบริษัทที่ให้บริการมาเจอกันได้อย่างสะดวก
                                และรวดเร็ว
                            </p>
                        </div>
                        <img src="images/about/cp02.png" class="img-fluid" width="100%"
                            alt="หากคุณเป็นบริษัทที่ให้บริการคุณจะสามารถติดต่อกับลูกค้าได้โดยตรงและรวดเร็วด้วยเช่นกัน
      เป้าหมายของเราคือทำให้ผู้ที่ต้องการหาบริการและบริษัทที่ให้บริการมาเจอกันได้อย่างสะดวก 
      และรวดเร็ว">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section style="background: rgb(244, 246, 249);" class="page-section">
        <div class="container">

            <div class="row">

                <div class="col-lg-12">
                    <div data-aos="zoom-in" data-aos-offset="200" data-aos-duration="200">
                        <p class="text-center mb-0 text-orange"><strong>(สำหรับบริษัทผู้ให้บริการ)</strong></p>
                        <h2 class="text-center"><strong>At-Once เหมาะสำหรับใคร ?</strong></h2>
                    </div>
                    <br> <br>

                    <ul class="benefits--list">
                        <li class="benefits--item">
                            <span class="icon icon--degree">
                                <img src="images/about/quality.png" class="mb-3 aos-init aos-animate" data-aos="zoom-in"
                                    data-aos-delay="100">
                            </span>

                            <p>เหมาะสำหรับผู้ต้องการหาลูกค้าผ่านเว็บไซต์ที่มีคุณภาพ</p>
                        </li>
                        <li class="benefits--item">
                            <span class="icon icon--degree">
                                <img src="images/about/not-call.png" class="mb-3 aos-init aos-animate"
                                    data-aos="zoom-in" data-aos-delay="200">
                            </span>

                            <p>เหมาะสำหรับผู้ที่ต้องการยกเลิกการขายทางโทรศัพท์ที่ไม่ได้ผล</p>
                        </li>
                        <li class="benefits--item">
                            <span class="icon icon--degree">
                                <img src="images/about/cs.png" class="mb-3 aos-init aos-animate" data-aos="zoom-in"
                                    data-aos-delay="300">
                            </span>

                            <p>เหมาะสำหรับผู้ที่ต้องการหาลูกค้า แต่จำนวนพนักงานขายไม่เพียงพอ</p>
                        </li>
                        <li class="benefits--item">
                            <span class="icon icon--degree">
                                <img src="images/about/seo.png" class="mb-3 aos-init aos-animate" data-aos="zoom-in"
                                    data-aos-delay="400">
                            </span>
                            <p>เหมาะสำหรับผู้ที่มีโฮมเพจเป็นของตนเอง แต่ไม่มีความเชี่ยวชาญด้านการทำ Marketing Online (
                                SEO, Ads etc.)</p>
                        </li>
                        <li class="benefits--item">
                            <span class="icon icon--degree">
                                <img src="images/about/marketing.png" class="mb-3 aos-init aos-animate"
                                    data-aos="zoom-in" data-aos-delay="500">
                            </span>
                            <p>เหมาะสำหรับผู้ที่ไม่ทราบว่าการหาลูกค้าทางเว็บไซต์นั้นทำอย่างไร</p>
                        </li>
                        <li class="benefits--item">
                            <span class="icon icon--degree">
                                <img src="images/about/money.png" class="mb-3 aos-init aos-animate"
                                    data-aos="zoom-in" data-aos-delay="600">
                            </span>
                            <p>เหมาะสำหรับผู้ที่มีงบประมาณสำหรับโฆษณาที่จำกัด</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="page-section" data-aos="fade-up" data-aos-delay="400">
        <div class="container">
            <div class="ads-marketing-box">
                <div class="content">
                    <div class="">
                        <h2><strong>สนใจลงโฆษณากับ At-Once</strong></h2>
                        <h3>ร่วมเป็นส่วนหนึ่งกับเรา ดูแพ็คเกจได้ที่นี่</h3>
                        <br>
                        <a href="https://www.at-once.info/th/promotion-package" class="w-button">ดูแพ็คเกจ</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    @include("$prefix.analytics.gtagBody")
    @include("$prefix.footer")

    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en">
    </script>
    <script src="js/custom.js"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js?v=005"></script>
    <script src="plugin/sweetalert2/sweetalert2.all.js"></script>


    <script src='slider/wow.min.js'></script>
    <script>
        new WOW().init();
    </script>
    @include("$prefix.popup")

</body>

</html>
<script src="js/aos.js"></script>

<script>
    AOS.init();
</script>
