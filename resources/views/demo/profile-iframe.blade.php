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
            body{
                background-color: #ededed
            }
            .container iframe{
                height: 87vh;
            }

            .container iframe document{
                overflow-y: auto;
            }
            .container iframe document::-webkit-scrollbar-track {
                background-color: #dedede;
                border-radius: 10px;
            }

            .container iframe document::-webkit-scrollbar {
                width: 10px;
                background-color: #dedede;
            }

            .container iframe document::-webkit-scrollbar-thumb {
                border-radius: 10px;
                background-color: #dedede;
            }
            .custom-radio{
                display: flex;
                align-content: center;
                justify-content: center;
                align-items: center;
            }
            .col-left{
                background-color: #a3ddb0;
                font-weight: bold;
            }
            .col-right{
                background-color: #ff93a1;
                font-weight: bold;
            }
            .custom-control-label::before {

                border: #000000 solid 2px !important;
            }
        </style>
    </head>
    <body>
        <input type="hidden" name="companyId" value="{{$row->id}}">
        <input type="hidden" name="categoryId" value="{{$row->categoryId}}">
        <input type="hidden" name="category" value="{{$row->category}}">
        <input type="hidden" name="redirect" value="{{$redirect}}">
        @if(!$row->allow)
        <section>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-xs-12 p-0">
                        <iframe src ="demo/p/u/{{$row->profile_url}}" marginheight="0" marginwidth="0" frameborder="no"></iframe>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-xs-6 col-md-6 col-left">
                        <label class="custom-control custom-radio mx-3">
                            <input type="radio" name="allow" value="allow" class="custom-control-input" id="customCheck1">
                            <label class="custom-control-label" for="customCheck1">อนุญาตให้ใช้ข้อมูล</label>
                        </label>
                    </div>
                    <div class="col-lg-6 col-xs-6 col-md-6 col-right">
                        <label class="custom-control custom-radio mx-3">
                            <input type="radio" name="allow" value="not-allow" class="custom-control-input" id="customCheck2">
                            <label class="custom-control-label" for="customCheck2">ไม่อนุญาตให้ใช้ข้อมูล</label>
                        </label>
                    </div>
                </div>
        </section>
        @else
            @if($row->allow == 'allow')<script> window.location.replace("th/{{$row->category}}/cp/{{$row->profile_url}}");</script>@endif
        @endif

    </body>
</html>
<script src="js/jquery.js"></script>
<script src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
<script src="back-end/sweetalert2/sweetalert2.min.js"></script>
<script src="js/axios.min.js"></script>
<script>
    var companyId = document.querySelector('input[type="hidden"]').value;
    var category = document.querySelector('input[name="category"]').value;
    var categoryId = document.querySelector('input[name="categoryId"]').value;

    checkCookie();
    function setCookie(cname, cvalue) 
    {
        // 400 days
        const exdays = 3600 * 1000 * 24 * 400;
        const d = new Date();
        d.setTime(d.getTime() + exdays);
        let expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    function getCookie(cname) 
    {
        let name = cname + "=";
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
        return "";
    }
    function checkCookie() 
    {
        setCookie("at_once_visitor", `cid-${companyId}`);
        // r = '{{$redirect}}';
        // if(r!='') window.location.replace(r);

    }

    iframe = document.querySelector('iframe');
    setTimeout(() => {
        height = iframe.clientHeight;
        height = height + 20;
        radio = document.querySelectorAll('.custom-radio');
        for(let i=0; i<radio.length; i++){

            radio[i].style.height = `calc(100vh - ${height}px)`;
        }
    }, 500);
    allow = document.querySelectorAll('input[name="allow"]');
    
    for(let i=0; i<allow.length; i++){
        allow[i].addEventListener('change',function(){
            requestAllow(allow[i].value);
        });
    }
    function requestAllow(val)
    {
        axios({
            method: 'post',
            url: 'api/company/allow-to-use-infomation',
            data: {
                id: companyId,
                allow: val
            }
        })
        .then((res)=>{
            console.log(res.data)
            alert(`${res.data.status}, ${res.data.message}`);
            if(res.data.statusCode == 200){
                setTimeout(() => {
                    r = document.querySelector('input[name="redirect"]').value;
                    console.log(r);
                    if(r!='') window.location.replace(r);
                }, 1000);
            }
        })
        .catch((error) => console.log(error));       
    }
    
</script>