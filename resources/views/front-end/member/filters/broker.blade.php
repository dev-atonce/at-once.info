@php
    $lang  = Session('lang');
    
    $get['service'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','real-estate-service')->get();
    $get['type'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','real-estate-type')->get();
    $get['nationality'] = \App\Models\CountryMd::select('id as key',"nationality as name")->get();
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->orderBy("name_$lang")->get();

    $service = \App\Models\CpServiceMd::select('service')->where('_id',$_id)->get();
    $type = \App\Models\CpTypeMd::select('_type')->where('_id',$_id)->get();
    $nationality = \App\Models\CpNationlityMd::select('nationality')->where('_id',$_id)->get();
    $location = \App\Models\CpLocationMd::select('location')->where('_id',$_id)->get();

@endphp
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.broker.filter.service')</h6>
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
    <h6 class="bold text-secondary">@lang('phrase.broker.filter.type')</h6>
    <div class="row ml-1 type" data-val="{{json_encode(@$type)}}">
        @foreach($get['type'] as $c)
        <div class="col-lg-6">
            <input type="checkbox" name="type[]" id="type_{{$c->key}}" value="{{$c->key}}"> 
            <label for="type_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <h6 class="bold text-secondary location-label" data-val="{{json_encode(@$location)}}">
        @lang('phrase.broker.filter.location')
    </h6>
    <select name="location[]" class="location" multiple="multiple">
        @foreach($get['location'] as $pv)
        <option value="{{$pv->id}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <h6 class="bold text-secondary nationality-label" data-val="{{json_encode(@$nationality)}}">
        @lang('phrase.broker.filter.nationality')
    </h6>
    <select name="nationality[]" class="nationality" multiple="multiple">
        @foreach($get['nationality'] as $n)
        <option value="{{$n->id}}">{{$n->name}}</option>
        @endforeach
    </select>
</div>