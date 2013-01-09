<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}} :: Admin Area</title>
    <meta name="viewport" content="width=device-width">
    {{ HTML::script('global/js/jquery.js') }} 
    {{ HTML::style('jquery-ui/css/lusocms-theme/jquery-ui-1.9.0.custom.min.css') }} 
    {{ HTML::script('jquery-ui/js/jquery-ui-1.9.0.custom.min.js') }} 
    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
    {{ HTML::style('global/css/jqtree.css') }}
    {{ HTML::style('themes/admin/css/dashboard.css') }}

</head>
<body class="dashboard">
  <div class="dashboard-wrapper">

  
<div class="container">
           
  
           



<div class="row-fluid">
 <div class="span12">
   <div class="span2">
      <div id="sidebar">
         {{  Elements::get('dashboard_elements') }}
         <ul class="dashboard_navigation">
           <li><i class="icon-globe"></i> {{ HTML::link('', 'Frontend') }} </li>
                <li><i class="icon-th-large"></i> {{ HTML::link('admin', 'Dashboard') }} </li>
                <li class="active"><i class="icon-file"></i> {{ HTML::link('pages', 'Pages') }} </li>
                 <ul class="inner_navigation">
                    <li><i class="icon-white icon-plus"></i> {{ HTML::link('pages/new', ' Add New Page') }}</li>
                    <li><i class="icon-white icon-asterisk"></i> {{ HTML::link('pages/attributes', ' Page Atributes') }}</li>
                  </ul> 
                <li><i class="icon-folder-close"></i> {{ HTML::link('files', 'Files') }}</li>
                 <li><i class="icon-inbox"></i> {{ HTML::link('form/list', 'Forms') }}</li>
                <li><i class="icon-user"></i> {{ HTML::link('users', 'Users') }}</li>
                <li><i class="icon-wrench"></i> {{ HTML::link('settings', 'Settings') }}</li>
                <li><i class="icon-off"></i> {{ HTML::link('logout', 'Logout') }}</li>
          </ul>
      {{  Elements::get('admin_footer') }}
     </div>           
    </div>  

<div class="span10 main">

  <div class="ajax-message"></div>
     <br/>
          <div class="block header_block">
          <h4> <i class="icon-file"></i> Pages </h4>
           </div>
           <br/> 
           
         
            <br/>
             <div class="block">
               
              
            {{Tree::navigationTree()}}

              
             </div>
             <br/>
            <div>
             
             
        </div>
      </div>
</div>

{{ HTML::script('global/js/tree.jquery.js') }} 
<script type="text/javascript">
$(document).ready(function() {


$('#navigation_tree').tree({
  data: data,
  autoEscape: false,
  dragAndDrop: true,
  autoOpen: false
});
 


$('#navigation_tree').bind(
    'tree.move',
    function(event) {
        
              event.preventDefault();
             
              event.move_info.do_move();

               var items = []; 

              $('#navigation_tree  li p').each(function(index) {
               
               items[index] = $(this).text();

                
              });
 

              $.post('{{url('pages/order')}}', {tree: items});
              var message = '<div class="alert alert-info"> <button type="button" class="close" data-dismiss="alert">×</button>Pages Rearranged!</div>'; 
                     $(".ajax-message").html(message);
                     $('.ajax-message').animate({right: '-30px'}, 500, function() {
                         
                     });
                     $('.ajax-message').delay(2000).animate({right: '-310px'}, 500, function() {});        

    }
);

});
</script>


    {{ HTML::script('global/bootstrap/js/bootstrap.min.js') }} 
    {{ HTML::script('themes/admin/js/app.js') }} 

</body>
</html>
