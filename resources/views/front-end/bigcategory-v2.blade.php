@php
    $lang = !Session('lang') ? 'th' : Session('lang');
    $main = \App\Models\CategoryMainMd::where('status', 1)
        ->select(['id', "name_$lang as name", 'name_th', 'logo', 'coming_soon'])
        ->get();
@endphp
<style>
    .main-category-item {
        position: relative;
    }

    .badge-coming-soon {
        position: absolute;
        top: 3px;
        right: 10px;
        z-index: 2;
    }

    .main-category-item.coming-soon {
        border-radius: 15px;
        overflow: hidden;
        pointer-events: none;
    }
</style>

<div class="card-category layout2">
    <div class="category-header">
        {{-- <h4 class="mx-2 font-weight-bold">หมวดหมู่ธุรกิจ:</h4> --}}
        <div class="row">
            <div class="col-lg-12">
                <div class=" mb-3">
                    <input type="text" id="formCategory" class="form-control px-3" placeholder="ค้นหาหมวดหมู่"
                        style="border:none;">
                </div>
            </div>
        </div>
    </div>
    <div class="category-content">
        <ul id="myTabs" class="nav nav-pills nav-justified main-category" role="tablist">
            @foreach ($main as $k => $v)
                <li class="tabs__big-category main-category-item{{ $v->coming_soon == 1 ? ' coming-soon' : '' }}">
                    @if ($v->coming_soon == 1)
                        <div class="badge badge-dark badge-coming-soon">Coming soon</div>
                    @endif
                    <a href="javascript:"
                        class="box__big-category main-category-link text-center @if ($k == 0) active @endif"
                        data-id="{{ $v->id }}">
                        @if ($v->logo != '')
                            <img src="{{ $v->logo }}">
                        @endif
                        <span>{{ $v->name ? $v->name : $v->name_th }}</span>
                    </a>
                </li>
            @endforeach
        </ul>
        <div class="table-category mt-3">
            <div class="table-body">
                <div class="row bg-white m-0" style="border-radius: 15px; overflow: hidden;">
                    <div class="step3">
                        @foreach (\App\Models\CategorySubMd::where('category_main', 1)->select('id', "name_$lang as name", 'name_th', 'icon', 'category_main as main')->orderBy('sort')->orderBy('id')->get() as $j => $s)
                            <div class="col-12 col-lg-12 col-md-12">
                                <h3 class="mt-3 mb-2 border-bottom --c-blue">
                                    <small>{{ $s->name ? $s->name : $s->name_th }}</small></h3>
                            </div>
                            <div class="col-12 col-lg-12 col-md-12 px-2 pb-3">
                                <div class="-grid collection-list">
                                    @foreach (\App\Models\CategoryMd::where('category_sub', $s->id)->select('id', "name_$lang as name", 'name_th', 'image', 'category_sub as sub', 'key', 'coming_soon')->orderBy('coming_soon')->orderBy('no')->get() as $c)
                                        @php($href = $c->coming_soon != 1 ? "$lang/$c->key" : 'javascript:')
                                        <a class="text-dark" href="{{ $href }}" target="_blank"
                                            style="text-decoration: none;">
                                            <div class="card-cat fade show">
                                                <div class="circle">
                                                    <div
                                                        class="images @if ($c->coming_soon == 1) coming-soon @endif">
                                                        @if ($c->coming_soon == 1)
                                                            <span>Coming soon</span>
                                                        @endif
                                                        <img src="{{ $c->image != '' ? $c->image : 'img/no-image.png' }}"
                                                            title="{{ $c->name }}" width="100">
                                                    </div>
                                                </div>
                                                <div class="title mb-3">{{ $c->name ? $c->name : $c->name_th }}</div>
                                            </div>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script defer>
    var sectionCategories = document.getElementById('section-categories');
    if (window.location.hash == '#section-categories') {
        document.addEventListener("DOMContentLoaded", function() {
            sectionCategories.scrollIntoView('slow');
        });
    }
</script>
