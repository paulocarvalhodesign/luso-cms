
<?php echo Form::open('form/add') ?>

<?php echo Form::hidden('page_id', $page_id); ?>

<?php  echo Form::hidden('global', $global); ?>

<?php echo Form::hidden('area', $area); ?>

<label>Choose your form:</label>
<?php

	$query = DB::table('forms')->get();

	$forms = array();

	foreach($query as $set)
	$forms[$set->id] = $set->name; 


 ?>
<?php  echo Form::select('form', $forms); ?>
<br/>
<label>Template:</label>
<?php
$dir = array();

$path = CMS::get_templates(USER_BUNDLE_PATH.'form/views/templates/'); 

$pa = is_dir($path);

  if($pa == true)

$dir[] = $path;    

if(!empty($dir))
       
       foreach($dir as $d)

       $ps = CMS::readFolder($d);
       $form_templates[''] = 'no template';
      foreach($ps as $key=>$value)
       $form_templates[$value] =  $value;






?>
<?php echo Form::select('template', $form_templates); ?>
<br/>
<?php echo Form::submit('Save',array('class'=>'btn  btn-primary')); ?>

<?php echo Form::close() ?>





