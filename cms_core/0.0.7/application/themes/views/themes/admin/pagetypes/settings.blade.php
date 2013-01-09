<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}} :: Admin Area</title>
    <meta name="viewport" content="width=device-width">
    {{ HTML::script('global/js/jquery.js') }} 
    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
    {{ HTML::style('themes/admin/css/dashboard.css') }}
</head>
{{ Session::get('info') }}
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
                <li><i class="icon-file"></i> {{ HTML::link('pages', 'Pages') }} </li>
                 
                <li><i class="icon-folder-close"></i> {{ HTML::link('files', 'Files') }}</li>
                  
                 <li><i class="icon-inbox"></i> {{ HTML::link('form/list', 'Forms') }}</li>
                <li><i class="icon-user"></i> {{ HTML::link('users', 'Users') }}</li>
                 
                <li  class="active"><i class="icon-wrench"></i> {{ HTML::link('settings', 'Settings') }}</li>
                <ul class="inner_navigation">
        <li> <a href="#" type="button" class="" onclick="$('#theme_modal').modal({backdrop: 'static'});"><i class="icon-picture icon-white"></i> Install Theme </a></li>
                </ul>
                <li><i class="icon-off"></i> {{ HTML::link('logout', 'Logout') }}</li>
          </ul>
            {{  Elements::get('admin_footer') }}
      </div>                 
    </div>         





  <div class="span10 main">

  <div class="ajax-message"></div>
         <br/>
         <div class="block header_block">
                <h4><i class="icon-wrench"></i> Settings</h4>  
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


                  <h4><i class="icon-wrench"></i> Error Level</h4>
                  
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
                  <h4><i class="icon-wrench"></i> Website Name</h4> 

                 <?php foreach($sitename as $s)

                  $name = $s->value;
                  ?>

                  {{ Form::open('settings/sitename')}}

                  {{Form::text('site_name', $name, array('placeholder'=>'Site Name'))}}
                   <br/>
                  {{Form::submit('Save', array('class'=>'btn btn-primary'))}}
                  {{Form::close()}}
               

                   
                  <h4><i class="icon-wrench"></i> Theme</h4> 

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
               <h4><i class="icon-wrench"></i> Google Analytics</h4> 
                      
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
          <br/>
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


  
 
    {{ HTML::script('global/bootstrap/js/bootstrap.min.js') }} 
</body>
</html>
