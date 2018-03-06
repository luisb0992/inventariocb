<div class="modal fade" tabindex="-1" role="dialog" id="ver_entrevistas">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
				<div class="">
					<buttton class="close" type="button" data-dismiss="modal">&times;</buttton>
					<div class="label-primary text-center padding_1em">
						<h3><i class="fa fa-info-circle"></i> Datos de la entrevista</h3>
					</div>
					<div class="modal-body text-left">
						
						<!-- nombre de la persona -->
						<div class="label-primary padding_1em">
							<span id="per_nombre" class="text-capitalize"></span> 
							<span style="display: none" class="pull-right reload_data">
								<i class="fa fa-spinner fa-pulse fa-fw"></i> ...
							</span>
						</div>	
						<div class="well">
							<p id="ver_data"></p>
						</div>

						<!-- datos del bebe -->
						<div class="label-primary padding_1em">
							<i class="fa fa-male"></i><i class="fa fa-female"></i> Datos del bebe
							<span style="display: none" class="pull-right reload_data">
								<i class="fa fa-spinner fa-pulse fa-fw"></i> ...
							</span>
						</div>
						<div class="well">
							<p id="ver_data_2"></p>
						</div>
						
						<!-- nombre de la cita -->
						<div class="label-primary padding_1em">
							<i class="fa fa-cube"></i> Cita
							<span style="display: none" class="pull-right reload_data">
								<i class="fa fa-spinner fa-pulse fa-fw"></i> ...
							</span>
						</div>
						<div class="well">
							<p id="ver_data_3"></p>
						</div>


						<!-- comentarios -->
						<div class="label-primary padding_1em">
							<i class="fa fa-comments"></i> Comentarios
							<span style="display: none" class="pull-right reload_data">
								<i class="fa fa-spinner fa-pulse fa-fw"></i> ...
							</span>
						</div>
						<div class="well">
							<p id="ver_data_4"></p>
						</div>	

					</div>
				</div>
				<div class="padding_1em">
					<div class="text-right">
						<input type="button" class="btn" data-dismiss="modal" value="Cerrar">
						<button type="button" id="imprimir" class="btn btn-danger"><i class="fa fa-file-pdf-o"></i> imprimir</button>
					</div>
				</div>
		</div>	
	</div>
</div>