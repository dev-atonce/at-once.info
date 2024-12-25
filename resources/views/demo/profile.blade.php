<!doctype html>
<html lang="th">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ @csrf_token() }}">
    {{-- ----------- SEO FRIENDLY ----------- --}}
    @php
        //keyword from company
        $keyword = $row->seo_keyword_th != '' ? $row->seo_keyword_th : '';
        $keyword = $row->seo_keyword_en != '' ? $keyword . ', ' . $row->seo_keyword_en : $keyword;
        $keyword = $row->seo_keyword_jp != '' ? $keyword . ', ' . $row->seo_keyword_jp : $keyword;
        $keyword = $row->seo_keyword_zh != '' ? $keyword . ', ' . $row->seo_keyword_zh : $keyword;
        //keyword from at-once
        $keyword = $row->category_key_th != '' ? $keyword . ', ' . $row->category_key_th : $keyword;
        $keyword = $row->category_key_en != '' ? $keyword . ', ' . $row->category_key_en : $keyword;
        $keyword = $row->category_key_jp != '' ? $keyword . ', ' . $row->category_key_jp : $keyword;
        $keyword = $row->category_key_zh != '' ? $keyword . ', ' . $row->category_key_zh : $keyword;
        
        $keyword = $keyword == '' ? $row->name : $keyword;
    @endphp
    <meta name="keywords" content="{{ $keyword }}">
    <meta name="description" content="{{ $row->description }}">
    <meta name="author" content="at-once.info">

    <meta property="og:title" content="{{ $row->name }} - @lang('phrase.app_name')">
    <meta property="og:description" content="{{ env('APP_NAME') . ', ' . $row->description }}">
    @if ($row->logo)
        <meta property="og:image" content="{{ url($row->logo) }}">
    @endif
    <meta property="og:type" content="article">
    <meta property="og:url" content="/">

    {{-- ----------- /SEO FRIENDLY ----------- --}}
    <title>
        @if ($row->name)
            {{ $row->name }} -
        @endif{{ ENV('APP_NAME', 'At Once') }}
    </title>

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link href="css/style.css?v=0004" rel="stylesheet">
    <link href="css/panel-box.css?v=005" rel="stylesheet">
    <link href="css/gallery.css?v=002" rel="stylesheet">
    <link href="css/detail.css?v=0001" rel="stylesheet">
    <link href="css/blog.css?v=005" rel="stylesheet">
    <link href="css/header-footer.css" rel="stylesheet">
    <link href="slick/slick.min.css?v=0002" rel="stylesheet">
    <link href="slick/slick-custom.css?v=0002" rel="stylesheet">
    <link href="css/social.media.css" rel="stylesheet">
    <link href="css/validate.css" rel="stylesheet">
    <link href="css/popup-contact.css" rel="stylesheet">
    <link href="css/card-list.css" rel="stylesheet">

    <style type="text/css">
        .order-lg-1 {
            -ms-flex-order: 1;
            order: 1;
        }

        .order-lg-2 {
            -ms-flex-order: 2;
            order: 2;
        }

        .company-logo {
            display: grid;
            width: 100%;
            height: 150px;
            background-color: coral;
            align-items: center;
        }

        .company-logo span {
            display: table-cell;
            vertical-align: middle;
            text-align-last: center;
            font-size: 32px;
            color: #fff;
        }

        mark {
            background-color: orange;
            padding: unset !important;
        }

        .form-control.error {
            border-color: #dc3545;
            padding-right: calc(1.5em + 0.75rem) !important;
            background-image: url(data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' fill='none' stroke='%23dc3545' viewBox='0 0 12 12'%3e%3ccircle cx='6' cy='6' r='4.5'/%3e%3cpath stroke-linejoin='round' d='M5.8 3.6h.4L6 6.5z'/%3e%3ccircle cx='6' cy='8.2' r='.6' fill='%23dc3545' stroke='none'/%3e%3c/svg%3e);
            background-repeat: no-repeat;
            background-position: right calc(0.375em + 0.1875rem) center;
            background-size: calc(0.75em + 0.375rem) calc(0.75em + 0.375rem);
        }

        .form-control.error:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgb(220 53 69 / 25%);
        }

        .company-detail a {
            word-break: initial;
            font-size: 24px;
            font-weight: bold;
            margin: 0px;
            line-height: 30px;
            margin-bottom: 10px;
            color: #fff;
        }

        .title.skiptranslate a {
            word-break: initial;
            margin: 0px;
            line-height: 30px;
            margin-bottom: 10px;
            color: #333333;
            font-size: 2rem;
            line-height: 2.8rem;
        }

        @keyframes tilt-shaking {
            0% {
                transform: rotate(0deg);
            }

            25% {
                transform: rotate(5deg);
            }

            50% {
                transform: rotate(0eg);
            }

            75% {
                transform: rotate(-5deg);
            }

            100% {
                transform: rotate(0deg);
            }
        }

        .popup-dialog .profile-img {}
    </style>
