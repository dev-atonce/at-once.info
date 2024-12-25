<!doctype html>
  <html lang="{{Session('lang')}}">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Landing page - {{env('APP_NAME')}}</title>

    <base href="{{url('/')}}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/header-footer.css?v=0006">
    <link rel="stylesheet" href="css/style.css?v=0005">
    <link rel="stylesheet" href="css/panel-box.css?v=07">
    <link rel="stylesheet" href="css/hunterPopup.css">
    <link rel="stylesheet" href="css/validate.css">
    <link rel="stylesheet" href="css/landing.css">
    <link href="css/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css'>
    <link rel="stylesheet" href="css/animate.css">
  </head>

  <style type="text/css">
    /* nav.navbar {
      background: #fff;
      font-family: 'Lato', serif;
      font-size: 1.2rem;
      letter-spacing: 0.4rem;
      position: fixed;
    }*/
    .navbar-fixed nav {
      position: relative;
    }

    #navbar-landing .navbar {
      border-bottom: 0px solid rgb(0, 112, 168);
      box-shadow: none;
      background: #fff6f4;
      z-index: 9;

    }

    #navbar-landing  .navbar a {
      text-decoration: none;
      background-color: #ffffff;
    }
  </style>

  <body data-spy="scroll" data-target="#nav" style="background-color: #fff6f4;">

    <div class="sticky-top"> 
      <div id="navbar-landing">
        <nav class="navbar navbar-fixed" id="nav">
          <div class="container">
            <div class="navbar-brand"><img src="img/at-once-black.png" class="logo"> </div>
            <div class="dropdown d-lg-none">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="images/landing/flag/th.png" loading="lazy" alt="Thailand" class="img-flag"> Thailand
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item active" href="{{url(Session('lang'))}}/landing-page#sec-th" data-scroll="#sec-th"><img src="images/landing/flag/th.png" loading="lazy" alt="Thailand" class="img-flag"> Thailand</a>
                <a class="dropdown-item" href="{{url(Session('lang'))}}/landing-page#sec-en" data-scroll="#sec-en"><img src="images/landing/flag/en.png" loading="lazy" alt="Thailand" class="img-flag"> English</a>
                <a class="dropdown-item" href="{{url(Session('lang'))}}/landing-page#sec-jp" data-scroll="#sec-jp"><img src="images/landing/flag/jp.png" loading="lazy" alt="Thailand" class="img-flag"> Japanese</a>
              </div>
            </div>
            <div class="d-none d-lg-block">
              <ul class="nav nav-tab-lang justify-content-center">
               <li class="nav-item active" data-elem="parallax"><a class="btn btn-lang" href="{{url(Session('lang'))}}/landing-page#sec-th" data-scroll="#sec-th">
                <img src="images/landing/flag/th.png" loading="lazy" alt="Thailand" class="img-flag"> Thailand
              </a></li>
              <li class="nav-item" data-elem="about"><a class="btn btn-lang" href="{{url(Session('lang'))}}/landing-page#sec-en" data-scroll="#sec-en" loading="lazy" alt="English"> 
                <img src="images/landing/flag/en.png" loading="lazy" alt="Thailand" class="img-flag">English
              </a></li>
              <li class="nav-item" data-elem="works"> <a class="btn btn-lang" href="{{url(Session('lang'))}}/landing-page#sec-jp" data-scroll="#sec-jp" loading="lazy" alt="Japanese">
                <img src="images/landing/flag/jp.png" loading="lazy" alt="Thailand" class="img-flag">Japanese</a></li>  
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>


    <section class="banner parallax scroll" id="sec-th">
      <div style="background-color: #fff6f4;">
        <div class="page-ld">
          <div class="title-landing">
            <h1 class="h1 text-center" data-aos="fade-down">
              <strong>
                หากคุณกำลังมองหาบริษัท บริการ และ สินค้า <br>
                <span class="">เราสามารถช่วยให้คุณค้นหาเจอได้ง่ายๆ</span>
              </strong>
            </h1>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <p class="h4 mb-0" data-aos="fade-down" data-aos-delay="200"><strong></strong></p>
                <div data-aos="fade-up" data-aos-delay="400">
                  <h2> <strong>เพราะเรารวบรวมรายชื่อบริษัท<br><div class="text-orange">มากกว่า <span style="font-size: 50px;">8,000</span> รายชื่อ</div> ทั่วประเทศไทย</strong></h2> <!-- (เอฟเฟคเด้ง) -->             
                  <p class="h5 mb-5"><strong>ไม่ว่าคุณจะหาบริการประเภทไหน ก็หาบริษัทเจอได้ง่ายๆ <br>
                   <strong class="text-orange" >แค่คลิก</strong> ก็ได้เจอบริการที่ต้องการ</strong></p>
                 </div>
               </div>
               <div class="col-lg-6"><!-- ปักหมุด -->
                <div class="contact_thumbnail" data-aos="zoom-in">
                  <img src="images/landing/sec02.png" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div> <!-- container -->
      </div> <!-- bg -->

      <div class="page-ld bg-white">
        <div class="container">
          <div class="row" style="align-items: center;">
           <div class="col-lg-6">
             <div class="contact_thumbnail-r" data-aos="zoom-in">
              <img src="images/landing/sec03-02.png" class="img-fluid">
            </div>
          </div>
          <div class="col-lg-6">
            <div data-aos="fade-up">
              <h3 class=""><span class="text-orange h1"><strong>ประหยัดเวลา</strong></span><strong><span>ค้นหาบริษัท</span> <br> ด้วยระบบการค้นหาที่ง่าย </strong></h3>
              <p><strong>โดยรวบรวม และ แบ่งหมวดหมู่ เช่น โลจิสติกส์ คลังสินค้า โซล่าเซลล์ บัญชี <br> เช่ารถยนต์ รับเหมาก่อสร้าง คอมพิวเตอร์และเทคโนโลยี ฯลฯ</strong></p>
            </div>
          </div>
        </div>
      </div><!-- container -->
    </div>

    <div class="bg-white">
      <div class="container">
        <div class="div-block" data-aos="fade-up" data-aos-delay="200">
          <h3  class="text-center h2"><strong>บริษัทที่คนยอดนิยมในการค้นหา</strong></h3>
          <div id="carousel-brands" class="swiper carousel-brands">
            <div class="swiper-wrapper">
              <div class="swiper-slide brand"><img src="images/landing/logo/logo01.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo02.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo03.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo04.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo05.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo06.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo07.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo08.svg" loading="eager" alt=""/></div>
            </div>
          </div>
        </div>
      </div> <!-- container -->
    </div>

    <div class="bg-white">
     <div class="container">
      <div class="text-center title-landing" data-aos="fade-down" data-aos-delay="400">
        <h3 class="h1"><strong> 3 เหตุผล</strong></h3>  
        <p class="text-orange h4"><strong>ที่ต้องใช้เว็บไซต์ At Once ในการค้นหาบริษัท</strong></p>
      </div>
      <div class="row" style="align-items: center;">
        <div class="col-lg-7">   
          <div id="w-node-_2d68d5fc-5d1d-ab70-9220-b3663eba7911-199eb68b">
            <div class="steps" data-aos="zoom-in-right" data-aos-delay="200">
              <div class="steps-item">
                <div style="opacity: 1;" class="steps-item-text _1">
                  <div class="steps-item-index">01</div>
                  <div class="steps-item-title">ค้นหาโปรไฟล์บริษัทได้ง่ายๆ จาก keyword ที่ต้องการ</div>
                </div>
                <div style="opacity: 1;" class="steps-item-svg _1">
                  <div class="steps-item-bull"></div>
                  <div class="steps-item-line _1"></div>
                </div>
              </div>
              <div class="steps-item">
                <div style="opacity: 1;" class="steps-item-text _2">
                  <div class="steps-item-index red">02</div>
                  <div class="steps-item-title">เลือกเงื่อนไขการบริการ เพื่อประหยัดเวลาค้นหาบริษัท</div>
                  <div class="steps-item-bull red"></div>
                </div>
                <div style="opacity: 1;" class="steps-item-svg _2">
                  <div class="steps-item-line _2"></div>
                </div>
              </div>
              <div class="steps-item last">
                <div style="opacity: 1;" class="steps-item-text _3">
                  <div class="steps-item-index yellow">03</div>
                  <div class="steps-item-title">ติดต่อได้มากกว่า 10 บริษัท ในการส่งอีเมล 1 ครั้ง</div>
                  <div class="steps-item-bull yellow"></div>
                </div>
                <div style="opacity: 1;" class="steps-item-svg _3"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="contact_thumbnail-3" data-aos="zoom-in-left" data-aos-delay="400">
            <img src="images/landing/03.png" class="img-fluid" >
          </div>
        </div>
      </div>  
    </div>

    <div class="mt-5"></div>
    <br><br>
    <div class="text-center">
      <a href="{{url(Session('lang'))}}" class="HeroHome__link PrimitiveLink " aria-label="Get Started Link">
        <div class="StyleStadium StyleStadium--color-marshmallow StyleStadium--size-large" style="--button-width:159;">
          <div class="StyleStadium__bg"></div> 
          <div class="StyleStadium__text t-h5">
            <div class="StyleStadiumCircle StyleStadiumCircle--size-small">
              <div class="StyleStadiumCircle__inner">ทดลองค้นหาบริษัทได้ฟรี คลิก!<div class="StyleStadiumCircle__icon">
                <div class="StyleCircle StyleCircle--color-white-faint StyleCircle--size-small">
                  <div class="StyleCircle__inner">
                    <svg preserveAspectRatio="xMidYMid meet" role="presentation" viewBox="0 0 6 8" style="height: 8px; width: 6px;">
                      <path d="M2.286 3.154A6.07 6.07 0 011.004.464c0-.232.115-.464.42-.464.307 0 .403.143.67.41a19.69 19.69 0 002.623 2.334C5.33 3.17 6 3.474 6 3.99c0 .517-.67.838-1.283 1.247a19.373 19.373 0 00-2.622 2.334c-.21.214-.402.428-.67.428a.467.467 0 01-.32-.145.383.383 0 01-.1-.318 6.07 6.07 0 011.281-2.69c.402-.553.575-.66.575-.856 0-.196-.173-.285-.575-.837z"></path>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    
  </div>
  <br><br><br><br>
