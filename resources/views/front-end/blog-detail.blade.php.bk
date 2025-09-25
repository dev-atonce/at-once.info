<!doctype html>
<html lang="{{ Session('lang') }}">

<head>
    @include("$prefix.analytics.googleAnalytics")
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Article",
            "mainEntityOfPage": {
                "@type": "WebPage",
                "@id": "{{ Request::url() }}"
            },
            "headline": "{{ @$row->name_th }}",
            "image": "{{ url($row->images) }}",
            "author": {
                "@type": "Person",
                "name": "At-once",
                "publisher": {
                    "@type": "Organization",
                    "name": "at-once",
                    "logo": {
                        "@type": "ImageObject",
                        "url": "https://at-once.info/img/logo-bg-white.jpg"
                    }
                },
                "datePublished": "{{ $row->publish }}"
            }
        }
    </script>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $row->seo_keyword }}">
    <meta name="description" content="{{ $row->seo_description }}">
    <meta name="author" content="at-once.info">

    <title>{{ $row->name . ' - ' . env('APP_NAME') }}</title>

    <meta property="og:title" content="{{ $row->name }}">
    <meta property="og:description" content="{{ $row->seo_description }}">
    <meta property="og:image" content="@if ($row->images) {{ url($row->images) }} @endif" />
    <meta property="og:url" content="{{ url('') . '/' . Session('lang') }}/blog/{{ $row->url }}" />

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/panel-box.css" rel="stylesheet">
    <link href="css/header-footer.css" rel="stylesheet">
    <link href="css/blog.css?v=0001" rel="stylesheet">
    <link href="css/detail.css" rel="stylesheet">
    <link href="slick/slick.min.css?v=0002" rel="stylesheet">
    <link href="slick/slick-custom.css?v=0002" rel="stylesheet">
    <link href="css/popup-contact.css" rel="stylesheet">
    <link href="css/validate.css?v=001" rel="stylesheet">
</head>

