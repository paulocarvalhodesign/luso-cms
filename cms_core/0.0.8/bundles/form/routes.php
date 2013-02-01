<?php
// to catch controllers
Route::controller(Controller::detect('form'));

Route::group(array('before' => 'auth'), function()
    {


Route::get('form/list', function(){

	
	$forms = DB::table('forms')->get();

	 $view = View::make('Form::dashboard.form')
        ->with('user',Auth::user())
        ->with('forms', $forms);

      return $view;


});

//Route::get('form/list', array('uses'=>'form@list'));

Route::get('form/manage_form/(:num)', function($id){

	 
	 $form  = DB::table('forms')->find($id);
	 $fields = DB::table('form_fields')->where_form_id($id)->order_by('order', 'asc')->get();

	 $view = View::make('Form::dashboard.manage')
        ->with('user',Auth::user())
        ->with('fields',$fields)
        ->with('form_id',$id)
        ->with('form', $form);

      return $view;


});

Route::post('form/manage_form', function(){

	$id = Input::get('id');
	$name = Input::get('name');
	$title = Input::get('title');
	$message = Input::get('message'); 

	$rules = array(
                        'id'  => 'required',
                        'name' => 'required',
                        'title' => 'required',
                        'message' => 'required',
                    );
        $input = Input::all();
        $validation = Validator::make($input, $rules);
	 
	  if ($validation->fails())
        {
              $errors = $validation->errors->all('<p>:message</p>'); 
    
              $message ='<div class="alert alert-error">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span class="error">';    

                  foreach($errors as $error)

                  $message .= $error;

                  $message .=' </span> </div>';



  

            Session::flash('info', $message);     
            return Redirect::to('form/manage_form/'.$id);
        
        }else{

        	$data = array(

        		'name' => $name,
        		'title'=> $title,
        		'message'=>$message

        		);

        	 $affected = DB::table('forms')
			    ->where('id', '=', $id)
			    ->update($data);

			 $message ='<div class="alert alert-info">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <span class="error">';    

              $message .=' Form Updated';
                  
              $message .=' </span> </div>';



  

            Session::flash('info', $message);        

        	 return Redirect::to('form/manage_form/'.$id);

        }
	


});

Route::post('form/new', function(){


	$form = Input::get('name');

       
	DB::table('forms')->insert(array('name'=>$form));
	Session::flash('info', '
				  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Form Created!</span>
                  </div>



		');
    return Redirect::to('form/list');



});

Route::post('form/new_field', function(){


	$name = Input::get('name');
	$label = Input::get('label');
	$type = Input::get('type');
	$rules = Input::get('rules');
	$form_id = Input::get('form_id');
	$options = Input::get('options');

       
	DB::table('form_fields')->insert(array(
		'form_id' =>$form_id,
		'name' 		=>$name,
		'label'		=>$label,
		'type' 		=>$type,
		'rules'		=>$rules,
		'options'	=>$options


		 ));
	Session::flash('info', '
				  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Field Created!</span>
                  </div>



		');
    return Redirect::to('form/manage_form/'.$form_id);



});

Route::post('form/edit_field/(:num)', function($id){


	$name = Input::get('name');
	$label = Input::get('label');
	$type = Input::get('type');
	$rules = Input::get('rules');
	$form_id = Input::get('form_id');
	$options = Input::get('options');

       
	DB::table('form_fields') ->where_id($id)->update(array(
		'form_id' =>$form_id,
		'name' 		=>$name,
		'label'		=>$label,
		'type' 		=>$type,
		'rules'		=>$rules,
		'options'	=>$options


		 ));
	Session::flash('info', '
				  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Field Updated!</span>
                  </div>



		');
    return Redirect::to('form/manage_form/'.$form_id);



});


Route::get('form/delete_form/(:num)', function($id){


        DB::table('forms')->delete($id);
        Session::flash('info', '
        	<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Form Deleted !</span>
                  </div>


        	');

        return Redirect::to('form/list');




    });
Route::get('form/delete_field/(:num)', function($id){

	

        DB::table('form_fields')->delete($id);
        Session::flash('info', '
        	<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">Field Deleted !</span>
                  </div>


        	');
        
        return Redirect::to('form/list');




    });
Route::post('form/add', function() {
  
	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	$area    = Input::get('area');
	$content = Input::get('form');


	$content = Form\Models\Formblock::create(array(
		'page_id'=> $page_id,
		'area_id'=> $area,
		'form_id'=> $content,
		'block_handle'=>'formblock',
		'block_name'=>'form'

		));

	$page_blocks = DB::table('page_blocks')->where_page_id_and_area_id($page_id, $area)->order_by('order','desc')->first();
	
	
	if(empty($page_blocks)){
		$order = '0';
	}else{
		$order = $page_blocks->order + 1;
	}
	

	$block = array(
			'page_id'=> $page_id,
			'area_id'=> $area,
			'block_handle'=>'formblock',
			'block_slug'=>'form',
			'block_id'=> $content->id,
			'order'=> $order
			

			);
	$page_id = Input::get('page_id');
	$page = Page::find($page_id);


	DB::table('page_blocks')->insert($block);

	 return Redirect::to($page->route);

});


Route::post('form/edit', function() {

  	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	
	$id = Input::get('id');
	
	$newcontent = Input::get('form_id');

	$content = Form\Models\Formblock::find($id);
	$content->form_id = $newcontent;
	$content->save();

	
		
	
	 $page_id = Input::get('page_id');	
	 $page = DB::table('pages')->find($page_id);

	

	return Redirect::to($page->route);

});
Route::post('form/fields_order', function(){

				$items = Input::get('item');
				$total_items = count($items);

			for($item = 0; $item < $total_items; $item++ )
	    {
	
	            $data = array(
	                'id' => $items[$item],
	                'order' => $rank = $item
	            );
				
	            DB::table('form_fields')->where_id($data['id'])
	            ->update(array('id'=> $data['id'],'order' => $data['order']));
	
	            	
	    }  


				
		});
});

  Route::post('process_form', function() {

	$user =  Auth::user(); 


	$page  = Input::get('page');
	$email  = Input::get('email');
	$form_id  = Input::get('form_id');

	$fields = DB::table('form_fields')->where('form_id', '=',$form_id)->get();

	
	
	$rules = array();

	foreach($fields as $field){

		if(empty($field)){

		
		}elseif($field->type == 'checkbox'){



		}else{
		$rules[$field->name] = $field->rules;
		}
	}


	$input = Input::all();


	

	$validation = Validator::make($input, $rules);

		if ($validation->fails())
		{
		
		$errors = $validation->errors->all('<p>:message</p>'); 
		
		$message ='<div class="alert alert-error">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">';		

        foreach($errors as $error)

        	$message .= $error;

        $message .=' </span> </div>';







		 Session::flash('success', $message);
		
		 return Redirect::to($page); 
		
		}else{

	$body ='';

	
	

	foreach($fields as $field){
		$name = Input::get($field->name);
		if($field->type == 'checkbox' || Input::get($field->name) == '1'){
			$name = 'yes';
		}elseif($field->type == 'checkbox' || Input::get($field->name) == ''){
			$name = 'no';
		}



		$body .=" ".$field->label."    ".$name."\r\n";
	}
	

	$form = DB::table('forms')->where('id','=',$form_id)->first();

	$email ='cms@lusocms.org';
	
	Message::to($user->username)
    ->from($email)
    ->subject('Form')
    ->body($body)
    ->send();
	Session::flash('success', '
				  <div class="alert alert-info">
                  <button type="button" class="close" data-dismiss="alert">×</button>
                  <span class="error">'.$form->message.'</span>
                  </div>



		');
	  
     return Redirect::to($page);
	}



  });
		

		

