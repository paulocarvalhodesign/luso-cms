 
<?php echo Form::open('form/edit') ?>


 
<?php echo Form::hidden('page_id', $page_id); ?>

<?php  echo Form::hidden('global', $global); ?>

<?php  echo Form::hidden('id', $id); ?>


<br/>
<?php echo Form::submit('Save',array('class'=>'btn  btn-primary')); ?>

<?php echo Form::close() ?>



