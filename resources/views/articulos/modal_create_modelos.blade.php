<div class="modal fade" tabindex="-1" role="dialog" id="create_modelo">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
				<div class="panel panel-primary">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="panel-heading text-center">
						<h3>Nuevo Modelo</h3>
					</div>
					<div class="modal-body text-left">
							<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
							<div class="form-group">
								<label for="">Nombre</label>
								<input type="text" class="form-control" name="name" id="name_model" required="" placeholder="Nombre del modelo">
							</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group text-right">
						<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
						<button type="button" class="btn btn-success btn_create_model">
							<i class="fa fa-send"> Guardar</i>
						</button>
						<span id="reload_model" style="display: none">
							<i class="fa fa-refresh fa-pulse fa-fw"></i>
						</span>
					</div>
				</div>
		</div>	
	</div>
</div>