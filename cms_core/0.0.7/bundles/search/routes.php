<?php
// to catch controllers
Route::controller(Controller::detect('search'));
Route::post('search/add', function() {


  	
  	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	
	$area    = Input::get('area');
	$content = Input::get('content');
	$results = Input::get('results');
	
	$page_blocks = DB::table('page_blocks')->where_page_id_and_area_id($page_id, $area)->order_by('order','desc')->first();
	
	if(empty($page_blocks)){
		$order = '0';
	}else{
		$order = $page_blocks->order + 1;
	}


	$content = Search\Models\Searchblock::create(array(
		'page_id'=> $page_id,
		'area_id'=> $area,
		'target'=> $content,
		'block_handle'=>'searchblock',
		'block_name'=>'search',
		'results'=>$results

		));

	

	$block = array(
			'page_id'=> $page_id,
			'area_id'=> $area,
			'block_handle'=>'searchblock',
			'block_slug'=>'search',
			'block_id'=> $content->id,
			'order'=> $order

			);

	$page_id = Input::get('page_id');
	$page = Page::find($page_id);


	DB::table('page_blocks')->insert($block);

	 return Redirect::to($page->route);

});


Route::post('search/edit', function() {

  	

  	$global = Input::get('global');
  	if($global == 'true'){
  		$page_id = '0';
  	}else{
  		$page_id = Input::get('page_id');
  	}
	
	$id = Input::get('id');
	
	$newcontent = Input::get('content');
	$results = Input::get('results');
	$content = Search\Models\Searchblock::find($id);
	$content->target = $newcontent;
	$content->results = $results;
	$content->save();

	
		
	
	 $page_id = Input::get('page_id');
	 $page = DB::table('pages')->find($page_id);

	

	return Redirect::to($page->route);

});

Route::post('search', function() {

	$keywords = Input::get('keywords');

	if(!empty($keywords)){

	$query =  DB::table('pages')
	->where('description', 'LIKE', '%'.$keywords.'%')
	->or_where('tags', 'LIKE', '%'.$keywords.'%')
	->or_where('keywords', 'LIKE', '%'.$keywords.'%')
	->get();

	}else{

	$query = '';	
	}
     
	
	$page_id = Input::get('target');

	//echo $page_id;

	Session::flash('query', $query);

	//$page = DB::table('pages')->find($page_id);

	
	return Redirect::to($page_id);


	

});