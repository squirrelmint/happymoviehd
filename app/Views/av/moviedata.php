

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
