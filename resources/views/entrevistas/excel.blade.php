@extends('layouts.app')
@section('title','Reporte de ventas - '.config('app.name'))
@section('content')
	@include('partials.flash')

<div class="row">
	  <div class="col-sm-4">
	    	<div class="box box-success box-solid">
		      	<div class="box-header with-border">
		        	<h3 class="box-title">
                Reporte Excel Prospectos de venta
		        	</h3>
		      	</div>
	      		<div class="box-body">
              <form action="{{ route('entrevistasExcel') }}" method="post">
							<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <label for="">Desde</label>
                  <input type="text" class="form-control" id="from" placeholder="inicio" name="desde" required>
                  <!-- <p class="help-block">Help text here.</p> -->
                </div>
                <div class="form-group">
                  <label for="">Hasta</label>
                  <input type="text" class="form-control" id="to" placeholder="fin" name="hasta" required>
                  <!-- <p class="help-block">Help text here.</p> -->
                </div>
                <div class="form-group text-right">
									<span id="rve" style="display:none;">
			                <i class="fa fa-refresh fa-pulse fa-fw text-success"></i>
			            </span>
                  <button type="submit" class="btn btn-success" id="btn_busqueda">
                    <i class="fa fa-search"> Buscar</i>
                  </button>
                </div>
              </form>
				    </div>
			  </div>
		</div>
		<div class="col-sm-8" style="background-color: #ffffff; padding: 1em">
			<table class="table data-table table-bordered table-hover">
				<thead class="label-success">
					<tr>
            <th class="text-center">Nombre</th>
            <th class="text-center">Articulo</th>
            <th class="text-center">Fecha</th>
            <th class="text-center">Hora</th>
            <th class="text-center">Estatus</th>
            <th class="text-center">Descargar</th>
					</tr>
				</thead>
				<tbody class="text-center">
					@foreach($entrevistas as $t)
						<tr>
              <td>{{$t->nombre}} {{$t->apellido}}</td>
              <td>{{$t->articulo->name}}</td>
              <td>{{$t->fecha}}</td>
              <td>@if($t->hora == '') 00:00 @else {{$t->hora}} @endif</td>
              <td>{{$t->status_entre}}</td>
              <td>
                <form action="{{ url('pdf_entrevistas/'.$t->id) }}" method="GET">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger btn-sm" id="imprimir" name="id">
                  <i class="fa fa-file-pdf-o"></i> PDF
                </button>
                </form>
              </td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
</div>

@endsection
