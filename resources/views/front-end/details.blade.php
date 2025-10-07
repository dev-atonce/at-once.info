<!doctype html>
<html lang="{{ Session('lang') }}">

<head>
    @include("$prefix.analytics.googleAnalytics")
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $row->seo_keyword ? $row->seo_keyword : $row->seo_keyword_th }}">
    <meta name="description" content="{{ $row->description ? $row->description : ($row->description_th ? $row->description_th : $row->name)}}">
    <meta name="author" content="at-once.info">

    <title>{{ $row->title ? $row->title : $row->name . ' - ' . env('APP_NAME') }}</title>

    <!-- 既存のOrganization Schema（SearchAction削除版） -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "At-Once",
            "url": "https://at-once.info",
            "logo": {
                "@type": "ImageObject",
                "url": "https://at-once.info/img/at-once-tw.png"
            },
            "description": "แหล่งรวบรวมข้อมูลธุรกิจครบวงจรสำหรับค้นหารายชื่อบริษัทจากทุกอุตสาหกรรมในประเทศไทย ผู้ให้บริการเว็บไซต์รวมรายชื่อบริษัทอันดับหนึ่ง พร้อมข้อมูลสำคัญอย่างละเอียดถูกต้องและทันสมัย",
            "areaServed": {
                "@type": "Country",
                "name": "Thailand"
            }
            }
    </script>

    <!-- LocalBusiness Schema -->
    @php
        $dayMap = [
            'Monday' => 'Mo',
            'Tuesday' => 'Tu',
            'Wednesday' => 'We',
            'Thursday' => 'Th',
            'Friday' => 'Fr',
            'Saturday' => 'Sa',
            'Sunday' => 'Su',
        ];
    @endphp
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "LocalBusiness",
            "name": "{{ $row->name }}",
            "url": "https://at-once.info/th/{{ $row->key }}/cp/{{ $row->profile_url }}",
            "description": "{{ $row->detail }}",
            "address": {
                "@type": "PostalAddress",
                "streetAddress": "{{ $row->address }}",
                "addressLocality": "",
                "addressRegion": "",
                "postalCode": "",
                "addressCountry": "TH"
            },
            "telephone": "{{ $row->phone }}",
            "openingHours": [
                @foreach ($workingHrs as $kwh => $wh)
                    "{{ $dayMap[$wh->day_en] }} {{ str_replace(' - ', '-', $wh->time) }}"{{!$loop->last ? ',' : ''}}
                @endforeach
            ],
            "areaServed": {
                "@type": "Country",
                "name": "Thailand"
            },
            "knowsAbout": "{{ $row->category }}"
        }
    </script>

    <!-- BreadcrumbList Schema -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                "@type": "ListItem",
                "position": 1,
                "name": "หน้าแรก",
                "item": "https://at-once.info/th"
                },
                {
                "@type": "ListItem",
                "position": 2,
                "name": "{{ $row->category }}",
                "item": "https://at-once.info/th/{{ $row->key }}"
                },
                {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $row->name }}",
                "item": "https://at-once.info/th/{{ $row->key }}/cp/{{ $row->profile_url }}"
                }
            ]
        }
    </script>

    <meta property="og:title" content="{{ $row->name }}">
    <meta property="og:description" content="{{ $row->seo_description }}">
    <meta property="og:image" content="@if ($row->logo) {{ url($row->logo) }} @endif" />
    <meta property="og:url"
        content="{{ url('') . '/' . Session('lang') }}/{{ $row->key }}/cp/{{ $row->profile_url }}" />

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
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

        .hider-img img {
            display: none !important;
        }
    </style>
</head>

