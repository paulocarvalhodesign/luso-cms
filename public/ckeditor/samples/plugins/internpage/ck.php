<?php
$base =  ((isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == "on") ?  "https" : "http");
$base .=  "://".$_SERVER['HTTP_HOST'];
$base .=  str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

$url = str_replace('public/ckeditor/plugins/internpage/','',$base);


define("base_url", $url);