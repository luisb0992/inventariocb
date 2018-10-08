<div class="modal fade" tabindex="-1" role="dialog" id="nuevo_red">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="{{ route('redes.store') }}" method="POST">
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
				<div class="">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="label-primary text-center padding_1em">
						<h3>Nuevo Grupo</h3>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Link de Facebook</label>
							<input type="text" name="link_f" class="form-control" required="">
						</div>
						<div class="form-group">
							<label>Fecha de Creacion</label>
							<input type="text" name="fecha" class="form-control fecha" required="">
						</div>
						<div class="form-group">
							<label>Hora de Creacion</label>
							<input type='text' class='form-control timepicker' name='hora' placeholder='h/m :s' required="">
						</div>
						<div class="form-group">
							<label>Cantidad de personas</label>
							<input type="text" name="cantidad" class="form-control" required="">
						</div>
						<div class="form-group">
							<label>Provincias</label>
							<select class="form-control" name="provincia_id" required="">
							@foreach($prov as $p)
							<option value="{{ $p->id }}">{{ $p->provincia }}</option>
							@endforeach
							</select>
						</div>
						<div class="form-group">
							<label>Descripcion</label>
							<textarea class="form-control" name="descripcion"></textarea>
						</div>
					</div>
				</div>
				<div class="padding_1em">
					<div class="text-right">
						<input type="button" class="btn" data-dismiss="modal" value="Cerrar">
						<button type="submit" class="btn btn-primary btn_save_comentario">
							<i class="fa fa-save"></i> Guardar
						</button>
					</div>
				</div>
			</form>	
		</div>	
	</div>
</div>