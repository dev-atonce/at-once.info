<style>
    .slick-dots li button:before {
        color: #192F48 !important;
    }

    #section-top {
        position: sticky;
        top: 0;
        z-index: 8;
        background-color: rgba(255, 255, 255, 0.7);
        backdrop-filter: saturate(180%) blur(10px);
    }

    .page-cp {
        padding-bottom: 1px;
        padding-top: 15px;
    }
</style>

<div id="section-top">
    <section class="page-cp">
        <div class="container">
            <div class="top-cp row">
                @php($lang = Session('lang'))
                @if (count($sponsor) > 0)
                    @foreach ($sponsor as $k => $row)
                        <div class="col-12">
                            @php($key = @$row->key ? $row->key : $module)
                            @switch($row->_type)
                                @case('home')
                                    @php($href = '')
                                @break

                                @case('home+link')
                                    @php($href = "/$row->url")
                                @break

                                @case('company')
                                    @php($module = @$row->key ? $row->key : $module)
                                    @php($href = "/$lang/$module/cp/$row->profile_url")
                                @break

                                @case('home+company')
                                    @php($module = @$row->key ? $row->key : $module)
                                    @php($href = "/$lang/$module/cp/$row->profile_url")
                                @break;
                                @case('category')
                                    @php($module = @$row->url ? $row->url : $module)
                                    @php($href = "/$module")
                                @break

                                @case('custom')
                                    @php($href = $row->url)
                                @break
                            @endswitch
                            {{-- @php($href = $row->profile_url == '' ? $row->url : Session('lang') . "/$key/cp/$row->profile_url")
                            @php($href = $row->_type == 'home' || $row->_type == 'home+company' && $row->url != '' ? '' : $href) --}}
                            <a @if ($href != '') href="{!! $href !!}" @endif target="_blank"
                                class="sponsor countOfClickBanner" id="countOfClickBanner" data-cp="{{ $row->id }}"
                                data-id="{{ @$row->_id }}" style="color: #1f1f1f;">
                                @if ($row->logo != '')
                                    <div class="top-company">
                                        <img src="{{ url($row->logo) }}" class="img-fluid img-banner" width="100%"
                                            @if ($row->title != '') title="{{ $row->title }}" @endif
                                            @if ($row->caption !== '') alt="{{ $row->caption }}" @endif
                                            src-md="{{ str_replace('.', '-md.', $row->logo) }}"
                                            src-xs="{{ str_replace('.', '-xs.', $row->logo) }}">
                                    </div>
                                @else
                                    <div class="col-9 col-lg-9 pl-3 pl-lg-0">
                                        <div class="table-ver"
                                            @if ($row->logo == '') style="width:100%;" @endif>
                                            <div class="vertical-align--middle">
                                                <div class="title bold " style="">{{ $row->name }}</div>
                                                <div class=" content">
                                                    <p class="highlight" style=""> {!! $row->caption !!}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
</div>
{{-- @include('front-end.announce') --}}
