@php
    // 13 => Fuang
    $user = (@Request::get('user'))?Request::get('user'):$auth->id;
    $date = (Request::get('date'))?date('Y-m-d',strtotime(Request::get('date'))):date('Y-m-d');

    $goalDI = 28;
    $queryDI = \App\Models\JobProgressMd::select([
        'job_progress.id',
        'cp.id as companyId',
        'cp.category as categoryId',
        'category.name_jp as categoryName',
        'me.id as memberId',
        'cp.logo',
        'cp.name_th',
        'cp.name_jp',
        'cp.description_th',
        'cp.description_jp',
        'cp.more_th',
        'cp.more_jp',
        'cp.created',
        'job_progress.step1_on',
        'job_progress.step1_by',
        'job_progress.step2_on',
        'job_progress.step2_by'
    ])
    ->leftJoin('company as cp','job_progress.company','=','cp.id')
    ->leftJoin('job_forward as jf','job_progress.id','=','jf.job_progress')
    ->leftJoin('category','cp.category','=','category.id')
    ->leftJoin('members as me','cp._id','=','me.id');

    // Step 1
    $setp1 = $queryDI->where('job_progress.step1_by',$user)
        ->whereDate('job_progress.step1_on',$date)
        ->whereNull('jf.content')
        ->get();

    $inStock = $setp1->count();
    $allStep1 = round($queryDI->where('step1_by', $user)->count(),2);
    $percentStep1 = round(($inStock * 100) / $goalDI,2);
    $allCreated = \App\Models\JobProgressMd::where('step1_by', $user)->count();

    // Step 2
    $step2 = $queryDI->where('job_progress.step1_by', $user)
        ->where(db::raw('DATE(step1_on)'),'like',$date)
        ->where(db::raw('DATE(step2_on)'),'like',$date)
        ->get();
    $step2Stock = $step2->count();
    $allStep2 = \App\Models\JobProgressMd::where('step2_by', $user)->count();
    $percentStep2 = round(($step2Stock * 100) / $goalDI,2);

    // Forward to Designer
    $queryForward = \App\Models\JobForwardMd::select([
        'job_forward.id',
        'cp.id as companyId',
        'cp.category as categoryId',
        'category.name_jp as categoryName',
        'cp.logo',
        'cp.name_th',
        'cp.name_jp',
        'job_forward.job_progress',
        'job_forward.content',
        'job_forward.content_date'
    ])
    ->leftJoin('job_progress as jp','job_forward.job_progress','=','jp.id')
    ->leftJoin('company as cp','jp.company','=','cp.id')
    ->leftJoin('category','cp.category','=','category.id')
    ->where('job_forward.content', Auth::user()->id)
    ->whereDate('job_forward.content_date',$date)
    ->groupBy('cp.id')
    ->get();

    $finish = $queryForward->count();
    $reject = \App\Models\JobRejectMd::select([
        'job_reject.id',
        'cp.id as companyId',
        'cp.logo',
        'cp.name_th',
        'cp.name_jp',
        'category.name_jp as categoryName',
        'mb.id as memberId',
        'uf.name as from',
        'job_reject.remark',
        'job_reject.image',
        'job_reject.from as fromId',
        'job_reject.created'
    ])
    ->leftJoin('job_progress as jp','job_reject.job_progress','=','jp.id')
    ->leftJoin('company as cp','jp.company','=','cp.id')
    ->leftJoin('members as mb','cp._id','=','mb.id')
    ->leftJoin('category','cp.category','=','category.id')
    ->leftJoin('users as uf','job_reject.from','=','uf.id')
    ->whereNull('job_reject.status')
    ->where('job_reject.type','di')
    ->where('job_reject.to', $user)
    ->groupBy('cp.id')
    ->get();

    $allReject = $reject->count();
    $monthStart = date('m');
    $yearStart = date('Y');

    $start = date('Y-m-d',strtotime("$yearStart-$monthStart-1"));
    $end = date('Y-m-t',strtotime("-2 months",strtotime($start)));

    $diGoalOfMonth = 800;
    $kpi = \App\Models\JobProgressMd::select([
        db::raw("DATE_FORMAT(step2_on, '%Y-%m') as date"),
        db::raw("COUNT(id) as kpi"),
        db::raw("COUNT(id) * 100 / $diGoalOfMonth as percent")
    ])
    ->orderBy('step2_on','desc')
    ->where('step2_on','>=',$end)
    ->groupBy(db::raw('date'))
    ->get();

@endphp

