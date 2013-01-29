# [laravel-sitemap](http://roumen.me/projects/laravel-sitemap) bundle

A simple sitemap generator for Laravel.


## Installation

Install using the Artian CLI:

	php artisan bundle:install sitemap

then edit ``application/bundles.php`` to autoload sitemap:

```php
'sitemap' => array('auto' => true)
```

## Example (xml)

```php
Route::get('sitemap', function(){

    $sitemap = new Sitemap();

    // set item's url, date, priority, freq
    $sitemap->add(URL::to(), '2012-08-25T20:10:00+02:00', '1.0', 'daily');
    $sitemap->add(URL::to('page'), '2012-08-26T12:30:00+02:00', '0.9', 'monthly');

    $posts = DB::table('posts')->order_by('created', 'desc')->get();
    foreach ($posts as $post)
    {
        $sitemap->add($post->slug, $post->modified, $post->priority, $post->freq);
    }

    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
    return $sitemap->render('xml');

});
```

## Example (ror-rdf)

```php
Route::get('ror-sitemap', function(){

    $sitemap = new Sitemap();

    // set sitemap's title and url (only for html, ror-rss and ror-rdf)
    $sitemap->title = 'ROR sitemap';
    $sitemap->link = 'http://domain.tld';

    // set item's url, date, sortOrder, updatePeriod, title (optional)
    $sitemap->add(URL::to(), '2012-09-10T20:10:00+02:00', '0', 'daily', 'My page title');
    $sitemap->add(URL::to('page'), '2012-09-09T12:30:00+02:00', '1', 'monthly', 'Other page title');

    $posts = DB::table('posts')->order_by('created', 'desc')->get();
    foreach ($posts as $post)
    {
        $sitemap->add(URL::to('post/'.$post->slug), $post->modified, '2', 'weekly', $post->title);
    }

    // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
    return $sitemap->render('ror-rdf');

});
```