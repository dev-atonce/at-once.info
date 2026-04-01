<!doctype html>
<html lang="en">
<head>
    @include("$prefix.analytics.googleAnalytics")
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ @$seo->seo_keyword ? @$seo->seo_keyword : (@$seo->seo_keyword_th ?? '') }}">
    <meta name="description" content="{{ !empty($seo->seo_description) ? $seo->seo_description : (!empty($seo->seo_description_th) ? $seo->seo_description_th : 'ค้นหาบริษัท'.($categoryName ?? 'ชั้นนำ').'กว่า 700 บริษัทบน At-Once เปรียบเทียบและติดต่อได้เลย') }}">

    <title>
        @if(!empty($seo->title))
            {{ $seo->title }}
        @elseif(!empty($seo->title_th))
            {{ $seo->title_th }}
        @elseif(!empty($seo->seo_keyword))
            {{ $seo->seo_keyword }}
        @else
            รายชื่อบริษัท{{ $categoryName ?? 'ที่น่าเชื่อถือ' }} | แพลตฟอร์มB2B อันดับ1ในไทย - At-Once
        @endif
    </title>

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

    <meta property="og:title" content="{{ !empty($seo->title) ? $seo->title : (!empty($seo->title_th) ? $seo->title_th : 'รายชื่อบริษัท'.($categoryName ?? 'ที่น่าเชื่อถือ').' | แพลตฟอร์มB2B อันดับ1ในไทย - At-Once') }}">
    <meta property="og:description" content="{{ !empty($seo->seo_description) ? $seo->seo_description : (!empty($seo->seo_description_th) ? $seo->seo_description_th : 'ค้นหาบริษัท'.($categoryName ?? 'ชั้นนำ').'กว่า 700 บริษัทบน At-Once เปรียบเทียบและติดต่อได้เลย') }}">
    <meta property="og:image" content="{{ url('img/logo-bg-white.jpg') }}">
    <meta property="og:url" content="{{ url('') . '/' . Session('lang') . '/blog' }}">

    <base href="{{url('/')}}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href='https://fonts.googleapis.com/icon?family=Material+Icons'>
    <link rel="stylesheet" href="css/header-footer.css?v=0005">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/filter.css">
    <link rel="stylesheet" href="css/panel-box.css">
    <link rel="stylesheet" href="slick/slick.min.css">
    <link rel="stylesheet" href="slick/slick-custom.css">
    <link rel="stylesheet" href="css/blog.css">
    <link rel="stylesheet" href="css/category-v2.css">
    <link rel="stylesheet" href="css/filter-v2.css">
    <link rel="stylesheet" href="css/hunterPopup.css">
    <link rel="stylesheet" href="css/validate.css">
    <link rel="stylesheet" href="css/bootstrap-select-1.13.14/bootstrap-select.css">
    <style type="text/css">
        /*    08/06/2023*/
        .h1{
            font-size: 24px;
        }
        .h2{
            font-size: 21px;
        }
        .card-other-title > .h3{
            font-size: 16px;
            line-height: 25px;
            padding: 0 1.5%;
            margin: 0;
            text-align: center;
        }

        
        .search-results .search-card-company{
            padding: 20px;
            border-radius: var(--v1-radius-lg);
            border: var(--v1-border);
            box-shadow: var(--v1-sha01);
            margin-bottom: 30px;
        }
        
        .company-name{
            color: var(--v1-black);
        }
        
        .search-results .industry-name{
            font-size: 16px;
            line-height: 30px;
        }
        
        .search-results p{
            color: var(--v1-gray);
        }
        
        .search-card-company .row{
            align-items: center;
        }
        
        @media screen and (max-width: 767px){
            .search-card-company .row {
             align-items: unset;nter;
         }
        }
        
        .search-results .btn-detail{
            background-color: var(--v1-orange);
            color: #ffffff;
            border-radius: var(--v1-radius-lg);
            padding: 5px 20px;
            display: block;
        }
        
        .search-results .btn-detail:hover{
            background-color: var(--v1-orange);
            color: #ffffff;
            border-radius: var(--v1-radius-lg);
            padding: 5px 20px;
        }

        .slick-dots li button:before {
            color: #192F48 !important;
        }

    </style>
