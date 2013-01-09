
<?php echo Form::open('gallery/add') ?>

<?php echo Form::hidden('page_id', $page_id); ?>

<?php echo Form::hidden('global', $global); ?>

<?php echo Form::hidden('area', $area); ?>

<label>Choose your file set:</label>
<?php

	$query = DB::table('sets')->get();

	$sets = array();

	foreach($query as $set)
	$sets[$set->id] = $set->name; 


 ?>
<?php  echo Form::select('set', $sets); ?>
<br/>
<?php echo Form::submit('Save',array('class'=>'btn  btn-primary')); ?>

<?php echo Form::close() ?>





