{{ Area::open_wrapper($area, $handle, $id, $global) }}

<div id="navigation-{{$block->id}}" class="navigation">


{{  $menu  }}

</div>




<div class="mobile_navigation">

	
<form action="#" method="post" enctype="multipart/form-data">

  <select id="goto">
  	@foreach($pages as $page)
  	@if($active == $page->url || $page->parent_id == Config::get('page_id'))
    <option selected="selected" value="{{  url($page->route) }}">{{ $page->title }}</option>
    @elseif($active =='' && $active == 'home')
    <option selected="selected" value="{{  url($page->route) }}">{{ $page->title }}</option>
    @else
     <option value="{{  url($page->route) }}">{{ $page->title }}</option>
    @endif
    @endforeach 
  </select>

</form>

</div>




<script>




	
$(document).ready(function() {

  $(function(){
   var root = location.pathname.substring();
  // var path = location.pathname.substring(1);
   

     $('#navigation-{{$block->id}} a[href$="' + root + '"]').attr('class', 'selected');
  
  
 
 });





  $("#goto").change(function(){
    if ($(this).val()!='') {
      window.location.href=$(this).val();
    }
  });
});

</script>


{{ Area::close_wrapper($handle, $id, $global) }}