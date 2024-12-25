<!doctype html>
<html lang="{{Session('lang')}}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>{{env('APP_NAME')}} - Forgot your password?</title>

  <base href="{{url('/')}}">
  <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="fonts/icofont.css">
  <link rel="stylesheet" href="css/fontawesome.css">
  <link rel="stylesheet" href="css/header-footer.css?v=0006">
  <link rel="stylesheet" href="css/style.css?v=0005">
  {{-- <link rel="stylesheet" href="css/filter.css?v=0003"> --}}
  <link rel="stylesheet" href="css/panel-box.css?v=07">
  <link rel="stylesheet" href="slick/slick.min.css">
  <link rel="stylesheet" href="slick/slick-custom.css?v=001">
  <link rel="stylesheet" href="css/hunterPopup.css">
  <link rel="stylesheet" href="css/validate.css">
  <link rel="stylesheet" href="css/gallery.css?v=002">
  {{-- <link rel="stylesheet" href="css/detail.css"> --}}
  <link rel="stylesheet" href='https://fonts.googleapis.com/icon?family=Material+Icons'>
  <link rel="stylesheet" href="css/lightgallery.css">
    <style>
        input[type="email"].error,
        input[type="password"].error{
            border:1px solid #f00;
        }
        input[type="email"].error:focus,
        input[type="password"].error:focus
        {
            box-shadow: 0 0 0 0.2rem rgb(255,0,0,0.25) !important;
        }
        html, body {
        height: 100%;
        }
        body{
            display: flex;
            flex-direction: column;
            background-color: #f0f0f0;
        }
        .container{
            flex: 1 0 auto; /* Prevent Chrome, Opera, and Safari from letting these items shrink to smaller than their content's default minimum size. */
            /* padding: 20px; */
        }
        .footer {
            flex-shrink: 0;
        }
        input.error{
            border-color: #ff160c !important;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgb(255 22 12 / 25%) !important;
        }
        
    </style>
</head>
<body>
    @if(@$module!='login' || @$module!='')
        @include("$prefix.$module.header")
    @else
        @include("$prefix.header")
    @endif
  
    <div class="container" >
        <div class="row">
            <div class="col-lg-3"></div>
            <div class="col-lg-5">
                <div class="card px-4 py-4 my-5">
                    <form class="formValidate" action="" method="post">
                        @csrf
                        <div class="row">     
                            <div class="col-lg-12">
                                <h5 class="border-bottom pb-3 text-center" style="color:#fc593b;">@lang('phrase.member.reset-password')</h5>
                            </div>
                            <div class="col-lg-12">                 
                                @if(Session('error'))
                                    <div class="alert alert-danger">
                                        <strong>Opps!</strong>, {{Session('error')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div> 
                                @endif
                                @if(Session('success'))
                                    <div class="alert alert-success">
                                        <strong>Success!</strong>, {{Session('success')}}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <h5>@lang('phrase.member.new-password') : &nbsp;</h5>
                                    <input type="password" name="password" id="password" class="form-control" value="{{Session('password')}}" placeholder="@lang('phrase.member.new-password')">
                                </div>
                                <div class="form-group">
                                    <h5>@lang('phrase.member.confirm-password') : &nbsp;</h5>
                                    <input type="password" name="confirm-password" id="confirmPassword" class="form-control" value="{{Session('confirm-password')}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 mt-5">                              
                                <button type="submit" class="btn btn-login btn-block">@lang('phrase.confirm')</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<div class="footter-content" style="flex-shrink: 0;">
  @include("$prefix.footer")
</div>

  <script src="js/jquery.js"></script>
  <!-- Optional JavaScript -->
  {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.10.0/js/lightgallery.min.js" integrity="sha512-gDBgGPXSeC2hx1W3S1CfSHbAValtLI8OArTGf0UVX7Fwb9Ak7HUE3LK9UEZxKGYVrIe0CJUVZDk9B2dIPwJ6VQ==" crossorigin="anonymous"></script> --}}
  <script src="js/lightgallery.js"></script>
  <script src="js/lg-fullscreen.js"></script>
  <script src="js/lg-thumbnail.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>

  <script src="js/bootstrap.min.js"></script>

  <script src="js/jquery-popup.js"></script>
  <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

  <script type="text/javascript" src="js/custom.js?v=0001"></script>
  <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
  <script type="text/javascript" src="js/build/authentication.js"></script>
  <script type="text/javascript" src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>

  <script type="text/javascript" src="slick/slick.min.js"></script>
  <script type="text/javascript" src="slick/custom.js"></script>
  <script type="text/javascript" src="slick/main.js"></script>
  <script type="text/javascript" src="js/color.js"></script>
    <script>
        errMessage = {
            equalTo: ['รหัสผ่านไม่เหมือนกัน','password is a ']
        },
        reqMessage = {
            password : ['กรอกรหัสผ่าน.','Enter your email.'],
            confirmPassword : ['กรอกรหัสผ่าน.','Enter your email.'],
        },
        lang = $('html').attr('lang'),
        hl = (lang=='th')?0:1,
        url = window.location.pathname,
        segment = url.split('/'),
        category = segment[2];
        $('.formValidate').validate({
            ignore : [],
            rules : {
                password: { required: true },
                'confirm-password': {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages : {
                password: { required: reqMessage.password[hl] },
                'confirm-password':{
                    required: reqMessage.confirmPassword[hl],
                    equalTo: errMessage.equalTo[hl]
                }
            },
            errorElement: 'span',
            highlight : function(el,error){ $(el).addClass(error); },
            unhighlight : function(el,error){ $(el).removeClass(error); },
            errorPlacement : function(error,el){        
                el.prev().append(error)                
            }
        });
    </script>
</body>
</html>
