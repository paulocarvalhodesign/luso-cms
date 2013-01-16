<?php

if(CMS_INSTALL){
$theme 	= CMS::set_theme();

return array(
            'directories' => array(
            	 $_SERVER['DOCUMENT_ROOT'] . '/public/themes/'.$theme->name.'/less' => $_SERVER['DOCUMENT_ROOT'] . '/public/themes/'.$theme->name.'/css',
            ),
            
            'files' => array(
               
                //path('public') . 'themes/default/less/theme.less' => path('public') . 'themes/default/css/theme.css',
            ),
            'snippets' => array(
              
            ),
        );
}

else{

return array();	

}