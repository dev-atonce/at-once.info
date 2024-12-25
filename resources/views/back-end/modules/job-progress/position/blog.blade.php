{{-- <h2 class="mb-4">Blog</h2> --}}
@php
    $goal = 3;
    // $user = !Request::get('user')? 8 : Request::get('user');
    $user = Auth::user();
    $req_date = Request::get('date');
    $req_user = Request::get('user');
    $date = date('Y-m-d', strtotime(Request::get('date')));
    $select = [
        'bl.id',
        'bl.name_th',
        'bl.name_jp',
        'bl.status',
        'bl.images',
        'category.key as categoryKey',
        'category.name_jp as categoryName',
        'bl.url_th',
        'bl.url_jp',
        'blog_progress.step1',
        'blog_progress.step1_on',
        'blog_progress.step2',
        'blog_progress.step2_on',
        'bl.created',
        'bl.created_by',
        'bl.updated',
        'bl.updated_by',
        'bl.publish',
        'bl.type',
    ];
    $stockQuery = \App\Models\BlogProgressMd::select($select)
        // ->leftJoin('blog_reject as bre','blog_progress.blog','=','bre.blog')
        ->leftJoin('blog as bl', 'blog_progress.blog', '=', 'bl.id')
        ->leftJoin('category', 'bl.category', '=', 'category.id')
        ->where(function ($query) use ($user) {
            if ($user->name == 'WIN') {
                $query->whereNotNull('blog_progress.step2')->whereNull('blog_progress.step3');
            }
            if ($user->name == 'BOOM' || $user->name == 'FUANG') {
                $query->whereNull('blog_progress.step2');
            }
        })
        ->when(Request::get('date'), function ($query) use ($req_date, $user) {
            if ($user->name == 'BOOM' || $user->name == 'FUANG') {
                return $query->where(db::raw('DATE(blog_progress.step1_on)'), 'like', $req_date);
            }
            if ($user->name == 'WIN') {
                return $query->where(db::raw('DATE(blog_progress.step2_on)'), 'like', $req_date);
            }
        });
    $stock = $stockQuery->orderBy('blog_progress.created', 'desc')->skip(0)->take(50)->get();

    $reject = \App\Models\BlogRejectMd::select(
        'blg.*',
        'blog_reject.id as reject_id',
        'blog_reject.from',
        'blog_reject.to',
        'blog_reject.remark',
        'blog_reject.status',
        'blog_reject.finished',
        'blog_reject.message',
    )
        ->leftJoin('blog as blg', 'blog_reject.blog', '=', 'blg.id')
        ->where('to', $user->id)
        ->whereNull('blog_reject.status')
        ->whereNull('blog_reject.finished')
        ->get();

    $today = \App\Models\BlogProgressMd::whereDate('step3_on', $date)->count();
    $percent = round(($today * 100) / $goal, 2);

    // step2 => forward to design
    // step3 => forward to qc

    $forwardQuery = \App\Models\BlogProgressMd::select([
        'bl.id',
        'bl.name_th',
        'bl.name_jp',
        'bl.status',
        'bl.images',
        'bl.url_th',
        'bl.url_jp',
        'category.name_jp as categoryName',
        'blog_progress.id as blog_progress',
        'blog_progress.step1',
        'blog_progress.step1_by',
        'blog_progress.step1_on',
        'blog_progress.step2',
        'blog_progress.step2_by',
        'blog_progress.step2_on',
        'blog_progress.step3',
        'blog_progress.step3_by',
        'blog_progress.step3_on',
        'bl.created',
        'bl.created_by',
    ])
        ->leftJoin('blog as bl', 'blog_progress.blog', '=', 'bl.id')
        ->leftJoin('category', 'bl.category', '=', 'category.id')
        ->where(function ($query) use ($user) {
            if ($user->name == 'BOOM' || $user->name == 'FUANG' || $user->name == 'NOT') {
                return $query->where('blog_progress.step1_by', $user->id)->whereNotNull('blog_progress.step2');
            }
            if ($user->name == 'WIN') {
                return $query->where('blog_progress.step2_by', $user->id)->whereNotNull('blog_progress.step3');
            }
        })
        ->when(Request::get('date'), function ($query) use ($req_date, $user) {
            if ($user->name == 'BOOM' || $user->name == 'FUANG' || $user->name == 'NOT') {
                return $query->where(db::raw('DATE(blog_progress.step2)', 'like', $req_date));
            }
            if ($user->name == 'WIN') {
                return $query->where(db::raw('DATE(blog_progress.step)', 'like', $req_date));
            }
        });

    if ($user->name == 'BOOM' || $user->name == 'FUANG' || $user->name == 'NOT') {
        $forwardQuery->orderBy('blog_progress.step2', 'desc');
    }
    if ($user->name == 'WIN') {
        $forwardQuery->orderBy('blog_progress.step3', 'desc');
    }

    $forward = $forwardQuery->limit(20)->get();

    $createdToday = \App\Models\BlogProgressMd::whereDate('created', 'like', date('Y-m-d'))->count();
    $percentToday = ($createdToday * 100) / $goal;
    $designedToday = \App\Models\BlogProgressMd::whereDate('step2', 'like', date('Y-m-d'))->count();
    $noDetail = \App\Models\BlogMd::whereNull('detail_th')->whereNull('detail_jp')->count();
    $detailed = \App\Models\BlogMd::whereNotNull('detail_th')->orWhereNotNull('detail_jp')->count();
