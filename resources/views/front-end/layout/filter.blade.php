@php
    $bgImg = \App\Models\CategoryMd::where('key', $module)->select('image')->first();
    $path = str_replace('.jpg', '.webp', $bgImg->image);
@endphp
<link rel="stylesheet" href="slider/animate.min.css" media="all">
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/aos.css">
<script src="js/wow.min.js"></script>
<script src="js/aos.js"></script>
<script>
    new WOW().init();
    AOS.init();
</script>

{{-- Input filter --}}
<div id="mian-cover"
    style="background:url(images/category/4856489489489456-2.jpg) no-repeat top center; background-size:cover;">
    {{-- <div class="container">
        <div class="relative">
            <div data-wow-delay="0.1s" class="wow bounceInDown center">@lang("phrase.$module.title-industry")</div>
                <div class="bookmark-industry bold" data-aos="bounceInDown" style="background-color:#192F48">@l
            </div>
        </div>
    </div> --}}
    <div class="content">
        <div class="container">
            <div data-wow-delay="0.1s" class="box-title wow bounceInDown">
                {{-- <div class="main-keyword" style="background-color:#192F48">@lang("phrase.index.main-keyword")</div> --}}
                <div class="main-keyword" style="background-color:#192F48">@lang('phrase.index.main-keyword')</div>
                <h1>@lang("phrase.$module.caption")</h1>
                <div class="tag_banner">
                    <ul>
                        @if (is_array(__("phrase.$module.tag")))
                            @foreach (__("phrase.$module.tag") as $k => $t)
                                <li title="{{ $t }}" alt="{{ $t }}">{{ $t }}</li>
                            @endforeach
                        @endif
                    </ul>
                </div>
            </div>
            <div class="filter">
                <h2 class="header bold">
                    <i class="icofont-search-2"></i> @lang('phrase.search')
                    <span>@lang("phrase.$module.title-industry")</span>
                </h2>
                <div class="filter-form">
                    <form id="formFilters" class="bg-fluid" method="get">
                        <div class="row">
                            {{-- @if (count(@$filter->input) > 4)
                            <div class="col-md-4 col-lg-2 col-xs-12 d-block d-md-block">
                                <button type="button" class="btn btn-outline-primary search-advance" data-toggle="collapse" href="#collapseExample" aria-expanded="{{$expanded}}">@lang("phrase.index.search-advance")<i class="fas @if ($expanded === true)fa-caret-left @else fa-caret-down @endif fa-fw"></i></button>
                            </div>
                            @endif --}}
                            {{-- @php($colKeyword = count(@$filter->input)>4?'col-md-8 col-lg-10':'col-md-2 col-lg-12') --}}
                            <div class="col-md-2 col-lg-12 col-xs-12">
                                <div>
                                    <input type="text" name="keywords" id="keywords" class="form-control"
                                        placeholder="@lang('phrase.placeholder')" value="{{ Request::get('keywords') }}">
                                    <input type="hidden" name="submit" value="search">
                                </div>
                            </div>
                        </div>
                        <div class="row-1">
                            <div class="row">
                                @foreach ($filter->input as $k => $v)
                                    @if (@$v->type != '')
                                        @if ($v->type == 'checkbox')
                                            <div class="col-md-6 col-lg-3">
                                                <div class="input-group">
                                                    <label for="{{ $v->name }}" class="choice form-control ">
                                                        {{ $v->label }}
                                                        <input type="checkbox" id="{{ $v->name }}" class="filters"
                                                            name="{{ $v->name }}" value="1"
                                                            title="{{ $v->label }}"
                                                            @if (Request::get("$v->name") == 1) checked @endif>
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                        @if ($v->type == 'text')
                                            <div class="col-md-6 col-lg-3">
                                                <div class="input-group">
                                                    <span class="form-control " id="{{ $v->name }}"
                                                        title="{{ $v->label }}">{{ $v->label }}</span>
                                                    <input type="hidden" name="{{ $v->name }}" class="filters"
                                                        value="{{ Request::get("$v->name") }}">
                                                </div>
                                            </div>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        </div>
                        {{--  <div class="row">
                            @foreach ($filter->input as $k => $v)

                                @if ($v->type == 'checkbox')
                                    <div class="col-md-6 col-lg-3">
                                        <div class="input-group">
                                            <label for="{{$v->name}}" class="choice form-control "> {{$v->label}}
                                            <input type="checkbox" id="{{$v->name}}" class="filters" name="{{$v->name}}" value="1" title="{{$v->label}}" @if (Request::get("$v->name") == 1)checked @endif>
                                            </label>
                                        </div>
                                    </div>
                                @endif
                                @if ($v->type == 'text')
                                    <div class="col-md-6 col-lg-3">
                                        <div class="input-group">
                                            <span class="form-control " id="{{$v->name}}" title="{{$v->label}}">{{$v->label}}</span>
                                            <input type="hidden" name="{{$v->name}}" class="filters" value="{{Request::get("$v->name")}}">
                                        </div>
                                    </div>
                                @endif

                            @endforeach
                        </div> --}}


                        <div class="right-form">
                            <div class="row ">
                                <div class="col-lg-7 form-alert"></div>
                                <div class="col-5 col-md-4 col-lg-2">
                                    <a href="javascript:" class="btn btn-search mr-2 reset-all-filters"><i
                                            class="icofont-refresh"></i> @lang('phrase.reset')</a>
                                </div>
                                <div class="col-7 col-md-8 col-lg-3">
                                    <button type="submit" name="submit" class="btn btn-search --bg-blue"
                                        value="search"><i class="icofont-search-2 "></i> @lang('phrase.search')</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- Pop-up filter --}}
@foreach ($filter->filter as $key => $val)
    @php($request = explode(',', Request::get($key)))
    @if ($val)
        <div id="filter-{{ $key }}" style="display:none">
            <div class="row scroll-y"><br>
                @foreach ($val as $k => $v)
                    <div class="col-lg-4 col-xs-6">
                        <div class="qa-box">
                            <label for="{{ $key }}{{ $k }}">
                                <input type="checkbox" id="{{ $key }}{{ $k }}"
                                    name="{{ $key }}" class="choice {{ $key }}_"
                                    value="{{ $v->key }}" text="{!! $v->name ? $v->name : $v->name_th !!}"
                                    @if (@in_array($v->key, $request)) checked @endif>
                                &nbsp;{!! $v->name ? $v->name : $v->name_th !!}
                            </label>
                        </div>
                    </div>
                @endforeach
                <div class="clearfix"></div><br>
            </div>
            <div class="row">
                <div class="col-lg-12 popover-footer text-right">
                    <button class="btn btn-success ok-list">@lang('phrase.ok')</button>
                    <a href="javascript:" class="btn btn-danger clear-list">@lang('phrase.reset')</a>
                </div>
            </div>
        </div>
    @endif
@endforeach
