		// cargar modelos
		function cargarModelos(){
			$("#select_modelo").empty();
		  	$.get($('#ruta_cargar_m').attr('href'), function(res){
		  		$.each(res, function(index, val) {
		    		$("#select_modelo").append("<option value='"+val.id+"'>"+val.name+"</option>");
		    	});
		  	});
		}

		// cargar colores
		function cargarColores(){
			$(".select_color").empty();
		  	$.get($('#ruta_cargar_c').attr('href'), function(res){
		  		$.each(res, function(index, val) {
		    		$(".select_color").append("<option value='"+val.id+"'>"+val.name+"</option>");
		    	});
		  	});
		}

		// guardar modelos
		$(".btn_create_model").click(function(e) {
			e.preventDefault();
			var btn = $(".btn_create_model");
			var token = $("#token").val();
			var ruta = $('#ruta_crear_m').attr('href');

			btn.text("Espere un momento...");
			btn.addClass("disabled");
			$("#reload_model").fadeIn('slow/400/fast');

			$.ajax({
				url: ruta,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'JSON',
				data: {name: $("#name_model").val()},
			})
			.done(function(data) {
				$("#msj_ajax").empty();
				if (data.count){
					$("#create_modelo").modal('toggle');
					$("#modelo_listo").fadeIn('slow/400/fast');
						$("#msj_ajax").append("<i class='fa fa-remove text-danger'>"+"Ya existe este modelo!"+"</i>");
					$("#modelo_listo").fadeOut(6000);
					btn.text("Guardar");
					btn.removeClass("disabled");
				    $("#reload_model").fadeOut('slow/400/fast');
				}else{	
					$("#create_modelo").modal('toggle');
				    $("#modelo_listo").fadeIn('slow/400/fast');
						$("#msj_ajax").append("<i class='fa fa-check text-success'>"+'Creado con exito!'+"</i>");
					$("#modelo_listo").fadeOut(6000);
				    btn.text("Guardar");
				    btn.removeClass("disabled");
				    $("#reload_model").fadeOut('slow/400/fast');
				    cargarModelos();
			    }
			})
			.fail(function(data) {
				btn.text("Guardar");
				btn.removeClass("disabled");
				$("#reload_model").fadeOut('slow/400/fast');
				alert("campo vacio! intente de nuevo");
			})
			.always(function() {
				console.log("complete");
			});
			
		});


		// guardar colores
		$(".btn_create_color").click(function(e) {
			e.preventDefault();
			var btn = $(".btn_create_color");
			var token = $("#token").val();
			var ruta = $('#ruta_crear_c').attr('href');
			
			btn.text("Espere un momento...");
			$("#reload_color").fadeIn('slow/400/fast');
			btn.addClass("disabled");

			$.ajax({
				url: ruta,
				headers: {'X-CSRF-TOKEN': token},
				type: 'POST',
				dataType: 'JSON',
				data: {name: $("#name_color").val()},
			})
			.done(function(data) {
				$("#msj_ajax_color").empty();
				if (data.count){
					$("#create_color").modal('toggle');
					$("#color_listo").fadeIn('slow/400/fast');
						$("#msj_ajax_color").append("<i class='fa fa-remove text-danger'>"+"Ya existe este color!"+"</i>");
					$("#color_listo").fadeOut(6000);
					btn.text("Guardar");
					btn.removeClass("disabled");
				    $("#reload_color").fadeOut('slow/400/fast');
				}else{	
					$("#create_color").modal('toggle');
				    $("#color_listo").fadeIn('slow/400/fast');
						$("#msj_ajax_color").append("<i class='fa fa-check text-success'>"+'Creado con exito!'+"</i>");
					$("#color_listo").fadeOut(6000);
				    btn.text("Guardar");
				    btn.removeClass("disabled");
				    $("#reload_color").fadeOut('slow/400/fast');
				    cargarColores();
			    }
			})
			.fail(function(data) {
				btn.text("Guardar");
				btn.removeClass("disabled");
				$("#reload_color").fadeOut('slow/400/fast');
				alert("campo vacio! intente de nuevo");
			})
			.always(function() {
				console.log("complete");
			});
			
		});