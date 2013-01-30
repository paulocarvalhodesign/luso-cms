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
<div class="span12">
	<div class="span6">
   <h3 class="cms_logo">LUSO CMS</h3>
	</div>
    <div class="span6">

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
	<p>WELCOME: <?php echo $user->nickname;?></p>
</div>
<div class="logout_button"><a href="<?php echo url('logout');?>"><i class="icon-off icon"></i></a></div>
</div>

</div>

</div>