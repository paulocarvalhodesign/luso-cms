{{ Area::open_wrapper($area, $handle, $id, $global) }}

<?php $test = array('1','2','3');?>

@foreach($test as $t)


<!-- {{ Area::render('tab-'.$t, Config::get('page_id')) }}   -->




@endforeach


{{ Area::close_wrapper($handle, $id, $global) }}