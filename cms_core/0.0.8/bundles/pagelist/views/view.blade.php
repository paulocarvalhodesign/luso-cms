{{ Area::open_wrapper($area, $handle, $id, $global) }}

<div class="pagelist">

<h3>Recent Posts:</h3>

@foreach($list->results as $post)

<div class="article">
<h4>{{$post->title}}</h4>
<p>{{$post->description}}</p>
<p>{{HTML::link($post->route, 'Continue reading &#8594;');}}</p>
</div>

@endforeach
{{$list->links()}}
</div>

{{ Area::close_wrapper() }}