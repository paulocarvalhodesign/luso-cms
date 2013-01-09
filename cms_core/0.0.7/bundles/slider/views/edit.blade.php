
<?php echo Form::open('slider/edit') ?>


 
<?php echo Form::hidden('page_id', $page_id); ?>

<?php echo Form::hidden('global', $global); ?>
<?php  echo Form::hidden('id', $id); ?>


<?php

	$query = DB::table('sets')->get();

	$sets = array();

	foreach($query as $set)
	$sets[$set->id] = $set->name; 

	
 ?>
<?php  echo Form::select('set', $sets ,$block->slider_id); ?>

<br/>
<?php echo Form::submit('Save',array('class'=>'btn  btn-primary')); ?>

<?php echo Form::close() ?>





