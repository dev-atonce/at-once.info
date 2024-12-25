@php
$goal = 23;
$date = (Request::get('date'))?date('Y-m-d',strtotime(Request::get('date'))):date('Y-m-d');
// if($auth->role=='developer') {
//     $user = (Request::get('user'))?Request::get('user'):14;
// }else{
$user = (@$auth->role=='developer')?Request::get('user'):$auth->id;
// $user = $auth->id;
// }

$booking = \App\Models\JobProgressMd::select([
    'job_progress.id',
    'category.name_jp as categoryName',
    'category.id as categoryId',
    'cp.id as companyId',
    'cp.logo',
    'cp.name_th',
    'cp.name_jp',
    'me.id as memberId',
    // 'job_progress.step2_by',
    'job_progress.step2_on',
    'usc.name as step2_by'
])
->leftJoin('job_forward as jf','job_progress.id','=','jf.job_progress')
->leftJoin('company as cp','job_progress.company','=','cp.id')
->leftJoin('members as me','cp._id','=','me.id')
->leftJoin('users as usc','job_progress.step2_by','=','usc.id')
->leftJoin('category','cp.category','=','category.id')
->whereNull('job_progress.step3_by')
->whereNull('job_progress.step4_by')
->where('cp.type','full')
->orderBy('job_progress.step2_on','desc')
->get();
    
$forward = \App\Models\JobProgressMd::select([
    'jf.id as forwardId',
    'jf.content',
    'jf.content_date',
    'jf.designer',
    'jf.designer_date',
    'cp.id as companyId',
    'cp.logo',
    'cp.name_th',
    'cp.name_jp',
    'me.id as memberId',
    'category.name_jp as categoryName',
    'category.id as categoryId',
    'usc.name as content_by',
    'usd.name as design_by',
    'job_progress.id',
    'job_progress.step1_by',
    'job_progress.step1_on',
    'job_progress.step2_by',
    'job_progress.step2_on',
    'job_progress.step3_by',
    'job_progress.step3_on'
])

->leftJoin('job_forward as jf','jf.job_progress','=','job_progress.id')
->leftJoin('users as usc','jf.content','=','usc.id')
->leftJoin('users as usd','jf.designer','=','usd.id')
->leftJoin('company as cp','job_progress.company','=','cp.id')
->leftJoin('members as me','cp._id','=','me.id')
->leftJoin('category','cp.category','=','category.id')
// ->whereNotNull('job_progress.step3_on')
// ->whereDate('job_progress.step3_on','=',$date)
// ->where('job_progress.step3_by',$user)
->whereDate('jf.designer_date',$date)
->where('jf.designer',$user)
->get();
    
$stockCount = \App\Models\JobProgressMd::where('step3_by',$user)
    ->leftJoin('job_forward as jf','jf.job_progress','=','job_progress.id')
    ->whereNull('job_progress.step4')
    ->whereNull('job_progress.step4_on')
    ->whereNull('jf.designer_date')
    ->count();
$stock = \App\Models\JobProgressMd::select([
    'job_progress.id',
    'jf.id as forwardId',
    'category.name_jp as categoryName',
    'category.id as categoryId',
    'cp.id as companyId',
    'cp.logo',
    'cp.name_th',
    'cp.name_jp',
    'us.name as content_by',
    'jf.content',
    'jf.content_date',
    'jf.designer',
    'jf.designer_date',
    'me.id as memberId',
    'usu.name as step3_by',
    'job_progress.step3_on'
])
->leftJoin('job_forward as jf','jf.job_progress','=','job_progress.id')
->leftJoin('users as us','jf.content','=','us.id')
->leftJoin('company as cp','job_progress.company','=','cp.id')
->leftJoin('users as usu','job_progress.step3_by','=','usu.id')
->leftJoin('members as me','cp._id','=','me.id')
->leftJoin('category','cp.category','=','category.id')
->where('cp.type','full')
->where('step3_by',$user)
->whereNull('step4')
->whereNull('step4_on')
->whereNull('jf.designer_date')
// ->limit(20)
->get();

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
->where('job_reject.type','de')
->where('job_reject.to', $user)
->get();

$allReject = $reject->count();

$monthStart = date('m');
$yearStart = date('Y');
$start = date('Y-m-t',strtotime("$yearStart-$monthStart-1"));
$end = date('Y-m-d',strtotime("-2 months",strtotime($start)));
$deGoalOfMonth = 800;

