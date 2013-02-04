        
<?php echo Form::open('search/add') ?>

<?php echo Form::hidden('page_id', $page_id); ?>

<?php echo Form::hidden('global', $global); ?>

<?php echo Form::hidden('area', $area); ?>
<label><span>Show Results?</span></label>
<?php 
	$results = array(

		'false'=>'FALSE',
		'true'=>'TRUE'
		
		);
?>
<?php echo Form::select('results', $results); ?>

<label><span>Redirect Where?</span></label>
<?php echo Form::select('content', $pages); ?>
<br/>
<?php echo Form::submit('Save',array('class'=>'btn  btn-primary bt-max')); ?>
<?php echo Form::close() ?>




