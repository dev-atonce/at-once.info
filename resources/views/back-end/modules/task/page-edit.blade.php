
<style>
    .img-preview{
        width: 100%;
        max-height:145px;
        overflow: hidden;
    }
    .img-preview>img{
        height: 100%;        
    }
    #tree{
        width:auto;
        height:350px; 
        overflow-x:auto; 
        overflow-y:auto;
    }
    #tree>ul{
        padding-top:10px;
    }
    .weekDays-selector .weekday {
        display: none!important;
        -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;
    }
    .weekDays-selector input[type=checkbox] + label {
        display: inline-block;
        border-radius: 6px;
        background: #dddddd;
        height: 40px;
        min-width: 50px;
        margin-right: 3px;
        line-height: 40px;
        text-align: center;
        cursor: pointer;
        -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;
    }
    .weekDays-selector input[type=checkbox]:checked + label {
        background: #26B99A;
        color: #ffffff;
        -moz-user-select: none; -webkit-user-select: none; -ms-user-select:none; user-select:none;-o-user-select:none;
    }
    .dropdown-menu > li > a {
        font-weight: 700;
        padding: 10px 20px;
    }

    .bootstrap-select.btn-group .dropdown-menu li small {
        display: block;
        padding: 6px 0 0 0;
        font-weight: 100;
    }
    .custom-file-label.selected{
        overflow: hidden;
    }

    .ad-auto{
      position: absolute;
      padding: 0;
      background: #fff;
      border: 1px solid;
      border-top: none;
      border-color: #ccc;
      margin-top:1px;
    }
    .ad-auto ul{
      font-size:14px; 
      margin-left: 0;
    }
    ul.ad-auto li{
        list-style-type: none;
        color:#000;
        font-size: 14px;
        padding:5px 5px 5px 12px;
    }
    ul.ad-auto li>span{
      color:#555;
    }
    ul.ad-auto li:hover>span{
      color:#fff;
    }
    ul.ad-auto li:hover{
      cursor: pointer;
      background-color: #5ca7fd;
      color:#fff;
      
    }
    .list-item .item{
        display: block;
        width:100%;
        padding: 0 5px 0 5px;
        cursor:default;
        border-radius: 3px;
    }

    .list-item .item:hover{
        background: #5997fb;
        color: white;
        
    }
    .item.active{
        background-color: #5997fb;
        color:#fff;
    }
    .v-action{
        position: absolute;
        top: 0;
        right: 0;
        padding: 10px;
    }
    .v-details{
        overflow: hidden;
        padding: 0 10px 10px 10px;
        width: -webkit-fill-available;
    }
    #vExplorerZone{
        position: relative;
        min-height: 350px;
    }
    .col-lg-12.v-footer {
        border-top: 1px solid #dedede;
        height: min-content;
        position: absolute;
        bottom: 0;
        padding: 10px;
    }
    .form-control.error{
        border-color: #ef8b8b;
    }
    .form-control.error:focus{
        color: rgb(247, 74, 74);;
        background-color: #fff;
        border-color: #ef8b8b !important;
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgb(219 31 31 / 25%);
    }

    label.error{
        color: rgb(247, 74, 74);
    }
  </style>
  <link rel="stylesheet" href="back-end/css/skEditor.css" />
  @php
        $day = DB::table('working_hours')->select('id','name_th')->get();
  @endphp
