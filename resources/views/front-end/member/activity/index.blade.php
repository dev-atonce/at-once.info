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

        .h5 {
            font-size: 18px;
            font-weight: bold;
        }

        .h4 {
            font-size: 20px;
            font-weight: bold;
        }
    </style>
</head>

<body>

    @include("$prefix.header")

    <section class="page">
        <div class="container">
            <div class="col-lg-12">
                <div class="personal row" style="box-shadow: rgba(0, 0, 0, 0.08) 0px 4px 16px;">
                    <div class="left">
                        @include("$prefix.member.member-menu")
                    </div>
                    @php($path = $module != 'member' ? '/{{ $module }}/member' : '/member')
                    <div class="right">
                        <div class="group-box-right">
                            <strong class="bold border-bottom mb-5 h5">@lang('phrase.activity')</strong>
                            <div class="row">
                                <div class="col-lg-12">
                                    <a class="btn btn-primary btn-sm float-right mb-2"
                                        href="{{ Session('lang') }}{{ $path }}/activity/create/{{ $category }}/{{ $cid }}">+
                                        @lang('phrase.create')</a>
                                </div>
                            </div>
                            @if (Session('status'))
                                <div class="alert alert-{{ Session('status') }} alert-dismissible fade show"
                                    role="alert">
                                    <strong class="bold"> {{ Session('message') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                            @endif
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="10%"></th>
                                        <th>Name</th>
                                        <th width="13%">Type</th>
                                        <th width="13%">View</th>
                                        <th width="24%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($blog->count() > 0)
                                        @foreach ($blog as $k => $v)
                                            <tr>
                                                <td class="text-center"><img
                                                        src="{{ str_replace('.', '-xs.', $v->images) }}"
                                                        class="img-thumbnail border" style="max-width: 80px"></td>
                                                @if ($v->status == 0)
                                                    <td><i
                                                            class="fas fa-hourglass-half text-warning mr-1"></i><span>{{ $v->name_th }}</span>
                                                    </td>
                                                @else
                                                    <td><i
                                                            class="fas fa-check-circle text-success mr-1"></i><span>{{ $v->name_th }}</span>
                                                    </td>
                                                @endif

                                                <td class="text-uppercase">
                                                    {{ $v->type == 'selfedit' ? 'general' : $v->type }}
                                                </td>
                                                <td><i class="fas fa-eye" style="color: #798191;">
                                                        {{ $v->view }}</i></td>
                                                <td>
                                                    <a class="btn btn-success btn-sm"
                                                        href="{{ Session('lang') }}{{ $path }}/activity-stat/{{ $category }}/{{ $cid }}/{{ $v->id }}"><i
                                                            class="fas fa-layer-group"></i></a>
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ Session('lang') }}{{ $path }}/activity/{{ $category }}/{{ $cid }}/{{ $v->id }}"><i
                                                            class="fas fa-pencil-alt"></i></a>
                                                    <a class="btn btn-danger btn-sm delete"
                                                        data-id="{{ $v->id }}" href="javascript:"><i
                                                            class="far fa-trash-alt"></i></a>
                                                    <a class="btn btn-info btn-sm share" data-id="{{ $v->id }}"
                                                        @if ($v->status != 1) style="pointer-events: none; background-color: #c5c5c5 !important; border-color:#c5c5c5 ;" @endif
                                                        href="{{ Session('lang') }}{{ $path }}/activity-share/{{ $category }}/{{ $cid }}/{{ $v->id }}/{{ $v->url_th }}"><i
                                                            class="fas fa-share"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td style="text-align: center;" colspan="4">ไม่พบข้อมูล...</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
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
    <script type="text/javascript" src="js/plugin/sweetalert2/sweetalert2.all.min.js"></script>
    <script src="js/build/main.js?v=04"></script>
    <script src="js/build/media.image.js?v=005"></script>
    <script>
        var lang = '{{ Session('lang') }}';
        var fullUrl = `${lang}/member/activity`;

        $('i.fa-eye-slash').click(function() {
            $(this).toggleClass('fa-eye-slash fa-eye');
            const prev = $(this).parent().parent().prev();
            type = (prev.attr('type') == 'password') ? 'text' : 'password';
            prev.attr('type', type);
        });
        errMessage = {
                th_require: ['กรุณากรอกชื่อบริษัท', 'Please enter company name.'],
                jp_require: ['กรุณากรอกชื่อบริษัท', '会社名を入力してください.'],
                remote: ['ชื่อนี้มีอยู่แล้ว', 'This name already exists']
            },
            lang = '{{ Session('lang') }}',
            hl = (lang == 'th') ? 0 : 1;
        $('#change-name').validate({
            ignore: [],
            rules: {
                name_th: {
                    required: true,
                    remote: {
                        url: 'check/name?hl=th',
                        type: 'get',
                        data: {
                            name: function() {
                                return $('#name_th').val()
                            }
                        }
                    }
                },
                name_jp: {
                    required: true,
                    remote: {
                        url: 'check/name?hl=jp',
                        type: 'get',
                        data: {
                            name: function() {
                                return $('#name_jp').val()
                            }
                        }
                    }
                },
            },
            messages: {
                name_th: {
                    required: errMessage.th_require[hl],
                    remote: errMessage.remote[hl]
                },
                name_jp: {
                    required: errMessage.jp_require[hl],
                    remote: errMessage.remote[hl]
                }
            },
            errorPlacement: function(error, input) {
                error.insertAfter(input.parent().prev());
            }
        })

        $(document).on('click', '.delete', function() {
            const id = $(this).attr('data-id');
            Swal.fire({
                title: "Delete data",
                text: "Do you want to delete the data?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                showLoaderOnConfirm: true,
                preConfirm: () => {
                    return fetch(fullUrl + '/delete?id=' + id)
                        .then(response => response.json())
                        .then(data => location.reload())
                        .catch(error => {
                            Swal.showValidationMessage(`Request failed: ${error}`)
                        })
                }
            });
        })
    </script>
</body>

</html>
