@php
    $lang = Session('lang');
    
    $get['service'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','forklift-service')->get();
    $get['type'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','forklift-type')->get();
    $get['fuel'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','fuel-system')->get();
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->orderBy("name_$lang")->get();

    $service = \App\Models\CpServiceMd::select('service')->where('_id',$_id)->get();
    $type = \App\Models\CpTypeMd::select('_type')->where('_id',$_id)->get();
    $fuel = \App\Models\CpFuelMd::select('fuel')->where('_id',$_id)->get();
    $location = \App\Models\CpLocationMd::select('location')->where('_id')->get();

@endphp
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.forklift.filter.service')</h6>
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
    <h6 class="bold text-secondary">@lang('phrase.forklift.filter.type')</h6>
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
    <h6 class="bold text-secondary">@lang('phrase.forklift.filter.fuel')</h6>
    <div class="row ml-1 fuel" data-val="{{json_encode(@$fuel)}}">
        @foreach($get['fuel'] as $c)
        <div class="col-lg-6">
            <input type="checkbox" name="fuel[]" id="fuel_{{$c->key}}" value="{{$c->key}}"> 
            <label for="fuel_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <h6 class="bold text-secondary location-label" data-val="{{json_encode(@$location)}}">
        @lang('phrase.forklift.filter.location')
    </h6>
    <select name="location[]" class="location" multiple="multiple">
        @foreach($get['location'] as $pv)
        <option value="{{$pv->id}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>