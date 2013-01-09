<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('cms.site_name')}} :: Admin Area</title>
    <meta name="viewport" content="width=device-width">
    {{ HTML::script('global/js/jquery.js') }} 
    {{ HTML::style('jquery-ui/css/lusocms-theme/jquery-ui-1.9.0.custom.min.css') }} 
    {{ HTML::script('jquery-ui/js/jquery-ui-1.9.0.custom.min.js') }} 
    {{ HTML::style('global/bootstrap/css/bootstrap.css') }}
    {{ HTML::style('global/bootstrap/css/bootstrap-responsive.css') }}
    {{ HTML::style('themes/admin/css/dashboard.css') }}
    {{ HTML::style('global/css/cms.css') }}
</head>

<h4>Layout tools</h4>


<label>How many Areas?</label>


<?php
	$areas = array(
		'2' =>'2',
		'3' =>'3',
		'4' =>'4',
		'6' =>'6',
		'12' =>'12'


	);
 ?>
  <?php echo Form::select('areas', $areas); ?>























{{ HTML::script('global/bootstrap/js/bootstrap.min.js') }} 



 
</body>
</html>