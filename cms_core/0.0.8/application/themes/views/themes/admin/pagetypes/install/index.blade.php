<!doctype html>
<html lang="en" class="sign_up">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Luso CMS :: Setup :: Step 1 : Database</title>
     <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link href='http://fonts.googleapis.com/css?family=Quantico:400,700' rel='stylesheet' type='text/css'>
    {{ HTML::script('global/js/jquery.js') }} 
    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
    {{ HTML::style('themes/admin/css/login.css') }}

</head>
<body class="sign_up">
    <div class="container">
      <div class="row-fluid"> 
         <div class="span12">
        <div class="span4"></div>  
        <div class="span4">
          <center><h3 class="cms_logo"><img width="25" src="<?php echo url('public/global/img/icon.png');?>"> LUSO CMS</h3></center>
        </div>  
         <div class="span4"></div>  
        </div>
       <div class="span4"></div>     
       <div class="span4">
       <div class="box">
          
        <h4 class="step_header step_one"><span>Setup Database</span></h4>

        <?php 
        $database_file = path('app').'config/database.php'; 
      
        $db = is_writable($database_file);

        ?>

         @if(!$db) 
        
         <p class="write_error">database.php must be writable.</p>
         
        
         @else
        
        <?php $message = Session::get('message'); ?>


         @if(isset($message))
        
          {{$message}}
         
         @endif
       
        
        {{ Form::open('setup') }}

        <label>Host:</label>
        {{ Form::text('host') }}

        <label>Username:</label>
        {{ Form::text('username') }}

        <label>Password:</label>
        {{ Form::password('password') }}

         <label>Database Name:</label>
        {{ Form::text('table') }}
        <br/>
        {{ Form::submit('next', array('class'=>'btn')) }}
        
        {{ Form::close() }}
         @endif
        </div>
       
          {{  Elements::get('admin_footer') }}
      </div>
        <div class="span4"></div>  
       
        </div>  
    </div>



  {{ HTML::script('global/bootstrap/js/bootstrap.min.js') }}  
  {{ HTML::script('themes/admin/js/app.js') }} 
  
</body>
</html>