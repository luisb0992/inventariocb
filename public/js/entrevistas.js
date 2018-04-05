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

// boton de fecha
$("#btn_fecha").click(function(e){
	$("#fecha").val('');
	$("#fecha").hide();
	// $("#div_fecha").remove();
});

// boton de hora
$("#btn_hora").click(function(e){
	$(".hora").val('');
	$(".hora").hide();
	// $("#div_hora").remove();
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
			"<li class='list-group-item'><b>Fecha de Nacimiento: </b>"+res.fecha_nac+"</li>"+
		"</ul>"
		);

		$("#ver_data_3").append(
		"<ul class='list-group'>"+
			"<li class='list-group-item'><b>Articulo: </b>"+res.articulo.name+"</li>"+
			"<li class='list-group-item'><b>Precio referencial: </b>"+res.precio_ref+"</li>"+
			"<li class='list-group-item'><b>Fecha pautada: </b>"+res.fecha+"</li>"+
			"<li class='list-group-item'><b>Hora pautada: </b>"+res.hora+"</li>"+
		"</ul>"
		);

		if (res.comentarios) {
			$.each(res.comentarios, function(index, val) {
				$("#ver_data_4").append(
				"<div class='list-group'>"+
					"<div class='col-sm-8 list-group-item text-capitalize'>"+val.comentario+"</div>"+
					"<div class='col-sm-4 list-group-item text-capitalize'>"+val.created_at+"</div>"+
				"</div>"
				);
			});
		}else{
			$("#ver_data_4").append(
			"<ol class='list-group'>"+
				"<li class='list-group-item text-capitalize'>"+"Sin Comentarios..."+"</li>"+
			"</ol>"
			);
		}

	$(".reload_data").fadeOut(100 ,'linear');	
  	});

}

	// cargar comentarios
	function cargarComentarios(btn_nuevo_comentario){
		var ruta = $('#ruta_ver_entrevista_one').attr('href')+"/"+btn_nuevo_comentario.value;

		$("#reload_coment_data").fadeIn(400,"linear");
	  	$.get(ruta, function(res){
	    	$("#id_entre").attr("value",  res);
	  	});
	  	$("#reload_coment_data").fadeOut(400,"linear");
	  	$("#data_coment").show(1000,"linear");
	}

  	$(".btn_save_comentario").click(function(e){

  			e.preventDefault();
			var btn = $(".btn_save_comentario");
			var token = $("#token").val();
			var ruta = $('#ruta_crear_comentario').attr('href');

			btn.text("Espere un momento...");
			btn.addClass("disabled");

			$("#reload_coment").fadeIn('slow/400/fast');

			$.ajax({
				url: ruta,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'JSON',
				data: {comentario: $("#comentario").val(), id_entrevista: $("#id_entre").val()},
			})
			.done(function(data) {
				$("#comentario").empty();
					$("#nuevo_comentario").modal('toggle');
				    $("#coment_listo").fadeIn('slow/400/fast');
						$("#msj_ajax").append("<i class='fa fa-check text-success'>"+'Comentario Añadido!'+"</i>");
					$("#coment_listo").fadeOut(6000);
				    
				    btn.text("Guardar");
				    btn.removeClass("disabled");
				    $("#reload_coment").fadeOut('slow/400/fast');
				    $("#reload_active").fadeIn('slow/400/fast');
				    location.reload(5000);
			})
			.fail(function(data) {

				btn.text("Guardar");
				btn.removeClass("disabled");
				$("#reload_coment").fadeOut('slow/400/fast');
				alert("campo vacio! intente de nuevo");
			
			})
			.always(function() {
				console.log("complete");
			});
  		});