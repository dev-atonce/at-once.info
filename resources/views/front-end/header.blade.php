<div class="overlay">
</div>
<nav id="sidebar">
    <div id="dismiss"><i class="icofont-close"></i></div>
    <div class="sidebar-header">At Once </div>
    <ul class="list-unstyled components mb-0" style="height: calc(100vh - 140px);">
        <li>
            <div class="collapsible-body">
                @php
                    $language = ['Arabic', 'Bengali', 'Chinese (Simplified)', 'Chinese (Traditional)', 'English', 'French', 'German', 'Hindi', 'Indonesian', 'Italian', 'Japanese', 'Javanese', 'Korean', 'Lao', 'Malay', 'Marathi', 'Myanmar (Burmese)', 'Portuguese', 'Punjabi', 'Russian', 'Spanish', 'Tamil', 'Telugu', 'Vietnamese'];
                    $home = @$categoryName != '' ? $categoryName : __('phrase.home');
                    $md = @$module != '' ? '/' . @$module : '';
                    $hbtn = @$categoryId == '' ? Session('lang') : Session('lang') . $md;
                    $blog_path = @$categoryId == '' ? Session('lang') . '/blog' : Session('lang') . $md . '/blog';
                @endphp
            </div>
        <li>
            <a href="{{ @$hbtn }}" aria-label="Go to home page">
                <img src="img/home.svg" alt="Home icon" width="16" height="16" loading="lazy" style="margin-top: -6px;">
                @if (@$categoryName != '')
                    {{ @$categoryName }}
                @else
                    @lang('phrase.home')
                @endif
                <span class="sr-only">(current)</span>
            </a>
        </li>
        <li><a href="{{ url(Session('lang') . '/about-us') }}" aria-label="Learn more about us">@lang('phrase.header.about')</a></li>
        {{-- <li>
            <a class="nav-link" href="{{ url(Session('lang') . '/category') }}">หมวดหมู่ธุรกิจ</a>
        </li> --}}
        <li>
            <a href="#menuBlog" data-toggle="collapse" aria-expanded="false"
                class="dropdown-toggle">@lang('phrase.header.blog')</a>
            <ul class="collapse list-unstyled" id="menuBlog">
                <a href="{{ Session('lang') }}/blog" data-href="/blog" aria-label="Read At-Once blog articles">@lang('phrase.header.at-once-blog')</a>
                <a href="{{ Session('lang') }}/blog-company"
                    data-href="/blog-company" aria-label="Read customer blog articles">@lang('phrase.header.customer-blog')</a>
                <a href="{{ Session('lang') }}/blog-package" data-href="/blog-package" aria-label="Read marketing blog articles">@lang('phrase.header.marketing-blog')</a>
            </ul>
        </li>
        {{-- <li><a href="{{ url(Session('lang') . '/new-promotion-package') }}">@lang('phrase.header.advertising-rate')</a></li> --}}
        <li><a href="{{ url(Session('lang') . '/promotion-package') }}" aria-label="View advertising rates and packages">@lang('phrase.header.advertising-rate')</a></li>
        <li><a href="{{ url(Session('lang') . '/faq') }}" aria-label="FAQ">@lang('phrase.header.faq')</a></li>
        {{-- <li><a href="{{ url(Session('lang') .'/contact') }}">@lang('phrase.header.free-profile')</a></li> --}}
    </ul>
    {{-- <ul class="list-unstyled CTAs">
		<div class="cate-menu-block-head-no mb-2">
			<div class="text-center"><i class="icofont-globe"></i>Language</div>
		</div>
		<div class="row">
			<div class="col-6 pr-1"><a href="{{url("logistic/set/lang/th")}}" class="article mr-2"><img src="images/flag_th.jpg"> ไทย</a></div>
			<div class="col-6 pl-1"><a href="{{url("logistic/set/lang/jp")}}" class="article"><img src="images/flag_jp.jpg"> Japan</a></div>
		</div>
	</ul> --}}
    <div class="sidebar-footer d-flex justify-content-center align-items-center">
        <div class="btn-group btn-block" style="height: 70px; width: 100px; margin-left: -35px; margin-top: 15px;">
            <div id="google_translate_element2"></div>
        </div>
    </div>

    @php
        $lng['th'] = 'ภาษาไทย';
        $lng['jp'] = '日本語';
        $flag = Session('lang') == 'jp' ? 'jp' : 'th';
        $change = Session('lang') == 'jp' ? 'th' : 'jp';
        // $blog_path = ($module=='blog'||$module!='about-us'||$module!='news'||$module!='promotion-package')?"blog":"$module/blog";
        $lang = Session('lang') ? Session('lang') : 'th';
    @endphp
