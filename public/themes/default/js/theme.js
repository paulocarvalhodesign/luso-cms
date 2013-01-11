$('.error').delay('2000').hide();
$(function(){
   var root = location.pathname.substring();
  // var path = location.pathname.substring(1);
   

     $('#navigation a[href$="' + root + '"]').attr('class', 'selected');
  
  
 
 });