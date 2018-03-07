<div class="modal fade" tabindex="-1" role="dialog" id="nuevo_comentario">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
				<div class="">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="label-primary text-center padding_1em">
						<h3><i class="fa fa-comment"></i> Nuevo Comentario</h3>
					</div>
					<div class="modal-body text-left">
						<a href="{{ url('guardarComentario') }}" id="ruta_crear_comentario" class="hide"></a>
						<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
						<input type="hidden" id="entrevista_id">
						<div class="form-group col-sm-12">
							<textarea class="form-control" name="comentario" id="comentario"></textarea>	
						</div>	
					</div>
				</div>
				<div class="padding_1em">
					<div class="text-right">
						<input type="button" class="btn" data-dismiss="modal" value="Cerrar">
						<button type="button" id="btn_save_comentario" class="btn btn-primary">
							<i class="fa fa-save"></i> Guardar</button>
					</div>
				</div>
		</div>	
	</div>
</div>