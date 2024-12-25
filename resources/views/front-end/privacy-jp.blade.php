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
            <h2 style="font-size: 26px"><strong> 用户隐私政策（隐私政策）</strong></h2>
            <h3 style="font-size:18px;"><strong> 1. 定义</strong></h3>

            <p class="pl-4"><strong>“您”</strong> 是指网站的用户。</p>
            <p class="pl-4"><strong>“我们”</strong> 是指At-Once 网站 由1-CE Wind Company Limited 准备。</p>
            <p class="pl-4"><strong>“网站”</strong> 是指我们当前提供的以及我们将来修改、更改、改进、更新或开发的网站和/或应用程序。</p>
            <p class="pl-4"><strong>“个人数据”</strong> 是指能够直接或间接识别个人身份的有关个人的信息根据个人资料保护法。</p>
            <p class="pl-4"><strong>“Cookie”</strong> 是指我们网站创建的文本文件，用于下载到您用于访问网站的计算机设备、平板电脑或手机上。 此类cookie或文本文件记录各种信息和设置以帮助您持续、方便地访问网站包括以文件的形式收集有关您在喜爱的网站上的浏览历史记录的信息。 这将有利于发展令您满意的服务。 Cookie 不会对您的设备造成任何损害。 Cookie 的内容只能由创建它们的网站查看或读取。
            </p>

            <h3 style="font-size:18px;"><strong> 2. 个人信息保护政策中的免责声明</strong></h3>
            <p class="pl-4">本个人信息保护政策 我们准备此信息是为了让您理解并同意 意识到您个人信息隐私的重要性。 但是，我们仍然可以修改和完善此个人数据保护政策，以与我们提供的服务保持一致。 无需通知或提前通知您。
            </p>

            <h3 style="font-size:18px;"><strong> 3. 个人信息的收集</strong></h3>
            <p class="pl-4">为了您通过网站使用我们的各种服务的利益。 包括改进和开发我们的产品或服务，让您满意。注册服务时直接发送给我们的个人信息 或回答问卷、调查或参与我们的任何其他活动，例如名字、电话号码、 电子邮件、地址或住所、存款帐号、信用卡号码、身份证号码、税号等 和/或通过您在网站上使用或使用我们的服务和/或通过 cookie 收集的信息。 或任何其他技术，例如登录日志数据（Login Log）、交易数据（Transaction Log）、使用行为（Customer Behavior）、计算机流量数据（Log）、您与用户之间的联系和通信数据。 有关设备的信息：电脑的 IP 地址、设备标识符、电信网络信息、连接信息、位置数据或地理坐标 网站信息、浏览器（Browser）、网站访问统计 访问网站的时间（Access Time） 您搜索的信息 使用网站上的各种功能，我们只会收集您必要的个人信息。 以及上述和本政策中指定的各种福利所必需的期限。
            </p>


            <h3 style="font-size:18px;"><strong> 4. 个人信息的使用</strong></h3>
            <p class="pl-4">我们将把个人信息用于以下目的。</p>
            <p class="pl-4">4.1 我们将把个人信息用于以下目的。</p>
            <p class="pl-4">4.2 在使用我们的各项服务时识别并确认您的身份。</p>
            <p class="pl-4">4.3 制定使用服务的安全标准信息技术基础设施的管理和保护，在这一部分中我们将仅处理必要的内容。并且在使用您的个人信息和/或安排随机检查之前可能需要加密。 或经其他人测试以管理风险 或用于任何其他可能违反法律的目的。 相关使用规定 或网站使用条款和条件 我们的（“使用条款和条件”）</p>
            <p class="pl-4">4.4 发展或提高我们为您提供的服务的效率。</p>
            <p class="pl-4">4.5 通过不限于电话、短信（SMS）、电子邮件、邮寄等多种渠道与您沟通，或通过任何渠道向您询问或通知。 或检查并确认您的帐户信息 必要时提供我们的服务。</p>
            <p class="pl-4">4.6 与我们的业务运营相关的任何其他利益，例如广告、公共关系、教育、研究、收集和准备统计数据。 以及为您提供的各种服务提供各种建议。</p>

            <h3 style="font-size:18px;"><strong> 5. 向第三方披露个人信息</strong></h3>
            <p class="pl-4">除非得到您的同意或为了在我们的网站上向您提供服务，否则我们不会向第三方披露您的个人信息。 同意我们向集团内的公司披露您的个人信息 包括与我们一起工作的人 或国内外的其他人 （“赞助商”）但是，这样做 我们将确保这些人员对您的个人信息保密，并且不会将您的个人信息用于我们指定范围之外的目的。
            </p>

            <p class="pl-4">如果您不希望我们向赞助商披露您的个人信息。 您可以通知我们停止这样做，但我们无法确认或保证。 我们暂停向赞助商披露您的个人信息的结果是否会影响您使用我们的服务 由于向您提供我们的服务可能需要您仅向我们的赞助商提供必要的个人信息，因此您应谨慎行事或寻求我们的建议。</p>
            <p class="pl-4">在公司重组时，我们也可能会披露您的个人信息。 公司合并 或出售业务 我们可能会将我们收集的全部或部分您的个人信息转移给相关公司。
            </p>


            <h3 style="font-size:18px;"><strong> 6. 删除个人信息</strong></h3>
            <p class="pl-4">个人信息对于使用我们网站的服务至关重要。因此，如果您不同意我们使用您的个人信息， 或允许我们从我们的系统中删除您的个人信息，无论是全部还是部分。 它可能会阻止您访问我们的服务。 或者可能无法充分利用该服务的潜力 我们对您没有任何义务或责任。 如果您想恢复使用我们网站的服务以像往常一样高效。 您可能需要向我们提供所有新的个人信息。 或执行我们设置您遵循的指示。</p>


            <p class="pl-4">此外，如果您要求我们从该系统中删除您的个人信息。 我们将尽最大努力利用现有技术和系统能力将您的信息从系统中删除，但该等信息是否仍可能被记录或复制在服务器（Server）或我们的备份系统上，这是技术限制 我们不以任何方式违背您的意愿。 并应视为我们已经实现了您的愿望。</p>

            <p class="pl-4">如果您对我们收集、使用和/或披露您的个人信息有任何疑问。
                <br>
                您可以通过以下方式联系我们进行咨询 <a href="mailto:marketing@at-once.info"> marketing@at-once.info </a>
                &nbsp;&nbsp; 或 <a href="tel:021266625">02-126-6625</a>
            </p>

            <h3 style="font-size:18px;"><strong> 7. 联系我们</strong></h3>
            <p class="pl-4">如果您对个人数据保护政策有任何疑问或疑问。 您可以通过以下渠道联系管理员<br>
                <a href="mailto:marketing@at-once.info"> marketing@at-once.info </a> 或电话号码 <a
                    href="tel:021266625"> 02-126-6625</a>
            </p>

            <h3 style="font-size:18px;"><strong> 8. 个人数据保护政策的执行</strong></h3>
            <p class="pl-4">
                本个人数据保护政策适用于我们现在和将来收集的所有个人数据。 您同意我们有权收集、维护和使用我们收集的您的个人信息 或透露给其他人 在本个人信息保护政策规定的范围内。</p>
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
