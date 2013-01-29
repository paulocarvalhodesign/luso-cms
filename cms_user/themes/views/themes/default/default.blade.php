<?php  
 
 //example on how to get an attribute
 //$poster = Attribute::image('poster', Config::get('page_id'));
 //$text = Attribute::text('test', Config::get('page_id'));
  

 ?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>{{ Config::get('site_name') }} :: {{ $title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $keywords }}" />
   
 

   
   <link rel="shortcut icon" type="image/x-icon" href="public/favicon.ico">
    
   
    {{  Elements::get('header_required') }}
    
</head>

@if ( Auth::check() == true)
    
    <body class="theme logged_in">

@else

    <body class="theme">

@endif
   
      
        <div  class="header_wrapper">
        <header>
             <div class="social_bar_top">
                 <div class="container">
                    <div class="row-fluid">
                        <div class="span12">
                            <div class="span8">
                                <div class="logo">
                                     
                                      {{ Area::globalRender('logo', $page_id, '1') }}
                                </div>
                                  
                            </div>
                        <div class="span4">

                             {{ Area::globalRender('social', $page_id, '1') }} 
                            
                        </div>
                      </div>
                    </div>        
                </div>
             </div> 
          <div class="container">
            <div class="row-fluid">
                
                <div class="span12">
                    <div class="span8">  
                 {{ Area::globalRender('navigation', $page_id, '1') }}  
                    </div>           
                    <div class="span4">
                      
                     

                    </div>
                </div>
          </div>  
        </header>
       </div>
      
      <br/>

      <div class="main"> 
       <div class="container">
        <div class="row-fluid">
            
            <div class="span8">
                               

                    {{ Area::render('main_left', $page_id) }} 
                   
           </div>  


             <div class="span4">
                    
               
                    {{ Area::render('main_right', $page_id) }}  
             
            </div>    
        </div>
      </div>
     </div> 
   
  <div  class="footer_wrapper">
     <div class="container">
        <div class="row-fluid">
          
        </div>
     </div>
  </div>

   <div class="copyright">
    <div class="container">
        <div class="row-fluid">
        {{ Area::globalRender('footer', $page_id, '1') }}
      <p>All rights reserved &copy; Paulo Carvalho {{ date('Y') }}, powered by <a href="http://lusocms.org">Luso CMS</a>, open source cms.</p>
       
        </div>
     </div>
    </div>  

    

 {{  Elements::get('footer_required') }}    


  
   
</body>
</html>
