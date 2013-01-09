{{ Area::open_wrapper($area, $handle, $id, $global) }}


<h3 class="themed_header">Ensembles:</h3>
<div class="ensembles">

@foreach($list->results as $post)

<?php  
 

 $poster = Attribute::image('poster', $post->id);


 ?>
<div class="row-fluid">
<div class="span12">
<div class="article">

  <div class="span3"> 
<div class="thumb">
	@if($poster)
	<img src="{{ url($poster->location) }}"  width="150" height="150"/>
	@endif
</div>   
</div>
<div class="span9">
<div class="description">
	<h4>{{HTML::link($post->route, $post->title);}}</h4>
	<p>{{$post->description}}</p>
	<a href="{{url($post->route)}}" class="button">Information</a>
</div>
</div>
<br/><br/>
<hr class="theme_hr"/>
</div>
</div>
</div>
@endforeach
{{$list->links()}}
</div>

{{ Area::close_wrapper() }}