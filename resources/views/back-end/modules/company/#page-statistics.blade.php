<link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    div.dataTables_wrapper div.dataTables_length select {
        width: -webkit-fill-available !important;
    }
</style>

<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12 col-xs-12 mb-3 position-relative">
                <div class="font-weight-bold pb-2">{{ $cp_name->name_th }} / {{ $cp_name->name_en }}</div>
                <a href="{{ $prefix }}/company/{{ $category }}/statistics/{{ request()->segment(5) }}/report"
                    class="btn btn-outline-success position-absolute export-click" style="right:0; top:0;">Report
                </a>

            </div>
        </div>
        <div class="row">
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
                {{-- <div class="btn-group ml-lg-3 mt-xs-3" role="group" aria-label="Button group with nested dropdown">
                    <button type="button" class="btn btn-light btn-empty-ms" data-length="latest">Today</button>                        
                    <button type="button" class="btn btn-light btn-empty-ms" data-length="7">7 days</button>
                    <button type="button" class="btn btn-light btn-empty-ms" data-length="30">30 days</button>
                    <button type="button" class="btn btn-light btn-empty-ms" data-length="60">60 days</button>
                    <button type="button" class="btn btn-light btn-empty-ms active" data-length="all">All</button>
                </div> --}}
            </div>

        </div>
    </div>
</div>

{{-- <div class="card">
    <div class="card-body">
        <div class="row justify-content-between">
            <div class="col-lg-3">
                <div class="input-group">
                    <input type="text" id="daterangeVisitor" class="form-control" name="daterange" readonly style="background-color:whitesmoke;">  
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary input-sm btn-search" type="button" data-type="clicks"><i class="fas fa-search"></i>&nbsp;Search</button>
                        <button class="btn btn-outline-danger input-sm btn-reset" type="button" data-type="clicks"><i class="fas fa-sync-alt"></i>&nbsp;Reset</button>
                    </div>                             
                </div>
                <div class="mb-3"></div>
            </div>
        </div>
        
    </div>
</div> --}}
<div class="row">
    {{-- <div class="col-lg-2 col-xs-12">
        <div class="card text-white bg-gradient-info">
            <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start all-view">
                <div style="min-height:100px;">
                    <div class="text-value-lg">0</div>
                    <div>เข้าดูโปรไฟล์<br>PV's of CP</div>
                </div>
                <i class="fas fa-eye fa-4x"></i>
            </div>
        </div>
    </div> --}}
    <div class="col-lg-2 col-xs-12">
        <div class="card text-white bg-gradient-info">
            <div class="card-body card-body pt-2 pb-1 d-flex justify-content-between align-items-center all-view">
                <div class="row" style="min-height:100px;">
                    <div class="col-6 border-white border">
                        <div class="text-value-lg allview">0</div>
                        <div>Total CP <i class="fas fa-eye"></i></div>
                    </div>
                    <div class="col-6 border-white border">
                        <div class="text-value-lg blogtocp">0</div>
                        <div>Blog -> CP</div>
                    </div>
                    <div class="col-6 border-white border">
                        <div class="text-value-lg recommendtocp">0</div>
                        <div>Home -> CP</div>
                    </div>
                    <div class="col-6 border-white border">
                        <div class="text-value-lg bannertocp">0</div>
                        <div>Banner -> CP</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-2 col-xs-12">
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
    <div class="col-lg-2 col-xs-6">
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
    <div class="col-lg-2 col-xs-6">
        <a href="{{ $prefix }}/company/{{ $category }}/stat-email/{{ request()->segment(5) }}"
            style="text-decoration: none">
            <div class="card bg-gradient-light">
                <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start all-letter">
                    <div style="min-height:100px;">
                        <div class="text-value-lg">0</div>
                        <div>กรอกฟอร์มอีเมล<br>Fill in Email form</div>
                    </div>
                    <i class="fas fa-inbox fa-4x"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-2 col-xs-6">
        <a href="{{ $prefix }}/company/{{ $category }}/stat-popup/{{ request()->segment(5) }}"
            style="text-decoration: none">
            <div class="card bg-gradient-light">
                <div class="card-body card-body pb-0 d-flex justify-content-between align-items-start all-popup">
                    <div style="min-height:100px;">
                        <div class="text-value-lg">0</div>
                        <div>กรอกป็อปอัพ<br>Fill in Popup form</div>
                    </div>
                    <i class="far fa-file-alt fa-4x"></i>
                </div>
            </div>
        </a>
    </div>
    <div class="col-lg-2 col-xs-6">
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

