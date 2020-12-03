

  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 h-100 text-center text-lg-left my-auto">
          <p class="text-muted small mb-4 mb-lg-0">&copy; Your Website 2020. All Rights Reserved.</p>
        </div>
      </div>
    </div>
  </footer>

  <script>

    function onClickAds(adsid, branch) {

      var backurl = '<?= $backURL ?>';
      debugger;
      jQuery.ajax({
          url: backurl + "ads/sid/<?= session_id() ?>/adsid/" + adsid + "/branch/" + branch,
          async: true,
          success: function(response) {
              console.log(response); // server response
          }
      });

    }

    function moveCursorToEnd(el) {
      if (typeof el.selectionStart == "number") {
          el.selectionStart = el.selectionEnd = el.value.length;
      } else if (typeof el.createTextRange != "undefined") {
          el.focus();
          var range = el.createTextRange();
          range.collapse(false);
          range.select();
      }
    }
  </script>
  
  </body>

</html>