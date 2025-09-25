@php
    $lang = Session('lang');
    
    $get['position'] = \App\Models\TypePositionMd::select('id',"position_$lang as name")->get();
    $get['nationality'] = \App\Models\CountryMd::select('id as key',"nationality as name")->get();
    $get['type'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','type-recruitment')->get();
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->get();

    $position = \App\Models\CpPositionMd::select('position')->where('_id',$_id)->get();
    $nationality = \App\Models\CpNationlityMd::select('nationality')->where('_id',$_id)->get();
    $type = \App\Models\CpTypeMd::select('_type')->where('_id',$_id)->get();
    $location = \App\Models\CpLocationMd::select('location')->where('_id',$_id)->get();

@endphp

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.recruitment.filter.position')</h6>
    <div class="row ml-1 position" data-val="{{json_encode(@$position)}}">
        @foreach($get['position'] as $c)
        <div class="col-lg-6">
            <input type="checkbox" name="position[]" id="position_{{$c->key}}" value="{{$c->key}}"> 
            <label for="position_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <h6 class="bold text-secondary" data-val="{{json_encode(@$nationality)}}">@lang('phrase.recruitment.filter.nationality')</h6>
    <select name="nationality[]" class="form-control" multiple="multiple">
        @foreach($get['nationality'] as $pv)
        <option value="{{$pv->id}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.recruitment.filter.type')</h6>
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
        @lang('phrase.logistics.filter.location')
    </h6>
    <select name="location[]" class="location" multiple="multiple">
        @foreach($get['location'] as $pv)
        <option value="{{$pv->id}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>