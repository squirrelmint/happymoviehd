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
          <a href="<?=$ads['ads_url']?>" alt="<?=$ads['ads_name']?>" title="<?=$ads['ads_name']?>">
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

<!-- Icons Grid -->
<section id="movie-video" class="text-center">
  <div class="container">
    <div class="row">
      <?php if (substr($videodata['movie_picture'], 0, 4) == 'http') {
        $movie_picture = $videodata['movie_picture'];
      } else {
        $movie_picture = $path_thumbnail . $videodata['movie_picture'];
      }
      $url_name = urlencode(str_replace(' ', '-', $videodata['movie_thname']))

      ?>
      <div id="movie-player">
        <div class="movie-header">
          <div class="movie-trailer">
          <?php
            $yb = explode('?v=', $videodata['movie_preview']);
            if (count($yb) > 1) {
              $urlyb = "https://www.youtube.com/embed/" . $yb[1];
            } else {
              $urlyb = "https://www.youtube.com/embed/" . $yb[0];
            }

          ?>
            <iframe src="<?=$urlyb?>" frameborder="0" allowfullscreen=""></iframe>
          </div>
          <div class="movie-thumbnail">
            <img src="<?php echo $videodata['movie_picture']; ?>" alt="<?= $videodata['movie_thname'] ?>" title="<?= $videodata['movie_thname'] ?>">
          </div>
        </div>
        <iframe id="player" class="player" src="<?= base_url('player/' . $videodata['movie_id'] . '/' . $index) ?>" scrolling="no" frameborder="0" allowfullscreen="yes"></iframe>
            
        <!-- สำหรับ series -->
        <?php if($videodata['movie_type']=='se'){ ?>
        <div class="movie-episode">
          <div id="NextEP" class="swiper-container">
            <div class="swiper-wrapper">

              <?php 
                foreach ($videodata['epdata'] as $key => $val) { 
                  $active = '';
                  if($index==$key){
                    $active = 'active';
                  }
                  $url_nameep = urlencode(str_replace(' ', '-', $videodata['name_ep'][$key]));

              ?>
                <div class="swiper-slide">
                  <a onclick="goEP('<?=$videodata['movie_id']?>','<?=$url_name?>','<?= trim($key) ?>','<?= $url_nameep ?>')" tabindex="-1">
                    <img src="<?= $movie_picture ?>">
                    <span class="<?=$active?>"><?= $videodata['name_ep'][$key] ?></span>
                  </a>
                </div>
              <?php } ?>

            </div>
              
            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>

            <!-- Add Pagination -->
            <div class="swiper-pagination"></div>
          </div>
        </div>
        <?php } ?>
      </div>

      <div id="movie-detail">
        <div class="movie-card-detail">
          <h1 class="movie-title"><?= $videodata['movie_thname'] ?> </h1>
          <div class="movie-description">
            <p>
              เรื่องย่อ: <?php if(empty($videodata['movie_des'])){ echo "-"; }else{ echo $videodata['movie_des']; } ?>
            </p>
          </div>
          <div class="movie-box">
           
            <div class="movie-score">
            <?php
              if( !empty($videodata['movie_ratescore']) && $videodata['movie_ratescore'] != 0 ){
                if( strpos($videodata['movie_ratescore'],'.') ){
                  $score = substr($videodata['movie_ratescore'],0,3);
                }else{
                  $score = substr($videodata['movie_ratescore'],0);
                }
            ?>
              <i class="fas fa-star"></i> <?= $score ?>
              <?php } ?>
            </div>
            
            <div class="movie-social">
              <a href="https://www.facebook.com/sharer/sharer.php?kid_directed_site=0&sdk=joey&u=<?= urlencode(base_url(uri_string())) ?>&display=popup&ref=plugin&src=share_button" target="_blank">
                <i class="fab fa-facebook-square"></i>
              </a>  

              <a target="_blank" href="https://twitter.com/share?hashtags=ดูหนังออนไลน์,ดูหนังใหม่&text=<?= $url_name ?>">
                <i class="fab fa-twitter"></i>
              </a>

              <a href="https://social-plugins.line.me/lineit/share?url=<?= urlencode(base_url(uri_string())) ?>" target="_blank">
                <i class="fab fa-line"></i>
              </a>

              <button class="movie-btn-report" onclick="get_Report()">แจ้งหนังเสีย</button>
            </div>
          </div>

          <?php if( !empty($videodata['cate_data'] ) ){ ?>
          <div class="movie-category">
            Category:
            <?php 
              foreach ($videodata['cate_data'] as $val) { 
                $catename = str_replace(' ','-',$val['category_name']);
            ?>
              <a href="<?php echo base_url().'/category/'.$val['category_id'].'/'.$catename ?>" target="_blank">
                <span class="cate-name"><?= $val['category_name'] ?></span>
              </a>
            <?php } ?>
          </div>
          <?php } ?>

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
          <a href="<?=$ads['ads_url']?>" alt="<?=$ads['ads_name']?>" title="<?=$ads['ads_name']?>">
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
      <div class="movie-title-list">
        <h1>คุณอาจจะสนใจ</h1>
      </div>
      <ul id="list-movie" class="list-movie">
      <?php foreach($videinterest as $interest){ ?>
        <li>
          <div class="movie-box">

            <?php if (substr($interest['movie_picture'], 0, 4) == 'http') {
              $movie_picture = $interest['movie_picture'];
            } else {
              $movie_picture = $path_thumbnail . $interest['movie_picture'];
            }

            $url_name = urlencode(str_replace(' ', '-', $interest['movie_thname']));
            ?>

            <a onclick="goView('<?= $interest['movie_id'] ?>', '<?=$url_name?>')" alt="<?= $interest['movie_thname'] ?>" title="<?= $interest['movie_thname'] ?>">
              <img src="<?= $movie_picture ?>" alt="<?= $interest['movie_thname'] ?>" title="<?= $interest['movie_thname'] ?>">
            </a>
            <div class="movie-overlay"></div>
            <?php
              if (!($interest['movie_view'])) {
                $view = 0;
              } else if (strlen($interest['movie_view']) >= 5) {
                $view =  substr($interest['movie_view'], 0, -3) . 'k';
              } else {
                $view = $interest['movie_view'];
              }
            ?>
            <span class="movie-view"><?=$view?> <i class="fas fa-eye"></i></span>


            <?php 
              $sound_style=' style="top:0;" ';
              if(!empty($interest['movie_quality'])){ 
                $sound_style='';
            ?>
            <span class="movie-quality"><?=$interest['movie_quality']?></span>
            <?php } ?>

            <?php
              if (!empty($interest['movie_sound'])) {
                $sound = $interest['movie_sound'];
                if (strtolower($interest['movie_sound'])=='th' || 
                strtolower($interest['movie_sound'])=='thai' ||
                strpos(strtolower($interest['movie_sound']),'thai')==true ||
                strtolower($interest['movie_sound'])=='ts') {
                  $sound = 'พากษ์ไทย';
                } else if (strtolower($interest['movie_sound'])=='eng') {
                  $sound = 'พากษ์อังกฤษ';
                } else if (strtolower($interest['movie_sound'])=='st' ||
                strpos(strtolower($interest['movie_sound']),'(t)')==true) {
                  $sound = 'ซับไทย';
                }
            ?>
            <span class="movie-sound" <?=$sound_style?>><?=$sound?></span>
            <?php } ?>

          </div>
          <div class="title-in">
            <h2>
              <a onclick="goView('<?= $interest['movie_id'] ?>', '<?=$url_name?>')" tabindex="-1" alt="<?= $interest['movie_thname'] ?>" title="<?= $interest['movie_thname'] ?>"><?= $interest['movie_thname'] ?></a>
            </h2>
            
            <?php
              if( !empty($interest['movie_ratescore']) && $interest['movie_ratescore'] != 0 ){
                if( strpos($interest['movie_ratescore'],'.') ){
                  $score = substr($interest['movie_ratescore'],0,3);
                }else{
                  $score = substr($interest['movie_ratescore'],0);
                }
            ?>
            <div class="movie-score">
              <i class="fas fa-star"></i> <?=$score?>
            </div>
            <?php } ?>

          </div>
        </li>
      <?php } ?>
        
      </ul>

        <div id="movie-comment">
          <div class="fb-comments" data-href="<?= base_url(uri_string()) ?>" data-colorscheme="light" data-width="1000" data-numposts="5"></div>
          <div id="fb-root"></div>
          <script>
            (function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s);
              js.id = id;
              js.src =
                'https://connect.facebook.net/th_TH/sdk.js#xfbml=1&version=v3.2&appId=254458338652270&autoLogAppEvents=1';
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
          </script>
        </div>
    </div>
  </div>
