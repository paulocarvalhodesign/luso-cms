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
|----------------------------------------------------------------
| Application Environments
|----------------------------------------------------------------
|
| Laravel takes a dead simple approach to environments, and we
| think you'll love it. Just specify which URLs belong to a
| given environment, and when you access your application
| from a URL matching that pattern, we'll be sure to
| merge in that environment's configuration files.
|
*/

$environments = array(

	'local' => array('http://192.168.56.2/', 'local'),
	'production' => array('http://lusocms.org/', 'production'),
	

);

// --------------------------------------------------------------
// The path to the application directory.
// --------------------------------------------------------------
$paths['app'] = 'application';

$paths['root'] = $_SERVER['DOCUMENT_ROOT'];

// --------------------------------------------------------------
// The path to the Laravel directory.
// --------------------------------------------------------------
$paths['sys'] = 'laravel';

// --------------------------------------------------------------
// The path to the bundles directory.
// --------------------------------------------------------------
$paths['bundle'] = 'bundles';

// --------------------------------------------------------------
// The path to the storage directory.
// --------------------------------------------------------------
$paths['storage'] = 'storage';

// --------------------------------------------------------------
// The path to the public directory.
// --------------------------------------------------------------
$paths['public'] = 'public';

// --------------------------------------------------------------
// The path to the views directory.
// --------------------------------------------------------------
$paths['views'] = $_SERVER['DOCUMENT_ROOT'].'/cms_user/themes/views'; 
// --------------------------------------------------------------
// The path to the user bundles.
// --------------------------------------------------------------
$paths['user_bundles'] = $_SERVER['DOCUMENT_ROOT'].'/user/bundles/'; 
// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-
// END OF USER CONFIGURATION. HERE BE DRAGONS!
// *-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-*-

// --------------------------------------------------------------
// Change to the current working directory.
// --------------------------------------------------------------
chdir(__DIR__);

// --------------------------------------------------------------
// Define the directory separator for the environment.
// --------------------------------------------------------------
if ( ! defined('DS'))
{
	define('DS', DIRECTORY_SEPARATOR);
}

// --------------------------------------------------------------
// Define the path to the base directory.
// --------------------------------------------------------------
$GLOBALS['laravel_paths']['base'] = __DIR__.DS;

// --------------------------------------------------------------
// Define each constant if it hasn't been defined.
// --------------------------------------------------------------
foreach ($paths as $name => $path)
{
	if ( ! isset($GLOBALS['laravel_paths'][$name]))
	{
		$GLOBALS['laravel_paths'][$name] = realpath($path).DS;
	}
}

/**
 * A global path helper function.
 * 
 * <code>
 *     $storage = path('storage');
 * </code>
 * 
 * @param  string  $path
 * @return string
 */
function path($path)
{
	return $GLOBALS['laravel_paths'][$path];
}

/**
 * A global path setter function.
 * 
 * @param  string  $path
 * @param  string  $value
 * @return void
 */
function set_path($path, $value)
{
	$GLOBALS['laravel_paths'][$path] = $value;
}