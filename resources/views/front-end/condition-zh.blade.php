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
    <meta property="og:url" content="{{ url('') . '/' . Session('lang') . '/condition' }}">

    <base href="{{ url('/') }}">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/header-footer.css?v=0006">
    <link rel="stylesheet" href="css/style.css?v=0005">
    <link rel="stylesheet" href="css/filter.css?v=0003">
    <link rel="stylesheet" href="css/panel-box.css?v=07">
    <link rel="stylesheet" href="css/hunterPopup.css">
    <link rel="stylesheet" href="css/validate.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
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
                        ข้อกำหนดและเงื่อนไข
                    </h1>

                    <!--   <div class="page-header__breadcrumb">

            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#" class="breadcrumb-link">
                 หน้าหลัก
               </a>
             </li>

             <li class="breadcrumb-item">
              <a href="javascript:void(0);" class="breadcrumb-link">
                ข้อกำหนดและเงื่อนไข
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
            <h2 style="font-size: 26px"><strong>At Once 服务的使用条款</strong></h2>
            <p style="text-indent:40px;">At-Once 服务的使用条款（以下简称“条款和条件“这些条款”）是使用网络服务的条件。 （以下简称“本服务”）由泰国1-CE Wind Company Limited设立，名称为“At-Once（At-Once）”。 本服务的使用者 （以下简称“用户”）自使用本服务之日起，即视为已接受本条款及隐私政策。</p>

            <h3 style="font-size: 20px;"><strong>服务条款的变更</strong></h3>
            <p style="text-indent:40px;">
                At-Once可以在未经用户事先同意的情况下更改或修改这些条款。 则视为用户已接受这些条款。 变更后的使用条款 该服务一经公布立即生效。 </p>
            <h3 style="font-size: 20px;"><strong>个人信息的使用</strong></h3>
            <p style="text-indent:40px;">为了提供这项服务 公司将按照用户的个人信息将按照另一既定的隐私政策使用。</p>

            <h3 style="font-size: 20px;"><strong> 版权 </strong></h3>
            <p style="text-indent:40px;">属于他人的信息 依法取得同意。</p>


            <h3 style="font-size: 20px;"><strong> 版权</strong></h3>
            <p style="text-indent:40px;">属于他人的信息 依法取得同意。</p>
            <ol>
                <li class="mb-3">侵犯著作权 其他知识产权 以及公司的物业效益 和第三方。</li>
                <li class="mb-3">
                    以本公司在本服务的功能中提供的方法以外的方式使用向本服务的用户提供的信息的行为。 （包括未经授权的转载、修改  但不仅限于这些）
                </li>

                <li class="mb-3">与犯罪行为有关的行为 以及违反公共秩序和良好道德的行为。</li>
                <li class="mb-3">违法行为 或本公司或用户所属的商业组织内的规定。</li>
                <li class="mb-3">传输含有电脑病毒的信息 和其他电脑危险的程序。</li>
                <li class="mb-3">伪造与本服务相关的信息的行为。</li>
                <li class="mb-3">可能干扰本公司管理本服务的行为。</li>
                <li class="">其他行动 本公司认为不适当。</li>
            </ol>

            <h3 style="font-size: 20px;"><strong>服务变更及其他</strong></h3>
            <p style="text-indent:40px;">公司可能会变更、暂停和取消任何服务 或出于任何原因并且随时无需提前通知用户。</p>

            <h3 style="font-size: 20px;"><strong>责任承担</strong></h3>
            <p style="text-indent:40px;">在本服务中由用户自行考虑并承担责任用户同意以下内容后，即视为使用本服务。 公司对任何损失或损坏不承担任何责任 用户可能发生的所有情况。</p>

            <ul>
                <li class="mb-3">是否使用本服务 公司对任何损坏不承担任何责任。 用户可能发生的所有事情 无论出于什么原因。
                </li>
                <li class="mb-3">公司不保证本服务的运行以及所使用的任何设备的一致性。</li>
                <li class="mb-3">
                    本公司不保证本服务的完整性、准确性、合法性或有用性。 以及使用本服务所获得的信息的准确性、适当性、合法性、有用性等。</li>
                <li class="mb-3">บริษัทของเราไม่รับผิดชอบต่อความเสียหายใดๆ
                    公司对任何损坏不承担任何责任。 这是由于显示速度较慢以及该服务中断造成的。 由于访问过多和其他意外原因造成。</li>
                <li class="mb-3">公司不负责电脑的安装和维护 软件和其他设备，例如通信电缆和其他通信环境 接受此服务所必需。</li>
                <li class="mb-3">本公司对因本服务的变更、中断、取消而造成的损失不承担任何责任。</li>
            </ul>

            <h3 style="font-size: 20px;"><strong>适用法律</strong></h3>
            <p style="text-indent:40px;">关于其成立、生效、遵守和问题的解决本规范的 应根据泰国法律执行。</p>
            <h3 style="font-size: 20px;"><strong>具有监督权的法院</strong></h3>
            <p style="text-indent:40px;">如果对这些条款有争议 泰国境内法院被认为是有权监督初审法院特别协议的法院。</p>
            <br>
            <p class="text-right">截至 2020 年 9 月 30 日的條款</p>
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
