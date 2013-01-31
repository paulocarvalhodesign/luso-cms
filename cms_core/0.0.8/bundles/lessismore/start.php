<?php

require 'lessc.inc.php';

$cacheconf = 'less-config';
$newConfig = Config::get('less');
$force_recompile = false;

// get cache if exists, else store config in cache for next time
$config = Cache::remember($cacheconf,$newConfig,60*24);

// see if the config's are different, if they are set recompile to true
if ($config !== $newConfig) {
	// cache this updated cache
	Cache::forever($cacheconf,$newConfig);
	// set the force recompile option to be true for this run
	$force_recompile = true;
	$config = $newConfig;
}

$imports = function($file) use (&$imports)
{
	$paths = array();

	preg_match_all('/@import\s+"(?P<imports>[^";]+)"/ism', File::get($file), $matches);
	foreach ($matches['imports'] as $import)
	{
		$path = dirname($file) . '/' . $import;
		if (File::exists($path) || File::exists($path .= '.less'))
		{
			$paths[] = $path;
			$paths = array_merge($paths, $imports($path));
		}
	}

	return $paths;
};

$compile = function($input_file, $output_file, $force_recompile=false) use ($imports)
{
	try
	{
		$config = Config::get('less');
		// $cacheconf = 'less-config';
		$cachename = 'less-'.md5($output_file);
		$recompile = false;


		if (Cache::has($cachename)) {
			$cache = Cache::get($cachename);
		} else {
			$cache = $input_file;
		}

		$less = new lessc;

		// set the formatter if available
		if (isset($config['formatter'])) {
			$less->setFormatter($config['formatter']);
		}

		// set preserve flag if set
		if (isset($config['preserveComments'])) {
			$less->setPreserveComments($config['preserveComments']);
		}

		// set variables if available
		if (isset($config['variables'])) {
			$less->setVariables($config['variables']);
		}

		// set the recompile flag if available
		if (isset($config['recompile'])) {
			$recompile = $config['recompile'];
		}

		// handle force recompile
		if ($force_recompile) $recompile = true;

		// actually compile the less
		if ($recompile==true) {
			$newCache = $less->cachedCompile($cache,true);
		} else {
			$newCache = $less->cachedCompile($cache);
		}


		// cache output and write file
		if (!is_array($cache) || $newCache["updated"] > $cache["updated"] || !file_exists($output_file) || $recompile) {
			Cache::forever($cachename,$newCache);
			File::put($output_file, $newCache['compiled'] );
		}
	}
	catch (Exception $ex)
	{
		exit('lessc fatal error:<br />' . $ex->getMessage());
	}
};

if (isset($config['directories']))
{
	foreach ($config['directories'] as $less_dir => $css_dir)
	{
		$less_dir = rtrim($less_dir, '/') . '/';
		foreach (glob($less_dir . '*.[Ll][Ee][Ss][Ss]') as $less)
		{
			$css = rtrim($css_dir, '/') . '/' . basename($less, '.less') . '.css';
			$compile($less, $css, $force_recompile);
		}
	}
}

if (isset($config['files']))
{
	foreach ($config['files'] as $less => $css)
	{
		$compile($less, $css, $force_recompile);
	}
}

if (isset($config['snippets']))
{
	$less = new lessc();
	foreach ($config['snippets'] as $snippet => $css)
	{
		File::put($css, $less->parse($snippet));
	}
}
