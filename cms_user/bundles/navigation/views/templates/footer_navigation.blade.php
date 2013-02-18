{{ Area::open_wrapper($area, $handle, $id, $global) }}

<div id="navigation-{{$block->id}}" class="footer_navigation">


{{  $menu  }}

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

  $("ul").each(
  function() {
    var elem = $(this);
    if (elem.children().length == 0) {
      elem.remove();
    }
  }
);



  
});

</script>


{{ Area::close_wrapper($handle, $id, $global) }}