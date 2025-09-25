@php
    $lang = Session('lang');
    $get['warehouse'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','stock')->get();
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->get();
    $warehouse = \App\Models\CpWarehouse::select('warehouse')->where('_id',$_id)->get();
    $location = \App\Models\CpLocationMd::select('location')->where('_id',$_id)->get();
@endphp


<!-- <div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.warehouse.filter.warehouse')</h6>
    <div class="row ml-1 method" data-val="{{json_encode(@$warehouse)}}">
        @foreach($get['warehouse'] as $med)
        <div class="col-lg-4">
            <input type="checkbox" name="method[]" id="method_{{$med->key}}" value="{{$med->key}}"> 
            <label for="method_{{$med->key}}" class="text-secondary">{{$med->name}}</label>
        </div>
        @endforeach
    </div>
</div> -->
<div class="form-group">
    <h6 class="bold text-secondary warehouse-label" data-val="{{json_encode(@$warehouse)}}">
        @lang('phrase.warehouse.filter.warehouse')
    </h6>
    <select name="warehouse[]" class="location" multiple="multiple">
        @foreach($get['warehouse'] as $pv)
        <option value="{{$pv->key}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <h6 class="bold text-secondary location-label" data-val="{{json_encode(@$location)}}">
        @lang('phrase.warehouse.filter.location')
    </h6>
    <select name="location[]" class="location" multiple="multiple">
        @foreach($get['location'] as $pv)
        <option value="{{$pv->id}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>