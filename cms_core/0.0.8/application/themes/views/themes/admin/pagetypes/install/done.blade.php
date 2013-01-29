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
       <div class="span3"></div>     
       <div class="span6">
       
          <div class="box">

         <h4 class="step_header step_one"><img src="<?php echo url('public/global/img/logo.png');?>"/><span>Ready to Install</span></h4>

        <p>Congratulations, we have all the information needed to install your cms :)</p>
          <br/>
           <br/>
            <br/>
           {{ Form::open('setup/done') }}

            {{ Form::hidden('done','true') }}

            {{ Form::submit('Complete Install', array('class'=>'btn')) }}

           {{ Form::close() }}
       
        </div>
         {{  Elements::get('admin_footer') }}
      </div>
        <div class="span3"></div>  
       
        </div>  
    </div>



  {{ HTML::script('global/bootstrap/js/bootstrap.min.js') }}  
  {{ HTML::script('themes/admin/js/app.js') }} 
  
</body>
</html>