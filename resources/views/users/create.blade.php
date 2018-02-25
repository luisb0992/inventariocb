@extends('layouts.app')
@section('title','Usuarios - '.config('app.name'))
@section('header','Usuarios')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('users.index')}}" title="Usuarios"> Usuarios </a></li>
	  <li class="active">Agregar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
			<div class="row fondo_blanco padding_1em">
				<div class="col-md-6 col-md-offset-3">
					<form class="" action="{{ route('users.store') }}" method="POST" enctype="multipart/form-data">
						{{ method_field( 'POST' ) }}
						{{ csrf_field() }}
						<h4 class="padding_1em label-primary">Agregar Usuario</h4>
						<div class="form-group {{ $errors->has('name')?'has-error':'' }}">
							<label class="control-label" for="name">Nombre: *</label>
							<input id="name" class="form-control" type="text" name="name" value="{{ old('name')?old('name'):'' }}" placeholder="Nombre" required>
						</div>

						<div class="form-group {{ $errors->has('apellido')?'has-error':'' }}">
							<label class="control-label" for="apellido">Apellido: *</label>
							<input id="apellido" class="form-control" type="text" name="apellido" value="{{ old('apellido')?old('apellido'):'' }}" placeholder="Apellido" required>
						</div>
						
						<div class="form-group {{ $errors->has('email')?'has-error':'' }}">
							<label class="control-label" for="email">Email: *</label>
							<input id="email" class="form-control" type="mail" name="email" value="{{ old('email')?old('email'):'' }}" placeholder="Email" required>
						</div>

						<div class="form-group {{ $errors->has('password')?'has-error':'' }}">
							<label class="control-label" for="password">Contraseña: *</label>
							<input id="password" class="form-control" type="password" name="password" required>
						</div>

						<div class="form-group {{ $errors->has('password_confirmation')?'has-error':'' }}">
							<label class="control-label" for="password_confirmation">Verificar: *</label>
							<input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required>
						</div>

						<div class="form-group {{ $errors->has('perfil_id')?'has-error':'' }}">
							<label class="control-label" for="perfil_id">Perfil: *</label>
							<select name="perfil_id" class="form-control" required>
								<option value="">Seleccione</option>
								@foreach($perfiles as $perfil)
								<option value="{{ $perfil->id }}">{{ $perfil->name }}</option>
								@endforeach
							</select>
						</div>

						<div class="form-group {{ $errors->has('perfil_id')?'has-error':'' }}">
							<label class="control-label" for="status">Estatus: *</label>
							<select name="status" class="form-control" required>
								<option value="">Seleccione</option>
								<option value="1">Activo</option>
								<option value="2">Inactivo</option>
								<option value="3">Suspendido</option>
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

						<div class="form-group text-right">
							<a class="btn btn-flat btn-default" href="{{route('users.index')}}"><i class="fa fa-reply"></i> Atras</a>
							<button class="btn btn-flat btn-primary" type="submit"><i class="fa fa-send"></i> Guardar</button>
						</div>
					</form>
				</div>
			</div>
@endsection
