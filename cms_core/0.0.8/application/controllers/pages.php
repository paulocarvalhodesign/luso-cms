<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 
class Pages_Controller extends Dashboard_Controller {

    /*
     |--------------------------------------------------------------------------
     | The Admin Controller 
     |--------------------------------------------------------------------------
     |
     */


    public $restful = true;
    

    public function get_index() {
        
     $pages = Page::order_by('order', 'asc')->get();        


     $view = View::make('path: '.ADMIN_THEME_PATH.'pages/pages.blade.php')
        ->with('user',Auth::user())->with('pages',$pages);

      return $view;
 
    }

    public function get_attributes() {
        
     $attributes = DB::table('page_atributes')->get();
     
    
     $view = View::make('path: '.ADMIN_THEME_PATH.'pages/attributes.blade.php')
        ->with('attributes',$attributes)
        ->with('user',Auth::user());

      return $view;
 
    }
    

    
    public function get_new() {
     $theme = DB::table('themes')->where_active('1')->first(); 
     $dir = path('root').'cms_user/themes/views/themes/'.$theme->name.'/';    
     $page_types = Page::pagetypes($dir);

     foreach($page_types as $key=>$value)
        $pagetypes[$value] =  $value;

     $pages = Page::all();
     foreach ($pages as $page) {
         $parents[$page->id] = $page->name; 
     }
    
     $view = View::make('path: '.ADMIN_THEME_PATH.'pages/new.blade.php')
        ->with('user',Auth::user())
        ->with('pagetypes',$pagetypes)
        ->with('parents',$parents);

      return $view;
 
    }

    
    public function post_new() {
        
    $input = Input::all();

    $rules = array(
    'title'  => 'required|max:255',
    'url'  => 'required|max:255|unique:pages,url',
    'pagetype'  => 'required|max:255',
    'parent_id'  => 'required|max:255',

    );

    $validation = Validator::make($input, $rules);

        if ($validation->fails())
        {
             return Redirect::to('pages/new')->with_errors($validation);
        
        }
        else

    {

    $page = new page();

    $page->title = Input::get('title'); 
    $page->name = Input::get('url');  
    $page->url = Input::get('url'); 
    $page->tags = Input::get('tags'); 
    $page->keywords = Input::get('keywords'); 
    $page->pagetype = Input::get('pagetype'); 
   
    if(Input::get('parent_id') == '1'){

         $page->parent_id = '0';    
    }else{

         $page->parent_id = Input::get('parent_id'); 
     }
    $page->description = Input::get('description'); 
    

    if(Input::get('exclude_from_sitemap') == null)
         $page->exclude_from_sitemap = '0';
         else   
    $page->exclude_from_sitemap = Input::get('exclude_from_sitemap');


     if(Input::get('exclude_from_navigation') == null) 
          $page->exclude_from_navigation = '0';
          else            
    $page->exclude_from_navigation = Input::get('exclude_from_navigation'); 
    
     if(Input::get('exclude_from_pagelist') == null) 
          $page->exclude_from_pagelist = '0';
          else  
    $page->exclude_from_pagelist = Input::get('exclude_from_pagelist'); 

    $route = Page::find(Input::get('parent_id'));
    

    $page->route = $route->route.'/'.Input::get('url'); 


    $page->save();


    $pages = Page::all();

                $links[] = '<?php ';
              

                foreach($pages as $p)
                
                $links[] ='$route["'.$p->title.'"] = "'.$p->route.'";';



                File::put(path('root').'public/ckeditor/plugins/internpage/routes.php', $links);  



    return Redirect::to('pages');
 
      }
    }
    

    public function post_save_page_atributes(){


         $attribute_id = Input::get('id');
         $attribute_type_id = Input::get('attribute_id');
         $page_id = Input::get('page_id');
         $type = Input::get('type');
         $name = Input::get('name');
         $content = Input::get('content');

         if($type == 'text'){
         
         if($attribute_id){

          $affected = DB::table($type.'_attribute')
            ->where('id', '=', $attribute_id)
            ->update(array('content' => $content,'name' => $name,'page_id' => $page_id));


         }else{

          DB::table($type.'_attribute')->insert(array('content' => $content,'name' => $name,'page_id' => $page_id));

         }

         }elseif($type == 'image'){

          $file_id = Input::get('file_id');

        

          if($attribute_id){

          $file = DB::table('files')->where_thumb_location($file_id)->first(); 

     

          $affected = DB::table($type.'_attribute')
            ->where('id', '=', $attribute_id)
            ->update(array('file_id' => $file->id,'name' => $name,'page_id' => $page_id,'type'=>'image'));


         }else{

          $file = DB::table('files')->where_thumb_location($file_id)->first();  

          DB::table($type.'_attribute')->insert(array('file_id' => $file->id,'name' => $name,'page_id' => $page_id, 'type'=>'image'));

         }

         } 
         

         return Redirect::to('pages/manage/'.$page_id);  


    }