</div>
</section>

<!-- =====================================================================  
------------------------------ English ------------------------------
===================================================================== -->
 
<section class="about scroll"  id="sec-en">
  <div style="background-color: #fff6f4;">
        <div class="page-ld">
          <div class="title-landing">
            <h1 class="h1 text-center " data-aos="fade-down">
              <strong>
                Looking for companies, products or services? <br>
                <span class="">Let us help you find them</span>
              </strong>
            </h1>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <p class="h4 mb-0 " data-aos="fade-down" data-aos-delay="200"><strong></strong></p>
                <div data-aos="fade-up" data-aos-delay="400">
                  <h2> <strong>We have <br><div class="text-orange">more than <span style="font-size: 50px;">8,000</span> companies</div> in Thailand listed on our website</strong></h2> <!-- (เอฟเฟคเด้ง) -->             
                  <p class="h5 mb-5"><strong>You can find any products or companies easily, with just 
                   <span class="text-orange" >one click</span></strong></p>
                 </div>
               </div>
               <div class="col-lg-6"><!-- ปักหมุด -->
                <div class="contact_thumbnail" data-aos="zoom-in">
                  <img src="images/landing/sec02.png" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div> <!-- container -->
      </div> <!-- bg -->

      <div class="page-ld bg-white">
        <div class="container">
          <div class="row" style="align-items: center;">
           <div class="col-lg-6">
             <div class="contact_thumbnail-r" data-aos="zoom-in">
              <img src="images/landing/sec03-02.png" class="img-fluid">
            </div>
          </div>
          <div class="col-lg-6">
            <div data-aos="fade-up"> 
              <h3 class=""><strong><span>Easy-to-Find</span><br>and</strong><span class="text-orange h1"><strong> Time-Saving</strong></span></h3>
              <p><strong>Well categorized, such as Logistics, Warehousing, Solar Cell, Accounting, Car Rental, Construction, Computer & Technology, etc.</strong></p>
            </div>
          </div>
        </div>
      </div><!-- container -->
    </div>

    <div class="bg-white">
      <div class="container">
        <div class="div-block" data-aos="fade-up" data-aos-delay="200">
          <h3  class="text-center h2"><strong>Popular Company</strong></h3>
          <div id="carousel-brands" class="swiper carousel-brands">
            <div class="swiper-wrapper">
              <div class="swiper-slide brand"><img src="images/landing/logo/logo01.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo02.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo03.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo04.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo05.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo06.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo07.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo08.svg" loading="eager" alt=""/></div>
            </div>
          </div>
        </div>
      </div> <!-- container -->
    </div>

    <div class="bg-white">
     <div class="container">
      <div class="text-center title-landing" data-aos="fade-down" data-aos-delay="400">
        <h3 class="h1"><strong> 3 Reasons</strong></h3>  
        <p class="h4"><strong> to use <span class="text-orange">At Once</span></strong></p>
      </div>
      <div class="row" style="align-items: center;">
        <div class="col-lg-7">   
          <div id="w-node-_2d68d5fc-5d1d-ab70-9220-b3663eba7911-199eb68b">
            <div class="steps" data-aos="zoom-in-right" data-aos-delay="200">
              <div class="steps-item">
                <div style="opacity: 1;" class="steps-item-text _1">
                  <div class="steps-item-index">01</div>
                  <div class="steps-item-title">To search for any company profile by keywords</div>
                </div>
                <div style="opacity: 1;" class="steps-item-svg _1">
                  <div class="steps-item-bull"></div>
                  <div class="steps-item-line _1"></div>
                </div>
              </div>
              <div class="steps-item">
                <div style="opacity: 1;" class="steps-item-text _2">
                  <div class="steps-item-index red">02</div>
                  <div class="steps-item-title">To sort by service terms, saving more time to search</div>
                  <div class="steps-item-bull red"></div>
                </div>
                <div style="opacity: 1;" class="steps-item-svg _2">
                  <div class="steps-item-line _2"></div>
                </div>
              </div>
              <div class="steps-item last">
                <div style="opacity: 1;" class="steps-item-text _3">
                  <div class="steps-item-index yellow">03</div>
                  <div class="steps-item-title">To send group email to more than 10 companies at once</div>
                  <div class="steps-item-bull yellow"></div>
                </div>
                <div style="opacity: 1;" class="steps-item-svg _3"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="contact_thumbnail-3" data-aos="zoom-in-left" data-aos-delay="400">
            <img src="images/landing/03.png" class="img-fluid" >
          </div>
        </div>
      </div>  
    </div>

    <div class="mt-5"></div>
    <br><br>
    <div class="text-center">
      <a href="{{url(Session('lang'))}}" class="HeroHome__link PrimitiveLink " aria-label="Get Started Link">
        <div class="StyleStadium StyleStadium--color-marshmallow StyleStadium--size-large" style="--button-width:159;">
          <div class="StyleStadium__bg"></div> 
          <div class="StyleStadium__text t-h5">
            <div class="StyleStadiumCircle StyleStadiumCircle--size-small">
              <div class="StyleStadiumCircle__inner">Search for a company for free CLICK!<div class="StyleStadiumCircle__icon">
                <div class="StyleCircle StyleCircle--color-white-faint StyleCircle--size-small">
                  <div class="StyleCircle__inner">
                    <svg preserveAspectRatio="xMidYMid meet" role="presentation" viewBox="0 0 6 8" style="height: 8px; width: 6px;">
                      <path d="M2.286 3.154A6.07 6.07 0 011.004.464c0-.232.115-.464.42-.464.307 0 .403.143.67.41a19.69 19.69 0 002.623 2.334C5.33 3.17 6 3.474 6 3.99c0 .517-.67.838-1.283 1.247a19.373 19.373 0 00-2.622 2.334c-.21.214-.402.428-.67.428a.467.467 0 01-.32-.145.383.383 0 01-.1-.318 6.07 6.07 0 011.281-2.69c.402-.553.575-.66.575-.856 0-.196-.173-.285-.575-.837z"></path>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    
  </div>
  <br><br><br><br>
