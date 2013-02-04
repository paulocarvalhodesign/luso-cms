<?php $files = Files::all();?>


<div id="imageblockimages">
 <button class="btn btn-primary"  id="imageblock_close_image_manager">X</button>
 <ul class="filemanager" id="imageblockuItem" >
<?php foreach($files as $file):?>

<li>
  <p>
  
  
                       <img src="<?php echo $file->thumb_location;?>"/>
                        
                        <span><?php echo $file->thumb_location;?></span>
                          
  </p>
</li>

<?php endforeach;?>
</ul>
</div>
<?php echo Form::open('image/add') ?>

<?php echo Form::hidden('page_id', $page_id); ?>

<?php echo Form::hidden('global', $global); ?>

<?php echo Form::hidden('area', $area); ?>
  <div class="row-fluid">
  	<div class="span12">
	
   
     <div class="span3">
        <label><span>title:</span></label>
        <?php  echo Form::text('title'); ?>

        <label><span>Template:</span></label>
<?php
$dir = array();

$path = CMS::get_templates(USER_BUNDLE_PATH.'image/views/templates/'); 

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
<?php echo Form::select('template', $image_templates); ?>

        
     	
  

  <label><span>Open in lightbox?:</span></label>
  
   <?php $opts = array('true'=>'True','false'=>'False') ; echo Form::select('lightbox', $opts); ?>


    


     </div>	
     <div class="span6">
     	

     	<label><span>description:</span></label>
     	<?php echo Form::textarea('description', '' , array('class'=>'image_block_textarea')); ?>

      <label> <span>Width:(px)</span></label>
       <div class="width-slider"></div>
       <div id="width-slider-result">0 </div>
      <?php echo Form::hidden('width', '',array('id'=>'width')); ?>

      <label><span>Height: (px)</span></label>
       <div class="height-slider"></div>
       <div id="height-slider-result">0 </div>
      <?php echo Form::hidden('height', '',array('id'=>'height')); ?>

     </div>	
      <div class="span3">
     <div class="field"></div> 
    <center>
     <div class="holder"></div> 
   </center>
      <br/>
    <center>
    <a class="btn image_submit" id="imageblockmedia-selector">Select File</a>
  </center>
      </div>
  </div>
</div>
<script type="text/javascript">
     $(document).ready(function () {
        
         
    
     $('#imageblockuItem p').click(function(){
      
      var $this = $(this);

    
      //CKEDITOR.instances.editor.insertHtml('<img src="'+$this.text()+'"/>');
      $('.field').html(' <input type="hidden" value="'+$this.text()+'" name="url" >');
      $('.holder').html('<img class="image_preview" src="'+$this.text()+'"/>');

      });   

     $("#imageblock_close_image_manager").click(function () {
      
      

      $('#imageblockimages').hide();
      
      $('#imageblockmedia-selector').show();



      


      });   

    

     $("#imageblockmedia-selector").click(function (event) {
      
      event.preventDefault();

      $('#imageblockimages').show();
      
      $('#imageblockmedia-selector').hide();



      


      });   



      $( ".width-slider" ).slider({
           animate: true,
               range: "min",
               value: 10,
               min: 10,
               max: 1000,
               step: 1,
 
               //this gets a live reading of the value and prints it on the page
               slide: function( event, ui ) {
                   $( "#width-slider-result" ).html( ui.value );
               },
 
               //this updates the hidden form field so we can submit the data using a form
               change: function(event, ui) {
               $('#width').attr('value', ui.value);
               }
 
               });
       $( ".height-slider" ).slider({
           animate: true,
               range: "min",
               value: 10,
               min: 10,
               max: 1000,
               step: 1,
 
               //this gets a live reading of the value and prints it on the page
               slide: function( event, ui ) {
                   $( "#height-slider-result" ).html( ui.value );
               },
 
               //this updates the hidden form field so we can submit the data using a form
               change: function(event, ui) {
               $('#height').attr('value', ui.value);
               }
 
               });






    });

</script>
  
    

<br/>
<?php echo Form::submit('Save',array('class'=>'btn  btn-primary')); ?>

<?php echo Form::close() ?>

