// boton de si nacio
$("#btn_si").click(function(e){
	$("#fa_si").show();
	$("#fa_no").hide();
	$("#tiempo_embarazo").val('');
	$("#si_nacio").show();
	$("#no_nacio").hide();
});

// boton de no nacio
$("#btn_no").click(function(e){
	$("#fa_no").show();
	$("#fa_si").hide();
	$("#tiempo_nacido").val('');
	$("#no_nacio").show();
	$("#si_nacio").hide();
});


// cargar entrevistas
function cargarEntrevistas(btn_ver_entrevistas){
	$("#ver_data").empty();
	var ruta = $('#ruta_ver_entrevistas').attr('href')+"/"+btn_ver_entrevistas.value;
	$("#reload_data").fadeIn(100 ,'linear');

  	$.get(ruta, function(res){
		$("#ver_data").append(
		"<ul>"+
		"<li>"+res.nombre+"</li>"+
		"<li>"+res.apellido+"</li>"+
		"<li>"+res.email+"</li>"+
		"<li>"+res.contacto+"</li>"+
		"<li>"+res.direccion+"</li>"+
		"</ul>"
		);

	$("#reload_data").fadeOut(100 ,'linear');	
  	});
}