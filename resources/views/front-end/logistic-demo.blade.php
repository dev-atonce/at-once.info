<!doctype html>
<html lang="{{Session('lang')}}">
<head>
<!-- Required meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="keywords" content="at-once,タイ 輸入,タイ ロジスティクス,タイ 輸入 ビジネス,ロジスティクス,物流,通関,輸出,運送 会社,ชิปปิ้ง,โกดังให้เช่า,ส่งพัสดุไปต่างประเทศ,ส่งของไปต่างประเทศ,โลจิสติกส์,โลจิสติกส์,พิธีการทางศุลกากร,คลังสินค้า,ส่งออก,นำเข้า,รับส่งของ,บริษัทข่นส่ง,จัดส่งของไปต่างประเทศ,ส่งของต่างจังหวัดราคาถูก,บริษัทโลจิสติกส์,บริษัทโลจิสติกส์ชั้นนำ" />
<meta name="description" content="at-once.info - ค้นหาบริษัทโลจิสติกส์ ขนส่ง ให้บริการเกี่ยวกับศุลกากร ในประเทศไทย " />
<meta name="author" content="at-once.info">
<meta name="csrf-token" content="{{csrf_token()}}">
<meta name="google-site-verification" content="SBEehLLGMBDzOMbSEIBIf15L3etk2d7P1_cYrwo97rk" />

<title>{{env('APP_NAME')}}</title>
<base href="{{url('/')}}">
<link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="fonts/icofont.css">
<link rel="stylesheet" href="css/fontawesome.css">
<link rel="stylesheet" href="css/header-footer.css?v=0005">
<link rel="stylesheet" href="css/style.css?v=0005">
<link rel="stylesheet" href="css/filter.css?v=0003">
<link rel="stylesheet" href="css/panel-box.css?v=05">
<link rel="stylesheet" href="css/blog.css?v=002">
<link rel="stylesheet" href="slick/slick.min.css">
<link rel="stylesheet" href="slick/slick-custom.css?v=001">
<link rel="stylesheet" href="css/hunterPopup.css">
<link rel="stylesheet" href="css/validate.css">
<link rel="stylesheet" href="css/gallery.css?v=002">
{{-- <link rel="stylesheet" href="css/detail.css"> --}}
<link rel="stylesheet" href='https://fonts.googleapis.com/icon?family=Material+Icons'>
<link rel="stylesheet" href="http://sachinchoolur.github.io/lightGallery/lightgallery/css/lightgallery.css">
</head>
<style>
  .border-default{
      border-color: #a1a1a1 !important
  }
  .badge a {

      color: #fff;
  }
  .company-contact::-webkit-scrollbar {
    width: 10px;
  }

  /* Track */
  .company-contact::-webkit-scrollbar-track {
    background: #f1f1f1; 
  }
  
  /* Handle */
  .company-contact::-webkit-scrollbar-thumb {
    background: #c1c1c1; 
  }

  /* Handle on hover */
  .company-contact::-webkit-scrollbar-thumb:hover {
    background: #a1a1a1; 
  }
 
  #formContact input.invalid ~ .bar,
  #formContact textarea.invalid ~ .bar{
      border-bottom: 0.0625rem solid #dc3545 !important;
  }
  .form-group .valid ~ .bar{
      border-bottom: 0.0625rem solid #28a745 !important;
  }

  .form-group .invalid{
    color: #dc3545 !important;
  }
  .form-group .valid{
    color: #28a745 !important;
  }
  .popup-international.popup-sticky:before,
  .popup-international.popup-sticky:after{
    left:315px
  }
  .popup-methods.popup-sticky:before,
  .popup-methods.popup-sticky:after{
    left:495px
  }
  .popup-item.popup-sticky:before,
  .popup-item.popup-sticky:after{
    left:630px
  }
  .popup-services.popup-sticky:before,
  .popup-services.popup-sticky:after{
    left:770px
  }
  .popup-warehouse.popup-sticky:before,
  .popup-warehouse.popup-sticky:after{
    left:910px
  }
  .badge-label{
    font-size:13px;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
  }
  .removeItem{
    position: absolute;
    background-color: #a1a1a1;
    color: #fff;
    display: block;
    padding: 5px;
    right: 0;
    top: 0;
  }
  /*  ================================*/
  .index-card-gallery{
    position: relative;
    height: 80px;
    -webkit-box-flex: 1;
    flex: auto;
    border-radius: 4px;
    overflow: hidden;
    box-shadow: 0px 0px 14px 0px rgba(193, 193, 193, 0.2);
  }

  .index-card-gallery img {
    width: 100%;
    height: 100%;
    -o-object-fit: cover;
    object-fit: cover;
  }

  /*================================*/
  .concept {
    flex: 1;
    display: flex !important;
  }

  .box-concept {
    display: flex;
  }


  .paddingcon {
    padding: 10px;
  }
  .lg-backdrop{
    background-color: rgba(0, 0, 0, 0.8) !important;
  }
  .backdrop-gallery{
    color: #c1c1c1;
  }
  .backdrop-gallery:hover{
    color: rgba(255,255,255,1);
  }
  .modal-detail{
    max-width: 1200px;
    margin:0 auto;
  }
  .comment-box {
      display: inline-block;
      position: relative;
      font-weight: 400;
      margin: 1px 0;
      align-items: center;
  }

  .alert-info02 {
      color: #333;
      /* display: inline-block; */
      border-radius: 4px;
      border-left: solid 4px #fc6549;
      box-shadow: 0 1px 2px 0 rgba(60, 64, 67, .30), 0 1px 3px 1px rgba(60, 64, 67, .15);
      box-shadow: rgba(163, 163, 163, 0.5) 0px 2px 4px 0px;
  }
  .alert-with-icon {
      padding-left: calc((0.6rem * 3) + 1.125em);
  }
  .alert-info02 .alert-icon-box {
  }
  .alert-icon-box {
      position: absolute;
      top: 0;
      left: 0;
      width: calc((.875rem * 2) + 1.125em);
      height: 100%;
      padding: 0 .875rem;
      border-radius: 4px;
      border-top-right-radius: 0;
      border-bottom-right-radius: 0;
  }
  .icon.icon-comment {
      mask-image: url(../../images/icon/comment.svg);
      mask-repeat: no-repeat;
      mask-position: center;
      -webkit-mask-image: url(../../images/icon/comment.svg);
      -webkit-mask-repeat: no-repeat;
      -webkit-mask-position: center;
  }
  .alert-icon-box>.alert-icon {
      position: absolute;
      top: 50%;
      -webkit-transform: translateY(-50%);
      transform: translateY(-50%);
      font-size: 1.125em;
  }
  .member-menu-icon {
      background: #fc6549;
      width: 22px;
      height: 22px;
      margin-right: 8px;
  }
  .ey7ls2-0 {
      padding: 0;
      list-style-type: none;
  }
  .bDELcg {
    display: flex;
    flex-wrap: wrap;
    /* margin-top: -8px; */
    margin-left: 10px;
}
  .fa-Dycg {
      position: relative;
      margin-top: 0px;
      padding-left: 8px;
      padding-right: 8px;
      border-radius: 16px;
      /* display: flex; */
      -webkit-box-align: center;
      align-items: center;
      white-space: nowrap;
      color: #111;
      cursor: pointer;
  }
  .bDELcg > * {
    margin-bottom: 8px;
    margin-left: 8px;
  }
  .ggGntR {
      display: flex;
      -webkit-box-align: center;
      align-items: center;
      border-radius: 16px;
      padding: 0px 8px;
      height: 32px;
      color: rgb(255 255 255);
      background-color: #148cd1;
      border-color: #148cd1;
      /* border: 1px solid rgb(220, 223, 224); */
      font-family: "DB Heavent Now", sans-serif;
      white-space: nowrap;
      cursor: pointer;
  }
  .icon-sh {
      align-items: center;
      justify-content: center;
      display: inline-block;
      /* margin: 0px 5px; */
      min-height: 35px;
      margin-right: 5px;
      text-align: center;
      background-color: #FFF;
      border-radius: 4px;
      /* box-shadow: rgba(163, 163, 163, 0.5) 0px 2px 4px 0px; */
      padding: 5px 9px;
      margin-bottom: 10px;
      border: 1px solid #E0E0E0;
  }
  .detail-contact a.tel, .detail-contact a.mail {
      font-weight: normal;
      font-stretch: normal;
      font-style: normal;
      line-height: normal;
      letter-spacing: normal;
      color: #ffffff;
  }
  .detail-contact.ch-orange {
      background-color: #fc593b;
  }
  .detail-contact {
      font-size: 16px;
      border-radius: 4px;
      padding: 5px;
      width: 100%;
      text-align: center;
  }
  .detail-contact {
      margin-bottom: 10px;
  }
  .detail-contact.ch-blue {
      background-color: #2196f3;
      color: #fff;
  }
  .detail-contact {
      font-size: 16px;
      border-radius: 4px;
      padding: 5px;
      width: 100%;
      text-align: center;
  }
  .detail-contact {
      margin-bottom: 10px;
  }
  .detail-contact .tel img, .detail-contact .mail img {
      filter: invert(1);
      margin-top: -5px;
  }
  .social-box {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(0px, 1fr));
      gap: 10px;
  }
  .detail-contact-02 .black-text-contact i {
      /* margin-top: -5px; */
      margin-right: 4px;
      background: #fff;
      border-radius: 4px;
      padding: 2px;
  }
  .detail-contact-02 .black-text-contact {
      display: flex;
      -webkit-box-align: center;
      align-items: center;
      color: #fff;
  }
  .detail-contact-02.web-contact {
      background-color: #17a2b8;
  }
  .detail-contact-02 {
      word-break: initial;
      font-size: 16px;
      height: 35px;
      width: 100%;
      display: inline-flex;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-pack: center;
      justify-content: center;
      border-radius: 4px;
      padding: 0px 8px;
      transition: all 0.2s ease-in-out 0s;
      cursor: pointer;
      text-decoration: none;
      background: transparent;
  }
  .detail-contact-02.facebook-contact {
      background-color: #385398;
  }
  .detail-contact-02 {
      word-break: initial;
      font-size: 16px;
      height: 35px;
      width: 100%;
      display: inline-flex;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-pack: center;
      justify-content: center;
      border-radius: 4px;
      padding: 0px 8px;
      transition: all 0.2s ease-in-out 0s;
      cursor: pointer;
      text-decoration: none;
      background: transparent;
  }
  .detail-contact-02.line-contact i {
      color: #30b945;
  }
  .detail-contact-02.line-contact {
      background-color: #30b945;
  }
  .detail-contact-02.web-contact i {
      color: #17a2b8;
  }
  .detail-contact-02.facebook-contact i {
      color: #385398;
  }
  .none-info i {
      color: #888!important;
  }
  .none-info.facebook-contact, .none-info.line-contact, .none-info.web-contact, .none-info.ch-blue, .none-info.ch-orang {
      background-color: #888!important;
  }
  .detail-contact-02 {
      word-break: initial;
      font-size: 16px;
      height: 35px;
      width: 100%;
      display: inline-flex;
      -webkit-box-align: center;
      align-items: center;
      -webkit-box-pack: center;
      justify-content: center;
      border-radius: 4px;
      padding: 0px 8px;
      transition: all 0.2s ease-in-out 0s;
      cursor: pointer;
      text-decoration: none;
      background: transparent;
  }
  .none-info {
      opacity: 0.4;
      cursor: no-drop;
  }
  .box-pro .flex-contact {
    display: flex;
    cursor: pointer;
}
.box-pro .flex-contact {
    padding-bottom: 15px;
}
  .box-pro {
      display: block;
      position: relative;
      margin-bottom: 16px;
      color: rgb(35, 39, 41);
      border-radius: 4px;
  }
  .box-pro .table-open td {
    width: 50%;
}
.box-pro i {
    color: rgb(153, 156, 158);
    padding-right: 2px;
    width: 24px;
    line-height: 1.42857;
    fill: none;
}
.box-pro .address {
    width: 100%;
    padding-right: 12px;
    margin-bottom: 0;
}
.pagination {
   justify-content: center;
}
.none-info .line-card,
.none-info .facebook,
.none-info .website{
    background-color: #d0d0d0 !important;
}
</style>

