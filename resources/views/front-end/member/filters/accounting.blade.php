@php
    $lang = Session('lang');
    $get['service'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','account-service')->get();
    $get['other'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','account-other')->get();
    $get['nationality'] = \App\Models\CountryMd::select('id as key',"nationality as name")->get();
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->get();
    
    $service = \App\Models\CpServiceMd::select('service')->wehere('_id',$_id)->get();
    $other = \App\Models\CpOtherMd::select('other')->where('_id',$_id)->get();
    $nationality = \App\Models\CpNationalityMd::select('nationality')->where('_id',$_id)->get();
    $location = \App\Models\CpLocationMd::select('location')->where('_id',$_id)->get();
@endphp

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.accounting.filter.service')</h6>
    <div class="row ml-1 service" data-val="{{json_encode(@$service)}}">
        @foreach($get['service'] as $s)
        <div class="col-lg-6">
            <input type="checkbox" name="service[]" id="service_{{$s->key}}" value="{{$s->key}}"> 
            <label for="service_{{$s->key}}" class="text-secondary">{{$s->name}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.accounting.filter.other')</h6>
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
    <h6 class="bold text-secondary nationality-label" data-val="{{json_encode(@$nationality)}}">
        @lang('phrase.accounting.filter.nationality')
    </h6>
    <select name="nationality[]" class="nationality">
        @foreach($get['nationality'] as $n)
            <option value="{{$n->id}}">{{$n->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <h6 class="bold text-secondary location-label" data-val="{{json_encode(@$location)}}">
        @lang('phrase.logistics.filter.location')
    </h6>
    <select name="location[]" class="location" multiple="multiple">
        @foreach($get['location'] as $l)
        <option value="{{$l->id}}">{{$l->name}}</option>
        @endforeach
    </select>
</div>