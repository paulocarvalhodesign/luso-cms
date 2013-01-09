<?php 
Asset::container('blocks')->add('colorbox_css','bundles/image/css/colorbox-min.css');
Asset::container('blocks_js')->add('colorbox_js','bundles/image/js/jquery.colorbox-min.js',null,array('async', 'defer'));