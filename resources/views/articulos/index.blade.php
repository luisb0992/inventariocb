@extends('layouts.app')
@section('title','Articulos - '.config('app.name'))
@section('header','Articulos')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Articulos </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	
	<a href="{{ url('editarImagen') }}" class="hide" id="ruta_editar_imagen"></a>
	<a href="{{ url('updateImagen') }}" class="hide" id="ruta_guardar_imagen"></a>

<!-- Info boxes -->
  <div class="row">
  	<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-th"></i></span>
        
        <div class="info-box-content">
          <span class="info-box-text">Articulos Registrados</span>
          <span class="info-box-number">{{ $articulos->count() }}</span>
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
				<a href="{{ route('articulos.create') }}" class="btn btn-flat btn-lg btn-success">
					<i class="fa fa-plus" aria-hidden="true"></i> Nuevo
				</a>
			</span>
			<div id="img_done" class="alert alert-success" style="display:none">
				<p id="msj_img"></p>
			</div>
	      </div>
      	<div class="box-body">
					<table class="table data-table table-bordered table-hover">
						<thead>
							<tr>
								<th class="text-center">#</th>
								<th class="text-center">Titulo</th>
								<th class="text-center">Modelo</th>
								<th class="text-center">C. tela</th>
								<th class="text-center">C. tubo</th>
								<th class="text-center">Cantidad</th>
								<th class="text-center">Descripcion</th>
								<th class="text-center">Imagen</th>
								<th class="text-center">Accion</th>
							</tr>
						</thead>
						<tbody class="text-center">
							@foreach($articulos as $art)
								<tr>
									<td>{{$loop->index+1}}</td>
									<td>{{$art->name}}</td>
									<td>{{$art->modelo->name}}</td>
									<td>{{$art->color->name}}</td>
									<td>{{$art->color_tubo}}</td>
									<td>{{$art->cantidad}}</td>
									<td>@if($art->observacion == "") ... @else {{$art->observacion}} @endif</td>
									<td>
										@include('articulos.modal_editar_imagen')
										@if($art->img)
										<a href="{{ url("articulos/img/$art->id.$art->img") }}" data-toggle="lightbox" data-max-width="600" id="img">
											<img style="max-width: 30%; max-height: 30%;" src="{{ url("articulos/img/$art->id.$art->img") }}" 
										class="img-rounded center-block img-responsive">
										</a>
										@else
										<a href="{{ asset('img/sin_imagen.jpg') }}" data-toggle="lightbox" data-max-width="600" id="img">
											<img style="max-width: 30%; max-height: 30%;" src="{{ asset('img/sin_imagen.jpg') }}" 
										class="img-rounded center-block img-responsive">
										</a>
										@endif
										<br>
										<button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editar_imagen" id="btn_edit_imagen" value="{{ $art->id }}" onclick="editarImagen(this);">
											<i class="fa fa-edit"></i> editar imagen
										</button>
									</td>
									<td>
										<a href="{{route('articulos.edit',[$art->id])}}" class="btn btn-flat btn-warning btn-sm" title="Editar"><i class="fa fa-edit"></i></a>
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
	
	$(document).on('click', '[data-toggle="lightbox"]', function(event) {
        event.preventDefault();
        $(this).ekkoLightbox();
    });

    function editarImagen(btn_edit_imagen){
    	var ruta = $('#ruta_editar_imagen').attr('href')+"/"+btn_edit_imagen.value;
    	var ruta2 = $('#ruta_guardar_imagen').attr('href')+"/"+btn_edit_imagen.value;
    	
    	$("#reload_div_img").fadeIn(400, 'linear');
    	
    	$.get(ruta, function(res){
    		$("#articulo_id").val(res.id);
    		$("#form_img").attr('action', ruta2);
    		$("#imagen_div").fadeIn(400, 'linear');
    		$("#reload_div_img").fadeOut(400, 'linear');
    	});

    }
    
    $(".btn_guardar_img").click(function(e){
    	$("#reload_img").fadeIn( 400, 'linear');
		var btn = $(".btn_guardar_img");
		btn.text("Espere un momento...");
		btn.addClass("disabled");
    });

</script>
@endsection