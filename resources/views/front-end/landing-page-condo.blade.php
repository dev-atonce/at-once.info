<!doctype html>
<html lang="{{ Session('lang') }}">
<head>
    @include("$prefix.analytics.googleAnalytics")
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>@lang('phrase.condo.hero.title') - At-Once</title>

    <base href="{{ url('/') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css?v=1">
    
    <style>
        /* --- 1. CORE & GLOBAL --- */
        :root {
            --bg-main: #F3ECE6;
            --text-dark: #382F27;
            --text-brown: #473E36;
            --bg-card: #ECDED2;
            --bg-card-alt: #EADACB;
            --btn-outline: #D7B496;
            --tag-gray: #CBC5BE;
            --tag-beige: #D2C2B4;
            --tag-orange-light: #EFD7C2;
            --footer-bg: #7D756D;
        }

        body.main_page {
            background-color: var(--bg-main);
            font-family: 'Inter', 'Conv_SukhumvitSet-Light', sans-serif;
            color: var(--text-dark);
        }

        .condo-landing-page {
            padding: 40px 0;
            background-color: var(--bg-main) !important;
            overflow-x: hidden;
        }

        /* --- 2. TYPOGRAPHY SYSTEM --- */
        .title-large { font-weight: 700; font-size: clamp(40px, 5vw, 74px); color: var(--text-brown); line-height: 1.1; }
        .title-medium { font-weight: 200; font-size: clamp(28px, 3vw, 47px); }
        .text-bold { font-weight: 600; color: var(--text-brown); }

        /* --- 3. UI COMPONENTS (Tags & Buttons) --- */
        .tag-pill {
            display: inline-block;
            padding: 4px 16px;
            border-radius: 16px;
            font-size: 14px;
            margin-right: 8px;
            margin-bottom: 8px;
            color: var(--text-dark);
        }
        .tag-graytop { background: var(--tag-gray); border-radius: 8px; }
        .tag-gray { background: var(--tag-gray); }
        .tag-beige { background: var(--tag-beige); }
        .tag-orange { background: var(--tag-orange-light); }

        .btn-custom-outline {
            border: 1px solid var(--btn-outline);
            background: #E4CDB9;
            border-radius: 16px;
            padding: 1px 20px;
            color: var(--text-dark);
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-custom-outline:hover { background: #d8be1; }
        
        .btn-custom-gradient {
            background: linear-gradient(62.54deg, #F3ECE6 17.1%, #BA783F 301.36%);
            border: 1px solid #544B43;
            border-radius: 17px;
            padding: 1px 20px;
            color: var(--text-dark);
            text-decoration: none;
        }

        /* --- 4. HERO SECTION --- */
        .hero-card {
            background-image: url('images/condo/hero_bg.svg');
            background-size: 100% 100%;
            background-repeat: no-repeat;
            border-radius: 24px;
            padding: 40px;
            position: relative;
        }
        .hero-img {
            max-width: 100%;
            height: auto;
            max-height: 700px;
            object-fit: contain;
            border-radius: 24px;
            display: block;
            position: relative;
            left: 50%;
            transform: translateX(-50%);
            z-index: 1;
        }
        .info-block {
            position: absolute;
            top: 190px;
            right: 40px;
            text-align: right;
            z-index: 2;
            color: var(--text-dark);
        }
        .main-heading {
            font-family: 'Conv_SukhumvitSet-Bold', sans-serif;
            font-weight: 700;
            font-size: 74px;
            margin-bottom: 0;
            white-space: nowrap;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }
        .main-heading::before {
            content: "";
            display: inline-block;
            width: 126px;
            height: 6px;
            background-color: currentColor;
            margin-right: 20px;
            border-radius: 3px;
        }
        @if(Session('lang') === 'jp')
        .main-heading::before {width: 108px;}
        .main-heading { font-size: 50px; }
        .sub-heading { font-size: 30px; }
        .details h4 { font-size: 30px; }
        @endif
        .sub-heading {
            font-size: 40px;
            margin-top: 30px;
            opacity: 0.8;
            font-family: 'Conv_SukhumvitSet-Light', sans-serif; 
        }
        .details {
            margin-top: 20px;
            text-align: left;
        }
        .details h4 {
            font-family: 'Conv_SukhumvitSet-Bold', sans-serif;
            font-size: 40px;
            color: #382F27;
            margin-top: 10px;
        }
        .details p {
            font-family: 'Conv_SukhumvitSet-Light', sans-serif;
            font-size: 47px;
            color: #382F27;
            margin-top: 20px;
            opacity: 0.8;
        }
        .lang-switch {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #6D3C11;
            color: #ECDED2;
            width: 60px;
            height: 60px;
            border-radius: 30px 8px 30px 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 400;
            font-size: 24px;
        }

        /* --- 5. IMAGE WRAPPERS --- */
        .feature-img {
            width: 100%;
            border-radius: 24px;
            height: 100%;
            object-fit: cover;
            min-height: 400px;
        }

        /* --- 6. ROOM CARD COMPONENT --- */
        .room-card-wrapper {
            max-width: 336px;
        }
        .room-card {
            background: var(--bg-card-alt);
            border-radius: 45px 45px 45px 20px;
            padding: 30px 0 25px 25px;
            overflow: hidden;
            position: relative;
            transition: 0.3s;
            display: flex;
            flex-direction: column;
        }
        .room-card:hover { box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.08); }
        .room-card-header {
            text-align: right;
            padding-right: 30px;
            margin-bottom: 15px;
        }
        .room-card-header h4 {
            font-weight: 700;
            font-size: 22px;
            margin-bottom: 5px;
            color: var(--text-dark);
        }
        .gallery-badge {
            display: inline-block;
            background: #5F564E;
            color: #CBC5BE;
            padding: 4px 16px;
            border-radius: 16px;
            font-size: 14px;
            position: absolute;
            right: 30px;
            top: 60px;
            z-index: 2;
        }
        .room-card-img-wrapper {
            width: 115%;
            margin-bottom: 20px;
        }
        .room-card-img-wrapper img {
            width: 100%;
            height: 275px;
            object-fit: cover;
            border-radius: 31px;
        }
        .room-card-info {
            padding-right: 30px;
            font-size: 15px;
            color: var(--text-dark);
            line-height: 1.5;
        }
        .room-tags-wrapper {
            padding-top: 15px;
            padding-left: 10px;
        }

        /* --- 7. FOOTER ACTION --- */
        .footer-action {
            background: var(--footer-bg);
            padding: 50px 0;
            color: white;
            margin-top: 60px;
        }
        .footer-action .container {
            max-width: 1600px !important;
            padding-left: 30px;
            padding-right: 30px;
        }
        .footer-line {
            width: 6px;
            height: 147px;
            background-color: var(--text-dark);
            border-radius: 3px;
            margin: 0 auto;
        }
        .footer-text-main {
            line-height: 1.6;
            font-size: 24px;
            font-weight: 400;
            margin-bottom: 0;
            width: 100%;
        }
        .footer-contact-text { font-size: 16px; }
    </style>
</head>
<body class="main_page">

    <section class="page condo-landing-page">
        <div class="container position-relative">
            
            <!-- 1. HEADER ICONS -->
            <div class="lang-switch">{{ strtoupper(Session('lang', 'th')) }}</div>

            <!-- 2. HERO SECTION -->
            <div class="hero-card mb-5">
                <div class="row">
                    <div class="col-md-7">
                        <div class="mb-3">
                            <span class="tag-pill tag-graytop">@lang('phrase.condo.hero.type_1_bed_corner')</span>
                            <span class="tag-pill tag-graytop">@lang('phrase.condo.hero.type_2_bed')</span>
                            <span class="tag-pill tag-graytop">@lang('phrase.condo.hero.type_1_bed')</span>
                            <span class="tag-pill tag-graytop">@lang('phrase.condo.hero.type_studio')</span>
                        </div>
                        <h2 class="text-bold" style="font-size: 45px; margin-bottom: 5px;">@lang('phrase.condo.hero.title')</h2>
                        <p style="font-size: 18px; opacity: 0.9;">@lang('phrase.condo.hero.subtitle')</p>
                    </div>
                </div>

                <div class="info-block d-none d-md-block">
                    <div class="main-heading">@lang('phrase.condo.hero.status_rent')</div>
                    <div class="sub-heading">@lang('phrase.condo.hero.status_ready')</div>
                    <div class="details">
                        <h4>@lang('phrase.condo.hero.floor', ['floor' => '37'])</h4>
                        <p>@lang('phrase.condo.hero.project_name')</p>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-12">
                        <img src="images/condo/LIFE_LP_Valley_1.svg" class="hero-img" alt="Life Ladprao Valley">
                    </div>
                </div>
            </div>

            <!-- 3. HIGHLIGHT SECTION -->
            <div class="row align-items-center mb-5">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <img src="images/condo/room-highlight.jpg" class="feature-img" alt="Room Highlight" loading="lazy">
                </div>
                <div class="col-lg-5 pl-lg-5">
                    <h3 class="title-medium mb-4">@lang('phrase.condo.highlight.title')</h3>
                    <p>@lang('phrase.condo.highlight.desc_1')<br>@lang('phrase.condo.highlight.desc_2')</p>
                    <div class="d-flex mt-4">
                        <a href="#" class="btn-custom-outline mr-3">@lang('phrase.condo.common.btn_inquiry')</a>
                        <a href="#" class="btn-custom-gradient">@lang('phrase.condo.common.btn_appointment')</a>
                    </div>
                </div>
            </div>

            <!-- 4. LOCATION & FACILITIES -->
            <div class="row align-items-center mb-5 py-4">
                <div class="col-lg-6 pr-lg-5 mb-4 mb-lg-0">
                    <h3 class="title-medium mb-4">@lang('phrase.condo.location.title')</h3>
                    
                    <div class="d-flex mb-3">
                        <div class="mr-3 mt-1 text-nowrap flex-shrink-0">@lang('phrase.condo.location.transport')</div>
                        <div>
                            <span class="tag-pill tag-beige">@lang('phrase.condo.location.bts_distance')</span>
                            <span class="tag-pill tag-beige">@lang('phrase.condo.location.mrt_distance')</span>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-3">
                        <div class="mr-3 mt-1 text-nowrap flex-shrink-0">@lang('phrase.condo.location.nearby')</div>
                        <div>
                            <span class="tag-pill tag-gray">@lang('phrase.condo.location.place_central')</span>
                            <span class="tag-pill tag-gray">@lang('phrase.condo.location.place_union')</span>
                            <span class="tag-pill tag-gray">@lang('phrase.condo.location.place_lotus')</span>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="mr-3 mt-1 text-nowrap flex-shrink-0">@lang('phrase.condo.facility.title')</div>
                        <div>
                            <span class="tag-pill tag-orange">@lang('phrase.condo.facility.pool')</span>
                            <span class="tag-pill tag-orange">@lang('phrase.condo.facility.fitness')</span>
                            <span class="tag-pill tag-orange">@lang('phrase.condo.facility.coworking')</span>
                            <span class="tag-pill tag-orange">@lang('phrase.condo.facility.trash')</span>
                            <span class="tag-pill tag-orange">@lang('phrase.condo.facility.security')</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <img src="images/condo/location-facilities-room.jpg" class="feature-img" alt="Location and Facilities" loading="lazy">
                </div>
            </div>

            <!-- 5. ROOM TYPES & GALLERY -->
            <div class="row mb-5">
                <div class="col-12 text-center mb-5">
                    <h3 class="title-medium">@lang('phrase.condo.room_types.title')</h3>
                </div>
                
                <!-- Studio -->
                <div class="col-lg-4 col-md-6 mb-5 d-flex">
                    <div class="room-card-wrapper mx-auto ml-lg-0 mr-lg-auto w-100">
                        <div class="room-card">
                            <div class="room-card-header">
                                <h4>@lang('phrase.condo.room_types.studio_title')</h4>
                                <span class="gallery-badge">Gallery</span>
                            </div>
                            <div class="room-card-img-wrapper">
                                <img src="images/condo/studio.jpg" alt="Studio" loading="lazy">
                            </div>
                            <div class="room-card-info">
                                @lang('phrase.condo.room_types.studio_size')<br>
                                @lang('phrase.condo.room_types.studio_price')
                            </div>
                        </div>
                        <div class="room-tags-wrapper">
                            <div class="d-flex flex-wrap mb-2">
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.room_regular')</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.dir_north')</span>
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.dir_south')</span>
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.dir_east')</span>
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.dir_west')</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 1 Bedroom -->
                <div class="col-lg-4 col-md-6 mb-5 d-flex">
                    <div class="room-card-wrapper mx-auto w-100">
                        <div class="room-card">
                            <div class="room-card-header">
                                <h4>@lang('phrase.condo.room_types.bed_1_title')</h4>
                                <span class="gallery-badge">Gallery</span>
                            </div>
                            <div class="room-card-img-wrapper">
                                <img src="images/condo/1bed.jpg" alt="1 Bedroom" loading="lazy">
                            </div>
                            <div class="room-card-info">
                                @lang('phrase.condo.room_types.bed_1_size')<br>
                                @lang('phrase.condo.room_types.bed_1_price')
                            </div>
                        </div>
                        <div class="room-tags-wrapper">
                            <div class="d-flex flex-wrap mb-2">
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.room_corner')</span>
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.room_regular')</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.dir_north')</span>
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.dir_south')</span>
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.dir_east')</span>
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.dir_west')</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- 2 Bedroom -->
                <div class="col-lg-4 col-md-6 mb-5 mx-auto d-flex">
                    <div class="room-card-wrapper mx-auto mr-lg-0 ml-lg-auto w-100">
                        <div class="room-card">
                            <div class="room-card-header">
                                <h4>@lang('phrase.condo.room_types.bed_2_title')</h4>
                                <span class="gallery-badge">Gallery</span>
                            </div>
                            <div class="room-card-img-wrapper">
                                <img src="images/condo/2bed.jpg" alt="2 Bedroom" loading="lazy">
                            </div>
                            <div class="room-card-info">
                                @lang('phrase.condo.room_types.bed_2_size')<br>
                                @lang('phrase.condo.room_types.bed_2_price')
                            </div>
                        </div>
                        <div class="room-tags-wrapper">
                            <div class="d-flex flex-wrap mb-2">
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.room_regular')</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.dir_north')</span>
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.dir_south')</span>
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.dir_east')</span>
                                <span class="tag-pill tag-orange">@lang('phrase.condo.common.dir_west')</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. FOOTER ACTION -->
    <section class="footer-action">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-md-5 text-md-left text-center mb-4 mb-md-0">
                    <div class="footer-text-main">
                        @lang('phrase.condo.contact.update_notice')<br>
                        @lang('phrase.condo.contact.media_desc')
                    </div>
                </div>
                
                <div class="col-md-1 d-none d-md-flex justify-content-center">
                    <div class="footer-line"></div>
                </div>
                
                <div class="col-md-6 text-center text-md-left">
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end">
                        
                        <div class="mb-4 mb-lg-0">
                            <p class="mb-1 footer-contact-text">@lang('phrase.condo.contact.line_id')</p>
                            <p class="mb-1 footer-contact-text">@lang('phrase.condo.contact.click_to_add') <a href="https://lin.ee/ZcTZCL4" class="text-white text-decoration-underline">https://lin.ee/ZcTZCL4</a></p>
                            <p class="mb-1 footer-contact-text">@lang('phrase.condo.contact.tel_th')</p>
                            <p class="mb-0 footer-contact-text">@lang('phrase.condo.contact.tel_jp')</p>
                        </div>
                        
                        <div class="d-flex justify-content-center justify-content-lg-end pb-lg-1">
                            <a href="#" class="btn-custom-outline mr-3">@lang('phrase.condo.common.btn_inquiry')</a>
                            <a href="#" class="btn-custom-gradient">@lang('phrase.condo.common.btn_appointment')</a>
                        </div>
                        
                    </div>
                </div>
                
            </div>
        </div>
    </section>

    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=0008"></script>
</body>
</html>