<div class="row" id="di-content">
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body bg-secondary-gradient">
                <form action="" method="get">
                    <a href="webpanel/members/create" target="_blank" id="member-create" class="btn btn-success float-right" title="Create">
                        <i class="fas fa-edit pr-1"></i> Create
                    </a>
                    <h2 class="mb-3">Data Input</h2>
                    @if($auth->role=='developer'||$auth->name=='FUANG')
                    <select name="user" class="custom-select custom-select-sm mb-1">
                        <option value="">Choose...</option>
                        @foreach(\App\Models\UsersMd::where(['position'=>12,'status'=>'active'])->get() as $k => $v)<option value="{{$v->id}}" @if($v->id==Request::get('user'))selected @endif>{{$v->name}}</option>@endforeach
                    </select>
                    @endif
                    @if($auth->name=='TONG')<hr class="my-4">@endif
                    <div class="fs-6 fw-semibold title">DATE</div>
                    <div class="input-group input-group-sm mb-3">
                        <div id="date"></div>
                        <input type="text" name="date" id="datepicker" class="form-control" readonly value="{{$date}}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fas fa-search-plus"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body bg-light-gradient">
                <div class="fs-6 fw-semibold title">CREATED</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{$inStock}}/{{$goalDI}}</div><small class=" text-blue">{{$percentStep1}}%</small>
                </div>
                <div class="progress progress-thin my-2">
                    <div class="progress-bar" role="progressbar" style="width: {{$percentStep1}}%" aria-valuenow="{{$percentStep1}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="text-muted">All Create:</div><div class="text-muted">{{$allCreated}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body bg-light-gradient">
                <div class="fs-6 fw-semibold title">EDIT</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{$step2Stock}}/{{$goalDI}}</div><small class=" text-blue">{{$percentStep2}}%</small>
                </div>
                <div class="progress progress-thin my-2">
                    <div class="progress-bar" role="progressbar" style="width: {{$percentStep2}}%" aria-valuenow="{{$percentStep2}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="text-muted">All Edit:</div><div class="text-muted">{{$allStep2}}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body bg-light-gradient">
                <div class="fs-6 fw-semibold title">FINISH</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{$finish}}/{{$goalDI}}</div><small class=" text-blue">10%</small>
                </div>
                <div class="progress progress-thin my-2">
                    <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="text-muted">All Finish:</div><div class="text-muted">20</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body bg-light-gradient">
                <div class="fs-6 fw-semibold title">REJECT <span class="badge me-1 rounded-pill bg-danger text-white h6">{{$reject->count()}}</span></div>
            </div>
        </div>
    </div>
    <div class="col-12 col-lg-2 d-flex">
        <div class="card box box-kpi">
            <div class="card-body text-white bg-success-gradient">
                <div class="fs-6 fw-semibold title">KPI</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1">{{@$kpi[0]->kpi}}/{{$diGoalOfMonth}}</div><small class=" text-blue">{{round(@$kpi[0]->percent,2)}}%</small>
                </div>
                <div class="progress progress-thin my-2">
                    <div class="progress-bar" role="progressbar" style="width: {{round(@$kpi[0]->percent,)}}%" aria-valuenow="{{round(@$kpi[0]->percent,)}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="text-white">{{@$kpi[1]->date}}</div>
                    <div class="text-white">
                        <span class="badge {{kpiColor(@$kpi[1]->kpi,$diGoalOfMonth)}}">
                            @if(@$kpi[1]->kpi>=$diGoalOfMonth)<i class="fas fa-arrow-up"></i>@else<i class="fas fa-arrow-down"></i>@endif
                            {{@$kpi[1]->kpi}}
                        </span>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="text-white">{{@$kpi[2]->date}}</div>
                    <div class="text-white ">
                        <span class="badge {{kpiColor(@$kpi[2]->kpi,$diGoalOfMonth)}}">
                            @if(@$kpi[2]->kpi>=$diGoalOfMonth)<i class="fas fa-arrow-up"></i>@else<i class="fas fa-arrow-down"></i>@endif
                            {{@$kpi[2]->kpi}}</span>
                        </div>
                </div>
            </div>
        </div>
    </div>
 
    <!--
    <div class="col-lg-2">
        <div class="card box">
            <div class="card-body">

                <div class="row align-items-center">
                    <div class="col-8">
                    <div class="fs-6 fw-semibold title">KPI</div>
                </div>
                <div class="col-4 text-right">
                    <h4 class="fs-4 fw-semibold number">800</h4>
                </div>
            </div>

            <div class="progress progress-thin my-2">
                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
            </div>

            </div>
            <div class="card-footer px-3 py-2">   <p class="text-muted text-sm mb-0">September (22 Day)</p></div>
        </div>
    </div> -->
