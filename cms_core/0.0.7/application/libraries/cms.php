<?php
/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

/*
|----------------------------------------------------------------
| CMS class
|----------------------------------------------------------------
*/


class Cms 
{	
	
   /**
   * 
   * grab  the last url segment.
   * 
   *
   * 
   * @return string
   */


	public static function last()
	{
		
		$uri = Request::getUri();
		$last = explode('/', $uri);
 	
 		return $segments = end($last);
	}



   /**
   * 
   * Resolve string is this query or not?
   * 
   *
   * @param String $filter
   * @return string
   */


	public static function resolve_url($filter){

	if(isset($filter['query']) && isset($filter['path']))
		{
			
			
			$url = $filter['path'];
		

		}elseif(isset($filter['query']))
		
				{
				
					$url = '';
				}	
		 else

		{
		
			$url = $filter['path'];
		}			


		return $url;

	}
	

   /**
   * 
   *Loop and set settings from database.
   *
   * 
   * @return object
   */


	public static function set_settings(){

			$settings = DB::table('settings')->get();
			foreach($settings as $setting)
			Config::set($setting->name, $setting->value);

			return $settings;

	}

	
   /**
   * 
   * Set theme from database
   * 
   *
   *
   * @return object
   */


	public static function set_theme(){

			$theme = Theme::where_active('1')->first(); 
	        Config::set('theme',$theme->name);

	         return $theme;

	}


	
   /**
   * 
   * Set the page object.
   * 
   *
   * @param String $url
   * @return string
   */


	public static function set_page($url){

	if(Auth::check() == true){

			// Check if it's empty
 		if(empty($url))
 		{
 		
 				// if yes them set it to home.
 			$page = Page::where_id('1')->first();

 			
 		}else{
 			

 			$page = Page::where_url($url)->first();
 			
 	
 		}

		}else{


		// Check if it's empty
 		if(empty($url))
 		{
 			
 			if(Config::get('maintenance-mode') == 'true'){

 			$page = Page::where_name('maintenance-mode')->first();	

 			}else{

 				// if yes them set it to home.
 			$page = Page::where_id('1')->first();


 			}

 			
 			
 		}else{
 			if(Config::get('maintenance-mode') == 'true'){

 			$page = Page::where_name('maintenance-mode')->first();	

 			}else{
 			// New collection object
 			$page = Page::where_url($url)->first();
 			}	
 		
 		}	



		}
		

		//if does not exist show 404
		if(empty($page))
		{

		  
		   return Response::error('404');	
		 

		}else{
			return $page;
		}
	

	}

	

   /**
   * 
   * Load the bundles or blocks assets
   * 
   *
   * @param object $page
   * @return null
   */


	public static function set_block_assets($page){

		$blocks        = DB::table('page_blocks')->where('page_id', '=', $page->id)->get();
	    $globalblocks  = DB::table('page_blocks')->where('page_id', '=', '0')->get();
	 

	 	 foreach($blocks as $block)

	 	 include(path('root').'public/bundles/'.$block->block_slug.'/assets.php');	

	 	 foreach($globalblocks as $globalblock)

	 	 include(path('root').'public/bundles/'.$globalblock->block_slug.'/assets.php');	



	}


	
  /**
   * 
   * Load the core js assets
   * 
   *
   *
   * @return null
   */


	public static function set_core_js_assets(){

	   if(Config::get('edit_mode') == 'true'){
	   Asset::container('plugins')->add('ckeditor','ckeditor/ckeditor.js');
	   Asset::container('core_js')->add('formsValidation','global/js/jquery.validate.min.js', '' ,array('async', 'defer'));
	  
	   Asset::container('jquery-ui')->add('jquery-ui','jquery-ui/js/jquery-ui-1.9.0.custom.min.js', '' ,array('async', 'defer'));
	   if( Auth::check() == true)


	   Asset::container('core_js')->add('formsValidation','global/js/jquery.validate.min.js', '' ,array('async', 'defer'));
	   Asset::container('core_js')->add('global','global/js/cms.js', '' ,array('async', 'defer'));
       
	
	   }


	   Asset::container('core_js')->add('jquery','global/js/jquery.js');
	   Asset::container('core_js')->add('bootstrapp','global/bootstrap/js/bootstrap.min.js', '' ,array('async', 'defer'));


	}

	
   /**
   * 
   * Load the core css assets
   * 
   *
   * 
   * @return null
   */



