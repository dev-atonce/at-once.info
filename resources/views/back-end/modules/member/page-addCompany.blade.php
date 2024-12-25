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
    .custom-file-label.selected{
        overflow: hidden;
    }
</style>
<style>
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
      background-color: #258aff;
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
    .custom-select.text-danger{
        border: 1px solid crimson !important;
    }
    .h3 .custom-control-label::before {
        width: 2rem;
        height: 2rem;
    }
    .h3 .custom-control-label::after {
        width: 2rem;
        height: 2rem;
    }
    html:not([dir=rtl]) .custom-control-label::before {
        left: -2.3rem;
    }
    html:not([dir=rtl]) .custom-control-label::after {
        left: -2.3rem;
    }
    .custom-checkbox.h3 .custom-control-label::before {
        border-radius: 1.25rem;
    }
  </style>
    <link rel="stylesheet" href="back-end/css/skEditor.css" />
    <link rel="stylesheet" href="bootstrap-multiselect/dist/css/bootstrap-multiselect.min.css" />
  @php
        $day = DB::table('working_hours')->select('id','name_th')->get();
  @endphp

<div class="fade-in">
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <form id="formCreate" method="post" action="{{url("$prefix$segment/insert")}}" enctype="multipart/form-data">
                @csrf
                @php
                    $group = \App\Http\Controllers\ProvincialCtrl::group();
                    $category = \App\Models\CategoryMd::orderBy('coming_soon')->orderBy('name_th')->get();
                    $nationality = \App\Models\CountryMd::select('id','nationality')->orderBy('nationality')->get();
                @endphp
                <input type="hidden" name="member_id" value="{{$member_id}}">
                <input type="hidden" id="provincial" value="{{json_encode($group)}}">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="border-bottom:unset; margin-bottom:unset;">
                        <li class="breadcrumb-item "><a href='{{url("$prefix$segment")}}'>Member</a></li>
                        <li class="breadcrumb-item "><a href='{{url("$prefix$segment")}}'>Member</a></li>
                        <li class="breadcrumb-item active">Add Form</span>&nbsp;&nbsp;<span></li>
                    </ol>
                </nav>
                <div class="card">
                    <div class="card-header">
                        <h5 style="color:#5997fb;" class="m-0">General</h5>
                    </div>
                    <div class="card-body">
                        {{-- Card --}}
                        <div class="row">
                            <div class="col-md-3">
                                <img src="img/no_image.webp" class="card-img" alt="" id="preview">
                                <div class="mt-4">
                                    <div class="custom-file">
                                        <input type="file" name="image" class="custom-file-input" id="image">
                                        <label class="custom-file-label" for="image">Choose file</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-9">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <img src="img/no-img-banner.jpg" class="card-img" alt="" id="bg_preview" style="max-height: 320px" >
                                        <div class="mt-4">
                                            <div class="custom-file">
                                                <input type="file" name="bg_image" class="custom-file-input" id="bg_image">
                                                <label class="custom-file-label" for="bg_image">Choose file</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <hr/>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="text-primary font-weight-bold ">*Profile URL : </label> e.g. <code>Company-Name-(Thailand)-Co-Ltd</code>
                                            <input type="text" name="profile_url" id="profile_url" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>ชื่อ บริษัท(TH)</label>
                                            <input type="text" name="name_th"  value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>ชื่อ บริษัท(EN)</label>
                                            <input type="text" name="name_en"  value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>ชื่อ บริษัท(JP)</label>
                                            <input type="text" name="name_jp"  value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>ชื่อ บริษัท(CH)</label>
                                            <input type="text" name="name_zh"  value="" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <label>อุตสาหกรรม</label>
                                            <select name="category" id="category">
                                                <option value="">กรุณาเลือก</option>
                                                @foreach($category as $ki => $vi)
                                                    <option value="{{$vi->id}}" @if($member_id==$vi->id)selected @endif>{{$vi->name_th}} / {{$vi->name_jp}}</option>
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
                                                    <option value="{{$cout->alpha2}}">{{$cout->nationality}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="float-right mt-3">
                                    <button type="submit" class="btn btn-success">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="m-0" style="color:#5997fb;">Filters</h5>
                    </div>
                    <div class="card-body">
                        <input type="hidden" id="get_international" value="{{@$transport}}">
                        <input type="hidden" id="get_method" value="{{@$method}}">
                        <input type="hidden" id="get_warehouse" value="{{@$warehouse}}">
                        <input type="hidden" id="get_item" value="{{@$item}}">
                        <input type="hidden" id="get_service" value="{{@$service}}">
                        <input type="hidden" id="get_condition" value="{{@$condition}}">
                        <input type="hidden" id="get_consulting" value="{{@$consulting}}">
                        <input type="hidden" id="get_language" value="{{@$language}}">
                        <input type="hidden" id="get_speciality" value="{{@$speciality}}">
                        <input type="hidden" id="get_status" value="{{@$status}}">
                        <input type="hidden" id="get_car" value="{{@$car}}">
                        <input type="hidden" id="get_contract" value="{{@$contract}}">
                        <input type="hidden" id="get_other_condition" value="{{@$other_condition}}">
                        <input type="hidden" id="get_visa" value="{{@$visa}}">
                        <input type="hidden" id="get_type" value="{{@$stock}}">
                        <input type="hidden" id="get_printing" value="{{@$printing}}">
                        <input type="hidden" id="get_minimum" value="{{@$minimum}}">
                        <input type="hidden" id="get_other" value="{{@$other}}">
                        <input type="hidden" id="get_accService" value="{{@$accService}}">
                        <input type="hidden" id="get_accOther" value="{{@$accOther}}">
                        <input type="hidden" id="get_accNationality" value="{{@$accNationality}}">
                        <input type="hidden" id="get_accLocationtion" value="{{@$accNationality}}">
                        <input type="hidden" id="get_lawService" value="{{@$lawService}}">
                        <input type="hidden" id="get_lawOther" value="{{@$lawOther}}">
                        <input type="hidden" id="get_lawLanguage" value="{{@$lawLanguage}}">
                        <input type="hidden" id="get_markService" value="{{@$markService}}">
                        <input type="hidden" id="get_markLanguage" value="{{@$markLanguage}}">

                        <input type="hidden" id="get_recruitPosition" value="{{@$recruitPosition}}">
                        <input type="hidden" id="get_recruitNationality" value="{{@$recruitNationality}}">
                        <input type="hidden" id="get_recruitType" value="{{@$recruitType}}">

                        <input type="hidden" id="get_webService" value="{{@$webService}}">
                        <input type="hidden" id="get_webOther" value="{{@$webOther}}">
                        <input type="hidden" id="get_webLanguage" value="{{@$webLanguage}}">

                        <input type="hidden" id="get_coService" value="{{@$coService}}">
                        <input type="hidden" id="get_coType" value="{{@$coType}}">
                        <input type="hidden" id="get_coSeat" value="{{@$coSeat}}">

                        <input type="hidden" id="get_offService" value="{{@$offService}}">

                        <input type="hidden" id="get_consType" value="{{@$consType}}">
                        <input type="hidden" id="get_consService" value="{{@$consService}}">
                        <input type="hidden" id="get_consRental" value="{{@$consRental}}">

                        <input type="hidden" id="get_forkService" value="{{@$forkService}}">
                        <input type="hidden" id="get_forkType" value="{{@$forkType}}">
                        <input type="hidden" id="get_forkFuel" value="{{@$forkFuel}}">
                        {{------- Interior Design -------}}
                        <input type="hidden" id="get_intService" value="{{@$intService}}">
                        {{------- Security System -------}}
                        <input type="hidden" id="get_secService" value="{{@$secService}}">

                        <input type="hidden" id="get_realService" value="{{@$realService}}">
                        <input type="hidden" id="get_realType" value="{{@$realType}}">

                        <input type="hidden" id="get_nationality" value="{{@$nationality}}">
                        {{------- Package -------}}
                        <input type="hidden" id="get_packService" value="{{@$packService}}">
                        <input type="hidden" id="get_packOther" value="{{@$packOther}}">
                        {{------- Insurance -------}}
                        <input type="hidden" id="get_insPersonal" value="{{@$insPersonal}}">
                        <input type="hidden" id="get_insBusiness" value="{{@$insBusiness}}">
                        {{------- Construction -------}}
                        <input type="hidden" id="get_constService" value="{{@$constService}}">
                        <input type="hidden" id="get_constOther" value="{{@$constOther}}">
                        {{------- Leasing -------}}
                        <input type="hidden" id="get_lesService" value="{{@$lesService}}">
                        {{------- Chemicals -------}}
                        <input type="hidden" id="get_chemiType" value="{{@$chemiType}}">
                        <input type="hidden" id="get_chemiService" value="{{@$chemiService}}">
                        {{------- Foods -------}}
                        <input type="hidden" id="get_fooType" value="{{@$fooType}}">
                        {{------- IT -------}}
                        <input type="hidden" id="get_itService" value="{{@$itService}}">
                        <input type="hidden" id="get_itSoftware" value="{{@$itSoftware}}">
                        <input type="hidden" id="get_itHardware" value="{{@$itHardware}}">
                        <input type="hidden" id="get_itSolution" value="{{@$itSolution}}">
                        {{------- Textiles & Garments -------}}
                        <input type="hidden" id="get_tgService" value="{{@$tgService}}">

                        {{------- Contractors -------}}
                        <input type="hidden" id="get_conService" value="{{@$conService}}">
                        <input type="hidden" id="get_conOther" value="{{@$conOther}}">

                        {{------- Contractors -------}}
                        <input type="hidden" id="get_babyType" value="{{@$babyType}}">



                        <div id="area-filter"></div>

                        <div class="float-right mt-3">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><h5 style="color:#5997fb;" class="m-0">Detail</h5></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
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
                                            <label>รายละเอียดย่อ (TH)</label>
                                            <textarea class="form-control" rows="5" name="description_th"></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="EN1" role="tabpanel" aria-labelledby="EN1-tab">
                                        <div class="form-group">
                                            <label>รายละเอียดย่อ (EN)</label>
                                            <textarea class="form-control" rows="5" name="description_en"></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="JP1" role="tabpanel" aria-labelledby="JP1-tab">
                                        <div class="form-group">
                                            <label>รายละเอียดย่อ (JP)</label>
                                            <textarea class="form-control" rows="5" name="description_jp"></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="CH1" role="tabpanel" aria-labelledby="CH1-tab">
                                        <div class="form-group">
                                            <label>รายละเอียดย่อ (CH)</label>
                                            <textarea class="form-control" rows="5" name="description_zh"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs" id="myTab2" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="TH2-tab" data-toggle="tab" href="#TH2" role="tab" aria-controls="TH2" aria-selected="true">TH</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="JP2-tab" data-toggle="tab" href="#JP2" role="tab" aria-controls="JP2" aria-selected="false">JP</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTab2Content">
                                    <div class="tab-pane fade show active" id="TH2" role="tabpanel" aria-labelledby="TH2-tab">
                                        <div class="row" >
                                            <div class="col-12">
                                                <div class="sk-area" data-lang="th">
                                                    <textarea name="more_th" class="sk-editor" hidden=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="JP2" role="tabpanel" aria-labelledby="JP2-tab">
                                        <div class="row" >
                                            <div class="col-12">
                                                <div class="sk-area" data-lang="jp">
                                                    <textarea name="more_jp" class="sk-editor" hidden=""></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="float-right mt-3">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><h5 style="color:#5997fb;" class="m-0">Gallery</h5></div>
                    <div class="card-body">
                        <div class="row" id="gallery_preview"></div>
                        <div class="row mt-4">
                            <div class="col-lg-6">
                                {{-- <input type="file" class="form-control" name="gallery[]" id="gallery" onchange="readGallery('gallery',this)"> --}}
                                <div class="custom-file">
                                    <input type="file" nbame="gallery" class="custom-file-input" id="gallery" onchange="readGallery('gallery',this)" multiple="">
                                    <label class="custom-file-label" for="gallery">Choose file</label>
                                </div>
                            </div>
                        </div>
                        <div class="float-right">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header"><h5 style="color:#5997fb;" class="m-0">Contact Data</h5></div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <label>เวลาทำการ</label>
                                <table class="table" id="areaWorkTime">

                                </table>
                                <a class="btn btn-info" id="btnAddWork">เพิ่ม</a>
                            </div>
                        </div>
                        <hr/>
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>เบอร์โทร</label>
                                    <input type="text" name="phone" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>เบอร์โทรสำหรับส่ง SMS</label>
                                    <input type="text" name="mobile" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>อีเมล</label>
                                    <input type="text" name="email" value="" class="form-control" placeholder="test@hotmail.com">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>เว็บไซต์</label>&nbsp;<small class="text-danger">ไม่ต้องเติม https:// ด้านหน้า</small>
                                    <input type="text" name="website" value="" class="form-control" placeholder="www.at-once.info" >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Facebook</label>
                                    <input type="text" name="facebook" value="" class="form-control" placeholder="https://www.facebook.com/JobsLaboRecruitment" >
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label>Line</label>
                                    <input type="text" name="line" value="" class="form-control" placeholder="" >
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
                                            <textarea name="address_th" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade show" id="JP3" role="tabpanel" aria-labelledby="JP3-tab">
                                        <div class="form-group">
                                            <label>ที่อยู่ (JP)</label>
                                            <textarea name="address_jp" class="form-control" rows="3"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="fas fa-home"></i></div>
                                    </div>
                                    <input type="text" id="postcode" data-name="postcode[]" class="form-control"  placeholder="Postcode" autocomplete="new-postcode" value="">
                                    <input type="text" id="subdistrict" data-name="subdistrict[]" class="form-control"  placeholder="Subdistrict" readonly="" value="">
                                    <input type="text" id="district" data-name="district[]" class="form-control"  placeholder="District" readonly="" value="">
                                    <input type="text" id="province" data-name="province[]" class="form-control"  placeholder="Province" readonly="" value="">
                                </div>
                                <div id="autoAddresArea"></div>
                                <input type="hidden" name="postcode" value="">
                                <input type="hidden" name="subdistrict" value="">
                                <input type="hidden" name="district" value="">
                                <input type="hidden" name="province" value="">
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Google Map</label>
                                    <textarea name="gmap"  class="form-control" rows="5"></textarea>
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
                <div class="card">
                    <div class="card-header">
                        <h5 style="color:#5997fb;" class="m-0">SEO (Search Egine Optimization)</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <ul class="nav nav-tabs" id="myTab5" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link active" id="TH5-tab" data-toggle="tab" href="#TH5" role="tab" aria-controls="TH4" aria-selected="true">TH</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="EN5-tab" data-toggle="tab" href="#EN5" role="tab" aria-controls="EN5" aria-selected="false">EN</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="JP5-tab" data-toggle="tab" href="#JP5" role="tab" aria-controls="JP5" aria-selected="false">JP</a>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <a class="nav-link" id="CH5-tab" data-toggle="tab" href="#CH5" role="tab" aria-controls="CH5" aria-selected="false">CH</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content" id="myTab5Content">
                            <div class="tab-pane fade show active" id="TH5" role="tabpanel" aria-labelledby="TH5-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Keyword :</label>
                                        <input type="text" name="seo_keyword_th" class="form-control" placeholder="(TH)">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="EN5" role="tabpanel" aria-labelledby="EN5-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Keyword :</label>
                                        <input type="text" name="seo_keyword_en" class="form-control" placeholder="(EN)">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="JP5" role="tabpanel" aria-labelledby="JP5-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Keyword :</label>
                                        <input type="text" name="seo_keyword_jp" class="form-control" placeholder="(JP)">
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade show" id="CH5" role="tabpanel" aria-labelledby="CH5-tab">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <label>Keyword :</label>
                                        <input type="text" name="seo_keyword_zh" class="form-control" placeholder="(CH)">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="float-right">
                                    <button type="submit" class="btn btn-success mt-3">Save</button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">&nbsp;</div>
                    <div class="card-body">
                        <div class="row">
                            @php($userPosition = Auth::user()->position)
                            <div class="col-lg-3 text-center text-white">
                                <div class="card bg-secondary">
                                    <div class="card-body text-danger">
                                        <h5>STEP 1</h5><br>
                                        <h3>
                                            <i class="fas fa-check-circle fa-lg"></i>&nbsp;Created
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 text-center text-white">
                                <div class="card bg-secondary">
                                    <div class="card-body">
                                        <h5>STEP 2</h5><br>
                                        <h3>
                                            @if($userPosition==12 || $userPosition==1 || Auth::user()->role=='super' || $userPosition==2)
                                            <div class="custom-control custom-checkbox h3">
                                                <input type="checkbox" name="step2" class="custom-control-input" id="step2" value="1">
                                                <label class="custom-control-label" for="step2">EDITED</label> <small style="color:#bababa"></small>
                                            </div>
                                            @else <i class="far fa-circle"></i>&nbsp;EDITED @endif
                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 text-center text-white">
                                <div class="card @if(@$step->step3==1)bg-success @else bg-secondary @endif">
                                    <div class="card-body">
                                        <h5>STEP 3</h5><br>
                                        <h3>
                                            @if($userPosition==1 || $userPosition==2 || $userPosition == 12 || Auth::user()->role=='super')<div class="custom-control custom-checkbox h3">
                                                <input type="checkbox" name="step3" class="custom-control-input" id="step3" value="1">
                                                <label class="custom-control-label" for="step3">DESIGN</label> <small style="color:#bababa"></small>
                                            </div>
                                            @else <i class="far fa-circle"></i>&nbsp;DESIGN @endif

                                        </h3>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 text-center text-white">
                                <div class="card bg-secondary">
                                    <div class="card-body">
                                        <h5>STEP 4</h5><br>
                                        <h3><i class="far fa-circle fa-lg"></i> ONLINE</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                                <div class="row">
                                    <div class="col-lg-12 col-xs-12">
                                        <div class="form-group">
                                            <label for="modified">Last Modified</label>
                                            <select name="modified[]" id="modified" multiple>
                                                <option value="สร้างข้อมูลบริษัท">สร้างข้อมูลบริษัท</option>
                                                <option value="แก้ไขชื่อบริษัท">แก้ไขชื่อบริษัท</option>
                                                <option value="แก้ไข แก้ไขชื่อบริษัท URL">แก้ไข Profile URL</option>
                                                <option value="เพิ่ม Video">เพิ่ม Video</option>
                                                <option value="เพิ่ม/ลบ รูปโปรไฟล์">เพิ่ม/ลบ รูปโปรไฟล์</option>
                                                <option value="เพิ่ม/ลบ แกลเลอรี่">เพิ่ม/ลบ แกลเลอรี่</option>
                                                <option value="แก้ไขเวลาทำการ">แก้ไขเวลาทำการ</option>
                                                <option value="เพิ่ม/ลบ/แก้ไข เบอร์โทร">เพิ่ม/ลบ/แก้ไข เบอร์โทร</option>
                                                <option value="เพิ่ม/ลบ/แก้ไข อีเมล">เพิ่ม/ลบ/แก้ไข อีเมล</option>
                                                <option value="เพิ่ม/ลบ/แก้ไข Social media link">เพิ่ม/ลบ/แก้ไข Social media link</option>
                                                <option value="เพิ่ม/ลบ/แก้ไข ที่อยู่">เพิ่ม/ลบ/แก้ไข ที่อยู่</option>
                                                <option value="เพิ่ม/ลบ/แก้ไข Google Map">เพิ่ม/ลบ/แก้ไข Google Map</option>
                                                <option value="เพิ่ม/แก้ไข รายละเอียดย่อ">เพิ่ม/แก้ไขรายละเอียดย่อ</option>
                                                <option value="เพิ่ม/แก้ไข รายละเอียด">เพิ่ม/แก้ไขรายละเอียด</option>
                                                <option value="เพิ่ม/แก้ไข Filter">เพิ่ม/แก้ไข Filter</option>
                                                <option value="เพิ่ม/แก้ไข HTML Design">แก้ไข HTML Design</option>
                                                <option value="เพิ่ม/แก้ไข เอกสารใบอนุญาต">เอกสารใบอนุญาต</option>
                                                <option value="ออนไลน์">ออนไลน์</option>
                                                <option value="ออฟไลน์">ออฟไลน์</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="float-left"><button type="button" class="btn btn-warning new-report">Report</button></div>

                                        <div class="float-right"><button type="submit" class="btn btn-success">Save</button></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div id="areaAlert"></div>
                                    </div>
                                </div>


                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>


    $('#category').change(function(){
        console.log($(this).val())
        const filters = $.ajax({method:'get',url:'webpanel/members/filter',async:false,dataType:"json",data:{category:$(this).val()}}).responseJSON;
        insertFilter(parseFloat($(this).val()),filters);
    })


    function insertFilter(type,filters){
        console.log(filters);
        $('#area-filter').children().not('h5').html('');
        switch (type) {
            case 1: /////// Logistics ///////
                obj = $('<div class="row"><div class="col-lg-4"><div class="form-group"><input type="checkbox" name="internal" value="1"><label>&nbsp;การขนส่งภายในประเทศไทย</label></div></div></div>');
                var transportArrVal=[], methodArrVal=[];
                $.each(filters,function(key,val){
                    let id = (key=='transport')?'international':key;
                    let label = {['transport']:'การขนส่งระหว่างประเทศ',['method']:'วิธีการข่นส่ง',['warehouse']:'โกดัง',['item']:'รายการข่นส่ง',['service']:'บริการ',['location']:'ที่ตั้ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+id+'" multiple=""></select></div></div>');
                    if (key == 'transport' || key=='method') $('<label class="ml-1" style="font-size:12px;"><input type="checkbox" class="ml-1" id="'+key+'All" > เลือกทั้งหมด</label>').insertAfter(select.find('label'));
                    $.each(val,function(k,v){
                        let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');
                        select.find('select').append(option);
                        if(key == 'transport'){ transportArrVal.push(v.key); }
                        if(key == 'method'){ methodArrVal.push(v.key); }
                    })
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                var data = [transportArrVal,methodArrVal];
                let transport = new SlimSelect({select:'#international'});
                let method =  new SlimSelect({select:'#method'});
                new SlimSelect({select:'#warehouse'});
                new SlimSelect({select:'#item'});
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#location'});
                $('#transportAll').click(function(){if($(this).is(':checked'))transport.set(data[0]);else transport.set([]);});
                $('#methodAll').click(function(){if($(this).is(':checked'))method.set(data[1]);else method.set([]);});
                break;
            case 2: /////// Solar Cell //////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['location']:'จังหวัด',['condition']:'เงือนไข'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#location'});
                new SlimSelect({select:'#condition'});
                break;
            case 3: /////// Translater //////
                obj = $('<div class="row"><div class="col-lg-4"><div class="form-group"><input type="checkbox" name="urgent" value="1"><label>&nbsp;รองรับงานด่วน</label></div></div><div class="col-lg-4"><div class="form-group"><input type="checkbox" name="postpay" value="1"><label>&nbsp;จ่ายภายหลัง</label></div></div></div>');
                $.each(filters,function(key,val){
                    let label = {['language']:'จังหวัด',['translate']:'แปลภาษา',['speciality']:'เชี่ยวชาญ',['status']:'สถานะ'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#translate'});
                new SlimSelect({select:'#speciality'});
                new SlimSelect({select:'#status'});
                break;
            case 4: /////// Car Rental //////
                obj = $('<div class="row"></div>');
                var carTypeArrVal=[], compPeriodArrVal=[],compOtherArrVal=[];
                $.each(filters,function(key,val){
                    let label = {['carType']:'ชนิดของรถ',['location']:'สถานที่ตั้ง',['period']:'ระยะเวลาของสัญญา',['other']:'เงื่อนไขอื่นๆ'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    if (key != 'location') $('<label class="ml-1" style="font-size:12px;"><input type="checkbox" class="ml-1" id="'+key+'All" > เลือกทั้งหมด</label>').insertAfter(select.find('label'));
                    $.each(val,function(k,v){
                        let option = $('<option value="'+v.key+'">'+v.name_th+'</option>'); select.find('select').append(option);
                        if(key=='carType'){ carTypeArrVal.push(v.key); }
                        if(key=='period'){ compPeriodArrVal.push(v.key); }
                        if(key=='other'){ compOtherArrVal.push(v.key); }
                    })
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                var data = [carTypeArrVal,compPeriodArrVal,compOtherArrVal];
                let carType = new SlimSelect({select: '#carType'});
                new SlimSelect({select: '#location'});
                let period = new SlimSelect({select: '#period'});
                let other =  new SlimSelect({select: '#other'});
                if($('#carTypeAll').is(':checked')){carType.set(data[0]);$(this).prop('checked',true);}
                $('#carTypeAll').click(function(){if($(this).is(':checked')) carType.set(data[0]); else carType.set([]);});
                if($('#periodAll').is(':checked')){period.set(data[1]);$(this).prop('checked',true);}
                $('#periodAll').click(function(){if($(this).is(':checked')) period.set(data[1]); else period.set([]);});
                if($('#otherAll').is(':checked')){other.set(data[2]);; $(this).prop('checked',true);}
                $('#otherAll').click(function(){if($(this).is(':checked')) other.set(data[2]); else other.set([]);});
                break;
            case 5: /////// Visa Support //////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['location']:'สถานที่ตั้ง',['visa']:'ประเภทวีซ่า'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#location'});
                new SlimSelect({select:'#visa'});
                break;
            case 6: /////// Company Register ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['location']:'สถานที่ตั้ง',['consulting']:'ปรึกษาด้านการจัดการ',['service']:'บริการ'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#location'});
                new SlimSelect({select:'#consulting'});
                new SlimSelect({select:'#service'});
                break;
            case 7: /////// Warehouse ///////
                obj = $('<div class="row"></div>');
                console.log(filters);
                $.each(filters,function(key,val){
                    let label = {['location']:'สถานที่ตั้ง',['type']:'ประเภทคลังสินค้า'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#location'});
                new SlimSelect({select:'#type'});
                break;
            case 8: /////// Printing ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['type']:'ประเภทการพิมพ์',['minimum']:'ขั้นต่ำการสั่งซื้อ',['service']:'บริการอื่นๆ',['location']:'สถานที่ตั้ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#type'});
                new SlimSelect({select:'#minimum'});
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#location'});
                break;
            case 9: /////// Account ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['service']:'บริการ',['other']:'บริการอื่นๆ',['nationality']:'สัญชาติ',['location']:'สถานที่ตั้ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#other'});
                new SlimSelect({select:'#nationality'});
                new SlimSelect({select:'#location'});
                break;
            case 10: /////// Law firm ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['service']:'บริการ',['other']:'บริการอื่นๆ',['language']:'ภาษา',['location']:'สถานที่ตั้ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#location'});
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#other'});
                new SlimSelect({select:'#language'});
                break;
            case 11: /////// Web Marketing ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['service']:'บริการ',['language']:'ภาษา',['location']:'สถานที่ตั้ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#location'});
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#language'});
                break;
            case 12: /////// Recruitment ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['position']:'ตำแหน่งงาน',['nationality']:'สัญชาติ',['type']:'ประเภทการจ้าง',['location']:'พื้นที่'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#position'});
                new SlimSelect({select:'#nationality'});
                new SlimSelect({select:'#type'});
                new SlimSelect({select:'#location'});
                break;
            case 13: /////// Web System ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['location']:'พื้นที่',['service']:'บริการ',['language']:'ภาษา',['other']:'บริการอื่นๆ'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#location'});
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#other'});
                new SlimSelect({select:'#language'});
                break;
            case 14: /////// Co-Working ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['location']:'พื้นที่',['type']:'ประเภทออฟฟิศ',['service']:'บริการ',['seat']:'ที่นั่ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#location'});
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#type'});
                new SlimSelect({select:'#seat'});
                break;
            case 15: /////// Office Rent ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['service']:'บริการ',['contract']:'ระยะเวลาสัญญา',['location']:'พื้นที่'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#location'});
                new SlimSelect({select:'#contract'});
                new SlimSelect({select:'#service'});
                break;
            case 16: /////// Contruction Machine leasing ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['type']:'ประเภทรถ',['service']:'บริการ',['rental']:'รูปแบบการเช่า',['location']:'พื้นที่'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#type'});
                new SlimSelect({select:'#rental'});
                new SlimSelect({select:'#location'});
                break;
            case 17: /////// Forklift ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['service']:'บริการ',['type']:'ประเภทสินค้า',['fuel']:'ระบบเชิ้อเพลิง',['location']:'พื้นที่'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option = $('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#type'});
                new SlimSelect({select:'#fuel'});
                new SlimSelect({select:'#location'});
                break;
            case 18: /////// Interior Design ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['service']:'บริการ',['location']:'พื้นที่'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#location'});
            break;
            case 19: /////// Security System ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['service']:'บริการ',['location']:'พื้นที่'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#location'});
            break;
            case 20: /////// Real Estate Agent ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['service']:'บริการ',['type']:'ประเภทสินทรัพย์',['location']:'พื้นที่',['nationality']:'สัญชาติของนายหน้า'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#type'});
                new SlimSelect({select:'#location'});
                new SlimSelect({select:'#nationality'});
            break;
            case 21: /////// Package ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['service']:'บริการ',['other']:'บริการอื่นๆ',['location']:'พื้นที่'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#other'});
                new SlimSelect({select:'#location'});
                break;
            case 22: /////// Insurance ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['personal']:'ประกันภัยรายบุคคล',['business']:'ประกันภัยรายบริษัท'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);
                    });
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#personal'});
                new SlimSelect({select:'#business'});
                break;
            case 23: /////// Contruction ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['service']:'งานก่อสร้าง',['other']:'บริการอื่นๆ'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#other'});
                break;
            case 24: /////// Leasing ///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['service']:'ประเภทสินเชื่อ',['location']:'บริการอื่นๆ'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#location'});
                break;
            case 28: ///////======= Chemicals =======///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['type']:'ประเภทสินค้า',['service']:'บริการอื่นๆ',['location']:'ที่ตั้ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#type'});
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#location'});
            break;
            case 30: ///////======= Foods =======///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['type']:'ประเภทอาหาร',['location']:'ที่ตั้ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#type'});
                new SlimSelect({select:'#location'});
            break;
            case 31: ///////======= IT =======///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['service']:'บริการ',['software']:'ซอฟท์แวร์',['hardware']:'ฮาร์ดแวร์',['solution']:'โซลูชั่น',['location']:'ที่ตั้ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
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
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['service']:'บริการ',['location']:'ที่ตั้ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#location'});
            break;
            case 42: ///////======= Contractors =======///////
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['service']:'บริการ',['other']:'รายการ',['location']:'ที่ตั้ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#service'});
                new SlimSelect({select:'#other'});
                new SlimSelect({select:'#location'});
            break;
            case 43: ///////======= Baby Supplies =======///////
                obj = $('<div class="row"></div>');
                console.log(filters);
                $.each(filters,function(key,val){
                    let label = {['type']:'ประเภท',['location']:'ที่ตั้ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#type'});
                new SlimSelect({select:'#location'});
            break;
            case 49:
                obj = $('<div class="row"></div>');
                console.log(filters);
                $.each(filters,function(key,val){
                    let label = {['appliance']:'ประเภทเครื่องใช้ไฟฟ้า',['brand']:'ยี่ห้อ',['location']:'ที่ตั้ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#appliance'});
                new SlimSelect({select:'#brand'});
                new SlimSelect({select:'#location'});
            break;
            case 50:
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['type']:'หมวดหมู่สินค้า',['location']:'ที่ตั้ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#product'});
                new SlimSelect({select:'#location'});
            break;
            case 51:
                obj = $('<div class="row"></div>');
                $.each(filters,function(key,val){
                    let label = {['product']:'ประเภท',['location']:'ที่ตั้ง'};
                    let select = $('<div class="col-lg-4"><div class="form-group"><label>'+label[key]+'</label><select name="'+key+'[]" id="'+key+'" multiple=""></select></div></div>');
                    $.each(val,function(k,v){let option=$('<option value="'+v.key+'">'+v.name_th+'</option>');select.find('select').append(option);});
                    obj.append(select);
                });
                $('#area-filter').append(obj);
                new SlimSelect({select:'#product'});
                new SlimSelect({select:'#location'});
            break;
            default: break;
        }

        // addSlimSelect(type,data);
    }



    new SlimSelect({select:'#country'});
    var categorySelect = new SlimSelect({select:'#category'});

    categorySelect.set([$('input[name="member_id"]').val()]);

    $("#image").on('change',function(){
        var $this = $(this);
        var input = $(this)[0];
        if (input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload=function(e){$('#preview').attr('src', e.target.result).fadeIn('slow');}
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
    // $('#gallery').filer({ limit: '5' });

    $('#postcode').addressAuto({subdistict:'#subdistrict',distict:'#subdistrict',province:'#province',width:500,top:2190});
    $('.saveData').click(function(){showAlert('areaAlert_30');});
    function showAlert(area){
        var html = '<div class="alert alert-success alert-dismissible fade show">\
                    <strong>สำเร็จ !</strong> บันทึกข้อมูลเรียบร้อย.\
                    <button type="button" class="close" data-dismiss="alert">&times;</button>\
                </div>';
        return $('#'+area).html(html);
    }

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
                        Swal.fire('Error!','มีบางอย่างผิดพลาด !','error');
                    }
                });
            }
        })

    });

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
                        Swal.fire('Error!','มีบางอย่างผิดพลาด !','error');
                    }
                });
            }
        });
    }

