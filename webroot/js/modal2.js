
// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks anywhere outside of the modal, close it

// When the user clicks on the button, open the modal 


// When the user clicks on <span> (x), close the modal
$(span).click(function() {
	$("#myModal").css('display','none');
	


});

// When the user clicks anywhere outside of the modal, close it
$(window).click(function(event) {
    if (event.target == document.getElementById('myModal')) {
    $("#myModal").css('display','none');
  
    }
});

$(document).on('click','.myBtn',function() {
    $("#myModal").css('display','block');
    
});