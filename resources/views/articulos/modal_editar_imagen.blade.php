<div class="modal fade" tabindex="-1" role="dialog" id="editar_imagen">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="">
				<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
				<div class="label-primary text-center padding_1em">
					<h3>Actualizar Foto</h3>
				</div>
				<div class="modal-body text-left">
					<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
					<!-- <img alt="imagen" id="img_modal" style="max-width: 40%; max-height: 50%;"> -->
					<input id="file_input" type="file" class="file" data-preview-file-type="text" name="imagen">
				</div>
			</div>
			<div class="padding_1em">
				<div class="text-right">
					<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
					<button type="button" class="btn btn-success btn_edit_img">
						<i class="fa fa-send"> Actualizar</i>
					</button>
					<span id="reload_model" style="display: none">
						<i class="fa fa-refresh fa-pulse fa-fw"></i>
					</span>
				</div>
			</div>
		</div>	
	</div>
</div>