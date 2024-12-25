<style>
    .is-invalid{
        background-image: unset !important;
    }
    .is-invalid::placeholder{
        color: #e55353;
    }
    .fs-13{
        font-size: 13px;
    }
    td[contenteditable="true"]{
        border-bottom-color: #000;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
@php
    switch (Auth::user()->name) {
        case 'HOCKY':
            $manage = true;
            break;
        case 'PAIR':
            $manage = true;
            break;
        default:
            $manage = false;
            break;
    }
    $date = explode('-',Request::get('date'));
    $now = date('m-Y');
    $lastDayOfTheMonth = date("t", strtotime(DATE('Y-m-d')));
    $di = \App\Models\JobDiMd::where(function($query)use($lastDayOfTheMonth){
        if(!Request::get('date')){
            $query->where('year',date('Y'))
                ->where('month',date('m'));
        }
    })
    ->when(Request::get('date'),function($q)use($date){
        $q->where('month',$date[0])->where('year',$date[1]);
    });

    $pv = \App\Models\PageViewMd::orderBy('year','asc')->orderBy('month','asc');

    $cr = \App\Models\CopyRightMd::
    when(Request::get('date'),function($q)use($date){
        $q->where('month',$date[0])->where('year',$date[1]);
    })
    ->orderBy('month')
    ->orderBy('day');

    $colspan = $manage === true ? 6 : 5;
@endphp

<h3>DI.</h3>
<input type="hidden" id="data-di" value="{{$di->get()->toJson()}}">
<input type="hidden" id="data-pv" value="{{$pv->get()->toJson()}}">
<input type="hidden" id="data-cr" value="{{$cr->get()->toJson()}}">
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <form>
                    <div class="input-group">
                        <input type="text" id="daterangeDI" class="form-control" name="date" readonly style="background-color:whitesmoke;" value="@if(Request::get('date')!=''){{Request::get('date')}}@else{{$now}}@endif">  
                        <div class="input-group-prepend">
                            <button class="btn btn-primary input-sm btn-search" type="submit"><i class="fas fa-search"></i>&nbsp;Search</button>
                            <button class="btn btn-danger input-sm btn-reset" type="button"><i class="fas fa-sync-alt"></i>&nbsp;Reset</button>
                        </div>                             
                    </div>
                </form>
                <div class="mb-3"></div>
            </div>
            <div class="col-lg-8">
                <div class="float-right">
                    <button class="btn btn-default show-di-graph"><i class="fas fa-chart-pie"></i></button>
                </div>
            </div>
        </div>
        <div class="row" style="overflow-y:auto;max-height: 400px;">            
            <div class="col-lg-6 col-md-12 col-xs-12 di-data">
                <table class="table table-bordered table-sm" id="tableDI">
                    <thead>
                        <tr>
                            <th class="text-center" width="19%">Years</th>
                            <th class="text-center" width="19%">Month</th>
                            <th class="text-center" width="19%">Day</th>
                            <th class="text-center" width="19%">Target</th>
                            <th class="text-center" width="19%">Real</th>
                            @if($manage===true)
                            <th class="text-center" width="5%">
                                <a class="badge badge-primary fs-13 add-di" href="javascript:"><i class="fas fa-plus"></i> ADD</a>
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row-add-di d-none">
                            <td>
                                <input type="text" name="year" class="form-control form-control-sm" value="{{date('Y')}}">
                            </td>                            
                            <td>
                                <select class="form-control form-control-sm" name="month">
                                    <option value="" hidden>Choose</option>
                                    @for($i=1; $i<=12; $i++)
                                    <option value="{{$i}}" @if(date('m')==$i) selected @endif>{{date("F",strtotime("2022-$i"))}}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="day" placeholder="Day" value="{{date('d')}}">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="target" value="40" placeholder="Target">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="real" placeholder="Real">                                
                            </td>
                            <td class="text-center" width="5%">
                                <a class="badge badge-success fs-13 save-di" href="javascript:"><i class="fas fa-save"></i></a>
                                <a class="badge badge-danger fs-13 cancel-di" href="javascript:"><i class="fas fa-times"></i> </a>
                            </td>
                        </tr>
                        @if($di->count()>0)
                        @foreach($di->get() as $v)
                        <tr>
                            <td class="text-right">{{$v->year}}</td>
                            <td class="text-right">{{$v->month}}</td>
                            <td class="text-right">{{$v->day}}</td>
                            <td class="text-right">{{$v->target}}</td>
                            <td class="text-right">{{$v->real}}</td>
                            @if($manage===true)
                            <td class="text-center">
                                <a class="badge badge-secondary edit-di fs-13" href="javascript:" data-id="{{$v->id}}"><i class="fas fa-pen"></i></a>
                                <a class="badge badge-danger delete-di fs-13" href="javascript:" data-id="{{$v->id}}"><i class="fas fa-times"></i></a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        <tr class="row-sum">
                            <td colspan="3" class="text-right font-weight-bold">Total :</td>
                            <td class="font-weight-bold text-right"></td>
                            <td class="font-weight-bold text-right"></td>
                            <td></td>
                        </tr>
                        @else
                        <tr><td colspan="{{$colspan}}" class="text-center">No record.</td></tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="di-graph col-lg-6 col-xs-12">
                <div id="diGrap"></div>
            </div>
        </div>
    </div>
</div>


<h3>User & PV.</h3>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="input-group">
                    <input type="text" id="daterangePV" class="form-control" name="date_pv" readonly style="background-color:whitesmoke;">  
                    <div class="input-group-prepend">
                        <button class="btn btn-primary input-sm btn-search-pv" type="button" data-type="clicks"><i class="fas fa-search"></i>&nbsp;Search</button>
                        <button class="btn btn-danger input-sm btn-reset" type="button" data-type="clicks"><i class="fas fa-sync-alt"></i>&nbsp;Reset</button>
                    </div>                             
                </div>
                <div class="mb-3"></div>
            </div>
        </div>
        <div class="row" style="overflow-y:auto;max-height: 400px;">
            <div class="col-lg-6 col-md-12 col-xs-12">
                <table class="table table-bordered table-striped table-sm">
                    <thead>
                        <tr>
                            <th width="23%">Year</th>
                            <th width="23%">Month</th>
                            <th width="23%">User</th>
                            <th width="23%">Page views</th>
                            @if($manage===true)                        
                            <th class="text-center" width="5%">
                                <a class="badge badge-primary add-pv fs-13" href="javascript:"><i class="fas fa-plus"></i> ADD</a>
                            </th>                        
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row-add-pv d-none">
                            <td>
                                <input type="text" name="pv_year" class="form-control form-control-sm" value="{{date('Y')}}">
                            </td>                            
                            <td>
                                <select class="form-control form-control-sm" name="pv_month">
                                    <option value="" hidden>Choose</option>
                                    @for($i=1; $i<=12; $i++)
                                    <option value="{{$i}}" @if(date('m')==$i) selected @endif>{{date("F",strtotime("2022-$i"))}}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="user" placeholder="User">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="pageview" placeholder="Page view">
                            </td>
                            <td class="text-center" width="5%">
                                <a class="badge badge-danger fs-13 cancel-pv" href="javascript:"><i class="fas fa-times"></i> </a>
                                <a class="badge badge-success fs-13 save-pv" href="javascript:"><i class="fas fa-save"></i></a>
                            </td>
                        </tr>
                        @if($pv->count()>0)
                        @foreach($pv->get() as $v)
                        <tr>
                            <td>{{$v->year}}</td>
                            <td>{{$v->month}}</td>
                            <td>{{$v->user}}</td>
                            <td>{{$v->pageview}}</td>
                            @if($manage===true)
                            <td class="text-center">
                                <a class="badge badge-secondary edit-pv fs-13" href="javascript:" data-id="{{$v->id}}"><i class="fas fa-pen"></i></a>
                                <a class="badge badge-danger delete-pv fs-13" href="javascript:" data-id="{{$v->id}}"><i class="fas fa-times"></i></a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td class="text-center" colspan="4">No record.</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="di-graph col-lg-6 col-xs-12">
                <div id="pvGrap"></div>
            </div>
        </div>
    </div>
</div>


<h3>Copy Right</h3>
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-4">
                <div class="input-group">
                    <input type="text" id="daterangeCR" class="form-control" name="date" readonly style="background-color:whitesmoke;" value="@if(Request::get('date')!=''){{Request::get('date')}}@else{{$now}}@endif">  
                    <div class="input-group-prepend">
                        <button class="btn btn-primary input-sm btn-search" type="button" data-type="clicks"><i class="fas fa-search"></i>&nbsp;Search</button>
                        <button class="btn btn-danger input-sm btn-reset" type="button" data-type="clicks"><i class="fas fa-sync-alt"></i>&nbsp;Reset</button>
                    </div>                             
                </div>
                <div class="mb-3"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12">
                <h4>Daily</h4>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th width="13.5%">Year</th>
                            <th width="13.5%">Month</th>
                            <th width="13.5%">Day</th>
                            <th width="13.5%">Calls</th>
                            <th width="13.5%" class="text-center">Send</th>
                            <th width="13.5%" class="text-center">OK / Return CR</th>
                            <th width="13.5%" class="text-center">Refuse</th>
                            @if($manage===true)
                            <th class="text-center" width="5%">
                                <a class="badge badge-primary add-cr fs-13" href="javascript:"><i class="fas fa-plus"></i> ADD</a>
                            </th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row-add-cr d-none">
                            <td>
                                <input type="text" name="cr_year" class="form-control form-control-sm" value="{{date('Y')}}">
                            </td>                            
                            <td>
                                <select class="form-control form-control-sm" name="cr_month">
                                    <option value="" hidden>Choose</option>
                                    @for($i=1; $i<=12; $i++)
                                    <option value="{{$i}}" @if(date('m')==$i) selected @endif>{{date("F",strtotime("2022-$i"))}}</option>
                                    @endfor
                                </select>
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="cr_day" placeholder="Day" value="{{date('d')}}">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="calls" placeholder="Calls">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="send" placeholder="Send">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="ok" placeholder="OK">
                            </td>
                            <td>
                                <input type="text" class="form-control form-control-sm" name="refuse" placeholder="Refuse">
                            </td>
                            <td class="text-center" width="5%">
                                <a class="badge badge-danger fs-13 cancel-cr" href="javascript:"><i class="fas fa-times"></i> </a>
                                <a class="badge badge-success fs-13 save-cr" href="javascript:"><i class="fas fa-save"></i></a>
                            </td>
                        </tr>
                        @php($callsSum=0)
                        @php($sendSum=0)
                        @php($okSum=0)
                        @php($refuseSum=0)
                        @if($cr->count()>0)
                        @foreach($cr->get() as $v)
                        @php($callsSum += $v->calls)
                        @php($sendSum += $v->send)
                        @php($okSum += $v->ok)
                        @php($refuseSum += $v->refuse)
                        <tr>
                            <td>{{$v->year}}</td>
                            <td>{{$v->month}}</td>
                            <td>{{$v->day}}</td>
                            <td>{{number_format($v->calls)}}</td>
                            <td>{{number_format($v->send)}}</td>
                            <td>{{number_format($v->ok)}}</td>
                            <td>{{number_format($v->refuse)}}</td>
                            @if($manage===true)
                            <td class="text-center">
                                <a class="badge badge-secondary edit-cr fs-13" href="javascript:" data-id="{{$v->id}}"><i class="fas fa-pen"></i></a>
                                <a class="badge badge-danger delete-cr fs-13" href="javascript:" data-id="{{$v->id}}"><i class="fas fa-times"></i></a>
                            </td>
                            @endif
                        </tr>
                        @endforeach
                        
                        @else
                        <tr>
                            <td class="text-center" colspan="7">No record.</td>
                        </tr>
                        @endif                        
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-right"><strong>Sum</strong></td>
                            <td>{{number_format($callsSum)}}</td>
                            <td>{{number_format($sendSum)}} @if($callsSum!=0)<span class="float-right font-weight-bold">{{round(($sendSum*100)/$callsSum,2)}}%</span>@endif</td>
                            <td>{{number_format($okSum)}} @if($callsSum!=0)<span class="float-right font-weight-bold">{{round(($okSum*100)/$callsSum,2)}}%</span>@endif</td>
                            <td>{{number_format($refuseSum)}} @if($callsSum!=0)<span class="float-right font-weight-bold">{{round(($refuseSum*100)/$callsSum,2)}}%</span>@endif</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
            @php(
                $copyRightMonthly = \App\Models\CopyRightMd::select([
                    'year','month',
                    db::raw('SUM(calls) as callsSum'),
                    db::raw('SUM(send) as sendSum'),
                    db::raw('SUM(ok) as okSum'),
                    db::raw('SUM(refuse) as refuseSum')
                ])
                ->groupBy('year')
                ->groupBy('month')
                ->get()      
            )
            <div class="col-lg-12">
                {{-- {{$copyRightMonthly}} --}}
                <h4>Monthly</h4>
                <table class="table table-bordered table-sm">
                    <thead>
                        <tr>
                            <th width="16.66%">Year</th>
                            <th width="16.66%">Month</th>
                            <th width="16.66%">Call</th>
                            <th width="16.66%" class="text-center">Send</th>
                            <th width="16.66%" class="text-center">OK / Return CR</th>
                            <th width="16.66%" class="text-center">Refuse</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($copyRightMonthly as $k => $v)
                        @php($callsPercent = 100)
                        @php($sendPercent = round(($v->sendSum*100)/$v->callsSum,2))
                        @php($okPercent = round(($v->okSum*100)/$v->callsSum,2))
                        @php($refusePercent = round(($v->refuseSum*100)/$v->callsSum,2))
                        <tr>
                            <td>{{$v->year}}</td>
                            <td>{{$v->month}}</td>
                            <td>{{number_format($v->callsSum)}} <span class="float-right font-weight-bold">100%</span></td>
                            <td>{{number_format($v->sendSum)}} <span class="float-right font-weight-bold">{{$sendPercent}}%</span></td>
                            <td>{{number_format($v->okSum)}} <span class="float-right font-weight-bold">{{$okPercent}}%</span></td>
                            <td>{{number_format($v->refuseSum)}} <span class="float-right font-weight-bold">{{$refusePercent}}%</span></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        @if($copyRightMonthly->count()>0)
                        <tr>
                            <td colspan="2"></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        @endif
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/drilldown.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>   
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $('#daterangePV').datepicker({
        format: "yyyy",
        startView: "years", 
        minViewMode: "years"
    });
    $('#daterangeDI').datepicker({
        format: "mm-yyyy",
        startView: "months", 
        minViewMode: "months"
    });
    var dataDi = JSON.parse($('#data-di').val());
    var dataPv = JSON.parse($('#data-pv').val());
    var dataCr = JSON.parse($('#data-cr').val());
    var diSeries = {};
    var pvSeries = {};

    diCategories = dataDi.map(function(x){ return x.day });
    diSeries.real = dataDi.map(function(x){ return x.real });
    diSeries.target = dataDi.map(function(x){ return x.target });

    pvCategories = dataPv.map((x)=>{ return x.month });
    pvSeries.pageview = dataPv.map((x)=>{ return x.pageview });
    pvSeries.user = dataPv.map((x)=>{ return x.user });


    var dateMonth = '@if(Request::get('date')!=''){{Request::get('date')}}@else{{$now}}@endif';


    Highcharts.chart('diGrap', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Data Input'
        },
        subtitle: {
            text: dateMonth
        },
        xAxis: {
            categories: diCategories,
            crosshair: true
        },
        yAxis: {
            title: {
                text: null
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Real',
            data: diSeries.real

        }, {
            name: 'Target',
            data: diSeries.target

        }]
    });
    Highcharts.chart('pvGrap', {
    chart: {
        type: 'line'
    },
    title: {
        text: 'User & Pageview'
    },
    subtitle: {
        text: ''
    },
    xAxis: {
        categories: pvCategories
    },
    yAxis: {
        title: {
            text: ''
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
        name: 'Pageview',
        data: pvSeries.pageview
    }, {
        name: 'User',
        data: pvSeries.user
    }]
});


    $('.btn-reset').on('click',function(){
        $(this).closest('.input-group').find('input').val('');
    });


    function ObjectLength( object ) {
        var length = 0;
        for( var key in object ) {
            if( object.hasOwnProperty(key) ) {
                ++length;
            }
        }
        return length;
    };

    ////////////////////////////////
    /////////// Data Input /////////
    ////////////////////////////////

    $('.show-di-graph').on('click',function(){
        var diData = $('save-pvdi-data');
        var diGrap = $('.di-graph');
        diData.toggleClass('col-lg-12 col-lg-6');
        if(diGrap.hasClass('d-none'))
            diGrap.removeClass('d-none');
        else
            diGrap.addClass('d-none');
    });    
    $('.add-di').on('click',function(){
        let row = $('.row-add-di');
        if(row.hasClass('d-none')) row.removeClass('d-none');
        else row.addClass('d-none');
    })
    $('.cancel-di').on('click',function(){
        let row = $('.row-add-di');
        if(row.hasClass('d-none')) row.removeClass('d-none');
        else row.addClass('d-none');
    })
    $('.edit-di').on('click',function(){
        let cur = $(this);
        let id = $(this).attr('data-id');
        let row = $(this).closest('tr');
        var SaveIco = $('<a class="badge badge-success save-edit-di fs-13 mr-1" href="javascript:" title="Save" data-id="'+id+'"><i class="fas fa-save"></i></a>');
        var CancelIco = $('<a class="badge badge-secondary cancel-edit-di fs-13" href="javascript:" title="Cancel" data-id="'+id+'"><i class="fas fa-times"></i></a>');
        row.find('.edit-di').addClass('d-none');
        row.find('.delete-di').addClass('d-none');
        cur.closest('td').append(SaveIco,CancelIco)
        row.find('td').not(':last-child').attr('contenteditable',true);
    })
    $('.save-di').on('click',function(){
        let formFd = new FormData();
        let errors = {};
        errors.year = $('input[name="year"]').val() == '' ? 'required' : null;
        errors.month = $('input[name="month"]').val() == '' ? 'required' : null;
        errors.day = $('input[name="day"]').val() == '' ? 'required': null;
        errors.target = $('input[name="target"]').val() == '' ? 'required': null;
        errors.real = $('input[name="real"]').val() == '' ? 'required': null;

        $.each(errors, (k,v) => {
            $('input[name="'+k+'"]').on('keyup keydown',function(){
                if($(this).val()!=''){
                    $(this).removeClass('is-invalid');
                    delete errors[k];
                }else{
                    $(this).addClass('is-invalid');
                    errors[k] = 'required';
                }
            });
            if (v!=null){ 
                if(v=='month') $('select[name="'+k+'"]').addClass('is-invalid');
                else $('input[name="'+k+'"]').addClass('is-invalid');
            }else{ 
                if(v=='month') $('select[name="'+k+'"]').removeClass('is-invalid'); 
                else $('input[name="'+k+'"]').removeClass('is-invalid'); 
                delete errors[k];
            }
        })
        if(ObjectLength(errors)==0){
            formFd.append('year',$('input[name="year"]').val());
            formFd.append('month',$('select[name="month"]').val());
            formFd.append('day',$('input[name="day"]').val());
            formFd.append('target',$('input[name="target"]').val());
            formFd.append('real',$('input[name="real"]').val());
            formFd.append('_token','{{csrf_token()}}');
            formFd.append('_method','PUT');
            $.ajax({
                method: 'post',
                url: 'webpanel/statistics/di',
                data: formFd,
                cache:false,
                contentType:false,
                processData:false,
                success:function(res){ if(res.status == 201) location.reload(); },
                error:function(err){ alert('Error: ['+ err.status + '] '+err.statusText); },
            })
        }
    });
    $(document).on('click','.save-edit-di',function(){
        let cur = $(this);
        let row = $(this).closest('tr');
        let data = {};
        let key = ['year','month','day','target','real'];
        row.find('[contenteditable="true"]').map(function(i,e){
            data[key[i]] = $(e).html();
        });
        var fd = new FormData();
        fd.append('id',cur.attr('data-id'));
        fd.append('_token','{{csrf_token()}}');
        $.each(data,function(i,v){
            console.log(i,v);
            fd.append(i,v);
        })
        editRecoed(fd,'webpanel/statistics/di/update');
    });
    $(document).on('click','.cancel-edit-di',function(){ 
        let row = $(this).closest('tr');
        row.find('td').not(':last-child').removeAttr('contenteditable');
        row.find('.save-edit-di').remove();
        row.find('.cancel-edit-di').remove();
        row.find('.edit-di').removeClass('d-none');
        row.find('.delete-di').removeClass('d-none');        
    });
    $('.delete-di').on('click',function(){
        let id = $(this).attr('data-id');
        if(confirm('ยืนยันลบข้อมูล')){
            deleteObject(id,'webpanel/statistics/di/delete');
        }
    })


    ///////////////////////////////
    /////////// Page View /////////
    ///////////////////////////////
    $('.btn-search-pv').on('click',function(){
        var curr = $(this);
        val = $('#daterangePV').val();
        PvData(val);
    });
    const PvData = (year) => {
        $.ajax({
            method: 'get',
            url: 'webpanel/statistics/pv',
            data: {
                year: year
            },
            success:function(res){
                console.log(res)
            }
        })
    }

    $('.add-pv').on('click',function(){
        let row = $('.row-add-pv');
        if(row.hasClass('d-none')) row.removeClass('d-none');
        else row.addClass('d-none');
    });
    $('.cancel-pv').on('click',function(){
        let row = $('.row-add-pv');
        if(row.hasClass('d-none')) row.removeClass('d-none');
        else row.addClass('d-none');
    });
    $('.edit-pv').on('click',function(){
        let cur = $(this);
        let id = $(this).attr('data-id');
        let row = $(this).closest('tr');
        var SaveIco = $('<a class="badge badge-success save-edit-pv fs-13 mr-1" href="javascript:" title="Save" data-id="'+id+'"><i class="fas fa-save"></i></a>');
        var CancelIco = $('<a class="badge badge-secondary cancel-edit-pv fs-13" href="javascript:" title="Cancel" data-id="'+id+'"><i class="fas fa-times"></i></a>');
        row.find('.edit-pv').addClass('d-none');
        row.find('.delete-pv').addClass('d-none');
        cur.closest('td').append(SaveIco,CancelIco)
        row.find('td').not(':last-child').attr('contenteditable',true);
    });
    $('.save-pv').on('click',function(){
        let errors = {};
        errors.pv_year = $('input[name="pv_year"]').val() == '' ? 'required' : null;
        errors.pv_month = $('select[name="pv_month"]').val() == '' ? 'required' : null;
        errors.user = $('input[name="user"]').val() == '' ? 'required': null;
        errors.pageview = $('input[name="pageview"]').val() == '' ? 'required': null;

        $.each(errors, (k,v) => {
            $('input[name="'+k+'"]').on('keyup keydown',function(){
                if($(this).val()!=''){
                    $(this).removeClass('is-invalid');
                    delete errors[k];
                }else{
                    $(this).addClass('is-invalid');
                    errors[k] = 'required';
                }
            });
            if (v!=null){ 
                $('input[name="'+k+'"]').addClass('is-invalid');
            }else{ 
                $('input[name="'+k+'"]').removeClass('is-invalid'); 
                delete errors[k];
            }
        })
        
        if(ObjectLength(errors)==0){
            var fd = new FormData();
            fd.append('year',$('input[name="pv_year"]').val());
            fd.append('month',$('select[name="pv_month"]').val());
            fd.append('user',$('input[name="user"]').val());
            fd.append('pageview',$('input[name="pageview"]').val());
            fd.append('_token','{{csrf_token()}}');
            fd.append('_method','PUT');
            $.ajax({
                method: 'post',
                url: 'webpanel/statistics/pv',
                data: fd,
                cache:false,
                contentType:false,
                processData:false,
                success:function(res){ res.status == 201 ? location.reload() : '' ; },
                error:function(err){ alert('Error: ['+ err.status + '] '+err.statusText); },
            })
        }
    });
    $(document).on('click','.save-edit-pv',function(){
        let cur = $(this);
        let row = $(this).closest('tr');
        let data = {};
        let key = ['year','month','user','pageview'];
        row.find('[contenteditable="true"]').map(function(i,e){
            data[key[i]] = $(e).html();
        });
        var fd = new FormData();
        fd.append('id',cur.attr('data-id'));
        fd.append('_token','{{csrf_token()}}');
        $.each(data,function(i,v){
            console.log(i,v);
            fd.append(i,v);
        })
        editRecoed(fd,'webpanel/statistics/pv/update');
    })
    $(document).on('click','.cancel-edit-pv',function(){ 
        let row = $(this).closest('tr');
        row.find('td').not(':last-child').removeAttr('contenteditable');
        row.find('.save-edit-pv').remove();
        row.find('.cancel-edit-pv').remove();
        row.find('.edit-pv').removeClass('d-none');
        row.find('.delete-pv').removeClass('d-none');        
    });    
    $('.delete-pv').on('click',function(){
        let id = $(this).attr('data-id');
        if(confirm('ยืนยันลบข้อมูล')===true){
            deleteObject(id,'webpanel/statistics/pv/delete');
        }
    });




    ////////////////////////////////
    /////////// Copy Right /////////
    ////////////////////////////////
    $('.add-cr').on('click',function(){
        let row = $('.row-add-cr');
        if(row.hasClass('d-none')) row.removeClass('d-none');
        else row.addClass('d-none');
    });
    $('.cancel-cr').on('click',function(){
        let row = $('.row-add-cr');
        if(row.hasClass('d-none')) row.removeClass('d-none');
        else row.addClass('d-none');
    });
    $('.edit-cr').on('click',function(){
        let cur = $(this);
        let id = $(this).attr('data-id');
        let row = $(this).closest('tr');
        var SaveIco = $('<a class="badge badge-success save-edit-cr fs-13 mr-1" href="javascript:" title="Save" data-id="'+id+'"><i class="fas fa-save"></i></a>');
        var CancelIco = $('<a class="badge badge-secondary cancel-edit-cr fs-13" href="javascript:" title="Cancel" data-id="'+id+'"><i class="fas fa-times"></i></a>');
        row.find('.edit-cr').addClass('d-none');
        row.find('.delete-cr').addClass('d-none');
        cur.closest('td').append(SaveIco,CancelIco)
        row.find('td').not(':last-child').attr('contenteditable',true);

    });
    $('.save-cr').on('click',function(){
        let errors = {};
        errors.cr_year = $('input[name="cr_year"]').val() == '' ? 'required' : null;
        errors.cr_month = $('select[name="cr_month"]').val() == '' ? 'required' : null;
        errors.cr_day = $('input[name="cr_day"]').val() == '' ? 'required' : null;
        errors.calls = $('input[name="calls"]').val() == '' ? 'required': null;
        errors.send = $('input[name="send"]').val() == '' ? 'required': null;
        errors.ok = $('input[name="ok"]').val() == '' ? 'required': null;
        errors.refuse = $('input[name="refuse"]').val() == '' ? 'required': null;
        $.each(errors, (k,v) => {
            $('input[name="'+k+'"]').on('keyup keydown',function(){
                if($(this).val()!=''){
                    $(this).removeClass('is-invalid');
                    delete errors[k];
                }else{
                    $(this).addClass('is-invalid');
                    errors[k] = 'required';
                }
            });
            if (v!=null){ 
                if(v=='cr_month') $('select[name="'+k+'"]').addClass('is-invalid');
                else $('input[name="'+k+'"]').addClass('is-invalid');
            }else{ 
                if(v=='cr_month') $('select[name="'+k+'"]').removeClass('is-invalid'); 
                else $('input[name="'+k+'"]').removeClass('is-invalid'); 
                delete errors[k];
            }
        })
        if(ObjectLength(errors)==0){
            var fd = new FormData();
            fd.append('year',$('input[name="cr_year"]').val());
            fd.append('month',$('select[name="cr_month"]').val());
            fd.append('day',$('input[name="cr_day"]').val());
            fd.append('calls',$('input[name="calls"]').val());
            fd.append('send',$('input[name="send"]').val());
            fd.append('ok',$('input[name="ok"]').val());
            fd.append('refuse',$('input[name="refuse"]').val());
            fd.append('_token','{{csrf_token()}}');
            fd.append('_method','PUT');
            $.ajax({
                method: 'post',
                url: 'webpanel/statistics/cr',
                data: fd,
                cache:false,
                contentType:false,
                processData:false,
                success:function(res){ res.status == 201 ? location.reload() : '' ; },
                error:function(err){ alert('Error: ['+ err.status + '] '+err.statusText); },
            })
        }
    });
    $(document).on('click','.save-edit-cr',function(){
        let cur = $(this);
        let row = $(this).closest('tr');
        let data = {};
        let key = ['year','month','day','calls','send','ok','refuse'];
        row.find('[contenteditable="true"]').map(function(i,e){
            data[key[i]] = $(e).html();
        });
        var fd = new FormData();
        fd.append('id',cur.attr('data-id'));
        fd.append('_token','{{csrf_token()}}');
        $.each(data,function(i,v){
            console.log(i,v);
            fd.append(i,v);
        })
        editRecoed(fd,'webpanel/statistics/cr/update'); 
    })
    $(document).on('click','.cancel-edit-cr',function(){ 
        let row = $(this).closest('tr');
        row.find('td').not(':last-child').removeAttr('contenteditable');
        row.find('.save-edit-cr').remove();
        row.find('.cancel-edit-cr').remove();
        row.find('.edit-cr').removeClass('d-none');
        row.find('.delete-cr').removeClass('d-none');        
    });
    $('.delete-cr').on('click',function(){
        let id = $(this).attr('data-id');
        if(confirm('ยืนยันลบข้อมูล')===true){
            deleteObject(id,'webpanel/statistics/cr/delete');
        }
    });
    

    


    
   

    
    
    
    var sumDiTable = $('#tableDI');
    if(sumDiTable.find('.row-sum').length>0){
       var sumTargetEl = sumDiTable.find('.row-sum').find('td:first-child').next();
       var sumRealEl = sumTargetEl.next();

       tr = sumDiTable.find('tbody').find('tr').not(':first-child').not(':last-child');
       let sumTarget = 0;
       let sumReal = 0;
       tr.map(function(i,el){
            sumTarget += Number($(el).find('td:nth-child(4)').html());
            sumReal += Number($(el).find('td:nth-child(5)').html());
       })
       sumDiTable.find('.row-sum').find('td:nth-child(2)').html(Number(sumTarget));
       sumDiTable.find('.row-sum').find('td:nth-child(3)').html(Number(sumReal));
    }
    var deleteObject = (id,url) => {
        $.ajax({
            url:url,
            method:'post',
            data:{_method:'DELETE',_token:'{{csrf_token()}}',id:id},
            success:function(res){ if( res.status == 200 ) location.reload(); },
            error:function(err){ alert('Error '+ err.status + ' : '+err.statusText) }
        });
    }

    var editRecoed = (data,url) => {
        $.ajax({
            url:url,
            method:'post',        
            data:data,
            cache:false,
            contentType:false,
            processData:false,
            success:function(res){ if(res.status == 200) location.reload() },
            error:function(err){ alert('Error '+ err.status + ' : '+err.statusText) }
        });
    }
</script>