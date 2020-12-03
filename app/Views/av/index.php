
  <section class="movie-content text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 ">
          <h1>HAPPYMOVIE</h1>
          <h2>หนังใหม่ ดูหนังออนไลน์ครบเรื่องทุกรสที่ HAPPYMOVIE</h2>
        </div>
      </div>
    </div>
  </section>

  <section id="movie-banners" class="text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 ">
        <?php
          if( !empty($adstop) ){
            foreach($adstop as $ads){
              if(substr($ads['ads_picture'], 0, 4) == 'http'){
                $ads_picture = $ads['ads_picture'];
              }else{
                $ads_picture = $path_ads . $ads['ads_picture'];
              }
        ?>
          <a onclick="onClickAds(<?= $ads['ads_id']; ?>, <?= $branch ?>)" href="<?=$ads['ads_url']?>" alt="<?=$ads['ads_name']?>" title="<?=$ads['ads_name']?>">
            <img class="banners" src="<?=$ads_picture?>" alt="<?=$ads['ads_name']?>" title="<?=$ads['ads_name']?>">
          </a>
        <?php
            }
          }
        ?>
    
        </div>
      </div>
    </div>
  </section>

  <section class="av-popular text-center">
    <div class="container">
      <div class="row">
        <div class="col-12 bg-popular">

          <div class="av-title-list">
            <h1>NEW MOVIES OF THE WEEK</h1>
          </div>

          <div id="Popular" class="swiper-container">
            <div class="swiper-wrapper">

              <?php 
                foreach($popular as $val){ 
              ?>

                <div class="swiper-slide">
                  <div class="av-box">

                    <?php if (substr($val['movie_picture'], 0, 4) == 'http') {
                      $movie_picture = $val['movie_picture'];
                    } else {
                      $movie_picture = $path_thumbnail . $val['movie_picture'];
                    }

                    $url_name = urlencode(str_replace(' ', '-', $val['movie_thname']));
                    ?>

                    <a onclick="goView('<?= $val['movie_id'] ?>', '<?=$url_name?>' , '<?=$val['movie_type']?>')" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
                      <img src="<?= $movie_picture ?>" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
                      <div class="av-overlay"></div>
                    </a>

                    <?php
                      if (!($val['movie_view'])) {
                        $view = 0;
                      } else if (strlen($val['movie_view']) >= 5) {
                        $view =  substr($val['movie_view'], 0, -3) . 'k';
                      } else {
                        $view = $val['movie_view'];
                      }
                    ?>
                    <span class="av-view"><?=$view?> <i class="fas fa-eye"></i> <span class="triangle"></span></span>

                  </div>
                  <div class="title-in">
                    <h2>
                      <a onclick="goView('<?= $val['movie_id'] ?>', '<?=$url_name?>', '<?=$val['movie_type']?>')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $val['movie_thname'] ?></a>
                    </h2>
                    
                    <div class="av-score">
                    <?php
                      if( !empty($val['movie_ratescore']) && $val['movie_ratescore'] != 0 ){
                        $score = $val['movie_ratescore'];
                        if( strpos($score,'.') ){
                          $score = substr($score,0,3);
                        }else{
                          $score = substr($score,0);
                        }
                    ?>
                      <i class="fas fa-star"></i> <?=$score?>
                    <?php
                      } 
                    ?>
                    </div>
                  </div>
                </div>
              
              <?php } ?>

            </div>
              
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev swiper-button-white"></div>
            <div class="swiper-button-next swiper-button-white"></div>

          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- Icons Grid -->
  <section class="text-center">
    <div class="container">
      <div class="row">
        <ul id="menuMobile" class="nav nav-pills">
          <li><a data-toggle="tab" href="#mb-home" class="active" >New</a></li>
          <li><a data-toggle="tab" href="#mb-category">Category</a></li>
          <li><a href="<?=base_url('av/clips');?>">Clips</a></li>
        </ul>
        
        <div class="tab-content">
          <div id="mb-home" class="tab-pane fade in active show">
            <ul id="list-av" class="list-av">

              <?PHP
              foreach ($list['list'] as $val) {
              ?>
                <li>
                  <div class="av-box">

                    <?php if (substr($val['movie_picture'], 0, 4) == 'http') {
                      $movie_picture = $val['movie_picture'];
                    } else {
                      $movie_picture = $path_thumbnail . $val['movie_picture'];
                    }

                    $url_name = urlencode(str_replace(' ', '-', $val['movie_thname']));
                    ?>

                    <a onclick="goView('<?= $val['movie_id'] ?>', '<?=$url_name?>' , '<?=$val['movie_type']?>')" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
                      <img src="<?= $movie_picture ?>" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
                      <div class="av-overlay"></div>
                    </a>
                    
                    <?php
                      if (!($val['movie_view'])) {
                        $view = 0;
                      } else if (strlen($val['movie_view']) >= 5) {
                        $view =  substr($val['movie_view'], 0, -3) . 'k';
                      } else {
                        $view = $val['movie_view'];
                      }
                    ?>
                    <div class="av-view"><?=$view?> <i class="fas fa-eye"></i> <span class="triangle"></span></div>


                    <?php 
                      $sound_style=' style="top:0;" ';
                      if(!empty($val['movie_quality'])){ 
                        $sound_style='';
                    ?>
                    <span class="av-quality"><?=$val['movie_quality']?></span>
                    <?php } ?>

                  </div>
                  <div class="title-in">
                    <h2>
                      <a onclick="goView('<?= $val['movie_id'] ?>', '<?=$url_name?>', '<?=$val['movie_type']?>')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $val['movie_thname'] ?></a>
                    </h2>
                    
                    <div class="av-score">
                    <?php
                      if( !empty($val['movie_ratescore']) && $val['movie_ratescore'] != 0 ){
                        $score = $val['movie_ratescore'];
                        if( strpos($score,'.') ){
                          $score = substr($score,0,3);
                        }else{
                          $score = substr($score,0);
                        }
                    ?>
                      <i class="fas fa-star"></i> <?=$score?>
                    <?php
                      } 
                    ?>
                    </div>

                  </div>
                </li>
              <?php  } ?>
            </ul>
            <button id="movie-loadmore">NEXT</button>
          </div>
          <div id="mb-category" class="tab-pane fade">
            
            <ul id="list-category-name">
              <?php
                if(!empty($av_category)){
                  foreach($av_category as $avcate){
                    $cateurl = urlencode(str_replace(' ','-',$avcate['category_name']));
              ?>
                <li><a href="<?=base_url('/av/category/'.$avcate['category_id'].'/'.$cateurl)?>"><?=$avcate['category_name']?></a></li>
              <?php 
                  }
                }
              ?>
            </ul>

          </div>
        </div>

      </div>
    </div>
  </section>

  <section id="movie-banners" class="text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12 col-lg-12 ">
        <?php
          if( !empty($adsbottom) ){
            foreach($adsbottom as $ads){
              if(substr($ads['ads_picture'], 0, 4) == 'http'){
                $ads_picture = $ads['ads_picture'];
              }else{
                $ads_picture = $path_ads . $ads['ads_picture'];
              }
        ?>
          <a onclick="onClickAds(<?= $ads['ads_id']; ?>, <?= $branch ?>)" href="<?=$ads['ads_url']?>" alt="<?=$ads['ads_name']?>" title="<?=$ads['ads_name']?>">
            <img class="banners" src="<?=$ads_picture?>" alt="<?=$ads['ads_name']?>" title="<?=$ads['ads_name']?>">
          </a>
        <?php
            }
          }
        ?>
    
        </div>
      </div>
    </div>
  </section>

  <section id="movie-footer" class="text-center">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <a class="navbar-brand" href="<?php echo base_url() ?>">
            <img class="logo" src="<?= $path_setting . $setting['setting_logo'] ?> ">
          </a>
          <p><strong>ดูหนังฟรี</strong> โหลดไวแบบไม่มีสะดุดภาพคมชัดระดับ HD FullHD 4k ครบทุกเรื่องทุกรสดูได้ทุกที่ทุกเวลาทั้งบนมือถือ แท็บเล็ต เครื่องคอมพิวเตอร์ ระบบปฏิบัติการ Android และ IOS ดูอนิเมะใหม่ให้รับชมอีกมากมาย สามารถรับชมฟรีได้ทุกที่ทุกเวลาตลอด 24 ชั่วโมง</p>
        </div>
      </div>
    </div>
  </section>

  <script>

    $(document).ready(function() {

      var track_click = 2; //track user click on "load more" button, righ now it is 0 click
      var total_pages = '<?= $list['total_page'] ?>';

      if( track_click >= total_pages ){
        $("#movie-loadmore").hide(0);
      }

      $("#movie-loadmore").click(function(e) { //user clicks on button

        if (track_click <= total_pages) //user click number is still less than total pages
        {
          //post page number and load returned data into result element
          $.get('<?php echo $url_loadmore ?>', {
            'page': track_click
          }, function(data) {
            $("#list-av").append(data); //append data received from server

            track_click++; //user click increment on load button

          }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
            alert(thrownError); //alert with HTTP error
          });

        }

        if(track_click >= total_pages){

          $("#movie-loadmore").hide(0);

        }

      });

    });

    window.onload = function() {

      var swiper = new Swiper('#Popular', {
        effect: 'coverflow',
        grabCursor: true,
        centeredSlides: true,
        speed: 800,
        slidesPerView: 2,
        slidesPerGroup: 2,
        loop: true,

        coverflowEffect: {
          rotate: 0,
          stretch: 20,
          depth: 100,
          modifier: 1,
          slideShadows: true,
        },

        // Slide auto play
        autoplay: {
          delay: 3000,
        },

        breakpoints: {
          320: {
            slidesPerView: 2,
          },

          // when window width is >= 480px
          480: {
            slidesPerView: 3,
            spaceBetween: 30
          },

          769: {
            slidesPerView: 5,
          }
        },

        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        }

      });

    };
    
  </script>