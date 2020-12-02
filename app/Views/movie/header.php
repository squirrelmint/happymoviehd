    <!-- Slider main container -->
    <div id="HomeSlide" class="swiper-container">
      <!-- Additional required wrapper -->
      <div class="swiper-wrapper">
          <!-- Slides -->
          <div class="swiper-slide">
            <div class="slider-area">
              <h2 class="title-slider">Movie</h2>
            </div>
            <img src="<?= $document_root ?>img_slide/3.jpg">
          </div>

      </div>

      <div class="movie-social">

      <?php 
        if(!empty($setting['setting_fb'])){
      ?>
        <a href="<?=$setting['setting_fb']?>" target="_blank">
          <i class="fab fa-facebook-square"></i>
        </a>  
      <?php } ?>
      
      <?php 
        if(!empty($setting['setting_line'])){
      ?>
        <a target="_blank" href="<?=$setting['setting_line']?>">
          <i class="fab fa-twitter"></i>
        </a>
      <?php } ?>

      </div>
      
    </div>
  </header>