</script>
<div class="modal fade" id="template" tabindex="-1" role="dialog" aria-labelledby="templateTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <span>Template</span>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
              </button>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
              <button type="button" class="btn btn-primary btn-block mt-2 select-template">เลือก</button>
            </div>
          </div>
          <div class="template-item card mt-2">
            <div class="row">
              <div class="col-lg-4 img"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">IMAGE</h5></div></div>
              <div class="col-lg-8 txt"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">TEXT</h5></div></div>
            </div>
          </div>
          <div class="template-item card mt-2">
            <div class="row">
              <div class="col-lg-12 txt"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">TEXT</h5></div></div>
            </div>
          </div>
          <div class="template-item card mt-2">
            <div class="row">
              <div class="col-lg-8 txt"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">TEXT</h5></div></div>
              <div class="col-lg-4 img"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">IMAGE</h5></div></div>
            </div>
          </div>
          <div class="template-item card mt-2">
            <div class="row">
              <div class="col-lg-4 img"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">IMAGE</h5></div></div>
              <div class="col-lg-4 img"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">IMAGE</h5></div></div>
              <div class="col-lg-4 img"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">IMAGE</h5></div></div>
            </div>
          </div>
          <div class="template-item card mt-2">
            <div class="row">
              <div class="col-lg-6 img"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">IMAGE</h5></div></div>
              <div class="col-lg-6 img"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">IMAGE</h5></div></div>
            </div>
          </div>
          <div class="template-item card mt-2">
            <div class="row">
              <div class="col-lg-12 img"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">IMAGE</h5></div></div>
            </div>
          </div>
          <div class="template-item card mt-2">
            <div class="row">
              <div class="col-lg-6 txt"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">TEXT</h5></div></div>
              <div class="col-lg-6 txt"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">TEXT</h5></div></div>
            </div>
          </div>
          <div class="template-item card mt-2">
            <div class="row">
              <div class="col-lg-4 txt"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">TEXT</h5></div></div>
              <div class="col-lg-4 txt"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">TEXT</h5></div></div>
              <div class="col-lg-4 txt"><div style="min-height:150px; display:grid;"><h5 style="margin:auto;">TEXT</h5></div></div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-6">
              <button type="button" class="btn btn-primary btn-block mt-2 select-template">เลือก</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="imageManager" tabindex="-1" role="dialog" aria-labelledby="imageManagerTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-body">
            <div class="row">
                <div class="col-lg-12 border-bottom">
                    <span style="line-height:20px; font-size:20px; font-weight:bold;">Image Manager</span>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"><i class="fas fa-times"></i></span>
                    </button>
                </div>
            </div>
            <div class="row im-f">
                <div class="col-lg-12 im-tools">
                    <button class="btn btn-outline-dark btn-sm im-upload">Upload</button>
                    <button class="btn btn-outline-dark btn-sm im-refresh" title="Refresh"><i class="fas fa-sync fa-xs"></i>&nbsp;Refresh</button>
                    <button class="btn btn-outline-danger btn-sm im-delete" title="Delete"><i class="fas fa-trash fa-xs"></i>&nbsp;Delete</button>
                    <div class="float-right">
                      <a href="javascript:" class="btn btn-outline-dark btn-sm im-view -list"><i class="fas fa-list-ul"></i></a>
                      <a href="javascript:" class="btn btn-outline-dark btn-sm im-view -grid"><i class="fas fa-th-large"></i></a>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="im-content-image im-container"></div>
                </div>
                <div class="col-lg-12 im-footer">
                  <div class="float-right">
                      <button type="button" class="btn btn-primary btn-sm im-select">Insert</button>
                      <button type="button" class="btn btn-secondary btn-sm im-close" data-dismiss="modal">Close</button>
                  </div>
              </div>
            </div>
            <div class="row im-u" style="display: none;">
                <div class="col-lg-12">
                  <div class="im-content-upload" style="display: grid;"><span class="choose" style="margin: auto;">Choose file</span></div>
                </div>
                <div class="col-lg-12 float-right">
                  <button class="btn btn-secondary my-3 btn-sm im-btn-choose">Add files<input type="file" name="im_upload" multiple style="display: none"></button>
                </div>
                <div class="col-lg-12 im-footer">
                    <div class="float-right">
                        <button class="btn btn-primary btn-sm im-upload">Upload</button>
                        <button class="btn btn-secondary btn-sm im-cancel">Cancel</button>
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
<script src="js/jquery.validate-v1.18.js"></script>
<script src="bootstrap-multiselect/dist/js/bootstrap-multiselect.min.js"></script>
<script>
    // $('.sk-editor').skEditor({height:'600px'});
    $('#more_th').skEditor({height:'600px'});
    $('#more_jp').skEditor({height:'600px'});
    $('#more_en').skEditor({height:'600px'});
    $('#more_zh').skEditor({height:'600px'});
