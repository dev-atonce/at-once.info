<!doctype html>
<html lang="{{Session('lang')}}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{ENV('APP_NAME')}}</title>

  <base href="{{url('/')}}">
  
  <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="fonts/icofont.css">
  <link rel="stylesheet" href="css/fontawesome.css">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/header-footer.css" rel="stylesheet">
  <link href="css/member-company.css" rel="stylesheet">
  <link rel="stylesheet" href="plugin/select2/css/select2.min.css">
  <style>
    .mce-btn, .mce-panel{
      background-color: #fff !important;
    }

  </style>
</head>
<body>

 @include("$prefix.header")
 
 <section class="page">
  <div class="container">

    <div class="col-lg-12">

      <div class="personal row" style="box-shadow: rgba(0, 0, 0, 0.08) 0px 4px 16px;">

        <div class="right">
          <div class="group-box-right">
            @if(Session('status')=='Success')
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              <strong class="bold">{{Session('status')}}!</strong> {{Session('message')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @endif
            @if(Session('status')=='Error')
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong class="bold">{{Session('status')}}!</strong> {{Session('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @endif
            <h4 class="bold text-center mb-5">Step 2</h4>
            <div class="alert alert-warning"><strong class="bold">คำเตือน!</strong> อย่าออกจากหน้านี้จนกว่าจะทำทุกขั้นตอนจนเสร็จสมบูรณ์</div>
            <form action="" method="post">
              <input type="hidden" name="id" value="{{$row->id}}">
              @csrf
              @php $lang=Session('lang'); @endphp
              <div class="group-box-right">
                  <h5 class="bold border-bottom mb-5">ข้อมูลเกี่ยวกับธุรกิจ</h5>

                  @if(Session('status')=='Success')
                  <div class="alert alert-success">
                    <strong class="bold">{{Session('status')}}!</strong> {{Session('message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif
                  @if(Session('status')=='Error')
                  <div class="alert alert-danger">
                    <strong class="bold">{{Session('status')}}!</strong> {{Session('message')}}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  @endif
                  <div class="form-group">
                      <h6 for="exampleFormControlSelect1" class="bold text-secondary">ประเภทธุรกิจ</h6>
                      <select class="form-control" name="category" id="category">
                          <option value="">@lang('phrase.please-select')</option>
                          @foreach(\App\Models\CategoryMd::select('id','name_th','name_jp')->where('status',1)->whereNull('coming_soon')->get() as $category)
                          <option value="{{$category->id}}" @if($categoryId==$category->id)selected @endif>{{@$category->name_th}} / {{$category->name_jp}}</option>
                          @endforeach
                      </select>
                  </div>
             
                  @php 
                      $langP = (Session('lang')=='th')?'th':'en';                      
                  @endphp

                  @switch($module)
                      @case('logistic') {{------------ logistic ------------}}
                          <div class="form-group">                          
                              <label for="domestic" class="bold text-secondary"><input type="checkbox" name="domestic" id="domestic" value="1"> @lang('phrase.domestic')</label>                        
                          </div>
                          <div class="form-group">
                              <h6 class="bold text-secondary">@lang('phrase.international')</h6>
                              <div class="row ml-1 international" >
                                  @foreach(\App\Models\ChoiceMd::where('type','transport')->select('key',"name_$lang as name")->get() as $int)
                                  <div class="col-lg-4">
                                    <input type="checkbox" name="international[]" id="international_{{$int->key}}" value="{{$int->key}}"> 
                                    <label for="international_{{$int->key}}" class="text-secondary">{{$int->name}}</label>
                                  </div>
                                  @endforeach
                              </div>
                          </div>
                          <div class="form-group">
                              <h6 class="bold text-secondary">@lang('phrase.transportation')</h6>
                              <div class="row ml-1 method" >
                                  @foreach(\App\Models\ChoiceMd::where('type','methods')->select('key',"name_$lang as name")->get() as $med)
                                  <div class="col-lg-4">
                                    <input type="checkbox" name="method[]" id="method_{{$med->key}}" value="{{$med->key}}"> 
                                    <label for="method_{{$med->key}}" class="text-secondary">{{$med->name}}</label>
                                  </div>
                                  @endforeach
                              </div>
                          </div>
                          <div class="form-group">
                              <h6 class="bold text-secondary">@lang('phrase.items')</h6>
                              <div class="row ml-1 item">
                                  @foreach(\App\Models\ChoiceMd::where('type','warehouse')->select('key',"name_$lang as name")->get() as $med)
                                  <div class="col-lg-4">
                                    <input type="checkbox" name="item[]" id="item_{{$med->key}}" value="{{$med->key}}"> 
                                    <label for="item_{{$med->key}}" class="text-secondary">{{$med->name}}</label>
                                  </div>
                                  @endforeach
                              </div>
                          </div>
                          <div class="form-group">
                              <h6 class="bold text-secondary">@lang('phrase.services')</h6>
                              <div class="row ml-1 service" >
                                  @foreach(\App\Models\ChoiceMd::where('type','services')->select('key',"name_$lang as name")->get() as $med)
                                  <div class="col-lg-6">
                                    <input type="checkbox" name="services[]" id="service_{{$med->key}}" value="{{$med->key}}"> 
                                    <label for="service_{{$med->key}}" class="text-secondary">{{$med->name}}</label>
                                  </div>
                                  @endforeach
                              </div>
                          </div>
                          
                          <div class="form-group">
                            <h6 class="bold text-secondary warehouse" >@lang('phrase.warehouse')</h6>
                            <select name="warehouse[]" class="example form-control" multiple="multiple">
                              @foreach(\App\Models\ProvinceMd::select("province_id as id","province_name_$langP as province")->orderBy('province')->get() as $w)
                              <option value="{{$w->id}}">{{$w->province}}</option>
                              @endforeach
                            </select>
                          </div>
                          @break

                      @case('solar-cell'){{------------ Solar Cell ------------}}
                          <div class="form-group">
                              <h6 class="bold text-secondary">@lang("phrase.$module.filter.province")</h6>
                              <div class="row ml-1 province" >
                                  @foreach(\App\Models\ProvinceMd::select('province_id as id',"province_name_$lang as province")->orderBy("province")->get() as $prv)
                                  <div class="col-lg-4">
                                      <input type="checkbox" name="provinces[]" id="province_{{$prv->id}}" value="{{$prv->id}}"> 
                                      <label for="province_{{$prv->id}}" class="text-secondary">{{$prv->province}}</label>
                                  </div>
                                  @endforeach
                              </div>
                          </div>
                          <div class="form-group">
                              <h6 class="bold text-secondary">@lang('phrase.condition')</h6>
                              <div class="row ml-1 service" >
                                  @foreach(\App\Models\ChoiceMd::where('type','solar-cell-condition')->select('key',"name_$lang as name")->get() as $med)
                                  <div class="col-lg-6">
                                      <input type="checkbox" name="condition[]" id="condition_{{$med->key}}" value="{{$med->key}}"> 
                                      <label for="condition_{{$med->key}}" class="text-secondary">{{$med->name}}</label>
                                  </div>
                                  @endforeach
                              </div>
                          </div>
                          @break

                      @case('translater'){{------------ Translater ------------}}
                          <div class="form-group">
                              <h6 class="bold text-secondary">@lang('phrase.translater.filter.language')</h6>
                              <div class="row ml-1 translate" >
                                  @foreach(\App\Models\TranslateMd::select('id',"name_$lang as name")->get() as $int)
                                  <div class="col-lg-4">
                                    <input type="checkbox" name="translate[]" id="translate_{{$int->id}}" value="{{$int->id}}"> 
                                    <label for="translate_{{$int->id}}" class="text-secondary">{{$int->name}}</label>
                                  </div>
                                  @endforeach
                              </div>
                          </div>
                          <div class="form-group">
                              <h6 class="bold text-secondary">@lang('phrase.translater.filter.speciality')</h6>
                              <div class="row ml-1 speciality" >
                                  @foreach(\App\Models\SpecialityMd::select('id',"name_$lang as name")->get() as $int)
                                  <div class="col-lg-4">
                                    <input type="checkbox" name="speciality[]" id="speciality_{{$int->id}}" value="{{$int->id}}"> 
                                    <label for="speciality_{{$int->id}}" class="text-secondary">{{$int->name}}</label>
                                  </div>
                                  @endforeach
                              </div>
                          </div>
                          <div class="form-group">
                              <h6 class="bold text-secondary">@lang('phrase.translater.filter.urgent')</h6>
                              <div class="row ml-1 urgent" >
                                  <div class="col-lg-12"><label for="urgent"><input type="checkbox" id="urgent" name="urgent" value="1"> @lang('phrase.translater.filter.urgent')</label></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <h6 class="bold text-secondary">@lang('phrase.translater.filter.postpay')</h6>
                              <div class="row ml-1 postpay" >
                                  <div class="col-lg-12"><label for="postpay"><input type="checkbox" id="postpay" name="postpay" value="1"> @lang('phrase.translater.filter.postpay')</label></div>
                              </div>
                          </div>
                          <div class="form-group">
                              <h6 class="bold text-secondary">@lang('phrase.translater.filter.status')</h6>
                              <div class="row ml-1 status" >
                                  @foreach(\App\Models\StatusMd::select('id',"name_$lang as name")->get() as $int)
                                  <div class="col-lg-4">
                                    <input type="checkbox" name="status[]" id="status_{{$int->id}}" value="{{$int->id}}"> 
                                    <label for="status_{{$int->id}}" class="text-secondary">{{$int->name}}</label>
                                  </div>
                                  @endforeach
                              </div>
                          </div>
                          @break
                      @case('auto-leasing'){{------------ Auto Leasing ------------}}
                          <div class="form-group">
                            <h6 class="bold text-secondary">@lang('phrase.car-type')</h6>
                            <div class="row ml-1 type" >
                                @foreach(\App\Models\ChoiceMd::select('id',"name_$lang as name")->where('type','car')->get() as $int)
                                <div class="col-lg-4">
                                  <input type="checkbox" name="type[]" id="type_{{$int->id}}" value="{{$int->id}}"> 
                                  <label for="type_{{$int->id}}" class="text-secondary">{{$int->name}}</label>
                                </div>
                                @endforeach
                            </div>
                          </div>
                          <div class="form-group">
                            <h6 class="bold text-secondary">@lang('phrase.location')</h6>
                            <div class="row ml-1 type" >
                                @foreach(\App\Models\ProvinceMd::select('province_id as id',"province_name_$lang as province")->orderBy('province')->get() as $int)
                                <div class="col-lg-4">
                                  <input type="checkbox" name="location[]" id="location_{{$int->id}}" value="{{$int->id}}"> 
                                  <label for="location_{{$int->id}}" class="text-secondary">{{$int->province}}</label>
                                </div>
                                @endforeach
                            </div>
                          </div>
                          <div class="form-group">
                            <h6 class="bold text-secondary">@lang('phrase.contract-period')</h6>
                            <div class="row ml-1 period" >
                                @foreach(\App\Models\ChoiceMd::select('id',"name_$lang as name")->where('type','contract-period')->get() as $int)
                                <div class="col-lg-4">
                                  <input type="checkbox" name="period[]" id="period_{{$int->key}}" value="{{$int->key}}"> 
                                  <label for="period_{{$int->key}}" class="text-secondary">{{$int->name}}</label>
                                </div>
                                @endforeach
                            </div>
                          </div>
                          <div class="form-group">
                            <h6 class="bold text-secondary">@lang('phrase.other-conditions')</h6>
                            <div class="row ml-1 conditions" >
                                @foreach(\App\Models\ChoiceMd::select('id',"name_$lang as name")->where('type','other-conditions')->get() as $int)
                                <div class="col-lg-4">
                                  <input type="checkbox" name="conditions[]" id="conditions_{{$int->key}}" value="{{$int->key}}"> 
                                  <label for="conditions_{{$int->key}}" class="text-secondary">{{$int->name}}</label>
                                </div>
                                @endforeach
                            </div>
                          </div>
                          @break
                      @case('visa-support'){{------------ visa support ------------}}
                          <div class="form-group">
                            <h6 class="bold text-secondary">@lang('phrase.location')</h6>
                            <div class="row ml-1 type" >
                                @foreach(\App\Models\ProvinceMd::select('province_id as id',"province_name_$lang as province")->orderBy('province')->get() as $int)
                                <div class="col-lg-4">
                                  <input type="checkbox" name="location[]" id="location_{{$int->id}}" value="{{$int->id}}"> 
                                  <label for="location_{{$int->id}}" class="text-secondary">{{$int->province}}</label>
                                </div>
                                @endforeach
                            </div>
                          </div>
                          <div class="form-group">
                            <h6 class="bold text-secondary">@lang('phrase.visa-type')</h6>
                            <div class="row ml-1 type" >
                                @foreach(\App\Models\VisaTypeMd::select('id',"name_$lang as name")->get() as $int)
                                <div class="col-lg-6">
                                  <input type="checkbox" name="type[]" id="type_{{$int->key}}" value="{{$int->key}}"> 
                                  <label for="type_{{$int->key}}" class="text-secondary">{{$int->name}}</label>
                                </div>
                                @endforeach
                            </div>
                          </div>
                          @break
                      @case('setting-cp'){{------------ setting company ------------}}
                          <div class="form-group">
                            <h6 class="bold text-secondary">@lang('phrase.location')</h6>
                            <div class="row ml-1 type" >
                                @foreach(\App\Models\ProvinceMd::select('province_id as id',"province_name_$lang as province")->orderBy('province')->get() as $int)
                                <div class="col-lg-4">
                                  <input type="checkbox" name="location[]" id="location_{{$int->id}}" value="{{$int->id}}"> 
                                  <label for="location_{{$int->id}}" class="text-secondary">{{$int->province}}</label>
                                </div>
                                @endforeach
                            </div>
                          </div>
                          <div class="form-group">
                            <h6 class="bold text-secondary">@lang('phrase.consulting')</h6>
                            <div class="row ml-1 type" >
                                @foreach(\App\Models\ConsultingMd::select('id',"name_$lang as name")->get() as $int)
                                <div class="col-lg-6">
                                  <input type="checkbox" name="consulting[]" id="consulting_{{$int->id}}" value="{{$int->id}}"> 
                                  <label for="consulting_{{$int->id}}" class="text-secondary">{{$int->name}}</label>
                                </div>
                                @endforeach
                            </div>
                          </div>
                          @break
                      @default
                  @endswitch
                  
              </div>
              <center><button type="submit" class="btn btn-blue btn-update mt-3">Save</button></center>
          </form>


    </div>
  </div>







</div>
</section>



@include("$prefix.footer")

<script src="js/jquery.js"></script>
<!-- Optional JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>

<script src="js/uk-tab.js"></script>
<script src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
<script src="plugin\select2\js\select2.full.js"></script>
<script>
    var lang = '{{Session("lang")}}', _id='{{$_id}}';
    $(".example").select2({
      theme: 'classic',
      placeholder : 'Warehouse'
    });
    $(document).on('change','#category',function(){
        insertFilter(parseFloat($(this).val()),filters());
    })
    var insertFilter = () => {

    }
</script>
<script src="js/build/main.js?v=02"></script>
