<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 
class Moveblock_Controller extends Dashboard_Controller {

    /*
     |--------------------------------------------------------------------------
     | The Admin Controller 
     |--------------------------------------------------------------------------
     |
     */


    public $restful = true;
    

    public function get_index() {
        
     $block_id = $_GET['id'];
     $page_id = $_GET['page_id'];  
     $handle = $_GET['area'];
     $global = $_GET['global'];
     
    if($global == 'true'){
     $blocks = DB::table('page_blocks')->where_area_id_and_page_id($handle, '0')->order_by('order', 'asc')->get();
    }else{
     $blocks = DB::table('page_blocks')->where_area_id_and_page_id($handle, $page_id)->order_by('order', 'asc')->get();
    }  


     // $view = View::make('themes.admin.pagetypes.move_block')
     $view = View::make('path: '.ADMIN_THEME_PATH.'move_block.blade.php')
        ->with('id',$block_id)
        ->with('page_id',$page_id)
        ->with('global',$global)
        ->with('blocks',$blocks);

      return $view;
 
    }


    
}