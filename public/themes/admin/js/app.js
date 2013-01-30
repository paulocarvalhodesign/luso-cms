

 
$(document).ready(function() {

  $(function(){
   
   var segment = url('1');
   var dash = '/';
  
   if(segment == '') { 
    var root = segment+dash;
    }else{
    var root = segment;
   }
    $('#dash_navigation  a[href$="' + root + '"]').attr('class', 'selected');
    $('#dash_navigation  a[href$="' + root + '"]').parent().attr('class', 'selected-path');
    
 
      });




  $('.alert, .error').delay('2000').fadeOut('2000');
  $('.tt').tooltip();
   });