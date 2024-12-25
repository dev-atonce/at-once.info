<!doctype html>
<html lang="{{ Session('lang') }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ENV('APP_NAME') }}</title>

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/header-footer.css" rel="stylesheet">
    <link href="css/member-company.css?v=002" rel="stylesheet">
    <link rel="stylesheet" href="css/gallery.css?v=0001">
    <link rel="stylesheet" href="css/validate.css">
    <link rel="stylesheet" href="css/skEditor-0.2.css?v=0001">
    <style>
        .mce-btn,
        .mce-panel {
            background-color: #fff !important;
        }

        input.error {
            border: 1px solid red;
        }

        input.error:focus {
            border-color: rgb(255, 128, 128);
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25);
        }

        .h5 {
            font-size: 18px;
            font-weight: bold;
        }

        .h4 {
            font-size: 20px;
            font-weight: bold;
        }

        .custom-file-label.selected {
            overflow: hidden;
        }
    </style>

</head>

<body>
    @include("$prefix.header")
    @php($path = $module != 'member' ? '{{ $path }}' : '/member')
    <section class="page">
        <div class="container">
            <div class="col-lg-12">
                <div class="personal row" style="box-shadow: rgba(0, 0, 0, 0.08) 0px 4px 16px;">
                    <div class="left">
                        @include("$prefix.member.member-menu")
                    </div>
                    <div class="right">
                        <div class="group-box-right">
                            <strong class="bold border-bottom mb-5 h5">@lang('phrase.activity')</strong>
                            <form method="post" action="" enctype="multipart/form-data" id="addFormBlog">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <button type="submit"
                                            class="btn btn-success btn-sm float-right mb-2">@lang('phrase.save')</button>
                                        <a class="btn btn-danger btn-sm float-right mb-2 mr-2"
                                            href="{{ url('') . '/' . Session('lang') . "/member/activity/$category/$cid" }}">@lang('phrase.cancel')</a>
                                    </div>
                                </div>
                                @if (Session('status'))
                                    <div class="alert alert-{{ Session('status') }} alert-dismissible fade show"
                                        role="alert">
                                        <strong class="bold"> {{ Session('message') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <label for="">@lang('phrase.member.activity.blog-img') : <span
                                                    class="text-danger">@lang('phrase.member.activity.blog-img-rule')</span></label>
                                        </div>
                                        <div>
                                            <img src="img/no-img-banner.jpg" class="mb-3" id="preview"
                                                style="width: 100%; overflow:hidden;">
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-group">
                                                    <div class="input-group">
                                                        <div class="custom-file">
                                                            <input type="file"
                                                                class="custom-file-input @error('image')is-invalid @enderror"
                                                                name="image" id="image">
                                                            <label class="custom-file-label" for="image">Choose
                                                                file @error('image')
                                                                    <small class="text-danger">{{ $message }}</small>
                                                                @enderror
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($cid == env('TCF_ID') || $cid == env('HANKYU_ID') || $cid == 64)
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <select name="type" id="type" class="form-control">
                                                            <option value="" hidden>Choose Type ...</option>
                                                            <option value="selfedit"
                                                                {{ old('type') == 'selfedit' ? 'selected' : '' }}>
                                                                General</option>
                                                            @if ($cid == env('TCF_ID'))
                                                                <option value="ma"
                                                                    {{ old('type') == 'ma' ? 'selected' : '' }}>MA
                                                                </option>
                                                            @endif
                                                            @if ($cid == env('HANKYU_ID') || $cid == 64)
                                                                <option value="news"
                                                                    {{ old('type') == 'news' ? 'selected' : '' }}>News
                                                                </option>
                                                                <option value="job-search"
                                                                    {{ old('type') == 'job-search' ? 'selected' : '' }}>Jobs
                                                                </option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row carreerFilter d-none">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="position">Position: @error('position')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </label>
                                            <select name="position" id="position"
                                                class="form-control @error('position')is-invalid @enderror">
                                                <option value="" hidden>Choose ...</option>
                                                @if ($position)
                                                    @foreach (@$position['rows'] as $k => $v)
                                                        <option value="{{ $v['id'] }}"
                                                            {{ old('position') == $v['id'] ? 'selected' : '' }}>
                                                            {{ $v['nameTH'] . ' / ' . $v['nameEN'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="location">Location: @error('location')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </label>
                                            <select name="location" id="location"
                                                class="form-control @error('location')is-invalid @enderror">
                                                <option value="" hidden>Choose ...</option>
                                                @foreach (@$location as $k => $v)
                                                    <option value="{{ $v->province_id }}"
                                                        {{ old('location') == $v->province_id ? 'selected' : '' }}>
                                                        {{ $v->province_name_th }} / {{ $v->province_name_en }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row maFilter d-none">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="industry">ประเภทอุตสาหกรรม: @error('industry')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </label>
                                            <select name="industry" id="industry"
                                                class="form-control @error('industry')is-invalid @enderror">
                                                <option value="" hidden>Choose ...</option>
                                                @foreach (@$industry as $k => $v)
                                                    <option value="{{ $v['id'] }}"
                                                        {{ old('industry') == $v['id'] ? 'selected' : '' }}>
                                                        {{ $v['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="product">สินค้า/บริการ: @error('productItem')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </label>
                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-outline-secondary w-100 @error('productItem')is-invalid @enderror"
                                                    type="button" id="product" disabled aria-haspopup="true"
                                                    aria-expanded="false">
                                                    Choose Product ...
                                                </button>
                                                <div class="dropdown-menu product-list"></div>
                                                <input type="hidden" name="producthidden" id="producthidden"
                                                    value="{{ json_encode(old('productItem')) }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="opportunity">ความต้องการ: @error('opportunity')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </label>
                                            <select name="opportunity" id="opportunity"
                                                class="form-control @error('opportunity')is-invalid @enderror">
                                                <option value="" hidden>Choose ...</option>
                                                <option value="1"
                                                    {{ old('opportunity') == 1 ? 'selected' : '' }}>Buy</option>
                                                <option value="2"
                                                    {{ old('opportunity') == 2 ? 'selected' : '' }}>Sell</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="price">ยอดขายต่อปี: @error('price')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </label>
                                            <input class="form-control @error('price')is-invalid @enderror"
                                                id="price" name="price" type="text" placeholder=""
                                                aria-label=" example" value="{{ old('price') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    {{-- name --}}
                                    <div class="col-lg-12">
                                        <label for="name_th">@lang('phrase.member.activity.blog-name'): @error('name_th')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </label>
                                        <ul class="nav nav-tabs" id="myTab2">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH2-tab" data-toggle="tab"
                                                    href="#TH2" role="tab" aria-controls="TH2"
                                                    aria-selected="true"><small>TH</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN2-tab" data-toggle="tab" href="#EN2"
                                                    role="tab" aria-controls="EN2"
                                                    aria-selected="false"><small>EN</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP2-tab" data-toggle="tab" href="#JP2"
                                                    role="tab" aria-controls="JP2"
                                                    aria-selected="false"><small>JP</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH2-tab" data-toggle="tab" href="#CH2"
                                                    role="tab" aria-controls="CH2"
                                                    aria-selected="false"><small>CH</small></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="tab-content" id="myTab2Content">
                                            <div class="tab-pane fade show active" id="TH2" role="tabpanel"
                                                aria-labelledby="TH2-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="text" name="name_th" id="name_th"
                                                            class="form-control @error('name_th')is-invalid @enderror"
                                                            value="{{ old('name_th') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="EN2" role="tabpanel"
                                                aria-labelledby="EN2-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="text" name="name_en" id="name_en"
                                                            class="form-control @error('name_en')is-invalid @enderror"
                                                            value="{{ old('name_en') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="JP2" role="tabpanel"
                                                aria-labelledby="JP2-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="text" name="name_jp" id="name_jp"
                                                            class="form-control @error('name_jp')is-invalid @enderror"
                                                            value="{{ old('name_jp') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="CH2" role="tabpanel"
                                                aria-labelledby="CH2-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="text" name="name_zh" id="name_zh"
                                                            class="form-control @error('name_zh')is-invalid @enderror"
                                                            value="{{ old('name_zh') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <div class="form-group">
                                            <label for="url">Url: @error('url')
                                                    <small class="text-danger">{{ $message }}</small>
                                                @enderror
                                            </label>
                                            <input type="text" name="url" id="url"
                                                class="form-control @error('url')is-invalid @enderror"
                                                value="{{ old('url') }}">
                                        </div>
                                    </div>
                                    {{-- description --}}
                                    <div class="col-lg-12">
                                        <label for="more_th">@lang('phrase.member.activity.blog-des'): @error('more_th')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </label>
                                        <ul class="nav nav-tabs" id="myTab1">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH1-tab" data-toggle="tab"
                                                    href="#TH1" role="tab" aria-controls="TH1"
                                                    aria-selected="true"><small>TH</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN1-tab" data-toggle="tab" href="#EN1"
                                                    role="tab" aria-controls="EN1"
                                                    aria-selected="false"><small>EN</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP1-tab" data-toggle="tab" href="#JP1"
                                                    role="tab" aria-controls="JP1"
                                                    aria-selected="false"><small>JP</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH1-tab" data-toggle="tab" href="#CH1"
                                                    role="tab" aria-controls="CH1"
                                                    aria-selected="false"><small>CH</small></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="tab-content" id="myTab1Content">
                                            <div class="tab-pane fade show active" id="TH1" role="tabpanel"
                                                aria-labelledby="TH1-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <textarea name="more_th" id="more_th" class="form-control @error('more_th')is-invalid @enderror" rows="5">{{ old('more_th') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="EN1" role="tabpanel"
                                                aria-labelledby="EN1-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <textarea name="more_en" id="more_en" class="form-control @error('more_en')is-invalid @enderror" rows="5">{{ old('more_en') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="JP1" role="tabpanel"
                                                aria-labelledby="JP1-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <textarea name="more_jp" id="more_jp" class="form-control @error('more_jp')is-invalid @enderror" rows="5">{{ old('more_jp') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="CH1" role="tabpanel"
                                                aria-labelledby="CH1-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <textarea name="more_zh" id="more_zh" class="form-control @error('more_zh')is-invalid @enderror" rows="5">{{ old('more_zh') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- detail --}}
                                    <div class="col-lg-12 mt-3">
                                        <label for="detail_th">@lang('phrase.member.activity.blog-detail'): @error('detail_th')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </label>
                                        <ul class="nav nav-tabs" id="myTab3">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH3-tab" data-toggle="tab"
                                                    href="#TH3" role="tab" aria-controls="TH3"
                                                    aria-selected="true"><small>TH</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN3-tab" data-toggle="tab" href="#EN3"
                                                    role="tab" aria-controls="EN3"
                                                    aria-selected="false"><small>EN</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP3-tab" data-toggle="tab" href="#JP3"
                                                    role="tab" aria-controls="JP3"
                                                    aria-selected="false"><small>JP</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH3-tab" data-toggle="tab" href="#CH3"
                                                    role="tab" aria-controls="CH3"
                                                    aria-selected="false"><small>CH</small></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="tab-content" id="myTab3Content">
                                            <div class="tab-pane fade show active" id="TH3" role="tabpanel"
                                                aria-labelledby="TH3-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="sk-area" data-lang="th"
                                                            @error('detail_th') style="border: 1px solid #dc3545 !important;" @enderror>
                                                            <textarea name="detail_th" id="detail_th" class="sk-editor" hidden="">{{ old('detail_th') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="EN3" role="tabpanel"
                                                aria-labelledby="EN3-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="sk-area" data-lang="en"
                                                            @error('detail_en') style="border: 1px solid #dc3545 !important;" @enderror>
                                                            <textarea name="detail_en" id="detail_en" class="sk-editor" hidden="">{{ old('detail_en') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="JP3" role="tabpanel"
                                                aria-labelledby="JP3-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="sk-area" data-lang="jp"
                                                            @error('detail_jp') style="border: 1px solid #dc3545 !important;" @enderror>
                                                            <textarea name="detail_jp" id="detail_jp" class="sk-editor" hidden="">{{ old('detail_jp') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="CH3" role="tabpanel"
                                                aria-labelledby="CH3-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="sk-area" data-lang="th"
                                                            @error('detail_zh') style="border: 1px solid #dc3545 !important;" @enderror>
                                                            <textarea name="detail_zh" id="detail_zh" class="sk-editor" hidden="">{{ old('detail_zh') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mt-3">
                                        <h4>SEO</h4>
                                    </div>
                                    {{-- seo_keyword --}}
                                    <div class="col-lg-12">
                                        <label for="seo_keyword_th">Keyword: @error('seo_keyword_th')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </label>
                                        <ul class="nav nav-tabs" id="myTab4">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH4-tab" data-toggle="tab"
                                                    href="#TH4" role="tab" aria-controls="TH4"
                                                    aria-selected="true"><small>TH</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN4-tab" data-toggle="tab" href="#EN4"
                                                    role="tab" aria-controls="EN4"
                                                    aria-selected="false"><small>EN</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP4-tab" data-toggle="tab" href="#JP4"
                                                    role="tab" aria-controls="JP4"
                                                    aria-selected="false"><small>JP</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH4-tab" data-toggle="tab" href="#CH4"
                                                    role="tab" aria-controls="CH4"
                                                    aria-selected="false"><small>CH</small></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="tab-content" id="myTab4Content">
                                            <div class="tab-pane fade show active" id="TH4" role="tabpanel"
                                                aria-labelledby="TH4-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="text" name="seo_keyword_th"
                                                            class="form-control @error('seo_keyword_th')is-invalid @enderror"
                                                            value="{{ old('seo_keyword_th') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="EN4" role="tabpanel"
                                                aria-labelledby="EN4-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="text" name="seo_keyword_en"
                                                            class="form-control @error('seo_keyword_en')is-invalid @enderror"
                                                            value="{{ old('seo_keyword_en') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="JP4" role="tabpanel"
                                                aria-labelledby="JP4-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="text" name="seo_keyword_jp"
                                                            class="form-control @error('seo_keyword_jp')is-invalid @enderror"
                                                            value="{{ old('seo_keyword_jp') }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="CH4" role="tabpanel"
                                                aria-labelledby="CH4-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <input type="text" name="seo_keyword_zh"
                                                            class="form-control @error('seo_keyword_zh')is-invalid @enderror"
                                                            value="{{ old('seo_keyword_zh') }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {{-- seo_description --}}
                                    <div class="col-lg-12 mt-3">
                                        <label for="seo_description_th">Description: @error('seo_description_th')
                                                <small class="text-danger">{{ $message }}</small>
                                            @enderror
                                        </label>
                                        <ul class="nav nav-tabs" id="myTab5">
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link active" id="TH5-tab" data-toggle="tab"
                                                    href="#TH5" role="tab" aria-controls="TH5"
                                                    aria-selected="true"><small>TH</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="EN5-tab" data-toggle="tab" href="#EN5"
                                                    role="tab" aria-controls="EN5"
                                                    aria-selected="false"><small>EN</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="JP5-tab" data-toggle="tab" href="#JP5"
                                                    role="tab" aria-controls="JP5"
                                                    aria-selected="false"><small>JP</small></a>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <a class="nav-link" id="CH5-tab" data-toggle="tab" href="#CH5"
                                                    role="tab" aria-controls="CH5"
                                                    aria-selected="false"><small>CH</small></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="tab-content" id="myTab4Content">
                                            <div class="tab-pane fade show active" id="TH5" role="tabpanel"
                                                aria-labelledby="TH5-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <textarea name="seo_description_th" class="form-control @error('seo_description_th')is-invalid @enderror"
                                                            rows="4">{{ old('seo_description_th') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="EN5" role="tabpanel"
                                                aria-labelledby="EN5-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <textarea name="seo_description_en" class="form-control @error('seo_description_en')is-invalid @enderror"
                                                            rows="4">{{ old('seo_description_en') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="JP5" role="tabpanel"
                                                aria-labelledby="JP5-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <textarea name="seo_description_jp" class="form-control @error('seo_description_jp')is-invalid @enderror"
                                                            rows="4">{{ old('seo_description_jp') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane fade show" id="CH5" role="tabpanel"
                                                aria-labelledby="CH5-tab">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <textarea name="seo_description_zh" class="form-control @error('seo_description_zh')is-invalid @enderror"
                                                            rows="4">{{ old('seo_description_zh') }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-lg-12">
                                        <button type="submit"
                                            class="btn btn-success btn-sm float-right mb-2">@lang('phrase.save')</button>
                                        <a class="btn btn-danger btn-sm float-right mb-2 mr-2"
                                            href="{{ url('') . '/' . Session('lang') . "/member/activity/$category/$cid" }}">@lang('phrase.cancel')</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("$prefix.footer")

    <script src="js/jquery.js"></script>
    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/uk-tab.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=001"></script>
    <script src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
    <script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/a-color-picker@1.1.8/dist/acolorpicker.js"></script>
    <script src="js/b64toBlob.js"></script>
    <script src="js/drag-arrange.js"></script>
    <script src="js/build/skEditor-0.2.js"></script>
    <script src="js/build/main.js?v=04"></script>
    <script src="js/build/media.image.js?v=005"></script>
    <script type="text/javascript" src="js/plugin/sweetalert2/sweetalert2.all.min.js"></script>

    <script>
        var lang = '{{ Session('lang') }}';
        var cid = '{{ $cid }}';
        var category = '{{ $category }}';
        var indsutryID = "{{ old('industry') }}";
        var productOld = JSON.parse(document.querySelector("#producthidden").value);
        var LINK_API = "{{ env('API_FILTER_MA') }}";

        if (document?.querySelector('#type')) {
            if (document?.querySelector('#type').value == 'ma') {
                document.querySelector('.maFilter').classList.remove("d-none");
            }

            if (document?.querySelector('#type').value == 'job-search') {
                document.querySelector('.carreerFilter').classList.remove("d-none");
            }
        }

        $('#detail_th').skEditor({
            height: '700px'
        });
        $('#detail_en').skEditor({
            height: '700px'
        });
        $('#detail_jp').skEditor({
            height: '700px'
        });
        $('#detail_zh').skEditor({
            height: '700px'
        });

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

        document.addEventListener('change', function(e) {
            const typeBtn = e.target.closest("#type");
            if (typeBtn) {
                let type = typeBtn.value;

                let filter = document.querySelector('.maFilter');
                if (type == 'ma') {
                    filter.classList.remove("d-none");
                } else {
                    document.querySelector('#industry').selectedIndex = 0;
                    document.querySelector('#opportunity').selectedIndex = 0;
                    document.querySelector('#price').value = '';
                    document.querySelector('.product-list').innerHTML = '';
                    document.querySelector('#product').setAttribute('disabled', true);
                    filter.classList.add("d-none");
                }

                let carreerfilter = document.querySelector('.carreerFilter');
                if (type == 'job-search') {
                    carreerfilter.classList.remove("d-none");
                } else {
                    carreerfilter.classList.add("d-none");
                }
            }

            const industryBtn = e.target.closest('#industry');
            if (industryBtn) {
                let industry = industryBtn.value;
                let product = document.querySelector('.product-list');
                document.querySelector('#product').removeAttribute('disabled');
                product.innerHTML = '';
                getProduct(industry).then((result) => {
                    result.map((e, k) => {
                        let div = document.createElement('div');
                        div.innerHTML =
                            `<label><input type="checkbox" name="productItem[]" id="productItem" value="${e.id}"> ${e.name}</label>`;
                        product.append(div);
                    })
                });
            }
        });

        if (indsutryID != '') {
            let product = document.querySelector('.product-list');
            document.querySelector('#product').removeAttribute('disabled');
            product.innerHTML = '';
            getProduct(indsutryID).then((result) => {
                result.map((e, k) => {
                    let div = document.createElement('div');
                    div.innerHTML =
                        `<label><input type="checkbox" name="productItem[]" id="productItem" value="${e.id}" ${ (productOld != null) ? productOld[k] == e.id ? `checked=""` : `` : `` }> ${e.name}</label>`;
                    product.append(div);
                })
            });
        }

        document.addEventListener('click', function(e) {
            const productBtn = e.target.closest('#product');
            const productList = e.target.closest('.product-list');
            if (productBtn) {
                productBtn.nextElementSibling.classList.add('show');
            }
            if (!productList && !productBtn) {
                document.querySelector('.product-list').classList.remove('show');
            }
        });

        async function getProduct(id) {
            let url = LINK_API + `api/ma-filter/product/${id}`;
            const response = await fetch(url);
            return response.json();
        }
    </script>
</body>

</html>
