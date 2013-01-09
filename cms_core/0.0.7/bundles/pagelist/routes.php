<?php
// to catch controllers
Route::controller(Controller::detect('pagelist'));
Route::post('pagelist/add', function() {
  
	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	$area    = Input::get('area');
	$pagetype = Input::get('pagetype');
	$ammount = Input::get('ammount');
	$location = Input::get('location');
	$pagination = Input::get('pagination');
	$position = Input::get('position');
	$order_by = Input::get('order_by');
	if(empty($pagination))
		$pagination = '0';
	$template = Input::get('template');
	
	$page_blocks = DB::table('page_blocks')->where_page_id_and_area_id($page_id, $area)->order_by('order','desc')->first();
	
	
	if(empty($page_blocks)){
		$order = '0';
	}else{
		$order = $page_blocks->order + 1;
	}
 

	$content = Pagelist\Models\Pagelistblock::create(array(
		'page_id'=> $page_id,
		'area_id'=> $area,
		'block_handle'=>'pagelistblock',
		'block_name'=>'pagelist',
		'pagetype'=>$pagetype, 
		'ammount'=>$ammount,
		'location'=>$location,
		'pagination'=>$pagination,
		'order_by'=>$order_by,
		'position'=>$position,
		'template'=>$template,
		

		));

	

	$block = array(
			'page_id'=> $page_id,
			'area_id'=> $area,
			'block_handle'=>'pagelistblock',
			'block_slug'=>'pagelist',
			'block_id'=> $content->id,
			'order' => $order

			);

	$page_id = Input::get('page_id');
	$page = Page::find($page_id);

	
	DB::table('page_blocks')->insert($block);

	 return Redirect::to($page->route);

});


Route::post('pagelist/edit', function() {

  	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	$id = Input::get('id');
	$pagetype = Input::get('pagetype');
	$ammount = Input::get('ammount');
	$location = Input::get('location');
	$pagination = Input::get('pagination');
	$order_by = Input::get('order_by');
	$position = Input::get('position');
	$template = Input::get('template');

	$content = Pagelist\Models\Pagelistblock::find($id);
	$content->pagetype = $pagetype;
	$content->ammount = $ammount;
	$content->location = $location;
	$content->pagination = $pagination;
	$content->order_by = $order_by;
	$content->position = $position;
	$content->template = $template;
	$content->save();

	echo $pagination;
		
	
	 $page_id = Input::get('page_id');	
	 $page = DB::table('pages')->find($page_id);

	

	return Redirect::to($page->route);

});