
// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks anywhere outside of the modal, close it

// When the user clicks on the button, open the modal 


// When the user clicks on <span> (x), close the modal
$(span).click(function() {
	$("#myModal").css('display','none');
	$("#contacto").hide();
    $("#et").hide();
    $("#fechacontacto").val("");
    $("#fechaet").val("");


});

// When the user clicks anywhere outside of the modal, close it
$(window).click(function(event) {
    if (event.target == document.getElementById('myModal')) {
    $("#myModal").css('display','none');
    $("#contacto").hide();
    $("#et").hide();
    $("#fechacontacto").val("");
    $("#fechaet").val("");
    }
});

$(document).on('click','.myBtn',function() {
    $("#mensajesanteriores").val("Espere mientras se cargan los mensajes...");
    $("#myModal").css('display','block');
    candidato_id = $(this).prev().prev().data('id');
    estado_candidato_id = parseInt($(this).prev().prev().data('estado'));
    switch (estado_candidato_id) {
    	case 2:
    		$("#contacto").show();
    		break;
    	case 3:
    		$("#et").show();
    		break;
    }
    
     $.ajax({
              url: "../selectmensajes",
              dataType: "JSON",
              method: "POST",
              data: {candidato_id: candidato_id, oferta_id: oferta_id, estado_candidato_id: estado_candidato_id, usuario_id: usuario_id }
            }).done(function(jsonmensajes) {
                var mensajes = "";

            for (var i = jsonmensajes.length - 1; i >= 0; i--) {
                mensajes =  mensajes + jsonmensajes[i]['fecha'] + ":" + jsonmensajes[i]['texto'] + "\n";
            }
                $("#mensajesanteriores").val(mensajes);

            });
});