</nav>

@php($loginPath = 'login')
<div id="topheader">
    <nav class="navbar navbar-light navbar-expand-lg navbar-light header --border-b2-orange">
        <div class="container">
            <a class="navbar-brand mx-auto bold" href="{{ Session('lang') }}" aria-label="At-Once homepage">
                {{-- <img src="img/at-once-black.png" class="d-inline-block align-top at-logo img-fluid" alt="At-Once ค้นหาบริษัทและธุรกิจต่างๆ ในประเทศไทย" ><br> --}}
                <img src="img/at-once-tw.webp" class="d-inline-block align-top at-logo img-fluid"
                    alt="At-Once ค้นหาบริษัทและธุรกิจต่างๆ ในประเทศไทย" loading="lazy"><br>
            </a>
            <a id="sidebarCollapse" class=" d-lg-none navbar-toggler-right"><span
                    class="navbar-toggler-icon"></span></a>
            <ul class="attributes d-block d-lg-none">
                <li class="nav-item n-left header-mb d-flex">
                    <div class="nav-item dropdown ">
                        <a class="" id="navbarDropdownMenuLink" data-toggle="dropdown" href="#">
                            <i class="fa fa-user-circle"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right dropdown-proflie"
                            aria-labelledby="navbarDropdownMenuLink">
                            @if (!Auth::guard('Members')->check())
                                <a class="dropdown-item" href="javascript:"
                                    data-target="#signInContent">@lang('phrase.sign-in')</a>
                                {{-- <a class="dropdown-item" href="javascript:"
                                    data-target="#signUpContent">@lang('phrase.sign-up')</a> --}}
                            @else
                                <a class="dropdown-item" href="/{{ Session('lang') }}/member/category"> <span
                                        class="member-menu-icon icon icon-pie-chart"></span> @lang('phrase.header.visit-profile')</a>
                                <!-- <a class="dropdown-item" href="/{{ Session('lang') }}/member/setting/password">Change password</a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="/{{ Session('lang') }}/member/logout"> <span
                                        class="member-menu-icon icon icon-logout"></span> Logout</a>
                            @endif
                        </div>
                    </div>
                </li>
            </ul>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link bold mian-menu" href="{{ $hbtn }}" aria-label="Go to home page">
                            <img src="img/home.svg" alt="Home icon" width="16" height="16" loading="lazy" style="margin-top: -6px;">
                            @if (@$categoryName != '')
                                {{ @$categoryName }}
                            @else
                                @lang('phrase.home')
                            @endif
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link bold"
                            href="{{ url(Session('lang') . '/about-us') }}" aria-label="Learn more about us">@lang('phrase.header.about')</a></li>
                    {{-- nav-item dropdown dropdown-animate --}}
                    {{-- <li class="nav-item position-static">
                        <a class="nav-link" href="{{ url(Session('lang') . '/category') }}">หมวดหมู่ธุรกิจ</a>
                    </li> --}}
                    <!-- <li class="nav-item"><a class="nav-link bold" href="{{ $blog_path }}">@lang('phrase.header.blog')</a></li> -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            @lang('phrase.header.blog')
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ Session('lang') }}/blog" data-href="/blog" aria-label="Read At-Once blog articles">@lang('phrase.header.at-once-blog')</a>
                            <a class="dropdown-item" href="{{ Session('lang') }}/blog-company"
                                data-href="/blog-company" aria-label="Read customer blog articles">@lang('phrase.header.customer-blog')</a>
                            <a class="dropdown-item" href="{{ Session('lang') }}/blog-package"
                                data-href="/blog-package" aria-label="Read marketing blog articles">@lang('phrase.header.marketing-blog')</a>
                        </div>
                    </li>
                    {{-- <li class="nav-item"><a class="nav-link bold" href="{{ url(Session('lang') . '/new-promotion-package') }}">@lang('phrase.header.advertising-rate')</a></li> --}}
                    <li class="nav-item"><a class="nav-link bold" href="{{ url(Session('lang') . '/promotion-package') }}" aria-label="View advertising rates and packages">@lang('phrase.header.advertising-rate')</a></li>
                    <li class="nav-item"><a class="nav-link bold" href="{{ url(Session('lang') . '/faq') }}" aria-label="FAQ">@lang('phrase.header.faq')</a></li>
                    {{-- <li class="nav-item"><a class="nav-link bold" href="{{ Session('lang') }}/contact">@lang('phrase.header.free-profile')</a></li> --}}
                </ul>
                <ul class="navbar-nav ml-auto icon-profile">
                    @if (!Auth::guard('Members')->check())
                        <li class="nav-item member-btn"><a class="nav-link btn-member-login color"
                                href="{{ Session('lang') }}/{{ $loginPath }}" aria-label="Sign in to your account">
								@lang('phrase.sign-in')</a></li>
                    @else
                        <li class="dropdown ">
                            <a class="nav-link nav-link-profile btn-member-login" id="navbarDropdownMenuLink"
                                data-toggle="dropdown" href="#" aria-label="User profile menu">
                                <i class="fa fa-user-circle"></i> @lang('phrase.header.profile')
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-proflie"
                                aria-labelledby="navbarDropdownMenuLink">
                                <a class="dropdown-item" href="/{{ Session('lang') }}/member/category" aria-label="Manage business categories"> <span
                                        class="member-menu-icon icon icon-pie-chart"></span> @lang('phrase.business-category')</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item " href="/{{ Session('lang') }}/member/logout" aria-label="Sign out of your account"><span
                                        class="member-menu-icon icon icon-logout"></span> Logout</a>
                            </div>
                        </li>
                    @endif
                    {{-- <li class="nav-item">
						<div class="btn-group">
							<button class="btn btn-primary dropdown-toggle lang-btn skiptranslate" type="button" data-toggle="dropdown" aria-expanded="false">
								Language
							</button>
							<div class="dropdown-menu language dropdown-menu-lg-right" style="max-height: 40vh; overflow-y:auto;">
								<a class="dropdown-item skiptranslate translation-links" href="set/lang/th" data-bs-auto-close="outside">
                                    <img src="flags/th.png" class="mr-2" alt="Thai flags">Thai
                                </a>
								<a class="dropdown-item skiptranslate translation-links" href="set/lang/en" data-bs-auto-close="outside">
                                    <img src="flags/gb.png" class="mr-2" alt="English flags">English
                                </a>
								<a class="dropdown-item skiptranslate translation-links" href="set/lang/jp" data-bs-auto-close="outside">
                                    <img src="flags/jp.png" class="mr-2" alt="Japanese flags">Japanse
                                </a>
								<a class="dropdown-item skiptranslate translation-links" href="set/lang/zh" data-bs-auto-close="outside">
                                    <img src="flags/cn.png" class="mr-2" alt="Chinese flags">Chinese
                                </a>

							</div>
						</div>
					</li> --}}
                    {{-- <ul class="list-unstyled CTAs">
                        <div class="cate-menu-block-head-no mb-2">
                            <div class="text-center"><i class="icofont-globe"></i>Language</div>
                        </div>
                        <div class="row">
                            <div class="col-6 pr-1"><a href="{{url("logistic/set/lang/th")}}" class="article mr-2"><img src="images/flag_th.jpg"> ไทย</a></div>
                            <div class="col-6 pl-1"><a href="{{url("logistic/set/lang/jp")}}" class="article"><img src="images/flag_jp.jpg"> Japan</a></div>
                        </div>
                    </ul> --}}
                    <li class="nav-item member-btn">
                        <div id="google_translate_element"></div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
