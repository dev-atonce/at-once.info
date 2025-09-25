
<style>
    .img-preview{
        width: 100%;
        max-height:145px;
        overflow: hidden;
    }
    .img-preview>img{
        height: 100%;        
    }
    #tree{
        width:auto;
        height:350px; 
        overflow-x:auto; 
        overflow-y:auto;
        border-radius: .25rem;
    }
    #tree>ul{
        padding-top:10px;
    }
    #preview{
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;
        
    }
    #preview:after{
        font-family: 'Font Awesome 5 Free';
        font-size: 9em !important;
        content: "\f03e";
        color: #999;
        display: block;
        margin: 30px;
    }
    .img-thumbnail{
        text-align: center;
    }

</style>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="input-group">
                                <input type="text" id="daterangeVisitor" class="form-control" name="daterange" readonly style="background-color:whitesmoke;">  
                                <div class="input-group-prepend">
                                    <button class="btn btn-primary input-sm btn-search" type="button" data-type="clicks"><i class="fas fa-search"></i>&nbsp;Search</button>
                                    <button class="btn btn-danger input-sm btn-reset" type="button" data-type="clicks"><i class="fas fa-sync-alt"></i>&nbsp;Reset</button>
                                </div>                             
                            </div>
                            <div class="mb-3"></div>
                        </div>
                    </div>
                    <div class="row ">                                        
                        <div class="col-lg-2 text-dark text-center">
                            <h5>เข้าดูหน้า Package</h5>
                            <hr style="border-top: 1px solid rgba(60, 60, 60, 0.5) !important;">
                            <h4 class="view-package">{{number_format(\App\Models\PageCounterMd::where('page','promotion-package')->count())}}</h4>
                        </div>
                        <div class="col-lg-2 text-dark text-center">
                            <h5>ปิด Popup</h5>
                            <hr style="border-top: 1px solid rgba(60, 60, 60, 0.5) !important;">
                            <h4 class="close-popup">{{number_format(\App\Models\ClosePopupMd::count())}}</h4>
                        </div>
                        <div class="col-lg-2 text-dark text-center">
                            <h5><a href="webpanel/statistics/packagesms">ส่ง Popup หน้า Package</a></h5>
                            <hr style="border-top: 1px solid rgba(60, 60, 60, 0.5) !important;">
                            <h4 class="send-popup">{{number_format(\App\Models\SMSHistoryMd::where('company', NULL)->count())}}</h4>
                        </div>
                        <div class="col-lg-2 text-dark text-center">
                            <h5><a href="webpanel/statistics/packagemail">ส่งอีเมลหน้า Package</a></h5>
                            <hr style="border-top: 1px solid rgba(60, 60, 60, 0.5) !important;">
                            <h4 class="send-package">{{number_format(\App\Models\ContactMd::where('type', 'package')->count())}}</h4>
                        </div>
                        <div class="col-lg-2 text-dark text-center">
                            <h5><a href="webpanel/statistics/contactusemail">ส่งอีเมลหน้า Contact US</a></h5>
                            <hr style="border-top: 1px solid rgba(60, 60, 60, 0.5) !important;">
                            <h4 class="send-contactus">{{number_format(\App\Models\ContactMd::where('type', NULL)->count())}}</h4>
                        </div>
                        <div class="col-lg-2 text-dark text-center">
                            <h5><a href="webpanel/statistics/contact-from-basic">Basic Profile</a></h5>
                            <hr style="border-top: 1px solid rgba(60, 60, 60, 0.5) !important;">
                            <h4 class="send-basic">{{number_format(\App\Models\ContactMd::where('type', 'basic')->count())}}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <select class="form-control" name="length">
                                            <option value="today">วันนี้</option>
                                            <option value="weekly">สัปดาห์</option>
                                            <option value="monthly">เดือน</option>
                                            <option value="yearly">ปี</option>
                                            <option value="all">ทั้่งหมด</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xs-12">
                                    <figure class="highcharts-figure">
                                        <div id="container"></div>
                                    </figure>
                                </div>
                                {{-- <div class="col-lg-6 col-xs-12">
                                    <figure class="highcharts-figure">
                                        <div id="container2"></div>
                                    </figure>
                                </div> --}}
                                <div class="col-lg-2 border-left">
                                    <div class="row p1">
                                        <div class="col-12">
                                        <h5>Export</h5>
                                        <hr>
                                        </div>
                                        <div class="col-12">              
                                            <ul style="list-style-type: none; padding:0;">
                                            <li><a href="webpanel/export/all-company"><i class="fas fa-download"></i> All Company (Online)</a></li>
                                            <li><a href="webpanel/history-mail/export"><i class="fas fa-download"></i> Email History</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mt-4">
                                        <div class="table-responsive">
                                        <table class="table table-striped" id="st-country" style="width: 100%;"><thead>
                                            <th width="10%">#</th>
                                            <th width="20%">Country</th>
                                            <th width="23%">District</th>
                                            <th width="23%">Sub District</th>
                                            <th width="20%">Clicks</th>
                                        </thead></table>
                                        </div>
                                    </div>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>          
            </div>
        </div>              
    </div>   
