<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Report_{{ str_replace('.', '-', $row->name_en) }}_{{ Date('d-m-Y_H-i-s') }}</title>
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="theme-color" content="#ffffff">
    <base href="{{ url('/') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon.ico">
    <link rel="stylesheet" href="back-end/fontawesome-5.11.2/css/all.css">
    <link href="back-end/css/style.css" rel="stylesheet">
    {{-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css"> --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    {{-- <link rel="stylesheet" type="text/css" href="https://gopeter.de/misc/c3/c3.css"> --}}
    <style>
        @page {
            size: 'A4';
        }

        @media print {

            html,
            body {
                margin-bottom: 10mm;
            }

            .btn-print {
                display: none;
            }

            .col-lg-4 {
                -ms-flex: 0 0 33.33333333%;
                flex: 0 0 33.33333333%;
                max-width: 33.33333333%;
            }

            .row {
                display: -ms-flexbox;
                display: flex;
                -ms-flex-wrap: wrap;
                flex-wrap: wrap;
                margin-right: -15px;
                margin-left: -15px;
            }

            .page-section {
                /* position: relative !important; */
                margin-bottom: 100px !important;
                top: 0.;
                height: 500px;
                clear: both;
                /* page-break-inside: avoid; */
            }

            .page-section svg {
                margin: 0;
                padding: 0;
                width: 80%;
            }

            .footer {
                page-break-after: always;
                position: fixed !important;
                display: block !important;
                left: 0;
                /* margin-top:2px; */
                bottom: -3px;
                width: 96%;
                background: #fff;
                border-bottom: 2px solid #fff !important;
            }

            .footer span,
            .footer a {
                font-size: 11px;
            }

            .footer a {
                text-decoration: none;
            }

            .footer .img {
                right: 0;
                float: right;
                width: 7% !important;
                border-right: 1px solid #dedede;
                padding-right: 10px;
            }

            .footer .right {
                right: 0;
                float: right;
            }

            .bg-gradient-info {
                background-color: #2982cc !important;
                background: linear-gradient(45deg, #39f 0%, #2982cc 100%);
                -webkit-print-color-adjust: exact;
                border-color: #2982cc;
                color: white !important;
            }

            .bg-gradient-primary {
                background: #1f1498 !important;
                background: linear-gradient(45deg, #321fdb 0%, #1f1498 100%);
                -webkit-print-color-adjust: exact;
                border-color: #1f1498;
                color: white !important;
            }

            .bg-gradient-dark {
                background: #212333 !important;
                background: linear-gradient(45deg, #3c4b64 0%, #212333 100%);
                -webkit-print-color-adjust: exact;
                border-color: #212333;
                color: white !important;
            }

            .bg-gradient-light {
                background: #fff;
                background: linear-gradient(45deg, #e3e8ed 0%, #fff 100%);
                -webkit-print-color-adjust: exact;
                border-color: #fff !important;
            }

            .bg-gradient-success {
                background: #1b9e3e;
                background: linear-gradient(45deg, #2eb85c 0%, #1b9e3e 100%);
                -webkit-print-color-adjust: exact;
                border-color: #1b9e3e !important;
            }
        }

        div.dataTables_wrapper div.dataTables_length select {
            width: -webkit-fill-available !important;
        }

        body {
            background-color: white !important;
        }

        .footer {
            display: none;
        }
    </style>

</head>

<body id="body">
    <div class="container">
        <div class="page-section">
            <div class="row">
                <div class="col-12">
                    <div class="form-group mt-3">
                        <button type="button" class="btn btn-primary btn-block btn-print">Export</button>
                    </div>
                </div>
            </div>
            <div class="row">
                @php
                    if (Request::get('range')) {
                        $range = explode(',', Request::get('range'));
                        $start = $range[0];
                        $end = $range[1];
                    } else {
                        $year = date('m') == 1 ? date('Y', strtotime('-1 year')) : date('Y');
                        $lastMonth = date('m', strtotime('-1 month'));
                        $lastDay = date('d', strtotime('last day of previous month'));
                        $start = date('Y-m-d', strtotime($year . '-' . $lastMonth . '-1'));
                        $end = date('Y-m-d', strtotime($year . '-' . $lastMonth . '-' . $lastDay));
                    }
                @endphp
                <div class="col-6">
                    <img src="img/at-once-black.png" width="10%" class="img"><br>
                    <strong>1-CE WIND CO., LTD.</strong><br>
                    <span>116/49 SSP Tower 2, 14Fl.,</span><br>
                    <span>Na Ranong Road, Klongtoey, Klongtoey, Bangkok 10110</span><br>
                    <span>Tax ID: 0105565069857</span>
                </div>
                <div class="col-6">
                    <div class="text-right float-right">
                        <strong>สถิติการเข้าชมประจำเดือน</strong><br>
                        <strong>Monthly Report</strong><br>
                        <div class="text-center mt-1">{{ date('d M Y', strtotime($start)) }} -
                            {{ date('d M Y', strtotime($end)) }}</div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="range" value="{{ $start }},{{ $end }}">
            <div class="row">
                <div class="col-12">
                    <table class="table table-bordered mt-3">
                        <tbody>
                            <tr>
                                <td>
                                    <strong>ชื่อบริษัท</strong><br>
                                    <strong>Company Name</strong><br>
                                </td>
                                <td><span>{{ $row->name_th }}</span><br><span>{{ $row->name_en }}</span></td>
                                <td><strong>สถิติวันที่</strong><br><strong>Date Statistics</strong></td>
                                <td style="vertical-align:middle;">{{ date('d M Y', strtotime($start)) }} -
                                    {{ date('d M Y', strtotime($end)) }}</td>
                            </tr>
                            <tr>
                                <td><strong>ลิงค์โปรไฟล์</strong><br><strong>URL Company</strong></td>
                                <td colspan="3" style="vertical-align:middle;">
                                    <a href="{{ url("th/$category/cp/$row->profile_url") }}"
                                        style="text-decoration:none;">
                                        {{ url("th/$category/cp/$row->profile_url") }}
                                    </a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-6">
                    <div class="card text-white bg-gradient-info">
                        <div
                            class="card-body card-body pt-2 pb-2 d-flex justify-content-between align-items-center all-view text-black">
                            <div style="min-height:100px;" class="d-flex flex-column align-items-start">
                                <div class="">
                                    <div class="text-value-lg monthly">0</div>
                                    <div>Monthly View</div>
                                </div>
                                <div class="">
                                    <div class="text-value-lg total">0</div>
                                    <div>Total View</div>
                                </div>
                            </div>
                            <i class="fas fa-inbox fa-4x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-6">
                    <div class="card text-white bg-gradient-primary">
                        <div
                            class="card-body card-body pt-2 pb-2 d-flex justify-content-between align-items-center all-phone text-black">
                            <div style="min-height:100px;" class="d-flex flex-column align-items-start">
                                <div class="">
                                    <div class="text-value-lg monthly">0</div>
                                    <div>Monthly Click Telephone</div>
                                </div>
                                <div class="">
                                    <div class="text-value-lg total">0</div>
                                    <div>Total Click Telephone</div>
                                </div>
                            </div>
                            <i class="fas fa-inbox fa-4x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-6">
                    <div class="card bg-gradient-dark">
                        <div
                            class="card-body card-body pt-2 pb-2 d-flex justify-content-between align-items-center all-news text-white">
                            <div style="min-height:100px;" class="d-flex flex-column align-items-start">
                                <div class="">
                                    <div class="text-value-lg monthly">0</div>
                                    <div>Monthly Blog View</div>
                                </div>
                                <div class="">
                                    <div class="text-value-lg blogTotal">0</div>
                                    <div>Total Blog View</div>
                                </div>
                            </div>
                            <i class="fas fa-globe fa-4x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-6">
                    <div class="card bg-gradient-light">
                        <div
                            class="card-body card-body pt-2 pb-2 d-flex justify-content-between align-items-center all-letter text-black">
                            <div style="min-height:100px;" class="d-flex flex-column align-items-start">
                                <div class="">
                                    <div class="text-value-lg monthly">0</div>
                                    <div>Monthly Form Contact</div>
                                </div>
                                <div class="">
                                    <div class="text-value-lg total">0</div>
                                    <div>Total Form Contact</div>
                                </div>
                            </div>
                            <i class="fas fa-inbox fa-4x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-6">
                    <div class="card bg-gradient-light">
                        <div
                            class="card-body card-body pt-2 pb-2 d-flex justify-content-between align-items-center all-popup text-black">
                            <div style="min-height:100px;" class="d-flex flex-column align-items-start">
                                <div class="">
                                    <div class="text-value-lg monthly">0</div>
                                    <div>Monthly Popup</div>
                                </div>
                                <div class="">
                                    <div class="text-value-lg total">0</div>
                                    <div>Total Popup</div>
                                </div>
                            </div>
                            <i class="fas fa-inbox fa-4x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-6">
                    <div class="card bg-gradient-success">
                        <div
                            class="card-body card-body pt-2  pb-2 d-flex justify-content-between align-items-center all-visit text-white">
                            <div style="min-height:100px;" class="d-flex flex-column align-items-start">
                                <div class="">
                                    <div class="text-value-lg cptoweb">0</div>
                                    <div>CP -> Website</div>
                                </div>
                                <div class="">
                                    <div class="text-value-lg blogtoweb">0</div>
                                    <div>Blog -> Website</div>
                                </div>
                            </div>
                            <i class="fas fa-globe fa-4x"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <h3 class="text-center">Non Member</h3>
                    <div class="row">
                        <div class="col-lg-4">
                            <div id="pageviewOld"></div>
                        </div>
                        <div class="col-lg-4">
                            <div id="inquiryOld"></div>
                        </div>
                        <div class="col-lg-4">
                            <div id="backlinkOld"></div>
                        </div>
                    </div>
                    <hr>
                    <h3 class="text-center mt-3">Member</h3>
                    <div class="row">
                        <div class="col-lg-4">
                            <div id="pageview"></div>
                        </div>
                        <div class="col-lg-4">
                            <div id="inquiry"></div>
                        </div>
                        <div class="col-lg-4">
                            <div id="backlink"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <table class="table" id="stBrowser" style="width:100%;">
                        <thead>
                            <tr>
                                <th width="8%">No.</th>
                                <th width="20%">ประเทศ / Country</th>
                                <th width="52%">พื้นที่ / Area</th>
                                <th width="20%">จำนวนคลิก / Clicks</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clicks as $k => $clk)
                                <tr>
                                    <td style="border-bottom: solid 1px #dedede;">{{ $k + 1 }}</td>
                                    <td style="border-bottom: solid 1px #dedede;">{{ $clk->country }}</td>
                                    <td style="border-bottom: solid 1px #dedede;">{{ $clk->city }}</td>
                                    <td style="border-bottom: solid 1px #dedede;" class="clicks">{{ $clk->clicks }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr style="border: none;">
                                <td colspan="4" style="border: none;">
                                    <div class="footer">
                                        <div class="flex">
                                            <div class="right">
                                                <span>ค้นหาข้อมูลบริษัท</span><br>
                                                <a href="https://www.at-once.info">www.at-once.info</a>
                                            </div>
                                            <img src="img/at-once-black.png" width="5%"
                                                class="img pt-2 pr-2 mr-2">
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <input type="hidden" name="company" value="{{ $row->id }}">

    <script src="back-end/jquery-3.5.1/jquery-3.5.1.min.js"></script>
    <script src="js/jquery.dataTables.min.js"></script>
    <script src="js/xepOnline.jqPlugin.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/data.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/drilldown.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>

    <script>
        const apiUrl = window.location.pathname;
        const category = apiUrl.split('/')[2];
        const cid = $('input[name="company"]').val()
        const search = window.location.search;

        const extractDataGraph = (data, key) => {
            const months = data[key].map(item => {
                return moment(item.month, 'M').format('MMM') + ' ' + item.year;
            });

            const totals = data[key].map(item => item.total);

            return {
                months: months,
                totals: totals
            }
        }

        function staticClick(request) {
            request = (request == null) ? '?range=' + $('input[name="range"]').val() : request;

            const stClick = $.ajax({
                url: 'api/' + category + '/' + cid + '/statistics/click' + request,
                async: false
            }).responseJSON

            $('.all-view').find('.text-value-lg.monthly').html(stClick.monthlyView);
            $('.all-view').find('.text-value-lg.total').html(stClick.totalView);

            $('.all-phone').find('.text-value-lg.monthly').html(stClick.telephoneMonthly);
            $('.all-phone').find('.text-value-lg.total').html(stClick.telephoneTotal);

            $('.all-news').find('.text-value-lg.monthly').html(stClick.blogMonthly);
            $('.all-news').find('.text-value-lg.blogTotal').html(stClick.blogTotal);

            $('.all-letter').find('.text-value-lg.monthly').html(stClick.emailContactMonthly);
            $('.all-letter').find('.text-value-lg.total').html(stClick.emailContactTotal);

            $('.all-popup').find('.text-value-lg.monthly').html(stClick.popupMonthly);
            $('.all-popup').find('.text-value-lg.total').html(stClick.popupTotal);

            $('.all-visit').find('.text-value-lg.cptoweb').html(stClick.cptoweb);
            $('.all-visit').find('.text-value-lg.blogtoweb').html(stClick.blogtoweb);

        }

        const fetchGraph = (monthRange) => {
            const range = monthRange ? monthRange : 6;
            const graph = $.ajax({
                url: 'api/' + category + '/' + cid + '/statistics/dataGraph?range=' + range,
                async: false
            }).responseJSON

            const pageview = extractDataGraph(graph, 'pageview');
            Highcharts.chart('pageview', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Page Views',
                    align: 'center'
                },
                xAxis: {
                    categories: pageview.months,
                    crosshair: true,
                    accessibility: {
                        description: 'Monthly'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total (views)'
                    }
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Monthly',
                    data: pageview.totals
                }, ]
            });

            const inquiry = extractDataGraph(graph, 'inquiry');
            Highcharts.chart('inquiry', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Inquiry',
                },
                xAxis: {
                    categories: inquiry.months,
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total (Send)'
                    }
                },
                plotOptions: {
                    line: {
                        enableMouseTracking: false
                    }
                },
                series: [{
                    name: 'Inquiry',
                    data: inquiry.totals
                }]
            });

            const backlink = extractDataGraph(graph, 'backlink');
            Highcharts.chart('backlink', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'BackLink'
                },
                xAxis: {
                    categories: backlink.months,
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total (Clicks)'
                    }
                },
                plotOptions: {
                    line: {
                        enableMouseTracking: false
                    }
                },
                series: [{
                    name: 'BackLink',
                    data: backlink.totals
                }]
            });

            const pageviewOld = extractDataGraph(graph, 'pageviewOld');
            Highcharts.chart('pageviewOld', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Page Views',
                    align: 'center'
                },
                xAxis: {
                    categories: pageviewOld.months,
                    crosshair: true,
                    accessibility: {
                        description: 'Monthly'
                    }
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total (views)'
                    }
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Monthly',
                    data: pageviewOld.totals
                }, ]
            });

            const inquiryOld = extractDataGraph(graph, 'inquiryOld');
            Highcharts.chart('inquiryOld', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Inquiry',
                },
                xAxis: {
                    categories: inquiryOld.months,
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total (Send)'
                    }
                },
                plotOptions: {
                    line: {
                        enableMouseTracking: false
                    }
                },
                series: [{
                    name: 'Inquiry',
                    data: inquiryOld.totals
                }]
            });

            const backlinkOld = extractDataGraph(graph, 'backlinkOld');
            Highcharts.chart('backlinkOld', {
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'BackLink'
                },
                xAxis: {
                    categories: backlinkOld.months,
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Total (Clicks)'
                    }
                },
                plotOptions: {
                    line: {
                        enableMouseTracking: false
                    }
                },
                series: [{
                    name: 'BackLink',
                    data: backlinkOld.totals
                }]
            });
        }

        fetchGraph();
        staticClick();

        $('.btn-print').click(function() {
            setTimeout(function() {
                window.print();
            }, 1500);
        });
    </script>
</body>

</html>
