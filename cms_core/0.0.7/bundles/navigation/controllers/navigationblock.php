<?php

class Navigation_Navigationblock_Controller extends Base_Controller {

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
        
        $pages = Page::order_by('order', 'asc')
        ->where_exclude_from_navigation('0')->where_parent_id('0')->get();
        
        $link = CMS::last();
        $filter = parse_url($link);

      
       if(isset($filter['query']) && isset($filter['path']))
        {
            
            
            $active = $filter['path'];
        

        }elseif(isset($filter['query']))
        
                {
                
                    $active = 'home';
                }   
         else

        {
        
            $active = $filter['path'];
        }       


        if(empty($active))
            $active ='home';

       

        
        
        $handle = 'navigationblock';


     $block = Navigation\Models\Navigationblock::find($params['block_id']);
     $id = $block->id;

     

      $global = $params['global'];
       $area =  $params['area'];

    
    $view = Block::template('navigation', $block->template);
    

    $menu = CMS::initialize_menu(0, 'test'.$block->id);

    $attrib = array('class'=>'navigation');

    $navigation =  Menu::handler('test'.$block->id, $attrib);


      return View::make($view)
      ->with('pages', $pages)->with('active', $active)
      ->with('id',$id)->with('handle', $handle)
      ->with('global',$global)
      ->with('area',$area)
      ->with('menu',$navigation);
       
    }

   

}
