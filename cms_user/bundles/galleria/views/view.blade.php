{{ Area::open_wrapper($area, $handle, $id, $global) }}
 
<div id="galleria">
	@foreach($set as $s)
	<a href="{{$s->location}}">
		<img src="{{$s->thumb_location}}" data-title="{{$s->title}}" data-description="{{$s->description}}"/>
	</a>
	@endforeach

</div>

<script>


Galleria.loadTheme('{{url('public/bundles/galleria/themes/classic/galleria.classic.min.js')}}');
Galleria.run('#galleria', {
//facebook: 'album:{{$block->gallery_id}}',
// width: 745,
 height: 550,
 lightbox: true});
</script>

{{ Area::close_wrapper() }}