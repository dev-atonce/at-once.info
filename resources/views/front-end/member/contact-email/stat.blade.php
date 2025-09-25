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
                            <strong class="bold border-bottom h5">MA Blog</strong>
                            <div class="row mb-5 mt-1">
                                <div class="col-12">
                                    ประวัติการเข้าชมเว็บไซต์
                                </div>
                            </div>
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th width="">#</th>
                                        <th width="">URL</th>
                                        <th class="text-center">Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($stat->count() > 0)
                                        @foreach ($stat as $k => $val)
                                            @php($page = explode('/', $val->url))
                                            @if ($page[2] == 'blog')
                                                @php($pageName = \App\Models\BlogMd::select('name_th')->where('url_th', $page[3])->first())
                                            @else
                                                @php($pageName = \App\Models\CompanyMd::select('name_th')->where('profile_url', $page[4])->first())
                                            @endif
                                            <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td>
                                                    @if ($page[2] == 'blog')
                                                        Blog - {{ @$pageName->name_th }}
                                                    @else
                                                        Company Profile - {{ @$pageName->name_th }}
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    {{ $val->click }}
                                                    <a href="javascript:0" class="ip-list" url="{{ $val->url }}"
                                                        data-id="{{ $val->contactId }}" data-page="{{ @$pageName->name_th }}">
                                                        <i class="fas fa-plus-square fa-xs"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td style="text-align: center;" colspan="3">ไม่พบข้อมูล...</td>
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

    <div class="modal fade" id="logtime" tabindex="-1" role="dialog" aria-labelledby="logtime" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="logtimeLabel">Log</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <table class="table-page-views table table-bordered">
                                <thead>
                                    <tr>
                                        <th class="text-center">Datetime</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="ip-norecord text-center">
                                        <td colspan="1">no record.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

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

        const ClicksData = (url, id, page) => {
            const data = $.ajax({
                method: 'get',
                url: 'th/member/contact-email/get-clicks',
                async: false,
                data: {
                    url: url,
                    id: id
                }
            }).responseJSON;

            if (data.length > 0) {
                Modal = $('#logtime');
                Modal.find('tr:not(:eq(0))').remove();
                Modal.find('.ip-norecord').addClass('d-none');
                Modal.find('#logtimeLabel').html(page);
                tr = $(`<tr><td></td></tr>`);
                ul = $('<ul></ul>');
                data.map((v) => {
                    ul.append(`<li>${new Date(v.datetime).toLocaleString()}</li>`)
                });
                tr.find('td').append(ul);
                Modal.find('tbody').append(tr);
                Modal.modal('show');
            }
        }

        $(document).on('click', '.ip-list', function() {
            url = $(this).attr('url');
            id = $(this).attr('data-id');
            page = $(this).attr('data-page');
            if (url || id) ClicksData(url, id, page);
        })
    </script>
</body>

</html>
