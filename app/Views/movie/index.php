
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

  <section class="movie-popular text-center">
    <div class="container">
      <div class="row">
        <div class="col-12 bg-popular">

          <div class="movie-title-list">
            <h1>POPULAR <span>WALL<span></h1>
          </div>

          <div id="Popular" class="swiper-container">
            <div class="swiper-wrapper">

              <?php 
                foreach($popular as $val){ 
              ?>

                <div class="swiper-slide">
                  <div class="movie-box">

                    <?php if (substr($val['movie_picture'], 0, 4) == 'http') {
                      $movie_picture = $val['movie_picture'];
                    } else {
                      $movie_picture = $path_thumbnail . $val['movie_picture'];
                    }

                    $url_name = urlencode(str_replace(' ', '-', $val['movie_thname']));
                    ?>

                    <a onclick="goView('<?= $val['movie_id'] ?>', '<?=$url_name?>' , '<?=$val['movie_type']?>')" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
                      <img src="<?= $movie_picture ?>" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
                      <div class="movie-overlay"></div>
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
                    <span class="movie-view"><?=$view?> <i class="fas fa-eye"></i></span>


                    <?php 
                      $sound_style=' style="top:0;" ';
                      if(!empty($val['movie_quality'])){ 
                        $sound_style='';
                    ?>
                    <span class="movie-quality"><?=$val['movie_quality']?></span>
                    <?php } ?>

                    <?php
                      if (!empty($val['movie_sound'])) {
                        $sound = $val['movie_sound'];
                        if (strtolower($val['movie_sound'])=='th' || 
                        strtolower($val['movie_sound'])=='thai' ||
                        strpos(strtolower($val['movie_sound']),'thai')==true ||
                        strtolower($val['movie_sound'])=='ts') {
                          $sound = 'พากษ์ไทย';
                        } else if (strtolower($val['movie_sound'])=='eng') {
                          $sound = 'พากษ์อังกฤษ';
                        } else if (strtolower($val['movie_sound'])=='st' ||
                        strpos(strtolower($val['movie_sound']),'(t)')==true) {
                          $sound = 'ซับไทย';
                        }
                    ?>
                    <span class="movie-sound" <?=$sound_style?>><?=$sound?></span>
                    <?php } ?>

                  </div>
                  <div class="title-in">
                    <h2>
                      <a onclick="goView('<?= $val['movie_id'] ?>', '<?=$url_name?>', '<?=$val['movie_type']?>')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $val['movie_thname'] ?></a>
                    </h2>
                    
                    <div class="movie-score">
                    <?php
                      if( !empty($val['movie_ratescore']) && $val['movie_ratescore'] != 0 ){
                        $score = $val['movie_ratescore']/2;
                        if( strpos($score,'.') ){
                          $score = substr($score,0,3);
                        }else{
                          $score = substr($score,0);
                        }

                        

                        for($i=1;$i<=$score;$i++){
                    ?>
                      <i class="fas fa-star"></i>
                    <?php 
                        }

                        if(strpos($score,'.')==true && $score<5 ){
                    ?>
                    <i class="fas fa-star-half"></i>
                    <?php
                        }
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
          <li><a data-toggle="tab" href="#mb-home" class="active">New</a></li>
          <li><a data-toggle="tab" href="#mb-category">Category</a></li>
          <li><a href="<?=base_url('/category/28/Netflix-Movie')?>"">Netflix</a></li>
        </ul>

        <div class="tab-content">
          <div id="mb-home" class="tab-pane fade in active show">
            <ul id="list-movie" class="list-movie">

            <?PHP
            foreach ($list['list'] as $val) {
            ?>
              <li>
                <div class="movie-box">

                  <?php if (substr($val['movie_picture'], 0, 4) == 'http') {
                    $movie_picture = $val['movie_picture'];
                  } else {
                    $movie_picture = $path_thumbnail . $val['movie_picture'];
                  }

                  $url_name = urlencode(str_replace(' ', '-', $val['movie_thname']));
                  ?>

                  <a onclick="goView('<?= $val['movie_id'] ?>', '<?=$url_name?>' , '<?=$val['movie_type']?>')" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
                    <img src="<?= $movie_picture ?>" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
                    <div class="movie-overlay"></div>
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
                  <span class="movie-view"><?=$view?> <i class="fas fa-eye"></i></span>


                  <?php 
                    $sound_style=' style="top:0;" ';
                    if(!empty($val['movie_quality'])){ 
                      $sound_style='';
                  ?>
                  <span class="movie-quality"><?=$val['movie_quality']?></span>
                  <?php } ?>

                  <?php
                    if (!empty($val['movie_sound'])) {
                      $sound = $val['movie_sound'];
                      if (strtolower($val['movie_sound'])=='th' || 
                      strtolower($val['movie_sound'])=='thai' ||
                      strpos(strtolower($val['movie_sound']),'thai')==true ||
                      strtolower($val['movie_sound'])=='ts') {
                        $sound = 'พากษ์ไทย';
                      } else if (strtolower($val['movie_sound'])=='eng') {
                        $sound = 'พากษ์อังกฤษ';
                      } else if (strtolower($val['movie_sound'])=='st' ||
                      strpos(strtolower($val['movie_sound']),'(t)')==true) {
                        $sound = 'ซับไทย';
                      }
                  ?>
                  <span class="movie-sound" <?=$sound_style?>><?=$sound?></span>
                  <?php } ?>

                </div>
                <div class="title-in">
                  <h2>
                    <a onclick="goView('<?= $val['movie_id'] ?>', '<?=$url_name?>', '<?=$val['movie_type']?>')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $val['movie_thname'] ?></a>
                  </h2>
                  
                  <div class="movie-score">
                  <?php
                    if( !empty($val['movie_ratescore']) && $val['movie_ratescore'] != 0 ){
                      $score = $val['movie_ratescore']/2;
                      if( strpos($score,'.') ){
                        $score = substr($score,0,3);
                      }else{
                        $score = substr($score,0);
                      }

                      

                      for($i=1;$i<=$score;$i++){
                  ?>
                    <i class="fas fa-star"></i>
                  <?php 
                      }

                      if(strpos($score,'.')==true && $score<5 ){
                  ?>
                  <i class="fas fa-star-half"></i>
                  <?php
                      }
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
            $("#list-movie").append(data); //append data received from server

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
        speed: 800,
        grabCursor: true,
        slidesPerView: 2,
        slidesPerGroup: 2,
        loop: true,

        // Slide auto play
        autoplay: {
          delay: 3000,
        },

        breakpoints: {
          320: {
            slidesPerView: 2,
            slidesPerGroup: 2,
          },

          // when window width is >= 480px
          480: {
            slidesPerView: 3,
            slidesPerGroup: 3
          },

          769: {
            slidesPerView: 5,
            slidesPerGroup: 5
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