</div>


<!-- Strock -->

<div class="row">
    @include('back-end.modules.job-progress.position.pages.waiting-for-create')
</div>
<div class="row">
    {{-- <div class="col-lg-7 d-flex">
        <div class="card h-lg-100 overflow-hidden">
            <div class="card-header d-flex flex-between-center">
                <h5 class="mb-0">Stock <strong class="text-info">{{$inStock}}</strong></h5>
                <div class="ms-auto text-end mt-n1 col-auto">
                    <a class="py-1 text-success" href="javascript:">Detail <span class="all-detail">0</span></a><div class="vr"></div>
                    <a class="py-1 text-danger" href="javascript:">No Detail <span class="all-no-detail">0</span></a><div class="vr"></div>
                    <a class="py-1 text-primary" href="javascript:">Edit <span class="all-edit">0</span></a><div class="vr"></div>
                    <a class="py-1 text-warning" href="javascript:">No Edit <span class="all-no-edit">0</a>
                </div>
            </div>
            <div class="card-body p-0 stock-list">
                <div class="table-responsive table-borderless table-hover">
                    <table class="table mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="text-center">NO.</th>
                                <th class="text-center"></th>
                                <th>Company Name</th>
                                <th class="text-center th-date">Created</th>
                                <th class="text-center th-status">Status</th>
                                <th class="text-center">Actions</th>
                                <th class="text-center"><label class="mb-0"><input type="checkbox" class="select-all mr-1">Forward</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($inStock>0)
                            @foreach($setp1 as $k => $v)
                                @php($logo=($v->logo=='')?'img/no-image.png':str_replace('.','-xs.',$v->logo))
                                @php($badgeDetail=($v->more_th=='')?'danger':'success')
                                @php($iconDetail=($badgeDetail=='success')?'check':'times')
                                @php($detailClass=($badgeDetail=='success')?'have-detail':'no-detail')
                                @php($badgeEdit=($v->step2_on=='')?'danger':'success')
                                @php($iconEdit=($badgeEdit=='success')?'check':'times')
                                @php($editClass=($badgeEdit=='success')?'have-edit':'no-edit')
                                <tr class="align-middle">
                                    <td class="text-center">{{$k+1}}</td>
                                    <td class="text-center"><img src="{{$logo}}" class="file-thumbnail border"></td>
                                    <td class="text-left">
                                        <p class="mb-0 cp-name">{{$v->name_jp}}</p>
                                        <p class="mb-0 cp-name">{{$v->name_th}}</p>
                                        <small class="text-primary font-weight-bold">{{$v->categoryName}}</small>
                                    </td>
                                    <td class="text-center"><small>{{date('d-m-Y H:i',strtotime($v->created))}}</small></td>
                                    <td class="text-center">
                                        <span class="badge badge-{{$badgeEdit}} {{$editClass}}"><i class="fas fa-{{$iconEdit}}"></i> Edited</span>
                                        <span class="badge badge-{{$badgeDetail}} {{$detailClass}}"><i class="fas fa-{{$iconDetail}}"></i> Details</span>
                                    </td>
                                    <td class="text-center">
                                        <a href="webpanel/members/{{$v->memberId}}/{{$v->companyId}}" target="_blank" class="badge bg-light text-dark">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check">
                                            <input class="form-check-input forward" type="checkbox" value="{{$v->id}}" data-company="{{$v->companyId}}" by="{{$v->step1_by}}">
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            @else
                                <tr class="align-middle"><td colspan="8" class="text-center">No record.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2">
                <div class="row flex-between-center">
                    <div class="col-auto"></div>
                    <div class="col-auto"><a class="btn btn-send btn-primary forward-to-designer" href="javascript:" @if($inStock<1) disabled="" @endif>Send</a></div>
                </div>
            </div>
        </div>
    </div> --}}


    <!-- Tranfer -->
    {{-- <div class="col-lg-5 d-flex">
        <div class="card h-lg-100 overflow-hidden">
            <div class="card-header d-flex flex-between-center">
                <h5 class="mb-0">Forward <strong class="text-info">{{$finish}}</strong></h5>
            </div>
            <div class="card-body p-0 tranfer-list">
                <div class="table-responsive table-borderless table-hover">
                    <table class="table mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="text-center">NO.</th>
                                <th class="text-center"></th>
                                <th>Company Name</th>
                                <th class="text-center th-date">Date Sent</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($finish>0)
                            @foreach($queryForward as $k => $v)
                                @php($logo=($v->logo=='')?'img/no-image.png':str_replace('.','-xs.',$v->logo))
                                <tr class="align-middle">
                                    <td class="text-center">{{$k+1}}</td>
                                    <td class="text-center"><img src="{{$logo}}" class="file-thumbnail border"></td>
                                    <td class="text-left">
                                        <p class="mb-0 cp-name ">{{$v->name_jp}}</p>
                                        <p class="mb-0 cp-name ">{{$v->name_th}}</p>
                                        <small class="text-primary font-weight-bold">{{$v->categoryName}}</small>
                                    </td>
                                    <td class="text-center"><small>{{date('Y-m-d H:i',strtotime($v->content_date))}}</small></td> <!-- วันละเวลาที่ส่ง -->
                                    <td class="text-center"><a href="webpanel/members/{{$v->memberId}}/{{$v->companyId}}" class="badge bg-light text-dark"><i class="fas fa-pen"></i> Edit</a></td>
                                </tr>
                            @endforeach
                            @else
                                <tr class="align-middle"><td colspan="7" class="text-center">No record.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2"></div>
        </div>
    </div> --}}
