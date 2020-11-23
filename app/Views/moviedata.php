
<?PHP
foreach ($list['list'] as $val) {
?>
  <li>
    <div class="movie-box">

      <?php 
        if (substr($val['movie_picture'], 0, 4) == 'http') {
          $movie_picture = $val['movie_picture'];
        } else {
          $movie_picture = $path_thumbnail . $val['movie_picture'];
        }

        $url_name = urlencode(str_replace(' ', '-', $val['movie_thname']));
      ?>

      <a onclick="goView('<?= $val['movie_id'] ?>', '<?=$url_name?>', '<?=$val['movie_type']?>')" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
        <img src="<?= $movie_picture ?>" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>">
      </a>
      <div class="movie-overlay"></div>
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
        if(!empty($interest['movie_quality'])){ 
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
      <span class="movie-sound" <?=$sound_style?> ><?=$sound?></span>
      <?php } ?>

    </div>
    <div class="title-in">
      <h2>
        <a onclick="goView('<?= $val['movie_id'] ?>', '<?=$url_name?>', 'se')" tabindex="-1" alt="<?= $val['movie_thname'] ?>" title="<?= $val['movie_thname'] ?>"><?= $val['movie_thname'] ?></a>
      </h2>
      
      <?php
        if( !empty($val['movie_ratescore']) && $val['movie_ratescore'] != 0 ){
          if( strpos($val['movie_ratescore'],'.') ){
            $score = substr($val['movie_ratescore'],0,3);
          }else{
            $score = substr($val['movie_ratescore'],0);
          }
      ?>
      <div class="movie-score">
        <i class="fas fa-star"></i> <?=$score?>
      </div>
      <?php } ?>

    </div>
  </li>
<?php  } ?>