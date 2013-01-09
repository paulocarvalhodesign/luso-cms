<?php
// to catch controllers
Route::controller(Controller::detect('layout'));
Route::post('layout/add', function() {
  	
  	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	
	$area    = Input::get('area');
	$content = Input::get('content');
	
	$page_blocks = DB::table('page_blocks')->where_page_id_and_area_id($page_id, $area)->order_by('order','desc')->first();
	
	if(empty($page_blocks)){
		$order = '0';
	}else{
		$order = $page_blocks->order + 1;
	}


	$content = Layout\Models\Layoutblock::create(array(
		'page_id'=> $page_id,
		'area_id'=> $area,
		'content'=> $content,
		'block_handle'=>'layoutblock',
		'block_name'=>'layout'

		));

	

	$block = array(
			'page_id'=> $page_id,
			'area_id'=> $area,
			'block_handle'=>'layoutblock',
			'block_slug'=>'layout',
			'block_id'=> $content->id,
			'order'=> $order

			);

	$page_id = Input::get('page_id');
	$page = Page::find($page_id);


	DB::table('page_blocks')->insert($block);

	 return Redirect::to($page->route);

});


Route::post('layout/edit', function() {

  	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	
	$id = Input::get('id');
	
	$newcontent = Input::get('content');

	$content = Layout\Models\Layoutblock::find($id);
	$content->content = $newcontent;
	$content->save();

	
		
	
	 $page_id = Input::get('page_id');
	 $page = DB::table('pages')->find($page_id);

	

	return Redirect::to($page->route);

});