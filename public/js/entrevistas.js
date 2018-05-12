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
	$("#p_c").empty();
	$("#ver_data").empty();
	$("#ver_data_2").empty();
	$("#ver_data_3").empty();
	$("#ver_data_4").empty();
	$("#per_nombre").empty();
	$(".reload_data").fadeIn(100 ,'linear');

	var ruta = $('#ruta_ver_entrevistas').attr('href')+"/"+btn_ver_entrevistas.value;

  	$.get(ruta, function(res){
  		var fecha = new Date(res.created_at);
  		$("#form_data_entre").attr('action', "entrevistas/"+res.id+"" );
  		$("#p_c").append('<span>'+fecha.toLocaleDateString("es-ES",{ year: 'numeric', month: 'numeric', day: 'numeric' }
)+'</span>');

		$("#ver_data").append(
		"<ul class='list-group'>"+
			"<li class='list-group-item'><b>Nombre </b>"+
				"<input class='form-control' style='width:100%' name='nombre' value='"+res.nombre+"'>"+
			"</li>"+
			"<li class='list-group-item'><b>Apellido </b>"+
				"<input class='form-control' style='width:100%' name='apellido' value='"+res.apellido+"'>"+
			"</li>"+
			"<li class='list-group-item'><b>Telefono </b>"+
				"<input class='form-control' style='width:100%' name='telefono' value='"+res.telefono+"'>"+
			"</li>"+
			"<li class='list-group-item'><b>Email </b>"+
				"<input class='form-control' style='width:100%' name='email' value='"+res.email+"'>"+
			"</li>"+
			"<li class='list-group-item'><b>Direccion </b>"+
				"<input class='form-control' style='width:100%' name='direccion' value='"+res.direccion+"'>"+
			"</li>"+
			"<li class='list-group-item'><b>ContactadoPor: </b>"+
				"<input class='form-control' style='width:100%' name='contacto' value='"+res.contacto+"'>"+
			"</li>"+
			"<li class='list-group-item'><b>Distrito </b>"+
				"<input class='form-control' style='width:100%' name='distrito' value='"+res.distrito+"'>"+
			"</li>"+
			"<li class='list-group-item'><b>Provincia </b>"+
				"<input class='form-control' style='width:100%' name='provincia' value='"+res.provincia+"'>"+
			"</li>"+
		"</ul>"
		);

		$("#ver_data_2").append(
		"<ul class='list-group'>"+
			"<li class='list-group-item'><b>Tiempo de Embarazo </b>"+
				"<input class='form-control' style='width:100%' name='tiempo_embarazo' value='"+res.tiempo_embarazo+"'>"+
			"</li>"+
			"<li class='list-group-item'><b>Tiempo de Nacido </b>"+
				"<input class='form-control' style='width:100%' name='tiempo_nacido' value='"+res.tiempo_nacido+"'>"+
			"</li>"+
			"<li class='list-group-item'><b>Sexo del Bebe </b>"+
				"<input class='form-control' style='width:100%' name='sexo_bebe' value='"+res.sexo_bebe+"'>"+
			"</li>"+
			"<li class='list-group-item'><b>Fecha de Nacimiento </b>"+
				"<input class='form-control fecha' name='fecha_nac' style='width:100%' value='"+res.fecha_nac+"'>"+
			"</li>"+
		"</ul>"
		);

		$("#ver_data_3").append(
		"<ul class='list-group'>"+
			"<li class='list-group-item'><b>Precio referencial </b>"+
				"<input class='form-control' style='width:100%' name='precio_ref' value='"+res.precio_ref+"'>"+
			"</li>"+
			"<li class='list-group-item'><b>Fecha pautada </b>"+
				"<input class='form-control fecha' style='width:100%' name='fecha' value='"+res.fecha+"'>"+
			"</li>"+
			"<li class='list-group-item'><b>Hora pautada </b>"+
				"<input class='form-control timepicker hora' style='width:100%' name='hora' value='"+res.hora+"'>"+
			"</li>"+
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

	function cargarDatosBebe(btn_datos_bebe){
		var ruta = $('#ruta_ver_entrevistas').attr('href')+"/"+btn_datos_bebe.value;

		$("#reload_data_bebe").fadeIn(400,"linear");
	  	$.get(ruta, function(res){
	    	$("#form_bebe").attr('action', "entrevistas/"+res.id+"" );
	    	$("#t_emba").val(res.tiempo_embarazo);
	    	$("#t_nac").val(res.tiempo_nacido);
	    	$("#sexo_bb").val(res.sexo_bebe);
	    	$("#fecha_nac").val(res.fecha_nac);
	  	});
	  	$("#reload_data_bebe").fadeOut(400,"linear");
	}

  	$(".btn_save_comentario").click(function(e){

  			// e.preventDefault();
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