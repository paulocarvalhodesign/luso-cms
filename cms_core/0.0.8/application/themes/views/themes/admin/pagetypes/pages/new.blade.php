<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}} :: New Page</title>
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
     <br/>
      <div class="block header_block">
        <h4>

          <i class="icon-file"></i>Add New Page

          <ul class="inner_navigation">
               <li>
                 <a href="{{url('pages')}}"> <i class="icon icon-arrow-left"></i> Back</a>
              </li>
              
            </ul> 

        </h4>
      </div>
             <br/>
              <div class="block">
              <div class="row-fluid"> 
              <div class="span12">

                {{ Form::open('pages/new', '',array('id'=>'new_page_form')) }}

              <div class="span4"> 
              <p>
              <label><span>Page Title:</span></label>
              {{ Form::text('title', '', array('id'=>'title')) }}
              </p>
              <p>
              <label><span>Page Tags</span></label>
              {{Form::text('tags')}}
              </p>
               <p>
              <label><span>Page Keywords</span></label>
              {{Form::text('keywords')}}
              </p>

              </div>

              <div class="span4"> 
              <p>
              <label><span>Page URL:</span></label>
              {{ Form::text('url', '', array('id'=>'url')) }}
             </p>
             <p>
              <label><span>Exclude from sitemap</span></label>
              <?php 
              
              $opts = array('0'=>'FALSE', '1'=>'TRUE');  
              
              ?>
              {{ Form::select('exclude_from_sitemap', $opts) }} 
              </p>  
              <p> 
               
               <label><span>Exclude from Navigation</span></label>
               
              {{ Form::select('exclude_from_navigation', $opts) }}
               </p>
              </div> 

              <div class="span4"> 
              <p>
              <label><span>PageType:</span></label>
              {{ Form::select('pagetype', $pagetypes) }}
             </p>

             <p>
              <label><span>Parent:</span></label>
              
              {{ Form::select('parent_id', $parents) }}
            </p>
             <p>
               <label><span>Exclude from pagelist</span></label>
               
              {{ Form::select('exclude_from_pagelist', $opts) }}
               </p>
            </div>
              
              
             </div>
             </div>
              <div class="row-fluid"> 
              <div class="span12">  
              <div class="span8">
              
              
                 
             <p>
              
              <label><span>Description:</span></label>
              {{ Form::textarea('description', '', array('class'=>'description', 'width'=>'100%')) }}
            </p>

               </div>
                <div class="span4">
          
              
              <br/>
              <br/>
              <br/>
              <br/>

            

            {{Form::submit('Create Page', array('class'=>'btn'))}}

          
            {{ Form::close() }}
            </div>
      </div>
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
