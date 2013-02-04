<?php
/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @version  0.0.1
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

/*
|----------------------------------------------------------------
| Area class
|----------------------------------------------------------------
*/


class Area 
{
	
	protected $area;
	protected $page_id;
	
	

public static function render($area, $page_id, $limit=''){
			
		
		$area_sorted = ucwords($exp = str_replace("_", ' ',$area));
		

		//$blocks = Block::all();


		if(empty($limit))
			$limit = null;	

		$areas = DB::table('areas')->where_page_id_and_area_name($page_id, $area)->get();
		
		$test = count($areas);
		

		if ( $test > 0)  
			{
	
			
	
	
			}else {
	
	
			$data = array(
		   	'page_id'=>$page_id,
		   	'area_name' =>$area ,
		   
			);
			
		 		DB::table('areas')->insert($data);
		
			}


		/*
		|----------------------------------------------------------------
		| Check for edit mode
		|----------------------------------------------------------------
		*/	

			
		if(Config::get('edit_mode') == 'true'){

		
			

		foreach($areas as $ar)
			{
		$page_blocks = DB::table('page_blocks')->where_page_id_and_area_id($page_id, $ar->area_name)->order_by('order', 'asc')->take($limit)->get();
		$total = count($page_blocks);
			}

		if(empty($page_blocks))
		{
		
			$total = '0';
		}
		else
		{
			
			foreach($page_blocks as $block)
			{

				$obj = '';


				$params = array(

					'area'      => $area,
					'page_id'   => $page_id,
					'block_id'  => $block->block_id,
					'global'    => 'false'

				);
			
				
				echo Controller::call(''.$block->block_slug.'::'.$block->block_handle.'@render', array($params));
				


			}
			$total = count($page_blocks);

			
			if($total == $limit && !$total < $limit){

				

			}
				else{
			if(Auth::check()){
	    $obj .='
		
		<div class="dropdown">
  			<a class="dropdown-toggle add_block" data-toggle="dropdown" href="#"><i class="icon-white icon-plus"></i> add to '.$area_sorted.' area</a>
  			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
		';	
		$obj .= '<li><a data-toggle="modal" data-area="'.$area.'" data-target="#'.$area.'-blocks" class="" href="'.url('blocks?global=false&page_id='.$page_id.'&area='.$area.'').'"> <i class="icon-white icon-plus"></i> add Block </a></li>';
	
		$obj .='

			 </ul>
		</div>

		';
		
				
			$obj .='

				<div class="modal hide fade add_block_modal" id="'.$area.'-blocks">
						      <div class="modal-header">
						        <button class="close" data-dismiss="modal">x</button>
						        <h4 class="blocks_title"> Add Block to Page </h4>
						      </div>
						      <div class="modal-body">
						        <p>

						          


						        </p>
						      </div>
						      
						    </div>



			';

			$obj .='

				<div class="modal hide fade " id="'.$area.'-layout">
						      <div class="modal-header">
						        <button class="close" data-dismiss="modal">x</button>
						        <h4 class="blocks_title"> Add Layout to Area </h4>
						      </div>
						      <div class="modal-body">
						        <p>

						          


						        </p>
						      </div>
						      
						    </div>



			';


				return $obj;

			}else{

				return $obj;
			}	
		
		  }

		}
		$obj='';

		
			
			if($total == $limit && !$total < $limit){

				

			}
				else{

		if(Auth::check()){

		$obj .='
		
		<div class="dropdown">
  			<a class="dropdown-toggle add_block" data-toggle="dropdown" href="#"><i class="icon-white icon-plus"></i> add to '.$area_sorted.' area</a>
  			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">


		';	
		$obj .= '<li><a data-toggle="modal" data-area="'.$area.'" data-target="#'.$area.'-blocks"  href="'.url('blocks?global=false&page_id='.$page_id.'&area='.$area.'').'"> <i class=" icon-white icon-plus"></i> add Block </a></li>';
		
		$obj .='

			 </ul>
		</div>

		';
		



		$obj .='

				<div class="modal hide fade" id="'.$area.'-blocks">
						      <div class="modal-header">
						        <button class="close" data-dismiss="modal">x</button>
						        <h4 class="blocks_title"> Add Block to Page </h4>
						      </div>
						      <div class="modal-body">
						        <p>

						         


						        </p>
						      </div>
						     
						    
						    </div>



			';

			$obj .='

				<div class="modal hide fade " id="'.$area.'-layout">
						      <div class="modal-header">
						        <button class="close" data-dismiss="modal">x</button>
						        <h4 class="blocks_title"> Add Layout to Area </h4>
						      </div>
						      <div class="modal-body">
						        <p>

						          


						        </p>
						      </div>
						      
						    </div>



			';

			return $obj;
		}
		else{
			return $obj;
		}
		
		
		}
		
		}
		
		
		else{


		foreach($areas as $ar)
			{
		    
		    $page_blocks = DB::table('page_blocks')->where_page_id_and_area_id($page_id, $ar->area_name)->order_by('order', 'asc')->take($limit)->get();
		    $total = count($page_blocks);
			}

		if(empty($page_blocks))
		{
		
			$total = '0';

		}
		else
		{
            
			foreach($page_blocks as $block)
			{
   				
   				

				$params = array(

					'area'      => $area,
					'page_id'   => $page_id,
					'block_id'  => $block->block_id,
					'global'    => 'false'

				);
					

				
				echo Controller::call(''.$block->block_slug.'::'.$block->block_handle.'@render', array($params));
				
              
				



			}

		}

	  }	
	  	
		
	}

public static function open_area_wrapper(){

	$markup ='<div class="area_wrapper">';

	return $markup;

}
	
public static function close_area_wrapper(){

	$markup ='</div>';

	return $markup;

}

public static function open_wrapper($area, $handle, $id, $global){

	if(Config::get('edit_mode') == 'true' && Auth::check()){

	
	$markup ='<div class="block_wrapper block_wrapper-'.$area.$id.'">';

	$markup .='<div class="edit_block">';

	

   
   
    $markup .='
    
    <ul class="dropdown-menu">
      <li><a data-toggle="modal" data-target="#'.$handle.'-blocks"  href="'.url('editblock?global='.$global.'&id='.$id.'&handle='.$handle.'&page_id='.Config::get('page_id').'').'"><i class="icon-white icon-pencil"></i> Edit block</a></li>
      <li><a data-toggle="modal" data-target="#'.$handle.'-blocks-move"  href="'.url('moveblock?global='.$global.'&id='.$id.'&area='.$area.'&page_id='.Config::get('page_id').'').'"><i class="icon-white icon-resize-vertical"></i> Move block</a></li>
      <li><a class="delete" onclick="deleteItem()" href="'.url('delete_block/?global='.$global.'&block='.$handle.'s&id='.$id.'&page_id='.Config::get('page_id').'').'"><i class="icon-white icon-minus"></i> Delete block</a></li>
    </ul>
 

	';


	$markup .='

		<div class="modal hide fade" id="'.$handle.'-blocks">
						      <div class="modal-header">
						        <button class="close" data-dismiss="modal">x</button>
						        <h4 class="blocks_title"> Edit Block </h4>
						      </div>
						      <div class="modal-body">
						        <p>

						         


						        </p>
						      </div>
						     
						    
						    </div>


	';

	$markup .='

		<div class="modal hide fade" id="'.$handle.'-blocks-move">
						      <div class="modal-header">
						        <button class="close" data-dismiss="modal">x</button>
						        <h4 class="blocks_title"><i class="icon-resize-vertical"></i>  Move Block </h4>
						      </div>
						      <div class="modal-body">
						        <p>

						         


						        </p>
						      </div>
						     
						    
						    </div>


	';
	

	$markup .='<div data-toggle="dropdown" class="block_wrapper_overlay"></div>';
	
	return $markup;
  	 }
  	 else
  	 {

  	 	return false;
	}
}
	
public static function close_wrapper(){

	if(Config::get('edit_mode') == 'true' && Auth::check()){
	
	$markup = '</div>';

	$markup .='</div>';

	return $markup;
		}else{
	return false;
	}
}


public static function globalRender($area, $page_id, $limit=""){
		
		$area_sorted = ucwords($exp = str_replace("_", ' ',$area));

		if(empty($limit))
			$limit = null;		

		$areas = DB::table('areas')->where_page_id_and_area_name($page_id, $area)->get();
		
		$test = count($areas);
		

		if ( $test > 0)  
			{
	
			
	
	
			}else {
	
	
			$data = array(
		   	'page_id'=>$page_id,
		   	'area_name' =>$area ,
		   
			);
			
		 		DB::table('areas')->insert($data);
		
			}


		/*
		|----------------------------------------------------------------
		| Check for edit mode
		|----------------------------------------------------------------
		*/	

			
		if(Config::get('edit_mode') == 'true'){

		
			
		
		foreach($areas as $ar)
			{
		$temp_id= '0';		
		$page_blocks = DB::table('page_blocks')->where_page_id_and_area_id($temp_id, $ar->area_name)->order_by('order', 'asc')->take($limit)->get();
		$total = count($page_blocks);
			}

		if(empty($page_blocks))
		{
		
			$total = '0';
		}
		else
		{
			
			foreach($page_blocks as $block)
			{

				$obj = '';


				$params = array(

					'area'      => $area,
					'page_id'   => $page_id,
					'block_id'  => $block->block_id,
					'global'  => 'true'

				);
			
				
				echo Controller::call(''.$block->block_slug.'::'.$block->block_handle.'@render', array($params));
				


			}
			

			
			
			if($total == $limit && !$total < $limit){

				

			}
				else{


			if(Auth::check()){
			
			$obj .='
		
		<div class="dropdown">
  			<a class="dropdown-toggle add_block" data-toggle="dropdown" href="#"><i class="icon-white icon-plus"></i> add to '.$area_sorted.' global area</a>
  			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">


		';	
		$obj .= '<li><a data-toggle="modal" data-area="'.$area.'" data-target="#'.$area.'-blocks"  href="'.url('blocks?global=true&page_id='.$page_id.'&area='.$area.'').'"> <i class="icon-white icon-plus"></i> add Block </a></li>';
	 
		$obj .='

			 </ul>
		</div>

		';

				
			$obj .='

				<div class="modal hide fade add_block_modal" id="'.$area.'-blocks">
						      <div class="modal-header">
						        <button class="close" data-dismiss="modal">x</button>
						        <h4 class="blocks_title"> Add Block to Page </h4>
						      </div>
						      <div class="modal-body">
						        <p>

						          


						        </p>
						      </div>
						      
						    </div>



			';
			$obj .='

				<div class="modal hide fade " id="'.$area.'-layout">
						      <div class="modal-header">
						        <button class="close" data-dismiss="modal">x</button>
						        <h4 class="blocks_title"> Add Layout to Area </h4>
						      </div>
						      <div class="modal-body">
						        <p>

						          


						        </p>
						      </div>
						      
						    </div>



			';


				return $obj;
			
			}else{

				return $obj;
			}	
		  }

		}

		if($total == $limit && !$total < $limit){

			

		}
		else{	
		$obj='';
		
		if(Auth::check()){
		$obj .='
		
		<div class="dropdown">
  			<a class="dropdown-toggle add_block" data-toggle="dropdown" href="#"><i class="icon-plus"></i> add to '.$area_sorted.' global area</a>
  			<ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">


		';	
		$obj .= '<li><a data-toggle="modal" data-area="'.$area.'" data-target="#'.$area.'-blocks"  href="'.url('blocks?global=true&page_id='.$page_id.'&area='.$area.'').'"> <i class=" icon-white icon-plus"></i> add Block </a></li>';
	
		$obj .='

			 </ul>
		</div>

		';


		$obj .='

				<div class="modal hide fade" id="'.$area.'-blocks">
						      <div class="modal-header">
						        <button class="close" data-dismiss="modal">x</button>
						        <h4 class="blocks_title"> Add Block to Page </h4>
						      </div>
						      <div class="modal-body">
						        <p>

						         


						        </p>
						      </div>
						     
						    
						    </div>



			';
			$obj .='

				<div class="modal hide fade " id="'.$area.'-layout">
						      <div class="modal-header">
						        <button class="close" data-dismiss="modal">x</button>
						        <h4 class="blocks_title"> Add Layout to Area </h4>
						      </div>
						      <div class="modal-body">
						        <p>

						          


						        </p>
						      </div>
						      
						    </div>



			';
			return $obj;
		}
		else{
			return $obj;
		}
		
		}
		
		
		}
		
		
		else{

		

		foreach($areas as $ar)
			{
		    $temp_id= '0';	
		    $page_blocks = DB::table('page_blocks')->where_page_id_and_area_id($temp_id, $ar->area_name)->order_by('order', 'asc')->take($limit)->get();

			}

		if(empty($page_blocks))
		{
		
			$total = '0';

		}
		else
		{
            
			foreach($page_blocks as $block)
			{
   				
   				

				$params = array(

					'area'      => $area,
					'page_id'   => $page_id,
					'block_id'  => $block->block_id,
					'global'  => 'true'

				);
					

				
				echo Controller::call(''.$block->block_slug.'::'.$block->block_handle.'@render', array($params));
				
              
				



			}

		}

	  }	
	  	
		
	}





}