</head>

<body>
    {{-- @if ($row->type != 'basic') --}}
        <section class="">
            @php
                $check = Storage::disk(env('disk'))->exists($row->cover);
                $cover = $row->cover != '' ? $row->cover : 'images/default-cover.jpg';
            @endphp
            <div class="cover" style="position: relative;">
                <img src="{{ $cover }}" class="bg-cover-detail-cp img-fluid">
                @if (@$row->video_profile != '')
                    @php
                        $cssAligh = '';
                        if ($row->video_position == 'center') {
                            $cssAligh = 'left:calc(50% - 250px);';
                        }
                        if ($row->video_position == 'left') {
                            $cssAligh = '';
                        }
                        if ($row->video_position == 'right') {
                            $cssAligh = 'right:0;';
                        }
                    @endphp
                    <div class="container" style="position: relative;">
                        <div style="position: absolute; bottom:0; {{ $cssAligh }}">
                            <div class="row">
                                <div class="col-lg-2 col-xs-12 d-block d-lg-none">
                                    <button type="button" class="btn btn-outline-primary search-advance"
                                        data-toggle="collapse" href="#collapseExample"
                                        aria-expanded="{{ @$expanded }}">ค้นหาแบบละเอียด<i
                                            class="fas @if (@$expanded === true) fa-caret-down @else fa-caret-left @endif fa-fw"></i></button>
                                </div>
                                <div class="col-lg-12">
                                    <video width="500" controls="controls" controlslist="nodownload"
                                        preload="metadata" autoplay>
                                        <source src="{{ url($row->video_profile) }}#t=1"
                                            type="video/{{ explode('.', $row->video_profile)[1] }}">
                                    </video>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="container">
                <div id="detail-box">
                    <div class="row">
                        <div class="col-sm-7 col-md-8 col-lg-9 pr-lg-0">
                            <div class="box-title-box-cp mb-lg-0">
                                <div class="row">
                                    <div class="col-5 col-md-3 col-lg-3">
                                        <center>
                                            @if ($row->public == 1 && $row->logo != '')
                                                <img src="{{ url($row->logo) }}"
                                                class="profile-img img-fluid mb-3 mb-lg-0">@else<div
                                                    class="company-logo profile-img img-fluid mb-3"
                                                    data-name="{{ $row->name }}"></div>
                                            @endif
                                        </center>
                                    </div>
                                    <div class="col-7 col-md-9 d-lg-none">
                                        <div class="tag-box-detail p-relative pb-2 mt-3">
                                            <div class="category-tag tag-category-detail">{{ $row->category }}</div>
                                            @if ($row->alpha2)
                                                <div class="category-tag"
                                                    style="background: #4caf50; color:white; border: 1px solid #4caf50;">
                                                    <img src="flags/{{ strtolower($row->alpha2) }}.png">
                                                    {{ $row->nationality }} Company
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-12 col-lg-9">
                                        <div class="company-detail">
                                            <div class="vertical-table disp-p none-absolute">
                                                <div class="vertical-align-middle">
                                                    <h1 class="mb-3 skiptranslate">
                                                        <a class="countOfClick"
                                                            @if ($row->website != '') href="{!! $row->website !!}" target="_blank" @else href="javascript:" @endif
                                                            style="text-decoration:none">{{ $row->name }}</a>
                                                    </h1>
                                                    @if ($row->description != '')
                                                        <div class="wrapper-qoute"><i
                                                                class="icofont-quote-left qoute-left"></i>
                                                            <div class="text">{!! $row->description !!}</div><i
                                                                class="icofont-quote-right qoute-right"></i>
                                                        </div>
                                                        <div
                                                            class="tag-box-detail p-relative pb-2 mt-3 d-none d-lg-block">
                                                            <div class="category-tag tag-category-detail">
                                                                {{ $row->category }}</div>
                                                            @if ($row->alpha2)
                                                                <div class="category-tag"
                                                                    style="background: #4caf50; color:white; border: 1px solid #4caf50;">
                                                                    <img
                                                                        src="flags/{{ strtolower($row->alpha2) }}.png">
                                                                    {{ $row->nationality }} Company
                                                                </div>
                                                            @endif
                                                            <!--   <div class="category-tag text-white"><img width="12" height="12" src="https://www.livinginsider.com/assets18/images/icon/icon-write-edit.svg"> @lang('phrase.updated') {{ \App\Helpers\BaseHp::time_passed($row->updated) }}</div>  -->
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-7 col-md-4 col-lg-3 d-lg-block">
                            <div class="contact-company-top">
                                <div class="vertical-table none-absolute">
                                    <div class="vertical-align-middle">
                                        <div class="one d-none d-md-block d-lg-block">
                                            <a href="#services"
                                                class="btn-sb-company service-pos">@lang('phrase.condition-service')</a>
                                            @if ($row->email != '')
                                                <div class="btn-group w-100" role="group"
                                                    aria-label="Basic example">
                                                    <button class="btn-sb-company tel-top"
                                                        style="border-bottom-right-radius: unset;border-top-right-radius: unset;"><img
                                                            src="images/icon/phone-call.svg" width="20"
                                                            style="filter: invert(1);"></button>
                                                    <button class="btn-sb-company mailtop"
                                                        style="border-bottom-left-radius: unset;border-top-left-radius: unset;"
                                                        lang="th" category={{ Request::segment(2) }}
                                                        tag="{{ $row->id }}" text="{{ $row->name }}"><img
                                                            src="images/icon/mail.svg" width="20"
                                                            style="filter: invert(1);"></button>
                                                </div>
                                            @else
                                                <button class="btn-sb-company tel-top"><img
                                                        src="images/icon/phone-call.svg" width="20"
                                                        style="filter: invert(1);"></button>
                                            @endif
                                            @php
                                                $phone = explode(',', $row->phone);
                                            @endphp
                                            @for ($i = 0; $i < COUNT($phone); $i++)
                                                <a href="tel:{{ $phone[$i] }}"
                                                    class="btn-sb-company tel-com-top d-none">{{ $phone[$i] }}</a>
                                            @endfor
                                        </div>
                                        <div class="two">
                                            <a href="#contact-box-zone" class="btn-contact ">@lang('phrase.contact-information')</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class=" highlight">
            @php
                $lang = 'th';
                $langP = $lang == 'th' ? 'th' : 'en';
                
                $position = \App\Models\Filter\CpPositionMd::select(["pos.position_$lang as name"])
                    ->leftJoin('job_position as pos', 'cp_position.position', '=', 'pos.id')
                    ->where(['cp_position._id' => $row->id]);
                $nationality = \App\Models\Filter\CpNationalityMd::select(["ch.name_$lang as name"])
                    ->leftJoin('choice as ch', 'cp_nationality.nationality', '=', 'ch.key')
                    ->where(['cp_nationality._id' => $row->id, 'ch.type' => 'recruitment-nationality']);
                $type = \App\Models\Filter\CpTypeMd::select(["ch.name_$lang as name"])
                    ->leftJoin('choice as ch', 'cp_type._type', '=', 'ch.key')
                    ->where(['cp_type._id' => $row->id, 'ch.type' => 'type-recruitment']);
                
                $items = \App\Models\Filter\CpItemMd::select('ch.id', "ch.name_$lang as name")
                    ->leftJoin('choice as ch', 'cp_item.item', '=', 'ch.key')
                    ->where(['_id' => $row->id, 'ch.type' => 'warehouse'])
                    ->get();
                $workingHrs = \App\Models\Filter\CpWorkingHoursMd::select('cp_working_hours.id', "wh.name_$lang as day", 'cp_working_hours.time')
                    ->leftJoin('working_hours as wh', 'cp_working_hours.day', '=', 'wh.id')
                    ->where('_id', $row->id)
                    ->get();
            @endphp
            <section class="mt-5">
                <div class="container">
                    <div class="detail-content">
                        {!! $row->more !!}
                    </div>
                </div>
            </section>
            @php
                $galls = \App\Models\Filter\CpGalleryMd::where('_id', $row->id)
                    ->select('image')
                    ->orderBy('created', 'desc')
                    ->get();
            @endphp
            @if ($galls->count() > 0)
                <section id="gallery" class="c-section page gallery-sec mt-5 ">
                    <div class="container">
                        <h3 class="title-service"><strong><i class="icon icofont-image"></i> Gallery</strong></h3>
                        <!-- <h3 class="mb-0"><strong>Gallery</strong></h3> -->
                        <div class="gallery-box mb-0">
                            <div class="regular slick-slider row">
                                @foreach ($galls as $gall)
                                    <div class="col-lg-12 gall">
                                        <a href="{{ $gall->image }}" data-fancybox="gallery1" class="slick-slide">
                                            <div class="img-gallery">
                                                <img src="{{ $gall->image }}" class="img-fluid">
                                            </div>
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endif
            <div id="services">
                <div class="container">
                    <div class="cRlzkX row">
                        <div class="bjDa-do col-md-12 ol-lg-12">
                            <div class="content kDOYDC">
                                <h3 class="title-service mb-5">
                                    <strong>
                                        <i class="icon icofont-verification-check"></i>
                                        @lang('phrase.condition-service')
                                    </strong>
                                </h3>
                                @foreach ($filters->input as $k => $v)
                                    @if ($myFilter[@$v->name])
                                        <div class="row service-check">
                                            <div class="col-lg-12 d-flex mb-2">
                                                @php
                                                    $items = $myFilter[@$v->name];
                                                    $items = json_decode($items);
                                                @endphp
                                                @if ($v->type == 'checkbox' && @$items[0]->key == 1)
                                                    <div class="bDELcg">
                                                        <span class="title bold text-success"><i
                                                                class="icofont-verification-check text-success"></i>{{ $v->label }}</span>
                                                    </div>
                                                @elseif($v->type != 'checkbox')
                                                    @if (count($items) > 0)
                                                        <div class="bDELcg">
                                                            <span class="title bold text-success mr-2"><i
                                                                    class="icofont-verification-check text-success"></i>{{ $v->label }}</span>
                                                            @foreach ($items as $i)
                                                                <div class="pix1uw-0">{{ @$i->name }}</div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                @else
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        @php $serviceImg = ($row->service)?$row->service:'images/bg-default.jpg'; @endphp
                    </div>
                </div>
            </div>
        </div>
        <section class="contact-footer page">
            <div class="container">
                <div id="contact-box-zone">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="box-pro text-center">
                                <!-- <h3 class="title bold service-check">{{ $row->name }}</h3> -->
                                <h3 class="title skiptranslate">
                                    <a class="countOfClick"
                                        @if ($row->website != '') href="{!! $row->website !!}" target="_blank" @else href="javascript:" @endif
                                        style="text-decoration:none">
                                        <strong>{{ $row->name }}</strong>
                                    </a>
                                </h3>
                                <div class="flex-contact">
                                    <p class="address"><i class="icofont-location-pin"></i>
                                        @if ($row->address != '')
                                            {{ @$row->address }}
                                        @else
                                            @lang('phrase.address_not_found')
                                        @endif {{-- {{$row->subdistrict}} {{$row->district}} {{$row->province}} {{$row->postcode}} @lang('phrase.thailand') --}}
                                    </p>
                                </div>
                            </div>
                            <div class="contact-tm">
                                <div class="detail-contact ch-red">
                                    <a class="tel" href="javascript:">
                                        <img src="images/icon/phone-call.svg" width="20">
                                        <span id="">@lang('phrase.telephone')</span>
                                    </a>
                                    <div class=" col-lg-12 d-none">
                                        @php
                                            $phone = explode(',', $row->phone);
                                        @endphp
                                        @for ($i = 0; $i < COUNT($phone); $i++)
                                            <a class="tel-com text-light" href="tel:{{ $phone[$i] }}">
                                                @if ($i > 0)
                                                    ,
                                                @endif{{ $phone[$i] }}
                                            </a>
                                        @endfor
                                    </div>
                                </div>
                                @if ($row->email != '')
                                    <div class="detail-contact ch-blue">
                                        <a class="mail" href="javascript:" lang="{{ Session('lang') }}"
                                            category={{ Request::segment(2) }} tag="{{ $row->id }}"
                                            text="{{ $row->name }}">
                                            <img src="images/icon/mail.svg" width="20"> @lang('phrase.email_contact')
                                        </a>
                                        <span class="d-none">{{ $row->email }}</span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-2"></div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-sm-7 col-md-6 col-lg-4 d-flex">
                            <div class="box-info-ds">
                                <div class="title">
                                    <div class="status-update">
                                        <span>
                                            <i class="icofont-ui-edit"></i> @lang('phrase.updated')
                                            {{ \App\Helpers\BaseHp::time_passed($row->updated) }}
                                        </span>
                                    </div>
                                </div>
                                <div class="content">
                                    <div class="vertical-table none-absolute">
                                        <div class="vertical-align-middle">
                                            <div class="list-comment">
                                                <div class="vertical-table none-absolute">
                                                    <div class="vertical-align-middle">
                                                        <div class="social-box">
                                                            <a class="black-text-contact countOfClick"
                                                                data-id="{{ $row->id }}" target="_blank"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="website"
                                                                @if ($row->website != '') href="{!! $row->website !!}" @else href="javascript:" @endif>
                                                                <div
                                                                    class="detail-contact-02 @if ($row->website == '') none-info @endif web-contact">
                                                                    <i class="icofont-globe"></i>
                                                                </div>
                                                            </a>
                                                            <a class="black-text-contact" target="_blank"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="facebook"
                                                                @if ($row->facebook != '') href="{!! $row->facebook !!}"@else href="javascript:" @endif>
                                                                <div
                                                                    class="detail-contact-02 @if ($row->facebook == '') none-info @endif facebook-contact">
                                                                    <i class="icofont-facebook"></i>
                                                                </div>
                                                            </a>
                                                            <a class="black-text-contact" target="_blank"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Line"
                                                                @if (@$row->line) href="https://line.me/ti/p/~{{ $row->line }}" @endif>
                                                                <div
                                                                    class="detail-contact-02 @if (@$row->line == '') none-info @endif line-contact">
                                                                    <i class="icofont-line"></i>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="action">
                                    @php $blogs = 0; @endphp
                                    <div class="info-update">
                                        <div>
                                            <i class="icofont-page"></i>@lang('phrase.header.blog')
                                            <span>({{ $blogs }})</span>
                                        </div>
                                        <div class="share-this-page">
                                            <i class="icofont-share mr-1"></i> @lang('phrase.share')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6 pr-lg-0  d-flex">
                            <div class="box-info-ds">
                                <div class="title">
                                    <h5 class="date bold mb-0"><i class="icofont-clock-time"></i>
                                        @lang('phrase.working_hours')</h5>
                                </div>
                                <div class=" content">
                                    @foreach ($workingHrs as $kwh => $wh)
                                        <table class="table-open col-lg-12">
                                            <tbody>
                                                <tr>
                                                    <td>{{ $wh->day }}</td>
                                                    <td>{{ $wh->time }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        @if ($row->gmap != '')
            <section>
                <div class="company-map">
                    <div class="MapCompact" data-element-name="hotel-mosaic-map" data-provider-id="294">
                        {!! $row->gmap !!}
                    </div>
                </div>
            </section>
        @endif
    {{-- @else --}}
        {{-- <section class="page">
            <div class="container">
                <div id="detail-box" class="">
                    <div class="row">
                        <div class="col-lg-2"></div>
                        <div class="col-lg-8">
                            <div class="company-detail card-basic">
                                <h1 class="mb-4 text-dark">{{ $row->name }}</h1>
                                @if ($row->description != '')
                                    <div class="wrapper-qoute"><i class="icofont-quote-left qoute-left"></i>
                                        <div class="text">{!! $row->description !!}</div><i
                                            class="icofont-quote-right qoute-right"></i>
                                    </div>
                                    <div class="tag-box-detail p-relative pb-2 mt-4">
                                        <div class="category-tag tag-category-detail">{{ $row->category }}</div>
                                        @if ($row->alpha2)
                                            <div class="category-tag"
                                                style="background: #4caf50; color:white; border: 1px solid #4caf50;">
                                                <img src="flags/{{ strtolower($row->alpha2) }}.png">
                                                {{ $row->nationality }} Company
                                            </div>
                                        @endif
                                    </div>
                                @endif
                                <div class="mt-3">
                                    <div class="flex-contact">
                                        <p class="address text-left"><i class="icofont-location-pin"></i>
                                            {{ @$row->address }}</p>
                                    </div>
                                    <div class="contact-tm text-center">
                                        <div class="detail-contact ch-red">
                                            <a class="tel" href="javascript:">
                                                <img src="images/icon/phone-call.svg" width="20">
                                                <span id="">@lang('phrase.telephone')</span>
                                            </a>
                                            <div class=" col-lg-12 d-none">
                                                <a class="tel-com text-light"
                                                    href="tel:{{ $row->phone }}">{{ $row->phone }}</a>
                                            </div>
                                        </div>
                                        @if ($row->email != '')
                                            <div class="detail-contact ch-blue">
                                                <a class="mail" href="javascript:" lang="{{ Session('lang') }}"
                                                    category="{{ Request::segment(2) }}" tag="{{ $row->id }}"
                                                    text="{{ $row->name }}" data-email="{{ $row->email }}">
                                                    <img src="images/icon/mail.svg" width="20">
                                                    @lang('phrase.email_contact')
                                                </a>
                                                <span class="d-none">{{ $row->email }}</span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> <!-- col-lg-8 -->
                        <div class="col-lg-12">
                            <div class="contact-tm">
                                <div class="mr-1 button-sh-info mb-5">
                                    <i class="icofont-share mr-1"></i> @lang('phrase.share')
                                </div>
                                <div class="ml-1 button-sh-info mb-5">
                                    <i class="icofont-info-circle mr-1"></i> ขอข้อมูลเพิ่มเติม
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <a href="https://www.at-once.info/th">
                                <img src="images/banner-blog01.jpg" class="img-fluid"
                                    alt="ร่วมเป็นส่วนหนึ่งกับเว็บไซต์ At Once เพิ่มโอกาสสร้างยอดขายให้กับธุรกิจของคุณได้ง่ายๆ"
                                    width="100%">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}
    {{-- @endif --}}

    <section>
        @include('front-end.form-contact-mail')
    </section>
    
    <style type="text/css">
        .card-contact-info {
            border-radius: 10px;
            margin-bottom: 15px;
            border: 0px solid #e7e7e7;
            box-shadow: 0 4px 7px rgb(0 0 0 / 25%);
        }

        .card-basic {
            background: rgb(255, 255, 254);
            border: 1px solid rgb(214, 222, 234);
            box-sizing: border-box;
            /*box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 1px;*/
            box-shadow: 0px 4px 8px rgb(0 0 0 / 24%), 0px 24px 40px rgb(0 0 0 / 24%);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 50px;
        }

        .button-sh-info {
            background: #ffffff;
            border: 2px solid rgba(0, 0, 0, 0.08);
            color: #000000;
            padding: 12px 30px;
            border-radius: 48px;
            display: inline-block;
            font-weight: 700;
            font-size: 16px;
            line-height: 24px;
            cursor: pointer;
        }

        .icofont-info-circle {
            color: #ffc107;
        }

        .icofont-share {
            color: #03a9f4;
        }

        .icofont-info-circle:before {
            content: "\ef4e";
        }

        .card-basic i {
            color: #f58524;
            padding-right: 2px;
            width: 24px;
            line-height: 1.42857;
            fill: none;
            font-size: 23px;
        }
    </style>



    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script type="text/javascript" src="js/gallery-box.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en">
    </script>
    <script type="text/javascript" src="js/custom.js?v=0002"></script>
    <script type="text/javascript" src="js/fancybox.js"></script>

    <script type="text/javascript" src="slick/slick.min.js?v=001"></script>
    <script type="text/javascript" src="slick/custom.js"></script>
    <script type="text/javascript" src="slick/main.js"></script>

    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    <script type="text/javascript" src="js/build/social.media.js"></script>
    <script type="text/javascript" src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
    <script type="text/javascript" src="js/blog.color.js"></script>

    {{-- <script src="js/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.es6.js"></script> --}}

</body>

</html>
<script>
    $(function() {
        const backlink = document.querySelectorAll('a[href="{{ $row->website }}"]')
        for (let i = 0; i < backlink.length; i++) {
            $('a[href="{{ $row->website }}"]').addClass('countOfClick').css('text-decoration', 'none');
        }
    })

    $(function() {
        $('.chatbox-top').click(function() {
            $(this).closest('.chatbox').toggleClass('chatbox-min');
        });
        $('.fa-close').click(function() {
            $(this).closest('.chatbox').hide();
        });
    });

    $(function() {
        $('a.mail').click(function() {
            actionAd($(this));
            $('.chatbox').removeClass('d-none').removeClass('chatbox-min');
            axios({
                method: 'post',
                url: 'api/' + cageoryId + '/store/statistics/click',
                data: {
                    _method: 'PUT',
                    company: _id,
                    c: 'm',
                    cageory: cageoryId,
                    locate: geoIp
                }
            });
        });
    });

    $(function() {
        $('button.mailtop').click(function() {
            actionAd($(this));
            $('.chatbox').removeClass('d-none').removeClass('chatbox-min');
            axios({
                method: 'post',
                url: 'api/' + categoryId + '/store/statistics/click',
                data: {
                    _method: 'PUT',
                    company: _id,
                    c: 'm',
                    category: categoryId,
                    locate: geoIp
                }
            });
        });
    });



    $.fn.extend({
        toggleText: function(a, b) {
            var that = this;
            if (that.text() != a && that.text() != b) {
                that.text(a);
            } else if (that.text() == a) {
                that.text(b);
            } else if (that.text() == b) {
                that.text(a);
            }
            return this;
        }
    });

    $(document).on('click', '.countOfClick', function() {
        let geo = converseToJson(geoIp);
        axios({
            url: 'api/count-of-click',
            method: 'post',
            data: {
                company: _id,
                ip: geoIp.ip
            }
        })
    });

    $('button.tel-top').on('click', function() {
        $('.tel-com-top').toggleClass('d-none d-flex');
        if ($('.tel-com-top').hasClass('d-flex')) {
            axios({
                method: 'post',
                url: 'api/' + category + '/store/statistics/click',
                data: {
                    _method: 'PUT',
                    company: _id,
                    c: 't',
                    category: categoryId,
                    locate: geoIp
                }
            });
        }
    })

    $('a.tel').on('click', function() {
        $('.tel-com').parent().toggleClass('d-none d-block');
        if ($('.tel-com').parent().hasClass('d-block')) {
            axios({
                method: 'post',
                url: 'api/' + category + '/store/statistics/click',
                data: {
                    _method: 'PUT',
                    company: _id,
                    c: 't',
                    category: categoryId,
                    locate: geoIp
                }
            });
        }
    });

    if ($('.wharehose li').length > 2) {
        $('.see-all').click(function() {
            $(this).toggleText('{{ __('phrase.see-more') }}', '{{ __('phrase.see-less') }}');
            $('.see-all').prev().find('[class]').toggleClass('d-none d-block');
        });
    }
    if ($('.company-logo').length > 0) {
        $('.company-logo').each(function() {
            var intials = $(this).data('name').charAt(0) + $(this).data('name').charAt(1);
            $(this).html('<span>' + intials + '</span>');

        })
    }

    function scrollNav() {
        $('.contact-company-top a').click(function() {
            $('html, body').stop().animate({
                scrollTop: $($(this).attr('href')).offset().top - 160
            }, 300);
            return false;
        });
    }
    scrollNav();
    blog = document.getElementById('blog');
    services = document.getElementById('services');

    blogBtn = document.getElementsByClassName('blog-pos');
    serviceBtn = document.getElementsByClassName('service-pos');

    if (blog == null) blogBtn[0]?.setAttribute('href', 'javascript:');
    if (services == null) serviceBtn[0]?.setAttribute('href', 'javascript:');

    function highlight(text) {
        var highlight = window.location.search;
        if (highlight != '') {
            highlight = highlight.replace('?', '');
            highlight = decodeURIComponent(highlight);
            highlight = highlight.split('&');
            const ar = [];
            for (i = 0; i < highlight.length; i++) {
                let name = highlight[i].split('=')[0].toString();
                ar.push({
                    name: highlight[i].split('=')[0],
                    value: highlight[i].split('=')[1]
                });
            }
            let CKH = false;
            let searchTerm = null;
            for (j = 0; j < ar.length; j++) {
                if (ar[j].name == 'highlight') searchTerm = ar[j].value;
                CKH = true;
            }

            if (CKH === true) {
                $(".detail-content").unmark().mark(searchTerm, {
                    "acrossElements": true,
                    "separateWordSearch": false
                });
                $(".highlight").unmark().mark(searchTerm, {
                    "acrossElements": true,
                    "separateWordSearch": false
                });
            }
        }
        // var inputText = document.getElementsByClass("highlight");
        // var innerHTML = inputText.innerHTML;
        // var index = innerHTML.indexOf(text);
        // if (index >= 0) { 
        // innerHTML = innerHTML.substring(0,index) + "<span class='text-highlight'>" + innerHTML.substring(index,index+text.length) + "</span>" + innerHTML.substring(index + text.length);
        // inputText.innerHTML = innerHTML;
        // }
    }
</script>

{{-- <script src="js/contact-function.js"></script>
<script type="text/javascript" src="js/custom-form-contact.js"></script>
<script src="js/statistics.js?v=003"></script> --}}

{{-- <script>
    var History = history;
    if (History.length == 1 && window.location.search == '') {
        // highlight();
        $('a.message-send').click(function() {
            let ac = actionAd($(this));
            let re = localStorage.getItem('re');
            if (re != null) {
                window.open(`${window.location.origin}${re}`, '_self');
            } else {
                if (ac != false) {
                    window.open('', '_self').close();
                }
            }
        });
    } else {
        $('a.message-send').on('click', function() {
            let ac = actionAd($(this));
            if (ac != false) {
                let path = window.location.pathname.split("/");
                window.location.replace(`${window.location.origin}/${path[1]}/${path[2]}?search`);
            }
        });
    }
</script> --}}
