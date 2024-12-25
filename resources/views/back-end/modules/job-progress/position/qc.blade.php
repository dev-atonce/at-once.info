<style>
    .badge-orange {
        color: #ffffff;
        background-color: #ff6a00;
    }

    button.nav-link {
        background-color: transparent;
        font-size: 1rem;
        font-weight: 500;
        color: #3c4b64;
    }
</style>
@php
    function objSum($obj, $key)
    {
        $sum = 0;
        foreach ($obj as $k => $v) {
            $sum = $sum + $obj[$k][$key];
        }
        return $sum;
    }
    $auth = Auth::user();
    // $date = Request::get('date')?Request::get('date'):date('Y-m-d');
    $date = date('Y-m-d');
    // $date = '2023-01-18';

    //=================== COMPANY =================== //
    //=================== COMPANY =================== //

    $contentBy = \App\Models\JobProgressMd::select([
        db::raw("DATE_FORMAT(job_progress.step2_on, '%Y-%m-%d') as date"),
        'usr.name',
        db::raw('COUNT(job_progress.id) as count'),
    ])
        ->leftJoin('users as usr', 'job_progress.step2_by', '=', 'usr.id')
        ->whereDate('job_progress.step2_on', 'like', $date)
        ->groupBy('usr.name')
        ->get();

    $designBy = \App\Models\JobProgressMd::select([
        db::raw("DATE_FORMAT(job_progress.step3_on, '%Y-%m-%d') as date"),
        'usr.name',
        db::raw('COUNT(job_progress.id) as count'),
    ])
        ->leftJoin('users as usr', 'job_progress.step3_by', '=', 'usr.id')
        ->whereDate('job_progress.step3_on', 'like', $date)
        ->groupBy('usr.name')
        ->get();

    $onlineBy = \App\Models\JobProgressMd::select([
        db::raw("DATE_FORMAT(job_progress.step3_on, '%Y-%m-%d') as date"),
        'usr.name',
        db::raw('COUNT(job_progress.id) as count'),
    ])
        ->leftJoin('users as usr', 'job_progress.step4_by', '=', 'usr.id')
        ->whereDate('job_progress.step4_on', 'like', $date)
        ->groupBy('usr.name')
        ->get();

    //=================== BLOG =================== //
    //=================== BLOG =================== //

    $blogBy = \App\Models\BlogProgressMd::select([
        db::raw("DATE_FORMAT(blog_progress.step1, '%Y-%m-%d') as date"),
        'usr.name',
        db::raw('COUNT(blog_progress.id) as count'),
    ])
        ->leftJoin('users as usr', 'blog_progress.step1_by', '=', 'usr.id')
        ->whereDate('step1_on', 'like', $date)
        ->groupBy('usr.name')
        ->get();
    $blogDesign = \App\Models\BlogProgressMd::select([
        db::raw("DATE_FORMAT(blog_progress.step2, '%Y-%m-%d') as date"),
        'usr.name',
        db::raw('COUNT(blog_progress.id) as count'),
    ])
        ->leftJoin('users as usr', 'blog_progress.step2_by', '=', 'usr.id')
        ->whereDate('step2_on', 'like', $date)
        ->groupBy('usr.name')
        ->get();

    $blogOnline = \App\Models\BlogProgressMd::select([
        db::raw("DATE_FORMAT(blog_progress.step3, '%Y-%m-%d') as date"),
        'usr.name',
        db::raw('COUNT(blog_progress.id) as count'),
    ])
        ->leftJoin('users as usr', 'blog_progress.step3_by', '=', 'usr.id')
        ->whereDate('step3_on', 'like', $date)
        ->groupBy('usr.name')
        ->get();

    //=========================================== //

    $finish = \App\Models\JobForwardMd::leftJoin('job_progress as jp', 'job_forward.job_progress', '=', 'jp.id')
        ->where(db::raw('DATE(jp.step3_on)'), 'like', date('Y-m-d'))
        ->count();

    $now = date('Y-m-d');
    $jobsProgress = \App\Models\JobProgressMd::select([
        'job_progress.id',
        'cp.id as companyId',
        'membercp.id as memberId',
        db::raw('REPLACE(cp.logo,".","-xs.") as logo'),
        // db::raw('REPLACE(membercp.name_th," ","") as cpname'),
        'cp.name_th',
        'cp.name_en',
        'cp.name_jp',
        'cp.checked',
        'category.name_jp as categoryName',
        'u1.id as step1',
        'u1.name as step1_by',
        'job_progress.step1_on',
        'u2.id as step2',
        'u2.name as step2_by',
        'job_progress.step2_on',
        'u3.id as step3',
        'u3.name as step3_by',
        'job_progress.step3_on',
        'u4.name as step4_by',
        'job_progress.step4_on',
        'cp.public',
        'cp.created',
        db::raw('COUNT(jr.id) as reject'),
        db::raw('COUNT(IF(jr.status = 1, 1, NULL)) as fixed'),
        db::raw('COUNT(IF(jr.status IS NULL, 1, NULL)) as noFix'),
    ])
        ->leftJoin('job_forward as jf', 'job_progress.id', '=', 'jf.job_progress')
        ->leftJoin('company as cp', 'job_progress.company', '=', 'cp.id')
        ->leftJoin('category', 'cp.category', '=', 'category.id')
        ->leftJoin('users as u1', 'job_progress.step1_by', '=', 'u1.id')
        ->leftJoin('users as u2', 'job_progress.step2_by', '=', 'u2.id')
        ->leftJoin('users as u3', 'job_progress.step3_by', '=', 'u3.id')
        ->leftJoin('users as u4', 'job_progress.step4_by', '=', 'u4.id')
        ->leftJoin('job_reject as jr', 'job_progress.id', '=', 'jr.job_progress')
        ->leftJoin('members as membercp', 'cp._id', '=', 'membercp.id')
        // ->where(db::raw('DATE(job_progress.step3_on)'),'like',date('Y-m-d'))
        // ->whereNull('job_progress.step4_on')
        // ->where('cp.public','!=',true)

        // ->where(db::raw('DATE(jf.designer_date)'),'>=',date('Y-m-d',strtotime('-3 days',strtotime($now))))
        ->whereNull('cp.deleted')
        ->where(db::raw('DATE(jf.designer_date)'), '>=', date('Y-m-d', strtotime($now)))
        ->groupBy('jr.job_progress')
        ->groupBy('cp.id')
        ->orderBy('jf.designer_date', 'desc')
        ->get();

    $reject = \App\Models\JobRejectMd::select([
        'job_reject.id',
        'jp.id as job_progress',
        'cp.id as companyId',
        db::raw('REPLACE(cp.logo,".","-xs.") as logo'),
        'cp.name_th',
        'cp.name_en',
        'cp.name_jp',
        'cp.checked',
        'cp.public',
        'category.name_jp as categoryName',
        'mb.id as memberId',
        'job_reject.from as fromId',
        'job_reject.to as toId',
        'ut.name as to',
        'job_reject.remark',
        'job_reject.image',
        'job_reject.type',
        'job_reject.status',
        'job_reject.message',
        'job_reject.finished',
        'job_reject.created',
    ])
        ->leftJoin('job_progress as jp', 'job_reject.job_progress', '=', 'jp.id')
        ->leftJoin('company as cp', 'jp.company', '=', 'cp.id')
        ->leftJoin('members as mb', 'cp._id', '=', 'mb.id')
        ->leftJoin('category', 'cp.category', '=', 'category.id')
        ->leftJoin('users as ut', 'job_reject.to', '=', 'ut.id')
        ->whereNull('job_reject.finished')
        ->get();

    $revise = \App\Models\LogOfModifiedMd::select([
        'company_log.id as id',
        'company.id as companyId',
        db::raw('REPLACE(company.logo,".","-xs.") as logo'),
        'company.name_th',
        'company.name_en',
        'company.name_jp',
        'company.public',
        'category.name_jp as categoryName',
        'members.id as memberId',
        'users.name as to',
        'company_log.action',
        'company_log.created',
        'company_log.status',
        'company_log.type',
    ])
        ->leftJoin('users', 'company_log.user', 'users.id')
        ->leftJoin('company', 'company_log.company', 'company.id')
        ->leftJoin('members', 'company._id', 'members.id')
        ->leftJoin('category', 'company.category', 'category.id')
        ->where('company_log.status', 0)
        ->where('company_log.type', 'revise')
        ->get();

    $online = \App\Models\JobProgressMd::select([
        'cp.id as companyId',
        db::raw('REPLACE(cp.logo,".","-xs.") as logo'),
        'cp.name_th',
        'cp.name_jp',
        'category.name_jp as categoryName',
        'job_progress.id',
        'job_progress.company',
        'job_progress.step4',
        'job_progress.step4_by',
        'u4.name as by',
        'job_progress.step4_on',
    ])
        ->leftJoin('company as cp', 'job_progress.company', '=', 'cp.id')
        ->leftJoin('category', 'cp.category', '=', 'category.id')
        ->leftJoin('users as u4', 'job_progress.step4_by', '=', 'u4.id')
        ->whereDate('job_progress.step4_on', 'like', $date)
        ->groupBy('cp.id')
        ->get();

    $blog = \App\Models\BlogProgressMd::leftJoin('blog as bl', 'blog_progress.blog', '=', 'bl.id')
        ->leftJoin('blog_reject as bre', 'blog_progress.blog', '=', 'bre.blog')
        ->select([
            'bl.id',
            'category.name_jp as categoryName',
            'category.key as categoryKey',
            'bl.name_th',
            'bl.name_jp',
            'bl.images',
            'bl.url_th',
            'bl.url_jp',
            'bl.status',
            'bl.publish',
            'bl.published_by',
            'bl.type',
            'blog_progress.id as blog_progress',
            'blog_progress.step2',
            'blog_progress.step2_on',
            'blog_progress.step2_by',
            'blog_progress.step3',
            'blog_progress.step3_on',
            'blog_progress.step3_by',
            'bl.created',
            'bl.created_by',
            'bre.status as rejectStatus',
            'bre.finished',
            db::raw('COUNT(bre.id) as reject'),
            db::raw('COUNT(IF(bre.status = 1, 1, NULL)) as fixed'),
            db::raw('COUNT(IF(bre.status IS NULL, 1, NULL)) as noFix'),
        ])
        ->whereNull('bre.finished')
        ->leftJoin('category', 'bl.category', '=', 'category.id')
        ->whereNotNull('blog_progress.step2')
        ->whereNotNull('blog_progress.step3')
        // ->where('bre.status','!=',1)
        ->groupBy('blog_progress.blog')
        ->orderBy('blog_progress.step3', 'desc');
    $blogCount = \App\Models\BlogProgressMd::whereNotNull('step2')->count();
    $allBlogCount = $blog->get()->count();
    $blogPaginate = $blog->paginate(100)->setPageName('blogPage'); 

    $seoBy = \App\Models\SeoProgressMd::select(['us.name as by', db::raw('count(seo_progress.id) as seo')])
        ->leftJoin('users as us', 'seo_progress.by', '=', 'us.id')
        ->where(db::raw('DATE(created)'), date('Y-m-d'))
        ->groupBy('us.name')
        ->get();

    $monthStart = date('m');
    $yearStart = date('Y');
    $start = date('Y-m-t', strtotime("$yearStart-$monthStart-1"));
    $end = date('Y-m-d', strtotime('-2 months', strtotime($start)));
    $qcGoalOfMonth = 800;
    $kpi = \App\Models\JobProgressMd::select([
        db::raw('DATE_FORMAT(step4_on, "%Y-%m") as date'),
        db::raw('COUNT(id) as kpi'),
        db::raw("COUNT(id) * 100 / $qcGoalOfMonth as percent"),
    ])
        ->where(db::raw('DATE(step4_on)'), '>=', $end)
        ->groupBy(db::raw('date'))
        ->orderBy('step4_on', 'desc')
        ->get();

