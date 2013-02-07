<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 
class Files_Controller extends Dashboard_Controller {

    /*
     |--------------------------------------------------------------------------
     | The Files Controller 
     |--------------------------------------------------------------------------
     |
     */


    public $restful = true;
    

    /*
     |--------------------------------------------------------------------------
     | The Files index
     |--------------------------------------------------------------------------
     |
     */


    public function get_index() {

      
     $files    = DB::table('files')->get();

     if(empty($files))
      
       $files = '';
     else 
       $files    = DB::table('files')->order_by('id', 'desc')->paginate('8');
     



     $all_sets = DB::table('sets')->get();

     if($all_sets){
      foreach($all_sets as $set)

            $sets[$set->id] = $set->name;
        }else{
           $sets []= ''; 
     }
     
     $view = View::make('path: '.ADMIN_THEME_PATH.'files/files.blade.php')
     ->with('user',Auth::user())
     ->with('files', $files)
     ->with('sets', $sets);

      return $view;
 
    }

    
    /*
     |--------------------------------------------------------------------------
     | Sets page 
     |--------------------------------------------------------------------------
     |
     */


    public function get_sets() {
        
     $sets   = DB::table('sets')->paginate('20');
     $set_id = CMS::last();
    
     $view = View::make('path: '.ADMIN_THEME_PATH.'files/sets.blade.php')
        ->with('user',Auth::user())
        ->with('sets', $sets)
        ->with('edit_id',$set_id);

       
      return $view;
 
    }

    /*
     |--------------------------------------------------------------------------
     | Add a new set.
     |--------------------------------------------------------------------------
     |
     */
    
