@php

$domestic = \App\Models\CpDomesticMd::where('_id',$_id)->select('transport')->first();
$inter = \App\Models\CpInternationalMd::where('_id',$_id)->select('transport')->get();
$method = \App\Models\CpMethodMd::where('_id',$_id)->select('method')->get();
$item = \App\Models\CpItemMd::where('_id',$_id)->select('item')->get();
$service = \App\Models\CpServiceMd::where('_id',$_id)->select('service')->get();
$warehouse = \App\Models\CpWarehouseMd::where('_id',$_id)->select('warehouse')->get();
$location = \App\Models\CpLocationMd::where('_id',$_id)->select('location')->get();

$langPro = (Session('lang')=='th')?'th':'en';
$province = \App\Models\ProvinceMd::select('province_id as id',"province_name_$langPro as name")->orderBy('name')->get();

@endphp

<div class="form-group">                          
    <label for="domestic" class="bold text-secondary"><input type="checkbox" name="domestic" id="domestic" value="1" @if(@$domestic->transport)checked @endif> @lang('phrase.domestic')</label>                        
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.international')</h6>
    <div class="row ml-1 international" data-val="{{json_encode($inter)}}">
        @foreach(\App\Models\ChoiceMd::where('type','transport')->select('key',"name_$lang as name")->get() as $int)
        <div class="col-lg-4">
            <input type="checkbox" name="international[]" id="international_{{$int->key}}" value="{{$int->key}}"> 
            <label for="international_{{$int->key}}" class="text-secondary">{{$int->name}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.transport')</h6>
    <div class="row ml-1 method" data-val="{{json_encode($method)}}">
        @foreach(\App\Models\ChoiceMd::where('type','methods')->select('key',"name_$lang as name")->get() as $med)
        <div class="col-lg-4">
            <input type="checkbox" name="method[]" id="method_{{$med->key}}" value="{{$med->key}}"> 
            <label for="method_{{$med->key}}" class="text-secondary">{{$med->name}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.items')</h6>
    <div class="row ml-1 item" data-val="{{json_encode($item)}}">
        @foreach(\App\Models\ChoiceMd::where('type','warehouse')->select('key',"name_$lang as name")->orderBy('key','asc')->get() as $med)
        <div class="col-lg-4">
            <input type="checkbox" name="item[]" id="item_{{$med->key}}" value="{{$med->key}}"> 
            <label for="item_{{$med->key}}" class="text-secondary">{{$med->name}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.services')</h6>
    <div class="row ml-1 service" data-val="{{json_encode($service)}}">
        @foreach(\App\Models\ChoiceMd::where('type','services')->select('key',"name_$lang as name")->get() as $med)
        <div class="col-lg-6">
            <input type="checkbox" name="services[]" id="service_{{$med->key}}" value="{{$med->key}}"> 
            <label for="service_{{$med->key}}" class="text-secondary">{{$med->name}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h6 class="bold text-secondary warehouse-label" data-val="{{json_encode($warehouse)}}">@lang('phrase.logistics.filter.warehouse')</h6>
    <select name="warehouse[]" class="warehouse form-control" multiple="multiple">
        @foreach($province as $w)
        <option value="{{$w->id}}">{{$w->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <h6 class="bold text-secondary location-label" data-val="{{json_encode($location)}}">@lang('phrase.logistics.filter.location')</h6>
    <select name="location[]" class="location form-control" multiple="multiple">
        @foreach($province as $pv)
        <option value="{{$pv->id}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>