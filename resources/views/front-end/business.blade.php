<!doctype html>
<html lang="{{ Session('lang') }}">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ ENV('APP_NAME') }}</title>

    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "name": "At-Once",
            "url": "https://at-once.info",
            "logo": {
                "@type": "ImageObject",
                "url": "https://at-once.info/img/at-once-tw.png"
            },
            "description": "แหล่งรวบรวมข้อมูลธุรกิจครบวงจรสำหรับค้นหารายชื่อบริษัทจากทุกอุตสาหกรรมในประเทศไทย ผู้ให้บริการเว็บไซต์รวมรายชื่อบริษัทอันดับหนึ่ง พร้อมข้อมูลสำคัญอย่างละเอียดถูกต้องและทันสมัย",
            "areaServed": {
                "@type": "Country",
                "name": "Thailand"
            },
            "potentialAction": {
                "@type": "SearchAction",
                "target": "https://at-once.info/th/search?keywords={search_term_string}",
                "query-input": "required name=search_term_string"
            }
        }
    </script>

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
        integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/header-footer.css" rel="stylesheet">
    <link href="css/member-company.css?v=002" rel="stylesheet">
    <link rel="stylesheet" href="css/gallery.css?v=0001">
    <!-- Latest compiled and minified CSS -->
    {{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css"> --}}
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
    <link rel="stylesheet" href="plugin/select2/css/select2.min.css">
    <style>
        .select-wrapper {
            margin: auto;
            max-width: 600px;
            width: calc(100% - 40px);
        }

        .select-pure__select {
            align-items: center;
            background: #f9f9f8;
            border-radius: 4px;
            border: 1px solid rgba(0, 0, 0, 0.15);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            box-sizing: border-box;
            color: #363b3e;
            cursor: pointer;
            display: flex;
            font-size: 16px;
            font-weight: 500;
            justify-content: left;
            min-height: 44px;
            padding: 5px 10px;
            position: relative;
            transition: 0.2s;
            width: 100%;
        }

        .select-pure__options {
            border-radius: 4px;
            border: 1px solid rgba(0, 0, 0, 0.15);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.04);
            box-sizing: border-box;
            color: #363b3e;
            display: none;
            left: 0;
            max-height: 221px;
            overflow-y: scroll;
            position: absolute;
            top: 50px;
            width: 100%;
            z-index: 5;
        }

        .select-pure__select--opened .select-pure__options {
            display: block;
        }

        .select-pure__option {
            background: #fff;
            border-bottom: 1px solid #e4e4e4;
            box-sizing: border-box;
            height: 44px;
            line-height: 25px;
            padding: 10px;
        }

        .select-pure__option--selected {
            color: #e4e4e4;
            cursor: initial;
            pointer-events: none;
        }

        .select-pure__option--hidden {
            display: none;
        }

        .select-pure__selected-label {
            background: #5e6264;
            border-radius: 4px;
            color: #fff;
            cursor: initial;
            display: inline-block;
            margin: 5px 10px 5px 0;
            padding: 3px 7px;
        }

        .select-pure__selected-label:last-of-type {
            margin-right: 0;
        }

        .select-pure__selected-label i {
            cursor: pointer;
            display: inline-block;
            margin-left: 7px;
        }

        .select-pure__selected-label i:hover {
            color: #e4e4e4;
        }

        .select-pure__autocomplete {
            background: #f9f9f8;
            border-bottom: 1px solid #e4e4e4;
            border-left: none;
            border-right: none;
            border-top: none;
            box-sizing: border-box;
            font-size: 16px;
            outline: none;
            padding: 10px;
            width: 100%;
        }

        button.dropdown-toggle::after {
            right: 15px !important;
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
                        <form action="" method="post">
                            @csrf
                            @php $lang=Session('lang'); @endphp
                            <div class="group-box-right">
                                <h5 class="bold border-bottom mb-5">ข้อมูลเกี่ยวกับธุรกิจ</h5>
                                @if (Session('status') == 'Success')
                                    <div class="alert alert-success">
                                        <strong class="bold">{{ Session('status') }}!</strong>
                                        {{ Session('message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (Session('status') == 'Error')
                                    <div class="alert alert-danger">
                                        <strong class="bold">{{ Session('status') }}!</strong>
                                        {{ Session('message') }}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <h6 for="exampleFormControlSelect1" class="bold text-secondary">@lang('phrase.company-nationality')
                                    </h6>
                                    <select name="country" class="form-control selectpicker"
                                        id="exampleFormControlSelect1" data-live-search="true">
                                        @foreach (\App\Models\CountryMd::all() as $coun)
                                            <option value="{{ $coun->alpha2 }}"
                                                data-content='<img src="flags/{{ strtolower($coun->alpha2) }}.png" width="20"> {{ @$coun->country }} <small class="text-secondary">{{ $coun->nationality }}</small>'
                                                @if ($coun->alpha2 == $row->alpha2)
                                                selected
                                        @endif></option>
                                        @endforeach
                                    </select>
                                </div>
                                @include('front-end.member.filter')
                            </div>
                            <center><button type="submit" class="btn btn-blue btn-update mt-3">บันทึก</button></center>
                        </form>
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
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
    <script src="js/uk-tab.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=001"></script>
    <script src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
    <script src="plugin\select2\js\select2.full.js"></script>
    <script src="js/build/main.js?v=001"></script>
    <script src="js/build/media.image.js?v=005"></script>
    <script>
        let thisFilter = document.querySelectorAll('.this-filter');
        thisFilter.forEach(element => {
            let val = element.getAttribute('data-val')
            let input = element.querySelectorAll('.filterSub')
            if (val != '') {
                val = JSON.parse(val);
                for (let i = 0; i < input.length; i++) {
                    for (let j = 0; j < val.length; j++) {
                        if (val[j]?.key == input[i]?.value) {
                            if(element.querySelector('.filterSub').tagName === 'INPUT'){
                                input[i].setAttribute('checked', true)
                            } else {
                                input[i].setAttribute('selected', true)
                            }
                        }
                    }
                }
            }
        });

        $(".warehouse").select2({
            theme: 'classic',
            placeholder: 'Warehouse'
        });
        $(".location").select2({
            theme: 'classic',
            placeholder: 'Location'
        });
        $(".nationality").select2({
            theme: 'classic',
            placeholder: 'Nationality'
        });
        $(".pick-up-point").select2({
            theme: 'classic',
            placeholder: 'Pick up point'
        });
        $(".destination").select2({
            theme: 'classic',
            placeholder: 'destination'
        });
    </script>
</body>
</html>
