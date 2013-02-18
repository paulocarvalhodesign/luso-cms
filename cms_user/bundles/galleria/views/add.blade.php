
<?php echo Form::open('galleria/add') ?>

<?php echo Form::hidden('page_id', $page_id); ?>

<?php echo Form::hidden('global', $global); ?>

<?php echo Form::hidden('area', $area); ?>


<label><span>Use Facebook Album?</span> insert ID</label>
<?php echo Form::text('facebook');?>

<br/>
<label><span>Choose your file set:</span></label>
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





