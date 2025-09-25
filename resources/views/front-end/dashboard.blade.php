<!doctype html>
<html lang="{{ Session('lang') }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ENV('APP_NAME') }}</title>

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

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/header-footer.css" rel="stylesheet">
    <link href="css/member-company.css?v=002" rel="stylesheet">
    <link rel="stylesheet" href="css/gallery.css?v=0001">
    <link rel="stylesheet" href="css/validate.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <style>
        .group-graph {
            margin-right: 12px;
            border-radius: 32px !important;
            border: solid 0.8px #eeeeee;
            background-color: #f8f8f8;
        }

        .btn-group,
        .btn-group-vertical {
            position: relative;
            display: inline-block;
            vertical-align: middle;
        }

        .btn-empty-ms {
            z-index: 2;
            left: 0%;
            display: block;
        }

        .btn-empty-ms.active {
            background-color: #21b79a;
            border-radius: 32px !important;
            color: #ffffff;
        }

        .btn.active,
        .btn:active {
            background-color: #7f7f7f;
        }


        .btn-group-vertical>.btn,
        .btn-group>.btn {
            position: relative;
            float: left;
        }

        .btn.active,
        .btn:active {
            outline: 0;
            -webkit-box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
            box-shadow: inset 0 3px 5px rgba(0, 0, 0, .125);
        }

        .box-view {
            border: solid 1px #f1f1f1;
            border-radius: 8px;
            color: #fff;
            padding: 10px;
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.05);
        }

        .box-view p {
            margin-bottom: 0px;
        }

        .box-view img {
            filter: invert(1);
            margin-bottom: 5px;
        }

        .all-phone {
            background-color: #f97157;
        }

        .all-view {
            background-color: #13bb9a;
        }

        .all-click {
            background-color: #268ed2;
        }

        .all-visit {
            background-color: #268ed2;
        }

        .row-ctr {
            box-shadow: 0 2px 4px 0 rgba(0, 0, 0, 0.05);
            border: solid 1px #f1f1f1;
            background-color: #ffffff;
            border-radius: 8px;
            min-height: 87px;
        }

        .percent-ctr {
            margin-top: 10px;
        }

        .btn-empty-ms:active {
            border-radius: 32px !important;
        }

        .btn-empty-ms.active {
            border-radius: 32px !important;
        }

        .btn-empty-ms {
            border-radius: 32px !important;
        }


        .highcharts-figure,
        .highcharts-data-table table {
            min-width: 310px;
            max-width: 800px;
            margin: 1em auto;
        }

        #container {
            height: 400px;
        }

        .highcharts-data-table table {
            font-family: Verdana, sans-serif;
            border-collapse: collapse;
            border: 1px solid #EBEBEB;
            margin: 10px auto;
            text-align: center;
            width: 100%;
            max-width: 500px;
        }

        .highcharts-data-table caption {
            padding: 1em 0;
            font-size: 1.2em;
            color: #555;
        }

        .highcharts-data-table th {
            font-weight: 600;
            padding: 0.5em;
        }

        .highcharts-data-table td,
        .highcharts-data-table th,
        .highcharts-data-table caption {
            padding: 0.5em;
        }

        .highcharts-data-table thead tr,
        .highcharts-data-table tr:nth-child(even) {
            background: #f8f8f8;
        }

        .highcharts-data-table tr:hover {
            background: #f1f7ff;
        }

        .right .loading-overlay {
            margin: 0;
        }

        .loading-overlay {
            top: 0;
            z-index: 100;
            width: 100%;
            height: 100%;
        }

        .cv-spinner {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px #ddd solid;
            border-top: 4px #2e93e6 solid;
            border-radius: 50%;
            animation: sp-anime 0.8s infinite linear;
        }

        @keyframes sp-anime {
            100% {
                transform: rotate(360deg);
            }
        }

        .is-hide {
            display: none;
        }

        .pagination .previous a,
        .pagination .next a {
            font-size: 40px;
            vertical-align: middle;
            display: grid;
            align-content: center;
        }
    </style>
</head>

