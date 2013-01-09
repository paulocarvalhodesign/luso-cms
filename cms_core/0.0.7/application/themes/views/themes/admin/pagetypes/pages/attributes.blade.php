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
                    <li><a  onclick="$('#upload_modal').modal({backdrop: 'static'});" href="#"><i class="icon-white icon-plus"></i> Add Atribute</a></li>
                    <li><a  href="{{url('pages')}}"><i class="icon-white icon-arrow-left"></i> Back</a></li>        
                  </ul>
                
                <li><i class="icon-folder-close"></i> {{ HTML::link('files', 'Files') }}</li>
                 <li><i class="icon-inbox"></i> {{ HTML::link('form/list', 'Forms') }}</li>
                <li><i class="icon-user"></i> {{ HTML::link('users', 'Users') }}</li>
                <li class="active"><i class="icon-wrench"></i> {{ HTML::link('settings', 'Settings') }}</li>
                <li><i class="icon-off"></i> {{ HTML::link('logout', 'Logout') }}</li>
          </ul>
 {{  Elements::get('admin_footer') }}
      </div>                 
    </div>  
             <div class="span10 main">
                <div class="ajax-message"></div>
              <br/>
              <div class="block header_block">
                <h4><i class="icon-file"></i> Page Attributes</h4>  
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
             <th>Edit</th>
             <th>Delete</th>
             </tr>
             </thead>
             <tbody>
          
              
                @foreach($attributes as $attribute)
                <tr>
                <td>{{$attribute->type}}</td>
                <td>{{$attribute->name}}</td>
                <td><span class="btn btn-info"><a  href="#" onclick="$('#attribute_modal-{{$attribute->id}}').modal({backdrop: 'static'});"><i class="icon-wrench"></i> Edit</a></span></td>
                <td><span class="btn btn-danger"><a href="{{url('pages/delete_attribute/'.$attribute->id) }}"><i class="icon-minus"></i> Delete</a></span></td>
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
                    <label for="photo">name</label>
                    {{Form::text('name')}}
                    <br/>
                    <label for="photo">type</label>
                    <?php $types = array(

                      'text'=>'Text',
                      'image'=>'Image'

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




    {{ HTML::script('global/bootstrap/js/bootstrap.min.js') }} 

    <script>
    $(document).ready(function() {    

 var ht = $(window).height(); 
 $('#sidebar').css('height', ht);
 $('.main').css('min-height', ht);
    });
</script>
</body>
</html>
