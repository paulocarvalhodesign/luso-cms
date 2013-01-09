<?php

class Search_Searchblock_Controller extends Base_Controller {

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

       $content = Search\Models\Searchblock::find($params['block_id']);

       $test = $content->target;
       $id = $content->id;
       $handle = 'searchblock';
       $global = $params['global'];
       $area =  $params['area'];
       $results = $content->results;
     

       $all_pages = Page::all();

       foreach($all_pages as $p)

          $pages[$p->name] = $p->name;

       $view = Block::template('search', $content->template);
       return View::make($view)
       ->with('pages', $pages)
       ->with('content', $test)
       ->with('id',$id)
       ->with('handle', $handle)
       ->with('global',$global)
      ->with('results',$results)
       ->with('area',$area);
       
    }


    
    


}
