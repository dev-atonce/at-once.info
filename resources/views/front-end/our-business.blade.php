<!doctype html>
<html lang="{{Session('lang')}}">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>เกี่ยวกับเว็บไซต์ - {{env('APP_NAME')}}</title>

  <base href="{{url('/')}}">
  <link href="img/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" />
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="fonts/icofont.css">
  <link rel="stylesheet" href="css/header-footer.css?v=0006">
  <link rel="stylesheet" href="css/style.css?v=0005">
  <link rel="stylesheet" href="css/filter.css?v=0003">
  <link rel="stylesheet" href="css/panel-box.css?v=07">
  <link rel="stylesheet" href="css/hunterPopup.css">
  <link rel="stylesheet" href="css/validate.css">
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <style>
    input[type="email"].error,
    input[type="password"].error{
      border:1px solid #f00;
    }
    input[type="email"].error:focus,
    input[type="password"].error:focus
    {
      box-shadow: 0 0 0 0.2rem rgb(255,0,0,0.25) !important;
    }

  </style>
</head>
<body>

  @include("$prefix.header")

  <div class="page-header">
    <div class="container d-block">
      <div class="row">
        <div class="col-12">
          <h1 class="page-header__title">เกี่ยวกับเว็บไซต์</h1>
      </div>
    </div>
  </div>
</div>

<section class="page">
  <div class="container">



  </div>
</section>


@include("$prefix.footer")

<script src="js/jquery.js"></script>
<!-- Optional JavaScript -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-popup.js"></script>

</body>
</html>
