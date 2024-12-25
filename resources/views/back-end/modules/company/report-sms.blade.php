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
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <style>
        @page {
            size: 'A4';
        }
        @media print {
            html,
            body {
                /* width: 210mm; */
                /* height: 100%; */
                margin-bottom: 10mm;
            }

            .btn-print {
                display: none;
            }

            .img {
                width: 20%;
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

            body {
                /* top:0; */
                /* page-break-inside: avoid; */
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
                width: 253mm;
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

            tfoot tr,
            tfoot tr td {
                border: none;
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
                        <div class="border text-center mt-1">{{ date('F Y', strtotime('-1 month')) }}</div>
                    </div>
                </div>
            </div>
            @php
                $year = date('m') == 1 ? date('Y', strtotime('-1 year')) : date('Y');
                $lastMonth = date('m', strtotime('-1 month'));
                $lastDay = date('d', strtotime('last day of previous month'));
                $start = date('Y-m-d', strtotime($year . '-' . $lastMonth . '-1'));
                $end = date('Y-m-d', strtotime($year . '-' . $lastMonth . '-' . $lastDay));
            @endphp
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
                                <td style="vertical-align:middle;">{{ date('d/m/Y', strtotime($start)) }} -
                                    {{ date('d/m/Y', strtotime($end)) }}</td>
                            </tr>
                            <tr>
                                <td><strong>ลิงค์โปรไฟล์</strong><br><strong>URL Company</strong></td>
                                <td colspan="3" style="vertical-align:middle;"><a
                                        href="{{ url("th/$category/cp/$row->profile_url") }}"
                                        style="text-decoration:none;">{{ url("th/$category/cp/$row->profile_url") }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-xs-12">
                    <div class="card text-white bg-gradient-info">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start all-popup">
                            <div style="min-height:100px;">
                                <div class="text-value-lg">0</div>
                                <div>Total Popup Showed Up</div>
                            </div>
                            <i class="fas fa-eye fa-4x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-12">
                    <div class="card text-white bg-gradient-primary">
                        <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start all-send">
                            <div style="min-height:100px;">
                                <div class="text-value-lg">0</div>
                                <div>User Fill In Popup</div>
                            </div>
                            <i class="fas fa-user-edit fa-4x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-12">
                    <div class="card text-white bg-gradient-dark">
                        <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start all-sms">
                            <div style="min-height:100px;">
                                <div class="text-value-lg">0</div>
                                <div>Send Popup By SMS</div>
                            </div>
                            <i class="fas fa-sms fa-4x"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="card bg-gradient-light">
                        <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start all-line">
                            <div style="min-height:100px;">
                                <div class="text-value-lg">0</div>
                                <div>Send Popup By Line Notification</div>
                            </div>
                            <i class="fab fa-line fa-4x"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <div class="footer">  
        <div class="flex">                                    
            <div class="right">
                <span >ค้นหาข้อมูลบริษัท</span><br>
                <a href="https://www.at-once.info">www.at-once.info</a>
            </div>
            <img src="img/at-once-black.png" width="5%" class="img pt-2 pr-2 mr-2">                                         
        </div>
    </div>
</footer>

<script src="back-end/jquery-3.5.1/jquery-3.5.1.min.js"></script>

<script>
    let apiUrl = window.location.pathname;
    let category = apiUrl.split('/')[3];
    let cid = apiUrl.split('/')[5];

    function totalpopup(request) {
        request = (request == null) ? '' : '?range=' + request;
        const popup = $.ajax({
            url: 'api/{{$category}}/' + cid + '/statistics/popup' + request,
            async: false
        }).responseJSON

        $('.all-popup').find('.text-value-lg').html(popup.popup);
        $('.all-send').find('.text-value-lg').html(popup.send);
        $('.all-sms').find('.text-value-lg').html(popup.sms);
        $('.all-line').find('.text-value-lg').html(popup.line);
    }

    this.totalpopup();

    $('.btn-print').click(function(){
            window.print();
    });
</script>
