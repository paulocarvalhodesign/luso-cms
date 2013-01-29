<?php
/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @version  0.0.1
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

/*
|----------------------------------------------------------------
| Area class
|----------------------------------------------------------------
*/


class Elements{



 public static function get($section){


 	 include(path('app').'elements/'.$section.'.php');


 }



} 