<?php

require 'lessc.inc.php';

$config = Config::get('less');

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

$compile = function($input_file, $output_file) use ($imports)
{
	try
	{
		$latest = File::modified($input_file);
		foreach ($imports($input_file) as $import)
		{
			$import_modified = File::modified($import);
			$latest = $import_modified > $latest ? $import_modified : $latest;
		}

		if (! File::exists($output_file) || $latest > File::modified($output_file))
		{
			$cache = lessc::cexecute($input_file);
			File::put($output_file, $cache['compiled']);
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
			$compile($less, $css);
		}
	}
}

if (isset($config['files']))
{
	foreach ($config['files'] as $less => $css)
	{
		$compile($less, $css);
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