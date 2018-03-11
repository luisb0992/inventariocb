<div class="modal fade" tabindex="-1" role="dialog" id="nuevo_comentario">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
				<div class="">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="label-primary text-center padding_1em">
						<h3><i class="fa fa-comment"></i> Nuevo Comentario</h3>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-sm-12">
								<span id="reload_coment_data" style="display: none">
									<i class="fa fa-spinner fa-pulse fa-fw fa-2x"></i>
								</span>
								<span id="data_coment" style="display:none">
									<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
									<input type="hidden" id="id_entre">
									<textarea class="form-control input-lg" name="comentario" id="comentario"></textarea>
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="padding_1em">
					<div class="text-right">
						<input type="button" class="btn" data-dismiss="modal" value="Cerrar">
						<button type="button" class="btn btn-primary btn_save_comentario">
							<i class="fa fa-save"></i> Guardar
						</button>
						<span id="reload_coment" style="display: none">
							<i class="fa fa-refresh fa-pulse fa-fw"></i>
						</span>
					</div>
				</div>
		</div>	
	</div>
</div>