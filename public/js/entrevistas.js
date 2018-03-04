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