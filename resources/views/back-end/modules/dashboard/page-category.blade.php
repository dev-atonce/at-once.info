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

    .table-responsive {
        overflow: auto;
        height: 800px;
    }

    .table-responsive thead th {
        position: sticky;
        top: 0;
        z-index: 1;
    }

    table {
        border-collapse: collapse;
        width: 100%;
    }

    th {
        background: #ffffff;
    }
</style>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card-header py-2 px-3">
                <span class="breadcrumb-item "><a href="jacascript:">All category</a></span>
                <div class="card-header-actions">
                    <small class="badge badge-secondary">
                        <a target="_blank" href="webpanel/export/all">
                            <i class="fas fa-file-export"></i>ExportAll .csv
                        </a>
                    </small>
                    <small class="badge badge-secondary">
                        <a target="_blank" href="webpanel/export/onSiteCategory">
                            <i class="fas fa-file-export"></i>ExportOnsite .csv
                        </a>
                    </small>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <form action="" class="mb-3">
                        <div class="row justify-content-between">
                            <div class="col-6 d-flex">
                                <div class="row w-100">
                                    <div class="col-6">
                                        <input type="text" class="form-control" name="date" placeholder="Date"
                                            value="{{ Request::get('date') }}">
                                    </div>
                                    <div class="col-3 pl-0">
                                        <button type="submit" class="btn btn-primary mb-2">Search</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                @php
                                    $CompanyMd = \App\Models\CompanyMd::class;
                                    $date = Request::get('date');
                                    $date = explode('-', $date);
                                    $categoryOnlineFull = $CompanyMd
                                        ::join('category', 'company.category', 'category.id')
                                        ->where([
                                            'company.public' => 1,
                                            'category.status' => 1,
                                            'category.coming_soon' => 0,
                                            'company.type' => 'full',
                                        ])
                                        ->when(Request::get('date'), function ($query) use ($date) {
                                            $query
                                                ->where(
                                                    DB::raw('DATE(company.published_on)'),
                                                    '>=',
                                                    date('Y-m-d', strtotime($date[0])),
                                                )
                                                ->where(
                                                    DB::raw('DATE(company.published_on)'),
                                                    '<=',
                                                    date('Y-m-d', strtotime($date[1])),
                                                );
                                        })
                                        ->count();
                                    $categoryOnlineBasic = $CompanyMd
                                        ::join('category', 'company.category', 'category.id')
                                        ->where([
                                            'company.public' => 1,
                                            'category.status' => 1,
                                            'category.coming_soon' => 0,
                                            'company.type' => 'basic',
                                        ])
                                        ->when(Request::get('date'), function ($query) use ($date) {
                                            $query
                                                ->where(
                                                    DB::raw('DATE(company.published_on)'),
                                                    '>=',
                                                    date('Y-m-d', strtotime($date[0])),
                                                )
                                                ->where(
                                                    DB::raw('DATE(company.published_on)'),
                                                    '<=',
                                                    date('Y-m-d', strtotime($date[1])),
                                                );
                                        })
                                        ->count();
                                    $categoryOnlineOnprocess = $CompanyMd
                                        ::join('job_cs', 'company.id', 'job_cs.company')
                                        ->join('category', 'company.category', 'category.id')
                                        ->where([
                                            'category.status' => 1,
                                            'category.coming_soon' => 0,
                                            'company.type' => 'semi',
                                        ])
                                        ->whereNull(['job_cs.refuse', 'company.resource'])
                                        ->where(function ($query) {
                                            $query->whereNull('company.semi')->orWhere('company.semi', false);
                                        })
                                        ->whereNull(['job_cs.refuse', 'company.resource'])
                                        ->count();
                                @endphp
                                <div class="row w-100 justify-content-end">
                                    <div class="col-4">
                                        <span class="form-control mr-1 d-flex justify-content-center">
                                            <label for="online">OnlineFull [<span
                                                    class="text-success font-weight-bolder">{{ $categoryOnlineFull }}</span>]</label>
                                        </span>
                                    </div>
                                    <div class="col-4 pl-0">
                                        <span class="form-control mr-1 d-flex justify-content-center">
                                            <label for="onlinebasic">OnlineBasic [<span
                                                    class="text-success font-weight-bolder">{{ $categoryOnlineBasic }}</span>]</label>
                                        </span>
                                    </div>
                                    <div class="col-4 pl-0">
                                        <span class="form-control mr-1 d-flex justify-content-center">
                                            <label for="onprocess">OnProcess [<span
                                                    class="text-success font-weight-bolder">{{ $categoryOnlineOnprocess }}</span>]</label>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped no-footer table-res" id="sort_table" role="grid"
                                style="border-collapse: collapse !important">
                                <thead>
                                    <tr role="">
                                        <th>#</th>
                                        <th class="">CATEGORY</th>
                                        <th class="text-center">TOTAL</th>
                                        <th class="text-center">ONLINE FULL</th>
                                        <th class="text-center">NO ATTACHFILE</th>
                                        <th class="text-center">COPYRIGHT</th>
                                        <th class="text-center">OFFLINE</th>
                                        <th class="text-center">BASIC YP</th>
                                        <th class="text-center">REFUSE</th>
                                        <th class="text-center">SEMI</th>
                                        <th class="text-center">ON PROCESS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $sum_total = 0;
                                        $sum_onlinefull = 0; // no attachfile + copyright
                                        $sum_noattachfile = 0; // full no attachfile
                                        $sum_copyright = 0; // full attachfile
                                        $sum_offline = 0; //
                                        $sum_offlinebasic = 0; //
                                        $sum_basicYp = 0; // basic yp
                                        $sum_refuse = 0; // refuse
                                        $sum_semi = 0; // refuse
                                        $sum_onprocess = 0; // di create
                                    @endphp
                                    @foreach ($rows as $k => $row)
                                        @php
                                            $total = $CompanyMd
                                                ::where('category', $row->id)
                                                ->count();
                                            $sum_total += $total;

                                            $onlineFull = $CompanyMd
                                                ::where([
                                                    'company.type' => 'full',
                                                    'company.public' => 1,
                                                    'company.category' => $row->id,
                                                ])
                                                ->when(Request::get('date'), function ($query) use ($date) {
                                                    $query
                                                        ->where(
                                                            DB::raw('DATE(company.published_on)'),
                                                            '>=',
                                                            date('Y-m-d', strtotime($date[0])),
                                                        )
                                                        ->where(
                                                            DB::raw('DATE(company.published_on)'),
                                                            '<=',
                                                            date('Y-m-d', strtotime($date[1])),
                                                        );
                                                })
                                                ->count();
                                            $sum_onlinefull += $onlineFull;

                                            $no_attachfile = $CompanyMd
                                                ::where([
                                                    'company.type' => 'full',
                                                    'company.license_attachfile' => null,
                                                    'company.category' => $row->id,
                                                ])
                                                ->count();
                                            $sum_noattachfile += $no_attachfile;

                                            $copyright = $CompanyMd
                                                ::leftJoin('job_cs', 'company.id', 'job_cs.company')
                                                ->where(['company.type' => 'full', 'company.category' => $row->id])
                                                ->when(Request::get('date'), function ($query) use ($date) {
                                                    $query
                                                        ->where(
                                                            DB::raw('DATE(job_cs.attachfile)'),
                                                            '>=',
                                                            date('Y-m-d', strtotime($date[0])),
                                                        )
                                                        ->where(
                                                            DB::raw('DATE(job_cs.attachfile)'),
                                                            '<=',
                                                            date('Y-m-d', strtotime($date[1])),
                                                        );
                                                })
                                                ->whereNotNull('license_attachfile')
                                                ->count();
                                            $sum_copyright += $copyright;

                                            $offline = $CompanyMd
                                                ::where([
                                                    'company.type' => 'full',
                                                    'company.public' => 0,
                                                    'company.category' => $row->id,
                                                ])
                                                ->count();
                                            $sum_offline += $offline;

                                            $offlineBasic = $CompanyMd
                                                ::where([
                                                    'company.type' => 'basic',
                                                    'company.public' => 0,
                                                    'company.category' => $row->id,
                                                ])
                                                ->count();
                                            $sum_offlinebasic += $offlineBasic;

                                            $basicYp = $CompanyMd
                                                ::where([
                                                    'company.type' => 'basic',
                                                    'company.resource' => 'import',
                                                    'company.category' => $row->id,
                                                ])
                                                ->count();
                                            $sum_basicYp += $basicYp;

                                            $refuse = $CompanyMd
                                                ::leftJoin('job_cs', 'company.id', 'job_cs.company')
                                                ->when(Request::get('date'), function ($query) use ($date) {
                                                    $query
                                                        ->where(
                                                            DB::raw('DATE(job_cs.refuse)'),
                                                            '>=',
                                                            date('Y-m-d', strtotime($date[0])),
                                                        )
                                                        ->where(
                                                            DB::raw('DATE(job_cs.refuse)'),
                                                            '<=',
                                                            date('Y-m-d', strtotime($date[1])),
                                                        );
                                                })
                                                ->where([
                                                    'company.category' => $row->id,
                                                ])
                                                ->whereNotNull('job_cs.refuse')
                                                ->count();
                                            $sum_refuse += $refuse;

                                            $semi = $CompanyMd
                                                ::where([
                                                    'company.type' => 'semi',
                                                    'company.category' => $row->id,
                                                    'company.semi' => true,
                                                ])
                                                ->count();
                                            $sum_semi += $semi;

                                            $onprocess = $CompanyMd
                                                ::leftJoin('job_progress', 'company.id', '=', 'job_progress.company')
                                                ->leftJoin('job_cs', 'company.id', '=', 'job_cs.company')
                                                ->where([
                                                    'company.type' => 'semi',
                                                    'company.category' => $row->id,
                                                ])
                                                ->whereNull(['job_cs.refuse', 'company.resource'])
                                                ->where(function ($query) {
                                                    $query->whereNull('company.semi')->orWhere('company.semi', false);
                                                })
                                                ->count();
                                            $sum_onprocess += $onprocess;
                                        @endphp
                                        <tr>
                                            <td class="font-weight-bolder">{{ $k + 1 }}</td>
                                            <td>
                                                <span
                                                    class="badge @if ($row->status == 1 && $row->coming_soon != 1) badge-success @else badge-secondary @endif">
                                                    <a class="text-white" style="text-decoration: none"
                                                        href="{{ url("/webpanel/company/$row->key") }}">#
                                                        {{ $row->name_jp }}</a>
                                                </span>
                                            </td>
                                            {{-- TOTAL --}}
                                            <td class="text-center text-primary font-weight-bolder">{{ $total }}
                                            </td>

                                            {{-- ONLINE FULL --}}
                                            <td class="text-center text-success font-weight-bolder">
                                                <div
                                                    class="@if ($onlineFull >= 10) badge badge-success @elseif ($onlineFull >= 6 && $onlineFull < 10)  badge badge-warning @endif d-flex justify-content-center align-items-center py-1">
                                                    <div>
                                                        {{ $onlineFull }}
                                                    </div>
                                                </div>
                                            </td>

                                            {{-- NO ATTACHFILE --}}
                                            <td class="text-center text-danger font-weight-bolder">{{ $no_attachfile }}
                                            </td>

                                            {{-- COPYRIGHT --}}
                                            <td class="text-center text-info font-weight-bolder">{{ $copyright }}
                                            </td>

                                            {{-- OFFLINE --}}
                                            <td class="text-center text-dark font-weight-bolder">F[<span
                                                    class="text-danger">{{ $offline }}</span>] B[<span
                                                    class="text-danger">{{ $offlineBasic }}</span>]
                                            </td>

                                            {{-- BASIC YP --}}
                                            <td class="text-center text-warning font-weight-bolder">{{ $basicYp }}
                                            </td>

                                            {{-- REFUSE --}}
                                            <td class="text-center text-danger font-weight-bolder">{{ $refuse }}
                                            </td>

                                            {{-- SEMI --}}
                                            <td class="text-center text-info font-weight-bolder">{{ $semi }}
                                            </td>

                                            {{-- ON PROCESS. --}}
                                            <td class="text-center text-warning font-weight-bolder">{{ $onprocess }}
                                            </td>

                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="font-weight-bolder"></td>
                                        <td><span class="badge badge-primary"></span></td>
                                        <td class="text-center text-primary font-weight-bolder">{{ $sum_total }}
                                        </td>
                                        <td class="text-center text-success font-weight-bolder">{{ $sum_onlinefull }}
                                        </td>
                                        <td class="text-center text-danger font-weight-bolder">{{ $sum_noattachfile }}
                                        </td>
                                        <td class="text-center text-info font-weight-bolder">{{ $sum_copyright }}</td>
                                        <td class="text-center text-dark font-weight-bolder">F[<span
                                                class="text-danger">{{ $sum_offline }}</span>] B[<span
                                                class="text-danger">{{ $sum_offlinebasic }}</span>]</td>
                                        <td class="text-center text-warning font-weight-bolder">{{ $sum_basicYp }}
                                        </td>
                                        <td class="text-center text-danger font-weight-bolder"><a href="javascript:0"
                                                data-toggle="modal" data-target="#refuseModal" class="text-danger"
                                                style="text-decoration: none">{{ $sum_refuse }}</a></td>
                                        <td class="text-center text-info font-weight-bolder">{{ $sum_semi }}
                                        </td>
                                        <td class="text-center text-warning font-weight-bolder">{{ $sum_onprocess }}
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="refuseModal" tabindex="-1" role="dialog" aria-labelledby="refuseModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="refuseModalLabel">Refuse Status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
    $('input[name="date"]').daterangepicker({
        autoUpdateInput: false,
    }).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });

    function getLog() {
        const data = $.ajax({
            method: 'get',
            url: "{{ route('refuseLog') }}",
            async: false,
            contentType: "application/json"
        }).responseJSON;

        return data;
    }

    $('#refuseModal').on('show.bs.modal', function(event) {
        var modal = $(this);
        modal.find('.modal-body').html('');

        const datalog = getLog();
        let item = "";

        if (datalog.status == 200) {
            datalog.data.map((x) => {
                item +=
                    `<div><span class="badge badge-danger">Cancel Refuse</span> ${x.companyName} - ${moment(x.dateOfLog).format('D MMMM YYYY')}</div>`;
            })
            modal.find('.modal-body').html(item);
        } else {
            modal.find('.modal-body').html("<div>No data Found !</div>");
        }
    })
</script>