<body style="background-color: #fafafb;">
    @include("$prefix.$module.header")  

    <div class="cover-top">
      @php
      $bgImg = \App\Models\CategoryMd::where('key',$module)->first();
      @endphp
      <div class="cover-img" style="background-image: url({{@$bgImg->image}}); background-color: rgb(27, 160, 226);">
        <div class="cover-text"><h1 class="_29HYP">@lang('phrase.logistic.caption')</h1></div>
      </div>
    </div>
    <div class="container">
      <div class="promote-box3">
        <div class="row">
          <div class="col-lg-4">
            <div class="pd-0 pd-lg-2">
              <center>
                <img src="images/icon/search-company02.svg"  style="width: 20%; height: 100%;">
                <p class="mt-2 mt-lg-2">@lang('phrase.concept.1')</p>
              </center>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="pd-0 pd-lg-2">
              <center>
                <img src="images/icon/check-mail02.svg"  style="width: 20%; height: 100%;">
                <p class="mt-2 mt-lg-2">@lang('phrase.concept.2')</p>
              </center>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="pd-0 pd-lg-2">
              <center>
                <img src="images/icon/profile.svg" style="width: 20%; height: 100%;">
                <p class="mt-2 mt-lg-2">@lang('phrase.concept.3')
                </p>
              </center>
            </div>
          </div>
        </div>
      </div>
    </div>


    <section id="sticky-filter">
      @include('front-end.filter.logistic-gen2')
    </section>


    <section>
      <div class="main-content">
        <div class="container">
          <div class="row">
            <div class="col-lg-8 scrolling">
              <div class="row ">
                <div class="col-md-7">
                  <h5 class="bold mt-2">@lang('phrase.allLogisticCompany')</h5>
                </div>
                <div class="col-md-5">
                  <div class="form-group has-search mt-1">
                    <span class="fa fa-search form-control-feedback"></span>
                    <form action=""><input type="text" name="keyword" class="form-control" placeholder="@lang('phrase.searchCompanyName')" value="{{Request::get('keyword')}}"></form>
                  </div>
                </div>
              </div>
              <div class="row">
                @foreach($company as $k => $row)
                <div class="col-md-6 col-lg-12">
                  <div class="card-profile" >
                    <div class="toggle">
                      <div class="rkmd-checkbox checkbox-ripple">
                        <label for="com_{{$k}}" class="label">@lang('phrase.select')</label>
                        <label class="input-checkbox checkbox-lightBlue">
                          <input type="checkbox" id="com_{{$k}}" class="mr-1 comp-select" value="{{$row->id}}" data-text="{{$row->name}}">
                          <span class="checkbox"></span>
                        </label>
                      </div>
                      <div class="captions">Normal</div>
                    </div>
                    <div class="card-top row">
                      <div class="col-7 col-lg-4">
                        <img src="{{url($row->logo)}}" class="img-fluid logo-company" > 
                      </div>
                      <div class="col-lg-8 ">
                        <div class="row">
                          <div class="col-lg-12">
                            <div class="title bold mt-2" style="font-size: 18px;">{{$row->name}}</div>
                            <div class=" content" >
                              <div class="box-nation mt-1 mb-2">
                                <small class="nation"><img src="https://www.at-once.info/flags/jp.png"> {{$row->nationality}} Company</small>
                              </div>
                              <p class="highlight" style="color: #83838e;"> {!!$row->description!!}</p> 
                            </div>
                          </div>
                          @php 
                            $galleryRaw = $row->gallery()->where('_id',$row->id);
                            $count = $galleryRaw->get()->count();
                            
                          @endphp
                          <div class="col-lg-8 pr-0">
                              <div class="light-g">                                
                                <div class="gallery-flex relative-gall" id="lightg{{$k}}">
                                  @foreach($galleryRaw->get() as $kg => $vg)
                                  <a href="{{$vg->image}}" style="background-image:url({{$vg->image}});background-position:center;background-size:cover;height:70px;border-radius:4px; @if($kg>=4) position:relative;display:none; @endif">
                                      <img src="{{$vg->image}}" class="cWzaZM" style="display: none;">        
                                      @if($kg==3)<div style="position:absolute;background-color:rgba(0,0,0,0.6);text-align:center;height:100%;border-radius:4px;"><span class="backdrop-gallery" style="text-align:center;vertical-align:middle;height:100%;vertical-align:-webkit-baseline-middle;">ดูภาพทั้งหมด</span></div>@endif
                                  </a>                   
                                @endforeach
                              </div>  
                              </div>                    
                          </div>
                          <div class="col-lg-4" >
                            <center>
                              <div class="social">
                                <a class="aicon" @if($row->website!='')href="http://{{$row->website}}"@else href="javascript:"@endif data-toggle="tooltip" data-placement="top" title="Website">
                                  <span class="boxicon "><img src="images/icon/world-wide-web.svg" width="20" style="filter: grayscale(100%);"></span>
                                </a>
                                <a class="aicon"  @if($row->facebook!='')href="http://{{$row->facebook}}" target="_blank"@else href="javascript:"@endif data-toggle="tooltip" data-placement="top" title="facebook">
                                  <span class="boxicon facebook"></span>
                                </a>
                                <a class="aicon" @if($row->line!='')href="{{$row->line}}" target="blank"@else href="javascript:"@endif data-toggle="tooltip" data-placement="top" title="Line">
                                  <span class="boxicon line-card"></span>
                                </a>
                              </div>
                            </center>
                            <div class="card-footer-cp mt-2">
                              <center>
                                <a href="javascript:{{$row->id}}" class="search-buttons"  data-toggle="modal" data-target="#exampleModal">ดูรายละเอียด</a>
                              </center>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
            <div class="col-lg-4">
              @include('front-end.form-contact-right')
            </div>
          </div>
        </div>
      </div>
    </section>


    <section class="page ">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <div class="">
              <h4 class="bold mb-3"> @lang('phrase.comming-soon')</h4>
              <div class="row">
                @foreach($category as $k => $v)
                <div class="col-20">
                  <div class="cards-business mb-4 mb-lg-0">
                    <a class="card-other" href="{{url(Session('lang')."/$v->key")}}"> 
                      <span class="card-other-header" style="background-image: url({{$v->image}});">
                        <div class="card__new"><span class="">@lang('phrase.new')!</span></div>
                        <span class="card-other-title">
                          <h5>{{$v->name}}</h5>
                        </span>
                      </span>
                    </a>
                  </div>
                </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="page ">
        <div class="container">

          <div class="">
            <div class="d-flex">
              <h4 class="bold mb-3 XWyRR"> Blogs</h4><div><a class="b-view-more gKiAgG" href="{{url(Session('lang'))}}/{{$module}}/blog">ดูทั้งหมด »</a></div>
            </div>
            <div class="row">
              @if(!empty($blog_first))
              <div class="col-md-6 col-lg-4 d-flex">
                <div class="blog-index blog-container ">
                <div class="blog-cover">
                  <a href="{{Session('lang')}}/{{$module}}/blog/{{$blog_first->url}}"><img src="{{$blog_first->images}}"></a>
                </div>
                <div class="blog-body">
                  <div class="blog-title">
                  <a href="{{Session('lang')}}/{{$module}}/blog/{{$blog_first->url}}">
                    <h5 >{{$blog_first->name}}</h5>
                  </a>
                </div>
                @php
                $get_tag = DB::table('blog_join_tag as join')->select('tag.tag')->leftJoin('tag','tag.id','=','join.tag_id')->where('join.blog_id',$blog_first->id)->get();    
                @endphp
                <div class="blog-tags">
                  <ul>
                    @if(!empty($get_tag))
                    @foreach($get_tag as $tag)
                    <li><a href="{{Session('lang')}}/{{$module}}/tag/{{$tag->tag}}">{{$tag->tag}}</a></li>
                    @endforeach
                    @endif
                  </ul>
                </div>
                
              </div>
              <div class="blog-footer">
                <ul>
                  <li class="published-date">{{date_format($blog_first->created,'d-m-Y')}}</li>
                  <li class="comments"><a href="#"><i class="icofont-eye-alt"></i> {{$blog_first->view}}</a></li>
                  <li class="shares"><a href="https://www.facebook.com/sharer/sharer.php?u={{url(Session('lang').'/'.$module.'/blog/'.$blog_first->url)}}" target="_blank"><i class="icofont-share"></i> share</a></li>
                </ul>
              </div>
            </div>
          </div>
          @endif
          @if(!empty($blog_row))
          @foreach($blog_row as $blog_r)
          <div class="col-md-6 col-lg-4 d-flex ">
            <div class="blog-index blog-container ">
              <div class="blog-header">
                <div class="blog-cover">
                  <a href="{{Session('lang')}}/{{$module}}/blog/{{$blog_r->url}}"><img src="{{$blog_r->images}}"></a>
                </div>
              </div>
              <div class="blog-body">
                <div class="blog-title">
                  <a href="{{Session('lang')}}/{{$module}}/blog/{{$blog_r->url}}">
                    <h5>{{$blog_r->name}}</h5>
                  </a>
                </div>
                <div class="blog-tags">
                  @php
                  $get_tag = DB::table('blog_join_tag as join')->select('tag.tag')->leftJoin('tag','tag.id','=','join.tag_id')->where('join.blog_id',$blog_r->id)->get();    
                  @endphp
                  @if(!empty($get_tag))
                  <ul>
                    @foreach($get_tag as $tag)
                    <li><a href="{{Session('lang')}}/{{$module}}/tag/{{$tag->tag}}">{{$tag->tag}}</a></li>
                    @endforeach
                  </ul>
                  @endif
                </div>
              </div>
              <div class="blog-footer">
                <ul>
                  <li class="published-date">{{date('d-m-Y',strtotime($blog_r->created))}}</li>
                  <li class="comments"><a href="#"><i class="icofont-eye-alt"></i> {{$blog_r->view}}</a></li>
                  <li class="shares"><a href="https://www.facebook.com/sharer/sharer.php?u={{url(Session('lang').'/'.$module.'/blog/'.$blog_r->url)}}" target="_blank"><i class="icofont-share"></i> share</a></li>
                </ul>
              </div>
            </div>
          </div>
          @endforeach
          @endif


        </div>
      </div>
    </div>
    </section>

    <section class="d-lg-none" style="position:fixed;z-index:102;">
        @include('front-end.mobile-form-contact')
    </section>

    <section class="page" style="">
      <div class="container">
        <div class="autoplay slider row carousel-brands">
          @foreach($company as $k => $row)
          @if($row->logo!='')
          <div class="col-lg-12">
            <a  href="{{url(Session('lang').'/logistic/company')}}/{{$row->id}}">
              <img src="{{url($row->logo)}}" class="logo-slide-index img-fluid" >
            </a>
          </div>
          @endif
          @endforeach
        </div>
      </div>
    </section>
