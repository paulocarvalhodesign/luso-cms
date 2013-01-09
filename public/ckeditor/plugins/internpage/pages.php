<?php 

header('Content-type: application/javascript');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Cache-Control: post-check=0, pre-check=0, false');
header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
header('Pragma: no-cache');





include('ck.php');
include('routes.php');

$directory = base_url;



echo "var InternPagesSelectBox = new Array( new Array( '', '' )";

foreach ($route as $key => $value) {
	
       echo ", new Array( '".$key."', '".$directory.$value."' )";
    
       } 

echo " );\n";



?>
