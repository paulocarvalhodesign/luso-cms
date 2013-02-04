<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}} :: Settings </title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link href='http://fonts.googleapis.com/css?family=Quantico:400,700' rel='stylesheet' type='text/css'>
    {{ HTML::script('global/js/jquery.js') }} 
     {{ HTML::script('global/js/jquery.validate.min.js') }}
    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
    {{ HTML::style('themes/admin/css/dashboard.css') }}
</head>
{{ Session::get('info') }}
<body class="dashboard">
  <div class="dashboard-wrapper">
    <div class="container">
      <div class="header_dashboard">
        <div class="row-fluid">
        
        {{  Elements::get('dashboard_elements') }}
          <div class="span12">
       
        {{  Elements::get('dashboard_navigation') }}
       
        </div>

      </div>
    </div>
  <div class="row-fluid">
<div class="span12 main">
<div class="ajax-message"></div>

                
               
         <br/>
         <div class="block header_block">
                <h4><i class="icon-wrench"></i> Settings

                  <ul class="inner_navigation">
        <li> <a href="#" type="button" class="" onclick="$('#theme_modal').modal({backdrop: 'static'});"><i class="icon-picture icon"></i> Install Theme </a></li>
                </ul>

                </h4>  
              </div>
            <br/>
            <div class="block">
              <div class="row-fluid">
                <div class="span12">
                 <div class="span6">
                  <div class="inner">
                   <hr/>
                  <h4><i class="icon-wrench"></i> Maintenance Mode</h4>
                  
                  {{ Form::open('settings/maintenance')}}

                  <?php 
                  foreach($mmode as $m)

                    if($m->value == 'true'){
                      $modes = array(
                          'true' => 'On',
                          'false'=> 'Off'
                      );
                    }else{
                        $modes = array(
                          'false'=> 'Off',
                           'true' => 'On');
                      }


                  ?>

                 
                  {{Form::select('maintenance_mode', $modes)}}
                  <br/>
                  {{Form::submit('Save', array('class'=>'btn btn-primary'))}}
                  {{Form::close()}}


                  <h4><i class="icon-warning-sign"></i> Error Level</h4>
                  
                  {{ Form::open('settings/error_level')}}

                  <?php 
                  foreach($error_level as $m)

                    if($m->value == 'true'){
                      $modes = array(
                          'true' => 'Show and Debug (Development)',
                          'false'=> "Hide errors (Production)"
                      );
                    }else{
                        $modes = array(
                          'false'=> "Hide errors (Production)",
                           'true' => 'Show and Debug (Development)');
                      }


                  ?>

                 
                  {{Form::select('error_level', $modes)}}
                  <br/>
                  {{Form::submit('Save', array('class'=>'btn btn-primary'))}}
                  {{Form::close()}}

                 <br/>
                 <hr/>
                 
                  
                </div> 
                </div> 
                <div class="span6">
                   <div class="inner">
                     <hr/>
                  <h4><i class="icon-pencil"></i> Website Name</h4> 

                 <?php foreach($sitename as $s)

                  $name = $s->value;
                  ?>

                  {{ Form::open('settings/sitename')}}

                  {{Form::text('site_name', $name, array('placeholder'=>'Site Name'))}}
                   <br/>
                  {{Form::submit('Save', array('class'=>'btn btn-primary'))}}
                  {{Form::close()}}
               

                   
                  <h4><i class="icon-picture"></i> Theme</h4> 

                  {{ Form::open('settings/theme')}}

                  {{Form::select('theme', $themes, $theme)}}
                   <br/> 
                  {{Form::submit('Save', array('class'=>'btn btn-primary'))}}
                  {{Form::close()}}
                   <br/>
                  <hr/>

                </div> 
   </div>
                </div>
            </div>
          </div>
          <br/>
          <div class="block"> 
          <div class="row-fluid">
            <div class="span12">

             <div class="span4">
               <h4><i class="icon-tasks"></i> Google Analytics</h4> 
                      
                      {{ Form::open('settings/analytics')}}

                      {{Form::text('username', $username, array('placeholder'=>'username'))}}
 <br/>
                     <input type="password" value="{{$password}}" name="password" placeholder="password">

                      <br/>
                      {{Form::text('profile', $profile, array('placeholder'=>'profile ID'))}}
 <br/>
                      {{Form::submit('Save', array('class'=>'btn btn-primary'))}}
 <br/>               
                      
             </div>
             <div class="span8">
                <?php $tracking = File::get(path('root').'/cms_config/tracking_code.php');?> 
               {{Form::textarea('tracking_code', $tracking ,array('placeholder'=>'tracking code...', 'rows'=>'10', 'style'=> 'width: 504px '))}}
  <br/>
                
                {{Form::close()}}
             </div> 
            </div>
          </div>
          </div>
         
        </div>
      </div>







<div class="modal hide" id="theme_modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Upload a new Package:</h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ URL::to('settings/theme_install') }}" id="theme_modal_form" enctype="multipart/form-data">
                        <label for="photo">Theme in Zip file format</label>
                        <input type="file" placeholder="Choose a file to upload" name="file" id="file" />
                       
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                    <button type="button" onclick="$('#theme_modal_form').submit();" class="btn btn-primary">Upload File</a>
                </div>
               </div>



<br/>

<div class="header_dashboard">
<div class="row-fluid">
<div class="span12">
<div class="span4"></div>
<div class="span4">
{{  Elements::get('admin_footer') }}
</div>
<div class="span4"></div>
</div>
</div>
</div>
 
    {{ HTML::script('global/bootstrap/js/bootstrap.min.js') }} 
    {{ HTML::script('themes/admin/js/app.js') }}

    <script>
    (function($,W,D)
{
    var FORM = {};

    FORM.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#theme_modal_form").validate({
                rules: {
                    file: "required",
                   
                    
                  
                },
                messages: {
                    file: "Please choose a file",
                   
                    
                    
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        }
    }

    //when the dom has loaded setup form validation rules
    $(D).ready(function($) {
        FORM.UTIL.setupFormValidation();
    });

})(jQuery, window, document);

</script>
</body>
</html>
