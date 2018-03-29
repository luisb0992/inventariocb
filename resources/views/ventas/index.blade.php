@extends('layouts.app')
@section('title','Ventas - '.config('app.name'))
@section('header','Ventas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Ventas </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
  	<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
        
        <div class="info-box-content">
          <span class="info-box-text">Ventas Totales</span>
          <span class="info-box-number">{{ $ventas->count() }}</span>
        </div>
        <!-- /.info-box-content -->
      </div>
      <!-- /.info-box -->
    </div>
  </div><!--row-->

	<div class="row">
	  	<div class="col-md-12">
	    	<div class="box box-danger">
		      	<div class="box-header with-border">
		        	<h3 class="box-title"><i class="fa fa-th"></i> Ventas Realizadas</h3>
		      	</div>
	      		<div class="box-body">
						<table class="table data-table table-bordered">
						<thead class="label-danger">
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Nº Contrato</th>
								<th class="text-center">Vendedor</th>
								<th class="text-center">Comprador</th>
								<th class="text-center">Articulo</th>
								<th class="text-center">Precio</th>
								<th class="text-center">Fecha de Venta</th>
								<th class="text-center">Status</th>
								<th class="text-center">Descargar</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($ventas as $t)
								<tr @if($t->status->id == 1) class="bg-success" @endif>
									<td>{{$loop->index+1}}</td>
									<td>{{$t->numero_contrato}}</td>
									<td>{{$t->user->name}}</td>
									<td>{{$t->entrevista->nombre}} {{$t->entrevista->apellido}}</td>
									<td>{{$t->articulo->name}}</td>
									<td>{{$t->precio}} {{$t->unidad->name}}</td>
									<td>{{$t->formatoCreated()}}</td>
									<td>{{$t->status->name}}</td>
									<td>
										<form action="{{ url('pdf_venta/'.$t->id) }}" method="POST">
										{{ csrf_field() }}
											<button type="submit" class="btn btn-danger btn-sm" id="imprimir" name="id">
												<i class="fa fa-file-pdf-o"></i>
											</button>
										</form>
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