<body>
    @if($row->type=='semi')
    @include("$prefix.header")
    @else
    @if (!$customerStatus)
    @include("$prefix.header")
    @else
    @include("$prefix.translateBox")
    @endif
    @endif

    @if ($row->type != 'basic')

    <nav aria-label="Tab navigation">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link pr-1" aria-current="page" href="{{Session('lang')}}">หน้าแรก</a>
            </li>
            <li class="nav-item">
                <span class="nav-link text-muted px-1">></span>
            </li>
            <li class="nav-item">
                <a class="nav-link px-1" href="{{Session('lang')}}/{{ $row->key }}">{{ $row->category }}</a>
            </li>
            <li class="nav-item"></li>
                <span class="nav-link text-muted px-1">></span>
            </li>
            <li class="nav-item">
                <a class="nav-link active pl-1 text-primary" aria-current="page" href="#">{{ $row->name }}</a>
            </li>
        </ul>
    </nav>

    <section class="">
        <div class="cover" style="position: relative; margin-bottom: 20px">
            @if ($row->type != 'semi')
                <img src="{{ $row->cover ?? asset('images/default-cover.jpg') }}" class="bg-cover-detail-cp img-fluid" loading="lazy" alt="{{ $row->name }} - Cover Image" width="1200" height="400">
            @endif
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
                    <div style="position: absolute; bottom:0; @if($cssAligh) {!! $cssAligh !!} @endif">
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
                                <div class="col-5 col-md-3 col-lg-3 {{$row->type == 'semi' ? 'hider-img' : ''}}">
                                    <center>
                                        @if ($row->public == 1 && $row->logo != '')
                                        <img src="{{ url($row->logo) }}"
                                            class="profile-img img-fluid mb-3 mb-lg-0" loading="lazy" alt="{{ $row->name }} - Company Logo" width="150" height="150">
                                        @else
                                            <div class="company-logo profile-img img-fluid mb-3"
                                                data-name="{{ $row->name ? $row->name : $row->name_th }}"></div>
                                        @endif
                                    </center>
                                </div>
                                <div class="col-7 col-md-9 d-lg-none">
                                    <div class="tag-box-detail p-relative pb-2 mt-3">
                                        <div class="category-tag tag-category-detail">
                                            {{ $row->category ? $row->category : $row->category_th }}
                                        </div>
                                        @if ($row->alpha2)
                                        <div class="category-tag"
                                            style="background: #4caf50; color:white; border: 1px solid #4caf50;">
                                            <img src="flags/{{ strtolower($row->alpha2) }}.png" loading="lazy" alt="{{ $row->nationality }} Flag" width="16" height="12">
                                            {{ $row->nationality }} Company
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 {{$row->type == 'semi' ? 'col-lg-12' : 'col-lg-9'}}">
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
                                                        <img src="flags/{{ strtolower($row->alpha2) }}.png" loading="lazy" alt="{{ $row->nationality }} Flag" width="16" height="12">
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
                                            <button class="btn-sb-company tel-top" style="border-bottom-right-radius: unset;border-top-right-radius: unset;">
                                                <img src="images/icon/phone-call.svg" width="20" height="20" style="filter: invert(1);" loading="lazy" alt="Phone Icon">
                                            </button>
                                            <a class="btn-sb-company mailtop"
                                                @if ($customerStatus) href="#formQuotation" @else href="javascript:0" @endif
                                                style="border-bottom-left-radius: unset;border-top-left-radius: unset;"
                                                lang="{{ Session('lang') }}"
                                                category={{ Request::segment(2) }} tag="{{ $row->id }}"
                                                text="{{ $row->name }}">
                                                <img src="images/icon/mail.svg" width="20" height="20" style="filter: invert(1);" loading="lazy" alt="Mail Icon">
                                            </a>
                                        </div>
                                        @else
                                        <button class="btn-sb-company tel-top">
                                            <img src="images/icon/phone-call.svg" width="20" height="20" style="filter: invert(1);" loading="lazy" alt="Phone Icon">
                                        </button>
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
        @endphp

        <section class="mt-5">
            <div class="container">
                <div class="detail-content {{$row->type == 'semi' ? 'hider-img' : ''}}">
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
        @if ($galls->count() > 0 && $row->type != "semi")
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
                                    <img src="{{ $gall->image }}" class="img-fluid" loading="lazy" alt="{{ $row->name }} - Gallery Image {{ $loop->iteration }}" width="800" height="600">
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
                                            {{ @$i->name ? $i->name : $i->name_th }}
                                        </div>
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

        @if ($blog->count() > 0 && $row->type != 'semi')
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
                                            alt="{{ $v->name }} - Blog Image" loading="lazy" width="300" height="200"></a>
                                </div>
                            </div>
                            <div class="blog-body">
                                <div>
                                    <ul class="published-date">
                                        <li class=""><i class="far fa-calendar-alt"></i>
                                            {{ date('d-m-y', strtotime(@$v->publish)) }}
                                        </li>
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
                                        <img src="images/icon/phone-call.svg" width="20" height="20" loading="lazy" alt="Phone Icon">
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
                                        <img src="images/icon/mail.svg" width="20" height="20" loading="lazy" alt="Mail Icon"> @lang('phrase.contact.inquiry')
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
                                            <div class="data-dots-custom active" data-owl-item="0">
                                                <img src="{{ url($row->logo) }}" alt="{{ $row->name }} - Company Logo"
                                                    width="179" height="89" class="img-fluid" loading="lazy">
                                            </div>
                                            <div class="data-dots-custom" data-owl-item="1">
                                                <img src="images/page-package/mk01.webp" alt="Package Information"
                                                    width="250" height="153" class="img-fluid" loading="lazy">
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
                                        <h4>
                                            <i class="icofont-ui-edit"></i> @lang('phrase.updated')
                                            {{ \App\Helpers\BaseHp::time_passed($row->updated) }}
                                        </h4>
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
                                    <h5 class="date bold mb-0"><i class="icofont-clock-time"></i>
                                        @lang('phrase.working_hours')</h5>
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

        <!-- Critical JavaScript -->
        <script src="js/jquery.js"></script>
        
        <!-- Non-critical JavaScript with defer -->
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"
        defer></script>
        <script src="js/bootstrap.min.js" defer></script>
        <script type="text/javascript" src="js/gallery-box.js" defer></script>
        <script src="js/jquery.mCustomScrollbar.concat.min.js" defer></script>
        <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en" async></script>
        <script type="text/javascript" src="js/custom.js?v=0002" defer></script>
        <script type="text/javascript" src="js/fancybox.js" defer></script>

        <script type="text/javascript" src="slick/slick.min.js?v=001" defer></script>
        <script type="text/javascript" src="slick/custom.js" defer></script>
        <script type="text/javascript" src="slick/main.js" defer></script>

        <script type="text/javascript" src="js/jquery.validate-v1.18.js" defer></script>
        <script type="text/javascript" src="js/build/authentication.js" defer></script>
        <script type="text/javascript" src="js/build/social.media.js" defer></script>
        <script type="text/javascript" src="js/js.device.detector-master/dist/jquery.device.detector.js" defer></script>
        <script type="text/javascript" src="js/blog.color.js" defer></script>

        <script src="js/axios.min.js" defer></script>
        <script src="https://cdn.jsdelivr.net/npm/promise-polyfill@8/dist/polyfill.min.js" defer></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/mark.js/8.11.1/jquery.mark.es6.js" defer></script>

</body>

</html>
<script>
    const profileType = "{{$row->type}}";
    // if (profileType == 'semi') {
        // document.querySelector('.cover').querySelector('img')?.remove();
        // document.querySelector('.profile-img').closest('[class^="col-"]')?.remove();
        // const companyDetail = document.querySelector('.company-detail');
        // companyDetail.closest('[class^="col-"]').classList.add('col-lg-12');
        // companyDetail.closest('[class^="col-"]').classList.remove('col-lg-9');
        // const detailCotnent = document.querySelector('.detail-content');
        // detailCotnent.querySelectorAll('img').forEach((el) => el.remove());
        // detailCotnent.querySelectorAll('img').forEach((el) => {
        //     el.style.filter = 'blur(16px) grayscale(70%)';
        // });
    // }
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
                    axios.post('api/contact/s/basic', fd, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(function(response) {
                        store = response.data;
                    }).catch(function(error) {
                        console.log('Contact form error:', error);
                        store = { statusCode: 500, title: 'Error', message: 'เกิดข้อผิดพลาด' };
                    });

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
                    axios.post('api/contact/s/basic', fd, {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        }
                    }).then(function(response) {
                        store = response.data;
                    }).catch(function(error) {
                        console.log('Contact form error:', error);
                        store = { statusCode: 500, title: 'Error', message: 'เกิดข้อผิดพลาด' };
                    });

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
    var geoIp = null;
    
    // Load geo IP asynchronously - optimized version
    function loadGeoIP() {
        if (typeof axios !== 'undefined') {
            axios.get(ipUrl).then(function(response) {
                geoIp = response.data;
            }).catch(function(error) {
                console.log('Geo IP error:', error);
            });
        }
    }
    
    // Load geo IP when DOM is ready
    $(document).ready(function() {
        loadGeoIP();
    });

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
        const locationData = converseToJson(geoIp);
        
        if (typeof axios !== 'undefined') {
            axios.post('api/' + category + '/store/statistics', {
                _method: 'PUT',
                company: _id,
                locate: locationData,
                device: d.getInfo()
            }).catch(function(error) {
                console.log('Statistics capture error:', error);
            });
        }
    }
    
    // Call staticsCapture after geo IP is loaded
    function callStaticsCapture() {
        setTimeout(function() {
            staticsCapture();
        }, 1000); // Wait 1 second for geo IP to load
    }
    
    // Call statistics capture
    callStaticsCapture();

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
        axios.post('api/count-of-click', {
            company: _id,
            ip: geoIp.ip,
            type: "cp-to-website"
        }).catch(function(error) {
            console.log('Count click error:', error);
        });
    });

    // Tel button click handler - optimized
    $(document).on('click', 'button.tel-top', function() {
        $('.tel-com-top').toggleClass('d-none d-flex');
        
        if ($('.tel-com-top').hasClass('d-flex')) {
            const locationData = converseToJson(geoIp);
            
            if (typeof axios !== 'undefined') {
                axios.post('api/' + category + '/store/statistics/click', {
                    _method: 'PUT',
                    company: _id,
                    c: 't',
                    category: categoryId,
                    locate: locationData || null
                }).catch(function(error) {
                    console.log('Tel click error:', error);
                });
            }
        }
    });

    $('a.tel').on('click', function() {
        $('.tel-com').parent().toggleClass('d-none d-block');
        if ($('.tel-com').parent().hasClass('d-block')) {
            axios.post('api/' + category + '/store/statistics/click', {
                _method: 'PUT',
                company: _id,
                c: 't',
                category: categoryId,
                locate: converseToJson(geoIp)
            }).catch(function(error) {
                console.log('Tel click error:', error);
            });
        }
    });

    $(function() {
        $('a.mail').click(function() {
            if (!customer) {
                actionAd($(this));
                $('.chatbox').removeClass('d-none').removeClass('chatbox-min');
            }
            axios.post('api/' + category + '/store/statistics/click', {
                _method: 'PUT',
                company: _id,
                c: 'm',
                category: categoryId,
                locate: converseToJson(geoIp)
            }).catch(function(error) {
                console.log('Mail click error:', error);
            });
        });
    });

    $(function() {
        $('a.mailtop').click(function() {
            if (!customer) {
                actionAd($(this));
                $('.chatbox').removeClass('d-none').removeClass('chatbox-min');
            }
            axios.post('api/' + category + '/store/statistics/click', {
                _method: 'PUT',
                company: _id,
                c: 'm',
                category: categoryId,
                locate: converseToJson(geoIp)
            }).catch(function(error) {
                console.log('Mailtop click error:', error);
            });
        });
    });

    if ($('.wharehose li').length > 2) {
        $('.see-all').click(function() {
            $(this).toggleText("{{ __('phrase.see - more') }}', '{{ __('phrase.see - less ') }}");
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
<script src="js/contact-function.js?v=001" defer></script>
@else
<script defer>
    var formQuotation = document.getElementById('formQuotation');
    document.addEventListener('click', function(e) {
        const buttonQuotation = e.target.closest('.mail');
        if (buttonQuotation) {
            formQuotation.style.height = null;
        }
    });
</script>
@endif
<script type="text/javascript" src="js/custom-form-contact.js" defer></script>
<script src="js/statistics.js?v=000033" defer></script>
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<script defer>
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
            axios.post('my/service/request/quotation', inputs)
                .then(function(response) {
                    const res = response.data;
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
                })
                .catch(function(error) {
                    console.log('Quotation error:', error);
                    const res = { statusCode: 500, message: 'เกิดข้อผิดพลาด' };
                    alert = document.createElement('div');
                    alert.setAttribute('class', 'alert alert-danger text-center w-100');
                    alert.innerHTML = res.message;
                    $('#quotationForm').find('.alert')?.remove();
                    document.getElementById('quotationForm').querySelector('.row').prepend(alert);
                });
        }
    })

    function getLanguageFromCookie() {
        let name = 'googtrans=';
        let decodedCookie = decodeURIComponent(document.cookie);
        let ca = decodedCookie.split(';');
        for (let i = 0; i < ca.length; i++) {
            let c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
    }

    function setCompapnayName() {
        let lng = getLanguageFromCookie();
        lng = lng.replace('/auto/', '');
        let Heading = document.querySelector('.countOfClick');
        if (lng != 'th') {
            Heading.innerHTML = Heading.getAttribute('data-en')
        } else {
            Heading.innerHTML = Heading.getAttribute('data-th')
        }
        let more_jp = Heading.getAttribute('more-jp');
        if (more_jp == 'true') {
            more = document.createElement('div');
            more.innerHTML = '{!!$row->more_jp!!}'
            document.querySelector('.detail-content').innerHTML = '';
            document.querySelector('.detail-content').append(more);
        }
    }
    setCompapnayName()

    document.addEventListener('change', function(e) {
        const languageSwitch = e.target.closest('.goog-te-combo');
        if (languageSwitch) setCompapnayName();
    })
</script>