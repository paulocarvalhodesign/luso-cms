<!doctype html>
<html lang="en" class="sign_up">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Luso CMS :: Setup :: Step 3</title>
    <meta name="viewport" content="width=device-width">
    {{ HTML::script('global/js/jquery.js') }} 
    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
    {{ HTML::style('themes/admin/css/login.css') }}
    
</head>
<body class="login_page sign_up">
    <div class="container">
      <div class="row-fluid"> 
       <div class="span4"></div>     
       <div class="span4">
       <div class="box">
          

        <h4 class="step_header step_one"><img src="<?php echo url('public/global/img/logo.png');?>"/><span>Setup Application</span></h4>


        <?php $message = Session::get('message'); ?>


         @if(isset($message))
        
          {{$message}}
         
         @endif

        {{ Form::open('setup/install_cms') }}

        <label>Site Name:</label>
        {{ Form::text('name') }}


        <label>Website Theme:</label>
        <?php

        
           $directory = path('root').'cms_user/themes/views/themes/';  
 
            //get all files in specified directory
            $files = glob($directory . "*");
             
            //print each file name
            foreach($files as $file)
            {
             //check to see if the file is a folder/directory
             if(is_dir($file))
             {
              $result = str_replace($directory, '',$file);
              if($result == 'admin'){

              }else{
                $themes[$result] = $result;
              }
              
             }
            }
  

        ?>
        {{ Form::select('theme', $themes) }}

        
        <br/>
        {{ Form::submit('next', array('class'=>'btn')) }}
        
        {{ Form::close() }}
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