<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}} :: Extensions Area</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
   
   <link href='http://fonts.googleapis.com/css?family=Quantico:400,700' rel='stylesheet' type='text/css'>

    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
    {{ HTML::style('themes/admin/css/dashboard.css') }}
  
  <!-- Include the Google Charts API -->
  <script type="text/javascript" src="https://www.google.com/jsapi"></script>

    {{ HTML::script('global/js/jquery.js') }} 
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
<h4><i class="icon-th header-icon"></i> Extensions & Blocks:</h4>
</div>
<br/>
<div class="block">
 
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
   
    
</body>
</html>
