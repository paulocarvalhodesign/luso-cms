<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 
class Settings_Controller extends Dashboard_Controller {

    /*
     |--------------------------------------------------------------------------
     | The Admin Controller 
     |--------------------------------------------------------------------------
     |
     */


    public $restful = true;
    

    public function get_index() {
        
     $mmode = DB::table('settings')->where_name('maintenance-mode')->get();
     $name = DB::table('settings')->where_name('site_name')->get();
     $error_level = DB::table('settings')->where_name('error_level')->get();
     $analytics = DB::table('analytics')->get();

     if(empty($analytics))
     {
        $username = '';
        $password = '';
        $profile  = '';
      }else
      { 
        foreach($analytics as $analytic)
         $username = $analytic->username;
         $password = $analytic->password;
         $profile  = $analytic->profile;

      }
     $avthemes = Theme::all();
    foreach($avthemes as $t)
        $allthemes[$t->name] =$t->name ;


     $themes = DB::table('themes')->where_active('1')->get();
     foreach($themes as $t)
     $theme = $t->name;



    $view = View::make('path: '.ADMIN_THEME_PATH.'settings.blade.php')
        ->with('user',Auth::user())
        ->with('mmode',$mmode)
        ->with('sitename',$name)
        ->with('error_level',$error_level)
        ->with('theme',$theme)
        ->with('username',$username)
        ->with('password',$password)
        ->with('profile',$profile)
        ->with('themes',$allthemes);

      return $view;
 
    }


    public function post_maintenance() {

    $mode = Input::get('maintenance_mode');

     if($mode == 'false'){
      $maintenance = 'off';
     }elseif($mode == 'true'){
      $maintenance = 'on';
     }

    $affected = DB::table('settings')
    ->where('name', '=', 'maintenance-mode')
    ->update(array('value' => $mode));



     Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Maintenance mode is '.$maintenance.'!</span>
                  </div>



        ');
     return Redirect::to('settings');

    
 }

 public function post_error_level() {

    $mode = Input::get('error_level');

     if($mode == 'false'){
      $maintenance = 'Production';
     }elseif($mode == 'true'){
      $maintenance = 'Development';
     }

    $affected = DB::table('settings')
    ->where('name', '=', 'error_level')
    ->update(array('value' => $mode));


    $a ="'";
                 $data[] = '<?php ';
                 $data[] ='$error ='.$mode.';';     
                
               
                
                
                File::put(path('app').'config/cms_error.php', $data);   

     Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Error Level is '.$maintenance.'!</span>
                  </div>



        ');
     return Redirect::to('settings');

    
 }

  public function post_analytics() {

     $username = Input::get('username');
     $password = Input::get('password');
     $profile = Input::get('profile');
     
     $tracking_code = Input::get('tracking_code');
     

     $analytics = DB::table('analytics')->get();

     if($analytics){

      $affected = DB::table('analytics')
     ->where('id', '=', '1')
     ->update(array('username' => $username, 'password'=>$password,'profile'=>$profile));

      File::put(path('root').'cms_config/tracking_code.php', $tracking_code);

     Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Saved!</span>
                  </div>



        ');


     }else{

      $affected = DB::table('analytics')
     
     ->insert(array('username' => $username, 'password'=>$password,'profile'=>$profile));

      File::put(path('root').'cms_config/tracking_code.php', $tracking_code);

     Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Saved!</span>
                  </div>



        ');

     }

     

     return Redirect::to('settings');

  }

   public function post_sitename() {

    $name = Input::get('site_name');

     

    $affected = DB::table('settings')
    ->where('name', '=', 'site_name')
    ->update(array('value' => $name));

     Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Sitename Changed!</span>
                  </div>



        ');
     return Redirect::to('settings');



   }

     public function post_theme() {

        $name = Input::get('theme');

     $themes = DB::table('themes')->where_active('1')->get();
     foreach($themes as $t)
     $theme = $t->name;

    
     $affected = DB::table('themes')
    ->where('name', '=', $theme)
    ->update(array('active' => '0'));

     $affected = DB::table('themes')
    ->where('name', '=', $name)
    ->update(array('active' => '1'));

     Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Theme Changed!</span>
                  </div>



        ');
     return Redirect::to('settings');
        
     }

     public function post_theme_install(){


         $input = Input::all();
         
         $filename = trim($input['file']['name']);

         $directory = path('root').'public/themes/';
         
         $temp = path('root').'public/themes/temp/';

        
         $destination_views = path('root').'cms_user/themes/views/themes/';

         $upload_success = Input::upload('file', $directory, $filename);

         
         Session::flash('info', '
                    <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <span class="error">Theme uploaded and installed!</span>
                    </div>



          ');

         

          $zip = new ZipArchive;
          $res = $zip->open($directory.$filename);
          if ($res === TRUE) {
            $zip->extractTo($temp);
            $zip->close();
          
           $files = scandir($temp) ;



           $withoutExt = preg_replace("/\\.[^.\\s]{3,4}$/", "", $filename);

           $views = File::cpdir($temp.$withoutExt.'/views/', $destination_views);
           $assets = File::cpdir($temp.$withoutExt.'/assets/', $directory);


         
          
          File::delete($directory.$filename);
          File::rmdir($temp);
          File::mkdir($temp); 

          DB::table('themes')->insert(array(
            
            'name' => $withoutExt,
            'description' => '',
            'active' => '0'
            ));


          } else {
           



          }

         return Redirect::to('settings');


     }
    
}