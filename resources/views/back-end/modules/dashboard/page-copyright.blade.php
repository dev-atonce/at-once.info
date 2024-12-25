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
</style>

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header py-2 px-3">
                    <span class="breadcrumb-item "><a href="jacascript:">Copyright</a></span>
                    <div class="card-header-actions"><small class="badge badge-secondary"><a target="_blank"
                                href="@if (Request::get('datereturn') ||
                                        Request::get('keyword') ||
                                        Request::get('category') ||
                                        Request::get('basic') ||
                                        Request::get('sale')) {{ Request::fullUrl() }}&export=1 @else{{ Request::fullUrl() }}?export=1 @endif">
                                <i class="fas fa-file-export"></i>Export .csv</a></small></div>
                    <div class="card-header-actions mr-2"><small class="badge badge-secondary"><a target="_blank"
                                href="webpanel/copyright-all">
                                <i class="fas fa-file-export"></i>Export All .csv</a></small></div>
                </div>
                <div class="card-body">
                    <form class="mb-3">
                        <div class="form-row">
                            <div class="col-2">
                                <input type="text" class="form-control" name="keyword" placeholder="Keyword"
                                    value="{{ Request::get('keyword') }}">
                            </div>
                            <div class="col-1">
                                <label class="form-control text-danger" for="basic">
                                    <input type="checkbox" name="basic" id="basic" value="1"
                                        @if (Request::get('basic') == '1') checked @endif> Basic
                                </label>
                            </div>
                            <div class="col-1">
                                <label class="form-control text-danger" for="sale">
                                    <input type="checkbox" name="sale" id="sale" value="1"
                                        @if (Request::get('sale') == '1') checked @endif> Exported
                                </label>
                            </div>
                            <div class="col-2">
                                <select class="form-control" id="category" name="category">
                                    <option value="">Category</option>
                                    @php
                                        $category = \App\Models\CategoryMd::select('id', 'name_jp')
                                            ->where('status', 1)
                                            ->orderBy('name_jp')
                                            ->get();
                                    @endphp
                                    @foreach ($category as $k => $cate)
                                        <option @if (Request::get('category') == $cate->id) selected @endif
                                            value="{{ $cate->id }}">{{ $cate->name_jp }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-2">
                                <input type="text" class="form-control" name="datereturn"
                                    placeholder="Date Copyright Return" value="{{ Request::get('datereturn') }}">
                            </div>
                            <div class="col-1">
                                <button type="submit" class="btn btn-primary mb-2">Search</button> {{ $rowsCount }}
                            </div>
                        </div>
                    </form>
                    <div class="row">
                        <div class="table-responsive">
                            <table class="table table-striped no-footer table-res" id="sort_table" role="grid"
                                style="border-collapse: collapse !important">
                                <thead>
                                    <tr role="">
                                        <th class="text-center" width="5%">#</th>
                                        <th class="text-center" width="10%"></th>
                                        <th width="70%">Company</th>
                                        <th class="text-center">Sale By</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $item = $rows->firstItem();
                                    @endphp
                                    @foreach ($rows as $key => $row)
                                        <tr role="row" class="odd" data-row="{{ $key + 1 }}"
                                            data-id="{{ $row->id }}">
                                            <td class="text-center">
                                                <span class="no">{{ $item + $key }}</span>
                                            </td>
                                            <td class="text-center">
                                                @php
                                                    $image = !empty($row->logo)
                                                        ? str_replace('.', '-xs.', $row->logo)
                                                        : 'img/no-image.png';
                                                @endphp
                                                <img src="{{ $image }}" class="img-thumbnail"
                                                    style="width:95px; border-radius: 50% !important;">
                                            </td>
                                            <td>
                                                <div class="text-left d-flex justify-content-between">
                                                    <div>
                                                        <span class="badge badge-secondary mr-1"><i
                                                                class="fas fa-language fa-lg text-primary"></i>Thai</span>{{ $row->name_th }}
                                                        @if ($row->type == 'basic')
                                                            <strong class="badge badge-info"><i
                                                                    class="far fa-file-alt"></i>{{ strtoupper($row->type) }}</strong>
                                                        @endif
                                                        <br>
                                                        <span class="badge badge-secondary mr-1"><i
                                                                class="fas fa-language fa-lg text-primary"></i>Japanese</span>{{ $row->name_jp }}<br>
                                                        <a class="badge badge-primary font-weight-bold text-white"
                                                            style="font-size: 12px;"># {{ $row->categoryName }}</a>
                                                        @if ($row->reason != '')
                                                            <span class="text-danger"
                                                                style="font-weight: 500">Reason:&nbsp;{{ $row->reason }}</span>
                                                        @endif
                                                    </div>
                                                    <div
                                                        class="d-flex justify-content-center align-items-center flex-column">
                                                        @php
                                                            $users = \App\Models\UsersMd::find($row->upload_by);
                                                        @endphp
                                                        <div>
                                                            @if ($row->license_attachfile != '')
                                                                <a href="{{ $row->license_attachfile }}"
                                                                    target="_blank"><i class="far fa-file-pdf"
                                                                        style="font-size: 18px; color:red"></i></a>
                                                            @endif
                                                        </div>
                                                        @if ($row->upload_by != '')
                                                            <div>
                                                                <small style="color: #bababa">
                                                                    <i class="fas fa-user-circle"></i>
                                                                    {{ $users->name }}</small>
                                                            </div>
                                                        @endif
                                                        <div>
                                                            @if ($row->license_attachfile != '')
                                                                <span
                                                                    class="badge badge-info">{{ date('d-M-Y H:i:s', strtotime($row->attachfile)) }}</span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div
                                                    class="d-flex justify-content-center align-items-center flex-column">
                                                    @if ($row->sale_by)
                                                        <div>
                                                            <small style="color: #bababa"><i
                                                                    class="fas fa-user-circle"></i>
                                                                {{ $row->sale_by }}</small>
                                                        </div>
                                                        <div>
                                                            <span
                                                                class="badge badge-warning">{{ date('d-M-Y H:i:s', strtotime($row->export_date)) }}</span>
                                                        </div>
                                                    @else
                                                        -
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center align-items-center">
                                {{ $rows->links() }}
                            </div>
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
    $('input[name="datereturn"]').daterangepicker({
        autoUpdateInput: false,
    }).on('apply.daterangepicker', function(ev, picker) {
        $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
    });
</script>
