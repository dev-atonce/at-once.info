<!doctype html>
<html lang="{{ Session('lang') }}">

<head>
    @include("$prefix.analytics.googleAnalytics")
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $row->seo_keyword ? $row->seo_keyword : $row->seo_keyword_th }}">
    <meta name="description" content="{{ $row->seo_description ? $row->seo_description : $row->seo_description_th }}">
    <meta name="author" content="at-once.info">

    <title>{{ $row->title ? $row->title : $row->name . ' - ' . env('APP_NAME') }}</title>

    <meta property="og:title" content="{{ $row->name }}">
    <meta property="og:description" content="{{ $row->seo_description }}">
    <meta property="og:image" content="@if ($row->logo) {{ url($row->logo) }} @endif" />
    <meta property="og:url"
        content="{{ url('') . '/' . Session('lang') }}/{{ $row->key }}/cp/{{ $row->profile_url }}" />

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link href="css/style.css?v=0004" rel="stylesheet">
    <link href="css/panel-box.css?v=0001" rel="stylesheet">
    <link href="css/gallery.css?v=002" rel="stylesheet">
    <link href="css/detail.css?v=0001" rel="stylesheet">
    @if ($row->type == 'full')
        <link href="css/blog.css?v=005" rel="stylesheet">
    @endif
    <link href="css/header-footer.css" rel="stylesheet">
    <link href="slick/slick.min.css?v=0002" rel="stylesheet">
    <link href="slick/slick-custom.css?v=0002" rel="stylesheet">
    <link href="css/social.media.css" rel="stylesheet">
    <link href="css/validate.css" rel="stylesheet">
    <link href="css/popup-contact.css" rel="stylesheet">
    <link href="css/card-list.css" rel="stylesheet">

    <style type="text/css">
        .btn-no-info {
            background-color: #c5c5c5 !important;
            cursor: not-allowed;
        }

        a[disabled] {
            pointer-events: none;
        }

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
    @if (!$customerStatus)
        @include("$prefix.header")
    @else
        @include("$prefix.translateBox")
    @endif

    @if ($row->type != 'basic')

        <section class="">
            @php
                $check = Storage::disk(env('disk'))->exists($row->cover);
                $cover = $row->cover != '' ? $row->cover : 'images/default-cover.jpg';
            @endphp
            <div class="cover" style="position: relative; margin-bottom: 20px">
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
                                                    data-name="{{ $row->name ? $row->name : $row->name_th }}"></div>
                                            @endif
                                        </center>
                                    </div>
                                    <div class="col-7 col-md-9 d-lg-none">
                                        <div class="tag-box-detail p-relative pb-2 mt-3">
                                            <div class="category-tag tag-category-detail">
                                                {{ $row->category ? $row->category : $row->category_th }}</div>
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
                                                        @php
                                                            $more_th = ($row->more_th!='')?'true':'false';
                                                            $more_en = ($row->more_en!='')?'true':'false';
                                                            $more_jp = ($row->more_jp!='')?'true':'false';
                                                        @endphp
                                                        <a 
                                                            data-th="{{$row->name_th}}"
                                                            data-en="{{$row->name_en}}"
                                                            data-jp="{{$row->name_jp}}"
                                                            more-th="{{$more_th}}"
                                                            more-en="{{$more_en}}"
                                                            more-jp="{{$more_jp}}"
                                                            @if ($customerStatus) 
                                                                @if ($row->website != '') class="countOfClick" href="{!! $row->website !!}" target="_blank" @endif
                                                            @endif
                                                            style="text-decoration:none; color: white">
                                                            <strong>{{ $row->name }}</strong>
                                                        </a>
                                                    </h1>
                                                    @if ($row->description != '' || $row->description_th != '')
                                                        <div class="wrapper-qoute"><i
                                                                class="icofont-quote-left qoute-left"></i>
                                                            <div class="text">{!! $row->description ? $row->description : $row->description_th !!}</div><i
                                                                class="icofont-quote-right qoute-right"></i>
                                                        </div>
                                                        <div
                                                            class="tag-box-detail p-relative pb-2 mt-3 d-none d-lg-block">
                                                            <div class="category-tag tag-category-detail">
                                                                {{ $row->category ? $row->category : $row->category_th }}
                                                            </div>
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
                                            @if ($blog->count() > 0)
                                                <a href="#blog" class="btn-sb-company blog-pos service-pos">
                                                    @lang('phrase.header.blog')</a>
                                            @endif
                                            @if ($row->email != '')
                                                <div class="btn-group w-100" role="group"
                                                    aria-label="Basic example">
                                                    <button class="btn-sb-company tel-top"
                                                        style="border-bottom-right-radius: unset;border-top-right-radius: unset;"><img
                                                            src="images/icon/phone-call.svg" width="20"
                                                            style="filter: invert(1);"></button>
                                                    <a class="btn-sb-company mailtop"
                                                        @if ($customerStatus) href="#formQuotation" @else href="javascript:0" @endif
                                                        style="border-bottom-left-radius: unset;border-top-left-radius: unset;"
                                                        lang="{{ Session('lang') }}"
                                                        category={{ Request::segment(2) }} tag="{{ $row->id }}"
                                                        text="{{ $row->name }}"><img src="images/icon/mail.svg"
                                                            width="20" style="filter: invert(1);"></a>
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
                                            <a href="#contact-box-zone"
                                                class="btn-contact service-pos">@lang('phrase.contact-information')</a>
                                        </div>
                                        <!--   <div class="share-this-page">
                      <div class="btn-share-company">
                      <i class="icofont-share mr-1"></i>  @lang('phrase.share')</div>
                  </div> -->
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
                $lang = Session('lang');
                $langP = Session('lang') == 'th' ? 'th' : 'en';

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
                $workingHrs = \App\Models\Filter\CpWorkingHoursMd::select(
                    'cp_working_hours.id',
                    "wh.name_$lang as day",
                    'wh.name_en as day_en',
                    'cp_working_hours.time',
                )
                    ->leftJoin('working_hours as wh', 'cp_working_hours.day', '=', 'wh.id')
                    ->where('_id', $row->id)
                    ->get();
            @endphp

            <section class="mt-5">
                <div class="container">
                    <div class="detail-content">
                        {!! $row->more ? $row->more : $row->more_th !!}
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
                                                                <div class="pix1uw-0">
                                                                    {{ @$i->name ? $i->name : $i->name_th }}</div>
                                                            @endforeach
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @php $serviceImg = ($row->service) ? $row->service : 'images/bg-default.jpg'; @endphp
                        </div>
                    </div>
                </div>
            </div>

            @if ($blog->count() > 0)
                <section id="blog" class="">
                    <div class="container">
                        <div class="mb-4 ">
                            <div class="d-flex">
                                <h3 class="title-service"><strong><i class="icon icofont-newspaper"></i>
                                        @lang('phrase.header.news')</strong></h3>
                            </div>
                        </div>
                        <div @if ($blog->count() > 3) class="regular slick-slider row" @endif class="row">
                            @foreach ($blog as $k => $v)
                                @php
                                    $url = $v->url_th != '' ? $v->url_th : str_replace(' ', '-', $v->name);
                                    $category = Request::segment(2);
                                @endphp
                                <div class="col-md-6 col-lg-3 d-flex blog-list" data-key="{{ $v->key }}">
                                    <div class="blog-container">
                                        <div class="blog-header">
                                            <div class="blog-cover">
                                                <a href="{{ Session('lang') }}/blog/{{ $url }}"><img
                                                        src="{{ $v->images }}" title="{{ $v->name }}"
                                                        alt="{{ $v->name }}"></a>
                                            </div>
                                        </div>
                                        <div class="blog-body">
                                            <div>
                                                <ul class="published-date">
                                                    <li class=""><i class="far fa-calendar-alt"></i>
                                                        {{ date('d-m-y', strtotime(@$v->publish)) }}</li>
                                                    <li class=""><i class="far fa-eye"></i> {{ $v->view }}
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="blog-title">
                                                <a href="{{ Session('lang') }}/blog/{{ $url }}">
                                                    <h4 class="mb-3">{{ $v->name }}</h4>
                                                </a>
                                            </div>
                                            <p>{{ $v->detail }}</p>
                                        </div>
                                        <div class="blog-footer">
                                            <div class="border-3x"></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endif

            <section class="contact-footer page">
                <div class="container">
                    <div id="contact-box-zone">
                        <div class="row">
                            <div class="col-lg-2"></div>
                            <div class="col-lg-8">
                                <div class="box-pro text-center">
                                    <h3 class="title skiptranslate">
                                        <a 
                                            data-th="{{$row->name_th}}"
                                            data-en="{{$row->name_en}}"
                                            @if ($customerStatus) @if ($row->website != '') class="countOfClick" href="{!! $row->website !!}" target="_blank" @endif
                                            @endif
                                            style="text-decoration:none">
                                            <strong>{{ $row->name }}</strong>
                                        </a>
                                    </h3>
                                    <div class="flex-contact">
                                        <p class="address"><i class="icofont-location-pin"></i>
                                            @if ($row->address != '')
                                                {{ @$row->address }}
                                            @elseif($row->address_th != '')
                                                {{ @$row->address_th }}
                                            @else
                                                @lang('phrase.address_not_found')
                                            @endif
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
                                    <div
                                        class="detail-contact ch-blue @if ($row->email == '') btn-no-info @endif">
                                        <a class="mail" href="javascript:" lang="{{ Session('lang') }}"
                                            category={{ Request::segment(2) }} tag="{{ $row->id }}"
                                            text="{{ $row->name ? $row->name : $row->name_th }}"
                                            @if ($row->email == '') disabled @endif>
                                            <img src="images/icon/mail.svg" width="20"> @lang('phrase.contact.inquiry')
                                        </a>
                                        <span class="d-none">{{ $row->email }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-2"></div>
                            @if (@$customerStatus)
                                <div class="col-lg-12" style="height:0; overflow:hidden;" id="formQuotation">
                                    <div class="form-bg-package bg-light my-3">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <h4 class="h3 v1-blue"><strong>@lang('phrase.contact.inquiry')</strong></h4>
                                                <p class="text-orange font-weight-normal">@lang('phrase.contact.inquiry-for', ['company' => $row->name])</span>
                                                </p>
                                                <div class="owl-pagination-custom fd">
                                                    <div class="data-dots-custom active" data-owl-item="0"><img
                                                            src="{{ url($row->logo) }}" alt=""
                                                            width="179" height="89" class="img-fluid">
                                                    </div>
                                                    <div class="data-dots-custom" data-owl-item="1"><img
                                                            src="images/page-package/mk01.webp" alt=""
                                                            width="250" height="153" class="img-fluid">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class=" form-contact-package">
                                                    <form method="get" action="" id="quotationForm"
                                                        novalidate="novalidate">
                                                        <div class="row">

                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="control-label">@lang('phrase.contact.company')</label>
                                                                    <input type="text" name="company"
                                                                        class="form-control" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="control-label">@lang('phrase.contact.name')</label>
                                                                    <input type="text" name="name"
                                                                        class="form-control" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="control-label">@lang('phrase.contact.telephone')</label>
                                                                    <input type="text" name="telephone"
                                                                        class="form-control" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="control-label">@lang('phrase.contact.email')</label>
                                                                    <input type="email" name="email"
                                                                        class="form-control" autocomplete="off">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="control-label">@lang('phrase.contact.department')</label>
                                                                    <input type="text" name="department"
                                                                        class="form-control" autocomplete="off">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="control-label">@lang('phrase.contact-detail')</label>
                                                                    <textarea type="textarea" rows="4" class="form-control" name="detail"></textarea>
                                                                    <input type="hidden" name="companyId"
                                                                        value="{{ $row->id }}">
                                                                    <input type="hidden" name="page"
                                                                        value="Form email At CP Customer">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div
                                                                    style="display:flex; justify-content:center; margin:0 0 10px 0;">
                                                                    <div id="g-recaptcha" class="g-recaptcha"
                                                                        data-sitekey="6LcEE6ooAAAAAN8ZnN5uTezCAeCpAvB6fGuugnKB"
                                                                        data-callback='onSubmit'></div>
                                                                </div>
                                                                <input type="submit" value="@lang('phrase.contact.send-form')"
                                                                    class="message-send btn-block" disabled>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
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

                                                                <a 
                                                                    data-th="{{$row->name_th}}"
                                                                    data-en="{{$row->name_en}}"
                                                                    class="black-text-contact  @if ($row->website != '') countOfClick" @endif
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
                                        @php $blogs = ($blog->count()>0)?$blog->count():0; @endphp
                                        <div class="info-update">
                                            @if ($blog->count() > 0)
                                                <a href="#blog">
                                                    <i class="icofont-page"></i>@lang('phrase.header.blog')
                                                    <span>({{ $blogs }})</span>
                                                </a>
                                            @else
                                                <div>
                                                    <i class="icofont-page"></i>@lang('phrase.header.blog')
                                                    <span>({{ $blogs }})</span>
                                                </div>
                                            @endif
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
                                        <h4 class="date bold mb-0"><i class="icofont-clock-time"></i>
                                            @lang('phrase.working_hours')</h4>
                                    </div>
                                    <div class=" content">
                                        @foreach ($workingHrs as $kwh => $wh)
                                            <table class="table-open col-lg-12">
                                                <tbody>
                                                    <tr>
                                                        <td>{{ $wh->day ? $wh->day : $wh->day_en }}</td>
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
            <style>
                span.no-charge {
                    color: red;
                    font-weight: 900;
                    text-shadow:
                        -0.0075em 0.0075em 0 #fef2f6,
                        0.005em 0.005em 0 #ffaeae,
                        0.01em 0.01em 0 #ffaeae,
                        0.015em 0.015em #ffaeae,
                        0.02em 0.02em 0 #ffaeae,
                        0.025em 0.025em 0 #ffaeae,
                        0.03em 0.03em 0 #ffaeae,
                        0.035em 0.035em 0 #ffaeae;
                }

                .click-here {
                    --s: 0.1em;
                    /* the thickness of the line */
                    --c: #ff6200;
                    /* the color */
                    padding-bottom: var(--s);
                    background:
                        linear-gradient(90deg, var(--c) 50%, #ff6200 0) calc(50% - var(--_p, 0%))/200% 100%,
                        linear-gradient(var(--c) 0 0) 0% 85%/var(--_p, 0%) var(--s) no-repeat;
                    -webkit-background-clip: text, padding-box;
                    background-clip: text, padding-box;
                    transition: 0.5s;
                }

                .click-here:hover {
                    --_p: 100%;
                    color: #ff6200 !important;
                }
            </style>
        @else
            <section class="page">
                <div class="container">
                    <div id="detail-box" class="">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="company-detail card-basic">
                                    <h1 class="mb-4">{{ $row->name }}</h1>
                                    <div class="mt-3">
                                        <div class="flex-contact">
                                            <p class="address"><i class="icofont-location-pin"></i>
                                                {{ @$row->address }}</p>
                                        </div>
                                        <div class="contact-tm text-center">
                                            <div
                                                class="detail-contact ch-tel @if ($row->phone == '') btn-no-info @endif">
                                                <a class="tel" href="javascript:" style="text-decoration: none"
                                                    @if ($row->phone == '') disabled @endif>
                                                    <img src="images/icon/phone-call.svg" width="20">
                                                    <span style="font-size: 18px;">@lang('phrase.contact.telephone')</span>
                                                </a>
                                                <div class=" col-lg-12 d-none">
                                                    <a class="tel-com text-light" style="font-size: 18px"
                                                        href="tel:{{ $row->phone }}">{{ $row->phone }}</a>
                                                </div>
                                            </div>
                                            <div
                                                class="detail-contact ch-blue @if ($row->email == '' || $row->mail == 0) btn-no-info @endif">
                                                <a class="mail" href="javascript:" lang="{{ Session('lang') }}"
                                                    category="{{ Request::segment(2) }}" tag="{{ $row->id }}"
                                                    text="{{ $row->name }}" data-email="{{ $row->email }}"
                                                    style="font-size: 18px; text-decoration: none"
                                                    @if ($row->email == '' || $row->mail == 0) disabled @endif>
                                                    <img src="images/icon/mail.svg" width="20">
                                                    @lang('phrase.contact.inquiry')
                                                </a>
                                                <span class="d-none">{{ $row->email }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="contact-tm mt-2">
                                            <div class="mr-1 button-sh-info mb-4 share-this-page">
                                                <i class="icofont-share mr-1"></i> @lang('phrase.share')
                                            </div>
                                            {{-- <div class="ml-1 button-sh-info mb-4 information">
                                                <i class="icofont-info-circle mr-1"></i> ขอข้อมูลเพิ่มเติม
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <br>
                            </div> <!-- col-lg-8 -->
                            <div class="col-lg-4">
                                <div class="card-popup">
                                    <figure class="snip1205 navy">
                                        <img src="images/detail/popup-basic.jpg"
                                            alt="@lang('phrase.owner-basic') @lang('phrase.owner-interest')" class="img-fluid">
                                        <i class="icofont-search-2"></i>
                                        <a href="https://www.at-once.info/th/web-marketing/cp/1-ce-wind"
                                            target="_blank"></a>
                                    </figure>
                                    <!-- <div class="preview-full"><a href="https://www.at-once.info/th/online-marketing/cp/1-ce-wind">ดูตัวอย่าง Full Company Profile คลิก</a></div> -->
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="">
                                    <div class="">
                                        <div class="contact-full">
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-12 form-title mb-3">
                                                        <h5 class="font-weight-bold text-center">
                                                            @lang('phrase.owner-basic')</h5>
                                                        <h6 class="font-weight-bold text-center"
                                                            style="color:#1f1f1f; font-size:18px">@lang('phrase.owner-interest')
                                                        </h6>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label for="name">@lang('phrase.contact.name') :</label>
                                                            <input type="text" name="name" class="form-control"
                                                                id="name">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="telephone">@lang('phrase.contact.telephone') :</label>
                                                            <input type="text" name="telephone"
                                                                class="form-control" id="telephone">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3">
                                                        <div class="form-group">
                                                            <label for="email">@lang('phrase.contact.email') :</label>
                                                            <input type="text" name="email" class="form-control"
                                                                id="email">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <label for="">@lang('phrase.contact-detail') :</label>
                                                            <textarea name="detail" class="form-control" id="detail" rows="2"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <center>
                                                            <button type="submit"
                                                                class="message-send2 mt-2 send-form">@lang('phrase.contact.send-form')</button>
                                                        </center>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="banner-atonce mt-2">
                                <a href="https://www.at-once.info/th">
                                    <img src="images/banner-blog01.jpg" class="img-fluid"
                                        alt="ร่วมเป็นส่วนหนึ่งกับเว็บไซต์ At Once เพิ่มโอกาสสร้างยอดขายให้กับธุรกิจของคุณได้ง่ายๆ"
                                        width="100%">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <div id="popupBasic" class="modal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content" style="border-radius: 15px;">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="ads">
                                <img src="images/detail/popup-basic.jpg" alt="@lang('phrase.owner-basic') @lang('phrase.owner-interest')"
                                    class="img-fluid">
                                <h5 class="text-center mt-2">@lang('phrase.contact.interest') <a href="javascript:"
                                        class="click-here font-weight-bold">@lang('phrase.contact.clickhere')</a></h5>
                            </div>
                            <div class="form d-none">
                                <form>
                                    <div class="row">
                                        <div class="col-lg-12 form-title">
                                            <h4 class="text-center my-2">@lang('phrase.contact.inquiry')</h4>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="name">@lang('phrase.contact.name') :</label>
                                                <input type="text" name="name" class="form-control"
                                                    id="name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="telephone">@lang('phrase.contact.telephone') :</label>
                                                <input type="text" name="telephone" class="form-control"
                                                    id="telephone">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label for="email">@lang('phrase.contact.email') :</label>
                                                <input type="text" name="email" class="form-control"
                                                    id="email">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">@lang('phrase.contact-detail') :</label>
                                                <textarea name="detail" class="form-control" id="detail" rows="9"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="d-flex">
                                                <button type="button"
                                                    class="btn btn-light btn-block my-0 btn-cancel">Cancel</button>
                                                <button type="submit"
                                                    class="btn btn-success btn-block my-0 btn-send">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endif

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
            background-image: linear-gradient(to right top, #0383ce, #136bb8, #1d54a1, #243d89, #262670);
            /*            background: rgb(255, 255, 254);*/
            border: 1px solid rgb(214, 222, 234);
            box-sizing: border-box;
            /*box-shadow: rgb(0 0 0 / 8%) 0px 2px 4px 1px;*/
            box-shadow: 0px 4px 8px rgb(0 0 0 / 24%), 0px 24px 40px rgb(0 0 0 / 24%);
            border-radius: 12px;
            padding: 30px;
            margin-bottom: 30px;
        }

        .button-sh-info {
            background: #ffffff;
            border: 2px solid rgba(0, 0, 0, 0.08);
            color: #000000;
            padding: 7px 30px;
            border-radius: 48px;
            display: inline-block;
            font-weight: 700;
            font-size: 18px;
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
    @php
        //check cookieBlog for MA
        if (!empty(Cookie::get('cookieBlog'))) {
            $cookie = Cookie::get('cookieBlog'); //contact id
            $contactCid = \App\Models\ContactEmailMd::find($cookie);
            if (@$contactCid->_id == $row->id) {
                //check company id
                \App\Helpers\ClicksBlog::__index($cookie);
            }
        }
    @endphp

    @include("$prefix.footer")

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

    <script src="js/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.es6.js"></script>

</body>

</html>
<script>
    modal = $('#popupBasic');
    timeout = 5000;
    customer = '{{ @$customerStatus->id }}';
    setTimeout(() => {
        if (modal.length > 0) modal.modal('show');
    }, timeout);
    document.addEventListener('click', function(e) {
        click = e.target.closest('.information');
        if (click) {
            modal.modal('show')
        }
        clickHere = e.target.closest('.click-here');
        if (clickHere) {
            modal.modal('hide')
            document.getElementById("name").focus();
            $('html,body').animate({
                scrollTop: $(".contact-full").offset().top
            }, 'slow');
            // ads = clickHere.closest('.modal-body').querySelector('.ads');
            // form = clickHere.closest('.modal-body').querySelector('.form');
            // if (ads.classList.contains('d-none')) {
            //     ads.classList.remove('d-none');
            //     form.classList.add('d-none');
            // } else {
            //     ads.classList.add('d-none');
            //     form.classList.remove('d-none');
            // }
        }
        Cancel = e.target.closest('.btn-cancel');
        if (Cancel) {
            ads = Cancel.closest('.modal-body').querySelector('.ads');
            form = Cancel.closest('.modal-body').querySelector('.form');
            if (ads.classList.contains('d-none')) {
                ads.classList.remove('d-none');
                form.classList.add('d-none');
            } else {
                ads.classList.add('d-none');
                form.classList.remove('d-none');
            }
        }
        Send = e.target.closest('.btn-send');
        if (Send) {
            ads = Send.closest('.modal-body').querySelector('.ads');
            form = Send.closest('.modal-body').querySelector('.form');
            request = [];
            const fd = new FormData();

            $(form.querySelector('form')).validate({
                ignore: [],
                rules: {
                    name: {
                        required: true
                    },
                    telephone: {
                        required: true,
                        number: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    detail: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: '*'
                    },
                    telephone: {
                        required: '*',
                        number: '*'
                    },
                    email: {
                        required: '*',
                        email: '*'
                    },
                    detail: {
                        required: '*'
                    },
                },
                errorPlacement: function(er, el) {
                    er.addClass('mb-0 ml-1');
                    el.closest('.form-group').find('label').append(er);
                },
                submitHandler: function(form, e) {
                    e.preventDefault();
                    Send.setAttribute("disabled", "");
                    if ($(form).find('[role="alert"]').length == 0) {
                        alert = $('<div class="alert alert-dismissible text-center fade show" role="alert">\
                            <strong>Holy guacamole!</strong> <span>You should check in on some of those fields below.</span>\
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                            <span aria-hidden="true">&times;</span>\
                            </button>\
                            </div>');
                    } else {
                        alert = $(form).find('.alert');
                    }
                    fd.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    fd.append('company', $('.card-basic').find('h1').text())
                    fd.append("name", modal.find('input[name="name"]').val());
                    fd.append("telephone", modal.find('input[name="telephone"]').val());
                    fd.append("email", modal.find('input[name="email"]').val());
                    fd.append("detail", modal.find('textarea[name="detail"]').val());
                    store = $.ajax({
                        method: 'POST',
                        url: 'api/contact/s/basic',
                        async: false,
                        processData: false,
                        contentType: false,
                        data: fd
                    }).responseJSON;

                    if (store.statusCode == 200) {
                        alert.removeClass('alert-danger');
                        alert.addClass('alert-success');
                        alert.find('strong').html(store.title);
                        alert.find('strong').next().html(store.message);

                        modal.find('input[name="name"]').val('');
                        modal.find('input[name="telephone"]').val('');
                        modal.find('input[name="email"]').val('');
                        modal.find('textarea[name="detail"]').val('');

                        Send.removeAttribute("disabled", "");
                    } else {
                        alert.removeClass('alert-success');
                        alert.addClass('alert-danger');
                        alert.find('strong').html(store.title);
                        alert.find('strong').next().html(store.message);

                        Send.removeAttribute("disabled", "");
                    }
                    alert.appendTo($(form).find('.form-title'));
                }
            })
        }
        SendForm = e.target.closest('.send-form');
        if (SendForm) {
            form = SendForm.closest('.contact-full').querySelector('form');
            const fd = new FormData();

            $(form).validate({
                ignore: [],
                rules: {
                    name: {
                        required: true
                    },
                    telephone: {
                        required: true,
                        number: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    detail: {
                        required: true
                    },
                },
                messages: {
                    name: {
                        required: '*'
                    },
                    telephone: {
                        required: '*',
                        number: '*'
                    },
                    email: {
                        required: '*',
                        email: '*'
                    },
                    detail: {
                        required: '*'
                    },
                },
                errorPlacement: function(er, el) {
                    er.addClass('mb-0 ml-1');
                    el.closest('.form-group').find('label').append(er);
                },
                submitHandler: function(form, e) {
                    SendForm.setAttribute("disabled", "");
                    e.preventDefault();
                    if ($(form).find('[role="alert"]').length == 0) {
                        alert = $('<div class="alert alert-dismissible text-center fade show" role="alert">\
                            <strong>Holy guacamole!</strong> <span>You should check in on some of those fields below.</span>\
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">\
                            <span aria-hidden="true">&times;</span>\
                            </button>\
                            </div>');
                    } else {
                        alert = $(form).find('.alert');
                    }
                    fd.append("_token", $('meta[name="csrf-token"]').attr('content'));
                    fd.append('company', $('.card-basic').find('h1').text())
                    fd.append("name", $('input[name="name"]').val());
                    fd.append("telephone", $('input[name="telephone"]').val());
                    fd.append("email", $('input[name="email"]').val());
                    fd.append("detail", $('textarea[name="detail"]').val());
                    store = $.ajax({
                        method: 'POST',
                        url: 'api/contact/s/basic',
                        async: false,
                        processData: false,
                        contentType: false,
                        data: fd
                    }).responseJSON;

                    if (store.statusCode == 200) {
                        alert.removeClass('alert-danger');
                        alert.addClass('alert-success');
                        alert.find('strong').html(store.title);
                        alert.find('strong').next().html(store.message);

                        $('input[name="name"]').val('');
                        $('input[name="telephone"]').val('');
                        $('input[name="email"]').val('');
                        $('textarea[name="detail"]').val('');

                        SendForm.removeAttribute("disabled", "");
                    } else {
                        alert.removeClass('alert-success');
                        alert.addClass('alert-danger');
                        alert.find('strong').html(store.title);
                        alert.find('strong').next().html(store.message);
                        SendForm.removeAttribute("disabled", "");
                    }
                    alert.appendTo($(form).find('.form-title'));
                }
            })
        }
    })

    if (customer) {
        $(function() {
            const backlink = document.querySelectorAll('a[href="{{ $row->website }}"]')
            for (let i = 0; i < backlink.length; i++) {
                $('a[href="{{ $row->website }}"]').addClass('countOfClick').css('text-decoration', 'none');
            }
        })
    }

    $(function() {
        $('.chatbox-top').click(function() {
            $(this).closest('.chatbox').toggleClass('chatbox-min');
        });
        $('.fa-close').click(function() {
            $(this).closest('.chatbox').hide();
        });
    });

    var d = $.fn.deviceDetector,
        _id = '{{ $row->id }}',
        categoryId = '{{ $categoryId }}';
    var pageUrl = window.location.pathname.split('/');
    category = pageUrl[2];
    var ipUrl = "https://get.geojs.io/v1/ip/geo.js";
    var geoIp = $.ajax({
        url: ipUrl,
        async: false,
        success: function(res) {
            console.log(res)
        }
    }).responseText;

    function converseToJson(data) {

        if (data != null && typeof data === 'string') {
            if (typeof data === 'string') {
                geoIp = data.replace('geoip', '');
                geoIp = geoIp.replace('(', '');
                geoIp = geoIp.replace(')', '');
                geoIp = JSON.parse(geoIp);
                return geoIp;
            } else {
                return geoIp;
            }
        } else {
            return null;
        }
    }

    function staticsCapture() {
        axios({
            method: 'post',
            url: 'api/' + category + '/store/statistics',
            data: {
                _method: 'PUT',
                company: _id,
                locate: converseToJson(geoIp),
                device: d.getInfo()
            }
        });
    }
    staticsCapture()

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
                ip: geoIp.ip,
                type: "cp-to-website"
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

    $(function() {
        $('a.mail').click(function() {
            if (!customer) {
                actionAd($(this));
                $('.chatbox').removeClass('d-none').removeClass('chatbox-min');
            }
            axios({
                method: 'post',
                url: 'api/' + category + '/store/statistics/click',
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

    $(function() {
        $('a.mailtop').click(function() {
            if (!customer) {
                actionAd($(this));
                $('.chatbox').removeClass('d-none').removeClass('chatbox-min');
            }
            axios({
                method: 'post',
                url: 'api/' + category + '/store/statistics/click',
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
        $('.contact-company-top a.service-pos').click(function() {
            $('html, body').stop().animate({
                scrollTop: $($(this).attr('href')).offset().top - 160
            }, 300);
            return false;
        });
        $('.info-update a').click(function() {
            $('html, body').stop().animate({
                scrollTop: $($(this).attr('href')).offset().top - 160
            }, 300);
            return false;
        });
        if (customer) {
            $('.contact-company-top a.mailtop').click(function() {
                var formQuotation = document.getElementById('formQuotation');
                formQuotation.style.height = null;
                $('html, body').stop().animate({
                    scrollTop: $($(this).attr('href')).offset().top - 160
                }, 300);
                return false;
            });
        }
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
@if (!$customerStatus)
    <script src="js/contact-function.js?v=001"></script>
@else
    <script>
        var formQuotation = document.getElementById('formQuotation');
        document.addEventListener('click', function(e) {
            const buttonQuotation = e.target.closest('.mail');
            if (buttonQuotation) {
                formQuotation.style.height = null;
            }
        });
    </script>
@endif
<script type="text/javascript" src="js/custom-form-contact.js"></script>
<script src="js/statistics.js?v=000034"></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script>
    var reRender = function() {
        grecaptcha.reset();
    };

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

    function onSubmit(token) {
        if (token) {
            document.getElementById('quotationForm').querySelector('[type="submit"]').removeAttribute('disabled');
        }
    }

    $('#quotationForm').submit(function(e) {
        e.preventDefault();
    }).validate({
        validClass: "valid",
        errorClass: "invalid",
        errorElement: "small",
        rules: {
            company: {
                required: true
            },
            name: {
                required: true
            },
            telephone: {
                required: true,
                number: true
            },
            email: {
                required: true,
                email: true
            },
            department: {
                required: true
            },
            detail: {
                required: true
            },
        },
        messages: {
            company: {
                required: "{{ __('phrase.contact.validate.company') }}"
            },
            name: {
                required: "{{ __('phrase.contact.validate.name') }}"
            },
            telephone: {
                required: "{{ __('phrase.contact.validate.telephone') }}",
                number: "{{ __('phrase.contact.validate.numberonly') }}"
            },
            email: {
                required: "{{ __('phrase.contact.validate.email') }}",
                email: "{{ __('phrase.contact.validate.email-pattern') }}"
            },
            department: {
                required: "{{ __('phrase.contact.validate.department') }}"
            },
            detail: {
                required: "{{ __('phrase.contact.validate.detail') }}"
            },
        },
        submitHandler: function(form) {
            inputs = $('#quotationForm').serialize();
            const res = $.ajax({
                method: 'post',
                url: 'my/service/request/quotation',
                data: inputs,
                async: false,
            }).responseJSON;
            alert = document.createElement('div');
            alert.setAttribute('class',
                `alert${res.statusCode == 200 ?' alert-success': ' alert-danger'} text-center w-100`);
            alert.innerHTML = `${res.message.replace('ที่','ที่ <br/>')}`;
            $('#quotationForm').find('.alert')?.remove();
            document.getElementById('quotationForm').querySelector('.row').prepend(alert);
            document.getElementById('quotationForm').querySelector('[type="submit"]').setAttribute(
                'disabled', true);
            reRender();
            if (res.statusCode == 200) {
                $('#quotationForm').find("input[name='company']").val('').removeClass('valid');
                $('#quotationForm').find("input[name='name']").val('').removeClass('valid');
                $('#quotationForm').find("input[name='telephone']").val('').removeClass('valid');
                $('#quotationForm').find("input[name='email']").val('').removeClass('valid');
                $('#quotationForm').find("input[name='department']").val('').removeClass('valid');
                $('#quotationForm').find("textarea[name='detail']").val('').removeClass('valid');
            }
        }
    })
    function getLanguageFromCookie(){
        let name = 'googtrans=';
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for(let i = 0; i <ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
    }
    function setCompapnayName(){    
        let lng = getLanguageFromCookie();
        lng = lng.replace('/auto/','');
        let Heading = document.querySelector('.countOfClick');
        if(lng!='th'){
            Heading.innerHTML = Heading.getAttribute('data-en')
        }else{
            Heading.innerHTML = Heading.getAttribute('data-th')
        }
        let more_jp = Heading.getAttribute('more-jp');
        if(more_jp=='true'){
            more = document.createElement('div');
            more.innerHTML = '{!!$row->more_jp!!}'
            document.querySelector('.detail-content').innerHTML = '';
            document.querySelector('.detail-content').append(more);
        }
    }
    setCompapnayName()

    document.addEventListener('change',function(e){
        const languageSwitch = e.target.closest('.goog-te-combo');
        if(languageSwitch) setCompapnayName();
    })
</script>
