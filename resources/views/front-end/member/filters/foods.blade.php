@php
    $lang = Session('lang');
    $get['type'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','food-type')->get();
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->get();

    $type = \App\Models\CpTypeMd::select('_type')->where('_id',$_id)->get();
    $location = \App\Models\CpLocationMd::select('location')->where('_id',$_id)->get();
    
@endphp
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.foods.filter.type')</h6>
    <div class="row ml-1 type" data-val="{{json_encode(@$type)}}">
        @foreach($get['type'] as $k => $c)
        @if($k ==12 || $k ==13)<div class="col-lg-12">@else<div class="col-lg-6">@endif
            <input type="checkbox" name="type[]" id="type_{{$c->key}}" value="{{$c->key}}"> 
            <label for="type_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <h6 class="bold text-secondary location-label" data-val="{{json_encode(@$location)}}">
        @lang('phrase.foods.filter.location')
    </h6>
    <select name="location[]" class="location" multiple="multiple">
        @foreach($get['location'] as $pv)
        <option value="{{$pv->id}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>