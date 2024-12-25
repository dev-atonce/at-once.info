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

    .dropdown-menu>li>a {
        font-weight: 700;
        padding: 10px 20px;
    }

    .bootstrap-select.btn-group .dropdown-menu li small {
        display: block;
        padding: 6px 0 0 0;
        font-weight: 100;
    }

    .custom-file-label.selected {
        overflow: hidden;
    }

    .ad-auto {
        position: absolute;
        padding: 0;
        background: #fff;
        border: 1px solid;
        border-top: none;
        border-color: #ccc;
        margin-top: 1px;
    }

    .ad-auto ul {
        font-size: 14px;
        margin-left: 0;
    }

    ul.ad-auto li {
        list-style-type: none;
        color: #000;
        font-size: 14px;
        padding: 5px 5px 5px 12px;
    }

    ul.ad-auto li>span {
        color: #555;
    }

    ul.ad-auto li:hover>span {
        color: #fff;
    }

    ul.ad-auto li:hover {
        cursor: pointer;
        background-color: #5ca7fd;
        color: #fff;

    }

    .list-item .item {
        display: block;
        width: 100%;
        padding: 0 5px 0 5px;
        cursor: default;
        border-radius: 3px;
    }

    .list-item .item:hover {
        background: #5997fb;
        color: white;

    }

    .item.active {
        background-color: #5997fb;
        color: #fff;
    }

    .v-action {
        position: absolute;
        top: 0;
        right: 0;
        padding: 10px;
    }

    .v-details {
        overflow: hidden;
        padding: 0 10px 10px 10px;
        width: -webkit-fill-available;
    }

    #vExplorerZone {
        position: relative;
        min-height: 350px;
    }

    .col-lg-12.v-footer {
        border-top: 1px solid #dedede;
        height: min-content;
        position: absolute;
        bottom: 0;
        padding: 10px;
    }

    .form-control.error {
        border-color: #ef8b8b;
    }

    .form-control.error:focus {
        color: rgb(247, 74, 74);
        ;
        background-color: #fff;
        border-color: #ef8b8b !important;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgb(219 31 31 / 25%);
    }

    label.error {
        color: rgb(247, 74, 74);
    }

    .custom-select.text-danger {
        border: 1px solid crimson !important;
    }

    .h3 .custom-control-label::before {
        width: 2rem;
        height: 2rem;
    }

    .h3 .custom-control-label::after {
        width: 2rem;
        height: 2rem;
    }

    html:not([dir=rtl]) .custom-control-label::before {
        left: -2.3rem;
    }

    html:not([dir=rtl]) .custom-control-label::after {
        left: -2.3rem;
    }

    .custom-checkbox.h3 .custom-control-label::before {
        border-radius: 1.25rem;
    }

    .info.selected {
        border: 1px solid #3399ff !important;
    }

    .success.selected {
        border: 1px solid #2eb85c !important;
    }

    .custom-control-input:checked~.label-info::before {

        border-color: #3399ff !important;
        background-color: #3399ff !important;
    }

    .custom-control-input:checked~.label-info {
        color: #3399ff;
    }

    .custom-control-input:checked~.label-success::before {

        border-color: #2eb85c !important;
        background-color: #2eb85c !important;
    }

    .custom-control-input:checked~.label-success {
        color: #2eb85c
    }

    .restore-content {
        position: fixed;
        background: #fff;
        right: 10px;
        top: 70px;
        z-index: 500;
        border-radius: 8px;
        box-shadow: 0 0 3px 1px #b9c0c9;
        padding: 15px;
        max-width: 280px;
    }

    .restore-content-header {
        font-size: 20px;
        font-weight: bold;
    }

    .restore-content-body {
        /* padding: 15px */
    }

    .restore-content-footer {}

    .restore-content.minimize {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        font-size: 16px;
        cursor: pointer;
    }

    .minimize .fa-minus,
    .minimize .restore-content-header span,
    .minimize .restore-content-body,
    .minimize .restore-content-footer {
        display: none;

    }

    .minimize i.mr-1 {
        font-size: 24px;
        margin-right: unset !important;
    }

    .minimize .restore-content-header {
        display: grid;
        height: -webkit-fill-available;
        /* vertical-align: middle; */
        /* text-align: center; */
        align-items: center;
        justify-content: center;
    }

    .to-minimize {
        cursor: pointer;
    }

    [name^="_type"]:checked {
        color: #3399ff;
    }

    label.card-body input:checked {
        color: #fff !important;
        background-color: #ff3333 !important;
    }
</style>
<link rel="stylesheet" href="back-end/css/skEditor.css" />
<link rel="stylesheet" href="bootstrap-multiselect/dist/css/bootstrap-multiselect.min.css" />
@php
    $day = DB::table('working_hours')->select('id', 'name_th')->get();
