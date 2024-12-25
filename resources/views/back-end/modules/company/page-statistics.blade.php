<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    div.dataTables_wrapper div.dataTables_length select {
        width: -webkit-fill-available !important;
    }
</style>

<div class="card">
    <div class="card-body">
        <div class="row mb-3">
            <div class="col-lg-12 col-xs-12 position-relative">
                <div class="font-weight-bold pb-2">{{ $cp_name->name_th }} / {{ $cp_name->name_en }}</div>
                <a href="api/{{ $category }}/{{ request()->segment(5) }}/statistics/report"
                    class="btn btn-outline-success position-absolute export-click" style="right: 0; top:0">Report
                </a>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-lg-6 col-xs-12 form-inline">
                <div class="input-group float-left">
                    <input type="text" id="daterange" class="form-control" name="daterange"
                        style="background-color:whitesmoke;">
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary input-sm btn-search" type="button"><i
                                class="fas fa-search"></i>&nbsp;Search</button>
                        <button class="btn btn-outline-danger input-sm btn-reset" type="button"><i
                                class="fas fa-sync-alt"></i>&nbsp;Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-2 col-lg-4 col-md-6 col-xs-12">
                <div class="card text-white bg-gradient-info">
                    <div
                        class="card-body card-body pt-2 pb-1 d-flex justify-content-between align-items-center all-view">
                        <div class="row" style="min-height:100px;">
                            <div class="col-6 border-white border">
                                <div class="text-value-lg allview">0</div>
                                <div><small>Total CP <i class="fas fa-eye"></i></small></div>
                            </div>
                            <div class="col-6 border-white border">
                                <div class="text-value-lg blogtocp">0</div>
                                <div><small>Blog -> CP</small></div>
                            </div>
                            <div class="col-6 border-white border">
                                <div class="text-value-lg recommendtocp">0</div>
                                <div><small>Home -> CP</small></div>
                            </div>
                            <div class="col-6 border-white border">
                                <div class="text-value-lg bannertocp">0</div>
                                <div><small>Banner -> CP</small></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-6 col-xs-12">
                <div class="card text-white bg-gradient-primary">
                    <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start all-phone">
                        <div style="min-height:100px;">
                            <div class="text-value-lg">0</div>
                            <div>ดูหมายเลขโทรศัพท์<br>Clicks at Telephone number</div>
                        </div>
                        <i class="fas fa-phone-square fa-4x"></i>
                    </div>
                </div>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-6 col-xs-12">
                <div class="card bg-gradient-dark">
                    <div
                        class="card-body card-body pt-2  pb-2 d-flex justify-content-between align-items-center all-news text-white">
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
            <div class="col-xl-2 col-lg-4 col-md-6 col-xs-12">
                <a href="{{ $prefix }}/company/{{ $category }}/stat-email/{{ request()->segment(5) }}"
                    style="text-decoration: none">
                    <div class="card bg-gradient-light">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start all-letter">
                            <div style="min-height:100px;">
                                <div class="text-value-lg">0</div>
                                <div>กรอกฟอร์มอีเมล<br>Fill in Email form</div>
                            </div>
                            <i class="fas fa-inbox fa-4x"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-6 col-xs-12">
                <a href="{{ $prefix }}/company/{{ $category }}/stat-popup/{{ request()->segment(5) }}"
                    style="text-decoration: none">
                    <div class="card bg-gradient-light">
                        <div
                            class="card-body card-body pb-0 d-flex justify-content-between align-items-start all-popup">
                            <div style="min-height:100px;">
                                <div class="text-value-lg">0</div>
                                <div>กรอกป็อปอัพ<br>Fill in Popup form</div>
                            </div>
                            <i class="far fa-file-alt fa-4x"></i>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-xl-2 col-lg-4 col-md-6 col-xs-12">
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
    </div>
</div>

<div class="card">
    <div class="card-body">
        <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
            <button type="button" class="btn btn-light btn-empty-ms btn-graph active" data-length="6">6 Month</button>
            <button type="button" class="btn btn-light btn-empty-ms btn-graph" data-length="12">1 Year</button>
        </div>
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

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12">
                <table class="table table-striped" id="stBrowser" style="width:100%;">
                    <thead>
                        <tr>
                            <th width="8%">No.</th>
                            <th width="15%">ประเทศ / Country</th>
                            <th width="55%">พื้นที่ / Area</th>
                            <th width="22%">จำนวนคลิก/ Clicks</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>

