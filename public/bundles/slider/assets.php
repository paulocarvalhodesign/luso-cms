<?php 
Asset::container('blocks')->add('slider_css','bundles/slider/css/slider.css');
Asset::container('blocks_js')->add('slider_js','bundles/slider/js/slider.js',null,array('async', 'defer'));