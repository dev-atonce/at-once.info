<!doctype html>
<html lang="{{ Session('lang') }}">
<head>
    @include("$prefix.analytics.googleAnalytics")
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>Life Ladprao Valley - At-Once</title>

    <base href="{{ url('/') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css?v=1">
    
    <!-- Popup Business Card CSS & Icons -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/animate.css">
    <link href="css/popup-contact.css" rel="stylesheet">
    <link rel="stylesheet" href="css/validate.css" media="all">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        .card-bussiness {
            max-width: 500px !important;
            margin: 1.75rem auto;
            min-height: auto !important;
            display: flex;
            align-items: center;
        }

        .dialog-centered {
            min-height: auto !important;
        }
    </style>
    
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
            transform: translateX(-50%) scale(1);
            z-index: 1;
        }
        /* Hero left-column title */
        .hero-title {
            font-size: 45px;
            margin-bottom: 5px;
        }
        /* Info block — absolutely positioned over the SVG background */
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

        /* ── Responsive: 1400px → 1200px ─────────────────────────── */
        @media (max-width: 1399px) {
            .main-heading        { font-size: 62px; }
            .main-heading::before{ width: 100px; }
            .sub-heading         { font-size: 34px; }
            .details h4          { font-size: 34px; }
            .details p           { font-size: 40px; }
            .hero-title          { font-size: 40px; }
            .info-block          { top: 160px; right: 30px; }
        }

        /* ── Responsive: 1200px → 992px ──────────────────────────── */
        @media (max-width: 1199px) {
            .main-heading        { font-size: 50px; }
            .main-heading::before{ width: 80px; }
            .sub-heading         { font-size: 28px; margin-top: 20px; }
            .details h4          { font-size: 28px; }
            .details p           { font-size: 33px; margin-top: 14px; }
            .hero-title          { font-size: 34px; }
            .info-block          { top: 130px; right: 24px; }
            .hero-img            { max-height: 640px; }
        }

        /* ── Responsive: 992px → 768px ───────────────────────────── */
        @media (max-width: 991px) {
            .main-heading        { font-size: 40px; }
            .main-heading::before{ width: 60px; height: 4px; margin-right: 14px; }
            .sub-heading         { font-size: 22px; margin-top: 14px; }
            .details h4          { font-size: 22px; }
            .details p           { font-size: 26px; margin-top: 10px; }
            .hero-title          { font-size: 28px; }
            .info-block          { top: 100px; right: 16px; }
            .hero-img            { max-height: 550px; }
            .hero-card           { padding: 28px; }
        }
        /* --- 5. LANG SWITCHER --- */
        .lang-switcher {
            position: absolute;
            top: 20px;
            right: 20px;
            display: flex;
            flex-direction: row;
            align-items: stretch;
            z-index: 10;
            background: #6D3C11;
            border-radius: 30px 8px 30px 30px;
            overflow: hidden;
        }
        .lang-options {
            display: flex;
            flex-direction: row;
            align-items: center;
            overflow: hidden;
            max-width: 0;
            opacity: 0;
            white-space: nowrap;
            transition: max-width 0.4s cubic-bezier(0.16, 1, 0.3, 1),
                        opacity 0.3s ease;
            background: transparent;
        }
        .lang-options.open {
            max-width: 110px;
            opacity: 1;
        }
        .lang-opt {
            color: #ECDED2;
            width: 55px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
            font-weight: 400;
            text-decoration: none;
            flex-shrink: 0;
            transition: opacity 0.2s;
            opacity: 0.7;
        }
        .lang-opt:hover { opacity: 1; color: #ECDED2; text-decoration: none; background: rgba(255,255,255,0.1); }
        .lang-opt.active { opacity: 1; font-weight: 600; }
        .lang-current {
            background: transparent;
            color: #ECDED2;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 400;
            font-size: 24px;
            cursor: pointer;
            border: none;
            outline: none;
            flex-shrink: 0;
            user-select: none;
        }
        .lang-current:focus, .lang-current:active, .lang-opt:focus {
            outline: none !important;
            box-shadow: none !important;
        }
        /* --- 6. IMAGE WRAPPERS --- */
        .feature-img {
            width: 100%;
            border-radius: 24px;
            height: 100%;
            object-fit: cover;
            min-height: 400px;
        }

        /* --- 7. ROOM CARD COMPONENT --- */
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

        /* --- 8. FOOTER ACTION --- */
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
        a.footer-contact-text {
            color: #ffffff;
            transition: color 0.2s ease-in-out;
        }
        a.footer-contact-text:hover {
            color: #00c300 !important;
            text-decoration: none;
        }

        /* --- 9. INLINE CONTACT FORM --- */
        .inline-contact-wrapper {
            width: 100%;
        }
        .inline-contact-header {
            display: flex;
            align-items: baseline;
            gap: 15px;
            margin-bottom: 15px;
            color: #FFFFFF;
        }
        .inline-contact-title {
            font-weight: 500;
            font-size: 24px;
            margin: 0;
        }
        .inline-contact-subtitle {
            font-weight: 400;
            font-size: 16px;
            margin: 0;
            opacity: 0.9;
        }
        .inline-input-group input {
            background-color: var(--bg-main);
            border: none;
            border-radius: 10px;
            height: 50px;
            padding: 10px 15px;
            font-size: 16px;
            color: var(--text-dark);
            width: 100%;
        }
        .inline-input-group input::placeholder {
            color: rgba(84, 75, 67, 0.6);
        }
        .inline-input-group input:focus {
            outline: none;
            box-shadow: 0 0 0 2px var(--btn-outline);
        }

        /* --- 10. GALLERY LIGHTBOX --- */
        #galleryLightbox {
            display: none;
            position: fixed;
            inset: 0;
            z-index: 9999;
            background: rgba(30, 22, 15, 0.92);
            backdrop-filter: blur(6px);
            align-items: center;
            justify-content: center;
            flex-direction: column;
        }
        #galleryLightbox.active {
            display: flex;
        }
        .gallery-lb-close {
            position: absolute;
            top: 20px;
            right: 28px;
            color: #ECDED2;
            font-size: 32px;
            cursor: pointer;
            line-height: 1;
            opacity: 0.8;
            transition: opacity 0.2s;
            z-index: 10001;
            background: none;
            border: none;
            padding: 0;
        }
        .gallery-lb-close:hover { opacity: 1; }
        .gallery-lb-img-wrap {
            width: 100%;
            max-width: 880px;
            max-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 0 60px;
        }
        .gallery-lb-img-wrap img {
            max-width: 100%;
            max-height: 78vh;
            object-fit: contain;
            border-radius: 16px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .gallery-lb-img-wrap img.loaded {
            opacity: 1;
        }
        .gallery-lb-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(236, 222, 210, 0.15);
            border: 1px solid rgba(236, 222, 210, 0.3);
            color: #ECDED2;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            font-size: 22px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.2s, transform 0.2s;
            z-index: 10001;
            line-height: 1;
        }
        .gallery-lb-btn:hover {
            background: rgba(236, 222, 210, 0.3);
            transform: translateY(-50%) scale(1.1);
        }
        .gallery-lb-prev { left: 6px; }
        .gallery-lb-next { right: 6px; }
        .gallery-lb-counter {
            color: rgba(236, 222, 210, 0.75);
            font-size: 14px;
            margin-top: 16px;
            letter-spacing: 1px;
        }
        .gallery-lb-title {
            color: #ECDED2;
            font-size: 18px;
            font-weight: 500;
            margin-bottom: 14px;
            opacity: 0.9;
            letter-spacing: 0.5px;
        }
        .room-card-wrapper {
            cursor: pointer;
        }
        .room-card-wrapper:hover .room-card {
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.13);
        }
    </style>
