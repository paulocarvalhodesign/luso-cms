{{ Area::open_wrapper($area, $handle, $id, $global) }}

@if($results == 'false')
						<div class="search">
                         {{Form::open('search')}}
                         {{Form::text('keywords')}}
                         {{Form::hidden('target', $content)}}
                         {{Form::submit('search', array('class'=>'btn'))}}
                         {{Form::close()}}
                       </div>
@else
<?php $result = Session::get('query');?>
@if(!empty($result))
<h4><i class="icon-search icon-white"></i> Results</h4>
<hr class="theme_hr"/>
	@foreach($result as $res)

	<h6>{{$res->title}}</h6>

	<p>{{$res->description}}</p>

	<a href="{{$res->route}}">Visit</a>
	<hr class="theme_hr"/>

	@endforeach
@else
<h4><i class="icon-search icon-white"></i> No Results</h4>
<hr class="theme_hr"/>
@endif
@endif
{{ Area::close_wrapper($handle, $id, $global) }}