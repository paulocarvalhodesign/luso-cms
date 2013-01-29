 <!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('cms.site_name')}} :: Admin Area</title>
    <meta name="viewport" content="width=device-width">
    {{ HTML::script('global/js/jquery.js') }} 
    {{ HTML::style('jquery-ui/css/lusocms-theme/jquery-ui-1.9.0.custom.min.css') }} 
    {{ HTML::script('jquery-ui/js/jquery-ui-1.9.0.custom.min.js') }} 
    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
    {{ HTML::style('themes/admin/css/dashboard.css') }}
    {{ HTML::style('global/css/cms.css') }}
</head>
 

<ul class="move_blocks sortable" >
<h4>Drag blocks to reorder them.</h4>
<?php foreach($blocks as $block):?>




 <li id="item-<?php echo $block->id;?>">&nbsp;<i class="icon-th-large"></i> Item-<?php echo $block->id;?>::<?php echo $block->block_slug;?></li>




<?php endforeach;?>






 </ul>	



     {{ HTML::script('global/bootstrap/js/bootstrap.min.js') }} 

    <script>
    $(document).ready(function() {    
      $(function() {
         $( ".sortable" ).sortable({
             opacity: 0.6, 
             cursor: 'move', 
             tolerance: 'pointer', 
             revert: true, 
             items:'li',
             placeholder: 'state', 
             forcePlaceholderSize: true,
             update: function(event, ui){
         

                 $.ajax({
                     url: "{{url('blocks/reorder')}}",
                     type: 'POST',      
                     data: $(this).sortable("serialize"),
                     success: function (data) {
                     var message = '<div class="alert alert-info"> <button type="button" class="close" data-dismiss="alert">×</button>Fields Rearranged!</div>';  
                     $(".ajax-message").html(message);
                     $('.ajax-message').animate({right: '-30px'}, 500, function() {
                         
                     });
                     $('.ajax-message').delay(2000).animate({right: '-310px'}, 500, function() {});
                      

                     window.location.reload(true);
                      
                     }
     
                 });
                              
                 }
                     
             });
     
    
         });  
     
         });
</script>

</body>
</html>