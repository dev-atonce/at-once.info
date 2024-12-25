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
  <link rel="stylesheet" href="css/gallery.css?v=0001">
  <link rel="stylesheet" href="css/validate.css">
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
            <h4 class="bold text-center mb-5">Step 1</h4>
            <div class="alert alert-warning"><strong class="bold">คำเตือน!</strong> อย่าออกจากหน้านี้จนกว่าจะทำทุกขั้นตอนจนเสร็จสมบูรณ์</div>
            <form id="step1" action="" method="post" enctype="multipart/form-data">
              @csrf
              <h5 class="bold border-bottom mb-5">ข้อมูลเกี่ยวบริษัท</h5>
              <div class="row mb-4">
                <div class="col-lg-4">
                  <label for="" class="bold">โลโก้บริษัทฯ</label>
                  <img src="images/untitled.png" class="img-thumbnail upload-preview mb-3">
                  <small class="text-primary">รูปภาพจะถูก Resize & Crop ขนาด 500&times;500 Pixel</small>
                  <div class="input-group mb-3">
                    <div class="custom-file">
                      <input type="file" name="image" class="custom-file-input" id="inputLogo">
                      <label class="custom-file-label" for="inputLogo">Choose file</label>
                    </div>
                  </div>
                  
                </div>
                <div class="col-lg-8">
                    <label for="validationTextarea" class="bold">ชื่อบริษัทของคุณ</label>
                    <div class="form-group">
                      <div class="input-group" style="margin-bottom:0px !important;">
                        <div class="input-group-prepend">
                            <span class="input-group-text">ภาษาไทย</span>
                        </div>
                        <input type="text" name="name_th" id="name_th" class="form-control" value="{{$row->name_th}}">
                      </div>   
                    </div>
                    <div class="form-group">
                      <div class="input-group" style="margin-bottom:0px !important;">
                        <div class="input-group-prepend">
                            <span class="input-group-text">English</span>
                        </div>                
                        <input type="text" name="name_en" id="name_en" class="form-control" value="{{$row->name_en}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group" style="margin-bottom:0px !important;"> 
                        <div class="input-group-prepend">
                            <span class="input-group-text">日本語</span>
                        </div>
                        <input type="text" name="name_jp" id="name_jp" class="form-control" value="{{$row->name_jp}}">
                      </div>
                    </div>
                    <div class="form-group">
                      <div class="input-group" style="margin-bottom:0px !important;"> 
                        <div class="input-group-prepend">
                            <span class="input-group-text">中国语訳</span>
                        </div>
                        <input type="text" name="name_zh" id="name_zh" class="form-control" value="{{$row->name_zh}}">
                      </div>
                    </div>
                    <center><button type="submit" class="btn btn-primary">Next</button></center>
                    <div class="mb-4">
                      <label for="validationTextarea" class="bold">จุดเด่นบริษัท</label>
                      <ul class="nav nav-tabs info-member" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link active" id="des-tab" data-toggle="tab" href="#des_th" role="tab" aria-controls="des" aria-selected="true"><img class="mr-2" width="25" src="images/flag_th.jpg" alt="ภาษาไทย"> ภาษาไทย</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#des_en" role="tab" aria-controls="profile" aria-selected="false"><img class="mr-2" width="25" src="images/flag_en.jpg" alt="English"> English</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#des_jp" role="tab" aria-controls="profile" aria-selected="false"><img class="mr-2" width="25" src="images/flag_jp.jpg" alt="日本語"> 日本語</a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#des_zh" role="tab" aria-controls="profile" aria-selected="false"><img class="mr-2" width="25" src="images/flag_zh.jpg" alt="中国语訳"> 中国语訳</a>
                        </li>
                      </ul>
                      <div class="tab-content info-member" id="myTabContent">
                        <div class="tab-pane show active" id="des_th" role="tabpanel" aria-labelledby="home-tab"> 
                          <textarea name="description_th" class="form-control" rows="5" cols="50"></textarea>
                        </div>
                        <div class="tab-pane" id="des_en" role="tabpanel" aria-labelledby="profile-tab">
                          <textarea name="description_en" class="form-control" rows="5" cols="50"></textarea>
                        </div>  
                        <div class="tab-pane" id="des_jp" role="tabpanel" aria-labelledby="profile-tab">
                          <textarea name="description_jp" class="form-control" rows="5" cols="50"></textarea>
                        </div>   
                        <div class="tab-pane" id="des_zh" role="tabpanel" aria-labelledby="profile-tab">
                          <textarea name="description_zh" class="form-control" rows="5" cols="50"></textarea>
                        </div>  
                      </div>
                  </div>

                </div>
              </div>

              

            <div class="mb-3">
                <label for="validationTextarea" class="bold">รายละเอียดบริษัท</label>

                <ul class="nav nav-tabs info-member" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#det_th" role="tab" aria-controls="home" aria-selected="true"><img class="mr-2" width="25" src="images/flag_th.jpg" alt="ภาษาไทย"> ภาษาไทย</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#det_en" role="tab" aria-controls="profile" aria-selected="false"><img class="mr-2" width="25" src="images/flag_en.jpg" alt="English"> English</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#det_jp" role="tab" aria-controls="profile" aria-selected="false"><img class="mr-2" width="25" src="images/flag_jp.jpg" alt="日本語"> 日本語</a>
                  </li>
                  <li class="nav-item" role="presentation">
                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#det_zh" role="tab" aria-controls="profile" aria-selected="false"><img class="mr-2" width="25" src="images/flag_zh.jpg" alt="中国语訳"> 中国语訳</a>
                  </li>
                </ul>
                <div class="tab-content  info-member" id="myTabContent">
                  <div class="tab-pane show active" id="det_th" role="tabpanel" aria-labelledby="home-tab"> 
                    <textarea name="detail_th" class="form-control tiny-detail" rows="20" cols="50"></textarea>
                  </div>
                  <div class="tab-pane" id="det_jp" role="tabpanel" aria-labelledby="profile-tab">
                    <textarea name="detail_jp" class="form-control tiny-detail" rows="20" cols="50"></textarea>
                  </div>   
                </div>

            </div>
            <center><button type="submit" class="btn btn-primary">Next</button></center>
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
<script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
<script src="back-end/jquery-validation-1.19.1/dist/jquery.validate.min.js"></script>
<script>
    // window.addEventListener('beforeunload', function (e) { 
    //     e.preventDefault(); 
    //     e.returnValue = ''; 
    // }); 
    tinymce.init({
		selector: 'textarea.tiny-detail',
		menubar : false,
		force_br_newlines : true,
		force_p_newlines : false,
		forced_root_block : '',
		height: 600, 
        //width : 1100,
        plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker","searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking","save table contextmenu directionality emoticons template paste textcolor colorpicker layer textpattern moxiemanager"],    
        toolbar: 'undo redo | table | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | nonbreaking hr code',
        
    });
    var lang = '{{Session("lang")}}', _id='{{$_id}}';
    $(document).on('change','#inputLogo',function(){
        if (this.files && this.files[0]) {
            $(this).next().html(this.files[0].name);

            var reader = new FileReader();
            reader.readAsDataURL(this.files[0]);
            reader.onload = function(e) {
                var image = new Image();
                image.src = e.target.result;
                image.onload = function () {
                    var height = this.height;
                    var width = this.width;
                    console.log('width:',width,'hieght:',height);
                }
                $('.upload-preview').attr('src', e.target.result);
                UploadTheme.find('.modal-body').append(actionButton);
            };
        }
    })
    $('#step1').validate({
      ignore: [],
      errorClass:'invalid',
      errorElement:'small',
      rules: {
        name_th:{
          required:true
        },
        name_en:{
          required:true
        }
      },
      messages:{
        name_th:{
          required:"ต้องระบุฟิลด์ชื่อ"
        },
        name_en:{
          required:"ต้องระบุฟิลด์ชื่อ"
        }
      },
      errorPlacement:function(er,el){
        el.closest('.form-group').append(er);
      }
    })
</script>
{{-- <script src="js/build/main.js?v=02"></script> --}}
