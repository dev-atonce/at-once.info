<!doctype html>
<html lang="{{ Session('lang') }}">

<head>
    @include("$prefix.analytics.googleAnalytics")
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $seo->seo_keyword ? $seo->seo_keyword : $seo->seo_keyword_th }}">
    <meta name="description" content="{{ $seo->seo_description ? $seo->seo_description :  $seo->seo_description_th }}">

    <title>{{ $seo->title ? $seo->title : $seo->title_th }}</title>

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
                "name": "บทความ",
                "item": "https://at-once.info/th/{{ $segment }}"
                }
            ]
        }
    </script>

    <meta property="og:title" content="{{ $seo->title ? $seo->title : $seo->title_th }}">
    <meta property="og:description" content="{{ $seo->seo_description ? $seo->seo_description :  $seo->seo_description_th }}">
    <meta property="og:image" content="{{ url('img/logo-bg-white.jpg') }}">
    <meta property="og:url" content="{{ url('') . '/' . Session('lang') . '/blog' }}">

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/header-footer.css?v=0006">
    <link rel="stylesheet" href="css/panel-box.css?v=0005">
    <link rel="stylesheet" href="css/aos.css">
    <link href="back-end/slimselectjs/slimselect.min.css" rel="stylesheet">

</head>
<style>
    .ss-content.ss-open {
        left: 0 !important;
    }

    .ss-single-selected {
        padding: 0px 0px 4px 0px !important;
        border: unset !important;
    }

    @keyframes changeColor {
        from {
            background-color: aliceblue;
        }

        to {
            background-color: rgb(250, 232, 215);
        }
    }

    .lazy-circle {
        width: 33px;
        height: 33px;
        border-radius: 50%;
        background-color: aliceblue;
        animation: changeColor 1.5s infinite alternate;
    }

    .lazy-bar {
        display: block;
        height: 10px;
        width: 100%;
        border-radius: 15px;
        min-height: 10px;
        background-color: aliceblue;
        animation: changeColor 1.5s infinite alternate;

    }

    .mnw-50 {
        min-width: 50px;
    }

    .mxw-50 {
        max-width: 50px;
    }

    .mnw-100 {
        min-width: 100px;
    }

    .mxw-100 {
        max-width: 100px;
    }

    .mxw-130 {
        max-width: 130px;
    }

    .order-by.active {
        color: #007bff;
        background-color: unset !important;
    }
</style>

