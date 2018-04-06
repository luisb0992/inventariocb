@extends('layouts.app')
@section('title','Entrevistas - '.config('app.name'))
@section('header','Entrevistas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('entrevistas.index')}}" title="Entrevistas"> Entrevistas </a></li>
	  <li class="active">Editar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
		<div class="fondo_blanco">
			<div class="row padding_1em">
				<form class="" action="{{ route('entrevistas.update',[$entrevista->id]) }}" method="POST">

					{{ method_field('PATCH') }}
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
						<input type="text" class="form-control" name="nombre" placeholder="nombre" required="" value="{{ $entrevista->nombre }}">
					</div>
					<div class="col-sm-4">
						<label for="apellido">Apellido <span class="span_rojo">*</span></label>
						<input type="text" class="form-control" name="apellido" placeholder="apellido" required="" value="{{ $entrevista->apellido }}">
					</div>
					<div class="col-sm-4">
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" placeholder="email" value="{{ $entrevista->email }}">
						<hr>
					</div>
					<div class="col-sm-4">
						<label for="telefono">Telefono</label>
						<input type="text" class="form-control" name="telefono" placeholder="telefono" value="{{ $entrevista->telefono }}">
					</div>
					<div class="col-sm-8">
						<label for="contacto">Fue contactado por</label>
						<input type="text" class="form-control" name="contacto" placeholder="via de contacto" value="{{ $entrevista->contacto }}">
						<hr>
					</div>
					<div class="col-sm-4">
						<label for="pais">Pais <span class="span_rojo">*</span></label>
							<select name="pais_id" class="form-control" required="">
								<option value="">Seleccione...</option>
								@foreach($paises as $pais)
								<option value="{{ $pais->id }}" @if($pais->id == $entrevista->pais_id) selected @endif>{{ $pais->name }}</option>
								@endforeach
							</select>
					</div>
					<div class="col-sm-4">
						<label for="distrito">Distrito</label>
						<input type="text" class="form-control" name="distrito" placeholder="distrito" value="{{ $entrevista->distrito }}">
					</div>
					<div class="col-sm-4">
						<label for="provincia">Provincia</label>
						<input type="text" class="form-control" name="provincia" placeholder="provincia" value="{{ $entrevista->provincia }}">
						<hr>
					</div>
					<div class="col-sm-12">
						<label for="direccion">direccion</label>
						<textarea name="direccion" id="direccion" placeholder="direccion o localidad" class="form-control">{{ $entrevista->direccion }}</textarea>
					</div>

					<!-- articulos -->
					<div class="col-sm-12">
						<h4 class="padding_1em label-primary">Articulo de interes y cita</h4>
					</div>

					<div class="col-sm-3">
						<label for="">Seleccione un articulo <span class="span_rojo">*</span></label>
						<select name="articulo_id" class="form-control" required>
							<option value="">seleccione</option>
							@foreach($articulos as $articulo)
							<option value="{{ $articulo->id }}" @if($articulo->id == $entrevista->articulo_id) selected @endif>{{ $articulo->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="col-sm-3">
						<label for="precio referencial">Precio referencial </label>
						<br>
						<input type="text" class="form-control" name="precio_ref" placeholder="precio referencial.." value="{{ $entrevista->precio_ref }}">
					</div>

					<div class="col-sm-3">
						<label for="fecha_hora_cita">Fecha de cita</label>
						<br>
						<input type="text" class="form-control fecha" name="fecha" placeholder="d/m/a" id="fecha" value="{{ $entrevista->fecha }}">
						<br>
						<div id="div_fecha">
							<button type="button" class="btn btn-primary" id="btn_fecha">
								No definir
							</button>
						</div>
					</div>
					<div class="col-sm-3">
						<label for="fecha_hora_cita">Hora de cita</label>
						<br>
						<input type='text' class='form-control timepicker hora' name='hora' placeholder='h/m :s' value="{{ $entrevista->fecha }}">
						<br>
						<div id="div_hora">
							<button type="button" class="btn btn-primary" id="btn_hora">
								No Definir
							</button>
						</div>
					</div>

					@if (count($errors) > 0)
			          <div class="alert alert-danger alert-important">
				          <ul>
				            @foreach($errors->all() as $error)
				              <li>{{$error}}</li>
				            @endforeach
				          </ul>  
			          </div>
			        @endif
					
					<div class="col-sm-12 text-right">
					<hr>
						<a class="btn btn-flat btn-default" href="{{ route('entrevistas.index') }}">
							<i class="fa fa-reply"></i> Atras
						</a>
						<button class="btn btn-flat btn-primary" type="submit">
							<i class="fa fa-send"></i> Actualizar
						</button>
					</div>
				</form>
			</div>
		</div>	
@endsection
@section('script')
	<script src="{{ asset('js/entrevistas.js') }}"></script>
@endsection
