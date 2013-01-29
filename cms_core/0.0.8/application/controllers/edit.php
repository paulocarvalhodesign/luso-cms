<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 

class Edit_Controller extends Base_Controller {

	/*

	|--------------------------------------------------------------------------
	| The Home Controller
	|--------------------------------------------------------------------------
	*/

	public $restful = true;
	public $url;



	public function get_index($id)
	{

		$page_id =  $id;
        $page = Page::find($page_id);

        $user = Auth::user();
        $owner = $page->owner;

        if($user->canWrite() == 'true'){

        $page->edit_mode = 'true';
        
        }else{

        $message ='<div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span class="error">You dont have permitions to edit this page.</span></div>';    
        session::flash('message', $message);
        }

        $page->save();
        
        return Redirect::to($page->route);

	}

	public function get_publish($id){

		$page_id =  $id;
        $page = Page::find($page_id);
        $page->edit_mode = 'false';       
        $page->save();
        return Redirect::to($page->route);


	}
}