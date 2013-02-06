<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 
class Admin_Controller extends Dashboard_Controller {

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
      
        $analytics = DB::table('analytics')->get();

 

        if($analytics){
       
        foreach($analytics as $analytic)
         $ga_email = $analytic->username;
         $ga_password = $analytic->password;
         $ga_profile_id  = $analytic->profile;
        }
        else{

         $analytics =''; 
         $ga_email = '';
         $ga_password = '';
         $ga_profile_id  = '';
        }

        if(!empty($ga_email) && !empty($ga_password) && !empty($ga_profile_id))
        {
          try{
       
        $ga = new gapi($ga_email,$ga_password);
        $ga->requestReportData($ga_profile_id, array('date'),array('pageviews', 'uniquePageviews', 'exitRate', 'avgTimeOnPage', 'entranceBounceRate', 'newVisits'), 'date');
        $results = $ga->getResults();  
         
          }catch(Exception $e){

            $results = '';

          }
        }else{
           
            $results = '';
        }
        
  
    
     $view = View::make('path: '.ADMIN_THEME_PATH.'admin.blade.php')
        ->with('user',Auth::user())
        ->with('ga_email', $ga_email)
        ->with('ga_password', $ga_password)
        ->with('ga_profile_id', $ga_profile_id)
        ->with('results',$results);

      return $view;
 
    }

    /*
     |--------------------------------------------------------------------------
     |Process Upgrade, download package, unzip, move and set new version
     |--------------------------------------------------------------------------
     |
     */


     public function get_cms_upgrade_download() {

            
            //Get version from http://lusocms.org

            $version = 'http://lusocms.org/version.xml';
            $xml=simplexml_load_file($version);
            $version =$xml->value;

             //Get zip file from http://lusocms.org and copy to temp folder

            $file = 'http://lusocms.org/'.$version.'.zip';
            $newfile = path('root').'cms_core/temp/'.$version.'.zip';
            $temp = path('root').'cms_core/';
            copy($file, $newfile) ;


            //Unzip package

            $zip = new ZipArchive;
            $res = $zip->open($newfile);
            if ($res === TRUE) {
            $zip->extractTo($temp);
            $zip->close();
            }
            
             //Write new version

            $a ="'";
                 $data[] = '<?php ';
                 $data[] ='$version ='.$a.$version.$a.';';     
                
               
                
                
            File::put(path('root').'cms_config/version.php', $data);   

            

            Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Upgrade downloaded and Unpacked!</span>
                  </div>

                ');    


         return Redirect::to('admin');

     } 

     /*
     |--------------------------------------------------------------------------
     |Finish  Upgrade, check if there is a finish upgrade script, if so process it.
     |--------------------------------------------------------------------------
     |
     */

    public function get_finish_upgrade() {

            
            require path('base').'upgrade.php';
            
            $false = 'false';
            
            $a ="'";
                     $data[] = '<?php ';
                     $data[] ='$include_script ='.$false.';';     
                    
                   
                    
                    
             File::put(path('app').'config/cms_upgrade.php', $data);   

             Session::flash('info', '
                      <div class="alert alert-info">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <span class="error">Upgrade finalized!</span>
                      </div>

                    ');        

            return Redirect::to('admin');


    }
        
}