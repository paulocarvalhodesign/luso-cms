# laraveless - Automated LESS compilation for Laravel

Thanks to [leafo](https://github.com/leafo) for [lessphp](https://github.com/leafo/lessphp).

### Quick Start

1. Install the bundle

        php artisan bundle:install laraveless

1. Add it to your application's `bundles.php`

        return array(
            'laraveless' => array(
            	'auto' => true,
            ),
        );

1. Create `application/config/less.php`

        return array(
            'directories' => array(
                ...
            ),
            'files' => array(
                ...
            ),
            'snippets' => array(
                ...
            ),
        );

1. That's it, really.

### More about `directories`, `files`, and `snippets`

`laraveless` uses the `directories`, `files`, and `snippets` arrays to create CSS from your LESS. Here's how.

#### Directories

The `directories` array is optional. If you don't have any directories that you want compiled to LESS, you can leave it out; otherwise, you want to specify your directories in `application/config/less.php` as so:

    return array(
    	'directories' => array(
    		path('app') . 'less' => path('public') . 'css',
    	),
    );

That will get all files matching `application/less/*.less` (case-insensitive, non-recursive) and compile them to CSS in the `public/css` directory. For example, the file `application/less/test.less` becomes `public/css/test.css`.

If you want to specify single LESS files or want to specify the output filename, use `files`.

#### Files

The `files` array is nearly identical to the `directories` array. In `application/config/less.php`:

    return array(
    	'files' => array(
    		path('app') . 'less/source.less' => path('public') . 'css/destination.css',
    	),
    );

That will... you get it, right?... compile `application/less/source.less` to `public/css/destination.css`.

#### Snippets

I added snippets just because. They're probably not great practice, but maybe you'll find a use for them. Once again, in `application/config/less.php`:

    return array(
    	'snippets' => array(
    		'#content { background: #f00; h1 { color: #0f0; } }' => path('public') . 'css/file.css',
    	),
    );

That should be pretty self-explanatory.

### One final note

`laraveless` uses `lessphp`'s `ccompile` method, which means that only source less files modified more recently than the destination css file are compiled, so you shouldn't take a performance hit.

... except for on snippets, which are compiled and written to disk every time the bundle is started.