<div class="fade-in">
        <div class="row">
            <div class="col-lg-12 col-md-12">   
                    <div class="card">
                        <div class="card-header">
                            <span class="breadcrumb-item "><a href='{{url("$prefix$segment")}}'>Member</a></span>
                            <span class="breadcrumb-item active">Edit Form</span>&nbsp;&nbsp;<span>User Email : {{@$row->email}}</span>
                            <div class="card-header-actions"><small class="text-muted"><a href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small></div>
                        </div>
                        <div class="card-body">
                    @php
                        $group = \App\Http\Controllers\ProvincialCtrl::group();
                        $category = \App\Models\CategoryMd::orderBy('coming_soon')->orderBy('name_th')->get();
                        $nationality = \App\Models\CountryMd::select('id','nationality')->orderBy('nationality')->get();
                    @endphp
                    <form id="formEdit" method="post" action="" enctype="multipart/form-data"> 
                        @csrf
                        <input type="hidden" name="member_id" value="{{@$row->id}}">
                        <input type="hidden" name="cp_id" value="{{@$comp->id}}">
                        <input type="hidden" name="edited" value="{{$comp->edited}}">
                        {{-- Card --}}
                        <div class="card border-light">
                            <div class="card-header bg-light">
                              #{{$comp->id}}
                            </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            @php
                                                $image=($comp->logo!=='')?$comp->logo:"img/no_image.webp";
                                            @endphp
                                            <img src="{{$image}}" class="card-img" alt="{{$comp->name_th}}" id="preview">
                                            <input type="hidden" name="currentImage" value="{{@$comp->logo}}">
                                            <div class="form-group">
                                                <code>Dimension: 500 x 500 pixel (auto resize & crop)</code>
                                                <div class="custom-file">                                                            
                                                    <input type="file" class="custom-file-input" id="image" lang="th" name="image">
                                                    <label class="custom-file-label" for="image">Choose file</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    @php
                                                        $bg_image=(!empty($comp->cover))?$comp->cover:"img/no-img-banner.jpg";
                                                    @endphp
                                                    <img src="{{$bg_image}}" class="card-img" alt="{{$comp->name_th}}" id="bg_preview"  style="max-height: 320px">
                                                    <input type="hidden" name="currentBgImage" value="{{@$comp->bg_image}}">
                                                    <div class="form-group">
                                                        <code>Dimension: 1920 x 500 pixel (auto resize & crop)</code>
                                                        <div class="custom-file">                                                            
                                                            <input type="file" class="custom-file-input" id="bg_image" lang="th" name="bg_image">
                                                            <label class="custom-file-label" for="bg_image">Choose file</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <label for="">Video :</label>
                                                    <label><input type="radio" name="video_position" value="left" @if($comp->video_position=='left') checked @endif>&nbsp;ซ้าย</label>
                                                    <label><input type="radio" name="video_position" value="center" @if($comp->video_position=='center') checked @endif>&nbsp;กลาง</label>
                                                    <label><input type="radio" name="video_position" value="right" @if($comp->video_position=='right') checked @endif>&nbsp;ขวา</label>
                                                    <div class="input-group mb-3">
                                                        <input type="text" name="video_profile" class="form-control" placeholder="Video URL" aria-label="Video URL" aria-describedby="basic-addon2" value="{{$comp->video_profile}}">
                                                        <div class="input-group-append">
                                                          <button type="button" class="btn btn-outline-secondary select-video" type="button">Browse</button>
                                                        </div>
                                                      </div>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="text-right">
                                                        <button type="submit" class="text-right btn btn-success">บันทึก</button>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="bd-callout bd-callout-danger">
                                                            <label class="text-danger font-weight-bold">*Profile URL :</label> e.g. <code>company-name-thailand</code> @if($comp->profile_url!='')<a href="/th/{{$comp->key}}/cp/{{$comp->profile_url}}" target="_blank"><i class="fas fa-globe-asia"></i></a>@endif
                                                            <input type="text" name="profile_url" id="profile_url" class="form-control" value="{{$comp->profile_url}}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>ชื่อ บริษัท(TH)</label>
                                                        <input type="text" name="name_th" value="{{$comp->name_th}}" class="form-control">
                                                    </div>
                                                </div> 
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>ชื่อ บริษัท(JP)</label>
                                                        <input type="text" name="name_jp" value="{{$comp->name_jp}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>อุตสาหกรรม</label>
                                                        <select name="category" class="selectpicker" id="category">
                                                            <option value="">กรุณาเลือก</option>
                                                            @foreach($category as $ki => $vi)
                                                                <option value="{{$vi->id}}" @if($vi->coming_soon==1)disabled @endif @if($comp->category==$vi->id) selected @endif>{{$vi->name_th}} / {{$vi->name_jp}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>  
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>สัญชาติ</label>
                                                        <select id="country" name="country">
                                                            <option value="">กรุณาเลือก</option>
                                                            @foreach ($country as $cout)
                                                                <option value="{{$cout->alpha2}}" @if($comp->country == $cout->alpha2) selected @endif >{{$cout->nationality}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                @switch($comp->category)
                                                    @case(1) 
                                                        @php
                                                            @$op_Domestic = DB::table('domestic')->select('transport')->where('_id',$comp->id)->first();
                                                            @$op_international = DB::table('international')->select('transport')->where('_id',$comp->id)->get()->toJson();
                                                            @$op_method = DB::table('cp_method')->select('method')->where('_id',$comp->id)->get()->toJson();
                                                            @$op_warehouse = DB::table('cp_warehouse')->select('warehouse')->where('_id',$comp->id)->get()->toJson();
                                                            @$op_item = DB::table('cp_item')->select('item')->where('_id',$comp->id)->get()->toJson();
                                                            @$op_service = DB::table('cp_service')->select('service')->where('_id',$comp->id)->get()->toJson();
                                                            @$op_Pac = DB::table('packing')->select('packing')->where('_id',$comp->id)->first();
                                                            @$op_location = \App\Models\Filter\CpLocationMd::select('location')->where(['_id'=>$comp->id,'type'=>'logistics'])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="compDomestic" value="@if(!empty($op_Domestic->transport)){{$op_Domestic->transport}}@endif">
                                                        <input type="hidden" id="compInternational" value="@if(!empty($op_international)){{$op_international}}@endif">
                                                        <input type="hidden" id="compMethod" value="@if(!empty($op_method)){{$op_method}}@endif">
                                                        <input type="hidden" id="compWarehouse" value="@if(!empty($op_warehouse)){{$op_warehouse}}@endif">
                                                        <input type="hidden" id="compItem" value="@if(!empty($op_item)){{$op_item}}@endif">
                                                        <input type="hidden" id="compService" value="@if(!empty($op_service)){{$op_service}}@endif">
                                                        <input type="hidden" id="compPac" value="@if(!empty($op_Pac->packing)){{$op_Pac->packing}}@endif">
                                                        <input type="hidden" id="compLocation" value="@if(!empty($op_location)){{$op_location}}@endif">
                                                    @break
                                                    @case(2) {{-- Solar Cell --}}
                                                        @php
                                                            @$op_LocationSolar = \App\Models\Filter\CpLocationMd::select('location')->where(['_id'=>$comp->id,'type'=>'solar-cell'])->get()->toJson();
                                                            @$solar_condition = DB::table('cp_condition')->select('condition')->where(['_id'=>$comp->id,'type'=>'solar-cell'])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="compLocationSolar" value="@if(!empty($op_LocationSolar)){{$op_LocationSolar}}@endif">
                                                        <input type="hidden" id="compCondition" value="@if(!empty($solar_condition)){{$solar_condition}}@endif">
                                                    @break
                                                    @case(3) {{-- Translater --}}
                                                        @php
                                                            @$op_Translate = DB::table('cp_translate')->select('translate')->where(['_id'=>$comp->id])->get()->toJson();
                                                            @$op_Speciality = DB::table('cp_speciality')->select('speciality')->where(['_id'=>$comp->id])->get()->toJson();
                                                            @$op_Urgent = DB::table('cp_urgent')->select('urgent')->where(['_id'=>$comp->id])->first()->urgent;
                                                            @$op_Postpay = DB::table('cp_postpay')->select('postpay')->where(['_id'=>@$comp->id])->first()->postpay;
                                                            $op_Status = DB::table('cp_status')->select('status')->where(['_id'=>$comp->id])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="compTranslate" value="@if(!empty($op_Translate)){{$op_Translate}}@endif">
                                                        <input type="hidden" id="compSpeciality" value="@if(!empty($op_Speciality)){{$op_Speciality}}@endif">
                                                        <input type="hidden" id="compUrgent" value="@if(!empty($op_Urgent)){{$op_Urgent}}@endif">
                                                        <input type="hidden" id="compPostpay" value="@if(!empty($op_Postpay)){{$op_Postpay}}@endif">
                                                        <input type="hidden" id="compStatus" value="@if(!empty($op_Status)){{$op_Status}}@endif">
                                                    @break
                                                    @case(4) {{------- Car Rental -------}}
                                                        @php
                                                            @$op_CarType = DB::table('cp_cartype')->select('type')->where(['_id'=>$comp->id])->get()->toJson();
                                                            @$op_LocationAuto = \App\Models\Filter\CpLocationMd::select('location')->where(['_id'=>$comp->id,'type'=>'carrent'])->get()->toJson();
                                                            @$op_Period = DB::table('cp_period')->select('period')->where(['_id'=>$comp->id])->get()->toJson();
                                                            @$op_other_condition = DB::table('cp_condition')->select('condition')->where(['_id'=>$comp->id])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="compCarType" value="@if(!empty($op_CarType)){{$op_CarType}}@endif">
                                                        <input type="hidden" id="compLocationAuto" value="@if(!empty($op_LocationAuto)){{$op_LocationAuto}}@endif">
                                                        <input type="hidden" id="compPeriod" value="@if(!empty($op_Period)){{$op_Period}}@endif">
                                                        <input type="hidden" id="compOtherCondition" value="@if(!empty($op_other_condition)){{$op_other_condition}}@endif">
                                                    @break
                                                    @case(5) {{------- Visa Support -------}}
                                                        @php
                                                            @$op_LocationVisa = \App\Models\Filter\CpLocationMd::select('location')->where(['_id'=>$comp->id,'type'=>'visa-support'])->get()->toJson();
                                                            @$op_visa = \App\Models\Filter\CpVisaMd::select('visa')->where(['_id'=>$comp->id])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="compLocationVisa" value="@if(!empty($op_LocationVisa)){{$op_LocationVisa}}@endif">
                                                        <input type="hidden" id="compVisa" value="@if(!empty($op_visa)){{$op_visa}}@endif">
                                                    @break
                                                    @case(6) {{------- Company Register -------}}
                                                        @php
                                                            @$op_LocationCR = \App\Models\Filter\CpLocationMd::select('location')->where(['_id'=>$comp->id,'type'=>'company-register'])->get()->toJson();
                                                            @$op_Consulting = DB::table('cp_consulting')->select('consulting')->where(['_id'=>$comp->id])->get()->toJson();
                                                            @$op_ServiceCR = DB::table('cp_service')->select('service')->where(['_id'=>$comp->id,'type'=>'company-register'])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="compLocationCR" value="@if(!empty($op_LocationCR)){{$op_LocationCR}}@endif">
                                                        <input type="hidden" id="compConsulting" value="@if(!empty($op_Consulting)){{$op_Consulting}}@endif">
                                                        <input type="hidden" id="compServiceCR" value="@if(!empty($op_ServiceCR)){{$op_ServiceCR}}@endif">
                                                    @break
                                                    @case(7) {{------- Warehouse -------}}
                                                        @php
                                                            @$op_TypeOfWh= DB::table('cp_warehouse')->select('warehouse')->where(['_id'=>$comp->id])->get()->toJson(); 
                                                            @$op_LocationWh= \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'warehouse','_id'=>$comp->id])->get()->toJson();                                                        
                                                        @endphp
                                                        <input type="hidden" id="compTypeOfWarehouse" value="@if(!empty($op_TypeOfWh)){{$op_TypeOfWh}}@endif">
                                                        <input type="hidden" id="compWarehouseLocation" value="@if(!empty($op_LocationWh)){{$op_LocationWh}}@endif">
                                                    @break
                                                    @case(8) {{------- Printing -------}}
                                                        @php
                                                            @$op_TypeOfPt= DB::table('cp_printing')->select('printing')->where(['_id'=>$comp->id])->get()->toJson();
                                                            @$op_compMinimum = \App\Models\Filter\CpMinimumMd::select('minimum')->where('_id',$comp->id)->get()->toJson();
                                                            @$op_compOther = \App\Models\Filter\CpServiceMd::select('service')->where('_id',$comp->id)->get()->toJson();
                                                            @$op_LocationPt= \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'printing','_id'=>$comp->id])->get()->toJson();                                                        
                                                        @endphp
                                                        <input type="hidden" id="compTypeOfPrinting" value="@if(!empty($op_TypeOfPt)){{$op_TypeOfPt}}@endif">
                                                        <input type="hidden" id="compMinimum" value="@if(!empty($op_compMinimum)){{$op_compMinimum}}@endif">
                                                        <input type="hidden" id="compOther" value="@if(!empty($op_compOther)){{$op_compOther}}@endif">
                                                        <input type="hidden" id="compPrintingLocation" value="@if(!empty($op_LocationPt)){{$op_LocationPt}}@endif">
                                                    @break
                                                    @case(9) {{------- Accounting ------}}
                                                        @php
                                                            @$op_AccService = \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'account','_id'=>$comp->id])->get()->toJson();
                                                            @$op_AccOther = \App\Models\Filter\CpOtherMd::select('other')->where(['type'=>'account','_id'=>$comp->id])->get()->toJson();
                                                            @$op_AccNationality = \App\Models\Filter\CpNationalityMd::select('nationality')->where(['type'=>'account','_id'=>$comp->id])->get()->toJson();
                                                            @$op_AccLocation= \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'account','_id'=>$comp->id])->get()->toJson();                                                        
                                                        @endphp
                                                        <input type="hidden" id="compAccService" value="@if(!empty($op_AccService)){{$op_AccService}}@endif">
                                                        <input type="hidden" id="compAccOther" value="@if(!empty($op_AccOther)){{$op_AccOther}}@endif">
                                                        <input type="hidden" id="compAccNationality" value="@if(!empty($op_AccNationality)){{$op_AccNationality}}@endif">
                                                        <input type="hidden" id="compAccLocation" value="@if(!empty($op_AccLocation)){{$op_AccLocation}}@endif">
                                                    @break
                                                    @case(10) {{------- Law Firm -------}}
                                                        @php
                                                            @$op_LawLocation= \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'law-firm','_id'=>$comp->id])->get()->toJson();
                                                            @$op_LawService = \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'law-firm','_id'=>$comp->id])->get()->toJson();
                                                            @$op_LawOther = \App\Models\Filter\CpOtherMd::select('other')->where(['type'=>'law-firm','_id'=>$comp->id])->get()->toJson();
                                                            @$op_LawLanguage = \App\Models\Filter\CpLanguageMd::select('language')->where(['type'=>'law-firm','_id'=>$comp->id])->get()->toJson();                                                   
                                                        @endphp
                                                        <input type="hidden" id="compLawLocation" value="@if(!empty($op_LawLocation)){{$op_LawLocation}}@endif">
                                                        <input type="hidden" id="compLawService" value="@if(!empty($op_LawService)){{$op_LawService}}@endif">
                                                        <input type="hidden" id="compLawOther" value="@if(!empty($op_LawOther)){{$op_LawOther}}@endif">
                                                        <input type="hidden" id="compLawLanguage" value="@if(!empty($op_LawLanguage)){{$op_LawLanguage}}@endif">
                                                    @break
                                                    @case(11) {{------- Web Marketing -------}}
                                                        @php
                                                            @$op_MarkLocation= \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'web-marketing','_id'=>$comp->id])->get()->toJson();
                                                            @$op_MarkLanguage = \App\Models\Filter\CpLanguageMd::select('language')->where(['type'=>'web-marketing','_id'=>$comp->id])->get()->toJson();
                                                            @$op_MarkService = \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'web-marketing','_id'=>$comp->id])->get()->toJson();                                                   
                                                        @endphp
                                                        <input type="hidden" id="compMarkLocation" value="@if(!empty($op_MarkLocation)){{$op_MarkLocation}}@endif">
                                                        <input type="hidden" id="compMarkService" value="@if(!empty($op_MarkService)){{$op_MarkService}}@endif">
                                                        <input type="hidden" id="compMarkLanguage" value="@if(!empty($op_MarkLanguage)){{$op_MarkLanguage}}@endif">
                                                    @break
                                                    @case(12) {{------- Recruitment -------}}
                                                        @php
                                                            @$op_RecruitLocation = \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'recruitment','_id'=>$comp->id])->get()->toJson();
                                                            @$op_RecruitPosition = \App\Models\Filter\CpPositionMd::select('position')->where(['type'=>'recruitment','_id'=>$comp->id])->get()->toJson();
                                                            @$op_RecruitNationality = \App\Models\Filter\CpNationalityMd::select('nationality')->where(['type'=>'recruitment','_id'=>$comp->id])->get()->toJson();                                                   
                                                            @$op_RecruitType = \App\Models\Filter\CpTypeMd::select('_type as type')->where(['type'=>'recruitment','_id'=>$comp->id])->get()->toJson();                                                   
                                                        @endphp
                                                        <input type="hidden" id="compRecruitPosition" value="@if(!empty($op_RecruitPosition)){{$op_RecruitPosition}}@endif">
                                                        <input type="hidden" id="compRecruitNationality" value="@if(!empty($op_RecruitNationality)){{$op_RecruitNationality}}@endif">
                                                        <input type="hidden" id="compRecruitType" value="@if(!empty($op_RecruitType)){{$op_RecruitType}}@endif">
                                                        <input type="hidden" id="compRecruitLocation" value="@if(!empty($op_RecruitLocation)){{$op_RecruitLocation}}@endif">
                                                    @break
                                                    @case(13) {{------- Web System -------}}
                                                        @php
                                                            @$op_WebLocation = \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'web-system','_id'=>$comp->id])->get()->toJson();
                                                            @$op_WebService = \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'web-system','_id'=>$comp->id])->get()->toJson();
                                                            @$op_WebOther= \App\Models\Filter\CpOtherMd::select('other')->where(['type'=>'web-system','_id'=>$comp->id])->get()->toJson();
                                                            @$op_WebLanguage = \App\Models\Filter\CpLanguageMd::select('language')->where(['type'=>'web-system','_id'=>$comp->id])->get()->toJson();                                                   
                                                        @endphp
                                                        <input type="hidden" id="compWebLocation" value="@if(!empty($op_WebLocation)){{$op_WebLocation}}@endif">
                                                        <input type="hidden" id="compWebService" value="@if(!empty($op_WebService)){{$op_WebService}}@endif">
                                                        <input type="hidden" id="compWebOther" value="@if(!empty($op_WebOther)){{$op_WebOther}}@endif">
                                                        <input type="hidden" id="compWebLanguage" value="@if(!empty($op_WebLanguage)){{$op_WebLanguage}}@endif">
                                                    @break
                                                    @case(14) {{------- Office Rent -------}}
                                                        @php
                                                            @$op_coLocation= \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'co-working','_id'=>$comp->id])->get()->toJson();
                                                            @$op_coType = \App\Models\Filter\CpTypeMd::select('_type as type')->where(['type'=>'co-working','_id'=>$comp->id])->get()->toJson();
                                                            @$op_coService= \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'co-working','_id'=>$comp->id])->get()->toJson();
                                                            @$op_coSeat = \App\Models\Filter\CpSeatMd::select('seat')->where(['type'=>'co-working','_id'=>$comp->id])->get()->toJson();                                                   
                                                        @endphp
                                                        <input type="hidden" id="compCoLocation" value="@if(!empty($op_coLocation)){{$op_coLocation}}@endif">
                                                        <input type="hidden" id="compCoService" value="@if(!empty($op_coService)){{$op_coService}}@endif">
                                                        <input type="hidden" id="compCoType" value="@if(!empty($op_coType)){{$op_coType}}@endif">
                                                        <input type="hidden" id="compCoSeat" value="@if(!empty($op_coSeat)){{$op_coSeat}}@endif">
                                                    @break
                                                    @case(15) 
                                                        @php
                                                            @$group = \App\Http\Controllers\ProvincialCtrl::group();
                                                            @$op_offLocation= \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'office-rent','_id'=>$comp->id])->get()->toJson();
                                                            @$op_offService= \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'office-rent','_id'=>$comp->id])->get()->toJson();                                               
                                                            @$op_offContract= \App\Models\Filter\CpContractMd::select('contract')->where(['type'=>'office-rent','_id'=>$comp->id])->get()->toJson();                                               
                                                        @endphp
                                                        <input type="hidden" id="compOffService" value="@if(!empty($op_offService)){{$op_offService}}@endif">
                                                        <input type="hidden" id="compOffLocation" value="@if(!empty($op_offLocation)){{$op_offLocation}}@endif">
                                                        <input type="hidden" id="compOffContract" value="@if(!empty($op_offContract)){{$op_offContract}}@endif">
                                                    @break
                                                    @case(16) {{------- Contruction Machine -------}}
                                                        @php
                                                            @$op_consLocation= \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'construction-machine','_id'=>$comp->id])->get()->toJson();
                                                            @$op_consType = \App\Models\Filter\CpTypeMd::select('_type as type')->where(['type'=>'construction-machine','_id'=>$comp->id])->get()->toJson();
                                                            @$op_consService= \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'construction-machine','_id'=>$comp->id])->get()->toJson();
                                                            @$op_consRental = \App\Models\Filter\CpRentalMd::select('rental')->where(['type'=>'construction-machine','_id'=>$comp->id])->get()->toJson();                                                   
                                                        @endphp
                                                        <input type="hidden" id="compConsService" value="@if(!empty($op_consService)){{$op_consService}}@endif">
                                                        <input type="hidden" id="compConsType" value="@if(!empty($op_consType)){{$op_consType}}@endif">
                                                        <input type="hidden" id="compConsRental" value="@if(!empty($op_consRental)){{$op_consRental}}@endif">
                                                        <input type="hidden" id="compConsLocation" value="@if(!empty($op_consLocation)){{$op_consLocation}}@endif">
                                                    @break
                                                    @case(17) {{------- Forklift -------}}
                                                        @php
                                                            @$op_forkLocation= \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'forklift','_id'=>$comp->id])->get()->toJson();
                                                            @$op_forkType = \App\Models\Filter\CpTypeMd::select('_type as type')->where(['type'=>'forklift','_id'=>$comp->id])->get()->toJson();
                                                            @$op_forkService= \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'forklift','_id'=>$comp->id])->get()->toJson();
                                                            @$op_forkFuel = \App\Models\Filter\CpFuelMd::select('fuel')->where(['type'=>'forklift','_id'=>$comp->id])->get()->toJson();                                                   
                                                        @endphp
                                                        <input type="hidden" id="compForkService" value="@if(!empty($op_forkService)){{$op_forkService}}@endif">
                                                        <input type="hidden" id="compForkType" value="@if(!empty($op_forkType)){{$op_forkType}}@endif">
                                                        <input type="hidden" id="compForkFuel" value="@if(!empty($op_forkFuel)){{$op_forkFuel}}@endif">
                                                        <input type="hidden" id="compForkLocation" value="@if(!empty($op_forkLocation)){{$op_forkLocation}}@endif">
                                                    @break
                                                    @case(18) {{------- Interior Design -----}}
                                                        @php
                                                            @$op_intService = \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'interior-design','_id'=>$comp->id])->get()->toJson();         
                                                            @$op_intLocation = \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'interior-design','_id'=>$comp->id])->get()->toJson();         
                                                        @endphp
                                                        <input type="hidden" id="compIntService" value="@if(!empty($op_intService)){{$op_intService}}@endif">
                                                        <input type="hidden" id="compIntLocation" value="@if(!empty($op_intLocation)){{$op_intLocation}}@endif">
                                                    @break
                                                    @case(19) {{------- Security System -------}}
                                                        @php
                                                            @$op_secService = \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'security-system','_id'=>$comp->id])->get()->toJson();
                                                            @$op_secLocation = \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'security-system','_id'=>$comp->id])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="compSecService" value="@if(!empty($op_secService)){{$op_secService}}@endif">
                                                        <input type="hidden" id="compSecLocation" value="@if(!empty($op_secLocation)){{$op_secLocation}}@endif">
                                                    @break
                                                    @case(20) {{------- Real Estate Agent -------}}
                                                        @php
                                                            @$op_realService = \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'real-estate-agent','_id'=>$comp->id])->get()->toJson();
                                                            @$op_realType = \App\Models\Filter\CpTypeMd::select('_type as type')->where(['type'=>'real-estate-agent','_id'=>$comp->id])->get()->toJson();
                                                            @$op_realLocation = \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'real-estate-agent','_id'=>$comp->id])->get()->toJson();
                                                            @$op_realNationality = \App\Models\Filter\CpNationalityMd::select('nationality')->where(['type'=>'real-estate-agent','_id'=>$comp->id])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="compRealService" value="@if(!empty($op_realService)){{$op_realService}}@endif">
                                                        <input type="hidden" id="compRealType" value="@if(!empty($op_realType)){{$op_realType}}@endif">
                                                        <input type="hidden" id="compRealLocation" value="@if(!empty($op_realLocation)){{$op_realLocation}}@endif">
                                                        <input type="hidden" id="compRealNationality" value="@if(!empty($op_realNationality)){{$op_realNationality}}@endif">
                                                    @break
                                                    @case(21) {{------- Package -------}}
                                                        @php
                                                            @$op_packService = \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'package','_id'=>$comp->id])->get()->toJson();
                                                            @$op_packOther = \App\Models\Filter\CpOtherMd::select('other')->where(['type'=>'package','_id'=>$comp->id])->get()->toJson();
                                                            @$op_packLocation = \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'package','_id'=>$comp->id])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="compPackService" value="@if(!empty($op_packService)){{$op_packService}}@endif">
                                                        <input type="hidden" id="compPackOther" value="@if(!empty($op_packOther)){{$op_packOther}}@endif">
                                                        <input type="hidden" id="compPackLocation" value="@if(!empty($op_packLocation)){{$op_packLocation}}@endif">
                                                    @break
                                                    @case(22) {{------- Insurance -------}}
                                                        @php
                                                            @$op_insPersonal = \App\Models\Filter\CpServiceMd::select('service as personal')->where(['type'=>'insurance-personal','_id'=>$comp->id])->get()->toJson();
                                                            @$op_insBusiness = \App\Models\Filter\CpServiceMd::select('service as business')->where(['type'=>'insurance-business','_id'=>$comp->id])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="compInsPersonal" value="@if(!empty($op_insPersonal)){{$op_insPersonal}}@endif">
                                                        <input type="hidden" id="compInsBusiness" value="@if(!empty($op_insBusiness)){{$op_insBusiness}}@endif">
                                                    @break
                                                    @case(23) {{------- Contruction -------}}
                                                        @php
                                                            @$op_constService = \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'construction','_id'=>$comp->id])->get()->toJson();
                                                            @$op_constOther = \App\Models\Filter\CpOtherMd::select('other')->where(['type'=>'construction','_id'=>$comp->id])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="compConstService" value="@if(!empty($op_constService)){{$op_constService}}@endif">
                                                        <input type="hidden" id="compConstOther" value="@if(!empty($op_constOther)){{$op_constOther}}@endif">
                                                    @break
                                                    @case(24) {{-------Leasing -------}}
                                                        @php
                                                            @$op_lesService = \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'leasing','_id'=>$comp->id])->get()->toJson();
                                                            @$op_lesLocation = \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'leasing','_id'=>$comp->id])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="compLesService" value="@if(!empty($op_lesService)){{$op_lesService}}@endif">
                                                        <input type="hidden" id="compLesLocation" value="@if(!empty($op_lesLocation)){{$op_lesLocation}}@endif">
                                                    @break
                                                    @case(28) {{------- Chemicals -------}}
                                                        @php
                                                            @$op_chemiType = \App\Models\Filter\CpTypeMd::select('_type as type')->where(['type'=>'chemicals','_id'=>$comp->id])->get()->toJson();
                                                            @$op_chemiService = \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'chemicals','_id'=>$comp->id])->get()->toJson();
                                                            @$op_chemiLocation = \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'chemicals','_id'=>$comp->id])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="chemiType" value="@if(!empty($op_chemiType)){{$op_chemiType}}@endif">
                                                        <input type="hidden" id="chemiService" value="@if(!empty($op_chemiService)){{$op_chemiService}}@endif">
                                                        <input type="hidden" id="chemiLocation" value="@if(!empty($op_chemiLocation)){{$op_chemiLocation}}@endif">
                                                    @break
                                                    @case(30) {{------- Foods -------}}
                                                        @php
                                                            @$op_fooType = \App\Models\Filter\CpTypeMd::select('_type')->where(['type'=>'foods','_id'=>$comp->id])->get()->toJson();
                                                            @$op_fooLocation = \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'foods','_id'=>$comp->id])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="fooType" value="@if(!empty($op_fooType)){{$op_fooType}}@endif">
                                                        <input type="hidden" id="fooLocation" value="@if(!empty($op_fooLocation)){{$op_fooLocation}}@endif">
                                                    @break
                                                    @case(31) {{------- IT -------}}
                                                        @php
                                                            @$op_itService = \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'it','_id'=>$comp->id])->get()->toJson();
                                                            @$op_itSoftware = \App\Models\Filter\CpSoftwareMd::select('software')->where(['type'=>'it','_id'=>$comp->id])->get()->toJson();
                                                            @$op_itHardware = \App\Models\Filter\CpHardwareMd::select('hardware')->where(['type'=>'it','_id'=>$comp->id])->get()->toJson();
                                                            @$op_itSolution = \App\Models\Filter\CpSolutionMd::select('solution')->where(['type'=>'it','_id'=>$comp->id])->get()->toJson();
                                                            @$op_itLocation = \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'it','_id'=>$comp->id])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="itService" value="@if(!empty($op_itService)){{$op_itService}}@endif">
                                                        <input type="hidden" id="itSoftware" value="@if(!empty($op_itSoftware)){{$op_itSoftware}}@endif">
                                                        <input type="hidden" id="itHardware" value="@if(!empty($op_itHardware)){{$op_itHardware}}@endif">
                                                        <input type="hidden" id="itSolution" value="@if(!empty($op_itSolution)){{$op_itSolution}}@endif">
                                                        <input type="hidden" id="itLocation" value="@if(!empty($op_itLocation)){{$op_itLocation}}@endif">
                                                    @break
                                                    @case(36) {{------- Textile & Garment -------}}
                                                        @php
                                                            @$tg_service = \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'textiles-garments','_id'=>$comp->id])->get()->toJson();
                                                            @$tg_location = \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'textiles-garments','_id'=>$comp->id])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="compTgService" value="@if(!empty($tg_service)){{$tg_service}}@endif">
                                                        <input type="hidden" id="compTgLocation" value="@if(!empty($tg_location)){{$tg_location}}@endif">
                                                    @break
                                                    @case(42) {{------- Contractors -------}}
                                                        @php
                                                            @$conService = \App\Models\Filter\CpServiceMd::select('service')->where(['type'=>'contractors','_id'=>$comp->id])->get()->toJson();
                                                            @$conOther = \App\Models\Filter\CpOtherMd::select('other')->where(['type'=>'contractors','_id'=>$comp->id])->get()->toJson();
                                                            @$conLocation = \App\Models\Filter\CpLocationMd::select('location')->where(['type'=>'foods','_id'=>$comp->id])->get()->toJson();
                                                        @endphp
                                                        <input type="hidden" id="constService" value="@if(!empty($conService)){{$conService}}@endif">
                                                        <input type="hidden" id="constOther" value="@if(!empty($conOther)){{$conOther}}@endif">
                                                        <input type="hidden" id="constLocation" value="@if(!empty($conLocation)){{$conLocation}}@endif">
                                                    @break
                                                    @default
                                                        
                                                @endswitch

                                            </div>

                                            <div id="area-filter" class="mb-3" style="border-top: 1px solid #5997fb; border-bottom: 1px solid #5997fb; padding-top: 10px;">
                                                <h5 style="color:#5997fb;">Filters</h5>
                                            </div>
                                          
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h5>รายละเอียดย่อ</h5>
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                          <a class="nav-link active" id="TH1-tab" data-toggle="tab" href="#TH1" role="tab" aria-controls="TH1" aria-selected="true">TH</a>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                          <a class="nav-link" id="JP1-tab" data-toggle="tab" href="#JP1" role="tab" aria-controls="JP1" aria-selected="false">JP</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade show active" id="TH1" role="tabpanel" aria-labelledby="TH1-tab">
                                                            <div class="form-group">
                                                                <textarea class="form-control" rows="5" name="description_th">{{$comp->description_th}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="JP1" role="tabpanel" aria-labelledby="JP1-tab">
                                                            <div class="form-group">
                                                                <textarea class="form-control" rows="5" name="description_jp">{{$comp->description_jp}}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <textarea name="detail_th" class="form-control" rows="17">{{$comp->detail_th}}</textarea>
                                                    <textarea name="detail_jp" class="form-control" rows="17">{{$comp->detail_jp}}</textarea>
                                     
                                                    <div class="from-group mt-3">
                                                        <h4>รายละเอียดเต็ม</h4>
                                                        
                                                    </div>

                                                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                          <a class="nav-link active" id="TH2-tab" data-toggle="tab" href="#TH2" role="tab" aria-controls="TH2" aria-selected="true">TH</a>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                          <a class="nav-link" id="JP2-tab" data-toggle="tab" href="#JP2" role="tab" aria-controls="JP2" aria-selected="false">JP</a>
                                                        </li>
                                                    </ul>
                                                    
                                                    {{--------------- Template -----------------}}
                                                    <div class="tab-content" id="myTab2Content">
                                                        <div class="tab-pane fade show active" id="TH2" role="tabpanel" aria-labelledby="TH2-tab">
                                                            <div class="row" >
                                                                <div class="col-12">
                                                                    <div class="sk-area" data-lang="th">
                                                                        <textarea name="more_th" id="more_th" class="sk-editor" hidden="">{{$comp->more_th}}</textarea>                                                                                                   
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="JP2" role="tabpanel" aria-labelledby="JP2-tab">
                                                            <div class="row" >
                                                                <div class="col-12">
                                                                    <div class="sk-area" data-lang="jp">
                                                                        <textarea name="more_jp" id="more_jp" class="sk-editor" hidden="">{{$comp->more_jp}}</textarea>                                                                                                   
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="text-right mt-3">
                                                                <button type="submit" class="text-right btn btn-success">บันทึก</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{--------------- /Template -----------------}}
                                                </div>

                                            </div>

                                            

                                            @php
                                                $gallery = \App\Models\Filter\CpGalleryMd::where('_id',$comp->id)->get();
                                            @endphp
                                            <hr/>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <h4>แกลเลอรี่</h4>
                                                </div>
                                            </div>
                                            <div class="row" id="gallery_preview">
                                                @if($gallery)
                                                    @foreach($gallery as $gal)
                                                        <div class="col-lg-4" id="gal_{{$gal->id}}">
                                                            <div style="position:relative;">
                                                                <button type="button" class="close AClass" aria-label="Close">
                                                                    <span aria-hidden="true" onclick="removeGalleryData({{$gal->id}});">&times;</span>
                                                                </button>
                                                                <img src="{{$gal->image}}" class="img-thumbnail" >
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-lg-6">
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="gallery" lang="th" name="gallery[]" onchange="readGallery('gallery',this)" multiple="multiple">
                                                        <label class="custom-file-label" for="gallery">Choose file</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr/>
                                            @php
                                                $op_working_hours = DB::table('cp_working_hours')->select('id','day','time')->where('_id',$comp->id)->get();
                                                $array_working_hours = [];
                                                foreach($op_working_hours as $value){
                                                    array_push($array_working_hours,$value->day);
                                                }
                                            @endphp
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label>เวลาทำการ</label>
                                                    <table class="table" id="areaWorkTime">
                                                    @if(!empty($op_working_hours))
                                                    @foreach ($op_working_hours as $k => $work )
                                                        <input type="hidden" name="time_id[{{$k}}]" value="{{$work->id}}">
                                                        <tr id="working_{{$work->id}}" class="workItem">
                                                            <td>
                                                                <select class="form-control" name="cp_working_day[{{$k}}]">
                                                                    <option value="">โปรดเลือกวัน</option>
                                                                    @foreach ( $day as $d )
                                                                        <option value="{{$d->id}}" @if($d->id == $work->day) selected @endif>{{$d->name_th}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="cp_working_time[{{$k}}]" value="{{$work->time}}">
                                                            </td>
                                                            <td>
                                                                <a href="javascript:void(0)" class="deleteItemWork" data-id="{{$work->id}}" data-cp="{{$comp->id}}">ลบ</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    @endif
                                                    </table>
                                                    <a class="btn btn-info" id="btnAddWork">เพิ่ม</a>
                                                </div>
                                            </div>
                                            <hr/>
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>เบอร์โทร</label>
                                                        <input type="text" name="phone" value="{{$comp->phone}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>อีเมล</label>
                                                        <input type="email" name="email" value="{{$comp->comp_email}}" class="form-control" placeholder="test@hotmail.com" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>เว็บไซต์</label>&nbsp;<small class="text-danger">ไม่ต้องเติม https:// ด้านหน้า</small>
                                                        <input type="text" name="website" value="{{$comp->website}}" class="form-control" placeholder="www.at-once.info" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Facebook</label>
                                                        <input type="text" name="facebook" value="{{$comp->facebook}}" class="form-control" placeholder="https://www.facebook.com/JobsLaboRecruitment" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Line</label>
                                                        <input type="text" name="line" value="{{$comp->line}}" class="form-control" placeholder="" >
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <ul class="nav nav-tabs" id="myTab3" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                          <a class="nav-link active" id="TH3-tab" data-toggle="tab" href="#TH3" role="tab" aria-controls="TH3" aria-selected="true">TH</a>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                          <a class="nav-link" id="JP3-tab" data-toggle="tab" href="#JP3" role="tab" aria-controls="JP3" aria-selected="false">JP</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="myTab3Content">
                                                        <div class="tab-pane fade show active" id="TH3" role="tabpanel" aria-labelledby="TH3-tab">
                                                            <div class="form-group">
                                                                <label>ที่อยู่ (TH)</label>
                                                                <textarea name="address_th" class="form-control" rows="3">{!!$comp->address_th!!}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade show" id="JP3" role="tabpanel" aria-labelledby="JP3-tab">
                                                            <div class="form-group">
                                                                <label>ที่อยู่ (JP)</label>
                                                                <textarea name="address_jp" class="form-control" rows="3">{!!$comp->address_jp!!}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text"><i class="fas fa-home"></i></div>
                                                        </div>
                                                        <input type="text" id="postcode" data-name="postcode[]" class="form-control"  placeholder="Postcode" autocomplete="new-postcode" value="{{$comp->postcode}}">
                                                        <input type="text" id="subdistrict" data-name="subdistrict[]" class="form-control"  placeholder="Subdistrict" readonly="" value="{{$comp->subdistrict}}">
                                                        <input type="text" id="district" data-name="district[]" class="form-control"  placeholder="District" readonly="" value="{{$comp->district}}">
                                                        <input type="text" id="province" data-name="province[]" class="form-control"  placeholder="Province" readonly="" value="{{$comp->province}}">
                                                    </div>
                                                    {{-- <input type="hidden" name="postcode" value="{{$comp->postcode}}">
                                                    <input type="hidden" name="subdistrict" value="{{$comp->subdist_id}}">
                                                    <input type="hidden" name="district" value="{{$comp->district_id}}">
                                                    <input type="hidden" name="province" value="{{$comp->province_id}}"> --}}
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <label>Google Map</label>
                                                        <textarea name="gmap"  class="form-control" rows="5">{!!$comp->gmap!!}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row text-right">
                                                <div class="col-lg-12">
                                                    <div id="areaAlert"></div>
                                                    <button type="submit" class="btn btn-success">Save</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>
                                <div class="card-footer text-center bg-light">
                                    {{\App\Helpers\BaseHp::time_passed_backend($comp->updated)}}
                                </div>
                            </div>
                        </form>
                                      
                        </div>
                </div>            
            </div>
        </div>              
    </div>         

<script>
    function convertArray(elm,objName){
        var newArray  = [];
        elm = (elm!='')?JSON.parse(elm):[];
        elm.forEach(function(v,i){
            newArray.push(v[objName]);
        });

        return newArray;
    }
    function arrayToFloat(el,obj)
    {
        var newArray  = [];
        el = (el!='')?JSON.parse(el):[];
        if(el.length>0){
            el.forEach(function(v,i){
                newArray.push(parseFloat(v[obj]));
            });
        }
        return newArray;
    }


        // insertFilter($('#industry').val());
        // $('#industry').change(function(){
        //     insertFilter($(this).val());
        // });
        function filters(){
            const filters = $.ajax({method:'get',url:'webpanel/members/filter',async:false,dataType:"json",data:{category:$('#category').val()}}).responseJSON;
            return filters;
        }
        $(document).on('change','#category',function(){
            insertFilter(parseFloat($(this).val()),filters());
        })
        insertFilter(parseFloat($('#category').val()),filters())
        function insertFilter(type,filters){
            var html ="";
            $('#area-filter').children().not('h5').html('');    
            switch (type) {
                case 1: /////// Logistics ///////
                    obj = $('<div class="row"><div class="col-lg-4"><div class="form-group"><label><input type="checkbox" name="domestic" value="1">&nbsp;การขนส่งภายในประเทศไทย</label></div><div class="form-group"><label><input type="checkbox" name="pac" value="1">&nbsp;การห่อ/บรรจุ</label></div></div></div>');
                    var internationalArrVal=[], methodArrVal=[];
                    var compDomestic = parseInt($('#compDomestic').val());
                    var compPac = parseInt($('#compPac').val());
                    var compInternationalArray = convertArray($('#compInternational').val(),'transport');
                    var compMethodArray = convertArray($('#compMethod').val(),'method');
                    var compWarehouseArray = convertArray($('#compWarehouse').val(),'warehouse');
                    var compItemArray = convertArray($('#compItem').val(),'item');
                    var compServiceArray = arrayToFloat($('#compService').val(),'service');
                    var compLocationArray = arrayToFloat($('#compLocation').val(),'location');
                    if( compDomestic==1 ){ obj.find('input[name="domestic"]').attr('checked','checked'); }
                    // if( compPac==1 ){ obj.find('input[name="pac"]').attr('checked','checked'); }
                    $.each(filters,function(key,val){
                        let label = {['international']:'การขนส่งระหว่างประเทศ',['method']:'วิธีการข่นส่ง',['warehouse']:'โกดัง',['item']:'รายการข่นส่ง',['service']:'บริการ',['location']:'ที่ตั้ง'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        if (key == 'international' || key=='method') $('<label class="ml-1" style="font-size:12px;"><input type="checkbox" class="ml-1" id="'+key+'All" > เลือกทั้งหมด</label>').insertAfter(select.find('label'));
                        $.each(val,function(k,v){
                            let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');
                            console.log(key)
                            if(key=='international'){ 
                                if(compInternationalArray.indexOf(v.key.toString())>-1)option.attr('selected',true);
                                internationalArrVal.push(v.key);
                            }
                            if(key=='method'){ 
                                if(compMethodArray.indexOf(v.key.toString())>-1)option.attr('selected',true);
                                methodArrVal.push(v.key);
                            }
                            if(key=='item'){ if(compItemArray.indexOf(v.key)> -1) option.attr('selected',true); }
                            if(key=='warehouse'){ if(compWarehouseArray.indexOf(v.key.toString())> -1) option.attr('selected',true); }
                            if(key=='service'){ if(compServiceArray.indexOf(v.key)> -1) option.attr('selected',true); }
                            if(key=='location'){ if(compLocationArray.indexOf(v.key)> -1) option.attr('selected',true); }
                            select.find('select').append(option);
                        })                        
                        obj.append(select);
                    });
                    $('#area-filter').html(obj);
                    $('#area-filter').prepend('<h5 style="color:5997fb;">Filters</h5>');
                    var data = [internationalArrVal,methodArrVal];
                    var interSelected = $('#international').find(":selected");
                    var methodSelected = $('#method').find(":selected");
       
                    if(interSelected.length==filters['international'].length){ $('#internationalAll').attr('checked','checked'); }
                    if(methodSelected.length==filters['method'].length){ $('#methodAll').attr('checked','checked'); }
                    let international = new SlimSelect({select:'#international'});
                    let method =  new SlimSelect({select:'#method'});
                    new SlimSelect({select:'#warehouse'});
                    new SlimSelect({select:'#item'});
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#location'});

                    $(document).on('click','#internationalAll',function(){if($(this).is(':checked'))international.set(data[0]);else international.set([]);});
                    $(document).on('click','#methodAll',function(){if($(this).is(':checked'))method.set(data[1]);else method.set([]);});
                    break;
                case 2: /////// Solar cell ///////
                    obj = $('<div class="row"></div>');
                    const compLocation = convertArray($('#compLocationSolar').val(),'location');
                    const compCondition = convertArray($('#compCondition').val(),'condition');
                    $.each(filters,function(key,val){
                        let label = {['location']:'จังหวัด',['condition']:'เงือนไข'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            const option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='location'){ if(compLocation.indexOf(v.key.toString())>-1) option.attr('selected',true);}
                            if(key=='condition'){ if(compCondition.indexOf(v.key.toString())>-1) option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);                    
                    new SlimSelect({select:'#condition'});
                    new SlimSelect({select:'#location'});
                    break;
                case 3: ////// Translater ///////
                    var compUrgent = ($('#compUrgent').val()==1)?'checked':'';
                    var compPostpay = ($('#compPostpay').val()==1)?'checked':'';
                    obj = $('<div class="row"><div class="col-lg-4"><div class="form-group"><label><input type="checkbox" name="urgent" value="1" '+compUrgent+'>&nbsp;รองรับงานด่วน</label></div></div><div class="col-lg-4"><div class="form-group"><label><input type="checkbox" name="postpay" value="1" '+compPostpay+'>&nbsp;จ่ายภายหลัง</label></div></div></div>');
                    const compTranslate = convertArray($('#compTranslate').val(),'translate');
                    const compSpeciality = convertArray($('#compSpeciality').val(),'speciality');
                    const compStatus = convertArray($('#compStatus').val(),'status');
                    $.each(filters,function(key,val){
                        let label = {['translate']:'แปลภาษา',['speciality']:'เชี่ยวชาญ',['status']:'สถานะ'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='translate'){ if(compTranslate.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='speciality'){ if(compSpeciality.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='status'){ if(compStatus.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#translate'});
                    new SlimSelect({select:'#speciality'});
                    new SlimSelect({select:'#status'});
                    break;
                case 4: /////// Car Rental ///////
                    obj = $('<div class="row"></div>');
                    var carTypeArrVal=[], compPeriodArrVal=[],compOtherArrVal=[];
                    const compCarType = convertArray($('#compCarType').val(),'type');
                    const compLocationAuto = convertArray($('#compLocationAuto').val(),'location');
                    const compPeriod = convertArray($('#compPeriod').val(),'period');
                    const compOtherCondition = convertArray($('#compOtherCondition').val(),'condition');
                    $.each(filters,function(key,val){
                        let label = {['carType']:'ชนิดของรถ',['location']:'สถานที่ตั้ง',['period']:'ระยะเวลาของสัญญา',['other']:'เงื่อนไขอื่นๆ'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        if (key != 'location') $('<label class="ml-1" style="font-size:12px;"><input type="checkbox" class="ml-1" id="'+key+'All" > เลือกทั้งหมด</label>').insertAfter(select.find('label'));
                        $.each(val,function(k,v){
                            let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='carType'){ if(compCarType.indexOf(v.key)>-1)option.attr('selected',true); carTypeArrVal.push(v.key); }
                            if(key=='location'){ if(compLocationAuto.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='period'){ if(compPeriod.indexOf(v.key)>-1)option.attr('selected',true); compPeriodArrVal.push(v.key); }
                            if(key=='other'){ if(compOtherCondition.indexOf(v.key.toString())>-1)option.attr('selected',true); compOtherArrVal.push(v.key); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    var data = [carTypeArrVal,compPeriodArrVal,compOtherArrVal];
                    let carType = new SlimSelect({select:'#carType'});
                    new SlimSelect({select:'#location'});
                    let period = new SlimSelect({select:'#period'});
                    let other = new SlimSelect({select:'#other'});
                    if($('#carTypeAll').is(':checked')){carType.set(data[0]);$(this).prop('checked',true);}
                    $(document).on('click','#carTypeAll',function(){if($(this).is(':checked')) carType.set(data[0]); else carType.set([]);});
                    if($('#periodAll').is(':checked')){period.set(data[1]);$(this).prop('checked',true);}
                    $(document).on('click','#periodAll',function(){if($(this).is(':checked')) period.set(data[1]); else period.set([]);});
                    if($('#otherAll').is(':checked')){other.set(data[2]);; $(this).prop('checked',true);}
                    $(document).on('click','#otherAll',function(){if($(this).is(':checked')) other.set(data[2]); else other.set([]);});
                    break;
                case 5: /////// Visa Support ///////
                    const compLocationVisa = convertArray($('#compLocationVisa').val(),'location');
                    const compVisa = convertArray($('#compVisa').val(),'visa');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['location']:'สถานที่ตั้ง',['visa']:'ประเภทวีซ่า'};
                        let col= {['location']:'col-lg-4',['visa']:'col-lg-8'}
                        let select = $('<div class="'+col[key]+'"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='location'){ if(compLocationVisa.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='visa'){ if(compVisa.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);}
                        );                      
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#location'});
                    new SlimSelect({select:'#visa'});
                    break;
                case 6: /////// Company Register ///////
                    const compLocationCR = convertArray($('#compLocationCR').val(),'location');
                    const compConsulting = convertArray($('#compConsulting').val(),'consulting');
                    const compServiceCR = convertArray($('#compServiceCR').val(),'service');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['location']:'สถานที่ตั้ง',['consulting']:'ปรึกษาด้านการจัดการ',['service']:'บริการ'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='location'){ if(compLocationCR.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='consulting'){ if(compConsulting.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='service'){ if(compServiceCR.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });                     
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#location'});
                    new SlimSelect({select:'#consulting'});
                    new SlimSelect({select:'#service'});
                    break;
                case 7: /////// Warehouse ///////
                    const compLocationWH = convertArray($('#compWarehouseLocation').val(),'location');
                    const compType = convertArray($('#compTypeOfWarehouse').val(),'warehouse'); 
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['location']:'สถานที่ตั้ง',['type']:'ประเภทคลังสินค้า'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='location'){ if(compLocationWH.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='type'){ if(compType.indexOf(v.key)>-1)option.attr('selected',true); }
                            
                            select.find('select').append(option);
                        });                     
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#location'});
                    new SlimSelect({select:'#type'});                    
                    break;
                case 8: /////// Printing ///////
                    const compPrinting = convertArray($('#compTypeOfPrinting').val(),'printing');
                    const compMinimum = convertArray($('#compMinimum').val(),'minimum');
                    const compOther = convertArray($('#compOther').val(),'service');
                    const compLocationPt = convertArray($('#compPrintingLocation').val(),'location');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['type']:'ประเภทการพิมพ์',['minimum']:'ขั้นต่ำการสั่งซื้อ',['service']:'บริการอื่นๆ',['location']:'สถานที่ตั้ง'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='type'){ if(compPrinting.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='minimum'){ if(compMinimum.indexOf(v.key.toString())>-1)option.attr('selected',true); }
                            if(key=='service'){ if(compOther.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(compLocationPt.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });                     
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#type'});
                    new SlimSelect({select:'#location'});
                    new SlimSelect({select:'#minimum'});
                    new SlimSelect({select:'#service'});
                    break;
                case 9:  /////// Accounting ///////
                    obj = $('<div class="row"></div>');
                    const compAccService = convertArray($('#compAccService').val(),'service');
                    const compAccOther = convertArray($('#compAccOther').val(),'other');
                    const compAccNationality = convertArray($('#compAccNationality').val(),'nationality');
                    const compAccLocation = convertArray($('#compAccLocation').val(),'location');
                    $.each(filters,function(key,val){
                        let label = {['service']:'บริการ',['other']:'บริการอื่นๆ',['nationality']:'สัญชาติ',['location']:'สถานที่ตั้ง'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='service'){ if(compAccService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='other'){ if(compAccOther.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='nationality'){ if(compAccNationality.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(compAccLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });                     
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#other'});
                    new SlimSelect({select:'#nationality'});
                    new SlimSelect({select:'#location'});
                    break;
                case 10: /////// Law Firm ///////
                    const compLawService = convertArray($('#compLawService').val(),'service');
                    const compLawOther = convertArray($('#compLawOther').val(),'other');
                    const compLawLanguage = convertArray($('#compLawLanguage').val(),'language');
                    const compLawLocation = convertArray($('#compLawLocation').val(),'location');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['service']:'บริการ',['other']:'บริการอื่นๆ',['language']:'ภาษา',['location']:'สถานที่ตั้ง'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='service'){ if(compLawService.indexOf(v.key)>-1)option.attr('selected',true); }                                                 
                            if(key=='other'){ if(compLawOther.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='language'){ if(compLawLanguage.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(compLawLocation.indexOf(v.key)>-1)option.attr('selected',true); }       
                            select.find('select').append(option);
                        });                     
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#other'});
                    new SlimSelect({select:'#language'});
                    new SlimSelect({select:'#location'});
                    break;
                case 11: /////// Web Marketing ///////
                    const compMarkLocation = convertArray($('#compMarkLocation').val(),'location');
                    const compMarkService = convertArray($('#compMarkService').val(),'service');
                    const compMarkLanguage = convertArray($('#compMarkLanguage').val(),'language');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['service']:'บริการ',['language']:'ภาษา',['location']:'สถานที่ตั้ง'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='service'){ if(compMarkService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='language'){ if(compMarkLanguage.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(compMarkLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });                   
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#location'});
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#language'});
                    break;
                case 12: /////// Recruitment ///////
                    const compRecruitPosition = convertArray($('#compRecruitPosition').val(),'position');
                    const compRecruitNationality = convertArray($('#compRecruitNationality').val(),'nationality');
                    const compRecruitType = convertArray($('#compRecruitType').val(),'type');
                    const compRecruitLocation = convertArray($('#compRecruitLocation').val(),'location');
                    obj = $('<div class="row"></div>');
                    let col= {['position']:'col-lg-8',['nationality']:'col-lg-4',['type']:'col-lg-4',['location']:'col-lg-4'};
                    $.each(filters,function(key,val){
                        let label = {['position']:'ตำแหน่งงาน',['nationality']:'สัญชาติ',['type']:'ประเภทการจ้าง',['location']:'พื้นที่'};
                        let select = $('<div class="'+col[key]+'"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='position'){ if(compRecruitPosition.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='nationality'){ if(compRecruitNationality.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='type'){ if(compRecruitType.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(compRecruitLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#position'});
                    new SlimSelect({select:'#nationality'});
                    new SlimSelect({select:'#type'});
                    new SlimSelect({select:'#location'});
                    break;
                case 13: /////// Web System ///////
                    const compWebLocation = convertArray($('#compWebLocation').val(),'location');
                    const compWebService = convertArray($('#compWebService').val(),'service');
                    const compWebLanguage = convertArray($('#compWebLanguage').val(),'language');
                    const compWebOther = convertArray($('#compWebOther').val(),'other');
                    var obj = $('<div class="row"></div>');
                    const col13 = {['location']:'col-lg-8',['service']:'col-lg-4',['language']:'col-lg-4',['other']:'col-lg-4'};
                    $.each(filters,function(key,val){
                        let label = {['location']:'พื้นที่',['service']:'บริการ',['language']:'ภาษา',['other']:'บริการอื่นๆ'};
                        let select = $('<div class="'+col13[key]+'"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='location'){ if(compWebLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='service'){ if(compWebService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='language'){ if(compWebLanguage.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='other'){ if(compWebOther.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#location'});
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#other'});
                    new SlimSelect({select:'#language'});
                    break;
                case 14: /////// Service Office/Co Working ///////
                    const compCoLocation = convertArray($('#compCoLocation').val(),'location');
                    const compCoType = convertArray($('#compCoType').val(),'type');
                    const compCoService = convertArray($('#compCoService').val(),'service');
                    const compCoSeat = convertArray($('#compCoSeat').val(),'seat');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['location']:'พื้นที่',['type']:'ประเภทออฟฟิศ',['service']:'บริการ',['seat']:'ที่นั่ง'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='location'){ if(compCoLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='type'){ if(compCoType.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='service'){ if(compCoService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='seat'){ if(compCoSeat.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#location'});
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#type'});
                    new SlimSelect({select:'#seat'});
                    break;
                case 15: /////// Office rent ///////
                    const compOffLocation = convertArray($('#compOffLocation').val(),'location');
                    const compOffService = convertArray($('#compOffService').val(),'service');
                    const compOffContract = convertArray($('#compOffContract').val(),'contract');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['service']:'บริการ',['contract']:'ระยะเวลาสัญญา',['location']:'พื้นที่'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='location'){ if(compOffLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='service'){ if(compOffService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='contract'){ if(compOffContract.indexOf(v.key.toString())>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#location'});
                    new SlimSelect({select:'#contract'});
                    new SlimSelect({select:'#service'});
                    break;
                case 16: /////// Construction machine ///////                    
                    const compConsType = convertArray($('#compConsType').val(),'type');
                    const compConsService = convertArray($('#compConsService').val(),'service');
                    const compConsLocation = convertArray($('#compConsLocation').val(),'location');
                    const compConsRental = convertArray($('#compConsRental').val(),'rental');
                    
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['type']:'ประเภทรถ',['service']:'บริการ',['rental']:'รูปแบบการเช่า',['location']:'พื้นที่'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='type'){ if(compConsType.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='service'){ if(compConsService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='rental'){ if(compConsRental.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(compConsLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#type'});
                    new SlimSelect({select:'#rental'});
                    new SlimSelect({select:'#location'});
                    break;
                case 17: /////// Forklift ///////
                    const compForkService = convertArray($('#compForkService').val(),'service');
                    const compForkType = convertArray($('#compForkType').val(),'type');
                    const compForkFuel = convertArray($('#compForkFuel').val(),'fuel');
                    const compForkLocation = convertArray($('#compForkLocation').val(),'location');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['service']:'บริการ',['type']:'ประเภทสินค้า',['fuel']:'ระบบเชิ้อเพลิง',['location']:'พื้นที่'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='service'){ if(compForkService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='type'){ if(compForkType.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='fuel'){ if(compForkFuel.indexOf(v.key.toString())>-1)option.attr('selected',true); }
                            if(key=='location'){ if(compForkLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });          
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#type'});
                    new SlimSelect({select:'#fuel'});
                    new SlimSelect({select:'#location'});
                    break;
                case 18: /////// Interior Design ///////
                    const compIntService = convertArray($('#compIntService').val(),'service');
                    const compIntLocation = convertArray($('#compIntLocation').val(),'location');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['service']:'บริการ',['location']:'พื้นที่'};
                        let select = $('<div class="col-lg-6"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='service'){ if(compIntService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(compIntLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#location'});
                    break;
                case 19: /////// Security System ///////
                    const compSecService = convertArray($('#compSecService').val(),'service');
                    const compSecLocation = convertArray($('#compSecLocation').val(),'location');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['service']:'บริการ',['location']:'พื้นที่'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='service'){ if(compSecService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(compSecLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                            });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#location'});
                    break;
                case 20: /////// Real Estate Agent ///////
                    const compRealService = convertArray($('#compRealService').val(),'service');
                    const compRealType = convertArray($('#compRealType').val(),'type');
                    const compRealLocation = convertArray($('#compRealLocation').val(),'location');
                    const compRealNationality = convertArray($('#compRealNationality').val(),'nationality');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['service']:'บริการ',['type']:'ประเภทสินทรัพย์',['location']:'พื้นที่',['nationality']:'สัญชาติของนายหน้า'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='service'){ if(compRealService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='type'){ if(compRealType.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(compRealLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='nationality'){ if(compRealNationality.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#type'});
                    new SlimSelect({select:'#location'});
                    new SlimSelect({select:'#nationality'});
                    break;
                case 21: /////// Package ///////
                    const compPackService = convertArray($('#compPackService').val(),'service');
                    const compPackOther = convertArray($('#compPackOther').val(),'other');
                    const compPackLocation = convertArray($('#compPackLocation').val(),'location');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['service']:'บริการ',['other']:'บริการอื่นๆ',['location']:'พื้นที่'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='service'){ if(compPackService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='other'){ if(compPackOther.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(compPackLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#other'});
                    new SlimSelect({select:'#location'});
                    break;
                case 22: /////// Insurance ///////
                    const compInsPersonal = convertArray($('#compInsPersonal').val(),'personal');
                    const compInsBusiness = convertArray($('#compInsBusiness').val(),'business');
                    console.log(compInsBusiness);
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['personal']:'ประกันภัยรายบุคคล',['business']:'ประกันภัยรายบริษัท'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='personal'){ if(compInsPersonal.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='business'){ if(compInsBusiness.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#personal'});
                    new SlimSelect({select:'#business'});
                    break;
                case 23: /////// Construction ///////
                    const compConstService = convertArray($('#compConstService').val(),'service');
                    const compConstOther = convertArray($('#compConstOther').val(),'other');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['service']:'งานก่อสร้าง',['other']:'บริการอื่นๆ'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='service'){ if(compConstService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='other'){ if(compConstOther.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#other'});
                    break;
                case 24: /////// Leasing ///////
                    const compLesService = convertArray($('#compLesService').val(),'service');
                    const compLesLocation = convertArray($('#compLesLocation').val(),'location');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['service']:'ประเภทสินเชื่อ',['location']:'บริการอื่นๆ'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='service'){ if(compLesService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(compLesLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#location'});
                break;
                case 28: ///////======= Chemicals =======///////
                    const chemiType = convertArray($('#chemiType').val(),'type');
                    console.log(chemiType);
                    const chemiService = convertArray($('#chemiService').val(),'service');
                    const chemiLocation = convertArray($('#chemiLocation').val(),'location');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['type']:'ประเภทสินค้า',['service']:'บริการอื่นๆ',['location']:'พื้นที่'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='type'){ if(chemiType.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='service'){ if(chemiService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(chemiLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#type'});
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#location'});
                break;
                case 30: ///////======= Foods =======///////
                    const fooType = convertArray($('#fooType').val(),'_type');
                    const fooLocation = convertArray($('#fooLocation').val(),'location');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['type']:'ประเภทสินค้า',['location']:'สถานที่ตั้ง'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='type'){ if(fooType.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(fooLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#type'});
                    new SlimSelect({select:'#location'});
                break;
                case 31: ///////======= IT =======///////
                    const itType = convertArray($('#itService').val(),'service');
                    const itSoftware = convertArray($('#itSoftware').val(),'software');
                    const itHardware = convertArray($('#itHardware').val(),'hardware');
                    const itSolution = convertArray($('#itSolution').val(),'solution');
                    const itLocation = convertArray($('#itLocation').val(),'location');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['service']:'บริการ',['software']:'ซอฟต์แวร์',['hardware']:'ฮาร์ดแวร์',['solution']:'โซลูชั่น',['location']:'สถานที่ตั้ง'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='service'){ if(itType.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='software'){ if(itSoftware.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='hardware'){ if(itHardware.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='solution'){ if(itSolution.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(itLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#software'});
                    new SlimSelect({select:'#hardware'});
                    new SlimSelect({select:'#solution'});
                    new SlimSelect({select:'#location'});
                break;
                case 36: ///////======= Textiles & Garments =======///////
                    var compTgService = convertArray($('#compTgService').val(),'service');
                    var compTgLocation = convertArray($('#compTgLocation').val(),'location');
                    obj = $('<div class="row"></div>');
                    console.log($('#compTgService').val());
                    $.each(filters,function(key,val){
                        let label = {['service']:'บริการ',['location']:'สถานที่ตั้ง'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='service'){ if(compTgService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(compTgLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#location'});
                break;
                case 42: ///////======= Contractors =======///////
                    const conService = convertArray($('#constService').val(),'service');
                    const conOther = convertArray($('#constOther').val(),'other');
                    const conLocation = convertArray($('#constLocation').val(),'location');
                    obj = $('<div class="row"></div>');
                    $.each(filters,function(key,val){
                        let label = {['service']:'บริการ',['other']:'รายการ',['location']:'สถานที่ตั้ง'};
                        let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                        $.each(val,function(k,v){
                            let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');
                            if(key=='service'){ if(conService.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='other'){ if(conOther.indexOf(v.key)>-1)option.attr('selected',true); }
                            if(key=='location'){ if(conLocation.indexOf(v.key)>-1)option.attr('selected',true); }
                            select.find('select').append(option);
                        });
                        obj.append(select);
                    });
                    $('#area-filter').append(obj);
                    new SlimSelect({select:'#service'});
                    new SlimSelect({select:'#other'});
                    new SlimSelect({select:'#location'});
                break;
                default:
                    break;
            }

        }
        
        new SlimSelect({select:'#category'});
        new SlimSelect({select:'#country'});
        $("#image").on('change',function(){
            var $this = $(this);
            var input = $(this)[0];
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#preview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);

                $this.siblings(".custom-file-label").addClass("selected").html(input.files[0].name.toString());
            }
        });
        $("#bg_image").on('change',function(){
            var $this = $(this);
            var input = $(this)[0];
            if (input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#bg_preview').attr('src', e.target.result).fadeIn('slow');
                }
                reader.readAsDataURL(input.files[0]);

                $this.siblings(".custom-file-label").addClass("selected").html(input.files[0].name.toString());
            }
        });
        $('#btnAddWork').click(function(){
            var stringRand = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
            var html = '<tr id="working_'+stringRand+'" class="workItem">\
                            <td>\
                                <select class="form-control" name="cp_working_day_add['+stringRand+']">\
                                    <option value="">โปรดเลือกวัน</option>\
                                    @foreach ( $day as $d )\
                                        <option value="{{$d->id}}">{{$d->name_th}}</option>\
                                    @endforeach\
                                </select>\
                            </td>\
                            <td>\
                                <input type="text" class="form-control" name="cp_working_time_add['+stringRand+']" value="">\
                            </td>\
                            <td>\
                                <a href="javascript:void(0)" class="deleteItemWorkNomal" data-id="'+stringRand+'">ลบ</a>\
                            </td>\
                        </tr>';
            $('#areaWorkTime').append(html);
        });
        // $('#gallery').filer();
        
        $('#postcode').addressAuto({
            subdistict : '#subdistrict',
            distict : '#subdistrict',
            province : '#province',
            width : 500,
            top : 2190
        })


    $('.saveData').click(function(){
        showAlert('areaAlert_30');
    });

    
    function showAlert(area){
        var html = '<div class="alert alert-success alert-dismissible fade show">\
                    <strong>สำเร็จ !</strong> บันทึกข้อมูลเรียบร้อย.\
                    <button type="button" class="close" data-dismiss="alert">&times;</button>\
                </div>';
        return $('#'+area).html(html);
    }
    // tinymce.init({
	// 	selector: 'textarea.tiny1',
	// 	menubar : false,
	// 	force_br_newlines : true,
    //     force_p_newlines : false,
    //     height: 200, 
    //     plugins: ["code textcolor"],    
    //     toolbar: 'undo redo code bold italic forecolor backcolor',
    //     formats: {
    //         h1: { block: 'h1', classes: 'heading' }
    //     },
    // });
    // tinymce.init({
	// 	selector: 'textarea.tiny',
	// 	menubar : false,
	// 	force_br_newlines : true,
	// 	force_p_newlines : false,
	// 	forced_root_block : '',
	// 	height: 400, 
    //     //width : 1100,
    //     relative_urls : false,
    //     remove_script_host : false,
    //     convert_urls : true,
    //     plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","save table contextmenu directionality emoticons template paste textcolor colorpicker layer textpattern moxiemanager"],    
    //     toolbar: 'insertfile undo redo | table | styleselect fontselect fontsizeselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | print nonbreaking hr emoticons code',
        
    // });

    $(document).on('click','.deleteItemWorkNomal',function(){
        var id = $(this).data('id');
        $('#working_'+id).slideUp("slow", function() { $(this).remove(); } );
    });
    $('.deleteItemWork').click(function(){
        Swal.fire({
        title: 'ต้องการลบใช่หรือไม่ ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่ !'
        }).then((result) => {
            if (result.isConfirmed) {
                // OpenLoading();
                var id = $(this).data('id');
                var cp_id = $(this).data('cp');
                var token = "{{csrf_token()}}";
                $.ajax({
                    type:'post',
                    url:'{{url($prefix.$segment."/deleteItemTime")}}',
                    data: {id: id ,_token:token,cp_id:cp_id},
                        success: function (data) {
                                // CloseLoading();
                                Swal.fire(
                                    'สำเร็จ !',
                                    'ลบรายการออกแล้ว',
                                    'success'
                                ).then((result)=>{
                                    $('#working_'+id).slideUp("slow", function() { $(this).remove(); } );
                                })
                        },
                        error: function() {
                            // CloseLoading();
                            Swal.fire(
                                'Error!',
                                'มีบางอย่างผิดพลาด !',
                                'error'
                            )
                        }
                });
            }
        })

    });
    $(document).on('change','input[name="category"]',function(){
        $.ajax({method:'get',url:'webpanel/member/filter',data:{category:$(this).val(),success:function(){}}})
    })
    function readGallery(input,id)
    {
        if (input.files && input.files[0])
        {
            var reader = new FileReader();
            reader.onload = function (e)
            {
                $("#"+id).css("display", "block").prop("src", e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function readGallery(input,id) 
    {
        var total_file=document.getElementById("gallery").files.length;
        var stringRand = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
        $('.gal_add').remove();
        for(var i=0;i<total_file;i++)
        {
            var html = '<div class="col-lg-4 gal_add_'+'" id="gal_add_'+stringRand+'" >\
                               <img class="img-thumbnail" src="'+URL.createObjectURL(event.target.files[i])+'">\
                        </div>';
            $('#gallery_preview').append(html);
        }
    }
    function removeGalleryData(id){
        Swal.fire({
        title: 'ต้องการลบใช่หรือไม่ ?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'ใช่ !'
        }).then((result) => {
            if (result.isConfirmed) {
                // OpenLoading();
                var token = "{{csrf_token()}}";
                $.ajax({
                    type:'post',
                    url:'{{url($prefix.$segment."/deleteItemGallery")}}',
                    data: {id:id,_token:token},
                        success: function (data) {
                                // CloseLoading();
                                Swal.fire(
                                    'สำเร็จ !',
                                    'ลบรายการออกแล้ว',
                                    'success'
                                ).then((result)=>{
                                    $('#gal_'+id).slideUp("slow", function() { $(this).remove(); } );
                                })
                        },
                        error: function() {
                            // CloseLoading();
                            Swal.fire(
                                'Error!',
                                'มีบางอย่างผิดพลาด !',
                                'error'
                            )
                        }
                });
            }
        })
    }
    var re = new RegExp("^([ก-๙]|[a-z]|[0-9]|[/]|[\\]|[ ]|[\n]|[.]|[ๅภถุึคตจขชๆไำพะัีรนยบลฃฟหกดเ้่าสวงผปแอิืทมใฝ๑๒๓๔ู฿๕๖๗๘๙๐ฎฑธํ๊ณฯญฐฅฤฆฏโฌ็๋ษศซฉฮฺ์ฒฬฦ])+$", "g");
    // patternTH = re.compile("[^\u0E00-\u0E7Fa-zA-Z' ]|^'|'$|''");

    // $('input[name="name_th"]').on('keyup change',function(){
    //     var pattern_thai = /^[ก-๏\s]+$/u;
    //     var input_name_th = $(this).val();
    //     if(!input_name_th.match(pattern_thai)) $(this).addClass('is-invalid'); else $(this).removeClass('is-invalid');
    
        
    // })
    
</script>      

<div class="modal fade" id="VideoUpload" tabindex="-1" role="dialog" aria-labelledby="VideoUploadLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="VideoUploadLabel">Video</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12" style="border-bottom: 1px solid #dedede; padding-bottom:10px;">
                        <div class="float-left">
                            <button type="button" id="uploadZoneBtn" class="btn btn-sm btn-primary">Upload</button>
                            <button type="button" id="uploadBack" class="btn btn-sm btn-secondary" style="display:none;">Back</button>
                        </div>
                        <div class="float-right view-group">
                            <button type="button" id="" class="btn btn-sm btn-secondary v-view list active"><i class="fas fa-list-ul"></i></button>
                            <button type="button" id="" class="btn btn-sm btn-secondary v-view column"><i class="fas fa-columns"></i></button>
                        </div>
                    </div>
                </div>
                <div class="row" id="vExplorerZone">
                    <div class="col-lg-12 v-col list-item"></div>
                    <div class="col-lg-12 v-col">
                        <video id="vPreview" width="100%" controls style="display: none;"></video>
                    </div>
                    <div class="col-lg-12 v-footer" >
                        <div class="flex">
                            <span><strong>File name: </strong><span></span></span>
                            <div class="float-right mt-2">
                                <button class="btn btn-primary btn-sm v-select">Select</button>
                                <button class="btn btn-secondary btn-sm v-cancel" data-dismiss="modal">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row" id="vUploadZone" style="display: none;">
                    <div class="col-lg-12">
                        <div class="vContentUpload" style="min-height:35vh; max-height:40vh; overflow-y: auto; overflow-x: hidden;display: grid;">
                            <span class="choose" style="margin: auto;">Choose file</span>
                        </div>
                    </div>                            
                    <div class="col-lg-12">
                        <button class="btn btn-secondary my-3 btn-sm v-btn-choose">Add files<input type="file" name="v_upload" multiple="" accept="video/mp4,video/x-m4v" style="margin-top:15px; display: none"></button>
                    </div>                            
                    <div class="col-lg-12" style="border-top:1px solid #dedede; padding-top:15px;">
                        <div class="float-right">                                    
                            <button class="btn btn-primary btn-sm" id="vUpload">Upload</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  
<script src="js/b64toBlob.js"></script>
<script src="js/jquery.selection.js"></script>
<script src="https://cdn.jsdelivr.net/npm/a-color-picker@1.1.8/dist/acolorpicker.js"></script>
<script src="js/drag-arrange.js"></script>
<script src="back-end/build/skEditor.js"></script>
<script src="back-end/build/video.upload.js"></script>
<script src="js/jquery.validate-v1.18.js"></script>
<script>
$('#more_th').skEditor({height:'600px'});
$('#more_jp').skEditor({height:'600px'});
$('#formEdit').validate({
    ignor:[],
    rules:{
        profile_url:{required:true,formatEN:true},
        name_th:{required:true,formatTH:true},
        name_jp:{required:true},        
        category:{ required:true }
    },
    messages:{
        profile_url:{required:'กรุณากรอก URL',formatEN:'กรุณากรอกภาษาอังกฤษ'},
        name_th:{required:'กรุณากรอกชื่อบริษัท',formatTH:'กรุณากรอกภาษาไทย'},
        name_jp:{required:'กรุณากรอกชื่อบริษัท'},
        
        category:{ required:'กรุณาเลือกประเภทธุรกิจ' }
    }
});
jQuery.validator.addMethod('formatTH',function(v,e){
    return (!v.match(/^[ก-๏0-9-.()\s]+$/u))?false:true;
},'กรุณากรอกภาษาไทย');
jQuery.validator.addMethod('formatEN',function(v,e){
    return (!v.match(/^[A-z0-9-\s]+$/u))?false:true;
},'กรุณากรอกภาษาอังกฤษ');
</script>