
{{ Area::open_wrapper($area, $handle, $id, $global) }}

{{ Session::get('success') }}

<div class="formblock">
{{ Form::open('process_form') }}

<input type="hidden" name="page" value="{{ $page = CMS::last() }}" /> 
<input type="hidden" name="form_id" value="{{$id}}" /> 

@foreach($fields as $field)


@if($field->type == 'select')

<label>{{ $field->label }}</label>


<?php

	$option = $field->options;
	$exp = explode(",",$option);

	foreach($exp as $key=>$value){
		
	$options[$value] = ucwords($value);
	}
		


?>
	{{ Form::select($field->name, $options) }}


@elseif($field->type == 'textarea')	

<label>{{ $field->label }}</label>

	{{ Form::textarea($field->name) }}

@elseif($field->type == 'checkbox')	

<label>{{ $field->label }} {{ Form::checkbox($field->name) }}</label>



@elseif($field->type == 'date')

<label>{{ $field->label }}</label>

<input id="datepicker-{{$field->id}}" name="{{ $field->name }}" value="" type="{{ $field->type }}"/>


    <script>
    $(function() {
        $( "#datepicker-{{$field->id}}" ).datepicker();
    });
    </script>

@else



<label>{{ $field->label }}</label>

<input name="{{ $field->name }}" value="" type="{{ $field->type }}"/>

@endif

@endforeach

<br/>
<br/>
{{ Form::submit('Send', array('class'=>'btn')) }}


{{ Form::close() }}
</div>

{{ Area::close_wrapper() }}
