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



{{ Session::get('info') }}

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
                <li class="active"><i class="icon-user"></i> {{ HTML::link('users', 'Users') }}</li>
                <ul class="inner_navigation">
                      <li><a href="#" onclick="$('#new_user_modal').modal({backdrop: 'static'});" class="" ><i class="icon-user icon-white"></i> New User </a>
                </ul>
                <li><i class="icon-wrench"></i> {{ HTML::link('settings', 'Settings') }}</li>
                <li><i class="icon-off"></i> {{ HTML::link('logout', 'Logout') }}</li>
          </ul>
       {{  Elements::get('admin_footer') }}
      </div>                 
    </div>         





  <div class="span10 main">

  <div class="ajax-message"></div>
         <br/>
         <div class="block header_block">
          <h4><i class="icon-user"></i> Users</h4>  
          </div>
          <br/>
        <div class="block">
        <div class="row-fluid">
             <div class="span12">
               <table class="table table-condensed table-bordered">
             <thead>
             <tr>
             <th>Avatar</th>
             <th>nickname</th>
             <th>first name</th>
             <th>last name</th>
             <th>email</th>
             <th>Options</th>
             </tr>
             </thead>
             <tbody>
              @foreach($users as $user)
             
              <tr> 
                <td>
                  
                  <div class="user_img">  
                  <?php $gravatar = CMS::get_gravatar($user->username)  ;?>
                  <?php if($gravatar):?>
                   <img src="<?php echo $gravatar;?>" width="50" height="50"/>
                   <?php else:?>
                  <?php if(!empty($user->avatar)):?>
                   <img src="<?php echo url('public/filemanager/images/'.$user->avatar);?>" width="50" height="50"/>
                  <?php else : ?>
                   <img src="<?php echo url('public/images/avatar_user.png');?>" width="50" height="50"/>
                   <?php endif;?> 
                   <?php endif;?>
                  </div>

                </td>
                <td>{{$user->nickname}} </td>
                <td>{{$user->firstname}} </td>
                <td>{{$user->lastname}} </td>
                <td>{{$user->username }} </td>
                <td><span class="btn btn-info"><a  onclick="$('#user_modal-{{$user->id}}').modal({backdrop: 'static'});" href="#"><i class="icon-wrench"></i> Manage User</a></span></td>
              </tr>

                 <div class="modal hide" id="user_modal-{{$user->id}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Edit User:</h3>
                </div>
                <div class="modal-body">
                 
                    <form method="POST" action="{{ URL::to('users/update') }}" id="user_modal_form--{{$user->id}}" enctype="multipart/form-data">
                       
                       <div class="span12">
                       <div class="span6">              
                       
                       {{Form::hidden('id',$user->id)}}
                      <label>Avatar: (Use filename from file manager)</label>
                      {{Form::text('avatar', $user->avatar)}}
                      <br/>

                      <label>Nickname:</label>
                      {{Form::text('nickname', $user->nickname)}}
                      <br/>
                        <label>Username:</label>
                      {{Form::text('username', $user->username)}}
                      <br/>
                        <label>Firstname:</label>
                      {{Form::text('firstname', $user->firstname)}}
                      <br/>
                      <label>Lastname:</label>
                      {{Form::text('lastname', $user->lastname)}}
                       <br/>
                      
                      <label>New Password</label>
                      {{Form::password('password')}} 
                       </div>
                       <div class="span6"></div>
                      </div>
              
                                     
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                    @if($user->id > '1')
                    <a href="{{url('users/delete/'.$user->id)}}" class="btn btn-danger">Delete User</a>
                   @endif
                    <button type="button" onclick="$('#user_modal_form--{{$user->id}}').submit();" class="btn btn-primary">Save</a>
                  </form>
                </div>
               </div>

              @endforeach
            </tbody>
            </table>  

            </div>
        </div>
      </div>
   </div>

 <div class="modal hide" id="new_user_modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>New User:</h3>
                </div>
                <div class="modal-body">
                   
                    <form method="POST" action="{{ URL::to('users/new') }}" id="new_user_modal_form" enctype="multipart/form-data">
                      
                      <label>Avatar: (Use filename from file manager)</label>
                      {{Form::text('avatar')}}
                      <br/>
                   

                      <label>Nickname:</label>
                      {{Form::text('nickname')}}
                      <br/>
                        <label>Username:</label>
                      {{Form::text('username')}}
                      <br/>
                        <label>Firstname:</label>
                      {{Form::text('firstname')}}
                      <br/>
                      <label>Lastname:</label>
                      {{Form::text('lastname')}}
                       <br/>
                      
                      <label>Password</label>
                      {{Form::password('password')}} 
                      <br/>
                      </div>
                     
                
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                    <button type="button" onclick="$('#new_user_modal_form').submit();" class="btn btn-primary">Save</a>
                </form>
                </div>
               </div>

   

    {{ HTML::script('global/bootstrap/js/bootstrap.min.js') }} 

    

</body>
</html>