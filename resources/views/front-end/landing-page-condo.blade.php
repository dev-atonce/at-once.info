<!doctype html>
<html lang="{{ Session('lang') ?? 'th' }}">
<head>
    @include("$prefix.analytics.googleAnalytics")
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>@lang('phrase.condo.title') - At-Once</title>

    <base href="{{ url('/') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css?v=1">
    
    <style>
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
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
        }

        .condo-landing-page {
            padding: 40px 0;
            background-color: var(--bg-main) !important;
            overflow-x: hidden;
        }

        .title-large { font-weight: 700; font-size: clamp(40px, 5vw, 74px); color: var(--text-brown); line-height: 1.1; }
        .title-medium { font-weight: 200; font-size: clamp(28px, 3vw, 47px); }
        .text-bold { font-weight: 600; color: var(--text-brown); }

        .tag-pill {
            display: inline-block;
            padding: 4px 16px;
            border-radius: 16px;
            font-size: 14px;
            margin-right: 8px;
            margin-bottom: 8px;
            color: var(--text-dark);
        }
        .tag-gray { background: var(--tag-gray); border-radius: 8px; }
        .tag-beige { background: var(--tag-beige); }
        .tag-orange { background: var(--tag-orange-light); }

        .btn-custom-outline {
            border: 1px solid var(--btn-outline);
            background: #E4CDB9;
            border-radius: 16px;
            padding: 8px 20px;
            color: var(--text-dark);
            text-decoration: none;
            transition: 0.3s;
        }
        .btn-custom-outline:hover { background: #d8be1; }
        
        .btn-custom-gradient {
            background: linear-gradient(62.54deg, #F3ECE6 17.1%, #BA783F 301.36%);
            border: 1px solid #544B43;
            border-radius: 17px;
            padding: 8px 20px;
            color: var(--text-dark);
            text-decoration: none;
        }

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
        .thai-info-block {
            position: absolute;
            top: 190px;
            right: 40px;
            text-align: right;
            z-index: 2;
            color: var(--text-dark);
        }
        .thai-main-heading {
            font-weight: 700;
            font-size: clamp(30px, 4vw, 55px);
            margin-bottom: 0;
            white-space: nowrap;
        }
        .thai-sub-heading {
            font-size: 24px;
            margin-top: -5px;
            opacity: 0.8;
        }
        .thai-details {
            margin-top: 20px;
            text-align: left;
        }
        .thai-details h4 {
            font-weight: 700;
            font-size: 28px;
            margin-bottom: 0px;
            color: #382F27;
        }
        .thai-details p {
            font-size: clamp(30px, 4vw, 44px);
            font-weight: 200;
            line-height: 1.1;
            color: #382F27;
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

        .feature-img {
            width: 100%;
            border-radius: 24px;
            height: 100%;
            object-fit: cover;
            min-height: 400px;
        }

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
        
        .room-card:hover {
            box-shadow: 0px 8px 25px rgba(0, 0, 0, 0.08);
        }

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

        /* Footer Action */
        .footer-action {
            background: var(--footer-bg);
            padding: 50px 0;
            color: white;
            margin-top: 60px;
        }
        .footer-line {
            width: 4px;
            height: 147px;
            background: var(--text-dark);
            margin: 0 auto;
        }
    </style>
</head>
<body class="main_page">

    <section class="page condo-landing-page">
        <div class="container position-relative">
            
            <div class="lang-switch">TH</div>

            <div class="hero-card mb-5">
                <div class="row">
                    <div class="col-md-7">
                        <div class="mb-3">
                            <span class="tag-pill tag-gray">1 Bedroom Corner</span>
                            <span class="tag-pill tag-gray">2 Bedroom</span>
                            <span class="tag-pill tag-gray">1 Bedroom</span>
                            <span class="tag-pill tag-gray">Studio</span>
                        </div>
                        <h2 class="text-bold" style="font-size: 45px; margin-bottom: 5px;">Room for Rent</h2>
                        <p style="font-size: 18px; opacity: 0.9;">High Floor Unit • Ready to Move In</p>
                    </div>
                </div>

                <div class="thai-info-block d-none d-md-block">
                    <div class="thai-main-heading">—— ว่างให้เช่า</div>
                    <div class="thai-sub-heading">พร้อมเข้าอยู่</div>
                    <div class="thai-details">
                        <h4>ห้องพักชั้น 37</h4>
                        <p>Life Ladprao Valley</p>
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-12">
                        <img src="images/condo/LIFE_LP_Valley_1.svg" class="hero-img" alt="Life Ladprao Valley">
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-5">
                <div class="col-lg-7 mb-4 mb-lg-0">
                    <img src="images/condo/room-highlight.jpg" class="feature-img" alt="Room Highlight" loading="lazy">
                </div>
                <div class="col-lg-5 pl-lg-5">
                    <h3 class="title-medium mb-4">Highlight</h3>
                    <p>ห้องพักให้เช่าแต่งครบ พร้อมเข้าอยู่ทันที<br>มีบริการหลังการขาย และรองรับภาษาญี่ปุ่น</p>
                    <div class="d-flex mt-4">
                        <a href="#" class="btn-custom-outline mr-3">สอบถามเพิ่มเติม</a>
                        <a href="#" class="btn-custom-gradient">นัดดูห้อง</a>
                    </div>
                </div>
            </div>

            <div class="row align-items-center mb-5 py-4">
                <div class="col-lg-6 pr-lg-5 mb-4 mb-lg-0">
                    <h3 class="title-medium mb-4">Location & Facilities</h3>
                    
                    <div class="d-flex mb-3">
                        <strong class="mr-3 mt-1" style="min-width: 120px;">การเดินทาง :</strong>
                        <div>
                            <span class="tag-pill tag-beige">เดิน 6 นาทีถึง BTS ห้าแยกลาดพร้าว</span>
                            <span class="tag-pill tag-beige">เดิน 12 นาทีถึง MRT พหลโยธิน</span>
                        </div>
                    </div>
                    
                    <div class="d-flex mb-3">
                        <strong class="mr-3 mt-1" style="min-width: 120px;">สถานที่ใกล้เคียง :</strong>
                        <div>
                            <span class="tag-pill tag-gray">Central Plaza Ladprao</span>
                            <span class="tag-pill tag-gray">Union Mall</span>
                            <span class="tag-pill tag-gray">Lotus's</span>
                        </div>
                    </div>

                    <div class="d-flex">
                        <strong class="mr-3 mt-1" style="min-width: 120px;">ส่วนกลาง :</strong>
                        <div>
                            <span class="tag-pill tag-orange">สระว่ายน้ำ 3 สระ</span>
                            <span class="tag-pill tag-orange">ฟิตเนส & ซาวน่า</span>
                            <span class="tag-pill tag-orange">Co-working space & Meeting room</span>
                            <span class="tag-pill tag-orange">ทิ้งขยะได้ 24 ชม.</span>
                            <span class="tag-pill tag-orange">ระบบรักษาความปลอดภัย 24 ชม.</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <img src="images/condo/location-facilities-room.jpg" class="feature-img" alt="Location and Facilities" loading="lazy">
                </div>
            </div>

            <div class="row mb-5">
                <div class="col-12 text-center mb-5">
                    <h3 class="title-medium">Room Types & Gallery</h3>
                </div>
                
                <div class="col-lg-4 col-md-6 mb-5 d-flex">
                    <div class="room-card-wrapper mx-auto ml-lg-0 mr-lg-auto w-100">
                        <div class="room-card">
                            <div class="room-card-header">
                                <h4>Studio</h4>
                                <span class="gallery-badge">Gallery</span>
                            </div>
                            <div class="room-card-img-wrapper">
                                <img src="images/condo/studio.jpg" alt="Studio" loading="lazy">
                            </div>
                            <div class="room-card-info">
                                Size: 26 - 29 Sq.M.<br>
                                Price: เริ่มต้น 16,000 THB/เดือน
                            </div>
                        </div>
                        <div class="room-tags-wrapper">
                            <div class="d-flex flex-wrap mb-2">
                                <span class="tag-pill tag-orange">ห้องปกติ</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <span class="tag-pill tag-orange">เหนือ</span>
                                <span class="tag-pill tag-orange">ใต้</span>
                                <span class="tag-pill tag-orange">ออก</span>
                                <span class="tag-pill tag-orange">ตก</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-5 d-flex">
                    <div class="room-card-wrapper mx-auto w-100">
                        <div class="room-card">
                            <div class="room-card-header">
                                <h4>1 Bedroom</h4>
                                <span class="gallery-badge">Gallery</span>
                            </div>
                            <div class="room-card-img-wrapper">
                                <img src="images/condo/1bed.jpg" alt="1 Bedroom" loading="lazy">
                            </div>
                            <div class="room-card-info">
                                Size: 34 - 37 Sq.M.<br>
                                Price: เริ่มต้น 23,000 THB/เดือน
                            </div>
                        </div>
                        <div class="room-tags-wrapper">
                            <div class="d-flex flex-wrap mb-2">
                                <span class="tag-pill tag-orange">ห้องมุม</span>
                                <span class="tag-pill tag-orange">ห้องปกติ</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <span class="tag-pill tag-orange">เหนือ</span>
                                <span class="tag-pill tag-orange">ใต้</span>
                                <span class="tag-pill tag-orange">ออก</span>
                                <span class="tag-pill tag-orange">ตก</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mb-5 mx-auto d-flex">
                    <div class="room-card-wrapper mx-auto mr-lg-0 ml-lg-auto w-100">
                        <div class="room-card">
                            <div class="room-card-header">
                                <h4>2 Bedroom</h4>
                                <span class="gallery-badge">Gallery</span>
                            </div>
                            <div class="room-card-img-wrapper">
                                <img src="images/condo/2bed.jpg" alt="2 Bedroom" loading="lazy">
                            </div>
                            <div class="room-card-info">
                                Size: 47 - 50 Sq.M.<br>
                                Price: เริ่มต้น 35,000 THB/เดือน
                            </div>
                        </div>
                        <div class="room-tags-wrapper">
                            <div class="d-flex flex-wrap mb-2">
                                <span class="tag-pill tag-orange">ห้องมุม</span>
                            </div>
                            <div class="d-flex flex-wrap">
                                <span class="tag-pill tag-orange">เหนือ</span>
                                <span class="tag-pill tag-orange">ใต้</span>
                                <span class="tag-pill tag-orange">ออก</span>
                                <span class="tag-pill tag-orange">ตก</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="footer-action">
        <div class="container">
            <div class="row align-items-center">
                
                <div class="col-md-5 text-md-left text-center mb-4 mb-md-0">
                    <h4 style="line-height: 1.6; font-size: clamp(20px, 2vw, 24px); font-weight: 400; margin-bottom: 0;">
                        ห้องมีการอัปเดตเข้า-ออกตลอดเวลา ทัก LINE หรือโทรหาเราวันนี้<br>
                        เพื่อรับรูปภาพและวิดีโอห้องว่างอัปเดตล่าสุด
                    </h4>
                </div>
                
                <div class="col-md-1 d-none d-md-flex justify-content-center">
                    <div class="footer-line" style="background-color: #382F27; width: 6px; border-radius: 3px;"></div>
                </div>
                
                <div class="col-md-6 text-center text-md-left">
                    <div class="d-flex flex-column flex-lg-row justify-content-between align-items-lg-end">
                        
                        <div class="mb-4 mb-lg-0">
                            <p class="mb-1" style="font-size: 16px;">ID LINE : @309uddun</p>
                            <p class="mb-1" style="font-size: 16px;">คลิกเพื่อแอดไลน์: <a href="https://lin.ee/ZcTZCL4" class="text-white text-decoration-underline">https://lin.ee/ZcTZCL4</a></p>
                            <p class="mb-1" style="font-size: 16px;">Tel: (TH) 02-080-6106</p>
                            <p class="mb-0" style="font-size: 16px;">Tel: (JP)+662-630-4848 ถึง 51</p>
                        </div>
                        
                        <div class="d-flex justify-content-center justify-content-lg-end pb-lg-1">
                            <a href="#" class="btn-custom-outline mr-3">สอบถามเพิ่มเติม</a>
                            <a href="#" class="btn-custom-gradient">นัดดูห้อง</a>
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