</section>

<script>
  window.onload = function() {

    var swiper = new Swiper('#NextEP', {
        speed: 800,
        slidesPerView: 4,
        slidesPerGroup: 4,
        loopFillGroupWithBlank: true,
        spaceBetween: 10,
        mousewheel: true,
        freeMode: true,
        initialSlide: '<?= $index ?>',

        pagination: {
          el: '.swiper-pagination',
          dynamicBullets: true,
          clickable: true,
          renderBullet: function (index, className) {
            return '<span class="' + className + '">' + (index + 1) + '</span>';
          },
        },

        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      });

  };

  function get_Report() {
    var movie_id = '<?= $videodata['movie_id'] ?>';
    var movie_name = '<?= $videodata['movie_thname'] ?>';
    var movie_ep_name = '';
    <?php if($videodata['movie_type']=='se'){ ?>
      movie_ep_name = '<?= $videodata['name_ep'][$index] ?>';
    <?php } ?>

    $.ajax({
      url: "<?= base_url('saveReport') ?>",
      data: {
        movie_id: movie_id,
        movie_name: movie_name,
        movie_ep_name: movie_ep_name
      },
      type: 'POST',
      async: false,
      success: function(data) {
        alert('แจ้งเรียบร้อยจะดำเนินการโดยเร็ว');
      }
    });
  }
</script>