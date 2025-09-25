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
                            <strong class="bold border-bottom mb-5 h5">@lang('phrase.member.menu.c-email')</strong>
                            {{-- @if (Session('status'))
                                <div class="alert alert-{{ Session('status') }} alert-dismissible fade show" role="alert">
                                    <strong class="bold"> {{ Session('message') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif --}}
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="">บริษัท</th>
                                        <th width="">ชื่อผู้ติดต่อ</th>
                                        <th width="">แผนก</th>
                                        <th width="">อีเมล</th>
                                        <th width="5%">
                                            <input type="checkbox" class="checkAll">
                                        </th>
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
                                                    <input type="checkbox" name="checkMail" id="checkMail"
                                                        class="checkMail" data-id="{{ $v->id }}"
                                                        data-email="{{ $v->email }}"
                                                        data-url="{{ url("/demo/blog/detail/$blogId/$v->id/$blogUrl") }}">
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
                            <div class="row mt-4">
                                <div class="col-lg-12">
                                    <button type="button" class="btn btn-success btn-sm float-right mb-2 send-list"
                                        disabled>ส่งอีเมล</button>
                                </div>
                            </div>
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
        let blogId = {{ $blogId }};
        let email = '{{ $row->email }}';
        let category = '{{ $category }}';
        let cid = '{{ $cid }}';

        $(document).on('change', '.checkAll', function() {
            let checked = false;
            if ($(this).is(':checked')) checked = true;
            else checked = false;
            $('.checkMail').prop('checked', checked);
            disabled = (checked === true) ? false : true;
            $('.send-list').prop('disabled', disabled)
        })

        $(document).on('change', '.checkMail', function() {
            if ($('.checkMail:checked').length <= 10) {
                let mail = $('.checkMail:checked').map(function() {
                    return $(this).val()
                }).get();
                disabled = (mail.length > 0) ? false : true;
                $('.send-list').prop('disabled', disabled);
            } else {
                $(this).prop('checked', false);
            }
        })

        $(document).on('click', '.send-list', function() {
            let contactMail = $('.checkMail:checked').map(function() {
                return $(this).attr('data-email')
            }).get();
            let blogUrl = $('.checkMail:checked').map(function() {
                return $(this).attr('data-url')
            }).get();
            let contactId = $('.checkMail:checked').map(function() {
                return $(this).attr('data-id')
            }).get();

            let fd = new FormData();
            fd.append('contactMail', contactMail);
            fd.append('blogUrl', blogUrl);
            fd.append('contactId', contactId);
            fd.append('blogId', blogId);
            fd.append('email', email);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: lang + '/member/activity-share/blog',
                method: 'post',
                contentType: false,
                processData: false,
                async: false,
                data: fd,
                dataType: 'json',
                success: (res) => {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success !',
                        showConfirmButton: false,
                        timer: 1000
                    }).then((result) => {
                        window.location.replace(`${window.location.origin}/${lang}/member/activity/${category}/${cid}`);
                    })
                },
                error: (res) => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Please Try Again Later !',
                        showConfirmButton: false,
                        timer: 1000
                    })
                }
            });
        })
    </script>
</body>

</html>
