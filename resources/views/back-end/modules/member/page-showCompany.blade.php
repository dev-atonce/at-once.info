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
</style>
<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="breadcrumb-item "><a href="{{ url("$prefix$segment") }}">Company</a></span>
                    <span class="breadcrumb-item active">Add Form</span>
                    <div class="card-header-actions"><small class="text-muted"><a
                                href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small>
                    </div>
                </div>
                <div class="card-body text-right">
                    <div class="pb-2">
                        <a class="btn btn-primary btn-sm" href="{{ url("$prefix$segment/$member_id/add") }}">Create</a>
                    </div>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped no-footer table-res" id="sort_table" role="grid"
                                style="border-collapse: collapse !important">
                                <thead>
                                    <tr role="">
                                        <th width="5%">#</th>
                                        <th width="10%" style="text-align:center;">Logo</th>
                                        <th width="30%" style="text-align:left;">Company</th>
                                        <th width="15%" style="text-align:left;">Category</th>
                                        <th width="15%">Created</th>
                                        <th width="10%">Status</th>
                                        <th width="15%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($company)
                                        @php
                                            $item = $company->firstItem();
                                        @endphp
                                        @foreach ($company as $key => $row)
                                            <tr role="row" class="odd" data-row="{{ $key + 1 }}"
                                                data-id="{{ $row->id }}">
                                                <td data-label="No."><span class="no">{{ $item + $key }}</span> <i
                                                        class="fas fa-bars handle d-none"></i></td>
                                                <td class="text-center">
                                                    @php
                                                        $image = !empty($row->logo) ? $row->logo : 'img/no_image.webp';
                                                    @endphp
                                                    <img src="{{ $image }}" class="img-thumbnail">
                                                </td>
                                                <td class="text-left">
                                                    {{ $row->name_th }}
                                                </td>
                                                <td data-label="" style="text-align:left;">
                                                    {{ $row->category }}
                                                </td>
                                                <td data-label="Created :">
                                                    {{ date('d-M-Y H:i:s', strtotime($row->created)) }}</td>
                                                <td data-label="Status :">
                                                    <label
                                                        class="c-switch c-switch-label c-switch-pill c-switch-success">
                                                        <input class="c-switch-input status" type="checkbox"
                                                            data-id="{{ $row->id }}"
                                                            @if ($row->public == 1) checked @endif
                                                            @if (Auth::user()->role == 'developer' || Auth::user()->name == 'PAIR') @else disabled @endif><span
                                                            class="c-switch-slider" data-checked="On"
                                                            data-unchecked="Off"></span>
                                                    </label>
                                                    <div>
                                                        <p>Refuse:</p>
                                                        <label
                                                        class="c-switch c-switch-label c-switch-pill c-switch-danger">
                                                        <input class="c-switch-input refuse" type="checkbox"
                                                            data-id="{{ $row->id }}"
                                                            @if ($row->ct_refuse_date != '') checked @endif
                                                            @if (Auth::user()->role == 'developer' || Auth::user()->name == 'PAIR'|| Auth::user()->name == 'TUM') @else disabled @endif><span
                                                            class="c-switch-slider" data-checked="On"
                                                            data-unchecked="Off"></span>
                                                    </label>
                                                    </div>
                                                </td>
                                                <td data-label="Actions :">
                                                    <a href="{{ url("$prefix$segment/$row->_id/$row->id") }}"
                                                        class="btn btn-warning btn-sm" title="Edit"><i
                                                            class="far fa-edit"></i></a>
                                                    <a href="javascript:" class="btn btn-danger btn-sm deleteItem"
                                                        data-id="{{ $row->id }}" title="Delete"><i
                                                            class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            @if (Request::get('view') != 'all')
                                {{ $company->links() }}
                            @endif
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
<div class="modal fade" id="refuseModal" tabindex="-1" role="dialog" aria-labelledby="refuseModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Refuse</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Refuse By:</label>
                        <input type="hidden" name="cid" id="cid">
                        <input readonly type="text" class="form-control" name="id" id="id"
                            data-id="{{ Auth::user()->id }}" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="form-group">
                        <label for="message-text" class="col-form-label">Message:</label>
                        <textarea class="form-control" id="message" name="message"></textarea>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="mail" value="1" name="mail">
                        <label class="form-check-label badge badge-info" for="mail">Mail</label>
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="notmail" value="0" name="mail">
                        <label class="form-check-label badge badge-danger" for="notmail">Not Mail</label>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary confirmRefuse">Confirm</button>
            </div>
        </div>
    </div>
</div>
<script>
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
        let id = $('.ChkBox:checked').map(function() {
            return $(this).val()
        }).get();
        if (id.length > 0) {
            deleted(id)
        }
    })
    $('.deleteItem').on('click', function() {
        let data = {
            "id": $(this).data('id'),
            "msg": 'Delete From Members Page'
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
    $('.refuse').on('click', function() {
        let modal = $('#refuseModal');
        let cur = $(this)
        if (cur.is(':checked')) {
            modal.find('input[name="cid"]').val(cur.attr('data-id'));
            modal.find('#message').val('');
            modal.modal('show')
            modal.find('.confirmRefuse').on('click', function() {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    url: 'webpanel/members/company/refuse-handler',
                    method: 'post',
                    async: false,
                    data: {
                        id: cur.attr('data-id'),
                        uid: modal.find('input[name="id"]').attr('data-id'),
                        msg: modal.find('textarea[name="message"]').val(),
                        mail: modal.find('input[name="mail"]:checked').val()
                    },
                    success: function(res) {
                        modal.modal('hide')
                        Swal.fire({
                            title: "refuse Success !",
                            icon: "success",
                            timer: 1000,
                            closeOnClickOutside: false,
                            showConfirmButton: false,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        })
                    },
                    error: function() {
                        Swal.fire({
                            title: "refuse error !",
                            icon: "error",
                            timer: 1000,
                            closeOnClickOutside: false,
                            showConfirmButton: false,
                            willClose: () => {
                                clearInterval(timerInterval)
                            }
                        }).then(() => {
                            cur.prop('checked', false);
                        })
                    }
                });
            })
        } else {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                url: 'webpanel/members/company/refuse-handler',
                method: 'post',
                async: false,
                data: {
                    id: cur.attr('data-id'),
                },
                success: function(res) {
                    Swal.fire({
                        title: "Cancel refuse !",
                        icon: "success",
                        timer: 1000,
                        closeOnClickOutside: false,
                        showConfirmButton: false,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    })
                },
                error: function() {
                    Swal.fire({
                        title: "Cancel error !",
                        icon: "error",
                        timer: 1000,
                        closeOnClickOutside: false,
                        showConfirmButton: false,
                        willClose: () => {
                            clearInterval(timerInterval)
                        }
                    }).then(() => {
                        $(this).prop('checked', true);
                    })
                }
            });
        }
    })
</script>
