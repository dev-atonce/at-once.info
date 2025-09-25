<!doctype html>
  <html lang="en">
  <head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  @php
    $keyword = ($seo->seo_keyword_th != '') ? $seo->seo_keyword_th : '';
    $keyword = ($seo->seo_keyword_en != '') ? $keyword.', '.$seo->seo_keyword_en : $keyword;
    $keyword = ($seo->seo_keyword_jp != '') ? $keyword.', '.$seo->seo_keyword_jp : $keyword;
    $keyword = ($seo->seo_keyword_zh != '') ? $keyword.', '.$seo->seo_keyword_zh : $keyword;

    $description = ($seo->seo_description_th != '') ? $seo->seo_description_th : '';
    $description = ($seo->seo_description_en != '') ? $description.', '.$seo->seo_description_en : $description;
    $description = ($seo->seo_description_jp != '') ? $description.', '.$seo->seo_description_jp : $description;
    $description = ($seo->seo_description_zh != '') ? $description.', '.$seo->seo_description_zh : $description;
  @endphp

  <meta name="keywords" content="{{env('APP_NAME').', '.$keyword}}">
  <meta name="description" content="{{env('APP_NAME').', '.$description}}">
  <title>หางาน - {{env('APP_NAME')}}</title>

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
            },
            "potentialAction": {
                "@type": "SearchAction",
                "target": "https://at-once.info/th/search?keywords={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
  </script>
  
  <meta name="author" content="at-once.info">

  <base href="{{url('/')}}">
  <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="css/fontawesome.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="fonts/icofont.css">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/header-footer.css">
  <link rel="stylesheet" href="css/panel-box.css">
  <link rel="stylesheet" href="css/aos.css">
</head>

<body>
    @include("$prefix.header")

    <div class="layout-bannerinsite" style="background-image: url(images/cover-nav.jpg);">
      <span class="layout-bannerinsite-shadow"></span>
      <div class="text-on-banner">
        <div class="container">
          <div class="headline-banner">
           <div class="">
            @php
            $header = (Session('lang')=='th')?[__('phrase.header.job-search'),$moduleName]:[$moduleName,__('phrase.header.job-search')];
            @endphp

            <h1 class="text-orange"><span class="text-title">{{$header[0]}}</span>{{$header[1]}}</h1>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- @include("$prefix.navigation") --}}
  @php
    $search = Request::get('category') ? '?category='.Request::get('category') : '' ;
    $search .= $search != '' && Request::get('keywords') ? $search."&keywords=".Request::get('keywords') : '';
    $search .= Request::get('keywords') ? '?keywords='.Request::get('keywords') : '' ;
  @endphp
  <section class="page">
    <div class="container">
      <div class="card border rounded-2x bg-light">
        <div class="card-body">
          <form action="" method="get">
            <div class="row">
              <div class="col-lg-12">
                <h5 class="text-blue">ค้นหา</h5>
              </div>
              <div class="col-lg-12">
                @if(!empty($tag))
                <h5 class="mb-4 text-orange">Tag: {{$tag}}</h5>
                @endif
              </div>
              @if(@$categoryId=='')
              <div class="col-lg-4">
                <div class="form-group">
                  <select name="category" id="category" class="form-control">
                    <option value="">@lang('phrase.all')</option>
                    @foreach(\App\Models\CategoryMd::whereNull('coming_soon')->get() as $k => $v)<option value="{{$v->id}}" @if(Request::get('category')==$v->id)selected @endif>{{$v->name_th}}</option>@endforeach
                  </select>
                </div>
              </div>
              @endif
              <div class="col-lg-8">
                  <div class="form-group">
                    <div class="input-group">
                      <!-- <div class="input-group-prepend"><label class="input-group-text">ค้นหา</label></div> -->
                      <input type="text" name="keywords" id="kywords" class="form-control" placeholder="ค้นหา…" value="{{Request::Get('keywords')}}">
                      <div class="input-group-append">
                        <button type="submit" class="btn btn-outline-secondary"><i class="icofont-search-2"></i></button>
                      </div>
                    </div>
                  </div>
              </div>
            </div>
          </form>
        </div>
      </div>


      <div class="mt-4">
        <div class="clearfix row">
          @if(@$rows->count())
          @foreach($rows as $row)
          <div class="col-lg-4 d-flex blog-list" data-key="{{$row->key}}">
            <div class="blog-container aos-init" data-aos="fade-up" data-aos-delay="400">
              <div class="blog-header">
                <div class="blog-cover">
                  <a href="{{url(Session('lang'))}}/job-search/{{$row->url}}">                    
                    <img src="{{str_replace('.','-xs.',$row->images)}}" class="img-fluid border-3x" title="{{$row->name}}" alt="{{$row->name}}" width="100%"></a>                    
                </div>
              </div>
              <div class="blog-body">
                <div class="post-meta">
                  <p class="written-by">
                    @if($row->by!='')
                      <a class="company-logo" href="{{Session('lang')}}/{{$row->key}}/cp/{{$row->by_url}}">
                        <img src="{{$row->by_logo}}" alt="">
                      </a>
                      <a href="{{Session('lang')}}/job-search/{{$row->url}}{{$search}}"> 
                        @if($row->by!='')BY: @endif{{$row->by}}
                      </a>
                    @else
                    <img src="img/Logo-at-once.jpg" alt=""><a href="">{{env('APP_NAME')}}</a>
                    @endif
                  </p>
                </div>
                <div class="blog-title">                  
                  <a href="{{Session('lang')}}/job-search/{{$row->url}}{{$search}}">
                    <h3>{{$row->name}}</h3>
                  </a>                  
                </div>
              </div>
              <div class="blog-footer">
                <ul>
                  <li class="published-date"><i class="fas fa-calendar-alt fa-fw"></i>{{date('d-m-y',strtotime($row->created))}}</li>
                  <li class="comments"><a href="#"><i class="fas fa-eye fa-fw"></i> {{$row->view}}</a></li>
                </ul>
              </div>
            </div>
          </div>
          @endforeach
          @else
          <div class="col-lg-12"> <h5 class="text-center d-block py-5">ขออภัยไม่พบข้อมูลที่คุณค้นหา. <br>Data not found.</h5></div>
          @endif

        </div>
      </div>

      <div class="container middle mt-2 mb-5">
        <center>
          <div class="pagination row">
            @if(!empty($rows))
            {{$rows->links()}}
            @endif
          </div>
        </center>
      </div>


    </div>
  </section>

  @include("$prefix.footer")

  <script src="js/jquery.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en"></script>
  <script type="text/javascript" src="js/custom.js"></script>
  <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
  <script type="text/javascript" src="js/build/authentication.js"></script>

  <script src="js/aos.js"></script>
  <script src="js/blog.color.js"></script>
  <script>
    AOS.init();
  </script>
</body>
</html>


