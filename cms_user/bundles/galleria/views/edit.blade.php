
<?php echo Form::open('galleria/edit') ?>


 
<?php echo Form::hidden('page_id', $page_id); ?>

<?php echo Form::hidden('global', $global); ?>
<?php  echo Form::hidden('id', $id); ?>


<label><span>Use Facebook Album?</span> insert ID</label>
<?php echo Form::text('facebook', $block->gallery_id);?>
<br/>
<label><span>Choose your file set:</span></label>
<?php

	$query = DB::table('sets')->get();

	$sets = array();

	foreach($query as $set)
	$sets[$set->id] = $set->name; 


 ?>
<?php  echo Form::select('set', $sets ,$block->gallery_id); ?>

<br/>
<?php echo Form::submit('Save',array('class'=>'btn  btn-primary')); ?>

<?php echo Form::close() ?>





