<!doctype html>
<html lang="{{ Session('lang') }}">

<head>
    @include("$prefix.analytics.googleAnalytics")
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $seo->seo_keyword ?? $seo->seo_keyword_th ?? '' }}">
    <meta name="description" content="{{ $seo->seo_description ?? $seo->seo_description_th ?? '' }}">

    <title>{{ $seo->title ?? $seo->title_th ?? __('faq.page_title') }}</title>

    <meta property="og:title" content="{{ $seo->title ?? $seo->title_th ?? __('faq.page_title') }}">
    <meta property="og:description" content="{{ $seo->seo_description ?? $seo->seo_description_th ?? '' }}">
    <meta property="og:image" content="{{ url('img/logo-bg-white.jpg') }}">
    <meta property="og:url" content="{{ url('') . '/' . Session('lang') . '/faq' }}">

    <base href="{{ url('/') }}">
    <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="fonts/icofont.css">
    <link rel="stylesheet" href="css/header-footer.css?v=0006">
    <link rel="stylesheet" href="css/style.css?v=0005">
    <link rel="stylesheet" href="css/panel-box.css?v=07">
    <link rel="stylesheet" href="css/hunterPopup.css">
    <link rel="stylesheet" href="css/validate.css">
    <link rel="stylesheet" href="css/gallery.css?v=002">
    <link href="css/aos.css" rel="stylesheet">
    <link href="css/package.css" rel="stylesheet">
</head>

