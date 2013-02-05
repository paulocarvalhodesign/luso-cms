<ul id="navigation" class="dashboard_navigation">
	
     <li><a href=" <?php echo url('admin') ;?> "><i class="icon-th-large"></i> Dashboard</a> </li>
     <li><a href=" <?php echo url('pages') ;?> "><i class="icon-file"></i> Pages</a> </li>
     <li><a href=" <?php echo url('files') ;?> "><i class="icon-folder-close"></i> Files</a> </li>
     <li><a href=" <?php echo url('form/list') ;?> "><i class="icon-inbox"></i> Forms</a> </li>
     <li><a href=" <?php echo url('users') ;?> "><i class="icon-user"></i> Users</a> </li>
     <li><a href=" <?php echo url('settings') ;?> "><i class="icon-wrench"></i> Settings</a> </li>
     <li><a href=" <?php echo url('extensions') ;?> "><i class="icon-th"></i> Extensions & Blocks</a> </li>
  
     <a class="frontend_btn tt" rel="tooltip" data-placement="top" data-original-title="Frontend " href="<?php echo url('/');?>"><i class="icon-globe icon"></i></a>
</ul>
<script>
$(document).ready(function() {

  $(function(){
   
   var segment = url('1');
   var dash = '/';
  
   if(segment == '') { 
    var root = segment+dash;
    }else{
    var root = segment;
    }
    
    $('#navigation li  a[href*="' + root + '"]').attr('class', 'selected');
    $('#navigation li  a[href*="' + root + '"]').parent().attr('class', 'selected-path');
    $('#navigation li  a[href*="' + root + '"] i').addClass('icon-white');
    $('#navigation li  a ').hover(

         function () {
        $(this).find('i').addClass('icon-selected');
        
         },
        function () {

          $(this).find('i').removeClass('icon-selected').addClass('icon');
         }

      );
    

    });




  
   });
</script>