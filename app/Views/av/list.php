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

<!-- Icons Grid -->
<section class="text-center">
  <div class="container">
    <div id="movie-list" class="row">
      <?php
        $chkactive = [
          'cate' => '',
          'clips' => 'active'
        ];

        if(!empty($keyword)){
          $chkactive = [
            'cate' => 'active',
            'clips' => ''
          ];
        }
      ?>
      <ul id="menuMobile" class="nav nav-pills">
        <li><a href="<?=base_url('av/#mb-home')?>" >New</a></li>
        <li><a data-toggle="tab" href="#mb-category" >Category</a></li>
        <li><a href="<?=base_url('av/clips');?>" class="<?=$chkactive['clips']?>">Clips</a></li>
      </ul>

      <div class="tab-content">
        <div id="mb-home" class="tab-pane fade in active show">
          <div class="movie-title-list">
            <?php
              if (!empty($cate_name)) {
            
                $title = $cate_name ;

              } else if (!empty($keyword)) {
            
                $title = 'คุณกำลังค้นหา : '. $keyword;
          
              }
            ?>
            <h1><?= $title ?></h1>
          </div>

          <?php if (!empty($list['list'])) { ?>
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
          <?php
            } else {
          ?>

              <h3> ไม่พบหนังที่คุณค้นหา</h3>

          <?php } ?>

          <?php
            if ( !empty($list['list']) ) {
          ?>
            <button id="movie-loadmore">NEXT</button>
          <?php
            }
          ?>
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

<script>
  $(document).ready(function() {
    var track_click = 1; //track user click on "load more" button, righ now it is 0 click
    var total_pages = '<?= $list['total_page'] ?>';
    var keyword = "<?= $keyword ?>";

    if( track_click >= total_pages ){
      $("#movie-loadmore").hide(0);
    }

    track_click = 2;

    $("#movie-loadmore").click(function(e) { //user clicks on button

      if (track_click <= total_pages) //user click number is still less than total pages
      {
        //post page number and load returned data into result element
        $.get('<?php echo $url_loadmore ?>', {
          'page': track_click,
          'keyword': keyword,
        }, function(data) {

         //  $("#anime-loadmore").show(); //bring back load more button
          $("#list-av").append(data); //append data received from server

          track_click++; //user click increment on load button

        }).fail(function(xhr, ajaxOptions, thrownError) { //any errors?
          alert(thrownError); //alert with HTTP error
        });

      }

      if(track_click >= total_pages){

        $("#movie-loadmore").hide(0);

      }

      // alert(track_click+" "+total_pages)

    });
  });
</script>