</script>

<script>
    $('#modified').multiselect({
        buttonWidth: '100%',
        enableFiltering: true,
        buttonText: function(options, select) {
            if (options.length == 0) {
            return this.nonSelectedText
            }
            var selected = '';
            options.each(function() {
                var label = ($(this).attr('label') !== undefined) ? $(this).attr('label') : $(this).html();

                selected += label + ', ' ;
            });
            return selected.substr(0, selected.length - 2);
        }

    });
    $('#postcode').addressAuto({
            subdistict : '#subdistrict',
            distict : '#subdistrict',
            province : '#province',
            displayAuto: '#autoAddresArea',
            // width : 500,
            // top : $('#postcode').offset().top
        });

    $('#formCreate').validate({
        ignor:[],
        rules:{
            // profile_url:{ required:true,formatEN:true },
            name_th:{ required:true,formatTH:true },
            name_jp:{ required:true },
            category:{ required:true },
            'modified[]':{ required:true }
        },
        messages:{
            // profile_url:{ required:'กรุณากรอก URL',formatEN:'กรุณากรอกภาษาอังกฤษ' },
            name_th:{ required:'กรุณากรอกชื่อบริษัท(TH)' },
            name_jp:{ required:'กรุณากรอกชื่อบริษัท(JP)' },
            category:{ required:'กรุณาเลือกประเภทธุรกิจ' },
            'modified[]':{ required:'*** กรุณาเลือกการแก้ไขล่าสุดของคุณ ***' },
        }
    });
    jQuery.validator.addMethod('formatTH',function(v,e){
        return (!v.match(/^[ก-๏0-9-.()\s]+$/u))?false:true;
    },'กรุณากรอกภาษาไทย');
    jQuery.validator.addMethod('formatEN',function(v,e){
        return (!v.match(/^[A-z0-9-\s]+$/u))?false:true;
    },'กรุณากรอกภาษาอังกฤษ');
</script>
