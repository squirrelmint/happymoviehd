
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

    /* When the user clicks on the button, 
    toggle between hiding and showing the dropdown content */
    function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
    }

    // Close the dropdown if the user clicks outside of it
    window.onclick = function(e) {
      if (!e.target.matches('.dropbtn')) {
      var myDropdown = document.getElementById("myDropdown");
        if (myDropdown.classList.contains('show')) {
          myDropdown.classList.remove('show');
        }
      }
    }

    function goView(id, name, type) {
      countView(id);

      var url = '';
      if(type=='se'){
        url = "<?=base_url()?>/series/" + id + '/' + name ;
      }else{
        url = "<?=base_url()?>/video/" + id + '/' + name ;
      }

      window.open(url, '_blank');

    }

    function goEP(id, name, index, epname) {
      countView(id);
      window.location.href = "<?=base_url()?>/series/" + id + '/' + name + '/' + index + '/' + epname ;
    }
  
    function countView(id) {
      // alert(id);
      var base_url = '<?= base_url() ?>';
      $.ajax({

        url: base_url + "/countview/" + id,
        method: "GET",

        async: true,

        success: function(response) {

          console.log(response); // server response

        }


      });

    }
    

    function goCate(id, name) {
      name = name.replace("/", "|");
      window.location.href = "<?=base_url()?>/category/" + id + '/' + name ;
    }

    /* Set the width of the side navigation to 0 */
    /* Set the width of the side navigation to 250px */
    function openNav() {
      document.getElementById("mySidenav").style.width = "250px";
      document.body.style.overflow = 'hidden'
      document.getElementById("overlay").style.display = "block";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0";
      document.body.style.overflow = 'auto'
      document.getElementById("overlay").style.display = "none";
    }
    
  </script>