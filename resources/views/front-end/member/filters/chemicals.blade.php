@php
    $lang = Session('lang');
    $get['type'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','chemicals-types')->get();
    $get['service'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','chemicals-services')->get();
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->get();

    $type = \App\Models\CpTypeMd::select('_type')->where('_id',$_id)->get();
    $service = \App\Models\CpServiceMd::select('service')->where('_id',$_id)->get();
    $location = \App\Models\CpLocationMd::select('location')->where('_id',$_id)->get();

@endphp
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.chemicals.filter.type')</h6>
    <div class="row ml-1 type" data-val="{{json_encode(@$type)}}">
        @foreach($get['type'] as $t)
        <div class="col-lg-6">
            <input type="checkbox" name="type[]" id="type_{{$t->key}}" value="{{$t->key}}"> 
            <label for="type_{{$t->key}}" class="text-secondary">{{$t->name}}</label>
        </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.chemicals.filter.service')</h6>
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
    <h6 class="bold text-secondary location-label" data-val="{{json_encode(@$location)}}">
        @lang('phrase.chemicals.filter.location')
    </h6>
    <select name="location[]" class="location" multiple="multiple">
        @foreach($get['location'] as $pv)
        <option value="{{$pv->id}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>