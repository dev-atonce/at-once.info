@php
    $lang = Session('lang');
    $get['service'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','web-service')->get();
    $get['other'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','web-other-service')->get();
    $get['language'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','web-language')->get();
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->orderBy("name_$lang")->get();

    $location = \App\Models\CpLocationMd::select('location')->where('_id',$_id)->get();
    $service = \App\Models\CpServiceMd::select('service')->where('_id',$_id)->get();
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
    <h6 class="bold text-secondary">@lang('phrase.web-system.filter.service')</h6>
    <div class="row ml-1 service" data-val="{{json_encode(@$service)}}">
        @foreach($get['service'] as $c)
        <div class="col-lg-6">
            <input type="checkbox" name="service[]" id="service_{{$c->key}}" value="{{$c->key}}"> 
            <label for="service_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.web-system.filter.other')</h6>
    <div class="row ml-1 other" data-val="{{json_encode(@$other)}}">
        @foreach($get['other'] as $c)
        <div class="col-lg-6">
            <input type="checkbox" name="other[]" id="other_{{$c->key}}" value="{{$c->key}}"> 
            <label for="other_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.web-system.filter.language')</h6>
    <div class="row ml-1 language" data-val="{{json_encode(@$language)}}">
        @foreach($get['language'] as $c)
        <div class="col-lg-4">
            <input type="checkbox" name="language[]" id="language_{{$c->key}}" value="{{$c->key}}"> 
            <label for="language_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>