<?php
/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */
class User extends Eloquent
{	



public function roles()
     {
          return $this->has_many_and_belongs_to('Role');
     }
	

public static function canWrite(){

	$logged_user = Auth::user();
	
	if($logged_user){
	$roles = User::find($logged_user->id)->roles()->first();
	$permitions = $roles->can_write;
	return $permitions;
	}
	
	else
	{
	return null;	
	}
}

public static function canCreate(){

	$logged_user = Auth::user();
	
	if($logged_user){
	$roles = User::find($logged_user->id)->roles()->first();
	$permitions = $roles->can_create;
	return $permitions;
	}
	
	else
	{
	return null;	
	}
}


public static function canDelete(){

	$logged_user = Auth::user();
	
	if($logged_user){
	$roles = User::find($logged_user->id)->roles()->first();
	$permitions = $roles->can_delete;
	return $permitions;
	}
	
	else
	{
	return null;	
	}
}
public static function roleName(){

	$logged_user = Auth::user();
	
	if($logged_user){
	$roles = User::find($logged_user->id)->roles()->first();
	$permitions = $roles->name;
	return $permitions;
	}
	
	else
	{
	return null;	
	}
}

public static function showAvatar($user, $width, $height){

 $gravatar   = CMS::get_gravatar($user->username);
 $user_image = $user->avatar;

if($user_image)
  	$gravatar = null;

 if($gravatar)
 
 $avatar = '<img src="'.$gravatar.'" width="'.$width.'" height="'.$height.'"/>';

 elseif(!empty($user->avatar))

 $avatar = '<img src="'.url('public/filemanager/images/'.$user->avatar.'').'" width="'.$width.'" height="'.$height.'"/>';

	else 

 $avatar =  '<img src="'.url('public/images/avatar_user.png').'" width="'.$width.'" height="'.$height.'"/>';









 return $avatar;
}







}