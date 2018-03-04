@extends('layouts.app')
@section('title','Entrevistas - '.config('app.name'))
@section('header','Entrevistas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Entrevistas </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
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
    	<div class="box box-danger">
	      <div class="box-header with-border">
	        <span class="pull-left">
				<a href="{{ route('entrevistas.create') }}" class="btn btn-flat btn-lg btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nueva</a>
			</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Nombre y Apellido</th>
								<th class="text-center">Articulo</th>
								<th class="text-center">Fecha</th>
								<th class="text-center">Hora</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($entrevistas as $t)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td>{{$t->nombre}} {{$t->apellido}}</td>
									<td>{{$t->articulo->name}}</td>
									<td>{{$t->fecha}}</td>
									<td>{{$t->hora}}</td>
									<td>
										<!-- <a class="btn btn-primary btn-flat btn-sm" href="{{ route('users.show',[$t->id])}}"><i class="fa fa-search"></i></a>-->
										<a href="{{route('entrevistas.edit',[$t->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a> 
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
@endsection