</div> <!-- row -->



<!-- REJECT -->

{{-- <div class="row">
    <div class="col-lg-12">
        <div class="card h-lg-100 overflow-hidden ">
            <div class="card-header d-flex flex-between-center ">
                <h5 class="mb-0">Reject <strong class="text-info">{{$allReject}}</strong></h5>
            </div>
            <div class="card-body p-0 reject-list">
                <div class="table-responsive table-borderless table-hover">
                    <table class="table mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="text-center" width="5%">NO.</th>
                                <th class="text-center" ></th>
                                <th width="22%">Company Name</th>
                                <th class="text-left" width="18%">Remark</th>
                                <th class="text-center th-date" width="10%">Reject Date</th>
                                <th class="text-center" width="7%">Sender Reject</th>
                                <th class="text-center" width="5%">Actions</th>
                                <th class="text-center" width="17%">Message</th>
                                <th class="text-center"><label class="mb-0"><input type="checkbox" class="all-job-reject mr-1">QC</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($allReject>0)
                            @foreach($reject as $k => $v)
                            @php($attach = \App\Models\RejectImageMd::whereNotNull('image')->where(['_id'=>$v->id, 'type_reject'=>'Job'])->select('image')->get())
                                @php($logo=($v->logo=='')?'img/no-image.png':str_replace('.','-xs.',$v->logo))
                                <tr class="align-middle">
                                    <td class="text-center">{{$k+1}}</td>
                                    <td class="text-center"><img src="{{$logo}}" class="file-thumbnail border"></td>
                                    <td class="text-left">
                                        <p class="mb-0 cp-name m-w300">{{$v->name_jp}}</p>
                                        <p class="mb-0 cp-name m-w300">{{$v->name_th}}</p>
                                        <small class="text-primary font-weight-bold">{{$v->categoryName}}</small>
                                    </td>
                                    <td class="text-left">
                                        <p class="mb-0">{{$v->remark}}</p>
                                        @if($attach->count()>0)<a href="javascript:" data-href="{{$attach->toJson()}}" class="d-inline-flex align-items-center border rounded-pill px-2 me-2 mt-2 inbox-link modalImgReject"><i class="fas fa-image"></i> Image</a>@endif
                                    </td>
                                    <td class="text-center"><small>{{date('d-m-Y H:i',strtotime($v->created))}}</small></td>
                                    <td class="text-center"><i class="fas fa-user-circle"></i> {{$v->from}}</td>
                                    <td class="text-center"><a href="webpanel/members/{{$v->memberId}}/{{$v->companyId}}" class="badge bg-dark text-light"><i class="fas fa-pen"></i> Edit</a></td>
                                    <td class="text-center"><input class="form-control" type="text" placeholder="Message"></td>
                                    <td class="text-center"><div class="form-check"><input class="form-check-input this-reject" type="checkbox" value="{{$v->id}}"></div></td>
                                </tr>
                            @endforeach
                            @else
                                <tr class="align-middle"><td colspan="11" class="text-center">No record.</td></tr>
                            @endif

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2">
                <div class="row flex-between-center">
                    <div class="col-auto"></div>
                    <div class="col-auto"><button class="btn btn-send btn-primary job-send-reject" data-type="di" disabled="">Send</button></div>
                </div>
            </div>
        </div>
    </div>
</div> --}}

<!-- Modal Img Reject -->
<div class="modal fade" id="modalImgReject" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Reject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="attach"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

