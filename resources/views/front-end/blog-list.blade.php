@if (count($blogs) > 0)
    <div id="blogs">
        <div class="container">
            <div class="d-flex">
                <h2 class="bold mb-3 XWyRR" style="font-weight: bold"> @lang('phrase.header.blog-atonce') <span class="text-orange ml-2">
                        @lang('phrase.header.atonce')</span></h2>
                <div><a class="b-view-more gKiAgG"
                        href="{{ Session('lang') }}/blog?category={{ $categoryId }}">@lang('phrase.see-all')
                        »</a></div>
            </div>
            <div class="row">
                @foreach ($blogs as $v)
                    @php
                        if ($v->type == 'general') {
                            $bullet = '--c-skyblue';
                            $border = '--border-skyblue';
                        }
                        if ($v->type == 'job-search' || $v->type == 'want-to-sale' || $v->type == 'want-to-buy' || $v->type == 'promotion' || $v->type == 'customer' || $v->type == 'selfedit' || $v->type == 'review') {
                            $bullet = '--c-blue';
                            $border = '--border-blue';
                        }
                        if ($v->type == 'marketing-blog') {
                            $bullet = '--c-orange';
                            $border = '--border-orange';
                        }
                    @endphp
                    <div class="col-md-6 col-lg-3 d-flex blog-list" data-key="{{ $v->key }}">
                        <div class="blog-container">
                            <div class="blog-header">
                                <div class="post-meta">
                                    @if ($v->by != '')
                                        <a class="company-logo" data-name="{{ $v->by }}"
                                            href="{{ Session('lang') }}/{{ $v->key }}/cp/{{ $v->by_url }}">
                                            <img src="{{ $v->by_logo }}" alt="">
                                        </a>
                                        <div class="createdby">
                                            <div><a href="{{ Session('lang') }}/{{ $v->key }}/cp/{{ $v->by_url }}"
                                                    class="written-by">
                                                    @if ($v->by != '')
                                                        {{ $v->by }}
                                                    @endif
                                                </a></div>
                                            <div class="industry-name"><i class="fas fa-circle bullet {{ @$bullet }}"></i>
                                                {{ $v->categoryName }}</div>
                                        </div>
                                    @else
                                        <a class="company-logo" href="{{ Session('lang') }}" data-name=""><img
                                                src="img/at-once.jpg"></a>
                                        <div class="createdby">
                                            <div class="written-by">
                                                {{ env('APP_NAME') }}
                                            </div>
                                            <div class="industry-name"><i class="fas fa-circle bullet {{ @$bullet }}"></i>
                                                {{ $v->categoryName }}</div>
                                        </div>
                                    @endif
                                </div>
                                <div class="blog-cover">
                                    <a href="{{ Session('lang') }}/blog/{{ $v->url }}"><img
                                            src="{{ str_replace('.', '-xs.', $v->images) }}" class=""
                                            alt="{{ $v->name }}"></a>
                                </div>
                            </div>
                            <div class="blog-body">
                                <div>
                                    <ul class="published-date">
                                        <li class=""><i class="far fa-calendar-alt"></i>
                                            {{ date('d-m-y', strtotime($v->publish)) }}</li>
                                        <li class=""><i class="far fa-eye"></i> {{ $v->view }}</li>
                                    </ul>
                                </div>
                                <div class="blog-title">
                                    <a href="{{ Session('lang') }}/blog/{{ $v->url }}">
                                        <h4 class="mb-2">{{ $v->name }}</h4>
                                    </a>
                                </div>
                                <p>{{ $v->detail }}</p>
                            </div>
                            <div class="blog-footer">
                                <div class="border-3x {{ @$border }}"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="col-lg-12 mb-4">
                    <center>
                        <a href="{{ Session('lang') }}/blog?category={{ $categoryId }}"
                            class="btn-orange">@lang('phrase.see-all')</a>
                    </center>
                </div>
            </div>
        </div>
    </div>
@endif
