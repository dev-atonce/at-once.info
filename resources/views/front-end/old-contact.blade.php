<!doctype html>
<html lang="en">

<head>
    @include("$prefix.analytics.googleAnalytics")
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $seo->seo_keyword }}">
    <meta name="description" content="{{ $seo->seo_description }}">

    <title>{{ $seo->title }}</title>

    <meta property="og:title" content="{{ $seo->title }}">
    <meta property="og:description" content="{{ $seo->seo_description }}">
    <meta property="og:image" content="{{ url('img/logo-bg-white.jpg') }}">
    <meta property="og:url" content="{{ url('') . '/' . Session('lang') . '/contact' }}">

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/fontawesome.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/panel-box.css">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
    <link rel="stylesheet" href="slider/animate.min.css" media="all">
    <link rel="stylesheet" href="css/validate.css" media="all">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- 04/10/2023 -->
    <link rel="stylesheet" href="css/landing.css?v=0002">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.1/animate.min.css'>
    <link rel="stylesheet" href="css/animate.css">
    <link href="css/package.css" rel="stylesheet">
</head>
<style type="text/css">
    .card-blue {
        /*  background-color: #1b497d!important;*/
        background-color: var(--v1-navy);
        box-shadow: var(--v1-sha01);
        border-radius: var(--v1-radius-lg);
        padding: 3rem !important;
    }

    .info-contact {
        background: rgb(255, 255, 254);
        border: var(--v1-border);
        box-sizing: border-box;
        box-shadow: var(--v1-sha01);
        border-radius: var(--v1-radius-lg);
        width: 100%;
    }

    input.invalid {
        border: 1px solid #ff5f5f;
    }

    /* input.invalid:focus{
    border:2px solid #fd6a6a;
    } */
    em.invalid {
        color: #ff5f5f;
    }

    .text-c-none {
        color: #1f1f1f;
    }

    h2 {
        line-height: 40px;
    }

    /*03/10/2023*/
    .title-landing {
        padding-top: 5px;
        padding-bottom: 50px;
    }

    .steps {
        padding-left: 81px;
    }

    .steps-item {
        position: relative;
        padding-bottom: 65px;
    }

    .steps-item.last {
        padding-bottom: 10px;
    }

    .steps-item-index {
        display: inline-block;
        margin-bottom: 24px;
        padding: 4px 16px;
        border-radius: 40px;
        background-color: #ff7700;

        color: #fffdfd;
        font-size: 16px;
        line-height: 130%;
        font-weight: 600;
        letter-spacing: 0em;
    }

    .steps-item-title {
        margin-bottom: 8px;
        /*color: #2d1653;*/
        font-size: 24px;
        line-height: 130%;
        font-weight: 300;
    }

    .steps-item-line._1 {
        background-image: url(../images/landing/line-1-new.png);
        background-position: 50% 50%;
        background-size: 100% 100%;
        background-repeat: no-repeat;
    }

    .steps-item-line._2 {
        background-image: url(../images/landing/line-1-new.png);
        background-position: 50% 50%;
        background-size: 100% 100%;
    }

    .steps-item-line {
        position: absolute;
        left: -79px;
        top: 13px;
        bottom: -15px;
        width: 42px;
        max-width: 42px;
        min-width: 42px;
        background-image: url(https://d3e54v103j8qbb.cloudfront.net/img/background-image.svg);
        background-position: 0px 0px;
        background-size: auto;
    }

    .steps-images {
        position: relative;
    }


    /*form*/
    label {
        font-weight: 300;
    }

    .form-bg-package {
        border-radius: var(--v1-radius-lg);
        background-color: var(--v1-silver);
        border: solid 1px #dddddd;
        padding: 30px;
    }

    .form-contact-package {
        background-color: #ffffff;
        box-shadow: var(--v1-sha01);
        border-radius: var(--v1-radius-lg);
        border: var(--v1-border);
        padding: 30px;
    }

    .steps-item-index {
        background-color: var(--v1-orange);
    }

    .div-block {
        background-color: #ffffff;
    }
</style>
</head>

<body class="contact_page">
    @include("$prefix.header")

    <section style="background: linear-gradient( 180deg , #1A315F 0%, #0E2439 46.16%);">
        <div class="page p-0">
            <div class="title-landing">
                <h1 class="h2 mt-5 text-center text-white" data-aos="fade-down" data-aos-delay="200">
                    <span class="h1 "><strong>ให้เราช่วยเพิ่มโอกาสในการขายสินค้าและบริการของคุณ </strong></span><br>
                    <strong>ด้วยเครื่องมือและแผนการตลาดออนไลน์ โดยทีมงานมืออาชีพจาก <span
                            class="v1-orange">At-Once</span></strong>
                </h1>
                <!--  <p class="h3 text-center" data-aos="zoom-in" data-aos-delay="400">
            <strong class="v1-orange">
                Backlink | Blog | Google Ads | SEO | Company Profile
            </strong>
          </p> -->
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-lg-2"></div>
                    <div class="col-lg-8">
                        <div class="" data-aos="zoom-in">
                            <center> <img src="images/landing/backlink.png" class="img-fluid mb-5"></center>
                        </div>
                    </div>
                    <div class="col-lg-2"></div>
                </div>

            </div>
        </div> <!-- container -->
    </section> <!-- bg -->

    <section class="page bg-white">
        <div class="container">
            <div class="row" style="align-items: center;">
                <div class="col-lg-6 mt-4 mb-4">
                    <div class="" data-aos="zoom-in">
                        <img src="images/landing/profit.png" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div data-aos="fade-up">
                        <h3 class="">
                            <span class="v1-orange h1">
                                <strong>
                                    ลดต้นทุน สร้างกำไร
                                </strong>
                            </span>
                            <span>ให้ธุรกิจเติบโต <br>ด้วยกลยุทธ์ทางการตลาดออนไลน์<br>ของ At-Once</span>
                        </h3>
                    </div>
                </div>
            </div>
        </div><!-- container -->
    </section>

    <section class="page steps-c" style="background-color: #f5f8fa;">
        <div class="container">
            <div class="text-center title-landing" data-aos="fade-down" data-aos-delay="400">
                <h3 class="h1"><strong> เราไม่ใช่ Agency แต่เราคือ</strong></h3>
                <!-- <p class="h3"><strong> </strong></p> -->
                <p class="v1-orange h2"><strong>"เว็บไซต์รวบรวมข้อมูลและทำการตลาดออนไลน์"</strong></p>
            </div>
            <div class="row" style="align-items: center;">
                <div class="col-lg-7">
                    <div id="w-node-_2d68d5fc-5d1d-ab70-9220-b3663eba7911-199eb68b">
                        <div class="steps" data-aos="zoom-in-right" data-aos-delay="200">
                            <div class="steps-item">
                                <div style="opacity: 1;" class="steps-item-text _1">
                                    <div class="steps-item-index">01</div>
                                    <div class="steps-item-title">สร้าง Backlink แบบมีคุณภาพให้กับเว็บไซต์ของคุณ</div>
                                </div>
                                <div style="opacity: 1;" class="steps-item-svg _1">
                                    <div class="steps-item-bull"></div>
                                    <div class="steps-item-line _1"></div>
                                </div>
                            </div>
                            <div class="steps-item">
                                <div style="opacity: 1;" class="steps-item-text _2">
                                    <div class="steps-item-index red">02</div>
                                    <div class="steps-item-title">ตัวช่วยเพิ่มช่องทางการขาย
                                        ด้วยเครื่องมือที่มีประสิทธิภาพ</div>
                                    <div class="steps-item-bull red"></div>
                                </div>
                                <div style="opacity: 1;" class="steps-item-svg _2">
                                    <div class="steps-item-line _2"></div>
                                </div>
                            </div>
                            <div class="steps-item">
                                <div style="opacity: 1;" class="steps-item-text _2">
                                    <div class="steps-item-index red">03</div>
                                    <div class="steps-item-title">วางแผนการใช้งบประมาณอย่างมีคุณภาพ และไม่บานปลาย</div>
                                    <div class="steps-item-bull red"></div>
                                </div>
                                <div style="opacity: 1;" class="steps-item-svg _2">
                                    <div class="steps-item-line _2"></div>
                                </div>
                            </div>
                            <div class="steps-item last">
                                <div style="opacity: 1;" class="steps-item-text _3">
                                    <div class="steps-item-index yellow">04</div>
                                    <div class="steps-item-title">ส่งเสริมการทำงานของ SEO แบบเต็มประสิทธิภาพ</div>
                                    <div class="steps-item-bull yellow"></div>
                                </div>
                                <div style="opacity: 1;" class="steps-item-svg _3"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="" data-aos="zoom-in-left" data-aos-delay="400">
                        <img src="images/landing/seo_link.png" class="img-fluid">
                    </div>
                </div>
            </div>
    </section>
    <br><br>
    <section class="">
        <div class="container">
            <div class="" data-aos="fade-up" data-aos-delay="200">
                <h3 class="text-center h2"><strong>บริษัทที่ไว้วางใจให้เราดูแลเรื่อง "การตลาดออนไลน์"</strong></h3>
                <div id="carousel-brands" class="swiper carousel-brands">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide brand"><img src="images/landing/logo/yamato.jpg" loading="eager"
                                class="img-fluid radius-lg" alt="" /></div>
                        <div class="swiper-slide brand"><img src="images/landing/logo/ctw.jpg" loading="eager"
                                class="img-fluid radius-lg" alt="" /></div>
                        <div class="swiper-slide brand"><img src="images/landing/logo/logo03.jpg" loading="eager"
                                class="img-fluid radius-lg" alt="" /></div>
                        <div class="swiper-slide brand"><img src="images/landing/logo/logo_25072022-12374107sd-xs.jpg"
                                loading="eager" class="img-fluid radius-lg" alt="" /></div>
                        <div class="swiper-slide brand"><img src="images/landing/logo/logo_24092022-16202809-xs.png"
                                loading="eager" class="img-fluid radius-lg" alt="" /></div>
                        <div class="swiper-slide brand"><img src="images/landing/logo/logo_13122021-11451612-xs.png"
                                loading="eager" class="img-fluid radius-lg" alt="" /></div>
                        <div class="swiper-slide brand"><img src="images/landing/logo/logo_20092022-14275009-xs.png"
                                loading="eager" class="img-fluid radius-lg" alt="" /></div>
                        <div class="swiper-slide brand"><img src="images/landing/logo/logo_14092023-14105709.jpeg"
                                loading="eager" class="img-fluid radius-lg" alt="" /></div>
                        <div class="swiper-slide brand"><img src="images/company/16784/logo_12012024-17160101.jpeg"
                                loading="eager" class="img-fluid radius-lg" alt="" /></div>
                        <div class="swiper-slide brand"><img src="images/landing/logo/logo_01092022-16451009.jpeg"
                                loading="eager" class="img-fluid radius-lg" alt="" /></div>
                        <div class="swiper-slide brand"><img src="images/landing/logo/logo_25072022-12374107-xs.jpeg"
                                loading="eager" class="img-fluid radius-lg" alt="" /></div>
                        <div class="swiper-slide brand"><img src="images/landing/logo/logo_29092022-15121209-xs.png"
                                loading="eager" class="img-fluid radius-lg" alt="" /></div>
                        <div class="swiper-slide brand"><img src="images/landing/logo/logo_11092023-15263609.jpeg"
                                loading="eager" class="img-fluid radius-lg" alt="" /></div>
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </section>

    <section class="page mb-5">
        <div class="container">
            <div class="form-bg-package" id="formpackage" data-aos="zoom-in">
                <div class="row">
                    <div class="col-lg-6">
                        <h4 class="h3 v1-orange mb-1" style="margin-bottom: -10px;"><strong>ทีมงานมืออาชีพของ
                                At-Once</strong></h4>
                        <p class="">จะติดต่อกลับหาท่านภายใน 1 วัน</p>
                        <div class="owl-pagination-custom fd">
                            <div class="data-dots-custom active" data-owl-item="0"><img
                                    src="images/page-package/mk02.webp" alt="" width="179" height="89"
                                    class="img-fluid">
                            </div>
                            <div class="data-dots-custom" data-owl-item="1"><img src="images/page-package/mk01.webp"
                                    alt="" width="250" height="153" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class=" form-contact-package">
                            <form method="get" action="" id="formContactPackage">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>@lang('phrase.company-name')</label>
                                            <input type="text" class="form-control" name="company"
                                                id="company">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>@lang('phrase.name')</label>
                                            <input type="text" class="form-control" name="name"
                                                id="name">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>@lang('phrase.department')</label>
                                            <input type="text" class="form-control" name="department"
                                                id="department">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>@lang('phrase.telephone')</label>
                                            <input type="text" class="form-control" name="telephone"
                                                id="telephone">
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>@lang('phrase.member.email')</label>
                                            <input type="email" class="form-control" name="email"
                                                id="email">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label>@lang('phrase.contact-detail')</label>
                                            <textarea name="detail" class="form-control" rows="8" id="detail"></textarea>
                                            <input type="hidden" name="page" id="page"
                                                value="Form Contact Page">
                                            <input type="hidden" name="type" value="atonce">
                                        </div>
                                    </div>
                                </div>
                                <div style="display:flex; justify-content:center; margin:0 0 10px 0;">
                                    <div id="g-recaptcha" class="g-recaptcha"
                                        data-sitekey="6LcEE6ooAAAAAN8ZnN5uTezCAeCpAvB6fGuugnKB"
                                        data-callback='onSubmit'></div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <input type="submit" value="ส่งข้อความ" class="message-send btn-block"
                                            disabled />
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
    <script src="js/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
    </script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=0001"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en">
    </script>
    <script src="plugin/sweetalert2/sweetalert2.all.js"></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/gsap/1.16.1/TweenMax.min.js'></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <!-- 04/10/2023 -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function onSubmit(token) {
            if (token) {
                document.getElementById('formContactPackage').querySelector('[type="submit"]').removeAttribute('disabled');
            }
        }
        var reRender = function() {
            grecaptcha.reset();
        };
        jQuery.validator.addMethod("letteronly", function(value, element, param) {
            return value.match(new RegExp("." + param + "$"));
        });
        $('#btnFacebook,#btnLine,#btnMail').click(function() {
            const url = $(this).data('href');
            window.open(url);
        })
        $('#formContactPackage').validate({
            ignor: [],
            errorElement: "em",
            errorClass: "invalid",
            rules: {
                company: {
                    required: true
                },
                name: {
                    required: true,
                    letteronly: "[a-zA-Zก-ฮฤฤๅฦฦๅะ ัา ำ ิ ี ึ ื ุ ูเแโใไ ็ ่ ้ ๊ ๋ ์]+"
                },
                department: {
                    required: true
                },
                telephone: {
                    required: true,
                    minlength: 9,
                    letteronly: "[0-9]+"
                },
                email: {
                    required: true
                },
                detail: {
                    required: true
                }
            },
            messages: {
                company: {
                    required: '{{ __('phrase.contact.validate.company') }}'
                },
                name: {
                    required: '{{ __('phrase.contact.validate.name') }}',
                    letteronly: 'กรุณากรอกตัวอักษร'
                },
                department: {
                    required: '{{ __('phrase.contact.validate.department') }}'
                },
                telephone: {
                    required: '{{ __('phrase.contact.validate.telephone') }}',
                    minlength: 'กรุณากรอกเบอร์โทรให้ถูกต้อง',
                    letteronly: 'กรุณากรอกตัวเลข'
                },
                email: {
                    required: '{{ __('phrase.contact.validate.email') }}',
                    email: 'กรุณากรอกอีเมลให้ถูกต้อง',
                },
                detail: {
                    required: '{{ __('phrase.contact.validate.detail') }}'
                }
            },
            submitHandler: function(form, e) {

                inputs = $('#formContactPackage').serialize();
                e.preventDefault();
                // fd = new FormData();
                // fd.append('company', $('input[name="company"]').val());
                // fd.append('name', $('input[name="name"]').val());
                // fd.append('telephone', $('input[name="telephone"]').val());
                // fd.append('email', $('input[name="email"]').val());
                // fd.append('department', $('input[name="department"]').val());
                // fd.append('detail', $('textarea[name="detail"]').val());
                // fd.append('page', $('input[name="page"]').val());
                // fd.append('type', 'atonce');

                axios({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'post',
                    url: 'api/package/sendmail',
                    data: inputs
                }).then((result) => {
                    Swal.fire({
                        icon: 'success',
                        title: 'ส่งอีเมลสำเร็จแล้ว',
                        showConfirmButton: false,
                        timer: 1500
                    }).then((result) => {
                        reRender();
                        document.querySelectorAll('.form-control').forEach(el => el.classList
                            .remove('valid'));
                        document.querySelectorAll('.form-control').forEach(el => el.value = '');
                    });
                }).catch((err) => {
                    Swal.fire({
                        icon: 'danger',
                        title: 'ไม่สามารถส่งได้ กรุณาลองใหม่อีกครั้ง',
                        showConfirmButton: false,
                        timer: 1500
                    });
                });
            }
        })
        AOS.init({
            easing: 'ease-out-back',
            duration: 1800
        });
    </script>
    <script type="text/javascript">
        window.addEventListener('load', function() {
            var swiper = new Swiper("#carousel-brands", {
                slidesPerView: "auto",
                centeredSlides: true,
                autoplay: {
                    delay: 0,
                },
                loop: true,
                speed: 3000
            });
            let linksShowModal = document.querySelectorAll('[data-type="show-modal"]');

            if (linksShowModal) {
                linksShowModal.forEach(function(link) {
                    link.addEventListener('click', function(e) {
                        document.body.classList.add('hidden');
                    })
                })
            }
            let linksHideModal = document.querySelectorAll('[data-type="hide-modal"]');
            if (linksHideModal) {
                linksHideModal.forEach(function(link) {
                    link.addEventListener('click', function(e) {
                        document.body.classList.remove('hidden');
                    })
                })
            }
        })
    </script>
</body>

</html>