<body>

    @include("$prefix.header")

    @if(app()->getLocale() == 'th')
        <div class="page-header">
            <div class="container d-block">
                <div class="row">
                    <div class="col-12">
                        <h1 class="page-header__title">คำถามที่พบบ่อยเกี่ยวกับบริการ At-Once</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="page">
            <div class="container">
                <h2><strong>FAQs: คำถามที่พบบ่อยเกี่ยวกับบริการ At-Once</strong></h2>
                <div class="col-lg-12">
                    <div class="accordion" style="max-width: 100%;">
                        <div class="accordion-item">
                            <button id="accordion-button-1" aria-expanded="true">
                                <span class="accordion-title">At-Once คืออะไร และจะช่วยธุรกิจของฉันได้อย่างไร?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    <strong>At-Once</strong> คือแพลตฟอร์มรวบรวมรายชื่อบริษัทและธุรกิจที่ใหญ่ที่สุดในไทย <strong>(มากกว่า 160,000 รายชื่อ)</strong>
                                    เราเปรียบเสมือน "ทางลัด" ที่ช่วย<strong>สร้างตัวตนออนไลน์ (Company Profile)</strong> ให้ธุรกิจของคุณถูกค้นพบได้ง่ายขึ้นบน 
                                    <strong>Google</strong> ช่วยเพิ่มความน่าเชื่อถือ และเชื่อมโยงคุณเข้ากับคู่ค้าแบบ B2B ทั่วประเทศ
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-2" aria-expanded="false">
                                <span class="accordion-title">ถ้ายังไม่มีเว็บไซต์ของตัวเอง สามารถใช้บริการ At-Once ได้ไหม?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    <strong>ได้แน่นอนครับ!</strong> นี่คือจุดเด่นของเรา แม้คุณจะไม่มีเว็บไซต์ <strong>At-Once</strong> จะสร้าง <strong>Company Profile </strong>
                                    ภายใต้ Domain ของเราให้ทันที ซึ่งมีความน่าเชื่อถือสูงและพร้อมใช้งานได้เลย
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-3" aria-expanded="false">
                                <span class="accordion-title">การฝากโปรไฟล์บริษัทมีค่าใช้จ่ายหรือไม่?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    สำหรับการฝากโปรไฟล์พื้นฐาน ไม่มีค่าใช้จ่าย คุณสามารถนำข้อมูลธุรกิจมาลงไว้เพื่อเพิ่มการมองเห็นได้ฟรี 
                                    แต่หากต้องการการโปรโมทแบบเจาะจง หรือใช้บริการ <strong>SEO ขั้นสูง</strong> เราก็มีแพ็คเกจ เพื่อเร่งประสิทธิภาพให้ธุรกิจของคุณ
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-4" aria-expanded="false">
                                <span class="accordion-title">บริการของ At-Once ช่วยเรื่อง SEO (การค้นหาบน Google) อย่างไร?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    เรามีทีมผู้เชี่ยวชาญช่วยวิเคราะห์ <strong>Keyword</strong> ที่เหมาะสมกับธุรกิจของคุณโดยเฉพาะ และปรับแต่งเนื้อหาให้ติดอันดับการค้นหาบนหน้าแรกของ 
                                    <strong>Google</strong> แบบ <strong>Organic Search</strong> ทำให้ลูกค้าที่ "กำลังมองหา" สินค้าหรือบริการของคุณจริงๆ เจอคุณเป็นอันดับต้นๆ 
                                    โดยไม่ต้องพึ่งพาการยิงโฆษณาเพียงอย่างเดียว
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-5" aria-expanded="false">
                                <span class="accordion-title">ทำไมต้องทำ SEO กับ At-Once แทนที่จะยิงโฆษณา (Ads) ปกติ?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    การยิงโฆษณาคือการจ่ายเงินเพื่อซื้อ <strong>Traffic</strong> เมื่อหยุดจ่ายคนก็ไม่เห็น แต่การทำ <strong>SEO</strong> 
                                    คือการสร้างฐานที่แข็งแกร่งในระยะยาว ช่วยลดต้นทุนค่าโฆษณา และที่สำคัญคือสร้าง <strong>"ความน่าเชื่อถือ"</strong> 
                                    เพราะลูกค้ามักจะไว้วางใจเว็บไซต์ที่ขึ้นหน้าแรกจากการค้นหาจริงมากกว่าลิงก์โฆษณา
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-6" aria-expanded="false">
                                <span class="accordion-title">ข้อมูลที่ลงไว้บน At-Once ปลอดภัยแค่ไหน?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    เราให้ความสำคัญกับความถูกต้องแม่นยำ ทุกข้อมูลผ่านกระบวนการคัดกรองและตรวจสอบอย่างละเอียด 
                                    และระบบหลังบ้านของเรามีความเสถียรภายใต้ชื่อโดเมน <strong>at-once.info</strong> ที่มีความน่าเชื่อถือและปลอดภัย
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-7" aria-expanded="false">
                                <span class="accordion-title">สนใจเริ่มใช้บริการต้องทำอย่างไร?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    ง่ายมากครับ! เพียงแค่กรอกรายละเอียดใน<a href="{{ url(Session('lang') . '/promotion-package') }}"><strong>หน้าเว็บไซต์</strong></a> หรือติดต่อทีมงานที่เบอร์ <strong>082-875-7539 </strong>
                                    ทีมงานมืออาชีพของเราพร้อมจะติดต่อกลับเพื่อพูดคุยแผนการตลาดที่เหมาะกับธุรกิจของคุณ
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @elseif(app()->getLocale() == 'jp')
        <div class="page-header">
            <div class="container d-block">
                <div class="row">
                    <div class="col-12">
                        <h1 class="page-header__title">At-Once サービスに関するよくある質問</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="page">
            <div class="container">
                <h2><strong>FAQ: At-Once サービスに関するよくある質問</strong></h2>
                <div class="col-lg-12">
                    <div class="accordion" style="max-width: 100%;">
                        <div class="accordion-item">
                            <button id="accordion-button-1" aria-expanded="true">
                                <span class="accordion-title">At-Once とは何ですか? また、At-Once は私のビジネスにどのように役立ちますか?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    At-Onceは、タイ最大の企業検索プラットフォームです（16万件以上の掲載実績）。お客様のビジネスのオンラインプレゼンス構築するため、
                                    Googleでの検索結果表示を向上させ、信頼性を高め、各地のB2Bパートナーとのマッチングを実現します。
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-2" aria-expanded="false">
                                <span class="accordion-title">まだ独自のウェブサイトを持っていなくても、At-Once サービスを利用できますか?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    <strong>もちろんです！</strong> これが当社の大きな特徴です。ウェブ サイトをお持ちでない場合でも、
                                    At-Once は当社のドメインの下に企業プロフィールの形式で企業ページ作成します。即座にご活用いただけます。
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-3" aria-expanded="false">
                                <span class="accordion-title">会社概要の提出には料金がかかりますか?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    基本の企業プロフィール登録には<strong>料金はかかりません</strong>。ビジネス情報を無料で掲載して、認知度を高めることができます。
                                    ターゲットを絞ったプロモーションや高度なSEOサービスが必要な場合は、
                                    ビジネスのパフォーマンス向上を支援するパッケージをご用意しております。
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-4" aria-expanded="false">
                                <span class="accordion-title">At-Once のサービスは SEO（Google 検索）にどのように役立ちますか?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    当社には、お客様のビジネスに最適なキーワードを分析し、
                                    コンテンツを最適化してGoogleのオーガニック検索1ページ目にランクインさせる専門家チームがいます。これにより、
                                    有料広告だけに頼ることなく、お客様の商品やサービスを真に「探している」顧客に、検索結果の上位に表示されるようになります。
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-5" aria-expanded="false">
                                <span class="accordion-title">通常の広告を掲載するのではなく、At-Once で SEO を行うのはなぜですか?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    広告を掲載するということは、トラフィックに対して料金を支払うことを意味します。料金の支払いをやめれば、
                                    人々はあなたのコンテンツを見なくなります。一方、SEOとは強固で長期的な基盤を築くことです。SEOは広告費用の削減に役立ち、
                                    最も重要なのは「信頼」を築くことです。なぜなら、顧客は広告リンクよりも検索結果の最初のページにランクインするウェブサイトを信頼する傾向があるからです。
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-6" aria-expanded="false">
                                <span class="accordion-title">At-Once に入力されたデータはどの程度安全ですか?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    私たちは正確性を重視しています。すべてのデータは厳格な審査と検証を受けており、バックエンドシステムは安定しており、
                                    国際的に認められたAt-Onceドメイン名で運用されています。
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-7" aria-expanded="false">
                                <span class="accordion-title">サービスの利用を始めるには何をする必要がありますか?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    とても簡単です！ウェブサイトで詳細を入力するか、下記の電話番号までお問い合わせください。
                                    <strong>082-875-7539</strong> 当社の専門チームがお客様にご連絡し、適切なマーケティング プランについてご相談させていただきます。
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @else
        <div class="page-header">
            <div class="container d-block">
                <div class="row">
                    <div class="col-12">
                        <h1 class="page-header__title">Frequently Asked Questions about At-Once Service</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="page">
            <div class="container">
                <h2><strong>FAQ: Frequently Asked Questions about At-Once Service</strong></h2>
                <div class="col-lg-12">
                    <div class="accordion" style="max-width: 100%;">
                        <div class="accordion-item">
                            <button id="accordion-button-1" aria-expanded="true">
                                <span class="accordion-title">What is At-Once, and how can it help my business?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    At-Once is Thailand's largest directory platform for companies and businesses 
                                    (over 160,000 listings). We act as a "shortcut" to help create an online presence 
                                    (Company Profile) for your business, making it easier to be found on Google, 
                                    increasing credibility, and connecting you with B2B partners nationwide.
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-2" aria-expanded="false">
                                <span class="accordion-title">If I don't have my own website yet, can I still use the At-Once service?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    <strong>Absolutely!</strong> This is our key feature, even if you don't have a website, 
                                    At-Once will instantly create a “Company Profile" under our domain, 
                                    which is highly reliable and ready to use.
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-3" aria-expanded="false">
                                <span class="accordion-title">Is there a fee for submitting a company profile?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                     For basic profile registration <strong>“there is no charge”</strong> you can post your business 
                                     information here to increase visibility for free. However, if you need targeted promotion 
                                     on advanced SEO services, we have packages to accelerate your business's performance.
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-4" aria-expanded="false">
                                <span class="accordion-title">How does At-Once's service help with SEO (Google Search)?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    We have an expert team who will <strong>analyze</strong> keywords specifically suited for your business 
                                    and <strong>optimize</strong> your content to rank on the first page of Google organic search. 
                                    This ensures that customers who are genuinely <strong>"looking for"</strong> your products or 
                                    services find you at the top, without relying solely on paid advertising.
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-5" aria-expanded="false">
                                <span class="accordion-title">Why do SEO with At-Once instead of running regular ads?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    Running advertising means paying for traffic when you stop paying, 
                                    people stop seeing your content. <strong>SEO</strong>, on the other hand, 
                                    is about building a <strong>strong</strong> and <strong>long-term</strong> foundation. 
                                    It helps reduce advertising costs and most importantly builds <strong>"trust"</strong> 
                                    because customers tend to trust websites that rank on the first page of search 
                                    results more than advertised links.
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-6" aria-expanded="false">
                                <span class="accordion-title">How secure is the data entered on At-Once?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    We prioritize accuracy, all data undergoes rigorous screening and verification, 
                                    and our backend system is stable and operated under the internationally recognized 
                                    at-once.info domain name.
                                </p>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <button id="accordion-button-7" aria-expanded="false">
                                <span class="accordion-title">What do I need to do to start using the service?</span>
                                <span class="icon" aria-hidden="true"></span>
                            </button>
                            <div class="accordion-content">
                                <p class="mb-0">
                                    It's very easy! Just fill in the details on the <a href="{{ url(Session('lang') . '/promotion-package') }}"><strong>website</strong></a>
                                    or contact our team at the number <strong>082-875-7539</strong>. 
                                    Our professional team is ready to contact you to discuss a suitable marketing plan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    @include("$prefix.footer")

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery-popup.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=0001"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    <script type="text/javascript" src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>
    <script src="js/aos.js"></script>
    <script>AOS.init();</script>
    <script>
        const items = document.querySelectorAll(".accordion button");
        function toggleAccordion() {
            const itemToggle = this.getAttribute('aria-expanded');
            if (itemToggle == 'false') {
                this.setAttribute('aria-expanded', true);
            } else {
                this.setAttribute('aria-expanded', false);
            }
        }
        items.forEach(item => item.addEventListener('click', toggleAccordion));
    </script>
</body>

</html>
