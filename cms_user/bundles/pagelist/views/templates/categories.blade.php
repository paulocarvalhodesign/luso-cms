{{ Area::open_wrapper($area, $handle, $id, $global) }}

<div class="categories">

<h3>Pages</h3>

@foreach($list->results as $post)

<p class="cat_header"><span class="arrow">> </span>{{HTML::link($post->route, $post->title);}}</p>



@endforeach

</div>

{{ Area::close_wrapper() }}