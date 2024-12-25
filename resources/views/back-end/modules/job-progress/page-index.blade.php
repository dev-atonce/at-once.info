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

    .custom-control-input:checked~.c-dark::before {
        border-color: #aaa !important;
        background-color: #aaa !important;
    }

    .fs-11 {
        font-size: 11px;
    }

    .ui-draggable .ui-draggable-handle {
        cursor: move;
    }
</style>

<div class="card">
    <div class="card-header">Job Progress</div>
    <div class="card-body">
        <div class="row">
            <div class="col-lg-12 col-xs-12">
                <div class="form-row">
                    <form action="" style="width: 100%">
                        <div class="form-row">
                            <div class="form-group col-lg-3">
                                <input type="text" name="keyword" class="form-control" placeholder="Keywords"
                                    value="{{ Request::get('keyword') }}">
                            </div>
                            <div class="form-group col-lg-1">
                                <label class="form-control text-danger" for="step1">
                                    <input type="checkbox" name="step1" id="step1" value="1"
                                        @if (Request::get('step1') == '1') checked @endif> Created
                                </label>
                            </div>
                            <div class="form-group col-lg-1">
                                <label class="form-control text-primary" for="step2">
                                    <input type="checkbox" name="step2" id="step2" value="1"
                                        @if (Request::get('step2') == 1) checked @endif> Edited
                                </label>
                            </div>
                            <div class="form-group col-lg-1">
                                <label class="form-control text-info" for="step3">
                                    <input type="checkbox" name="step3" id="step3" value="1"
                                        @if (Request::get('step3') == '1') checked @endif> Design
                                </label>
                            </div>
                            {{-- <div class="form-group col-lg-1">
                                <select name="createdby" id="createdby" class="form-control">
                                    <option value="">Create By</option>
                                    @if ($step1)
                                        @foreach ($step1 as $by1)
                                            <option @if (Request::get('createdby') == $by1->id) selected @endif
                                                value="{{ $by1->id }}">{{ $by1->by1 }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-lg-1">
                                <select name="editedby" id="editedby" class="form-control">
                                    <option value="">Edited By</option>
                                    @if ($step2)
                                        @foreach ($step2 as $by2)
                                            <option @if (Request::get('editedby') == $by2->id) selected @endif
                                                value="{{ $by2->id }}">{{ $by2->by2 }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-lg-1">
                                <select name="designby" id="designby" class="form-control">
                                    <option value="">Design By</option>
                                    @if ($step3)
                                        @foreach ($step3 as $by3)
                                            <option @if (Request::get('designby') == $by3->id) selected @endif
                                                value="{{ $by3->id }}">{{ $by3->by3 }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="form-group col-lg-1">
                                <select name="onlineby" id="onlineby" class="form-control">
                                    <option value="">Online By</option>
                                    @if ($step4)
                                        @foreach ($step4 as $by4)
                                            <option @if (Request::get('onlineby') == $by4->id) selected @endif
                                                value="{{ $by4->id }}">{{ $by4->by4 }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div> --}}
                            <div class="form-group col-lg-1">
                                <select name="category" id="category" class="form-control">
                                    <option value="">Category</option>
                                    @if ($category)
                                        @foreach ($category as $cat)
                                            <option @if (Request::get('category') == $cat->id) selected @endif
                                                value="{{ $cat->id }}">{{ $cat->name_jp }} / {{ $cat->name_th }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
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
                <table class="table" id="sort_table" role="grid" style="border-collapse: collapse !important">
                    <thead class="thead-dark">
                        <tr role="">
                            <th width="2%">#</th>
                            <th width="7%"></th>
                            <th width="35%">Company</th>
                            <th width="25%">Progress</th>
                            <th width="17%" style="text-align:left">Created</th>
                            <th width="5%">Status</th>
                            <th width="5%">Full/Basic</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($rows)
                            @php $item = $rows->firstItem(); @endphp
                            @foreach ($rows as $key => $row)
                                @php
                                    $by1 =
                                        $row->step1 == 1
                                            ? '<span class="fs-11"><i class="fas fa-check-circle"></i> ' .
                                                $row->by1 .
                                                '</span>'
                                            : '-';
                                    $by2 =
                                        $row->step2 == 1
                                            ? '<span class="fs-11"><i class="fas fa-check-circle"></i> ' .
                                                $row->by2 .
                                                '</span>'
                                            : '-';
                                    if ($row->step3 == 1) {
                                        $by3 =
                                            '<span class="fs-11"><i class="fas fa-check-circle"></i> ' .
                                            $row->by3 .
                                            '</span>';
                                    } elseif ($row->step3_by != '') {
                                        $by3 =
                                            '<span class="fs-11"><i class="far fa-circle"></i> ' .
                                            $row->by3 .
                                            '</span>';
                                    } elseif ($row->step3_by == '') {
                                        $disabled =
                                            Auth::user()->position == 2 ||
                                            Auth::user()->role == 'super' ||
                                            Auth::user()->id == 13
                                                ? ''
                                                : 'disabled=""';
                                        $by3 =
                                            '<div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="booking" class="custom-control-input booking" id="booking' .
                                            $row->id .
                                            '" value="' .
                                            $row->id .
                                            '" ' .
                                            $disabled .
                                            '>
                                                <label class="custom-control-label text-dark c-dark" for="booking' .
                                            $row->id .
                                            '">Booking</label>
                                            </div>';
                                    } else {
                                        $by3 = '-';
                                    }
                                    $by4 =
                                        $row->step4 == 1
                                            ? '<span class="fs-11"><i class="fas fa-check-circle"></i> ' .
                                                $row->by4 .
                                                '</span>'
                                            : '-';
                                    if (Auth::user()->position == 2 || Auth::user()->role == 'super') {
                                        $booking = '<label><input type="checkbok" class="form-control">Booking</label>';
                                    }
                                    $step3 =
                                        $row->step3_by == Auth::user()->id
                                            ? '<a class="badge badge-secondary text-primary ml-1" href="webpanel/members/' .
                                                $row->memberId .
                                                '/' .
                                                $row->company .
                                                '" target="_blank"><i class="fas fa-pen"></i></a>'
                                            : '';
                                    $step3 =
                                        Auth::user()->role == 'super' ||
                                        Auth::user()->role == 'developer' ||
                                        $row->step2 == 1
                                            ? '<a class="badge badge-secondary text-primary ml-1" href="webpanel/members/' .
                                                $row->memberId .
                                                '/' .
                                                $row->company .
                                                '" target="_blank"><i class="fas fa-pen"></i></a>'
                                            : '';
                                @endphp


                                <tr role="row" class="odd" data-row="{{ $key + 1 }}"
                                    data-id="{{ $row->id }}">
                                    <td data-label="No.">
                                        <span class="no">{{ $item + $key }}</span>
                                        <i class="fas fa-bars handle d-none"></i>
                                        @if ($row->company == '')
                                            @if (Auth::user()->role == 'developer' ||
                                                    Auth::user()->role == 'super' ||
                                                    Auth::user()->name == 'FUANG' ||
                                                    Auth::user()->name == 'TONG')
                                                <a class="badge badge-danger delete" href="javascript:"
                                                    id="{{ $row->id }}"><i class="fas fa-times"></i> Delete</a>
                                            @endif
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        @php
                                            $image = !empty($row->logo)
                                                ? str_replace('.', '-xs.', $row->logo)
                                                : 'img/no-image.png';
                                        @endphp
                                        <img src="{{ $image }}" class="img-thumbnail"
                                            style="width:75px; border-radius: 50% !important;">
                                    </td>
                                    <td class="text-left">
                                        @if ($row->profile_url != '' && $row->step3 == 1)
                                            <a href="{{ url('th') }}/preview/company-profile/{{ $row->company }}"
                                                target="_blank">
                                        @endif
                                        <span class="badge badge-secondary mr-1"><i
                                                class="fas fa-language fa-lg text-primary"></i>
                                            Thai</span>{{ $row->name_th }}
                                        @if ($row->type == 'basic')
                                            <span class="badge badge-info"><i class="far fa-file-alt">
                                                    BASIC</i></span>
                                        @endif
                                        <br>
                                        <span class="badge badge-secondary mr-1"><i
                                                class="fas fa-language fa-lg text-primary"></i>
                                            Japanese</span>{{ $row->name_jp }}<br>
                                        @if ($row->profile_url != '' && $row->step3 == 1)
                                            </a>
                                        @endif
                                        <span class="badge badge-secondary text-primary">#
                                            {{ $row->company }}</span>&nbsp;<a
                                            href="{{ url("/webpanel/company/$row->categoryKey") }}"
                                            class="badge badge-primary font-weight-bold text-white"
                                            style="font-size: 12px;"># {{ $row->categoryNameJP }}</a>
                                        @if ($row->refuse != '')
                                            <span class="badge badge-danger">REFUSE</span>
                                        @endif
                                        @if ($row->cannot_contact != '')
                                            <span class="badge badge-warning">Cannot Contact</span>
                                        @endif
                                        @if ($row->follow != '')
                                            <span class="badge badge-info">Follow</span>
                                        @endif
                                        @if ($row->no_response != '')
                                            <span class="badge badge-dark">No Response</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="row p-0">
                                            @php
                                                $createdClass = $row->step1 == 1 ? 'text-danger' : 'text-secondary';
                                                $editedClass = $row->step2 == 1 ? 'text-primary' : 'text-secondary';
                                                $designClass = $row->step3 == 1 ? 'text-info' : 'text-secondary';
                                                $onlineClass = $row->step4 == 1 ? 'text-success' : 'text-secondary';
                                            @endphp
                                            <div class="col-lg-3 col-xs-12 col-md-12 p-0 step1">
                                                <div class="card {{ $createdClass }}">
                                                    <div class="card-body mb-0 p-2 text-center">
                                                        <p class="mb-1" style="font-size:11px; font-weight:bold;">
                                                            CREATED</p>
                                                        {!! $by1 !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-xs-12 col-md-12 p-0 step2">
                                                <div class="card {{ $editedClass }}">
                                                    <div class="card-body mb-0 p-2 text-center">
                                                        <p class="mb-1" style="font-size:11px; font-weight:bold;">
                                                            EDITED</p>
                                                        {!! $by2 !!}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-xs-12 col-md-12 p-0 step3">
                                                <div class="card {{ $designClass }}">
                                                    <div class="card-body mb-0 p-2 text-center">
                                                        <p class="mb-1" style="font-size:11px; font-weight:bold;">
                                                            DESIGN{!! $step3 !!}</p>
                                                        {!! $by3 !!}
                                                        @if (Auth::user()->role == 'developer' && $row->step3_by != '')
                                                            <a class="badge badge-warning ml-1 remove-booking"
                                                                href="javascript:{{ $row->id }}"
                                                                data-id="{{ $row->id }}"><i
                                                                    class="fas fa-times"></i></a>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-3 col-xs-12 col-md-12 p-0 step4">
                                                <div class="card {{ $onlineClass }}">
                                                    <div class="card-body mb-0 p-2 text-center">
                                                        <p class="mb-1" style="font-size:11px; font-weight:bold;">
                                                            ONLINE</p>
                                                        {!! $by4 !!}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-label="Created :">
                                        {{ date('D, d-M-Y H:i', strtotime($row->created)) }}
                                    </td>
                                    <td data-label="Status :">
                                        @php($onlineAction = ($row->step1 == 1 && $row->step2 == 1 && $row->step3 == 1 && Auth::user()->role == 'super') || Auth::user()->name == 'NOT' || Auth::user()->name == 'NATTAWAT' || Auth::user()->name == 'BOOM' || Auth::user()->name == 'WIN' || Auth::user()->name == 'NAMFON' || Auth::user()->name == 'TANGMO' || Auth::user()->name == 'FERN' || Auth::user()->role == 'developer' ? '' : 'disabled=""')
                                        <label class="c-switch c-switch-label c-switch-pill c-switch-success">
                                            <input class="c-switch-input status" type="checkbox"
                                                data-id="{{ $row->company }}"
                                                @if ($row->public == 1) checked @endif
                                                {{ $onlineAction }}><span class="c-switch-slider" data-checked="On"
                                                data-unchecked="Off"></span>
                                        </label>
                                    </td>
                                    <td data-label="Status :">
                                        @php($basicAction = Auth::user()->role == 'super' || Auth::user()->name == 'NOT' || Auth::user()->name == 'WIN' || Auth::user()->name == 'BOOM' || Auth::user()->name == 'NATTAWAT' || Auth::user()->name == 'TANGMO' || Auth::user()->name == 'NAMFON' || Auth::user()->name == 'FERN' || Auth::user()->name == 'TANGMO' || Auth::user()->role == 'developer' ? '' : 'disabled=""')
                                        <label class="c-switch c-switch-label c-switch-pill  c-switch-danger ">
                                            <input class="c-switch-input basicStatus" type="checkbox"
                                                data-id="{{ $row->company }}"
                                                @if ($row->type == 'basic') checked @endif
                                                {{ $basicAction }}><span class="c-switch-slider" data-checked="Basi"
                                                data-unchecked="Full"></span>
                                        </label>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {{ $rows->links() }}
                </div>
                <div>
                    <p class="text-center text-danger"><strong>This page took :
                        </strong>{{ round(microtime(true) - LARAVEL_START, 2) }}s</p>
                </div>
            </div>
        </div>
    </div>
</div>

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
            success: (res) => {
                console.log(res);
            },
            error: (res) => {
                console.log(res);
            }
        });
    })
    $('.basicStatus').on('click', function() {
        const cur = $(this);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: 'webpanel/members/company/statusBasic',
            method: 'post',
            async: false,
            data: {
                id: cur.data('id')
            },
            success: (res) => {
                console.log(res);
            },
            error: (res) => {
                console.log(res);
            }
        });
    })
    $(document).on('click', '.booking', function() {
        const span = $('<span class="fs-11"><i class="far fa-circle"></i>&nbsp;</span>');
        const href = $(
            '<a target="_blank" class="badge badge-secondary text-primary ml-1"><i class="fas fa-pen"></i></a>'
        )
        $.ajax({
            method: 'get',
            url: 'webpanel/job-progress/booking',
            data: {
                id: $(this).val()
            },
            success: (res) => {
                if (res.booking === true) {
                    span.append(res.message);
                    href.attr('href', res.url);
                    $(this).closest('.custom-control').addClass('d-none');
                    $(this).closest('.card-body').append(span);
                    $(this).closest('.card-body').find('p').append(href);
                    $(this).closest('.custom-control').remove();
                } else {
                    $(this).prop('checked', false);
                    alert(res.message)
                }
            }
        })
    })
    $('.delete').on('click', function() {
        if (confirm('Confirm to delete?')) {
            const curr = $(this);
            $.ajax({
                method: 'get',
                url: 'webpanel/job-progress/delete',
                data: {
                    id: curr.attr('id')
                },
                success: function(res) {
                    if (res.message == 'deleted') {
                        location.reload();
                    } else {
                        alert('Something went wrong.');
                    }
                }
            })
        }
    })
    $('.remove-booking').on('click', function() {
        if (confirm('Confirm to delete design booking?')) {
            const curr = $(this);
            $.ajax({
                method: 'get',
                url: 'webpanel/job-progress/delete-booking',
                data: {
                    id: curr.attr('data-id')
                },
                success: function(res) {
                    if (res.message == 'deleted') {
                        location.reload();
                    } else {
                        alert('Something went wrong.');
                    }
                }
            })
        }
    })
</script>
