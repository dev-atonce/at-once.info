<div class="c-sidebar-brand">
    <img class="c-sidebar-brand-minimized"><i class=" fas fa-toolbox fa-lg">&nbsp;</i>
    <h5 class="c-sidebar-brand-ful" style="margin-bottom:0px;">Webpanel</h5>
</div>
<ul class="c-sidebar-nav">
    <li class="c-sidebar-nav-title mt-0"></li>
    {{-- @if (Auth::user()->role != 'staff') --}}
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url("$prefix/dashboard") }}"><i
                    class="c-sidebar-nav-icon fas fa-tachometer-alt fa-fw"></i>Dashboard{{-- <span class="badge badge-info">NEW</span> --}}</a></li>
    {{-- @endif --}}
    {{-- @if (Auth::user()->role != 'staff')
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url("$prefix/web-traffic") }}"><i
                    class="c-sidebar-nav-icon fas fa-chart-line fa-fw"></i>Website Traffic</a>
        <li>
    @endif
    @if (Auth::user()->role != 'staff')
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url("$prefix/statistics") }}"><i
                    class="c-sidebar-nav-icon fas fa-chart-bar"></i>Statistics</a></li>
    @endif
    @if (Auth::user()->role != 'staff')
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url("$prefix/job-progress") }}"><i
                    class="c-sidebar-nav-icon fas fa-layer-group fa-fw"></i>Job Progress</a></li>
    @endif --}}
    {{-- @if (Auth::user()->role != 'staff') --}}
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url("$prefix/my-job") }}"><i
                    class="c-sidebar-nav-icon fas fa-briefcase fa-fw"></i>My Jobs</a></li>
    {{-- @endif --}}
    {{-- @if (Auth::user()->role != 'staff')
        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url("$prefix/copyright") }}"><i
                    class="c-sidebar-nav-icon fas fa-copyright fa-fw"></i>Copyright</a></li>
    @endif

        <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ url("$prefix/allcategory") }}"><i
                    class="c-sidebar-nav-icon far fa-building fa-fw"></i>All Category</a></li> --}}
    {{-- @if (Auth::user()->role != 'staff') --}}
        <li class="c-sidebar-nav-title">Front-end</li>
        {{-- @endif --}}
    @php
        $menu = \App\Models\MenuMd::select(['tb_menu.*', 'pe.read', 'pe.write', 'pe.execute'])
            ->where(['tb_menu.position' => 'main', 'tb_menu.status' => 'on', 'pe.user' => Auth::user()->id, 'pe.read' => true])
            ->leftJoin('menu_permission as pe', 'tb_menu.id', '=', 'pe.menu')
            ->orderBy('sort')
            ->get();
    @endphp
    @foreach ($menu as $i => $m)
        @php
            $second = \App\Models\MenuMd::where(['_id' => $m->id, 'position' => 'secondary'])
                ->orderBy('sort')
                ->get();
            $count = '';
            $notiBlog = '';
            if ($second) {
                if ($m->name == 'Blog') {
                    $notiBlog = \App\Models\BlogMd::select('id')
                        ->where(['type' => 'selfedit', 'status' => 0])
                        ->count();
                    $count = \App\Models\BlogMd::select('id')->count();
                }
                if ($m->name == 'Company') {
                    $count = \App\Models\CompanyMd::select('id')->count();
                }
                if ($m->name == 'Popup Approve') {
                    $count = \App\Models\SMSHistoryMd::select('id')->whereNull('status')->count();
                }
            }
        @endphp
        <li class="c-sidebar-nav-item @if ($second) c-sidebar-nav-dropdown @endif @if ($m->position == 'main' && $m->name == 'Company') four-cubcategories @endif">
            <a class="c-sidebar-nav-link @if (count($second) > 0) c-sidebar-nav-dropdown-toggle @endif"
                @if($m->url) href="{{ $prefix }}{!! $m->url !!}"@endif><i class="c-sidebar-nav-icon {!! $m->icon !!}"></i> {{ $m->name }}
                    @if ($notiBlog > 0) <span class='badge badge-danger'><i class='fas fa-exclamation-circle mr-1'></i>{{ @$notiBlog }}</span> @endif
                    <span class='badge badge-success @if ($notiBlog > 0) ml-1 @endif'>{{ @$count }}</span>
            </a>
            @if (count($second) > 0)
                <ul class="c-sidebar-nav-dropdown-items">
                    @foreach ($second as $ks => $vs)
                        @php
                            $third = \App\Models\MenuMd::where(['_id' => $vs->id, 'position' => 'third'])
                                ->orderBy('sort')
                                ->get();
                            $subCount = '';
                            $category = \App\Models\CategoryMd::select('id')
                                ->where('name_jp', $vs->name)
                                ->first();
                            if ($m->name == 'Blog') {
                                $subCount =
                                    "<span class='badge badge-success'>" .
                                    DB::table('blog')
                                        ->where('category', @$category->id)
                                        ->count() .
                                    '</span>';
                            }
                            $countVs = '';
                            if ($vs->name == 'Popup Approve') {
                                $countVs = \App\Models\SMSHistoryMd::select('id')->whereNull('status')->count();
                            }
                        @endphp
                        <li class="c-sidebar-nav-item @if ($third->count() > 0) c-sidebar-nav-dropdown sub-secondary @endif">
                            @if ($vs->url == '/blog-type/promotion-package')
                                @php($subCount = "<span class='badge badge-success'>" . \App\Models\BlogMd::where('type', 'marketing-blog')->count() . '</span>')
                            @elseif ($vs->url == '/blog-type/customer')
                                @php($subCount = "<span class='badge badge-success'>" . \App\Models\BlogMd::where('type', 'customer')->count() . '</span>')
                            @endif
                            <a class="c-sidebar-nav-link @if ($third->count() > 0) c-sidebar-nav-dropdown-toggle @endif"
                                @if($vs->url)href="{{ $prefix }}{{ $vs->url }}"@endif>{{ $vs->name }}
                                {!! $subCount !!}
                                <span class='badge badge-success'>{{ @$countVs }}</span>
                            </a>
                            @if ($third->count() > 0)
                                <ul class="c-sidebar-nav-dropdown-items">
                                    @foreach ($third as $krd => $vrd)
                                        @php($fourth = \App\Models\MenuMd::where(['position' => 'fourth', '_id' => $vrd->id, 'status' => 'on'])->orderBy('sort')->get())
                                        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown sub-fourth">
                                            <a class="c-sidebar-nav-link @if ($fourth->count() > 0) c-sidebar-nav-dropdown-toggle @endif">{{ $vrd->name }}</a>
                                            @if ($fourth->count() > 0)
                                                <ul class="c-sidebar-nav-dropdown-items">
                                                    @foreach ($fourth as $kth => $vth)
                                                        <li class="c-sidebar-nav-item"><a
                                                                class="c-sidebar-nav-link fourth"
                                                                href="{{ $prefix }}{{ $vth->url }}">{{ $vth->name }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </li>
                    @endforeach
                </ul>
            @endif
        </li>
    @endforeach

    @if (Auth::user()->role == 'developer')
        <li class="c-sidebar-nav-title">Administrator</li>
        <li class="c-sidebar-nav-item c-sidebar-nav-dropdown">
            <a class="c-sidebar-nav-link c-sidebar-nav-dropdown-toggle" href="#"><i
                    class="c-sidebar-nav-icon fas fa-sliders-h"></i> Setting</a>
            <ul class="c-sidebar-nav-dropdown-items">
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ $prefix }}/users"><span
                            class="c-sidebar-nav-icon"></span> Users</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link" href="{{ $prefix }}/menu"><span
                            class="c-sidebar-nav-icon"></span> Menu</a></li>
                <li class="c-sidebar-nav-item"><a class="c-sidebar-nav-link"
                        href="{{ $prefix }}/business-category"><span class="c-sidebar-nav-icon"></span>Business
                        Category</a></li>
            </ul>
        </li>
    @endif
    <li class="c-sidebar-nav-divider"></li>
</ul>
<button class="c-sidebar-minimizer c-class-toggler" style="display:grid; align-items: center;" type="button"
    data-target="_parent" data-class="c-sidebar-minimized"></button>