@endphp
<div class="row" id="qc-content">
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body bg-light-gradient">
                <div class="fs-6 fw-semibold title">CONTENT</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{ objSum($contentBy, 'count') }}</div>
                </div>
                <hr>
                @foreach ($contentBy as $k => $v)
                    <div class="d-flex justify-content-between">
                        <div class="font-weight-medium">{{ $v->name }}</div>
                        <div class="text-muted">{{ $v->count }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body bg-light-gradient">
                <div class="fs-6 fw-semibold title">DESIGN</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{ objSum($designBy, 'count') }}</div>
                </div>
                <hr>
                @foreach ($designBy as $k => $v)
                    <div class="d-flex justify-content-between">
                        <div class="font-weight-medium">{{ $v->name }}</div>
                        <div class="text-muted">{{ $v->count }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex ">
        <div class="card box box-card">
            <div class="card-body bg-light-gradient">
                <div class="fs-6 fw-semibold title">ONLINE</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{ objSum($onlineBy, 'count') }}</div>
                </div>
                <hr>
                @foreach ($onlineBy as $k => $v)
                    <div class="d-flex justify-content-between">
                        <div class="font-weight-medium">{{ $v->name }}</div>
                        <div class="text-muted">{{ $v->count }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body bg-light-gradient">
                <div class="fs-6 fw-semibold title">BLOG</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{ objSum($blogBy, 'count') }}</div>
                </div>
                <hr>
                @foreach ($blogBy as $k => $v)
                    <div class="d-flex justify-content-between">
                        <div class="font-weight-medium">{{ $v->name }} <small class="text-info">Created</small>
                        </div>
                        <div class="text-muted">{{ $v->count }}</div>
                    </div>
                @endforeach
                @foreach ($blogDesign as $k => $v)
                    <div class="d-flex justify-content-between">
                        <div class="font-weight-medium">{{ $v->name }} <small
                                class="text-primary">Designed</small></div>
                        <div class="text-muted">{{ $v->count }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box box-card">
            <div class="card-body bg-light-gradient">
                <div class="fs-6 fw-semibold title">SEO KEYWORD</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{ $seoBy->count() }}</div>
                </div>
                <hr>
                @foreach ($seoBy as $k => $v)
                    <div class="d-flex justify-content-between">
                        <div class="font-weight-medium">{{ $v->by }}</div>
                        <div class="text-muted">{{ $v->seo }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    {{-- <div class="col-lg-2 d-flex ">
        <div class="card box box-card">
            <div class="card-body">
                <div class="fs-6 fw-semibold title">STOCK</div>
                <div class="d-flex justify-content-between">
                    <div class="font-weight-medium">Fuang</div><div class="text-muted">25</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="font-weight-medium">Noey</div><div class="text-muted">20</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="font-weight-medium">Fern</div><div class="text-muted">25</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="font-weight-medium">Numfon</div><div class="text-muted">20</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="font-weight-medium">Boom</div><div class="text-muted">3</div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="font-weight-medium">Win</div><div class="text-muted">2</div>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="col-lg-2 d-flex">
        <div class="card box box-kpi">
            <div class="card-body text-white bg-success-gradient">
                <div class="fs-6 fw-semibold title">KPI</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1">{{ @$kpi[0]->kpi }}/{{ $qcGoalOfMonth }}</div>
                    <small class=" text-blue">{{ round(@$kpi[0]->percent, 2) }}%</small>
                </div>
                <div class="progress progress-thin my-2">
                    <div class="progress-bar bg-success" role="progressbar"
                        style="width: {{ round(@$kpi[0]->percent, 2) }}%"
                        aria-valuenow="{{ round(@$kpi[0]->percent, 2) }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="text-white">{{ @$kpi[1]->date }}</div>
                    <div class="text-white">
                        <span class="badge {{ kpiColor(@$kpi[1]->kpi, $qcGoalOfMonth) }}">
                            @if (@$kpi[1]->kpi >= $qcGoalOfMonth)
                            <i class="fas fa-arrow-up"></i>@else<i class="fas fa-arrow-down"></i>
                            @endif
                            {{ @$kpi[1]->kpi }}
                        </span>
                    </div>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="text-white">{{ @$kpi[2]->date }}</div>
                    <div class="text-white ">
                        <span class="badge {{ kpiColor(@$kpi[2]->kpi, $qcGoalOfMonth) }}">
                            @if (@$kpi[2]->kpi >= $qcGoalOfMonth)
                            <i class="fas fa-arrow-up"></i>@else<i class="fas fa-arrow-down"></i>
                            @endif
                            {{ @$kpi[2]->kpi }}
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-12">
        <div class="card h-lg-100" id="qc-jobs-content">
            <div class="card-header d-flex flex-between-center">
                <h5 class="mb-0">Job Progress <strong class="text-info">{{ $jobsProgress->count() }}</strong></h5>
                <div class="ms-auto col-auto form-inline">
                    <a class="py-1 text-success mr-4" href="javascript:"
                        style="font-size: 16px; font-weight:bold;">Finish <span>{{ $finish }}</span></a>
                    <!-- จำนวนรวมเสร็จแล้ว 3 step รอการ online -->
                    <div class="ms-auto text-end mt-n1 col-auto">
                        <button class="btn btn-falcon-default" id="job_progress_date"><i
                                class="far fa-calendar-alt"></i>&nbsp; Date</button>
                    </div>
                    <input type="text" name="search" class="form-control" placeholder="Search Company Name..."
                        aria-label="Search Company Name..." aria-describedby="button-addon1">
                    <button class="btn btn-outline-danger ml-2 reset" type="button">Reset</button>
                </div>
            </div>
            <div class="card-body p-0 job-progress-list">


                <div class="table-responsive">
                    <table class="table mb-0">
                        <thead class="table-light fw-semibold">
                            <tr role="">
                                <th class="text-center" width="5%">NO.</th>
                                <th class="text-center" width="5%"></th>
                                <th width="30%">Company Name</th>
                                <th class="text-center" width="10%" style="text-align:left">Created</th>
                                <th class="text-center" width="30%">Progress</th>
                                <th class="text-center" width="10%">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jobsProgress as $k => $v)
                                @php($countname = \App\Models\CompanyMd::leftJoin('category', 'company.category', 'category.id')->leftJoin('members as mem', 'company._id', '=', 'mem.id')->select('company.name_th', 'company.name_jp', 'company.id', 'category.name_jp as categoryName', 'mem.id as membersId')->where('company.name_jp', $v->name_jp)->get())
                                @php($logo = $v->logo == '' ? 'img/no-image.png' : $v->logo)
                                @php($step1Class = $v->step1_on != '' ? 'progress-success' : 'progress-none')
                                @php($step2Class = $v->step2_on != '' ? 'progress-success' : 'progress-none')
                                @php($step3Class = $v->step3_on != '' ? 'progress-success' : 'progress-none')
                                @php($step4Class = $v->public == 1 ? 'progress-success' : 'progress-danger')
                                @php($step4Class = $v->step4_on == '' ? 'progress-none' : $step4Class)
                                <tr role="row" class="odd" data-row="{{ $k }}"
                                    data-id="{{ $v->id }}">
                                    <td class="text-center">{{ $k + 1 }}</td>
                                    <td class="text-center"><img src="{{ $logo }}"
                                            class="file-thumbnail border"></td>
                                    <td class="text-left">
                                        <p class="mb-0 cp-name">
                                            <a class="text-dark"
                                                href="th/preview/company-profile/{{ $v->companyId }}"
                                                target="_blank">{{ $v->name_jp }}@if ($countname->count() > 1)
                                                    <a href="javascript:"
                                                        class="ml-1 badge badge-primary Modalindustry"
                                                        data-category="{{ $countname->toJson() }}">{{ $countname->count() }}</a>
                                                @endif
                                                <a href="webpanel/members/{{ $v->memberId }}/{{ $v->companyId }}"
                                                    target="_blank" class="float-right mr-1 text-danger"><i
                                                        class="fas fa-pen"></i></a>
                                        </p>
                                        <p class="mb-0 cp-name"><a class="text-dark"
                                                href="th/preview/company-profile/{{ $v->companyId }}"
                                                target="_blank">{{ $v->name_th }}</p>
                                        <small class="text-primary font-weight-bold">{{ $v->categoryName }}</small>
                                        @if ($v->checked == 'checked')
                                            <span class="badge badge-orange"><i class="fas fa-check"></i>
                                                Checked</span>
                                        @endif
                                        @if ($v->reject)
                                            | <a class="badge badge-danger ml-1 find-reject"
                                                job="{{ $v->id }}" href="javascript:">Reject :
                                                {{ $v->reject }}</a>
                                            <a class="badge badge-warning find-reject" job="{{ $v->id }}"
                                                href="javascript:"><i class="fas fa-times-circle"></i>
                                                {{ $v->noFix }}</a>
                                            <a class="badge badge-success reject-edited find-reject"
                                                job="{{ $v->id }}" href="javascript:"><i
                                                    class="fas fa-check-circle"></i> {{ $v->fixed }}</a>
                                        @endif
                                        <br>
                                    </td>

                                    <td class="text-center" data-label="Created :">
                                        {{ date('d M Y, H:i', strtotime($v->created)) }}</td>
                                    <td>
                                        <div class="row p-0">
                                            <div class="col-lg-3 col-xs-12 col-md-12 pl-1 pr-1 step1">
                                                <div class="box-step">
                                                    <div class="{{ $step1Class }}">
                                                        @if ($v->step1_on != '')
                                                            <i class="fas fa-check-circle"></i>
                                                        @endif CREATED
                                                    </div>
                                                    <div>
                                                        @if ($v->step1_by)
                                                            {{ $v->step1_by }}
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-xs-12 col-md-12 pl-1 pr-1 step2">
                                                <div class="box-step job-reject" data-job="{{ $v->id }}"
                                                    data-id="{{ $v->step2 }}" data-type="di">
                                                    <div class="{{ $step2Class }}">
                                                        @if ($v->step2_on != '')
                                                            <i class="fas fa-check-circle"></i>
                                                        @endif EDITED
                                                    </div>
                                                    <div>
                                                        @if ($v->step2_by)
                                                            {{ $v->step2_by }}
                                                        @else
                                                            -
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-xs-12 col-md-12 pl-1 pr-1 step3">
                                                <div class="box-step job-reject" data-job="{{ $v->id }}"
                                                    data-id="{{ $v->step3 }}" data-type="de">
                                                    <div class="{{ $step3Class }}">
                                                        @if ($v->step3_on != '')
                                                            <i class="fas fa-check-circle"></i>
                                                        @endif DESIGNED
                                                    </div>
                                                    <div>
                                                        @if ($v->step3_by != '')
                                                            {{ $v->step3_by }}@else-
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-xs-12 col-md-12 pl-1 pr-1 step4">
                                                <div class="box-step" data-id="{{ $v->step4 }}">
                                                    <div class="step4_bar {{ $step4Class }}">
                                                        @if ($v->public == 1)
                                                        <i class="fas fa-check-circle"></i>@else<i
                                                                class="fas fa-times-circle"></i>
                                                        @endif <span class="public_status">
                                                            @if ($v->public == 1)
                                                                ONLINE
                                                            @else
                                                                OFFLINE
                                                            @endif
                                                        </span>
                                                    </div>
                                                    <div class="step4_by">
                                                        @if ($v->step4_by != '')
                                                            {{ $v->step4_by }}@else-
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center" data-label="Status :">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input qc-job-status"
                                                id="customSwitch{{ $v->companyId }}" data-id="{{ $v->companyId }}"
                                                @if ($v->public == 1) checked="" @endif
                                                @if ($auth->role != 'super' && $auth->role != 'developer') disabled="" @endif>
                                            <label class="custom-control-label"
                                                for="customSwitch{{ $v->companyId }}"></label>
                                        </div>
                                        {{-- <label class="c-switch c-switch-label c-switch-pill c-switch-success">
                                    <input class="c-switch-input qc-job-status" type="checkbox" data-id="{{$v->companyId}}" @if ($v->public == 1)checked=""@endif @if ($auth->role != 'super' && $auth->role != 'developer')disabled=""@endif>
                                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                                </label> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2">
                {{-- <nav class="position">
            <ul class="pagination justify-content-center mb-0">
                <li class="page-item disabled" aria-disabled="true" aria-label="pagination.previous"><span class="page-link" aria-hidden="true">‹</span> </li>
                <li class="page-item active" aria-current="page"><span class="page-link">1</span></li>
                <li class="page-item"><a class="page-link" href="https://www.at-once.info/webpanel/job-progress?page=2">2</a></li>
                <li class="page-item"><a class="page-link" href="https://www.at-once.info/webpanel/job-progress?page=3">3</a></li>
                <li class="page-item"><a class="page-link" href="https://www.at-once.info/webpanel/job-progress?page=4">4</a></li>
                <li class="page-item"><a class="page-link" href="https://www.at-once.info/webpanel/job-progress?page=2" rel="next" aria-label="pagination.next">›</a></li>
            </ul>
        </nav> --}}
            </div>
        </div>
    </div>




    <!-- REJECT & REVISE -->

    <div class="col-lg-7">
        <div class="card h-lg-100 overflow-hidden" id="qc-reject-content">
            <div class="card-header d-flex flex-between-center ">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="tab">
                        <button class="nav-link active" id="reject-tab" data-toggle="tab" data-target="#reject"
                            type="button" role="tab" aria-controls="reject" aria-selected="true">Reject <strong
                                class="text-info text-bold">{{ $reject->count() }}</strong></button>
                    </li>
                    <li class="nav-item" role="tab">
                        <button class="nav-link" id="revise-tab" data-toggle="tab" data-target="#revise"
                            type="button" role="tab" aria-controls="revise" aria-selected="false">Revise
                            <strong class="text-info text-bold">{{ $revise->count() }}</strong></button>
                    </li>
                </ul>
            </div>
            <div class="card-body p-0 reject-list">
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="reject" role="tabpanel"
                        aria-labelledby="reject-tab">
                        <div class="table-responsive table-borderless table-hover">
                            <table class="table mb-0">
                                <thead class="table-light fw-semibold">
                                    <tr class="align-middle">
                                        <th class="text-center">NO.</th>
                                        <th class="text-center"></th>
                                        <th>Company Name</th>
                                        <th class="text-center">Remark</th>
                                        <th class="text-center">Presonal Inchange</th>
                                        <th class="text-center th-date">Reject Date</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reject as $k => $v)
                                        @php($attach = \App\Models\RejectImageMd::select('image')->where('_id', $v->id)->get())
                                        <tr class="align-middle" data-job-progress="{{ $v->job_progress }}">
                                            <td class="text-center">{{ $k + 1 }}</td>
                                            <td class="text-center"><img src="{{ $v->logo }}"
                                                    class="file-thumbnail border"></td>
                                            <td class="text-left">
                                                <a class="text-dark"
                                                    href="th/preview/company-profile/{{ $v->companyId }}"
                                                    target="_blank">
                                                    <p class="mb-0 cp-name">{{ $v->name_jp }}</p>
                                                    <p class="mb-0 cp-name">{{ $v->name_th }}</p>
                                                    <small
                                                        class="text-primary font-weight-bold">{{ $v->categoryName }}</small>
                                                </a>
                                            </td>
                                            <td class="text-left"><small>{{ $v->remark }}</small><br>
                                                @if ($v->image != '')
                                                    <span class="badge badge-secondary"></span>
                                                @endif
                                            </td>
                                            <td class="text-center"><i class="fas fa-user-circle"></i>
                                                <small>{{ $v->to }}</small>
                                            </td>
                                            <td class="text-center">
                                                <small>{{ date('d M-Y H:i', strtotime($v->created)) }}</small>
                                            </td>
                                            <td class="text-center">
                                                <div class="box-step reject-status" data-id="{{ $v->id }}"
                                                    data-remark="{{ $v->remark }}"
                                                    data-image="{{ $attach }}"
                                                    data-status="{{ $v->status }}"
                                                    data-message="{{ $v->message }}"
                                                    data-finished="{{ $v->finished }}">
                                                    @if ($v->status == 1)
                                                        <span class="text-success" style="font-size: 11px;"><i
                                                                class="fas fa-check-circle"></i> Fixed</span>
                                                    @else
                                                        <span class="text-warning" style="font-size: 11px;"><i
                                                                class="far fa-circle"></i> Pending</span>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="revise" role="tabpanel" aria-labelledby="revise-tab">
                        <div class="table-responsive table-borderless table-hover">
                            <table class="table mb-0">
                                <thead class="table-light fw-semibold">
                                    <tr class="align-middle">
                                        <th class="text-center">NO.</th>
                                        <th class="text-center"></th>
                                        <th>Company Name</th>
                                        <th class="text-center">Action</th>
                                        <th class="text-center">Presonal Inchange</th>
                                        <th class="text-center th-date">Revise Date</th>
                                        <th class="text-center">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($revise as $k => $v)
                                        <tr class="align-middle" data-job-progress="{{ $v->job_progress }}">
                                            <td class="text-center">{{ $k + 1 }}</td>
                                            <td class="text-center"><img src="{{ $v->logo }}"
                                                    class="file-thumbnail border"></td>
                                            <td class="text-left">
                                                <a class="text-dark"
                                                    href="th/preview/company-profile/{{ $v->companyId }}"
                                                    target="_blank">
                                                    <p class="mb-0 cp-name">{{ $v->name_jp }}</p>
                                                    <p class="mb-0 cp-name">{{ $v->name_th }}</p>
                                                    <small
                                                        class="text-primary font-weight-bold">{{ $v->categoryName }}</small>
                                                </a>
                                            </td>
                                            <td class="text-left">• <small>{{ $v->action }}</small><br>
                                                @if ($v->image != '')
                                                    <span class="badge badge-secondary"></span>
                                                @endif
                                            </td>
                                            <td class="text-center"><i class="fas fa-user-circle"></i>
                                                <small>{{ $v->to }}</small>
                                            </td>
                                            <td class="text-center">
                                                <small>{{ date('d M-Y H:i', strtotime($v->created)) }}</small>
                                            </td>
                                            <td class="text-center">
                                                <div class="box-step revise-status" data-id="{{ $v->id }}">
                                                    <span class="text-success" style="font-size: 11px;"><i
                                                            class="fas fa-check-circle"></i> Fixed</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer py-2">
                <div class="row flex-between-center">
                    <div class="col-auto"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Online -->

    <div class="col-lg-5">
        <div class="card h-lg-100 overflow-hidden ">
            <div class="card-header d-flex flex-between-center ">
                <h5 class="mb-0">Online <strong class="text-info">{{ $online->count() }}</strong></h5>
                <div class="ms-auto text-end mt-n1 col-auto">
                    <button class="btn btn-falcon-default" id="online_date"><i class="far fa-calendar-alt"></i>&nbsp;
                        Date</button><!-- เลือกวันดูย้อนหลัง -->
                </div>
            </div>
            <div class="card-body p-0 card-list">
                <div class="table-responsive table-borderless table-hover">
                    <table class="table mb-0" id="tableOnline">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="text-center">NO.</th>
                                <th class="text-center"></th>
                                <th>Company Name</th>
                                <th class="text-center">Online</th>
                                <th class="text-center th-date">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($online->count() > 0)
                                @foreach ($online as $k => $v)
                                    @php($logo = $v->logo == '' ? 'img/no-image.png' : $v->logo)
                                    <tr class="align-middle">
                                        <td class="text-center">{{ $k + 1 }}</td>
                                        <td class="text-center"><img src="{{ $logo }}"
                                                class="file-thumbnail border"></td>
                                        <td class="text-left">
                                            <a class="text-dark" href="#">
                                                <p class="mb-0 cp-name">{{ $v->name_jp }}</p>
                                                <p class="mb-0 cp-name">{{ $v->name_th }}</p>
                                                <small
                                                    class="text-primary font-weight-bold">{{ $v->categoryName }}</small>
                                            </a>
                                        </td>
                                        <td class="text-center"><i class="fas fa-user-circle"></i>
                                            <small>{{ $v->by }}</small>
                                        </td>
                                        <td class="text-center">
                                            <small>{{ date('d M-Y H:i', strtotime($v->step4_on)) }}</small>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr class="align-middle">
                                    <td class="text-center" colspan="6">No record.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2"></div>
        </div>
    </div>


    <!-- Blog --> <!-- แสดงส่งที่ส่งมา 1 อาทิตย์ -->
    <div class="col-lg-12 d-flex">
        <div class="card h-lg-100 overflow-hidden">
            <div class="card-header d-flex flex-between-center">
                <h5 class="mb-0">Blog <strong class="text-info">{{ $allBlogCount }}</strong></h5>
                <div class="ms-auto text-end mt-n1 col-auto">
                    <div class="form-inline">
                        <select name="category" class="form-control mr-3">
                            <option value="">Category</option>
                            @foreach (\App\Models\CategoryMd::where('status', 1)->get() as $kin => $vin)
                                <option value="{{ $vin->id }}">{{ $vin->name_jp }} / {{ $vin->name_th }}
                                </option>
                            @endforeach
                        </select>
                        <button class="btn btn-falcon-default" id="qc_blog_date"><i
                                class="far fa-calendar-alt"></i>&nbsp; Date</button><!-- เลือกวันดูย้อนหลัง -->
                    </div>
                </div>
            </div>
            <div class="card-body p-0 tranfer-list">
                <div class="table-responsive table-borderless table-hover">
                    <table class="table mb-0" id="qc-blog-talble">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="text-center">NO.</th>
                                <th class="text-center"></th>
                                <th>Company Name</th>
                                <th>Remark</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Category</th>
                                <th class="text-center th-date">Created Date</th>
                                <th class="text-center th-date">Forward Date</th>
                                <th class="text-center">Actions</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($blogPaginate as $k => $v)
                                @php($image = $v->images != '' ? $v->images : 'img/no-iamge.png')
                                <tr class="align-middle" data-id="{{ $v->id }}">
                                    <td class="text-center">{{ $k + 1 }}</td>
                                    <td class="text-center"><img src="{{ $image }}"
                                            class="file-thumbnail border"></td>
                                    <td class="text-left">
                                        <div class="d-flex align-items-center">
                                            <div
                                                style="white-space: nowrap;
                                                overflow: hidden;
                                                text-overflow: ellipsis;
                                                max-width: 650px;">
                                                <span>{{ $v->name_th }}</span>
                                            </div>
                                            <div>
                                                @if (date('Y-m-d', strtotime($v->step2_on)) == date('Y-m-d'))
                                                    <small class="badge badge-orange ml-1">New &#9733;</small>
                                                @endif
                                                @if ($v->reject)
                                                    <a class="badge badge-danger ml-1" href="javascript:">Reject :
                                                        {{ $v->reject }}</a>
                                                    <a class="badge badge-warning" href="javascript:"><i
                                                            class="fas fa-times-circle"></i> {{ $v->noFix }}</a>
                                                    <a class="badge badge-success reject-edited" href="javascript:"><i
                                                            class="fas fa-check-circle"></i> {{ $v->fixed }}</a>
                                                @endif
                                                <br>
                                            </div>
                                        </div>
                                        <a style=" white-space: nowrap;
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        max-width: 800px;
                                        display:inline-block"
                                            href="th/blog/{{ $v->url_th }}" target="_blank"
                                            class="text-gray">URL: {{ $v->url_th }}</a>
                                        <br>
                                        <a style=" white-space: nowrap;
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        max-width: 800px;
                                        display:inline-block"
                                            href="th/preview/blog/{{ $v->id }}" target="_blank"
                                            class="text-gray">PREVIEW: {{ $v->url_th }}</a>
                                    </td>
                                    @php($remark = \App\Models\BlogRejectMd::select('remark')->where('blog', $v->id)->get())
                                    <td>
                                        @foreach ($remark as $re)
                                            <div class="d-flex align-items-center">
                                                <div class="bg-secondary dot rounded-circle me-1"></div>
                                                <small>{{ $re->remark }}</small>
                                            </div>
                                        @endforeach
                                    </td>
                                    <td class="text-center">{{ $v->type }}</td>
                                    <td class="text-center">{{ $v->categoryName }}</td>
                                    <td class="text-center">
                                        <small>{{ date('d, m/Y H:i', strtotime($v->created)) }}</small>
                                    </td>
                                    <td class="text-center">
                                        <small>{{ date('d, m/Y H:i', strtotime($v->step2_on)) }}</small>
                                    </td>
                                    <td class="text-center">
                                        <div class="dropdown">
                                            <button
                                                class="btn rounded-3 me-2 fs--2 icon-item icon-item-sm dropdown-toggle"
                                                type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                    href="webpanel/blog/{{ $v->id }}/{{ $v->categoryKey }}"
                                                    target="_blank">Edit</a>
                                                <a class="dropdown-item reject-blog" href="javascript:"
                                                    data-id="{{ $v->id }}">Reject</a>
                                            </div>

                                        </div>
                                    </td>
                                    <td class="text-center">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" class="custom-control-input blog-finished"
                                                id="customSwitch{{ $v->id }}" data-id="{{ $v->id }}"
                                                @if ($v->status == 1) checked="" @endif
                                                @if ($auth->role != 'super' && $auth->role != 'developer' && $auth->name != 'MAY') disabled="" @endif>
                                            <label class="custom-control-label"
                                                for="customSwitch{{ $v->id }}"></label>
                                        </div>
                                        {{-- <label class="c-switch c-switch-label c-switch-pill c-switch-success">
                                    <input class="c-switch-input blog-finished" type="checkbox" data-id="{{$v->id}}" @if ($v->status == 1)checked=""@endif @if ($auth->role != 'super' && $auth->role != 'developer')disabled=""@endif>
                                    <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>
                                </label> --}}

                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2">{{$blogPaginate->links()}}</div>
        </div>
    </div>


    <div class="col-lg-4">
        <div class="card-members box box-activity">
            <div class="card-header d-flex flex-between-center">
                <h5 class="mb-0">Team Members <strong class="text-info">20</strong></h5>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary d-inline-flex align-items-center new-user"><i
                            class="fas fa-plus fa-fw"></i> New User</button>
                </div>
            </div>
            <div class="card-body">
                <ul class="list-group list-group-flush list team-member">
                    @foreach (\App\Models\UsersMd::select(['users.*', 'upo.position as positionName'])->leftJoin('user_position as upo', 'users.position', '=', 'upo.id')->where('status', 'active')->get() as $k => $v)
                        @php($diff = $v->last_seen != '' ? Carbon\Carbon::parse($v->last_seen)->diffInMinutes() : 3)
                        <li class="list-group-item member" data-id="{{ $v->id }}">
                            <div class="row align-items-center">
                                <div class="position">
                                    <h4 class="h6 mb-1">{{ $v->name }} <small>- {{ $v->positionName }}</small>
                                    </h4>
                                    @if ($diff < 3)
                                        {{-- <span class="text-success">Online</span> --}}
                                        <div class="d-flex align-items-center">
                                            <div class="bg-success dot rounded-circle me-1"></div><small>Online</small>
                                        </div>
                                    @else
                                        {{-- <span class="text-secondary">Offline</span> --}}
                                        <div class="d-flex align-items-center">
                                            <div class="bg-secondary dot rounded-circle me-1"></div><small>Offline
                                                @if ($v->last_seen != '')
                                                    ใช้งานเมื่อ
                                                    {{ Carbon\Carbon::parse($v->last_seen)->diffForHumans() }}
                                                @endif
                                            </small>
                                        </div>
                                    @endif


                                </div>
                                <div class="col text-end pr-0">
                                    <div class="dropdown">
                                        <button class="btn rounded-3 me-2 fs--2 icon-item icon-item-sm dropdown-toggle"
                                            type="button" id="dropdownMenuButton" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false">
                                            <i class="fas fa-ellipsis-h"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item qc-edit-user" data-user="{{ $v }}"
                                                href="javascript:">Edit</a>
                                            <a class="dropdown-item qc-delete-user" data-user="{{ $v }}"
                                                href="javascript:">Delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                    {{-- <li class="list-group-item">
        <div class="row align-items-center">
            <div class="position">
                <h4 class="h6 mb-1">Fern <small>- Designer</small></h4>
                <div class="d-flex align-items-center"><div class="bg-secondary dot rounded-circle me-1"></div><small>Offline</small></div>
            </div><div class="col text-end pr-0">
                <div class="dropdown">
                  <button class="btn rounded-3 me-2 fs--2 icon-item icon-item-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#">Edit</a>
                    <a class="dropdown-item" href="#">Delete</a>
                </div>
            </div>
        </div></div>
    </li> --}}

                </ul>
            </div>
            <div class="card-footer py-2"></div>
        </div>
    </div>

    <!-- Modal New User -->
    <div class="modal fade" id="ModalUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="alert alert-danger mb-2 d-none"></p>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="label-username">Username</label>
                                <input type="text" class="form-control" name="username"
                                    autocomplete="new-username">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-2">
                                <label class="label-password">Password</label> <a href="javascript:"
                                    class="rounded show-password p-1"><i class="fas fa-eye-slash"></i></a>
                                <input type="password" class="form-control" name="password"
                                    autocomplete="new-password">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mt-2">
                                <label class="label-position">Position:</label>
                                @foreach (\App\Models\UserPositionMd::all() as $k => $v)
                                    <a href="javascript:" data-id="{{ $v->id }}"
                                        class="badge badge-pill badge-light mb-1 user-position">{{ $v->position }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary btn-new-user">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Close Modal New User -->

    <!-- Avtivity -->

    <div class="col-lg-4">
        <div class="card-members box box-activity">
            <div class="card-header d-flex flex-between-center">
                <h5 class="mb-0">Members Activity <strong class="text-info"></strong></h5>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-falcon-default" id="activity_date"><i
                            class="far fa-calendar-alt"></i>&nbsp; Date</button><!-- เลือกวันดูย้อนหลัง -->
                </div>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush list-group-timeline">
                    <p class="m-auto">Select member</p>
                </div>
            </div>
            <div class="card-footer py-2"></div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card-members box box-activity">
            <div class="card-header d-flex flex-between-center">
                <h5 class="mb-0">Stock <strong class="text-info"></strong></h5>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush">
                    <div class="d-flex justify-content-between">
                        <a href="#">
                            <div class="font-weight-medium">Fuang</div>
                        </a>
                        <div class="text-muted">25</div> <!-- คลิกแล้วไปหน้า profile ของคนนั้น -->
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="#">
                            <div class="font-weight-medium">Noey</div>
                        </a>
                        <div class="text-muted">25</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="#">
                            <div class="font-weight-medium">Fern</div>
                        </a>
                        <div class="text-muted">25</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="#">
                            <div class="font-weight-medium">Numfon</div>
                        </a>
                        <div class="text-muted">25</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="#">
                            <div class="font-weight-medium">Boom</div>
                        </a>
                        <div class="text-muted">25</div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="#">
                            <div class="font-weight-medium">Win</div>
                        </a>
                        <div class="text-muted">25</div>
                    </div>
                </div>
            </div>

            <div class="card-footer py-2"></div>
        </div>
    </div>
</div><!-- row -->

<!-- Modal -->
<div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="rejectModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Messege Reject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="tab-reject">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Receiver:</label>
                        <select name="reject" class="form-control">
                            @foreach (\App\Models\UsersMd::whereIn('position', [2, 12])->where('status', 'active')->get() as $k => $v)
                                <option value="{{ $v->id }}">{{ $v->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- <span class="badge rounded-pill me-2 p-2 send-to mb-2 ">Fuang <span aria-hidden="true">×</span></span> -->
                    <div class="form-group">
                        <textarea class="form-control" name="remark" rows="5" placeholder="Remark..."></textarea>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="rejectCompany[]" multiple required>
                        <label class="custom-file-label" for="rejectCompany">Choose file...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                    <input type="hidden" name="job" />
                    <input type="hidden" name="type" />
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-primary qc-reject-job">Send</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
            <div class="tab-status d-none">
                <div class="modal-body">
                    <div class="form-group attach">
                        <label class="font-weight-bold">Attach a picture :</label>
                        {{-- <p class="attach">Attach: </p> --}}
                        <p class="no-image d-none"><span class="badge badge-secondary"><i
                                    class="fas fa-times-circle"></i> no image.</span></p>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Edit status :</label>
                        <p class="reject-status-text">-</p>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold">Edit message :</label>
                        <textarea class="form-control" rows="3" name="message" readonly style="resize: none;"></textarea>
                    </div>
                    <div class="form-group">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">Finished<span
                                    class="ml-1 font-weight-bold text-success"></span></label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="ModalRejectBlog" tabindex="-1" role="dialog" aria-labelledby="ModalRejectBlog"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenter">Messenge Reject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="tab-reject d-none">
                    <div class="form-group">
                        <label>Receiver:</label>
                        @foreach (\App\Models\UsersMd::whereIn('position', [2, 12])->where('status', 'active')->get() as $k => $v)
                            <a class="badge badge-pill badge-light mb-1 receiver" href="javascript:"
                                data-id="{{ $v->id }}">{{ $v->name }}</a>
                        @endforeach
                        {{-- <input type="text" class="form-control" id="tokenfield" value="Fuang" /> <!-- ทำแบบ Tag --> --}}
                    </div>
                    <!-- <span class="badge rounded-pill me-2 p-2 send-to mb-2 ">Fuang <span aria-hidden="true">×</span></span> -->
                    <div class="form-group">
                        <textarea class="form-control" name="remark" rows="5" placeholder="Remark..."></textarea>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="rejectAttach" name="rejectAttach[]"
                            multiple required>
                        <label class="custom-file-label" for="rejectAttach">Choose file...</label>
                        <div class="invalid-feedback">Example invalid custom file feedback</div>
                    </div>
                </div>
                <div class="tab-finished d-none">
                    <div class="row">
                        <div class="col-lg-12">

                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-primary">Reject</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="Modalindustry" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            </div>
        </div>
    </div>
</div>

<script>
    var blogcategory;
    var blogDate;
    const fetchCompanyOnline = (date, category) => {


        const data = $.ajax({
            method: 'get',
            url: 'webpanel/my-job/qc/get/company/online',
            async: false,
            data: {
                date: date
            }
        }).responseJSON;

        var tableOnline = $('#tableOnline');

        if (data.length > 0) {
            tableOnline.find('tbody').html('');
            tableOnline.closest('.card').find('.text-info').html(data.length);
            $.each(data, function(k, v) {
                const tr = `<tr class="align-middle">\
                    <td class="text-center">${(k+1)}</td>\
                    <td><img class="file-thumbnail border" src="${v.logo}"></td>\
                    <td>\
                        <p class="cp-name mb-0"><a class="text-dark" href="th/preview/company-profile/${v.companyId}" target="_blank">${v.name_jp}</a></p>\
                        <p class="cp-name mb-0"><a class="text-dark" href="th/preview/company-profile/${v.companyId}" target="_blank">${v.name_th}</a></p>\
                        <small class="text-primary font-weight-bold">${v.categoryName}</small>\
                    </td>\
                    <td class="text-center"><i class="fas fa-user-circle"></i> <small>${v.by}</small></td>\
                    <td class="text-center"><small>${v.step4_on}</small></td>\
                </tr>`;
                tableOnline.find('tbody').append(tr)
            });
        }

    }

    const fetchUserActivity = (datetime, userId) => {

        const data = $.ajax({
            method: 'get',
            url: 'webpanel/my-job/qc/get/activity',
            async: false,
            dataType: "json",
            data: {
                id: userId,
                date: datetime
            }
        }).responseJSON;

        if (data.length > 0) {
            $('.list-group-timeline').html('');
            $.each(data, function(k, v) {
                const timeline = $('<div class="list-group-item border-0">\
                        <div class="row ps-lg-1"><div class="col ms-n2 mb-3"><p class="fs-6 fw-bold mb-1 item-title">title</p>\
                    <div class="d-flex align-items-center"><span class="item-text">time</span></div></div></div>\
                </div>');
                let title = `<span style="font-weight:600;">${v.action}</span>`;
                if (v.description != "") title += ', <small class="badge badge-secondary">' + v.datetime +
                    '</small>';
                timeline.find('.item-title').html(title);
                timeline.find('.item-text').html(v.description);
                $('.list-group-timeline').append(timeline);
            })
        }
    }

    async function fetchJobProgress(date) {
        const data = await axios('webpanel/my-job/qc/get/job-progress', {
            params: {
                'date': date
            }
        });
        const tableJobProgress = $('#qc-jobs-content').find('table');
        const tbody = tableJobProgress.find('tbody');

        if (data.data.length > 0) {
            $('#qc-jobs-content').find('.card-header').find('.text-info').html(data.data.length);
            tableJobProgress.find('tbody').html('');
            $.each(data.data, (k, v) => {
                let checked = (v.public == 1) ? 'checked=""' : '';
                let logo = (v.logo != null) ? v.logo : 'img/no-image.png';
                let online = (v.public == 1) ? 'ONLINE' : 'OFFLINE';
                let reject = (v.reject > 0) ?
                    `<a class="badge badge-danger ml-1 find-reject" job="${v.id}" href="javascript:">Reject : ${v.reject}</a>\
                <a class="badge badge-warning find-reject" job="${v.id}" href="javascript:"><i class="fas fa-times-circle"></i> ${v.noFix}</a>\
                <a class="badge badge-success reject-edited find-reject" job="${v.id}" href="javascript:"><i class="fas fa-check-circle"></i> ${v.fixed}</a>` :
                    '';
                let step4Icon = (v.public == 1) ? 'fa-check-circle' : 'fa-times-circle';
                let step4Class = (v.public == 1) ? 'progress-success' : 'progress-none';
                let step4By = (v.step4_by == null) ? '-' : v.step4_by;
                let tr =
                    `<tr role="row" class="odd" data-row="${k+1}" data-id="${v.id}">\
                    <td class="text-center">${k+1}</td>\
                    <td class="text-center"><img src="${logo}" class="file-thumbnail border"></td>\
                    <td class="text-left">\
                        <p class="mb-0 cp-name">\
                            <a class="text-dark" href="th/preview/company-profile/${v.companyId}" target="_blank">${v.name_jp}</a>`
                if (v.countname.length > 1) {
                    tr +=
                        `<a href="javascript:" class="ml-1 badge badge-primary Modalindustry" data-category='${JSON.stringify(v.countname)}'>${v.countname.length}</a>`
                }
                tr += `<a href="webpanel/members/${v.memberId}/${v.companyId}" target="_blank" class="float-right mr-1 text-danger"><i class="fas fa-pen"></i></a>
                        </p>\
                        <p class="mb-0 cp-name">
                            <a class="text-dark" href="th/preview/company-profile/${v.companyId}" target="_blank">${v.name_th}</a>\
                        </p>
                        <small class="text-primary font-weight-bold">${v.categoryName}</small>`;
                if (v.checked == 'checked') {
                    tr +=
                        `<span class="badge badge-orange ml-2"><i class="fas fa-check"></i> Checked</span>`;
                }
                tr += `${reject}\
                    </td>\
                    <td class="text-center" data-label="Created :">${v.created}</td>\
                    <td>\
                        <div class="row p-0">\
                            <div class="col-lg-3 col-xs-12 col-md-12 pl-1 pr-1 step1">\
                                <div class="box-step">\
                                    <div class="progress-success"><i class="fas fa-check-circle"></i> CREATED</div>\
                                    <div>${v.step1_by}</div>\
                                </div>\
                            </div>\
                            <div class="col-lg-3 col-xs-12 col-md-12 pl-1 pr-1 step2">\
                                <div class="box-step job-reject" data-job="${v.id}" data-id="${v.step2_by}" data-type="di">\
                                    <div class="progress-success"><i class="fas fa-check-circle"></i> EDITED</div>\
                                    <div>${v.step2_by}</div>\
                                </div>\
                            </div>  \
                            <div class="col-lg-3 col-xs-12 col-md-12 pl-1 pr-1 step3">\
                                <div class="box-step job-reject" data-job="${v.id}" data-id="${v.step3_by}" data-type="de">\
                                    <div class="progress-success"><i class="fas fa-check-circle"></i> DESIGNED</div>\
                                    <div>${v.step3_by}</div>\
                                </div>\
                            </div>\
                            <div class="col-lg-3 col-xs-12 col-md-12 pl-1 pr-1 step4">\
                                <div class="box-step" data-id="${v.step4_by}">\
                                    <div class="step4_bar ${step4Class}">\
                                        <i class="fas ${step4Icon}"></i>\
                                        <span class="public_status">${online}</span>
                                    </div>\
                                    <div class="step4_by">${step4By}</div>\
                                </div>\
                            </div>\
                        </div>\
                    </td>\
                    <td class="align-middle text-center" data-label="Status :">\
                        <div class="custom-control custom-switch">\
                            <input type="checkbox" class="custom-control-input qc-job-status" id="customSwitch${v.companyId}" data-id="${v.companyId}" ${checked}>\
                            <label class="custom-control-label" for="customSwitch${v.companyId}"></label>\
                        </div>\
                    </td>\
                </tr>`;
                tableJobProgress.find('tbody').append(tr);
            });
        } else {
            Swal.fire({
                title: 'No record from date you select.',
                icon: 'info'
            });
        }
    }
    const fetchBlog = (datetime, category) => {
        request = {};
        request.date = datetime;
        if (category != null || category != undefined) request.date = category;

        const Table = $('#qc-blog-talble');
        const data = $.ajax({
            method: 'get',
            url: 'webpanel/my-job/qc/get/blog',
            async: false,
            dataType: "json",
            data: request
        }).responseJSON;
        if (data.length > 0) {
            Table.closest('.card').find('.text-info').html(data.length);
            Table.find('tbody').html('');
            $.each(data, function(k, v) {
                // const online = (v.status === true) ? 'checked=""' : '';
                const image = v.images != '' ? v.images : 'img/no-image.png';
                reject = '';
                checked = '';
                if (v.status == 1) checked = `checked=""`;

                // const disabled = '';
                // if(auth.role!='super' && auth.role!='developer') disabled=`disabled=""`;

                if (v.reject > 0)
                    reject =
                    `<a class="badge badge-danger ml-1" href="javascript:">Reject : ${v.reject}</a>\
                        <a class="badge badge-warning" href="javascript:"><i class="fas fa-times-circle"></i> ${v.noFix}</a>\
                        <a class="badge badge-success reject-edited" href="javascript:"><i class="fas fa-check-circle"></i> ${v.fixed}</a>`;

                const tr = `<tr class="align-middle" data-id="${v.id}">\
                    <td class="text-center">${(k+1)}</td>\
                        <td class="text-center"><img src="${image}" class="file-thumbnail border"></td>\
                        <td class="text-left">\
                        <span>${v.name_th}</span>${reject}<br>\
                        <a href="th/blog/${v.url_th}" target="_blank" class="text-gray">URL: ${v.url_th}</a>\
                    </td>\
                    <td class="text-center">${v.categoryName}</td>\
                    <td class="text-center"><small>${v.created}</small></td>\
                    <td class="text-center">\
                        <div class="dropdown">\
                            <button class="btn rounded-3 me-2 fs--2 icon-item icon-item-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">\
                                <i class="fas fa-ellipsis-h"></i>\
                            </button>\
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">\
                                <a class="dropdown-item" href="javascript:">Edit</a>\
                                <a class="dropdown-item reject-blog" href="javascript:" data-id="${v.id}">Reject</a>\
                            </div>\
                        </div>\
                    </td>\
                    <td class="text-center">\
                        <label class="c-switch c-switch-label c-switch-pill c-switch-success">\
                            <input class="c-switch-input blog-finished" type="checkbox" data-id="${v.id}" ${checked}>\
                            <span class="c-switch-slider" data-checked="On" data-unchecked="Off"></span>\
                        </label>\
                    </td>\
                </tr>`;
                Table.find('tbody').append(tr);
            });
        }
    }



    $(document).on('click', '.Modalindustry', function() {
        cur = $(this);
        category = cur.attr('data-category');
        category = JSON.parse(category);
        modal = $('#Modalindustry');
        modal.find(".modal-body").html('')
        modal.modal("show");
        ul = $('<ul class="list-group"></ul>');
        if (category.length > 0) modal.find('.modal-body').append(ul)
        $.each(category, function(k, v) {
            li =
                `<li class="list-group-item">${v.categoryName}<a href="webpanel/members/${v.membersId}/${v.id}" class="badge badge-primary float-right"><i class="fas fa-pen"></i></a></li>`;
            modal.find('ul').append(li)
        })
    })

    $(document).on('change', 'select[name="category"]', function() {
        category = $(this).val();
        console.log(category);
        fetchBlog(null, category)
    })

    $('#job_progress_date').datepicker({
        format: 'yyy-m-d',
        todayHighlight: true
    }).on('changeDate', function(ev) {
        const date = ev.date.getFullYear() + '-' + (ev.date.getMonth() + 1) + '-' + ev.date.getDate();
        fetchJobProgress(date)
    });

    $('#online_date').datepicker({
        todayHighlight: 'TRUE',
        autoclose: true,
    }).on('changeDate', function(ev) {
        const date = ev.date.getFullYear() + '-' + (ev.date.getMonth() + 1) + '-' + ev.date.getDate();
        fetchCompanyOnline(date)
    })

    $('#qc_blog_date').datepicker({
        todayHighlight: 'TRUE',
        autoclose: true,
    }).on('changeDate', function(ev) {
        const date = ev.date.getFullYear() + '-' + (ev.date.getMonth() + 1) + '-' + ev.date.getDate();
        fetchBlog(date, null)
    });

    $('#activity_date').datepicker({
        todayHighlight: 'TRUE',
        autoclose: true,
    }).on('changeDate', function(ev) {
        const datetime = ev.date.getFullYear() + '-' + (ev.date.getMonth() + 1) + '-' + ev.date.getDate();
        const userId = $('.member.active').attr('data-id');
        if (userId != undefined) {
            fetchUserActivity(datetime, userId)
        } else {
            alert()
        }
    });
</script>
