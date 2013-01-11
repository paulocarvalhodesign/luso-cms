<?php
// to catch controllers
Route::controller(Controller::detect('slider'));
Route::post('slider/add', function() {
  
	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	$area    = Input::get('area');
	$content = Input::get('set');
	$template = Input::get('template');


	$content = Slider\Models\Sliderblock::create(array(
		'page_id'=> $page_id,
		'area_id'=> $area,
		'slider_id'=> $content,
		'block_handle'=>'sliderblock',
		'block_name'=>'slider',
		'template'=>$template

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
				'block_handle'=>'sliderblock',
				'block_slug'=>'slider',
				'block_id'=> $content->id,
				'order'=> $order			

			);
	$page_id = Input::get('page_id');
	$page = Page::find($page_id);


	DB::table('page_blocks')->insert($block);

	 return Redirect::to($page->route);

});


Route::post('slider/edit', function() {

  	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	$id = Input::get('id');
	$template = Input::get('template');
    
	$newcontent = Input::get('set');

	$content = Slider\Models\Sliderblock::find($id);
	$content->slider_id = $newcontent;
	$content->template = $template;
	$content->save();

	
		
	
	$page_id = Input::get('page_id');	
	 $page = DB::table('pages')->find($page_id);

	

	return Redirect::to($page->route);

});