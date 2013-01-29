<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 

class Home_Controller extends Base_Controller {

	/*

	|--------------------------------------------------------------------------
	| The Home Controller
	|--------------------------------------------------------------------------
	*/

	public $restful = true;
	public $url;
	public $page;


	public function get_index()
	{
		
		
	   // Grab our last segment of the requested URI
	   $link     		 = CMS::last();
	   $filter   		 = parse_url($link);
	   // Resolve the url
	   $url 	 		 = CMS::resolve_url($filter);
	   $settings 		 = CMS::set_settings();
	   $theme 	  		 = CMS::set_theme();
	   $page     		 = CMS::set_page($url);
	   $page_id  		 = Config::set('page_id', $page->id);
	   $edit_mode 		 = Config::set('edit_mode', $page->edit_mode);
   	   $core_css_assets  = CMS::set_core_css_assets();
       $theme_assets     = CMS::set_theme_assets($theme);     
	   $block_assets     = CMS::set_block_assets($page);
	   $core_js_assets   = CMS::set_core_js_assets();
	   $agent            = Agent::browser();


 		
 		// let's prepare the view and get the correct theme and pagetype 
		$view =  View::make('themes.'.$theme->name.'.'.$page->pagetype.'')	
		->with('agent', $agent)
		->with('name', $page->name)
		->with('title', $page->title)
		->with('keywords', $page->keywords)
		->with('tags', $page->tags)
		->with('description', $page->description)
		->with('url', $page->url)
		->with('page_id', $page->id)
		->with('edit_mode', $page->edit_mode)
		->with('page',$page)
		;
		return $view;
	}
	
	
}