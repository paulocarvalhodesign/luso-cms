<?php

/**
 * Luso CMS - Next generation CMS
 *
 * @package  Luso CMS
 * @author   Paulo Carvalho <pauloworkmail@gmail.com>
 * @link     http://paulocarvalhodesign.com
 * 
 */




require 'cms_config/version.php';
require 'cms_config/verify.php';


define('CMS_VERSION', $version);
define('CMS_INSTALL', $install);



// --------------------------------------------------------------
// Tick... Tock... Tick... Tock...
// --------------------------------------------------------------
define('LARAVEL_START', microtime(true));

// --------------------------------------------------------------
// Indicate that the request is from the web.
// --------------------------------------------------------------
//
// --------------------------------------------------------------
// Set the core Laravel path constants.
// --------------------------------------------------------------
require 'cms_core/lusocms/paths.php';

// --------------------------------------------------------------
// Unset the temporary web variable.
// --------------------------------------------------------------
unset($web);

// --------------------------------------------------------------
// Launch Luso CMS.
// --------------------------------------------------------------
require path('sys').'laravel.php';
