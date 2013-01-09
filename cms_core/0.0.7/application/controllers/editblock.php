<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 
class Editblock_Controller extends Base_Controller {

    /*
     |--------------------------------------------------------------------------
     | The Edit block Controller 
     |--------------------------------------------------------------------------
     |
     */
    

    public $restful = true;
    

    public function get_index() {
        
     $block_id = $_GET['id'];
     $page_id  = $_GET['page_id'];  
     $handle   = $_GET['handle'];
     $global   = $_GET['global'];

     $block = DB::table($handle.'s')->find($block_id);

     $core =  DB::table('blocks')->where_block_table($block->block_handle)->first();

     $view = View::make('path: '.ADMIN_THEME_PATH.'edit_block.blade.php')
        ->with('id',$block_id)
        ->with('page_id',$page_id)
        ->with('block_name',$block->block_name)
        ->with('core',$core->core)
        ->with('global',$global)
        ->with('block',$block);

      return $view;
 
    }


    
}