<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>at−once</title>
  <!-- <link href="images/favicon.ico?v=1001" rel="shortcut icon" type="image/x-icon" /> -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="fonts/icofont.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link href="css/style.css" rel="stylesheet">
  <link href="css/panel-box.css" rel="stylesheet">

</head>
<body>

 <?php include("header.php");?>

 <div class="layout-bannerinsite" style="background-image: url(images/cover-nav.jpg);">
    <span class="layout-bannerinsite-shadow"></span>
  <div class="text-on-banner">
    <div class="container">
      <div class="headline-banner">
        <h2>Blogs</h2>
      </div>
    </div>
  </div>
</div>

<?php include("navigation.php");?>

<section class="page">
  <div class="container">

    <h2 class="bold">At Once Blogs</h2>
    <h5 class="mb-4 text-orange">เรื่องราวดีๆ ที่เราคัดสรรมาบอกคุณ</h5>

    <div class="row">
      <div class="col-lg-8">
        <div class="blog-container-first" href="https://codetheweb.blog/2017/10/06/html-syntax/" style="background-image: url(upload/ship-drydock_1398-242.jpg);">
          <span class="card-other-title-shadow"></span>
          <div class="blog-body">
            <div class="blog-title">
             <a href="blog-detail.php">
              <h5 class="bold">69 ปี การท่าเรือแห่งประเทศไทย (กทท.)กับบทบาทศูนย์กลางขนส่งทางน้ำเชื่อมเศรษฐกิจไทยสู่โลก</h5>
            </a>
          </div>
          <div class="blog-tags">
            <ul>
              <li><a href="#">css</a></li>
              <li><a href="#">web design</a></li>
              <li><a href="#">codepen</a></li>
              <li><a href="https://twitter.com/russbeye">twitter</a></li>
            </ul>
          </div>
          <div class="blog-footer">
            <ul>
              <li class="published-date">01 ต.ค. 63</li>
              <li class="comments"><a href="#"><i class="icofont-eye-alt"></i> 4</a></li>
              <li class="shares"><a href="#"><i class="icofont-share"></i> share</a></li>
            </ul>
          </div>
        </div>
      </div>
    </div>


    <?php for($i=1;$i<=10;$i++){ ?>
      <div class="col-lg-4">
        <div class="blog-container">
          <div class="blog-header">
            <div class="blog-cover">
              <a href="blog-detail.php"><img src="upload/ship-drydock_1398-242.jpg"></a>
            </div>
          </div>
          <div class="blog-body">
            <div class="blog-title">
              <a href="#">
                <h5>69 ปี การท่าเรือแห่งประเทศไทย (กทท.)กับบทบาทศูนย์กลางขนส่งทางน้ำเชื่อมเศรษฐกิจไทยสู่โลก</h5>
              </a>
            </div>
            <div class="blog-tags">
              <ul>
                <li><a href="#">css</a></li>
                <li><a href="#">web design</a></li>
                <li><a href="#">codepen</a></li>
                <li><a href="https://twitter.com/russbeye">twitter</a></li>
              </ul>
            </div>
          </div>
          <div class="blog-footer">
            <ul>
              <li class="published-date">01 ต.ค. 63</li>
              <li class="comments"><a href="#"><i class="icofont-eye-alt"></i> 4</a></li>
              <li class="shares"><a href="#"><i class="icofont-share"></i> share</a></li>
            </ul>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>

  <div class="container middle mt-2 mb-5">
    <center>
      <div class="pagination row">
        <ul>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li class="active"><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
          <li><a href="#"></a></li>
        </ul>
      </div>
    </center>
  </div>


</div>
</section>

<?php include("footer.php");?>

<script src="js/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/materialize.min.js"></script>
<script src="js/custom.js"></script>

</body>
</html>


