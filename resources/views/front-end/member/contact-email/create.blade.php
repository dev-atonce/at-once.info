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
    <link rel="stylesheet" href="css/skEditor-0.2.css?v=0001">
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

        .h5 {
            font-size: 18px;
            font-weight: bold;
        }

        .h4 {
            font-size: 20px;
            font-weight: bold;
        }

        .custom-file-label.selected {
            overflow: hidden;
        }
    </style>

</head>

<body>

    @include("$prefix.header")
    @php($path = $module != 'member' ? '{{ $path }}' : '/member')
    <section class="page">
        <div class="container">
            <div class="col-lg-12">
                <div class="personal row" style="box-shadow: rgba(0, 0, 0, 0.08) 0px 4px 16px;">
                    <div class="left">
                        @include("$prefix.member.member-menu")
                    </div>
                    <div class="right">
                        <div class="group-box-right">
                            <strong class="bold border-bottom mb-4 h5">@lang('phrase.member.menu.c-email')</strong>
                            <form method="post" action="" enctype="multipart/form-data">
                                @method('post')
                                @csrf
                                @if (Session('status'))
                                    <div class="alert alert-{{ Session('status') }} alert-dismissible fade show"
                                        role="alert">
                                        <strong class="bold"> {{ Session('message') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                    </div>
                                @endif
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="company">ชื่อบริษัท</label>
                                        <input type="text" class="form-control @error('company')is-invalid @enderror" id="company" name="company"
                                            placeholder="ชื่อบริษัท" value="{{ old('company') }}">
                                        @error('company')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="email">อีเมล</label>
                                        <input type="email" class="form-control @error('email')is-invalid @enderror" id="email" name="email"
                                            placeholder="อีเมล" value="{{ old('email') }}">
                                        @error('email')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="telephone">เบอร์โทรศัพท์</label>
                                        <input type="text" class="form-control @error('telephone')is-invalid @enderror" name="telephone" id="telephone"
                                            placeholder="เบอร์โทรศัพท์" value="{{ old('telephone') }}">
                                        @error('telephone')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="customer">ชื่อ - นามสกุล</label>
                                        <input type="customer" class="form-control @error('customer')is-invalid @enderror" id="customer" name="customer"
                                            placeholder="ชื่อ - นามสกุล" value="{{ old('customer') }}">
                                        @error('customer')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col">
                                        <label for="department">แผนก</label>
                                        <input type="text" class="form-control @error('department')is-invalid @enderror" id="department" name="department"
                                            placeholder="แผนก" value="{{ old('department') }}">
                                        @error('department')
                                            <small class="text-danger">{{ $message }}</small>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mt-5">
                                    <div class="col-lg-12">
                                        <button type="submit"
                                            class="btn btn-success btn-sm float-right mb-2">@lang('phrase.save')</button>
                                        <a class="btn btn-danger btn-sm float-right mb-2 mr-2"
                                            href="{{ url("th/member/contact-email/$category/$cid") }}">@lang('phrase.cancel')</a>
                                    </div>
                                </div>
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
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/uk-tab.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=001"></script>
    <script src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
    <script type="text/javascript" src="plugin/tinymce/tinymce.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/a-color-picker@1.1.8/dist/acolorpicker.js"></script>
    <script src="js/b64toBlob.js"></script>
    <script src="js/drag-arrange.js"></script>
    <script src="js/build/skEditor-0.2.js"></script>
    <script src="js/build/main.js?v=04"></script>
    <script src="js/build/media.image.js?v=005"></script>
</body>

</html>
