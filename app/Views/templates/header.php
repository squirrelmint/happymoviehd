<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="<?php echo $setting['setting_description']; ?>">
  <meta name="keywords" content="<?php echo $setting['setting_keyword']; ?>">

  <!-- TAG og facebook -->

	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php echo base_url(); ?>" />
	<meta property="og:title" content="<?php echo $setting['setting_title']; ?>" />
	<meta property="og:description" content="<?php echo  $setting['setting_description']; ?>" />
	<meta property="og:image" content="<?php echo $setting['setting_img']; ?>" />


	<!-- TAG og Twitter -->
	<meta name="twitter:card" content="summary" />
	<meta name="twitter:title" content="<?php echo $setting['setting_title']; ?>" />
	<meta name="twitter:description" content="<?php echo  $setting['setting_description']; ?>" />
	<meta name="twitter:image" content="<?php echo $setting['setting_img']; ?>" />
	<meta name="twitter:site" content="@ondemandacademy" />

  <title><?php echo $setting['setting_title']; ?></title>

  <link rel="icon" type="image/png" href="<?= $path_setting . $setting['setting_icon'] ?>" />

  <!-- Bootstrap core CSS -->
  <link href="<?= $document_root ?>assets/vendor/bootstrap/css/bootstrap.min.css?v=1" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="<?= $document_root ?>assets/vendor/fontawesome-free/css/all.min.css?v=1" rel="stylesheet">
  <link href="<?= $document_root ?>assets/vendor/simple-line-icons/css/simple-line-icons.css?v=1" rel="stylesheet" type="text/css">

  <!-- Swiper -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css">
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,400;0,700;1,100;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="<?= $document_root ?>assets/css/landing-page.css?v=2" rel="stylesheet">

  <?php

	if (("https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']) != ('https://' . $_SERVER['HTTP_HOST'] . '/')) {

  ?>

	<link rel="canonical" href="<?= 'https://' . $_SERVER['HTTP_HOST']?>" />

	<?php } ?>

  <!-- Bootstrap core JavaScript -->
  <script src="<?= $document_root ?>assets/vendor/jquery/jquery.min.js"></script>
  <script src="<?= $document_root ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script src="https://unpkg.com/swiper/swiper-bundle.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <?php

    if (!empty($setting['setting_header'])) {
      echo base64_decode($setting['setting_header']);
    }

  ?>

</head>

<body>
  <div id="overlay"></div>

  <header>
    <!-- Navigation -->
    <nav id="movie-menu" class="navbar navbar-expand-lg navbar-light static-top">
      <div class="container">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">

          <ul class="navbar-nav">
            <li class="nav-item <?= $chk_act['home'] ?>">
              <a class="nav-link" href="#">หนัง <i class="fas fa-chevron-down"></i></a>
            </li>
            <li class="nav-item dropdown">
              <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown"><span class="fa fa-medkit"></span> หนัง <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="#">Beauty</a></li>
                <li><a href="#">Cosmetics</a></li>
                <li><a href="#">Medicines</a></li>
              </ul>
            </li>
            <li class="nav-item <?= $chk_act['poppular'] ?>">
              <a class="nav-link" href="<?php echo base_url('popular') ?>">Jav</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo base_url('contract') ?>">ติดต่อ | ขอหนัง</a>
            </li>
          </ul>

          <a class="navbar-brand m-auto" href="<?php echo base_url() ?>">
            <img class="logo" src="<?= $path_setting . $setting['setting_logo'] ?> ">
          </a>

          <form id="movie-formsearch">
            <div class="input-group" id="adv-search">
              <?php
              if (!empty($keyword)) {
                $value = $keyword;
              } else {
                $value = '';
              }
              ?>

              <input id="movie-search" class="movie-search ml-auto" placeholder="Search..." value="<?php echo $value ?>">
              <div class="input-group-btn">
                <div class="btn-group" role="group">
                  <button type="submit" class="movie-search-button"><i class="fas fa-search"></i></button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </nav>


    <script type="text/javascript">
      $(document).ready(function() {
        $('#movie-formsearch').submit(function(e) {
          goSearch();
          return false; //<---- Add this line
        });
      });
      function goSearch() {
        var search = $.trim($("#movie-search").val())

        if (search) {
          window.location.href = "/search/" + $("#movie-search").val();
        } else {
          window.location.href = "<?= base_url() ?>";
        }
      }
        
    </script>

    <!-- Slider main container -->
    <div id="HomeSlide" class="swiper-container">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
          <!-- Slides -->

          <div class="swiper-slide">
            <div class="slider-area">
              <h2 class="title-slider">Iron man</h2>
            </div>
            <img src="<?= $document_root ?>img_slide/1.jpg">
          </div>

          <div class="swiper-slide">
            <div class="slider-area">
              <h2 class="title-slider">ALIEN</h2>
            </div>
            <img src="<?= $document_root ?>img_slide/2.jpg">
          </div>

          <div class="swiper-slide">
            <div class="slider-area">
              <h2 class="title-slider">Joker</h2>
            </div>
            <img src="<?= $document_root ?>img_slide/3.jpg">
          </div>

      </div>
      <!-- If we need pagination -->
      <div class="swiper-pagination"></div>

      <!-- If we need navigation buttons -->
      <div class="swiper-button-prev"></div>
      <div class="swiper-button-next"></div>

      <!-- If we need scrollbar -->
      <div class="swiper-scrollbar"></div>
    </div>
  </header>