<body>
    @if ($module != 'member')
        @include("$prefix.$module.header")
    @else
        @include("$prefix.header")
    @endif
    <section class="page">
        <div class="container">
            <div class="col-lg-12">
                <div class="loading-overlay">
                    <div class="cv-spinner">
                        <span class="spinner"></span>
                    </div>
                </div>
                <div class="personal row" style="box-shadow: rgba(0, 0, 0, 0.08) 0px 4px 16px;">
                    <div class="left">
                        @include("$prefix.member.member-menu")
                        <input type="hidden" name="id" value="{{ $row->id }}">
                        <input type="hidden" name="categoryId" value="{{ $row->categoryId }}">
                        <input type="hidden" name="categoryKey" value="{{ $row->categoryKey }}">
                        <input type="hidden" name="categoryName" value="{{ $row->categoryName }}">
                    </div>
                    <div class="right">
                        <div class="group-box-right" style="display: none;">
                            <div class="row ">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                    <h5 class="bold mt-2">@lang('phrase.member.statistics')</h5>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                                    <div class="input-group">
                                        <input type="text" id="daterangeVisitor" class="form-control pd-0"
                                            name="daterange" readonly style="background-color:whitesmoke;">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-primary input-sm btn-search" type="button"
                                                data-type="clicks"><i class="fas fa-search"></i>&nbsp;ค้นหา</button>
                                            <button class="btn btn-outline-danger input-sm btn-reset" type="button"
                                                data-type="clicks"><i class="fas fa-sync-alt"></i>&nbsp;รีเซ็ต</button>
                                        </div>
                                    </div>
                                    <div class="mb-3"></div>
                                </div>
                            </div>
                            <div class="row ">
                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                    <div class="row row-click-view">
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">
                                            <div class="box-view all-view">
                                                <img src="images/icon/eye.svg" width="20">
                                                <p style="margin-bottom:0">@lang('phrase.member.see-profile')</p>
                                                <p style="font-size: 20px;">0 <small>ครั้ง</small></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">
                                            <div class="box-view all-phone">
                                                <img src="images/icon/phone-call.svg" width="20">
                                                <p style="margin-bottom:0">@lang('phrase.member.see-telephone')</p>
                                                <p style="font-size: 20px;">0 <small>ครั้ง</small></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-6 col-xs-6 text-center">
                                            <div class="box-view all-visit">
                                                <img src="images/icon/lang-icon.png" style="filter:invert(0)"
                                                    width="20">
                                                <p style="margin-bottom:0">@lang('phrase.member.see-my-website')</p>
                                                <p style="font-size: 20px;">0 <small>ครั้ง</small></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-12">
                                    <figure class="highcharts-figure">
                                        <div id="device"></div>
                                        <p class="highcharts-description"></p>
                                    </figure>
                                </div>
                            </div>
                            <div class="mt-4 mx-0">
                                <table class="table" id="st-country" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th width="70%">Country</th>
                                            <th width="30%" style="text-align:right;">Clicks</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("$prefix.footer")

    <script src="js/jquery.js"></script>
    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/uk-tab.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=001"></script>
    <script src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
    <script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="js/build/main.js?v=04"></script>
    <script src="js/build/media.image.js?v=005"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="js/build/dashboard.js"></script>
    <script>
        $(".loading-overlay").fadeIn(300);
        tinymce.init({
            selector: 'textarea.tiny-detail',
            menubar: false,
            force_br_newlines: true,
            force_p_newlines: false,
            forced_root_block: '',
            height: 600,
            plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor colorpicker layer textpattern moxiemanager"
            ],
            toolbar: 'undo redo | table | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | nonbreaking hr code',
        });

        $('i.fa-eye-slash').click(function() {
            $(this).toggleClass('fa-eye-slash fa-eye');
            const prev = $(this).parent().parent().prev();
            type = (prev.attr('type') == 'password') ? 'text' : 'password';
            prev.attr('type', type);
        });
        errMessage = {
                password_require: ['ป้อนรหัสผ่านใหม่', 'Enter new password.'],
                new_password: ['ป้อนรหัสผ่านยืนยัน.', 'Enter enter confirm password.'],
                minlength: ['พาสเวิร์อย่างน้อย', 'Password at least'],
                characters: ['ตัวอักษร', 'characters'],
                equalTo: ['พาสเวิร์ดไม่ตรงกัน', 'Password mismatch.']
            },
            lang = '{{ Session('lang') }}',
            hl = (lang == 'th') ? 0 : 1;

        $('#change-password').validate({
            ignore: [],
            rules: {
                password: {
                    required: true,
                    minlength: 8
                },
                confirm: {
                    required: true,
                    minlength: 8,
                    equalTo: '#password'
                },
            },
            messages: {
                password: {
                    required: errMessage.password_require[hl],
                    minlength: errMessage.minlength[hl] + ' {0} ' + errMessage.characters[hl]
                },
                confirm: {
                    required: errMessage.new_password[hl],
                    minlength: errMessage.minlength[hl] + ' {0} ' + errMessage.characters[hl],
                    equalTo: errMessage.equalTo[hl]
                }
            },
            errorPlacement: function(error, input) {
                error.insertAfter(input.parent().prev());
            }
        })
        var lang = '{{ Session('lang') }}';
        var cid = '{{ @$cid }}',
            url = window.location;
        var resultBrowser = null;
        var browser = [],
            device = [],
            table = $('#st-country');
        let category = $('input[name="categoryKey"]').val();
        this.fetchLocate();
        this.staticClick();
        this.generateChart();
        window.addEventListener("load", (event) => {
            setTimeout(function() {
                $('.group-box-right').fadeIn(300);
                $(".loading-overlay").fadeOut(300);
            }, 500);
        });

        $('input[name="daterange"]').daterangepicker();
        let search = document.querySelectorAll('.btn-search');
        for (i = 0; i < search.length; i++) {
            search[i].onclick = function() {
                $('.group-box-right').fadeOut(300);
                $('.loading-overlay').fadeIn(300);
                let testDate = this.parentNode.previousElementSibling.value;
                testDate = testDate.split(' - ');
                let request = moment(testDate[0]).format('YYYY-MM-DD') + ',' + moment(testDate[1]).format('YYYY-MM-DD');
                let load = {};
                setTimeout(() => {
                    load.first = staticClick(request);
                    load.second = generateChart(request);
                    load.third = fetchLocate(request);
                    if (Object.keys(load).length == 3) {
                        $('.group-box-right').fadeIn(300);
                        $(".loading-overlay").fadeOut(300);
                    }
                }, 500);
            }
        }

        let reset = document.querySelectorAll('.btn-reset');
        for (i = 0; i < reset.length; i++) {
            reset[i].onclick = function() {
                switch (this.getAttribute('data-type')) {
                    case 'clicks':
                        staticClick('');
                        generateChart('');
                        fetchLocate('');
                        break;
                    default:
                        fetchLocate('');
                        break;
                }
            }
        }
    </script>
</body>

</html>
