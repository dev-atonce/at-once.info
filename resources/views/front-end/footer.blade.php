<a href="#" id="back-to-top" title="Back to top"><i class="icofont-thin-up"></i></a>


@php
    $lang = Session('lang') ? Session('lang') : 'th';
    $hbtn = @$categoryId == '' ? $lang : $lang . "/$module";
    $condition_path = @$categoryId == '' ? 'condition' : "$module/condition";
    $policy_path = @$categoryId == '' ? 'privacy-policy' : "$module/privacy-policy";
    $blog_path = @$categoryId == '' ? $lang . '/blog' : $lang . "/$module/blog";
@endphp

@if (Request()->segment(3) == 'cp')
    <section id="footer" @if (@$err === 404) style="bottom:0;width:100%;" @endif>
        <div class="container footer-cp">
            <div class="detail">
                <div class="row" style="align-items: center;">

                    <style>
                        .btn-back {
                            padding: 8px 30px;
                            border-radius: 30px;
                            background-color: var(--v1-blue);
                            border: solid 1px var(--v1-blue);
                        }
                    </style>
                    <div class="col-4 col-md-6 col-lg-6 pr-1">
                        <ul class="sitemap mb-0">
                            <li class="list-item">
                                <a href="{{ url($lang) }}" target="_self" class="btn btn-back link link--primary">
                                    <span class="link__title"><i class="icofont-arrow-left"></i>
                                        @lang('phrase.home')</span>
                                </a>
                            </li>
                            @if (@!$customerStatus)
                                <li class="list-item">
                                    <a href="{{ url($lang) }}/about-us" target="_self" class="link link--primary">
                                        <span class="link__title">@lang('phrase.header.about')</span>
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a href="{{ $blog_path }}" target="_self" class="link link--primary">
                                        <span class="link__title">@lang('phrase.header.blog')</span>
                                    </a>
                                </li>
                                <li class="list-item">
                                    <a href="{{ url($lang) }}/news" target="_self" class="link link--primary">
                                        <span class="link__title">@lang('phrase.news')</span>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-8 col-md-6 col-lg-6">
                        <div class="row @if (@!$customerStatus) '' @else justify-content-end @endif">
                            @if (@!$customerStatus)
                                <div class="col-12 col-md-12 col-lg-6 mb-3 mb-lg-0">
                                    <a href="{{ url($lang) }}/category" class="btn btn-border d-block"><i
                                            class="icofont-search-2"></i> @lang('phrase.search-business')</a>
                                </div>
                            @endif
                            <div class="col-12 col-md-12 col-lg-6">
                                <a href="{{ url($lang . '/promotion-package') }}" class="btn btn-orange d-block">
                                    <span class="link__title">@lang('phrase.advertise')</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="border-top: 1px solid rgb(255 255 255 / 10%);">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <!-- <span>@lang('phrase.footer.copyright') {{ date('Y') }} {{ env('APP_NAME') }} | @lang('phrase.footer.reserved')</span> -->
                    <span> Copyright 2022 1-CE WIND CO., LTD. | All rights reserved.</span><a
                        href="http://www.trustmarkthai.com/callbackData/popup.php?data=9a2-18-6-253d529d70a8c51101033f0566fe7d4165dd1cfbbf4&markID=firstmar"
                        class="ml-2"><img src="img/dbd-logo.svg"></a>
                </div>
                <div class="col-12 col-md-12 col-lg-6">
                    <ul class="list-menu">
                        <li class="list-item">
                            <a href="{{ url($lang) }}/{{ $condition_path }}" target="_self"
                                class="link link--primary">
                                <span class="link__title">@lang('phrase.footer.terms-conditions')</span>
                            </a>
                        </li>
                        <li class="list-item">
                            <a href="{{ url($lang) }}/{{ $policy_path }}" target="_self"
                                class="link link--primary">
                                <span class="link__title">@lang('phrase.footer.privacy-policy')</span>
                            </a>
                        </li>
                        <!-- <a href="javascript:" onclick="destroy()">Clear</a> -->
                    </ul>
                </div>
            </div>
        </div>
    </section>
@else
    <section id="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-2">
                    <div class="mb-1"><img src="img/at-once-tw.png" width="150" alt="{{ env('APP_NAME') }}"></div>
                </div>
                <div class="col-md-5 col-lg-4">
                    <p class="mb-0"><strong class="v1-orange" style="font-size: 24px;">{{__('phrase.app_name')}} </strong>
                    </p>
                    <p> {{__('phrase.footer.caption-upper')}} <br class="d-none d-lg-block">
                        {{__('phrase.footer.caption-lower')}}</p>
                </div>
                <div class="d-md-none d-lg-block col-lg-1"></div>
                <div class="col-5 col-md-3 col-lg-2 pl-md-4">
                    <ul class="sitemap mb-0 mb-lg-2">
                        <li class="list-item">
                            <a href="{{ url($lang) }}" target="_self" class="link link--primary">
                                <span class="link__title">@lang('phrase.home')</span>
                            </a>
                        </li>
                        <li class="list-item">
                            <a href="{{ url($lang) }}/about-us" target="_self" class="link link--primary">
                                <span class="link__title">@lang('phrase.header.about')</span>
                            </a>
                        </li>
                        <li class="list-item">
                            <a href="{{ $blog_path }}" target="_self" class="link link--primary">
                                <span class="link__title">@lang('phrase.header.blog')</span>
                            </a>
                        </li>
                        <li class="list-item">
                            <a href="{{ url($lang) }}/contact" class="link link--primary">
                                <span class="link__title">@lang('phrase.footer.contact-us')</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-7 col-md-4 col-lg-3">
                    <div class="vertical-table disp-p none-absolute">
                        <div class="vertical-align-middle-xs">
                            <ul class="sitemap">
                                <li class="list-item">
                                    <a href="{{ url($lang) }}#section-categories"
                                        class="btn btn-border d-block"><i class="icofont-search-2"></i>
                                        @lang('phrase.search-business')</a>
                                </li>
                            </ul>
                            <a href="{{ url($lang . '/promotion-package') }}#ContactForm"
                                class="btn btn-orange mt-3 d-block">
                                <span class="link__title">@lang('phrase.advertise')</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <hr style="border-top: 1px solid rgb(255 255 255 / 10%);">
            <div class="row">
                <div class="col-12 col-lg-6">
                    <span> Copyright 2022 1-CE WIND CO., LTD. | All rights reserved.</span>
                    <a href="http://www.trustmarkthai.com/callbackData/popup.php?data=9a2-18-6-253d529d70a8c51101033f0566fe7d4165dd1cfbbf4&markID=firstmar"
                        class="ml-2"><img src="img/dbd-logo.svg"></a>
                </div>
                <div class="col-12 col-lg-6">
                    <ul class="list-menu">
                        <li class="list-item">
                            <a href="{{ url($lang) }}/{{ $condition_path }}" target="_self"
                                class="link link--primary">
                                <span class="link__title">@lang('phrase.footer.terms-conditions')</span>
                            </a>
                        </li>
                        <li class="list-item">
                            <a href="{{ url($lang) }}/{{ $policy_path }}" target="_self"
                                class="link link--primary">
                                <span class="link__title">@lang('phrase.footer.privacy-policy')</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endif

@php(\App\Helpers\Clicks::__index())
