<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
        <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
        <meta name="author" content="Łukasz Holeczek">
        <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
        <meta name="csrf-token" content="{{csrf_token()}}">

        <title>{{Config::get('app.name')}} | Webpanel</title>

        <base href="{{url('/')}}">
        <link rel="icon" type="image/png" sizes="16x16" href="favicon.ico">
        <link rel="stylesheet" href="back-end/fontawesome-5.15.4/css/all.css">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="theme-color" content="#ffffff">
        
        <link href="back-end/css/style.css" rel="stylesheet">
        {{-- <link href="back-end/bootstrap-4.3.1/css/bootstrap.css" rel="stylesheet"> --}}
        <link href="css/docs.min.css" rel="stylesheet">
        <link href="back-end/vendors/pace-progress/css/pace.min.css" rel="stylesheet">
        @if(@$css)
        @foreach($css as $css)
            <link href="{{$css}}" rel="stylesheet">
        @endforeach
        @endif
        @if(@$js)
            @foreach($js as $js)
                <script src="{{$js}}"></script>
            @endforeach
        @endif
        <style>
            .translation{
                padding: 0;
                margin: 0;
            }
            .translation li{
                list-style-type: none;
                float: left;
                margin: 0 2px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex justify-content-center mt-3 mb-3">
                        <ul class="translation skiptranslate">
                            <li><a href="javascript:#" class="btn btn-secondary translation-links" data-lang="Thai"><i class="fas fa-language fa-lg"></i>&nbsp;Thai</a></li>
                            <li><a href="javascript:#" class="btn btn-secondary translation-links" data-lang="English"><i class="fas fa-language fa-lg"></i>&nbsp;English</a></li>
                            <li><a href="javascript:#" class="btn btn-secondary translation-links" data-lang="Japanese"><i class="fas fa-language fa-lg"></i>&nbsp;Japanese</a></li>
                            <li><a href="javascript:#" class="btn btn-secondary translation-links" data-lang="Chinese"><i class="fas fa-language fa-lg"></i>&nbsp;Chinese</a></li>
                            <li><a href="javascript:#" class="btn btn-info ml-2 copy"><i class="fas fa-copy fa-fw"></i>&nbsp;Copy</a></li>
                        </ul>
                        {{-- <button class="btn btn-info btn-sm skiptranslate">Copy</button> --}}
                        <div id="google_translate" class="d-none"></div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        <div class="container">
            {!!$row->more_th!!}
            {{-- @if($row->more_en)
                {!!$row->more_en!!}
            @else
                <h1 class="text-primary text-center mt-5">กรุณากรอกฟิลด์ภาษาอังกฤษ</h1>
            @endif --}}
        </div>
    </body>
</html>
<script>
    function googleTranslateElementInit() {
        const hl = 'en,th,vi,id,ms,lo,zh-TW,zh-CN,zh-HK,ja,es,fr,ko,it,de,my,pa,mr,hi,ar,pa,pt,ru,bn,jw,te,ta';
        new google.translate.TranslateElement({
            pageLanguage: 'th' , 
            layout: google.translate.TranslateElement.InlineLayout.SIMPLE, 
            autoDisplay: false, 
            includedLanguages: hl
        },'google_translate');
    }

</script>
<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en"></script>
<script>
    
    // $(document).on('click','.translation-links',function() {
    //     var lang = $(this).data('lang');
    //     var $frame = $('.goog-te-menu-frame:first');
    //     if (!$frame.length) {
    //         alert("Error: Could not find Google translate frame.");
    //         return false;
    //     }
    //     $frame.contents().find('.goog-te-menu2-item span.text:contains('+lang+')').get(0).click();
    //     return false;
    // });
    $(document).on('click','.translation-links',function() {
        thisClass = `VIpgJd-ZVi9od`;
        var lang = $(this).data('lang');
        var $frame = $(`iframe[class^="${thisClass}"]`).eq(2);
        if($frame.length<1) $frame = $(`iframe[class^="${thisClass}"]`);
        if (!$frame.length) {
            alert("Error: Could not find Google translate frame.");
            return false;
        }
        $frame.contents().find(`.${thisClass}-vH1Gmf-ibnC6b span.text:contains(${lang})`).get(0).click();
        return false;
    });
    $(document).on('click','.copy',function(){
        let html = $('.container:last').clone();
        html.select();
        navigator.clipboard.writeText(html.html())
        // alert(html)
        swal.fire({
            title:'Copy to clipboard',
            icon:'success',
            showConfirmButton: false,
            timer:2000,
            toast:true,
            customClass:{ container:'skiptranslate' },
            position:'bottom-end'
        })
    })
</script>