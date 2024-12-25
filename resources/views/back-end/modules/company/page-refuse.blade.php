<style>
    .badge-orange {
        color: #ffffff;
        background-color: #ff6a00;
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="fade-in">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header py-2 px-3">
                    <span class="breadcrumb-item"><a href="{{ url("$prefix$segment") }}">Refuse Company</a></span>
                    <span class="float-right"><a href="{{ url("$prefix$segment/report") }}">Export</a></span>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12 col-xs-12">
                            <div class="form-row">
                                <form action="" style="width: 100%">
                                    <div class="form-row">
                                        <div class="form-group col-lg-3">
                                            <input type="text" name="keyword" class="form-control"
                                                placeholder="Keywords" value="{{ Request::get('keyword') }}">
                                        </div>
                                        <div class="col-2">
                                            <input type="text" class="form-control" name="date"
                                                placeholder="Date" value="{{ Request::get('date') }}">
                                        </div>
                                        <div class="form-group col-lg-1">
                                            <label class="form-control text-danger" for="full">
                                                <input type="checkbox" name="full" id="full" value="1"
                                                    @if (Request::get('full') == '1') checked @endif> Full
                                            </label>
                                        </div>
                                        <div class="form-group col-lg-1">
                                            <label class="form-control text-primary" for="offline">
                                                <input type="checkbox" name="offline" id="offline" value="1"
                                                    @if (Request::get('offline') == 1) checked @endif> Offline
                                            </label>
                                        </div>
                                        <div class="form-group col-lg-1 mr-2">
                                            <button type="submit" class="btn btn-outline-info mr-2">Search</button> {{ $rowsCount }}
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                                        <th width="11%" style="text-align:center;">Actions</th>
                                        <th width="5%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rows as $key => $row)
                                        @php
                                            $logs = \App\Models\LogOfModifiedMd::select(['company_log.id as logId', 'uss.name as admin', 'company_log.action as lastModified', 'company_log.created as lastUpdated'])
                                                ->leftJoin('users as uss', 'company_log.user', '=', 'uss.id')
                                                ->where(['company_log.company' => $row->id])
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
                                            if ($row->logo != '') {
                                                $design = 'success';
                                                $iconDs = 'fa-check';
                                            } else {
                                                $design = 'danger';
                                                $iconDs = 'fa-times';
                                            }
                                            $item = $rows->firstItem();
                                        @endphp
                                        <tr role="row" class="odd" data-row="{{ $key + 1 }}"
                                            data-id="{{ $row->id }}">
                                            <td data-label="No.">
                                                <span class="no">{{ $item + $key }}</span>
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $image = !empty($row->logo) ? str_replace('.', '-xs.', $row->logo) : 'img/no-image.png';
                                                @endphp
                                                <img src="{{ $image }}" class="img-thumbnail"
                                                    style="width:95px; border-radius: 50% !important;">
                                            </td>
                                            <td class="text-left">
                                                <span class="badge badge-secondary mr-1">
                                                    <i class="fas fa-language fa-lg text-primary"></i> Thai
                                                </span>
                                                {{ $row->name_th }}
                                                @if ($row->type == 'basic')
                                                    <strong class="badge badge-info">
                                                        <i class="far fa-file-alt"></i>
                                                        {{ strtoupper($row->type) }}
                                                    </strong>
                                                @endif
                                                @if ($row->mail == 1)
                                                    <strong class="badge badge-primary">
                                                        MAIL
                                                    </strong>
                                                @else
                                                    <strong class="badge badge-danger">
                                                        NOT MAIL
                                                    </strong>
                                                @endif
                                                <br>
                                                <span class="badge badge-secondary mr-1"><i
                                                        class="fas fa-language fa-lg text-primary"></i>
                                                    Japanese</span>{{ $row->name_jp }}<br>
                                                {{-- <a href="{{$prefix}}/{{$folder}}/{{request()->segment(3)}}/statistics/{{$row->id}}" class="btn btn-outline-info btn-sm" style="max-width:50px; margin:auto;"><i class="fas fa-chart-line fa-lg"></i></a> --}}
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
                                                    <span class="badge badge-orange"><i class="fas fa-check"></i>
                                                        Checked</span>
                                                @endif
                                                @if ($row->refuseDate)
                                                    <span class="badge badge-danger">
                                                        REFUSE</span>
                                                @endif
                                                <br />
                                            </td>
                                            <td data-label="Created :">
                                                <a class="badge badge-primary font-weight-bold text-white"
                                                    style="font-size: 12px;"># {{ $row->categoryName }}</a>
                                                <a class="badge badge-secondary">Refuse Date:
                                                    {{ date('d-M-Y H:i', strtotime($row->refuseDate)) }}</a>
                                            </td>
                                            <td data-label="Last update :">
                                                @if ($logs->count() > 0)
                                                    @foreach ($logs as $kl => $log)
                                                        •<span class="text-warning"
                                                            style="font-weight:bold; font-size:12px; padding:2px;">{{ $log->admin }}</span>-
                                                        <small><span>{{ date('d-M-y, H:i', strtotime($log->lastUpdated)) }}</span></small>
                                                        <p style="font-size: 11px;line-height:1.2;padding:0;margin:0;">
                                                            {{ $log->lastModified }}</p>
                                                    @endforeach
                                                    @else{{ $row->updated_by }}
                                                @endif
                                            </td>
                                            <td data-label="Actions :" style="display: flex; justify-content:center;">
                                                <a href="{{ url("webpanel/members/$row->_id/$row->id") }}"
                                                    class="btn btn-info btn-sm p-2 mr-1">Edit</a>
                                            </td>
                                            <td>
                                                <label class="c-switch c-switch-label c-switch-pill c-switch-success">
                                                    <input class="c-switch-input status" type="checkbox"
                                                        data-id="{{ $row->id }}"
                                                        @if ($row->public == 1) checked @endif>
                                                    <span class="c-switch-slider" data-checked="On"
                                                        data-unchecked="Off"></span>
                                                </label>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="d-none d-sm-block d-xs-none d-sm-none">
                                <div class="d-flex justify-content-center p-2">
                                    {{ $rows->links() }}
                                </div>
                            </div>
                            <p class="text-center text-danger"><strong>This page took :
                                </strong>{{ round(microtime(true) - LARAVEL_START, 2) }}s</p>
                        </div>
                    </div>
                </div>
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
</script>
<script>
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
                Swal.fire({
                    position: 'top',
                    icon: 'success',
                    title: 'Success',
                    showConfirmButton: false,
                    timer: 1000
                })
            },
            error: function(){
                Swal.fire({
                    position: 'top',
                    icon: 'error',
                    title: 'Fail',
                    showConfirmButton: false,
                    timer: 1000
                })
                cur.prop('disabled', true);
            }
        });
    })
</script>
