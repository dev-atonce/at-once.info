<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<style>
    .ip-address {
        list-style-type: none;
        margin: 0;
        padding: 0 !important;
    }

    .cursor-pointer {
        cursor: pointer;
    }

    .dataTables_wrapper {
        display: block;
        position: relative;
    }

    div.dataTables_length select {
        min-width: 55px;
    }

    .sorting_1 {
        max-width: 200px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }

    .text-url {
        max-width: calc(45vw);
        overflow: hidden;
        margin-bottom: 0;
    }

    mark {
        background-color: #ff9632 !important;
    }
</style>
@php
    $firstItem = Request::get('skip') ? Request::get('skip') + 1 : 1;
    $lastPage = $allPage * $take;
    $previous = Request::get('start');
    $previous = $previous > $take ? $previous - $take : $take;
    $next = Request::get('start');
    $next = $next == $lastPage ? $lastPage : $next + $take;
    $notAllowCount = \App\Models\CsToCompany::join('company as cp', 'to_company.company', '=', 'cp.id')
        ->where('cp.allow', 'not-allow')
        ->count();
@endphp
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <form action="">
                    <div class="input-group mb-3">
                        <input type="text" name="keyword" class="form-control" value="{{ Request::get('keyword') }}"
                            placeholder="/th/package-promotion">
                        <select name="group" class="form-control">
                            <option value="">Group By</option>
                            <option value="allow" @if (Request::get('group') == 'allow') selected @endif>Allow</option>
                            <option value="not-allow" @if (Request::get('group') == 'not-allow') selected @endif>Not allow
                            </option>
                            <option value="changetorefuse" @if (Request::get('group') == 'changetorefuse') selected @endif>Change to
                                refuse</option>
                        </select>
                        <select name="type" class="form-control">
                            <option value="">Type</option>
                            <option value="basic" @if (Request::get('type') == 'basic') selected @endif>Basic</option>
                            <option value="basic" @if (Request::get('type') == 'full') selected @endif>Full</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Date" aria-label="Date" name="date"
                            id="date" autocomplete="off" value="{{Request::get('date')}}">
                        <div class="input-group-append"><button
                                class="btn btn-outline-secondary reset-date"type="button">Reset</button></div>
                        <div class="input-group-append">
                            <button class="btn btn-info" id="inputGroup-sizing-sm">Search</button>
                        </div>
                    </div>
                </form>
                {{-- <div class="input-group">
                    <input type="text" class="form-control" name="keyword" value="{{Request::get('keyword')}}">
                </div> --}}
            </div>
            <div class="col-lg-12">
                <strong class="text-success">Allow : {{ $allowCount }}</strong>,
                <strong class="text-danger ml-2">Not Allow : {{ $notAllowCount }}</strong>
            </div>
            <div class="col-lg-12">
                <h5 class="text-center">Identifiable</h5>
            </div>

            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th></th>
                                <th width="15%">Email</th>
                                <th width="10%">Category</th>
                                <th width="33%">Company</th>
                                <th width="17%" class="text-center">Allowed to use the data</th>
                                <th width="17%" class="text-center">Change To Refuse</th>
                                <th width="18" class="text-center">IP Address</th>
                                {{-- <th class="text-center">Clicks</th>
                                <th class="text-center">Pages view.</th> --}}
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rows as $key => $val)
                                @php($ips = \App\Models\ClicksMd::where('cookie', $val->id)->groupBy('ip')->get())
                                <tr>
                                    <td>{{ $firstItem + $key }}</td>
                                    <td>{{ $val->to }}</td>
                                    <td>{{ $val->categoryName }}</td>
                                    <td>
                                        <div>
                                            [<strong>{{ $val->id }}</strong>] {{ $val->name_th }} 
                                                @if ($val->type == 'basic')
                                                    <span class="badge badge-danger">{{ strtoupper($val->type) }}</span>
                                                @else
                                                    <span class="badge badge-success">{{ strtoupper($val->type) }}</span>
                                                @endif
                                        </div>
                                        @if ($val->allow_comment != '' || $val->type == 'basic')
                                        <div class="input-group mt-2">
                                            <input type="text" class="form-control" name="comment" id="comment" placeholder="Waiting For ..." @if($val->allow_comment) value="{{$val->allow_comment}}" style="color: red" disabled @endif>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-success save_comment" data-id="{{$val->id}}" type="button">Save</button>
                                                <button class="btn btn-outline-danger del_comment" data-id="{{$val->id}}" type="button">DEL</button>
                                            </div>
                                        </div>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @php($allowClass = $val->allow == 'allow' ? 'text-success' : 'text-danger')
                                        <strong
                                            class="{{ $allowClass }}">{{ ucfirst(str_replace('-', ' ', $val->allow)) }}</strong>
                                        @if ($val->allow == 'allow' || $val->allow == 'changetorefuse' || $val->allow == 'not-allow')
                                            - <span
                                                class="text-primary">{{ date('d F Y H:i:s', strtotime($val->allow_date)) }}</span><br>
                                            @if ($val->allow == 'allow')
                                                <label class="c-switch c-switch-label c-switch-pill c-switch-success">
                                                    <input class="c-switch-input status" type="checkbox"
                                                        data-id="{{ $val->id }}"
                                                        @if ($val->public == 1) checked @endif
                                                        @if (Auth::user()->name == 'HOCKY' ||
                                                                Auth::user()->name == 'PAIR' ||
                                                                Auth::user()->name == 'TUM' ||
                                                                Auth::user()->name == 'RYO' ||
                                                                Auth::user()->name == 'BANK') @else disabled @endif><span
                                                        class="c-switch-slider" data-checked="On"
                                                        data-unchecked="Off"></span>
                                                </label>
                                            @endif
                                            @if ($val->allow == 'not-allow')
                                                <label class="c-switch c-switch-label c-switch-pill c-switch-success">
                                                    <input class="c-switch-input refuse" type="checkbox"
                                                        data-id="{{ $val->id }}"
                                                        @if ($val->refuse != '') checked @endif
                                                        @if (Auth::user()->name == 'HOCKY' ||
                                                                Auth::user()->name == 'PAIR' ||
                                                                Auth::user()->name == 'TUM' ||
                                                                Auth::user()->name == 'RYO' ||
                                                                Auth::user()->name == 'BANK') @else disabled @endif><span
                                                        class="c-switch-slider" data-checked="On"
                                                        data-unchecked="Off"></span>
                                                </label>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @if ($val->allow == 'changetorefuse')
                                            @php($allowClass = $val->allow == 'changetorefuse' ? 'text-warning' : 'text-danger')
                                            <strong
                                                class="{{ $allowClass }}">{{ ucfirst(str_replace('-', ' ', $val->allow)) }}</strong>
                                            - <span
                                                class="text-primary">{{ date('d F Y H:i:s', strtotime($val->ct_refuse_date)) }}</span><br>
                                        @endif
                                        @if ($val->allow == 'allow' || $val->allow == 'changetorefuse')
                                            <label class="c-switch c-switch-label c-switch-pill c-switch-success">
                                                <input class="c-switch-input changerefuse" type="checkbox"
                                                    data-id="{{ $val->id }}"
                                                    @if ($val->allow == 'changetorefuse') checked @endif
                                                    @if (Auth::user()->name == 'HOCKY' ||
                                                            Auth::user()->name == 'PAIR' ||
                                                            Auth::user()->name == 'TUM' ||
                                                            Auth::user()->name == 'RYO' ||
                                                            Auth::user()->name == 'BANK') @else disabled @endif><span
                                                    class="c-switch-slider" data-checked="On"
                                                    data-unchecked="Off"></span>
                                            </label>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($ips->count() > 0)
                                            <ul class="ip-address">
                                                @foreach ($ips as $k => $v)
                                                    <li><a href="javascript:" class="ip-list"
                                                            ip="{{ $v->ip }}">{{ $v->ip }} -
                                                            [<b>{{ $v->cookie }}</b>]</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    {{-- <td> --}}
                                    {{-- @if ($ips->count() > 0)
                                    <ul class="ip-address">
                                        @foreach ($ips->get() as $k => $v)
                                        @php($ToDayClicks=\App\Models\ClicksMd::whereDate('created',date('Y-m-d'))->where('ip',$v->ip)->count())
                                        @php($AllClicks=\App\Models\ClicksMd::where('ip',$v->ip)->count())
                                        <li><span class="cursor-pointer" title="Today">{{$ToDayClicks}}</a> <span class="cursor-pointer" title="All clicks">[{{$AllClicks}}]</span></li>
                                        @endforeach
                                    </ul>
                                    @endif --}}
                                    {{-- </td> --}}
                                    {{-- <td> --}}
                                    {{-- @if ($ips->count() > 0)
                                    <ul class="ip-address">
                                        @foreach ($ips->get() as $k => $v)
                                        @php($TodayPV=\App\Models\ClicksMd::select("url")->where('ip',$v->ip)->whereDate('created',date('Y-m-d'))->groupBy('url')->pluck('url'))
                                        @php($AllPV=\App\Models\ClicksMd::where('ip',$v->ip)->groupBy('url')->pluck('url'))
                                        <li><span class="cursor-pointer">{{$TodayPV->count()}}</a> <span class="cursor-pointer">[{{$AllPV->count()}}]</span></li>
                                        @endforeach
                                    </ul>
                                    @endif --}}
                                    {{-- </td> --}}
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot></tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <p class="text-center mb-0">Page loding({{ round(microtime(true) - LARAVEL_START, 2) }}s)</p>
                <div class="form-inline d-flex justify-content-center">
                    <div class="input-group my-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">
                                <a class="prev-page" href="javascript:">&lt; Prev</a>
                            </label>
                        </div>
                        <select class="custom-select text-center paginate" all-page="{{ $allPage }}">
                            @for ($i = 0; $i < $allPage; $i++)
                                @php($val = $i == 0 ? 0 : $i * $take)
                                <option value="{{ $val }}" @if (Request::get('skip') == $val) selected @endif>
                                    {{ $i + 1 }}</option>
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
</div>

