<div class="modal fade" tabindex="-1" role="dialog" id="editar_imagen">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="">
				<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
				<div class="label-primary text-center padding_1em">
					<h3>Actualizar Foto</h3>
				</div>
			<form method="POST" id="form_img" enctype="multipart/form-data">
				<div class="modal-body text-left">
					<span id="reload_div_img" style="display: none" class="text-center text-success">
						<i class="fa fa-refresh fa-2x fa-pulse fa-fw"></i>
					</span>
					<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
					{{ method_field('PUT') }}
					<input type="hidden" name="articulo_id" id="articulo_id">
					<!-- <img alt="imagen" id="img_modal" style="max-width: 40%; max-height: 50%;"> -->
					<div id="imagen_div" style="display:none">
						<input id="file_input" type="file" class="file" data-preview-file-type="text" name="img">
					</div>
				</div>
			</div>
			<div class="padding_1em">
				<div class="text-right">
					<input type="button" class="btn btn-danger" data-dismiss="modal" value="Cerrar">
					<button type="submit" class="btn btn-success btn_guardar_img">
						<i class="fa fa-send"> Actualizar</i>
					</button>
					<span id="reload_img" style="display: none">
						<i class="fa fa-refresh fa-pulse fa-fw"></i>
					</span>
				</div>
			</div>
			</form>
		</div>	
	</div>
</div>