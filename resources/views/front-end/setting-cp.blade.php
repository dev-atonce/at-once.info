<!DOCTYPE html>
<html lang="{{Session('lang')}}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@lang('phrase.setting-cp-caption')</title>

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
            background-image:url('./images/company-main-hero-banner-1440x670_tcm148-13299.jpg');
            background-position: center;
            background-size: cover;
        }
        .search-content{
            padding: 6rem 0 4rem 0;
        }
        .search-header{
            color:rgba(0,0,0);
        }
        .form-search{
            padding: 40px;
            background-color: rgba(242,245,247,0.8);
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
    @php
        $lang = Session('lang');
    @endphp
    <section class="bg-img">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="lang-bar float-right">
                        <a class="" href="{{url('translate/set/lang/jp')}}">日本語</a> | <a class="" href="{{url('translate/set/lang/th')}}">ภาษาไทย</a>
                    </div>
                </div>
                <div class="col-lg-12 mt-5">
                    <span class="btn btn-outline-dark btn-sm float-right">@lang('phrase.how-to')</span>
                    <h3 class="search-header f-400">@lang('phrase.setting-cp-caption')</h3>                    
                </div>
            </div>
            <div class="search-content">
                <div class="form-search">         
                    <form action="" method="get">           
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>@lang('phrase.location')</label>
                                    <span class="form-control form-control-lg" id="location" title="@lang('phrase.location')"></span>
                                    <input type="hidden" name="location"  value="{{Request::get('location')}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>@lang('phrase.consulting')</label>
                                    <span class="form-control form-control-lg" id="consulting" title="@lang('phrase.consulting')"></span>
                                    <input type="hidden" name="consulting"  value="{{Request::get('consulting')}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <input type="submit" name="submit" class="btn btn-info btn-block btn-lg" value="@lang('phrase.search')">
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
    $get['location'] = explode(',',Request::get('location'));
    $get['consulting'] = explode(',',Request::get('consulting'));
    $langPro = (Session('lang')=='th')?'th':'en';
@endphp
<div id="tableOne" style="display:none">
    <div class="row scroll-y"><br>
        @foreach(\App\Models\ProvinceMd::select('province_id as id',"province_name_$langPro as name")->get() as $k => $v)
        <div class="col-lg-6 col-xs-6">                
            <div class="qa-box">
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input one_" id="one_{{$k}}" name="location[]" value="{{$v->id}}" text="{!!$v->name!!}" @if(in_array($v->id,$get['location'])) checked="" @endif>
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
        @foreach(\App\Models\ConsultingMd::select('id',"name_$lang as name")->get() as $k => $v)
        <div class="col-lg-6 col-xs-6">                
            <div class="qa-box">
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input two_" id="two_{{$k}}" name="consulting[]" value="{{$v->id}}" text="{!!$v->name!!}" @if(in_array($v->id,$get['consulting'])) checked="" @endif>
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
            window.location.href='{{Session('lang')}}/setting-cp/confirmation';
        }else{
            alert('{{__('phrase.company-select')}}');
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

        $('#location').html(text.one.join(', '));
        $('#consulting').html(text.two.join(', '));
    }
    $('#location').hunterPopup({
        width: '750px',
        title: $('#location').attr('title'),
        content: $('#tableOne'),
        event:function(){
            var one = {id:[],text:[]};
            $('.one_').click(function(){ one = {id:[],text:[]}; adjust(); });
            function adjust() {
                $('.one_:checked').each(function(){
                    one.id.push($(this).val())
                    one.text.push(' '+$(this).attr('text'))
                })
                $('#location').html(one.text.join(', '));
                $('#location').next().val(one.id);
            }  
            $('.clear-list').click(function(){
                $('#location').html('')
                $('#location').next().val('')
                $('.one_:checked').prop('checked',false);
            })
        }
    })
    $('#consulting').hunterPopup({
        width: 750,
        title: $('#consulting').attr('title'),
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
                $('#consulting').html(one.text.join(', '));
                $('#consulting').next().val(one.id);
            }
            $('.clear-list').click(function(){
                $('#consulting').html('')
                $('#consulting').next().val('')
                $('.two_:checked').prop('checked',false);
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