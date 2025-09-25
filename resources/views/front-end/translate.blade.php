<!DOCTYPE html>
<html lang="{{Session('lang')}}">
<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':  
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5FDVRDL');</script>
    <!-- End Google Tag Manager -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@lang('phrase.translate')</title>

    <base href="{{url('/')}}">
    <link href="https://fonts.googleapis.com/css2?family=Pridi:wght@200;400;500;600;700&family=Monoton&family=Noto+Sans+JP:wght@100;300;500;700;900&family=Roboto:ital,wght@0,100;0,300;1,500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/hunterPopup.css?v=5">
    <style>
        body{
            font-family: 'Pridi', 'Noto Sans JP', Verdana, Geneva, sans-serif;
            /* font-weight: 200; */
        }
        .bg-img{
            background-color: rgba(255, 255, 255, 1);
            background: url('images/2020-10-01_17h16_12.png') top no-repeat ;
            background-position-y: center;
            background-size:cover; 
        }
        .search-content{
            padding: 6rem 0 4rem 0;
        }
        .search-header{
            color:rgba(0,0,0);
        }
        .form-search{
            padding: 40px;
            background-color: rgba(242, 245, 247, .7);
        }
        .bg-light{
            /* background-color: rgba(0,0,0,0.7) !important; */
            background-color: var(--light-grey)
        }
        .quiz_card_area{
            overflow: hidden;
        }
        .form-content .col-lg-4{
            overflow-y: scroll;
            max-height: 1000px;
        }
        .form-content .col-lg-4::-webkit-scrollbar {
            width: 8px;
            position: relative;
            z-index: -1;
        }
        .form-content .col-lg-4::-webkit-scrollbar-thumb {
            background: #ddd;
        }
        .form-content .col-lg-4::-webkit-scrollbar-track {
            background: #f5f5f5;
        }
        .quiz_card_area{position: relative;margin-bottom: 15px;}
        .quiz_card_area:first-child{;margin-top: 15px;}
        .single_quiz_card{
            border-radius: 5px;
            overflow: hidden;
            border:2px solid #efefef;
            -webkit-transition: all 0.3s linear;
            -moz-transition: all 0.3s linear;
            -o-transition: all 0.3s linear;
            -ms-transition: all 0.3s linear;
            -khtml-transition: all 0.3s linear;
            transition: all 0.3s linear;
        }
        .quiz_checkbox {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            z-index: 99;
            cursor: pointer;
        }  
        .quiz_checkbox:checked ~ .single_quiz_card{ border: 2px solid #0062cc;}
        .quiz_checkbox:checked:hover ~ .single_quiz_card{ border: 2px solid #0062cc;}
        .quiz_checkbox:checked ~ .single_quiz_card .quiz_card_content .quiz_card_title{ background-color:#0062cc; color: #ffffff; }
        .quiz_checkbox:checked ~ .single_quiz_card .quiz_card_content .quiz_card_title h3{ color: #ffffff; }
        .quiz_checkbox:checked ~ .single_quiz_card .quiz_card_content .quiz_card_title h3 i{ opacity: 1; }
        .quiz_checkbox:checked:hover ~ .quiz_card_title{ border: 2px solid #0062cc;}
        .title-company{
            overflow:hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
        }
        .title-description{
            overflow:hidden;
            line-height: 1.5;
            height: 3em;
            text-overflow: ellipsis;
            white-space: nowrap;
            
        }
        .more{
            position: relative; z-index:100; font-size:12px; margin-right:10px;
        }
        .total-select{
            font-size: 18px;
        }
        .quiz_card_area img {
            margin:5px;
        }
        span.form-control{
            cursor: pointer;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        span.-focus{
            color: #495057;
            background-color: #fff;
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
        }
        .group{
            width: 100%;
            display: flex;
        }
    </style>


</head>
<body>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5FDVRDL"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
    @php
        $lang = Session('lang');
    @endphp
    <section class="bg-img">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="lang-bar text-white float-right">
                        <a class="text-white" href="{{url('translate/set/lang/jp')}}">日本語</a> | <a class="text-white" href="{{url('translate/set/lang/th')}}">ภาษาไทย</a>
                    </div>
                </div>
                <div class="col-lg-12 mt-5">
                    <span class="btn btn-outline-light btn-sm float-right">@lang('phrase.how-to')</span>
                    <h3 class="search-header text-white f-400">@lang('phrase.translate-caption')</h3>                    
                </div>
            </div>
            <div class="search-content">
                <div class="form-search">         
                    <form action="" method="get">           
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span class="form-control form-control-lg" id="language" title="@lang('phrase.language')">@lang('phrase.language')</span>
                                    <input type="hidden" name="language"  value="{{Request::get('language')}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span class="form-control form-control-lg" id="speciality" title="@lang('phrase.speciality')">@lang('phrase.speciality')</span>
                                    <input type="hidden" name="speciality"  value="{{Request::get('speciality')}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span class="form-control form-control-lg" title="@lang('phrase.urgent')" >
                                        <label for="urgent">@lang('phrase.urgent')</label> <input type="checkbox" id="urgent" name="urgent"  class="four_" value="yes" @if(Request::get('urgent')=='yes') checked="" @endif>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span class="form-control form-control-lg" title="@lang('phrase.postpay')">
                                        <label for="postpay">@lang('phrase.postpay')</label> <input type="checkbox" id="postpay" name="postpay" class="four_" value="yes" @if(Request::get('postpay')=='yes') checked="" @endif>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <span class="form-control form-control-lg" id="status" title="@lang('phrase.status')">@lang('phrase.status')</span>
                                    <input type="hidden" name="status"  value="{{Request::get('status')}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input type="submit" name="submit" class="btn btn-success btn-block btn-lg" value="@lang('phrase.search')">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            
            </div>
        </div>
    </section>
    <section class="bg-light">
        <div class="container py-5" >
            <div class="card" >
                <div class="row d-flex align-items-stretch form-content p-2">
                    <div class="col-lg-4">
                        @if(count($company)>0)
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="select-all">
                            <label class="custom-control-label" for="select-all">@lang('phrase.select-all')</label>
                        </div>
                        @foreach($company as $k => $row)
                        <a href="{{url(Session('lang').'/company')}}/{{$row->id}}" target="_blank">
                            <div class="card my-2 p-1">
                                <div class="float-left group">
                                    <img src="{{url($row->logo)}}" class="float-left d-block m-2" style="width: 80px;">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" id="com_{{$k}}" class="custom-control-input comp" value="{{$row->id}}" data-text="{{$row->name}}">
                                        <label for="com_{{$k}}" class="custom-control-label">{{$row->name}}</label>
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                        @else
                            <h5 class="text-center mt-4">Not found.</h5>
                        @endif
                    </div>
                    <div class="col-lg-8 pt-3">
                        <div class="form-group">
                            <label>@lang('phrase.company-name') : </label>
                            <input type="text" class="form-control" name="company">
                        </div>
                        <div class="form-group">
                            <label>@lang('phrase.telephone') : </label>
                            <input type="text" class="form-control" name="telephone">
                        </div>
                        <div class="form-group">
                            <label>@lang('phrase.position')  : </label>
                            <input type="text" class="form-control" name="position">
                        </div>
                        <div class="form-group">
                            <label>@lang('phrase.name')  : </label>
                            <input type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                            <label>Email : </label>
                            <input type="text" class="form-control" name="email">
                        </div>
                        <div class="form-group">
                            <label>@lang('phrase.content')  : </label>
                            <textarea name="content" class="form-control" rows="20"></textarea>
                        </div>
                        <div class="form-group">
                            <div class="float-left select text-info font-weight-bold">@lang('phrase.total') : <span class="total-select">0</span> @lang('phrase.company')</div>
                            <button type="button" class="float-right btn btn-outline-primary mb-3 next-step">@lang('phrase.submit')</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <footer class="d-block bg-dark" style="height:100px;">
        <div class="container"><h6 class="text-white text-center align-middle py-4">Hiroa Thai  Company Limited&copy;</h6></div>
    </footer>
</body>
</html>
@php
    $get['language'] = explode(',',Request::get('language'));
    $get['speciality'] = explode(',',Request::get('speciality'));
    $get['urgent'] = Request::get('urgent');
    $get['postpay'] = Request::get('postpay');
    $get['status'] = explode(',',Request::get('status'));
@endphp
<div id="tableOne" style="display:none">
    <div class="row scroll-y"><br>
        @foreach(\App\Models\TranslateMd::select('id',"name_$lang as name")->get() as $k => $v)
        <div class="col-lg-6 col-xs-6">                
            <div class="qa-box">
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input one_" id="one_{{$k}}" name="language[]" value="{{$v->id}}" text="{!!$v->name!!}" @if(in_array($v->id,$get['language'])) checked="" @endif>
                    <label class="custom-control-label" for="one_{{$k}}">{!!$v->name!!}</label>
                </div>
            </div>
        </div>
        @endforeach
        <div class="clearfix"></div><br>
    </div>
    <div class="row">
        <div class="col-lg-12 popover-footer"><a href="javascript:" class="btn btn-danger btn-sm clear-list"><i class="fas fa-angle-double-right"></i> @lang('phrase.reset')</a></div>
    </div>
</div>
<div id="tableTwo" style="display:none">
    <div class="row scroll-y"><br>
        @foreach(\App\Models\SpecialityMd::select('id',"name_$lang as name")->get() as $k => $v)
        <div class="col-lg-6 col-xs-6">                
            <div class="qa-box">
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input two_" id="two_{{$k}}" name="speciality[]" value="{{$v->id}}" text="{!!$v->name!!}" @if(in_array($v->id,$get['speciality'])) checked="" @endif>
                    <label class="custom-control-label" for="two_{{$k}}">{!!$v->name!!}</label>
                </div>
            </div>
        </div>
        @endforeach
        <div class="clearfix"></div><br>
    </div>
    <div class="row">
        <div class="col-lg-12 popover-footer"><a href="javascript:" class="btn btn-danger btn-sm clear-list"><i class="fas fa-angle-double-right"></i> @lang('phrase.reset')</a></div>
    </div>
</div>
<div id="tableFive" style="display:none">
    <div class="row scroll-y"><br>
        @foreach(\App\Models\StatusMd::select('id',"name_$lang as name")->get() as $k => $v)
        <div class="col-lg-6 col-xs-6">                
            <div class="qa-box">
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input five_" id="five_{{$k}}" name="status[]" value="{{$v->id}}" text="{!!$v->name!!}" @if(in_array($v->id,$get['status'])) checked="" @endif>
                    <label class="custom-control-label" for="five_{{$k}}">{!!$v->name!!}</label>
                </div>
            </div>
        </div>
        @endforeach
        <div class="clearfix"></div><br>
    </div>
    <div class="row">
        <div class="col-lg-12 popover-footer"><a href="javascript:" class="btn btn-danger btn-sm clear-list"><i class="fas fa-angle-double-right"></i> @lang('phrase.reset')</a></div>
    </div>
</div>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/jquery-popup.js?v=16"></script>
<script>
    $('span.form-control').on('click',function(ev){
        $(this).addClass('-focus');
        $('span.form-control').not(this).removeClass('-focus');
        ev.stopPropagation();
    });
    $(document).click(function(){
        $('span.form-control').removeClass('-focus');
    })
    $('.comp').click(function(){ console.log($('.comp:checked').map(function(){ return $(this).val(); }).get()) });
    $('button.next-step').click(function(){
        var saveMy = { 
            company : $('input[name="company"]').val(),
            telephone : $('input[name="telephone"]').val(),
            position : $('input[name="position"]').val(),
            name : $('input[name="name"]').val(),
            email : $('input[name="email"]').val(),
            content : $('textarea[name="content"]').val(),
            sendTo : { 
                id:$('.comp:checked').map(function(){return $(this).val()}).get(), 
                text:$('.comp:checked').map(function(){return $(this).data('text')}).get()
            },
        };
        localStorage.setItem('saveMy',JSON.stringify(saveMy));
        console.log(localStorage.getItem('saveMy'));
        if($('.comp:checked').length>0){
            window.location.href='{{Session('lang')}}/translate/confirmation';
        }else{
            alert('会社を選択してください!');
        }
    });
    function cleareStorage(){
        localStorage.removeItem('saveMy');
        localStorage.clear();
    }
    $('.comp').click(function(){
        const count = $('.comp:checked').length;
        $('.total-select').html(count);
    })
    checked()
    function checked()
    {
        // const inter = $('input[name="international"]').val().split(',');
        text = { one:[],two:[],three:[],four:[],five:[]};
        $('.one_:checked').each(function(i,v){ text.one.push($(this).attr('text')); })
        $('.two_:checked').each(function(i,v){ text.two.push($(this).attr('text')); })
        $('.three_:checked').each(function(i,v){ text.three.push($(this).attr('text')); })
        $('.four_:checked').each(function(i,v){ text.four.push($(this).attr('text')); })
        $('.five_:checked').each(function(i,v){ text.five.push($(this).attr('text')); })

        if(text.one.length>0) $('#language').html(text.one.join(', '));
        if(text.two.length>0) $('#speciality').html(text.two.join(', '));
        // $('#urgent').val(text.three);
        // $('#postpay').val(text.four);
        if(text.two.five>0) $('#status').html(text.five.join(', '));
    }
    $('#language').hunterPopup({
        width: '750px',
        title: $('#language').attr('title'),
        content: $('#tableOne'),
        event:function(){
            var one = {id:[],text:[]};
            $('.one_').click(function(){ one = {id:[],text:[]}; adjust(); });
            function adjust() {
                $('.one_:checked').each(function(){
                    one.id.push($(this).val())
                    one.text.push(' '+$(this).attr('text'))
                })
                $('#language').html(one.text.join(', '));
                $('#language').next().val(one.id);
            }  
            $('.clear-list').click(function(){
                $('#language').html($('#language').attr('title'))
                $('#language').next().val('')
                $('.one_:checked').prop('checked',false);
            })
        }
    })
    $('#speciality').hunterPopup({
        width: 750,
        title: $('#speciality').attr('title'),
        content: $('#tableTwo'),
        placement:'center',
        event:function(){
            var one = {id:[],text:[]};
            $('.two_').click(function(){ one = {id:[],text:[]}; adjust(); });
            function adjust() {
                $('.two_:checked').each(function(){
                    one.id.push($(this).val())
                    one.text.push(' '+$(this).attr('text'))
                })
                $('#speciality').html(one.text.join(', '));
                $('#speciality').next().val(one.id);
            }
            $('.clear-list').click(function(){
                $('#speciality').html($('#speciality').attr('title'))
                $('#speciality').next().val('')
                $('.two_:checked').prop('checked',false);
            })
        }
    })
    $('#status').hunterPopup({
        width: 750,
        title: $('#status').attr('title'),
        content: $('#tableFive'),
        placement: 'center',
        event:function(){
            var one = {id:[],text:[]};
            $('.five_').click(function(){ one = {id:[],text:[]}; adjust(); });
            function adjust() {
                $('.five_:checked').each(function(){
                    one.id.push($(this).val())
                    one.text.push(' '+$(this).attr('text'))
                })
                $('#status').html(one.text.join(', '));
                $('#status').next().val(one.id);
            }  
            $('.clear-list').click(function(){
                $('#status').html($('#status').attr('title'))
                $('#status').next().val('')
                $('.five_:checked').prop('checked',false);
            })
        }
    })
    $('#select-all').on('click',function(){
        if($(this).is(':checked')){
            $('.comp').prop('checked',true);
            $('.total-select').html($('.comp:checked').length);
        }else{ 
            $('.comp').prop('checked',false);
            $('.total-select').html(0);
        }
    }); 
</script>