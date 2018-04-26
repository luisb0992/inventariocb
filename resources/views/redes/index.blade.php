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
						<a href="#nuevo_red" class="btn btn-lg btn-success" data-toggle="modal" data-target="#nuevo_red">
							<i class="fa fa-plus" aria-hidden="true"></i> Nuevo
						</a>
					</span>
					@include('redes.modal_nueva_red')
		      	</div>
	      		<div class="box-body">
					<table class="table data-table table-bordered table-hover">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Usuario</th>
								<th class="text-center">Link de Facebook</th>
								<th class="text-center">fecha de creacion</th>
								<th class="text-center">hora de creacion</th>
								<th class="text-center">Cantidad personas</th>
								<th class="text-center">descripcion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($redes as $red)
								<tr>
									<td>{{ $loop->index+1 }}</td>
									<td>{{ $red->user->name }} {{ $red->user->apellido }}</td>
									<td>
										<a href="{{ $red->link_f }}" target="blank" class="btn btn-link">
											<i class="fa fa-hand-o-up"></i> {{ $red->link_f }}
										</a>
									</td>
									<td>{{ $red->fecha }}</td>
									<td>{{ $red->hora }}</td>
									<td>{{ $red->cantidad }}</td>
									<td>{{ $red->descripcion }}</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection