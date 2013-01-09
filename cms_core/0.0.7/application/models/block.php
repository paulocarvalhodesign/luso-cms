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
class Block extends Eloquent
{

	



	public static function template($block, $template){

		if(empty($template))
		
		$view = $block.'::view';  

		else

		$view = 'path: '.USER_BUNDLE_PATH.$block.'/views/templates/'.$template.'.blade.php';



		return $view;
	}


	public static function isGlobal($value){

		$global = Input::get('global');
		  	if($global == 'true'){
		  		$page_id = '0';
		  	}else{
		  		$page_id = Input::get('page_id');
		  	}

		  return $page_id;	

	}
}

