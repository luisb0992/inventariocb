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
		<!-- Formulario -->
		<div class="row padding_1em">
			<div class="col-md-6 col-md-offset-3 fondo_blanco">
				<form class="" action="{{ route('articulos.update',[$articulo->id])}}" method="POST">
					{{ method_field('PATCH') }}
					{{ csrf_field() }}
					<h4 class="padding_1em label-warning">Editar Articulo</h4>
					<!-- contenido -->
					<section class="padding_1em ">
						<div class="col-sm-4">
							<label for="nombre">Titulo <span class="span_rojo">*</span></label>	
							<input type="text" class="form-control" name="name" value="{{ $articulo->name }}" required="">
						</div>
						<div class="col-sm-4">
							<label for="modelo">
								Modelo <span class="span_rojo">*</span>&nbsp;
								[<a href="#" class="btn-link text-right">
									<span class="text-success"><i class="fa fa-plus"></i> agregar</span>
								</a>]
							</label>
							<select name="modelo_id" id="modelo" class="form-control" required="">
								@foreach($modelos as $model)
								<option value="{{ $model->id }}" @if($model->id == $articulo->modelo_id) selected @endif>{{ $model->name }}</option>
								@endforeach
							</select>
							<!-- <input type="text" class="form-control" name="model_id" placeholder="modelo" required=""> -->
						</div>
						<div class="col-sm-4">
							<label for="color">Color <span class="span_rojo">*</span>&nbsp;
								[<a href="#" class="btn-link text-right">
									<span class="text-success"><i class="fa fa-plus"></i> agregar</span>
								</a>]
							</label>
							<select name="color_id" id="modelo" class="form-control" required="">
								@foreach($colores as $color)
								<option value="{{ $color->id }}" @if($color->id == $articulo->color_id) selected @endif>{{ $color->name }}</option>
								@endforeach
							</select>
							<!-- <input type="email" class="form-control" name="email" placeholder="email" required=""> -->
							<hr>
						</div>
						<div class="col-sm-4">
							<label for="telefono">Cantidad <span class="span_rojo">*</span></label>
							<input type="text" class="form-control" name="cantidad" value="{{ $articulo->cantidad }}" required="">
						</div>
						<div class="col-sm-8">
							<label for="observacion">Observacion</label>
							<textarea name="observacion" id="observacion" placeholder="descripcion u observacion" class="form-control">{{ $articulo->observacion }}</textarea>
							<hr>
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
