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
					<table class="table data-table table-bordered table-hover nowrap" style="width: 100%;">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Usuario</th>
								<th class="text-center">Link de Facebook</th>
								<th class="text-center">Provincia</th>
								<th class="text-center">fecha de creacion</th>
								<th class="text-center">hora de creacion</th>
								<th class="text-center">Cantidad personas</th>
								<th class="text-center">descripcion</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($redes as $red)
								<tr>
									<td>{{ $loop->index+1 }}</td>
									<td>{{ $red->user->name }} {{ $red->user->apellido }}</td>
									<td>
										<a href="{{ $red->link_f }}" target="_blank" class="btn btn-link" onclick="Link(this);" data-value="{{ $red->id }}">
											<i class="fa fa-hand-o-up"></i> {{ $red->link_f }}
										</a>
										<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
									</td>
									<td>{{ $red->provincia->provincia }}</td>
									<td>{{ $red->fecha }}</td>
									<td>{{ $red->hora }}</td>
									<td>{{ $red->cantidad }}</td>
									<td>{{ $red->descripcion }}</td>
									<td>
										@if(Auth::user()->perfil_id == 1)
										<form class="" action="{{ route('redes.destroy', $red->id) }}" method="POST">
											{{ method_field( 'DELETE' ) }}
              								{{ csrf_field() }}
              								<button type="submit" class="btn btn-danger" onclick="return confirm('Seguro desea eliminar?');">
              									<i class="fa fa-trash"></i>
              								</button>
										</form>
										@else
										<span>(ninguna)</span>
										@endif
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
@section("script")
<script>
	
	//link de redes sociales
    function Link(ele){
			// alert($(ele).data('value'));
			 var token = $("#token").val();
			 var ruta = '{{ route('saveClick') }}';
			 $.ajax({
					 url: ruta,
					 headers: {'X-CSRF-TOKEN': token},
					 type: 'POST',
					 dataType: 'JSON',
					 data: {red_id: $(ele).data('value')},
			 })
			 .done(function(data) {
				 console.log("guardo");
			 })
			 .fail(function(data) {
			 })
			 .always(function() {
					 console.log("complete");
			 });
    }
</script>
@endsection