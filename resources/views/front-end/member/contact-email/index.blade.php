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
                            <strong class="bold border-bottom h5">@lang('phrase.member.menu.c-email')</strong>
                            <div class="row mb-5 mt-1">
                                <div class="col-12">
                                    @lang('phrase.member.contact-email.contact-for-sending')
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12">
                                    <a class="btn btn-primary btn-sm float-right mb-2"
                                        href="{{ Session('lang') }}{{ $path }}/contact-email/create/{{ $category }}/{{ $cid }}">+
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
                                        <th width="">@lang('phrase.member.contact-email.contact-company')</th>
                                        <th width="">@lang('phrase.member.contact-email.contact-name')</th>
                                        <th width="">@lang('phrase.member.contact-email.contact-department')</th>
                                        <th width="">@lang('phrase.member.contact-email.contact-email')</th>
                                        <th width="18%"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($contact->count() > 0)
                                        @foreach ($contact as $k => $v)
                                            <tr>
                                                <td>
                                                    <span>{{ $v->company_name }}</span>
                                                </td>
                                                <td>{{ $v->customerName }}</td>
                                                <td>{{ $v->department }}</td>
                                                <td>{{ $v->email }}</td>
                                                <td>
                                                    <a class="btn btn-success btn-sm"
                                                        href="{{ Session('lang') }}{{ $path }}/contact-email/stat/{{ $category }}/{{ $cid }}/{{ $v->id }}">
                                                        <i class="fas fa-layer-group"></i></a>
                                                    <a class="btn btn-warning btn-sm"
                                                        href="{{ Session('lang') }}{{ $path }}/contact-email/{{ $category }}/{{ $cid }}/{{ $v->id }}">
                                                        <i class="fas fa-pencil-alt"></i></a>
                                                    <a class="btn btn-danger btn-sm delete"
                                                        data-id="{{ $v->id }}" href="javascript:">
                                                        <i class="far fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td style="text-align: center;" colspan="5">ไม่พบข้อมูล...</td>
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
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en"></script>
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
        var fullUrl = `${lang}/member/contact-email`;

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
