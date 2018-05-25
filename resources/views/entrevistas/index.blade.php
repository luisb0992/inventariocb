@extends('layouts.app')
@section('title','Entrevistas - '.config('app.name'))
@section('header','Entrevistas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Prospectos </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')

	<a href="{{ url('cargarEntrevistas') }}" class="hidden" id="ruta_ver_entrevistas"></a>
	<a href="{{ url('cargarEntrevistaOne') }}" class="hidden" id="ruta_ver_entrevista_one"></a>
	<a href="{{ url('guardarComentario') }}" id="ruta_crear_comentario" class="hide"></a>
	<!-- Info boxes -->
  <div class="row">
  	<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-list-alt"></i></span>
        
        <div class="info-box-content">
          <span class="info-box-text">Entrevistas Realizadas</span>
          <span class="info-box-number">{{ $entrevistas->count() }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div><!--row-->

	<div class="row">
  	<div class="col-md-12">
  		<div id="coment_listo" style="display:none">
  			<p id="msj-ajax"></p>
  		</div>
    	<div class="box box-danger">
	      <div class="box-header with-border">
	        <span class="pull-left">
				<a href="{{ route('entrevistas.create') }}" class="btn btn-flat btn-lg btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva</a>
			</span>
	      </div>
      	<div class="box-body">
      				<div id="reload_active" style="display: none" class="text-center">
						<i class="fa fa-refresh fa-spin fa-3x fa-fw text-success"></i>
					</div>
					<div class="col-sm-12 bg-danger">
						<h3>Mis entrevistas</h3>
					</div>	
					<table class="table data-table table-bordered table-hover">
						<thead class="label-danger">
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Nombre y Apellido</th>
								<th class="text-center">Articulo</th>
								<th class="text-center">Modelo</th>
								<th class="text-center">Color</th>
								<th class="text-center">C. Tubo</th>
								<th class="text-center">Fecha</th>
								<th class="text-center">Hora</th>
								<th class="text-center">Descargar</th>
								<th class="text-center">Venta</th>
								<th class="text-center" style="width: 300px">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($entrevistas as $t)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td>{{$t->nombre}} {{$t->apellido}}</td>
									<td>{{$t->articulo->name}}</td>
									<td>{{$t->articulo->modelo->name}}</td>
									<td>{{$t->articulo->color->name}}</td>
									<td>{{$t->articulo->color_tubo}}</td>
									<td>{{$t->fecha}}</td>
									<td>@if($t->hora == '') 00:00 @else {{$t->hora}} @endif</td>
									<td>
										<form action="{{ url('pdf_entrevistas/'.$t->id) }}" method="GET">
										{{ csrf_field() }}
										<button type="submit" class="btn btn-danger btn-sm" id="imprimir" name="id">
											<i class="fa fa-file-pdf-o"></i> PDF
										</button>
										</form>
									</td>
									<td class="well">
										@if($t->venta($t->id) == 1)
											<i class="fa fa-check-circle text-success"></i> Vendida
										@elseif($t->venta($t->id) == 2)
											<i class="fa fa-check-circle text-success"></i> Separado
										@elseif($t->venta($t->id) == 3)	
											<i class="fa fa-folder text-warning"></i> Seguimiento
										@elseif($t->venta($t->id) == 4)	
											<i class="fa fa-long-arrow-right text-warning"></i> En espera
										@else
											<a href="{{ url('vender/'.$t->id) }}" class="btn btn-info btn-sm">
												<i class="fa fa-shopping-cart"></i> Procesar
											</a>
										@endif
									</td>
									<td>
										<button type="button" class="btn btn-primary btn-flat btn-sm" data-toggle="modal" data-target="#ver_entrevistas" id="btn_ver_entrevistas" value="{{ $t->id }}" onclick="cargarEntrevistas(this);">
			                    			<i class="fa fa-eye"></i> Ver y editar
			                    		</button>
			                    		@include('entrevistas.modal_ver_entrevistas')

			                    		<button type="button" class="btn btn-success btn-flat btn-sm" data-toggle="modal" data-target="#nuevo_comentario" id="btn_nuevo_comentario" value="{{ $t->id }}" onclick="cargarComentarios(this);">
			                    			<i class="fa fa-plus"></i> <i class="fa fa-comments"></i> comentario
			                    		</button>
			                    		@include('entrevistas.modal_nuevo_comentario')

			                    		@if(\Auth::user()->perfil_id == 1)
										<a href="{{ url('eliminarEntrevista/'.$t->id) }}" class="btn btn-danger btn-sm" onclick="return confirm('Desea eliminar S/N?');"><i class="fa fa-remove"></i> Eliminar</a>
										@endif 
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('script')
	<script src="{{ asset('js/entrevistas.js') }}"></script>
@endsection