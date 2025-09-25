<div class="container">
<div class="row">
    <div class="col-lg-12 position-relative">   
        <div class="mb-4">
            <div class="d-flex">
                <h2 class="bold mb-0 XWyRR">@lang('phrase.recommend-industry')</h2>
                <a class="b-view-more gKiAgG" href="{{Session('lang')}}/category">@lang('phrase.see-all') »</a>
            </div>
        </div>
        @php $lang=Session('lang') @endphp
      
        <div class="row">
            @foreach(\App\Models\IndustryMd::select(["name_$lang as name",'key','image','coming_soon'])->where(['status'=>1])->get() as $k => $ind)
            @php
            $path=str_replace('.jpg', '.webp', $ind->image);
            $path=str_replace('.webp', '-xs.webp', $path);
            @endphp
            <div class="col-6 col-md-3 col-lg-2">
                <div class="cards-business pb-4 mb-lg-0">
                    <a class="card-other" href="@if($ind->coming_soon==1)javascript:@else{{url(Session('lang')."/$ind->key")}}@endif"> 
                        <span class="card-other-header" style="background-image: url({{$path}});" title="{{$ind->name}}" alt="{{$ind->name}}">
                            @if($ind->coming_soon==1)<div class="card-coming-soon"><h6>@lang('phrase.comming-soon')!</h6></div>@endif
                            <span class="card-other-title"><h5>{{$ind->name}}</h5></span>
                        </span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        {{-- <div class="row">
            @foreach($industry as $k => $ind)
            @php
            $path=str_replace('.jpg', '.webp', $ind->image);
            $path=str_replace('.webp', '-xs.webp', $path);
            @endphp
            <div class="col-6 col-md-3 col-lg-2">
                <div class="cards-business pb-4 mb-lg-0">
                    <a class="card-other" href="@if($ind->coming_soon==1)javascript:@else{{url(Session('lang')."/$ind->key")}}@endif"> 
                        <span class="card-other-header" style="background-image: url({{$path}});" title="{{$ind->name}}" alt="{{$ind->name}}">
                            @if($ind->coming_soon==1)<div class="card-coming-soon"><h6>@lang('phrase.comming-soon')!</h6></div>@endif
                            <span class="card-other-title"><h5>{{$ind->name}}</h5></span>
                        </span>
                    </a>
                </div>
            </div>
            @endforeach
        </div>  --}}
        {{--
        @php
        if($module!='') $industry->withPath(Session('lang')."/$module?pgn=industry");
        else $industry->withPath(Session('lang')."?pgn=industry");
        @endphp
        {{$industry->links()}}      
        --}}
    </div>
</div>
</div>