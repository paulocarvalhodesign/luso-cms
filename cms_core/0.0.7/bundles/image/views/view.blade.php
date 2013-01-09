{{ Area::open_wrapper($area, $handle, $id, $global) }}

@if($block->lightbox == 'true')
<?php

 $url = str_replace("public/", "", $block->url );	
 
 $attributes = array(

 	'width' => $block->width,
 	'height'=> $block->height,
 	'title' => $block->title,
 	
 	

 );?>

<a class="group-{{$block->id}}" href="{{$block->url}}">{{HTML::image($url,  $block->title, $attributes)}}</a>

{{ Area::close_wrapper() }}

<script>
			$(document).ready(function(){
				
				$(".group-{{$block->id}}").colorbox({rel:'group-{{$block->id}}'});
				
			});
</script>

@else


<?php

 $url = str_replace("public/", "", $block->url );	
 $attributes = array(

 	'width' => $block->width,
 	'height'=> $block->height,
 	'title' => $block->title,
 	


 );?>

{{HTML::image($url,  $block->title, $attributes)}}



@endif