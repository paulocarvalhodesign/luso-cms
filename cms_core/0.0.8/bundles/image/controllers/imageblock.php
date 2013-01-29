<?php

class Image_Imageblock_Controller extends Base_Controller {

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

       $content = Image\Models\Imageblock::find($params['block_id']);

       $id = $content->id;
       $handle = 'imageblock';
       $block = $content;
       $global = $params['global'];
       $area = $params['area'];
      
      $view = Block::template('image', $content->template);
       
       return View::make($view)
       ->with('id',$id)
       ->with('handle', $handle)
       ->with('global', $global)
       ->with('area', $area)
       ->with('block',$block);
       
       
    }


    
    


}
