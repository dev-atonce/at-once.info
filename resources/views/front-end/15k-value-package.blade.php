<!doctype html>
<html lang="{{ Session('lang') ? Session('lang') : 'th' }}">

<head>
    @include("$prefix.analytics.googleAnalytics")
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ @$seo->seo_keyword }}">
    <meta name="description" content="{{ @$seo->seo_description }}">

    <title>{{ @$seo->title ? @$seo->title : '15k Value Package - At-Once' }}</title>

    <meta property="og:title" content="{{ @$seo->title ? @$seo->title : '15k Value Package - At-Once' }}">
    <meta property="og:description" content="{{ @$seo->seo_description }}">
    <meta property="og:image" content="{{ url('img/logo-bg-white.jpg') }}">
    <meta property="og:url" content="{{ url('') . '/' . (Session('lang') ? Session('lang') : 'th') . '/15k-value-package' }}">

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" crossorigin="anonymous">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/header-footer.css?v=0007">
    <link rel="stylesheet" href="css/style.css?v=0005">
    <link rel="stylesheet" href="css/panel-box.css?v=07">
    <link rel="stylesheet" href="css/validate.css" media="all">
    <link href="css/popup-contact.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;500;600;700&family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        /* Custom Modern Styling for 15k Value Package Landing Page */
        :root {
            --primary-navy: #1A315F;
            --secondary-navy: #0E2439;
            --accent-orange: #FF7700;
            --accent-orange-hover: #E06600;
            --text-light: #F8FAFC;
            --text-dark: #1E293B;
            --card-bg-glass: rgba(255, 255, 255, 0.08);
            --card-border-glass: rgba(255, 255, 255, 0.15);
        }

        body.main_page {
            font-family: 'Prompt', 'Inter', sans-serif;
            color: var(--text-dark);
            background-color: #F8FAFC;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-navy) 0%, var(--secondary-navy) 100%);
            padding: 80px 0 100px;
            color: var(--text-light);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -20%;
            width: 80%;
            height: 100%;
            background: radial-gradient(circle, rgba(255, 119, 0, 0.15) 0%, transparent 60%);
            z-index: 1;
            pointer-events: none;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero-tag {
            background-color: rgba(255, 119, 0, 0.2);
            border: 1px solid var(--accent-orange);
            color: var(--accent-orange);
            font-weight: 600;
            font-size: 14px;
            padding: 6px 18px;
            border-radius: 50px;
            display: inline-block;
            margin-bottom: 20px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .hero-title {
            font-size: clamp(32px, 4vw, 52px);
            font-weight: 700;
            line-height: 1.25;
            margin-bottom: 20px;
        }

        .hero-description {
            font-size: clamp(16px, 1.8vw, 20px);
            color: #CBD5E1;
            font-weight: 300;
            margin-bottom: 35px;
            line-height: 1.6;
        }

        /* Glassmorphism Card */
        .glass-card {
            background: var(--card-bg-glass);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--card-border-glass);
            border-radius: 20px;
            padding: 35px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            transition: transform 0.3s ease, border-color 0.3s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            border-color: rgba(255, 119, 0, 0.4);
        }

        .price-tag {
            font-size: 48px;
            font-weight: 700;
            color: var(--accent-orange);
            line-height: 1;
            margin-bottom: 5px;
        }

        .price-period {
            font-size: 14px;
            color: #94A3B8;
            margin-bottom: 20px;
            display: block;
        }

        .feature-list {
            list-style: none;
            padding: 0;
            margin: 0 0 30px;
        }

        .feature-list li {
            padding-left: 28px;
            position: relative;
            margin-bottom: 12px;
            font-size: 15px;
            color: #E2E8F0;
        }

        .feature-list li::before {
            content: "\f00c";
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            left: 0;
            top: 2px;
            color: var(--accent-orange);
        }

        /* CTA Buttons */
        .btn-cta {
            background-color: var(--accent-orange);
            color: white !important;
            font-weight: 600;
            font-size: 16px;
            padding: 14px 30px;
            border-radius: 50px;
            border: none;
            display: inline-block;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(255, 119, 0, 0.3);
            text-align: center;
            width: 100%;
        }

        .btn-cta:hover {
            background-color: var(--accent-orange-hover);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 119, 0, 0.4);
        }

        .btn-cta-secondary {
            background-color: transparent;
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: white !important;
            font-weight: 600;
            font-size: 16px;
            padding: 12px 30px;
            border-radius: 50px;
            transition: all 0.3s ease;
            text-align: center;
            display: inline-block;
            width: 100%;
        }

        .btn-cta-secondary:hover {
            border-color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Details Section */
        .details-section {
            padding: 80px 0;
        }

        .section-title {
            font-size: 32px;
            font-weight: 700;
            color: var(--primary-navy);
            margin-bottom: 15px;
            text-align: center;
        }

        .section-subtitle {
            font-size: 16px;
            color: #64748B;
            text-align: center;
            margin-bottom: 50px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .benefit-card {
            background: white;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
            height: 100%;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid #E2E8F0;
        }

        .benefit-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border-color: rgba(26, 49, 95, 0.15);
        }

        .benefit-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            background-color: rgba(26, 49, 95, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-navy);
            font-size: 24px;
            margin-bottom: 20px;
        }

        .benefit-card:hover .benefit-icon {
            background-color: var(--primary-navy);
            color: white;
            transition: all 0.3s ease;
        }

        .benefit-title {
            font-size: 18px;
            font-weight: 600;
            color: var(--primary-navy);
            margin-bottom: 12px;
        }

        .benefit-desc {
            font-size: 14px;
            color: #64748B;
            line-height: 1.6;
        }

        /* Comparison Section */
        .comparison-section {
            background-color: #F1F5F9;
            padding: 80px 0;
        }

        .comparison-table {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .comparison-header {
            background: var(--primary-navy);
            color: white;
            padding: 25px;
            font-size: 20px;
            font-weight: 600;
            text-align: center;
        }

        .comparison-row {
            display: flex;
            border-bottom: 1px solid #E2E8F0;
            align-items: center;
        }

        .comparison-row:last-child {
            border-bottom: none;
        }

        .comparison-cell {
            padding: 20px;
            flex: 1;
            text-align: center;
            font-size: 15px;
        }

        .comparison-label {
            text-align: left;
            font-weight: 500;
            color: var(--primary-navy);
            flex: 1.5;
            padding-left: 30px;
        }

        .text-check {
            color: #22C55E;
            font-size: 18px;
        }

        .text-cross {
            color: #EF4444;
            font-size: 18px;
        }

        /* Statistics Section */
        .stats-section {
            background-color: var(--primary-navy);
            color: white;
            padding: 60px 0;
            text-align: center;
        }

        .stat-number {
            font-size: 40px;
            font-weight: 700;
            color: var(--accent-orange);
            margin-bottom: 5px;
        }

        .stat-label {
            font-size: 14px;
            color: #94A3B8;
        }

        /* Final Call to Action Section */
        .cta-bottom-section {
            padding: 80px 0;
            text-align: center;
            background: linear-gradient(180deg, #F8FAFC 0%, #E2E8F0 100%);
        }

        .cta-box {
            max-width: 700px;
            margin: 0 auto;
        }

        .card-bussiness {
            margin: 1.75rem auto;
        }
    </style>
</head>

<body class="main_page">
    @include("$prefix.header")

    <!-- Hero Section -->
    <section class="hero-section">
        <div class="container hero-content">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-5 mb-lg-0">
                    <div class="hero-tag">Special Package</div>
                    <h1 class="hero-title">ขยายโอกาสทางธุรกิจแบบก้าวกระโดดด้วย 15K Value Package</h1>
                    <p class="hero-description">
                        แพ็กเกจโปรโมทธุรกิจที่ครอบคลุมและคุ้มค่าที่สุดบน At-Once ช่วยเพิ่มประสิทธิภาพการค้นหาลูกค้า B2B แปลภาษาได้หลากหลาย และส่งตรงผู้สนใจใช้บริการตรงถึงมือคุณอย่างมีประสิทธิภาพ
                    </p>
                    <div class="row">
                        <div class="col-sm-6 mb-3 mb-sm-0">
                            <button class="btn-cta trigger-contact-popup" aria-label="สมัครสมาชิกแพ็กเกจ 15k">สมัครแพ็กเกจเลย</button>
                        </div>
                        <div class="col-sm-6">
                            <button class="btn-cta-secondary trigger-contact-popup" aria-label="สอบถามข้อมูลรายละเอียดเพิ่มเติม">สอบถามรายละเอียดเพิ่มเติม</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <div class="glass-card text-center">
                        <h2 class="h4 text-white mb-3">15K Value Package</h2>
                        <div class="price-tag">15,000 บาท</div>
                        <span class="price-period">ต่อปี (เฉลี่ยเพียง 1,250 บ./เดือน)</span>
                        <ul class="feature-list text-left">
                            <li>ลงข้อมูลโปรไฟล์ธุรกิจอย่างละเอียดครบถ้วน</li>
                            <li>รองรับการแปล 4 ภาษา (TH, EN, JP, ZH)</li>
                            <li>ระบบจัดอันดับ Priority เพิ่มโอกาสการแสดงผล</li>
                            <li>รับข้อมูลผู้ติดต่อผ่าน Line Notify ทันที</li>
                            <li>สถิติวิเคราะห์จำนวนผู้เข้าชมแบบละเอียด</li>
                            <li>การช่วยเหลือจากเจ้าหน้าที่สนับสนุนส่วนตัว</li>
                        </ul>
                        <button class="btn-cta trigger-contact-popup" aria-label="รับสิทธิ์ประโยชน์แพ็กเกจพิเศษ">รับสิทธิ์แพ็กเกจพิเศษนี้</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Stats Section -->
    <section class="stats-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="stat-number">120,000+</div>
                    <div class="stat-label">ผู้ประกอบการลงทะเบียน</div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="stat-number">177+</div>
                    <div class="stat-label">หมวดหมู่ธุรกิจ B2B ครอบคลุม</div>
                </div>
                <div class="col-md-4">
                    <div class="stat-number">1,500,000+</div>
                    <div class="stat-label">ผู้เข้าชมแพลตฟอร์มรายปี</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Details Section -->
    <section class="details-section">
        <div class="container">
            <h2 class="section-title">ฟีเจอร์และคุณประโยชน์ที่คุณจะได้รับ</h2>
            <p class="section-subtitle">ยกระดับธุรกิจของคุณขึ้นสู่อีกขั้น ด้วยเครื่องมือทางการตลาดที่ออกแบบมาสำหรับธุรกิจ B2B โดยเฉพาะ</p>
            <div class="row">
                <div class="col-md-4 mb-4">
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-search-plus"></i></div>
                        <h3 class="benefit-title">SEO Optimization</h3>
                        <p class="benefit-desc">โปรไฟล์บริษัทของคุณจะถูกปรับแต่งโครงสร้างให้สอดคล้องตามหลัก SEO ช่วยให้หน้าเว็บของคุณติดอันดับการค้นหาบน Google ได้ง่ายและเสถียรยิ่งขึ้น</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-language"></i></div>
                        <h3 class="benefit-title">Multilingual Translations</h3>
                        <p class="benefit-desc">รองรับการแปลข้อมูลธุรกิจของคุณออกเป็น 4 ภาษาหลัก (ไทย, อังกฤษ, ญี่ปุ่น, จีน) ช่วยเปิดประตูต้อนรับลูกค้าและผู้แทนการค้าจากต่างประเทศอย่างมืออาชีพ</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4">
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-bell"></i></div>
                        <h3 class="benefit-title">Instant Line Alerts</h3>
                        <p class="benefit-desc">ทุกครั้งที่มีลูกค้ากรอกฟอร์มแสดงความสนใจติดต่อบริการจากโปรไฟล์ของคุณ ระบบจะแจ้งเตือนข้อความผ่าน Line Notify ส่งตรงไปยังทีมขายของคุณทันที</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-chart-line"></i></div>
                        <h3 class="benefit-title">Performance Analytics</h3>
                        <p class="benefit-desc">ระบบรายงานสถิติหลังบ้านแบบละเอียด ช่วยให้คุณสามารถเข้าถึงข้อมูลการคลิกเข้าชม การแชร์ และพฤติกรรมลูกค้าได้ทุกเวลาเพื่อนำไปใช้วางแผนต่อยอด</p>
                    </div>
                </div>
                <div class="col-md-4 mb-4 mb-md-0">
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-award"></i></div>
                        <h3 class="benefit-title">Priority Placement</h3>
                        <p class="benefit-desc">จัดอันดับการแสดงรายชื่อบริษัทของคุณให้อยู่ในอันดับต้น ๆ ภายในหมวดหมู่ธุรกิจของคุณ ช่วยดึงดูดสายตาและสร้างความน่าเชื่อถือได้เป็นอันดับแรก</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="benefit-card">
                        <div class="benefit-icon"><i class="fas fa-headset"></i></div>
                        <h3 class="benefit-title">Dedicated Account Manager</h3>
                        <p class="benefit-desc">เจ้าหน้าที่ดูแลประสานงานส่วนบุคคล คอยช่วยเหลือ แนะนำแนวทางการปรับปรุงโปรไฟล์ และช่วยอำนวยความสะดวกในการจัดทำหน้าเว็บของท่านตลอดระยะเวลาแพ็กเกจ</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Section -->
    <section class="comparison-section">
        <div class="container">
            <h2 class="section-title">เปรียบเทียบความแตกต่าง</h2>
            <p class="section-subtitle">ดูความคุ้มค่าที่แตกต่างระหว่างสิทธิ์ใช้งานทั่วไปกับ 15K Value Package ที่มอบประสิทธิภาพสูงสุด</p>
            <div class="comparison-table">
                <div class="comparison-header">ตารางเปรียบเทียบสิทธิประโยชน์</div>
                
                <div class="comparison-row">
                    <div class="comparison-cell comparison-label">ฟีเจอร์ / สิทธิประโยชน์</div>
                    <div class="comparison-cell font-weight-bold">Free Plan</div>
                    <div class="comparison-cell font-weight-bold text-primary">15K Value Package</div>
                </div>
                
                <div class="comparison-row">
                    <div class="comparison-cell comparison-label">ข้อมูลประวัติและรูปภาพบริษัท</div>
                    <div class="comparison-cell"><i class="fas fa-check text-check"></i></div>
                    <div class="comparison-cell"><i class="fas fa-check text-check"></i></div>
                </div>
                
                <div class="comparison-row">
                    <div class="comparison-cell comparison-label">การรองรับระบบ 4 ภาษา (TH, EN, JP, ZH)</div>
                    <div class="comparison-cell"><i class="fas fa-times text-cross"></i> (เฉพาะภาษาหลัก)</div>
                    <div class="comparison-cell"><i class="fas fa-check text-check"></i> (แปลทุกภาษา)</div>
                </div>

                <div class="comparison-row">
                    <div class="comparison-cell comparison-label">การแจ้งเตือนทันทีผ่าน LINE Notify</div>
                    <div class="comparison-cell"><i class="fas fa-times text-cross"></i></div>
                    <div class="comparison-cell"><i class="fas fa-check text-check"></i></div>
                </div>

                <div class="comparison-row">
                    <div class="comparison-cell comparison-label">การแสดงอันดับผู้ให้บริการ (Priority list)</div>
                    <div class="comparison-cell">อันดับทั่วไป</div>
                    <div class="comparison-cell font-weight-bold text-primary">อันดับพิเศษต้นหมวดหมู่</div>
                </div>

                <div class="comparison-row">
                    <div class="comparison-cell comparison-label">ผู้ดูแลบัญชีและอัพเดทข้อมูลส่วนตัว</div>
                    <div class="comparison-cell"><i class="fas fa-times text-cross"></i></div>
                    <div class="comparison-cell"><i class="fas fa-check text-check"></i></div>
                </div>

                <div class="comparison-row">
                    <div class="comparison-cell comparison-label">การแสดงรายละเอียดสินค้า/บริการเสริม</div>
                    <div class="comparison-cell">จำกัด 3 รายการ</div>
                    <div class="comparison-cell font-weight-bold text-primary">ไม่จำกัดจำนวนรายการ</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bottom Call to Action -->
    <section class="cta-bottom-section">
        <div class="container">
            <div class="cta-box">
                <h2 class="h1 font-weight-bold var(--primary-navy) mb-3">ยกระดับธุรกิจของคุณวันนี้</h2>
                <p class="text-muted mb-5">โอกาสทองในการเข้าถึงลูกค้าธุรกิจและสร้างเครือข่าย B2B ในประเทศไทยและต่างประเทศที่ครอบคลุมมากที่สุด ทีมงานยินดีให้คำปรึกษาฟรี!</p>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-5">
                        <button class="btn-cta btn-lg trigger-contact-popup" aria-label="สนใจสมัครสมาชิก 15k package">สนใจสมัครแพ็กเกจ คลิกที่นี่</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include("$prefix.footer")

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-popup.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=0001"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    <script type="text/javascript" src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en"></script>
    <script src="js/package-popup.js?v=4"></script>
    <script src="plugin/sweetalert2/sweetalert2.all.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        $(document).ready(function() {
            // Trigger contact popup immediately on clicking any CTA button
            $(document).on('click', '.trigger-contact-popup', function(e) {
                e.preventDefault();
                
                // Force state in localStorage
                localStorage.setItem("PopupCard", JSON.stringify({show: true, toggle: 'content'}));
                
                if ($(document).find('.popup-dialog').length == 0) {
                    // Call the PopupCard function from package-popup.js
                    PopupCard(true);
                } else {
                    // Open the popup if it exists
                    $('.popup-dialog').addClass('dialog-backdrop');
                    $('.popup-dialog .dialog-content').removeClass('d-none').addClass('d-block');
                    $('.popup-dialog .dialog-bar').removeClass('d-block').addClass('d-none');
                }
            });
        });
    </script>
</body>

</html>
