<!doctype html>
<html lang="{{ Session('lang') }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ENV('APP_NAME') }}</title>

    <base href="{{ url('/') }}">
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
        .mce-btn,
        .mce-panel {
            background-color: #fff !important;
        }

        input.error {
            border: 1px solid red;
        }

        input.error:focus {
            border-color: rgb(255, 128, 128);
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(255, 0, 0, 0.25);
        }
    </style>
</head>

<body>

    @if ($module != 'member')
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
                            <form id="change-password" action="th/member/setting/password" method="post">
                                @csrf
                                <h5 class="bold border-bottom mb-5">เปลี่ยนรหัสผ่าน</h5>
                                @if (Session('status') == 'Success')
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong class="bold">{{ Session('status') }}!</strong>
                                        {{ Session('message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (Session('status') == 'Error')
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong class="bold">{{ Session('status') }}!</strong>
                                        {{ Session('message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-8">
                                        <label class="mr-2">รหัสผ่านใหม่</label>
                                        <div class="input-group">
                                            <input type="password" name="password" id="password" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="far fa-eye-slash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-2"></div>
                                    <div class="col-lg-8">
                                        <label class="mr-2">ยืนยันรหัสผ่าน</label>
                                        <div class="input-group">
                                            <input type="password" name="confirm" id="confirm" class="form-control">
                                            <div class="input-group-append">
                                                <span class="input-group-text"><i class="far fa-eye-slash"></i></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <center class="mt-5"><button type="submit" class="btn btn-primary">บันทึก</button>
                                </center>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>



    @include("$prefix.footer")

    <script src="js/jquery.js"></script>
    <!-- Optional JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en">
    </script>

    <script src="js/uk-tab.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=001"></script>
    <script src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
    <script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script>
        tinymce.init({
            selector: 'textarea.tiny-detail',
            menubar: false,
            force_br_newlines: true,
            force_p_newlines: false,
            forced_root_block: '',
            height: 600,
            //width : 1100,
            plugins: ["advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor colorpicker layer textpattern moxiemanager"
            ],
            toolbar: 'undo redo | table | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | nonbreaking hr code',

        });
        $('i.fa-eye-slash').click(function() {
            $(this).toggleClass('fa-eye-slash fa-eye');
            const prev = $(this).parent().parent().prev();
            type = (prev.attr('type') == 'password') ? 'text' : 'password';
            prev.attr('type', type);
        });
        errMessage = {
                password_require: ['ป้อนรหัสผ่านใหม่', 'Enter new password.'],
                new_password: ['ป้อนรหัสผ่านยืนยัน.', 'Enter enter confirm password.'],
                minlength: ['พาสเวิร์ดอย่างน้อย', 'Password at least'],
                characters: ['ตัวอักษร', 'characters'],
                equalTo: ['พาสเวิร์ดไม่ตรงกัน', 'Password mismatch.']
            },
            lang = '{{ Session('lang') }}',
            hl = (lang == 'th') ? 0 : 1;
        $('#change-password').validate({
            ignore: [],
            rules: {
                password: {
                    required: true,
                    minlength: 8
                },
                confirm: {
                    required: true,
                    minlength: 8,
                    equalTo: '#password'
                },
            },
            messages: {
                password: {
                    required: errMessage.password_require[hl],
                    minlength: errMessage.minlength[hl] + ' {0} ' + errMessage.characters[hl]
                },
                confirm: {
                    required: errMessage.new_password[hl],
                    minlength: errMessage.minlength[hl] + ' {0} ' + errMessage.characters[hl],
                    equalTo: errMessage.equalTo[hl]
                }
            },
            errorPlacement: function(error, input) {
                error.insertAfter(input.parent().prev());
            }
        })
        var lang = '{{ Session('lang') }}';
    </script>
    <script src="js/build/main.js?v=04"></script>
    <script src="js/build/media.image.js?v=005"></script>
