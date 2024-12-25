<style>
    .list-item {
        position: relative;
        display: block;
        padding: 0.75rem 1.25rem;
        margin-bottom: -1px;
        border: 1px solid;
        background-color: inherit;
        border-color: rgba(0, 0, 21, .125);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .text-medium-emphasis {
        --cui-text-opacity: 1;
        color: rgba(44, 56, 74, 0.681) !important;
    }
    .fs-6 {
        font-size: 1rem !important;
    }
    .fw-semibold {
        font-weight: 600 !important;
    }
    small, .small {
        font-size: 0.875em !important;
    }
    .list-item.active{
        background: #ebedef;
    }
    .list-item a{
        display: block;
        text-overflow: ellipsis;
        overflow: hidden; 
        white-space: nowrap;
    }
    a.action{
        cursor: pointer;
    }
    .card-active{
        background-color: #ced2d8;
    }

</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/css/datepicker.min.css" rel="stylesheet">
<div class="row">
    @php
    //  $test = \App\Models\CsToCompany::select(["to_company.*",DB::raw('count(clk.id) as clicks')])
    //  ->leftJoin('to_company_ip as ips','to_company.company','=','ips.company')
    //     ->leftJoin('clicks as clk','ips.ip','=','clk.ip')
    //     ->groupBy('clk.ip')
    //     ->where('to_company.company',127)
    //     ->first();  

    // $visitedData = \App\Models\CsToCompany::select(["to_company.*",DB::raw('count(clk.id) as clicks')])
    //     ->leftJoin('to_company_ip as ips','to_company.company','=','ips.company')
    //     ->leftJoin('clicks as clk','ips.ip','=','clk.ip')
    //     ->where('to_company.read',1)
    //     ->groupBy('clk.ip')
    //     ->groupBy('to_company.id')
    //     ->get();  
    // $countVisited = 0;
    // foreach($visitedData as $k => $v){ if($v->clicks>1){$countVisited++;} }
    // 
    // 
    // 
    $m = Request::get('m');
    $toCompany = \App\Models\CsToCompany:: leftJoin('company as cp','to_company.company','=','cp.id')
    ->select(['to_company.id',
        'to_company.from',
        'to_company.to',
        'to_company.read',
        'cp.name_th',
        'cp.name_jp',
        'to_company.created'
    ])
    ->orderBy('to_company.created','desc')
    ->get();

    $newVisited = \App\Models\CsToCompany::select([
            'to_company.id',
            'to_company.from',
            'to_company.to',
            'to_company.read',
            'clk.ip',
            'clk.cookie',
            'cp.name_th',
            'cp.name_jp',
            'to_company.created',
            db::raw('count(vlt.id) as clicks')
        ])
        ->leftJoin('clicks as clk','to_company.company','=','clk.cookie')
        ->leftJoin('visitor_log_time as vlt','clk.id','=','vlt._id')
        ->leftJoin('company as cp','clk.cookie','=','cp.id')
        ->whereNotNull('clk.cookie')
        ->when(Request::get('m'),function($query)use($m){
            if($m == 'read') $query->where(db::raw('clicks'),'>',1);
        })
        ->groupBy('clk.ip')
        ->orderBy('to_company.created','desc')
        ->get();
        $countVisitor = 0;
        foreach($newVisited as $k => $v){ if($v->clicks>1){ $countVisitor++; } }
    @endphp
    <div class="col-lg-12">     
        {{-- <h6>Count Visitor oldes function: {{print_r($countVisited,true)}}</h6> --}}
    </div>
    <div class="col-6 col-lg-2">
        <a class="action" data-action="all" style="text-decoration: none;">
            <div class="card card-active overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-primary text-white p-4 me-3">
                        <i class="fas fa-paper-plane fa-lg"></i>
                    </div>
                    <div class="ml-2">
                        <div class="fs-6 fw-semibold text-primary">{{\App\Models\CsToCompany::count()}}</div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small">ส่งอีเมล</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-lg-2">
        <a class="action" data-action="read" style="text-decoration: none;">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-info text-white p-4 me-3">
                        <i class="fas fa-book-reader fa-lg"></i>
                    </div>
                    <div class="ml-2">
                        <div class="fs-6 fw-semibold text-info">{{\App\Models\CsToCompany::where('read',1)->count()}}</div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small">อ่านแล้ว</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    <div class="col-6 col-lg-2">
        <a class="action" data-action="visited" style="text-decoration: none;">
            <div class="card overflow-hidden">
                <div class="card-body p-0 d-flex align-items-center">
                    <div class="bg-success text-white p-4 me-3">
                        <i class="fas fa-bell fa-lg"></i>
                    </div>
                    <div class="ml-2">
                        <div class="fs-6 fw-semibold text-success">{{$countVisitor}}</div>
                        <div class="text-medium-emphasis text-uppercase fw-semibold small">กลับเข้ามา</div>
                    </div>
                </div>
            </div>
        </a>
    </div>
    
</div>
<div class="card">
    <div class="card-body">        
        <div class="row">

            <div class="col-lg-5 col-md-2 col-xs-12 col-left" style="height:calc(100vh - 205px);">
                <div class="input-group mt-1 mb-3">
                    <input type="text" name="keyword" class="form-control" placeholder="ค้นหา" value="{{Request::get('keyword')}}" style="width:40%">
                    <input type="text" name="date" id="date" class="form-control" placeholder="วันเวลา" value="{{Request::get('date')}}" readonly="true" autocomplete="off" style="background-color: whitesmoke">
                    <input type="hidden" name="m" value="{{Request::get('m')}}" >
                    <div class="input-group-append"> 
                        <button class="btn btn-outline-primary" type="submit"><i class="fas fa-search"></i></button>
                        <button class="btn btn-outline-danger btn-reset-form" type="button"><i class="fas fa-sync-alt"></i></button>
                    </div>
                </div>
                <form id="formSearch" action="webpanel/mail/cs">
                    <div class="mail-list position-relative">
                        @if($toCompany->count()>0)
                        @foreach($toCompany as $v)
                        <div class="list-item" data-read="{{$v->read}}" data-clicks="{{$v->clicks}}" >
                            <div class="position-absolute text-right" style="right:5px; overflow:hidden;">
                                <small>{{date('D. H:i',strtotime($v->created))}}</small><br>
                                @if($v->read==1)<span class="badge badge-secondary text-primary">Read</span>@endif
                            </div>
                            <a class="read" data-id="{{$v->id}}" data-created="{{$v->created}}" href="javascript:"> 
                                {{$v->name_th}}<br>&lt;{{$v->to}}&gt; 
                            </a>
                        </div>
                        @endforeach          
                        @endif
                    </div>
                </form>
            </div>

            <div class="col-lg-7 col-md-10 col-xs-12 col-right email-content">   
                {{-- <div class="header-conten mb-2 email-header"><div class="text-right"></div></div> --}}
                <div class="email-click d-none"></div>
                <div class="d-flex align-items-center justify-content-center select-item" style="height:100%">
                    <div class="text-center">
                        <i class="far fa-envelope fa-3x"></i>
                        <h5 style="font-weight: normal">Select an item to read</h5>
                    </div>
                </div>             
            </div>

        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.2.0/js/bootstrap-datepicker.min.js"></script>
<script>
    var leftHeight = $('.col-left').find('.mail-list').height();
    var rightHeight = $('.col-right').find('.mail-content').height();
    if(leftHeight>=732){
        $('.col-left').css('overflow-y','scroll');
    }
    if(rightHeight >= 732) $('.col-right').find('.mail-content').css({'height':'732px','overflow-y':'scroll'});


    $('#date').datepicker({
        autoclose:true,
        format:'dd-mm-yyyy'
    });
    $('#date').datepicker().on('changeDate', function (ev) {
        var date = moment(ev.date).format('YYYY-M-D');
        $('#date').val(date);
    });
    $('.btn-reset-form').on('click',function(){
        window.location.href = 'webpanel/mail/cs'
    })
    var listWidth = $('.list-item').width();
    $('.list-item').each(function(){
        $(this).find('a').css('width',listWidth - 50.84);
    })
    $(document).on('click','a.action',function(){
        const cur = $(this);
        const action = cur.attr('data-action');
        cur.closest('.row').find('.card').removeClass('card-active');
        cur.children().addClass('card-active');
        const item = $('.mail-list').find('.list-item');
        const emailClick = $('.email-click');
        const selectContent = `<div class="d-flex align-items-center justify-content-center select-item" style="height:100%">
            <div class="text-center">
                <i class="far fa-envelope fa-3x"></i>
                <h5 style="font-weight: normal">Select an item to read</h5>
            </div>
        </div>`;
        switch (action)
        {
            case 'visited' :
                item.map(function(k,v){
                    if($(v).attr('data-clicks')<2) $(v).addClass('d-none'); else $(v).removeClass('d-none');
                })
            break;
            case 'read':
                item.map(function(k,v){
                    if($(v).attr('data-read')==1) $(v).removeClass('d-none'); else $(v).addClass('d-none')
                })
            break;
            default:
                item.removeClass('d-none');
            break;
        }
        emailClick.addClass('d-none');
        if($('.email-content').find('.select-item').length < 1) $('.email-content').append(selectContent);
   

    });
    $(document).on('click','.read',function(){
        const id = $(this).attr('data-id');
        console.log(id)
        $.ajax({
            url:'webpanel/mail/cs/read',
            data:{ id:id },
            success:function(res){
                ReadEmail(res)
            }
        }).catch((e) => {
            console.log(e)
        })
    })
    const ReadEmail = (data) => {
        selectItem = $('.select-item');
        emailClick = $('.email-click');
        if(data.length > 0)
        {
            emailClick.html('');
            if(emailClick.hasClass('d-none')) emailClick.removeClass('d-none');
            if(!selectItem.hasClass('d-none')) selectItem.remove();
            data.map((v,k)=>{
                emailClick.append(`<p><strong>${v.created}</strong> ${v.name}</p>`);
            });
        }
    }
</script>