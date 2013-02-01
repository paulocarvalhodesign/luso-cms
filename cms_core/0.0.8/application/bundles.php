<?php

/**
 *Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */

 
/*
|--------------------------------------------------------------------------
| Bundle Configuration
|--------------------------------------------------------------------------
|
| Bundles allow you to conveniently extend and organize your application.
| Think of bundles as self-contained applications. They can have routes,
| controllers, models, views, configuration, etc. You can even create
| your own bundles to share with the Laravel community.
|
| This is a list of the bundles installed for your application and tells
| Laravel the location of the bundle's root directory, as well as the
| root URI the bundle responds to.
|
| For example, if you have an "admin" bundle located in "bundles/admin" 
| that you want to handle requests with URIs that begin with "admin",
| simply add it to the array like this:
|
|		'admin' => array(
|			'location' => 'admin',
|			'handles'  => 'admin',
|		),
|
| Note that the "location" is relative to the "bundles" directory.
| Now the bundle will be recognized by Laravel and will be able
| to respond to requests beginning with "admin"!
|
| Have a bundle that lives in the root of the bundle directory
| and doesn't respond to any requests? Just add the bundle
| name to the array and we'll take care of the rest.
|
*/

$array = array(
	'content' 	 => array('auto' => true, 'handles' => 'content'),
	'navigation' => array('auto' => true, 'handles' => 'navigation'),
	'image'      => array('auto' => true, 'handles' => 'image'),
	'form'       => array('auto' => true, 'handles' => 'form'),
	'pagelist'   => array('auto' => true, 'handles' => 'pagelist'),
	'slider' 	 => array('auto' => true, 'handles' => 'slider'),
	'search'     => array('auto' => true, 'handles' => 'search'),
	'composer'   => array('auto' => true ),
	'resizer'    => array('auto' => true ),
	'messages'   => array('auto' => true ),
	'breadcrumb' => array('auto' => true ),
	'useragent'  => array('auto' => true ),
	'flatten'    => array('auto' => true ),
	'sitemap'    => array('auto' => true ),
	'lessismore' => array('auto' => true ),
	'gallery' 	 => array('auto' => true, 'handles' => 'gallery', 'location' => '../../../cms_user/bundles/gallery'),
);

return $array;


