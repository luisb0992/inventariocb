@extends('layouts.app')
@section('title','Articulos - '.config('app.name'))
@section('header','Articulos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li><a href="{{route('articulos.index')}}" title="Articulos"> Articulos </a></li>
	  <li class="active">Editar</li>
	</ol>
@endsection
@section('content')
		
		@include("articulos.rutasDinamicas")
		<!-- Formulario -->
		<div class="row padding_1em">
			<div class="col-md-12 fondo_blanco">
				<form class="" action="{{ route('articulos.update',[$articulo->id])}}" method="POST">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
					<h4 class="padding_1em label-warning">Editar Articulo</h4>
					<!-- contenido -->
					<section class="padding_1em">
						<div class="col-sm-4">
							<label for="nombre">Titulo <span class="span_rojo">*</span></label>	
							<input type="text" class="form-control" name="name" value="{{ $articulo->name }}" required="">
						</div>

						<!-- modelos  -->
						<div class="col-sm-4">
							<label for="modelo">
								Modelo <span class="span_rojo">*</span>&nbsp;
								[<a href="#create_modelo" class="btn-link" data-toggle="modal" data-target="#create_modelo">
									<span class="text-success"><i class="fa fa-plus"></i> agregar</span>
								</a>] 
								<span id="modelo_listo" style="display: none"> <small id="msj_ajax"></small></span>
								@include('articulos.modal_create_modelos')
							</label>
							<select name="modelo_id" id="select_modelo" class="form-control" required="">
								@foreach($modelos as $model)
								<option value="{{ $model->id }}" @if($model->id == $articulo->modelo_id) selected @endif>{{ $model->name }}</option>
								@endforeach
							</select>
						</div>

						<!-- colores  -->
						<div class="col-sm-4">
							<label for="color">
								Color de tela <span class="span_rojo">*</span>&nbsp;
								[<a href="#create_color" class="btn-link" data-toggle="modal" data-target="#create_color">
									<span class="text-success"><i class="fa fa-plus"></i> agregar</span>
								</a>] 
								<span id="color_listo" style="display: none"> <small id="msj_ajax_color"></small></span>
								@include('articulos.modal_create_colores')
							</label>
							<select name="color_id" class="select_color form-control" required="">
								@foreach($colores as $color)
								<option value="{{ $color->id }}" @if($color->id == $articulo->color_id) selected @endif>{{ $color->name }}</option>
								@endforeach
							</select>
							<hr>
						</div>

						<div class="col-sm-6">
							<label for="color">
								Color de tubo <span class="span_rojo">*</span>&nbsp;
							</label>
							<input type="text" value="{{ $articulo->color_tubo }}" class="form-control" name="color_tubo">
							<hr>
						</div>

						<div class="col-sm-6">
							<label for="telefono">Cantidad <span class="span_rojo">*</span></label>
							<input type="text" class="form-control" name="cantidad" value="{{ $articulo->cantidad }}" required="">
						</div>
						<div class="col-sm-12">
							<label for="observacion">Observacion</label>
							<textarea name="observacion" id="observacion" placeholder="descripcion u observacion" class="form-control">{{ $articulo->observacion }}</textarea>
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
						
						<div class="col-sm-12 text-right padding_1em">
							<a class="btn btn-flat btn-default" href="{{route('articulos.index')}}">
								<i class="fa fa-reply"></i> Atras
							</a>
							<button class="btn btn-flat btn-primary" type="submit">
								<i class="fa fa-send"></i> Actualizar
							</button>
						</div>
					</section>
				</form>
			</div>
		</div>
@endsection
@section('script')
	<script src="{{ asset('js/articulo.js') }}"></script>
@endsection
