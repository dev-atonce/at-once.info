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
<div class="card">
    <div class="card-body">
        <div class="row">
            <div class="col-lg-6">
                <form action="">
                    <div class="input-group mb-3">
                        <input type="text" name="keyword" class="form-control" value="{{ Request::get('keyword') }}"
                            placeholder="Keyword">
                        <select name="group" class="form-control">
                            <option value="">Group By</option>
                            <option value="A" @if (Request::get('group') == 'A') selected @endif>A</option>
                            <option value="B" @if (Request::get('group') == 'B') selected @endif>B</option>
                            <option value="C" @if (Request::get('group') == 'C') selected @endif>C</option>
                            <option value="D" @if (Request::get('group') == 'D') selected @endif>D</option>
                            <option value="E" @if (Request::get('group') == 'E') selected @endif>E</option>
                            <option value="F" @if (Request::get('group') == 'F') selected @endif>F</option>
                        </select>
                        <select name="category" class="form-control">
                            <option value="">Categories</option>
                            @foreach ($catData as $i)
                                <option value="{{ $i->id }}" @if (Request::get('category') == $i->id) selected @endif>
                                    {{ $i->name_th }}
                                </option>
                            @endforeach

                        </select>
                        <input type="text" class="form-control" placeholder="Date" aria-label="Date" name="date"
                            id="date" autocomplete="off">
                        <div class="input-group-append"><button
                                class="btn btn-outline-secondary reset-date"type="button">Reset</button></div>
                        <div class="input-group-append">
                            <button class="btn btn-info" id="inputGroup-sizing-sm">Search</button>
                        </div>
                    </div>
                </form>
            </div>
            @php
                if (Request::get('group')) {
                    if (Request::get('keyword')) {
                        $filteredRows = array_filter($rows, function ($obj) {
                            return $obj->rank == Request::get('group') && (strpos($obj->categoryName, Request::get('keyword')) || strpos($obj->name_th, Request::get('keyword')) || strpos($obj->email, Request::get('keyword')) || (Request::get('keyword') == $obj->categoryName || Request::get('keyword') == $obj->name_th || Request::get('keyword') == $obj->email));
                        });
                    } else {
                        $filteredRows = array_filter($rows, function ($obj) {
                            return $obj->rank == Request::get('group');
                        });
                    }
                } else {
                    if (Request::get('keyword')) {
                        $filteredRows = array_filter($rows, function ($obj) {
                            return $obj->stClick > 0 && (strpos($obj->categoryName, Request::get('keyword')) || strpos($obj->name_th, Request::get('keyword')) || strpos($obj->email, Request::get('keyword')) || (Request::get('keyword') == $obj->categoryName || Request::get('keyword') == $obj->name_th || Request::get('keyword') == $obj->email));
                        });
                    } else {
                        $filteredRows = array_filter($rows, function ($obj) {
                            return $obj->stClick > 0;
                        });
                    }
                }
                $filteredRows = array_values($filteredRows);
                $count = count($filteredRows);
            @endphp
            <div class="col-lg-12">
                <h5 class="text-center">Ranking by Click {{ $count }}
                    {{-- @if (!Request::get('keyword'))
                        @if (Request::get('group') == 'A')
                            (A-{{ $rankAAmount }})
                        @elseif (Request::get('group') == 'B')
                            (B-{{ $rankBAmount }})
                        @elseif(Request::get('group') == 'C')
                            (C-{{ $rankCAmount }})
                        @elseif(Request::get('group') == 'D')
                            (D-{{ $rankDAmount }})
                        @else
                            ({{ $amount }})
                        @endif
                    @endif --}}

                </h5>
            </div>

            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th width="3%">#</th>
                                <th width="15%">Email</th>
                                <th width="10%">Category</th>
                                <th width="33%">Company</th>
                                <th class="text-center">IP Address</th>
                                <th width="8%" class="text-center">Ranking</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($filteredRows as $index => $val)
                                {{-- @if (Request::get('group') == $val->rank) --}}
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $val->to }}</td>
                                    <td><span class="badge badge-danger"># {{ $val->categoryName }}</span>
                                    </td>
                                    <td>[<strong>{{ $val->id }}</strong>]
                                        {{ $val->name_th }}
                                    </td>
                                    <td>
                                        @if ($val->ips->count() > 0)
                                            <ul class="ip-address">
                                                @foreach ($val->ips as $k => $v)
                                                    <li><a href="javascript:" class="ip-list" ip="{{ $v->ip }}"
                                                            data-id="{{ $val->id }}">{{ $v->ip }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </td>
                                    <td class="text-center font-weight-bolder">
                                        <span class="badge badge-dark p-2">
                                            @if ($val->rank != 'F')
                                                <i class="fas fa-crown"
                                                    style="@if ($val->rank == 'A') color:yellow; @elseif($val->rank == 'B') color:#E8E8E8; @elseif($val->rank == 'C') color:#F09766; @elseif($val->rank == 'D') color:#3DF700; @elseif($val->rank == 'E') color:black; @else color:#636F83; @endif"></i></i>
                                            @endif
                                            {{ $val->stClick }} {{ $val->rank }}
                                        </span>
                                        {{-- <span class="badge badge-secondary p-2"><i class="fas fa-crown"></i> B</span>
                                        <span class="badge badge-secondary p-2"><i class="fas fa-crown"></i> C</span>
                                        <span class="badge badge-secondary p-2"><i class="fas fa-crown"></i> D</span> --}}
                                    </td>
                                </tr>
                                {{-- @endif --}}
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
                        {{-- {{$paginate->links()}} --}}
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

    const ClicksData = (ip, id) => {
        const data = $.ajax({
            method: 'get',
            url: 'webpanel/web-traffic/get-clicks',
            async: false,
            data: {
                ip: ip,
                id: id
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
                    `<td><p class="text-url">${decodeURI(v.url)}</p></td>
                    <td>${v.clicks?.length}<a href="javascript:" class="badge badge-secondary ml-2 toggle-ul"><i class="fas fa-chevron-left"></i></a></td>`
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
        id = $(this).attr('data-id');
        if (ip || id) ClicksData(ip, id);
    })

    $(document).on('click', '.toggle-ul', function() {
        cur = $(this);
        cur.find('.fas').toggleClass('fa-chevron-left fa-chevron-down');
        cur.next().toggleClass('d-none d-block');
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