</head>
<body class="main_page">

    <section class="page condo-landing-page">
        <div class="container position-relative">
            
            <!-- 1. HEADER ICONS -->
            @php $currentLang = Session('lang', 'th'); $langs = ['jp', 'en', 'th']; @endphp
            <div class="lang-switcher" id="langSwitcher">
                <div class="lang-options" id="langOptions">
                    @foreach($langs as $l)
                        @if($l !== $currentLang)
                            <a href="{{ url('/' . $l . '/rent-condo-life-ladprao-valley') }}" class="lang-opt">{{ strtoupper($l) }}</a>
                        @endif
                    @endforeach
                </div>
                <button class="lang-current" id="langCurrentBtn" onclick="toggleLangSwitcher(event)">{{ strtoupper($currentLang) }}</button>
            </div>

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
                        <h2 class="text-bold hero-title">@lang('phrase.condo.hero.title')</h2>
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
                        <a class="btn-custom-outline mr-3">@lang('phrase.condo.common.btn_inquiry')</a>
                        <a class="btn-custom-gradient">@lang('phrase.condo.common.btn_appointment')</a>
                    </div>
                </div>
            </div>

            <!-- 4. LOCATION & FACILITIES -->
            <div class="row align-items-center mb-5 py-4">
                <div class="col-lg-6 pr-lg-5 mb-4 mb-lg-0">
                    <h3 class="title-medium mb-4">@lang('phrase.condo.location.title')</h3>
                    
                    <div class="d-flex mb-3">
                        <div class="mr-3 mt-1 text-nowrap shrink-0">@lang('phrase.condo.location.transport')</div>
                        <div>
                            <span class="tag-pill tag-beige">@lang('phrase.condo.location.bts_distance')</span>
                            <span class="tag-pill tag-beige">@lang('phrase.condo.location.mrt_distance')</span>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-3">
                        <div class="mr-3 mt-1 text-nowrap shrink-0">@lang('phrase.condo.location.nearby')</div>
                        <div>
                            <span class="tag-pill tag-gray">@lang('phrase.condo.location.place_central')</span>
                            <span class="tag-pill tag-gray">@lang('phrase.condo.location.place_union')</span>
                            <span class="tag-pill tag-gray">@lang('phrase.condo.location.place_lotus')</span>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="mr-3 mt-1 text-nowrap shrink-0">@lang('phrase.condo.facility.title')</div>
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
                    <div class="room-card-wrapper mx-auto ml-lg-0 mr-lg-auto w-100" onclick="openGallery('studio')" role="button" aria-label="Studio Gallery">
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
                    <div class="room-card-wrapper mx-auto w-100" onclick="openGallery('1bed')" role="button" aria-label="1 Bedroom Gallery">
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
                    <div class="room-card-wrapper mx-auto mr-lg-0 ml-lg-auto w-100" onclick="openGallery('2bed')" role="button" aria-label="2 Bedroom Gallery">
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

                            <a href="https://line.me/ti/p/@431xnkdu" target="_blank" class="mb-1 footer-contact-text d-flex justify-content-center justify-content-md-start align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 48 48" class="mr-2">
                                  <path fill="#00c300" d="M12.5,42h23c3.59,0,6.5-2.91,6.5-6.5v-23C42,8.91,39.09,6,35.5,6h-23C8.91,6,6,8.91,6,12.5v23C6,39.09,8.91,42,12.5,42z"></path><path fill="#fff" d="M37.113,22.417c0-5.865-5.88-10.637-13.107-10.637s-13.108,4.772-13.108,10.637c0,5.258,4.663,9.662,10.962,10.495c0.427,0.092,1.008,0.282,1.155,0.646c0.132,0.331,0.086,0.85,0.042,1.185c0,0-0.153,0.925-0.187,1.122c-0.057,0.331-0.263,1.296,1.135,0.707c1.399-0.589,7.548-4.445,10.298-7.611h-0.001C36.203,26.879,37.113,24.764,37.113,22.417z M18.875,25.907h-2.604c-0.379,0-0.687-0.308-0.687-0.688V20.01c0-0.379,0.308-0.687,0.687-0.687c0.379,0,0.687,0.308,0.687,0.687v4.521h1.917c0.379,0,0.687,0.308,0.687,0.687C19.562,25.598,19.254,25.907,18.875,25.907z M21.568,25.219c0,0.379-0.308,0.688-0.687,0.688s-0.687-0.308-0.687-0.688V20.01c0-0.379,0.308-0.687,0.687-0.687s0.687,0.308,0.687,0.687V25.219z M27.838,25.219c0,0.297-0.188,0.559-0.47,0.652c-0.071,0.024-0.145,0.036-0.218,0.036c-0.215,0-0.42-0.103-0.549-0.275l-2.669-3.635v3.222c0,0.379-0.308,0.688-0.688,0.688c-0.379,0-0.688-0.308-0.688-0.688V20.01c0-0.296,0.189-0.558,0.47-0.652c0.071-0.024,0.144-0.035,0.218-0.035c0.214,0,0.42,0.103,0.549,0.275l2.67,3.635V20.01c0-0.379,0.309-0.687,0.688-0.687c0.379,0,0.687,0.308,0.687,0.687V25.219z M32.052,21.927c0.379,0,0.688,0.308,0.688,0.688c0,0.379-0.308,0.687-0.688,0.687h-1.917v1.23h1.917c0.379,0,0.688,0.308,0.688,0.687c0,0.379-0.309,0.688-0.688,0.688h-2.604c-0.378,0-0.687-0.308-0.687-0.688v-2.603c0-0.001,0-0.001,0-0.001c0,0,0-0.001,0-0.001v-2.601c0-0.001,0-0.001,0-0.002c0-0.379,0.308-0.687,0.687-0.687h2.604c0.379,0,0.688,0.308,0.688,0.687s-0.308,0.687-0.688,0.687h-1.917v1.23H32.052z"></path>
                                </svg>
                                <span>LINE ID: @431xnkdu</span>
                            </a>
                            <p class="mb-1 footer-contact-text">Tel (TH): 02-168-8494</p>
                            <p class="mb-0 footer-contact-text">Tel (JP/EN): 081-116-1641</p>
                        </div>
                        
                        <div class="d-flex justify-content-center justify-content-lg-end pb-lg-1">
                            <a class="btn-custom-outline mr-3">@lang('phrase.condo.common.btn_inquiry')</a>
                            <a class="btn-custom-gradient">@lang('phrase.condo.common.btn_appointment')</a>
                        </div>
                        
                    </div>
                </div>
                
            </div>

            <div id="footer-popup-trigger" class="row mt-5" style="display: none;">
                <div class="col-12">
                    <div class="inline-contact-wrapper text-left">
                        
                        <div class="inline-contact-header flex-column flex-lg-row">
                            <h4 class="inline-contact-title">@lang('phrase.condo.inline_form.contact_us')</h4>
                            <p class="inline-contact-subtitle">@lang('phrase.condo.inline_form.instruction')</p>
                        </div>

                        <form id="inlineBusinessCard" onsubmit="return false;">
                            <input type="hidden" name="thisCompany" value="At-once">
                            <input type="hidden" name="lang" value="{{ Session('lang', 'th') }}">
                            <input type="hidden" name="type" value="customer">
                            <input type="hidden" name="page" value="Inline Form from Condo Landing Page">
                            <input type="hidden" name="companyId" value="64">

                            <div class="form-row mt-1">
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="inline-input-group">
                                        <input type="text" name="name" class="form-control" placeholder="@lang('phrase.condo.inline_form.name')" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="inline-input-group">
                                        <input type="text" name="telephone" class="form-control" placeholder="@lang('phrase.condo.inline_form.telephone')" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3 mb-md-0">
                                    <div class="inline-input-group">
                                        <input type="email" name="email" class="form-control" placeholder="@lang('phrase.condo.inline_form.email')" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-row mt-4 align-items-center">
                                <div class="col-md-8 d-flex justify-content-md-start justify-content-center mb-3 mb-md-0">
                                    <div id="captcha_container_inline" style="transform: scale(0.9); transform-origin: left center;"></div>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn-custom-gradient w-100 btn-inline-submit" disabled style="padding: 14px 20px; font-size: 18px; border-radius: 12px; font-weight: 600; box-shadow: 0 4px 10px rgba(0,0,0,0.15);">
                                        <i class="fas fa-paper-plane mr-2"></i> @lang('phrase.condo.inline_form.send')
                                    </button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </section>

    <!-- Gallery Lightbox Modal -->
    <div id="galleryLightbox" role="dialog" aria-modal="true" aria-label="Image Gallery">
        <button class="gallery-lb-close" id="galleryLbClose" aria-label="Close gallery">&times;</button>
        <div class="gallery-lb-title" id="galleryLbTitle"></div>
        <div class="gallery-lb-img-wrap" id="galleryLbImgWrap">
            <button class="gallery-lb-btn gallery-lb-prev" id="galleryLbPrev" aria-label="Previous image">&#8249;</button>
            <img id="galleryLbImg" src="" alt="Gallery Image">
            <button class="gallery-lb-btn gallery-lb-next" id="galleryLbNext" aria-label="Next image">&#8250;</button>
        </div>
        <div class="gallery-lb-counter" id="galleryLbCounter"></div>
    </div>

    <script src="js/jquery.js"></script>
    <script src="js/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=0008"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <script>
        function toggleLangSwitcher(e) {
            e.stopPropagation();
            var switcher = document.getElementById('langSwitcher');
            var options  = document.getElementById('langOptions');
            var isOpen   = switcher.classList.contains('open');
            if (isOpen) {
                switcher.classList.remove('open');
                options.classList.remove('open');
            } else {
                switcher.classList.add('open');
                options.classList.add('open');
            }
        }
        document.addEventListener('click', function(e) {
            var switcher = document.getElementById('langSwitcher');
            if (switcher && !switcher.contains(e.target)) {
                switcher.classList.remove('open');
                document.getElementById('langOptions').classList.remove('open');
            }
        });

        // --- Popup Business Card ---
        var lang = "{{ Session('lang', 'th') }}";

        // Register custom 'letteronly' validator
        jQuery.validator.addMethod("letteronly", function(value, element, param) {
            return value.match(new RegExp("." + param + "$"));
        });

        function PopupBusinessCard(action)
        {
            let page = 'Pop-up from Condo Landing Page';
            let pop = JSON.parse(localStorage.getItem('PopupBUsinessCard'));
            
            let companyLogo = "split/at_once.png";
            let companyName = "At-once";
            const caption = 'ขอบคุณสำหรับความสนใจในบริษัทของเราหากลูกค้าต้องการสอบถามข้อมูลเพิ่มเติม สามารถกรอกรายละเอียดด้านล่าง จากนั้นจะมีเจ้าหน้าที่ติดต่อกลับภายใน 24 ชั่วโมงค่ะ';
            let companyId = 64; 

            const popup = $(
            `<div class="popup-dialog dialog-centered dialog-backdrop">
                <div class="card-bussiness dialog-content${pop?.minimize==true?' d-none':''}" style="border-radius:8px; display:flex; flex-direction:column; -webkit-transition:opacity 400ms ease-in; -moz-transition:opacity 400ms ease-in; transition: opacity 400ms ease-in;">
                        <a href="javascript:" class="dialog-minimize" onclick="PopupMinimize(true)">
                            <span><i class="fas fa-times"></i></span>
                        </a>
                            <input type="hidden" name="company" value="${companyId}">
                            <div class="dialog-header">
                                    <div class="card-cover" style="background-image: url(https://images.unsplash.com/photo-1549068106-b024baf5062d?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=934&q=80)"></div>
                                </div>
                                <div class="dialog-body mt-4">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <img src="${companyLogo}" class="img-fluid card-avatar" alt="avatar">
                                        </div>
                                        <div class="col-lg-9">
                                            <div class="dialog-content">
                                            <div class="card-fullname">${companyName}</div>${caption}</div>
                                        </div>
                                    </div>
                                    <form id="businessCard" onsubmit="return false;">
                                        <input type="hidden" name="thisCompany" value="${companyName}">
                                        <input type="hidden" name="lang" value="${lang}">
                                        <input type="hidden" name="type" value="customer">
                                        <input type="hidden" name="page" value="${page}">
                                        <input type="hidden" name="companyId" value="${companyId}">
                                        <div class="row">
                                            <div class="col-12">
                                                <label for="cardNumber" class="card-input__label">Name</label>
                                                <input type="text" name="name" class="form-control" placeholder="ชื่อ" autocomplete="off"/>
                                            </div>
                                            <div class="col-12">
                                                <label for="cardNumber" class="card-input__label">Telephone</label>
                                                <input type="text" name="telephone" class="form-control" placeholder="เบอร์โทรศัพท์" autocomplete="off"/>
                                            </div>
                                            <div class="col-12">
                                                <label for="cardNumber" class="card-input__label">Email</label>
                                                <input type="email" name="email" class="form-control" placeholder="อีเมล์" autocomplete="off"/>
                                            </div>
                                            <div class="col-lg-12">
                                                <div style="display:flex;justify-content: center;margin:15px 0 10px 0;">
                                                    <div id="captcha_container"></div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="dialog-footer mt-3">
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-confirm" style="minWidth:100;margin:0 5px 0 0" disabled="">Confirm</button>
                                            <button type="button" class="btn btn-secondary" onclick="PopupMinimize(true)" style="minWidth:100; margin:0 0 0 5px">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>`);
            
                if ($(document).find('.popup-dialog').length==0) 
                {
                    $(document).find('body').append(popup);

                    var loadCaptcha = function() {
                        captchaContainer = grecaptcha.render('captcha_container', {
                            'sitekey' : '6LcEE6ooAAAAAN8ZnN5uTezCAeCpAvB6fGuugnKB',
                            'callback' : function(response) {
                                document.querySelector('#businessCard').querySelector('[type="submit"]').removeAttribute('disabled');
                            }
                        });
                    };
                    loadCaptcha();
                    
                    axios({
                        method: 'post',
                        url: `api/statistics/show-popup`,
                        data: {
                            companyId: companyId,
                        }
                    }).then((res => {
                        if(res.data == false){
                            console.log(res.status)
                        }
                    }))
                }
                
                if(pop?.minimize == true) {
                    $('#footer-popup-trigger').show();
                }

                const messageResponse = (code, msg) => 
                {
                    popup.find('.alert').remove();
                    let alert = $('<label class="alert alert-'+code+' text-center" style="width:100%">'+msg+'</alert>');
                    popup.find('form').prepend(alert);
                }
                const sendTo = async () => 
                {
                    let inputs = $("#businessCard").serialize();
                    await axios({
                        method: 'post',
                        url: `api/send/sms`,
                        data: inputs
                    })
                    .then((res) => {
                        grecaptcha.reset(captchaContainer);
                        let code = 'danger';
                        if(res.data.status=='success'){
                            code = 'success';
                        }
                        messageResponse(code, res.data.message);
                        popup.find('input[name="name"]').val('');
                        popup.find('input[name="telephone"]').val('');
                        popup.find('input[name="email"]').val('');
                        popup.find('input').removeClass('valid');
                        $('.btn-confirm').attr("disabled", false);
                    })
                    .catch(err => console.log(err));
                }

                
                $('#businessCard').validate({
                    ignore: [],
                    errorElement: "span",
                    errorClass: "invalid",
                    rules: {
                        name: { required: true, letteronly: '[a-zA-Zก-ฮฤฤๅฦฦๅะ ัา ำ ิ ี ึ ื ุ ูเแโใไ ็ ่ ้ ๊ ๋ ์]+' },
                        telephone: { required: true, letteronly:'[0-9]+' },
                        email: { required: true, email: true }
                    },
                    messages: {
                        name: {
                            required: '{{ __('phrase.contact.validate.name') }}',
                            letteronly: 'กรุณากรอกตัวอักษร'
                        },
                        telephone: {
                            required: '{{ __('phrase.contact.validate.telephone') }}',
                            minlength: 'กรุณากรอกเบอร์โทรให้ถูกต้อง',
                            letteronly: 'กรุณากรอกตัวเลข'
                        },
                        email: {
                            required: 'กรุณากรอกอีเมล',
                            email: 'กรุณากรอกอีเมล์ให้ถูกต้อง'
                        }
                    },
                    submitHandler: function (form) {
                        sendTo();
                        $('.btn-confirm').attr("disabled", true);
                    }
                });
        }

        function Countdown() {
            let timeLeft = 1;
                const interval = setInterval(function(){
                    if (timeLeft == 0){
                        clearInterval(interval);
                        PopupBusinessCard(true)
                    }else{
                        timeLeft--;
                    }
                },1000)
        }
        function PopupMinimize(e)
        {
            const popup = $('.popup-dialog');
            if(Boolean(e)===true){
                popup.removeClass('dialog-backdrop');
                popup.find('.dialog-content').removeClass('d-block').addClass('d-none');
                $('#footer-popup-trigger').show();
                localStorage.setItem("PopupBusinessCard",JSON.stringify({minimize: Boolean(e)}));
            }else{
                popup.addClass('dialog-backdrop');
                popup.find('.dialog-content').removeClass('d-none');
                $('#footer-popup-trigger').hide();
                localStorage.setItem("PopupBusinessCard",JSON.stringify({minimize: Boolean(e)}));
            }
        }
        // --- Inline footer form logic ---
        window.addEventListener('load', function() {
            setTimeout(function() {
                if(typeof grecaptcha !== 'undefined' && $('#captcha_container_inline').length) {
                    grecaptcha.render('captcha_container_inline', {
                        'sitekey' : '6LcEE6ooAAAAAN8ZnN5uTezCAeCpAvB6fGuugnKB',
                        'callback' : function(response) {
                            $('#inlineBusinessCard .btn-inline-submit').removeAttr('disabled');
                        }
                    });
                }
            }, 1000);

            const messageResponseInline = (code, msg) => {
                $('#inlineBusinessCard').find('.alert').remove();
                let alert = $('<div class="alert alert-'+code+' mt-3" style="width:100%">'+msg+'</div>');
                $('#inlineBusinessCard').append(alert);
            };

            const sendInlineTo = async () => {
                let inputs = $("#inlineBusinessCard").serialize();
                await axios({
                    method: 'post',
                    url: `api/send/sms`,
                    data: inputs
                })
                .then((res) => {
                    let code = 'danger';
                    if(res.data.status=='success'){
                        code = 'success';
                        $('#inlineBusinessCard').find('input[name="name"]').val('');
                        $('#inlineBusinessCard').find('input[name="telephone"]').val('');
                        $('#inlineBusinessCard').find('input[name="email"]').val('');
                        $('#inlineBusinessCard').find('input').removeClass('valid');
                    }
                    messageResponseInline(code, res.data.message);
                    $('.btn-inline-submit').attr("disabled", true);
                })
                .catch(err => console.log(err));
            };

            $('#inlineBusinessCard').validate({
                ignore: [],
                errorElement: "em",
                errorClass: "invalid",
                rules: {
                    name:{ required:true, letteronly: '[a-zA-Zก-ฮฤฤๅฦฦๅะ ัา ำ ิ ี ึ ื ุ ูเแโใไ ็ ่ ้ ๊ ๋ ์]+'},
                    telephone:{ required:true, letteronly:'[0-9]+'},
                    email:{ required: true, email: true }
                },
                messages: {
                    name: {
                        required: '{{ __('phrase.condo.validate.name_required') }}',
                        letteronly: '{{ __('phrase.condo.validate.name_letteronly') }}'
                    },
                    telephone: {
                        required: '{{ __('phrase.condo.validate.tel_required') }}',
                        minlength: '{{ __('phrase.condo.validate.tel_minlength') }}',
                        letteronly: '{{ __('phrase.condo.validate.tel_letteronly') }}'
                    },
                    email: {
                        required: '{{ __('phrase.condo.validate.email_required') }}',
                        email: '{{ __('phrase.condo.validate.email_email') }}'
                    }
                },
                submitHandler: function (form) {
                    sendInlineTo();
                }
            });
        });

        Countdown();

        // --- Gallery Lightbox ---
        @php
            $studioImages = array_map(fn($f) => 'images/condo/studio_gallery/'.basename($f), glob(public_path('images/condo/studio_gallery/*.jpg')) ?: []);
            $bed1Images   = array_map(fn($f) => 'images/condo/1bed_gallery/'.basename($f),   glob(public_path('images/condo/1bed_gallery/*.jpg'))   ?: []);
            $bed2Images   = array_map(fn($f) => 'images/condo/2bed_gallery/'.basename($f),   glob(public_path('images/condo/2bed_gallery/*.jpg'))   ?: []);
        @endphp

        var galleryData = {
            'studio': {
                title: 'Studio',
                images: {!! json_encode($studioImages) !!}
            },
            '1bed': {
                title: '1 Bedroom',
                images: {!! json_encode($bed1Images) !!}
            },
            '2bed': {
                title: '2 Bedroom',
                images: {!! json_encode($bed2Images) !!}
            }
        };

        var currentGallery = null;
        var currentIndex = 0;

        function openGallery(type) {
            currentGallery = galleryData[type];
            currentIndex = 0;
            document.getElementById('galleryLbTitle').textContent = currentGallery.title;
            document.getElementById('galleryLightbox').classList.add('active');
            document.body.style.overflow = 'hidden';
            showGalleryImage(0);
        }

        function showGalleryImage(index) {
            var img = document.getElementById('galleryLbImg');
            img.classList.remove('loaded');
            img.onload = function() { img.classList.add('loaded'); };
            img.src = currentGallery.images[index];
            img.alt = currentGallery.title + ' - Image ' + (index + 1);
            document.getElementById('galleryLbCounter').textContent =
                (index + 1) + ' / ' + currentGallery.images.length;
            currentIndex = index;
        }

        function galleryPrev() {
            var n = currentGallery.images.length;
            showGalleryImage((currentIndex - 1 + n) % n);
        }

        function galleryNext() {
            var n = currentGallery.images.length;
            showGalleryImage((currentIndex + 1) % n);
        }

        function closeGallery() {
            document.getElementById('galleryLightbox').classList.remove('active');
            document.body.style.overflow = '';
            currentGallery = null;
        }

        document.getElementById('galleryLbClose').addEventListener('click', closeGallery);
        document.getElementById('galleryLbPrev').addEventListener('click', galleryPrev);
        document.getElementById('galleryLbNext').addEventListener('click', galleryNext);

        // Close when clicking the dark backdrop (outside the image wrap)
        document.getElementById('galleryLightbox').addEventListener('click', function(e) {
            var wrap = document.getElementById('galleryLbImgWrap');
            var title = document.getElementById('galleryLbTitle');
            var counter = document.getElementById('galleryLbCounter');
            if (!wrap.contains(e.target) && e.target !== title && e.target !== counter) {
                closeGallery();
            }
        });

        // Keyboard navigation
        document.addEventListener('keydown', function(e) {
            if (!currentGallery) return;
            if (e.key === 'ArrowLeft')  galleryPrev();
            if (e.key === 'ArrowRight') galleryNext();
            if (e.key === 'Escape')     closeGallery();
        });
    </script>
</body>
</html>
