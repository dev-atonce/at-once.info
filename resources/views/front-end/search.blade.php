<!doctype html>
<html lang="en">

<head>
    @include("$prefix.analytics.googleAnalytics")
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $seo->seo_keyword }}">
    <meta name="description" content="{{ $seo->seo_description }}">

    <title>{{ $seo->title }}</title>

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
                "name": "ค้นหา",
                "item": "https://at-once.info/th/search"
                }
            ]
        }
    </script>

    <meta property="og:title" content="{{ $seo->title }}">
    <meta property="og:description" content="{{ $seo->seo_description }}">
    <meta property="og:image" content="{{ url('img/logo-bg-white.jpg') }}">
    <meta property="og:url" content="{{ url(Session('lang')) }}">
    
    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/panel-box.css" rel="stylesheet">
    <link href="css/blog.css?v=0001" rel="stylesheet">
    <link href="css/header-footer.css" rel="stylesheet">
    <link rel="stylesheet" href="css/gallery.css">
    <link rel="stylesheet" href="css/lightgallery.css">
</head>
<style type="text/css">
    .text-title {
        position: relative;
        font-weight: 700;
        /* color: #1d1862; */
        font-size: 48px;
        color: #fff;
        padding-bottom: 1rem;
        margin-bottom: 1.25rem;
    }

    .text-title:after {
        content: "";
        position: absolute;
        left: 0;
        bottom: 0;
        height: 2px;
        width: 80px;
        background-color: #3296e2;
    }

    .text-blue {
        color: #3296e2;
    }

    .gallery-wrapper {
        overflow: hidden;
    }

    /*.grid-item {
  padding-bottom: 3rem;
  }*/

    .sidebar {
        text-align: center;
        background: red;
        height: 900px;
    }

    em {
        font-weight: bold;
        color: red;
        font-style: inherit;
        line-height: unset;
    }
</style>

