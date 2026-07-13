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
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    <!-- Tailwind CSS (scoped to .lp-15k, does not touch the existing header/footer) -->
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            important: '.lp-15k',
            corePlugins: {
                preflight: false,
                container: false
            },
            theme: {
                extend: {
                    colors: {
                        'brand-blue-dark': '#1e3a8a',
                        'brand-blue': '#2563eb',
                        'brand-blue-light': '#dbeafe',
                        'brand-orange': '#ea580c',
                        'brand-orange-hover': '#c2410c',
                        'brand-yellow': '#facc15',
                    }
                }
            }
        }
    </script>

    <style>
        /* Icon font used by the "Why AT-Once" section */
        .material-symbols-outlined {
            font-family: 'Material Symbols Outlined';
            font-weight: normal;
            font-style: normal;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -webkit-font-feature-settings: 'liga';
            -webkit-font-smoothing: antialiased;
        }

        :where(.lp-15k) :where(*, *::before, *::after) {
            box-sizing: border-box;
            border-width: 0;
            border-style: solid;
            border-color: currentColor;
        }

        .lp-15k {
            font-family: 'Prompt', sans-serif;
            color: #1e293b;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
        }

        :where(.lp-15k) :where(h1, h2, h3, h4) {
            margin: 0;
            font-size: inherit;
            font-weight: inherit;
        }

        :where(.lp-15k) :where(p) {
            margin: 0;
        }

        :where(.lp-15k) :where(ul, ol) {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        :where(.lp-15k) :where(button) {
            font-family: inherit;
            font-size: 100%;
            font-weight: inherit;
            line-height: inherit;
            color: inherit;
            margin: 0;
            padding: 0;
            background-color: transparent;
            background-image: none;
            border: none;
            text-align: inherit;
            cursor: pointer;
        }

        :where(.lp-15k) :where(a) {
            color: inherit;
            text-decoration: inherit;
        }

        :where(.lp-15k) :where(svg) {
            display: block;
            vertical-align: middle;
        }

        @media (prefers-reduced-motion: no-preference) {
            :where(.lp-15k) .reveal {
                opacity: 0;
                transform: translateY(22px);
                transition: opacity .7s cubic-bezier(.16, 1, .3, 1), transform .7s cubic-bezier(.16, 1, .3, 1);
            }

            :where(.lp-15k) .reveal.is-visible {
                opacity: 1;
                transform: translateY(0);
            }

            :where(.lp-15k) .reveal-d1 { transition-delay: .08s; }
            :where(.lp-15k) .reveal-d2 { transition-delay: .16s; }
            :where(.lp-15k) .reveal-d3 { transition-delay: .24s; }
            :where(.lp-15k) .reveal-d4 { transition-delay: .32s; }
            :where(.lp-15k) .reveal-d5 { transition-delay: .4s; }
            :where(.lp-15k) .reveal-d6 { transition-delay: .48s; }

            /* Step connector "draws itself" left-to-right once the row is in
               view — a motion choice tied to what the line means (sequence),
               not decoration for its own sake. */
            :where(.lp-15k) .step-connector {
                transform: scaleX(0);
                transform-origin: left center;
                transition: transform 1s cubic-bezier(.16, 1, .3, 1) .15s;
            }

            :where(.lp-15k) .step-connector.is-visible {
                transform: scaleX(1);
            }

            :where(.lp-15k) .badge-pulse {
                animation: lp15k-badge-pulse 2.4s ease-out infinite;
            }

            @keyframes lp15k-badge-pulse {
                0%, 100% { box-shadow: 0 0 0 0 rgba(234, 88, 12, .45); }
                70% { box-shadow: 0 0 0 10px rgba(234, 88, 12, 0); }
            }
        }

        html, body {
            overflow-x: hidden;
        }

        #topheader {
            position: relative;
            z-index: 1050 !important;
        }
    </style>
</head>