	public static function set_core_css_assets(){

	   Asset::container('core_css')->add('bootstrap','global/bootstrap/css/bootstrap.css');
	   Asset::container('core_css')->add('bootstrap-responsive','global/bootstrap/css/bootstrap-responsive.css');
	   Asset::container('core_css')->add('jquery-ui','jquery-ui/css/lusocms-theme/jquery-ui-1.9.0.custom.min.css');

	   if( Auth::check() == true){
	   Asset::container('core_css')->add('global','global/css/cms.css');
       }

	}

	
  /**
   * 
   * Load the theme assets
   * 
   *
   * @param object $theme
   * @return null
   */


	public static function set_theme_assets($theme){


	include(path('root').'public/themes/'.$theme->name.'/assets.php');
	


	}

	
  /**
   * 
   * initialize menu
   * 
   *
   * @param int    $parent_id
   * @param string $handler
   * @return null
   */


	public static function initialize_menu($parent_id = 0, $handler="")
	{
	    // Load the pages from the database
	    $pages = DB::table('pages')
	        ->where_parent_id($parent_id)
	        ->where_exclude_from_navigation(0)
	        ->get();

	    // Loop through the pages
	    foreach ($pages as $page)
	    {
	        if($parent_id == 0)
	        {
	            // Get a menu handler for the menus this page should go in
	            $menus = Menu::handler(explode(',', $handler));
	        }
	        else
	        {
	            // Find the item list that has a name of the parent_id we are looking for
	            $menus = Menu::all()->find($parent_id);
	        }

	        // Add the page to the item list, and add the children item list (empty)
	        // but named with the page's id
	        $menus->add($page->route, $page->title, Menu::items($page->id));

	        // Attach the children (if any) of this page
	        CMS::initialize_menu($page->id);
	    }
	}


 /**
   * 
   * Load the core js assets
   * 
   *
   * @param string    $email
   * @param int       $s
   * @param string    $d
   * @param string    $r
   * @param boolean   $img
   * @param array     $atts
   * @return string   $url
   */


	public static function get_gravatar( $email, $s = 80, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {
	$url = 'http://www.gravatar.com/avatar/';
	$url .= md5( strtolower( trim( $email ) ) );
	$url .= "?s=$s&d=$d&r=$r";
	if ( $img ) {
		$url = '<img src="' . $url . '"';
		foreach ( $atts as $key => $val )
			$url .= ' ' . $key . '="' . $val . '"';
		$url .= ' />';
	}
	return $url;
}


 /**
   * 
   * check if is directory
   * 
   *
   * @param string    $path 
   * @return string   $path
   */
	
	
	public static function get_templates($path){

	$pa = is_dir($path);

		if($pa)

			return $path;
		
		else

			return $path = "";

	 
			
		
	}


 /**
   * 
   * check if is directory
   * 
   *
   * @param string    $dir 
   * @param array     $array
   * @return array    $files
   */


	public static function readFolder($dir, $array = array()){ 
	           $dh = opendir($dir); 
	                  
	             $files = array(); 
	                while (($file = readdir($dh)) !== false) { 
	                   $flag = false; 
	                  if($file !== '.'&& $file !== '.DS_Store' && $file !== '..' && !in_array($file, $array) && !is_dir($dir.$file.'/')) { 
	                 $files[] = basename($file, '.blade.php'); 
	                } 
	             } 
	             return $files; 
	           }       




	
}