<body>
    @include("$prefix.header")
    <section class="page">
        <div class="container">
            <div class="card bg-light">
                <div class="card-body rounded-2x border">
                    <form action="{{ $searchUrl }}" method="get">
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="mb-3 text-blue font-weight-bold">@lang('phrase.search')</h5>
                            </div>
                            @if (@$categoryId == '')
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <select name="category" id="category" class="form-control">
                                        <option value="">@lang('phrase.all')</option>
                                        @foreach (\App\Models\CategoryMd::select('id', "name_$lang as name")->where(['status' => 1, 'coming_soon' => 0])->get() as $k => $v)
                                        <option value="{{ $v->id }}"
                                            @if (Request::get('category')==$v->id) selected @endif>
                                            {{ $v->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @endif
                            <div class="col-lg-8">
                                <div class="form-group">
                                    <div class="input-group">
                                        <!-- <div class="input-group-prepend"><label class="input-group-text">ค้นหา</label></div> -->
                                        <input type="text" name="keywords" id="kywords" class="form-control"
                                            placeholder="@lang('phrase.search') ..." value="{{ Request::Get('keywords') }}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-secondary"><i
                                                    class="icofont-search-2"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Request::get('keywords'))
                        <div class="col-lg-12 col-md-12 col-xs-12 pt-2">
                            <h6 class="text-center d-block "><strong>ผลการค้นหา:</strong>
                                {{ Request::get('keywords') }}
                            </h6>
                        </div>
                        @endif
                    </form>
                </div>
            </div>
            <div class="row">

                <div class="col-12 col-md-12 offset-lg-1 col-lg-10 mb-4">
                    <div class="d-block">
                        <img src="{{ $row->images }}" class="img-fluid blog-image" width="100%"
                            alt="{{ $row->name }}">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-fluid p-0 m-0 bg-white blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title">
                        <h1 class="mb-4"><strong>{{ $row->name ? $row->name : $row->name_th }}</strong></h1>
                    </div>
                </div>
            </div>

            <div class="elementor">
                @php
                $creator = $row->comid ? ($row->language == 1 ? $row->company : ($row->language == 2 ? $row->companyJP : ($row->language == 3 ? $row->companyEN : $row->company))) : __('phrase.app_name');
                $logo = $row->company != '' ? $row->logo : 'img/Logo-at-once.jpg';
                $name = $row->profile_url != '' ? $row->profile_url : $row->company;
                $url =
                $row->company != ''
                ? Session('lang') . "/$row->key/cp/" . str_replace(' ', '-', $name)
                : 'javascript:0';
                @endphp
                <div class="row ">
                    <div class="col-lg-8">
                        <div class="writer d-flex">
                            <a href="{{ $url }}" target="_blank"><img src="{{ $logo }}"
                                    width="40" height="40" alt="ผู้เขียนบทความ : {{ $creator }}"
                                    title="ผู้เขียนบทความ : {{ $creator }}"></a>
                            <div class="user-description">
                                <div class="user-name">By : <a href="{{ $url }}">{{ $creator }}</a>
                                </div>
                            </div>
                        </div>
                        <div class="disp-p">
                            <div class="blog-tags-footer mt-1 ml-2">
                                <ul>
                                    @if (!empty($tags))
                                    @foreach ($tags as $i => $tag)
                                    <li @if ($i>= 1) class="ml-1" @endif>
                                        @if ($module == 'blog')
                                        <a
                                            href="{{ Session('lang') }}/{{ $module }}/tag/{{ $tag->tag }}">{{ $tag->tag }}</a>
                                        @else
                                        <a
                                            href="{{ Session('lang') }}/{{ $module }}/blog/tag/{{ $tag->tag }}">{{ $tag->tag }}</a>
                                        @endif
                                    </li>
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="user-read float-none float-lg-right">
                            <div class="post-meta">
                                <p class="date-in"><i class="icofont-ui-clock"></i> Date :
                                    {{ date('d-m-y', strtotime(@$row->publish)) }}
                                </p>
                                <p class="view"><i class="icofont-eye-alt"></i> Views : {{ $row->view }}</p>
                            </div>
                            <div class="blog-sh d-flex justify-content-end">
                                <div class="icon-sh fb-top" id="btnFacebook"
                                    data-href="https://www.facebook.com/sharer/sharer.php?u={{ Request::fullUrl() }}">
                                    <i class="fab fa-facebook"></i>
                                </div>
                                <div class="icon-sh line-sh-top" id="btnLine"
                                    data-href="https://social-plugins.line.me/lineit/share?url={{ Request::fullUrl() }}">
                                    <i class="fab fa-line"></i>
                                </div>
                                <div class="icon-sh mail-top" id="btnMail"
                                    data-href="mailto:?body={{ Request::fullUrl() }}"><i class="fas fa-envelope"></i>
                                </div>
                                <div class="icon-sh link" id=""><i class="fas fa-link"></i>
                                    @lang('phrase.blog.copylink')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="content">
                {!! $row->detail ? $row->detail : $row->detail_th !!}
                {!! $row->recommend !!}
                {!! $row->reference !!}
            </div>

            @if ($row->customerId && !$row->customerStatus && $row->type != 'marketing-blog' && $row->type != 'job-search')
            <div class="form-bg-package bg-light mb-5" id="formpackage">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="h3 v1-blue"><strong>@lang('phrase.contact.inquiry')</strong></h4>
                        <h6><span class="font-weight-bold">@lang('phrase.contact.inquiry-for', ['company' => $row->company])</h6>
                        <div class="owl-pagination-custom fd">
                            <div class="data-dots-custom active" data-owl-item="0"><img
                                    src="{{ url($row->logo) }}" alt="" width="179" height="89"
                                    class="img-fluid">
                            </div>
                            <div class="data-dots-custom" data-owl-item="1"><img
                                    src="images/page-package/mk01.webp" alt="" width="250"
                                    height="153" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-contact-package">
                            <form method="get" action="" id="quotationForm" novalidate="novalidate">
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">@lang('phrase.contact.company')</label>
                                            <input type="text" name="company" class="form-control"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">@lang('phrase.contact.name')</label>
                                            <input type="text" name="name" class="form-control"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">@lang('phrase.contact.department')</label>
                                            <input type="text" name="department" class="form-control"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="control-label">@lang('phrase.contact.telephone')</label>
                                            <input type="text" name="telephone" class="form-control"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label">@lang('phrase.contact.email')</label>
                                            <input type="email" name="email" class="form-control"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="control-label">@lang('phrase.contact-detail')</label>
                                            <textarea type="textarea" rows="4" class="form-control" name="detail"></textarea>
                                            <input type="hidden" name="companyId" value="{{ $row->comid }}">
                                            <input type="hidden" name="page"
                                                value="Form Blog at CP Customer">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div style="display:flex; justify-content:center; margin:0 0 10px 0;">
                                            <div id="g-recaptcha" class="g-recaptcha"
                                                data-sitekey="6LcEE6ooAAAAAN8ZnN5uTezCAeCpAvB6fGuugnKB"
                                                data-callback='onSubmit'></div>
                                        </div>
                                        <input type="submit" value="@lang('phrase.contact.send-form')"
                                            class="message-send btn-block">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="blog-sh mb-3">
                <center>
                    <p class="mb-4"><strong>@lang('phrase.blog.shareblog')</strong></p>
                    <!-- <div class="icon-sh"><i class="icofont-share"></i> แชร์</div> -->
                    <div class="icon-sh fb" id="btnFacebook"
                        data-href="https://www.facebook.com/sharer/sharer.php?u={{ Request::fullUrl() }}"><i
                            class="icofont-facebook "></i> Facebook</div>
                    <div class="icon-sh line-sh" id="btnLine"
                        data-href="https://social-plugins.line.me/lineit/share?url={{ Request::fullUrl() }}"><i
                            class="icofont-line"></i> Line</div>
                    <div class="icon-sh mail" id="btnMail" data-href="mailto:?body={{ Request::fullUrl() }}"><i
                            class="icofont-envelope"></i> Mail</div>
                    <div class="icon-sh link" id=""><i class="fas fa-link"></i> @lang('phrase.blog.copylink')</div>
                </center>
            </div>
            @if ($row->type == 'marketing-blog')
            <section class="my-5">
                <div class="form-bg-blog" id="formpackage">
                    <div class="row">
                        <div class="col-lg-6">
                            <h4 class="h3 v1-blue" style="margin-bottom: 10px;">
                                <strong>@lang('phrase.contact.owner')</strong>
                            </h4>
                            <p style="line-height: 18px;" class="mb-4">
                                <span class="v1-orange h5">@lang('phrase.contact.or')</span> @lang('phrase.contact.product-promotion')<br>
                                @lang('phrase.contact.contact-back')
                            </p>
                            <div class="owl-pagination-custom fd">
                                <div class="data-dots-custom active" data-owl-item="0"><img
                                        src="@if ($row->logo) {{ url($row->logo) }} @else images/page-package/mk02.webp @endif"
                                        alt="" width="179" height="89" class="img-fluid">
                                </div>
                                <div class="data-dots-custom" data-owl-item="1">
                                    <img src="images/page-package/mk01.webp" alt="" width="250"
                                        height="153" class="img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-contact-package">
                                <form method="get" action="" id="formContactPackage1">
                                    <input type="hidden" name="type" value="blog-marketing">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">@lang('phrase.contact.company')</label>
                                                <input type="text" name="company" class="form-control"
                                                    autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">@lang('phrase.contact.name')</label>
                                                <input type="text" name="name" class="form-control"
                                                    autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">@lang('phrase.contact.department')</label>
                                                <input type="department" name="department" class="form-control"
                                                    autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="form-group">
                                                <label class="control-label">@lang('phrase.contact.telephone')</label>
                                                <input type="text" name="telephone" class="form-control"
                                                    autocomplete="off" />
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="control-label">@lang('phrase.contact.email')</label>
                                                <input type="email" name="email" class="form-control"
                                                    autocomplete="off" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label class="control-label">@lang('phrase.contact-detail')</label>
                                                <textarea type="textarea" rows="4" class="form-control" name="detail"></textarea>
                                                <input type="hidden" name="page" id="page"
                                                    value="Form Blog Page">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <input type="submit" value="@lang('phrase.contact.send-form')"
                                                class="message-send btn-block" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            @endif
            <hr>
            @if ($blogReccommend != '')
            @if ($blogReccommend->count() > 0)
            <section id="blog" class="" style="border-bottom: unset; background: unset;">
                <div class="container">
                    <div class="mb-4 ">
                        <div class="d-flex justify-content-between">
                            <h3 class="title-service"><strong><i class="icon icofont-newspaper"></i>
                                    @lang('phrase.blog.blog-recommend')</strong></h3>
                            <div><a class="b-view-more" style="color:rgb(0, 112, 168);"
                                    href="{{ url(Session('lang')) }}/blog-customer-company/{{ $row->comid }}/{{ $row->company }}">@lang('phrase.see-more')
                                    »</a></div>
                        </div>
                    </div>
                    <div class="">
                        <div class="regular slick-slider row">
                            @foreach ($blogReccommend as $k => $v)
                            <div class="col-lg-12">
                                <div class="blog-container slick-slide">
                                    <div class="blog-header">
                                        <div class="blog-cover">
                                            <a href="{{ Session('lang') }}/blog/{{ $v->url_th }}"><img
                                                    src="{{ $v->images }}"
                                                    title="{{ $v->name ? $v->name : $v->name_th }}"
                                                    alt="{{ $v->name ? $v->name : $v->name_th }}"></a>
                                        </div>
                                    </div>
                                    <div class="blog-body">
                                        <div class="blog-title">
                                            <a href="{{ Session('lang') }}/blog/{{ $v->url_th }}">
                                                <h4>{{ $v->name ? $v->name : $v->name_th }}</h4>
                                            </a>
                                        </div>
                                        <div class="blog-tags">
                                            @php
                                            $get_tag = DB::table('blog_join_tag as join')
                                            ->select('tag.tag')
                                            ->leftJoin('tag', 'tag.id', '=', 'join.tag_id')
                                            ->where('join.blog_id', $v->id)
                                            ->get();
                                            @endphp
                                            @if (!empty($get_tag))
                                            <ul>
                                                @foreach ($get_tag as $i => $tag)
                                                <li>
                                                    @if ($module == 'blog')
                                                    <a
                                                        href="{{ Session('lang') }}/{{ $module }}/tag/{{ $tag->tag }}">{{ $tag->tag }}</a>
                                                    @else
                                                    <a
                                                        href="{{ Session('lang') }}/{{ $module }}/blog/tag/{{ $tag->tag }}">{{ $tag->tag }}</a>
                                                    @endif
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="blog-footer">
                                        <ul>
                                            <li class="published-date">
                                                <i
                                                    class="fas fa-calendar-alt"></i>{{ date('d-m-Y', strtotime($v->created)) }}
                                            </li>
                                            <li class="comments"><a href="#">
                                                    <i class="fas fa-eye"></i> {{ $v->view }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            @endif
            @endif
        </div>
    </section>

    @php
    //check cookieBlog for MA
    if (!empty(Cookie::get('cookieBlog'))) {
    $cookie = Cookie::get('cookieBlog'); //contact id
    $contactCid = \App\Models\ContactEmailMd::find($cookie);
    if (@$contactCid->_id == $row->comid) {
    //check company id
    \App\Helpers\ClicksBlog::__index($cookie);
    }
    }
    @endphp

    @include("$prefix.footer")

    <script src="js/jquery.js"></script>
    <script src="js/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js'></script>

    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en">
    </script>
    <script src="plugin/sweetalert2/sweetalert2.all.js"></script>
    <script type="text/javascript" src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript" src="slick/slick.min.js?v=001"></script>
    <script type="text/javascript" src="slick/custom.js"></script>
    <script type="text/javascript" src="slick/main.js"></script>
    {{-- <script type="text/javascript" src="js/ads.js"></script> --}}
    <script type="text/javascript" src="js/statistics.js?v=0001"></script>
    <script type="text/javascript" src="js/custom-form-contact.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        $(function() {
            const links = document.querySelectorAll('a');

            links?.forEach(link => {
                if (link.getAttribute('href')?.includes("{{ $row->profile_url }}")) {
                    link.classList.add('countOfClickCP');
                    link.style.textDecoration = 'none';
                }
                if (link.getAttribute('href')?.includes("{{ $row->website }}")) {
                    link.classList.add('countOfClick');
                    link.style.textDecoration = 'none';
                }
            });
        })

        var onloadCallback = function() {
            console.log("grecaptcha is ready!");
        };
        var reRender = function() {
            grecaptcha.reset();
        };

        $('#btnFacebook,#btnLine,#btnMail').click(function() {
            const url = $(this).data('href');
            window.open(url);
        })

        var $temp = $('<input id="copy-link">');
        var $url = $(location).attr('href');

        $('.link').on('click', function() {
            $("body").append($temp);
            $temp.val($url).select();
            document.execCommand("copy");
            $temp.remove();
        });

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
            }
        });

        $('#formContactPackage1').validate({
            ignore: [],
            errorElement: "span",
            rules: {
                company: {
                    required: true
                },
                name: {
                    required: true,
                    letteronly: "[a-zA-Zก-ฮฤฤๅฦฦๅะ ัา ำ ิ ี ึ ื ุ ูเแโใไ ็ ่ ้ ๊ ๋ ์]+"
                },
                department: {
                    required: true
                },
                telephone: {
                    required: true,
                    digits: true
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
                company: {
                    required: "{{ __('phrase.contact.validate.company') }}"
                },
                name: {
                    required: "{{ __('phrase.contact.validate.name') }}",
                    letteronly: "{{ __('phrase.contact.validate.name') }}",
                },
                department: {
                    required: "{{ __('phrase.contact.validate.department') }}"
                },
                telephone: {
                    required: "{{ __('phrase.contact.validate.telephone') }}",
                    digits: "{{ __('phrase.contact.validate.numberonly') }}"
                },
                email: {
                    required: "{{ __('phrase.contact.validate.email') }}",
                    email: "{{ __('phrase.contact.validate.email-pattern') }}"
                },
                detail: {
                    required: "{{ __('phrase.contact.validate.detail') }}",
                },
            },
            submitHandler: function(form) {
                inputs = $('#formContactPackage1').serialize();
                axios({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'post',
                    url: 'api/package/sendmail',
                    data: inputs
                }).then((result) => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Sussecc',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        reRender();
                        document.querySelectorAll('.form-control').forEach(el => el.classList
                            .remove('valid'));
                        document.querySelectorAll('.form-control').forEach(el => el.value = '');
                    });
                }).catch((err) => {
                    Swal.fire({
                        icon: 'danger',
                        title: 'Please Try Again Later !',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            }
        })

        $(document).on('click', '.countOfClick', function() {
            axios({
                url: 'api/count-of-click',
                method: 'post',
                data: {
                    company: "{{ $row->comid }}",
                    type: "blog-to-web"
                }
            })
        });

        $(document).on('click', '.countOfClickCP', function() {
            axios({
                url: 'api/count-of-click',
                method: 'post',
                data: {
                    company: "{{ $row->comid }}",
                    type: "blog-to-cp"
                }
            })
        });
    </script>

</body>

</html>