</div>
<script src="js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>      
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    var BrowserSt = $.ajax({method:'get',url:'api/statistics/device',dataType:'JSON',async:false}).responseJSON;
    var LengthSt = $.ajax({method:'get',url:'api/statistics/length',dataType:'JSON',async:false}).responseJSON;
        
    Highcharts.chart('container', {
        chart: { type: 'column' },
        title: { text: 'ค่าเฉลี่ยบราวเซอร์ ในการการเยี่ยมชมรายละเอียดบริษัทฯ' },
        subtitle: { text: 'Click the columns to view versions. Source: <a href="http://statcounter.com" target="_blank">statcounter.com</a>' },
        accessibility: { announceNewData: { enabled: true } },
        xAxis: { type: 'category' },
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

        series: [
        {
            name: "Browsers",
            colorByPoint: true,
            data: BrowserSt.data
        }
        ],
        drilldown: { series: BrowserSt.drilldown }
    });
    function fetchLocate()
    {   
        const stLocate = statisticsLocate();
        tab = $('#st-country').DataTable();
        tab.destroy();
        $('#st-country').DataTable({
            retrieve: true,
            responsive: true,
            // columnDefs: [{ targets: [1,2,3,4], className: 'text-center' }],
            order: [[ 0, "asc" ]],
            info: false,
            data: stLocate
        });
    }
    function statisticsLocate(len)
    {
        const stLength = (len!=null)?'?len='+len:'';
        const response = $.ajax({url:'api/statistics/locate'+stLength,async:false,dataType:'json'}).responseJSON;
        return response;
    }
    function browserStatistics()
    {
        const stLength = (len!=null)?'?len='+len:'';
        const response = $.ajax({url:'api/statistics/browser'+stLength,async:false,dataType:'json'}).responseJSON;
        return response;
    }
    fetchLocate();
    $('select[name="length"]').on('change',function(){
        data = browserStatistics($(this).val());
    });
    $('input[name="daterange"]').daterangepicker();

    $('.btn-search').on('click',function() {
        let testDate = $(this).closest('.input-group').find('input').val();
        testDate = testDate.split(' - ');
        let request = moment(testDate[0]).format('YYYY-MM-DD')+','+moment(testDate[1]).format('YYYY-MM-DD');
        clickCustom(request); 
    });
    $('.btn-reset').on('click',function(){
        clickCustom('');
    })
    const clickCustom = (request) => {
        request = (request==null)?'':'?range='+request;
        console.log(request);
        const stClick = $.ajax({url:'api/statistics/click-custom'+request,async:false}).responseJSON
        $('.view-package').html(stClick.package);
        $('.close-popup').html(stClick.closePopup);
        $('.send-popup').html(stClick.sendPopup);
        $('.send-package').html(stClick.sendpackage);
        $('.send-contactus').html(stClick.sendcontact);
        $('.send-basic').html(stClick.sendbasic);
    }
      /*
    Highcharts.chart('container2', {

    title: {
    text: 'Solar Employment Growth by Sector, 2010-2016'
    },

    subtitle: {
    text: 'Source: thesolarfoundation.com'
    },

    yAxis: {
    title: {
        text: 'Number of Employees'
    }
    },

    xAxis: {
    accessibility: {
        rangeDescription: 'Range: 2010 to 2017'
    }
    },

    legend: {
    layout: 'vertical',
    align: 'right',
    verticalAlign: 'middle'
    },

    plotOptions: {
    series: {
        label: {
        connectorAllowed: false
        },
        pointStart: 2010
    }
    },

    series: [{
    name: 'Installation',
    data: [43934, 52503, 57177, 69658, 97031, 119931, 137133, 154175]
    }, {
    name: 'Manufacturing',
    data: [24916, 24064, 29742, 29851, 32490, 30282, 38121, 40434]
    }, {
    name: 'Sales & Distribution',
    data: [11744, 17722, 16005, 19771, 20185, 24377, 32147, 39387]
    }, {
    name: 'Project Development',
    data: [null, null, 7988, 12169, 15112, 22452, 34400, 34227]
    }, {
    name: 'Other',
    data: [12908, 5948, 8105, 11248, 8989, 11816, 18274, 18111]
    }],

    responsive: {
    rules: [{
        condition: {
        maxWidth: 500
        },
        chartOptions: {
        legend: {
            layout: 'horizontal',
            align: 'center',
            verticalAlign: 'bottom'
        }
        }
    }]
    }

    }); 
    */


</script>
            