@extends('layouts.app')
@section('title','Entrevistas - '.config('app.name'))
@section('header','Entrevistas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('entrevistas.index')}}" title="Entrevistas"> Entrevistas </a></li>
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
						<h4 class="padding_1em label-primary">Datos Personales</h4>
					</div>
					
					<div class="col-sm-4">
						<label for="nombre">Nombre</label>	
						<input type="text" class="form-control" name="nombre" placeholder="nombre" required="">
					</div>
					<div class="col-sm-4">
						<label for="apellido">Apellido</label>
						<input type="text" class="form-control" name="apellido" placeholder="apellido" required="">
					</div>
					<div class="col-sm-4">
						<label for="email">Email</label>
						<input type="email" class="form-control" name="email" placeholder="email" required="">
						<hr>
					</div>
					<div class="col-sm-4">
						<label for="telefono">Telefono</label>
						<input type="text" class="form-control" name="telefono" placeholder="telefono" required="">
					</div>
					<div class="col-sm-8">
						<label for="contacto">Fue contactado por</label>
						<input type="text" class="form-control" name="contacto" placeholder="via de contacto" required="">
						<hr>
					</div>
					<div class="col-sm-4">
						<label for="pais">Pais</label>
							<select name="pais_id" class="form-control" required="">
								<option value="">Seleccione...</option>
								@foreach($paises as $pais)
								<option value="{{ $pais->id }}">{{ $pais->name }}</option>
								@endforeach
							</select>
					</div>
					<div class="col-sm-4">
						<label for="distrito">Distrito</label>
						<input type="text" class="form-control" name="distrito" placeholder="distrito" required="">
					</div>
					<div class="col-sm-4">
						<label for="provincia">Provincia</label>
						<input type="text" class="form-control" name="provincia" placeholder="provincia" required="">
						<hr>
					</div>
					<div class="col-sm-12">
						<label for="direccion">direccion</label>
						<textarea name="direccion" id="direccion" placeholder="direccion de localidad" class="form-control" required=""></textarea>
					</div>

					<!-- articulos -->
					<div class="col-sm-12">
						<h4 class="padding_1em label-primary">Articulo de interes</h4>
					</div>

					<div class="col-sm-6">
						<label for="">Seleccione un articulo</label>
						<select name="articulo_id" class="form-control" required>
							<option value="">seleccione</option>
							@foreach($articulos as $articulo)
							<option value="{{ $articulo->id }}">{{ $articulo->name }}</option>
							@endforeach
						</select>
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
							<i class="fa fa-send"></i> Guardar
						</button>
					</div>
				</form>
			</div>
		</div>	
@endsection
