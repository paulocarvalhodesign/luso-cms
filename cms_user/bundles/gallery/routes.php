<?php
// to catch controllers
Route::controller(Controller::detect('gallery'));
Route::post('gallery/add', function() {
  
	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	$area    = Input::get('area');
	$content = Input::get('set');


	$content = Gallery\Models\Galleryblock::create(array(
		'page_id'=> $page_id,
		'area_id'=> $area,
		'gallery_id'=> $content,
		'block_handle'=>'galleryblock',
		'block_name'=>'gallery'

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
				'block_handle'=>'galleryblock',
				'block_slug'=>'gallery',
				'block_id'=> $content->id,
				'order'=> $order			

			);
	$page_id = Input::get('page_id');
	$page = Page::find($page_id);


	DB::table('page_blocks')->insert($block);

	 return Redirect::to($page->route);

});


Route::post('gallery/edit', function() {

  	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	$id = Input::get('id');

    
	$newcontent = Input::get('set');

	$content = Gallery\Models\Galleryblock::find($id);
	$content->gallery_id = $newcontent;
	$content->save();

	
		
	
	$page_id = Input::get('page_id');	
	 $page = DB::table('pages')->find($page_id);

	

	return Redirect::to($page->route);

});