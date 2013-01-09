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

 <h3 class="cms_logo"><img src="<?php echo url('public/global/img/logo.png');?>" width="150" height="68"/></h3>
<hr class="theme_hr"/>
<?php 
$user   = Auth::user();
$avatar = User::showAvatar($user, '40', '40');

?>
 


 <div class="user_avatar">


 <div class="user_img">	
<?php echo $avatar;?>

</div>
<div class="user_details">
	<?php $user =  Auth::user(); ?>
	<p>Welcome: <br/><?php echo $user->nickname;?></p>
</div>
</div>

 <hr class="theme_hr"/>