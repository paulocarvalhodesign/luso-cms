<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}}  :: Admin Area</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link href='http://fonts.googleapis.com/css?family=Quantico:400,700' rel='stylesheet' type='text/css'>
    {{ HTML::script('global/js/jquery.js') }} 
    {{ HTML::script('global/js/jquery.validate.min.js') }} 
    {{ HTML::style('jquery-ui/css/lusocms-theme/jquery-ui-1.9.0.custom.min.css') }} 
    {{ HTML::script('jquery-ui/js/jquery-ui-1.9.0.custom.min.js') }} 
    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
    {{ HTML::style('themes/admin/css/dashboard.css') }}
    {{ HTML::style('global/css/cms.css') }}
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
                <h4><i class="icon-inbox"></i> Forms

                   <ul class="inner_navigation">
                    <li> <a href="#"  onclick="$('#upload_modal').modal({backdrop: 'static'});"><i class="icon-plus-sign icon"></i> Add New Field </a></li>
                   <li><a href="{{ url('form/list') }}"><i class="icon icon-arrow-left"></i> Back</a></li>
                  </ul>
                </h4> 
 </div>
              <br/>
              <div class="block">
                <div class="span12">
             <div class="span9">
              <ul class="navigation secondary_nav" >
            
                <div class="row-fluid">
               <div class="span12">
                <div class="span12">
                  <div class="span4">
               <h5>Managing Form :: {{ $form->name }}</h5>

               {{ Form::open('form/manage_form/')  }}
               <br/>
               {{ Form::hidden('id', $form->id) }}
               <label>Form Name:</label>
               {{ Form::text('name', $form->name) }}
               <br/>
               <label>Form Title:</label>
               {{ Form::text('title', $form->title) }}
               <br/>
               <label>Submited Message:</label>
               {{ Form::textarea('message', $form->message) }}
               <br/>
               {{ Form::submit('Update', array('class'=>'btn btn-primary')) }}

               {{ Form::close() }}
                 </div>
                <div class="span8">
               <h5>Managing Fields for :: {{ $form->name }}</h5>
                @if(!empty($fields)) 
               <ul class="fields sortable">
               @foreach($fields as $field)

              <li  id="item-{{$field->id}}">
              <div class="row-fluid">
              <div class="span12">
                  <div class="span9">
                   <span><i class="icon-comment"></i> {{ $field->label }} </span>
                  </div>
                  <div class="span3">
                  <a onclick="$('#field_modal-{{$field->id}}').modal({backdrop: 'static'});" class="btn btn-info  page-options" href="#"><i class="icon-wrench"></i></a> 
                  
                  <a href="{{ url('form/delete_field/'.$field->id) }}" class="btn btn-danger  page-options" href="#"><i class="icon-minus"></i></a>

                 
                  </div>
                
                   <div class="modal hide" id="field_modal-{{$field->id}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Edit Field:</h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ URL::to('form/edit_field/'.$field->id) }}" id="field_modal_form--{{$field->id}}" enctype="multipart/form-data">
                    <label for="name">name</label>
                    {{Form::text('name',$field->name)}}
                    <br/>
                     {{ Form::hidden('form_id',$field->form_id) }}

                     <label>Label:</label>

                    {{ Form::text('label',$field->label) }}

                    <label>Rules: Usage like :: example(required|max:50)</label>
                    
                    
                    {{ Form::text('rules', $field->rules, array('placeholder'=>'required|max:50')) }}
                    <br/>
                    <label for="type">Type</label>    
                     <?php

                   $types = array(

                    'text' => 'Text',
                    'textarea' => 'Textarea',
                    'email' => 'Email',
                    'telephone' => 'Telephone',
                    'select' => 'Select',
                    'date' => 'Date',
                    'checkbox' => 'Checkbox',


                    );

                   ?>



                    {{ Form::select('type', $types, $field->type) }}
                    <br/>
                    <label>select Options:</label>
                    <p>Comma separated values please.</p>
                     {{ Form::text('options',$field->options,array('placeholder'=>'one,two,three')) }}
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                    <button type="button" onclick="$('#field_modal_form--{{$field->id}}').submit();" class="btn btn-primary">Save</a>
                      </form>
                </div>
               </div>
            
              </div>
              </div>
                  </li>
                @endforeach
              </ul>
              @else
               
               <p>No forms fields created.</p>
              
               @endif  
                 </div>
               </div>
             </div>
           </div>
             
              
             
             </div>
             <div class="span3">

              
              <div class="modal hide" id="upload_modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add New Field:</h3>
                </div>
                <div class="modal-body">
                  <div class="row-fluid">
                  <div class="span12">
                       <div class="span4">
                    {{ Form::open('form/new_field', '', array('id'=>'set_from')) }}
                    {{ Form::hidden('form_id', $form_id) }}
                    <label>Type:</label>

                   <?php

                   $types = array(

                    'text' => 'Text',
                    'textarea' => 'Textarea',
                    'email' => 'Email',
                    'telephone' => 'Telephone',
                    'select' => 'Select',
                    'date' => 'Date',
                    'checkbox' => 'Checkbox',


                    );

                   ?>



                    {{ Form::select('type', $types) }}

                    <label>Label:</label>

                    {{ Form::text('label') }}

                    <label>Name:</label>

                    {{ Form::text('name') }}
                  </div>
                   <div class="span4">

                     <label>Rules: Usage like :: example(required|max:50)</label>

                    {{ Form::text('rules', '', array('placeholder'=>'required|max:50')) }}


                    <p>Rules: Documentation:</p>
                    <ul>
                      <li>Required = required</li>
                      <li>Max or Min = max:50 / min:5</li>
                      <li>Size = size:50 / between:10,50</li>
                       <li>Email = email</li>
                       <li>Url = url</li>
                       <li>Numeric = numeric</li>
                    </ul>
                  </div>
                   <div class="span4">
                      <label>select Options:</label>
                      <p>Comma separated values please.</p>
                       {{ Form::text('options','',array('placeholder'=>'one,two,three')) }}

                   </div>
                </div>
                  </div>
                    </div>
                <div class="modal-footer">
                     
                      <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                   
                      {{ Form::submit('Add Form', array('class'=>'btn btn-primary')) }}

                  {{ Form::close() }}     
                </div>
               </div>
                
            </div>
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
                     url: "{{url('form/fields_order')}}",
                     type: 'POST',      
                     data: $(this).sortable("serialize"),
                     success: function (data) {
                     var message = '<div class="alert alert-info"> <button type="button" class="close" data-dismiss="alert">×</button>Fields Rearranged!</div>';  
                     $(".ajax-message").html(message);
                     $('.ajax-message').animate({right: '-30px'}, 500, function() {
                         
                     });
                     $('.ajax-message').delay(2000).animate({right: '-310px'}, 500, function() {});
                         
                     }
     
                 });
                              
                 }
                     
             });
     
    
         });  
     
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
            $("#set_from").validate({
                rules: {
                    name: "required",
                    label: "required",
                    type: "required",
                   
                    
                  
                },
                messages: {
                    name: "Please choose name for the new field",
                    label: "Please choose name for the new label",
                    type: "Please choose field type",
                    
                    
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
