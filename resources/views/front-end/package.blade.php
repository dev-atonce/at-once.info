<!doctype html>
<html lang="{{ Session('lang') }}">

<head>
    @include("$prefix.analytics.googleAnalytics")
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $seo->seo_keyword }}">
    <meta name="description" content="{{ $seo->seo_description }}">

    <title>{{ $seo->title }}</title>

    <meta property="og:title" content="{{ $seo->title }}">
    <meta property="og:description" content="{{ $seo->seo_description }}">
    <meta property="og:image" content="{{ url('img/logo-bg-white.jpg') }}">
    <meta property="og:url" content="{{ url('') . '/' . Session('lang') . '/promotion-package' }}">

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/header-footer.css?v=0007">
    <link rel="stylesheet" href="css/style.css?v=0005">
    <link rel="stylesheet" href="css/panel-box.css?v=07">
    <link rel="stylesheet" href="css/hunterPopup.css">
    <link rel="stylesheet" href="css/validate.css">
    <link rel="stylesheet" href="css/animate.css">
    <link href="css/aos.css" rel="stylesheet">
    <link href="css/package.css?v=0001" rel="stylesheet">
    <link rel="stylesheet" href="css/aos.css">
    <link href="css/card-list.css" rel="stylesheet">
    <style>
        input[type="email"].error,
        input[type="password"].error,
        input[type="text"].error,
        textarea[type="textarea"].error {
            border: 1px solid #f00;
        }

        input[type="email"].error:focus,
        input[type="password"].error:focus {
            box-shadow: 0 0 0 0.2rem rgb(255, 0, 0, 0.25) !important;
        }
    </style>

</head>