    public function post_sets() {
    
       $setname = Input::get('setname');

       Set::create(array(

        'name' => $setname

        ));
      
       Session::flash('info', '
                    <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <span class="error">Set Created!</span>
                    </div>



          ');

      return Redirect::to('files/sets');

    }
    

    /*
     |--------------------------------------------------------------------------
     | Manage a specific set.
     |--------------------------------------------------------------------------
     |
     */

    public function get_set_manage() {
        
    


     $sets = DB::table('sets')->paginate('20');

     
     $view = View::make('path: '.ADMIN_THEME_PATH.'files/sets.blade.php')
        ->with('user',Auth::user())
        ->with('sets', $sets);

      return $view;
 
    }

    /*
     |--------------------------------------------------------------------------
     | Delete a specific set.
     |--------------------------------------------------------------------------
     |
     */

    public function get_delete_set($id) {


        $set = Set::find($id);

 
        $affected = DB::table('files_in_sets')->where_set_id($id)->delete();


        $set->delete();

        Session::flash('info', '
                    <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <span class="error">Set deleted!</span>
                    </div>



          ');


        return Redirect::to('files/sets');


      }


    /*
     |--------------------------------------------------------------------------
     |Upload files
     |--------------------------------------------------------------------------
     |
     */
   
    public function post_upload() {


        $input     = Input::all();
        $setname   = Input::get('set'); 
        $ext       = File::extension($input['file']['name']);
        $extension = strtolower ( $ext );
        $file  = trim($input['file']['name']);
        $filename = str_replace(" ","_", $file);
        
        if(

          $extension == 'jpg'  ||
          $extension == 'jpeg' ||
          $extension == 'png'  || 
          $extension == 'gif'  ||
          $extension == 'ico' 
          
          ){

        $directory      = path('root').'public/filemanager/images/';
        $upload_success = Input::upload('file', $directory, $filename);
        $img            = url('public/filemanager/images/'.$filename);

       
        if( $upload_success ) {
            Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">File Uploaded!</span>
                  </div>



        ');        } else {
           Session::flash('info', '
                  <div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">There was an error with the upload process, please try again...</span>
                  </div>



        ');
        }
        if( $upload_success ) {
          
          
           
          Files::create(array(
          'title' => $input['title'],  
          'filename' => $input['file']['name'],
          'description' => $input['description'],
          'location' => 'public/filemanager/images/'.$filename,
          'thumb_location' => 'public/filemanager/thumbs/images/'.$filename,
          'mime' => $extension,

            ));

          $square = Resizer::open($img)
                ->resize( 75 , 75 , 'crop')
                ->save(path('root').'public/filemanager/thumbs/images/'.  $filename, 90 ); 
            
            if (!$square) {
                die('Resize failed');
            }
          
         }

         $square = Resizer::open($img)
                ->resize( 750 , 200 , 'landscape')
                ->save(path('root').'public/filemanager/level2/images/'.  $filename, 90 ); 
            
            if (!$square) {
                die('Resize failed');
            }
          
        
        
        
        }
        
        else
        
        {

        $directory = path('root').'public/filemanager/files/';
        $upload_success = Input::upload('file', $directory, $filename);
        
       

       
        if( $upload_success ) {

           
            if($extension == 'mp3' || $extension == 'wav' || $extension == 'ogg' || $extension == 'mp4'){
                $thumb = 'music.png';
            }elseif($extension == 'zip' || $extension == 'rar'){
                 $thumb = 'compressed.png';
            }
            elseif($extension == 'pdf'){
                 $thumb = 'pdf.png';
            }








            Files::create(array(
              'filename' => $input['file']['name'],
              'description' => $input['description'],
              'location' => 'public/filemanager/files/'.$filename,
              'thumb_location' => 'public/global/file-types/'.$thumb,
              'mime' => $extension,

            ));

        } else {

             Session::flash('info', '
                  <div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">There was an error with the upload process, please try again...</span>
                  </div>



        ');
        }
        

        }
        Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">File Uploaded!</span>
                  </div>



        ');



        if(!empty($setname)) {
           $set_id = DB::table('sets')->where_name($setname)->first();    

           $final_set = $set_id->id;
          


           $files = DB::table('files')->where_filename($filename)->only('id'); 

          if($files == '0' || $files == null)  {}   

            else{
            $file = array(
                'set_id' => $final_set,
                'file_id'=>$files

              );

          DB::table('files_in_sets')->insert($file); 
            } 
          }
            
          


        return Redirect::to('files');

    }


    /*
     |--------------------------------------------------------------------------
     | Delets a file .
     |--------------------------------------------------------------------------
     |
     */
     

     public function get_delete_file($id) {

        $file = Files::find($id);


        File::delete(path('root').$file->location);
        File::delete(path('root').$file->thumb_location);
        File::delete(path('root').'public/filemanager/level2/images/'.$file->filename);


        $file->delete();

        DB::table('files_in_sets')->where_file_id($id)->delete();
        DB::table('image_attribute')->where_file_id($id)->delete();


         Session::flash('info', '
                    <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <span class="error">File deleted!</span>
                    </div>



          ');



        return Redirect::to('files');


     }


      
     public function get_remove_from_set($id) {

        $affected = DB::table('files_in_sets')->delete($id);
        Session::flash('info', '
                    <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <span class="error">File Removed from set!</span>
                    </div>



          ');
        return Redirect::to('files');


     }

     public function post_save_properties(){

        $id = Input::get('id');
        $description = Input::get('description');
        $title = Input::get('title');

         $update = DB::table('files')->where_id($id)
              ->update(array('title'=>$title,'description' => $description));
        


        Session::flash('info', '
                    <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <span class="error">Properties updated!</span>
                    </div>



          ');
       return Redirect::to('files');

     }
       public function post_add_to_set(){

       $set = Input::get('set');
       $file = Input::get('file');

        $file = array(
            'set_id' => $set,
            'file_id'=>$file

          );

      DB::table('files_in_sets')->insert($file);

      Session::flash('info', '
                    <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <span class="error">File added to set!</span>
                    </div>



          ');

     return Redirect::to('files'); 



       }

       public function post_multi_upload(){

         $input = Input::all();
         $set = Input::get('set');
         $setname = Input::get('set');
         $ext = File::extension($input['file']['name']);
         $extension =  strtolower ( $ext );
         $file = trim($input['file']['name']);
         $filename = str_replace(" ","_", $file);


         try
         
         {
           $directory = path('root').'public/filemanager/compressed/';
           $temp = path('root').'public/filemanager/compressed/temp/';
         }

        catch(exception $e)
        {

            Session::flash('info', '
                      <div class="alert alert-danger">
                      <button type="button" class="close" data-dismiss="alert">×</button>
                      <span class="error">Permitions error :: '.$e->getMessage().'</span>
                      </div>



            ');
         }


         try
         
         {


         $upload_success = Input::upload('file', $directory, $filename);
        
         
         }
        
         catch(exception $e){

          Session::flash('info', '
                    <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <span class="error">Upload failed :: '.$e->getMessage().'</span>
                    </div>



          ');

         }
         
        


          $zip = new ZipArchive;
          $res = $zip->open($directory.$filename);
          if ($res === TRUE) {
            $zip->extractTo($temp);
            $zip->close();
          
           $files = scandir($temp) ;

          foreach ($files as $filetype) {

            $file = $temp.$filetype;
            $ext =  File::extension($temp.$file);
            $extension =  strtolower ( $ext );
            $filename = str_replace(" ","_", $filetype);
            


            if ($filetype != "." && $filetype != ".." && $filetype != "__MACOSX" && $filetype != ".gitignore") {

              if(
                $extension == 'jpg'  ||
                $extension == 'jpeg' ||
                $extension == 'png'  || 
                $extension == 'gif'  ||
                $extension == 'ico' 
                )

              {
              copy($file, path('root').'public/filemanager/images/'.$filename);
               
               Files::create(array(
                  'filename' => $filename,
                  'location' => 'public/filemanager/images/'.$filename,
                  'thumb_location' => 'public/filemanager/thumbs/images/'.$filename,
                  'mime' => $extension,
                    ));

                $new_file = path('root').'public/filemanager/images/'.$filename;

                  $square = Resizer::open($new_file)
                        ->resize( 75 , 75 , 'crop')
                        ->save(path('root').'public/filemanager/thumbs/images/'. $filename, 90 ); 
                    
                    if (!$square) {
                        die('Resize failed');
                    }

                   $square = Resizer::open($new_file)
                        ->resize( 750 , 200 , 'landscape')
                        ->save(path('root').'public/filemanager/level2/images/'.  $filename, 90 ); 
                    
                    if (!$square) {
                        die('Resize failed');
                    } 
                  
                 }

                 else{

                   $thumb = '';

                    if($extension == 'mp3' || $extension == 'wav' || $extension == 'ogg' || $extension == 'mp4'){
                                $thumb = 'music.png';
                            }elseif($extension == 'zip' || $extension == 'rar'){
                                 $thumb = 'compressed.png';
                            }
                            elseif($extension == 'pdf'){
                                 $thumb = 'pdf.png';
                            } 

                    Files::create(array(
                      'filename' => $filename,
                      'location' => 'public/filemanager/files/'.$filename,
                      'thumb_location' => 'public/global/file-types/'.$thumb,
                      'mime' => $extension,

                    ));
            }


               } 
            else{

             Session::flash('info', '
                    <div class="alert alert-info">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <span class="error">Zip file uploaded and files added!</span>
                    </div>

            ');
                 
            }

          if(!empty($setname)) {
           $set_id = DB::table('sets')->where_name($setname)->first();    

           $final_set = $set_id->id;
          


           $files = DB::table('files')->where_filename($filetype)->only('id'); 

          if($files == '0' || $files == null)  {}   

            else{
            $file = array(
                'set_id' => $final_set,
                'file_id'=>$files

              );

          DB::table('files_in_sets')->insert($file); 
            } 
          }
            
          }
          
          File::rmdir($directory);
          File::mkdir($temp); 

          } else {
           



          }

         return Redirect::to('files');
        

       }

       public function post_reorder_set(){

        $items = Input::get('item');
        $total_items = count($items);

      for($item = 0; $item < $total_items; $item++ )
      {
  
              $data = array(
                  'id' => $items[$item],
                  'order' => $rank = $item
              );
        
              DB::table('files_in_sets')->where_id($data['id'])
              ->update(array('id'=> $data['id'],'order' => $data['order']));
  
                
      }  
      
    }
}