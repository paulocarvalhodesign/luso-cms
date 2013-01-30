<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}} :: File Sets Area</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
   <link href='http://fonts.googleapis.com/css?family=Quantico:400,700' rel='stylesheet' type='text/css'>

        <!--[if lt IE 9]>
          <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    
    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
    {{ HTML::style('themes/admin/css/dashboard.css') }}
     {{ HTML::style('jquery-ui/css/lusocms-theme/jquery-ui-1.9.0.custom.min.css') }} 
    
    
    {{ HTML::script('global/js/jquery.js') }} 
    {{ HTML::script('jquery-ui/js/jquery-ui-1.9.0.custom.min.js') }} 
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
         <br/>
         <div class="block header_block">
             <h4><i class="icon-folder-close"></i>File Sets

              <ul class="inner_navigation">
                    <li><a href="#" class="" onclick="$('#upload_modal').modal({backdrop: 'static'});"><i class="icon-plus-sign icon"></i> Add New Set </a></li>
                    <li>
                       <a href="{{url('files')}}"> <i class="icon icon-arrow-left"></i> Back</a>
                    </li>
                   </ul>
             </h4>  
             </div>
             <br/>
         <div class="block">
          <div class="row-fluid">
             <div class="span12">
             
             
              @if(!empty($sets->results)) 
             
            <table class="table table-condensed table-bordered">
             <thead>
             <tr>
             <th>Set Name</th>
             <th>Manage</th>
             <th>Delete</th>
             
             </tr>
             </thead>
             <tbody>
              
             @foreach($sets->results as $set)

               <tr>
                <td><i class="icon-folder-open"></i> {{ $set->name }}</td>
                <td><span class="btn btn-info"><a href="{{ url('files/manage_set/'.$set->id) }}"><i class="icon-wrench"></i> Manage Set</a></span></td>
                <td><span class="btn btn-danger"><a href="{{ url('files/delete_set/'.$set->id) }}"><i class="icon-minus"></i> Delete Set</a></span></td>
               </tr>

          
               
             @endforeach
           </tbody>
             </table>  
            </div> 
             {{$sets->links()}}
             
             <?php $files = DB::table('files_in_sets')->where_set_id($edit_id)->order_by('order','asc')->get(); ?>

          

             @else
             <p>No sets created.</p>
             @endif
             </div>
            </div>
            <br/>
            @if(isset($files))
             <div class="block">
             <div>
              <h4>Reorder position:</h4>
             <ul class="images_in_set sortable" >
              @foreach($files as $f)

              <?php $image = DB::table('files')->where_id($f->file_id)->first();?>
              <li id="item-{{$f->id}}">
               <i class="icon-resize-vertical"></i>
                 &nbsp;
                <img src="{{url($image->thumb_location)}}" width="75" height="75"/>
                &nbsp;
                image - {{$image->filename}}

              </li>
              @endforeach
             </ul>
           </div>
           @endif
















              <div class="modal hide" id="upload_modal">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>Add New Set:</h3>
                </div>
                <div class="modal-body">
                    {{ Form::open('files/sets', '', array('id'=>'set_from')) }}

                    <label>New Set Name:</label>

                    {{ Form::text('setname') }}

                    

                   
                </div>
                <div class="modal-footer">
                     
                      <a href="#" class="btn" data-dismiss="modal">Cancel</a>
                   
                      {{ Form::submit('Add Set', array('class'=>'btn btn-primary')) }}

                  {{ Form::close() }}     
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

<script language="Javascript">



$(document).ready(function() {
$('#uItem li ').click(function(){
var $this = $(this);

self.opener.setTheVal($this.text());

self.close();


});

});


</script>

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
                     url: "{{url('files/reorder_set')}}",
                     type: 'POST',      
                     data: $(this).sortable("serialize"),
                     success: function (data) {
                     var message = '<div class="alert alert-info"> <button type="button" class="close" data-dismiss="alert">×</button>files Rearranged!</div>';  
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

    
   
</body>
</html>
