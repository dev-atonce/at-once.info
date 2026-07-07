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
            corePlugins: {
                preflight: false
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

        /* Minimal, scoped reset so Tailwind utility classes render as designed
           without disturbing the site-wide Bootstrap header/footer styling.
           :where() keeps the ".lp-15k" scope at zero specificity so these
           rules behave like Tailwind's own preflight: they lose to ANY
           Tailwind utility class (e.g. text-3xl), but still win (by source
           order) over Bootstrap's plain h1-h6/ul/button element defaults. */
        :where(.lp-15k) :where(*, *::before, *::after) {
            box-sizing: border-box;
        }

        .lp-15k {
            font-family: 'Prompt', sans-serif;
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
        
        .collapse {
            visibility: visible !important;
        }
    </style>
</head>

<body class="main_page">
    @include("$prefix.header")

    <div class="lp-15k text-slate-800 antialiased">
        <!-- BEGIN: Hero Section -->
        <header class="text-white py-20 text-center relative overflow-hidden" style="background: linear-gradient(to bottom, #172554 0%, #1e40af 100%);">
            <div class="max-w-4xl mx-auto px-4 relative z-10">
                <span class="inline-block bg-white/20 text-white text-sm px-4 py-1 rounded-full mb-6 backdrop-blur-sm">แพลตฟอร์ม B2B Matching อันดับ 1 ในไทย</span>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight mb-4">
                    อยากหาลูกค้า B2B ในไทย<br>
                    แต่ยังไม่มีเว็บไซต์?
                </h1>
                <h2 class="text-3xl md:text-4xl font-bold text-brand-yellow mb-6">
                    ไม่ใช่ปัญหาอีกต่อไป!
                </h2>
                <p class="text-lg md:text-xl text-blue-100 mb-12 max-w-2xl mx-auto">
                    AT-Once ให้ธุรกิจของคุณมีหน้าร้านออนไลน์พร้อมเข้าถึงลูกค้า B2B ไทยได้ทันที ไม่ต้องลงทุนสร้างเว็บเอง
                </p>
                <!-- Stats -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-12 py-8">
                    <div class="md:border-r md:border-white/20">
                        <div class="text-3xl font-bold text-brand-yellow mb-1">150,000+</div>
                        <div class="text-sm text-blue-200">ยอดเข้าชม/เดือน</div>
                    </div>
                    <div class="md:border-r md:border-white/20">
                        <div class="text-3xl font-bold text-brand-yellow mb-1">35,000+</div>
                        <div class="text-sm text-blue-200">ผู้ใช้จริง/เดือน</div>
                    </div>
                    <div class="md:border-r md:border-white/20">
                        <div class="text-3xl font-bold text-brand-yellow mb-1">160,000+</div>
                        <div class="text-sm text-blue-200">บริษัทในฐานข้อมูล</div>
                    </div>
                    <div>
                        <div class="text-3xl font-bold text-brand-yellow mb-1">177</div>
                        <div class="text-sm text-blue-200">หมวดธุรกิจ</div>
                    </div>
                </div>
                <!-- CTA Buttons -->
                <div class="flex flex-col sm:flex-row justify-center items-center space-y-4 sm:space-y-0 sm:space-x-4">
                    <a class="trigger-contact-popup bg-brand-orange hover:bg-brand-orange-hover text-white px-8 py-3 rounded-md font-medium text-lg flex items-center transition duration-300" href="javascript:;" aria-label="เริ่มต้นสมัครแพ็กเกจวันนี้">
                        เริ่มต้นวันนี้ <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 5l7 7m0 0l-7 7m7-7H3" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                    </a>
                    <a class="bg-transparent border border-white hover:bg-white/10 text-white px-8 py-3 rounded-md font-medium text-lg transition duration-300" href="{{ url('/') }}" aria-label="ดูตัวอย่างแพลตฟอร์ม">
                        ดูตัวอย่าง
                    </a>
                </div>
            </div>
        </header>
        <!-- END: Hero Section -->

        <!-- BEGIN: Why AT-Once Section -->
        <section class="py-20" style="background-color: #FFFEFE;">
            <div class="max-w-6xl mx-auto px-4">
                <div class="text-center mb-16">
                    <span class="text-brand-orange font-semibold text-sm tracking-wider uppercase mb-2 block">ทำไมต้อง AT-ONCE</span>
                    <h2 class="text-3xl font-bold text-brand-blue-dark mb-4">AT-Once คือแพลตฟอร์มที่เชื่อมโยง<br>ผู้ซื้อกับผู้ขาย B2B ทั่วประเทศไทย</h2>
                    <p class="text-slate-600 max-w-3xl mx-auto">เราช่วยให้ธุรกิจของคุณถูกค้นพบโดยลูกค้าที่ใช่ ด้วยโปรไฟล์บริษัทออนไลน์ที่สร้างง่าย พร้อมระบบ Inquiry โดยตรง</p>
                </div>
                <div class="grid grid-cols-1 gap-12 max-w-3xl mx-auto">
                    <!-- Feature 1 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-brand-blue mr-6"><span class="material-symbols-outlined text-3xl">storefront</span></div>
                        <div>
                            <h3 class="text-xl font-bold text-brand-blue-dark mb-2">หน้าร้านออนไลน์พร้อมใช้งานทันที</h3>
                            <p class="text-slate-600 text-sm">ไม่ต้องสร้างเว็บเอง เราจัดทำ Company Profile ให้พร้อม พร้อม Dashboard ส่วนตัวเพื่อดูสถิติได้ตลอดเวลา</p>
                        </div>
                    </div>
                    <!-- Feature 2 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-brand-blue mr-6"><span class="material-symbols-outlined text-3xl">group</span></div>
                        <div>
                            <h3 class="text-xl font-bold text-brand-blue-dark mb-2">เข้าถึงลูกค้า B2B กว่า 35,000 คน/เดือน</h3>
                            <p class="text-slate-600 text-sm">แพลตฟอร์มที่ลูกค้าไทยใช้ค้นหาซัพพลายเออร์จริง ครอบคลุม 177 หมวดธุรกิจ ทุกขนาดทุกประเภท</p>
                        </div>
                    </div>
                    <!-- Feature 3 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-brand-blue mr-6"><span class="material-symbols-outlined text-3xl">mail</span></div>
                        <div>
                            <h3 class="text-xl font-bold text-brand-blue-dark mb-2">รับ Inquiry ฟรี ไม่มีค่าใช้จ่ายเพิ่ม</h3>
                            <p class="text-slate-600 text-sm">ทีมงานคัดกรองและส่งต่อ Inquiry จากผู้ซื้อถึงทีม Sales ของคุณโดยตรง ไม่ตกหล่นทุก Lead</p>
                        </div>
                    </div>
                    <!-- Feature 4 -->
                    <div class="flex items-start">
                        <div class="flex-shrink-0 w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center text-brand-blue mr-6"><span class="material-symbols-outlined text-3xl">bar_chart</span></div>
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
                <div class="bg-white border-2 border-brand-blue rounded-2xl shadow-xl overflow-hidden mt-12 max-w-2xl mx-auto flex flex-col items-center">
                    <!-- Badge -->
                    <div class="bg-brand-orange text-white px-6 py-1 rounded-full text-sm font-bold inline-flex items-center shadow-md mb-4 mx-auto">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        แนะนำสำหรับธุรกิจที่เริ่มต้น
                    </div>
                    <div class="p-8 pt-10 text-center border-b border-gray-100">
                        <h3 class="text-2xl font-bold text-brand-blue-dark mb-4">Value Package</h3>
                        <div class="flex justify-center items-end mb-2">
                            <span class="text-5xl font-bold text-brand-blue">15,000</span>
                            <span class="text-xl text-gray-500 ml-1 font-medium pb-1">฿/ปี</span>
                        </div>
                        <p class="text-brand-orange font-medium text-sm">เฉลี่ยเพียง 43 บาทต่อวัน!</p>
                    </div>
                    <div class="p-8">
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
                        <a class="trigger-contact-popup block w-full bg-brand-blue hover:bg-brand-blue-dark text-white text-center py-3 rounded-md font-medium transition duration-300 mt-4" href="javascript:;" aria-label="สมัคร Value Package เริ่มต้นได้วันนี้">
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
                <div class="text-center mb-16">
                    <span class="text-brand-orange font-semibold text-sm tracking-wider uppercase mb-2 block">ขั้นตอน</span>
                    <h2 class="text-3xl font-bold text-brand-blue-dark mb-4">เริ่มต้นง่ายใน 3 ขั้นตอน</h2>
                    <p class="text-slate-600">ไม่ต้องมีความรู้ด้านเทคนิค เริ่มได้ทันทีภายในวันเดียว</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6 relative">
                    <!-- Connecting Line (visible on md+) -->
                    <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-gray-200 -z-10 -translate-y-1/2"></div>
                    <!-- Step 1 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm relative z-10">
                        <div class="w-12 h-12 bg-brand-blue text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4 border-4 border-white shadow-sm" style="background-color: rgb(30, 84, 161);">1</div>
                        <h3 class="font-bold text-brand-blue-dark mb-2">กรอกข้อมูลบริษัท</h3>
                        <p class="text-slate-500 text-sm">กรอกข้อมูลธุรกิจ ประเภทบริการ และข้อมูลติดต่อ</p>
                    </div>
                    <!-- Step 2 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm relative z-10">
                        <div class="w-12 h-12 bg-brand-blue text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4 border-4 border-white shadow-sm" style="background-color: rgb(30, 84, 161);">2</div>
                        <h3 class="font-bold text-brand-blue-dark mb-2">ทีมงานจัดทำโปรไฟล์</h3>
                        <p class="text-slate-500 text-sm">ทีมงาน AT-Once ออกแบบและจัดทำ Company Profile ให้</p>
                    </div>
                    <!-- Step 3 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm relative z-10">
                        <div class="w-12 h-12 bg-brand-blue text-white rounded-full flex items-center justify-center text-xl font-bold mx-auto mb-4 border-4 border-white shadow-sm" style="background-color: rgb(30, 84, 161);">3</div>
                        <h3 class="font-bold text-brand-blue-dark mb-2">เริ่มรับ Inquiry</h3>
                        <p class="text-slate-500 text-sm">โปรไฟล์ขึ้นแพลตฟอร์ม ลูกค้าเริ่มพบเจอและส่ง Inquiry ได้ทันที</p>
                    </div>
                    <!-- Step 4 -->
                    <div class="bg-white border border-gray-200 rounded-xl p-6 text-center shadow-sm relative z-10">
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
                <div class="text-center mb-12">
                    <span class="text-brand-orange font-semibold text-sm tracking-wider uppercase mb-2 block">ทำไมต้องเลือก</span>
                    <h2 class="text-3xl font-bold text-brand-blue-dark">จุดเด่นของ AT-Once</h2>
                </div>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    <!-- Highlight 1 -->
                    <div class="md:border-r md:border-gray-200 pr-6">
                        <div class="bg-white p-6 rounded-xl text-center shadow-sm border border-gray-100 h-full">
                            <div class="text-brand-blue mb-4 flex justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                            </div>
                            <h3 class="font-bold text-brand-blue-dark mb-2">Cost-Effective</h3>
                            <p class="text-slate-500 text-xs">วิธีที่คุ้มค่าที่สุดในการมี Online Presence ในไทย</p>
                        </div>
                    </div>
                    <!-- Highlight 2 -->
                    <div class="md:border-r md:border-gray-200 pr-6">
                        <div class="bg-white p-6 rounded-xl text-center shadow-sm border border-gray-100 h-full">
                            <div class="text-brand-blue mb-4 flex justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                            </div>
                            <h3 class="font-bold text-brand-blue-dark mb-2">เริ่มได้ทันที</h3>
                            <p class="text-slate-500 text-xs">ไม่ต้องรอสร้างเว็บ ไม่ต้องมีความรู้ด้านเทคนิค</p>
                        </div>
                    </div>
                    <!-- Highlight 3 -->
                    <div class="md:border-r md:border-gray-200 pr-6">
                        <div class="bg-white p-6 rounded-xl text-center shadow-sm border border-gray-100 h-full">
                            <div class="text-brand-blue mb-4 flex justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                            </div>
                            <h3 class="font-bold text-brand-blue-dark mb-2">Market Insight</h3>
                            <p class="text-slate-500 text-xs">เห็นข้อมูล Engagement ของลูกค้าไทยจาก Dashboard จริง</p>
                        </div>
                    </div>
                    <!-- Highlight 4 -->
                    <div>
                        <div class="bg-white p-6 rounded-xl text-center shadow-sm border border-gray-100 h-full">
                            <div class="text-brand-blue mb-4 flex justify-center">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                            </div>
                            <h3 class="font-bold text-brand-blue-dark mb-2">ทีมซัพพอร์ต</h3>
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
                <h2 class="text-3xl font-bold mb-4">พร้อมเริ่มต้นขยายธุรกิจสู่ตลาดไทย?</h2>
                <p class="text-blue-200 mb-8">ติดต่อเราได้เลยวันนี้ ทีมงานพร้อมช่วยคุณเริ่มต้น</p>
                <div class="inline-block bg-brand-blue-dark border-2 border-brand-yellow rounded-xl px-8 py-4 mb-8">
                    <div class="flex items-end justify-center">
                        <span class="text-4xl font-bold text-brand-yellow">15,000</span>
                        <span class="text-lg text-white ml-2 pb-1 font-medium">฿/ปี</span>
                    </div>
                    <div class="text-sm text-blue-200 mt-1">เฉลี่ยเพียง 43 บาทต่อวัน</div>
                </div>
                <div class="flex flex-wrap justify-center gap-4 mb-8">
                    <a class="flex items-center bg-white/10 hover:bg-white/20 px-6 py-2 rounded border border-white/20 transition" href="tel:0655285587">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                        065-528-5587
                    </a>
                    <a class="flex items-center bg-white/10 hover:bg-white/20 px-6 py-2 rounded border border-white/20 transition" href="mailto:marketing2@at-once.info">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                        marketing2@at-once.info
                    </a>
                    <a class="flex items-center bg-white/10 hover:bg-white/20 px-6 py-2 rounded border border-white/20 transition" href="https://at-once.info/th" target="_blank">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path></svg>
                        at-once.info/th
                    </a>
                </div>
                <button class="trigger-contact-popup bg-brand-orange hover:bg-brand-orange-hover text-white px-8 py-3 rounded-md font-bold text-lg transition duration-300" aria-label="สมัคร Value Package เลย">
                    สมัคร Value Package เลย
                </button>
            </div>
        </section>
        <!-- END: Footer CTA Section -->
    </div>

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
