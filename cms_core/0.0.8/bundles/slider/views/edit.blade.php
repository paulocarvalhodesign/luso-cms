
<?php echo Form::open('slider/edit') ?>


 
<?php echo Form::hidden('page_id', $page_id); ?>

<?php echo Form::hidden('global', $global); ?>
<?php  echo Form::hidden('id', $id); ?>

<label>Choose your file set:</label>
<?php

	$query = DB::table('sets')->get();

	$sets = array();

	foreach($query as $set)
	$sets[$set->id] = $set->name; 

	
 ?>
<?php  echo Form::select('set', $sets ,$block->slider_id); ?>

<br/>
<br/>
<?php
$dir = array();

$path = CMS::get_templates(USER_BUNDLE_PATH.'slider/views/templates/'); 

$pa = is_dir($path);

  if($pa == true)

$dir[] = $path;    

if(!empty($dir))
       
       foreach($dir as $d)

       $ps = CMS::readFolder($d);
       $image_templates[''] = 'no template';
      foreach($ps as $key=>$value)
       $image_templates[$value] =  $value;






?>
<label>Template:</label>
<?php echo Form::select('template', $image_templates, $block->template); ?>
<br/>
<?php echo Form::submit('Save',array('class'=>'btn  btn-primary')); ?>

<?php echo Form::close() ?>





