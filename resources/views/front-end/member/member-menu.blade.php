<div class="profile-edit">
    <div class="profile-img mt-3 mb-3">
        <figure class="snip1566">
            <img src="{{ @$row->logo }}" class="company-logo img-fluid">
            <figcaption><small><i class="fas fa-edit logo-edit"></i> @lang('phrase.member.edit')</small></figcaption>
            <a href="javascript:"></a>
        </figure>
    </div>
    <p class="mb-2">
        @if (Session('lang') == 'th')
            {{ @$row->name_th }}@else{{ @$row->name_jp }}
        @endif
    </p>
    <div class="box-button-change-profile">
        <a href="{{ Session('lang') }}/preview/company-profile/{{ $row->id }}" target="_blank">
            <button class="btn change-profile-image"><i class="icofont-eye-alt"></i> @lang('phrase.member.profile-preview')</button>
        </a>
    </div>
</div>

@if ($module != 'member')
    @php($path = '/{{ $module }}')
@else
    @php($path = '')
@endif

<div class="">
    <div class="user-submenu">
        <ul style="padding: 0; list-style: none;">
            <li>
                <a href="/{{ Session('lang') }}{{ $path }}/member/statistics/{{ $category }}/{{ $cid }}"
                    class="submenu-member loading_page">
                    <span class="member-menu-icon icon icon-pie-chart" width="20"></span>
                    <span class="member-menu-title">@lang('phrase.member.menu.statistics')</span>
                </a>
            </li>
            <li>
                <a href="/{{ Session('lang') }}{{ $path }}/member/information/{{ $category }}/{{ $cid }}"
                    class="submenu-member loading_page border-top">
                    <span class="member-menu-icon icon icon-building"></span>
                    <span class="member-menu-title">@lang('phrase.member.menu.b-info')</span>
                </a>
            </li>
            <li>
                <a href="/{{ Session('lang') }}{{ $path }}/member/profile/{{ $category }}/{{ $cid }}"
                    class="submenu-member loading_page border-top">
                    <span class="member-menu-icon icon icon-profile"></span>
                    <span class="member-menu-title">@lang('phrase.member.menu.c-profile')</span>
                </a>
            </li>
            <li>
                <a href="/{{ Session('lang') }}{{ $path }}/member/contact/{{ $category }}/{{ $cid }}"
                    class="submenu-member loading_page border-top">
                    <span class="member-menu-icon icon icon-pin"></span>
                    <span class="member-menu-title">@lang('phrase.member.menu.c-info')</span>
                </a>
            </li>
            <li>
                <a href="/{{ Session('lang') }}{{ $path }}/member/contact-email/{{ $category }}/{{ $cid }}"
                    class="submenu-member loading_page border-top">
                    <span class="member-menu-icon icon icon-contact"></span>
                    <span class="member-menu-title">@lang('phrase.member.menu.c-email')</span>
                </a>
            </li>
            <li>
                <a href="/{{ Session('lang') }}{{ $path }}/member/activity/{{ $category }}/{{ $cid }}"
                    class="submenu-member loading_page border-top">
                    <span class="member-menu-icon icon icon-news"></span>
                    <span class="member-menu-title">@lang('phrase.member.menu.activity-news')</span>
                </a>
            </li>
            @if (@$myPackage['data']->popup)
                <li>
                    <a href="/{{ Session('lang') }}{{ $path }}/member/sms-history/{{ $category }}/{{ $cid }}"
                        class="submenu-member loading_page border-top">
                        <span class="member-menu-icon icon icon-sms-message"></span>
                        <span class="member-menu-title">SMS History</span>
                    </a>
                </li>
            @endif
            <li>
                <a href="javascript:" class="submenu-member loading_page border-top">
                    <span class="member-menu-icon icon icon-setting"></span>
                    <span class="member-menu-title">@lang('phrase.member.menu.setting')</span>
                    <span class="position-absolute" style="right: 10px;"><i class="fas fa-chevron-left"></i></span>
                </a>
                <div class="nav flex-column menu-child d-none">
                    {{-- <a class="pl-5" href="/{{Session('lang')}}{{$path}}/member/setting/name"><span class="member-menu-title pl-0">Name</span></a> --}}
                    <a class="pl-5" href="/{{ Session('lang') }}{{ $path }}/member/setting/email/{{ $category }}/{{ $cid }}"><span
                            class="member-menu-title pl-0">@lang('phrase.member.menu.email')</span></a>
                    <a class="pl-5" href="/{{ Session('lang') }}{{ $path }}/member/setting/password/{{ $category }}/{{ $cid }}"><span
                            class="member-menu-title pl-0">@lang('phrase.member.menu.password')</span></a>
                </div>
            </li>
            <li>
                <a href="/{{ Session('lang') }}{{ $path }}/member/logout"
                    class="submenu-member submenu-logout border-top">
                    <span class="member-menu-icon icon icon-logout"></span>
                    <span class="member-menu-title">@lang('phrase.member.menu.logout')</span>
                </a>
            </li>
        </ul>
    </div>
</div>
