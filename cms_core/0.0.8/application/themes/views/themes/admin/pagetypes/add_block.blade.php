<div>
    <ul class="nav nav-tabs" id="myTab">
    
      @foreach($blocks as $block)
        <li>
            <a data-toggle="tab" href="#cms_{{ $block->block_name }}">
              <i class="{{ $block->icon }}"></i> {{ $block->block_name }}
            </a>
        </li>
      @endforeach       
    </ul>
    <div class="tab-content">

   
    @foreach($blocks as $block)

        <div id="cms_{{ $block->block_name }}" class="tab-pane">


<?php

if($block->core == 'true'){

   include(path('app').'../bundles/'.$block->block_name.'/views/add.blade.php');

}elseif($block->core == 'false'){

    include(path('root').'/cms_user/bundles/'.$block->block_name.'/views/add.blade.php');

}





?>
                

    </div>

    @endforeach     

    </div>
    </div>


<script>
$(function () {
$('#myTab a:first').tab('show');
$('.tt').tooltip();
})
</script>
 