<br>
@php
$lang = Session('lang');
$langPro = (Session('lang')=='jp')?'en':'th';
$yes_or_no = \App\Models\ChoiceMd::where('type','YesNo')->select('id','key',"name_$lang as name")->get();
$two = \App\Models\ChoiceMd::where('type','transport')->select('id','key',"name_$lang as name")->get();;
$methods = \App\Models\ChoiceMd::where('type','methods')->select('key',"name_$lang as name")->get();
$three = \App\Models\ChoiceMd::where('type','warehouse')->select('id','key',"name_$lang as name")->get();
$services = \App\Models\ChoiceMd::where('type','services')->select('id','key',"name_$lang as name")->get();
$province = \App\Models\ProvinceMd::select('province_id as id',"province_name_$langPro as name")->orderBy('name')->get();
$get['demestic'] = Request::get('demestic');
$get['inter'] = explode(',',Request::get('international'));
$get['methods'] = explode(',',Request::get('methods'));
$get['warehouse'] = explode(',',Request::get('warehouse'));
$get['services'] = explode(',',Request::get('services'));
$get['packing'] = Request::get('packing');
$get['item'] =  explode(',',Request::get('item'));
@endphp
<div id="tableTwo" style="display:none">
  <div class="row scroll-y"><br>
    @foreach($two as $k => $v)
    <div class="col-lg-4 col-xs-6">                
      <div class="qa-box">
        <label for="two{{$k}}">
          <input type="checkbox" id="two{{$k}}" class="two_" value="{{$v->key}}" text="{!!$v->name!!}" @if(in_array($v->key,$get['inter'])) checked @endif>
          &nbsp;{!!$v->name!!}
        </label>   
      </div>
    </div>
    @endforeach
    <div class="clearfix"></div><br>
  </div>
  <div class="row"><div class="col-lg-12 popover-footer text-right"><a href="javascript:" class="btn btn-outline-danger clear-list"><i class="fas fa-angle-double-right"></i>@lang('phrase.reset')</a></div></div>
