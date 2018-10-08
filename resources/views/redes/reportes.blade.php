@extends('layouts.app')
@section('title','Reportes - '.config('app.name'))
@section('header','Reportes')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Reportes </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')

  <div class="row fondo_blanco padding_1em">
    <div class="col-sm-12">
      <form action="{{ route('busqueda_click') }}" class="form-inline" method="POST">
        {{ method_field( 'POST' ) }}
        {{ csrf_field() }}

        <fieldset class="form-group">
          <label for="usuario">Usuario</label>
          <select class="form-control" name="user_id" required>
            @foreach($users as $u)
            <option value="{{$u->id}}">{{ $u->name }}</option>
            @endforeach
          </select>
        </fieldset>

        &nbsp;&nbsp;&nbsp;

        <fieldset class="form-group">
          <label for="fecha">Fecha</label>
					<input type="text" class="form-control fecha" name="fecha" placeholder="d/m/a" id="fecha" required>
        </fieldset>

        <button type="submit" class="btn btn-primary">Buscar</button>
      </form>
    </div>
  </div>
  <hr>
	<div class="row">
	  	<div class="col-md-12">
	    	<div class="box box-danger">
		      	<div class="box-header with-border">
		      	</div>
	      		<div class="box-body">
					<table class="table data-table table-bordered table-hover">
						<thead>
							<tr>
								<th class="text-center">Usuario</th>
								<th class="text-center">Link de Facebook</th>
								<th class="text-center">Fecha</th>
								<th class="text-center">Hora</th>
								<th class="text-center">Provincia</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($reportes as $r)
								<tr>
									<td>{{ $r->user->name }} {{ $r->user->apellido }}</td>
									<td>
					                    <a href="{{ $r->red->link_f }}" target="_blank" class="btn btn-link">
											<i class="fa fa-hand-o-up"></i> {{ $r->red->link_f }}
										</a>
				                  	</td>
									<td>{{ $r->fecha }}</td>
									<td>{{ $r->hora }}</td>
									<td>{{ $r->red->provincia->provincia }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection