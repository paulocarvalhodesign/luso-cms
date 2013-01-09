<?php
// to catch controllers
Route::controller(Controller::detect('navigation'));
Route::post('navigation/add', function() {
  
	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	$area    = Input::get('area');
	$template = Input::get('template');
	if(empty($template)){
			$template ='';
		}


	$navigation = Navigation\Models\Navigationblock::create(array(
		'page_id'=> $page_id,
		'area_id'=> $area,
		'template'=>$template,
		'block_handle'=>'navigationblock',
		'block_name'=>'navigation'

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
				'block_handle'=>'navigationblock',
				'block_slug'=>'navigation',
				'block_id'=> $navigation->id,
				'order'=> $order
			

			);
	$page_id = Input::get('page_id');	
	$page = Page::find($page_id);


	DB::table('page_blocks')->insert($block);

	 return Redirect::to($page->route);

});
Route::post('navigation/edit', function() {

  	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	$area    = Input::get('area');
	$id = Input::get('id');
	
	$newcontent = Input::get('template');

	$content = Navigation\Models\Navigationblock::find($id);
	$content->template = $newcontent;
	$content->save();

	
		
	
	 $page_id = Input::get('page_id');	
	 $page = DB::table('pages')->find($page_id);

	

	return Redirect::to($page->route);

});