<body>

    <!-- style="background-image: linear-gradient(68deg,#90ccf6,#e0ecfd,#fefafc);" -->
    <!-- background-color: #e1eaf4; background-image: url(images/page-package/noise.png); -->
    @include("$prefix.header")

    <style type="text/css">
        #mian-page-cover {
            position: relative;
        }

        #mian-page-cover .bg-cover {
            background-image: url(../images/beautiful-office-building-tower-architecture-bangkok-city.webp);
            min-height: 365px;
            padding-top: 50px;
            padding-bottom: 15px;
            background-size: cover;
        }

        #mian-page-cover .bg-cover {
            background-image: url(../images/beautiful-office-building-tower-architecture-bangkok-city.webp);
            min-height: 365px;
            padding-top: 50px;
            padding-bottom: 15px;
            background-size: cover;
        }
    </style>
    <section class="package page " style="background: linear-gradient( 180deg , #1A315F 0%, #0E2439 46.16%);">
        <br class="d-none d-lg-block">
        <!-- <div class="pt-5 d-none d-lg-block"></div> -->
        <div class="container">
            <div class="text-center aos-init" data-aos="zoom-in">
                <h1 class="v1-orange"><strong>แพ็คเกจสุดคุ้ม ฟังก์ชั่น ครบ จบ ในที่เดียว</strong></h1>
                <h2 class="mb-5 text-white">ให้เราช่วยแก้ไขปัญหาเรื่องการทำการตลาดออนไลน์ที่ยุ่งยากให้เป็นเรื่องง่าย<br>
                    และคุณสามารถเลือกงบประมาณที่เหมาะสมกับธุรกิจของคุณได้เอง</h2>
            </div>
            <div class="collection-list-3 w-dyn-items">
                <div class="card_service">
                    <div class="service_content">
                        <img src="images/page-package/list.png" loading="lazy" alt="title slide"
                            sizes="(max-width: 479px) 79vw, (max-width: 767px) 87vw, (max-width: 991px) 39vw, 23vw"
                            class="service_image img-fluid">
                        <div class="w-layout-grid service_name">
                            <div class="subtitle-small">รายชื่อและโปรไฟล์บริษัท</div>
                            <div class="dropup">
                                <button class="number_slides black" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">ดูรายละเอียด</button>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right stop-propagation">
                                    <!-- <div class="dropdown-arrow"></div> -->
                                    <b>List and Company Profile</b>
                                    <div>
                                        สามารถออกแบบ และแก้ไขข้อมูลโปรไฟล์บริษัทของคุณ ได้ด้วยตัวเองแบบไม่จำกัด</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card_service">
                    <div class="service_content">
                        <img src="images/page-package/blog.png" loading="lazy" alt="title slide"
                            sizes="(max-width: 479px) 79vw, (max-width: 767px) 87vw, (max-width: 991px) 39vw, 23vw"
                            class="service_image img-fluid">
                        <div class="w-layout-grid service_name">
                            <div class="subtitle-small">พื้นที่ลงบทความ รีวิว <br class="d-none d-lg-block">โปรโมชั่น
                                โปรโมทสินค้า<br class="d-none d-lg-block">และบริการ อื่นๆ</div>
                            <div class="dropup ">
                                <button class="number_slides black" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">ดูรายละเอียด</button>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right stop-propagation">
                                    <!-- <div class="dropdown-arrow"></div> -->
                                    <b>Classified Advertising</b>
                                    <div>
                                        สามารถลงบทความ, บริการ, ประกาศรับสมัครงาน และกิจกรรมต่างๆ ของบริษัทแบบไม่จำกัด
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card_service">
                    <div class="service_content">
                        <img src="images/page-package/google-ads.png" loading="lazy" alt="title slide"
                            sizes="(max-width: 479px) 79vw, (max-width: 767px) 87vw, (max-width: 991px) 39vw, 23vw"
                            class="service_image img-fluid">
                        <div class="w-layout-grid service_name">
                            <div class="subtitle-small">มีบริการโฆษณา<br class="d-none d-lg-block">ทาง Google
                                ให้ตรง<br class="d-none d-lg-block">กลุ่มเป้าหมาย</div>
                            <div class="dropup">
                                <button class="number_slides black" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">ดูรายละเอียด</button>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right stop-propagation">
                                    <!-- <div class="dropdown-arrow"></div> -->
                                    <b>Google Ads</b>
                                    <div>
                                        ลงโฆษณาบน Google เพิ่มการมองเห็น เพื่อให้ผู้ใช้งานพบเจอสินค้า
                                        และบริการของคุณได้ง่ายและรวดเร็วยิ่งขึ้น
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card_service">
                    <div class="service_content">
                        <img src="images/page-package/popup.png" loading="lazy" alt="title slide"
                            sizes="(max-width: 479px) 79vw, (max-width: 767px) 87vw, (max-width: 991px) 39vw, 23vw"
                            class="service_image img-fluid">
                        <div class="w-layout-grid service_name">
                            <div class="subtitle-small">ฟังก์ชั่นการติดต่อ<br class="d-none d-lg-block">สุดพิเศษ</div>
                            <div class="dropup">
                                <button class="number_slides black" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">ดูรายละเอียด</button>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right stop-propagation">
                                    <!-- <div class="dropdown-arrow"></div> -->
                                    <b>Pop-up Contact</b>
                                    <div>
                                        ผู้ใช้งานที่สนใจสินค้า และบริการ จะสามารถกรอกข้อมูล
                                        เพื่อให้บริษัทของคุณติดต่อกลับได้ทันที ฟีเจอร์นี้
                                        ช่วยให้บริษัทของคุณเข้าถึงลูกได้อย่างรวดเร็ว
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card_service">
                    <div class="service_content">
                        <img src="images/page-package/banner.png" loading="lazy" alt="title slide"
                            sizes="(max-width: 479px) 79vw, (max-width: 767px) 87vw, (max-width: 991px) 39vw, 23vw"
                            class="service_image img-fluid">
                        <div class="w-layout-grid service_name">
                            <div class="subtitle-small">พื้นที่โดดเด่นบนหน้าเว็บไซต์ <br
                                    class="d-none d-lg-block">ลูกค้าเข้าถึงง่าย</div>
                            <div class="dropup">
                                <button class="number_slides black" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">ดูรายละเอียด</button>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right stop-propagation">
                                    <b>Banner</b>
                                    <div>
                                        พื้นที่ลงโฆษณา เพื่อดึงดูดความสนใจของผู้ใช้งาน
                                        ให้เข้าถึงโปรไฟล์บริษัทของคุณก่อนใคร <br><strong
                                            style="color: #f00;">*จำกัดเพียง 25 บริษัท ต่อ 1 ธุรกิจ เท่านั้น!!</strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card_service">
                    <div class="service_content">
                        <img src="images/page-package/side-view-woman-call-center.jpg" loading="lazy"
                            alt="title slide"
                            sizes="(max-width: 479px) 79vw, (max-width: 767px) 87vw, (max-width: 991px) 39vw, 23vw"
                            class="service_image img-fluid">
                        <div class="w-layout-grid service_name">
                            <div class="subtitle-small">บริการช่วยเหลือ<br class="d-none d-lg-block">จากทีมซัพพอร์ต
                            </div>
                            <div class="dropup">
                                <button class="number_slides black" type="button" id="dropdownMenuButton"
                                    data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">ดูรายละเอียด</button>
                                <div class="dropdown-menu dropdown-menu-md dropdown-menu-right stop-propagation">
                                    <div>
                                        <b>Staff Service</b>
                                        <div>
                                            เจ้าหน้าที่ของ At-Once จะคอยช่วยเหลือติดต่อประสานงาน ระหว่างผู้ใช้งาน
                                            และบริษัทของคุณ</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </section>
    <section class="page">
        <div class="container">
            <h3 class="h1 text-center v1-orange"><strong>แพ็คเกจของเรา</strong></h3>
            <br><br><br>
            <div class="collection-list-3 w-dyn-items">
                @foreach (\App\Models\PackageCategoryMd::where('status', 1)->get() as $k => $v)
                    @php
                        $price = $v
                            ->price()
                            ->leftJoin('package_list as li', 'package.list', '=', 'li.id')
                            ->where(['li.key' => 'pricing', 'package.package' => $v->id])
                            ->select('package.value')
                            ->first();
                    @endphp
                    <div class="card_price silver aos-animate" data-aos="fade-up" data-aos-delay="200">
                        <div class="ribbon-1" style="background:{{ $v->color }};">
                            <div class="content">
                                <b>{{ @$v->name_th }}</b>
                                <div class="price"><span class="cd-currency">฿</span>{!! str_replace('/Month', '', $price->value) !!}</div>
                                <div class="mounth">/Month</div>
                            </div>
                        </div>
                        <div class="price_content">
                            <ul>
                                @foreach ($v->package()->leftJoin('package_list as li', 'package.list', '=', 'li.id')->whereNotIn('li.key', ['member'])->select(['key', 'name', 'name_th', 'description'])->get() as $op)
                                    @if (@$op->name_th)
                                        <li>{{ $op->name_th }}</li>
                                    @endif
                                @endforeach
                            </ul>
                            <div class="text-center mail" data-package="{{ @$v->name_th }}"
                                data-color="{{ @$v->color }}">
                                <button><b>สนใจ คลิก!</b></button>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="card_price gold aos-animate" data-aos="fade-up" data-aos-delay="300">
                            <div class="ribbon-1">
                                <div class="content">
                                    <b>Gold</b>
                                    <div class="price"><span class="cd-currency">฿</span>13,990</div>
                                    <div class="mounth">/Month</div>
                                </div>
                            </div>
                            <div class="price_content">
                                <ul>
                                    <li>รายชื่อและโปรไฟล์บริษัท</li>
                                    <li>สามารถแก้ไขข้อมูลด้วยตัวเอง</li>
                                    <li>พื้นที่ลงบทความ รีวิว โปรโมชั่น โปรโมทสินค้าและบริการ อื่นๆ</li>
                                    <li>รายงานผลผู้เข้าชมโปรไฟล์ของท่านในทุกเดือน</li>
                                    <li>การทำโฆษณาบน Google</li>
                                    <li>ฟังก์ชั่นการติดต่อสุดพิเศษ</li>
                                    <li>พื้นที่โดดเด่นบนหน้าเว็บไซต์ ลูกค้าสามารถเข้าถึงโปรไฟล์ของท่านได้ง่าย</li>
                                    <li>บริการช่วยเหลือจากทีมซัพพอร์ต</li>
                                </ul>
                                <div class="text-center mail">
                                    <button><b>สนใจ คลิก!</b></button>
                                </div>
                            </div>
                        </div> --}}
            </div>
        </div>
    </section>
    <section id="ContactForm">
        <div class="container">
            <div class="form-bg-package" id="formpackage">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="h3 v1-blue" style="margin-bottom: -10px;"><strong>รับให้คำปรึกษา</strong></h4>
                        <p style="line-height: 18px;" class="mb-4">การตลาดออนไลน์ เพิ่มช่องทางการมองเห็น
                            <strong><span
                                    class="v1-orange h2">ฟรี</span></strong><br>ทีมงานมืออาชีพจะติดต่อกลับโดยเร็วที่สุด
                        </p>
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
                                {{-- <input type="hidden" name="type" value="promotion-package"> --}}
                                <input type="hidden" name="type" value="atonce">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group mb-1">
                                            <span class="badge badge-dark"><i
                                                    class="fas fa-star package-color"></i><span
                                                    class="package-name"></span></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">ชื่อบริษัท</label>
                                            <input type="text" name="company" class="form-control"
                                                autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">ชื่อ</label>
                                            <input type="text" name="name" class="form-control"
                                                autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">แผนก</label>
                                            <input type="text" name="department" class="form-control"
                                                autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">หมายเลขโทรศัพท์</label>
                                            <input type="text" name="telephone" class="form-control"
                                                autocomplete="off" />
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label">อีเมล</label>
                                            <input type="email" name="email" class="form-control"
                                                autocomplete="off" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label">รายละเอียดที่ต้องการติดต่อ</label>
                                            <textarea type="textarea" rows="4" class="form-control" name="detail"></textarea>
                                            <input type="hidden" name="package" id="package">
                                            <input type="hidden" name="page" id="page"
                                                value="From Package Page">
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
    <script defer>
        document.addEventListener('DOMContentLoaded', () => {
            var toEl = document.getElementById('ContactForm');
            if (window.location.hash == '#ContactForm') {
                toEl.scrollIntoView('slow');
            }
        });

        function onSubmit(token) {
            if (token) {
                document.querySelector('[type="submit"]').removeAttribute('disabled');
            }
        }
    </script>
    <section class="page">
        <div class="container">
            <div class="collection-list-info w-dyn-items">
                <a href="th/blog/why-advertise-with-at-once" class="card_info">
                    <div class="image-0-2-208">
                        <i class="fas fa-question"></i>
                    </div>
                    <div class="title">ทำไมต้องลงโฆษณา<br>กับ At-Once</div>
                </a>
                <a href="th/blog/how-does-at-once-market" class="card_info">
                    <div class="image-0-2-208">
                        <i class="fas fa-bullhorn"></i>
                    </div>
                    <div class="title">At-Once ทำการตลาดยังไง</div>
                </a>
                <a href="th/blog/how-to-make-the-company-known" class="card_info">
                    <div class="image-0-2-208">
                        <i class="fas fa-star"></i>
                    </div>
                    <div class="title">ทำยังไงให้บริษัทเป็นที่รู้จัก</div>
                </a>
                <a href="th/blog/how-good-is-it-to-have-reviews-blogs" class="card_info">
                    <div class="image-0-2-208">
                        <i class="fas fa-pen"></i>
                    </div>
                    <div class="title">การมีรีวิว / บล็อก ดีอย่างไร</div>
                </a>
            </div>
        </div>
    </section>
    <section class="page bg-gray">
        <div class="container">
            <!-- <div class="mt-4 d-none d-lg-block"></div> -->
            <div class="div-orange mb-5">
                <h3 class="large-title"><strong>บทความการตลาด</strong></h3>
            </div>
            <div class="row mt-4">
                @foreach ($blogs as $blog)
                    <div class="card_blog col-md-6 col-lg-3">
                        <div class="blog_body">
                            <div class="img-blog">
                                <a href="{{ Session('lang') }}/blog/{{ $blog->url_th }}">
                                    <img src="{{ $blog->images }}" class="img-fluid" alt="">
                                </a>
                            </div>
                            <div class="blog-title mb-2">
                                <a href="{{ Session('lang') }}/blog/{{ $blog->url_th }}"
                                    class="title"><strong>{{ $blog->name_th }}</strong></a>
                            </div>
                            <p>{{ $blog->more_th }}</p>
                            <div class="date d-flex justify-content-between">
                                <div class="day">
                                    <i class="far fa-calendar-alt"></i>
                                    {{ date('d-m-y', strtotime($blog->publish)) }}
                                </div>
                                <div class="view">
                                    <i class="far fa-eye"></i> {{ $blog->view }}
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="see-all-button mt-4">
                <a class="number_slides blue" type="button" href="th/blog-package">ดูบทความทั้งหมด</a>
            </div>
        </div>
    </section>
    <section class="page">
        <div class="container small_container">
            <div class="faq-title">FAQ</div>
            <div class="accordion">
                <div class="accordion-item aos-init aos-animate" data-aos="fade-up" data-aos-delay="100">
                    <button id="accordion-button-1" aria-expanded="false"><span class="accordion-title">จะได้รับ
                            Inquiry จากช่องทางไหนบ้าง</span><span class="icon" aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p class="mb-0">Inquiry ที่ท่านจะได้รับจากช่องทางดังนี้
                        <div class="pl-4">
                            1. หน้า Company Profile <br>
                            2. Pop up <br>
                            3. หน้าหมวดหมู่สินค้า <br>
                            4. Banner <br>
                        </div>
                        User สามารถส่ง Inquiry ไปยังบริษัทของคุณได้จากหน้าเหล่านี้ และยังเป็นโอกาสอีกหนึ่งช่องทาง
                        ที่ทางบริษัทของคุณจะได้รับ inquiry ที่จะเกิดขึ้นในอนาคต
                        <b><a href="https://www.at-once.info/th/contact">คลิก</a></b>
                        </p>
                    </div>
                </div>
                <div class="accordion-item aos-init aos-animate" data-aos="fade-up" data-aos-delay="200">
                    <button id="accordion-button-2" aria-expanded="false"><span
                            class="accordion-title">มีค่าใช้จ่ายในการทำ Company
                            Profile หรือไม่</span><span class="icon" aria-hidden="true"></span>
                    </button>
                    <div class="accordion-content">
                        <p>
                            ทางบริษัทของคุณ สามารถสร้าง Company Profile <b style="color: #f00;">ฟรี!!</b>
                            ไม่มีค่าใช้จ่าย <br>
                            <b>ติดต่อสอบถามรายละเอียดเพิ่มเติม
                                <a href="https://www.at-once.info/th/contact">คลิก</a></b>
                        </p>
                    </div>
                </div>
                <div class="accordion-item aos-init aos-animate" data-aos="fade-up" data-aos-delay="300">
                    <button id="accordion-button-3" aria-expanded="false">
                        <span class="accordion-title">ทำเว็บไซต์ให้ใหม่หรือไม่</span><span class="icon"
                            aria-hidden="true"></span>
                    </button>
                    <div class="accordion-content">
                        <p>
                            ทางเว็บไซต์ At-Once จะไม่ได้สร้างเว็บไซต์ใหม่ให้กับบริษัทของท่าน แต่ทีมงานของเรา
                            จะทำการสร้าง Company Profile
                            ให้กับบริษัทของท่าน โดยอยู่ภายใต้ Domain name ของเว็บไซต์ At-Once
                        </p>
                    </div>
                </div>
                <div class="accordion-item aos-init aos-animate" data-aos="fade-up" data-aos-delay="400">
                    <button id="accordion-button-4" aria-expanded="false">
                        <span class="accordion-title">สามารถดูสถิติการเข้าชมเว็บไซต์และบริการของเราได้ที่ไหน</span>
                        <span class="icon" aria-hidden="true"></span>
                    </button>
                    <div class="accordion-content">
                        <p>
                            สถิติการเข้าชมเว็บไซต์ ประจำเดือน มกราคม - มีนาคม ยอดรวมคือ 1,247,786
                            หากต้องการทราบข้อมูลเดือนอื่นๆ ย้อนหลัง <b> สอบถามเพิ่มเติม
                                <a href="https://www.at-once.info/th/contact">คลิก</a></b><br>
                            <b>บริการของเรา <a href="https://www.at-once.info/th/contact">คลิก</a></b>
                        </p>
                    </div>
                </div>
                <div class="accordion-item aos-init aos-animate" data-aos="fade-up" data-aos-delay="700">
                    <button id="accordion-button-5" aria-expanded="false"><span
                            class="accordion-title">อยากเขียนรีวิว ต้องทำอย่างไร</span><span class="icon"
                            aria-hidden="true"></span></button>
                    <div class="accordion-content">
                        <p>
                            หากบริษัทของท่านต้องการมีรีวิว ใน Website ของเรา ต้องทำอย่างไร
                            ท่านสามารถส่งข้อมูลของท่าน ให้ทางเราตรวจสอบเพื่อเขียนรีวิวให้กับทางบริษัทของท่าน
                            โดยส่งข้อมูลมาที่อีเมล marketing@at-once.info
                            <b><a href="https://www.at-once.info/th/contact">คลิก</a></b>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <br><br>
    </section>

    @include("$prefix.footer")

    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-popup.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=0001"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    <script type="text/javascript" src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en">
    </script>
    <script src="js/package-popup.js?v=4"></script>
    <script src="plugin/sweetalert2/sweetalert2.all.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/axios.min.js"></script>
    <script src="js/wow.min.js"></script>
    <script type="text/javascript" src="js/custom-form-contact.js?v=2"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        AOS.init();
        new WOW().init();
        $(function() {
            $(".bg-holder").parallaxScroll({
                friction: .5,
                direction: "vertical"
            })
        });

        $(function() {
            $('.chatbox-top').click(function() {
                $(this).closest('.chatbox').toggleClass('chatbox-min');
            });
            $('.fa-close').click(function() {
                $(this).closest('.chatbox').hide();
            });
        });

        $(function() {
            $('.mail').click(function() {
                $('html,body').animate({
                    scrollTop: $('#formpackage').offset().top - 50
                }, 800);
                let package = $(this).attr('data-package');
                let package_color = $(this).attr('data-color');
                $('.package-name').html(' ' + package + ' Package');
                $('.package-color').css("color", package_color);
                $('input[name="package"]').val(package);
            });
        });

        ! function(a, b) {
            "function" == typeof define && define.amd ? define(["jquery"], b) : b(a.jQuery)
        }(this, function(a) {
            "use strict";
            var b, c = {
                    friction: .5,
                    direction: "vertical"
                },
                d = a(window),
                e = 0;
            return window.requestAnimationFrame = function(a) {
                var b = (new Date).getTime(),
                    c = Math.max(0, 5 - (b - e)),
                    d = window.setTimeout(function() {
                        a(b + c)
                    }, c);
                return e = b + c, d
            }, b = function(b, e) {
                return {
                    init: function() {
                        this.$background = a(b), this.settings = a.extend({}, c, e), this._initStyles(), this
                            ._bindEvents()
                    },
                    _initStyles: function() {
                        this.$background.css({
                            "background-attachment": "scroll"
                        })
                    },
                    _visibleInViewport: function() {
                        var a = d.height(),
                            b = this.$background.get(0).getBoundingClientRect();
                        return b.top < a && b.bottom > 0 || b.bottom <= a && b.top > a
                    },
                    _bindEvents: function() {
                        var a = this;
                        d.on("load scroll resize", function() {
                            a._requestTick()
                        })
                    },
                    _requestTick: function() {
                        var a = this;
                        this.ticking || (this.ticking = !0, requestAnimationFrame(function() {
                            a._updateBgPos()
                        }))
                    },
                    _updateBgPos: function() {
                        if (this._visibleInViewport()) {
                            var a = d.width(),
                                b = d.height(),
                                c = this.$background.data("width"),
                                e = this.$background.data("height"),
                                f = c / e,
                                g = this.$background.width(),
                                h = this.$background.height(),
                                i = g / h,
                                j = f > i,
                                k = g / c,
                                l = e * k,
                                m = c * k,
                                n = this.$background.offset().top,
                                o = d.scrollTop(),
                                p = o - n,
                                q = b + l,
                                r = a + m,
                                s = p * (b / q),
                                t = p / b,
                                u = p * (a / r),
                                v = p / a,
                                w = (b - h) / 2;
                            w = j ? w * t : w;
                            var x = (a - g) / 2;
                            x = j ? x : x * v;
                            var y, z, A = j ? 2 * this.settings.friction * i : this.settings.friction * i;
                            "horizontal" === this.settings.direction ? (y = j ? a + "px auto" : "auto " + b +
                                "px", z = x - u * A + "px 50%") : (y = j ? "auto " + b + "px" : a +
                                "px auto", z = "50% " + (s * A - w) + "px"), this.$background.css({
                                "background-size": y,
                                "background-position": z
                            })
                        }
                        this.ticking = !1
                    }
                }
            }, b.defaults = c, a.fn.parallaxScroll = function(a) {
                return this.each(function() {
                    new b(this, a).init()
                })
            }, b
        });

        // faq
        const items = document.querySelectorAll(".accordion button");

        function toggleAccordion() {
            const itemToggle = this.getAttribute('aria-expanded');
            for (i = 0; i < items.length; i++) {
                items[i].setAttribute('aria-expanded', 'false');
            }
            if (itemToggle == 'false') {
                this.setAttribute('aria-expanded', 'true');
            }
        }
        items.forEach(item => item.addEventListener('click', toggleAccordion));
    </script>
    @php
        \App\Helpers\PageCounter::index('promotion-package');
    @endphp

</body>

</html>
