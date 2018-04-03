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
    	<div class="box box-danger">
	      	<div class="box-header with-border">
	        	<span class="pull-left">
					<a href="{{ route('grupos.create') }}" class="btn btn-flat btn-lg btn-success">
						<i class="fa fa-plus" aria-hidden="true"></i> Nuevo
					</a>
				</span>
	      	</div>
      		<div class="box-body">
				<table class="table data-table table-bordered table-hover">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-center">Nombre y Apellido</th>
							<th class="text-center">Facebook</th>
							<th class="text-center">clave Facebook</th>
							<th class="text-center">Email</th>
							<th class="text-center">Clave Email</th>
							<th class="text-center">Observacion</th>
							<th class="text-center">Accion</th>
						</tr>
					</thead>
					<tbody class="text-center">
						@foreach($grupos as $d)
							<tr>
								<td>{{ $loop->index+1 }}</td>
								<td>{{ $d->user->name }} {{ $d->user->apellido }}</td>
								<td>{{ $d->facebook }}</td>
								<td>{{ $d->clave_face }}</td>
								<td>{{ $d->email }}</td>
								<td>{{ $d->clave_email }}</td>
								<td>{{ $d->observacion }}</td>
								<td>
									<!--<a href="{{route('users.edit',[$d->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>-->
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