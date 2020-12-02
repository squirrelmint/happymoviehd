  <!-- Icons Grid -->
  <section>
    <div class="container">
      <div id="movie-list" class="row">
        <div class="movie-title-list">
          <h1>POPULAR</h1>
        </div>
        <ul class="list-popular">

        <?php 
          foreach($list as $val){ 
            $url_name = urlencode(str_replace(' ', '-', $val['movie_thname']));
        ?>
          <li>
            <a onclick="goView('<?= $val['movie_id'] ?>', '<?=$url_name?>' , '<?=$val['movie_type']?>')" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
              <span class="movie-category">
                <?php
                  if(!empty($val['cate_data'])){
                    $i=1;
                    foreach($val['cate_data'] as $cate){
                      echo $cate['category_name'];
                      if(count($val['cate_data'])>$i){
                        echo ',';
                      }
                      $i++;
                    }
                  }
                ?>
              </span>
              <div class="movie-quality-area">

                <?php if(!empty($val['movie_quality'])){ ?>
                  <span><?=strtoupper($val['movie_quality'])?></span>
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
                <span><?=$sound?></span>
                <?php } ?>
              </div>

              <?php
                if (!($val['movie_view'])) {
                  $view = 0;
                } else if (strlen($val['movie_view']) >= 5) {
                  $view =  substr($val['movie_view'], 0, -3) . 'k';
                } else {
                  $view = $val['movie_view'];
                }
              ?>
              <span class="movie-view"><?= $view ?> <i class="fas fa-eye"></i></span>
              <div class="movie-area">
                <?php
                  if( !empty($val['movie_ratescore']) && $val['movie_ratescore'] != 0 ){
                    if( strpos($val['movie_ratescore'],'.') ){
                      $score = substr($val['movie_ratescore'],0,3);
                    }else{
                      $score = substr($val['movie_ratescore'],0);
                    }
                ?>
                <span class="movie-score"><i class="fas fa-star"></i> <?=$score?></span>
                <?php } ?>

                <!-- <h1 class="movie-title-en">Tesla (2020)</h1> -->
                <h1  class="movie-title-th"><?= $val['movie_thname'] ?></h1>
              </div>

              <img src="<?= $path_silde . $val['slide_img'];?>">

            </a>
          </li>
        <?php } ?>
              
        </ul>
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