$( document ).ready(function() {

    $("#comunidades").change(function() {
		$("#provincias").prop('disabled',true);
		document.getElementById("municipio_id").innerHTML = "";
    	
    	var comunidad_id = $("#comunidades").val();
    	var url = "listarprovincias";
		$.ajax({
		  url: APP_URI + url,
		  dataType: "JSON",
		  method: "POST",
		  data: { comunidad_id: comunidad_id }
		}).done(function(json) {
			var z = '<option value="">Seleccione provincia</option>';
			
		  if(json.provincias){
			for (var i = json.provincias.length - 1; i >= 0; i--) {
			  //console.log(json.subtipos[i]);
			  z = z+'<option value="'+json.provincias[i]['id']+'">'+json.provincias[i]['provincia']+'</option>';
			}}
			 document.getElementById("provincias").innerHTML = z;
			 document.getElementById("municipio_id").innerHTML = "";
			 $("#provincias").prop('disabled',false);
			 
			//console.log(z);
			//console.log($("#lineas-de-negocio-id").val());*/
		});
		
    });

    $("#provincias").change(function() {
    	$("#municipio_id").prop('disabled',true);
    	document.getElementById("municipio_id").innerHTML = "";
    	
    	
    	var provincia_id = $("#provincias").val();
    	var url = "listarmunicipios";
		$.ajax({
		  url: APP_URI + url,
		  dataType: "JSON",
		  method: "POST",
		  data: { provincia_id: provincia_id }
		}).done(function(json) {
			var z = '<option value="">Seleccione Municipio</option>';
			$("#municipio_id").prop('disabled',false);
		  if(json.municipios){
			for (var i = json.municipios.length - 1; i >= 0; i--) {
			  //console.log(json.subtipos[i]);
			  z = z+'<option value="'+json.municipios[i]['id']+'">'+json.municipios[i]['municipio']+'</option>';
			}}
			 document.getElementById("municipio_id").innerHTML = z;
			 
			//console.log($("#lineas-de-negocio-id").val());*/
		});
    });
});