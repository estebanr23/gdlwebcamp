<footer class="site-footer">
    <div class="contenedor clearfix">
      <div class="footer-informacion">
        <h3>Sobre <span>gdlwebcamp</span></h3>
        <p>Aenean pharetra faucibus interdum. Vestibulum ac aliquam ante. Morbi interdum nec ante a interdum. Praesent nulla sem, finibus sed accumsan ut, lacinia non magna. Aenean dui quam, pulvinar at libero nec, vulputate vulputate dui. Nunc a nibh ipsum. Nullam elementum justo eros, sit amet posuere risus elementum id. Pellentesque id euismod sapien. Quisque mi quam, dapibus sit amet efficitur sit amet, porttitor vitae risus.</p>
      </div>
      <div class="ultimos-tweets">
        <h3>Ultimos <span>tweets</span></h3>
        <ul>
          <li>Aenean pharetra faucibus interdum. Vestibulum ac aliquam ante. Morbi interdum nec ante a interdum. Praesent nulla sem.</li>
          <li>Aenean pharetra faucibus interdum. Vestibulum ac aliquam ante. Morbi interdum nec ante a interdum. Praesent nulla sem.</li>
          <li>Aenean pharetra faucibus interdum. Vestibulum ac aliquam ante. Morbi interdum nec ante a interdum. Praesent nulla sem.</li>
        </ul>
      </div>
      <div class="menu">
        <h3>Redes <span>sociales</span></h3>
        <nav class="redes-sociales">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          <a href="#"><i class="fab fa-twitter"></i></a>
          <a href="#"><i class="fab fa-pinterest-p"></i></a>
          <a href="#"><i class="fab fa-youtube"></i></a>
          <a href="#"><i class="fab fa-instagram"></i></a>
        </nav>
      </div>
    </div>
      <p class="copyright">Todos los Derechos Resevados GDLWEBCAM 2021</p>

      <!-- Begin Mailchimp Signup Form -->
      <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
      <style type="text/css">
        #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
        /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
          We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
      </style>
      <div style="display:none";>
        <div id="mc_embed_signup">
        <form action="https://hotmail.us5.list-manage.com/subscribe/post?u=fb681e468edccc6695d672f3c&amp;id=646a9632ea" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
            <div id="mc_embed_signup_scroll">
          <h2>Subscribete al Newslestter y no te pierdas nada de este evento</h2>
        <div class="indicates-required"><span class="asterisk">*</span> es obligatorio</div>
        <div class="mc-field-group">
          <label for="mce-EMAIL">Correo Electronico<span class="asterisk">*</span>
        </label>
          <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
        </div>
          <div id="mce-responses" class="clear">
            <div class="response" id="mce-error-response" style="display:none"></div>
            <div class="response" id="mce-success-response" style="display:none"></div>
          </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
            <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_fb681e468edccc6695d672f3c_646a9632ea" tabindex="-1" value=""></div>
            <div class="clear"><input type="submit" value="Subscribirse" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
            </div>
        </form>
        </div>
        <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
        <!--End mc_embed_signup-->
      </div>
  </footer>


  <!-- Add your site or application content here -->
  <script src="js/vendor/modernizr-3.11.2.min.js"></script>
  <script src="js/plugins.js"></script>
  <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
   integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
   crossorigin=""></script>
  <script src="js/jquery.js"></script>
  <script src="js/jquery.animateNumber.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/jquery.lettering.js"></script>
  
  <?php
    $archivo = basename($_SERVER['PHP_SELF']);
    $pagina = str_replace(".php", "", $archivo);
    if($pagina == 'invitados' || $pagina == 'index') {
        echo '<script src="js/jquery.colorbox.js"></script>';
    } else if($pagina == 'conferencia') {
        echo '<script src="js/lightbox.js"></script>';
    }
  ?>

  <script src="js/main.js"></script>
  <script src="js/cotizador.js"></script>

  <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
  <script>
    window.ga = function () { ga.q.push(arguments) }; ga.q = []; ga.l = +new Date;
    ga('create', 'UA-XXXXX-Y', 'auto'); ga('set', 'anonymizeIp', true); ga('set', 'transport', 'beacon'); ga('send', 'pageview')
  </script>
  <script src="https://www.google-analytics.com/analytics.js" async></script>
  <!-- Mailchamp -->
  <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/fb681e468edccc6695d672f3c/a66276e89a3c87cdd1f157bec.js");</script>
</body>
</html>
