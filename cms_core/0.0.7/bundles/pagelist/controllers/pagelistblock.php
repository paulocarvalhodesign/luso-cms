<?php

class Pagelist_Pagelistblock_Controller extends Base_Controller {

    /*
     |--------------------------------------------------------------------------
     | The Default Controller
     |--------------------------------------------------------------------------
     |
     | Instead of using RESTful routes and anonymous functions, you might wish
     | to use controllers to organize your application API. You'll love them.
     |
     | This controller responds to URIs beginning with "home", and it also
     | serves as the default controller for the application, meaning it
     | handles requests to the root of the application.
     |
     | You can respond to GET requests to "/home/profile" like so:
     |
     |		public function action_profile()
     |		{
     |			return "This is your profile!";
     |		}
     |
     | Any extra segments are passed to the method as parameters:
     |
     |		public function action_profile($id)
     |		{
     |			return "This is the profile for user {$id}.";
     |		}
     |
     */
    public $restful = true;
     
    public function get_render($params) {

       $content = Pagelist\Models\Pagelistblock::find($params['block_id']);

      
       $id = $content->id;
       $handle = 'pagelistblock';
       $block = $content;
       $list = 'list';
       $global = $params['global'];
       $area = $params['area'];
       
       if($block->order_by == 'sitemap')

          $filter = 'order';
        
        elseif($block->order_by == 'alphabetic')

          $filter = 'name';

         elseif($block->order_by == 'id')
        
          $filter = 'id';
        
        else
         
          $filter = 'order';

       if($block->pagination == '0'){
          $ammount = 10000;
        }else{
          $ammount = $block->ammount;
        }
      
       if($block->location == 'anywhere'){

      $list = DB::table('pages')
      ->order_by($filter, $block->position)
      ->where_pagetype($block->pagetype)
      ->where_exclude_from_pagelist('0')
      ->paginate($ammount);


       }else{
         

      $list = DB::table('pages')
      ->order_by($filter, $block->position)
      ->where_pagetype($block->pagetype)
      ->where_parent_id($block->location)

      ->paginate($ammount);
      }


      $view = Block::template('pagelist', $block->template);
       
       return View::make($view)
       ->with('id',$id)
       ->with('handle', $handle)
       ->with('block',$block)
       ->with('global',$global)
       ->with('area',$area)
       ->with('list',$list);
      

       
    }


    
    


}
