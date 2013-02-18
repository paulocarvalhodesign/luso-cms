{{ Area::open_wrapper($area, $handle, $id, $global) }}

<div class="shadow">
<div class="programas">
<h3 class="themed_header">Programas:</h3>


@foreach($list->results as $post)

<?php  
 

 $poster = Attribute::image('poster', $post->id);
 $locutor = Attribute::image('locutor', $post->id);

 ?>
<div class="row-fluid">
<div class="span12">
<div class="article">
<div class="row-fluid">
<div class="span12">
<div class="thumb">
	@if($poster)
	<img src="{{ url($poster->location) }}"  height="100"/>
	@endif
</div>   
</div>
</div>
<div class="row-fluid">
<div class="span12">
<div class="description">
	<h4>
	@if($locutor)
	<img class="locutor" src="{{ url($locutor->location) }}"  height="40" width="40"/>
	@endif
		<i class="icon-th icon"></i> {{HTML::link($post->route, $post->title);}}</h4>
	<p>{{$post->description}}</p>
	<a href="{{url($post->route)}}" class="button">Continuar a ler....</a>
</div>
</div>
</div>

</div>
</div>
</div>
@endforeach
{{$list->links()}}
</div>
</div>
{{ Area::close_wrapper() }}