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

    .detail {
        position: relative;
    }

    .detail:before {
        content: '&nbsp;';
        visibility: hidden;
    }

    .detail span {
        position: absolute;
        left: 10px;
        right: 10px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media screen and (max-width:414px) {
        .pagination .page-link {
            padding: 10px !important;
        }
    }

    @media screen and (max-width:375px) {
        .pagination .page-link {
            padding: 8px !important;
        }
    }

    .status-contact a {
        padding: 5px
    }

    .status-contact i {
        font-size: 20px
    }
</style>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="breadcrumb-item "><a href="{{ url("$prefix$segment") }}">Mail History</a></span>
                    <span class="breadcrumb-item active">Add Form</span>
                    <div class="card-header-actions"><small class="text-muted"><a
                                href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small>
                    </div>
                </div>
                <div class="card-body">
                    <div class="card p-3">
                        <form method="get">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="keyword">Keyword:</label>
                                        <input type="text" name="keyword" id="keyword" class="form-control"
                                            value="{{ Request::get('keyword') }}">
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="keyword">Approve By:</label>
                                        <select name="approve_by" id="approve_by" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($appr_name as $k => $v)
                                                <option value="{{ $v->approve_by }}"
                                                    @if (Request::get('approve_by') == $v->approve_by) selected @endif>
                                                    {{ $v->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="keyword">Status:</label>
                                        <select name="status" id="status" class="form-control">
                                            <option value="">Select</option>
                                            <option value="send" @if (Request::get('status') == 'send') selected @endif>
                                                Sending</option>
                                            <option value="process" @if (Request::get('process') == 'send') selected @endif>On
                                                process</option>
                                            <option value="done" @if (Request::get('status') == 'done') selected @endif>
                                                Done</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="keyword">Person In Charge:</label>
                                        <select name="cs" id="cs" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($appr_name as $k => $v)
                                                <option value="{{ $v->approve_by }}"
                                                    @if (Request::get('approve_by') == $v->approve_by) selected @endif>
                                                    {{ $v->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <label for="keyword">Date:</label>
                                    <div class="input-group mb-3">
                                        <input type="text" class="form-control" placeholder="Date" aria-label="Date"
                                            name="date" id="date" autocomplete="off">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary reset-date"
                                                type="button">Reset</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="keyword">Sort:</label>
                                        <select name="sort" id="sort" class="form-control">
                                            <option value="latest" @if (Request::get('sort') == 'latest') selected @endif>
                                                Latest</option>
                                            <option value="asc" @if (Request::get('sort') == 'asc') selected @endif>A
                                                -
                                                Z (Email User)</option>
                                            <option value="desc" @if (Request::get('v') == 'desc') selected @endif>Z
                                                -
                                                A (Email User)</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-xs-12 text-right mb-3">
                                    <button type="button" class="btn btn-secondary export"><i
                                            class="fas fa-file-download fa-fw"></i>Export to .csv file</button>
                                    <button type="submit" class="btn btn-primary"><i
                                            class="fas fa-search fa-fw"></i>Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped no-footer table-res" id="sort_table" role="grid"
                                style="border-collapse: collapse !important">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Approve By</th>
                                        <th>Status</th>
                                        <th width="10%"">Username</th>
                                        <th width="15%"">User Details</th>
                                        <th width="30%">Detail of contact</th>
                                        <th>Person In Charge</th>
                                        <th>Company Details</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rows)
                                        @php
                                            $item = $rows->firstItem();
                                        @endphp
                                        @foreach ($rows as $key => $row)
                                            <tr role="row" class="odd" data-row="{{ $key + 1 }}"
                                                data-id="{{ $row->id }}">
                                                <td>{{ date('d-M-Y', strtotime($row->updated)) }}<br>{{ date('H:i:s', strtotime($row->updated)) }}
                                                </td>
                                                @php($name = \App\Models\UsersMd::find($row->approve_by))
                                                <td><i class="fas fa-user-circle"></i> {{ @$name->name }}</td>
                                                <td class="status-contact">
                                                    <a href="javacript:0"
                                                        @if ($row->status == 'send') class="badge badge-danger"><i class="fas fa-times-circle"></i>
                                                        @elseif ($row->status == 'process') class="badge badge-warning"><i class="fas fa-exclamation-circle"></i>
                                                        @elseif ($row->status == 'done') class="badge badge-success"><i class="fas fa-check-circle"></i> @endif
                                                        </a>
                                                </td>
                                                <td></i>{{ $row->name }}</td>
                                                <td>
                                                    <div><span class="badge badge-secondary">บริษัท:</span>
                                                        {{ $row->company }}</div>
                                                    <div><span class="badge badge-info">แผนก:</span>
                                                        {{ $row->department }}</div>
                                                    <div><span class="badge badge-warning">อีเมล์:</span>
                                                        {{ $row->email }}</div>
                                                    <div><span class="badge badge-primary">เบอร์:</span>
                                                        {{ $row->telephone }}</div>
                                                </td>
                                                <td><span>{{ $row->content }}</span></td>
                                                @php($cs = \App\Models\UsersMd::find($row->cs_id))
                                                <td><i class="fas fa-user-circle"></i> {{ @$cs->name }}</td>
                                                <td>
                                                    <div><span class="badge badge-secondary">บริษัท:</span>
                                                        {{ $row->to_company }}</div>
                                                    <div><span class="badge badge-warning">อีเมล์:</span>
                                                        {{ $row->to }}</div>
                                                    <div><span class="badge badge-primary">เบอร์:</span>
                                                        {{ $row->company_tel }}</div>
                                                </td>
                                                <td data-label="Actions :">
                                                    <a href="javascript:" class="btn btn-info btn-sm show-modal"
                                                        data-id="{{ $row->id }}"
                                                        data-company="{{ $row->cid }}" title="View">
                                                        <i class="fas fa-search"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="float-right">
                            @if (!empty($rows))
                                <strong>พบข้อมูลมูลทั้งหมด {{ $rows->total() }} รายการ</strong> หน้า
                                {{ $rows->currentPage() }} / {{ $rows->lastPage() }}
                            @endif
                            @if (Request::get('view') != 'all' && !empty($rows))
                                {{ $rows->onEachSide(1)->links() }}
                            @endif
                        </div>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update status</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-contact">

                </div>
                <div class="remark-cs">

                </div>
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Send:</label>
                        <input readonly type="text" class="form-control" name="name" id="name"
                            data-id="{{ Auth::user()->id }}" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Status:</label>
                        <select class="form-control" name="status" id="status">
                            <option value="process">On process</option>
                            <option value="done">Done</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" name="remark" id="remark" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary update-status">Update</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    $(document).on('click', '.show-modal', function() {
        cur = $(this);
        modal = $('#modal-status');
        id = cur.attr('data-id')
        cid = cur.attr('data-company')

        modal.find('textarea#remark').val('');
        modal.find('.remark-cs').html('').removeClass('border-bottom');
        modal.find('.modal-contact').html('').removeClass('border-bottom');

        fd = new FormData();
        fd.append('_id', id);

        $.ajax({
            method: 'get',
            url: `/webpanel/company/lastcontact?id=${cid}`,
            contentType: false,
            processData: false,
            async: false,
            success: (res) => {
                if (res.length > 0) {
                    item = $(`<span class="mb-2" style="font-size: 16px; font-weight:600">ข้อมูลการติดต่อ</span>\
                    <p class="mb-2">\
                    •<span class="text-info" style="font-weight:bold; font-size:12px; padding:2px;">${res[0].name}</span>,\
                    <span class="ml-1">${res[0].created}</span>,\
                    <span class="ml-1">${res[0].action}</span>\
                    </p>`);
                    modal.find('.modal-contact').append(item).addClass('border-bottom');
                }
            }
        })

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            url: '/webpanel/get-remark/cs',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success: (res) => {
                if (res != '') {
                    $.each(res, function(k, v) {
                        let item = $('<div class="mb-2 mt-2">•<span class="name-remark text-warning" style="font-weight:bold; font-size:12px; padding:2px;"></span>,\
                                    <span class="time-remark"></span>\
                                    <span class="text-remark"></span>\
                                    </div>')
                        item.find('span.name-remark').html(v.name);
                        item.find('span.time-remark').html(v.created + ' : ');
                        item.find('span.text-remark').html(v.remark);
                        $('.remark-cs').append(item).addClass('border-bottom');
                    })
                }
            }
        })
        modal.modal('show');
    })
    $(document).on('click', 'button.update-status', function() {
        fd = new FormData();
        fd.append('uid', modal.find('input[name="name"]').attr('data-id'));
        fd.append('remark', modal.find('textarea#remark').val());
        fd.append('status', modal.find('#status').find(":selected").val());
        fd.append('_id', id);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            url: '/webpanel/update-status/cs',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success: (res) => {
                if (res == true) {
                    Swal.fire({
                        position: 'top',
                        icon: 'success',
                        title: 'Your status has been saved',
                        showConfirmButton: false,
                        timer: 1000
                    }).then(() => {
                        location.reload();
                    })
                }
            }
        })
    })

    range = '{{ Request::get('date') }}';
    range = (range != '') ? range.split('-') : '';
    start = (range.length > 0) ? range[0].trim() : '';
    end = (range.length > 0) ? range[1].trim() : '';

    $('#date').daterangepicker({
        autoUpdateInput: false,
        opens: 'left',
        locale: {
            format: 'YYYY/MM/DD'
        },
        cancelButtonClasses: 'btn-danger',
        startDate: (range.length > 0) ? range[0] : false,
        endDate: (range.length > 0) ? range[1] : false,
    });
    $('#date').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
    });
    $('.reset-date').on('click', function() {
        $(this).closest('.input-group').find('input').val('');
    });

    $('button.export').on('click', function() {
        let search = window.location.search;
        let path = window.location.pathname
        window.open(path + '/export' + search);
    })
</script>
