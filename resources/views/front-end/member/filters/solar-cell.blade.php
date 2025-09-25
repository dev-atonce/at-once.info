@php
    $lang = Session('lang');

    $get['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name')->orderBy('province_name_th','asc')->get(;
    $get['condition'] = \App\Models\ChoiceMd::where('type','solar-cell-condition')->select("key","name_$lang as name")->get();

    $location=\App\Models\CpLocationMd::where('_id',$row->id)->select('location')->get();
    $condition=\App\Models\CpConditionMd::where('_id',$row->id)->select('condition')->get();
@endphp

<div class="form-group">
    <h6 class="bold text-secondary location-label" data-val="{{json_encode(@$location)}}">@lang('phrase.solar-cell.filter.location')</h6>
    <select name="location[]" class="location" multiple="multiple">
        @foreach($get['location'] as $pv)
        <option value="{{$pv->key}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang("phrase.condition")</h6>
    <div class="row ml-1 condition" data-val="{{json_encode($condition)}}">
        @foreach($get['condition'] as $v)
        <div class="col-lg-4">
            <input type="checkbox" name="condition[]" id="condition_{{$v->key}}" value="{{$v->key}}"> 
            <label for="condition_{{$v->key}}" class="text-secondary">{{$v->name}}</label>
        </div>
        @endforeach
    </div>
</div>