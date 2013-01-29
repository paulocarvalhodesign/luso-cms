<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}} :: Admin Area</title>
    <meta name="viewport" content="width=device-width">
    {{ HTML::script('global/js/jquery.js') }} 
    {{ HTML::script('global/js/jquery.validate.min.js') }} 
    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
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
                    <li class="inneractive"><i class="icon-white icon-plus"></i> {{ HTML::link('pages/new', ' Add New Page') }}</li>
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
   @if (Session::has('errors'))
     <div class="alert alert-error">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <span class="error">
       <ul>
                  {{ implode('', $errors->all('<li>:message</li>'))}}
      </ul>
    </span>
 </div>
    @endif

  <div class="ajax-message"></div>
     <br/>
      <div class="block header_block">
        <h4><i class="icon-file"></i>Add New Page</h4>
      </div>
             <br/>
              <div class="block">
             <div class="row-fluid"> 
              <div class="span12"> 
               
              <div class="span9">
                <div class="row-fluid">
                <div class="span12">
                  
                 <div class="span1"></div>  
                   <div class="span4">
              
              {{ Form::open('pages/new', '',array('id'=>'new_page_form')) }}
             <p>
              <label>Page Title:</label>
              {{ Form::text('title', '', array('id'=>'title')) }}
            </p>
             <p>
              <label>Page URL:</label>
              {{ Form::text('url', '', array('id'=>'url')) }}
            </p>
               <p>
              <label>PageType:</label>
              
              {{ Form::select('pagetype', $pagetypes) }}
            </p>
            <p>
              <label>Parent:</label>
              
              {{ Form::select('parent_id', $parents) }}
            </p>
              <p>
              <label>Exclude from sitemap</label>
              <?php 
              
              $opts = array('0'=>'FALSE', '1'=>'TRUE');  
              
              ?>
              {{ Form::select('exclude_from_sitemap', $opts) }} 
              </p>  
              <p>
              <label>Page Tags</label>
              {{Form::text('tags')}}
              </p>
                 </div>
                 <div class="span7">
             <p>
              
              <label>Description:</label>
              {{ Form::textarea('description', '', array('class'=>'description')) }}
            </p>

               <p> 
               
               <label>Exclude from Navigation</label>
               
              {{ Form::select('exclude_from_navigation', $opts) }}
          </p>
           <p>
               <label>Exclude from pagelist</label>
               
              {{ Form::select('exclude_from_pagelist', $opts) }}
               </p>
               <p>
              <label>Page Keywords</label>
              {{Form::text('keywords')}}
              </p>
              </div>
            </div>
                 
               </div>
              </div>
            <div class="span3">

             <center>
                <h6><i class="icon-wrench"></i> Options:</h6>
               <a class="page-options btn btn-max" href="{{url('pages')}}"><i class="icon-white icon-arrow-left"></i> Back</a>
               <br/>
                 <br/>
               {{Form::submit('Create Page', array('class'=>' btn btn-max btn-primary'))}}

               {{ Form::close() }}
              
              </center> 
               <!-- submit button -->
   

             </div> 
                 {{ Form::close() }}
            </div>
      </div>



  


    {{ HTML::script('global/bootstrap/js/bootstrap.min.js') }} 
    {{ HTML::script('themes/admin/js/app.js') }}
    <script> 
   
    $("#title").keyup(function(){
    $("#url").val(this.value.replace(/\s+/g, '-').toLowerCase());
    });
    </script>




<script>
    (function($,W,D)
{
    var FORM = {};

    FORM.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#new_page_form").validate({
                rules: {
                    title: "required",
                    url: "required",
                    pagetype: "required",
                    parent: "required",
                  
                },
                messages: {
                    title: "Please enter a title",
                    url: "Please enter url for the page",
                    pagetype: "Please choose a page tpye",
                    parent: "Please choose a parent",
                    
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
