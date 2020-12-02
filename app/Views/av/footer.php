
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

      var mySwiper = new Swiper('#HomeSlide', {
        loop: true,
        speed: 800,
        spaceBetween: 100,
        effect: 'fade',

        // Slide auto play
        autoplay: {
          delay: 5000,
        },

        // Navigation arrows
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
      })

    });

    function goView(id, name, type) {
      countView(id);

      var url = '';
      if(type=='cl'){
        url = "<?=base_url()?>/av/clips/" + id + '/' + name ;
      }else{
        url = "<?=base_url()?>/av/" + id + '/' + name ;
      }

      window.open(url, '_blank');

    }
  
    function countView(id) {
      // alert(id);
      var base_url = '<?= base_url() ?>';
      $.ajax({

        url: base_url + "/av/countview/" + id,
        method: "GET",

        async: true,

        success: function(response) {

          console.log(response); // server response

        }


      });

    }
    

    function goCate(id, name) {
      window.location.href = "<?=base_url()?>/av/category/" + id + '/' + name ;
    }
    
  </script>