$kpi = \App\Models\JobProgressMd::select([
    db::raw("DATE_FORMAT(step3_on, '%Y-%m') as date"),
    db::raw("COUNT(id) as kpi"),
    db::raw("COUNT(id) * 100 / $deGoalOfMonth as percent")
])
->where(db::raw('DATE(step3_on)'),'>=',$end)
->groupBy(db::raw('date'))
->orderBy('step3_on','desc')
->get();

@endphp

<div class="row" id="designer-content">
    
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box bg-secondary-gradient">
            <div class="card-body">
                <form action="" method="get">
                    <h2 class="mb-2">Designer</h2>
                    @if($auth->role=='developer')
                        <select name="user" class="custom-select custom-select-sm mb-3">
                            <option value="">Choose...</option>
                            @foreach(\App\Models\UsersMd::where(['position'=>2,'status'=>'active'])->get() as $k => $v)<option value="{{$v->id}}" @if($v->id==$user)selected @endif>{{$v->name}}</option>@endforeach
                        </select>
                    @endif
                    @if($auth->role!='developer')<hr class="my-4"/>@endif
                    <div class="fs-6 fw-semibold title mb-1">DATE</div>
                    <div class="input-group input-group-sm">
                        <input type="text" name="date" id="designer_date" class="form-control" readonly value="{{$date}}">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-sm" type="submit"><i class="fas fa-search-plus"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box bg-light-gradient">
            <div class="card-body">
                <div class="fs-6 fw-semibold title">JOBS</div>
                <div class="d-flex flex-between-baseline"><div class="h3 mb-1 number">{{number_format($booking->count())}}</div></div>
                <hr>
                <div class="fs-6 fw-semibold title">STOCK</div>
                <div class="d-flex flex-between-baseline"><div class="h3 mb-1 number"><a href="javascript:" class="show-stock">{{@$stock->count()}}</a></div></div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box bg-light-gradient">
            <div class="card-body">
                <div class="fs-6 fw-semibold title">REJECT <span class="badge me-1 rounded-pill bg-danger text-white h6">{{$allReject}}</span></div>
                <hr class="mt-0 mb-2">
                <div class="fs-6 fw-semibold title">FINISH</div>
                <div class="d-flex flex-between-baseline">
                    
                    <div class="h3 mb-1 number">{{$forward->count()}}/{{$goal}}</div><small class=" text-blue">10%</small>
                </div>
                <div class="progress progress-thin my-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="text-muted">All Finish:</div><div class="text-muted">0</div>
                </div>
            </div>
        </div>
    </div>
    {{-- <div class="col-6 col-lg-2 d-flex">
        <div class="card box">
            <div class="card-body">
                <div class="fs-6 fw-semibold title">REJECT <span class="badge me-1 rounded-pill bg-danger text-white h6">{{$allReject}}</span></div>
            </div>
        </div>
    </div> --}}
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box text-white bg-success-gradient">
            <div class="card-body">
                <div class="fs-6 fw-semibold title">KPI</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{@$kpi[0]->kpi}}/{{$deGoalOfMonth}}</div>
                    <small class="text-blue">{{round(@$kpi[0]->percent,2)}}%</small>
                </div>
                <div class="progress progress-thin my-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{round(@$kpi[0]->percent,2)}}%" aria-valuenow="{{round(@$kpi[0]->percent,2)}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="text-white">{{@$kpi[1]->date}}</div>
                    <div class="text-white">
                        <span class="badge {{kpiColor(@$kpi[1]->kpi,$deGoalOfMonth)}}">
                            @if(@$kpi[1]->kpi>=$deGoalOfMonth)<i class="fas fa-arrow-up"></i>@else<i class="fas fa-arrow-down"></i>@endif 
                            {{@$kpi[1]->kpi}}
                        </span>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="text-white">{{@$kpi[2]->date}}</div>
                    <div class="text-white ">
                        <span class="badge {{kpiColor(@$kpi[2]->kpi,$deGoalOfMonth)}}">
                            @if(@$kpi[2]->kpi>=$deGoalOfMonth)<i class="fas fa-arrow-up"></i>@else<i class="fas fa-arrow-down"></i>@endif 
                            {{@$kpi[2]->kpi}}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card h-lg-100 overflow-hidden" id="designer-content-jobs">
            <div class="card-header d-flex justify-content-between">
                <h5 class="mb-0 ">Jobs <strong class="text-info">{{number_format(@$booking->count())}}</strong></h5> <!--  ดีไซน์ทุกคนเห็น List นี้ -->
                <div class="ms-auto col-auto form-inline">
                    <input type="text" name="search" id="booking-search" class="form-control" placeholder="Search Company Name...">              
                    <button class="btn btn-primary ml-2 reset" type="button" style="height: 100%;"><i class="fas fa-sync"></i></button>
                </div>
            </div>

            <div class="card-body p-0 job-list">
                <div class="table-responsive table-borderless table-hover">
                    <table class="table mb-0 table-booking">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="text-center">NO.</th>
                                {{-- <th class="text-center"></th> --}}
                                <th>Company Name</th>
                                <th class="text-center th-date">Date Sent</th>
                                <th class="text-center">By</th>
                                <th class="text-center td-booking"><label class="mb-0"><input type="checkbox" class="mr-1 all-booking">Booking</label></th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(@$booking->count()>0)
                            @foreach($booking as $k => $v)
                            @php($logo=($v->logo=='')?'img/no-image.png':str_replace('.','-xs.',$v->logo))
                                <tr class="align-middle">
                                    <td class="text-center">{{number_format($k+1)}}</td>
                                    {{-- <td class="text-center"><img src="{{$logo}}" class="file-thumbnail border"></td> --}}
                                    <td class="text-left">
                                        <p class="mb-0 cp-name">{{$v->name_jp}}</p>
                                        <p class="mb-0 cp-name">{{$v->name_th}}</p>
                                        <small class="text-primary font-weight-bold">{{$v->categoryName}}</small>
                                    </td>
                                    <td class="text-center">
                                        <small>{{date('d M Y, H:i',strtotime($v->step2_on))}}</small>
                                    </td>
                                    <td class="text-center">
                                        <i class="fas fa-user-circle"></i><br><small>{{$v->step2_by}}</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="form-check">
                                            <input class="form-check-input booking-list" type="checkbox" value="{{$v->id}}" data-company="{{$v->companyId}}">
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                    <tr class="align-middle"><td class="text-center" colspan="7">No record.</td></tr>
                                @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2">
                <div class="row flex-between-center">
                    <div class="col-auto"></div>
                    <div class="col-auto"><button class="btn btn-send btn-primary designer-booking" disabled>Booking</button></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Tranfer -->
    <div class="col-lg-6 d-flex">
        <div class="card h-lg-100 overflow-hidden">
            <div class="card-header d-flex flex-between-center">
                <h5 class="mb-0">Forward <strong class="text-info">{{$forward->count()}}</strong></h5>
                {{-- <div class="ms-auto text-end mt-n1 col-auto">
                    <button class="btn btn-falcon-default"><i class="far fa-calendar-alt"></i>&nbsp;  Date</button><!-- เลือกวันดูย้อนหลัง -->
                </div> --}}
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
                            @if($forward->count()>0)
                            @foreach($forward as $k => $v)
                            @php($logo=($v->logo=='')?'img/no-image.png':str_replace('.','-xs.',$v->logo))
                            <tr class="align-middle">
                                <td class="text-center">{{$k+1}}</td>
                                <td class="text-center"><img src="{{$logo}}" class="file-thumbnail border"></td>
                                <td class="text-left">
                                    <p class="mb-0 cp-name">{{$v->name_jp}}</p>
                                    <p class="mb-0 cp-name">{{$v->name_th}}</p>
                                    <small class="text-primary font-weight-bold">{{$v->categoryName}}</small>
                                </td>
                                <td class="text-center"><small>{{$v->content_date}}</small></td> <!-- วันละเวลาที่ส่ง -->
                                <td class="text-center"><a href="webpanel/members/{{$v->memberId}}/{{$v->companyId}}" target="_blank" class="badge bg-light text-dark"><i class="fas fa-pen"></i> Edit</a></td>
                            </tr>  
                            @endforeach
                            @else
                            <tr class="align-middle">
                                <td colspan="7" class="text-center">No record.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2"></div>
        </div>
    </div>
    <!-- Stock -->
    <div class="col-lg-12">
        <div class="card h-lg-100 overflow-hidden">
            <div class="card-header d-flex flex-between-center">
                <h5 class="mb-0">Stock <strong class="text-info">{{$stockCount}}</strong></h5>
                <div class="ms-auto text-end mt-n1 col-auto">    
                    <a class="py-1 text-dark designed" href="javascript:#">Design <span>0</span></a><div class="vr"></div>
                    <a class="py-1 text-dark no-design" href="javascript:#">No Design <span>0</span></a>
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
                                <th class="text-center">Category</th>
                                {{-- <th class="text-center th-date">Date Sent</th> --}}
                                <th class="text-center">Last Update</th>
                                <th class="text-center th-status">Status</th>
                                <th class="text-center">Actions</th>
                                <th class="text-center">
                                    <label class="mb-0"><input type="checkbox" class="all-forward mr-1">QC</label>
                                </th>
                                <th class="text-center" width="6%">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($stock->count()>0)
                            @foreach($stock as $k => $v)
                                @php($logo=($v->logo=='')?'img/no-image.png':str_replace('.','-xs.',$v->logo))
                                @php($designed=($v->step3_on!='')?'check':'times')
                                @php($badgeClass=($v->step3_on!='')?'success':'danger')
                                <tr class="align-middle">
                                    <td class="text-center">{{$k+1}}</td>
                                    <td class="text-center"><img src="{{$logo}}" class="file-thumbnail border"></td>
                                    <td class="text-left">
                                        <p class="mb-0 design-stock-list">{{$v->name_jp}}</p>
                                        <p class="mb-0 design-stock-list">{{$v->name_th}}</p>
                                    </td>
                                    <td class="text-center"><small>{{$v->categoryName}}</small></td>
                                    {{-- <td class="text-center">@if($v->content_date!='')<small>{{date('d-m-Y H:i',strtotime($v->content_date))}}</small>@endif</td> --}}
                                    <td class="text-center"><i class="fas fa-user-circle"></i><br/><small>{{$v->step3_by}}</small></td>
                                    <td class="text-center">
                                        <span class="badge badge-{{$badgeClass}}"><i class="fas fa-{{$designed}}"></i> Designed</span>
                                    </td>
                                    <td class="text-center"><a href="webpanel/members/{{$v->memberId}}/{{$v->companyId}}" target="_blank"  class="badge bg-light text-dark"><i class="fas fa-pen"></i> Edit</a></td>
                                    <td class="text-center"><div class="form-check"><input class="form-check-input forward-list" type="checkbox" value="{{$v->id}}"></div></td>
                                    <td class="text-center"><a href="javascript:" class="badge badge-warning booking-remove" job="{{$v->id}}"><i class="far fa-trash-alt mr-1"></i>Remove</a></td>
                                </tr>

                            @endforeach
                            @else
                            <tr class="align-middle"><td class="text-center" colspan="9">No record.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2">
                <div class="row flex-between-center">
                    <div class="col-auto"></div>
                    <div class="col-auto"><button class="btn btn-send btn-primary forward-to-qc" disabled>Forward >></button></div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- row -->


