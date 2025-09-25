@php
    $lang = Session('lang');
    $get['personal'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','insurance-personal')->get();
    $get['business'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','insurance-business')->get();
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->orderBy("name_$lang")->get();

    $personal = \App\Models\CpServiceMd::select('personal')->where(['type'=>'insurance-personal','_id'=>$_id])->get();
    $business = \App\Models\CpServiceMd::select('business')->where(['type'=>'insurance-business','_id'=>$_id])->get();
    $location = \App\Models\CpLocationMd::select('location')->where('_id',$_id)->get();

@endphp
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.insurance.filter.personal')</h6>
    <div class="row ml-1 personal-filter" data-val="{{json_encode(@$personal)}}">
        @foreach($get['personal'] as $c)
        <div class="col-lg-6">
            <input type="checkbox" name="personal[]" id="personal_{{$c->key}}" value="{{$c->key}}"> 
            <label for="personal_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.insurance.filter.business')</h6>
    <div class="row ml-1 business" data-val="{{json_encode(@$business)}}">
        @foreach($get['business'] as $c)
        <div class="col-lg-6">
            <input type="checkbox" name="business[]" id="business_{{$c->key}}" value="{{$c->key}}"> 
            <label for="business_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
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