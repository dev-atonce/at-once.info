<!doctype html>
<html lang="{{Session('lang')}}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{csrf_token()}}">

  <title>{{ENV('APP_NAME')}}</title>

  <base href="{{url('/')}}">  
  <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="fonts/icofont.css">
  <link rel="stylesheet" href="css/fontawesome.css">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/header-footer.css" rel="stylesheet">
  <link href="css/member-company.css?v=002" rel="stylesheet">
  <link rel="stylesheet" href="css/gallery.css?v=0001">
  <link rel="stylesheet" href="css/validate.css">
  <style>
      .mce-btn, .mce-panel{
          background-color: #fff !important;
      }
      input.error{
        border: 1px solid red;
      }
      input.error:focus{
        border-color: rgb(255, 128, 128);
        outline: 0;
        box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25);
      }
  </style>
</head>
<body>

  @if($module!='member')
  @include("$prefix.$module.header")
@else
  @include("$prefix.header")
@endif
 
 <section class="page">
  <div class="container">

    <div class="col-lg-12">
      <div class="personal row" style="box-shadow: rgba(0, 0, 0, 0.08) 0px 4px 16px;">
        <div class="left">
          @include("$prefix.member.member-menu")
        </div>
        <div class="right">
          <div class="group-box-right">
            

            <form id="change-name" action="" method="post">
              @csrf
              <h5 class="bold border-bottom mb-5">ชื่อบริษัท</h5>
              @if(Session('status')=='success')
              <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong class="bold">{{Session('status')}}!</strong> {{Session('message')}}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              @endif
              @if(Session('status')=='error')
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                  <strong class="bold">{{Session('status')}}!</strong> {{Session('message')}}
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
              @endif
              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8 col-xs-12 col-md-12">
                    <div class="form-group">
                      <label for="changeName" class="mb-2"><input type="checkbox" value="change" id="changeName"> เปลี่ยนชื่อบริษัทใหม่</label>
                    </div>
                    <label class="mr-2">ภาษาไทย</label>
                    <div class="form-group">                        
                        <input type="text" name="name_th" id="name_th" class="form-control" value="{{$row->name_th}}">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <label class="mr-2">English</label>
                    <div class="form-group">                        
                        <input type="text" name="name_en" id="name_en" class="form-control" value="{{$row->name_en}}">
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <label class="mr-2">日本語</label>
                    <div class="form-group">                      
                        <input type="text" name="name_jp" id="name_jp" class="form-control" value="{{$row->name_jp}}">
                     
                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <label class="mr-2">中国语訳</label>
                    <div class="form-group">                      
                        <input type="text" name="name_zh" id="name_zh" class="form-control" value="{{$row->name_zh}}">
                     
                    </div>
                </div>
              </div>

              <center class="mt-5"><button type="submit" class="btn btn-primary">Save</button></center>
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

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en"></script>
<script src="js/uk-tab.js"></script>
<script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
<script type="text/javascript" src="js/custom.js?v=001"></script>
<script src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
<script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
<script>
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
    $('i.fa-eye-slash').click(function(){
        $(this).toggleClass('fa-eye-slash fa-eye');
        const prev = $(this).parent().parent().prev();
        type = (prev.attr('type')=='password')?'text':'password';
        prev.attr('type',type);
    });
    errMessage = {
        th_require : ['กรุณากรอกชื่อบริษัท','Please enter company name.'],
        jp_require : ['กรุณากรอกชื่อบริษัท','会社名を入力してください.'],
        remote : ['ชื่อนี้มีอยู่แล้ว','This name already exists']
    },
    lang = '{{Session("lang")}}',
    hl = (lang=='th')?0:1;



      $('#change-name').validate({
          ignore:[],
          rules : {
              name_th : { 
                required: function() { return $('#changeName').is(':checked') }, 
                remote: { 
                  depends: function(){ return $('#changeName').is(':checked') },
                  param: {
                    url: 'check/name?hl=th', type: 'get', data : { name: function(){return $('#name_th').val() } } } 
                  }
              },
              name_jp : { 
                required: function() { return $('#changeName').is(':checked') }, 
                remote: { 
                  depends: function(){ return $('#changeName').is(':checked') },
                  param: {
                    url: 'check/name?hl=jp', type: 'get', data : { name: function(){return $('#name_jp').val() } } } 
                  }
              },
              name_en : { 
                required: function() { return $('#changeName').is(':checked') }, 
                remote: { 
                  depends: function(){ return $('#changeName').is(':checked') },
                  param: {
                    url: 'check/name?hl=en', type: 'get', data : { name: function(){return $('#name_en').val() } } } 
                  }
              },
              name_zh : { 
                required: function() { return $('#changeName').is(':checked') }, 
                remote: { 
                  depends: function(){ return $('#changeName').is(':checked') },
                  param: {
                    url: 'check/name?hl=ch', type: 'get', data : { name: function(){return $('#name_zh').val() } } } 
                  }
              },
          },
          messages : {
              name_th : {required: errMessage.th_require[hl], remote: errMessage.remote[hl]},
              name_jp : {required: errMessage.jp_require[hl], remote: errMessage.remote[hl]},
              name_en : {required: errMessage.th_require[hl], remote: errMessage.remote[hl]},
              name_zh : {required: errMessage.th_require[hl], remote: errMessage.remote[hl]}
          },
          errorPlacement : function(error,input){
            error.insertAfter(input.parent().prev());
          }
      })
    
    var lang = '{{Session("lang")}}';
</script>
<script src="js/build/main.js?v=04"></script>
<script src="js/build/media.image.js?v=005"></script>