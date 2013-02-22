#[Luso CMS](http://lusocms.org) 


##Features Overview

- Created with Laravel 3
- Composer
- Themes
- Caching system
- One folder wrapping upgradable core
- Multi location for bundles
- Core and user bundles
- View overriding for bundles
- More to come...

##Quick Install

-Get Composer.

-To actually get Composer, we need to do two things. The first one is installing Composer (again, this means downloading it into your project):

$ curl -s https://getcomposer.org/installer | php

This will just check a few PHP settings and then download composer.phar to your working directory. This file is the Composer binary. It is a PHAR (PHP archive), which is an archive format for PHP which can be run on the command line, amongst other things.

You can install Composer to a specific directory by using the --install-dir option and providing a target directory (it can be an absolute or relative path):

$ curl -s https://getcomposer.org/installer | php -- --install-dir=bin

Globally#

You can place this file anywhere you wish. If you put it in your PATH, you can access it globally. On unixy systems you can even make it executable and invoke it without php.

You can run these commands to easily access composer from anywhere on your system:

$ curl -s https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer

Then, just run composer in order to run Composer instead of php composer.phar.

- Run composer update.
- Got to your url(example.com).
- Follow the setup.
- Enjoy.
