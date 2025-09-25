@php
    $lang = Session('lang');
    $get['consulting'] =\App\Models\ConsultingMd::select('id as key',"name_$lang as name")->orderBy("name_$lang",'asc')->get();
    $get['service'] =\App\Models\ConsultingMd::select('id as key',"name_$lang as name")->orderBy("name_$lang",'asc')->get();
    $get['location'] = \App\Models\ProvinceMd::select("province_id as key","province_name_$lang as name")->get();
    $location = \App\Models\CpLocationMd::select('location')->where('_id',$_id)->get();
    $consulting = \App\Models\CpConsultingMd::select('consulting')->where('_id',$_id)->get();
    $service = \App\Models\CpServiceMd::select('service')->where('_id',$_id)->get();
@endphp

<div class="form-group">
    <h6 class="bold text-secondary location-label" data-val="{{json_encode(@$location)}}">
        @lang('phrase.logistics.filter.location')
    </h6>
    <select name="location[]" class="form-control" multiple="multiple">
        @foreach($get['location'] as $pv)
        <option value="{{$pv->id}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.company-register.filter.consulting')</h6>
    <div class="row ml-1 consulting" data-val="{{json_encode(@$consulting)}}">
        @foreach($get['consulting'] as $c)
        <div class="col-lg-6">
            <input type="checkbox" name="consulting[]" id="consulting_{{$c->key}}" value="{{$c->key}}"> 
            <label for="consulting_{{$c->key}}" class="text-secondary">{{$c->name}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang('phrase.company-register.filter.service')</h6>
    <div class="row ml-1 service" data-val="{{json_encode(@$service)}}">
        @foreach($get['service'] as $s)
        <div class="col-lg-6">
            <input type="checkbox" name="service[]" id="service_{{$s->key}}" value="{{$s->key}}"> 
            <label for="service_{{$s->key}}" class="text-secondary">{{$s->name}}</label>
        </div>
        @endforeach
    </div>
</div>