@php
    $lang = Session('lang');
    $get['service'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','co-working-service')->get();
    $get['type'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','co-working-type')->get();
    $get['seat'] = \App\Models\ChoiceMd::select('key',"name_$lang as name")->where('type','co-working-seat')->get();
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->get();

    $service = \App\Models\CpServiceMd::select('service')->where('_id',$_id)->get();
    $type = \App\Models\CpTypeMd::select('_type')->where('_id',$_id)->get();
    $location = \App\Models\CpLocationMd::select('location')->where('_id',$_id)->get();
    $seat = \App\Models\CpSeatMd::select('seat')->where('_id',$_id)->get();

@endphp
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
<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.prefabricated-office.filter.type')</h6>
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
    <h6 class="bold text-secondary">@lang('phrase.prefabricated-office.filter.service')</h6>
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
    <h6 class="bold text-secondary">@lang('phrase.prefabricated-office.filter.seat')</h6>
    <div class="row ml-1 seat" data-val="{{json_encode(@$seat)}}">
        @foreach($get['seat'] as $c)
        <div class="col-lg-6">
            <input type="checkbox" name="seat[]" id="seat_{{$c->key}}" value="{{$c->key}}"> 
            <label for="seat_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>