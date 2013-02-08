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

    var url = window.location.pathname, 
        urlRegExp = new RegExp(url.replace(/\/$/,'') + "$"); // create regexp to match current url pathname and remove trailing slash if present as it could collide with the link in navigation in case trailing slash wasn't present there
        // now grab every link from the navigation
        if(window.location == '{{URL::base()}}')
        {
        $('#navigation-{{$block->id}} li a')
            .first().addClass('selected'); 
        $('#navigation-{{$block->id}} li a')
        .first().parent().attr('class', 'selected-path');  
        }
       else{
        $('#navigation-{{$block->id}} a').each(function(){
            // and test its normalized href against the url pathname regexp
            if(urlRegExp.test(this.href)){
                $(this).addClass('selected');
                $(this).parent().attr('class', 'selected-path');
            }
        });
      }

});




  $("#goto").change(function(){
    if ($(this).val()!='') {
      window.location.href=$(this).val();
    }
  });
});

</script>


{{ Area::close_wrapper($handle, $id, $global) }}