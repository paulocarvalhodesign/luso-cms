
<?php echo Form::open('pagelist/add') ?>

<?php echo Form::hidden('page_id', $page_id); ?>

<?php echo Form::hidden('global', $global); ?>

<?php echo Form::hidden('area', $area); ?>
<div class="row-fluid"> 
 <div class="span12">
 <div class="span4">
<label><span>Show Pages of type?</span></label>

<?php

$theme = Theme::where_active('1')->first(); 
     


 $dir = path('root').'cms_user/themes/views/themes/'.$theme->name.'/'; 
       $page_types = Page::pagetypes($dir);
     foreach($page_types as $key=>$value)
        $pagetypes[$value] =  $value;
?>

<?php echo Form::select('pagetype', $pagetypes); ?>
<label><span>Where?</span></label>
<?php

 $p = DB::table('pages')->get();
    
    $pages['anywhere'] = 'Anywhere';
 foreach($p as $page)

 		$pages[$page->id] = $page->title;

?>
<?php echo Form::select('location', $pages); ?>
<label><span>Template:</span></label>




<?php
$dir = array();

$path = CMS::get_templates(USER_BUNDLE_PATH.'pagelist/views/templates/'); 

$pa = is_dir($path);

  if($pa == true)

$dir[] = $path;    

if(!empty($dir))
       
       foreach($dir as $d)

       $ps = CMS::readFolder($d);
       $pagelist_templates[''] = 'no template';
      foreach($ps as $key=>$value)
       $pagelist_templates[$value] =  $value;






?>
<?php echo Form::select('template', $pagelist_templates); ?>
</div>
 <div class="span4">
<label><span>Order by?</span></label>
<?php $order_by = array('sitemap'=>'Sitemap', 'id'=>'ID', 'alphabetic'=>'Alphabetic');?>
<?php echo Form::select('order_by', $order_by); ?>
<label><span>Position?</span></label>
<?php $position = array('asc'=>'ASC', 'desc'=>'DESC');?>
<?php echo Form::select('position', $position); ?>

<?php $options = array('0'=>'false', '1'=>'true');?>
<label><span>Paginate? </span></label>

<?php echo Form::select('pagination', $options); ?>
<br/>
</div>
 <div class="span4">
<label><span>How many?</span></label>
 <div class="ammount-slider"></div>
 <div id="ammount-slider-result">4</div>
 <?php echo Form::hidden('ammount', '4',array('id'=>'ammount')); ?>




<?php echo Form::submit('Save',array('class'=>'btn  btn-primary')); ?>

</div>
</div>
</div>



<?php echo Form::close() ?>


<script type="text/javascript">
     $(document).ready(function () {
        
   

      $( ".ammount-slider" ).slider({
           animate: true,
               range: "min",
               value: 4,
               min: 2,
               max: 30,
               step: 1,
 
               //this gets a live reading of the value and prints it on the page
               slide: function( event, ui ) {
                   $( "#ammount-slider-result" ).html( ui.value );
               },
 
               //this updates the hidden form field so we can submit the data using a form
               change: function(event, ui) {
               $('#ammount').attr('value', ui.value);
               }
 
               });
      






    });

</script>
  


