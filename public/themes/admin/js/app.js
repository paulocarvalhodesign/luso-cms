$('.alert-error').delay(5000).fadeOut(5000);
 
$('.delete').click(function(event) {
    event.preventDefault();
    var r=confirm("Are you sure you want to delete?");
    if (r==true)   {  
       window.location = $(this).attr('href');
    }
	});