<body class="main_page">
    @include("$prefix.header")

    <div class="lp-15k">
        <!-- BEGIN: Hero Section -->
        <header class="text-white py-20 text-center relative overflow-hidden" style="background: linear-gradient(to bottom, #172554 0%, #1e40af 100%);">
            <div class="max-w-4xl mx-auto px-4 relative z-10">
                <span class="reveal reveal-load inline-block bg-white/20 text-brand-yellow text-sm px-4 py-1 rounded-full mb-6 backdrop-blur-sm">แพลตฟอร์ม B2B Matching อันดับ 1 ในไทย</span>
                <h1 class="reveal reveal-load reveal-d1 text-4xl md:text-5xl font-bold leading-tight mb-4">
                    อยากหาลูกค้า B2B ในไทย<br>
                    แต่ยังไม่มีเว็บไซต์?
                </h1>
                <h2 class="reveal reveal-load reveal-d2 text-3xl md:text-4xl font-bold text-brand-yellow mb-6">
                    ไม่ใช่ปัญหาอีกต่อไป!
                </h2>
                <p class="reveal reveal-load reveal-d3 text-lg md:text-xl text-blue-100 mb-12 max-w-2xl mx-auto">
                    AT-Once ให้ธุรกิจของคุณมีหน้าร้านออนไลน์พร้อมเข้าถึงลูกค้า B2B ไทยได้ทันที ไม่ต้องลงทุนสร้างเว็บเอง
                </p>
                <!-- Stats -->
                <div class="reveal reveal-load reveal-d4 grid grid-cols-2 md:grid-cols-4 mb-12 py-8">
                    <div class="border-r border-white/20 px-4">
                        <div class="text-3xl font-bold text-brand-yellow mb-1"><span class="stat-value" data-target="150000" data-suffix="+">150,000+</span></div>
                        <div class="text-sm text-blue-200">ยอดเข้าชม/เดือน</div>
                    </div>
                    <div class="md:border-r md:border-white/20 px-4">
                        <div class="text-3xl font-bold text-brand-yellow mb-1"><span class="stat-value" data-target="35000" data-suffix="+">35,000+</span></div>
                        <div class="text-sm text-blue-200">ผู้ใช้จริง/เดือน</div>
                    </div>
                    <div class="border-r border-white/20 px-4">
                        <div class="text-3xl font-bold text-brand-yellow mb-1"><span class="stat-value" data-target="160000" data-suffix="+">160,000+</span></div>
                        <div class="text-sm text-blue-200">บริษัทในฐานข้อมูล</div>
                    </div>
                    <div class="px-4">
                        <div class="text-3xl font-bold text-brand-yellow mb-1"><span class="stat-value" data-target="177" data-suffix="">177</span></div>
                        <div class="text-sm text-blue-200">หมวดธุรกิจ</div>
                    </div>
                </div>
                <!-- CTA Buttons -->
                <div class="reveal reveal-load reveal-d5 flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a class="group trigger-contact-popup bg-brand-orange hover:bg-brand-orange-hover text-white px-8 py-3 rounded-md font-medium text-lg flex items-center transition duration-300 transform hover:scale-105 active:scale-95" href="javascript:;" aria-label="เริ่มต้นสมัครแพ็กเกจวันนี้">
                        เริ่มต้นวันนี้ <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                    </a>
                    <a class="bg-transparent border border-white hover:bg-white/10 text-white px-8 py-3 rounded-md font-medium text-lg transition duration-300 transform hover:scale-105 active:scale-95" href="{{ url((Session('lang') ? Session('lang') : 'th') . '/promotion-package') }}" aria-label="ดูตัวอย่างแพลตฟอร์ม">
                        ดูตัวอย่าง
                    </a>
                </div>
            </div>
        </header>
        <!-- END: Hero Section -->

        <!-- BEGIN: Why AT-Once Section -->
        <section class="py-20" style="background-color: #FFFEFE;">
            <div class="max-w-6xl mx-auto px-4">
                <div class="reveal reveal-scroll text-center mb-16">
                    <span class="text-brand-orange font-semibold text-sm tracking-wider uppercase mb-2 block">ทำไมต้อง AT-ONCE</span>
                    <h2 class="text-3xl font-bold text-brand-blue-dark mb-4">AT-Once คือแพลตฟอร์มที่เชื่อมโยง<br>ผู้ซื้อกับผู้ขาย B2B ทั่วประเทศไทย</h2>
                    <p class="text-slate-600 max-w-3xl mx-auto">เราช่วยให้ธุรกิจของคุณถูกค้นพบโดยลูกค้าที่ใช่ ด้วยโปรไฟล์บริษัทออนไลน์ที่สร้างง่าย พร้อมระบบ Inquiry โดยตรง</p>
                </div>
                <div class="grid grid-cols-1 gap-12 max-w-3xl mx-auto">
                    <!-- Feature 1 -->
                    <div class="reveal reveal-scroll group flex items-start">
                        <div class="flex-shrink-0 w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-brand-blue mr-6 transition-colors duration-300 group-hover:bg-brand-blue group-hover:text-white"><span class="material-symbols-outlined text-3xl">storefront</span></div>
                        <div>
                            <h3 class="text-xl font-bold text-brand-blue-dark mb-2">หน้าร้านออนไลน์พร้อมใช้งานทันที</h3>
                            <p class="text-slate-600 text-sm">ไม่ต้องสร้างเว็บเอง เราจัดทำ Company Profile ให้พร้อม พร้อม Dashboard ส่วนตัวเพื่อดูสถิติได้ตลอดเวลา</p>
                        </div>
                    </div>
                    <!-- Feature 2 -->
                    <div class="reveal reveal-scroll reveal-d1 group flex items-start">
                        <div class="flex-shrink-0 w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-brand-blue mr-6 transition-colors duration-300 group-hover:bg-brand-blue group-hover:text-white"><span class="material-symbols-outlined text-3xl">group</span></div>
                        <div>
                            <h3 class="text-xl font-bold text-brand-blue-dark mb-2">เข้าถึงลูกค้า B2B กว่า 35,000 คน/เดือน</h3>
                            <p class="text-slate-600 text-sm">แพลตฟอร์มที่ลูกค้าไทยใช้ค้นหาซัพพลายเออร์จริง ครอบคลุม 177 หมวดธุรกิจ ทุกขนาดทุกประเภท</p>
                        </div>
                    </div>
                    <!-- Feature 3 -->
                    <div class="reveal reveal-scroll reveal-d2 group flex items-start">
                        <div class="flex-shrink-0 w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-brand-blue mr-6 transition-colors duration-300 group-hover:bg-brand-blue group-hover:text-white"><span class="material-symbols-outlined text-3xl">mail</span></div>
                        <div>
                            <h3 class="text-xl font-bold text-brand-blue-dark mb-2">รับ Inquiry ฟรี ไม่มีค่าใช้จ่ายเพิ่ม</h3>
                            <p class="text-slate-600 text-sm">ทีมงานคัดกรองและส่งต่อ Inquiry จากผู้ซื้อถึงทีม Sales ของคุณโดยตรง ไม่ตกหล่นทุก Lead</p>
                        </div>
                    </div>
                    <!-- Feature 4 -->
                    <div class="reveal reveal-scroll reveal-d3 group flex items-start">
                        <div class="flex-shrink-0 w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-brand-blue mr-6 transition-colors duration-300 group-hover:bg-brand-blue group-hover:text-white"><span class="material-symbols-outlined text-3xl">bar_chart</span></div>
                        <div>
                            <h3 class="text-xl font-bold text-brand-blue-dark mb-2">ติดตามผลได้จริงผ่าน Dashboard</h3>
                            <p class="text-slate-600 text-sm">ดู Views, Inquiries และ Engagement ได้ตลอดเวลา อัปเดตข้อมูลได้เองไม่จำกัด</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END: Why AT-Once Section -->

        <!-- BEGIN: Value Package Section -->
        <section class="py-20" style="background-color: #F4F6FB;">
            <div class="max-w-4xl mx-auto px-4">
                <div class="text-center mb-12">
                    <span class="text-brand-orange font-semibold text-sm tracking-wider uppercase mb-2 block">VALUE PACKAGE</span>
                    <h2 class="text-3xl font-bold text-brand-blue-dark mb-4">ราคาเริ่มต้นที่คุ้มค่า</h2>
                    <p class="text-slate-600">เริ่มต้นเพียง 15,000 บาท/ปี หรือเฉลี่ยแค่ 43 บาทต่อวัน</p>
                </div>
                <div class="reveal reveal-scroll bg-white border-2 border-brand-blue rounded-2xl shadow-xl mt-12 max-w-2xl mx-auto flex flex-col items-center relative transition-transform duration-300 hover:-translate-y-1">
                    <!-- Badge -->
                    <div class="badge-pulse absolute top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-brand-orange text-white px-6 py-1 rounded-full text-sm font-bold inline-flex items-center shadow-md z-10">
                        <svg class="w-4 h-4 mr-1 text-brand-yellow" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        แนะนำสำหรับธุรกิจที่เริ่มต้น
                    </div>
                    <div class="px-8 pt-10 pb-0 text-center">
                        <h3 class="text-2xl font-bold text-brand-blue-dark mb-4">Value Package</h3>
                        <div class="flex justify-center items-end mb-2">
                            <span class="text-5xl font-bold text-brand-blue">15,000</span>
                            <span class="text-xl text-gray-500 ml-1 font-medium pb-1">฿/ปี</span>
                        </div>
                        <p class="text-brand-orange font-medium text-sm">เฉลี่ยเพียง 43 บาทต่อวัน!</p>
                    </div>
                    <div class="px-8 pt-0 pb-6">
                        <ul class="text-left mb-8">
                            <li class="flex items-start py-4 border-b border-gray-100">
                                <svg class="w-5 h-5 text-brand-blue mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                                <span class="text-slate-700">Professional Company Profile บนแพลตฟอร์ม B2B ที่มีผู้ใช้งานจริง</span>
                            </li>
                            <li class="flex items-start py-4 border-b border-gray-100">
                                <svg class="w-5 h-5 text-brand-blue mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                                <span class="text-slate-700">Backend Dashboard — ดู Views &amp; Inquiries ได้ตลอด 24 ชม.</span>
                            </li>
                            <li class="flex items-start py-4 border-b border-gray-100">
                                <svg class="w-5 h-5 text-brand-blue mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                                <span class="text-slate-700">อัปโหลดเนื้อหาไม่จำกัด เพื่อทดสอบตลาดไทย</span>
                            </li>
                            <li class="flex items-start py-4 border-b border-gray-100">
                                <svg class="w-5 h-5 text-brand-blue mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                                <span class="text-slate-700">Free Inquiry Handling — ส่ง Lead ให้ฟรีไม่มีค่าใช้จ่ายเพิ่ม</span>
                            </li>
                            <li class="flex items-start py-4 border-b border-gray-100">
                                <svg class="w-5 h-5 text-brand-blue mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                                <span class="text-slate-700">ไม่ต้องสร้างเว็บเอง ลดต้นทุนหลายหมื่นบาท</span>
                            </li>
                            <li class="flex items-start py-4">
                                <svg class="w-5 h-5 text-brand-blue mt-0.5 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                                <span class="text-slate-700">ทีมซัพพอร์ตพร้อมช่วยเหลือ</span>
                            </li>
                        </ul>
                        <a class="trigger-contact-popup block w-full bg-brand-blue hover:bg-brand-blue-dark text-white text-center py-3 rounded-md font-medium transition duration-300 mt-4 transform hover:scale-[1.02] active:scale-95" href="javascript:;" aria-label="สมัคร Value Package เริ่มต้นได้วันนี้">
                            สมัครเลย — เริ่มต้นได้วันนี้
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- END: Value Package Section -->

        <!-- BEGIN: 3 Easy Steps Section -->
        <section class="py-20 bg-white border-t border-gray-100">
            <div class="max-w-6xl mx-auto px-4">
                <div class="reveal reveal-scroll text-center mb-16">
                    <span class="text-brand-orange font-semibold text-sm tracking-wider uppercase mb-2 block">ขั้นตอน</span>
                    <h2 class="text-3xl font-bold text-brand-blue-dark mb-4">เริ่มต้นง่ายใน 3 ขั้นตอน</h2>
                    <p class="text-slate-600">ไม่ต้องมีความรู้ด้านเทคนิค เริ่มได้ทันทีภายในวันเดียว</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
                    <!-- Connecting Line (visible on md+) -->
                    <div class="step-connector reveal-scroll hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-gray-200 -z-10 -translate-y-1/2"></div>
                    <!-- Step 1 -->
                    <div class="reveal reveal-scroll bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm relative z-10 transition-transform duration-300 hover:-translate-y-1 hover:shadow-md">
                        <div class="w-12 h-12 bg-brand-blue text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4 border-4 border-white shadow-sm" style="background-color: rgb(30, 84, 161);">1</div>
                        <h3 class="font-bold text-brand-blue-dark mb-2">กรอกข้อมูลบริษัท</h3>
                        <p class="text-slate-500 text-sm">กรอกข้อมูลธุรกิจ ประเภทบริการ และข้อมูลติดต่อ</p>
                    </div>
                    <!-- Step 2 -->
                    <div class="reveal reveal-scroll reveal-d1 bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm relative z-10 transition-transform duration-300 hover:-translate-y-1 hover:shadow-md">
                        <div class="w-12 h-12 bg-brand-blue text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4 border-4 border-white shadow-sm" style="background-color: rgb(30, 84, 161);">2</div>
                        <h3 class="font-bold text-brand-blue-dark mb-2">ทีมงานจัดทำโปรไฟล์</h3>
                        <p class="text-slate-500 text-sm">ทีมงาน AT-Once ออกแบบและจัดทำ Company Profile ให้</p>
                    </div>
                    <!-- Step 3 -->
                    <div class="reveal reveal-scroll reveal-d2 bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm relative z-10 transition-transform duration-300 hover:-translate-y-1 hover:shadow-md">
                        <div class="w-12 h-12 bg-brand-blue text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4 border-4 border-white shadow-sm" style="background-color: rgb(30, 84, 161);">3</div>
                        <h3 class="font-bold text-brand-blue-dark mb-2">เริ่มรับ Inquiry</h3>
                        <p class="text-slate-500 text-sm">โปรไฟล์ขึ้นแพลตฟอร์ม ลูกค้าเริ่มพบเจอและส่ง Inquiry ได้ทันที</p>
                    </div>
                    <!-- Step 4 -->
                    <div class="reveal reveal-scroll reveal-d3 bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm relative z-10 transition-transform duration-300 hover:-translate-y-1 hover:shadow-md">
                        <div class="w-12 h-12 bg-brand-blue text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4 border-4 border-white shadow-sm" style="background-color: rgb(30, 84, 161);">4</div>
                        <h3 class="font-bold text-brand-blue-dark mb-2">ติดตามผลผ่าน Dashboard</h3>
                        <p class="text-slate-500 text-sm">ดูสถิติ Views และ Inquiries ได้แบบ Real-time ตลอด 24 ชม.</p>
                    </div>
                </div>
            </div>
        </section>
        <!-- END: 3 Easy Steps Section -->

        <!-- BEGIN: Highlights Section -->
        <section class="py-20 bg-slate-50">
            <div class="max-w-6xl mx-auto px-4">
                <div class="reveal reveal-scroll text-center mb-12">
                    <span class="text-brand-orange font-semibold text-sm tracking-wider uppercase mb-2 block">ทำไมต้องเลือก</span>
                    <h2 class="text-3xl font-bold text-brand-blue-dark">จุดเด่นของ AT-Once</h2>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <!-- Highlight 1 -->
                    <div class="reveal reveal-scroll">
                        <div class="bg-white p-6 rounded-xl text-center shadow-sm border border-gray-100 h-full transition-transform duration-300 hover:-translate-y-1 hover:shadow-md">
                            <div class="text-brand-blue mb-4 flex justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 6v12m-3-2.818.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                            </div>
                            <h4 class="font-bold text-brand-blue-dark mb-2">Cost-Effective</h4>
                            <p class="text-slate-500 text-xs">วิธีที่คุ้มค่าที่สุดในการมี Online Presence ในไทย</p>
                        </div>
                    </div>
                    <!-- Highlight 2 -->
                    <div class="reveal reveal-scroll reveal-d1">
                        <div class="bg-white p-6 rounded-xl text-center shadow-sm border border-gray-100 h-full transition-transform duration-300 hover:-translate-y-1 hover:shadow-md">
                            <div class="text-brand-blue mb-4 flex justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15.59 14.37a6 6 0 0 1-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 0 0 6.16-12.12A14.98 14.98 0 0 0 9.631 8.41m5.96 5.96a14.926 14.926 0 0 1-5.841 2.58m-.119-8.54a6 6 0 0 0-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 0 0-2.58 5.84m2.699 2.7c-.103.021-.207.041-.311.06a15.09 15.09 0 0 1-2.448-2.448 14.9 14.9 0 0 1 .06-.312m-2.24 2.39a4.493 4.493 0 0 0-1.757 4.306 4.493 4.493 0 0 0 4.306-1.758M16.5 9a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                            </div>
                            <h4 class="font-bold text-brand-blue-dark mb-2">เริ่มได้ทันที</h4>
                            <p class="text-slate-500 text-xs">ไม่ต้องรอสร้างเว็บ ไม่ต้องมีความรู้ด้านเทคนิค</p>
                        </div>
                    </div>
                    <!-- Highlight 3 -->
                    <div class="reveal reveal-scroll reveal-d2">
                        <div class="bg-white p-6 rounded-xl text-center shadow-sm border border-gray-100 h-full transition-transform duration-300 hover:-translate-y-1 hover:shadow-md">
                            <div class="text-brand-blue mb-4 flex justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3.75 3v11.25A2.25 2.25 0 0 0 6 16.5h2.25M3.75 3h-1.5m1.5 0h16.5m0 0h1.5m-1.5 0v11.25A2.25 2.25 0 0 1 18 16.5h-2.25m-7.5 0h7.5m-7.5 0-1 3m8.5-3 1 3m0 0 .5 1.5m-.5-1.5h-9.5m0 0-.5 1.5m.75-9 3-3 2.148 2.148A12.061 12.061 0 0 1 16.5 7.605" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                            </div>
                            <h4 class="font-bold text-brand-blue-dark mb-2">Market Insight</h4>
                            <p class="text-slate-500 text-xs">เห็นข้อมูล Engagement ของลูกค้าไทยจาก Dashboard จริง</p>
                        </div>
                    </div>
                    <!-- Highlight 4 -->
                    <div class="reveal reveal-scroll reveal-d3">
                        <div class="bg-white p-6 rounded-xl text-center shadow-sm border border-gray-100 h-full transition-transform duration-300 hover:-translate-y-1 hover:shadow-md">
                            <div class="text-brand-blue mb-4 flex justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 12.75 11.25 15 15 9.75m-3-7.036A11.959 11.959 0 0 1 3.598 6 11.99 11.99 0 0 0 3 9.749c0 5.592 3.824 10.29 9 11.623 5.176-1.332 9-6.03 9-11.622 0-1.31-.21-2.571-.598-3.751h-.152c-3.196 0-6.1-1.248-8.25-3.285Z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                            </div>
                            <h4 class="font-bold text-brand-blue-dark mb-2">ทีมซัพพอร์ต</h4>
                            <p class="text-slate-500 text-xs">ทีมงานมืออาชีพพร้อมช่วยตลอดการใช้งาน</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- END: Highlights Section -->

        <!-- BEGIN: Footer CTA Section -->
        <section class="bg-brand-blue-dark text-white py-16 from-[#1e3a8a] via-[#1e40af] to-[#3b82f6] bg-gradient-to-br">
            <div class="max-w-4xl mx-auto px-4 text-center">
                <h2 class="reveal reveal-scroll text-3xl font-bold mb-4">พร้อมเริ่มต้นขยายธุรกิจสู่ตลาดไทย?</h2>
                <p class="reveal reveal-scroll reveal-d1 text-blue-200 mb-8">ติดต่อเราได้เลยวันนี้ ทีมงานพร้อมช่วยคุณเริ่มต้น</p>
                <div class="reveal reveal-scroll reveal-d2 inline-block bg-brand-blue-dark border-2 border-brand-yellow rounded-xl px-8 py-4 mb-8">
                    <div class="flex items-end justify-center">
                        <span class="text-4xl font-bold text-brand-yellow">15,000</span>
                        <span class="text-lg text-white ml-2 pb-1 font-medium">฿/ปี</span>
                    </div>
                    <div class="text-sm text-blue-200 mt-1">เฉลี่ยเพียง 43 บาทต่อวัน</div>
                </div>
                <div class="reveal reveal-scroll reveal-d3 flex flex-wrap justify-center gap-4 mb-8">
                    <a class="flex items-center bg-white/10 hover:bg-white/20 px-6 py-2 rounded border border-white/20 transition text-white transform hover:-translate-y-0.5" href="https://line.me/ti/p/~@431xnkdu" target="_blank" aria-label="ติดต่อผ่าน LINE">
                        <i class="fab fa-line mr-2" style="font-size: 1rem;"></i>
                        @431xnkdu
                    </a>
                    <a class="flex items-center bg-white/10 hover:bg-white/20 px-6 py-2 rounded border border-white/20 transition text-white transform hover:-translate-y-0.5" href="mailto:marketing2@at-once.info">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                        marketing2@at-once.info
                    </a>
                    <a class="flex items-center bg-white/10 hover:bg-white/20 px-6 py-2 rounded border border-white/20 transition text-white transform hover:-translate-y-0.5" href="https://at-once.info/th" target="_blank">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                        at-once.info/th
                    </a>
                </div>
                <button class="reveal reveal-scroll reveal-d4 trigger-contact-popup bg-brand-orange hover:bg-brand-orange-hover text-white px-8 py-3 rounded-md font-bold text-lg transition duration-300 transform hover:scale-105 active:scale-95" aria-label="สมัคร Value Package เลย">
                    สมัคร Value Package เลย
                </button>
            </div>
        </section>
        <!-- END: Footer CTA Section -->
    </div>

    @include("$prefix.footer")

    <!-- Scripts -->
    <script src="js/jquery.js"></script>
    <script src="js/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-popup.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=0001"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    <script type="text/javascript" src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit&hl=en"></script>
    <script src="plugin/sweetalert2/sweetalert2.all.js"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <script>
        // --- Popup Business Card ---
        var lang = "{{ Session('lang', 'th') }}";

        jQuery.validator.addMethod("letteronly", function(value, element, param) {
            return value.match(new RegExp("." + param + "$"));
        });

        function PopupBusinessCard() {
            let page = 'Pop-up from 15k Value Package Landing Page';
            let companyLogo = "split/at_once.png";
            let companyName = "At-once";
            const caption = 'ขอบคุณสำหรับความสนใจใน 15K Value Package หากลูกค้าต้องการสอบถามข้อมูลเพิ่มเติม สามารถกรอกรายละเอียดด้านล่าง จากนั้นจะมีเจ้าหน้าที่ติดต่อกลับภายใน 24 ชั่วโมงค่ะ';
            let companyId = 64;

            const popup = $(
            `<div class="popup-dialog dialog-centered dialog-backdrop">
                <div class="card-bussiness dialog-content" style="border-radius:8px; display:flex; flex-direction:column; -webkit-transition:opacity 400ms ease-in; -moz-transition:opacity 400ms ease-in; transition: opacity 400ms ease-in;">
                        <a href="javascript:" class="dialog-minimize" onclick="PopupMinimize()">
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
                                            <button type="button" class="btn btn-secondary" onclick="PopupMinimize()" style="minWidth:100; margin:0 0 0 5px">Cancel</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>`);

            $(document).find('body').append(popup);

            grecaptcha.ready(function() {
                var captchaContainer = grecaptcha.render('captcha_container', {
                    'sitekey' : '6LcEE6ooAAAAAN8ZnN5uTezCAeCpAvB6fGuugnKB',
                    'callback' : function(response) {
                        document.querySelector('#businessCard').querySelector('[type="submit"]').removeAttribute('disabled');
                    }
                });

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
            });
        }

        function PopupMinimize() {
            $('.popup-dialog').remove();
        }

        $(document).ready(function() {
            // Open the reference-style contact popup on every CTA button click
            $(document).on('click', '.trigger-contact-popup', function(e) {
                e.preventDefault();

                if ($(document).find('.popup-dialog').length == 0) {
                    PopupBusinessCard();
                }
            });
        });

        // --- Motion layer: reveal-on-load, reveal-on-scroll, stat count-up ---
        (function() {
            var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

            function animateCount(el) {
                var target = parseInt(el.getAttribute('data-target'), 10) || 0;
                var suffix = el.getAttribute('data-suffix') || '';
                if (reduceMotion) {
                    el.textContent = target.toLocaleString('en-US') + suffix;
                    return;
                }
                var duration = 1400;
                var start = null;
                function step(timestamp) {
                    if (start === null) start = timestamp;
                    var progress = Math.min((timestamp - start) / duration, 1);
                    var eased = 1 - Math.pow(1 - progress, 3);
                    var current = Math.round(target * eased);
                    el.textContent = current.toLocaleString('en-US') + suffix;
                    if (progress < 1) window.requestAnimationFrame(step);
                }
                window.requestAnimationFrame(step);
            }

            document.addEventListener('DOMContentLoaded', function() {
                document.querySelectorAll('.lp-15k .reveal-load').forEach(function(el) {
                    el.classList.add('is-visible');
                });
                document.querySelectorAll('.lp-15k .stat-value').forEach(function(el) {
                    animateCount(el);
                });
            });

            var revealScrollEls = document.querySelectorAll('.lp-15k .reveal-scroll');
            if ('IntersectionObserver' in window && !reduceMotion) {
                var io = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('is-visible');
                            io.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.15, rootMargin: '0px 0px -40px 0px' });
                revealScrollEls.forEach(function(el) { io.observe(el); });
            } else {
                revealScrollEls.forEach(function(el) { el.classList.add('is-visible'); });
            }
        })();
    </script>
</body>

</html>