</div>
<div id="tableWarehouse" style="display:none">
  <div class="row scroll-y"><br>
    @foreach($province as $k => $v)
    <div class="col-lg-4 col-xs-6">                
      <div class="qa-box">
        <input type="checkbox" class="six_" id="six_{{$k}}" name="province" value="{{$v->id}}" text="{!!$v->name!!}" @if(in_array($v->id,$get['warehouse'])) checked @endif>
        <label for="six_{{$k}}">{!!$v->name!!}</label>       
      </div>
    </div>
    @endforeach
    <div class="clearfix"></div><br>
  </div>
  <div class="row">
    <div class="col-lg-12 popover-footer text-right"><a href="javascript:" class="btn btn-outline-danger btn-sm clear-list"><i class="fas fa-angle-double-right"></i> @lang('phrase.reset')</a></div>
  </div>
</div>
<div id="tableItems" style="display:none">
  <div class="row scroll-y"><br>
    @foreach($three as $k => $v)
    <div class="col-lg-4 col-xs-6">                
      <div class="qa-box">
        <label for="four{{$k}}">
          <input type="checkbox" id="four{{$k}}" class="four_" value="{{$v->key}}" text="{!!$v->name!!}" @if(in_array($v->key,$get['item'])) checked @endif>
          &nbsp;{!!$v->name!!}
        </label>   
      </div>
    </div>
    @endforeach
    <div class="clearfix"></div><br>
  </div>
  <div class="row">
    <div class="col-lg-12 popover-footer text-right"><a href="javascript:" class="btn btn-outline-danger clear-list"><i class="fas fa-angle-double-right"></i>@lang('phrase.reset')</a></div>
  </div>
</div>
<div id="tableMethods" style="display:none">
  <div class="row scroll-y"><br>
    <div class="clearfix"></div><br>
    @foreach($methods as $k => $v)
    <div class="col-lg-4 col-xs-6">                
      <div class="qa-box">
        <label for="three{{$k}}">
          <input type="checkbox" id="three{{$k}}" class="three_" value="{{$v->key}}" text="{!!$v->name!!}" @if(in_array($v->key,$get['methods'])) checked @endif>
          &nbsp;{!!$v->name!!}
        </label>   
      </div>
    </div>
    @endforeach
  </div>
  <div class="row">
    <div class="col-lg-12 popover-footer text-right"><a href="javascript:" class="btn btn-outline-danger clear-list"><i class="fas fa-angle-double-right"></i>@lang('phrase.reset')</a></div>
  </div>
