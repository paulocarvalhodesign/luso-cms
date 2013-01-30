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


/* url() v1.7.2 - http://github.com/websanova/js-url */window.url=(function(){function b(c){return !isNaN(parseFloat(c))&&isFinite(c)}return function a(p,d){var c=d||window.location.toString();if(c.substring(0,2)==="//"){c="http:"+c}else{if(c.split("://").length===1){c="http://"+c}}d=c.split("/");var g={auth:""},o=d[2].split("@");if(o.length===1){o=o[0].split(":")}else{g.auth=o[0];o=o[1].split(":")}g.protocol=d[0],g.hostname=o[0],g.port=(o[1]||"80"),g.pathname="/"+d.slice(3,d.length).join("/").split("?")[0].split("#")[0];var e=g.pathname;if(e.split(".").length===1&&e[e.length-1]!=="/"){e+="/"}var k=g.hostname,l=k.split("."),m=e.split("/");if(!p){return c}else{if(p==="hostname"){return k}else{if(p==="domain"){return l.slice(-2).join(".")}else{if(p==="tld"){return l.slice(-1).join(".")}else{if(p==="sub"){return l.slice(0,l.length-2).join(".")}else{if(p==="port"){return g.port||"80"}else{if(p==="protocol"){return g.protocol.split(":")[0]}else{if(p==="auth"){return g.auth}else{if(p==="user"){return g.auth.split(":")[0]}else{if(p==="pass"){return g.auth.split(":")[1]||""}else{if(p==="path"){return e}else{if(p[0]==="."){p=p.substring(1);if(b(p)){p=parseInt(p);return l[p<0?l.length+p:p-1]||""}}else{if(b(p)){p=parseInt(p);return m[p<0?m.length-1+p:p]||""}else{if(p==="file"){return m.slice(-1)[0]}else{if(p==="filename"){return m.slice(-1)[0].split(".")[0]}else{if(p==="fileext"){return m.slice(-1)[0].split(".")[1]||""}else{if(p[0]==="?"||p[0]==="#"){var h=c,f=null;if(p[0]==="?"){h=(h.split("?")[1]||"").split("#")[0]}else{if(p[0]==="#"){h=(h.split("#")[1]||"")}}if(!p[1]){return h}p=p.substring(1);h=h.split("&");for(var j=0,n=h.length;j<n;j++){f=h[j].split("=");if(f[0]===p){return f[1]}}}}}}}}}}}}}}}}}}}return""}})();




	
$(document).ready(function() {

  $(function(){
   
   var segment = url('1');
   var dash = '/';
   
   if(segment == '')  
    var root = segment+dash;
   else
    var root = segment;
   
   
     
     $('#navigation-{{$block->id}} a[href$="' + root + '"]').attr('class', 'selected');
     $('#navigation-{{$block->id}} a[href$="' + root + '"]').parent().attr('class', 'selected-path');
    
 
 });




  $("#goto").change(function(){
    if ($(this).val()!='') {
      window.location.href=$(this).val();
    }
  });
});

</script>


{{ Area::close_wrapper($handle, $id, $global) }}