{{ Area::open_wrapper($area, $handle, $id, $global) }}


<div id='gallery-{{$block->id}}' class="gallery-block">
  @foreach($set as $image)

         
        <a class="group-{{$block->id}}" href="{{url($image->location)}}">
            <img 
            src="{{$image->location}}" 
            data-title="{{$image->title}}"
            data-description=""
            
            />
        </a>
        
   
@endforeach      

    </div>
    
    

<script>
            $(document).ready(function(){
                
                $(".group-{{$block->id}}").colorbox({rel:'group-{{$block->id}}',width:"75%", height:"75%"});
                
            });
</script>

   
 	 

{{ Area::close_wrapper() }}

 