<body style="background-color: #fff;">
    @include("$prefix.header")

    <div class="layout-bannerinsite" style="background-image: url(images/cover-nav.jpg);">
        <span class="layout-bannerinsite-shadow"></span>
        <div class="text-on-banner">
            <div class="container">
                <div class="headline-banner">
                    <div class="mb-5">
                        <span class="text-title">
                            <strong>
                                <span style="color: #f5941c"><span class="text-white pr-3">Search</span><span
                                        class="text-orange">Result</span></span>
                            </strong>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <nav aria-label="Tab navigation">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link pr-1" aria-current="page" href="{{Session('lang')}}">หน้าแรก</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-muted px-1 disabled" href="#" tabindex="-1" aria-disabled="true">></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active pl-1 text-primary" aria-current="page" href="#">ค้นหา</a>
            </li>
        </ul>
    </nav>

    <section class="page">
        <div class="container">
            <div class="company-section">
                <div class="row mb-4">
                    <div class="search-box">
                        <div class="col-lg-12">
                            <h4 class="header bold">
                                <i class="icofont-search-2"></i> ผลการ@lang('phrase.search')
                                <span class="ml-2">"<em>{{ Request::get('keywords') }}</em>"</span>
                            </h4>
                        </div>
                        <div class="col-lg-12">
                            <form action="">
                                <div class="mb-3">
                                    <input type="text" name="keywords" id="keywords" class="form-control"
                                        placeholder="ชื่อบริษัท, บริการ, สถานที่"
                                        value="{{ Request::get('keywords') }}">
                                </div>
                                <div class="d-flex justify-content-end">
                                    <div>
                                        <button type="submit" class="btn btn-search-box">
                                            <i class="icofont-search-2"></i> @lang('phrase.search')
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="search-company">
                        <div class="search-company-header col-lg-12">
                            <h5 class="text-white mb-0">
                                <span class="ml-2">หมวดหมู่บริษัท <em>{{ @$rows->total() }}</em> บริษัท</span>
                            </h5>
                        </div>
                        <div class="search-company-body col-lg-12">
                            @foreach ($rows as $k => $row)
                                @php
                                    $position = strpos($row->line, '@');
                                    if ($position > -1) {
                                        $hrefLine = 'https://line.me/ti/p/' . str_replace('@', '%40', $row->line);
                                    } else {
                                        $hrefLine = 'https://line.me/ti/p/~' . $row->line;
                                    }
                                @endphp
                                <div class="search-company-card">
                                    <div class="row">
                                        @if ($row->type != 'basic')
                                            <div class="col-lg-2 d-flex flex-column justify-content-between">
                                                <div class="search-company-img">
                                                    <img class="img-fluid" src="{{ $row->logo }}"
                                                        title="{{ $row->name }}"
                                                        style="width:120px; max-width: 150px;">
                                                </div>
                                                <div class="search-company-category">
                                                    <a href="/th/{{$row->category}}" target="_blank" class="badge badge-orange"># {{ $row->categoryName }}</a>
                                                </div>
                                                <div class="search-company-social">
                                                    <a @if ($row->website != '') href="{{ $row->website }}" @endif
                                                        target="_blank"
                                                        class="social-icon website @if ($row->website == '') none-social @endif">
                                                        <i class="fas fa-globe-asia"></i>
                                                    </a>
                                                    <a @if ($row->facebook != '') href="{{ $row->facebook }}" @endif
                                                        target="_blank"
                                                        class="social-icon facebook @if ($row->facebook == '') none-social @endif">
                                                        <i class="fab fa-facebook"></i>
                                                    </a>
                                                    <a @if ($row->line != '') href="{{ $hrefLine }}" @endif
                                                        target="_blank"
                                                        class="social-icon line @if ($row->line == '') none-social @endif">
                                                        <i class="fab fa-line"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endif
                                        <div class="@if ($row->type != 'basic') col-lg-8 @else col-lg-10 @endif">
                                            <div class="search-company-name mt-3">
                                                <h5 class="title bold mb-0">
                                                    <a @if ($row->profile_url != '' && $row->profile_url != 'No') href="{{ url(Session('lang')) }}/{{ $row->category }}/cp/{{ $row->profile_url }}" @endif
                                                        target="_blank" class="skiptranslate">{{ $row->name }}</a>
                                                </h5>
                                            </div>
                                            <div class="search-company-location">
                                                @foreach (($row->search_locations ?? []) as $province)
                                                    <span class="badge-location"><i
                                                            class="fas fa-map-marker-alt fa-fw"></i>
                                                        {{ $province }}</span>
                                                @endforeach
                                            </div>
                                            <div class="search-company-description">
                                                @if ($row->type != 'basic')
                                                    <p class="company-description"> {{ $row->description }}</p>
                                                @else
                                                    <p class="company-description-basic"> {{ $row->description }}</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div
                                            class="col-lg-2 @if ($row->type != 'basic') d-flex flex-column justify-content-between @else d-flex justify-content-center align-items-center @endif">
                                            @php
                                                $galleryItems = $row->search_gallery ?? collect();
                                                $count = $galleryItems->count();
                                            @endphp
                                            @if ($row->type == 'full')
                                                <div class="light-g d-none d-lg-block">
                                                    <div class="gallery-flex relative-gall"
                                                        id="lightg{{ $k }}">
                                                        @foreach ($galleryItems as $kg => $vg)
                                                            <a href="{{ $vg->image }}"
                                                                style="background-image:url({{ str_replace('.', '-sm.', $vg->image) }});background-position:center;background-size:cover;border-radius:4px; @if ($kg >= 4) position:relative;display:none; @endif">
                                                                <img src="{{ str_replace('.', '-sm.', $vg->image) }}"
                                                                    class="cWzaZM" style="display: none;">
                                                                @if ($kg == 3)
                                                                    <div class="overlay-see-all"><span
                                                                            class="backdrop-gallery"
                                                                            style="text-align:center;vertical-align:middle;height:100%;vertical-align:-webkit-baseline-middle;">ดูภาพทั้งหมด</span>
                                                                    </div>
                                                                @endif
                                                            </a>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="search-company-detail mt-2">
                                                <a target="_blank"
                                                    @if ($row->profile_url != '') href="{{ url(Session('lang')) }}/{{ $row->category }}/cp/{{ $row->profile_url }}" @endif
                                                    class="btn btn-search-box skiptranslate" capture="index"
                                                    @if ($row->profile_url != '') data-full="{{ Session('lang') }}/{{ $row->category }}/cp/{{ $row->profile_url }}" @endif>
                                                    @lang('phrase.see-details')
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-center algin-items-center">
                                {{ $rows->appends(request()->except(['company_page', 'page']))->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="blog-section mt-5">
                <div class="search-blog">
                    <div class="row">
                        <h5 class="mb-4">
                            <span class="ml-2">หมวดหมู่บทความ <em>{{ $shouldLoadBlog ? @$blogs->total() : '...' }}</em> บทความ</span>
                        </h5>
                    </div>
                    <div id="blog-section-content">
                        @if ($shouldLoadBlog)
                            @include('front-end.partials.search-blog-list', ['blogs' => $blogs])
                        @else
                            <div class="text-center py-4 text-muted">กำลังโหลดบทความ...</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("$prefix.footer")

    @if (!empty($searchDebug))
    <script>
        console.log('[search debug]', @json($searchDebug));
        console.log('[search debug] company page rows:', {{ $searchDebug['company']['page_rows'] }}, '/ total matched:', {{ $searchDebug['company']['total_matched'] }}, '/ query:', {{ $searchDebug['company']['query_ms'] }}, 'ms', '/ cache:', {{ $searchDebug['company']['cache_hit'] ? 'true' : 'false' }});
        console.log('[search debug] blog page rows:', {{ $searchDebug['blog']['page_rows'] }}, '/ total matched:', {{ $searchDebug['blog']['total_matched'] }}, '/ query:', {{ $searchDebug['blog']['query_ms'] }}, 'ms', '/ cache:', {{ $searchDebug['blog']['cache_hit'] ? 'true' : 'false' }});
    </script>
    @endif
    @if (!$shouldLoadBlog)
    <script>
        (function() {
            const container = document.getElementById('blog-section-content');
            if (!container) return;
            const url = new URL(window.location.href);
            url.searchParams.set('load_blog', '1');
            url.searchParams.set('partial', 'blogs');
            fetch(url.toString(), {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(res => res.text())
            .then(html => { container.innerHTML = html; })
            .catch(() => { container.innerHTML = '<div class="text-center py-4 text-danger">โหลดบทความไม่สำเร็จ</div>'; });
        })();
    </script>
    @endif
    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    {{-- <script type="text/javascript" src="js/blog.color.js"></script> --}}
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/img-detect.js"></script>
    <script src="js/lightgallery.js"></script>
    <script src="js/lg-fullscreen.js"></script>
    <script src="js/lg-thumbnail.js"></script>
</body>
<script>
    $('.light-g').each(function() {
        $(this).find('.gallery-flex').lightGallery({
            thumbnail: true,
            download: false
        })
    });
</script>

</html>
