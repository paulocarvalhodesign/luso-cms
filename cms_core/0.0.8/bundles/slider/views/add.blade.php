
<?php echo Form::open('slider/add') ?>

<?php echo Form::hidden('page_id', $page_id); ?>

<?php echo Form::hidden('global', $global); ?>

<?php echo Form::hidden('area', $area); ?>

<label><span>Choose your file set:</span></label>
<?php

	$query = DB::table('sets')->get();

	$sets = array();

	foreach($query as $set)
	$sets[$set->id] = $set->name; 


 ?>
<?php  echo Form::select('set', $sets); ?>
<br/><br/>
<?php
$dir = array();

$path = CMS::get_templates(USER_BUNDLE_PATH.'slider/views/templates/'); 

$pa = is_dir($path);

  if($pa == true)

$dir[] = $path;    

if(!empty($dir))
       
       foreach($dir as $d)

       $ps = CMS::readFolder($d);
       $slider_templates[''] = 'no template';
      foreach($ps as $key=>$value)
       $slider_templates[$value] =  $value;






?>
<label><span>Template:</span></label>
<?php echo Form::select('template', $slider_templates); ?>
<br/>
<?php echo Form::submit('Save',array('class'=>'btn  btn-primary')); ?>

<?php echo Form::close() ?>





