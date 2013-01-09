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
                <li class="active"><i class="icon-inbox"></i> {{ HTML::link('form/list', 'Forms') }}</li>
                 <ul class="inner_navigation">
                    <li> <a href="#"  onclick="$('#upload_modal').modal({backdrop: 'static'});"><i class="icon-plus-sign icon-white"></i> Add New Form </a></li>
                   
                  </ul>
                <li><i class="icon-user"></i> {{ HTML::link('users', 'Users') }}</li>
                <li><i class="icon-wrench"></i> {{ HTML::link('settings', 'Settings') }}</li>
                <li><i class="icon-off"></i> {{ HTML::link('logout', 'Logout') }}</li>
          </ul>
     {{  Elements::get('admin_footer') }}
      </div>                 
    </div>  

<div class="span10 main">
 <br/>
<div class="block header_block">
                <h4><i class="icon-inbox"></i> Forms</h4> 

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
   <script type="text/javascript">
  
  var ht = $(window).height(); 
 $('#sidebar').css('height', ht);
 $('.main').css('height', ht);
 </script>


    {{ HTML::script('global/bootstrap/js/bootstrap.min.js') }} 
</body>
</html>
