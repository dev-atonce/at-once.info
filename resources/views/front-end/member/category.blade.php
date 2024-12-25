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
    <link rel="stylesheet" href="js/plugin/sweetalert2/sweetalert2.min.css">
    <style>
        .main_page { 
            height: 100vh;
        }

        .categoryname {
            border-top-left-radius: 25px;
            border-top-right-radius: 25px;
            background: var(--v1-navy);
            padding: 10px;
        }

        .categoryname p {
            color: #fff;
        }

        .categoryClick {
            border-radius: 25px;
            cursor: pointer;
            border: unset;
            box-shadow: 0 19px 38px rgba(0, 0, 0, 0.30), 0 15px 12px rgba(0, 0, 0, -0.78);
            transition: all 0.3s ease-in-out;
        }

        .categoryClick:hover {
            text-decoration: none;
            transform: scale(1.03);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.25), 0 5px 5px rgba(0, 0, 0, -0.78);
        }

        .texthead {
            color: #3c4b64;
            text-shadow: 2px 8px 6px rgba(0, 0, 0, 0.2),
                0px -5px 16px rgba(255, 255, 255, 0.3);
        }

        .companyname{
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    </style>
</head>

<body>
    <section class="page main_page">
        <div class="selectcat d-flex align-items-center justify-content-center">
            <h1 class="texthead font-weight-bolder mb-5">SELECT CATEGORY</h1>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                @foreach ($row as $v)
                    @php
                        $package = \App\Models\OurCustomerMd::select(['package'])->where('company',$v->id)->first();
                    @endphp
                    <div class="col-xl-4 col-md-6 col-6 mb-5">
                        <div class="card categoryClick" data-id="{{ $v->id }}" data-key={{ $v->key }}>
                            @if ($package)
                                <a href="{{ session('lang') }}/member/statistics/{{ $v->key }}/{{ $v->id }}" style="text-decoration: none; color:#3c4b64">
                            @else
                                <a class="packagePopup" style="text-decoration: none; color:#3c4b64">
                            @endif
                            <div class="categoryname">
                                <p class="card-text text-center font-weight-bolder">{{ $v->categoryName }}</p>
                            </div>
                            <img class="card-img-top" src="{{ $v->logo }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-center companyname">{{ $v->name_th }}</h5>
                            </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/blog.color.js"></script>
    <script src="js/plugin/sweetalert2/sweetalert2.all.js"></script>
</body>
<script>
    $('.packagePopup').on('click', function() {
        Swal.fire({
            icon: 'error',
            title: 'ขออภัย ธุรกิจนี้ของท่าน ไม่ได้อยู่ในแพ็คเกจการให้บริการ',
            footer:'หากต้องการสอบถามข้อมูลราคาแพ็คเกจเพิ่มเติม'+'<a class="ml-2" style="text-decoration:none;" href="/th/promotion-package">คลิกที่นี้</a>',
            showConfirmButton: false,
        })
    })
</script>
