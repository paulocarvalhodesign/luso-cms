<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 
class Login_Controller extends Base_Controller {

    /*
     |--------------------------------------------------------------------------
     | The Content Controller
     |--------------------------------------------------------------------------
     |
     */
    public $restful = true;

    public function get_index() {
        
       //$view = View::make('themes.admin.pagetypes.login');
       $view = View::make('path: '.ADMIN_THEME_PATH.'login.blade.php');

      return $view;
 
    }

     public function post_index() {

        $userinfo = array( 
                'username' => Input::get('username'),
                'password' => Input::get('password')
                );

           
            if( Auth::attempt($userinfo) )
                {
                
                    $remember = Input::get('remember');

                        if(!empty($remember))
                        {
                            Auth::login(Auth::user()->id, true);
                        }

                // we are now logged in, go to home
                //Auth::login(Auth::user()->id, true);
                return Redirect::to('admin');
               
                   
                }
                else
                {
                
                // auth failure! lets go back to the login
                 return Redirect::to('login')->with('login_errors', true);
              
                
                }   

     }
}