<div class="card">

    <div class="card-body">
        {{-- <div class="row">
            <div class="col-lg-3">
                <div class="input-group">
                    <input type="text" id="daterangeLine" class="form-control" name="daterange" readonly style="background-color:whitesmoke;">  
                    <div class="input-group-prepend">
                        <button class="btn btn-outline-primary input-sm btn-search" type="button" data-type="grap"><i class="fas fa-search"></i>&nbsp;Search</button>
                        <button class="btn btn-outline-danger input-sm btn-reset" type="button" data-type="grap"><i class="fas fa-sync-alt"></i>&nbsp;Reset</button>
                    </div>                             
                </div>
                <div class="mb-3"></div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-lg-6">
                <div id="monthly"></div>
            </div>
            <div class="col-lg-6">
                <div id="browsers"></div>
            </div>
        </div>
    </div>
</div>
<div class="card">
    <div class="card-body">
        {{-- <div class="row">
            <div class="col-lg-12 mb-3">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="input-group float-left">
                            <input type="text" id="daterange" class="form-control" name="daterange" readonly style="background-color:whitesmoke;">  
                            <div class="input-group-prepend">
                                <button class="btn btn-outline-primary input-sm btn-search" type="button"><i class="fas fa-search"></i>&nbsp;Search</button>
                                <button class="btn btn-outline-danger input-sm btn-reset" type="button"><i  class="fas fa-sync-alt"></i>&nbsp;Reset</button>
                            </div>                             
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="mb-3 d-lg-none"></div>
                        <div class="btn-group ml-lg-3 mt-xs-3" role="group" aria-label="Button group with nested dropdown">
                            <button type="button" class="btn btn-light btn-empty-ms" data-length="latest">Today</button>                        
                            <button type="button" class="btn btn-light btn-empty-ms" data-length="7">7 days</button>
                            <button type="button" class="btn btn-light btn-empty-ms" data-length="30">30 days</button>
                            <button type="button" class="btn btn-light btn-empty-ms" data-length="60">60 days</button>
                            <button type="button" class="btn btn-light btn-empty-ms active" data-length="all">All</button>
                        </div>
                    </div>
                </div>
            </div>            
        </div> --}}

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
    var apiUrl = window.location.pathname;
    category = apiUrl.split('/')[3];
    cid = apiUrl.split('/')[5];
    var barChart = null;
    let dateCreate = "{{ $dateCreate->created }}";

    barGrap = function(req) {
        const request = {};
        request.company = $('input[name="company"]').val();
        request.range = (req?.range) ? req.range : '';
        request.len = (req?.len) ? req.len : '';
        var BrowserSt = $.ajax({
            method: 'get',
            url: 'api/statistics/device',
            data: request,
            dataType: 'JSON',
            async: false
        }).responseJSON;
        var bc = Highcharts.chart('browsers', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'ค่าเฉลี่ยน Browser ในการเข้าชมรายละเอียด<br>Average by browser'
            },
            // subtitle: { text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>' },
            accessibility: {
                announceNewData: {
                    enabled: true
                }
            },
            xAxis: {
                type: 'category'
            },
            yAxis: {
                title: {
                    text: 'Total percent market share'
                }
            },
            legend: {
                enabled: false
            },
            plotOptions: {
                series: {
                    borderWidth: 0,
                    dataLabels: {
                        enabled: true,
                        format: '{point.y:.1f}%'
                    }
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
            },
            series: [{
                name: "Browsers",
                colorByPoint: true,
                data: BrowserSt.data
            }],
            drilldown: {
                series: BrowserSt.drilldown
            },
            responsive: {
                rules: [{
                    condition: {
                        maxWidth: window.screen.width
                    },
                    chartOptions: {
                        legend: {
                            align: 'center',
                            verticalAlign: 'bottom',
                            layout: 'horizontal'
                        },
                        yAxis: {
                            labels: {
                                align: 'left',
                                x: 0,
                                y: -5
                            },
                            title: {
                                text: null
                            }
                        },
                        subtitle: {
                            text: null
                        },
                        credits: {
                            enabled: false
                        }
                    }
                }]
            }
        });

    }

    lineGrap = function(req) {
        const request = {};
        request.company = $('input[name="company"]').val();
        request.range = (req?.range) ? req.range : '';
        request.len = (req?.len) ? req.len : '';
        var LengthSt = $.ajax({
            method: 'get',
            url: 'api/statistics/length',
            data: request,
            dataType: 'JSON',
            async: false
        }).responseJSON;
        Highcharts.chart('monthly', {
            chart: {
                /*type:'area',*/
                scrollablePlotArea: {
                    minWidth: 700
                }
            },
            title: {
                text: 'สถิติการเข้าชมในช่วง 30 วันที่ผ่านมา<br>Traffic statistics for the last 30 days'
            },
            subtitle: {
                text: (LengthSt.total) ? `Total : ${LengthSt.total}` : ''
            },
            xAxis: {
                /* tickInterval: 7, // one week */
                categories: LengthSt.date
            },
            yAxis: [{
                    /* left y axis */
                    title: {
                        text: null
                    },
                    showFirstLabel: false
                },
                { // right y axis
                    linkedTo: 0,
                    gridLineWidth: 0,
                    opposite: true,
                    title: {
                        text: null
                    },
                    labels: {
                        align: 'left',
                        x: 0,
                        y: 16,
                        format: '{value:.,0f}'
                    },
                    showFirstLabel: false
                }
            ],
            tooltip: {
                valueSuffix: ' Clicks',
                split: true
            },
            plotOptions: {
                line: {
                    dataLabels: {
                        enabled: true
                    },
                    enableMouseTracking: true
                },
                /*area:{stacking:'normal',lineColor:'#666666',lineWidth:1,marker:{lineWidth:1,lineColor:'#666666'}}*/
            },
            series: [{
                name: `Users`,
                data: LengthSt.clicks.map(i => Number(i))
            }],
            legend: {
                align: 'left',
                verticalAlign: 'top',
                borderWidth: 0
            }
        });
    }



    function staticsBrowser(req) {
        const request = {};
        request.company = $('input[name="company"]').val();
        request.range = (req?.range) ? req.range : '';
        request.len = (req?.len) ? req.len : '';

        const response = $.ajax({
            url: 'api/' + category + '/' + cid + '/statistics/browser',
            data: request,
            async: false,
            dataType: 'json'
        }).responseJSON;
        return response;
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
    const stLocate = statisticsLocate(null);

    function staticClick(req) {
        const request = {};
        request.company = $('input[name="company"]').val();
        request.range = (req?.range) ? req.range : '';
        request.len = (req?.len) ? req.len : '';
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

    this.barGrap();
    this.lineGrap();
    this.staticClick();

    $('#stBrowser').dataTable({
        // width: '100%',
        retrieve: true,
        responsive: true,
        columnDefs: [{
            targets: 2,
            className: 'text-left'
        }],
        order: [
            [0, "asc"]
        ],
        info: false,
        data: fetchData(stLocate, ['no', 'country', 'city', 'clicks'])
    });

    function fetchData(data, fields) {
        const array = [];
        $.each(data, function(key, val) {
            let nArray = [];
            let run = 0;
            $.each(val, function(k, v) {
                let check = $.inArray(k, fields);
                if (check >= 0) {
                    nArray[check] = v;
                    run++;
                }
                if (fields.length == run) {
                    array.push(nArray);
                    run = 0;
                    nArray = [];
                }
            })
        });
        return array;
    }

    function formatDate(input) {
        var datePart = input.match(/\d+/g),
            year = datePart[0].substring(2), // get only two digits
            month = datePart[1],
            day = datePart[2];

        return day + '/' + month + '/' + year;
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
    // var len = document.querySelectorAll('.btn-empty-ms');
    // for (i = 0; i < len.length; i++) {
    //     len[i].onclick = function() {
    //         this.classList.add('active');
    //         $('.btn-empty-ms').not(this).removeClass('active');
    //         let request = '?len='+this.getAttribute('data-length');
    //         staticClick(request);
    //         fetchLocate(request);
    //     };
    // }


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
        searchBtn = e.target.closest('.btn-search');
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
            staticsBrowser({
                'range': request
            });
            lineGrap({
                'range': request
            });
            fetchLocate({
                'range': request
            });
        }
        resetBtn = e.target.closest('.btn-reset');
        if (resetBtn) {
            staticClick('');
            staticsBrowser('');
            lineGrap('');
            fetchLocate('');
        }
        const lenBtn = e.target.closest('.btn-empty-ms');
        if (lenBtn) {
            const val = lenBtn.getAttribute('data-length');
            staticClick({
                'len': val
            });
            staticsBrowser({
                'len': val
            })
            lineGrap({
                'len': val
            });
            fetchLocate({
                'len': val
            });
        }
    })
</script>
