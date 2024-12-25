<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="fade-id">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="breadcrumb-item active">
                        <a
                            href="{{ $segment == 'email-reject' ? $prefix . '/' . $segment : $prefix . '/' . $segment }}">{{ $segment == 'email-reject' ? 'Email Reject' : 'Email Approve' }}</a>
                    </span>
                </div>
                <div class="card-body">
                    <div class="card p-3">
                        <form method="get">
                            <div class="row">
                                <div class="col-lg-2">
                                    <div class="form-group">
                                        <label for="keyword">Keyword:</label>
                                        <input type="text" name="keywords" id="keywords" class="form-control"
                                            value="{{ Request::get('keywords') }}">
                                    </div>
                                </div>
                                @if ($segment == 'email-reject')
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="keyword">Reject By:</label>
                                            <select name="rejectby" id="rejectby" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($userAction as $k => $v)
                                                    <option value="{{ $v->id }}"
                                                        @if (Request::get('rejectby') == $v->id) selected @endif>
                                                        {{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <label for="keyword">Person In Charge:</label>
                                            <select name="cs" id="cs" class="form-control">
                                                <option value="">Select</option>
                                                <option value="11"
                                                    @if (Request::get('cs') == '11') selected @endif>Bum
                                                </option>
                                                <option value="50"
                                                    @if (Request::get('cs') == '50') selected @endif>May
                                                </option>
                                                <option value="51"
                                                    @if (Request::get('cs') == '51') selected @endif>Banana
                                                </option>
                                                <option value="52"
                                                    @if (Request::get('cs') == '52') selected @endif>Ball
                                                </option>
                                                <option value="53"
                                                    @if (Request::get('cs') == '53') selected @endif>Yoyo
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                @endif
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
                                    <button type="submit" class="btn btn-primary" style="margin-top: 30px">
                                        <i class="fas fa-search fa-fw"></i>Search</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <h3>{{ $segment == 'email-reject' ? 'Email Reject' : 'Email Approve' }}</h3>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped no-footer table-res" id="sort_table" role="grid"
                                style="border-collapse: collapse !important">
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        @if ($segment == 'email-approve')
                                            <th>
                                                <div class=d-flex><input type="checkbox" class="checkAll"><i
                                                        class="fas fa-long-arrow-alt-down ml-1"></i></div>
                                            </th>
                                        @endif
                                        <th>ส่งถึงบริษัท</th>
                                        <th>จากบริษัท</th>
                                        <th>ชื่อผู้ส่ง</th>
                                        <th>แผนก</th>
                                        <th>เบอร์โทรศัพท์</th>
                                        <th>ส่งจากอีเมล์</th>
                                        <th>รายละเอียดที่ต้องการติดต่อ</th>
                                        @if ($segment == 'email-reject')
                                            <th>Message Reject</th>
                                            <th>Reject By</th>
                                            <th>Person in Charge</th>
                                        @endif
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($rows)
                                        @foreach ($rows as $key => $row)
                                            <tr role="row" class="odd" data-row="{{ $key + 1 }}"
                                                data-id="{{ $row->id }}">
                                                <td hidden class="to">{{ $row->to }}</td>
                                                <td hidden class="attachment">{{ $row->attachment }}</td>
                                                <td hidden class="subject">{{ $row->subject }}</td>
                                                <td hidden class="cc">{{ $row->cc }}</td>

                                                @if ($segment == 'email-reject')
                                                    <td>{{ $row->updated }}</td>
                                                @else
                                                    <td>{{ $row->created }}</td>
                                                    <td><input type="checkbox" name="checkMail" id="checkMail"
                                                            class="checkMail" value="{{ $row->id }}"></td>
                                                @endif
                                                <td class="to_company">{{ $row->to_company }}<br><span
                                                        class="badge badge-primary"># {{ $row->categoryName }}</span>
                                                </td>
                                                <td class="company">{{ $row->company }}</td>
                                                <td class="name">{{ $row->name }}</td>
                                                <td class="department">{{ $row->department }}</td>
                                                <td class="telephone">{{ $row->telephone }}</td>
                                                <td class="email">{{ $row->email }}</td>
                                                <td class="content">{{ $row->content }}</td>
                                                @if ($segment == 'email-approve')
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <button type="button" class="btn btn-info mr-1"
                                                                data-action="submit">SEND</button>
                                                            <button type="button" class="btn btn-danger mr-1"
                                                                data-action="reject">REJECT</button>
                                                            <button type="button" class="btn btn-warning revisebtn"
                                                                data-action="revise">REVISE</button>
                                                        </div>
                                                    </td>
                                                @endif
                                                @if ($segment == 'email-reject')
                                                    <td>{{ $row->message_reject }}</td>
                                                    <td><i class="fas fa-user-circle"></i> {{ $row->reject_name }}
                                                    </td>
                                                    @php($cs = \App\Models\UsersMd::find($row->cs_reject))
                                                    <td>
                                                        <i class="fas fa-user-circle"></i> {{ @$cs->name }}
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <button type="button" class="btn btn-danger mr-1"
                                                                data-action="restore">Restore</button>
                                                        </div>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $rows->links() }}
                        </div>
                    </div>
                </div>
                @if ($segment == 'email-approve')
                    <div class="p-3" style="background-color: #eee">
                        <button type="button" class="btn btn-danger reject-list mr-1" disabled>REJECT SELECT</button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="modalemail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Revise Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Send By:</label>
                        <input type="hidden" name="_id" value="">
                        <input readonly type="text" class="form-control" name="name" id="name"
                            data-id="{{ Auth::user()->id }}" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Send to CS:</label>
                        <select class="form-control" name="sendto" id="sendto" required>
                            <option value="" selected="true" disabled="disabled">Select User</option>
                            <option value="11">Bum</option>
                            <option value="50">May</option>
                            <option value="51">Banana</option>
                            <option value="52">Ball</option>
                            <option value="53">Yoyo</option>
                            <option value="56">Luknam</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" name="message" id="message" required></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary revisemail">Revise</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="modalsendemail" tabindex="-1" role="dialog" aria-labelledby="modalsendemail"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Confirm Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Send By:</label>
                        <input type="hidden" name="id" value="">
                        <input type="hidden" name="to" value="">
                        <input type="hidden" name="attachment" value="">
                        <input type="hidden" name="subject" value="">
                        <input type="hidden" name="cc" value="">
                        <input type="hidden" name="to_company" value="">
                        <input type="hidden" name="company" value="">
                        <input type="hidden" name="name" value="">
                        <input type="hidden" name="department" value="">
                        <input type="hidden" name="telephone" value="">
                        <input type="hidden" name="email" value="">
                        <input type="hidden" name="content" value="">
                        <input readonly type="text" class="form-control" name="from_id" id="from_id"
                            data-id="{{ Auth::user()->id }}" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Send to CS:</label>
                        <select class="form-control" name="sendto" id="sendto" required>
                            <option value="" selected="true" disabled="disabled">Select User</option>
                            <option value="11">Bum</option>
                            <option value="50">May</option>
                            <option value="51">Banana</option>
                            <option value="52">Ball</option>
                            <option value="53">Yoyo</option>
                            <option value="56">Luknam</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary confirmemail">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalreject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalreject">Reject Mail</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="hidden" id="id" name="id">
                        <label for="recipient-name" class="col-form-label">Reject By:</label>
                        <input readonly type="text" class="form-control" name="from_id" id="from_id"
                            data-id="{{ Auth::user()->id }}" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="status" class="col-form-label">Send to CS:</label>
                        <select class="form-control" name="sendto" id="sendto" required>
                            <option value="" selected="true" disabled="disabled">Select User</option>
                            <option value="11">Bum</option>
                            <option value="50">May</option>
                            <option value="51">Banana</option>
                            <option value="52">Ball</option>
                            <option value="53">Yoyo</option>
                            <option value="56">Luknam</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message" name="message"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger confirmreject">Reject</button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script>
    let lang = '{{ Session('lang') }}',
        hl = (lang == 'th') ? 0 : 1;
    let url = window.location,
        category = url.pathname.split('/')[2];

    $(document).on('click', 'button[data-action="revise"]', function() {
        let currentRow = $(this).closest("tr");
        let modal = $('#modalemail');
        modal.find('input[name="_id"]').val(currentRow.attr('data-id'));
        modal.find('select[name="sendto"]').val('');
        modal.find('textarea[name="message"]').val('');
        modal.modal('show');
    })

    $(document).on('click', 'button[data-action="reject"]', function() {
        let currentRow = $(this).closest("tr");
        let modal = $('#modalreject');
        modal.find('input[name="id"]').val(currentRow.attr('data-id'));
        modal.find('textarea[name="message"]').val('');
        modal.modal('show');
    })

    $(document).on('click', 'button[data-action="restore"]', function() {
        let fd = new FormData();
        let currentRow = $(this).closest("tr");
        $(this).prop('disabled', true);
        fd.append('id', currentRow.attr('data-id'))
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            url: '/webpanel/restoremail/cs',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success: (res) => {
                if (res == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Restore Success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Restore Failed !',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        })
    })

    $(document).on('click', 'button.revisemail', function() {
        let fd = new FormData();
        let modal = $('#modalemail');
        $(this).prop('disabled', true);
        fd.append('_id', modal.find('input[name="_id"]').val());
        fd.append('from_id', modal.find('input[name="name"]').attr('data-id'));
        fd.append('to_id', modal.find('#sendto').find(":selected").val());
        fd.append('message', modal.find('textarea[name="message"]').val());
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            method: 'post',
            url: '/webpanel/revisemail/cs',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            success: (res) => {
                if (res == true) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Revise Success',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        location.reload();
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Revise Failed !',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        $('button.revisemail').prop('disabled', false);
                    })
                }
            }
        })
    })

    $(document).on('click', 'button[data-action="submit"]', function() {
        let modal = $('#modalsendemail');
        let currentRow = $(this).closest("tr");
        modal.find('input[name="id"]').val(currentRow.attr('data-id'));
        modal.find('select[name="sendto"]').val('');
        modal.find('input[name="to_company"]').val(currentRow.find(".to_company").html());
        modal.find('input[name="to"]').val(currentRow.find(".to").html());
        modal.find('input[name="attachment"]').val(currentRow.find(".attachment").html());
        modal.find('input[name="subject"]').val(currentRow.find(".subject").html());
        modal.find('input[name="cc"]').val(currentRow.find(".cc").html());
        modal.find('input[name="company"]').val(currentRow.find(".company").html());
        modal.find('input[name="name"]').val(currentRow.find(".name").html());
        modal.find('input[name="department"]').val(currentRow.find(".department").html());
        modal.find('input[name="telephone"]').val(currentRow.find(".telephone").html());
        modal.find('input[name="email"]').val(currentRow.find(".email").html());
        modal.find('input[name="content"]').val(currentRow.find(".content").html());
        modal.modal('show');
    })

    $(document).on('click', 'button.confirmemail', function() {
        let fd = new FormData();
        let modal = $('#modalsendemail');
        $(this).prop('disabled', true);
        fd.append('from_id', modal.find('input[name="from_id"]').attr('data-id'));
        fd.append('to_id', modal.find('#sendto').find(":selected").val());
        fd.append('id', modal.find('input[name="id"]').val());
        fd.append('to_company', modal.find('input[name="to_company"]').val());
        fd.append('to', modal.find('input[name="to"]').val());
        fd.append('company', modal.find('input[name="company"]').val());
        fd.append('name', modal.find('input[name="name"]').val());
        fd.append('department', modal.find('input[name="department"]').val());
        fd.append('telephone', modal.find('input[name="telephone"]').val());
        fd.append('email', modal.find('input[name="email"]').val());
        fd.append('content', modal.find('input[name="content"]').val());
        fd.append('attachment', modal.find('input[name="attachment"]').val());
        fd.append('subject', modal.find('input[name="subject"]').val());
        fd.append('cc', modal.find('input[name="cc"]').val());

        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'webpanel/sendmail/cs',
            type: 'post',
            contentType: false,
            processData: false,
            async: false,
            data: fd,
            dataType: 'json',
            success: (response) => {
                Swal.fire({
                    title: "Send Success !",
                    icon: "success",
                    timer: 1500,
                    closeOnClickOutside: false,
                    showConfirmButton: false,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then(() => {
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
                }).then(() => {
                    $(this).prop('disabled', false);
                })
            }
        })
    })

    $(document).on('click', 'button.confirmreject', function() {
        let fd = new FormData();
        let modal = $('#modalreject');
        $(this).prop('disabled', true);
        fd.append('id', modal.find('input[name="id"]').val());
        fd.append('rejectby', modal.find('input[name="from_id"]').attr('data-id'));
        fd.append('to_id', modal.find('#sendto').find(":selected").val());
        fd.append('message', modal.find('textarea[name="message"]').val());
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: 'webpanel/rejectmail/cs',
            type: 'post',
            contentType: false,
            processData: false,
            async: false,
            data: fd,
            dataType: 'json',
            success: (response) => {
                Swal.fire({
                    title: "Reject Success !",
                    icon: "success",
                    timer: 1500,
                    closeOnClickOutside: false,
                    showConfirmButton: false,
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((re) => {
                    window.location = window.location.href;
                });
            },
            error: (response) => {
                Swal.fire({
                    title: "Failed Reject",
                    text: "Please Try Again Later !",
                    icon: "error",
                    timer: 1500,
                    closeOnClickOutside: false,
                    showConfirmButton: false,
                }).then(() => {
                    $('button.confirmreject').prop('disabled', false);
                })
            }
        })
    })

    $('#date').daterangepicker({
        autoUpdateInput: false,
        opens: 'left',
        locale: {
            format: 'YYYY/MM/DD'
        },
        cancelButtonClasses: 'btn-danger',
    });
    $('#date').on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));
    });
    $('.reset-date').on('click', function() {
        $(this).closest('.input-group').find('input').val('');
    });

    $(document).on('change', '.checkAll', function() {
        let checked = false;
        if ($(this).is(':checked')) checked = true;
        else checked = false;
        $('.checkMail').prop('checked', checked);
        disabled = (checked === true) ? false : true;
        $('.reject-list').prop('disabled', disabled)
    })

    $(document).on('change', '.checkMail', function() {
        if ($('.checkMail:checked').length <= 12) {
            let job = $('.checkMail:checked').map(function() {
                return $(this).val()
            }).get();
            disabled = (job.length > 0) ? false : true;
            $('.reject-list').prop('disabled', disabled);
        } else {
            $(this).prop('checked', false);
        }
    })

    $(document).on('click', '.reject-list', function() {
        let mail = $('.checkMail:checked').map(function() {
            return $(this).val()
        }).get();
        if (mail.length > 0) {
            let list = mail.join();
            let user = {{ Auth::user()->id }}
            Swal.fire({
                title: 'Reject',
                text: 'Confirm to Reject ?',
                icon: 'warning',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Confirm',
                cancelButtonColor: '#d33',
                preConfirm: (mail) => {
                    return fetch(`webpanel/rejectAllmail/cs?user=${user}&mail=${list}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error(response.statusText)
                            }
                            return response.json()
                        })
                        .catch(error => {
                            Swal.showValidationMessage(`Request failed: ${error}`);
                        })
                }
            }).then((res) => {
                if (res.isConfirmed) {
                    Swal.fire({
                        icon: res.value.icon,
                        title: res.value.text,
                        toast: true,
                        timer: 2000,
                        position: 'top',
                        showConfirmButton: false,
                        timerProgressBar: true
                    });
                    setTimeout(() => {
                        location.reload()
                    }, 2300);
                }
            });

        }
    })
</script>
