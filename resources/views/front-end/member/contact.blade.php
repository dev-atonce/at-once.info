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

    <style>
        .ad-auto {
            position: absolute;
            padding: 0;
            background: #e9ecef;
            border: 1px solid;
            border-top: none;
            border-color: #ccc;
            margin-top: 1px;
        }

        .ad-auto ul {
            font-size: 14px;
            margin-left: 0;
        }

        ul.ad-auto li {
            color: #000;
            font-size: 14px;
            padding: 5px 5px 5px 12px;
        }

        ul.ad-auto li>span {
            color: #555;
        }

        ul.ad-auto li:hover>span {
            color: #fff;
        }

        ul.ad-auto li:hover {
            cursor: pointer;
            background-color: #258aff;
            color: #fff;
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
                            <h5 class="bold border-bottom mb-5">@lang('phrase.contact-information')</h5>
                            <form action="" method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            @if (Session('status') == 'Success')
                                                <div class="alert alert-success">
                                                    <strong class="bold">{{ Session('status') }}!,</strong>
                                                    {{ Session('message') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                            @endif
                                            @if (Session('status') == 'Error')
                                                <div class="alert alert-danger">
                                                    <strong class="bold">{{ Session('status') }}!,</strong>
                                                    {{ Session('message') }}
                                                    <button type="button" class="close" data-dismiss="alert"
                                                        aria-label="Close"><span
                                                            aria-hidden="true">&times;</span></button>
                                                </div>
                                            @endif
                                            <label for="address">Details of address</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span
                                                        class="input-group-text">ภาษาไทย</span></div>
                                                <input type="text" name="address_th" class="form-control"
                                                    id="address_th" placeholder="รายละเอียดที่อยู่"
                                                    autocomplete="new-detail-th" value="{!! $row->address_th !!}">
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span
                                                        class="input-group-text">English</span></div>
                                                <input type="text" name="address_en" class="form-control"
                                                    id="address_en" placeholder="Address detail"
                                                    autocomplete="new-detail-en" value="{!! $row->address_en !!}">
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span
                                                        class="input-group-text">日本語</span></div>
                                                <input type="text" name="address_jp" class="form-control"
                                                    id="address_jp" placeholder="アドレスの詳細" autocomplete="new-detail-jp"
                                                    value="{{ $row->address_jp }}">
                                            </div>
                                            <div class="input-group">
                                                <div class="input-group-prepend"><span
                                                        class="input-group-text">中国人</span></div>
                                                <input type="text" name="address_zh" class="form-control"
                                                    id="address_zh" placeholder="地址详情" autocomplete="new-detail-ch"
                                                    value="{!! $row->address_zh !!}">
                                            </div>
                                            <label for="address">Address</label> <small
                                                class="text-danger">*กรอกรหัสไปรษณีย์ ที่อยู่จะปรากฏขึ้นมา</small>
                                            <div class="mb-3">
                                                <div class="input-group" style="margin-bottom: 0 !important;">
                                                    <div class="input-group-prepend">
                                                        <div class="input-group-text"><i class="fas fa-home"></i>
                                                        </div>
                                                    </div>
                                                    <input type="text" id="postcode" class="form-control"
                                                        placeholder="Postcode" autocomplete="new-postcode"
                                                        value="{{ $row->postcode }}">
                                                    <input type="text" id="subdistrict" class="form-control"
                                                        placeholder="Subdistrict" readonly=""
                                                        value="{{ $row->subdistrict }}">
                                                    <input type="text" id="district" class="form-control"
                                                        placeholder="District" readonly=""
                                                        value="{{ $row->district }}">
                                                    <input type="text" id="province" class="form-control"
                                                        placeholder="Province" readonly=""
                                                        value="{{ $row->province }}">
                                                </div>
                                                <div id="autoAddresArea"></div>
                                                <input type="hidden" name="postcode" value="{{ $row->postcode }}">
                                                <input type="hidden" name="subdistrict"
                                                    value="{{ $row->subdist_id }}">
                                                <input type="hidden" name="district"
                                                    value="{{ $row->district_id }}">
                                                <input type="hidden" name="province"
                                                    value="{{ $row->province_id }}">
                                            </div>
                                            @php
                                                $langP = Session('lang') == 'th' ? 'th' : 'en';
                                                $lang = Session('lang');
                                                $workingHour = \App\Models\Filter\CpWorkingHoursMd::where(['_id' => $row->id])
                                                    ->select('id', 'day', 'time')
                                                    ->get();
                                            @endphp
                                            <label for="mobile">Google Map &lt;iframe/&gt;</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i
                                                            class="fas fa-map-marker-alt"></i></div>
                                                </div>
                                                <textarea name="gmap" class="form-control" rows='6'>{!! $row->gmap !!}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-6">
                                            <label for="mobile">@lang('phrase.telephone')</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-phone"></i></div>
                                                </div>
                                                <input type="text" name="phone" class="form-control"
                                                    placeholder="@lang('phrase.telephone')" value="{{ $row->phone }}">
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-6">
                                            <label for="mobile">@lang('phrase.email_contact')</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><i class="fas fa-envelope"></i>
                                                    </div>
                                                </div>
                                                <input type="email" name="email" class="form-control"
                                                    placeholder="@lang('phrase.email_contact')" value="{{ $row->email }}">
                                            </div>
                                        </div>
                                        <div class="col-lg-12 working_hour"
                                            data-val="{{ json_encode($workingHour) }}">
                                            <label for="mobile">@lang('phrase.working_hours')</label>
                                            @foreach (\App\Models\WorkingHoursMd::select('id', "name_$lang as name")->get() as $kwh => $wh)
                                                <div class="input-group">
                                                    <label for="working_hour{{ $kwh }}"
                                                        class="form-control"><input type="checkbox"
                                                            id="working_hour{{ $kwh }}" name="day[]"
                                                            value="{{ $wh->id }}"> {{ $wh->name }}</label>
                                                    <input type="text" name="time[]" class="form-control"
                                                        placeholder="{{ __('phrase.time') }}" disabled="">
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="col-12 col-lg-12 col-xs-12">
                                            <label for="mobile">Facebook (URL)
                                                eg.<span
                                                    style="background:rgb(243 244 245);padding:1px 5px; border-radius:4px; font-size:14px; color: rgba(117, 117, 117, 1);"
                                                    class="text-primary">https://www.facebook.com/abc-logistics</span></label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><img src="images/icon/facebook.svg">
                                                    </div>
                                                </div>
                                                <input type="text" name="facebook" class="form-control"
                                                    placeholder="Facebook URL" value="{{ $row->facebook }}">
                                            </div>
                                        </div>
                                        <div class="col-6 col-lg-12 col-xs-12">
                                            <label for="mobile">Line@</label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><img src="images/icon/line.svg">
                                                    </div>
                                                </div>
                                                <input type="text" name="line" class="form-control"
                                                    placeholder="LINE ID" value="{{ $row->line }}"
                                                    autocomplete="new-lineID">
                                            </div>
                                        </div>
                                        <div class="col-12 col-lg-12 ">
                                            <label for="mobile">Website (URL)
                                                <span style="font-size:14px;"
                                                    class="text-danger font-weight-bold"></span> eg.<span
                                                    style="background:rgb(243 244 245);padding:1px 5px; border-radius:4px; font-size:14px; color: rgba(117, 117, 117, 1);"
                                                    class="text-primary">https://www.abc-logistics.com</span>
                                            </label>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text"><img
                                                            src="images/icon/world-wide-web.svg"></div>
                                                </div>
                                                <textarea name="website" class="form-control" placeholder="Website URL" rows="2"
                                                    autocomplete="new-com_website">{{ $row->website }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <center><button type="submit" class="btn btn-blue btn-update mt-3">บันทึก</button></center>
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
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/uk-tab.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=001"></script>
    <script src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
    <script src="js/build/addressAutoComplete.js?v=002"></script>
    <script src="js/build/main.js"></script>
    <script src="js/build/media.image.js?v=005"></script>
    <script>
        $('#postcode').addressAuto({
            subdistict: '#subdistrict',
            distict: '#subdistrict',
            province: '#province',
            displayAuto: '#autoAddresArea',
        })
        $('input[name^="day"]').on('change', function() {
            let $next = $(this).parent().next();
            if (typeof $next.attr("disabled") !== typeof undefined)
                $next.removeAttr('disabled');
            else
                $next.attr('disabled', 'disabled');
        })
        var workingHour = $('.working_hour').data('val');
        $.each(workingHour, function(k, v) {
            $('input[name^="day"]').map(function() {
                if ($(this).val() == v.day) {
                    $(this).prop('checked', true);
                    $(this).parent().next().val(v.time).removeAttr('disabled');
                }
            })
        })
    </script>
</body>

</html>
