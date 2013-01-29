<?php
// to catch controllers
Route::controller(Controller::detect('content'));
Route::post('content/add', function() {
  	
  	$global = Input::get('global');
  	$page_id = Block::isGlobal( $global);
	$area    = Input::get('area');
	$content = Input::get('content');
	$template = Input::get('template');
	
	$page_blocks = DB::table('page_blocks')->where_page_id_and_area_id($page_id, $area)->order_by('order','desc')->first();
	
	if(empty($page_blocks)){
		$order = '0';
	}else{
		$order = $page_blocks->order + 1;
	}


	$content = Content\Models\Contentblock::create(array(
		'page_id'=> $page_id,
		'area_id'=> $area,
		'content'=> $content,
		'template'=> $template,
		'block_handle'=>'contentblock',
		'block_name'=>'content'

		));

	

	$block = array(
			'page_id'=> $page_id,
			'area_id'=> $area,
			'block_handle'=>'contentblock',
			'block_slug'=>'content',
			'block_id'=> $content->id,
			'order'=> $order

			);

	$page_id = Input::get('page_id');
	$page = Page::find($page_id);


	DB::table('page_blocks')->insert($block);

	 return Redirect::to($page->route);

});


Route::post('content/edit', function() {

  	$global = Input::get('global');
  	$page_id = Block::isGlobal( $global);
	
	$id = Input::get('id');
	
	$newcontent = Input::get('content');
	$template = Input::get('template');

	$content = Content\Models\Contentblock::find($id);
	$content->content = $newcontent;
	$content->template = $template;
	$content->save();

	
		
	
	 $page_id = Input::get('page_id');
	 $page = DB::table('pages')->find($page_id);

	

	return Redirect::to($page->route);

});