</div>
<div id="tableService" style="display:none">
  <div class="row scroll-y"><br>
    <div class="clearfix"></div><br>
    @foreach($services as $k => $v)
    <div class="col-lg-6 col-xs-6">                
      <div class="qa-box">
        <label for="five{{$k}}">
          <input type="checkbox" id="five{{$k}}" class="five_" value="{{$v->key}}" text="{!!$v->name!!}" @if(in_array($v->key,$get['services'])) checked @endif>
          &nbsp;{!!$v->name!!}
        </label>   
      </div>
    </div>
    @endforeach
  </div>
  <div class="row">
    <div class="col-lg-12 popover-footer text-right"><a href="javascript:" class="btn btn-outline-danger clear-list"><i class="fas fa-angle-double-right"></i>@lang('phrase.reset')</a></div>
  </div>
</div>
@include("$prefix.$module.footer")

{{----- Modal Detail of Company-----}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-detail" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">@lang('phrase.detail')</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">
          <div class="row">
            <div class="col-lg-12"></div>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('phrase.close')</button>
      </div>
    </div>
  </div>
</div>

<script src="js/jquery.js"></script>
<!-- Optional JavaScript -->
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.10.0/js/lightgallery.min.js" integrity="sha512-gDBgGPXSeC2hx1W3S1CfSHbAValtLI8OArTGf0UVX7Fwb9Ak7HUE3LK9UEZxKGYVrIe0CJUVZDk9B2dIPwJ6VQ==" crossorigin="anonymous"></script> --}}
<script src="http://sachinchoolur.github.io/lightGallery/lightgallery/js/lightgallery.js"></script>
<script src="http://sachinchoolur.github.io/lightGallery/lightgallery/js/lg-fullscreen.js"></script>
<script src="http://sachinchoolur.github.io/lightGallery/lightgallery/js/lg-thumbnail.js"></script>

<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

<script src="js/bootstrap.min.js"></script>


<script src="js/jquery.device.detector.js"></script>
<script src="js/jquery-popup.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

<script type="text/javascript" src="js/custom.js?v=0001"></script>
<script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
<script type="text/javascript" src="js/build/authentication.js"></script>
<script type="text/javascript" src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>

<script type="text/javascript" src="slick/slick.min.js" ></script>
<script type="text/javascript" src="slick/custom.js"></script>
<script type="text/javascript" src="slick/main.js"></script>

<script type="text/javascript">
  var device = $.fn.deviceDetector,
      width = $(window).width();
  if (!device.isIpad() && width < 768) {
    
      $('#back-to-top').parent().parent().css({'z-index':'999'});
  }
  $(document).ready(function() {
    $('.checkbox-ripple').rkmd_checkboxRipple();
    change_checkbox_color();
  });

  (function($) {

    $.fn.rkmd_checkboxRipple = function() {
      var self, checkbox, ripple, size, rippleX, rippleY, eWidth, eHeight;
      self = this;
      checkbox = self.find('.input-checkbox');

      checkbox.on('mousedown', function(e) {
        if(e.button === 2) {
          return false;
        }

        if($(this).find('.ripple').length === 0) {
          $(this).append('<span class="ripple"></span>');
        }
        ripple = $(this).find('.ripple');

        eWidth = $(this).outerWidth();
        eHeight = $(this).outerHeight();
        size = Math.max(eWidth, eHeight);
        ripple.css({'width': size, 'height': size});
        ripple.addClass('animated');

        $(this).on('mouseup', function() {
          setTimeout(function () {
            ripple.removeClass('animated');
          }, 200);
        });

      });
    }

  }(jQuery));

  function change_checkbox_color() {
    $('.color-box .show-box').on('click', function() {
      $(".color-box").toggleClass("open");
    });

    $('.colors-list a').on('click', function() {
      var curr_color = $('main').data('checkbox-color');
      var color = $(this).data('checkbox-color');
      var new_colot = 'checkbox-' + color;

      $('.rkmd-checkbox .input-checkbox').each(function(i, v) {
        var findColor = $(this).hasClass(curr_color);

        if(findColor) {
          $(this).removeClass(curr_color);
          $(this).addClass(new_colot);
        }

        $('main').data('checkbox-color', new_colot);

      });
    });
  }
</script>


<script type="text/javascript">

      $(".regular").slick({
        dots: true,
        infinite: true,
        slidesToShow: 5,
        slidesToScroll: 3,
        responsive: [
          { breakpoint: 1024, settings: {  slidesToShow: 3, slidesToScroll: 3, infinite: true, dots: true } },
          { breakpoint: 600, settings: { slidesToShow: 2, slidesToScroll: 2 } },
          { breakpoint: 480, settings: { slidesToShow: 2, slidesToScroll: 2 } }
        ]
    });

    $('.responsive').slick({
        dots: true,
        infinite: false,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 4,
        responsive: [
          { breakpoint: 1024,settings: { slidesToShow: 3, slidesToScroll: 3, infinite: true, dots: true } },
          { breakpoint: 600,settings: { slidesToShow: 2, slidesToScroll: 2 } },
          { breakpoint: 480,settings: { slidesToShow: 1, slidesToScroll: 1 } }
        ]
    });
    $('.autoplay').slick({
        slidesToShow: 7,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1000,
        responsive: [
          { breakpoint: 1024, settings: { slidesToShow: 5, slidesToScroll: 3, infinite: true, }  },
          { breakpoint: 600, settings: { slidesToShow: 4, slidesToScroll: 2 } },
          { breakpoint: 480, settings: { slidesToShow: 3, SlidesToScroll: 1 } }
        ]
      });

    $('.autoplay-banner').slick({
        slidesToShow: 2,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 1000,
        responsive: [
          { breakpoint: 1024, settings: { slidesToShow: 2, slidesToScroll: 1, infinite: true, } },
          { breakpoint: 600, settings: { slidesToShow: 4, slidesToScroll: 2 } },
          { breakpoint: 480, settings: { slidesToShow: 3, slidesToScroll: 1 } }
        ]
    });

</script>

<script type="text/javascript">
  if($('.company-logo').length>0) {
    $('.company-logo').each(function(){
      var intials = $(this).data('name').charAt(0) + $(this).data('name').charAt(1);
      $(this).html('<span>'+intials+'</span>');
    })
  }
  $('span.form-control').on('click',function(ev){
    $(this).addClass('-focus');
    $('span.form-control').not(this).removeClass('-focus');
    ev.stopPropagation();
  });
  $(document).click(function(){
    $('span.form-control').removeClass('-focus');
  })

  $(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })
  $('.aicon').click(function(){
    if( $(this).find('.phone').length>0 ){ 
      if($(this).hasClass('-show')){
        $(this).removeClass('-show');
      }else{
        $(this).addClass('-show');
      }
    }
  })
  
  var d = $.fn.deviceDetector, width = $(window).width();;
  var popUp = {
    international : {
      placement : 'center',
      width : $('.container').width()-5,
    },
    methods : {
      placement : (d.isMobile())?'center':'right',
      width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
    },
    item : {
      placement : (d.isMobile())?'center':'left',
      width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
    },
    service : {
      placement : 'center',
      width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
    },
    warehouse : {
      placement :(d.isMobile())?'center':'right',
      width : (!d.isMobile())?$('.container').width()-3:$('.filter-box02').width(),
    },
  };
  var category = window.location.pathname.split('/')[2];
  let color = '';
  switch (category) {
    case 'logistic':     color = '--orange';   break;
    case 'solar-cell':    color = '--sky-blue'; break;
    case 'translate':     color = '--pink';     break;
    case 'carrent':       color = '--gold';     break;
    case 'visa-support':  color = '--green';    break;
    case 'setting-cp':    color = '--indigo';   break;
    default: break;
  }
  $('input[name="domestic"]').on('change',function(){if($(this).is(':checked')){$(this).parent().addClass(color)}else{$(this).parent().removeClass(color)}});

  $('#international').hunterPopup({
    placement: popUp.international.placement,
    width: popUp.international.width,
    title: $('#international').attr('title'),
    content: $('#tableTwo'),
    event : function(){
      box = $('#international');
      var two = {id:[],text:[]};
      
      if (!d.isMobile()) {
        const offset = box.offset();
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+20,
            'right' : ($('.container').offset().left+20),
        });
      }
      
      $('.two_').click(function(){ two = {id:[],text:[]}; adjust(box); });
      function adjust() {
        $('.two_:checked').each(function(){
          two.id.push($(this).val())
          two.text.push(' '+$(this).attr('text'))
        })
        box.html(two.text.join(', '));
        if (two.text.length>0) {
          box.addClass(color);
        }else{
          box.removeClass(color);
          box.html(box.attr('title'));                    
        }
        box.next().val(two.id);
      }  
      $('.clear-list').click(function(){
        box.html(box.attr('title'))
        box.next().val('')
        $('.two_:checked').prop('checked',false);
        box.removeClass(color)
      })    
    }
  })
  // console.log($('.sticky').offset())
  $('#methods').hunterPopup({
    placement : popUp.methods.placement,
    width: popUp.methods.width,
    title: $('#methods').attr('title'),
    content: $('#tableMethods'),
    event : function(){
      box = $('#methods');
      if (!d.isMobile()) {
        const offset = box.offset();
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+20,
            'right' : ($('.container').offset().left+20), 
        });
      }
      var three = {id:[],text:[]};
      $('.three_').click(function(){ three = {id:[],text:[]}; adjust(box); })
      function adjust() {
        $('.three_:checked').each(function(){
          three.id.push($(this).val())
          three.text.push(' '+$(this).attr('text'))
        })
        box.html(three.text.join(', '));
        if (three.text.length>0) {
          box.addClass(color);
        }else{
          box.removeClass(color);
          box.html(box.attr('title'));                    
        }
        box.next().val(three.id);
      }  
      $('.clear-list').click(function(){
        box.html(box.attr('title'));
        box.next().val('');
        $('.three_:checked').prop('checked',false);
        box.removeClass(color);
      }) 
    }
  });

  $('#item').hunterPopup({
    placement : popUp.item.placement,
    width: popUp.item.width,
    title: $('#item').attr('title'),
    content: $('#tableItems'),
    event:function(){
      box = $('#item');
      if (!d.isMobile()) {
        const offset = box.offset();
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+20,
            'right' : ($('.container').offset().left+20), 
        });
      }
      var four = {id:[],text:[]};
      $('.four_').click(function(){ four = {id:[],text:[]}; adjust(box); })
      function adjust() {
        $('.four_:checked').each(function(){
          four.id.push($(this).val())
          four.text.push(' '+$(this).attr('text'))
        })
        box.html(four.text.join(', '));
        if (four.text.length>0) {
          box.addClass(color);
        }else{
          box.removeClass(color);
          box.html(box.attr('title'));                    
        }
        box.next().val(four.id);
      }  
      $('.clear-list').click(function(){
        box.html(box.attr('title'));
        box.next().val('');
        $('.four_:checked').prop('checked',false);
        box.removeClass(color);
      }) 
    }
  });

  $('#services').hunterPopup({
    placement: popUp.service.placement,
    width: popUp.service.width,
    title: $('#services').attr('title'),
    content: $('#tableService'),
    event : function(){
      box = $('#services');
      if (!d.isMobile()) {
        const offset = box.offset();
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+20,
            'right' : ($('.container').offset().left+20), 
        });
      }
      const offset = $('#services').offset();
      var five = {id:[],text:[]};
      $('.five_').click(function(e){ five = {id:[],text:[]}; adjust(box) })
      function adjust(box) {
        $('.five_:checked').each(function(){
          five.id.push($(this).val())
          five.text.push($(this).attr('text'))
        })
        $('#services').html(five.text.join(', '));
        if (five.text.length>0) {
          box.addClass(color);
        }else{
          box.removeClass(color);
          box.html(box.attr('title'));                    
        }
        box.next().val(five.id);
      }  
      $('.clear-list').click(function(){
        box.html(box.attr('title'))
        box.next().val('')
        $('.five_').prop('checked',false);
        box.removeClass(color);
      })
    }
  });

  $('#warehouse').hunterPopup({
    placement: popUp.warehouse.placement,
    width: popUp.warehouse.width,
    title: $('#warehouse').attr('title'),
    content: $('#tableWarehouse'),
    event : function(){
      var box = $('#warehouse');
      if (!d.isMobile()) {
        const offset = box.offset();
        $('.Hunter-pop-up').css({
            'left' : $('.container').offset().left+20,
            'right' : ($('.container').offset().left+20), 
        });
      }
      var six = {id:[],text:[]};
      $('.six_').click(function(e){ six = {id:[],text:[]}; adjust(box) })
      function adjust(box) {
        $('.six_:checked').each(function(){
          six.id.push($(this).val())
          six.text.push($(this).attr('text'))
        })
        box.html(six.text.join(', '));
        if (six.text.length>0) {
          box.addClass(color);
        }else{
          box.removeClass(color);
          box.html(box.attr('title'));                    
        }
        box.next().val(six.id);
      }  
      $('.clear-list').click(function(){
        box.html(box.attr('title'))
        box.next().val('')
        $('.six_').prop('checked',false);
        box.removeClass(color);
      })
    }
  });
  checked()
  function checked()
  {
      // const inter = $('input[name="international"]').val().split(',');
      text = { one:[],two:[],three:[],four:[],five:[],six:[]};
      // $('.one_:checked').each(function(i,v){ text.one.push($(this).attr('text')); })
      $('.two_:checked').each(function(i,v){ text.two.push($(this).attr('text')); })
      $('.three_:checked').each(function(i,v){ text.three.push($(this).attr('text')); })
      $('.four_:checked').each(function(i,v){ text.four.push($(this).attr('text')); })
      $('.five_:checked').each(function(i,v){ text.five.push($(this).attr('text')); })
      $('.six_:checked').each(function(i,v){ text.six.push($(this).attr('text')); })

      // $('#inland').html(text.one);
      if(text.two.length>0) $('#international').html(text.two.join(', '));
      if(text.three.length>0) $('#methods').html(text.three.join(', '));
      if(text.four.length>0) $('#item').html(text.four.join(', '));
      if(text.five.length>0) $('#services').html(text.five.join(', '));
      if(text.six.length>0) $('#warehouse').html(text.six.join(', '));
    }
    $('#select-all').on('click',function(){
      if($(this).is(':checked')){
        $('.comp').prop('checked',true);
        $('.total-select').html($('.comp:checked').length);
      }else{ 
        $('.comp').prop('checked',false);
        $('.total-select').html(0);
      }
    });
    function logoGen(el) {

    }
  </script>

  <script type="text/javascript">
    $(function(){
      $('.chatbox-top').click(function(){ $(this).closest('.chatbox').toggleClass('chatbox-min'); });
      $('.fa-close').click(function(){
        $(this).closest('.chatbox').hide();
      });
    });
  </script>


  <script type="text/javascript">

   $('.btn-view-more').click(function(){    $('#exampleModal').find('iframe').attr('src',$(this).attr('href'));
 });
