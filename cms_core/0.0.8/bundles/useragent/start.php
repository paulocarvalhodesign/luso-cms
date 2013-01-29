<?php

/**
 * --------------------------------------------------------------------------
 * User Agent
 * --------------------------------------------------------------------------
 * 
 * A user agent library based on the user agent library from CodeIgniter for use with
 * the Laravel Framework.
 *
 * @package  useragent
 * @version  1.0
 * @author   Patrick Foh <patrickfoh@gmail.com>
 * @link     https://github.com/mrfoh/laravel-useragent
 */


/*
 * --------------------------------------------------------------------------
 * Register the class.
 * --------------------------------------------------------------------------
 */
Autoloader::namespaces(array(
    'UserAgent' => __DIR__ . DS
));


/*
 * --------------------------------------------------------------------------
 * Set the global alias.
 * --------------------------------------------------------------------------
 */
Autoloader::alias('UserAgent\\Agent', 'Agent');


/*
 * --------------------------------------------------------------------------
 * Initialize the library
 * --------------------------------------------------------------------------
 */
Agent::init();