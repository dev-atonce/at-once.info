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
                    <span class="breadcrumb-item "><a href="{{ url("$prefix$segment") }}">Delisted Company</a></span>
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
                                        <div class="form-group col-lg-1">
                                            <button type="submit" class="btn btn-outline-info">Search</button>
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
                                        <th>Reason</th>
                                        <th width="11%"></th>
                                        <th width="17%">Last Update</th>
                                        <th width="11%" style="text-align:center;">Actions</th>
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
                                                <a href="javascript:" class="badge badge-dark">Blacklist</a>
                                                <br>
                                                <span class="badge badge-secondary mr-1"><i
                                                        class="fas fa-language fa-lg text-primary"></i>
                                                    Japanese</span>{{ $row->name_jp }}<br>
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
                                                <br />
                                            </td>
                                            <td>
                                                @if ($row->reason != '')
                                                    <span
                                                        class="text-danger font-weight-bold">Reason:&nbsp;{{ $row->reason }}</span>
                                                @endif
                                                @php
                                                    $users = \App\Models\UsersMd::find($row->delisted_by);
                                                @endphp
                                                @if ($users != '')
                                                    <div><i class="fas fa-user-circle"></i> {{ @$users->name }}</div>
                                                @endif
                                            </td>
                                            <td data-label="Created :">
                                                <a class="badge badge-primary font-weight-bold text-white"
                                                    style="font-size: 12px;"># {{ $row->categoryName }}</a>
                                                <a class="badge badge-secondary">Created:
                                                    {{ date('d-M-Y H:i', strtotime($row->created)) }}</a>
                                                <a class="badge badge-secondary">Delisted:
                                                    {{ date('d-M-Y H:i', strtotime($row->deleted)) }}</a>
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
                                                <a href="javascript:" class="btn btn-info btn-sm restoreItem p-2 mr-1"
                                                    data-id="{{ $row->id }}">Restore</a>
                                                <a href="{{ url("webpanel/members/$row->_id/$row->id") }}"
                                                    class="btn btn-warning btn-sm p-2 mr-1">Edit</a>
                                                @if (Auth::user()->role == 'developer' || Auth::user()->role == 'super')
                                                    <a href="javascript:" class="btn btn-danger btn-sm deleteItem p-2"
                                                        data-id="{{ $row->id }}" title="Delete">Delete</a>
                                                @endif
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
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="restore" tabindex="-1" role="dialog" aria-labelledby="restore" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Restore</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Restore By:</label>
                        <input type="hidden" name="cid" id="cid">
                        <input readonly type="text" class="form-control" name="id" id="id"
                            data-id="{{ Auth::user()->id }}" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="message" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message" name="message"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary confirmRestore">Confirm</button>
            </div>
        </div>
    </div>
</div>
<script>
    var fullUrl = window.location.origin + '/webpanel/company';

    $('.restoreItem').on('click', function() {
        let modal = $('#restore');
        modal.find('input[name="cid"]').val($(this).attr('data-id'));
        modal.find('#message').val('');
        modal.modal('show')
    })

    $('.confirmRestore').on('click', function() {
        let fd = new FormData();
        let modal = $('#restore');
        fd.append('cid', modal.find('input[name="cid"]').val());
        fd.append('uid', modal.find('input[name="id"]').attr('data-id'));
        fd.append('msg', modal.find('textarea[name="message"]').val());
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'webpanel/company/restore',
            type: 'post',
            contentType: false,
            processData: false,
            async: false,
            data: fd,
            dataType: 'json',
            success: (response) => {
                if (response.status == 'success') {
                    Swal.fire({
                        title: "Restore Success !",
                        icon: "success",
                        timer: 1000,
                        closeOnClickOutside: false,
                        showConfirmButton: false,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then((re) => {
                        modal.modal('hide');
                        window.location = window.location.href;
                    });
                } else {
                    Swal.fire({
                        title: "Restore Fail !",
                        icon: "error",
                        timer: 1000,
                        closeOnClickOutside: false,
                        showConfirmButton: false,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                    console.log(response.status, response.msg);
                }
            }
        })
    })

    $('.deleteItem').on('click', function() {
        let id = $(this).attr('data-id');
        Swal.fire({
            title: "Delete data",
            text: "Do you want to Delete ?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            showLoaderOnConfirm: true,
            preConfirm: async () => {
                return await fetch(fullUrl + '/forceDelete?id=' + id)
                    .then(response => response.json())
                    .then(data => location.reload())
                    .catch(error => {
                        Swal.showValidationMessage(`Request failed: ${error}`)
                    })
            }
        });
    })
</script>
