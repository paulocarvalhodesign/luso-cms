
<?php echo Form::open('search/edit') ?>

<?php echo Form::hidden('page_id', $page_id); ?>

<?php echo Form::hidden('global', $global); ?>

<?php  echo Form::hidden('id', $id); ?>


<?php echo Form::hidden('global', $global); ?>
<label><span>Show Results?</span></label>
<?php 
	$results = array(

		'false'=>'FALSE',
		'true'=>'TRUE'
		
		);
?>
<?php echo Form::select('results', $results, $block->results); ?>

<?php if($block->results == 'true'):?>


<?php else:?>
<label><span>Redirect Where?</span></label>
<?php
		$all_pages = Page::all();

       foreach($all_pages as $p)

          $pages[$p->name] = $p->name;

?>
<?php echo Form::select('content', $pages, $block->target); ?>
<br/>
<?php endif;?>

<br/>

<?php echo Form::submit('Save',array('class'=>'btn  btn-primary')); ?>
<?php echo Form::close() ?>