</div>
</section>

<!-- =====================================================================  
------------------------------ Japn ------------------------------
===================================================================== -->

<section class="works scroll" id="sec-jp">
  <div style="background-color: #fff6f4;">
        <div class="page-ld">
          <div class="title-landing">
            <h1 class="h1 text-center " data-aos="fade-down">
              <strong>
                企業、製品やサービスなどを探していますか？<br>
                <span class="">私たちにお任せください</span>
              </strong>
            </h1>
          </div>

          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <p class="h4 mb-0 " data-aos="fade-down" data-aos-delay="200"><strong></strong></p>
                <div data-aos="fade-up" data-aos-delay="400">
                  <h2> <strong>タイ全土にある<br><div class="text-orange">企業情報<span  style="font-size: 50px;"> 8,000 </span>件以上</div>を掲載</strong></h2> <!-- (เอฟเฟคเด้ง) -->             
                  <p class="h5 mb-5"><strong>どんな企業でも、どんなサービスでも <br>たった <span class="text-orange">ワンクリック</span>で簡単に見つ<br>けることができます
                   </strong></p>
                 </div>
               </div>
               <div class="col-lg-6"><!-- ปักหมุด -->
                <div class="contact_thumbnail" data-aos="zoom-in">
                  <img src="images/landing/sec02.png" class="img-fluid">
                </div>
              </div>
            </div>
          </div>
        </div> <!-- container -->
      </div> <!-- bg -->

      <div class="page-ld bg-white">
        <div class="container">
          <div class="row" style="align-items: center;">
           <div class="col-lg-6">
             <div class="contact_thumbnail-r" data-aos="zoom-in">
              <img src="images/landing/sec03-02.png" class="img-fluid">
            </div>
          </div>
          <div class="col-lg-6">
            <div data-aos="fade-up"> 
              <h3 class=""><span class="text-orange h1"><strong>時間短縮</strong></span><br><strong>で探しやすい</strong></h3>
              <p><strong>物流、倉庫業、太陽電池、会計、レンタカー、建設、ITなどで分類されています</strong></p>
            </div>
          </div>
        </div>
      </div><!-- container -->
    </div>

    <div class="bg-white">
      <div class="container">
        <div class="div-block" data-aos="fade-up" data-aos-delay="200">
          <h3  class="text-center h2"><strong>人気企業</strong></h3>
          <div id="carousel-brands" class="swiper carousel-brands">
            <div class="swiper-wrapper">
              <div class="swiper-slide brand"><img src="images/landing/logo/logo01.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo02.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo03.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo04.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo05.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo06.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo07.svg" loading="eager" alt=""/></div>
              <div class="swiper-slide brand"><img src="images/landing/logo/logo08.svg" loading="eager" alt=""/></div>
            </div>
          </div>
        </div>
      </div> <!-- container -->
    </div>

    <div class="bg-white">
     <div class="container">
      <div class="text-center title-landing" data-aos="fade-down" data-aos-delay="400">
        <h3 class="h4"><strong><span class=""> At Onceを利用する</span></strong></h3>  
        <p class="h1"><strong><span class="text-orange"><span style="font-size: 55px;">3</span>つの理由</span></strong></p>
      </div>
      <div class="row" style="align-items: center;">
        <div class="col-lg-7">   
          <div id="w-node-_2d68d5fc-5d1d-ab70-9220-b3663eba7911-199eb68b">
            <div class="steps" data-aos="zoom-in-right" data-aos-delay="200">
              <div class="steps-item">
                <div style="opacity: 1;" class="steps-item-text _1">
                  <div class="steps-item-index">01</div>
                  <div class="steps-item-title">キーワードで目当ての企業の情報を探す</div>
                </div>
                <div style="opacity: 1;" class="steps-item-svg _1">
                  <div class="steps-item-bull"></div>
                  <div class="steps-item-line _1"></div>
                </div>
              </div>
              <div class="steps-item">
                <div style="opacity: 1;" class="steps-item-text _2">
                  <div class="steps-item-index red">02</div>
                  <div class="steps-item-title">サービスタイプを選択し、すぐに見つけることができる</div>
                  <div class="steps-item-bull red"></div>
                </div>
                <div style="opacity: 1;" class="steps-item-svg _2">
                  <div class="steps-item-line _2"></div>
                </div>
              </div>
              <div class="steps-item last">
                <div style="opacity: 1;" class="steps-item-text _3">
                  <div class="steps-item-index yellow">03</div>
                  <div class="steps-item-title">10社以上の宛先にメール一斉送信が可能</div>
                  <div class="steps-item-bull yellow"></div>
                </div>
                <div style="opacity: 1;" class="steps-item-svg _3"></div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="contact_thumbnail-3" data-aos="zoom-in-left" data-aos-delay="400">
            <img src="images/landing/03.png" class="img-fluid" >
          </div>
        </div>
      </div>  
    </div>

    <div class="mt-5"></div>
    <br><br>
    <div class="text-center">
      <a href="{{url(Session('lang'))}}" class="HeroHome__link PrimitiveLink " aria-label="Get Started Link">
        <div class="StyleStadium StyleStadium--color-marshmallow StyleStadium--size-large" style="--button-width:159;">
          <div class="StyleStadium__bg"></div> 
          <div class="StyleStadium__text t-h5">
            <div class="StyleStadiumCircle StyleStadiumCircle--size-small">
              <div class="StyleStadiumCircle__inner">無料で企業を探す　クリック！<div class="StyleStadiumCircle__icon">
                <div class="StyleCircle StyleCircle--color-white-faint StyleCircle--size-small">
                  <div class="StyleCircle__inner">
                    <svg preserveAspectRatio="xMidYMid meet" role="presentation" viewBox="0 0 6 8" style="height: 8px; width: 6px;">
                      <path d="M2.286 3.154A6.07 6.07 0 011.004.464c0-.232.115-.464.42-.464.307 0 .403.143.67.41a19.69 19.69 0 002.623 2.334C5.33 3.17 6 3.474 6 3.99c0 .517-.67.838-1.283 1.247a19.373 19.373 0 00-2.622 2.334c-.21.214-.402.428-.67.428a.467.467 0 01-.32-.145.383.383 0 01-.1-.318 6.07 6.07 0 011.281-2.69c.402-.553.575-.66.575-.856 0-.196-.173-.285-.575-.837z"></path>
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </a>
    
  </div>
  <br><br><br><br>
