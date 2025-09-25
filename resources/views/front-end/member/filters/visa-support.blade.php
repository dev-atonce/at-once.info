@php
    $lang = Session('lang');
    $get['visa'] = \App\Models\VisaTypeMd::select('id as key',"name_$lang as name")->orderBy("name_$lang")->get();
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->get();
    $visa = \App\Models\CpVisaMd::where('_id',$_id)->select('visa')->get();
    $location = \App\Models\CpLocationMd::where('_id',$_id)->select('location')->get();
@endphp

<div class="form-group">
    <h6 class="bold text-secondary">@lang("phrase.visa-support.filter.location")</h6>
    <div class="row ml-1 visa" data-val="{{json_encode(@$visa)}}">
        @foreach($get['visa'] as $vt)
        <div class="col-lg-12">
            <input type="checkbox" name="visa[]" id="visa_{{$vt->key}}" value="{{$vt->key}}"> 
            <label for="visa_{{$vt->key}}" class="text-secondary">{{$vt->name}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h6 class="bold text-secondary location-label" data-val="{{json_encode(@$location)}}">@lang("phrase.visa-support.filter.location")</h6>
    <select name="location[]" class="location" multiple="multiple">
        @foreach($get['location'] as $pv)
        <option value="{{$pv->key}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>