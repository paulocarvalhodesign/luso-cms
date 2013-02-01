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


	<?php echo Asset::container('core_css')->styles() ;?>

  <link href='http://fonts.googleapis.com/css?family=Quantico:400,700' rel='stylesheet' type='text/css'>

	<?php echo Asset::container('jquery-ui')->styles() ;?>

  <?php echo Asset::container('theme')->styles() ;?>

  <?php echo Asset::container('blocks')->styles() ;?>


    
  <?php echo Asset::container('core_js')->scripts() ;?> 

  <?php echo Asset::container('jquery-ui')->scripts() ;?> 

  <?php echo Asset::container('plugins')->scripts() ;?>

  <?php echo Asset::container('blocks_js')->scripts() ;?>

  <?php echo Asset::container('theme')->scripts() ;?>



   	

  