</head>
<body>
    @php 
        $lang=Session('lang');
        $mainId = Request::get('main');
        $subId = Request::get('sub');
        $categoryId = Request::get('category');
    @endphp
    @include("$prefix.header")
    @include("$prefix.sponsor")

    {{-- <section class="layout2">
        <div class="container mb-5">
            <div class="row">
                <div class="col-lg-12">   
                    <h1 class="h3 text-center mt-2 mt-lg-4 mb-4"><strong> @lang('phrase.all-industry')</strong></h1>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card v1-sha01 radius-lg bg-gray mb-4">
                        <div class="card-body">
                            <div class="box-title">
                                <div class="h5 mb-3"><b>ค้นหา</b></div>
                            </div>
                            <div class="form-group">
                                <form action="">
                                    <div class="input-group">
                                        <input type="text" name="keywords" id="kywords" class="form-control" placeholder="ค้นหา…" value="{{Request::get('keywords')}}">
                                        <div class="input-group-append">
                                            <button type="submit" class="btn btn-outline-secondary"><i class="icofont-search-2"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <ul id="myTabs" class="nav nav-pills nav-justified row" role="tablist">
                @foreach($main as $k => $v)
                @php($active=($k==0)?'active':'')
                @if(Request::get('keywords'))@php($active='')@endif
                @if($mainId == $v->id)@php($active='active')@endif
                <li class="col-6 col-lg-3 tabs__big-category" data-id="{{$v->id}}">
                    <a href="javascript:" class="box__big-category {{$active}}">
                        <img src="{{$v->logo}}" alt="{{$v->name_th}}" title="{{$v->name_th}}"><div>{{$v->name_th}}</div>
                    </a>
                </li>
                @endforeach
            </ul>
            <div class="table-category position- mt-2 @if(Request::get('keywords'))d-none @endif">
                <div class="table-body">
                    <div class="row">
                        <div class="col-12 col-lg-4">
                            <div class="step2">
                                <div class="box-list bg-silver">
                                    <div class="scroll" id="scrollblue">
                                        <div class="collection-list">
                                            @foreach(
                                                \App\Models\CategorySubMd::where(function($sub)use($mainId){ 
                                                    if($mainId) $sub->where('status',1);
                                                    else $sub->where(['category_main' => 1,'status' => 1]); 
                                                })->when(Request::get('main'),function($sub)use($mainId){ 
                                                    $sub->where(function($query)use($mainId){
                                                        $query->where('category_main', $mainId);
                                                    });
                                                })
                                                ->select("id","name_th","icon","category_main as main")
                                                ->get() 
                                                as $j => $s
                                            )
                                                @php($activeSub=($j==0)?'active':'')
                                                @php($activeSub=($subId==$s->id)?'active':'')
                                                <div class="sub-category card-sub {{$activeSub}}" data-id="{{$s->id}}" datta-main="{{$s->main}}">
                                                    <div class="circle">
                                                        <div class="images">
                                                            
                                                            <img src="{{$s->icon}}" title="{{$s->name_th}}" width="50" height="50">
                                                        </div>
                                                    </div>
                                                    <div class="title">{{$s->name_th}}</div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-lg-8 pr-3 px-0 step3">
                            <div class="-grid collection-list">
                                @foreach(
                                    \App\Models\CategoryMd::leftJoin('category_main as main','category.category_sub','=','main.id')
                                    ->where(function($query)use($subId){
                                        if ($subId) $query->where('category.status',1);
                                        else $query->where(['category.status'=>1,'category.category_sub'=>1]);
                                    })
                                    ->when(Request::get('sub'),function($sub)use($subId){ 
                                        $sub->where(function($query)use($subId){ 
                                            $query->where('category.category_sub',$subId); 
                                        });
                                    })
                                    ->select('category.id','category.name_th','category.image','category.category_sub as sub','main.id as main','category.key','category.coming_soon')
                                    ->get() as $c
                                )
                                @php($activeCat=($categoryId==$c->id)?'active':'')
                                @php($href=($c->coming_soon!=1)?'th/'.$c->key:'javascript:')
                                <a class="text-dark" href="{{$href}}" target="_blank" style="text-decoration: none;">
                                    <div class="card-cat fade show {{$activeCat}}">
                                        <div class="circle">
                                            <div class="images @if($c->coming_soon==1)coming-soon @endif">
                                                @if($c->coming_soon==1)<span>Coming soon</span>@endif
                                                <img src="{{$c->image}}" title="{{$c->name_th}}" width="50" height="50">
                                            </div>
                                        </div>
                                        <div class="title">{{$c->name_th}}</div>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <style>
        .step3{
            height: unset !important; 
            border: 1px solid #ced4da;
            border-radius: var(--v1-radius-lg);
        }
        #formCategory{
            border: 1px solid #ced4da !important;
        }
    </style>
    <div class="container mb-5">
        @include("$prefix.bigcategory-v2")
    </div>

    @if(@$count>0)
    <section id="search-result">
        <div class="container mb-5">
            <div class="mb-3">ผลการค้นหา: 
                <b class="v1-blue">
                    @if(Request::get('keyword')){{Request::get('keyword')}}@endif
                    @if(Request::get('category')){{$categorySearch->name}}@endif
                    {{number_format($allCount)}} รายการ
                </b>
            </div>
            <div class="search-results">
                <div class="row">
                    <div class="col-lg-12">
                        @foreach($company as $k => $row)
                        <div class="search-card-company">
                            <div class="row">
                                <div class="col-4 col-lg-2">
                                    <img class="radius-lg img-fluid"  src="{{$row->logo}}"  alt="{{$row->name_th}}" title="{{$row->name_th}}">
                                </div>
                                <div class="col-8 col-lg-8">
                                    <div class=" d-flex ">
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3">
                                                <a href="/th/{{$row->category}}/cp/{{$row->profile_url}}" class="company-name">
                                                    <div class="h5 mb-0">
                                                        <strong>{{$row->name_th}}</strong>
                                                    </div>   
                                                </a>
                                                <div class="industry-name --c-orange">
                                                    <i class="fas fa-circle bullet "></i><span>{{$row->categoryName}}</span>
                                                </div>
                                                <p class="d-none d-lg-block">{{$row->description_th}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-12 col-lg-2">
                                    <p class="mt-2 d-block d-lg-none">{{$row->description_th}}</p>
                                    <a class="btn btn-detail" href="/th/{{$row->category}}/cp/{{$row->profile_url}}" target="__blank">ดูรายละเอียด</a>
                                </div>
                            </div>
                        </div>   
                        @endforeach
                    </div>
                </div>
            </div>
            @if($company->links()){{$company->links()}}@endif
        </div>
    </section>
    @endif
<script src="js/axios.min.js"></script>
{{-- <script>
    let portrait = window.matchMedia("(orientation: portrait)");    
    var myCategoryEl = document.querySelector('.layout2');
    var subCatEl = document.querySelectorAll('.sub-category');
    var mainsEl = myCategoryEl.querySelectorAll('.tabs__big-category');
    let MainCategory = [];
    let SubCategory = [];
    let Category = [];

    //================= Loading Overlay =================//
    var loadingOverlay = document.createElement('div');
        loadingOverlay.setAttribute('class', 'content-overlay light');
        loadingOverlay.innerHTML = `<div class="cv-spinner"><span class="spinner"></span></div>`;
    
    for(let i=0; i<mainsEl.length; i++){
        MainCategory.push({
            id : mainsEl[i].getAttribute('data-id'),
            icon : mainsEl[i].querySelector('img').getAttribute('src'),
            name_th : mainsEl[i].querySelector('div').innerHTML,
        })
    }

    document.addEventListener('click',function(e){
        mainsEl = e.target.closest('.box__big-category');
        if(mainsEl){
            id = mainsEl.closest('.tabs__big-category').getAttribute('data-id');
            getData('sub',id);
            active('main', mainsEl, id);
            myCategoryEl.querySelector('.table-category').classList.remove('d-none');
        }
        subCatEl = e.target.closest('.sub-category');
        if(subCatEl){
            id = subCatEl.getAttribute('data-id');
            getData('cat',id);
            active('sub', subCatEl, id);
            // activeStep2(subCatEl);
        }
    })

    const getData = async (type,id) =>
    {
        id = Number(id);
        find = search(type,id);
        switch (type) {
            case 'sub' :
                if(find == 0){
                    step2 = myCategoryEl.querySelector('.table-category');
                    step2.append(loadingOverlay);
                    res = await axios(`api/get/category/sub/${id}`);
                    data = res.data;
                    for(i=0; i<data.length; i++){
                        SubCategory.push(data[i]);
                    }
                    if(Object.keys(data).length>0){
                        step2.querySelector('.content-overlay').remove();
                    }
                }
                adjustCategory(type,id);
            break;
            case 'cat' :
                if(find == 0){
                    step3 = myCategoryEl.querySelector('.table-category');
                    step3.append(loadingOverlay);
                    res = await axios(`api/get/category/cat/${id}`);
                    data = res.data;
                    for(i=0; i<data.length; i++){
                        Category.push(data[i]);
                    }
                    if(Object.keys(data).length>0){
                        step3.querySelector('.content-overlay').remove();
                    }
                }
                adjustCategory(type,id);
            break;
        }
    }
    function search(type, find)
    {
        switch (type){
            case 'sub': 
                for (let i=0; i < Object.keys(SubCategory).length; i++) {
                    if (SubCategory[i].main === find) return 1;
                }
            break;
            case 'cat': 
                for (let i=0; i < Object.keys(Category).length; i++) {
                    if (Category[i].sub === find) return 1;
                }
            break;
        }
        return 0;
    }

    function adjustCategory(type,id)
    {
        find = new Array();
        html = '';
        switch(type) {
            case 'sub': 
                for(let i=0; i<Object.keys(SubCategory).length; i++){
                    if(SubCategory[i].main == id) find.push(SubCategory[i]);
                }
                step2 = myCategoryEl.querySelector('.step2');
                step3 = myCategoryEl.querySelector('.step3');
                step3.querySelector('.collection-list').innerHTML = '';
                items = step2.querySelector('.collection-list');
                for(let i =0; i<Object.keys(find).length; i++){
                    html+= `<div class="sub-category card-sub" data-id="${find[i].id}" datta-main="${find[i].main}">
                        <div class="circle">
                            <div class="images">
                                <img src="${find[i].icon}" title="${find[i].name_th}" width="50" height="50">
                            </div>
                        </div>
                        <div class="title">${find[i].name_th}</div>
                    </div>`;
                }
                items.innerHTML = html;
                setTimeout(() => { 
                    list = items.querySelectorAll('.fade');
                    for(let i=0; i<list.length; i++) list[i].classList.add('show');
                },150); 
            break;
            case 'cat': 
                for(let i=0; i<Object.keys(Category).length; i++){
                    if(Category[i].sub == id) find.push(Category[i]);
                }
                step3 = myCategoryEl.querySelector('.step3');
                items = step3.querySelector('.collection-list');
                console.log(find)
                for(let i =0; i<Object.keys(find).length; i++){
                    html+= `<a class="text-dark" href="${find[i].coming_soon != 1 ? 'th/'+find[i].key : 'javascript:' }" target="_blank" style="text-decoration:none;"><div class="card-cat fade" data-id="${find[i].id}" data-sub="${find[i].sub}">\
                        <div class="circle">\
                            <div class="images${find[i].coming_soon == 1 ? ' coming-soon' : ''}">\
                                ${find[i].coming_soon == 1 ? '<span>Coming soon</span>' : '' }
                                <img src="${find[i].icon}" title="${find[i].name_th}" width="50" height="50">\
                            </div>\
                        </div>\
                        <div class="title">${find[i].name_th}</div>\
                    </div></a>`;
                }
                items.innerHTML = html;
                setTimeout(() => { 
                    list = items.querySelectorAll('.fade')
                    for(let i=0; i<list.length; i++) list[i].classList.add('show');
                },150); 
            break;
        }
    }

    function active(type,el,id)
    {
        el.classList.add('active');
        switch(type) 
        {
            case 'main': 
                subCatEl = el.closest('.row').querySelectorAll('.tabs__big-category');
                for(let i=0; i<subCatEl.length; i++)
                {
                    if( subCatEl[i].getAttribute('data-id') != id )
                        subCatEl[i].querySelector('.box__big-category').classList.remove('active');
                }
            break;
            case 'sub': 
                subCategory = el.closest('.collection-list').querySelectorAll('.card-sub');
                for(let i = 0; i < subCategory.length; i++)
                {
                    if( id != subCategory[i].getAttribute('data-id'))
                        subCategory[i].classList.remove('active');
                }
            break;
        }
    }
    
</script> --}}


@include("$prefix.footer")

<script src="js/jquery.js"></script>
<!-- Optional JavaScript -->
{{-- <script src="js/lightgallery.js"></script> --}}
<script src="js/lg-fullscreen.js"></script>
<script src="js/lg-thumbnail.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-popup.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en"></script>
<script type="text/javascript" src="js/custom.js?v=0001"></script>
<script type="text/javascript" src="js/build/authentication.js"></script>
<script type="text/javascript" src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
<script type="text/javascript" src="js/bootstrap-select-1.13.14/bootstrap-select.js"></script>
<script src="js/filter-main.js?v=02"></script>

<script type="text/javascript" src="slick/slick.min.js"></script>
<script type="text/javascript" src="slick/custom.js"></script>
<script type="text/javascript" src="slick/main.js"></script>

<script>
    $('#navbarSupportedContent').find('div.dropdown-menu').click(function(){
            // console.log($(this));
        $(this).parent().addClass('show');
        $(this).prev().attr('aria-expanded',true);
        $(this).addClass('show');
    })
</script>
</body>
</html>
<script>

    if(window.location.search != ''){
        $('html,body').animate({
            scrollTop: 900
        }, 800);
    }
</script>