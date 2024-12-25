<!doctype html>
<html lang="{{ Session('lang') }}">

<head>
    @include("$prefix.analytics.googleAnalytics")
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="{{ $seo->seo_keyword ? $seo->seo_keyword : $seo->seo_keyword_th }}">
    <meta name="description" content="{{ $seo->seo_description ? $seo->seo_description :  $seo->seo_description_th }}">

    <title>{{ $seo->title ? $seo->title : $seo->title_th }}</title>

    <meta property="og:title" content="{{ $seo->title ? $seo->title : $seo->title_th }}">
    <meta property="og:description" content="{{ $seo->seo_description ? $seo->seo_description :  $seo->seo_description_th }}">
    <meta property="og:image" content="{{ url('img/logo-bg-white.jpg') }}">
    <meta property="og:url" content="{{ url('') . '/' . Session('lang') . '/privacy-policy' }}">

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
    <style>
        input[type="email"].error,
        input[type="password"].error {
            border: 1px solid #f00;
        }

        input[type="email"].error:focus,
        input[type="password"].error:focus {
            box-shadow: 0 0 0 0.2rem rgb(255, 0, 0, 0.25) !important;
        }
    </style>
</head>

<body>

    @include("$prefix.header")

    <div class="page-header">
        <div class="container d-block">
            <div class="row">
                <div class="col-12">
                    <h1 class="page-header__title">
                        นโยบายคุ้มครองข้อมูลส่วนบุคคล
                    </h1>

                    <!--     <div class="page-header__breadcrumb">

            <ol class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="#" class="breadcrumb-link">
                 หน้าหลัก
               </a>
             </li>

             <li class="breadcrumb-item">
              <a href="javascript:void(0);" class="breadcrumb-link">
                นโยบายคุ้มครองข้อมูลส่วนบุคคล
              </a>
            </li>

          </ol>
        </div> -->
                </div>
            </div>
        </div>
    </div>

    <section class="page">
        <div class="container">
          <h2><strong> นโยบายคุ้มครองข้อมูลส่วนบุคคล (Privacy Policy)</strong></h2>
          <h3><strong> 1. คำจำกัดความ</strong></h3>
      
          <p class="pl-4"><strong>“ท่าน”</strong> หมายถึง ผู้ใช้บริการเว็บไซต์</p>
          <p class="pl-4"><strong>“เรา”</strong> หมายถึง เว็บไซต์แอท-วันซ์ ซึ่งจัดทำโดยบริษัท ฮิโรอะ ไทย จำกัด</p>
          <p class="pl-4"><strong>“เว็บไซต์”</strong> หมายถึง เว็บไซต์ และ/หรือแอปพลิเคชันต่าง ๆ เราเป็นผู้ให้บริการทั้งในปัจจุบันและที่เราได้แก้ไข เปลี่ยนแปลง ปรับปรุง อัพเดต หรือพัฒนาขึ้นใหม่เพิ่มเติมในอนาคต</p>
          <p class="pl-4"><strong>“ข้อมูลส่วนบุคคล”</strong> หมายถึง ข้อมูลเกี่ยวกับบุคคลซึ่งทำให้สามารถระบุตัวบุคคลนั้นได้ไม่ว่าทางตรงหรือทางอ้อม ตามกฎหมายว่าด้วยการคุ้มครองข้อมูลส่วนบุคคล</p>
          <p class="pl-4"><strong>“คุกกี้ (cookie)”</strong> หมายถึง ไฟล์ข้อความที่เว็บไซต์เราได้สร้างขึ้นสำหรับดาวน์โหลดลงในอุปกรณ์คอมพิวเตอร์ แท็บเล็ต หรือโทรศัพท์เคลื่อนที่ที่ท่านใช้เพื่อการเข้าเว็บไซต์ โดยคุกกี้หรือไฟล์ข้อความดังกล่าวจะทำหน้าที่บันทึกข้อมูลและการตั้งค่าต่าง ๆ เพื่อช่วยให้ท่านสามารถเข้าใช้งานเว็บไซต์ได้อย่างต่อเนื่องและสะดวกรวดเร็ว รวมถึงมีการรวบรวมข้อมูลเกี่ยวกับประวัติการเข้าชมเว็บไซต์ที่ท่านชื่นชอบในรูปแบบไฟล์ ซึ่งจะเป็นประโยชน์ต่อการพัฒนาบริการให้เป็นที่พึงพอใจแก่ท่าน โดยคุกกี้ไม่ได้ทำให้เกิดอันตรายต่ออุปกรณ์ของท่าน และเนื้อหาในคุกกี้จะถูกเรียกออกมาดูหรืออ่านได้โดยเว็บไซต์ที่สร้างคุกกี้ดังกล่าวเท่านั้น
          </p>
      
          <h3><strong> 2. ข้อสงวนสิทธิในนโยบายคุ้มครองข้อมูลส่วนบุคคล</strong></h3>
          <p class="pl-4">นโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ เราจัดทำขึ้นเพื่อให้ท่านรับทราบ เข้าใจ และยอมรับตกลงว่า เราตระหนักถึงความสำคัญแก่ความเป็นส่วนตัวในข้อมูลส่วนบุคคลของท่าน แต่เรายังคงสามารถแก้ไขปรับปรุงนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ได้เพื่อให้สอดคล้องกับการให้บริการของเรา โดยไม่จำเป็นต้องแจ้งหรือบอกกล่าวให้ท่านทราบล่วงหน้า
          </p>
      
          <h3><strong> 3. การเก็บรวบรวมข้อมูลส่วนบุคคล</strong></h3>
          <p class="pl-4">เพื่อประโยชน์ของท่านในการใช้บริการต่าง ๆ ของเราผ่านเว็บไซต์ รวมตลอดทั้งเพื่อการปรับปรุงพัฒนาผลิตภัณฑ์หรือบริการของเราให้เป็นที่พึงพอใจแก่ท่าน ข้อมูลส่วนบุคคลที่ท่านส่งให้แก่เราโดยตรงในขณะลงทะเบียนสมัครใช้บริการ หรือตอบแบบสอบถาม แบบสำรวจ หรือเข้าร่วมกิจกรรมอื่นใดของเรา เช่น ชื่อ-นามสกุล เบอร์โทรศัพท์ อีเมล์แอดเดรส สถานที่ตั้งหรือภูมิลำเนา เลขที่บัญชีเงินฝาก หมายเลขบัตรเครดิต หมายเลขบัตรประจำตัวประชาชน เลขประจำตัวผู้เสียภาษีอากร ฯลฯ และ/หรือ จากการที่ท่านใช้งานหรือใช้บริการของเราบนเว็บไซต์ และ/หรือ จากการรวบรวมผ่านคุกกี้ หรือเทคโนโลยีอื่นใด เช่น ข้อมูลบันทึกการเข้าสู่ระบบ (Login Log) ข้อมูลรายการการทำธุรกรรม (Transaction Log) พฤติกรรมการใช้งาน (Customer Behavior) ข้อมูลจราจรทางคอมพิวเตอร์ (Log) ข้อมูลการติดต่อและสื่อสารระหว่างท่านและผู้ใช้งานรายอื่น ข้อมูลเกี่ยวกับอุปกรณ์ หมายเลข IP ของคอมพิวเตอร์ รหัสประจำตัวอุปกรณ์ ข้อมูลเครือข่ายโทรคมนาคม ข้อมูลการเชื่อมต่อ ข้อมูลระบุตำแหน่งหรือพิกัดทางภูมิศาสตร์ ข้อมูลเว็บไซต์ เบราว์เซอร์ (Browser) สถิติการเข้าเว็บไซต์ เวลาที่เยี่ยมชมเว็บไซต์ (Access Time) ข้อมูลที่ท่านค้นหา การใช้ฟังก์ชันต่าง ๆ ในเว็บไซต์ เราจะเก็บรวบรวมข้อมูลส่วนบุคคลของท่านเฉพาะข้อมูลที่จำเป็น และในระยะเวลานานเท่าที่จำเป็นเพื่อประโยชน์ต่าง ๆ ดังกล่าวข้างต้นและที่ระบุไว้ในนโยบายฉบับนี้
          </p>
      
      
          <h3><strong> 4.  การใช้ข้อมูลส่วนบุคคล</strong></h3>
          <p class="pl-4">เราจะนำข้อมูลส่วนบุคคลไปใช้ในวัตถุประสงค์ดังต่อไปนี้</p>
          <p class="pl-4">4.1 เพื่อให้การใช้บริการเป็นไปด้วยความเรียบร้อยและสอดคล้องกับกฎหมาย หลักเกณฑ์ และระเบียบต่าง ๆ ที่เกี่ยวข้อง</p>
          <p class="pl-4">4.2 เพื่อการระบุและยืนยันตัวตนของท่านในการเข้าใช้บริการต่างๆ ของเรา</p>
          <p class="pl-4">4.3 เพื่อการพัฒนามาตรฐานความมั่นคงปลอดภัยในการใช้บริการ การจัดการและการคุ้มครองโครงสร้างพื้นฐานทางเทคโนโลยีสารสนเทศ โดยในส่วนนี้เราจะดำเนินการเพียงเท่าที่จำเป็นและอาจดำเนินการให้มีการเข้ารหัส (Encrypt) ก่อนนำข้อมูลส่วนบุคคลของท่านไปใช้ และ/หรือ จัดให้มีการสุ่มตรวจ หรือทดสอบโดยบุคคลอื่นเพื่อบริหารจัดการความเสี่ยง หรือเพื่อการอื่นใดที่อาจเป็นการละเมิดกฎหมาย ระเบียบการใช้งานที่เกี่ยวข้อง หรือข้อตกลงและเงื่อนไขการใช้งานเว็บไซต์ (“ข้อตกลงและเงื่อนไขการใช้”) ของเรา</p>
          <p class="pl-4">4.4 เพื่อการพัฒนาหรือเพิ่มประสิทธิภาพการให้บริการของเราแก่ท่าน</p>
          <p class="pl-4">4.5 เพื่อการติดต่อสื่อสารกับท่านในช่องทางต่าง ๆ ซึ่งไม่จำกัดแต่เฉพาะทางโทรศัพท์ ข้อความ (SMS) อีเมล หรือไปรษณีย์ หรือผ่านช่องทางใด ๆ เพื่อสอบถาม หรือแจ้งให้ท่านทราบ หรือตรวจสอบและยืนยันข้อมูลเกี่ยวกับบัญชีของท่าน ที่เกี่ยวข้องกับการให้บริการของเราตามที่จำเป็น</p>
          <p class="pl-4">4.6 เพื่อประโยชน์อื่นใดที่เกี่ยวข้องกับการดำเนินธุรกิจของเรา เช่น การโฆษณาประชาสัมพันธ์ การศึกษา วิจัย รวบรวมจัดทำสถิติ ตลอดจนการให้คำแนะนำต่าง ๆ เกี่ยวกับการให้บริการต่าง ๆ ของเราแก่ท่าน</p>
      
          <h3><strong> 5. การเปิดเผยข้อมูลส่วนบุคคลต่อบุคคลภายนอก</strong></h3>
          <p class="pl-4">เราจะไม่เปิดเผยข้อมูลส่วนบุคคลของท่านต่อบุคคลภายนอกเว้นแต่จะได้รับความยินยอมจากท่าน หรือ เพื่อประโยชน์ในการให้บริการตามเว็บไซต์ของเราแก่ท่าน ซึ่งท่านรับทราบและยินยอมให้เราเปิดเผยข้อมูลส่วนบุคคลของท่านให้กับบริษัทในกลุ่ม รวมทั้งบุคคลซึ่งทำงานร่วมกับเรา หรือบุคคลอื่นทั้งในและต่างประเทศ (“ผู้สนับสนุน”) อย่างไรก็ดี ในการดำเนินการดังกล่าว เราจะดำเนินการให้บุคคลเหล่านั้นเก็บรักษาข้อมูลส่วนบุคคลของท่านไว้เป็นความลับโดยจะไม่นำข้อมูลส่วนบุคคลของท่านไปใช้เพื่อวัตถุประสงค์อื่นนอกเหนือจากขอบเขตที่เราได้กำหนดไว้</p>
      
          <p class="pl-4">ทั้งนี้ ในกรณีที่ท่านไม่ประสงค์ให้เราเปิดเผยข้อมูลส่วนบุคคลของท่านต่อผู้สนับสนุน ท่านสามารถแจ้งเราระงับการดำเนินการดังกล่าวได้ แต่ทั้งนี้ เราไม่สามารถยืนยันหรือรับรองได้ว่า ผลของการที่เราระงับการเปิดเผยข้อมูลส่วนบุคคลของท่านแก่ผู้สนับสนุนจะกระทบต่อการใช้บริการของท่านกับเราหรือไม่อย่างไร เนื่องจากการให้บริการของเราแก่ท่านอาจจำเป็นต้องให้ข้อมูลส่วนบุคคลของท่านเท่าที่จำเป็นแก่ผู้สนับสนุน ดังนั้น ท่านจึงควรใช้ความระมัดระวังหรืออาจขอคำแนะนำจากเราได้</p>
      
          <p class="pl-4">นอกจากนี้ เราอาจเปิดเผยข้อมูลส่วนบุคคลของท่านในกรณีที่มีการปรับโครงสร้างองค์กร การควบรวมบริษัท หรือการขายกิจการ เราอาจถ่ายโอนข้อมูลส่วนบุคคลของท่านไม่ว่าทั้งหมดหรือบางส่วนที่เราเก็บรวบรวมไว้ไปยังบริษัทที่เกี่ยวข้อง</p>
      
      
          <h3><strong> 6. การลบข้อมูลส่วนบุคคล</strong></h3>
          <p class="pl-4">โดยที่ข้อมูลส่วนบุคคลของท่านเป็นสาระสำคัญในการใช้บริการบนเว็บไซต์ของเรา ดังนั้น ในกรณีที่ท่านไม่ยินยอมให้เราใช้ข้อมูลส่วนบุคคลของท่าน หรือให้เราดำเนินการลบข้อมูลส่วนบุคคลของท่านออกจากระบบของเราไม่ว่าทั้งหมดหรือบางส่วน อาจทำให้ท่านไม่สามารถเข้าบริการจากเราได้ หรืออาจใช้บริการได้ไม่เต็มประสิทธิภาพ ซึ่งเราไม่มีหน้าที่หรือความรับผิดใด ๆ ต่อท่านทั้งสิ้น ในกรณีที่ท่านต้องการกลับมาใช้บริการบนเว็บไซต์ของเราให้มีประสิทธิภาพเหมือนดังปกติ ท่านอาจจะต้องให้ข้อมูลส่วนบุคคลแก่เราใหม่ทั้งหมด หรือดำเนินการตามคำแนะนำที่เรากำหนดให้ท่านปฏิบัติ</p>
      
      
          <p class="pl-4">อนึ่ง ในกรณีที่ท่านขอให้เราลบข้อมูลส่วนบุคคลของท่านจากระบบนั้น เราจะใช้ความพยายามอย่างเต็มที่เพื่อดำเนินการลบข้อมูลของท่านออกจากระบบด้วยเทคโนโลยีและความสามารถของระบบงานในปัจจุบัน อย่างไรก็ดี หากข้อมูลดังกล่าวอาจจะยังคงได้รับการบันทึกหรือทำสำเนาไว้ที่เซิร์ฟเวอร์ (Server) หรือระบบสำรอง (Backup System) ของเรา อันเป็นข้อจำกัดทางเทคโนโลยี ไม่ถือว่าเราปฏิบัติฝ่าฝืนความประสงค์ของท่านแต่อย่างใด และให้ถือว่าเราได้ดำเนินการตามความประสงค์ของท่านแล้ว</p>
      
          <p class="pl-4">ในกรณีที่ท่านมีข้อสังสัยในการที่เราเก็บรวบรวม ใช้ และ/หรือ เปิดเผยข้อมูลส่วนบุคคลของท่าน <br>
            ท่านสามารถติดต่อสอบถามจากเราได้ที่ <a href="mailto:marketing@at-once.info"> marketing@at-once.info </a>  
            &nbsp;&nbsp; โทรศัพท์หมายเลข <a href="tel:021266625"> 02-126-6625</a> </p>
      
            <h3><strong> 7. ติดต่อเรา</strong></h3>
            <p class="pl-4">หากท่านมีข้อสงสัยหรือคำถามเกี่ยวกับนโยบายคุ้มครองข้อมูลส่วนบุคคล ท่านสามารถติดต่อ Admin ได้ตามช่องทางดังนี้<br>
            <a href="mailto:marketing@at-once.info"> marketing@at-once.info </a>  หรือ โทรศัพท์หมายเลข<a href="tel:021266625"> 02-126-6625</a></p>
      
            <h3><strong> 8. การใช้บังคับนโยบายคุ้มครองข้อมูลส่วนบุคคล</strong></h3>
            <p class="pl-4">นโยบายคุ้มครองข้อมูลส่วนบุคคลนี้ให้มีผลใช้บังคับกับข้อมูลส่วนบุคคลทั้งหมดที่เราเป็นผู้เก็บรวบรวมทั้งในปัจจุบันและอนาคต ซึ่งท่านตกลงให้เรามีสิทธิในการเก็บรวบรวม รักษา และนำข้อมูลส่วนบุคคลของท่านที่เราได้รวบรวมไว้ดังกล่าวไปใช้ หรือเปิดเผยแก่บุคคลอื่นได้ ภายในขอบเขตตามที่ระบุไว้ในนโยบายคุ้มครองข้อมูลส่วนบุคคลนี้</p>
            <br>
            <p class="text-right">ข้อกำหนด ณ วันที่ 30 กันยายน ปี 2020</p>
      
      
          </div>
        </section>


    @include("$prefix.footer")

    <script src="js/jquery.js"></script>
    <!-- Optional JavaScript -->

    <script src="js/bootstrap.min.js"></script>

    <script src="js/jquery-popup.js"></script>
    <script src="js/jquery.mCustomScrollbar.concat.min.js"></script>

    <script type="text/javascript" src="js/custom.js?v=0001"></script>
    <script type="text/javascript" src="js/jquery.validate-v1.18.js"></script>
    <script type="text/javascript" src="js/build/authentication.js"></script>
    <script type="text/javascript" src="js/js.device.detector-master/dist/jquery.device.detector.js"></script>

    <script src="js/aos.js"></script>

    <script>
        AOS.init();


        (function(i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function() {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o),
                m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-21041420-11', 'auto');
        ga('send', 'pageview');


        /*
         *  Parallax-Scroll - v0.2.0
         *  jQuery plugin for background-attachment: scroll with friction, similar to the parallax scrolling effect on Spotify.
         *  http://parallax-scroll.aenism.com
         *
         *  Made by Aen Tan
         *  Under MIT License
         */
        $(function() {
            $(".bg-holder").parallaxScroll({
                friction: .5,
                direction: "vertical"
            })
        });



        /*
         *  Parallax-Scroll - v0.2.0
         *  jQuery plugin for background-attachment: scroll with friction, similar to the parallax scrolling effect on Spotify.
         *  http://parallax-scroll.aenism.com
         *
         *  Made by Aen Tan
         *  Under MIT License
         */
        ! function(a, b) {
            "function" == typeof define && define.amd ? define(["jquery"], b) : b(a.jQuery)
        }(this, function(a) {
            "use strict";
            var b, c = {
                    friction: .5,
                    direction: "vertical"
                },
                d = a(window),
                e = 0;
            return window.requestAnimationFrame = function(a) {
                var b = (new Date).getTime(),
                    c = Math.max(0, 5 - (b - e)),
                    d = window.setTimeout(function() {
                        a(b + c)
                    }, c);
                return e = b + c, d
            }, b = function(b, e) {
                return {
                    init: function() {
                        this.$background = a(b), this.settings = a.extend({}, c, e), this._initStyles(), this
                            ._bindEvents()
                    },
                    _initStyles: function() {
                        this.$background.css({
                            "background-attachment": "scroll"
                        })
                    },
                    _visibleInViewport: function() {
                        var a = d.height(),
                            b = this.$background.get(0).getBoundingClientRect();
                        return b.top < a && b.bottom > 0 || b.bottom <= a && b.top > a
                    },
                    _bindEvents: function() {
                        var a = this;
                        d.on("load scroll resize", function() {
                            a._requestTick()
                        })
                    },
                    _requestTick: function() {
                        var a = this;
                        this.ticking || (this.ticking = !0, requestAnimationFrame(function() {
                            a._updateBgPos()
                        }))
                    },
                    _updateBgPos: function() {
                        if (this._visibleInViewport()) {
                            var a = d.width(),
                                b = d.height(),
                                c = this.$background.data("width"),
                                e = this.$background.data("height"),
                                f = c / e,
                                g = this.$background.width(),
                                h = this.$background.height(),
                                i = g / h,
                                j = f > i,
                                k = g / c,
                                l = e * k,
                                m = c * k,
                                n = this.$background.offset().top,
                                o = d.scrollTop(),
                                p = o - n,
                                q = b + l,
                                r = a + m,
                                s = p * (b / q),
                                t = p / b,
                                u = p * (a / r),
                                v = p / a,
                                w = (b - h) / 2;
                            w = j ? w * t : w;
                            var x = (a - g) / 2;
                            x = j ? x : x * v;
                            var y, z, A = j ? 2 * this.settings.friction * i : this.settings.friction * i;
                            "horizontal" === this.settings.direction ? (y = j ? a + "px auto" : "auto " + b +
                                "px", z = x - u * A + "px 50%") : (y = j ? "auto " + b + "px" : a +
                                "px auto", z = "50% " + (s * A - w) + "px"), this.$background.css({
                                "background-size": y,
                                "background-position": z
                            })
                        }
                        this.ticking = !1
                    }
                }
            }, b.defaults = c, a.fn.parallaxScroll = function(a) {
                return this.each(function() {
                    new b(this, a).init()
                })
            }, b
        });
    </script>

</body>

</html>
