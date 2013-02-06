<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 
class Extensions_Controller extends Dashboard_Controller {

    /*
     |--------------------------------------------------------------------------
     | The Admin Controller 
     |--------------------------------------------------------------------------
     |
     */


    public $restful = true;


    

    /*
     |--------------------------------------------------------------------------
     | The Admin Dashboard with analytics 
     |--------------------------------------------------------------------------
     |
     */


    public function get_index() {
      
    
     $blocks = Block::all();



     $view = View::make('path: '.ADMIN_THEME_PATH.'extensions.blade.php')
        ->with('user',Auth::user())
        ->with('blocks', $blocks);
       

      return $view;
 
    }

    
        
}