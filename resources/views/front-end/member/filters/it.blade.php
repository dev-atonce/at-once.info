@php
    $lang = Session('lang');
    $get['service'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','it-service')->get();
    $get['software'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','it-software')->get();
    $get['hardware'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','it-hardware')->get();
    $get['solution'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','it-solution')->get();
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->get();

    $service = \App\Models\CpServiceMd::select('service')->where('_id',$_id)->get();
    $software = \App\Models\CpSoftwareMd::select('software')->where('_id',$_id)->get();
    $hardware = \App\Models\CpHardwareMd::select('hardware')->where('_id',$_id)->get();
    $solution = \App\Models\CpSolutionMd::select('solution')->where('_id',$_id)->get();
    $location = \App\Models\CpLocationMd::select('location')->where('_id',$_id)->get();

@endphp
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.it.filter.service')</h6>
    <div class="row ml-1 service" data-val="{{json_encode(@$service)}}">
        @foreach($get['service'] as $k => $s)
        @if($k>6)<div class="col-lg-12">@else<div class="col-lg-6">@endif
            <input type="checkbox" name="service[]" id="service_{{$s->key}}" value="{{$s->key}}"> 
            <label for="service_{{$s->key}}" class="text-secondary">{{$s->name}}</label>
        </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.it.filter.software')</h6>
    <div class="row ml-1 software" data-val="{{json_encode(@$software)}}">
        @foreach($get['software'] as $sw)
        <div class="col-lg-6">
            <input type="checkbox" name="software[]" id="software_{{$sw->key}}" value="{{$sw->key}}"> 
            <label for="software_{{$sw->key}}" class="text-secondary">{{$sw->name}}</label>
        </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.it.filter.hardware')</h6>
    <div class="row ml-1 hardware" data-val="{{json_encode(@$hardware)}}">
        @foreach($get['hardware'] as $hw)
        <div class="col-lg-6">
            <input type="checkbox" name="hardware[]" id="hardware_{{$hw->key}}" value="{{$hw->key}}"> 
            <label for="hardware_{{$hw->key}}" class="text-secondary">{{$hw->name}}</label>
        </div>
        @endforeach
    </div>
</div>
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.it.filter.solution')</h6>
    <div class="row ml-1 solution" data-val="{{json_encode(@$solution)}}">
        @foreach($get['solution'] as $sl)
        <div class="col-lg-12">
            <input type="checkbox" name="solution[]" id="solution_{{$sl->key}}" value="{{$sl->key}}"> 
            <label for="solution_{{$sl->key}}" class="text-secondary">{{$sl->name}}</label>
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