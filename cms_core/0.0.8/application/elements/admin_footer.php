<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @version  0.0.1
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */
?>
<script>
  $(document).ready(function() {
    $(".dashboard_navigation a, form input[type=submit]").click(function() {
     $('.preloader').show().delay(2000).fadeOut();
    });
  }); 
  </script>
<center  class="version">
              Luso CMS v-<?php echo CMS_VERSION ;?> 
              <a href="http://paulocarvalhodesign.com">Paulo Carvalho Design</a>
 </center>

 