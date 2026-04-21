<!doctype html>
<html lang="{{ Session('lang') }}">
<head>
    @include("$prefix.analytics.googleAnalytics")
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <title>@lang('phrase.condo.title') - At-Once</title>

    <base href="{{ url('/') }}">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/style.css?v=1">
    
    <style>
        /* ใส่ CSS เฉพาะสำหรับหน้านี้ได้ที่นี่ */
        .condo-landing-page {
            /* padding: 40px 0; */
        }
        .condo-landing-page img {
            width: 100%;
            height: auto;
            border-radius: 8px; /* ปรับได้ตามดีไซน์ */
        }
    </style>
</head>
<body class="main_page">

    <!-- เนื้อหา Landing Page เริ่มตรงนี้ -->
    <section class="page condo-landing-page bg-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center my-4">
                    <h1>@lang('phrase.condo.heading')</h1>
                    <h2>test</h2>
                    <p class="mb-4">@lang('phrase.condo.description')</p>
                    
                    <!-- ตัวอย่างการใส่รูปภาพที่มาจาก Figma (เอาไฟล์มาใส่ใน public/images/condo/) -->
                    <img src="images/condo/main-banner.webp" class="img-fluid mb-4" alt="@lang('phrase.condo.heading')">

                    <!-- ปุ่มติดต่อ หรือรายละเอียดอื่นๆ -->
                    <div class="actions">
                        <button class="btn btn-primary btn-lg">@lang('phrase.condo.contact_button')</button>
                    </div>
                </div>
            </div>
            
            <!-- ใส่ Section อื่นๆ ต่อๆ กันรูดลงไปยาวๆ ตามที่ต้องการเลยครับ -->
            <div class="row">
                <div class="col-lg-12 my-4">
                    <img src="images/condo/details-section.webp" class="img-fluid" alt="Detail Section">
                </div>
            </div>
        </div>
    </section>
    <!-- จบเนื้อหา Landing Page -->

    <script src="js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/custom.js?v=0008"></script>
</body>
</html>
