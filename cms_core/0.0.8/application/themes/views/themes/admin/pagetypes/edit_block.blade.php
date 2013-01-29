
<?php 



if($core == 'true'){

   include(path('app').'../bundles/'.$block_name.'/views/edit.blade.php');

}elseif($core == 'false'){

   include(path('root').'/cms_user/bundles/'.$block_name.'/views/edit.blade.php');

}


?>

