<?php
Asset::container('core_css')->add('bootstrap','global/bootstrap/css/bootstrap.css');
Asset::container('core_css')->add('bootstrap-responsive','global/bootstrap/css/bootstrap-responsive.css');
Asset::container('theme')->add('theme','themes/default/css/theme.css');
Asset::container('theme')->add('theme_js','themes/default/js/theme.js', '',array('async', 'defer'));