@endphp
<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb" style="border-bottom:unset; margin-bottom:unset;">
                    <li class="breadcrumb-item "><a href='{{ url("$prefix$segment") }}'>Member</a></li>
                    <li class="breadcrumb-item active">Edit Form</span>&nbsp;&nbsp;<span></li>
                </ol>
            </nav>

            @if (Session('status'))
                <input type="hidden" name="afterUpdate" value="{{ Session('status') }}">
            @endif
            <input type="hidden" name="restored" @if (Session('restored')) value="true" @endif>

            <form id="formEdit" method="post" action="" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="member_id" value="{{ @$row->id }}">
                <input type="hidden" name="cp_id" value="{{ @$comp->id }}">
                <input type="hidden" name="edited" value="{{ $comp->edited }}">
                {{-- <input type="hidden" name="c_type" value="full"> --}}

                <div class="row">
                    <div class="col-lg-2">
                        <div class="card text-secondary border info @if ($comp->type == 'basic') selected @endif">
                            <div class="card-body px-4 py-3">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="basic" name="c_type"
                                        class="custom-control-input form-storage" value="basic"
                                        @if ($comp->type == 'basic') checked @endif>
                                    <label class="custom-control-label label-info font-weight-bold" for="basic">Basic
                                        Profile</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div class="card text-secondary border info @if ($comp->type == 'semi') selected @endif">
                            <div class="card-body px-4 py-3">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="semi" name="c_type"
                                        class="custom-control-input form-storage" value="semi"
                                        @if ($comp->type == 'semi') checked @endif>
                                    <label class="custom-control-label label-info font-weight-bold" for="semi">Semi
                                        Profile</label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <div
                            class="card text-secondary border success @if ($comp->type == 'full') selected @endif">
                            <div class="card-body px-4 py-3">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="full" name="c_type"
                                        class="custom-control-input form-storage" value="full"
                                        @if ($comp->type == 'full') checked @endif>
                                    <label class="custom-control-label label-success font-weight-bold"
                                        for="full">Full
                                        Profile</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card">

                    <div class="card-header">
                        <h5 class="m-0" style="color:#5997fb;">General #{{ $comp->id }}</h5>
                    </div>
                    <div class="card-body">
                        @php
                            $group = \App\Http\Controllers\ProvincialCtrl::group();
                            $category = \App\Models\CategoryMd::orderBy('id')->get();
                            $nationality = \App\Models\CountryMd::select('id', 'nationality')
                                ->orderBy('nationality')
                                ->get();
                        @endphp
                        <div class="mb-3">User Email : {{ @$row->email }}</div>
                        <div class="row">
                            <div class="col-md-3">
                                @php
                                    $image = $comp->logo !== '' ? $comp->logo : 'img/no_image.webp';
                                @endphp
                                <img src="{{ $image }}" class="card-img" alt="{{ $comp->name_th }}"
                                    id="preview">
                                <input type="hidden" name="currentImage" value="{{ @$comp->logo }}">
                                <div class="form-group">
                                    <code>Dimension: 500 x 500 pixel (auto resize & crop)</code>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="image" lang="th"
                                            name="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-12">
                                        @php
                                            $bg_image = !empty($comp->cover) ? $comp->cover : 'img/no-img-banner.jpg';
                                        @endphp
                                        <img src="{{ $bg_image }}" class="card-img" alt="{{ $comp->name_th }}"
                                            id="bg_preview" style="max-height: 320px">
                                        <input type="hidden" name="currentBgImage" value="{{ @$comp->bg_image }}">
                                        <div class="form-group">
                                            <code>Dimension: 1920 x 500 pixel (auto resize & crop)</code>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="bg_image"
                                                    lang="th" name="bg_image">
                                                <label class="custom-file-label" for="bg_image">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <label for="">Video :</label>
                                        <label><input type="radio" name="video_position" class="form-storage"
                                                value="left"
                                                @if ($comp->video_position == 'left') checked @endif>&nbsp;ซ้าย</label>
                                        <label><input type="radio" name="video_position" class="form-storage"
                                                value="center"
                                                @if ($comp->video_position == 'center') checked @endif>&nbsp;กลาง</label>
                                        <label><input type="radio" name="video_position" class="form-storage"
                                                value="right"
                                                @if ($comp->video_position == 'right') checked @endif>&nbsp;ขวา</label>
                                        <div class="input-group mb-3">
                                            <input type="text" name="video_profile"
                                                class="form-control form-storage" placeholder="Video URL"
                                                aria-label="Video URL" aria-describedby="basic-addon2"
                                                value="{{ $comp->video_profile }}">
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-outline-secondary select-video"
                                                    type="button">Browse</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="text-right">
                                            <button type="submit" class="text-right btn btn-success">Save</button>
                                        </div>
                                        <div class="form-group">
                                            <div class="bd-callout bd-callout-danger">
                                                <label class="text-danger font-weight-bold">*Profile URL :</label> e.g.
                                                <code>company-name-thailand</code>
                                                <a class="badge badge-info"
                                                    href="th/preview/company-profile/{{ $comp->id }}"
                                                    target="_blank"><i class="fas fa-eye fa-fw"></i>&nbsp;Preview</a>
                                                @if ($comp->profile_url != '')
                                                    <a class="badge badge-success"
                                                        href="/th/{{ $comp->key }}/cp/{{ $comp->profile_url }}"
                                                        target="_blank"><i
                                                            class="fas fa-globe-asia"></i>&nbsp;Publish</a>
                                                @endif

                                                <input type="text" name="profile_url" id="profile_url"
                                                    class="form-control form-storage"
                                                    value="{{ $comp->profile_url }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>ชื่อบริษัท <span class="badge badge-primary">TH</span></label>
                                            <input type="text" name="name_th" value="{{ $comp->name_th }}"
                                                class="form-control form-storage">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>ชื่อบริษัท <span class="badge badge-primary">EN</span></label>
                                            <input type="text" name="name_en" value="{{ $comp->name_en }}"
                                                class="form-control form-storage">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>ชื่อบริษัท <span class="badge badge-primary">JP</span></label>
                                            <input type="text" name="name_jp" value="{{ $comp->name_jp }}"
                                                class="form-control form-storage">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>ชื่อบริษัท <span class="badge badge-primary">CH</span></label>
                                            <input type="text" name="name_zh" value="{{ $comp->name_zh }}"
                                                class="form-control form-storage">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>อุตสาหกรรม</label>
                                            <select name="my-category" class="selectpicker form-storage"
                                                id="my-category">
                                                <option value="">กรุณาเลือก</option>
                                                @foreach ($category as $ki => $vi)
                                                    <option value="{{ $vi->id }}"
                                                        @if ($comp->category == $vi->id) selected @endif>
                                                        {{ $vi->name_th }} / {{ $vi->name_jp }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>สัญชาติ</label>
                                            <select id="country" name="country" class="form-storage">
                                                <option value="">กรุณาเลือก</option>
                                                @foreach ($country as $cout)
                                                    <option value="{{ $cout->alpha2 }}"
                                                        @if ($comp->country == $cout->alpha2) selected @endif>
                                                        {{ $cout->nationality }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="float-right"><button type="submit"
                                                class="btn btn-success">Save</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 style="color:#5997fb;" class="m-0">Filters</h5>
                    </div>
                    <div class="card-body">
                        <div class="row" id="filter-category">
                            @foreach ($filters->input as $key => $val)
                                <input type="hidden" class="filters" data-label="{{ $val->label }}"
                                    data-type="{{ $val->type }}" data-name="{{ $val->name }}"
                                    data-filter='{{ @$filters->filter[$val->name] }}'
                                    data-val='{{ @$myFilter[$val->name] }}'
                                    select-all="{{ @$val->selectAll ? 'true' : 'false' }}">
                            @endforeach
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-xs-12">
                                <div id="area-filter" class="row mb-3"></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="float-right"><button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="card">
                    <div class="card-header">
                        <h5 style="color:#5997fb;" class="m-0">Detail</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>รายละเอียดย่อ (Short Description)</label>
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
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
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade show active" id="TH1" role="tabpanel"
                                                aria-labelledby="TH1-tab">
                                                <div class="form-group">
                                                    <textarea maxlength="990" class="form-control form-storage" rows="5" name="description_th"
                                                        placeholder="(TH)">{{ $comp->description_th }}</textarea>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="EN1" role="tabpanel"
                                                aria-labelledby="EN1-tab">
                                                <div class="form-group">
                                                    <textarea maxlength="990" class="form-control form-storage" rows="5" name="description_en"
                                                        placeholder="(EN)">{{ $comp->description_en }}</textarea>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="JP1" role="tabpanel"
                                                aria-labelledby="JP1-tab">
                                                <div class="form-group">
                                                    <textarea maxlength="990" class="form-control form-storage" rows="5" name="description_jp"
                                                        placeholder="(JP)">{{ $comp->description_jp }}</textarea>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="CH1" role="tabpanel"
                                                aria-labelledby="CH1-tab">
                                                <div class="form-group">
                                                    <textarea maxlength="990" class="form-control form-storage" rows="5" name="description_zh"
                                                        placeholder="(CH)">{{ $comp->description_zh }}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="from-group mt-3">
                                            <label>No Code</label>
                                        </div>
                                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link active" id="textTH-tab" data-toggle="tab"
                                                    href="#textTH" role="tab" aria-controls="TH1"
                                                    aria-selected="true">TH</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="textEN-tab" data-toggle="tab" href="#textEN"
                                                    role="tab" aria-controls="EN1" aria-selected="false">EN</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="textJP-tab" data-toggle="tab" href="#textJP"
                                                    role="tab" aria-controls="JP1" aria-selected="false">JP</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" id="textCH-tab" data-toggle="tab" href="#textCH"
                                                    role="tab" aria-controls="CH1" aria-selected="false">CH</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="textTab">
                                            <div class="tab-pane fade show active" id="textTH" role="tabpanel"
                                                aria-labelledby="textTH-tab">
                                                <textarea name="detail_th" class="form-control form-storage" rows="17" placeholder="(TH)">{{ $comp->detail_th }}</textarea>
                                            </div>
                                            <div class="tab-pane fade show" id="textEN" role="tabpanel"
                                                aria-labelledby="textEN-tab">
                                                <textarea name="detail_en" class="form-control form-storage" rows="17" placeholder="(EN)">{{ $comp->detail_en }}</textarea>
                                            </div>
                                            <div class="tab-pane fade show" id="textJP" role="tabpanel"
                                                aria-labelledby="textJP-tab">
                                                <textarea name="detail_jp" class="form-control form-storage" rows="17" placeholder="(JP)">{{ $comp->detail_jp }}</textarea>
                                            </div>
                                            <div class="tab-pane fade show" id="textCH" role="tabpanel"
                                                aria-labelledby="textCH-tab">
                                                <textarea name="detail_zh" class="form-control form-storage" rows="17" placeholder="(CH)">{{ $comp->detail_zh }}</textarea>
                                            </div>
                                        </div>



                                        <div class="from-group mt-3 mb-2">
                                            <label>รายละเอียดเต็ม</label>
                                            <a class="btn btn-info btn-sm"
                                                href="th/preview/company-profile/{{ $comp->id }}"
                                                target="_blank"><i class="fas fa-eye mr-1"></i> PREVIEW</a>
                                            <a class="btn btn-primary btn-sm" target="_blank"
                                                href="{{ Request::fullUrl() }}/translate"><i
                                                    class="fas fa-language fa-lg mr-1"></i>Translate</a>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">

                                            </div>
                                        </div>
                                        <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH2-tab" data-toggle="tab"
                                                    href="#TH2" role="tab" aria-controls="TH2"
                                                    aria-selected="true">TH</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN2-tab" data-toggle="tab" href="#EN2"
                                                    role="tab" aria-controls="EN2" aria-selected="false">EN</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP2-tab" data-toggle="tab" href="#JP2"
                                                    role="tab" aria-controls="JP2" aria-selected="false">JP</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH2-tab" data-toggle="tab" href="#CH2"
                                                    role="tab" aria-controls="CH2" aria-selected="false">CH</a>
                                            </li>
                                        </ul>

                                        {{-- ------------- Template --------------- --}}
                                        <div class="tab-content" id="myTab2Content">
                                            <div class="tab-pane fade show active" id="TH2" role="tabpanel"
                                                aria-labelledby="TH2-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="sk-area" data-lang="th">
                                                            <textarea name="more_th" id="more_th" class="sk-editor" hidden="">{{ $comp->more_th }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="EN2" role="tabpanel"
                                                aria-labelledby="EN2-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="sk-area" data-lang="en">
                                                            <textarea name="more_en" id="more_en" class="sk-editor" hidden="">{{ $comp->more_en }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="tab-pane fade" id="JP2" role="tabpanel"
                                                aria-labelledby="JP2-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="sk-area" data-lang="jp">
                                                            <textarea name="more_jp" id="more_jp" class="sk-editor" hidden="">{{ $comp->more_jp }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade" id="CH2" role="tabpanel"
                                                aria-labelledby="CH2-tab">
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="sk-area" data-lang="ch">
                                                            <textarea name="more_zh" id="more_zh" class="sk-editor" hidden="">{{ $comp->more_zh }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="float-left mt-3"><a class="btn btn-info btn-sm"
                                                        href="th/preview/company-profile/{{ $comp->id }}"
                                                        target="_blank"><i class="fas fa-eye mr-1"></i> PREVIEW</a>
                                                </div>
                                                <div class="text-right mt-3">
                                                    <button type="submit"
                                                        class="text-right btn btn-success">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                        {{-- ------------- /Template --------------- --}}
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>

                @php
                    $gallery = \App\Models\Filter\CpGalleryMd::where('_id', $comp->id)->get();
                @endphp

                <div class="card">
                    <div class="card-header">
                        <h4 class="m-0" style="color:#5997fb;">Gallery</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row" id="gallery_preview">
                                    @if ($gallery)
                                        @foreach ($gallery as $gal)
                                            <div class="col-lg-4" id="gal_{{ $gal->id }}">
                                                <div style="position:relative;">
                                                    <button type="button" class="close AClass" aria-label="Close">
                                                        <span aria-hidden="true"
                                                            onclick="removeGalleryData({{ $gal->id }});">&times;</span>
                                                    </button>
                                                    <img src="{{ $gal->image }}" class="img-thumbnail">
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-6">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="gallery"
                                                lang="th" name="gallery[]"
                                                onchange="readGallery('gallery',this)" multiple="multiple">
                                            <label class="custom-file-label" for="gallery">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="float-right"><button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h5 style="color:#5997fb;" class="m-0">Contact Data</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="row">
                                    @php
                                        $op_working_hours = DB::table('cp_working_hours')
                                            ->select('id', 'day', 'time')
                                            ->where('_id', $comp->id)
                                            ->get();
                                        $array_working_hours = [];
                                        foreach ($op_working_hours as $value) {
                                            array_push($array_working_hours, $value->day);
                                        }
                                    @endphp

                                    <div class="col-lg-6 col=md-12 col-xs-12">
                                        <strong>เวลาทำการ</strong>
                                        <div class="working_hour mt-2"
                                            data-val="{{ json_encode($op_working_hours) }}">
                                            @foreach (\App\Models\WorkingHoursMd::select('id', 'name_th as name')->get() as $kwh => $wh)
                                                <div
                                                    class="input-group @if ($kwh > 0) mt-2 @endif">
                                                    <label for="working_hour{{ $kwh }}"
                                                        class="form-control"><input type="checkbox"
                                                            id="working_hour{{ $kwh }}"
                                                            name="day[{{ $kwh }}]" class="form-storage"
                                                            value="{{ $wh->id }}">
                                                        {{ $wh->name }}</label>
                                                    <input type="text" name="time[{{ $kwh }}]"
                                                        class="form-control form-storage" placeholder="เวลา"
                                                        disabled="">
                                                </div>
                                            @endforeach
                                        </div>
                                        {{-- <div class="row">
                                        <div class="col-lg-6">
                                            <table class="table" id="areaWorkTime">
                                            @if (!empty($op_working_hours))
                                            @foreach ($op_working_hours as $k => $work)
                                                <input type="hidden" name="time_id[{{$k}}]" value="{{$work->id}}">
                                                <tr id="working_{{$work->id}}" class="workItem">
                                                    <td>
                                                        <select class="form-control" name="cp_working_day[{{$k}}]">
                                                            <option value="">โปรดเลือกวัน</option>
                                                            @foreach ($day as $d)
                                                                <option value="{{$d->id}}" @if ($d->id == $work->day) selected @endif>{{$d->name_th}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input type="text" class="form-control" name="cp_working_time[{{$k}}]" value="{{$work->time}}">
                                                    </td>
                                                    <td>
                                                        <a href="javascript:void(0)" class="deleteItemWork" data-id="{{$work->id}}" data-cp="{{$comp->id}}">ลบ</a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            @endif
                                            </table>
                                        </div>
                                    </div>
                                    <a class="btn btn-info" id="btnAddWork">เพิ่ม</a> --}}
                                    </div>
                                    <div class="col-12">
                                        <div class="mt-3">&nbsp;</div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <strong>เบอร์โทร</strong>
                                            <input type="text" name="phone" value="{{ $comp->phone }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>เบอร์โทรสำหรับส่ง SMS</label>
                                            <input type="text" name="mobile" value="{{ $comp->mobile }}"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>อีเมล</label>
                                            <input type="text" name="email" value="{{ $comp->comp_email }}"
                                                class="form-control" placeholder="test@hotmail.com">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>เว็บไซต์</label>
                                            <input type="text" name="website" value="{{ $comp->website }}"
                                                class="form-control" placeholder="www.at-once.info">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>Facebook</label>
                                            <input type="text" name="facebook" value="{{ $comp->facebook }}"
                                                class="form-control"
                                                placeholder="https://www.facebook.com/AtOnce.info">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div>
                                                    <label>Line</label>
                                                </div>
                                                <div>
                                                    <input type="checkbox" class="form-storage" name="addbynumber"
                                                        id="addbynumber" value="{{ $comp->add_by_number }}"
                                                        @if ($comp->add_by_number != 0) checked @endif>
                                                    <label for="addbyphone">เพิ่มจากเบอร์โทร</label>
                                                </div>
                                            </div>
                                            <input type="text" name="line" value="{{ $comp->line }}"
                                                class="form-control" placeholder="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs" id="myTab3" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH3-tab" data-toggle="tab"
                                                    href="#TH3" role="tab" aria-controls="TH3"
                                                    aria-selected="true">TH</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN3-tab" data-toggle="tab" href="#EN3"
                                                    role="tab" aria-controls="EN3" aria-selected="false">EN</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP3-tab" data-toggle="tab" href="#JP3"
                                                    role="tab" aria-controls="JP3" aria-selected="false">JP</a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH3-tab" data-toggle="tab" href="#CH3"
                                                    role="tab" aria-controls="CH3" aria-selected="false">CH</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTab3Content">
                                            <div class="tab-pane fade show active" id="TH3" role="tabpanel"
                                                aria-labelledby="TH3-tab">
                                                <div class="form-group">
                                                    <label>ที่อยู่ (TH)</label>
                                                    <textarea name="address_th" class="form-control" rows="3">{!! $comp->address_th !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="EN3" role="tabpanel"
                                                aria-labelledby="EN3-tab">
                                                <div class="form-group">
                                                    <label>ที่อยู่ (EN)</label>
                                                    <textarea name="address_en" class="form-control" rows="3">{!! $comp->address_en !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="JP3" role="tabpanel"
                                                aria-labelledby="JP3-tab">
                                                <div class="form-group">
                                                    <label>ที่อยู่ (JP)</label>
                                                    <textarea name="address_jp" class="form-control" rows="3">{!! $comp->address_jp !!}</textarea>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="CH3" role="tabpanel"
                                                aria-labelledby="CH3-tab">
                                                <div class="form-group">
                                                    <label>ที่อยู่ (CH)</label>
                                                    <textarea name="address_zh" class="form-control" rows="3">{!! $comp->address_zh !!}</textarea>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-lg-12 position-relative">
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <div class="input-group-text"><i class="fas fa-home"></i></div>
                                            </div>
                                            <input type="text" id="postcode" data-name="postcode[]"
                                                class="form-control" placeholder="Postcode"
                                                autocomplete="new-postcode" value="{{ $comp->postcode }}">
                                            <input type="text" id="subdistrict" data-name="subdistrict[]"
                                                class="form-control" placeholder="Subdistrict" readonly=""
                                                value="{{ $comp->subdistrict }}">
                                            <input type="text" id="district" data-name="district[]"
                                                class="form-control" placeholder="District" readonly=""
                                                value="{{ $comp->district }}">
                                            <input type="text" id="province" data-name="province[]"
                                                class="form-control" placeholder="Province" readonly=""
                                                value="{{ $comp->province }}">
                                        </div>
                                        <div id="autoAddresArea"></div>
                                        <input type="hidden" name="postcode" class="postcode form-storage"
                                            value="{{ $comp->postcode }}">
                                        <input type="hidden" name="subdistrict" class="subdistrict form-storage"
                                            value="{{ $comp->subdist_id }}">
                                        <input type="hidden" name="district" class="district form-storage"
                                            value="{{ $comp->district_id }}">
                                        <input type="hidden" name="province" class="province form-storage"
                                            value="{{ $comp->province_id }}">
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>Google Map</label>
                                            <textarea name="gmap" class="form-control form-storage" rows="5">{!! $comp->gmap !!}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="float-right"><button type="submit"
                                                class="btn btn-success">Save</button></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 style="color:#5997fb;" class="m-0">SEO (Search Engine Optimization)</h5>
                    </div>
                    <div class="card-body">
                        <label class="mt-2">Title</label>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="TH8-tab" data-toggle="tab" href="#TH8"
                                    role="tab" aria-controls="TH8" aria-selected="true">TH</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="EN8-tab" data-toggle="tab" href="#EN8" role="tab"
                                    aria-controls="EN8" aria-selected="false">EN</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="JP8-tab" data-toggle="tab" href="#JP8" role="tab"
                                    aria-controls="JP8" aria-selected="false">JP</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="CH8-tab" data-toggle="tab" href="#CH8" role="tab"
                                    aria-controls="CH8" aria-selected="false">CH</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="TH8" role="tabpanel"
                                aria-labelledby="TH8-tab">
                                <div class="form-group">
                                    <input type="text" name="title_th" class="form-control form-storage"
                                        value="{{ @$comp->title_th }}">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="EN8" role="tabpanel" aria-labelledby="EN8-tab">
                                <div class="form-group">
                                    <input type="text" name="title_en" class="form-control form-storage"
                                        value="{{ @$comp->title_en }}">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="JP8" role="tabpanel" aria-labelledby="JP8-tab">
                                <div class="form-group">
                                    <input type="text" name="title_jp" class="form-control form-storage"
                                        value="{{ @$comp->title_jp }}">
                                </div>
                            </div>
                            <div class="tab-pane fade" id="CH8" role="tabpanel" aria-labelledby="CH8-tab">
                                <div class="form-group">
                                    <input type="text" name="title_zh" class="form-control form-storage"
                                        value="{{ @$comp->title_zh }}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <label>SEO Keyword</label>
                                <ul class="nav nav-tabs" id="myTab5" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="TH5-tab" data-toggle="tab" href="#TH5"
                                            role="tab" aria-controls="TH5" aria-selected="true">TH</a>
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
                        <div class="tab-content my-2" id="myTab5Content">
                            <div class="tab-pane fade show active" id="TH5" role="tabpanel"
                                aria-labelledby="TH5-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mainseo">
                                            <label>Keyword :
                                                @if ($seo != '')
                                                    @foreach ($seo as $key => $v)
                                                        @php
                                                            $seok = explode(',', $v->seo_keyword_th);
                                                        @endphp
                                                        @foreach ($seok as $key => $word)
                                                            <span><a href="javacript:0"
                                                                    class="badge badge-secondary">{{ $word }}</a></span>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </label>
                                        </div>
                                        <input type="text" name="seo_keyword_th" class="form-control form-storage"
                                            value="{{ @$comp->seo_keyword_th }}">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="EN5" role="tabpanel"
                                aria-labelledby="EN5-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mainseo">
                                            <label>Keyword :
                                                @if ($seo != '')
                                                    @foreach ($seo as $key => $v)
                                                        @php
                                                            $seok = explode(',', $v->seo_keyword_en);
                                                        @endphp
                                                        @foreach ($seok as $key => $word)
                                                            <span><a href="javacript:0"
                                                                    class="badge badge-secondary">{{ $word }}</a></span>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </label>
                                        </div>
                                        <input type="text" name="seo_keyword_en" class="form-control form-storage"
                                            value="{{ @$comp->seo_keyword_en }}">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="JP5" role="tabpanel"
                                aria-labelledby="JP5-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mainseo">
                                            <label>Keyword :
                                                @if ($seo != '')
                                                    @foreach ($seo as $key => $v)
                                                        @php
                                                            $seok = explode(',', $v->seo_keyword_jp);
                                                        @endphp
                                                        @foreach ($seok as $key => $word)
                                                            <span><a href="javacript:0"
                                                                    class="badge badge-secondary">{{ $word }}</a></span>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </label>
                                        </div>
                                        <input type="text" name="seo_keyword_jp" class="form-control form-storage"
                                            value="{{ @$comp->seo_keyword_jp }}">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="CH5" role="tabpanel"
                                aria-labelledby="CH5-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mainseo">
                                            <label>Keyword :
                                                @if ($seo != '')
                                                    @foreach ($seo as $key => $v)
                                                        @php
                                                            $seok = explode(',', $v->seo_keyword_zh);
                                                        @endphp
                                                        @foreach ($seok as $key => $word)
                                                            <span><a href="javacript:0"
                                                                    class="badge badge-secondary">{{ $word }}</a></span>
                                                        @endforeach
                                                    @endforeach
                                                @endif
                                            </label>
                                        </div>
                                        <input type="text" name="seo_keyword_zh" class="form-control form-storage"
                                            value="{{ @$comp->seo_keyword_zh }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label class="mt-2">SEO Description</label>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="TH9-tab" data-toggle="tab" href="#TH9"
                                    role="tab" aria-controls="TH9" aria-selected="true">TH</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="EN9-tab" data-toggle="tab" href="#EN9" role="tab"
                                    aria-controls="EN9" aria-selected="false">EN</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="JP9-tab" data-toggle="tab" href="#JP9" role="tab"
                                    aria-controls="JP9" aria-selected="false">JP</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="CH9-tab" data-toggle="tab" href="#CH9" role="tab"
                                    aria-controls="CH9" aria-selected="false">CH</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active" id="TH9" role="tabpanel"
                                aria-labelledby="TH9-tab">
                                <div class="form-group">
                                    <textarea maxlength="990" class="form-control form-storage" rows="5" name="seo_description_th"
                                        placeholder="(TH)">{{ $comp->seo_description_th }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="EN9" role="tabpanel" aria-labelledby="EN9-tab">
                                <div class="form-group">
                                    <textarea maxlength="990" class="form-control form-storage" rows="5" name="seo_description_en"
                                        placeholder="(EN)">{{ $comp->seo_description_en }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="JP9" role="tabpanel" aria-labelledby="JP9-tab">
                                <div class="form-group">
                                    <textarea maxlength="990" class="form-control form-storage" rows="5" name="seo_description_jp"
                                        placeholder="(JP)">{{ $comp->seo_description_jp }}</textarea>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="CH9" role="tabpanel" aria-labelledby="CH9-tab">
                                <div class="form-group">
                                    <textarea maxlength="990" class="form-control form-storage" rows="5" name="seo_description_zh"
                                        placeholder="(CH)">{{ $comp->seo_description_zh }}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">&nbsp;</div>
                    <div class="card-body">
                        <div class="row">
                            @php($step = \App\Models\JobProgressMd::where('company', $comp->id)->first())
                            @php($userPosition = Auth::user()->position)
                            <div class="col-lg-3 text-center text-white">
                                <div class="card bg-danger">
                                    <div class="card-body">
                                        <h5>STEP 1</h5><br>
                                        <h3>
                                            @if (@$step->step1 != '')
                                            <i class="fas fa-check-circle fa-lg"></i>@else<i
                                                    class="far fa-circle fa-lg"></i>
                                            @endif CREATED
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 text-center text-white">
                                <div
                                    class="card @if (@$step->step2 == 1) bg-primary @else bg-secondary @endif">
                                    <div class="card-body">
                                        <h5>STEP 2</h5><br>
                                        <h3>
                                            {{-- @if (@$step->step2 != '')<i class="fas fa-check-circle fa-lg"></i>@else<i class="far fa-circle fa-lg"></i>@endif EDITED --}}
                                            @if (@$step->step2 == 1)
                                                <i class="fas fa-check-circle fa-lg"></i> EDITED
                                            @else
                                                @if (
                                                    $userPosition == 12 ||
                                                        $userPosition == 1 ||
                                                        Auth::user()->name == 'BOOM' ||
                                                        Auth::user()->id == 14 ||
                                                        Auth::user()->name == 'NAMFON' ||
                                                        Auth::user()->role == 'super' ||
                                                        $userPosition == 2)
                                                    <div class="custom-control custom-checkbox h3">
                                                        <input type="checkbox" name="step2"
                                                            class="custom-control-input" id="step2"
                                                            value="1">
                                                        <label class="custom-control-label"
                                                            for="step2">EDITED</label> <small
                                                            style="color:#bababa"></small>
                                                    </div>
                                                @else
                                                    <i class="far fa-circle"></i>&nbsp;EDITED
                                                @endif
                                            @endif
                                        </h3>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-3 text-center text-white">
                                <div
                                    class="card @if (@$step->step3 == 1) bg-info @else bg-secondary @endif">
                                    <div class="card-body">
                                        <h5>STEP 3</h5><br>
                                        <h3>
                                            @if (@$step->step3 == 1)
                                                <i class="fas fa-check-circle fa-lg"></i> DESIGN
                                            @else
                                                @if (
                                                    $userPosition == 1 ||
                                                        $userPosition == 2 ||
                                                        $userPosition == 12 ||
                                                        Auth::user()->id == 13 ||
                                                        Auth::user()->role == 'super')
                                                    <div class="custom-control custom-checkbox h3">
                                                        <input type="checkbox" name="step3"
                                                            class="custom-control-input" id="step3"
                                                            value="1">
                                                        <label class="custom-control-label"
                                                            for="step3">DESIGN</label> <small
                                                            style="color:#bababa"></small>
                                                    </div>
                                                @else
                                                    <i class="far fa-circle"></i>&nbsp;DESIGN
                                                @endif
                                            @endif
                                        </h3>
                                    </div>
                                </div>

                            </div>
                            <div class="col-lg-3 text-center text-white">
                                <div
                                    class="card @if (@$step->step4 == 1) bg-success @else bg-secondary @endif">
                                    <div class="card-body">
                                        <h5>STEP 4</h5><br>
                                        <h3>
                                            @if (@$step->step4 == 1)
                                            <i class="fas fa-check-circle fa-lg"></i>@else<i
                                                    class="far fa-circle fa-lg"></i>
                                            @endif ONLINE
                                        </h3>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label for="modified">Last Modified</label>
                                    <select name="modified[]" id="modified" class="form-storage modified"
                                        multiple>
                                        <option value="สร้างข้อมูลบริษัท">สร้างข้อมูลบริษัท</option>
                                        <option value="แก้ไขชื่อบริษัท">แก้ไขชื่อบริษัท</option>
                                        <option value="Change to semi type">Change to semi type</option>
                                        <option value="แก้ไข แก้ไขชื่อบริษัท URL">แก้ไข Profile URL</option>
                                        <option value="เพิ่ม Video">เพิ่ม Video</option>
                                        <option value="เพิ่ม/ลบ รูปโปรไฟล์">เพิ่ม/ลบ รูปโปรไฟล์</option>
                                        <option value="เพิ่ม/ลบ แกลเลอรี่">เพิ่ม/ลบ แกลเลอรี่</option>
                                        <option value="แก้ไขเวลาทำการ">แก้ไขเวลาทำการ</option>
                                        <option value="เพิ่ม/ลบ/แก้ไข เบอร์โทร">เพิ่ม/ลบ/แก้ไข เบอร์โทร</option>
                                        <option value="เพิ่ม/ลบ/แก้ไข อีเมล">เพิ่ม/ลบ/แก้ไข อีเมล</option>
                                        <option value="เพิ่ม/ลบ/แก้ไข Social media link">เพิ่ม/ลบ/แก้ไข Social media
                                        </option>
                                        <option value="เพิ่ม/ลบ/แก้ไข ที่อยู่">เพิ่ม/ลบ/แก้ไข ที่อยู่</option>
                                        <option value="เพิ่ม/ลบ/แก้ไข Google Map">เพิ่ม/ลบ/แก้ไข Google Map</option>
                                        <option value="เพิ่ม/แก้ไข รายละเอียดย่อ">เพิ่ม/แก้ไขรายละเอียดย่อ</option>
                                        <option value="เพิ่ม/แก้ไข รายละเอียด">เพิ่ม/แก้ไขรายละเอียด</option>
                                        <option value="เพิ่ม/แก้ไข Filter">เพิ่ม/แก้ไข Filter</option>
                                        <option value="เพิ่ม/แก้ไข HTML Design">แก้ไข HTML Design</option>
                                        <option value="เพิ่ม/แก้ไข เอกสารใบอนุญาต">เอกสารใบอนุญาต</option>
                                        <option value="เพิ่ม/แก้ไข SEO">เพิ่ม/แก้ไข SEO</option>
                                        <option value="ออนไลน์">ออนไลน์</option>
                                        <option value="ออฟไลน์">ออฟไลน์</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-xs-12">
                                <div class="form-group">
                                    <label for="revise">Revise</label>
                                    <select name="revise[]" id="revise" class="form-storage modified" multiple>
                                        <option value="สร้างข้อมูลบริษัท">สร้างข้อมูลบริษัท</option>
                                        <option value="แก้ไขชื่อบริษัท">แก้ไขชื่อบริษัท</option>
                                        <option value="Change to semi type">Change to semi type</option>
                                        <option value="แก้ไข แก้ไขชื่อบริษัท URL">แก้ไข Profile URL</option>
                                        <option value="เพิ่ม Video">เพิ่ม Video</option>
                                        <option value="เพิ่ม/ลบ รูปโปรไฟล์">เพิ่ม/ลบ รูปโปรไฟล์</option>
                                        <option value="เพิ่ม/ลบ แกลเลอรี่">เพิ่ม/ลบ แกลเลอรี่</option>
                                        <option value="แก้ไขเวลาทำการ">แก้ไขเวลาทำการ</option>
                                        <option value="เพิ่ม/ลบ/แก้ไข เบอร์โทร">เพิ่ม/ลบ/แก้ไข เบอร์โทร</option>
                                        <option value="เพิ่ม/ลบ/แก้ไข อีเมล">เพิ่ม/ลบ/แก้ไข อีเมล</option>
                                        <option value="เพิ่ม/ลบ/แก้ไข Social media link">เพิ่ม/ลบ/แก้ไข Social media
                                            link</option>
                                        <option value="เพิ่ม/ลบ/แก้ไข ที่อยู่">เพิ่ม/ลบ/แก้ไข ที่อยู่</option>
                                        <option value="เพิ่ม/ลบ/แก้ไข Google Map">เพิ่ม/ลบ/แก้ไข Google Map</option>
                                        <option value="เพิ่ม/แก้ไข รายละเอียดย่อ">เพิ่ม/แก้ไขรายละเอียดย่อ</option>
                                        <option value="เพิ่ม/แก้ไข รายละเอียด">เพิ่ม/แก้ไขรายละเอียด</option>
                                        <option value="เพิ่ม/แก้ไข Filter">เพิ่ม/แก้ไข Filter</option>
                                        <option value="เพิ่ม/แก้ไข HTML Design">แก้ไข HTML Design</option>
                                        <option value="เพิ่ม/แก้ไข เอกสารใบอนุญาต">เอกสารใบอนุญาต</option>
                                        <option value="เพิ่ม/แก้ไข SEO">เพิ่ม/แก้ไข SEO</option>
                                        <option value="ออนไลน์">ออนไลน์</option>
                                        <option value="ออฟไลน์">ออฟไลน์</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label for="reason" class="text-danger font-weight-bold">Reason:</label>
                                    <textarea rows="2" name="reason" class="form-control form-storage" id="reason">{{ @$comp->reason }}</textarea>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="float-left"><button type="button"
                                        class="btn btn-warning new-report">Report</button></div>

                                <div class="float-right"><button type="submit"
                                        class="btn btn-success">Save</button></div>
                            </div>
                            <div class="col-lg-12">
                                <div class="text-center bg-light mt-3">
                                    {{ \App\Helpers\BaseHp::time_passed_backend($comp->updated) }}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div id="areaAlert"></div>
                            </div>
                        </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        var categorySL = new SlimSelect({
            select: '#my-category'
        });
        var countrySl = new SlimSelect({
            select: '#country'
        });
        const areaFilter = document.getElementById('area-filter');
        const filterCategory = document.getElementById('filter-category');

        function generateFilter() {
            areaFilter.innerHTML = '';
            const Filters = document.querySelectorAll('.filters');
            const slim = {},
                allData = {};
            Filters.forEach((el, i) => {
                type = el.getAttribute('data-type');
                thisName = el.getAttribute('data-name');
                thisLabel = el.getAttribute('data-label');
                let val = el.getAttribute('data-val');
                if (val) val = JSON.parse(val);
                filter = el.getAttribute('data-filter');
                if (filter != undefined && filter != '') {
                    console.log(filter)
                    filter = JSON.parse(filter);
                }

                ColSelect = document.createElement('div');
                ColSelect.classList.add('col-lg-4');
                if (type == 'text') {
                    formGroup = document.createElement('div');
                    formGroup.classList.add('form-group');
                    ColSelect.append(formGroup);
                    selectAll = el.getAttribute('select-all');
                    label = `
                        <label>${thisLabel}</label>
                        ${selectAll=='true'?`<label class="ml-3"><input name="select-all" type="checkbox" select-to="${thisName}" class="mr-1 select-all">เลือกทั้งหมด</label>`:``}
                        <select name="${thisName}[]" class="form-storage" id="${thisName}" multiple=""></select>
                    `;
                    ColSelect.querySelector('.form-group').innerHTML = label;
                    html = '';
                    allData[i] = [];
                    filter.forEach(v => {
                        if (val)
                            check = val.map((j, i) => j.key == v.key);
                        else
                            check = [];
                        selected = check.indexOf(true) > -1 ? 'selected=""' : '';
                        html += `<option value="${v.key}" ${selected}>${v.name}</option>`;
                        allData[i].push(v.key)
                    })
                    ColSelect.querySelector('select').innerHTML = html;
                    areaFilter.append(ColSelect);
                    slim[i] = new SlimSelect({
                        select: `#${thisName}`
                    });
                    areaFilter.querySelector('.select-all')?.addEventListener('change', function(e) {
                        const selectAll = e.target.closest('.select-all');
                        if (selectAll) {
                            to = selectAll.getAttribute('select-to');
                            slim[i].set(allData[i]);
                        }
                    })

                } else {
                    if (val)
                        check = val.map((j, i) => j.key == '1');
                    else
                        check = [];
                    checked = check.indexOf(true) > -1 ? 'checked=""' : '';
                    formGroup = document.createElement('div');
                    formGroup.classList.add('form-group');
                    label =
                        `<label>
                        <input type="${type}" name="${thisName}[]" class="form-storage" value="1" ${checked}>&nbsp;${thisLabel}</label>`;
                    if (areaFilter.querySelector('input[type="checkbox"]') == null) {
                        ColSelect.append(formGroup);
                        ColSelect.querySelector('.form-group').innerHTML = label;
                        areaFilter.append(ColSelect);
                    } else {
                        formGroup = document.createElement('div');
                        formGroup.classList.add('form-group');
                        formGroup.innerHTML = label;
                        areaFilter.querySelector('input[type="checkbox"]').closest('.col-lg-4').append(formGroup);
                    }
                }
            })
        }
        generateFilter();

        function filters() {
            const filters = $.ajax({
                method: 'get',
                url: 'webpanel/members/filter',
                async: false,
                dataType: "json",
                data: {
                    category: $('#my-category').val()
                }
            }).responseJSON;
            return filters;
        }

        $(document).on('change', '#my-category', function() {
            insertFilter(parseFloat($(this).val()), filters());
        })

        function insertFilter(type, filters) {
            filterCategory.innerHTML = '';
            filters.input.forEach((v, k) => {
                input = document.createElement('input');
                input.setAttribute('type', 'hidden');
                input.setAttribute('class', 'filters');
                input.setAttribute('data-label', v.label);
                input.setAttribute('data-type', v.type);
                input.setAttribute('data-name', v.name);
                if (filters?.filter[v.name])
                    input.setAttribute('data-filter', JSON.stringify(filters.filter[v.name]));
                filterCategory.append(input);
            })
            generateFilter();
        }



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
        $("#bg_image").on('change', function() {
            var $this = $(this);
            var input = $(this)[0];
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#bg_preview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);

                $this.siblings(".custom-file-label").addClass("selected").html(input.files[0].name.toString());
            }
        });
        $('#btnAddWork').click(function() {
            var stringRand = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2,
                15);
            var html = '<tr id="working_' + stringRand +
                '" class="workItem">\
                                                                                <td>\
                                                                                    <select class="form-control" name="cp_working_day_add[' +
                stringRand +
                ']">\
                                                                                        <option value="">โปรดเลือกวัน</option>\
                                                                                        @foreach ($day as $d)\
                                                                                            <option value="{{ $d->id }}">{{ $d->name_th }}</option>\
                                                                                        @endforeach\
                                                                                    </select>\
                                                                                </td>\
                                                                                <td>\
                                                                                    <input type="text" class="form-control" name="cp_working_time_add[' +
                stringRand +
                ']" value="">\
                                                                                </td>\
                                                                                <td>\
                                                                                    <a href="javascript:void(0)" class="deleteItemWorkNomal" data-id="' +
                stringRand + '">ลบ</a>\
                                                                                </td>\
                                                                            </tr>';
            $('#areaWorkTime').append(html);
        });
        // $('#gallery').filer();

        $('#postcode').addressAuto({
            subdistict: '#subdistrict',
            distict: '#subdistrict',
            province: '#province',
            displayAuto: '#autoAddresArea',
            // width : 500,
            // top : $('#postcode').offset().top
        });


        $('.saveData').click(function() {
            showAlert('areaAlert_30');
        });

        $('input[name^="day"]').on('change', function() {
            let $next = $(this).parent().next();
            if ($(this).is(':checked')) {
                $next.removeAttr('disabled');
            } else {
                $next.val('');
                $next.attr('disabled', 'disabled');
            }
        })
        var workingHour = $('.working_hour').data('val');
        $.each(workingHour, function(k, v) {
            $('input[name^="day"]').map(function() {
                if ($(this).val() == v.day) {
                    $(this).prop('checked', true);
                    $(this).parent().next().val(v.time).removeAttr('disabled');
                }
            })
        })


        function showAlert(area) {
            var html = '<div class="alert alert-success alert-dismissible fade show">\
                                                                            <strong>สำเร็จ !</strong> บันทึกข้อมูลเรียบร้อย.\
                                                                            <button type="button" class="close" data-dismiss="alert">&times;</button>\
                                                                        </div>';
            return $('#' + area).html(html);
        }

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
        //     relative_urls : false,
        //     remove_script_host : false,
        //     convert_urls : true,
        //     plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","save table contextmenu directionality emoticons template paste textcolor colorpicker layer textpattern moxiemanager"],
        //     toolbar: 'insertfile undo redo | table | styleselect fontselect fontsizeselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | print nonbreaking hr emoticons code',

        // });

        $(document).on('click', '.deleteItemWorkNomal', function() {
            var id = $(this).data('id');
            $('#working_' + id).slideUp("slow", function() {
                $(this).remove();
            });
        });
        $('.deleteItemWork').click(function() {
            Swal.fire({
                title: 'ต้องการลบใช่หรือไม่ ?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'ใช่ !'
            }).then((result) => {
                if (result.isConfirmed) {
                    // OpenLoading();
                    var id = $(this).data('id');
                    var cp_id = $(this).data('cp');
                    var token = "{{ csrf_token() }}";
                    $.ajax({
                        type: 'post',
                        url: '{{ url($prefix . $segment . '/deleteItemTime') }}',
                        data: {
                            id: id,
                            _token: token,
                            cp_id: cp_id
                        },
                        success: function(data) {
                            // CloseLoading();
                            Swal.fire(
                                'สำเร็จ !',
                                'ลบรายการออกแล้ว',
                                'success'
                            ).then((result) => {
                                $('#working_' + id).slideUp("slow", function() {
                                    $(this).remove();
                                });
                            })
                        },
                        error: function() {
                            // CloseLoading();
                            Swal.fire(
                                'Error!',
                                'มีบางอย่างผิดพลาด !',
                                'error'
                            )
                        }
                    });
                }
            })

        });
        $(document).on('change', 'input[name="category"]', function() {
            $.ajax({
                method: 'get',
                url: 'webpanel/member/filter',
                data: {
                    category: $(this).val(),
                    success: function() {}
                }
            })
        })

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
                                                                                       <img class="img-thumbnail" src="' +
                    URL
                    .createObjectURL(
                        event
                        .target
                        .files[
                            i]) + '">\
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
                    // OpenLoading();
                    var token = "{{ csrf_token() }}";
                    $.ajax({
                        type: 'post',
                        url: '{{ url($prefix . $segment . '/deleteItemGallery') }}',
                        data: {
                            id: id,
                            _token: token
                        },
                        success: function(data) {
                            // CloseLoading();
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
                            // CloseLoading();
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
        var re = new RegExp(
            "^([ก-๙]|[a-z]|[0-9]|[/]|[\\]|[ ]|[\n]|[.]|[ๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ])+$",
            "g");
        // patternTH = re.compile("[^\u0E00-\u0E7Fa-zA-Z' ]|^'|'$|''");

        // $('input[name="name_th"]').on('keyup change',function(){
        //     var pattern_thai = /^[ก-๏\s]+$/u;
        //     var input_name_th = $(this).val();
        //     if(!input_name_th.match(pattern_thai)) $(this).addClass('is-invalid'); else $(this).removeClass('is-invalid');


        // })
    </script>

    <div class="modal fade" id="VideoUpload" tabindex="-1" role="dialog" aria-labelledby="VideoUploadLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="VideoUploadLabel">Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12" style="border-bottom: 1px solid #dedede; padding-bottom:10px;">
                            <div class="float-left">
                                <button type="button" id="uploadZoneBtn"
                                    class="btn btn-sm btn-primary">Upload</button>
                                <button type="button" id="uploadBack" class="btn btn-sm btn-secondary"
                                    style="display:none;">Back</button>
                            </div>
                            <div class="float-right view-group">
                                <button type="button" id=""
                                    class="btn btn-sm btn-secondary v-view list active"><i
                                        class="fas fa-list-ul"></i></button>
                                <button type="button" id=""
                                    class="btn btn-sm btn-secondary v-view column"><i
                                        class="fas fa-columns"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="vExplorerZone">
                        <div class="col-lg-12 v-col list-item"></div>
                        <div class="col-lg-12 v-col">
                            <video id="vPreview" width="100%" controls style="display: none;"></video>
                        </div>
                        <div class="col-lg-12 v-footer">
                            <div class="flex">
                                <span><strong>File name: </strong><span></span></span>
                                <div class="float-right mt-2">
                                    <button class="btn btn-primary btn-sm v-select">Select</button>
                                    <button class="btn btn-secondary btn-sm v-cancel"
                                        data-dismiss="modal">Cancel</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" id="vUploadZone" style="display: none;">
                        <div class="col-lg-12">
                            <div class="vContentUpload"
                                style="min-height:35vh; max-height:40vh; overflow-y: auto; overflow-x: hidden;display: grid;">
                                <span class="choose" style="margin: auto;">Choose file</span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button class="btn btn-secondary my-3 btn-sm v-btn-choose">Add files<input
                                    type="file" name="v_upload" multiple="" accept="video/mp4,video/x-m4v"
                                    style="margin-top:15px; display: none"></button>
                        </div>
                        <div class="col-lg-12" style="border-top:1px solid #dedede; padding-top:15px;">
                            <div class="float-right">
                                <button class="btn btn-primary btn-sm" id="vUpload">Upload</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" name="fillInSpecial" value="{{ Auth::user()->fill }}">
    <script src="js/b64toBlob.js"></script>
    <script src="js/jquery.selection.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/a-color-picker@1.1.8/dist/acolorpicker.js"></script>
    <script src="js/drag-arrange.js"></script>
    <script src="back-end/build/skEditor.js?v=00001"></script>
    <script src="back-end/build/video.upload.js"></script>
    <script src="js/jquery.validate-v1.18.js"></script>

    <script src="bootstrap-multiselect/dist/js/bootstrap-multiselect.min.js"></script>
    <script>
        $('#more_th').skEditor({
            height: '600px'
        });
        $('#more_jp').skEditor({
            height: '600px'
        });
        $('#more_en').skEditor({
            height: '600px'
        });
        $('#more_zh').skEditor({
            height: '600px'
        });
        // new SlimSelect({select:'#modified'});
        $('#modified').multiselect({
            buttonWidth: '100%',
            enableFiltering: true,
            buttonText: function(options, select) {
                if (options.length == 0) {
                    return this.nonSelectedText
                }
                var selected = '';
                options.each(function() {
                    var label = ($(this).attr('label') !== undefined) ? $(this).attr('label') : $(this)
                        .html();

                    selected += label + ', ';
                });
                return selected.substr(0, selected.length - 2);
            }

        });
        $('#revise').multiselect({
            buttonWidth: '100%',
            enableFiltering: true,
            buttonText: function(options, select) {
                if (options.length == 0) {
                    return this.nonSelectedText
                }
                var selected = '';
                options.each(function() {
                    var label = ($(this).attr('label') !== undefined) ? $(this).attr('label') : $(this)
                        .html();

                    selected += label + ', ';
                });
                return selected.substr(0, selected.length - 2);
            }

        });
        const fill = ($('input[name="fillInSpecial"]').val() == 1) ? true : false;

        $('#formEdit').validate({
            ignore: [],
            groups: { // consolidate messages into one
                names: "modified[] revise[]"
            },
            rules: {
                profile_url: {
                    required: true,
                    formatEN: true,
                    remote: {
                        url: "{{ url('webpanel/members/check/profile-url/duplicate') }}",
                        data: {
                            _token: "{{ csrf_token() }}",
                            id: $('input[name="cp_id"]').val()
                        },
                        type: "post"
                    }
                },
                name_th: {
                    required: true /*,formatTH:true*/
                },
                name_jp: {
                    required: true
                },
                category: {
                    required: true
                },
                'modified[]': {
                    require_from_group: [1, ".modified"]
                },
                'revise[]': {
                    require_from_group: [1, ".modified"]
                }
            },
            messages: {
                profile_url: {
                    required: 'กรุณากรอก URL',
                    formatEN: 'กรุณากรอกภาษาอังกฤษ',
                    remote: '*** URL นี้ถูกใช้ไปแล้ว ***'
                },
                name_th: {
                    required: 'กรุณากรอกชื่อบริษัท',
                    /*formatTH:'กรุณากรอกภาษาไทย'*/
                },
                name_jp: {
                    required: 'กรุณากรอกชื่อบริษัท'
                },
                category: {
                    required: 'กรุณาเลือกประเภทธุรกิจ'
                },
                'modified[]': {
                    require_from_group: '*** กรุณาเลือกการแก้ไขล่าสุดของคุณ ***'
                },
                'revise[]': {
                    require_from_group: '*** กรุณาเลือกการแก้ไขล่าสุดของคุณ ***'
                }
            },
            highlight: function(element, errorClass, validClass) {
                if ($(element).attr('id') == 'modified') {
                    $(element).parent().find('.custom-select').addClass('text-danger');
                } else {
                    $(element).addClass("error");
                }
            },
            unhighlight: function(element, errorClass, validClass) {
                if ($(element).attr('id') == 'modified') {
                    $(element).parent().find('.custom-select').removeClass('text-danger');
                } else {
                    $(element).removeClass("error");
                }
            },
            errorPlacement: function(error, element) {
                if (element.attr("id") == 'modified') {
                    element.parent().append(error);
                } else {
                    error.insertAfter(element);
                }
            },

        });
        jQuery.validator.addMethod("require_from_group", function(value, element, options) {
            var numberRequired = options[0];
            var selector = options[1];
            var fields = $(selector, element.form);
            var filled_fields = fields.filter(function() {
                return $(this).val() != "";
            });
            var empty_fields = fields.not(filled_fields);
            if (filled_fields.length < numberRequired && empty_fields[0] == element) {
                return false;
            }
            return true;
        });
        jQuery.validator.addMethod('formatTH', function(v, e) {
            return (!v.match(/^[ก-๏0-9-.()\s]+$/u)) ? false : true;
        }, 'กรุณากรอกภาษาไทย');
        jQuery.validator.addMethod('formatEN', function(v, e) {
            return (!v.match(/^[A-z0-9-\s]+$/u)) ? false : true;
        }, 'กรุณากรอกภาษาอังกฤษ');

        // $(document).on('change', 'input[name="type"]', function() {
        //     $(this).closest('.card').addClass('selected');
        //     // $(this).closest('.card').find('selected');
        //     $('input[name="type"]').not(this).closest('.card').removeClass('selected');
        //     if ($(this).val() == 'basic') {
        //         $('#formBasicEdit').removeClass('d-none');
        //         $('#formEdit').addClass('d-none');
        //     } else {
        //         $('#formBasicEdit').addClass('d-none');
        //         $('#formEdit').removeClass('d-none');
        //     }
        // })

        if ($('input[name="restored"]').val() == true) {

            removeFormStorage()
        }
        if ($('input[name="afterUpdate"]').length > 0) {
            let afterUpdate = $('input[name="afterUpdate"]').val();
            let Icon = afterUpdate === 'success' ? 'success' : 'error';
            let Text = afterUpdate === 'success' ? 'Date has been saved.' : 'An error has occurred.';
            Swal.fire({
                icon: Icon,
                title: 'Save the changes',
                text: Text,
                toast: true,
                position: 'center',
                timer: 3000
            });
        }

        // Local Storage form
        var typingTimer;
        var doneTypingInterval = 150;
        var $input = $('input.form-storage');
        var typeOfCompany = $(`input[name="type"]`).map(function() {
            if ($(this).is(':checked')) return $(this).val()
        }).get().toString();


        $input.on('keyup', function() {
            clearTimeout(typingTimer);
            typingTimer = setTimeout(() => {
                formStorage($(this).attr('name'), $(this).val())
            }, doneTypingInterval);
        });
        $input.on('keydown', function() {
            clearTimeout(typingTimer);
        });
        $(document).on('change', 'select.form-storage', function() {
            formStorage($(this).attr('name'), $(this).val())
        })
        // $(document).on('change','.sk-body',function(){
        //     let cur = $(this);
        //     let n = cur.closest('.sk-area').find('textarea').attr('name');
        //     let v = cur.html().clone();
        // });

        $(document).bind('change', 'input.postcode', function() {
            let postcode = $(this).val();
            setTimeout(() => {
                postcode = (postcode == '') ? $('.postcode').val() : postcode;
                if (postcode != '') formStorage('postcode', postcode);
            }, 1000);
        });
        $(document).bind('change', 'input.subdistrict', function() {
            let subdistrict = $(this).val();
            setTimeout(() => {
                subdistrict = (subdistrict == '') ? $('.subdistrict').val() : subdistrict;
                if (subdistrict != '') formStorage('subdistrict', subdistrict);
            }, 1000);
        });
        $(document).bind('change', 'input.district', function() {
            let district = $(this).val();
            setTimeout(() => {
                district = (district == '') ? $('.district').val() : district;
                if (district != '') formStorage('district', district);
            }, 1000);
        });
        $(document).bind('change', 'input.province', function() {
            let province = $(this).val();
            setTimeout(() => {
                province = (province == '') ? $('.province').val() : province;
                if (province != '') formStorage('province', province);
            }, 1000);
        })
        $(document).on('change', 'input.form-storage', function() {
            let type = $(this).attr('type');
            if ($(this).attr('id') == 'postcode') {
                formStorage('postcode', $(this).val())
            } else {
                switch (type) {
                    case 'checkbox':
                        if ($(this).is(':checked')) {
                            formStorage($(this).attr('name'), $(this).val());
                        } else {
                            removeFormItem($(this).attr('name'))
                        }
                        break;
                    case 'radio':
                        formStorage($(this).attr('name'), $(this).val());
                        break;
                }
            }
        })

        var formStore = JSON.parse(localStorage.getItem('formStorage'));
        var restoreContent = $(
            '<div class="position-fixed restore-content"><div class="restore-content-header"><i class="fas fa-exclamation-triangle mr-1 store-log"></i><span>Restore</span><i class="fas fa-minus float-right to-minimize"></i></div><div class="restore-content-body mt-2 mb-3"><h6>Do you want to restore the previously entered information?</h6></div><div class="restore-content-footer"><div class="d-flex"></div></div></div'
        )
        if (formStore == null) formStore = {};

        // if(formStore?.cp_id != null){
        formEl = ($('input[name="type"]:checked').length > 0) ? $(`#formEdit`) : $('#formBasicEdit');
        // console.log(formEl.find('input[name="cp_id"]').val())
        btn =
            '<a href="javascript:#" class="btn btn-warning btn-sm btn-block btn-restore">Confirm</a><button class="btn btn-secondary btn-sm btn-block mt-0 ml-1" onclick="confirmRemove()">Dismiss</button>';

        if (formStore?.cp_id == formEl.find('input[name="cp_id"]').val()) {
            restoreContent.find('.d-flex').append(btn);
            $('.fade-in').prepend(restoreContent);
        }
        // }
        $(document).on('click', '.btn-restore', function() {
            restoreFormStorage()
            // removeFormStorage()
        })
        $(document).on('click', '.to-minimize', function() {
            $('.restore-content').addClass('minimize');
        })
        $(document).on('click', '.minimize', function() {
            $(this).removeClass('minimize');
        })
        $(document).on('click', '.store-log', function() {
            console.log(JSON.parse(localStorage.getItem('formStorage')));
        })

        function checkRestoreData() {
            let formStore = JSON.parse(localStorage.getItem('formStorage'));
            if (formStore?.cp_id == null) {
                $('.restore-content').remove();
            }
        }

        function confirmRemove() {
            if (confirm('กรุณายืนยัน! ข้อมูลกู้คืนจะถูกลบถาวร')) {
                removeFormStorage();
            }
        }

        function formStorage(name, value) {
            formEl = (typeOfCompany == 'full') ? $('#formEdit') : $('#formBasicEdit');
            formStore['cp_id'] = formEl.find('input[name="cp_id"]').val();
            if (formStore?.type == null) formStore[`type`] = typeOfCompany == 'full' ? 'full' : 'basic';
            formStore[`${name}`] = value;
            localStorage.setItem(`formStorage`, JSON.stringify(formStore));
        }

        function removeFormItem(name) {
            let formStore = JSON.parse(localStorage.getItem('formStorage'));
            delete formStore[`${name}`];
            localStorage.setItem(`formStorage`, JSON.stringify(formStore));
        }

        function removeFormStorage() {
            localStorage.removeItem('formStorage');
            checkRestoreData();
        }

        function restoreFormStorage() {
            let formStore = JSON.parse(localStorage.getItem('formStorage'));
            // console.log(formStore);
            // return false;

            // data = formStore == null ? {} : JSON.parse(formStore);
            //

            if (formStore?.type == 'full' && formStore != null) {
                $.each(formStore, (k, v) => {
                    if (k == 'type') {
                        $('#full').prop('checked', true);
                        $('#formBasicEdit').addClass('d-none');
                    } else if (
                        k == 'name_th' || k == 'name_en' || k == 'name_jp' || k == 'name_zh' ||
                        k == 'video_profile' ||
                        k == 'profile_url' ||
                        k == 'phone' || k == 'mobile' || k == 'email' || k == 'website' || k == 'faebook' || k ==
                        'line'
                    ) {
                        $(`input[name="${k}"]`).val(v);
                    } else if (
                        k == 'detail_th' || k == 'detail_en' || k == 'detail_jp' || k == 'detail_zh' ||
                        k == 'description_th' || k == 'description_en' || k == 'description_jp' || k ==
                        'description_zh' ||
                        k == 'address_th' || k == 'address_en' || k == 'address_jp' || k == 'address_zh' ||
                        k == 'gmap' || k == 'reason'
                    ) {
                        $(`textarea[name="${k}"]`).html(v);
                    } else if (
                        k == 'more_th' || k == 'more_en' || k == 'more_jp' || k == 'more_zh'
                    ) {
                        let area = $(`textarea[name="${k}"]`).closest('.sk-area').find('.sk-body');
                        area.html('');
                        area.append(v);
                    } else if (
                        k == 'day[0]' || k == 'day[1]' || k == 'day[2]' || k == 'day[3]' || k == 'day[4]' || k ==
                        'day[5]' || k == 'day[6]'
                    ) {
                        $(`input[name="${k}"]`).prop('checked', true);
                    } else if (
                        k == 'time[0]' || k == 'time[1]' || k == 'time[2]' || k == 'time[3]' || k == 'time[4]' ||
                        k == 'time[5]' || k == 'time[6]'
                    ) {
                        $(`input[name="${k}"]`).prop('disabled', false).val(v);
                    } else if (
                        k == 'category'
                    ) {
                        categorySL.set(v);
                    } else if (k == 'postcode') {
                        $(`#${k}`).val(v);
                        $(`input[name="${k}"]`).val(v);
                    }
                    if (k == 'internal' || k == 'domestic' || k == 'packing' || k == 'urgent' || k == 'postpay') {
                        $(`input[name="${k}"]`).prop('checked', true);
                    }
                    if (k == 'international[]' && v.length > 0 && internationalSL != null) {
                        internationalSL.set(v);
                    }
                    if (k == 'method[]' && v.length > 0 && methodSL != null) {
                        methodSL.set(v);
                    }
                    if (k == 'item[]' && v.length > 0 && itemSL != null) {
                        itemSL.set(v);
                    }
                    if (k == 'warehouse[]' && v.length > 0 && warehouseSL != null) {
                        warehouseSL.set(v);
                    }
                    if (k == 'service[]' && v.length > 0 && serviceSL != null) {
                        serviceSL.set(v);
                    }
                    if (k == 'location[]' && v.length > 0 && locationSL != null) {
                        locationSL.set(v);
                    }
                    if (k == 'condition[]' && v.length > 0 && conditionSL != null) {
                        conditionSL.set(v);
                    }
                    if (k == 'translate[]' && v.length > 0 && translateSL != null) {
                        translateSL.set(v);
                    }
                    if (k == 'speciality[]' && v.length > 0 && specialitySL != null) {
                        specialitySL.set(v);
                    }
                    if (k == 'status[]' && v.length > 0 && statusSL != null) {
                        statusSL.set(v);
                    }
                    if (k == 'carType[]' && v.length > 0 && carTypeSL != null) {
                        carTypeSL.set(v)
                    }
                    if (k == 'period[]' && v.length > 0 && periodSL != null) {
                        periodSL.set(v);
                    }
                    if (k == 'other[]' && v.length > 0 && otherSL != null) {
                        otherSL.set(v);
                    }
                    if (k == 'visa[]' && v.length > 0 && visaSL != null) {
                        visaSL.set(v);
                    }
                    if (k == 'consulting[]' && v.length > 0 && consultingSL != null) {
                        consultingSL.set(v);
                    }
                    if (k == 'type[]' && v.length > 0 && typeSL != null) {
                        typeSL.set(v);
                    }
                    if (k == 'minimum[]' && v.length > 0 && minimumSL != null) {
                        minimumSL.set(v);
                    }
                    if (k == 'nationality[]' && v.length > 0 && nationalitySL != null) {
                        nationalitySL.set(v);
                    }
                    if (k == 'language[]' && v.length > 0 && languageSL != null) {
                        languageSL.set(v);
                    }
                    if (k == 'position[]' && v.length > 0 && positionSL != null) {
                        positionSL.set(v);
                    }
                    if (k == 'seat[]' && v.length > 0 && seatSL != null) {
                        seatSL.set(v);
                    }
                    if (k == 'rental[]' && v.length > 0 && rentalSL != null) {
                        rentalSL.set(v);
                    }
                    if (k == 'fuel[]' && v.length > 0 && fuelSL != null) {
                        fuelSL.set(v);
                    }
                    if (k == 'personal[]' && v.length > 0 && personalSL != null) {
                        personalSL.set(v);
                    }
                    if (k == 'business[]' && v.length > 0 && businessSL != null) {
                        businessSL.set(v);
                    }
                    if (k == 'software[]' && v.length > 0 && softwareSL != null) {
                        softwareSL.set(v);
                    }
                    if (k == 'hardware[]' && v.length > 0 && hardwareSL != null) {
                        hardwareSL.set(v);
                    }
                    if (k == 'solution[]' && v.length > 0 && solutionSL != null) {
                        solutionSL.set(v);
                    }

                })
            }
            if (formStore?.type == 'basic' && formStore != null) {
                let thisForm = $('#formBasicEdit');
                // $('#formEdit').addclass('d-none');
                $('#basic').prop('checked', true);
                $.each(data, (k, v) => {
                    if (k == 'name_th' || k == 'phone' || k == 'email' || k == 'profile_url') thisForm.find(
                        `input[name="${k}"]`).val(v);
                    if (k == 'description_th' || k == 'more_th' || k == 'address_th') thisForm.find(
                        `textarea[name="${k}"]`).val(v);
                })
            }

        }

        if ($('input[name="restored"]').val() == true) {

            removeFormStorage()
        }
        if ($('input[name="afterUpdate"]').length > 0) {
            let afterUpdate = $('input[name="afterUpdate"]').val();
            let Icon = afterUpdate === 'success' ? 'success' : 'error';
            let Title = afterUpdate === 'success' ? 'Date has been saved.' : 'An error has occurred.';
            Swal.fire({
                icon: Icon,
                title: Title,
                showConfirmButton: false,
                toast: true,
                position: 'top',
                timer: 2000
            });
        }

        function PrintElem(elem) {
            var mywindow = window.open('', 'PRINT', 'height=400,width=600');

            mywindow.document.write('<html><head><title>' + document.title + '</title>');
            mywindow.document.write('</head><body >');
            mywindow.document.write('<h1>' + document.title + '</h1>');
            mywindow.document.write(document.getElementById(elem).innerHTML);
            mywindow.document.write('</body></html>');

            mywindow.document.close(); // necessary for IE >= 10
            mywindow.focus(); // necessary for IE >= 10*/

            mywindow.print();
            mywindow.close();

            return true;
        }
    </script>
