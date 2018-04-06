<div class="modal fade" tabindex="-1" role="dialog" id="datos_bebe">
	<div class="modal-dialog modal-sm" role="document">
		<div class="modal-content">
			<form method="POST" id="form_bebe">
				<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
				{{ method_field('PATCH') }}
				<div class="">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="label-primary text-center padding_1em">
						<h3>
							<i class="fa fa-info-circle"></i> Datos del Bebe
							<span id="reload_data_bebe" style="display: none">
								<i class="fa fa-spinner fa-pulse fa-fw text-danger"></i>
							</span>
						</h3>
					</div>
					<div class="modal-body text-left">
						<div class="row well">
							<div class="col-sm-12">
								<div class="form-group">
									<label>Tiempo de Embarazo</label>
									<br>
									<input class="form-control" id="t_emba" name="tiempo_embarazo">
								</div>
								<br><br>
								<div class="form-group">
									<label>Tiempo de Nacido</label>
									<br>
									<input class="form-control" id="t_nac" name="tiempo_nacido">
								</div>
								<br><br>
								<div class="form-group">
									<label>Sexo del Bebe</label>
									<br>
									<select class="form-control" id="sexo_bb" name="sexo_bebe">
										<option value="Hembra">Hembra</option>
										<option value="Varon">Varon</option>
									</select>	
								</div>
								<br><br>
								<div class="form-group">
									<label>Fecha de Nacimiento</label>
									<br>
									<input class="form-control fecha" id="fecha_nac" name="fecha_nac">
								</div>
							</div>
						</div>	
					</div>
				</div>
				<div class="padding_1em">
					<div class="text-right">
						<input type="button" class="btn" data-dismiss="modal" value="Cerrar">
						<button type="submit" class="btn btn-primary" id="btn_actualizar_bebe">
							<i class="fa fa-edit"></i> Actualizar
						</button>
					</div>
				</div>
			</form>
		</div>	
	</div>
</div>