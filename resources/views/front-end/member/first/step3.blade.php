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
            <h4 class="bold text-center mb-5">Step 3</h4>
            <div class="alert alert-warning"><strong class="bold">คำเตือน!</strong> อย่าออกจากหน้านี้จนกว่าจะทำทุกขั้นตอนจนเสร็จสมบูรณ์</div>
            <form action="" method="post">
              @csrf
              <div class="form-group">
                <div class="row">
                  <div class="col-lg-12">
                      @if(Session('status')=='Success')
                        <div class="alert alert-success">
                          <strong class="bold">{{Session('status')}}!,</strong> {{Session('message')}}
                          <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                      @endif
                      @if(Session('status')=='Error')
                      <div class="alert alert-danger">
                        <strong class="bold">{{Session('status')}}!,</strong> {{Session('message')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      </div>
                      @endif
                      <label for="address">Details of address</label>
                      <div class="input-group">
                          <div class="input-group-prepend"><span class="input-group-text">日本語</span></div>     
                          <input type="text" name="address_th" class="form-control" id="address" placeholder="Address detail" autocomplete="new-detailOfAddress">
                      </div>
                      <div class="input-group">
                        <div class="input-group-prepend"><span class="input-group-text">ภาษาไทย</span></div>   
                        <input type="text" name="address_th" class="form-control" id="address" placeholder="Address detail" autocomplete="new-detailOfAddress">
                      </div>
                      <label for="address">Address</label> <small class="text-danger">*กรอกรหัสไปรษณีย์ ที่อยู่จะปรากฏขึ้นมา</small>
                      <div class="input-group" style="margin-bottom: 0 !important;">
                          <div class="input-group-prepend">
                              <div class="input-group-text"><i class="fas fa-home"></i></div>
                          </div>
                          <input type="text" id="postcode" class="form-control"  placeholder="Postcode" autocomplete="new-postcode" >
                          <input type="text" id="subdistrict" class="form-control"  placeholder="Subdistrict" readonly="">
                          <input type="text" id="district" class="form-control"  placeholder="District" readonly="">
                          <input type="text" id="province" class="form-control"  placeholder="Province" readonly="" >
                      </div>
                      <div id="autoAddresArea" class="mb-2"></div>
                      <input type="hidden" name="postcode">
                      <input type="hidden" name="subdistrict">
                      <input type="hidden" name="district">
                      <input type="hidden" name="province">
                    
                    @php
                      $langP = (Session('lang')=='th')?'th':'en';
                      $lang = Session('lang');
                      $workingHour = \App\Models\Filter\CpWorkingHoursMd::where("_id",$_id)->select('id','day','time')->get();
                    @endphp

                    <label for="mobile">Location ใส่ลิ้งค์ iframe google map</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>
                      </div>
                      <textarea name="gmap" class="form-control" rows='6'></textarea>
                    </div>
                  </div>
                  <div class="col-6 col-lg-6">
                    <label for="mobile">@lang('phrase.telephone')</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-phone"></i></div>
                      </div>
                      <input type="text" name="phone" class="form-control" placeholder="@lang('phrase.telephone')">
                    </div>
                  </div>
                  <div class="col-6 col-lg-6">
                    <label for="mobile">@lang('phrase.email_contact')</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><i class="fas fa-envelope"></i></div>
                      </div>
                      <input type="email" name="email" class="form-control" placeholder="@lang('phrase.email_contact')">
                    </div>
                  </div>
                
                  <div class="col-lg-12 working_hour" data-val="{{json_encode($workingHour)}}">
                    <label for="mobile">@lang('phrase.working_hours')</label>
                    @foreach(\App\Models\WorkingHoursMd::select("id","name_$lang as name")->get() as $kwh => $wh)
                    <div class="input-group">
                      <label for="working_hour{{$kwh}}" class="form-control" ><input type="checkbox" id="working_hour{{$kwh}}" name="day[]" value="{{$wh->id}}"> {{$wh->name}}</label>
                      <input type="text" name="time[]" class="form-control" placeholder="{{__('phrase.time')}}" disabled="">
                    </div>
                    @endforeach
                  </div>
                  <div class="col-6 col-lg-6">
                    <label for="mobile">Facebook</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><img src="images/icon/facebook.svg"></div>
                      </div>
                      <input type="text" name="facebook" class="form-control" placeholder="Facebook URL">
                    </div>
                  </div>
                  <div class="col-6 col-lg-6">
                    <label for="mobile">Line@</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><img src="images/icon/line.svg"></div>
                      </div>
                      <input type="text" name="line" class="form-control" placeholder="LINE ID" autocomplete="new-lineID">
                    </div>
                  </div>
                  <div class="col-12 col-lg-12 ">
                    <label for="mobile">Website</label>
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="input-group-text"><img src="images/icon/world-wide-web.svg"></div>
                      </div>
                      <textarea name="website" class="form-control" placeholder="Website" rows="2" autocomplete="new-com_website"></textarea>
                    </div>
                  </div>

                  
                </div>
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
<script src="js/build/addressAutoComplete.js"></script>
<script>
    var lang = '{{Session("lang")}}', _id='{{$_id}}';
    $('#postcode').addressAuto({
      subdistict : '#subdistrict',
      distict : '#subdistrict',
      province : '#province',
      displayAuto: '#autoAddresArea'
    })
    $('input[name^="day"]').on('change',function(){
        let $next = $(this).parent().next();
        if(typeof $next.attr("disabled")!== typeof undefined)
          $next.removeAttr('disabled');
        else
          $next.attr('disabled','disabled');
    })
</script>
<script src="js/build/main.js?v=02"></script>
