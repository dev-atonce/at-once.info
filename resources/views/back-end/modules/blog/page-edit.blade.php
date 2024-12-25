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
    }

    #tree>ul {
        padding-top: 10px;
    }

    .weekDays-selector .weekday {
        display: none !important;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -o-user-select: none;
    }

    .weekDays-selector input[type=checkbox]+label {
        display: inline-block;
        border-radius: 6px;
        background: #dddddd;
        height: 40px;
        min-width: 50px;
        margin-right: 3px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -o-user-select: none;
    }

    .weekDays-selector input[type=checkbox]:checked+label {
        background: #26B99A;
        color: #ffffff;
        -moz-user-select: none;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        -o-user-select: none;
    }

    .custom-file-label,
    .custom-file-label::after {
        overflow: hidden;
    }

    .recommend a.add-list {
        display: none;
    }

    .recommend:hover a.add-list {
        display: block;
    }

    .reference button.add-ref {
        display: none;
    }

    .reference:hover button.add-ref {
        display: block;
    }

    .ui-draggable .ui-draggable-handle {
        cursor: move;
    }
</style>

<link rel="stylesheet" href="back-end/css/skEditor.css" />
@php
    $progress = \App\Models\BlogProgressMd::where('blog', $row->id)->first();
    $myPackage = \App\Models\OurCustomerMd::leftJoin('package_category as p', 'our_customer.package', '=', 'p.id')
        ->where('our_customer.company', $row->companyId)
        ->select(['p.name_th', 'p.name_en', 'p.id'])
        ->first();
