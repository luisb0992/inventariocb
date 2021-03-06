@extends('layouts.app')
@section('title','Prospecto - '.config('app.name'))
@section('header','Prospecto')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('entrevistas.index')}}" title="Entrevistas"> Prospecto De Venta</a></li>
	  <li class="active">Agregar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="fondo_blanco">
			<div class="row padding_1em">
				<form class="" action="{{ route('entrevistas.store') }}" method="POST">
					{{ csrf_field() }}
					
					<!-- datos personales -->
					<div class="col-sm-12">
						<section class="padding_1em label-primary">
							<span class="h4">Datos personales</span>
							<br>
							<span>(<span class="span_rojo">*</span>)<sub> campos obligatorios</sub></span>
						</section>
						<br>
					</div>
					
					<div class="col-sm-4">
						<label for="nombre">Nombre <span class="span_rojo">*</span></label>	
						<input type="text" class="form-control" name="nombre" placeholder="nombre" required="">
					</div>
					<div class="col-sm-4">
						<label for="apellido">Apellido <span class="span_rojo">*</span></label>
						<input type="text" class="form-control" name="apellido" placeholder="apellido" required="">
					</div>
					<div class="col-sm-4">
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" placeholder="email">
						<hr>
					</div>
					<div class="col-sm-4">
						<label for="telefono">Telefono </label>
						<input type="text" class="form-control" name="telefono" placeholder="telefono">
					</div>
					<div class="col-sm-8">
						<label for="contacto">Fue contactado por </label>
						<input type="text" class="form-control" name="contacto" placeholder="via de contacto">
						<hr>
					</div>
					<div class="col-sm-4">
						<label for="pais">Pais <span class="span_rojo">*</span></label>
							<select name="pais_id" class="form-control" required="">
								<option value="">Seleccione...</option>
								@foreach($paises as $pais)
								<option value="{{ $pais->id }}" @if($pais->id == 121) selected @endif>{{ $pais->name }}</option>
								@endforeach
							</select>
					</div>
					<div class="col-sm-4">
						<label for="distrito">Distrito </label>
						<input type="text" class="form-control" name="distrito" placeholder="distrito">
					</div>
					<div class="col-sm-4">
						<label for="provincia">Provincia </label>
						<input type="text" class="form-control" name="provincia" placeholder="provincia">
						<hr>
					</div>
					<div class="col-sm-12">
						<label for="direccion">direccion</label>
						<textarea name="direccion" id="direccion" placeholder="direccion o localidad" class="form-control"></textarea>
					</div>

					<!-- datos bebe -->
					<div class="col-sm-12">
						<h4 class="padding_1em label-primary">Datos del bebe</h4>
					</div>

					<div class="col-sm-12" id="pregunta">
						<div class="col-sm-12 h4">¿Su bebe ya nacio? <i class="fa fa-male"></i><i class="fa fa-female"></i></div>
						<div class="col-sm-1">
							<button type="button" class="btn btn-primary" id="btn_si">SI</button>
							<span style="display:none;" id="fa_si"><i class="fa fa-check text-success"></i></span>
						</div>
						<div class="col-sm-2 text-left">	
							<button type="button" class="btn btn-danger" id="btn_no">NO</button>
							<span style="display:none;" id="fa_no"><i class="fa fa-check text-success"></i></span>
						</div>
						<div class="col-sm-9"></div>
						<div class="col-sm-12"><br></div>
					</div>

					<!-- si nacio -->
					<section class="col-sm-12" id="si_nacio" style="display: none;">
						<div class="col-sm-3">
							<label for="t_nacido">Tiempo de nacido</label>
							<select class="form-control" name="tiempo_nacido" id="tiempo_nacido">
								<option value="">Seleccione</option>
								@for($i = 0; $i < 50; $i++)
								<option value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
						<div class="col-sm-3">
							<label for="t_nacido">&nbsp;</label>	
							<select class="form-control" name="t_nacido">
								<option value="Semanas">Semanas</option>
								<option value="Meses">Meses</option>
								<option value="Años">Años</option>
							</select>
						</div>
						<div class="col-sm-3">
							<label for="sexo_bebe">Sexo del bebe</label>
							<select class="form-control" name="sexo_bebe">
								<option value="">Seleccione</option>
								<option value="Varon">Varon</option>
								<option value="Hembra">Hembra</option>
							</select>	
						</div>
						<div class="col-sm-3">
							<label for="sexo_bebe">Fecha de nacimiento</label>
							<input type="text" class="form-control fecha" name="fecha_nac" placeholder="d/m/a">	
						</div>		
					</section>

					<!-- no nacio -->
					<section class="col-sm-12" id="no_nacio" style="display: none;">
						<div class="col-sm-3">
							<label for="t_embarazo">Tiempo de embarazo</label>
							<select class="form-control" name="tiempo_embarazo" id="tiempo_embarazo">
								<option value="">Seleccione</option>
								@for($i = 0; $i < 50; $i++)
								<option value="{{ $i }}">{{ $i }}</option>
								@endfor
							</select>
						</div>
						<div class="col-sm-3">
							<label for="t_embarazo">&nbsp;</label>
							<select class="form-control" name="t_embarazo">
								<option value="Semanas">Semanas</option>
								<option value="Meses">Meses</option>
							</select>
						</div>

						<div class="col-sm-6">
							<label for="sexo_bebe">Sexo del bebe</label>
							<select class="form-control" name="sexo_bebe">
								<option value="">Seleccione</option>
								<option value="Varon">Varon</option>
								<option value="Hembra">Hembra</option>
							</select>	
						</div>
					</section>

					<!-- articulos -->
					<div class="col-sm-12">
						<h4 class="padding_1em label-primary">Articulo de interes y cita</h4>
					</div>

					<div class="col-sm-8">
						<label for="">Seleccione un articulo <span class="span_rojo">*</span> <em><small>(articulo - color tela - color tubo - modelo)</small></em></label>
						<select name="articulo_id" class="form-control" required>
							<option value="">seleccione</option>
							@foreach($articulos as $articulo)
							<option value="{{ $articulo->id }}">
								{{ $articulo->name }} - ({{ $articulo->color->name }}) - (@if($articulo->color_tubo) {{ $articulo->color_tubo }} @else Vacio @endif) - ({{ $articulo->modelo->name }}) 
							</option>
							@endforeach
						</select>
					</div>

					<div class="col-sm-4">
						<label for="precio referencial">Precio referencial </label>
						<br>
						<input type="text" class="form-control" name="precio_ref" placeholder="precio referencial..">
						<br>
					</div>

					
					<div class="col-sm-4">
						<label for="fecha_hora_cita">Fecha de cita </label>
						<br>
						<input type="text" class="form-control fecha" name="fecha" placeholder="d/m/a" id="fecha">
						<br>
						<div id="div_fecha">
							<button type="button" class="btn btn-primary" id="btn_fecha">
								No definir
							</button>
						</div>
					</div>

					<div class="col-sm-4">
						<label for="fecha_hora_cita">Hora de cita </label>
						<br>
						<input type='text' class='form-control timepicker hora' name='hora' placeholder='h/m :s'>
						<br>
						<div id="div_hora">
							<button type="button" class="btn btn-primary" id="btn_hora">
								No Definir
							</button>
						</div>
					</div>


					<div class="col-sm-4">
						<label for="status_entre">Estatus</label>
						<select class="form-control" name="status_entre" required="">
							<option value="">Seleccione</option>
							<option value="Registrado">Registrado</option>
							<option value="Congelado">Congelado</option>
							<option value="Frio">Frio</option>
							<option value="Tibio">Tibio</option>
							<option value="Caliente">Caliente</option>
							<option value="Esperar Respuestas">Esperar Respuestas</option>
						</select>
					</div>
					
					<div class="col-sm-12"><hr></div>
					
					<div class="col-sm-12">
						<label for="link">Link de Facebook</label>
						<input type="text" class="form-control" placeholder="Link..." name="link">
						<hr>
					</div>

					<div class="col-sm-12">
						<label for="comentarios">Comentario</label>
						<textarea name="comentario" id="comentario" placeholder="añadir comentario" class="form-control"></textarea>
						<hr>
					</div>

					@if (count($errors) > 0)
					<div class="col-sm-12">
			          <div class="alert alert-danger alert-important">
				          <ul>
				            @foreach($errors->all() as $error)
				              <li>{{$error}}</li>
				            @endforeach
				          </ul>  
			          </div>
			        </div> 
			        @endif
					
					<div class="col-sm-12 text-right">
					<hr>
						<a class="btn btn-flat btn-default" href="{{route('entrevistas.index')}}">
							<i class="fa fa-reply"></i> Atras
						</a>
						<button class="btn btn-flat btn-primary" type="submit">
							<i class="fa fa-send"></i> Guardar
						</button>
					</div>
				</form>
			</div>
		</div>	
@endsection
@section('script')
	<script src="{{ asset('js/entrevistas.js') }}"></script>
@endsection