<body>
    @include("$prefix.header")

    <div class="layout-bannerinsite" style="background-image: url(images/cover-nav.jpg);">
        <span class="layout-bannerinsite-shadow"></span>
        <div class="text-on-banner">
            <div class="container">
                <div class="headline-banner">
                    <div class="">
                        @php
                            $header = [$head, $moduleName];
                        @endphp
                        <h1 class="v1-orange"> <span class="text-title">{{ $header[0] }} </span>
                            {{ $header[1] }}</h1>
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
                <a class="nav-link active pl-1 text-primary" aria-current="page" href="#">{{ $segment }}</a>
            </li>
        </ul>
    </nav>

    @php
        $search = Request::get('category') ? '?category=' . Request::get('category') : '';
        $search .= $search != '' && Request::get('keywords') ? $search . '&keywords=' . Request::get('keywords') : '';
        $search .= Request::get('keywords') ? '?keywords=' . Request::get('keywords') : '';
        $lang = Session('lang');
    @endphp
    <section class="page">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (!empty($tag))
                        <h5 class="mb-4 v1-orange">Tag: {{ $tag }}</h5>
                    @else
                        <h3 class="mb-4"><strong>@lang('phrase.blog.caption')</strong></h3>
                    @endif
                </div>
            </div>
            <div class="card v1-sha01 radius-lg bg-gray">
                <div class="card-body">
                    <form action="" method="get">
                        <div class="row">
                            <div class="col-lg-12 d-flex align-items-center flex-wrap mb-3">
                                <div class="h5 v1-blue mb-0 mr-2">
                                    <strong>@lang('phrase.search')</strong>
                                </div>
                                @if ($segment != 'blog' && $segment != 'blog-package' && $segment != 'blog-customer-company')
                                    <a class="badge badge-blog mb-1 mr-1 @if ($segment == 'blog-review') active @endif"
                                        href="{{ Session('lang') }}/blog-review">@lang('phrase.blog.blog-review')</a>
                                    <a class="badge badge-blog mb-1 mr-1 @if ($segment == 'blog-promotion') active @endif"
                                        href="{{ Session('lang') }}/blog-promotion">@lang('phrase.blog.blog-promotion')</a>
                                    <a class="badge badge-blog mb-1 mr-1 @if ($segment == 'job-search') active @endif"
                                        href="{{ Session('lang') }}/job-search">@lang('phrase.blog.blog-jobsearch')</a>
                                    <a class="badge badge-blog mb-1 mr-1 @if ($segment == 'blog-wtb') active @endif"
                                        href="{{ Session('lang') }}/blog-wtb">@lang('phrase.blog.blog-wtb')</a>
                                    <a class="badge badge-blog mb-1 mr-1 @if ($segment == 'blog-wts') active @endif"
                                        href="{{ Session('lang') }}/blog-wts">@lang('phrase.blog.blog-wts')</a>
                                    <a class="badge badge-blog mb-1 mr-1 @if ($segment == 'blog-customer') active @endif"
                                        href="{{ Session('lang') }}/blog-customer">@lang('phrase.blog.blog-customer')</a>
                                    <a class="badge badge-blog mb-1 mr-1 @if ($segment == 'blog-company') active @endif"
                                        href="{{ Session('lang') }}/blog-company">@lang('phrase.all')</a>
                                @endif
                            </div>
                            @if (@$categoryId == '')
                                @if ($segment != 'blog-package')
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <select name="category" id="category" class="form-control">
                                                <option value="">@lang('phrase.all')</option>
                                                @foreach (\App\Models\CategoryMd::select('id', "name_$lang as name")->where(['status' => 1, 'coming_soon' => 0])->get() as $k => $v)
                                                    <option value="{{ $v->id }}"
                                                        @if (Request::get('category') == $v->id) selected @endif>
                                                        {{ $v->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                            @endif
                            <div class="@if ($segment == 'blog-package') col-lg-12 @else col-lg-8 @endif">
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
                            @if (Request::get('keywords'))
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12">
                                        <h6 class="mx-3"><strong>@lang('phrase.result')</strong> {{ Request::get('keywords') }}
                                        </h6>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-4">
                <div class="dropdown show">
                    <a class="btn btn-primary dropdown-toggle" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                        style="background: none !important; color: #0056b3; border:none">
                        <i class="fas fa-sort-amount-down"></i> <span class="order-by-title"
                            title="@lang('phrase.sort-by')">@lang('phrase.sort-by')</span>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item order-by active" orderBy="?by=publish&sort=desc&lang={{ Session('lang') }}"
                            href="javascript:">@lang('phrase.sort.date-new')</a>
                        <a class="dropdown-item order-by" orderBy="?by=publish&sort=asc&lang={{ Session('lang') }}"
                            href="javascript:">@lang('phrase.sort.date-old')</a>
                        <a class="dropdown-item order-by" orderBy="?by=view&sort=desc&lang={{ Session('lang') }}"
                            href="javascript:">@lang('phrase.sort.view-high')</a>
                        <a class="dropdown-item order-by" orderBy="?by=view&sort=asc&lang={{ Session('lang') }}" href="javascript:">@lang('phrase.sort.view-low')</a>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <div class="row blog-data">
                    @for ($i = 0; $i < $perPage; $i++)
                        <div class="col-md-6 col-lg-4 col-xl-3 d-flex blog-list">
                            <div class="blog-container">
                                <div class="blog-header">
                                    <div class="post-meta">
                                        <div class="company-logo">
                                            <div class="lazy-circle"></div>
                                        </div>
                                        <div class="createdby">
                                            <div class="written-by mnw-50 mxw-50">
                                                <div class="lazy-bar"></div>
                                            </div>
                                            <div class="industry-name mt-2 mnw-100">
                                                <div class="lazy-bar"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="blog-cover">
                                        <div class="lazy-bar mt-1" style="height:152px;"></div>
                                    </div>
                                </div>
                                <div class="blog-body">
                                    <div>
                                        <ul class="published-date">
                                            <li class="mnw-50 mxw-50">
                                                <div class="lazy-bar"></div>
                                            </li>
                                            <li class="mnw-50">
                                                <div class="lazy-bar"></div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="blog-title">
                                        <div class="lazy-bar"></div>
                                    </div>
                                    <p>
                                    <div class="lazy-bar"></div>
                                    <div class="lazy-bar mt-2 mxw-130"></div>
                                    <p>
                                </div>
                                <div class="blog-footer">
                                    <div class="border-3x {{ $_border }}"></div>
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
            <div class="container middle mt-2 mb-5">
                <div class="pagination form-inline d-flex justify-content-between"></div>
            </div>
        </div>
    </section>
    
    @include("$prefix.analytics.gtagBody")
    @include("$prefix.footer")
    
    <script>
        let previous = "{{ __('phrase.paginate.previous') }}";
        let next = "{{ __('phrase.paginate.next') }}";
        let ofpage = "{{ __('phrase.paginate.of') }}";
        let page = "{{ __('phrase.paginate.page') }}";
        let tag = "{{ $tag }}";
        
        var lang = "{{ Session('lang') }}";
        var rows = document.querySelector('.blog-data');
        var _color = '{{ $_color }}';
        var _border = '{{ $_border }}';
        var queryString = `?by=publish&sort=desc&lang=${lang}`;
        var urlQuueryString = window.location.search;

        var path = window.location.pathname;

        path = path.split('/');
        path = path.filter((a) => a);
        blogType = path[1];

        let apiUrl = '';
        switch (blogType) {
            case 'blog-company':
                apiUrl = `api/blog/all/company`;
                break;
            case 'blog-package':
                apiUrl = `api/blog/all/marketing-blog`;
                break;
            case 'blog-review':
                apiUrl = `api/blog/all/review`;
                break;
            case 'blog-promotion':
                apiUrl = `api/blog/all/promotion`;
                break;
            case 'job-search':
                apiUrl = `api/blog/all/job-search`;
                break;
            case 'blog-wtb':
                apiUrl = `api/blog/all/want-to-buy`;
                break;
            case 'blog-wts':
                apiUrl = `api/blog/all/want-to-sale`;
                break;
            case 'blog-customer':
                apiUrl = `api/blog/all/customer`;
                break;
            default:
                apiUrl = `api/blog/all/general`;
                break;
        }


        setTimeout(() => {
            lazyload(queryString);
        }, 1200);
        var allPage = 0;
        var perPage = 24;
        var currentPage = 1;
        var overLay = document.querySelector('.loading-overlay');
        var lazyBar = document.createElement('div');
        var lazyCircle = document.createElement('div');
        lazyBar.setAttribute('class', 'lazy-bar');
        lazyCircle.setAttribute('class', 'lazy-circle');
        var blogs;
        var lazyItem = `
        <div class="col-md-6 col-lg-4 col-xl-3 d-flex blog-list'">
            <div class="blog-container">
                <div class="blog-header">
                    <div class="post-meta">
                        <div class="company-logo"><div class="lazy-circle"></div></div>
                        <div class="createdby">
                            <div class="written-by mnw-50 mxw-50"><div class="lazy-bar"></div></div>
                            <div class="industry-name mt-2 mnw-100"><div class="lazy-bar"></div></div>
                        </div>
                    </div>
                    <div class="blog-cover"><div class="lazy-bar mt-1" style="height:152px;"></div></div>
                </div>
                <div class="blog-body">
                    <div>
                        <ul class="published-date">
                            <li class="mnw-50 mxw-50"><div class="lazy-bar"></div></li>
                            <li class="mnw-50"><div class="lazy-bar"></div></li>
                        </ul>
                    </div>
                    <div class="blog-title"><div class="lazy-bar"></div></div>
                    <p><div class="lazy-bar"></div><div class="lazy-bar mt-2 mxw-130"></div><p>
                </div>
                <div class="blog-footer">
                    <div class="border-3x ${_border}"></div>
                </div>
            </div>
        </div>
        `;

        document.addEventListener('click', function(e) {
            orderBy = e.target.closest('.order-by');
            if (orderBy) {
                orderBy.closest('.dropdown-menu').querySelector('.active')?.classList.remove('active');
                orderBy.classList.add('active');
                let queryString = orderBy.getAttribute('orderBy');
                activeOrderBy()
                lazyload(queryString);
            }
        });
        document.addEventListener('change', function(e) {
            const select = e.target.closest('[name="pagination"]');
            if (select) {
                select.setAttribute('selected', true);
                lazyNext(select.value)
            }
        })

        function lazyload(queryString) {
            let replace = '';
            for (i = 0; i < perPage; i++) {
                replace += lazyItem;
            }

            rows.innerHTML = replace;
            getBlog(queryString).then(data => {
                console.log(queryString);
                loadItems(data);
                loadPaginate(data);
            });
        }

        function lazyNext(queryString) {
            let replace = '';
            for (i = 0; i < perPage; i++) {
                replace += lazyItem;
            }

            rows.innerHTML = replace;
            getBlog(queryString).then(data => {
                console.log(queryString);
                loadItems(data);
                adjustPagination();
            });
        }

        async function getBlog(queryString) {
            newQueryString = (urlQuueryString != '') ? `${urlQuueryString}&${queryString.replace('?','')}` :
                queryString;
            url = apiUrl + newQueryString;

            const response = await fetch(`${url}`);
            const data = await response.json();

            return data;
        }

        function loadItems(e) {
            let htmlItem = '';
            const onItem = `<div class="col-lg-12 text-center"><p>ไม่พบข้อมูล</p></div>`;
            if (e.data.length == 0) {
                rows.innerHTML = onItem;
            } else {
                e.data.forEach(function(v) {
                    categoryName = (v.categoryName != null) ? v.categoryName : '';
                    htmlItem += `
                    <div class="col-md-6 col-lg-4 col-xl-3 d-flex blog-list">
                        <div class="blog-container">
                            <div class="blog-header">
                                <div class="post-meta">
                                    <a class="company-logo" href="${v.by_url!=null?`${v.by_url}`:`/th`}">
                                        <img src="${v.by_logo!=null?`${v.by_logo}`:`img/at-once.jpg`}">
                                    </a>
                                    <div class="createdby">
                                        <div class="written-by">${v.by!=null?`${v.by}`:`At-Once`}</div>
                                        <div class="industry-name">
                                            <i class="fas fa-circle bullet ${_color}"></i>
                                            ${v.blogType != 'marketing-blog'? `${v.categoryName}`:`บทความการตลาด`}
                                        </div>
                                    </div>
                                </div>
                                <div class="blog-cover">
                                    <a href="${v.url}">
                                        <img class="" src="${v.cover}" alt="${v.name}" title="${v.name}"/>
                                    <a>
                                </div>
                            </div>
                            <div class="blog-body">
                                <div>
                                    <ul class="published-date">
                                        <li class=""><i class="far fa-calendar-alt"></i> ${v.publish}</li>
                                        <li class=""><i class="far fa-eye"></i> ${v.view}</li>
                                    </ul>
                                </div>
                                <div class="blog-title"><a href="${v.url}"><h4 class="mb-2">${v.name?v.name:v.name_th}<h4></a></div>
                                <p>${v.description?v.description:v.more_th}<p>
                            </div>
                            <div class="blog-footer">
                                <div class="border-3x ${_border}"></div>
                            </div>        
                        </div>        
                    </div>
                    `;
                });
                rows.innerHTML = htmlItem;
            }
        }

        function loadPaginate(e) {
            if (e.links.allPage == 0) return false;
            let select = `
                <div class="pagination-control prev-page invisible"><a href="javascript:" class="font-weight-bold control-item" action="prev">${previous}</a></div>
                <div class="select-option"><span class="mr-2">${page}</span><select class="form-control pagination-select" name="pagination">
                
            `;
            const links = e.links;

            for (let i = 0; i < links.allPage; i++) {
                select += `<option value="?by=${links.by}&sort=${links.sort}&page=${i+1}&lang=${links.lang}">${i+1}</option>`;
            }
            select +=
                `
                </select>
                <span class="ml-2">${ofpage} ${links.allPage}</span>
            </div>
            <div class="pagination-control next-page"><a href="javascript:" class="font-weight-bold control-item" action="next">${next}</a></div>`;
            const paginateion = document.querySelector('.pagination');
            paginateion.innerHTML == '';
            paginateion.innerHTML = select;
            // if (paginateion.innerHTML == '') paginateion.innerHTML = select;
            allPage = links.allPage;
            Array.prototype.map.call(document.querySelectorAll('.control-item'), (item) => {
                item.onclick = adjustPage;
            });
            adjustPagination();

        }
        activeOrderBy()

        function activeOrderBy() {
            const title = document.querySelector('.order-by-title');
            const active = title.closest('.dropdown').querySelector('.dropdown-menu > .active');
            if (active) title.innerHTML = active.innerHTML;
        }

        function adjustPagination() {
            select = document.querySelector('.pagination-select');
            currentPage = select.selectedIndex + 1;
            const prev = document.querySelector('.prev-page');
            const next = document.querySelector('.next-page');
            if (currentPage > 1) prev.classList.remove('invisible');
            else prev.classList.add('invisible')
            if (currentPage == allPage) next.classList.add('invisible');
            else next.classList.remove('invisible');
        }

        function adjustPage() {
            pagination = document.querySelector('.pagination');
            const cur = this;
            const action = cur.getAttribute('action');
            const select = pagination.querySelector('select');
            let page = select.selectedIndex + 1;
            if (action == 'next') page++;
            else page--;
            select[(page - 1)].selected = 'selected';

            lazyNext(select[(page - 1)].value);
        }
    </script>
    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en">
    </script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    <script src="back-end/slimselectjs/slimselect.min.js"></script>
    <script src="js/aos.js"></script>
    {{-- <script src="js/blog.color.js"></script> --}}
    <script>
        // new SlimSelect({
        //     select: '#category'
        // });
        // AOS.init();

        // $(".dropdown-menu .dropdown-item").click(function() {
        //     var selText = $(this).text();
        //     $(this).parents('.dropdown').find('#dropdownMenuButton').html('<i class="fas fa-sort-amount-down"></i> ' + selText);
        // });
    </script>
</body>

</html>