<input type="hidden" name="company" value="{{ request()->segment(5) }}">
<script src="js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/series-label.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    let apiUrl = window.location.pathname;
    let category = apiUrl.split('/')[3];
    let cid = apiUrl.split('/')[5];
    let dateCreate = "{{ $dateCreate->created }}";

    function formatDate(input) {
        var datePart = input.match(/\d+/g),
            year = datePart[0].substring(2), // get only two digits
            month = datePart[1],
            day = datePart[2];
        return day + '/' + month + '/' + year;
    }
    let monthOfYear = [
        'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'
    ];

    function getkeyOfMonth (txt)
    {
        let res = 0;
        monthOfYear.map((e,i)=>{ if(e==txt){ res = i;  return false;}  });
        return res+1;
    }

    $('input[name="daterange"]').daterangepicker({
        locale: {
            format: 'DD/MM/YYYY'
        },
        startDate: formatDate(dateCreate),
        minDate: formatDate(dateCreate),
        maxDate: moment(new Date()).format("DD/MM/YYYY")
    });

    $('input[name="daterange"]').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
    });

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

    function staticClick(req) {
        const request = {};
        request.company = $('input[name="company"]').val();
        request.range = (req?.range) ? req.range : '';
        const stClick = $.ajax({
            url: 'api/' + category + '/' + cid + '/statistics/click',
            data: request,
            async: false
        }).responseJSON

        $('.all-view').find('.text-value-lg.allview').html(stClick.monthlyView);
        $('.all-view').find('.text-value-lg.blogtocp').html(stClick.blogtocp);
        $('.all-view').find('.text-value-lg.recommendtocp').html(stClick.recommendtocp);
        $('.all-view').find('.text-value-lg.bannertocp').html(stClick.bannertocp);

        $('.all-phone').find('.text-value-lg').html(stClick.telephoneMonthly);

        $('.all-news').find('.text-value-lg.monthly').html(stClick.blogMonthly);
        $('.all-news').find('.text-value-lg.blogTotal').html(stClick.blogTotal);

        $('.all-letter').find('.text-value-lg').html(stClick.emailContactMonthly);
        $('.all-popup').find('.text-value-lg').html(stClick.popupMonthly);

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
                    dataLabels: {
                        enabled: true
                    },
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
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'BackLink',
                data: backlink.totals
            }]
        });
        const pageviewOld = extractDataGraph(graph, 'pageviewOld');
        
        let pvoLength = pageviewOld.months.length
        let end = pageviewOld.months[pvoLength-1];
        let endNo = getkeyOfMonth(end.split(' ')[0]);
        let start = moment(end).subtract(6, 'months').format('MMMM YYYY');
        let startNo = getkeyOfMonth(start.split(' ')[0]);

        console.log(startNo, start,endNo, end);
        
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
                    dataLabels: {
                        enabled: true
                    },
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
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: false
                }
            },
            series: [{
                name: 'BackLink',
                data: backlinkOld.totals
            }]
        });
    }

    function statisticsLocate(req) {
        const request = {};
        request.company = $('input[name="company"]').val();
        request.range = (req?.range) ? req.range : '';
        request.len = (req?.len) ? req.len : '';
        const response = $.ajax({
            url: 'api/' + category + '/' + cid + '/statistics/locate',
            data: request,
            async: false,
            dataType: 'json'
        }).responseJSON;
        return response;
    }

    function fetchLocate(request) {
        const data = statisticsLocate(request);
        var stLocate = []
        $.each(data, function(k, v) {
            stLocate.push([v.no, v.country, v.city, v.clicks, v.accuracy])
        });
        tab = $('#stBrowser').DataTable();
        tab.destroy();
        $('#stBrowser').DataTable({
            // width: '100%',
            retrieve: true,
            responsive: true,
            columnDefs: [{
                targets: 2,
                className: 'text-center'
            }],
            order: [
                [0, "asc"]
            ],
            info: false,
            data: stLocate
        });
    }

    staticClick();
    fetchGraph();
    fetchLocate();

    document.addEventListener('click', function(e) {
        const exportClick = e.target.closest('.export-click');
        if (exportClick) {
            e.preventDefault();
            let testDate = document.querySelector('#daterange').value;
            testDate = testDate.split(' - ');
            start = testDate[0].split('/');
            end = testDate[1].split('/');
            StartDate = `${start[2]}-${start[1]}-${start[0]}`;
            endDate = `${end[2]}-${end[1]}-${end[0]}`;
            let request = StartDate + ',' + endDate;
            let newUrl = exportClick.getAttribute('href') + `?range=${StartDate},${endDate}`;
            window.open(newUrl, '_blank', "width=1200,height=800");
        }

        const searchBtn = e.target.closest('.btn-search');
        if (searchBtn) {
            let testDate = document.querySelector('#daterange').value;
            testDate = testDate.split(' - ');
            start = testDate[0].split('/');
            end = testDate[1].split('/');
            StartDate = `${start[2]}-${start[1]}-${start[0]}`;
            endDate = `${end[2]}-${end[1]}-${end[0]}`;
            let request = StartDate + ',' + endDate;
            staticClick({
                'range': request
            });
            fetchLocate({
                'range': request
            });
        }

        const resetBtn = e.target.closest('.btn-reset');
        if (resetBtn) {
            staticClick('');
            fetchLocate('');
        }

        const graphBtn = e.target.closest('.btn-graph');
        if (graphBtn) {
            if (!graphBtn.classList.contains('active')) {
                document.querySelector('.btn-graph.active').classList.remove('active');
                graphBtn.classList.add('active');
                const range = graphBtn.dataset.length;
                fetchGraph(range);
            }
        }
    })
</script>
