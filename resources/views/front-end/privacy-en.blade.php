<!doctype html>
<html lang="{{ Session('lang') }}">

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
    <meta property="og:url" content="{{ url('') . '/' . Session('lang') . '/privacy-policy' }}">

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/header-footer.css?v=0006">
    <link rel="stylesheet" href="css/style.css?v=0005">
    <link rel="stylesheet" href="css/panel-box.css?v=07">
    <link rel="stylesheet" href="css/hunterPopup.css">
    <link rel="stylesheet" href="css/validate.css">
    <link rel="stylesheet" href="css/gallery.css?v=002">
    <link href="css/aos.css" rel="stylesheet">
    <style>
        input[type="email"].error,
        input[type="password"].error {
            border: 1px solid #f00;
        }

        input[type="email"].error:focus,
        input[type="password"].error:focus {
            box-shadow: 0 0 0 0.2rem rgb(255, 0, 0, 0.25) !important;
        }
    </style>
</head>

<body>

    @include("$prefix.header")

    <div class="page-header">
        <div class="container d-block">
            <div class="row">
                <div class="col-12">
                    <h1 class="page-header__title">
                        นโยบายคุ้มครองข้อมูลส่วนบุคคล
                    </h1>

                    <!--     <div class="page-header__breadcrumb">

            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#" class="breadcrumb-link">
                 หน้าหลัก
               </a>
             </li>

             <li class="breadcrumb-item">
              <a href="javascript:void(0);" class="breadcrumb-link">
                นโยบายคุ้มครองข้อมูลส่วนบุคคล
              </a>
            </li>

          </ol>
        </div> -->
                </div>
            </div>
        </div>
    </div>

    <section class="page">
        <div class="container">
            <h2 style="font-size: 26px"><strong>ข้อกำหนดการใช้บริการ At Once</strong></h2>
            <p style="text-indent:40px;">ข้อกำหนดในการใช้บริการของ At-Once (จะเรียกต่อจากนี้ว่า "ข้อกำหนดนี้")
                เป็นเงื่อนไขการใช้บริการเว็บเซอร์วิส (จะเรียกต่อจากนี้ว่า "บริการนี้") ภายใต้ชื่อ " At-Once (แอท-วันซ์)"
                ที่กำหนดขึ้นมาโดยบริษัท 1-ซีอี วินด์ จำกัด ซึ่งเป็นบริษัทในประเทศไทย ผู้ใช้บริการนี้
                (จะเรียกต่อจากนี้ว่า "ผู้ใช้")
                จะถือว่าได้ยอมรับข้อกำหนดนี้และนโยบายความเป็นส่วนตัวนับตั้งแต่เริ่มใช้บริการนี้</p>

            <h3 style="font-size: 20px;"><strong>การเปลี่ยนแปลงข้อกำหนดการใช้บริการ </strong></h3>
            <p style="text-indent:40px;">
                บริษัทของเราสามารถเปลี่ยนแปลงแก้ไขข้อกำหนดนี้โดยไม่จำเป็นต้องได้รับคำยินยอมจากผู้ใช้ก่อนล่วงหน้า
                และจะถือว่าผู้ใช้ยอมรับในข้อกำหนดนี้แล้ว ข้อกำหนดการใช้บริการหลังจากเปลี่ยนแปลงแก้ไขแล้ว
                จะมีผลบังคับใช้ทันทีนับตั้งแต่มีการประกาศใช้กับบริการนี้ </p>
            <h3 style="font-size: 20px;"><strong>การใช้ข้อมูลส่วนบุคคล</strong></h3>
            <p style="text-indent:40px;">ในการให้บริการนี้
                บริษัทของเราจะใช้ข้อมูลส่วนบุคคลของผู้ใช้ตามนโยบายความเป็นส่วนตัวที่กำหนดขึ้นมาอีกฉบับ</p>

            <h3 style="font-size: 20px;"><strong> ลิขสิทธิ์ </strong></h3>
            <p style="text-indent:40px;">ข้อมูลที่เป็นของบุคคลอื่น ได้มาโดยการยินยอมโดยชอบด้วยกฎหมายแล้ว</p>


            <h3 style="font-size: 20px;"><strong> ข้อห้าม</strong></h3>
            <p style="text-indent:40px;">ในการใช้บริการนี้ ผู้ใช้จะต้องไม่กระทำการดังต่อไปนี้</p>
            <ol>
                <li class="mb-3">กระทำการละเมิดลิขสิทธิ์ สิทธิในทรัพย์สินทางปัญญาอื่นๆ
                    และประโยชน์เชิงทรัพย์สินของบริษัทของเรา และบุคคลที่สาม</li>
                <li class="mb-3">
                    การกระทำที่จะใช้ข้อมูลที่นำเสนอให้ผู้ใช้บริการนี้ในลักษณะอื่นนอกเหนือจากวิธีที่บริษัทของเราเสนอให้ในฟังก์ชั่นของบริการนี้
                    (รวมถึงการพิมพ์ซ้ำและเปลี่ยนแปลงโดยไม่ได้รับอนุญาต แต่ไม่จำกัดว่าจะต้องเป็นเรื่องเหล่านี้เท่านั้น)
                </li>

                <li class="mb-3">การกระทำที่เกี่ยวกับการกระทำผิดทางอาญา
                    และการกระทำที่ขัดต่อความสงบเรียบร้อยและศีลธรรมอันดีของประชาชน</li>
                <li class="mb-3">การกระทำที่ฝ่าฝืนกฎหมาย
                    หรือกฎระเบียบภายในองค์กรธุรกิจที่บริษัทของเราหรือผู้ใช้อยู่ในสังกัด</li>
                <li class="mb-3">การส่งข้อมูลที่รวมถึงไวรัสคอมพิวเตอร์ และโปรแกรมคอมพิวเตอร์อื่นๆ ที่เป็นอันตราย</li>
                <li class="mb-3">การกระทำแก้ไขปลอมแปลงข้อมูลที่สามารถใช้เกี่ยวกับบริการนี้ได้</li>
                <li class="mb-3">การกระทำที่อาจเป็นการขัดขวางการจัดการบริการนี้ของบริษัทของเรา</li>
                <li class="">การกระทำอื่นๆ ที่บริษัทของเราเห็นว่าไม่เหมาะสม</li>
            </ol>

            <h3 style="font-size: 20px;"><strong>การเปลี่ยนแปลงบริการและอื่นๆ</strong></h3>
            <p style="text-indent:40px;">บริษัทของเราสามารถเปลี่ยนแปลง ระงับ ยับยั้ง และยกเลิกบริการใดๆ
                หรือทั้งหมดด้วยเหตุผลใดก็ตาม และเมื่อใดก็ได้ โดยไม่ต้องแจ้งให้ผู้ใช้ทราบล่วงหน้า</p>

            <h3 style="font-size: 20px;"><strong>หัวข้อที่ยกเว้นไม่ต้องรับผิดชอบ</strong></h3>
            <p style="text-indent:40px;">ในบริการนี้ จากการพิจารณาและความรับผิดชอบของตัวผู้ใช้เอง
                จะถือว่าผู้ใช้ใช้บริการโดยยินยอมตามรายละเอียดด้านล่าง
                บริษัทของเราจะไม่รับผิดชอบต่อการสูญเสียหรือความเสียหายใดๆ ทั้งสิ้นที่อาจเกิดขึ้นกับผู้ใช้</p>

            <ul>
                <li class="mb-3">ไม่ว่าจะใช้บริการนี้หรือไม่ได้ใช้บริการนี้
                    บริษัทของเราจะไม่รับผิดชอบต่อความเสียหายใดๆ ทั้งสิ้นที่อาจจะเกิดขึ้นกับผู้ใช้ โดยไม่คำนึงถึงเหตุผล
                </li>
                <li class="mb-3">
                    บริษัทของเราจะไม่รับประกันเกี่ยวกับการทำงานของบริการนี้และลักษณะการตรงตามมาตรฐานของอุปกรณ์ที่ใช้ใดๆ
                    ทั้งสิ้น</li>
                <li class="mb-3">
                    บริษัทของเราไม่รับรองความสมบูรณ์แบบ,ความแม่นยำ,ความถูกต้องตามกฎหมาย,ความมีประโยชน์ของบริการนี้
                    และความแม่นยำ, ความเหมาะสม, ความถูกต้องตามกฎหมาย, ความมีประโยชน์ และอื่นๆ
                    ของข้อมูลที่ได้รับจากการใช้บริการนี้</li>
                <li class="mb-3">บริษัทของเราไม่รับผิดชอบต่อความเสียหายใดๆ
                    ที่เกิดจากความเร็วในการแสดงผลที่ช้าลงและการขัดข้องของบริการนี้ โดยมีสาเหตุมาจากการเข้าถึง (Access)
                    ที่มากเกินไปและสาเหตุอื่นๆ ที่ไม่คาดคิด</li>
                <li class="mb-3">บริษัทของเราไม่รับผิดชอบต่อการจัดเตรียมและการบำรุงรักษาของคอมพิวเตอร์
                    ซอฟต์แวร์และอุปกรณ์อื่นๆ เช่น สายสื่อสารและสภาพแวดล้อมการติดต่อสื่อสารอื่นๆ
                    ที่จำเป็นสำหรับการรับบริการนี้</li>
                <li class="mb-3">บริษัทของเราไม่รับผิดชอบต่อความเสียหายที่เกิดจากการเปลี่ยนแปลง การระงับ การยับยั้ง
                    และการยกเลิกของบริการนี้</li>
            </ul>

            <h3 style="font-size: 20px;"><strong>กฎหมายที่ใช้บังคับ</strong></h3>
            <p style="text-indent:40px;">ในส่วนที่เกี่ยวกับข้องกับการจัดทำ, การมีผลบังคับใช้,
                การปฏิบัติตามและการแก้ไขปัญหา ของข้อกำหนดนี้ จะบังคับใช้ภายใต้กฎหมายของประเทศไทย</p>
            <h3 style="font-size: 20px;"><strong>ศาลที่มีอำนาจควบคุมดูแล</strong></h3>
            <p style="text-indent:40px;">ในกรณีที่มีข้อพิพาทเกี่ยวกับข้อกำหนดนี้
                จะถือว่าศาลภายในประเทศไทยเป็นศาลที่มีอำนาจควบคุมดูแลข้อตกลงพิเศษของศาลชั้นต้น</p>
            <br>
            <p class="text-right">ข้อกำหนด ณ วันที่ 30 กันยายน ปี 2020</p>



        </div>
    </section>


    @include("$prefix.footer")

    <script src="js/jquery.js"></script>
    <!-- Optional JavaScript -->

    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery-popup.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript" src="js/custom.js?v=0001"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    <script type="text/javascript" src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>

    <script src="js/aos.js"></script>

    <script>
        AOS.init();


        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-21041420-11', 'auto');
        ga('send', 'pageview');


        /*
         *  Parallax-Scroll - v0.2.0
         *  jQuery plugin for background-attachment: scroll with friction, similar to the parallax scrolling effect on Spotify.
         *  http://parallax-scroll.aenism.com
         *
         *  Made by Aen Tan
         *  Under MIT License
         */
        $(function() {
            $(".bg-holder").parallaxScroll({
                friction: .5,
                direction: "vertical"
            })
        });



        /*
         *  Parallax-Scroll - v0.2.0
         *  jQuery plugin for background-attachment: scroll with friction, similar to the parallax scrolling effect on Spotify.
         *  http://parallax-scroll.aenism.com
         *
         *  Made by Aen Tan
         *  Under MIT License
         */
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
    </script>

</body>

</html>
