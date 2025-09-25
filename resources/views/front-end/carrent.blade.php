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

    <title>@lang('phrase.carrent-caption')</title>

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
            background: url('images/index_bg01.jpg') top no-repeat ;
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
        /* .lang-bar a{
            float: left;;
        } */
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
                        <a class="text-dark" href="{{url('translate/set/lang/jp')}}">日本語</a> <span class="text-dark">|</span> <a class="text-dark" href="{{url('translate/set/lang/th')}}">ภาษาไทย</a>
                    </div>
                </div>
                <div class="col-lg-12 mt-5">
                    <span class="btn btn-outline-dark btn-sm float-right">@lang('phrase.how-to')</span>
                    <h3 class="search-header text-white f-400">@lang('phrase.carrent-caption')</h3>                    
                </div>
            </div>
            <div class="search-content">
                <div class="form-search">         
                    <form action="" method="get">           
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>@lang('phrase.car-type')</label>
                                    <span class="form-control" id="type" title="@lang('phrase.car-type')"></span>
                                    <input type="hidden" name="type"  value="{{Request::get('type')}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>@lang('phrase.location')</label>
                                    <span class="form-control" id="location" title="@lang('phrase.location')"></span>
                                    <input type="hidden" name="location"  value="{{Request::get('location')}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>@lang('phrase.contract-period')</label>
                                    <span class="form-control" id="period" title="@lang('phrase.contract-period')"></span>
                                    <input type="hidden" name="period"  value="{{Request::get('period')}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>@lang('phrase.other-conditions')</label> 
                                    <span class="form-control" id="other-conditions" title="@lang('phrase.contract-period')"></span>
                                    <input type="hidden" name="other-conditions" value="{{Request::get('other-condition')}}">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <input type="submit" name="submit" class="btn btn-success btn-block" value="@lang('phrase.search')">
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
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="select-all">
                            <label class="custom-control-label" for="select-all">@lang('phrase.select-all')</label>
                        </div>
                        @if(count($company)>0)

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
    $lang = Session('lang');
    $langPro = (Session('lang')=='jp')?'en':'th';
    $get['type'] = explode(',',Request::get('type'));
    $get['location'] = explode(',',Request::get('location'));
    $get['period'] = explode(',',Request::get('period'));
    $get['other-conditions'] = explode(',',Request::get('other-conditions'));
@endphp
<div id="tableOne" style="display:none">
    <div class="row scroll-y"><br>
        @foreach(\App\Models\ChoiceMd::select('id','key',"name_$lang as name")->where('type','car')->get() as $k => $v)
        <div class="col-lg-6 col-xs-6">                
            <div class="qa-box">
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input one_" id="one_{{$k}}" name="language[]" value="{{$v->id}}" text="{!!$v->name!!}" @if(in_array($v->id,$get['type'])) checked="" @endif>
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
        @foreach(\App\Models\ProvinceMd::select('province_id as id',"province_name_$langPro as name")->get() as $k => $v)
        <div class="col-lg-6 col-xs-6">                
            <div class="qa-box">
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input two_" id="two_{{$k}}" name="speciality[]" value="{{$v->id}}" text="{!!$v->name!!}" @if(in_array($v->id,$get['location'])) checked="" @endif>
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
<div id="tableThree" style="display:none">
    <div class="row scroll-y"><br>
        @foreach(\App\Models\ChoiceMd::select('id','key',"name_$lang as name")->where('type','contract-period')->get() as $k => $v)
        <div class="col-lg-6 col-xs-6">                
            <div class="qa-box">
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input three_" id="three_{{$k}}" name="status[]" value="{{$v->key}}" text="{!!$v->name!!}" @if(in_array($v->key,$get['period'])) checked="" @endif>
                    <label class="custom-control-label" for="three_{{$k}}">{!!$v->name!!}</label>
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
<div id="tableFour" style="display:none">
    <div class="row scroll-y"><br>
        @foreach(\App\Models\ChoiceMd::select('id','key',"name_$lang as name")->where('type','other-conditions')->get() as $k => $v)
        <div class="col-lg-6 col-xs-6">                
            <div class="qa-box">
                <div class="custom-control custom-checkbox mb-3">
                    <input type="checkbox" class="custom-control-input four_" id="four_{{$k}}" name="status[]" value="{{$v->key}}" text="{!!$v->name!!}" @if(in_array($v->key,$get['other-conditions'])) checked="" @endif>
                    <label class="custom-control-label" for="four_{{$k}}">{!!$v->name!!}</label>
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
            window.location.href='{{Session('lang')}}/carrent/confirmation';
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
        $('.three_:checked').each(function(i,v){ text.three.push($(this).attr('text')); })
        $('.four_:checked').each(function(i,v){ text.four.push($(this).attr('text')); })

        $('#type').html(text.one.join(', '));
        $('#location').html(text.two.join(', '));
        $('#period').val(text.three.join(', '));
        $('#other-conditions').val(text.four.join(', '));
        // $('#status').html(text.five.join(', '));
    }
    $('#type').hunterPopup({
        width: '750px',
        title: $('#type').attr('title'),
        content: $('#tableOne'),
        event:function(){
            var one = {id:[],text:[]};
            $('.one_').click(function(){ one = {id:[],text:[]}; adjust(); });
            function adjust() {
                $('.one_:checked').each(function(){
                    one.id.push($(this).val())
                    one.text.push(' '+$(this).attr('text'))
                })
                $('#type').html(one.text.join(', '));
                $('#type').next().val(one.id);
            }  
            $('.clear-list').click(function(){
                $('#type').html('')
                $('#type').next().val('')
                $('.one_:checked').prop('checked',false);
            })
        }
    })
    $('#location').hunterPopup({
        width: 750,
        title: $('#location').attr('title'),
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
                $('#location').html(one.text.join(', '));
                $('#location').next().val(one.id);
            }
            $('.clear-list').click(function(){
                $('#location').html('')
                $('#location').next().val('')
                $('.two_:checked').prop('checked',false);
            })
        }
    })
    $('#period').hunterPopup({
        // width: 750,
        title: $('#period').attr('title'),
        content: $('#tableThree'),
        placement: 'right',
        event:function(){
            var one = {id:[],text:[]};
            $('.three_').click(function(){ one = {id:[],text:[]}; adjust(); });
            function adjust() {
                $('.three_:checked').each(function(){
                    one.id.push($(this).val())
                    one.text.push(' '+$(this).attr('text'))
                })
                $('#period').html(one.text.join(', '));
                $('#period').next().val(one.id);
            }  
            $('.clear-list').click(function(){
                $('#period').html('')
                $('#period').next().val('')
                $('.three_:checked').prop('checked',false);
            })
        }
    })
    $('#other-conditions').hunterPopup({
        width: 700,
        title: $('#other-conditions').attr('title'),
        content: $('#tableFour'),
        placement: 'left',
        event:function(){
            var one = {id:[],text:[]};
            $('.four_').click(function(){ one = {id:[],text:[]}; adjust(); });
            function adjust() {
                $('.four_:checked').each(function(){
                    one.id.push($(this).val())
                    one.text.push(' '+$(this).attr('text'))
                })
                $('#other-conditions').html(one.text.join(', '));
                $('#other-conditions').next().val(one.id);
            }  
            $('.clear-list').click(function(){
                $('#other-conditions').html('')
                $('#other-conditions').next().val('')
                $('.four_:checked').prop('checked',false);
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