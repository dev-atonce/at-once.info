<style>
    .img-preview {
        width: 100%;
        max-height: 145px;
        overflow: hidden;
    }

    .img-preview>img {
        height: 100%;
    }

    #tree {
        width: auto;
        height: 350px;
        overflow-x: auto;
        overflow-y: auto;
        border-radius: .25rem;
    }

    #tree>ul {
        padding-top: 10px;
    }

    #preview {
        display: inline-block;
        font-style: normal;
        font-variant: normal;
        text-rendering: auto;
        -webkit-font-smoothing: antialiased;

    }

    #preview:after {
        font-family: 'Font Awesome 5 Free';
        font-size: 9em !important;
        content: "\f03e";
        color: #999;
        display: block;
        margin: 30px;
    }

    .img-thumbnail {
        text-align: center;
    }

    a.previous-page,
    a.next-page {
        font-weight: bold;
    }

    .previous-page:hover,
    .next-page:hover {
        color: white;
        background-color: #321fdb;
        text-decoration: none;
    }

    .badge-orange {
        color: #ffffff;
        background-color: #ff6a00;
    }
</style>
<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header py-2 px-3">
                    <span class="breadcrumb-item "><a href="{{ url("$prefix$segment") }}">Company</a></span>
                    @if (@$category != '')
                        <span class="breadcrumb-item active"><a
                                href="{{ url("$prefix$segment") }}/{{ $category }}">{{ $category }}<a></span>
                    @endif
                    <div class="card-header-actions">
                        <a class="btn btn-primary" href='{{ url("$prefix/members/$categoryId/add") }}'>Create</a>
                    </div>
                    <div class="card-header-actions mr-2"><small class="badge badge-secondary"><a target="_blank"
                                href="webpanel/export/refuse/{{ $categoryId }}"><i class="fas fa-file-export"></i>
                                Export Refuse .csv</a></small></div>
                    <div class="card-header-actions mr-2"><small class="badge badge-secondary"><a target="_blank"
                                href="webpanel/export/copyright/{{ $categoryId }}"><i class="fas fa-file-export"></i>
                                Export Company License .csv</a></small></div>
                    <div class="card-header-actions mr-2"><small class="badge badge-secondary"><a target="_blank"
                                href="webpanel/export/category/{{ $categoryId }}"><i class="fas fa-file-export"></i>
                                Export .csv</a></small></div>
                    <!-- <div class="card-header-actions mr-2"><small class="badge badge-secondary"><a target="_blank"
                                href="webpanel/export/all-category"><i class="fas fa-file-export"></i>
                                Export All Compnay .csv</a></small></div> -->
                </div>
                <div class="card-body">
                    @php
                        $CompanyMd = \App\Models\CompanyMd::class;
                        $online = $CompanyMd
                            ::where(['public' => 1, 'category' => $categoryId, 'type' => 'full'])
                            ->count();
                        $offline = $CompanyMd::where(['public' => 0, 'category' => $categoryId])->count();
                        $full = $CompanyMd::where(['type' => 'full', 'category' => $categoryId])->count();
                        $basic = $CompanyMd
                            ::where([
                                'company.type' => 'basic',
                                'company.resource' => 'import',
                                'company.category' => $categoryId,
                            ])
                            ->count();
                        $semi = $CompanyMd
                            ::where([
                                'company.type' => 'semi',
                                'company.category' => $categoryId,
                                'company.semi' => true,
                            ])
                            ->count();
                        $onProcess = $CompanyMd
                            ::leftJoin('job_progress', 'company.id', 'job_progress.company')
                            ->leftJoin('job_cs', 'company.id', 'job_cs.company')
                            ->where([
                                'company.type' => 'semi',
                                'company.category' => $categoryId,
                            ])
                            ->whereNull(['job_cs.refuse', 'company.resource'])
                            ->where(function ($query) {
                                $query->whereNull('company.semi')->orWhere('company.semi', false);
                            })
                            ->count();
                        $attachfile = $CompanyMd
                            ::where(['category' => $categoryId])
                            ->whereNotNull('license_attachfile')
                            ->count();
                        $no_attachfile = $CompanyMd
                            ::where(['category' => $categoryId])
                            ->whereNull('license_attachfile')
                            ->count();
                        $refuse = $CompanyMd
                            ::join('job_cs', 'company.id', 'job_cs.company')
                            ->where(['company.category' => $categoryId])
                            ->whereNotNull('job_cs.refuse')
                            ->count();
                        $cannot_contact = $CompanyMd
                            ::join('job_cs', 'company.id', 'job_cs.company')
                            ->where('category', $categoryId)
                            ->whereNotNull('job_cs.cannot_contact')
                            ->count();
                        $follow = $CompanyMd
                            ::join('job_cs', 'company.id', 'job_cs.company')
                            ->where('category', $categoryId)
                            ->whereNotNull('job_cs.follow')
                            ->count();
                        $no_response = $CompanyMd
                            ::join('job_cs', 'company.id', 'job_cs.company')
                            ->where('category', $categoryId)
                            ->whereNotNull('job_cs.no_response')
                            ->count();
                    @endphp
                    <form action="" method="get" class="form-inline mb-4">
                        <div class="d-flex flex-wrap">
                            <div class="form-group mr-1 mb-1">
                                <input type="text" class="form-control" name="keyword" placeholder="Keyword"
                                    value="{{ Request::get('keyword') }}" style="width:200px;">
                            </div>
                            <span class="form-control mr-1 mb-1">
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" name="online" class="custom-control-input" id="online"
                                        value="1" @if (Request::get('online') == 1) checked @endif>
                                    <label class="custom-control-label" for="online">Online [<span
                                            class="text-success">{{ $online }}</span>]</label>
                                </div>
                            </span>
                            <span class="form-control mr-1 mb-1">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="offline" class="custom-control-input" id="Offline"
                                        value="1" @if (Request::get('offline') == 1) checked @endif>
                                    <label class="custom-control-label" for="Offline">Offline [<span
                                            class="text-danger">{{ $offline }}</span>]</label>
                                </div>
                            </span>
                            <span class="form-control mr-1 mb-1">
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" name="full" class="custom-control-input" id="full"
                                        value="1" @if (Request::get('full') == 1) checked @endif>
                                    <label class="custom-control-label" for="full">Full [<span
                                            class="text-success">{{ $full }}</span>]</label>
                                </div>
                            </span>
                            <span class="form-control mr-1 mb-1">
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" name="basic" class="custom-control-input" id="basic"
                                        value="1" @if (Request::get('basic') == 1) checked @endif>
                                    <label class="custom-control-label" for="basic">Basic [<span
                                            class="text-warning">{{ $basic }}</span>]</label>
                                </div>
                            </span>
                            <span class="form-control mr-1 mb-1">
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" name="semi" class="custom-control-input" id="semi"
                                        value="1" @if (Request::get('semi') == 1) checked @endif>
                                    <label class="custom-control-label" for="semi">Semi profile [<span
                                            class="text-warning">{{ $semi }}</span>]</label>
                                </div>
                            </span>
                            <span class="form-control mr-1 mb-1">
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" name="onProcess" class="custom-control-input" id="onProcess"
                                        value="1" @if (Request::get('onProcess') == 1) checked @endif>
                                    <label class="custom-control-label" for="onProcess">On Porcess [<span
                                            class="text-warning">{{ $onProcess }}</span>]</label>
                                </div>
                            </span>
                            <span class="form-control mr-1 mb-1">
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" name="attachfile" class="custom-control-input"
                                        id="attachfile" value="1"
                                        @if (Request::get('attachfile') == 1) checked @endif>
                                    <label class="custom-control-label" for="attachfile">Attachfile [<span
                                            class="text-success">{{ $attachfile }}</span>]</label>
                                </div>
                            </span>
                            <span class="form-control mr-1 mb-1">
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" name="no_attachfile" class="custom-control-input"
                                        id="no_attachfile" value="1"
                                        @if (Request::get('no_attachfile') == 1) checked @endif>
                                    <label class="custom-control-label" for="no_attachfile">No Attachfile [<span
                                            class="text-warning">{{ $no_attachfile }}</span>]</label>
                                </div>
                            </span>
                            <span class="form-control mr-1 mb-1">
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" name="refuse" class="custom-control-input"
                                        id="refuse" value="1"
                                        @if (Request::get('refuse') == 1) checked @endif>
                                    <label class="custom-control-label" for="refuse">Refuse [<span
                                            class="text-danger">{{ $refuse }}</span>]</label>
                                </div>
                            </span>
                            <span class="form-control mr-1 mb-1">
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" name="cannot_contact" class="custom-control-input"
                                        id="cannot_contact" value="1"
                                        @if (Request::get('cannot_contact') == 1) checked @endif>
                                    <label class="custom-control-label" for="cannot_contact">Cannot Contact [<span
                                            class="text-danger">{{ $cannot_contact }}</span>]</label>
                                </div>
                            </span>
                            <span class="form-control mr-1 mb-1">
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" name="follow" class="custom-control-input"
                                        id="follow" value="1"
                                        @if (Request::get('follow') == 1) checked @endif>
                                    <label class="custom-control-label" for="follow">Follow [<span
                                            class="text-danger">{{ $follow }}</span>]</label>
                                </div>
                            </span>
                            <span class="form-control mr-1 mb-1">
                                <div class="custom-control custom-checkbox ">
                                    <input type="checkbox" name="no_response" class="custom-control-input"
                                        id="no_response" value="1"
                                        @if (Request::get('no_response') == 1) checked @endif>
                                    <label class="custom-control-label" for="no_response">No Response [<span
                                            class="text-danger">{{ $no_response }}</span>]</label>
                                </div>
                            </span>
                            <input type="hidden" value="{{ Request::get('start') }}">
                            <input type="submit" class="btn btn-info input-sm ml-1" value="Search">
                        </div>

                    </form>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped no-footer table-res" id="sort_table" role="grid"
                                style="border-collapse: collapse !important">
                                <thead>
                                    <tr role="">
                                        <th width="2%">#</th>
                                        <th width="7%"></th>
                                        <th width="30%">Company</th>
                                        <th width="11%"></th>
                                        <th width="17%">Last Update</th>
                                        <th width="5%">Status</th>
                                        <th width="11%" style="text-align:center;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $key => $row)
                                        @php
                                            $logs = \App\Models\LogOfModifiedMd::select([
                                                'company_log.id as logId',
                                                'uss.name as admin',
                                                'company_log.action as lastModified',
                                                'company_log.created as lastUpdated',
                                            ])
                                                ->join('users as uss', 'company_log.user', '=', 'uss.id')
                                                ->where(['company_log.company' => $row->id])
                                                ->whereNull('type')
                                                ->orderBy('company_log.created', 'desc')
                                                ->limit(3)
                                                ->get();
                                            if ($row->more_th != '' || $row->more_jp != '') {
                                                $detail = 'success';
                                                $iconDt = 'fa-check';
                                            } else {
                                                $detail = 'danger';
                                                $iconDt = 'fa-times';
                                            }
                                            if ($row->step3 != '') {
                                                $design = 'success';
                                                $iconDs = 'fa-check';
                                            } else {
                                                $design = 'danger';
                                                $iconDs = 'fa-times';
                                            }
                                        @endphp
                                        <tr role="row" class="odd" data-row="{{ $key + 1 }}"
                                            data-id="{{ $row->id }}">
                                            <td data-label="No.">
                                                <span class="no">{{ Request::get('skip') + $key + 1 }}</span>
                                                <i class="fas fa-bars handle d-none"></i>
                                                <a href="javascript:" cp="{{ $row->id }}"
                                                    to="{{ $row->email }}" title="{{ $row->name_th }}"
                                                    data-href="{{ url("/api/my/services/company/profile/$row->profile_url") }}"
                                                    {{-- data-href="{{url("/demo/company/profile/$row->profile_url")}}" --}} target="_blank"
                                                    class="badge badge-secondary send-email" style="padding:5px;"><i
                                                        class="far fa-paper-plane fa-lg"></i></a>
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $image = !empty($row->logo)
                                                        ? str_replace('.', '-xs.', $row->logo)
                                                        : 'img/no-image.png';
                                                @endphp
                                                <img src="{{ $image }}" class="img-thumbnail"
                                                    style="width:95px; border-radius: 50% !important;">
                                                @if ($row->cs != '')
                                                    <label class="text-dark">CS: {{ $row->cs_by }}</label>
                                                @else
                                                    <label for="booking{{ $row->id }}">
                                                        <input type="checkbox" name="booking" class="cs-booking"
                                                            id="booking{{ $row->id }}"
                                                            value="{{ $row->id }}"> Booking
                                                    </label>
                                                @endif
                                            </td>
                                            <td class="text-left">
                                                <span class="badge badge-secondary mr-1"><i
                                                        class="fas fa-language fa-lg text-primary"></i>
                                                    Thai</span>{{ $row->name_th }} @if ($row->type == 'basic')
                                                    <strong class="badge badge-info"><i class="far fa-file-alt"></i>
                                                        {{ strtoupper($row->type) }}</strong>
                                                @endif
                                                <br>
                                                <span class="badge badge-secondary mr-1"><i
                                                        class="fas fa-language fa-lg text-primary"></i>
                                                    Japanese</span>{{ $row->name_jp }}<br>
                                                <div class="d-flex justify-content-between">
                                                    <div>
                                                        <a href="{{ $prefix }}/{{ $folder }}/{{ request()->segment(3) }}/statistics/{{ $row->id }}"
                                                            class="badge badge-primary"><i
                                                                class="fas fa-chart-line pr-1"></i>Statistics</a>
                                                        @if ($row->type != 'basic')
                                                            <span class="badge badge-{{ $detail }}"><i
                                                                    class="fas {{ $iconDt }}"></i> Detail</span>
                                                        @endif
                                                        @if ($row->type != 'basic')
                                                            <span class="badge badge-{{ $design }}"><i
                                                                    class="fas {{ $iconDs }}"></i> Design</span>
                                                        @endif
                                                        @if ($row->checked == 'checked')
                                                            <span class="badge badge-orange"><i
                                                                    class="fas fa-check fa-fw"></i> Checked</span>
                                                        @endif
                                                        @if ($row->license == true)
                                                            <a href="javascript:0" style="color:#ffffff"
                                                                class="badge badge-warning copyrightreturn">
                                                                <i class="fas fa-file-upload"></i>
                                                                Copyright Return
                                                            </a>
                                                            @if ($row->upload_by != '')
                                                                @php
                                                                    $users = \App\Models\UsersMd::find($row->upload_by);
                                                                @endphp
                                                                <small style="color: #bababa;">By:
                                                                    {{ $users->name }}</small>
                                                            @endif
                                                        @endif
                                                        @if (\App\Models\LogOfModifiedMd::where(['action' => 'URL Close', 'company' => $row->id])->count() > 0 && $row->website=='')
                                                            <span class="badge badge-warning"><i
                                                                    class="fas fa-times"></i> URL
                                                                Close</span>
                                                        @endif
                                                    </div>
                                                    <div>
                                                        @if ($row->license_attachfile != '')
                                                            <a href="{{ $row->license_attachfile }}"
                                                                target="_blank"><i class="far fa-file-pdf"
                                                                    style="font-size: 18px; color:red"></i></a>
                                                        @endif
                                                    </div>
                                                </div>
                                                @if ($row->reason != '')
                                                    <div>
                                                        <span style="font-weight: 500"
                                                            class="text-danger">Reason:&nbsp;{{ $row->reason }}</span>
                                                    </div>
                                                @endif
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="license"
                                                        class="custom-control-input license"
                                                        data-id="{{ $row->id }}"
                                                        id="license{{ $key }}" value="{{ $row->license }}"
                                                        @if ($row->license == true) checked @endif>
                                                    <label class="custom-control-label"
                                                        for="license{{ $key }}"><span>Copyright</span></label>
                                                    <small style="color:#bababa">
                                                        @if ($row->license == true)
                                                            @php
                                                                $users = \App\Models\UsersMd::find($row->license_by);
                                                            @endphp
                                                            By: {{ @$users->name }}
                                                        @endif
                                                    </small>
                                                </div>
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" name="semi"
                                                        class="custom-control-input semi"
                                                        data-id="{{ $row->id }}" id="semi{{ $key }}"
                                                        value="{{ $row->semi }}"
                                                        @if ($row->semi == true) checked @endif>
                                                    <label class="custom-control-label"
                                                        for="semi{{ $key }}"><span>SEMI</span></label>
                                                </div>
                                            </td>
                                            <td data-label="Created :">
                                                <div>
                                                    <a class="badge badge-primary font-weight-bold text-white"
                                                        style="font-size: 12px;"># {{ $row->categoryName }}</a>
                                                </div>
                                                <div>
                                                    <a class="badge badge-secondary">Created:
                                                        {{ date('d-M-Y H:i', strtotime($row->created)) }}</a>
                                                </div>
                                                <div>
                                                    @if ($row->refuse != '')
                                                        <a href="javascript:0"
                                                            class="badge badge-danger text-white cancelRefuse"
                                                            data-id="{{ $row->id }}">REFUSE</a>
                                                    @endif
                                                    @if ($row->cannot_contact != '')
                                                        <a href="javascript:0"
                                                            class="badge badge-warning text-white cancelCannot_contact"
                                                            data-id="{{ $row->id }}">Cannot Contact</a>
                                                    @endif
                                                    @if ($row->follow != '')
                                                        <a href="javascript:0"
                                                            class="badge badge-info text-white cancelFollow"
                                                            data-id="{{ $row->id }}">Follow</a>
                                                    @endif
                                                    @if ($row->no_response != '')
                                                        <a href="javascript:0"
                                                            class="badge badge-dark text-white cancelNo_response"
                                                            data-id="{{ $row->id }}">No Response</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td data-label="Last update :">
                                                @if ($logs->count() > 0)
                                                    @foreach ($logs as $kl => $log)
                                                        @if ($kl < 2)
                                                            •<span class="text-warning"
                                                                style="font-weight:bold; font-size:12px; padding:2px;">{{ $log->admin }}</span>,
                                                            <small>{{ date('d-M-y, H:i:s', strtotime($log->lastUpdated)) }}</small>
                                                            <p
                                                                style="font-size: 11px;line-height:1.2;padding:0;margin:0;">
                                                                {{ $log->lastModified }}</p>
                                                        @endif
                                                    @endforeach
                                                    <strong class="text-info more-log"
                                                        data-company="{{ $row->id }}"
                                                        style="cursor: pointer;">More..</strong>
                                                    @else{{ $row->updated_by }}
                                                @endif
                                            </td>
                                            <td data-label="Status :">
                                                <label class="c-switch c-switch-label c-switch-pill c-switch-success">
                                                    <input class="c-switch-input status" type="checkbox"
                                                        data-id="{{ $row->id }}"
                                                        @if ($row->public == 1) checked @endif
                                                        @if (Auth::user()->name == 'HOCKY' ||
                                                                Auth::user()->name == 'PAIR' ||
                                                                Auth::user()->name == 'TUM' ||
                                                                Auth::user()->name == 'BANK') @else disabled @endif><span
                                                        class="c-switch-slider" data-checked="On"
                                                        data-unchecked="Off"></span>
                                                </label>
                                            </td>
                                            <td data-label="Actions :" style="display: flex; justify-content:center;">
                                                {{-- <a href="{{url("webpanel/members/$row->_id/$row->id")}}" class="btn btn-warning btn-sm" title="Edit"><i class="far fa-edit"></i></a> --}}
                                                <a href="{{ url("webpanel/members/$row->_id/$row->id") }}"
                                                    class="badge badge-warning p-2 mr-1"><i class="fas fa-pen"></i>
                                                    Edit</a>
                                                {{-- <a href="javascript:" class="btn btn-danger btn-sm deleteItem" data-id="{{$row->id}}" title="Delete"><i class="far fa-trash-alt"></i></a> --}}
                                                @if (Auth::user()->role == 'developer' || Auth::user()->role == 'super')
                                                    <a href="javascript:"
                                                        class="badge badge-danger deleteItem p-2 mr-1"
                                                        data-id="{{ $row->id }}" title="Delete"><i
                                                            class="fas fa-trash"></i> Delete</a>
                                                @endif
                                                <a href="javascript:0" data-id="{{ $row->id }}"
                                                    data-company="{{ $row->id }}"
                                                    class="badge badge-info p-2 viewinfo"><i
                                                        class="fas fa-search"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    {{-- @endif --}}
                                </tbody>
                            </table>
                            {{-- @if (Request::get('view') != 'all'){{$rows->links()}}@endif --}}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <p class="text-center mb-0">Page loding({{ round(microtime(true) - LARAVEL_START, 2) }}s)
                            </p>
                            <div class="form-inline d-flex justify-content-center">
                                <div class="input-group my-3">
                                    <div class="input-group-prepend">
                                        <label class="input-group-text" for="inputGroupSelect01">
                                            <a class="prev-page" href="javascript:">&lt; Prev</a>
                                        </label>
                                    </div>
                                    <select class="custom-select text-center paginate"
                                        all-page="{{ $allPage }}">
                                        @for ($i = 0; $i < $allPage; $i++)
                                            @php($val = $i == 0 ? 0 : $i * $take)
                                            <option value="{{ $val }}"
                                                @if (Request::get('skip') == $val) selected @endif>{{ $i + 1 }}
                                            </option>
                                        @endfor
                                    </select>
                                    <div class="input-group-append">
                                        <label class="input-group-text" for="inputGroupSelect01">
                                            <a class="next-page" href="javascript:">Next &gt;</a>
                                        </label>
                                    </div>
                                </div><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button class="btn btn-primary btn-sm" type="submit" name="signup">Create</button>
                    <a class="btn btn-danger btn-sm" href="{{ url("$prefix$segment") }}">Cancel</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- copyright modal --}}
