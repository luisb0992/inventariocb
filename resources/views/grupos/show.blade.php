@extends('layouts.app')
@section('title','Grupos - '.config('app.name'))
@section('header','Grupos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Grupos </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	
	<div class="row">
	  	<div class="col-md-12">
	    	<div class="box box-danger box-solid">
	      		<div class="box-body">
	      			@if($grupo)
					<table class="table data-table table-bordered table-hover">
						<thead>
							<tr>
								<th class="text-center">Facebook</th>
								<th class="text-center">clave Facebook</th>
								<th class="text-center">Email</th>
								<th class="text-center">Clave Email</th>
								<th class="text-center">Observacion</th>
							</tr>
						</thead>
						<tbody class="text-center">
								<tr>
									<td>{{ $grupo->facebook }}</td>
									<td>{{ $grupo->clave_face }}</td>
									<td>{{ $grupo->email }}</td>
									<td>{{ $grupo->clave_email }}</td>
									<td>{{ $grupo->observacion }}</td>
								</tr>
						</tbody>
					</table>
					@else
						 <div class="alert alert-warning">
					      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					      <strong class="text-center">Actualmente no tiene grupos asignados</strong> 
					  	</div>
					@endif
				</div>
			</div>
		</div>
	</div>
@endsection