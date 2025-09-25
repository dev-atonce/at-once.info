@php

    $lang = Session('lang');
    $get['language'] = \App\Models\TranslateMd::select('language')->where('_id',$_id)->get();
    $get['speciality'] = \App\Models\SpecialityMd::select('speciality')->where('_id',$_id)->get();
    $get['status'] = \App\Models\StatusMd::select('status')->where('_id',$_id)->get();
    $get['urgent'] = \App\Models\CpUrgentMd::select('urgent')->where('_id',$_id)->first();
    $get['postpay'] = \App\Models\CpPostpayMd::select('postpay')->where('_id',$_id)->first();
    
@endphp
<div class="form-group">
    <h6 class="bold text-secondary">@lang("phrase.$module.filter.language")</h6>
    <div class="row ml-1 language" data-val="{{json_encode($get['language'])}}">
        @foreach(\App\Models\TranslateMd::select('id',"name_$lang as name")->get() as $prv)
        <div class="col-lg-4">
            <input type="checkbox" name="language[]" id="language_{{$prv->id}}" value="{{$prv->id}}"> 
            <label for="language_{{$prv->id}}" class="text-secondary">{{$prv->province}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang("phrase.$module.filter.speciality")</h6>
    <div class="row ml-1 speciality" data-val="{{json_encode($get['speciality'])}}">
        @foreach(\App\Models\SpecialityMd::select('id',"name_$lang as name")->get() as $prv)
        <div class="col-lg-4">
            <input type="checkbox" name="speciality[]" id="speciality_{{$prv->id}}" value="{{$prv->id}}"> 
            <label for="speciality_{{$prv->id}}" class="text-secondary">{{$prv->province}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">
    <h6 class="bold text-secondary">@lang("phrase.$module.filter.status")</h6>
    <div class="row ml-1 status" data-val="{{json_encode($get['status'])}}">
        @foreach(\App\Models\StatusMd::select('id',"name_$lang as name")->get() as $sta)
        <div class="col-lg-4">
            <input type="checkbox" name="status[]" id="status_{{$sta->id}}" value="{{$sta->id}}"> 
            <label for="status_{{$sta->id}}" class="text-secondary">{{$sta->name}}</label>
        </div>
        @endforeach
    </div>
</div>

<div class="form-group">                          
    <label for="urgent" class="bold text-secondary urgent" data-val="{{json_encode(@$get['urgent'])}}"><input type="checkbox" name="urgent" id="urgent" value="1"> @lang('phrase.urgent')</label>                        
</div>


<div class="form-group">                          
    <label for="postpay" class="bold text-secondary postpay" data-val="{{json_encode(@$get['postpay'])}}"><input type="checkbox" name="postpay" id="postpay" value="1"> @lang('phrase.postpay')</label>                        
</div>

{{-- <div class="form-group">
    <h6 class="bold text-secondary location-label" data-val="{{json_encode(@$location)}}">
        @lang('phrase.textiles-clothing.filter.location')
    </h6>
    <select name="location[]" class="location" multiple="multiple">
        @foreach($get['location'] as $pv)
        <option value="{{$pv->id}}">{{$pv->name}}</option>
        @endforeach
    </select>
</div> --}}
