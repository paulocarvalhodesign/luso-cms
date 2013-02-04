<?php

Autoloader::map(array(
    'Form_Formblock_Controller' => Bundle::path('form').'controllers/formblock.php',
));

Autoloader::namespaces(array(
    'Form\Models' => Bundle::path('form').'models',
));
