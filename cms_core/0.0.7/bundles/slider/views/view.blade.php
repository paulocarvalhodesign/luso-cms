{{ Area::open_wrapper($area, $handle, $id, $global) }}


<section class="slider">
        <div class="flexslider">
          <ul class="slides">



@foreach($set as $image)
   
    <?php $path = '../public/filemanager/level2/images/'.$image->filename;?>
       

    <li>
      <img src="{{ $path }}" /> 
     
    </li>


    


@endforeach
 	   </ul>
</div>
</section>
<br/><br/>
{{ Area::close_wrapper() }}

 <script type="text/javascript">
    
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        animationLoop: true,
        start: function(slider){
          $('body').removeClass('loading');
        }
      });
    });
  </script>