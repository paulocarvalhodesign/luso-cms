        
<?php echo Form::open('search/add') ?>

<?php echo Form::hidden('page_id', $page_id); ?>

<?php echo Form::hidden('global', $global); ?>

<?php echo Form::hidden('area', $area); ?>
<label>Show Results?</label>
<?php 
	$results = array(

		'false'=>'FALSE',
		'true'=>'TRUE'
		
		);
?>
<?php echo Form::select('results', $results); ?>

<label>Redirect Where?</label>
<?php echo Form::select('content', $pages); ?>
<br/>
<?php echo Form::submit('Save',array('class'=>'btn  btn-primary bt-max')); ?>
<?php echo Form::close() ?>




