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
	$("#ver_data_2").empty();
	$("#ver_data_3").empty();
	$("#ver_data_4").empty();
	$("#per_nombre").empty();
	$(".reload_data").fadeIn(100 ,'linear');

	var ruta = $('#ruta_ver_entrevistas').attr('href')+"/"+btn_ver_entrevistas.value;

  	$.get(ruta, function(res){
  		$("#per_nombre").append("<i class='fa fa-user-o'></i>"+' '+res.nombre+' '+res.apellido);

		$("#ver_data").append(
		"<ul class='list-group'>"+
			"<li class='list-group-item'><b>Telefono: </b>"+res.telefono+"</li>"+
			"<li class='list-group-item'><b>Email: </b>"+res.email+"</li>"+
			"<li class='list-group-item'><b>Direccion: </b>"+res.direccion+"</li>"+
			"<li class='list-group-item'><b>Contactado Por: </b>"+res.contacto+"</li>"+
			"<li class='list-group-item'><b>Pais: </b>"+res.pais.name+"</li>"+
			"<li class='list-group-item'><b>Distrito: </b>"+res.distrito+"</li>"+
			"<li class='list-group-item'><b>Provincia: </b>"+res.provincia+"</li>"+
		"</ul>"
		);
		
		$("#ver_data_2").append(
		"<ul class='list-group'>"+
			"<li class='list-group-item'><b>Tiempo de Embarazo: </b>"+res.tiempo_embarazo+"</li>"+
			"<li class='list-group-item'><b>Tiempo de Nacido: </b>"+res.tiempo_nacido+"</li>"+
			"<li class='list-group-item'><b>Sexo del Bebe: </b>"+res.sexo_bebe+"</li>"+
		"</ul>"
		);

		$("#ver_data_3").append(
		"<ul class='list-group'>"+
			"<li class='list-group-item'><b>Articulo: </b>"+res.articulo.name+"</li>"+
			"<li class='list-group-item'><b>Fecha pautada: </b>"+res.fecha+"</li>"+
			"<li class='list-group-item'><b>Hora pautada: </b>"+res.hora+"</li>"+
		"</ul>"
		);

		if (!res.comentarios) {
			$("#ver_data_4").append(
			"<ol class='list-group'>"+
				"<li class='list-group-item text-capitalize'>"+"Sin Comentarios..."+"</li>"+
			"</ol>"
			);
		}else{
			$.each(res.comentarios, function(index, val) {
				$("#ver_data_4").append(
				"<ol class='list-group'>"+
					"<li class='list-group-item text-capitalize'>"+val.comentario+"</li>"+
				"</ol>"
				);
			});
		}

	$(".reload_data").fadeOut(100 ,'linear');	
  	});
}