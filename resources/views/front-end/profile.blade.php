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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/header-footer.css" rel="stylesheet">
    <link href="css/member-company.css?v=002" rel="stylesheet">
    <link rel="stylesheet" href="css/gallery.css?v=0001">
    <link rel="stylesheet" href="css/detail.css?v=0001">

    <style>
        .mce-btn,
        .mce-panel {
            background-color: #fff !important;
        }

        .mce-primary button {
            background-color: #2d8ac7 !important;
        }

        .cover-bg-profile .cover-edit {
            position: absolute;
            z-index: 1;
            top: 12px;
            right: 12px;
        }

        .cover-bg-profile .cover-edit input {
            display: none;
        }

        .cover-bg-profile .cover-edit input+label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .cover-bg-profile .cover-edit input+label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .cover-bg-profile .cover-edit input+label:after {
            content: "\eecf";
            font-family: 'IcoFont' !important;
            font-size: 20px;
            color: #757575;
            position: absolute;
            /* top: 5px; */
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .cover-bg-profile .cover-action {
            position: absolute;
            right: 12px;
            bottom: 12px;
        }

        .gallery-upload {
            width: 100%;
            min-height: 100px;
            border: 2px dashed #aaa;
            border-radius: 4px;

        }

        .gu-item {
            display: flex;
            border: 1px solid rgba(0, 0, 0, 0.08);
            margin: 5px
        }

        .gu-item:hover {
            background: #d6d6d6;
        }

        .gallery-upload .gu-image {

            float: left;
            clear: both;
            position: relative;
            display: inline-table;
            overflow: hidden;
            width: 120px;
            height: 120px;
        }

        /* My gallery  */
        .my-gl .gl:hover {
            /* background-color: #ececec; */
            box-shadow: 0 0 10px 1px rgba(0, 0, 0, 0.5);
        }

        .gl {
            position: relative;
            border-radius: 5px;
            background-color: #f3f4f5;
            overflow: hidden;
            height: 170px;
            max-height: 200px;
        }

        .gl .gl-img {
            min-width: 120px;
            min-height: 120px;
            display: inline-flex;
            overflow: hidden;
        }

        .gl:hover .gl-backdrop {
            position: absolute;
            background: rgba(0, 0, 0, 0.08);
            width: 100%;
            height: 100%;
        }

        .gl-backdrop .gl-times {
            position: absolute;
            right: 3px;
            top: 0;
            padding: 0 !important;
            margin: 0 !important;
        }

        .gl-img:hover .gl-times {
            display: block;
        }

        .gl-img .gl-times:hover {
            background-color: #fff;
        }

        a.fas {
            text-decoration: none;
        }

        .gl .gl-caption {
            line-height: 1.2;
            margin: 5px;
            overflow: hidden;
        }

        /* Gallery Uploads */
        .gallery-upload .gu-details {
            float: left;
            clear: both;
            overflow: hidden;
            margin: 10px;
            width: -webkit-fill-available;
        }

        .gallery-upload .gu-progress {
            width: 100%;
        }

        .gallery-upload .gu-action {
            position: absolute;
            right: 15px;
            bottom: 15px;
        }

        .gu-details .gu-name span {
            white-space: nowrap;
        }

        .img-service-edit {
            position: absolute;
            z-index: 1;
            top: 12px;
            right: 12px;
        }

        .img-service-edit input {
            display: none;
        }

        .img-service-edit input+label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .img-service-edit input+label:after {
            content: "\eecf";
            font-family: 'IcoFont' !important;
            font-size: 20px;
            color: #757575;
            position: absolute;
            /* top: 5px; */
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .service-action {
            position: absolute;
            z-index: 1;
            bottom: 12px;
            right: 12px;
        }

        .rounded-lg.bg-light:hover {
            background-color: #ededed !important;
            cursor: pointer;
        }

        .rounded-lg.bg-light:hover>i {
            color: #aaa !important;
        }

        .border-selected {
            border-color: #0062cc;
        }

        .template-item:hover {
            cursor: pointer;
        }

        /* .i-resize{
      bottom: 0;
      cursor: row-resize;
      height: 5px;
      left: 0;
      width: 100%;
    } */
        .iframe {
            resize: vertical;
            overflow: auto;
        }

        .im-tools {
            padding-top: 7px;
            padding-bottom: 7px;
            /* padding: 5px; */
            /* border-top:1px solid #dedede; */
            border-bottom: 1px solid #dedede;
        }

        .im-content-upload {
            overflow-y: auto;
            overflow-x: hidden;
        }

        .im-content-image,
        .im-content-upload {
            min-height: 470px;
            max-height: 480px;
        }

        .im-content-upload::-webkit-scrollbar {
            padding: 0;
            width: 10px;
        }

        .im-content-upload::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        /* Handle */
        .im-content-upload::-webkit-scrollbar-thumb {
            background: #888;
        }

        /* Handle on hover */
        .im-content-upload::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        .im-footer {
            padding-top: 15px;
            border-top: 1px solid #dedede;
        }

        .im-item {
            position: relative;
            display: flow-root;
            border: 1px solid #dedede;
            margin: 5px 0 0 0;
        }

        .im-item:hover {
            background: #d6d6d6;
        }

        .im-content-upload .im-image {
            float: left;
            clear: both;
            position: relative;
            display: inline-table;
            overflow: hidden;
            width: 120px;
            height: 120px;
        }

        .im-action {
            position: absolute;
            top: 0;
            right: 0;
        }

        .im-details {
            overflow: hidden;
            padding: 10px;
            width: -webkit-fill-available;
        }

        .im-container {
            margin: 0;
            padding: 0;
            border: 0;
            outline: 0;
            vertical-align: top;
            background: transparent;
            text-decoration: none;
            color: #000;
            font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
            font-size: 14px;
            text-shadow: none;
            float: none;
            position: static;
            width: auto;
            height: auto;
            white-space: nowrap;
            cursor: inherit;
            -webkit-tap-highlight-color: transparent;
            line-height: normal;
            font-weight: normal;
            text-align: left;
        }

        .im-image-grid {
            margin: 4px;
            display: inline-block;
            width: 100px;
            height: 100px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            border: 2px solid #AAA;
            opacity: 70;
            filter: alpha(opacity=7000);
            zoom: 1;
            vertical-align: middle;
            line-height: 100px;
            text-align: center;
            float: left;
        }

        .im-image-grid img {
            vertical-align: middle;
            max-height: 77px;
            max-width: 100px;
            margin-top: -24px;
        }

        .im-content-image .im-image-list {
            cursor: pointer;
            position: relative;
            border-left: 1px solid #dedede;
            border-right: 1px solid #dedede;
            border-bottom: 1px solid #dedede;
        }

        .im-image-list img {
            display: none;
        }

        .im-info {
            position: absolute;
            bottom: 0;
            width: 100%;
            background: #AAA;
            color: #FFF;
            padding: 3px;
            opacity: 80;
            filter: alpha(opacity=8000);
            zoom: 1;
            line-height: normal;
        }

        .im-image-list .im-info {
            position: relative;
            background: none;
            color: #555;
            padding: 7px;
            text-indent: 20px;
        }

        .im-i-checkbox {
            filter: progid:DXImageTransform.Microsoft.gradient(enabled=false);
            position: absolute;
            top: 2px;
            right: 3px;
            margin: 1px;
            border: 1px solid #FFF;
            background: transparent;
            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
            background: #333;
            color: #FFF;
        }

        .im-image-grid:hover,
        .im-image-grid.im-checked {
            border: 2px solid #007bff;
        }

        .im-image-list:hover,
        .im-image-list:hover .im-info,
        .im-image-list:hover::before {
            color: #007bff;
        }

        .im-image-list::before:hover {
            color: #fff;
        }

        .im-image-grid.im-checked::after {
            font-family: "Font Awesome 5 Free";
            content: "\f14a";
            color: #007bff;
            font-size: 17px;
            font-weight: bold;
            position: absolute;
            top: 3px;
            right: 3px;
            line-height: normal;
        }

        .im-image-list::before {
            font-family: "Font Awesome 5 Free";
            content: "\f0c8";
            color: #888;
            font-size: 17px;
            position: absolute;
            line-height: normal;
            left: 7px;
            top: 6px;
            vertical-align: middle;
        }

        .im-image-list.im-checked::before {
            font-family: "Font Awesome 5 Free";
            content: "\f14a";
            color: #007bff;
            font-size: 17px;
            font-weight: bold;
            position: absolute;
            line-height: normal;
            left: 7px;
            top: 6px;
            vertical-align: middle;
        }

        .im-image-list.im-checked .im-info {
            color: #007bff;
        }

        .im-image-grid:hover,
        .im-image-grid.im-checked {
            opacity: 100;
            filter: alpha(opacity=10000);
            zoom: 1;
            -webkit-box-shadow: 0 0 5px rgb(255 255 255 / 75%);
            -moz-box-shadow: 0 0 5px rgba(255, 255, 255, 0.75);
            box-shadow: 0 0 5px rgb(255 255 255 / 75%);
        }

        .iframe {}
    </style>
    <link rel="stylesheet" href="css/skEditor-0.2.css?v=0001">
</head>

<body>

    @if ($module != 'member')
        @include("$prefix.$module.header")
    @else
        @include("$prefix.header")
    @endif

    <section class="page">
        <div class="container">
            <div class="col-lg-12">
                <div class="personal row" style="box-shadow: rgba(0, 0, 0, 0.08) 0px 4px 16px;">
                    <div class="left">
                        @include("$prefix.member.member-menu")
                    </div>
                    <div class="right">
                        <div class="group-box-right">
                            <div class="row my-cover">
                                <div class="col-lg-12">
                                    @php
                                        $check = Storage::disk(env('disk'))->exists($row->cover);
                                        $cover = !$check ? $row->cover : 'images/default-cover.jpg';
                                    @endphp
                                    <div class="cover-bg-profile"
                                        style="border: 1px solid #e7e7e7; border-radius: 0px;background-position:center;background-size:cover;background-repeat:no-repeat;position: relative;background-image:url('{{ $cover }}');background-color:transparent;">
                                        <div class="cover-edit">
                                            <input type='file' id="coverUpload" accept="image/png,image/jpeg" />
                                            <label for="coverUpload"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if (Session('status') == 'Success')
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong class="bold">{{ Session('status') }}!</strong> {{ Session('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            @if (Session('status') == 'Error')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong class="bold">{{ Session('status') }}!</strong> {{ Session('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <span class="mb-0 text-danger text-center" style="font-size:14px;">ขนาดรูปภาพ 1920 x 500
                                pixel (กว้าง x สูง)</span>
                            <form action="" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group mt-4">
                                            <strong
                                                style="color: #1a81c4; font-size: 20px;">คำอธิบายแบบสั้น</strong><small
                                                class="ml-1">เพื่อแนะนำบริษัทคุณ</small>
                                        </div>
                                        <div class="mb-4">
                                            <ul class="nav nav-tabs info-member" id="myTab" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link active" id="des-tab" data-toggle="tab"
                                                        href="#des_th" role="tab" aria-controls="des"
                                                        aria-selected="true"><img class="mr-2" width="25"
                                                            src="images/flag_th.jpg" alt="ภาษาไทย"> ภาษาไทย</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="profile-tab" data-toggle="tab"
                                                        href="#des_en" role="tab" aria-controls="profile"
                                                        aria-selected="false"><img class="mr-2" width="25"
                                                            src="images/flag_en.jpg" alt="English"> English</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="profile-tab" data-toggle="tab"
                                                        href="#des_jp" role="tab" aria-controls="profile"
                                                        aria-selected="false"><img class="mr-2" width="25"
                                                            src="images/flag_jp.jpg" alt="日本語"> 日本語</a>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <a class="nav-link" id="profile-tab" data-toggle="tab"
                                                        href="#des_ch" role="tab" aria-controls="profile"
                                                        aria-selected="false"><img class="mr-2" width="25"
                                                            src="images/flag_ch.jpg" alt="中国人"> 中国人</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content  info-member" id="myTabContent">
                                                <div class="tab-pane fade show active" id="des_th" role="tabpanel"
                                                    aria-labelledby="home-tab">
                                                    <textarea id="description_th" name="description_th" class="form-control" rows="4" cols="50"
                                                        placeholder="Eg.บริษัทของเรามีบริการนำเข้า-ส่งออก สินค้าหลากหลายประเภท ทั้งในและต่างประเทศ พร้อมมีบริการดำเนินการพิธีการศุลกากร">{!! $row->description_th !!}</textarea>
                                                </div>
                                                <div class="tab-pane fade" id="des_en" role="tabpanel"
                                                    aria-labelledby="profile-tab">
                                                    <textarea id="description_en" name="description_en" class="form-control" rows="4" cols="50"
                                                        placeholder="Eg.Our vision is to have constant growth with quality.">{!! $row->description_en !!}</textarea>
                                                </div>
                                                <div class="tab-pane fade" id="des_jp" role="tabpanel"
                                                    aria-labelledby="profile-tab">
                                                    <textarea id="description_jp" name="description_jp" class="form-control" rows="4" cols="50"
                                                        placeholder="Eg.Our vision is to have constant growth with quality.">{!! $row->description_jp !!}</textarea>
                                                </div>
                                                <div class="tab-pane fade" id="des_ch" role="tabpanel"
                                                    aria-labelledby="profile-tab">
                                                    <textarea id="description_ch" name="description_ch" class="form-control" rows="4" cols="50"
                                                        placeholder="Eg.Our vision is to have constant growth with quality.">{!! $row->description_ch !!}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mb-4">
                                    <div class="form-group mt-4">
                                        <strong class=""
                                            style="color: #1a81c4; font-size: 20px;">รายละเอียดเกี่ยวกับบริษัทคุณ</strong>
                                    </div>
                                    <ul class="nav nav-tabs info-member" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab"
                                                href="#det_th" role="tab" aria-controls="home"
                                                aria-selected="true"><img class="mr-2" width="25"
                                                    src="images/flag_th.jpg" alt="English"> ภาษาไทย</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#det_en"
                                                role="tab" aria-controls="profile" aria-selected="false"><img
                                                    class="mr-2" width="25" src="images/flag_en.jpg"
                                                    alt="English"> English</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#det_jp"
                                                role="tab" aria-controls="profile" aria-selected="false"><img
                                                    class="mr-2" width="25" src="images/flag_jp.jpg"
                                                    alt="Français"> 日本語</a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#det_ch"
                                                role="tab" aria-controls="profile" aria-selected="false"><img
                                                    class="mr-2" width="25" src="images/flag_ch.jpg"
                                                    alt="中国人">中国人</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content  info-member" id="myTabContent">
                                        <div class="tab-pane fade show active" id="det_th" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-12 col-lg-12">
                                                    <div class="sk-area" data-lang="th">
                                                        <textarea name="more_th" id="more_th" class="sk-editor" hidden="">{{ $row->more_th }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="det_en" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-12 col-lg-12">
                                                    <div class="sk-area" data-lang="en">
                                                        <textarea name="more_en" id="more_en" class="sk-editor" hidden="">{{ $row->more_en }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="det_jp" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            <div class="row">
                                                <div class="col-12 col-lg-12">
                                                    <div class="sk-area" data-lang="jp">
                                                        <textarea name="more_jp" id="more_jp" class="sk-editor" hidden="">{{ $row->more_jp }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="det_ch" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col-12 col-lg-12">
                                                    <div class="sk-area" data-lang="ch">
                                                        <textarea name="more_ch" id="more_ch" class="sk-editor" hidden="">{{ $row->more_ch }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <center><button type="submit" class="btn btn-blue btn-update mt-3">บันทึก</button>
                                </center>
                                <hr>
                            </form>
                        </div>
                        <h5 class="bold mt-3">แกลเลอรี่ <span class="text-danger"
                                style="font-size: 14px;">*ขนาดไฟล์ไม่เกิน 2MB</span></h5>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <div class="gallery-upload">
                                    <button type="button"
                                        class="btn btn-dark text-center btn-sm mt-2 ml-2">Browse<input type="file"
                                            name="gallery[]" id="gallery" multiple max="10" hidden></button>
                                    <button type="button" class="btn btn-info gu-upload btn-sm mt-2">Upload</button>
                                </div>
                            </div>
                        </div>
                        <div class="row my-gl">
                            @foreach (\App\Models\Filter\CpGalleryMd::where('_id', $row->id)->orderBy('created', 'desc')->get() as $img)
                                <div class="col-lg-3 col-md-6 col-xs-6 mb-3">
                                    <figure>
                                        <div class="gl"
                                            title="Item type: {{ $img->type }}&#013;Dimension: {{ $img->dimension }}&#013;Size: {{ \App\Helpers\BaseHp::formatSizeUnits($img->size) }}">
                                            <div class="gl-backdrop"><span class="gl-times float-right"><a
                                                        href="javascript:" class="fas fa-times text-white gl-remove"
                                                        data-id="{{ $img->id }}"></a></span></div>
                                            <div class="gl-img"
                                                style="background-image:url('{{ $img->image }}'); background-position: center; background-size: cover;  display: flex;">
                                            </div>
                                            <div class="gl-caption">
                                                <small>{{ explode('/', $img->image)[3] }}</small>
                                            </div>
                                        </div>
                                    </figure>
                                </div>
                            @endforeach
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
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/uk-tab.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=001"></script>
    <script src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/a-color-picker@1.1.8/dist/acolorpicker.js"></script>
    <script src="js/drag-arrange.js"></script>
    <script type="text/javascript" src="js/build/skEditor-0.2.js"></script>
    <script type="text/javascript" src="js/auto_translate.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/build/main.js?v=004"></script>
    <script src="js/build/media.image.js?v=005"></script>
    <script src="js/image-manager.js"></script>
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
        $('#more_ch').skEditor({
            height: '600px'
        });
    </script>
</body>

</html>