@endphp
<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header">
                    <span class="breadcrumb-item "><a href='{{ url("$prefix$segment") }}'>Blog</a></span>
                    <span class="breadcrumb-item active">Edit Form</span>
                    <div class="card-header-actions"><small class="text-muted"><a
                                href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small>
                    </div>
                </div>
                <div class="card-body">
                    <form id="formEdit" class="formBlog" method="post" action="" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $row->id }}">
                        {{-- Card --}}
                        #{{ $row->id }}
                        <div class="row">
                            <div class="col-md-3">
                                @php
                                    $image = !empty($row->images) ? $row->images : 'img/no_image.webp';
                                @endphp
                                <img src="{{ $image }}" class="card-img" alt="{{ $row->name_th }}"
                                    id="preview">
                                <input type="hidden" name="currentImage" value="{{ @$row->images }}">
                                <div class="mt-4">
                                    {{-- <input type="file" name="image" id="image"> --}}
                                    <div class="custom-file">
                                        <input type="file" id="image" class="form-control" name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <label>Url:</label>
                                    <input type="text" id="urlTH" class="form-control name" data-target="urlTH"
                                        name="urlTH" value="{{ $row->url_th }}" required>
                                </div>
                                {{-- <div class="mt-4">
                                    <label>Url JP:</label>
                                    <input type="text" id="urlJP" class="form-control name" data-target="urlJP" name="urlJP" value="{{$row->url_jp}}" required>
                                </div> --}}
                                <div class="mt-4">
                                    <label>Type:</label>
                                    <select name="type" id="type" class="form-control" required>
                                        <option value="" hidden>Choose...</option>
                                        <option value="general" @if ($row->type == 'general') selected @endif>
                                            General</option>
                                        <option value="customer" @if ($row->type == 'customer') selected @endif>
                                            Customer</option>
                                        <option value="review" @if ($row->type == 'review') selected @endif>Review
                                        </option>
                                        <option value="promotion" @if ($row->type == 'promotion') selected @endif>
                                            Promotion</option>
                                        <option value="job-search" @if ($row->type == 'job-search') selected @endif>
                                            Recruitment</option>
                                        <option value="want-to-sale" @if ($row->type == 'want-to-sale') selected @endif>
                                            Want to Sale</option>
                                        <option value="want-to-buy" @if ($row->type == 'want-to-buy') selected @endif>
                                            Want to buy</option>
                                        <option value="marketing-blog"
                                            @if ($row->type == 'marketing-blog') selected @endif>Marketing Blog</option>
                                        <option value="ma" @if ($row->type == 'ma') selected @endif>MA
                                        </option>
                                        <option value="news" @if ($row->type == 'news') selected @endif>News
                                        </option>
                                    </select>
                                </div>
                                <div class="mt-4 carreerFilter d-none">
                                    <label for="location">Location:</label>
                                    <select name="location" id="location" class="form-control">
                                        <option value="" hidden>Choose ...</option>
                                        @foreach (@$location as $k => $v)
                                            <option value="{{ $v->province_id }}"
                                                @if ($row->location == $v->province_id) selected @endif>
                                                {{ $v->province_name_th }} / {{ $v->province_name_en }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="position" class="mt-4">Position:</label>
                                    <select name="position" id="position" class="form-control">
                                        <option value="" hidden>Choose ...</option>
                                        @if (@$position)
                                            @foreach (@$position['rows'] as $k => $v)
                                                <option value="{{ $v['id'] }}"
                                                    @if ($row->position == $v['id']) selected @endif>
                                                    {{ $v['nameTH'] . ' / ' . $v['nameEN'] }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <label>Category:</label>
                                    <select name="category" id="category" selected="{{ $row->category }}">
                                        <option value="">กรุณาเลือก</option>
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <label>Review บริษัท</label>
                                    <select name="for_company" id="for_company"
                                        @if ($row->type != 'review') disabled @endif>
                                        <option value="">Choose...</option>
                                        @foreach (@$company as $k => $cp)
                                            <option value="{{ $cp->id }}">
                                                <strong>{{ $cp->category_th }}</strong> / {{ $cp->name_th }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <label>Language:</label>
                                    <select name="language" class="form-control">
                                        <option value="">กรุณาเลือก</option>
                                        <option value="1" @if ($row->language == 1) selected @endif>Thai</option>
                                        <option value="2" @if ($row->language == 2) selected @endif>Japan</option>
                                        <option value="3" @if ($row->language == 3) selected @endif>English</option>
                                    </select>
                                </div>
                                <div class="mt-4">
                                    <a class="btn btn-info btn-block" target="_blank"
                                        href="{{ url('th') }}/preview/blog/{{ $row->id }}">Preview&nbsp;<i
                                            class="far fa-eye"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-9">
                                <div class="row mt-4">
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div
                                                class="card-body bg-light @if (@$progress->step1) text-success @endif">
                                                @if (@$progress->step1_on)
                                                    <i class="fas fa-check-circle"></i>
                                                @endif
                                                <strong>CREATED</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div
                                                class="card-body bg-light @if (@$progress->step2) text-success @else text-secondary @endif">
                                                @if (@$progress->step2_on)
                                                <i class="fas fa-check-circle"></i>@else<i
                                                        class="far fa-circle"></i>
                                                @endif
                                                <strong>DESIGNED</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="card">
                                            <div
                                                class="card-body bg-light @if (@$progress->step3) text-success @else text-secondary @endif">
                                                @if (@$progress->step3_on)
                                                <i class="fas fa-check-circle"></i>@else<i
                                                        class="far fa-circle"></i>
                                                @endif
                                                <strong>FINISHED</strong>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-right"><button type="submit"
                                                class="btn btn-success">Save</button></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>ชื่อบทความ</label>
                                        <ul class="nav nav-tabs" id="myTab9">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH9-tab" data-toggle="tab"
                                                    href="#TH9" role="tab" aria-controls="TH9"
                                                    aria-selected="true">TH</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN9-tab" data-toggle="tab" href="#EN9"
                                                    role="tab" aria-controls="EN9" aria-selected="false">EN</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP9-tab" data-toggle="tab" href="#JP9"
                                                    role="tab" aria-controls="JP9" aria-selected="false">JP</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH9-tab" data-toggle="tab" href="#CH9"
                                                    role="tab" aria-controls="CH9" aria-selected="false">CH</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTab9Content">
                                    <div class="tab-pane fade show active" id="TH9" role="tabpanel"
                                        aria-labelledby="TH9-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <input type="text" name="name_th" value="{{ $row->name_th }}"
                                                    class="form-control form-storage">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="EN9" role="tabpanel"
                                        aria-labelledby="EN9-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <input type="text" name="name_en" value="{{ $row->name_en }}"
                                                    class="form-control form-storage">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="JP9" role="tabpanel"
                                        aria-labelledby="JP9-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <input type="text" name="name_jp" value="{{ $row->name_jp }}"
                                                    class="form-control form-storage">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="CH9" role="tabpanel"
                                        aria-labelledby="CH9-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <input type="text" name="name_zh" value="{{ $row->name_zh }}"
                                                    class="form-control form-storage">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if ($row->company)
                                    <div class="row mt-3">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label>บริษัท</label>
                                                <select name="company" id="company" class="form-control"
                                                    style="pointer-events: none">
                                                    <option value="{{ $row->companyId }}">{{ $row->companyName }}
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if (@$myPackage->id)
                                    <div class="row my-2">
                                        <div class="col-lg-2">
                                            <label>Package</label>
                                            <button type="button"
                                                class="btn btn-sm btn-light">{{ @$myPackage->name_th }}</button>
                                        </div>
                                    </div>
                                @endif
                                {{-- <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <strong>No Code &lt;/&gt;</strong>
                                            <textarea name="more_th" id="more_th" class="form-control" rows="17">{{ $row->more_th }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <strong>รายละเอียด</strong>
                                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH2-tab" data-toggle="tab"
                                                    href="#TH2" role="tab" aria-controls="TH2"
                                                    aria-selected="true">TH</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTab2Content">
                                            <div class="tab-pane fade show active" id="TH2" role="tabpanel"
                                                aria-labelledby="TH2-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="sk-area" data-lang="th">
                                                            <textarea name="detail_th" id="detail_th" class="sk-editor" hidden="">{{ $row->detail_th }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="text-right"><button type="submit"
                                                class="btn btn-success">Save</button></div>
                                    </div>
                                </div> --}}
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <strong>No Code &lt;/&gt;</strong>
                                        <ul class="nav nav-tabs" id="myTab1">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH1-tab" data-toggle="tab"
                                                    href="#TH1" role="tab" aria-controls="TH1"
                                                    aria-selected="true">TH</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN1-tab" data-toggle="tab" href="#EN1"
                                                    role="tab" aria-controls="EN1" aria-selected="false">EN</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP1-tab" data-toggle="tab" href="#JP1"
                                                    role="tab" aria-controls="JP1" aria-selected="false">JP</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH1-tab" data-toggle="tab" href="#CH1"
                                                    role="tab" aria-controls="CH1" aria-selected="false">CH</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTab1Content">
                                    <div class="tab-pane fade show active" id="TH1" role="tabpanel"
                                        aria-labelledby="TH1-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <textarea name="more_th" id="more_th" class="form-control" rows="17">{{ $row->more_th }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="EN1" role="tabpanel"
                                        aria-labelledby="EN1-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <textarea name="more_en" id="more_en" class="form-control" rows="17">{{ $row->more_en }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="JP1" role="tabpanel"
                                        aria-labelledby="JP1-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <textarea name="more_jp" id="more_jp" class="form-control" rows="17">{{ $row->more_jp }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="CH1" role="tabpanel"
                                        aria-labelledby="CH1-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <textarea name="more_zh" id="more_zh" class="form-control" rows="17">{{ $row->more_zh }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <strong>รายละเอียดเต็ม</strong>
                                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH2-tab" data-toggle="tab"
                                                    href="#TH2" role="tab" aria-controls="TH2"
                                                    aria-selected="true">TH</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN2-tab" data-toggle="tab" href="#EN2"
                                                    role="tab" aria-controls="EN2" aria-selected="true">EN</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP2-tab" data-toggle="tab" href="#JP2"
                                                    role="tab" aria-controls="JP2" aria-selected="true">JP</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH2-tab" data-toggle="tab" href="#CH2"
                                                    role="tab" aria-controls="CH2" aria-selected="true">CH</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTab2Content">
                                            <div class="tab-pane fade show active" id="TH2" role="tabpanel"
                                                aria-labelledby="TH2-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="sk-area" data-lang="th">
                                                            <textarea name="detail_th" id="detail_th" class="sk-editor" hidden="">{{ $row->detail_th }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="EN2" role="tabpanel"
                                                aria-labelledby="EN2-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="sk-area" data-lang="EN">
                                                            <textarea name="detail_en" id="detail_en" class="sk-editor" hidden="">{{ $row->detail_en }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="JP2" role="tabpanel"
                                                aria-labelledby="JP2-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="sk-area" data-lang="jp">
                                                            <textarea name="detail_jp" id="detail_jp" class="sk-editor" hidden="">{{ $row->detail_jp }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="CH2" role="tabpanel"
                                                aria-labelledby="CH2-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="sk-area" data-lang="zh">
                                                            <textarea name="detail_zh" id="detail_zh" class="sk-editor" hidden="">{{ $row->detail_zh }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <div style="display:flex;">
                                                <div class="custom-control custom-checkbox mb-2">
                                                    <input type="checkbox" class="custom-control-input"
                                                        id="onRecommend"
                                                        @if ($row->recommend != '') checked @endif>
                                                    <label class="custom-control-label" for="onRecommend">Recommend
                                                        (แนะนำ)</label>
                                                </div>
                                                <a class="badge badge-warning mt-1 ml-1 recommend-edit"
                                                    href="javascript:" style="height: fit-content">Add/Edit</a>
                                            </div>
                                            <div class="recommend border" contentEditable="false"
                                                style="position:relative; min-height:100px; padding:3px;">
                                                {!! $row->recommend !!}</div>
                                            <textarea id="recommend" name="recommend" class="form-control" style="display: none;">{!! $row->recommend !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label for="reference">Reference (อ้างอิง)</label><a
                                                class="badge badge-warning ml-1 reference-edit"
                                                href="javascript:">Add/Edit</a>
                                            <div class="reference border" contentEditable="false"
                                                style="position:relative; min-height:100px; padding:3px;">
                                                {!! $row->reference !!}</div>
                                            <textarea id="reference" name="reference" class="form-control" style="display: none;">{!! $row->reference !!}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-12">
                                        <div class="custom-control custom-checkbox mb-2">
                                            <input type="checkbox" class="custom-control-input" id="onShare"
                                                @if ($row->facebook_url != '') checked @endif>
                                            <label class="custom-control-label" for="onShare"><i
                                                    class="fab fa-facebook-square fa-fw"></i> Facebook Url</label>
                                        </div>
                                        <input type="text" name="facebook_url" id="facebook_url"
                                            class="form-control" value="{{ @$row->facebook_url }}"
                                            @if ($row->facebook_url == '') readonly @endif>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Tag:</label>
                                            @php
                                                $get_join = DB::table('tag')
                                                    ->select('tag.tag')
                                                    ->leftJoin('blog_join_tag as join', 'join.tag_id', '=', 'tag.id')
                                                    ->where('join.blog_id', $row->id)
                                                    ->get();
                                                $count_join = count($get_join);
                                                $join_array = '';
                                                foreach ($get_join as $k => $value) {
                                                    $comma = $k != $count_join - 1 ? ($count_join > 1 ? ',' : '') : '';
                                                    $join_array .= $value->tag . $comma;
                                                }

                                                $get_tag = DB::table('tag')->select('tag')->get();
                                                $count_tag = count($get_tag);
                                                $tag_array = '';
                                                $comma = '';
                                                foreach ($get_tag as $k => $value) {
                                                    $comma = $k != $count_tag - 1 ? ($count_tag > 1 ? ',' : '') : '';
                                                    $tag_array .= $value->tag . $comma;
                                                }
                                            @endphp
                                            <input type="text" class="form-control" name="tag"
                                                id="tokenfield" value="{{ $join_array }}" />
                                            <input type="hidden" class="form-control" id="autocomplete"
                                                value="{{ $tag_array }}" />
                                        </div>
                                    </div>
                                </div>

                                <hr />
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <h4>SEO</h4>
                                        <ul class="nav nav-tabs" id="myTab5">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH5-tab" data-toggle="tab"
                                                    href="#TH5" role="tab" aria-controls="TH5"
                                                    aria-selected="true">TH</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN5-tab" data-toggle="tab" href="#EN5"
                                                    role="tab" aria-controls="EN5" aria-selected="false">EN</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP5-tab" data-toggle="tab" href="#JP5"
                                                    role="tab" aria-controls="JP5" aria-selected="false">JP</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH5-tab" data-toggle="tab" href="#CH5"
                                                    role="tab" aria-controls="CH5" aria-selected="false">CH</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTab5Content">
                                    <div class="tab-pane fade show active" id="TH5" role="tabpanel"
                                        aria-labelledby="TH5-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Keyword :</label>
                                                <input type="text" name="seo_keyword_th"
                                                    class="form-control form-storage"
                                                    value="{{ $row->seo_keyword_th }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="EN5" role="tabpanel"
                                        aria-labelledby="EN5-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Keyword :</label>
                                                <input type="text" name="seo_keyword_en"
                                                    class="form-control form-storage"
                                                    value="{{ $row->seo_keyword_en }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="JP5" role="tabpanel"
                                        aria-labelledby="JP5-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Keyword :</label>
                                                <input type="text" name="seo_keyword_jp"
                                                    class="form-control form-storage"
                                                    value="{{ $row->seo_keyword_jp }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="CH5" role="tabpanel"
                                        aria-labelledby="CH5-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Keyword :</label>
                                                <input type="text" name="seo_keyword_zh"
                                                    class="form-control form-storage"
                                                    value="{{ $row->seo_keyword_zh }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs" id="myTab6" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH6-tab" data-toggle="tab"
                                                    href="#TH6" role="tab" aria-controls="TH6"
                                                    aria-selected="true">TH</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN6-tab" data-toggle="tab" href="#EN6"
                                                    role="tab" aria-controls="EN6" aria-selected="false">EN</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP6-tab" data-toggle="tab" href="#JP6"
                                                    role="tab" aria-controls="JP6" aria-selected="false">JP</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH6-tab" data-toggle="tab" href="#CH6"
                                                    role="tab" aria-controls="CH6" aria-selected="false">CH</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content" id="myTab6Content">
                                    <div class="tab-pane fade show active" id="TH6" role="tabpanel"
                                        aria-labelledby="TH6-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Description :</label>
                                                <textarea maxlength="990" name="seo_description_th" rows="8" class="form-control form-storage">{{ $row->seo_description_th }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="EN6" role="tabpanel"
                                        aria-labelledby="EN6-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Description :</label>
                                                <textarea maxlength="990" name="seo_description_en" rows="8" class="form-control form-storage">{{ $row->seo_description_en }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="JP6" role="tabpanel"
                                        aria-labelledby="JP6-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Description :</label>
                                                <textarea maxlength="990" name="seo_description_jp" rows="8" class="form-control form-storage">{{ $row->seo_description_jp }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="CH6" role="tabpanel"
                                        aria-labelledby="CH6-tab">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <label>Description :</label>
                                                <textarea maxlength="990" name="seo_description_zh" rows="8" class="form-control form-storage">{{ $row->seo_description_zh }}</textarea>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <strong>Google For Job &lt;/json&gt;</strong>
                                            <textarea name="gForJob" id="gForJob" class="form-control" rows="15">{{ $row->gForJob }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row text-right">
                                    <div class="col-lg-12">
                                        <div id="areaAlert"></div>
                                        <button type="submit" class="btn btn-success">Save</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/a-color-picker@1.1.8/dist/acolorpicker.js"></script>
<script src="js/drag-arrange.js"></script>
<script src="js/b64toBlob.js"></script>
<script src="back-end/build/skEditor.js?v=0000"></script>
<script src="back-end/build/skRecommend.js"></script>
<script src="back-end/build/skReference.js"></script>
<script src="back-end/slimselectjs/slimselect.min.js"></script>
<script>
    async function getCategory() {
        const request = await fetch('api/get/category/all');
        const response = await request.json();
        return response;
    }
    var Categories;
    getCategory().then(res => {
        Categories = res;
        let options = '<option value="">กรุณาเลือก</option>';
        let selected = document.querySelector('select[name="category"]').getAttribute('selected');
        res.map(function(m) {
            m.sub.map(function(s) {
                options += `<optgroup label="${s.name}">`;
                s.category.map(function(c) {
                    if (c.name != null) options +=
                        `<option value="${c.id}" ${selected == c.id?`selected=""`:``}>${c.no} ${c.name}</option>`;
                })
                options += `</optgroup>`;
            })
        })
        document.querySelector('select[name="category"]').innerHTML = options;
        setTimeout(() => {
            new SlimSelect({
                select: '#category'
            });
        }, 1000);
    });
    $('#detail_th').skEditor({
        height: '800px'
    });
    $('#detail_en').skEditor({
        height: '800px'
    });
    $('#detail_jp').skEditor({
        height: '800px'
    });
    $('#detail_zh').skEditor({
        height: '800px'
    });

    let fcom = new SlimSelect({
        select: '#for_company',
    });

    if (document?.querySelector('#type')) {
        if (document?.querySelector('#type').value == 'job-search') {
            document.querySelector('.carreerFilter').classList.remove("d-none");
        }
    }

    $('#type').on('change', function() {
        if (this.value != "review") {
            $('#for_company').prop('selectedIndex', 0);
            fcom.disable()
        } else {
            fcom.enable()
        }

        let carreerfilter = document.querySelector('.carreerFilter');
        if (this.value == "job-search") {
            carreerfilter.classList.remove("d-none");
        } else {
            carreerfilter.classList.add("d-none");
        }
    })

    $("#image").on('change', function() {
        var $this = $(this);
        var input = $(this)[0];
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#preview').attr('src', e.target.result).fadeIn('slow');
            }
            reader.readAsDataURL(input.files[0]);

            $this.siblings(".custom-file-label").addClass("selected").html(input.files[0].name.toString());
        }
    });
    $('#gallery').filer({
        limit: '5'
    });
    // tinymce.init({
    // 	selector: 'textarea.tiny1',
    // 	menubar : false,
    // 	force_br_newlines : true,
    //     force_p_newlines : false,
    //     height: 200, 
    //     plugins: ["code textcolor"],    
    //     toolbar: 'undo redo code bold italic forecolor backcolor',
    //     formats: {
    //         h1: { block: 'h1', classes: 'heading' }
    //     },
    // });
    // tinymce.init({
    // 	selector: 'textarea.tiny',
    // 	menubar : false,
    // 	force_br_newlines : true,
    // 	force_p_newlines : false,
    // 	forced_root_block : '',
    // 	height: 400, 
    //     //width : 1100,
    //     plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","save table contextmenu directionality emoticons template paste textcolor colorpicker layer textpattern moxiemanager"],    
    //     toolbar: 'insertfile undo redo | table | styleselect fontselect fontsizeselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | print nonbreaking hr emoticons code',

    // });

    function readGallery(input, id) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $("#" + id).css("display", "block").prop("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function readGallery(input, id) {
        var total_file = document.getElementById("gallery").files.length;
        var stringRand = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        $('.gal_add').remove();
        for (var i = 0; i < total_file; i++) {
            var html = '<div class="col-lg-4 gal_add_' + '" id="gal_add_' + stringRand + '" >\
                               <img class="img-thumbnail" src="' + URL.createObjectURL(event.target.files[i]) + '">\
                        </div>';
            $('#gallery_preview').append(html);
        }
    }

    function removeGalleryData(id) {
        Swal.fire({
            title: 'ต้องการลบใช่หรือไม่ ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'ใช่ !'
        }).then((result) => {
            if (result.isConfirmed) {
                OpenLoading();
                var token = "{{ csrf_token() }}";
                $.ajax({
                    type: 'post',
                    url: '{{ url($prefix . $segment . '/deleteItemGallery') }}',
                    data: {
                        id: id,
                        _token: token
                    },
                    success: function(data) {
                        CloseLoading();
                        Swal.fire(
                            'สำเร็จ !',
                            'ลบรายการออกแล้ว',
                            'success'
                        ).then((result) => {
                            $('#gal_' + id).slideUp("slow", function() {
                                $(this).remove();
                            });
                        })
                    },
                    error: function() {
                        CloseLoading();
                        Swal.fire(
                            'Error!',
                            'มีบางอย่างผิดพลาด !',
                            'error'
                        )
                    }
                });
            }
        })
    }
    var autoCom = $('#autocomplete').val();
    var autoCom = autoCom.split(',');
    $('#tokenfield').tokenfield({
        autocomplete: {
            source: autoCom,
            delay: 100
        },
        showAutocompleteOnFocus: true
    })
    var onShare = document.querySelector('#onShare');
    var facebook_url = document.querySelector('#facebook_url');
    onShare.addEventListener('click', function() {
        let ico = onShare.nextElementSibling.children[0];
        if (this.checked === true) {
            facebook_url.readOnly = false;
            ico.classList.add('text-primary');
        } else {
            facebook_url.value = '';
            facebook_url.readOnly = true;
            ico.classList.remove('text-primary');
        }
    });
    $('.recommend').skRecommend();
    $('.reference').skReference();

    // $(document).on('click','.reference-edit', function(){
    //     const area = $('.reference');
    //     const edit = area.attr('contentEditable');
    //     const html = area.html();
    //     if(edit=='false'){         
    //         $('.reference').html('');
    //         $('.reference').attr('contentEditable',true);  
    //         $('.reference').text(html);
    //     }else{
    //         $('.reference').html('');
    //         $('.reference').append($($.parseHTML(html)[0].textContent));
    //         $('.reference').attr('contentEditable',false);
    //     }
    // })
</script>
