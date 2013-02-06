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
<div class="preloader"><img src="<?php echo url('public/images/360.gif');?>"/></div>
<div class="span12">
	<div class="span6">

   <h3 class="cms_logo"><img width="25" src="<?php echo url('public/global/img/icon.png');?>"> LUSO CMS</h3>
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
<div class="logout_button"><a class="tt" rel="tooltip" data-placement="top" data-original-title="Logout" href="<?php echo url('logout');?>"><i class="icon-off icon"></i> Logout</a></div>
</div>

</div>

</div>