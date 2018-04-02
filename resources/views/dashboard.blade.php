@extends('layouts.app')
@section('title','Inicio - '.config('app.name'))
@section('header','Inicio')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li class="active"><i class="fa fa-home" aria-hidden="true"></i> Inicio</li>
	</ol>
@endsection

@section('content')
	<div class="row">
		<div class="col-sm-12">
			<div class="padding_1em bg-primary">
				<h4>Bienvenido {{ \Auth::user()->name }}</h4>
			</div>
			<br>
		</div>
		@if(\Auth::user()->perfil_id == 1)
			<div class="col-sm-12">
				<div class="box box-danger">
			      	<div class="box-header with-border">
			        	<h3 class="box-title"><i class="fa fa-users"></i> Usuarios Online</h3>
			      	</div>
					<div class="box-body">
						<table class="table data-table table-bordered table-hover">
							<thead class="label-danger">
								<tr>
									<th class="text-center">#</th>
									<th class="text-center">Nombre y Apellido</th>
									<th class="text-center">Perfil</th>
									<th class="text-center">Online</th>
								</tr>
							</thead>
							<tbody class="text-center">
								@foreach($users as $d)
									<tr>
										<td>{{$loop->index+1}}</td>
										<td>{{$d->name}} {{$d->apellido}}</td>
										<td class="@if($d->perfil_id == 1) label-primary @else label-info @endif">{{ $d->perfil->name }}</td>
										<td>
											@if($d->online == 1)
											<span class="text-success"><i class="fa fa-check-circle text-success"></i>Conectado</span>
											@else
											<span class="text-danger">Desconectado</span>
											@endif
										</td>
									</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-sm-4 border_right_1">
				<a href="{{ url('articulos') }}">   
					<img src="{{ asset('img/dashboard_3.png') }}" alt="articulos" class="img_hover img-responsive text-center col-sm-10">
				</a>
				<span class="h3"><i>Articulos</i></span>
			</div>
			<div class="col-sm-4 border_right_1">
				<a href="{{ url('entrevistas') }}">   
					<img src="{{ asset('img/dashboard_2.png') }}" alt="entrevistas" class="img_hover img-responsive text-center col-sm-10">
				</a>
				<span class="h3"><i>Entrevistas</i></span>
			</div>
			<div class="col-sm-4">
				<a href="{{ url('ventas') }}">   
					<img src="{{ asset('img/dashboard_1.png') }}" alt="ventas" class="img_hover img-responsive text-center col-sm-10">
				</a>
				<span class="h3"><i>Ventas</i></span>
			</div>
		@else
			<div class="col-sm-4 border_right_1">
				<a href="{{ url('entrevistas') }}">   
					<img src="{{ asset('img/dashboard_2.png') }}" alt="entrevistas" class="img_hover img-responsive text-center col-sm-10">
				</a>
				<span class="h3"><i>Entrevistas</i></span>
			</div>
		@endif		
  	</div>
@endsection