</script>




<!-- <script type="text/javascript">
    window.onscroll = function() {myFunction()};

  var navbar = document.getElementById("sticky-filter");
  var sticky = navbar.offsetTop;

  function myFunction() {
    if (window.pageYOffset >= sticky) {
      navbar.classList.add("sticky")
    } else {
      navbar.classList.remove("sticky");
    }
  }

</script> -->
<script>


  // (function($) {
    // "use strict";

    var $navbar = $("#sticky-filter"),
    y_pos = $navbar.offset().top,
    height = $navbar.height();

    $(document).scroll(function() {
      var scrollTop = $(this).scrollTop();
      if (!device.isIpad() && width > 768) {
        
          if (scrollTop > y_pos) {
            $navbar.addClass("sticky").animate({top:0});
            $('.scrolling').css('margin-top','190px');
            $('.scrolling').focus();
            // $('.Hunter-pop-up').remove()
          } else if (scrollTop <= (y_pos+height) ) {
            $navbar.removeClass("sticky").clearQueue().animate({top:""},0);
            $('.scrolling').removeAttr('style');
          }
      }
    });

  // })(jQuery, undefined);



</script>





<script type="text/javascript">
  /*
 Sticky-kit v1.1.2 | WTFPL | Leaf Corcoran 2015 | http://leafo.net
 */
 (function () {
  var c, f;
  c = this.jQuery || window.jQuery;
  f = c(window);
  c.fn.stick_in_parent = function (b) {
    var A, w, B, n, p, J, k, E, t, K, q, L;
    null == b && (b = {});
    t = b.sticky_class;
    B = b.inner_scrolling;
    E = b.recalc_every;
    k = b.parent;
    p = b.offset_top;
    n = b.spacer;
    w = b.bottoming;
    null == p && (p = 0);
    null == k && (k = void 0);
    null == B && (B = !0);
    null == t && (t = "is_stuck");
    A = c(document);
    null == w && (w = !0);
    J = function (a) {
      var b;
      return window.getComputedStyle ? (a = window.getComputedStyle(a[0]), b = parseFloat(a.getPropertyValue("width")) + parseFloat(a.getPropertyValue("margin-left")) +
        parseFloat(a.getPropertyValue("margin-right")), "border-box" !== a.getPropertyValue("box-sizing") && (b += parseFloat(a.getPropertyValue("border-left-width")) + parseFloat(a.getPropertyValue("border-right-width")) + parseFloat(a.getPropertyValue("padding-left")) + parseFloat(a.getPropertyValue("padding-right"))), b) : a.outerWidth(!0)
    };
    K = function (a, b, q, C, F, u, r, G) {
      var v, H, m, D, I, d, g, x, y, z, h, l;
      if (!a.data("sticky_kit")) {
        a.data("sticky_kit", !0);
        I = A.height();
        g = a.parent();
        null != k && (g = g.closest(k));
        if (!g.length) throw "failed to find stick parent";
        v = m = !1;
        (h = null != n ? n && a.closest(n) : c("<div />")) && h.css("position", a.css("position"));
        x = function () {
          var d, f, e;
          if (!G && (I = A.height(), d = parseInt(g.css("border-top-width"), 10), f = parseInt(g.css("padding-top"), 10), b = parseInt(g.css("padding-bottom"), 10), q = g.offset().top + d + f, C = g.height(), m && (v = m = !1, null == n && (a.insertAfter(h), h.detach()), a.css({
            position: "",
            top: "",
            width: "",
            bottom: ""
          }).removeClass(t), e = !0), F = a.offset().top - (parseInt(a.css("margin-top"), 10) || 0) - p, u = a.outerHeight(!0), r = a.css("float"), h && h.css({
            width: J(a),
            height: u,
            display: a.css("display"),
            "vertical-align": a.css("vertical-align"),
            "float": r
          }), e)) return l()
        };
        x();
        if (u !== C) return D = void 0, d = p, z = E, l = function () {
          var c, l, e, k;
          if (!G && (e = !1, null != z && (--z, 0 >= z && (z = E, x(), e = !0)), e || A.height() === I || x(), e = f.scrollTop(), null != D && (l = e - D), D = e, m ? (w && (k = e + u + d > C + q, v && !k && (v = !1, a.css({
            position: "fixed",
            bottom: "",
            top: d
          }).trigger("sticky_kit:unbottom"))), e < F && (m = !1, d = p, null == n && ("left" !== r && "right" !== r || a.insertAfter(h), h.detach()), c = {
            position: "",
            width: "",
            top: ""
          }, a.css(c).removeClass(t).trigger("sticky_kit:unstick")),
          B && (c = f.height(), u + p > c && !v && (d -= l, d = Math.max(c - u, d), d = Math.min(p, d), m && a.css({
            top: d + "px"
          })))) : e > F && (m = !0, c = {
            position: "fixed",
            top: d
          }, c.width = "border-box" === a.css("box-sizing") ? a.outerWidth() + "px" : a.width() + "px", a.css(c).addClass(t), null == n && (a.after(h), "left" !== r && "right" !== r || h.append(a)), a.trigger("sticky_kit:stick")), m && w && (null == k && (k = e + u + d > C + q), !v && k))) return v = !0, "static" === g.css("position") && g.css({
            position: "relative"
          }), a.css({
            position: "absolute",
            bottom: b,
            top: "auto"
          }).trigger("sticky_kit:bottom")
        },
        y = function () {
          x();
          return l()
        }, H = function () {
          G = !0;
          f.off("touchmove", l);
          f.off("scroll", l);
          f.off("resize", y);
          c(document.body).off("sticky_kit:recalc", y);
          a.off("sticky_kit:detach", H);
          a.removeData("sticky_kit");
          a.css({
            position: "",
            bottom: "",
            top: "",
            width: ""
          });
          g.position("position", "");
          if (m) return null == n && ("left" !== r && "right" !== r || a.insertAfter(h), h.remove()), a.removeClass(t)
        }, f.on("touchmove", l), f.on("scroll", l), f.on("resize", y), c(document.body).on("sticky_kit:recalc", y), a.on("sticky_kit:detach", H), setTimeout(l,
          0)
    }
  };
  q = 0;
  for (L = this.length; q < L; q++) b = this[q], K(c(b));
    
    return this
}
}).call(this);



    $(function() {
      initStickBar();
      initScrollLink();
      fetchItem();
    });


    function initStickBar(){
      $("#fix-scroll").stick_in_parent();

    };
    function initScrollLink(){
      $(".scroll-nav-bar").on("click","a", function (event) {
        event.preventDefault();
        var id  = $(this).attr('href'),
        top = $(id).offset().top;
        $('body,html').animate({scrollTop: top}, 1500);
      });
    }
    function scrolling()
    {
      $('.scrolling').css({'margin-top':'72px'});
    }
    /*================= form contact content =================*/
    var lang = $('html').attr('lang');
    var messages = {
      'selectLimit':{['th']:'ท่านสามารถเลือกได้สูงสุด 10 บริษัท',['en']:'You can select a maximum of 10 companies.'}
    };
    $(document).on('click','.comp-select',function(){actionAd($(this))});
    function actionAd(el)
    {
      var getS = JSON.parse(localStorage.getItem('saveMy'));
        if(getS==null) {
            cleareStore();store();fetchItem();
        }else{
            if(getS.sendTo.id.length<10){
                cleareStore();store();fetchItem();
            }else{
                alert(messages.selectLimit[lang]);
                el.prop('checked',false);
            }
        }
        if($('.company-contact').height()>=119){
              $('.company-contact').css({'max-height':'120px','overflow-y':'scroll','margin-bottom':'10px'});
        }else{
            $('.company-contact').removeAttr('style');
        }
    }

    $(document).on('click','.removeItem',function(){ removeItem($(this).parent()); })
    function store(){
        
        var saveMy = { 
            company : $('input[name="company"]').val(),
            telephone : $('input[name="telephone"]').val(),
            position : $('input[name="position"]').val(),
            name : $('input[name="name"]').val(),
            email : $('input[name="email"]').val(),
            content : $('textarea[name="content"]').val(),
            sendTo : { 
                id:$('.comp-select:checked').map(function(){return $(this).val()}).get(), 
                text:$('.comp-select:checked').map(function(){return $(this).data('text')}).get()
            },
        };
        localStorage.setItem('saveMy',JSON.stringify(saveMy));
    
    }
    function fetchItem() {
        $('.company-contact').html('');
        let saveMy = JSON.parse(localStorage.getItem('saveMy'));
        if (saveMy!=null) {
            $.each(saveMy.sendTo.id,function(k,v){
                let item = $('<div class="badge badge-light border border-default mr-1 position-relative"><span class="float-left badge-label"></span> <a class="fas fa-times fa-xs removeItem"></a></div>');
                item.find('span').html(saveMy.sendTo.text[k]+'&nbsp;');
                item.attr('tag',v);
                item.attr('text',saveMy.sendTo.text[k]);
                $('.company-contact').append(item);
            })
            $('.comp-select:not(:checked)').each(function(){
                cur = $(this);
                $.each(saveMy.sendTo.id,function(k1,v1){
                  if(cur.val()==v1){ cur.prop('checked',true); }
                })
            })
            if(saveMy.sendTo.id.length>0){
              $('.chatbox').find('.alert_mail').removeAttr('style');
              $('.chatbox').find('.alert_mail').html(saveMy.sendTo.id.length)
            }else{
              $('.chatbox').find('.alert_mail').css('display','none');
            }
        }
    }
    function removeItem(el)
    {
        saveMy = JSON.parse(localStorage.getItem('saveMy'));
        saveMy.sendTo.id.splice( $.inArray(el.attr('tag'), saveMy.sendTo.id), 1 );
        saveMy.sendTo.text.splice( $.inArray(el.attr('text'), saveMy.sendTo.text), 1 );
        $('input[type="checkbox"][value="'+el.attr('tag')+'"]').prop('checked',false);
        localStorage.setItem('saveMy',JSON.stringify(saveMy));
        fetchItem();
    }
    function cleareStore(){
        localStorage.removeItem('saveMy');
        localStorage.clear();
    }
    $('button.next-step').click(function(){
        if($('.comp-select:checked').length>0){
            window.location.href='{{Session('lang')}}/'+category+'/confirmation';
        }else{
            alert('{{__('phrase.company-select')}}');
        }
    });
    $('#formContact').validate({
        ignor:[],
        errorElement: "em",
        errorClass: "invalid",
        rules:{
            company:{required:true},
            name:{required:true},
            department:{required:true},
            telephone:{required:true},
            email:{required:true},
            message:{required:true},
        },
        errorPlacement: function(error,element) {
            return true;
        },
        highlight: function(element, errorClass) {
            $(element).addClass(errorClass);
            $(element).next().addClass(errorClass);
            $(element).next().next().addClass(errorClass);
        },
        unhighlight:function(element, errorClass, validClass){
            $(element).removeClass(errorClass);
            $(element).next().removeClass(errorClass).addClass(validClass);
            $(element).next().next().removeClass(errorClass).addClass(validClass);

        }
    })
 
    $('.light-g').each(function(){$(this).children().lightGallery({thumbnail:true,download:false})});
    $(document).on('click','[data-target="#exampleModal"]',function(){
        const html = $.ajax({method:'get',url:$('html').attr('lang')+'/'+category+'/cp/d/'+$(this).attr('href').replace('javascript:',''),async:false});
        console.log(html);
        $('#exampleModal').find('.col-lg-12').append(html.responseText); 
    })
    $('#exampleModal').on('hide.bs.modal',function(){
        $(this).find('.col-lg-12').html('');
    })
    $(document).on('click','.mail',function(){
        const id = $(this).data('id');
        $('.comp-select[value="'+id+'"]').prop('checked',true);
        actionAd();
    });
</script>
</body>
</html>
