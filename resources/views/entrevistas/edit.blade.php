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
						<label for="telefono">Telefono <span class="span_rojo">*</span></label>
						<input type="text" class="form-control" name="telefono" placeholder="telefono" required="" value="{{ $entrevista->telefono }}">
					</div>
					<div class="col-sm-8">
						<label for="contacto">Fue contactado por <span class="span_rojo">*</span></label>
						<input type="text" class="form-control" name="contacto" placeholder="via de contacto" required="" value="{{ $entrevista->contacto }}">
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
						<label for="distrito">Distrito <span class="span_rojo">*</span></label>
						<input type="text" class="form-control" name="distrito" placeholder="distrito" value="{{ $entrevista->distrito }}">
					</div>
					<div class="col-sm-4">
						<label for="provincia">Provincia <span class="span_rojo">*</span></label>
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

					<div class="col-sm-6">
						<label for="">Seleccione un articulo <span class="span_rojo">*</span><small class="text-info"><i> <i class="fa fa-exclamation-circle"></i> Solo apareceran los articulos disponibles </i></small></label>
						<select name="articulo_id" class="form-control" required>
							<option value="">seleccione</option>
							@foreach($articulos as $articulo)
							<option value="{{ $articulo->id }}" @if($articulo->id == $entrevista->articulo_id) selected @endif>{{ $articulo->name }}</option>
							@endforeach
						</select>
					</div>

					<div class="col-sm-3">
						<label for="fecha_hora_cita">Fecha de cita <span class="span_rojo">*</span></label>
						<input type="text" class="form-control" name="fecha" placeholder="d/m/a" required="" id="fecha" value="{{ $entrevista->fecha }}">
					</div>
					<div class="col-sm-3">
						<label for="fecha_hora_cita">Hora de cita <span class="span_rojo">*</span></label>
						<input type="text" class="form-control timepicker" name="hora" placeholder="h/m :s" required="" value="{{ $entrevista->hora }}">
						<br>
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
						<a class="btn btn-flat btn-default" href="{{route('entrevistas.index')}}">
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
