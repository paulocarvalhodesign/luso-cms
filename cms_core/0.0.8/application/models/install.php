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
| Area class
|----------------------------------------------------------------
*/




class Install{






static function Insert_db(){

	  Schema::table(Config::get('session.table'), function($table)
    {
      $table->create();

      
      $table->string('id')->length(40)->primary('session_primary');

      $table->integer('last_activity');

      $table->text('data');
    });

    Schema::create('pages', function($table) {
      $table->increments('id');
      $table->integer('parent_id');
      $table->string('name', 255);
      $table->string('title', 255);
      $table->string('url', 255);
      $table->string('route', 255);
      $table->string('edit_mode', 128);
      $table->string('pagetype', 255);
      $table->string('description', 255);
      $table->string('keywords', 500);
      $table->string('tags', 500);
      $table->integer('exclude_from_sitemap');
      $table->integer('exclude_from_navigation');
      $table->integer('exclude_from_pagelist');
      $table->integer('order');
      $table->integer('owner');
      $table->timestamps();
    });

    DB::table('pages')->insert(array(
      'parent_id' => '0',
      'name' 	  => 'home',
      'title' 	  => 'home',
      'url' 	  => 'home',
      'route' 	  => '',
      'edit_mode' => 'false',
      'pagetype'  => 'default',
      'description' 	  		  => '',
      'exclude_from_sitemap' 	  => '0',
      'exclude_from_navigation'   => '0',
      'exclude_from_pagelist' 	  => '0',
      'order' 	  => '0',
      'owner' 	  => '1'
    )); 
    DB::table('pages')->insert(array(
      'parent_id' => '0',
      'name' 	  => '404',
      'title' 	  => '404',
      'url' 	  => '404',
      'route' 	  => '404',
      'edit_mode' => 'false',
      'pagetype'  => 'default',
      'description' 	  		  => '',
      'exclude_from_sitemap' 	  => '1',
      'exclude_from_navigation'   => '1',
      'exclude_from_pagelist' 	  => '1',
      'order' 	  => '1',
      'owner' 	  => '1'
    )); 
    DB::table('pages')->insert(array(
      'parent_id' => '0',
      'name' 	  => '500',
      'title' 	  => '500',
      'url' 	  => '500',
      'route' 	  => '500',
      'edit_mode' => 'false',
      'pagetype'  => 'default',
      'description' 	  		  => '',
      'exclude_from_sitemap' 	  => '1',
      'exclude_from_navigation'   => '1',
      'exclude_from_pagelist' 	  => '1',
      'order' 	  => '2',
      'owner' 	  => '1'
    )); 
    DB::table('pages')->insert(array(
      'parent_id' => '0',
      'name'    => 'maintenance-mode',
      'title'     => 'Maintenance Mode',
      'url'     => 'maintenance-mode',
      'route'     => 'maintenance-mode',
      'edit_mode' => 'false',
      'pagetype'  => 'default',
      'description'           => '',
      'exclude_from_sitemap'    => '1',
      'exclude_from_navigation'   => '1',
      'exclude_from_pagelist'     => '1',
      'order'     => '3',
      'owner'     => '1'
    )); 
    Schema::create('file_atributes', function($table) {
      $table->increments('id');
      $table->integer('page_id');
      $table->string('name', 128);
      $table->string('type', 128);   
    });
    Schema::create('page_atributes', function($table) {
      $table->increments('id');
      $table->integer('page_id');
      $table->string('name', 128);
      $table->string('type', 128); 
    });
     Schema::create('text_attribute', function($table) {
      $table->increments('id');
      $table->integer('page_id');
      $table->string('name', 128);
      $table->text('content');
      $table->string('type', 128); 
    });
     Schema::create('image_attribute', function($table) {
      $table->increments('id');
      $table->integer('page_id');
      $table->string('name', 128);
      $table->integer('file_id');
      $table->string('type', 128); 
    });
    Schema::create('settings', function($table) {
      $table->increments('id');
      $table->string('name', 128);
      $table->string('value', 128); 
      
      });
    
    DB::table('settings')->insert(array( 
      'name'    => 'maintenance-mode',
      'value'     => 'false'
    )); 
    DB::table('settings')->insert(array( 
      'name'    => 'site_name',
      'value'     => 'Luso CMS'
    )); 
    DB::table('settings')->insert(array( 
      'name'    => 'error_level',
      'value'     => 'true'
    )); 
    DB::table('settings')->insert(array( 
      'name'    => 'verify',
      'value'     => 'true'
    )); 
    Schema::create('analytics', function($table) {
      $table->increments('id');
      $table->string('username', 128);
      $table->string('password', 128);
      $table->string('profile', 128);
     
      
    });
    Schema::create('attribute_type', function($table) {
      $table->increments('id');
      $table->string('name', 128);
      $table->string('type', 128);
      
      
    });   
    
    Schema::create('blocks', function($table) {
      $table->increments('id');
      $table->string('icon', 128);
      $table->string('block_name', 128);
      $table->string('block_slug', 128);
      $table->string('block_version', 128);
      $table->boolean('block_active', 1);
      $table->string('block_table', 128);
      $table->string('core', 128);
    });
    DB::table('blocks')->insert(array(
      'icon' => 'icon-pencil',
      'block_name'=>'content',
      'block_slug'=>'content',
      'block_version'=>'1.0',
      'block_active'=>'1',
      'block_table'=>'contentblock',
      'core'=>'true'
      
    ));
    DB::table('blocks')->insert(array(
      'icon' => 'icon-th-large',
      'block_name'=>'navigation',
      'block_slug'=>'navigation',
      'block_version'=>'1.0',
      'block_active'=>'1',
      'block_table'=>'navigationblock',
      'core'=>'true'
      
    ));
    DB::table('blocks')->insert(array(
      'icon' => 'icon-picture',
      'block_name'=>'image',
      'block_slug'=>'image',
      'block_version'=>'1.0',
      'block_active'=>'1',
      'block_table'=>'imageblock',
      'core'=>'true'
      
    ));
    DB::table('blocks')->insert(array(
      'icon' => 'icon-list',
      'block_name'=>'pagelist',
      'block_slug'=>'pagelist',
      'block_version'=>'1.0',
      'block_active'=>'1',
      'block_table'=>'pagelistblock',
      'core'=>'true'
      
    ));
    DB::table('blocks')->insert(array(
      'icon' => 'icon-step-forward',
      'block_name'=>'slider',
      'block_slug'=>'slider',
      'block_version'=>'1.0',
      'block_active'=>'1',
      'block_table'=>'sliderblock',
      'core'=>'true'
      
    ));
    DB::table('blocks')->insert(array(
      'icon' => 'icon-list',
      'block_name'=>'gallery',
      'block_slug'=>'gallery',
      'block_version'=>'1.0',
      'block_active'=>'1',
      'block_table'=>'galleryblock',
      'core'=>'false'
      
    ));
    DB::table('blocks')->insert(array(
      'icon' => 'icon-picture',
      'block_name'=>'galleria',
      'block_slug'=>'galleria',
      'block_version'=>'1.0',
      'block_active'=>'1',
      'block_table'=>'galleriablock',
      'core'=>'false'
      
    ));
    DB::table('blocks')->insert(array(
      'icon' => 'icon-envelope',
      'block_name'=>'form',
      'block_slug'=>'form',
      'block_version'=>'1.0',
      'block_active'=>'1',
      'block_table'=>'formblock',
      'core'=>'true'
      
    ));
    DB::table('blocks')->insert(array(
      'icon' => 'icon-search',
      'block_name'=>'search',
      'block_slug'=>'search',
      'block_version'=>'1.0',
      'block_active'=>'1',
      'block_table'=>'searchblock',
      'core'=>'true'
      
    ));

    Schema::create('users', function($table) {
      $table->increments('id');
      $table->string('avatar', 128);
      $table->string('username', 128)->unique();
      $table->string('nickname', 128);
      $table->string('firstname', 128);
      $table->string('lastname', 128);
      $table->string('password', 64);
      $table->timestamps();
    });
    
    Schema::create('roles', function($table) {
      $table->increments('id');
      $table->string('name', 128);
      $table->string('can_create', 128);
      $table->string('can_write', 128);
      $table->string('can_delete', 128);
      $table->timestamps();
    });

    Schema::create('role_user', function($table) {
      $table->increments('id');
      $table->integer('user_id');
      $table->integer('role_id');
      $table->timestamps();
    });

    DB::table('roles')->insert(array( 
      'name'    => 'administrator',
      'can_create'     => 'true',
      'can_write'     => 'true',
      'can_delete'     => 'true'
    )); 
    DB::table('role_user')->insert(array( 
     
      'user_id'     => '1',
      'role_id'     => '1'
    
    )); 
   
    Schema::create('areas', function($table) {
      $table->increments('id');
      $table->integer('page_id');
      $table->string('area_name', 128);
      
    });

    Schema::create('page_blocks', function($table) {
      $table->increments('id');
      $table->integer('page_id');
      $table->string('area_id', 128);
      $table->string('block_slug', 128);
      $table->string('block_handle', 128);
      $table->integer('block_id');
      $table->integer('order');
      
    });

    Schema::create('files', function($table) {
      $table->increments('id');
      $table->string('title', 128);
      $table->string('filename', 128);
      $table->string('description', 128);
      $table->string('location', 400);
      $table->string('thumb_location', 400);
      $table->string('width', 64);
      $table->string('height', 64);
      $table->string('mime', 64);
      $table->timestamps();
    });

    Schema::create('themes', function($table) {
      $table->increments('id');
      $table->string('name', 128);
      $table->string('description', 128);
      $table->integer('active');
      $table->timestamps();
    });

    Schema::create('global_areas', function($table) {
      $table->increments('id');
      $table->integer('page_id');
      $table->string('area_name', 128);
      
    });

    Schema::create('sets', function($table) {
          $table->increments('id');
          $table->string('name', 128);
          $table->timestamps();
        });

    Schema::create('files_in_sets', function($table) {
          $table->increments('id');
          $table->integer('set_id');
          $table->integer('file_id');
          $table->integer('order');
          $table->timestamps();
        });

    Schema::create('forms', function($table) {
          $table->increments('id');
          $table->string('name', 128);
          $table->string('title', 128);
          $table->string('message', 128);
          $table->timestamps();
        });
    Schema::create('form_fields', function($table) {
          $table->increments('id');
          $table->integer('form_id');
          $table->string('name', 128);
          $table->string('label', 128);
          $table->string('type', 128);
          $table->string('rules', 128);
          $table->string('options', 500);
          $table->integer('order');
          $table->timestamps();
        });
    Schema::create('blocks_assets', function($table) {
          $table->increments('id');
          $table->integer('page_id');
          $table->integer('block_handle');
          $table->timestamps();
        }); 
    Schema::create('navigationblocks', function($table) {
          $table->increments('id');
          $table->integer('page_id');
          $table->string('area_id', 128);
          $table->string('block_handle', 128);
          $table->string('block_name', 128);
          $table->string('template', 128);
          $table->timestamps();
        });
    Schema::create('contentblocks', function($table) {
          $table->increments('id');
          $table->integer('page_id');
          $table->string('area_id', 128);
          $table->text('content');
          $table->string('block_handle', 128);
          $table->string('block_name', 128);
          $table->string('template', 128);
          $table->timestamps();
        });
    Schema::create('searchblocks', function($table) {
          $table->increments('id');
          $table->integer('page_id');
          $table->string('area_id', 128);
          $table->string('target',128);
          $table->string('block_handle', 128);
          $table->string('block_name', 128);
          $table->string('results', 128);
          $table->string('template', 128);
          $table->timestamps();
        });
    Schema::create('pagelistblocks', function($table) {
          $table->increments('id');
          $table->integer('page_id');
          $table->string('area_id', 128);
          $table->string('block_handle', 128);
          $table->string('block_name', 128);
          $table->string('pagetype', 128);
          $table->string('ammount', 128);
          $table->string('location', 128);
          $table->integer('pagination');
          $table->string('order_by', 128);
          $table->string('position', 128);
          $table->string('template', 128);
          $table->timestamps();
        });
    Schema::create('imageblocks', function($table) {
          $table->increments('id');
          $table->integer('page_id');
          $table->string('area_id', 128);
          $table->string('block_handle', 128);
          $table->string('block_name', 128);
          $table->string('title', 128);
          $table->string('width', 128);
          $table->string('height', 128);
          $table->string('description', 400);
          $table->string('lightbox', 128);
          $table->string('url', 400);
          $table->string('template', 128);
          $table->timestamps();
        });
    Schema::create('sliderblocks', function($table) {
          $table->increments('id');
          $table->integer('page_id');
          $table->string('area_id', 128);
          $table->string('block_handle', 128);
          $table->string('block_name', 128);
          $table->string('slider_id', 128);
          $table->string('template', 128);
          $table->timestamps();
        });
    Schema::create('galleryblocks', function($table) {
          $table->increments('id');
          $table->integer('page_id');
          $table->string('area_id', 128);
          $table->string('block_handle', 128);
          $table->string('block_name', 128);
          $table->string('gallery_id', 128);
          $table->string('template', 128);
          $table->timestamps();
        });
    Schema::create('formblocks', function($table) {
          $table->increments('id');
          $table->integer('page_id');
          $table->string('area_id', 128);
          $table->string('block_handle', 128);
          $table->string('block_name', 128);
          $table->string('form_id', 128);
          $table->string('send_to', 250);
          $table->string('template', 128);
          $table->timestamps();
        });
      
}


}