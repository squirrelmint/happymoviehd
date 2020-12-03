
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
      name = name.replace("/", "|");
      window.location.href = "<?=base_url()?>/av/category/" + id + '/' + name ;
    }
    
  </script>