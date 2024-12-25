<!doctype html>
<html lang="en">

<head>

    <!-- End Google Tag Manager -->

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $row->seo_keyword }}" />
    <meta name="description" content="{{ $row->seo_description }}" />
    <meta name="author" content="at-once.info">
    <title>{{ $row->name }}</title>

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



</head>

<body>


    @include("$prefix.header")

    <section class="page">
        <div class="container">
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
                        <h1 class="mb-4"><strong>{{ $row->name }}</strong></h1>
                    </div>
                </div>
            </div>

            <div class="elementor">
                @php
                    $category = Request::segment(2);
                    $creator = $row->comid ? ($row->language == 1 ? $row->company : ($row->language == 2 ? $row->companyJP : ($row->language == 3 ? $row->companyEN : $row->company))) : __('phrase.app_name');
                    $logo = $row->company != '' ? $row->logo : 'img/Logo-at-once.jpg';
                    $name = $row->profile_url != '' ? $row->profile_url : $row->company;
                    $url = $row->company != '' ? Session('lang') . "/$category/cp/" . str_replace(' ', '-', $name) : '';
                @endphp
                <div class="row ">
                    <div class="col-lg-8">
                        <div class="writer d-flex">
                            <img src="{{ $logo }}" width="40" height="40"
                                alt="ผู้เขียนบทความ : {{ $creator }}" title="ผู้เขียนบทความ : {{ $creator }}">
                            <div class="user-description">
                                <div class="user-name">By : <a href="{{ $url }}">{{ $creator }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="user-read float-none float-lg-right">
                            <div class="post-meta">
                                <p class="date-in"><i class="icofont-ui-clock"></i> Date :
                                    {{ date_format($row->created, 'd-m-Y') }}</p>
                                <p class="view"><i class="icofont-eye-alt"></i> Views : {{ $row->view }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content">
                {!! $row->detail !!}
                {!! $row->recommend !!}
                {!! $row->reference !!}
            </div>


            <div class="blog-sh mb-3">
                <hr>
                <center>
                    <p>SHARE THIS NEWS & ACTIVITIES</p>
                    <!-- <div class="icon-sh"><i class="icofont-share"></i> แชร์</div> -->
                    <div class="icon-sh fb" id="btnFacebook"
                        data-href="https://www.facebook.com/sharer/sharer.php?u={{ url(Session('lang') . '/blog/detail/' . $row->url) }}">
                        <i class="icofont-facebook "></i> Facebook
                    </div>
                    <div class="icon-sh line-sh" id="btnLine"
                        data-href="https://social-plugins.line.me/lineit/share?url={{ url(Session('lang') . '/blog/detail/' . $row->url) }}">
                        <i class="icofont-line"></i> Line
                    </div>
                    <div class="icon-sh mail" id="btnMail"
                        data-href="mailto:?body={{ url(Session('lang') . '/blog/detail/' . $row->url) }}"><i
                            class="icofont-envelope"></i> Mail</div>
                </center>
            </div>


        </div>
    </section>

    <section class="page" style="background-color: #f4f6f9;">
        <div class="container">
            <div class="d-flex">
                <h4 class="tt-news bold mb-3 XWyRR"> Featured News & Activity</h4>
                <div><a class="b-view-more gKiAgG" href="{{ url(Session('lang')) }}/blog">ดูทั้งหมด »</a></div>
            </div>

            <div class="regular slider row">
                @if (!empty($blog_menu))
                    @foreach ($blog_menu as $menu)
                        <div class="col-lg-4 d-flex">

                            <div class="blog-container">
                                <div class="blog-header">
                                    <div class="blog-cover">
                                        <a href="{{ Session('lang') }}/{{ $module }}/blog/{{ $menu->url }}"><img
                                                src="{{ $menu->images }}"></a>
                                    </div>
                                </div>
                                <div class="blog-body">

                                    <div class="post-meta">
                                        <p class="written-by">
                                            <img src="img/Logo-at-once.jpg" alt=""><a href="">At
                                                Once</a>
                                        </p>
                                    </div>

                                    <div class="blog-title">
                                        <a
                                            href="{{ Session('lang') }}/{{ $module }}/blog/{{ $menu->url }}">
                                            <h5 class="mb-0">{{ $menu->name }}</h5>
                                        </a>
                                    </div>

                                    @php
                                        $get_tag = DB::table('blog_join_tag as join')
                                            ->select('tag.tag')
                                            ->leftJoin('tag', 'tag.id', '=', 'join.tag_id')
                                            ->where('join.blog_id', $menu->id)
                                            ->get();
                                    @endphp
                                    <!--    <div class="blog-tags">
            <ul>
              @if (!empty($get_tag))
@foreach ($get_tag as $tag)
<li><a href="{{ Session('lang') }}/{{ $module }}/tag/{{ $tag->tag }}">{{ $tag->tag }}</a></li>
@endforeach
@endif
            </ul>
          </div> -->
                                </div>



                                <div class="blog-footer">

                                    <ul>
                                        <li class="published-date">{{ date('d-m-Y', strtotime($menu->created)) }}</li>
                                        <li class="comments"><a href="#"><i class="icofont-eye-alt"></i>
                                                {{ $menu->view }}</a></li>
                                        <!-- <li class="shares"><a href="https://www.facebook.com/sharer/sharer.php?u={{ url(Session('lang') . '/' . $module . '/blog/' . $menu->url) }}" target="_blank"><i class="icofont-share"></i> share</a></li> -->
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>


    </section>





    @include("$prefix.footer")

    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    <script>
        $('#btnFacebook,#btnLine,#btnMail').click(function() {
            const url = $(this).data('href');
            window.open(url);
        })

        // var $box = $('.blog-container');

        // $box.hover(
        //  function() {
        //   TweenLite.to($(this), 0.1, {scale:0.95});
        // },
        // function() {
        //   TweenLite.to($(this), 0.1, {scale:1});  
        // }
        // );
    </script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js'></script>


    <script type="text/javascript" src="slick/slick.min.js?v=001"></script>
    <script type="text/javascript" src="slick/custom.js"></script>
    <script type="text/javascript" src="slick/main.js"></script>
    <script type="text/javascript" src="js/ads.js"></script>
</body>

</html>
