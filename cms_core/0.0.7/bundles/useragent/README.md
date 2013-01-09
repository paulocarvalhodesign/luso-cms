laravel-useragent
=================
### Version 1.0

A port of the user agent library from Codeigniter to Laravel

Installation
============

Install via artisan

``` php artisan bundle:install laravel-useragent```

Or clone the project into **bundles/useragent**

Then update your **bundles.php** to auto-start the bundle
``` 
    return array(
          'useragent'=>array('auto'=>true)
    );
 ```

Usage
============
This example attempts to determine whether the user agent browsing your site is a web browser, a mobile device, or a robot. It will also gather the platform information if it is available.
```
if (Agent::is_browser())
{
    $agent = Agent::browser().' '.Agent::version();
}
elseif (Agent::is_robot())
{
    $agent = Agent::robot();
}
elseif (Agent::is_mobile())
{
    $agent = Agent::mobile();
}
else
{
    $agent = 'Unidentified User Agent';
}

echo $agent;

echo Agent::platform(); // Platform info (Windows, Linux, Mac, etc.)
```
#Method Refrence
All methods in the Agent class are the same as the methods in the Codeigniter user agent library.
You can read the documentation <http://codeigniter.com/user_guide>

Note all method calls are static
Eg
``` 
Agent::is_browser(); 
```



