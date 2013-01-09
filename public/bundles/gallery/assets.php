<?php 
Asset::container('blocks')->add('colorbox_css','bundles/gallery/css/colorbox-min.css');
Asset::container('blocks')->add('gallery_css','bundles/gallery/css/styles.css');
Asset::container('blocks_js')->add('colorbox_js','bundles/gallery/js/jquery.colorbox-min.js',null,array('async', 'defer'));