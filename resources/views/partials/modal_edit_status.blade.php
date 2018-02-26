<div class="modal fade" tabindex="-1" role="dialog" id="modal_edit_status">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<form id="form_edit_status">
				<div class="panel panel-primary">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="panel-heading text-center">
						<h3>Cambio de Status</h3>
					</div>
				 
					<div class="modal-body text-left">
							<p class="texto_negro text-center">
								Actualmente <span class="text-info" id="status_name"></span>
								<span id="reload" style="display:none"><i class="fa fa-spinner fa-pulse fa-fw"></i></span>
							</p>
							<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
							<input type="hidden" id="id_user">
							<div class="form-group">
								<label for="">Status</label>
								<select name="status" class="form-control" required>
									<option value="">Seleccione un Status</option>
									<option value="1">Activo</option>
									<option value="2">Inactivo</option>
									<option value="3">Suspendido</option>
								</select>
							</div>
					</div>
				</div>
				<div class="modal-footer">
					<div class="form-group text-right">
						<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
						<button type="submit" class="btn btn-success btn_edit_status">
							Actualizar
						</button>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>