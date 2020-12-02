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
  <link href="<?= $document_root ?>assets/css/landing-page.css?v=3" rel="stylesheet">

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
          <a href="javascript:void(0);" class="icon" onclick="openMenu()">
            <i class="fa fa-bars"></i>
          </a>

          <ul id="movie-navbar" class="navbar-nav">
            <li class="nav-item subnav <?= $chk_act['home'] ?>">
              <a class="nav-link" href="<?=base_url()?>">หนัง <i class="fas fa-chevron-down"></i></a>
              <div class="subnav-content">
                <div class="container">
                  <div class="subnav-part">
                    <div class="subnav-part-title">Category Movie</div>
                    <ul>
                    <?php
                      if(!empty($movie_category)){
                        foreach($movie_category as $moviecate){
                          $cateurl = urlencode(str_replace(' ','-',$moviecate['category_name']));
                    ?>
                      <li><a href="<?=base_url('/category/'.$moviecate['category_id'].'/'.$cateurl)?>"><?=$moviecate['category_name']?></a></li>
                    <?php 
                        }
                      }
                    ?>
                    </ul>
                  </div>
                  <div class="subnav-part">
                    <div class="subnav-part-title subnav-link">
                      <a href="<?=base_url('/popular')?>">Popular</a>
                    </div>
                    <div class="subnav-part-title subnav-link">
                      <a href="<?=base_url('/category/28/Netflix-Movie')?>">Netflix</a>
                    </div>
                  </div>
                    
                </div>
              </div>
            </li>
            <li class="nav-item subnav <?= $chk_act['av'] ?>">
              <a class="nav-link" href="<?=base_url('/av')?>">Jav <i class="fas fa-chevron-down"></i></a>
              <div class="subnav-content">
                <div class="container">
                  <div class="subnav-part">
                    <div class="subnav-part-title">Category AV</div>
                    <ul>
                    <?php
                      if(!empty($av_category)){
                        foreach($av_category as $avcate){
                          $cateurl = urlencode(str_replace(' ','-',$avcate['category_name']));
                    ?>
                      <li><a href="<?=base_url('av/category/'.$avcate['category_id'].'/'.$cateurl)?>"><?=$avcate['category_name']?></a></li>
                    <?php 
                        }
                      }
                    ?>
                    </ul>
                  </div>
                  <div class="subnav-part">
                    <div class="subnav-part-title subnav-link">
                      <a href="<?=base_url('av/clips')?>">Clips 18+</a>
                    </div>
                  </div>
                    
                </div>
              </div>
            </li>
            <li class="nav-item <?= $chk_act['contract'] ?>">
              <a class="nav-link" href="<?php echo $contectUrl?>">ติดต่อ | ขอหนัง</a>
            </li>
          </ul>

          <a class="navbar-brand" href="<?php echo base_url() ?>">
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
          window.location.href = "<?=$urlsearch?>" + $("#movie-search").val();
        } else {
          window.location.href = "<?= base_url() ?>";
        }
      }
      function openMenu() {
        var x = document.getElementById("movie-navbar");
        if (x.style.display === "block") {
          x.style.display = "none";
        } else {
          x.style.display = "block";
        }
      }
        
    </script>