@endphp
<div class="row" id="bloger-content">
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box bg-secondary-gradient">
            <div class="card-body">
                <a href="webpanel/blog/add" target="_blank" id="blog-create" class="btn btn-success float-right"
                    href="javascript:" title="Create"><i class="fas fa-edit"></i></a>
                <h2 class="mb-2">Blog</h2>
                <form action="" method="get">
                    @if ($auth->role == 'developer')
                        <select name="user" class="custom-select custom-select-sm mb-3">
                            <option value="">Choose...</option>
                            @foreach (\App\Models\UsersMd::where('status', 'active')->whereIn('id', [8, 10])->get() as $k => $v)
                                <option value="{{ $v->id }}" @if ($v->id == Request::get('user')) selected @endif>
                                    {{ $v->name }}</option>
                            @endforeach
                        </select>
                    @endif
                    @if ($auth->role != 'developer')
                        <hr class="my-4">
                    @endif
                    <div class="fs-6 fw-semibold title mb-1">DATE</div>
                    <div class="input-group input-group-sm">
                        <input type="text" name="date" id="blog_datepicker" class="form-control" readonly
                            value="@if (Request::get('date')) {{ $req_date }}@else{{ date('Y-m-d') }} @endif">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary btn-sm" type="submit"><i
                                    class="fas fa-search-plus"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box bg-light-gradient">
            <div class="card-body">
                <div class="fs-6 fw-semibold title">CREATED</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{ $createdToday }}/{{ $goal }}</div>
                    <small class=" text-blue">{{ round($percentToday, 2) }}%</small>
                </div>
                <div class="progress progress-thin my-2">
                    <div class="progress-bar" role="progressbar" style="width: {{ round($percentToday, 2) }}%"
                        aria-valuenow="{{ round($percentToday, 2) }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="text-warning font-weight-bold">ALL</span>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{ \App\Models\BlogMd::whereNull('publish')->count() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box bg-listght-gradient">
            <div class="card-body">
                <div class="fs-6 fw-semibold title">DESIGNED</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{ $designedToday }}/{{ $goal }}</div>
                    <small class=" text-blue">{{ round($percentToday, 2) }}%</small>
                </div>
                <div class="progress progress-thin my-2">
                    <div class="progress-bar" role="progressbar" style="width: {{ round($percentToday, 2) }}%"
                        aria-valuenow="{{ round($percentToday, 2) }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="text-info font-weight-bold">ALL</span>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{ \App\Models\BlogProgressMd::whereNotNull('step2')->count() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box bg-light-gradient">
            <div class="card-body">
                <div class="fs-6 fw-semibold text-danger">REJECT</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number text-danger">{{ $reject->count() }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-6 col-lg-2 d-flex">
        <div class="card box text-white bg-success-gradient">
            <div class="card-body">
                <div class="fs-6 fw-semibold title">FINISH</div>
                <div class="d-flex flex-between-baseline">
                    <div class="h3 mb-1 number">{{ $today }}/{{ $goal }}</div><small
                        class=" text-blue">{{ round($percent, 2) }}%</small>
                </div>
                <div class="progress progress-thin my-2">
                    <div class="progress-bar bg-success" role="progressbar" style="width: {{ round($percent, 2) }}%"
                        aria-valuenow="{{ round($percent, 2) }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <span class="text-success font-weight-bold">PUBLISH</span>
                <div class="h3 mb-1 number">{{ \App\Models\BlogMd::whereNotNull('publish')->count() }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12 d-flex">
        <div class="card h-lg-100 overflow-hidden">
            <div class="card-header d-flex flex-between-center">
                <h5 class="mb-0">Stock <strong class="text-info">{{ $stockQuery->count() }}</strong></h5>
                <div class="ms-auto text-end mt-n1 col-auto">
                    <a class="py-1 text-dark" href="#!">Detail {{ $detailed }}</a>
                    <div class="vr"></div>
                    <a class="py-1 text-dark" href="#!">No Detail {{ $noDetail }}</a>
                    @if (Auth::user()->role == 'developer')
                        <div class="vr"></div>
                    @endif
                    <!-- -----------------ถ้าหน้า WIN จะเปลี่ยน Status เป็น Design No Design---------------------- -->
                    @if (Auth::user()->position == 8 || Auth::user()->role == 'developer')
                        <a class="py-1 text-dark" href="#!">Design 8</a>
                        <div class="vr"></div>
                        <a class="py-1 text-dark" href="#!">No Design 4</a>
                    @endif
                </div>
            </div>
            @php($byTitle = $auth->id == 8 ? 'Created By' : 'Updated by')
            <div class="card-body p-0 stock-list">
                <div class="table-responsive table-borderless table-hover">
                    <table class="table mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="text-center">NO.</th>
                                <th class="text-center"></th>
                                <th width="40%">Blog Name</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Category</th>
                                <th class="text-center th-date">
                                    @if ($user->name == 'BOOM')
                                        Created
                                    @else
                                        Date
                                    @endif
                                </th>
                                @if ($auth->id == 10 || $auth->role == 'developer')
                                    <th class="text-center" width="7%">Updated By</th>
                                @endif
                                <th class="text-center th-status">Status</th>
                                <th class="text-center">Actions</th>
                                @if ($user->name == 'BOOM' || $user->role == 'developer')
                                    <th class="text-center" width="6%">
                                        <label class="mb-0"><input type="checkbox"
                                                class="blog-all-design mr-1">Design</label>
                                    </th>
                                @endif
                                @if ($user->name == 'WIN' || $user->role == 'developer' || $user->name == 'NATTAWAT' || $user->name == 'NOT')
                                    <th class="text-center" width="6%">
                                        <label class="mb-0"><input type="checkbox"
                                                class="blog-all-qc mr-1">Qc</label>
                                    </th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @if ($stock->count() > 0)
                                @foreach ($stock as $k => $v)
                                    @php($datetime = $user->name == 'BOOM' ? $v->created : $v->step2)
                                    @php($logo = $v->images == '' ? 'img/no-image.png' : str_replace('.', '-xs.', $v->images))
                                    @php($url = $v->key == '' ? $v->url_th : "$v->categoryKey/$v->url_th")
                                    @php($byClass = $v->updated_by == '' ? 'text-danger' : '')
                                    <tr class="align-middle">
                                        <td class="text-center">{{ $k + 1 }}</td>
                                        <td class="text-center">
                                            <img src="{{ $logo }}" class="file-thumbnail border">
                                        </td>
                                        <td class="text-left">
                                            <p class="mb-0 blog-name">{{ $v->name_th }}@if (date('Y-m-d', strtotime($v->created)) == date('Y-m-d'))
                                                    <small class="badge badge-orange ml-1">New &#9733;</small>
                                                @endif
                                            </p>
                                            <a target="_blank" href="{{ url("th/blog/$url") }}"
                                                class="text-gray">URL: {{ url("th/blog/$url") }}</a>
                                            <br>
                                            <a target="_blank" href="{{ url("th/preview/blog/$v->id") }}"
                                                class="text-gray">PREVIEW: {{ url("th/preview/blog/$v->id") }}</a>
                                        </td>
                                        <td class="text-center"><small>{{ $v->type }}</small></td>
                                        <td class="text-center"><small>{{ $v->categoryName }}</small></td>
                                        <td class="text-center"><small
                                                @if (date('Y-m-d', strtotime($datetime)) == date('Y-m-d')) style="color:#ff7600;" @endif>{{ date('d-m-Y H:i:s', strtotime($datetime)) }}</small>
                                        </td>
                                        @if ($auth->id == 10 || $auth->role == 'developer')
                                            <td class="text-center"><i class="fas fa-user-circle"></i>
                                                <small>{{ $v->updated_by }}</small>
                                            </td>
                                        @endif
                                        <td class="text-center">
                                            <span class="badge badge-success"><i class="fas fa-check"></i>
                                                Detail</span>
                                        </td>
                                        <td class="text-center"><a
                                                href="webpanel/blog/{{ $v->id }}/{{ $v->categoryKey }}"
                                                target="_blank" class="badge bg-light text-dark"><i
                                                    class="fas fa-pen"></i> Edit</a></td>
                                        @if ($user->name == 'BOOM' || $user->role == 'developer')
                                            <td class="text-center">
                                                @if ($v->designer == '')
                                                    <div class="form-check">
                                                        <input class="form-check-input blog-to-design" type="checkbox"
                                                            value="{{ $v->id }}">
                                                    </div>
                                                @endif
                                            </td>
                                        @endif
                                        @if ($user->name == 'WIN' || $user->role == 'developer' || $user->name == 'NATTAWAT' || $user->name == 'NOT')
                                            <td class="text-center">
                                                @if ($v->publish == '')
                                                    <div class="form-check">
                                                        <input class="form-check-input blog-to-qc" type="checkbox"
                                                            value="{{ $v->id }}">
                                                    </div>
                                                @endif
                                            </td>
                                        @endif
                                    </tr>
                                @endforeach
                            @else
                                <tr class="align-middle">
                                    <td class="text-center" colspan="10">No record.</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2">
                <div class="row flex-between-center">
                    <div class="col-auto"></div>
                    <div class="col-auto"><button class="btn btn-send btn-primary blog-forward"
                            disabled>Forward</button></div>
                </div>
            </div>
        </div>
    </div>


    <!-- Tranfer --> <!-- แสดงส่งที่ส่งมา 1 อาทิตย์ -->
    <div class="col-lg-6 d-flex">
        <div class="card h-lg-100 overflow-hidden">
            <div class="card-header d-flex flex-between-center">
                <h5 class="mb-0">Forward <strong class="text-info">{{ $forward->count() }}</strong></h5>
            </div>
            <div class="card-body p-0 tranfer-list">
                <div class="table-responsive table-borderless table-hover">
                    <table class="table mb-0">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="text-center">NO.</th>
                                <th>Blog</th>
                                <th class="text-center">Category</th>
                                <th class="text-center th-date">Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($forward as $k => $v)
                                @php($logo = $v->images == '' ? 'img/no-image.png' : $v->images)
                                @php($url = $v->key == '' ? $v->url_th : "$v->categoryKey/$v->url_th")
                                @php($dateForward = $user->name == 'WIN' ? $v->step3 : $v->step2)
                                <tr class="align-middle">
                                    <td class="text-center">{{ $k + 1 }}</td>
                                    <td class="text-left">
                                        <div class="blog-name">
                                            <p class="mb-0"
                                                style="max-width: 450px; text-overflow:ellipsis; overflow:hidden; white-space:nowrap">
                                                {{ $v->name_th }}
                                                @if (date('Y-m-d', strtotime($v->created)) == date('Y-m-d'))
                                                    <small class="badge badge-orange ml-1">New &#9733;</small>
                                                @endif
                                            </p>
                                            <div
                                                style="max-width: 450px; text-overflow:ellipsis; overflow:hidden; white-space:nowrap">
                                                <a href="{{ url("th/blog/$url") }}" class="text-gray ">
                                                    URL: {{ url("th/blog/$url") }}
                                                </a>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-center"><small>{{ $v->categoryName }}</small></td>
                                    <td class="text-center">
                                        <small @if (date('Y-m-d', strtotime($dateForward)) == date('Y-m-d')) style="color:#ff7600;" @endif>
                                            {{ date('d M Y H:i', strtotime($dateForward)) }}
                                        </small>
                                    </td>
                                    <td class="text-center">
                                        <a href="webpanel/blog/{{ $v->id }}/{{ $v->categoryKey }}"
                                            class="badge bg-light text-dark">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2"></div>
        </div>
    </div>


    {{-- Reject Table --}}
    <div class="col-lg-6 d-flex">
        <div class="card h-lg-100 overflow-hidden">
            <div class="card-header d-flex flex-between-center">
                <h5 class="mb-0">Reject <strong class="text-danger">{{ $reject->count() }}</strong></h5>
            </div>
            <div class="card-body p-0 tranfer-list">
                <div class="table-responsive table-borderless table-hover">
                    <table class="table mb-0" id="blogRejectTable">
                        <thead class="table-light fw-semibold">
                            <tr class="align-middle">
                                <th class="text-center">NO.</th>
                                <th>Blog</th>
                                <th class="text-center">Date</th>
                                <th class="text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($reject as $k => $v)
                                @php($attach = \App\Models\RejectImageMd::select('image')->where('_id', $v->reject_id)->where('type_reject', 'blog')->get())
                                <tr class="align-middle tr" data-id="{{ $v->id }}"
                                    data-remark="{{ $v->remark }}" data-attach="{{ $attach }}"
                                    data-edit="webpanel/blog/{{ $v->id }}">
                                    <td class="text-center">{{ $k + 1 }}</td>
                                    <td class="ellipsis">
                                        <span class="mb-0">{{ $v->name_th }}</span><br />

                                        <span class="mb-0">Remark: {{ $v->remark }}</span>
                                    </td>
                                    <td class="text-center">
                                        <small>{{ date('d M-Y H:i', strtotime($v->created)) }}</small>
                                    </td>
                                    <td class="text-center">
                                        <a class="badge badge-info detail-reject" href="javascript:"><i
                                                class="fas fa-eye"></i> Detail</a><br>
                                        {{-- <a class="badge badge-info" href="javascript:"><i class="fas fa-undo"></i> Return</a> --}}
                                        <a class="badge badge-secondary" href="/webpanel/blog/{{ $v->id }}"
                                            target="_blank">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer py-2">
                <div class="row flex-between-center">
                    <div class="col-auto"></div>
                    <div class="col-lg-6">
                        <div class="d-flex float-right">
                            <div class="custom-control custom-checkbox mr-3 align-middle">
                                <input type="checkbox" name="return" id="allReturn" class="custom-control-input">
                                <label class="custom-control-label" for="allReturn">Select All</label>
                            </div>
                            <button class="btn btn-send btn-primary return-blog" disabled>Return to QC.</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> <!-- row -->

<div class="modal fade" id="blogModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Detail reject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="tab-detail">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="remark">Remark: <span></span></p>
                            <p class="attach">Attach: </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary d-none send">Send</button>
                <a class="btn btn-primary d-none edit"><i class="fas fa-pen fa-fw"></i> Edit</a>
            </div>
        </div>
    </div>
</div>
