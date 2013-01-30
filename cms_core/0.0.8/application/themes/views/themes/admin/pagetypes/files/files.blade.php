<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}} :: Files Area</title>
       <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
   <link href='http://fonts.googleapis.com/css?family=Quantico:400,700' rel='stylesheet' type='text/css'>

        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    
    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
    {{ HTML::style('themes/admin/css/dashboard.css') }}
    {{ HTML::script('global/js/jquery.js') }} 
    {{ HTML::script('global/js/jquery.validate.min.js') }} 
    {{ HTML::script('global/bootstrap/js/bootstrap.min.js') }} 
    {{ HTML::script('themes/admin/js/app.js') }}

    
     

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
          <h4> <i class="icon-file"></i> Files 
             

             <ul class="inner_navigation">
                    <li>
                         <a href="{{url('files/sets')}}"> <i class="icon icon-folder-open"></i> File Sets</a>
                       
                    </li>
                  
                   <li>  
                   
                    <a href="#" type="button" class="" onclick="$('#upload_modal').modal({backdrop: 'static'});"> <i class="icon-plus-sign icon"></i>
                     Upload </a>
                 </li>
                <li>  
                      
                        <a href="#" type="button" class="" onclick="$('#multi_upload_modal').modal({backdrop: 'static'});">  <i class="icon-plus-sign icon"></i> Multi-files Upload </a>
            </li>
            </ul>
          </h4>
           </div>
           <br/> 
           
           @if(empty($files))
            <div class="block">            
           <p>No files uploaded...</p>
       
           @else

            <div class="block">
             <table class="table table-condensed table-bordered">
             <thead>
             <tr>
             <th>Thumb</th>
             <th>Title</th>
             <th>Name</th>
              <th>Type</th>
             <th>Sets</th>
             <th>Properties</th>
          
             <th>Delete</th>
             </tr>
             </thead>
             <tbody>
             @foreach($files->results as $file)


             <div class="modal hide" id="set_modal-{{$file->id}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add file to set:</h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ URL::to('files/add_to_set') }}" id="sets_modal_form{{$file->id}}" enctype="multipart/form-data">
                       <div class="row-fluid">
                       <div class="span12">
                        <div class="span6">
                        <label for="photo">Sets</label>
                        
                         {{Form::select('set', $sets)}}

                         {{Form::hidden('file', $file->id)}}
                     </div>
                      <div class="span6">
                        <label>In Sets:</label>

                        <?php 

                        $filesets = DB::table('files_in_sets')->where_file_id($file->id)->get();
                        ?>
                        <ul class="list_sets">
                        @if(!empty($filesets))    
                        @foreach($filesets as $fs)   
                        <?php $name = DB::table('sets')->find($fs->set_id);?>
                        <li><span class="btn"><i class="icon-folder-open"></i> {{$name->name}} :: <a class="btn btn-danger" href="{{url('files/remove_from_set/'.$fs->id)}}"> X</a></span></li>
                       @endforeach
                       @endif
                        </ul>
                      </div>
                     </div>
                     </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                    <button type="button" onclick="$('#sets_modal_form{{$file->id}}').submit();" class="btn btn-primary">Add to Set</a>
                </div>
               </div>




                <div class="modal hide" id="properties_modal-{{$file->id}}">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>File Properties</h3>
                </div>
                <div class="modal-body">
                         <form method="POST" action="{{ URL::to('files/save_properties') }}" id="properties_modal_form{{$file->id}}" enctype="multipart/form-data">
                 
                        <label>Title:</label>
                         {{Form::text('title', $file->title)}}
                         
                         <label>Filename:</label>
                         {{Form::text('name', $file->filename)}}

                          <label>Description:</label>
                         {{Form::textarea('description', $file->description)}}

                         {{Form::hidden('id', $file->id)}}

                        
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                    <button type="button" onclick="$('#properties_modal_form{{$file->id}}').submit();" class="btn btn-primary">Save</a>
                  
                </div>
               </div>





             
             <tr>
             <td class="white"><img  src="{{$file->thumb_location}}" width="48px" height="48px"/></td>
             <td class="white">{{$file->title}}</td>
             <td class="white">{{$file->filename}}</td>
             <td class="white">{{$file->mime}}</td>
            
            <td><span class="btn btn-info"><a href="{{ url('#') }}" onclick="$('#set_modal-{{$file->id}}').modal({backdrop: 'static'});" > Sets </a> </span></td>
            <td><span class="btn btn-info"><a href="{{ url('#') }}" onclick="$('#properties_modal-{{$file->id}}').modal({backdrop: 'static'});" > Properties </a></span> </td>
           
           
              
              
             <td><span class="btn btn-danger"><a href="{{ url('files/delete_file/'.$file->id) }}"> Delete</a></span></td>
             
           
            
             </tr>
             
             @endforeach
             
             </tbody>
             </table>   
                {{$files->links()}} 

              @endif           
             </div>
           
             
     
                        
          
            
            

             
               <div class="modal hide" id="upload_modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Upload a new file:</h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ URL::to('files/upload') }}" id="upload_modal_form" enctype="multipart/form-data">
                        <label for="photo">Photo</label>
                        <input type="file" placeholder="Choose a file to upload" name="file" id="file" />
                        <label for="description">Title</label>
                        <input type="text" value="" name="title"/>
                        <label for="description">Description</label>
                        <textarea placeholder="Describe your file in a few sentences" name="description" id="description" class="span5"></textarea>
                        <label for="photo">Add files to existing set?</label>   

                        <?php foreach($sets as $key=>$value):?>

                         <?php 
                          $current[''] = 'Dont add to set';
                          $current[$value] = $value;
                        ?>

                        <?php endforeach;?>

                        {{Form::select('set',$current)}}
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                    <button type="button" onclick="$('#upload_modal_form').submit();" class="btn btn-primary">Upload File</a>
                </div>
               </div>


               

<div class="modal hide" id="multi_upload_modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Upload multi-file:</h3>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ URL::to('files/multi_upload') }}" id="multi_upload_modal_form" enctype="multipart/form-data">
                        <label for="photo">Zip file</label>
                        <input type="file" placeholder="Choose a file to upload" name="file" id="file" />

                        

                        <label for="photo">Add files to existing set?</label>   

                        <?php foreach($sets as $key=>$value):?>

                         <?php 
                          $current[''] = 'Dont add to set';
                          $current[$value] = $value;
                        ?>

                        <?php endforeach;?>

                        {{Form::select('set',$current)}}
                    </form>
                </div>
                <div class="modal-footer">
                    <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                    <button type="button" onclick="$('#multi_upload_modal_form').submit();" class="btn btn-primary">Upload File</a>
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
<script>
    (function($,W,D)
{
    var FORM = {};

    FORM.UTIL =
    {
        setupFormValidation: function()
        {
            //form validation rules
            $("#multi_upload_modal_form").validate({
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
