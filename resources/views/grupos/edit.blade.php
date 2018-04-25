@extends('layouts.app')
@section('title','Redes Sociales - '.config('app.name'))
@section('header','Redes Sociales')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('grupos.index')}}" title="Grupos"> Redes Sociales </a></li>
	  <li class="active">Agregar</li>
	</ol>
@endsection
@section('content')
		<!-- Formulario -->
			<div class="row padding_1em">
				<div class="col-sm-12 fondo_blanco">
					<form class="" action="{{ route('grupos.update',[$grupo->id]) }}" method="POST">
						{{ method_field('PATCH') }}
						{{ csrf_field() }}
						<h4 class="padding_1em label-primary">Nueva Asignacion</h4>
						<div class="form-group {{ $errors->has('user_id')?'has-error':'' }} col-sm-4">
							<label class="control-label">Usuario: <span class="span_rojo">*</span></label>
							<select class="form-control" name="user_id" required="">
								<option value="">Seleccione</option>
								@foreach($users as $user)
								<option value="{{ $user->id }}" @if($user->id == $grupo->user_id) selected @endif>{{ $user->name }} {{ $user->apellido }}</option>
								@endforeach
							</select>	
						</div>

						<div class="form-group {{ $errors->has('facebook')?'has-error':'' }} col-sm-4">
							<label class="control-label" for="apellido">Facebook: <span class="span_rojo">*</span></label>
							<input class="form-control" type="text" name="facebook" placeholder="Facebook..." required value="{{ $grupo->facebook }}">
						</div>
						
						<div class="form-group {{ $errors->has('clave_face')?'has-error':'' }} col-sm-4">
							<label class="control-label" for="email">Clave Facebook: <span class="span_rojo">*</span></label>
							<input class="form-control" type="text" name="clave_face" placeholder="clave face..." required value="{{ $grupo->clave_face }}">
						</div>

						<div class="form-group {{ $errors->has('email')?'has-error':'' }} col-sm-4">
							<label class="control-label" for="password">Email: <span class="span_rojo">*</span></label>
							<input class="form-control" type="email" name="email" required value="{{ $grupo->email }}">
						</div>

						<div class="form-group {{ $errors->has('clave_email')?'has-error':'' }} col-sm-4">
							<label class="control-label" for="password_confirmation">Clave E-mail: <span class="span_rojo">*</span></label>
							<input class="form-control" type="text" name="clave_email" required value="{{ $grupo->clave_email }}">
						</div>

						<div class="form-group {{ $errors->has('observacion')?'has-error':'' }} col-sm-4">
							<label class="control-label" for="perfil_id">Observacion: <span class="span_rojo">*</span></label>
							<textarea class="form-control" name="observacion" required="">{{ $grupo->observacion }}</textarea>
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

						<div class="form-group text-right">
							<a class="btn btn-flat btn-default" href="{{route('grupos.index')}}"><i class="fa fa-reply"></i> Atras</a>
							<button class="btn btn-flat btn-warning" type="submit"><i class="fa fa-send"></i> Actualizar</button>
						</div>

					</form>
				</div>
			</div>
@endsection
