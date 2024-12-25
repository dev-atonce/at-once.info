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
  </style>
  @php
        $day = DB::table('working_hours')->select('id','name_th')->get();
  @endphp
<div class="fade-in">
        <div class="row">
            <div class="col-lg-12 col-md-12">   
                    <div class="card">
                        <div class="card-header">
                            <span class="breadcrumb-item "><a href='{{url("$prefix$segment")}}'>Com</a></span>
                            <span class="breadcrumb-item active">Edit Form</span>
                            <div class="card-header-actions"><small class="text-muted"><a href="https://getbootstrap.com/docs/4.0/components/input-group/#custom-file-input">docs</a></small></div>
                        </div>
                        <div class="card-body">
                    @php
                        $category = \App\Models\CategoryMd::orderBy('name_th')->get()
                    @endphp
                    <form id="" method="post" action="" enctype="multipart/form-data"> 
                        @csrf
                        <input type="hidden" name="member_id" value="{{$row->id}}">
                        <input type="hidden" name="cp_id" value="{{$comp->id}}">
                        {{-- Card --}}
                        <div class="card border-light">
                            <div class="card-header bg-light">
                              #{{$comp->id}}
                            </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            @php
                                                $image=(!empty($comp->logo))?$comp->logo:"img/no_image.webp";
                                            @endphp
                                            <img src="{{$image}}" class="card-img" alt="{{$comp->name_th}}" id="preview">
                                            <input type="hidden" name="currentImage" value="{{@$comp->logo}}">
                                            <div class="mt-4">
                                                <input type="file" name="image" id="image">
                                            </div>
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    @php
                                                        $bg_image=(!empty($comp->bg_image))?$comp->bg_image:"img/no-img-banner.jpg";
                                                    @endphp
                                                    <img src="{{$bg_image}}" class="card-img" alt="{{$comp->name_th}}" id="bg_preview" >
                                                    <input type="hidden" name="currentBgImage" value="{{@$comp->bg_image}}">
                                                    <div class="mt-4">
                                                        <input type="file" name="bg_image" id="bg_image">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-4">
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>ชื่อ บริษัท(TH)</label>
                                                        <input type="text" name="name_th"  value="{{$comp->name_th}}" class="form-control">
                                                    </div>
                                                </div> 
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>ชื่อ บริษัท(JP)</label>
                                                        <input type="text" name="name_jp"  value="{{$comp->name_jp}}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>อุตสาหกรรม</label>
                                                        <select name="category" class="form-control">
                                                            <option value="">กรุณาเลือก</option>
                                                            @foreach($category as $ki => $vi)
                                                            <option value="{{$vi->id}}" @if($comp->category==$vi->id) selected @endif>{{$vi->name_th}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>  
                                            </div>
                                            <div class="row">
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
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="checkbox" name="internal" value="1" @if($comp->dmtInternal == 1) checked @endif  >
                                                        <label>การขนส่งภายในประเทศไทย</label>
                                                    </div>
                                                </div>
                                            @php
                                                $op_delivery = DB::table('delivery')->select('delivery')->where('_id',$comp->id)->get();
                                                $array_delivery = [];
                                                foreach($op_delivery as $value){
                                                    array_push($array_delivery,$value->delivery);
                                                }
                                            @endphp
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>การขนส่งระหว่างประเทศ</label>
                                                        <select id="international" name="international[]" multiple>
                                                            @foreach($ransport as $k => $v)
                                                                <option value="{{$v->key}}" @if(!empty($op_delivery) && in_array($v->key,$array_delivery)) selected  @endif>{{$v->name_th}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            @php
                                                $op_method = DB::table('cp_method')->select('method')->where('_id',$comp->id)->get();
                                                $array_method = [];
                                                foreach($op_method as $value){
                                                    array_push($array_method,$value->method);
                                                }
                                            @endphp
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>วิธีการข่นส่ง</label>
                                                        <select id="method" name="method[]" multiple>
                                                            @foreach($method as $k => $v)
                                                                <option value="{{$v->key}}" @if(!empty($array_method) && in_array($v->key,$array_method)) selected  @endif >{{$v->name_th}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @php
                                                    $op_warehouse = DB::table('warehouse')->select('warehouse')->where('_id',$comp->id)->get();
                                                    $array_warehouse = [];
                                                    foreach($op_warehouse as $value){
                                                        array_push($array_warehouse,$value->warehouse);
                                                    }
                                                @endphp
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>โกดัง</label>
                                                        <select id="warehouse" name="warehouse[]" multiple>
                                                            @foreach($warehouse as $k => $v)
                                                                <option value="{{$v->province_id}}" @if(!empty($op_warehouse) && in_array($v->province_id,$array_warehouse)) selected  @endif >{{$v->province_name_th}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @php
                                                    $op_item = DB::table('cp_item')->select('item')->where('_id',$comp->id)->get();
                                                    $array_item = [];
                                                    foreach($op_item as $value){
                                                        array_push($array_item,$value->item);
                                                    }
                                                @endphp
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>รายการข่นส่ง</label>
                                                        <select id="item" name="item[]" multiple>
                                                            @foreach($item as $k => $v)
                                                                <option value="{{$v->key}}" @if(!empty($op_item) && in_array($v->key,$array_item)) selected  @endif >{{$v->name_th}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @php
                                                    $op_service = DB::table('cp_service')->select('service')->where('_id',$comp->id)->get();
                                                    $array_service = [];
                                                    foreach($op_service as $value){
                                                        array_push($array_service,$value->service);
                                                    }
                                                @endphp
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>บริการ</label>
                                                        <select id="service" name="service[]" multiple>
                                                            @foreach($service as $k => $v)
                                                                <option value="{{$v->key}}" @if(!empty($op_service) && in_array($v->key,$array_service)) selected  @endif >{{$v->name_th}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <input type="checkbox" name="pac[]" value="1" @if($comp->pac == 1) checked @endif  >
                                                        <label>การห่อ/บรรจุ</label>
                                                    </div>
                                                </div>

                                            </div>

                 
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
                                                                <textarea class="form-control" rows="5" name="description_th">{{$comp->description_th}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade" id="JP1" role="tabpanel" aria-labelledby="JP1-tab">
                                                            <div class="form-group">
                                                                <label>รายละเอียดย่อ (JP)</label>
                                                                <textarea class="form-control" rows="5" name="description_jp">{{$comp->description_jp}}</textarea>
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
                                                            <div class="form-group">
                                                                <label>รายละเอียดเต็ม (TH)</label>
                                                                <textarea class="form-control tiny" rows="5" name="detail_th">{!!$comp->detail_th!!}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="tab-pane fade show" id="JP2" role="tabpanel" aria-labelledby="JP2-tab">
                                                            <div class="form-group">
                                                                <label>รายละเอียดเต็ม (JP)</label>
                                                                <textarea class="form-control tiny" rows="5" name="detail_jp">{!!$comp->detail_jp!!}</textarea>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                @if (!empty($gallery))
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
                                                    <input type="file" class="form-control" name="gallery[]" id="gallery" onchange="readGallery('gallery',this)">
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
                                                        <input type="text" name="facebook" value="{{$comp->line}}" class="form-control" placeholder="https://www.facebook.com/JobsLaboRecruitment" >
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
        new SlimSelect({
            select: '#international'
        });
        new SlimSelect({
            select: '#method'
        });
        new SlimSelect({
            select: '#warehouse'
        });
        new SlimSelect({
            select: '#item'
        });
        new SlimSelect({
            select: '#service'
        });
        new SlimSelect({
            select: '#country'
        });
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
        $('#gallery').filer({ limit: '5' });
        
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
    tinymce.init({
		selector: 'textarea.tiny1',
		menubar : false,
		force_br_newlines : true,
        force_p_newlines : false,
        height: 200, 
        plugins: ["code textcolor"],    
        toolbar: 'undo redo code bold italic forecolor backcolor',
        formats: {
            h1: { block: 'h1', classes: 'heading' }
        },
    });
    tinymce.init({
		selector: 'textarea.tiny',
		menubar : false,
		force_br_newlines : true,
		force_p_newlines : false,
		forced_root_block : '',
		height: 400, 
        //width : 1100,
        plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","save table contextmenu directionality emoticons template paste textcolor colorpicker layer textpattern moxiemanager"],    
        toolbar: 'insertfile undo redo | table | styleselect fontselect fontsizeselect | bold italic forecolor backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | print nonbreaking hr emoticons code',
        
    });
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
                OpenLoading();
                var id = $(this).data('id');
                var cp_id = $(this).data('cp');
                var token = "{{csrf_token()}}";
                $.ajax({
                    type:'post',
                    url:'{{url($prefix.$segment."/deleteItemTime")}}',
                    data: {id: id ,_token:token,cp_id:cp_id},
                        success: function (data) {
                                CloseLoading();
                                Swal.fire(
                                    'สำเร็จ !',
                                    'ลบรายการออกแล้ว',
                                    'success'
                                ).then((result)=>{
                                    $('#working_'+id).slideUp("slow", function() { $(this).remove(); } );
                                })
                        },
                        error: function() {
                            CloseLoading();
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
                OpenLoading();
                var token = "{{csrf_token()}}";
                $.ajax({
                    type:'post',
                    url:'{{url($prefix.$segment."/deleteItemGallery")}}',
                    data: {id:id,_token:token},
                        success: function (data) {
                                CloseLoading();
                                Swal.fire(
                                    'สำเร็จ !',
                                    'ลบรายการออกแล้ว',
                                    'success'
                                ).then((result)=>{
                                    $('#gal_'+id).slideUp("slow", function() { $(this).remove(); } );
                                })
                        },
                        error: function() {
                            CloseLoading();
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

</script>      