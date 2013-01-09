 
<?php $files = Files::all();?>


<br/>
<div id="images">
 <button class="btn btn-primary"  id="close_image_manager">Close</button>
 <ul class="filemanager" id="uItem" >
<?php foreach($files as $file):?>

<li>
  <p>
  
  
                       <img src="<?php echo $file->thumb_location;?>"/>
                        
                        <span><?php echo $file->location;?></span>
                          
  </p>
</li>

<?php endforeach;?>
</ul>
</div>
            
<?php echo Form::open('content/add') ?>

<?php echo Form::hidden('page_id', $page_id); ?>

<?php echo Form::hidden('global', $global); ?>

<?php echo Form::hidden('area', $area); ?>

<?php echo Form::textarea('content', '', array('id'=>'editor', 'class'=>'ckeditor')); ?>
<br/>
<?php echo Form::submit('Save',array('class'=>'btn  btn-primary bt-max')); ?>
<?php echo Form::close() ?>


<div class="buttons-content">
<button class="btn btn-info bt-max"  id="media-selector"><i class="icon-picture"></i>Media</button>
</div>
                  




<script type="text/javascript">
      $(document).ready(function () {
        $('#editor').ckeditor(function () { }, { 
          toolbarCanCollapse: false,
          skin :'BootstrapCK-Skin',      
          extraPlugins : 'internpage,MediaEmbed,maps,autogrow',
          autoGrow_maxHeight : 200,
          removePlugins : 'resize',
          toolbar :
          [
            ['Source','MediaEmbed','maps','-', 'Bold', 'Italic', 'TextColor', 'BGColor', '-', 'NumberedList', 'BulletedList' ,'-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyFull', '-', 'Link', 'Unlink', "Anchor", 'Image','HorizontalRule','Styles','Format','Font','FontSize' ]
      ],
            
            
           });
         
    
     $('#uItem p').click(function(){
      
      var $this = $(this);

    
      CKEDITOR.instances.editor.insertHtml('<img src="'+$this.text()+'"/>');
      

      });   

     $("#close_image_manager").click(function () {
      
      

      $('#images').hide();
      
      $('#media-selector').show();



      


      });   

    

     $("#media-selector").click(function (event) {
      
      event.preventDefault();

      $('#images').show();
      
      $('#media-selector').hide();



      


      });   

    });

</script>