@php($headerClass=$allReject>0?'text-danger':'text-info')
<div class="row">
    <div class="col-lg-12">
        <div class="card h-lg-100 overflow-hidden ">
            <div class="card-header d-flex flex-between-center ">
                <h5 class="mb-0 {{$headerClass}}">Reject <strong>{{$allReject}}</strong></h5>
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
                                <th class="text-center" width="10%">Category</th>
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
                            @php($attach = \App\Models\RejectImageMd::select('image')->where('_id', $v->id)->get())
                                <tr class="align-middle">
                                    <td class="text-center">{{$k+1}}</td>
                                    <td class="text-center"><img src="{{$v->logo}}" class="file-thumbnail border"></td>
                                    <td class="text-left">
                                        <p class="mb-0 cp-name m-w300">{{$v->name_jp}}</p>
                                        <p class="mb-0 cp-name m-w300">{{$v->name_th}}</p>
                                    </td>
                                    <td class="text-left">
                                        @if($attach->count() > 0)<a href="javascript:" class="btn btn-secondary btn-sm job-reject-attach" data-img="{{$attach}}" data-title="Image attach"><i class="fas fa-paperclip"></i></a>
                                        @endif{{$v->remark}}
                                    </td>
                                    <td class="text-center"><small>{{$v->categoryName}}</small></td>
                                    <td class="text-center"><small>{{$v->created}}</small></td>
                                    <td class="text-center"><i class="fas fa-user-circle"></i> {{$v->from}} </td>
                                    <td class="text-center"><a target="_blank" href="/webpanel/members/{{$v->memberId}}/{{$v->companyId}}" class="badge bg-light text-dark"><i class="fas fa-pen"></i> Edit</a></td>
                                    <td class="text-center"><input class="form-control" type="text" placeholder="Message"></td>
                                    <td class="text-center"><div class="form-check"><input class="form-check-input this-reject" type="checkbox" value="{{$v->id}}"></div></td>
                                </tr>
                            @endforeach
                            @else
                                <tr class="align-middle"><td colspan="10" class="text-center">No record.</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2">
                <div class="row flex-between-center">
                    <div class="col-auto"></div>
                    <div class="col-auto"><button class="btn btn-send btn-primary job-send-reject" data-type="de" disabled>Send</button></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="designer-modal" class="modal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Attatch</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <p class="attach"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary d-none">Save changes</button>
              </div>
        </div>
    </div>
</div>