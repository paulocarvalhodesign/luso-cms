<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 
class Blocks_Controller extends Base_Controller {

    /*
     |--------------------------------------------------------------------------
     | The Blocks Controller 
     |--------------------------------------------------------------------------
     |
     */


    public $restful = true;
    

    /*
     |--------------------------------------------------------------------------
     | Add new block to page 
     |--------------------------------------------------------------------------
     |
     */
    public function get_index() {
    
  
    
     

     if(empty($_GET['page_id']) || empty($_GET['area']) || empty($_GET['global']) )
     {

      return Redirect::to('404');

     }else{

      $page_id   = $_GET['page_id'];
      $area      = $_GET['area']; 
      $global    = $_GET['global'];   

     }

     $blocks = Block::all();
     
     $view = View::make('path: '.ADMIN_THEME_PATH.'add_block.blade.php')
       ->with('page_id',$page_id)
       ->with('area',$area)
       ->with('global',$global)
       ->with('blocks',$blocks);

      return $view;
 
    }

    /*
     |--------------------------------------------------------------------------
     | Reorder blocks in page 
     |--------------------------------------------------------------------------
     |
     */


    public function post_reorder(){

      $items = Input::get('item');
      $total_items = count($items);

      for($item = 0; $item < $total_items; $item++ )
      {
  
              $data = array(
                  'id' => $items[$item],
                  'order' => $rank = $item
              );
        
              DB::table('page_blocks')->where_id($data['id'])
              ->update(array('id'=> $data['id'],'order' => $data['order']));
  
                
      }  
    }
    
}