<div class="modal fade" id="modalcopyright" tabindex="-1" role="dialog" aria-labelledby="Modalcopyright"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="Modalcopyright">Copyright Attachment</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Upload By:</label>
                        <input type="hidden" name="id" id="id">
                        <input readonly type="text" class="form-control" name="cs" id="cs"
                            data-id="{{ Auth::user()->id }}" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Upload File:</label>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="attachment" name="attachment">
                            <label class="custom-file-label" for="attachment">Choose file</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger deletefile">Delete</button>
                <button type="button" class="btn btn-primary upload">Upload</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- delist modal --}}
<div class="modal fade" id="modaldelisted" tabindex="-1" role="dialog" aria-labelledby="modaldelisted"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modaldelisted">Delisted Company</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Delisted By:</label>
                        <input type="hidden" name="id" id="id">
                        <input readonly type="text" class="form-control" name="name" id="name"
                            data-id="{{ Auth::user()->id }}" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message" name="message"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary delisted">Send message</button>
            </div>
        </div>
    </div>
</div>

<!-- last update modal -->
<div class="modal fade" id="lastUpdate" tabindex="-1" role="dialog" aria-labelledby="lastUpdateLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lastUpdateLabel">Last update</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">...</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

{{-- view contact modal --}}
<div class="modal fade" id="contactmodal" tabindex="-1" role="dialog" aria-labelledby="contactmodal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="contactmodal">Contact Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-contact"></div>
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Update By:</label>
                        <input type="hidden" name="id" id="id">
                        <input readonly type="text" class="form-control" name="name" id="name"
                            data-id="{{ Auth::user()->id }}" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-form-label">Message:</label>
                        <textarea class="form-control" name="message" id="message"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary updatecontact">Update</button>
            </div>
        </div>
    </div>