<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Pages view</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <h5 class="text-center text-primary ip-header">IP : <span class="this-ip"></span></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <table class="table-page-views table table-bordered">
                            <thead>
                                <tr>
                                    <th width="80%">Path</th>
                                    <th class="text-center">Clicks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="ip-norecord text-center">
                                    <td colspan="3">no record.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
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
                        <input type="checkbox" class="form-check-input" id="nomail" value="0" name="mail">
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

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>
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

    var thisUrl = 'webpanel/web-traffic';
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

    const ClicksData = (ip) => {
        const data = $.ajax({
            method: 'get',
            url: 'webpanel/web-traffic/get-clicks',
            async: false,
            data: {
                ip: ip
            }
        }).responseJSON;

        if (data.length > 0) {
            Modal = $('#staticBackdrop');
            Modal.find('tr:not(:eq(0))').remove();
            Modal.find('.ip-norecord').addClass('d-none')
            Modal.find('.this-ip').html(ip);
            data.map((v, k) => {
                tr = $('<tr></tr>');
                tds = $(
                    `<td><p class="text-url">${decodeURI(v.url)}</p></td><td>${v.clicks?.length}<a href="javascript:" class="badge badge-secondary ml-2 toggle-ul"><i class="fas fa-chevron-left"></i></a></td>`
                );
                ul = $('<ul class="d-none mb-0"></ul>')
                v.clicks.map((i) => {
                    ul.append(`<li>${i}</li>`);
                })
                ul.insertAfter(tds.find('.badge'));
                tr.append(tds);
                Modal.find('tbody').append(tr);
            })
            Modal.modal('show');
            searchText();
        }
    }

    $(document).on('click', '.ip-list', function() {
        ip = $(this).attr('ip');
        if (ip) ClicksData(ip);
    })
    $(document).on('click', '.toggle-ul', function() {
        cur = $(this);
        cur.find('.fas').toggleClass('fa-chevron-left fa-chevron-down');
        cur.next().toggleClass('d-none d-block');
    });
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

    $('.changerefuse').on('click', function() {
        const cur = $(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: 'webpanel/members/company/toRefuse',
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
                    url: 'webpanel/members/company/refuse',
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
                url: 'webpanel/members/company/refuse',
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

    $(document).on('click','button.save_comment', function(){
        let id = $(this).attr('data-id');
        let msg = $(this).closest('.input-group').find('input').val();
        let data =  {
                        id:id,
                        msg:msg
                    }
        Swal.fire({
            title: 'Save Comment ?',
            icon: 'warning',
            showLoaderOnConfirm: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Confirm',
            cancelButtonColor: '#d33',
            preConfirm: (job_progress) => {
                return fetch(`webpanel/web-traffic/save-comment`,{
                    method: "POST",
                    cache: "no-cache",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN" : "{{csrf_token()}}"
                        },
                    body: JSON.stringify(data),
                }).then(response => {
                    if (!response.ok) {
                        throw new Error(response.statusText)
                    }
                    return response.json()
                }).catch(error => {
                    Swal.showValidationMessage(`Request failed: ${error}`);
                })
            }
        }).then((res) => {
            if (res.isConfirmed) {
                $(this).closest('.input-group').find('input').css("color","red").prop('disabled', true);
            }
        });
    });

    $(document).on('click','button.del_comment', function(){
        let id = $(this).attr('data-id');
        Swal.fire({
            title: 'Delete Comment ?',
            icon: 'warning',
            showLoaderOnConfirm: true,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Confirm',
            cancelButtonColor: '#d33',
            preConfirm: (job_progress) => {
                return fetch(`webpanel/web-traffic/del-comment?id=${id}`)
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
                $(this).closest('.input-group').find('input').val('').css("color","").prop('disabled', false);
            }
        });
    });

    function searchText() {
        search = '{{ Request::get('keyword') }}';
        let searched = $('#staticBackdrop').find(".text-url");
        searched.each((k, v) => {
            if (search !== "") {
                re = new RegExp(search, "g"); // search for all instances
                if (re) {
                    text = $(v).html();
                    let newText = text.replace(re, `<mark>${search}</mark>`);
                    // console.log(newText);
                    $(v).html(newText);
                }
            }
        })

    }
</script>