    public function get_manage($id){

        $id =  $id;
        $page = Page::find($id);
        $theme = DB::table('themes')->where_active('1')->first(); 
        $dir = path('root').'cms_user/themes/views/themes/'.$theme->name.'/'; 
        $page_types = Page::pagetypes($dir);

       foreach($page_types as $key=>$value)
          $pagetypes[$value] =  $value;       

        $attributes = DB::table('page_atributes')->get();

        $files = Files::all();

        $pages = Page::all();
         foreach ($pages as $pa) {
             $parents[$pa->id] = $pa->name; 
         }


        
        $view = View::make('path: '.ADMIN_THEME_PATH.'pages/manage.blade.php')
        ->with('user',Auth::user())
        ->with('page',$page)
        ->with('attributes',$attributes)
        ->with('files',$files)
        ->with('parents',$parents)
        ->with('pagetypes',$pagetypes);

      return $view;
    }


     public function post_update_page() {

        $title = Input::get('title');
        $description = Input::get('description');
        $keywords = Input::get('keywords');
        $tags = Input::get('tags');

        $exclude_from_sitemap = Input::get('exclude_from_sitemap');
      
        $exclude_from_navigation = Input::get('exclude_from_navigation');
      
        $exclude_from_pagelist = Input::get('exclude_from_pagelist');
     
        $pagetype = Input::get('pagetype');
        $id = Input::get('id');

        $page = Page::find($id);

        $page->title = $title;
        $page->description = $description;
        $page->pagetype = $pagetype;
        $page->keywords = $keywords;
        $page->tags = $tags;
        $page->exclude_from_sitemap = $exclude_from_sitemap;
        $page->exclude_from_navigation = $exclude_from_navigation;
        $page->exclude_from_pagelist = $exclude_from_pagelist;
        $page->save();

        



        return Redirect::to('pages/manage/'.$id);


     }

      public function get_delete($id) {

        $affected = DB::table('pages')->delete($id);
      Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Page Deleted!</span>
                  </div>



        ');
      $pages = Page::all();

                $links[] = '<?php ';
               

                foreach($pages as $p)
                
                $links[] ='$route["'.$p->title.'"] = "'.$p->route.'";';



                File::put(path('root').'public/ckeditor/plugins/internpage/routes.php', $links);  
      return Redirect::to('pages');

      }

     public function post_add_attribute(){

         $name = Input::get('name');
         $type = Input::get('type');

         DB::table('page_atributes')->insert(array('name' => $name, 'type'=>$type));
         

          Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Attribute added!</span>
                  </div>



        ');

          return Redirect::to('pages/attributes');
     }

       public function post_edit_attribute($id){

            $name = Input::get('name');
         $type = Input::get('type');

        // DB::table('page_atributes')->insert(array('name' => $name, 'type'=>$type));
         
         $affected = DB::table('page_atributes')
              ->where_id($id)
              ->update(array('name' => $name, 'type'=>$type));

          Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Attribute updated!</span>
                  </div>



        ');

          return Redirect::to('pages/attributes');

       }


       public function get_delete_attribute($id){

        $affected = DB::table('page_atributes')->where('id', '=', $id)->delete();
         
        Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Attribute deleted!</span>
                  </div>



        ');

          return Redirect::to('pages/attributes');

       }


       public function post_order(){

         $items = $_POST['tree'];
      
  

        $total_items = count($items);

       
    

      for($item = 0; $item < $total_items; $item++ )
      {
  
              $data = array(
                  'id' => $items[$item],
                  'order' => $rank = $item
              );
        
              DB::table('pages')->where_id($data['id'])
              ->update(array('id'=> $data['id'],'order' => $data['order']));
        
          
             
      }  
        
       }
}