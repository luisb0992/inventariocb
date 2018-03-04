<div class="modal fade" tabindex="-1" role="dialog" id="create_color">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
				<div class="">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="label-primary text-center padding_1em">
						<h3>Nuevo Color</h3>
					</div>
					<div class="modal-body text-left">
						<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
						<div class="form-group">
							<label for="">Nombre</label>
							<input type="text" class="form-control" id="name_color" placeholder="Nombre del color">
						</div>
					</div>
				</div>
				<div class="padding_1em">
					<div class="text-right">
						<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
						<button type="button" class="btn btn-success btn_create_color">
							<i class="fa fa-send"> Guardar</i>
						</button>
						<span id="reload_color" style="display: none">
							<i class="fa fa-refresh fa-pulse fa-fw"></i>
						</span>
					</div>
				</div>
		</div>	
	</div>
</div>