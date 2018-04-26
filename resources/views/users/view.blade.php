@extends('layouts.app')
@section('title','Usuario - '.config('app.name'))
@section('header','Usuario')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li> Usuarios </li>
	  <li class="active">Ver </li>
	</ol>
@endsection
@section('content')
	<section>
    <a class="btn btn-flat btn-default" href="{{ route('users.index') }}"><i class="fa fa-reply" aria-hidden="true"></i> Volver</a>
    <a class="btn btn-flat btn-success" href="{{ route('users.edit',[$user->id]) }}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar</a>
    <button class="btn btn-flat btn-danger" data-toggle="modal" data-target="#delModal"><i class="fa fa-times" aria-hidden="true"></i> Eliminar</button>
	</section>

	<section class="perfil">
		<div class="row">
	    	<div class="col-md-12">
	    		<h2 class="page-header" style="margin-top:0!important">
		          <i class="fa fa-user" aria-hidden="true"></i>
		          {{ $user->name }}
		          <small class="pull-right">Registrado: {{ $user->created_at }}</small>
		          <span class="clearfix"></span>
		        </h2>
	    	</div>
			<div class="col-md-6 list-group">
				<h4>Detalles del Usuario</h4>
        		<p class="list-group-item"><b>Nombre: </b> {{$user->name}} </p>
				<p class="list-group-item"><b>Apellido: </b> {{$user->apellido}} </p>
		        <p class="list-group-item"><b>Email: </b> {{$user->email}} </p>
		        <p class="list-group-item"><b>Perfil: </b> {{$user->perfil->name}} </p>
		        <p class="list-group-item"><b>Estatus Actual: </b> {{$user->nameStatus()}} </p>
			</div>
			<div class="col-md-6 list-group">
				<h4>Actividad en Littlebru</h4>
        		<p class="list-group-item"><b>Entrevistas realizadas </b> 
        			<span class="badge" style="background-color: green;">{{ $entrevista->count() }}</span> 
        		</p>
				<p class="list-group-item"><b>Ventas </b> 
					<span class="badge" style="background-color: green;">{{ $venta->count() }} </span> 
				</p>
		        <p class="list-group-item"><b>Grupos </b> 
		        	<span class="badge" style="background-color: green;"> {{ $red->count() }} </span>
		        </p>	
		        <p class="list-group-item"><b>Redes </b> 
		        	<span class="badge" style="background-color: green;"> {{ $grupo->count() }} </span> 
		        </p>
			</div>
			<div class="col-sm-12">
        		<div class="box box-danger box-solid">
			      	<div class="box-header with-border">
			        	<span class="text-center">
			        		<h3>Entrevistas</h3>
						</span>
			      	</div>
		      		<div class="box-body">
		      			<table class="table data-table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Comprador</th>
									<th class="text-center">Articulo</th>
									<th class="text-center">Status</th>
								</tr>
							</thead>
							<tbody class="text-center">
								@foreach($entrevista as $entre)
									<tr>
										<td>{{ $entre->vendedor->name }} {{ $entre->vendedor->apellido }}</td>
										<td>{{ $entre->articulo->name }}</td>
										<td class="well">
											@if($entre->status == 1)
												<i class="fa fa-check-circle text-success"></i> Vendida
											@elseif($entre->status == 2)
												<i class="fa fa-check-circle text-success"></i> Separado
											@elseif($entre->status == 3)	
												<i class="fa fa-folder text-warning"></i> Seguimiento
											@elseif($entre->status == 4)	
												<i class="fa fa-long-arrow-right text-warning"></i> En espera
											@endif
										</td>
									</tr>
								@endforeach	
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
        		<div class="box box-primary box-solid">
			      	<div class="box-header with-border">
			        	<span class="text-center">
			        		<h3>Ventas</h3>
						</span>
			      	</div>
		      		<div class="box-body">
		      			<table class="table data-table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Articulo</th>
									<th class="text-center">Precio</th>
									<th class="text-center">Status</th>
								</tr>
							</thead>
							<tbody class="text-center">
								@foreach($venta as $ven)
									<tr>
										<td>{{ $ven->articulo->name }}</td>
										<td>{{ $ven->precio }} {{ $ven->unidad->name }}</td>
										<td>{{ $ven->status->name }}</td>
									</tr>
								@endforeach	
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
        		<div class="box box-success box-solid">
			      	<div class="box-header with-border">
			        	<span class="text-center">
			        		<h3>Grupos</h3>
						</span>
			      	</div>
		      		<div class="box-body">
		      			<table class="table data-table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Facebook</th>
									<th class="text-center">Cantidad de personas</th>
									<th class="text-center">Descripcion</th>
								</tr>
							</thead>
							<tbody class="text-center">
								@foreach($red as $r)
									<tr>
										<td>
											<a href="{{ $r->link_f }}" class="btn btn-link">
												{{ $r->link_f }}
											</a>	
										</td>
										<td>{{ $r->cantidad }}</td>
										<td>{{ $r->descripcion }}</td>
									</tr>
								@endforeach	
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-sm-12">
        		<div class="box box-warning box-solid">
			      	<div class="box-header with-border">
			        	<span class="text-center">
			        		<h3>Redes Sociales</h3>
						</span>
			      	</div>
		      		<div class="box-body">
		      			<table class="table data-table table-bordered table-hover">
							<thead>
								<tr>
									<th class="text-center">Facebook</th>
									<th class="text-center">E-mail</th>
									<th class="text-center">Observacion</th>
								</tr>
							</thead>
							<tbody class="text-center">
								@foreach($grupo as $grup)
									<tr>
										<td>{{ $grup->facebook }}</td>
										<td>{{ $grup->email }}</td>
										<td>{{ $grup->observacion }}</td>
									</tr>
								@endforeach	
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>


	<div id="delModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="delModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="delModalLabel">Eliminar usuario</h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <form class="col-md-8 col-md-offset-2" action="{{ route('users.destroy',[$user->id])}}" method="POST">
              {{ method_field( 'DELETE' ) }}
              {{ csrf_field() }}
              <h4 class="text-center">¿Esta seguro de eliminar este usuario?</h4><br>

              <center>
                <button class="btn btn-flat btn-danger" type="submit">Eliminar</button>
                <button type="button" class="btn btn-flat btn-default" data-dismiss="modal">Cerrar</button>
              </center>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection