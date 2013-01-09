<?php
// to catch controllers
Route::controller(Controller::detect('image'));
Route::post('image/add', function() {
  
	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	$area    = Input::get('area');
	$description = Input::get('description');
	$width = Input::get('width');
	$height = Input::get('height');
	$title = Input::get('title');
	$template = Input::get('template');
	$lightbox = Input::get('lightbox');

	$old = Input::get('url');
	$url = str_replace("/filemanager/thumbs/images/", "/filemanager/images/", $old );
	



	$content = Image\Models\Imageblock::create(array(
		'page_id'=> $page_id,
		'area_id'=> $area,
		'block_handle'=>'imageblock',
		'block_name'=>'image',
		'description' => $description,
		'lightbox' => $lightbox,
		'width' => $width,
		'height' => $height,
		'title' => $title,
		'template' => $template,
		'url' => trim($url)

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
				'block_handle'=>'imageblock',
				'block_slug'=>'image',
				'block_id'=> $content->id,
				'order'=> $order
			

			);
	$page_id = Input::get('page_id');	
	$page = Page::find($page_id);


	DB::table('page_blocks')->insert($block);

	 return Redirect::to($page->route);

});


Route::post('image/edit', function() {

  	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	$id = Input::get('id');
	$description = Input::get('description');
	$width = Input::get('width');
	$height = Input::get('height');
	$title = Input::get('title');
	$old = Input::get('url');
	$template = Input::get('template');
	$lightbox = Input::get('lightbox');
	
	$url = str_replace("/filemanager/thumbs/images/", "/filemanager/images/", $old );

	$image = Image\Models\Imageblock::find($id);
	
	$image->description = $description;
	$image->width = $width;
	$image->height = $height;
	$image->title = $title;
	$image->lightbox = $lightbox;
	$image->template = $template;
	$image->url = trim($url);
	$image->save();

	
		
	
	 $page_id = Input::get('page_id');	
	 $page = DB::table('pages')->find($page_id);

	

	return Redirect::to($page->route);

});