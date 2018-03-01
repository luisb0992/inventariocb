@extends('layouts.app')
@section('title','Usuarios - '.config('app.name'))
@section('header','Usuarios')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Usuarios </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<div class="alert alert-success" style="display:none" id="msj_alert_done">
		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<strong class="text-center">Actualizado con exito!</strong>
		<span><i class="fa fa-refresh fa-pulse fa-fw"></i></span>
	</div>
	<!-- Info boxes -->
  <div class="row">
  	<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
        
        <div class="info-box-content">
          <span class="info-box-text">Usuarios</span>
          <span class="info-box-number">{{ count($users) }}</span>
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
	        <h3 class="box-title"><i class="fa fa-users"></i> Usuarios</h3>
	        <span class="pull-right">
						<a href="{{ route('users.create') }}" class="btn btn-flat btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Nuevo usuario</a>
					</span>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover table-condensed">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Nombre y Apellido</th>
								<th class="text-center">Email</th>
								<th class="text-center">Perfil</th>
								<th class="text-center">Estatus</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($users as $d)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td>{{$d->name}} {{$d->apellido}}</td>
									<td>{{$d->email}}</td>
									<td class="@if($d->perfil_id == 1) label-primary @else label-info @endif">{{ $d->perfil->name }}</td>
									<td class="	@if($d->status == 1) 
													label-success 
												@elseif($d->status == 2) 
													label-warning 
												@elseif($d->status == 3) 
													label-danger 
												@endif">

											{{$d->nameStatus()}}
										<button type="button" id="btn_status" value="{{ $d->id }}" 
										data-toggle="modal" data-target="#modal_edit_status" 
										aria-expanded="false" aria-controls="modal_edit_status" 
										class="btn pull-right btn-default" onclick="MostrarStatus(this);">
											<span class="">
												<i class="glyphicon glyphicon-pencil" aria-hidden="true"></i>
											</span>	
										</button>
										@include('partials.modal_edit_status')	
									</td>
									<td>
										<a class="btn btn-primary btn-flat btn-sm" href="{{ route('users.show',[$d->id])}}"><i class="fa fa-search"></i></a>
										<a href="{{route('users.edit',[$d->id])}}" class="btn btn-flat btn-success btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
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
	<script>
		// buscar status del usuario
		function MostrarStatus(btn_status){
		  var ruta = "users_status/"+btn_status.value;
		  $("#reload").fadeIn('slow/400/fast');
		  $.get(ruta, function(res){
		    if (res.status == 1) {
		    	$("#status_name").text("Activo");
		    }else if(res.status == 2){
		    	$("#status_name").text("Inactivo");
		    }else if(res.status == 3){
		    	$("#status_name").text("Suspendido");
		    }
		    $("#id_user").val(res.id);
		  });
		  $("#reload").fadeOut('slow/400/fast');
		}

		// actualizar status
		$('#form_edit_status').on("submit", function(ev) {
		  ev.preventDefault();
		  var form = $(this);
		  var ruta = "update_status/"+$("#id_user").val();
		  var btn = $('.btn_edit_status');
		  btn.text('Espere...');
		  
		  $.ajax({
		    url: ruta,
		    headers: {'X-CSRF-TOKEN': $("#token").val()},
		    type: 'PUT',
		    dataType: 'JSON',
		    data: form.serialize(),
		  })
		  .done(function() {
		    $("#modal_edit_status").modal('toggle');
		    $("#msj_alert_done").fadeIn('slow/400/fast').fadeOut(5000);
		    location.reload(2000);
		  })
		  .fail(function(msj) {
		      $("#modal_edit_status").modal('toggle');
		      btn.text('Actualizar');
		  })
		});
	</script>
@endsection