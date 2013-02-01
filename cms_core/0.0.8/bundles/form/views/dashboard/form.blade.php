<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}} :: Forms Area</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <link href='http://fonts.googleapis.com/css?family=Quantico:400,700' rel='stylesheet' type='text/css'>
    {{ HTML::script('global/js/jquery.js') }} 
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
                <h4><i class="icon-inbox"></i> Forms
        
        {{Config::get('site_name')}}

                  <ul class="inner_navigation">
                    <li> <a href="#"  onclick="$('#upload_modal').modal({backdrop: 'static'});"><i class="icon-plus-sign icon"></i> Add New Form </a></li>
                   
                  </ul>

                </h4> 

   </div>
<br/>
<div class="block">
        <div class="row-fluid">
            <div class="span12">
          
             @if(!empty($forms)) 
           
             <table class="table table-condensed table-bordered">
             <thead>
             <tr>
             <th>Form Name</th>
             <th>Edit</th>
             <th>Delete</th>
             
             </tr>
             </thead>
             <tbody>
             
             @foreach($forms as $form)

                
          
               
              <tr>
                <td><i class="icon-inbox"></i> {{ $form->name }}</td>
                <td><span class="btn btn-info"><a href="{{ url('form/manage_form/'.$form->id) }}"><i class="icon-wrench"></i> Manage Form</a></span></td>
                <td><span class="btn btn-danger"><a href="{{ url('form/delete_form/'.$form->id) }}"><i class="icon-minus"></i> Delete From</a></span></td>
                
              </tr>
      

             
               
             @endforeach
              </tbody>
             </table>   
           @else
           
           <p>No forms available.</p>
          
           @endif  
          </div> 
             
            
              <div class="modal hide" id="upload_modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add New Form:</h3>
                </div>
                <div class="modal-body">
                    {{ Form::open('form/new', '', array('id'=>'set_from')) }}

                    <label>New Form:</label>

                    {{ Form::text('name') }}

                    

                   
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                    {{ Form::submit('add form', array('class'=>'btn btn-primary')) }}
                </div>
                {{Form::close()}}
               
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
   

    {{ HTML::script('global/js/jquery.validate.min.js') }} 
    {{ HTML::script('global/bootstrap/js/bootstrap.min.js') }} 
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
                   
                    
                  
                },
                messages: {
                    name: "Please choose name for the new form",
                   
                    
                    
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
