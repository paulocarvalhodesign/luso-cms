<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{Config::get('site_name')}} :: Admin Area</title>
   <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
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
<h4><i class="icon-signal header-icon"></i> Analytics:</h4>
</div>
<br/>
<div class="block">
 @if(!empty($results))


<!-- Create an empty div that will be filled using the Google Charts API and the data pulled from Google -->
<div id="chart"></div>

<!-- Include the Google Charts API -->
<script type="text/javascript" src="https://www.google.com/jsapi"></script>


<!-- Create a new chart and plot the pageviews for each day -->
<script type="text/javascript">
  
 

  google.load("visualization", "1", {packages:["corechart"]});
  google.setOnLoadCallback(drawChart);
  function drawChart() {
    var data = new google.visualization.DataTable();

       
    data.addColumn('string', 'Day');
    data.addColumn('number', 'Pageviews');
    
   
    

    data.addRows([
      <?php
      foreach($results as $result) {
          echo '["'.date('M j',strtotime($result->getDate())).'", '.$result->getPageviews().'],';
      }
      ?>
    ]);

    var chart = new google.visualization.AreaChart(document.getElementById('chart'));
    chart.draw(
    data, {
    titleTextStyle: {
    color: '#333',
    // fontName: 'Tahoma',
    fontSize: 16,}, 
    width:"100%", 
    height:"750%", 
    title: 'Data for the period : <?php echo date('M j, Y',strtotime('-30 day')).' - '.date('M j, Y'); ?>',
    colors:['#8CC63F','#e6f4fa'],
    areaOpacity: 0.2,
     lineWidth:'1',
     vAxis: {title: "Views", textPosition: 'in',textStyle: { color: '#8CC63F', fontSize: 10 }},                 
     hAxis: { textPosition: 'in', showTextEvery: 2, slantedText: false, textStyle: { color: '#333', fontSize: 12 } },
     pointSize: 10,
     chartArea:{left:20,top:30,width:"85%",height:"100%"},
     "backgroundColor": { fill: "none" }, 
     animation:{duration:'800',easing:'in'},
     legendTextStyle: {color: '#333',  fontSize: 14},
     tooltipTextStyle: {color: '#111',  fontSize: 10}
                      
                     
    });
  }

</script>

@else



<h4>{{Lang::line('dashboard.analytics_inactive')->get()}}</h4>


@endif
</div>

<br/>

<br/>

<div class="row-fluid">
<div class="span12">
<div class="span6">
  <div class="block header_block">
<h4><i class="icon-signal header-icon"></i> Updates:</h4>
</div>
<br/>
 <div class="block">
<?php
$version = 'http://lusocms.org/version.xml';
$xml=simplexml_load_file($version);
$version =$xml->value;
$notes =$xml->notes;
$upgradable = $xml->upgradable;
?>


@if(CMS_VERSION < $version)

  <h4>Cms upgrade available, version: {{$version}}</h4>
  @if($upgradable == 'true')

  <p>Click to upgrade <a class="btn btn-info" href="{{url('admin/cms_upgrade_download')}}">here</a></p>
  @else
  <p>You can't upgrade from the dashboard, visit <a href="http://lusocms.org">Release notes</a>.</p>
  @endif
@else

<?php include(path('app').'config/cms_upgrade.php');?>
  
@if($include_script)
 <p>Your upgrade needs to run a final step.</p>
  <p>Click to finalize <a class="btn btn-info" href="{{url('admin/finish_upgrade')}}">here</a></p>
@else
  <p>You have currently installed version : {{CMS_VERSION}} </p>
  <p>Your system is updated.</p>
@endif


@endif

</div>
</div>
<!-- <div class="span6">
<div class="block header_block">
<h4><i class="icon-signal header-icon"></i> Next version approved changes:</h4>
</div>
<br/>
 <div class="block">


<?php //include('../temp/list_of_changes.txt');?>

</div> -->
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
    {{ HTML::script('themes/admin/js/app.js') }} 
    
<script>

</script>


</body>
</html>
