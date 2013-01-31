<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}} :: Page Attributes </title>
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
                <h4><i class="icon-file"></i> Page Attributes

                  <ul class="inner_navigation">
                    <li>
                     <a onclick="$('#upload_modal').modal({backdrop: 'static'});" href="#">
                     <i class="icon icon-plus"></i> Add Atribute</a>
                    
                    </li>
                    <li>
                      <a href="{{url('pages')}}"> <i class="icon icon-arrow-left"></i> Back</a>
                          
                  </ul>
                </h4>  
              </div>
                <br/>
              <div class="block">

              <div class="span12"> 

             @if(empty($attributes))  
              <p>No attributes available...</p> 
              @else   
             <table class="table table-condensed table-bordered">
             <thead>
             <tr>
            
             <th>Name</th>
             <th>Type</th>
             <th>Options</th>
             </tr>
             </thead>
             <tbody>
          
              
                @foreach($attributes as $attribute)
                <tr>
                <td>{{$attribute->type}}</td>
                <td>{{$attribute->name}}</td>
                <td><span class="btn btn-info"><a  href="#" onclick="$('#attribute_modal-{{$attribute->id}}').modal({backdrop: 'static'});"><i class="icon-wrench"></i> Edit</a></span>
                <span class="btn btn-danger"><a href="{{url('pages/delete_attribute/'.$attribute->id) }}"><i class="icon-minus"></i> Delete</a></span></td>
               </tr>

                 <div class="modal hide" id="attribute_modal-{{$attribute->id}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Edit Atribute:</h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ URL::to('pages/edit_attribute/'.$attribute->id) }}" id="upload_modal_form--{{$attribute->id}}" enctype="multipart/form-data">
                    <label for="name">name</label>
                    {{Form::text('name',$attribute->name)}}
                    <br/>
                    <label for="type">type</label>
                    
                     <?php $types = array(

                      'text'=>'Text',
                      'image'=>'Image'

                    );?>

                    {{Form::select('type', $types, $attribute->type)}}
                        
                  
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                    <button type="button" onclick="$('#upload_modal_form--{{$attribute->id}}').submit();" class="btn btn-primary">Save</a>
                      </form>
                </div>
               </div>



                @endforeach
              @endif
              </tbody>
             </table>  
           
            </div>
        </div>
     

            <div class="modal hide" id="upload_modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add Atribute:</h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ URL::to('pages/add_attribute') }}" id="upload_modal_form" enctype="multipart/form-data">
                    <label for="photo"><span>NAME:</span></label>
                    {{Form::text('name')}}
                    <br/>
                    <label for="photo"><span>type:</span></label>
                    <?php $types = array(

                      'text'=>'Text',
                      'image'=>'Image',
                      'date'=>'Date'

                    );?>

                    {{Form::select('type', $types)}}
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                    <button type="button" onclick="$('#upload_modal_form').submit();" class="btn btn-primary">Save</a>
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

<script>
    (function($,W,D)
{
    var FORM = {};

    FORM.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#upload_modal_form").validate({
                rules: {
                    name: "required",
                    type: "required",
                    
                  
                },
                messages: {
                    name: "Please enter a name for the atribute",
                    type: "Please specify the type of attribute",
                    
                    
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

{{ HTML::script('global/bootstrap/js/bootstrap.min.js') }} 
{{ HTML::script('themes/admin/js/app.js') }}

</body>
</html>
