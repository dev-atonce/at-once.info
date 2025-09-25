@php
    $lang = Session('lang');
    $get['service'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','law-firm-service')->get();
    $get['other'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','law-firm-other')->get();
    $get['language'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','law-firm-language')->get();
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->get();
    $service = \App\Models\CpServiceMd::select('service')->where('_id',$_id)->get();
    $location = \App\Models\CpLocationMd::select('location')->where('_id',$_id)->get();
    $other = \App\Models\CpOtherMd::select('other')->where('_id',$_id)->get();
    $language = \App\Models\CpLanguageMd::select('language')->where('_id',$_id)->get();
@endphp

<div class="form-group">
    <h6 class="bold text-secondary location-label" data-val="{{json_encode(@$location)}}">
        @lang('phrase.logistics.filter.location')
    </h6>
    <select name="location[]" class="location" multiple="multiple">
        @foreach($get['location'] as $pv)
        <option value="{{$pv->id}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.law-firm.filter.service')</h6>
    <div class="row ml-1 service" data-val="{{json_encode(@$service)}}">
        @foreach($get['service'] as $k => $c)
        @if($k==10)<div class="col-lg-12">@else<div class="col-lg-6">@endif
            <input type="checkbox" name="service[]" id="service_{{$c->key}}" value="{{$c->key}}"> 
            <label for="service_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.law-firm.filter.other')</h6>
    <div class="row ml-1 other" data-val="{{json_encode(@$other)}}">
        @foreach($get['other'] as $o)
        <div class="col-lg-6">
            <input type="checkbox" name="other[]" id="other_{{$o->key}}" value="{{$o->key}}"> 
            <label for="other_{{$o->key}}" class="text-secondary">{{$o->name}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.law-firm.filter.language')</h6>
    <div class="row ml-1 language" data-val="{{json_encode(@$language)}}">
        @foreach($get['language'] as $l)
        <div class="col-lg-6">
            <input type="checkbox" name="language[]" id="language_{{$l->key}}" value="{{$l->key}}"> 
            <label for="language_{{$l->key}}" class="text-secondary">{{$l->name}}</label>
        </div>
        @endforeach
    </div>
</div>