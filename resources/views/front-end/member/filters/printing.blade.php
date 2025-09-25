@php
    $lang = Session('lang');
    $get['printing'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','type-printing')->get();
    $get['minimum'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','service-minimum')->get();
    $get['service'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','service-other')->get();  
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->get();
    $printing = \App\Models\CpPrintingMd::where('_id',$_id)->select('printing')->get();
    $minimum = \App\Models\CpMinimumMd::where('_id',$_id)->select('minimum')->get();
    $service = \App\Models\CpServiceMd::select('service')->where('_id',$_id)->get();
    $location = \App\Models\CpLocationMd::select('province')->where('_id',$_id)->get();
@endphp

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.printing.filter.type')</h6>
    <div class="row ml-1 printing" data-val="{{json_encode(@$printing)}}">
        @foreach($get['printing'] as $c)
        <div class="col-lg-6">
            <input type="checkbox" name="printing[]" id="printing_{{$c->key}}" value="{{$c->key}}"> 
            <label for="printing_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.printing.filter.minimum')</h6>
    <div class="row ml-1 minimum" data-val="{{json_encode(@$minimum)}}">
        @foreach($get['minimum'] as $c)
        <div class="col-lg-6">
            <input type="checkbox" name="minimum[]" id="minimum_{{$c->key}}" value="{{$c->key}}"> 
            <label for="minimum_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.printing.filter.other-service')</h6>
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
    <h6 class="bold text-secondary location-label" data-val="{{json_encode(@$location)}}">
        @lang('phrase.logistics.filter.location')
    </h6>
    <select name="location[]" class="location" multiple="multiple">
        @foreach($get['location'] as $pv)
        <option value="{{$pv->id}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>

