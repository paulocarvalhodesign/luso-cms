<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 
class Users_Controller extends Dashboard_Controller {

    /*
     |--------------------------------------------------------------------------
     | The Admin Controller 
     |--------------------------------------------------------------------------
     |
     */


    public $restful = true;
    

    public function get_index() {
        
     $users = User::all();   

     
     $view = View::make('path: '.ADMIN_THEME_PATH.'users.blade.php')
        
        ->with('users',$users)
        ->with('user',Auth::user());

      return $view;
 
    }

    public function get_properties() {
        

     $view = View::make('path: '.ADMIN_THEME_PATH.'users.blade.php')
        ->with('user',Auth::user());

      return $view;
 
    }
     public function post_new() {


            $avatar = Input::get('avatar');
            $nickname = Input::get('nickname');
            $username = Input::get('username');
            $firstname = Input::get('firstname');
            $lastname = Input::get('lastname');
            $password = Input::get('password');
            $pass = Hash::make($password);


            $user = new User();
                
            $user->avatar = $avatar;
            $user->nickname = $nickname;
            $user->username = $username;
            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->password = $pass;

      

            $user->save();
            Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">User Created!</span>
                  </div>



        ');

            return Redirect::to('users');
          
    }

    public function post_update() {

            $avatar = Input::get('avatar');
            $user_id = Input::get('id');
            $nickname = Input::get('nickname');
            $username = Input::get('username');
            $firstname = Input::get('firstname');
            $lastname = Input::get('lastname');


            $user = User::find($user_id);
                
             $password = Input::get('password');
            if(!empty($password))
                   
                    $pass = Hash::make($password);
            else
                    $pass = $user->password;
   

            $user->avatar = $avatar;
            $user->nickname = $nickname;
            $user->username = $username;
            $user->firstname = $firstname;
            $user->lastname = $lastname;
            $user->password = $pass;

            print_r($avatar);

            $user->save();

            Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">User Updated!</span>
                  </div>



        ');

           return Redirect::to('users');
          
    }
    public function get_delete($id){

      if(!$id == '1')
      $affected = DB::table('users')->delete($id);
     
      Session::flash('info', '
                  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">User Deleted!</span>
                  </div>



        ');
      return Redirect::to('users');
    }
    
}