</div>

<script>
    var thisUrl = 'webpanel/company/{{ $category }}';
    var take = Number("{{ $take }}");
    var allPage = Number($('.paginate').attr('all-page'));
    var currentPage = Number('{{ Request::get('skip') }}');
    let action = '';

    function pagination() {
        $(document).on('change', '.paginate', function() {
            skip = $(this).val()
            adjust(skip)
        })
        $(document).on('click', '.prev-page', function() {
            action = 'prev';
            adjust();
        })

        $(document).on('click', '.next-page', function() {
            action = 'next';
            adjust()
        })
        queryString = window.location.search;
        queryString = queryString.replace('?', '');
        queryString = queryString.split('&');
        //======================================//
        objQuery = {
            'skip': 0
        };
        b = [];
        for (i in queryString) {
            a = queryString[i].split('=');
            objQuery[a[0]] = a[1];
        }
        //======================================//

        const adjust = (skip) => {

            $this = $('.paginate').find('option[selected]');

            if (action == 'next' && skip == null) {
                next = $('.paginate').find('option[selected]').next();
                if (next.html() <= allPage) skip = next.val();
            }
            if (action == 'prev' && skip == null) {
                prev = $('.paginate').find('option[selected]').prev();
                if (prev.html() >= 1) skip = prev.val();
            }
            skip = Number(skip);
            console.log(skip)
            //======================================//
            newQueryString = '';
            $.each(objQuery, function(k, v) {
                if (v != undefined) {
                    newQueryString += (k == 'skip') ? `&${k}=${skip}` : `&${k}=${v}`;
                }
            })
            n = newQueryString.replace('&', '?');
            window.location.href = `${thisUrl}${n}`
        }
    }

    pagination()

    $('.cancelRefuse').on('click', function() {
        const id = $(this).attr('data-id');
        Swal.fire({
            title: 'You want to cancel refuse?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `webpanel/cancel-refuse?id=${id}`,
                    success: (res) => {
                        if (res.msg == 'success') {
                            Swal.fire(
                                'Success!',
                                'Your refuse has been cancel.',
                                'success'
                            ).then(() => {
                                window.location = window.location.href;
                            })
                        } else {
                            Swal.fire(
                                'Fail!',
                                `error : ${res.msg}`,
                                'warning'
                            )
                        }
                    }
                })
            }
        })
    })

    $('.cancelCannot_contact').on('click', function() {
        const id = $(this).attr('data-id');
        Swal.fire({
            title: 'You want to cancel cannot contact ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `webpanel/cancel-cannotcontact?id=${id}`,
                    success: (res) => {
                        if (res.msg == 'success') {
                            Swal.fire(
                                'Success!',
                                'Your cannot contact has been cancel.',
                                'success'
                            ).then(() => {
                                window.location = window.location.href;
                            })
                        } else {
                            Swal.fire(
                                'Fail!',
                                `error : ${res.msg}`,
                                'warning'
                            )
                        }
                    }
                })
            }
        })
    })

    $('.cancelFollow').on('click', function() {
        const id = $(this).attr('data-id');
        Swal.fire({
            title: 'You want to cancel follow?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `webpanel/cancel-follow?id=${id}`,
                    success: (res) => {
                        if (res.msg == 'success') {
                            Swal.fire(
                                'Success!',
                                'Your follow has been cancel.',
                                'success'
                            ).then(() => {
                                window.location = window.location.href;
                            })
                        } else {
                            Swal.fire(
                                'Fail!',
                                `error : ${res.msg}`,
                                'warning'
                            )
                        }
                    }
                })
            }
        })
    })

    $('.cancelNo_response').on('click', function() {
        const id = $(this).attr('data-id');
        Swal.fire({
            title: 'You want to cancel no response?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Confirm!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'get',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: `webpanel/cancel-noresponse?id=${id}`,
                    success: (res) => {
                        if (res.msg == 'success') {
                            Swal.fire(
                                'Success!',
                                'Your no response has been cancel.',
                                'success'
                            ).then(() => {
                                window.location = window.location.href;
                            })
                        } else {
                            Swal.fire(
                                'Fail!',
                                `error : ${res.msg}`,
                                'warning'
                            )
                        }
                    }
                })
            }
        })
    })

    $('.viewinfo').on('click', function() {
        let modal = $('#contactmodal');
        modal.find('input[name="id"]').val($(this).attr('data-id'));
        modal.find('.modal-contact').html('');
        modal.find('textarea#message').val('');
        let id = $(this).attr('data-company');
        logs = $.ajax({
            method: 'get',
            url: `${window.location.pathname}/log-of-contact?id=${id}`,
            contentType: false,
            processData: false,
            async: false
        }).responseJSON
        if (logs.length > 0) {
            logs.map(function(v, k) {
                item = $(`<p>\
                    •<span class="text-warning" style="font-weight:bold; font-size:12px; padding:2px;">${v.name}</span>,\
                    <span class="ml-1">${v.created}</span>,\
                    <span class="ml-1">${v.action}</span>\
                </p>`);
                modal.find('.modal-contact').append(item);
            })
        }
        modal.modal('show');
    })

    $('.updatecontact').on('click', function() {
        let fd = new FormData();
        let modal = $('#contactmodal');
        fd.append('id', modal.find('input[name="id"]').val());
        fd.append('uid', modal.find('input[name="name"]').attr('data-id'));
        fd.append('message', modal.find('textarea[name="message"]').val());
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: `${window.location.pathname}/updateContact`,
            type: 'post',
            contentType: false,
            processData: false,
            async: false,
            data: fd,
            dataType: 'json',
            success: (response) => {
                Swal.fire({
                    title: "Update Success !",
                    icon: "success",
                    timer: 1500,
                    closeOnClickOutside: false,
                    showConfirmButton: false,
                    willClose: () => {
                        clearInterval(timerInterval);
                    }
                }).then((re) => {
                    modal.modal('hide');
                    window.location = window.location.href;
                });
            },
            error: (response) => {
                Swal.fire({
                    text: "Please Try Again Later !",
                    icon: "error",
                    timer: 1500,
                    closeOnClickOutside: false,
                    showConfirmButton: false,
                })
            }
        })
    })

    $(document).on('click', '.copyrightreturn', function(e) {
        let currentRow = $(this).closest("tr");
        let modal = $('#modalcopyright');
        modal.find('input[name="id"]').val(currentRow.attr('data-id'));
        modal.find('.custom-file-label').html();
        modal.find('.custom-file-input').on('change', function() {
            var $this = $(this);
            var input = $(this)[0];
            if (input.files && input.files[0]) {
                $this.siblings(".custom-file-label").addClass("selected").html(input.files[0].name
                    .toString());
            }
        })
        modal.modal('show');
    })

    $(document).on('click', '.upload', function() {
        let fd = new FormData();
        let modal = $('#modalcopyright');
        fd.append('id', modal.find('input[name="id"]').val());
        fd.append('cs', modal.find('input[name="cs"]').attr('data-id'));
        if ($('input[name="attachment"]').val() != '') {
            fd.append('attachment', $('input[name="attachment"]')[0].files[0]);
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'webpanel/copyright/upload',
            type: 'post',
            contentType: false,
            processData: false,
            async: false,
            data: fd,
            dataType: 'json',
            success: (response) => {
                Swal.fire({
                    title: "Upload Success !",
                    icon: "success",
                    timer: 1500,
                    closeOnClickOutside: false,
                    showConfirmButton: false,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((re) => {
                    modal.modal('hide');
                    window.location = window.location.href;
                });
            },
            error: (response) => {
                Swal.fire({
                    title: response.msg,
                    text: "Please Try Again Later !",
                    icon: "error",
                    timer: 1500,
                    closeOnClickOutside: false,
                    showConfirmButton: false,
                })
            }
        })
    })

    $(document).on('click', '.deletefile', function() {
        let fd = new FormData();
        let modal = $('#modalcopyright');
        fd.append('id', modal.find('input[name="id"]').val());
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'webpanel/copyright/delete',
            type: 'delete',
            data: {
                id: modal.find('input[name="id"]').val(),
                uid: modal.find('input[name="cs"]').attr('data-id'),
            },
            success: (response) => {
                Swal.fire({
                    title: "Delete Success !",
                    icon: "success",
                    timer: 1500,
                    closeOnClickOutside: false,
                    showConfirmButton: false,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((re) => {
                    modal.modal('hide');
                    window.location = window.location.href;
                });
            },
            error: (response) => {
                Swal.fire({
                    title: response.msg,
                    text: "Please Try Again Later !",
                    icon: "error",
                    timer: 1500,
                    closeOnClickOutside: false,
                    showConfirmButton: false,
                })
            }
        })
    })

    var queryString = (string) => {

        let newString = string.split('&');
        let newArr = [];
        newString.map((v, k) => {
            let array = v.split('=');
            var str = `${array[0]}=${array[1]}`;
            newArr.push(str);
        })

        return newArr;
    }

    function arrayToQueryString(obj, ck, val) {

        var blkstr = [];
        $.each(obj, function(k, v) {
            let arr = v.split('=');
            arr[0] = arr[0].replace('"', '');
            arr[1] = arr[1].replace('"', '');
            blkstr.push(arr);
        });
        res = [];
        $.each(blkstr, function(k, v) {

            c = ck == v[0] ? true : false;
            if (c === true) {
                v[1] = val;
            } else {}
            res.push(`${v[0]}=${+v[1]}`);
        });
        return res.join('&');
    }
    $('select[name="start"]').on('change', function() {
        const val = $(this).val();

        let search = window.location.search;
        if (search != '') {
            search = search.replace('?', '');
            search = JSON.stringify(search);
            search = queryString(search)
            search = arrayToQueryString(search, 'start', val);

        } else {
            search += 'start=' + val
        }

        search = search.replace('"', '');
        let url = window.location.pathname + '?' + search;
        // console.log(url);
        window.location.href = url;

    });
    var pageStart = $('select[name="start"]').find(':selected').val();

    var previousPage = () => {

        let search = window.location.search;
        if (search != '') {
            search = search.replace('?', '');
            search = JSON.stringify(search);
            search = queryString(search)
            console.log(search)
        } else {
            search += 'start=' + pageStart
        }
    }
    var nextPage = () => {

    }


    var fullUrl = window.location.origin + '/webpanel/members';
    $('.ChkBox').click(function() {
        const checked = [];
        const $this = $(this).prop("checked");
        $('.ChkBox').each(function() {
            if ($(this).is(':checked')) {
                checked.push($this)
            }
        })
        if (checked.length > 0) {
            $('#delSelect').prop('disabled', false);
        } else {
            $('#delSelect').prop('disabled', true);
        }
    })
    $('#delSelect').on('click', function() {
        const id = $('.ChkBox:checked').map(function() {
            return $(this).val()
        }).get();
        if (id.length > 0) {
            deleted(id)
        }
    })
    $('.deleteItem').on('click', function() {
        let modal = $('#modaldelisted');
        modal.find('input[name="id"]').val($(this).data('id'));
        modal.modal('show');
    })

    $('.delisted').on('click', function() {
        let modal = $('#modaldelisted');
        let id = modal.find('input[name="id"]').val();
        let data = {
            "id": id,
            "msg": modal.find('textarea[name="message"]').val()
        }
        deleted(data)
    })

    function deleted(data = {}) {
        Swal.fire({
            title: "Delete data",
            text: "Do you want to delete the data?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                return await fetch(fullUrl + '/deleteCompany', {
                        method: 'POST',
                        headers: {
                            "Content-Type": "application/json",
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify(data),
                    })
                    .then(response => response.json())
                    .then(data => location.reload())
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`)
                    })
            }
        });
    }
    $('.status').on('click', function() {
        const cur = $(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: 'webpanel/members/company/status',
            method: 'post',
            async: false,
            data: {
                id: cur.data('id')
            },
            success: function(res) {
                console.log(res)
            }
        });
    })
    $('.license').on('click', function() {
        const cur = $(this);
        const by = cur.parent().find('small');

        if (cur.is(':checked') === false) {
            by.addClass('d-none');
            by.html('');
        } else {
            by.removeClass('d-none')
        }
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: 'webpanel/company/license',
            method: 'post',
            data: {
                id: cur.data('id')
            },
            success: function(res) {
                if (res.by) by.removeClass('d-none').html('by:' + res.by.name);
            }
        })
    })

    $('.semi').on('click', function() {
        const cur = $(this);

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: 'webpanel/company/semi',
            method: 'post',
            data: {
                id: cur.data('id')
            },
        });
    })

    $('.cs-booking').on('change', function() {
        const by = $('<label class="text-dark">CS:&nbsp;</label>');
        const curr = $(this);
        $.ajax({
            method: "get",
            url: 'webpanel/my-job/cs/booking',
            data: {
                company: curr.val()
            },
            success: function(res) {
                if (res.status == 201) {
                    curr.parent().addClass('d-none');
                    curr.closest('td').append(by.append(res.by));
                    curr.parent().remove()
                } else if (res.status == 200) {
                    alert(res.message);
                    curr.parent().addClass('d-none');
                    curr.closest('td').append(by.append(res.by));
                    curr.parent().remove()
                } else {
                    alert(res.message);
                }
            }
        })
    })
    $('.send-email').on('click', function() {
        let cp = $(this).attr('cp');
        // let url = $(this).attr('data-href');
        url = $(this).attr('data-href');

        // let a = $(`<a href="${url.attr('data-href')}">${url.attr('title')}</a>`);
        // a.select();
        // document.execCommand('copy');
        console.log(url);
        console.log(navigator.clipboard);

        navigator.clipboard.writeText(`"${url}"`).then(() => {
            $.ajax(`webpanel/company/copyUrlAndStorageData?company=${cp}&to=${$(this).attr('to')}`)
                .then(response => {
                    if (!response.ok) throw new Error(response.statusText)
                    else return response.json()
                })
                .catch(error => {
                    response !== false ? Swal.showValidationMessage(`Request failed: ${error}`) :
                        '';
                })

            Swal.fire({
                icon: 'success',
                position: 'top-end',
                title: 'Copy to clipboard.',
                showConfirmButton: false,
                timer: 2000,
                // toast: true
            });
        });



        // let data = {
        //     id:$(this).attr('data-id'),
        //     name:$(this).attr('data-name').split(','),
        //     email:$(this).attr('data-email')
        // };
        // $('#email-modal').modal({
        //     show :true,
        //     keyboard: false,
        //     backdrop: 'static'
        // });

        // $('#email-modal').find('input[name="to"]').val(data.email+' - '+data.name[0]);

    })
    $(document).on('click', '.more-log', function() {
        id = $(this).attr('data-company');
        Modal = $('#lastUpdate');
        Modal.find('.modal-body').html('');
        logs = $.ajax({
            method: 'get',
            url: `${window.location.pathname}/log-of-modified?id=${id}`,
            contentType: false,
            processData: false,
            async: false
        }).responseJSON
        if (logs.length > 0) {
            logs.map(function(v, k) {
                console.log(v, k)
                item = $(`<p>\
                    •<span class="text-warning" style="font-weight:bold; font-size:12px; padding:2px;">${v.by}</span>,\
                    <span class="ml-1">${v.created}</span>,\
                    <span class="ml-1">${v.action}</span>\
                </p>`);
                Modal.find('.modal-body').append(item);
            })
            Modal.modal('show');
        }
    })
</script>
