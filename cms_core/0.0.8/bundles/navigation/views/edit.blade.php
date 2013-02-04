<?php echo Form::open('navigation/edit') ?>
<?php echo Form::hidden('page_id', $page_id); ?>
<?php echo Form::hidden('global', $global); ?>
<?php  echo Form::hidden('id', $id); ?>
<label><span>Template:</span></label>
<?php
$dir = array();


$path = CMS::get_templates(USER_BUNDLE_PATH.'navigation/views/templates/'); 

$pa = is_dir($path);

  if($pa == true)

$dir[] = $path;    

if(!empty($dir))
       
       foreach($dir as $d)

       $ps = CMS::readFolder($d);
       $navigation_templates[''] = 'no template';
      foreach($ps as $key=>$value)
       $navigation_templates[$value] =  $value;






?>
<?php echo Form::select('template',$navigation_templates, $block->template);?>
<br/>
<?php echo Form::submit('Save',array('class'=>'btn  btn-primary')); ?>

<?php echo Form::close() ?>