@php
    $lang = Session('lang');
    $get['type'] = \App\Models\ChoiceMd::where('type','car')->select('id','key',"name_th",'name_jp')->get();
    $get['contract'] = \App\Models\ChoiceMd::where('type','contract-period')->select('id','key',"name_$lang as name")->get();
    $get['other'] = \App\Models\ChoiceMd::where('type','other-conditions')->select('id','key',"name_$lang as name")->get();
    $get['location'] = \App\Models\ProvinceMd::select('province_id as key','province_name_th as name')->orderBy('province_name_th','asc')->get(;
    $type = \App\Models\CpCarTypeMd::select('_type')->where('_id',$_id])->get();
    $location = \App\Models\CpLocationMd::where('_id',$_id)->select('location')->get();
    $contract = \App\Models\CpContractMd::where('_id',$_id)->select('contract')->get();
    $other = \App\Models\CpOtherMd::where('_id',$_id)->select('other')->get();
@endphp

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.car-type')</h6>
    <div class="row ml-1 type" data-val="{{json_encode(@$type)}}">
        @foreach(\App\Models\ChoiceMd::where('type','car')->select('id','key',"name_th",'name_jp')->get() as $c)
        <div class="col-lg-4">
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
    <select name="location[]" class="form-control" multiple="multiple">
        @foreach($get['location'] as $pv)
        <option value="{{$pv->key}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.contract-period')</h6>
    <div class="row ml-1 contract" data-val="{{json_encode(@$contract)}}">
        @foreach($get['contract'] as $c)
        <div class="col-lg-4">
            <input type="checkbox" name="contract[]" id="contract_{{$c->key}}" value="{{$c->key}}"> 
            <label for="contract_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.other-conditions')</h6>
    <div class="row ml-1 other" data-val="{{json_encode(@$other)}}">
        @foreach($get['other'] as $c)
        <div class="col-lg-4">
            <input type="checkbox" name="other[]" id="other_{{$c->key}}" value="{{$c->key}}"> 
            <label for="other_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>