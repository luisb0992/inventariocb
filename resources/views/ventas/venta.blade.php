@extends('layouts.app')
@section('title','Ventas - '.config('app.name'))
@section('header','Ventas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Venta </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')

	<div class="row">
	  	<div class="col-md-12">
	    	<div class="box box-danger box-solid">
		      	<div class="box-header with-border">
		        	<h3 class="box-title">
		        		<i class="fa fa-shopping-cart"></i> 
		        		Venta para <span class="text-capitalize">{{ $entrevista->nombre }} {{ $entrevista->apellido }}</span>
		        	</h3>
		      	</div>
	      		<div class="box-body">
	      			<form action="{{ url('ventas') }}" method="POST">
	      				{{ csrf_field() }}
	      				<div class="col-sm-3">
	      					Articulo<br>
	      					<span class="h3 text-danger">
	      						{{ $entrevista->articulo->name }}
	      					</span>
	      					<input type="hidden" value="{{ $entrevista->articulo_id }}" name="articulo_id">
	      					<input type="hidden" value="{{ $entrevista->id }}" name="entrevista_id">
	      				</div>
	      				<div class="col-sm-3">
	      					Numero de Contrato<br>
		      				<span class="h3">
		      					<input type="text" class="form-control" name="numero_contrato" required>
		      				</span>	
	      				</div>
	      				<div class="col-sm-4">
	      					Precio<br>
		      				<span class="h3">
		      					<input type="text" class="form-control numero" name="precio" required value="{{ $entrevista->precio_ref }}">
		      				</span>	
	      				</div>
	      				<div class="col-sm-2">
	      					Unidad<br>
		      				<span class="h3">
		      					<select class="form-control" name="unidad_id" required="">
		      						<option value="">seleccione...</option>
		      						@foreach($unidades as $unidad)
		      						<option value="{{ $unidad->id }}">{{ $unidad->name }}</option>
		      						@endforeach
		      					</select>
		      				</span>	
	      				</div>
	      				
	      				<div class="col-sm-12"><hr></div>
	      				
	      				<div class="col-sm-12">
	      					Descripcion<br>
		      				<span class="h3">
		      					<textarea class="form-control" name="descripcion" required></textarea>
		      				</span>	
	      				</div>

	      				<div class="col-sm-12"><hr></div>

	      				<div class="col-sm-3">
	      					Entrada<br>
		      				<span class="h3">
		      					<input type="text" class="form-control numero" name="entrada" required>
		      				</span>	
	      				</div>
	      				<div class="col-sm-3">
	      					Salida<br>
		      				<span class="h3">
		      					<input type="text" class="form-control numero" name="salida" required>
		      				</span>	
	      				</div>
	      				<div class="col-sm-3">
	      					Deuda<br>
		      				<span class="h3">
		      					<input type="text" class="form-control numero" name="deuda" required>
		      				</span>	
	      				</div>
	      				<div class="col-sm-3">
	      					Status<br>
		      				<span class="h3">
		      					<select class="form-control" name="status_id" required="">
		      						<option>seleccione...</option>
		      						@foreach($status as $sta)
		      						<option value="{{ $sta->id }}">{{ $sta->name }}</option>
		      						@endforeach
		      					</select>
		      				</span>	
	      				</div>
	      				<div class="col-sm-12 text-right">
	      					<br>
		      				<button type="submit" class="btn btn-primary">
		      					<i class="fa fa-check"></i> Procesar venta
		      				</button>
	      				</div>	
	      			</form>
				</div>
			</div>
		</div>
	</div>

@endsection
@section("script")
	<script>
		$('.numero').numeric();
	</script>
@endsection