</div>
</section>

<a href="#" id="back-to-top" title="Back to top"><i class="icofont-thin-up"></i></a>


</body>
</html>

<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script  src="js/landing.js"></script>
<script src="js/wow.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-83360109-1', 'auto');
  ga('send', 'pageview');

</script>
<!-- Yandex.Metrika counter --> <script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter39321480 = new Ya.Metrika({ id:39321480, clickmap:true, trackLinks:true, accurateTrackBounce:true }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/39321480" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
<!-- partial -->

<script src='https://code.jquery.com/jquery-2.2.4.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js'></script>


<!-- aos -->
<script src="js/aos.js"></script>
<script>
  AOS.init({
    duration: 1200,
  })
</script>


<script>

  window.addEventListener('load', function(){

    var swiper = new Swiper("#carousel-brands", {
      slidesPerView: "auto",
      centeredSlides: true,
      spaceBetween: 40,
      autoplay: {
        delay: 0,
      },
      loop: true,
      speed: 3000
    });

    let linksShowModal = document.querySelectorAll('[data-type="show-modal"]');

    if(linksShowModal){
      linksShowModal.forEach(function(link){
        link.addEventListener('click', function(e){

          document.body.classList.add('hidden');

        })
      })
    }

    let linksHideModal = document.querySelectorAll('[data-type="hide-modal"]');

    if(linksHideModal){
      linksHideModal.forEach(function(link){
        link.addEventListener('click', function(e){

          document.body.classList.remove('hidden');

        })
      })
    }
  })




// ----------------
if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
    backToTop = function () {
      var scrollTop = $(window).scrollTop();
      if (scrollTop > scrollTrigger) {
        $('#back-to-top').addClass('show');
      } else {
        $('#back-to-top').removeClass('show');
      }
    };
    backToTop();
    $(window).on('scroll', function () {
      backToTop();
    });
    $('#back-to-top').on('click', function (e) {
      e.preventDefault();
      $('html,body').animate({
        scrollTop: 0
      }, 2800);
    });
  }



  $(document).ready(function() {
    $(window).on('scroll', function() {
      if (Math.round($(window).scrollTop()) > 0) {
        $('.navbar-fixed').addClass('scrolled');
      } else {
        $('.navbar-fixed').removeClass('scrolled');
      }
    });
  });


  $(document).on('click', '.js-videoPoster', function (e) {
    e.preventDefault();
    var poster = $(this);
    var wrapper = poster.closest('.js-videoWrapper');
    videoPlay(wrapper);
  });

  function videoPlay(wrapper) {
    var iframe = wrapper.find('.js-videoIframe');
    var src = iframe.data('src');
    wrapper.addClass('videoWrapperActive');
    iframe.attr('src', src);
  }



  $(document).ready(function () {
    $("#sidebar").mCustomScrollbar({
      theme: "minimal"
    });

    $('#dismiss, .overlay').on('click', function () {
      $('#sidebar').removeClass('active');
      $('.overlay').removeClass('active');
    });

    $('#sidebarCollapse').on('click', function () {
      $('#sidebar').addClass('active');
      $('.overlay').addClass('active');
      $('.collapse.in').toggleClass('in');
      $('a[aria-expanded=true]').attr('aria-expanded', 'false');
    });
  });

  $(document).on('ready', function(){
    cookiesPolicyBar();
  });
  function cookiesPolicyBar(){
    // Check cookie 
    if ($.cookie('ruxchaiCookiePolicy') != "active") $('#cookieAcceptBar').show(); 
    //Assign cookie on click
    $('#cookieAcceptBarConfirm').on('click',function(){
        $.cookie('ruxchaiCookiePolicy', 'active', { expires: 365 }); // cookie will expire in one day
        $('#cookieAcceptBar').fadeOut();
      });
  }


</script>



