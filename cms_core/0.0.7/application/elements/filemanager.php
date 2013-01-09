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

<?php $files = Files::all();?>


<div id="imageblockimages">
 <button class="btn btn-primary"  id="imageblock_close_image_manager">Close</button>
 <ul class="filemanager" id="imageblockuItem" >
<?php foreach($files as $file):?>

<li>
  <p>
  
  
                       <img src="<?php echo $file->thumb_location;?>"/>
                        
                        <span><?php echo $file->thumb_location;?></span>
                          
  </p>
</li>

<?php endforeach;?>
</ul>
</div>