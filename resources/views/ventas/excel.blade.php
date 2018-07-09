@extends('layouts.app')
@section('title','Reporte de ventas - '.config('app.name'))
@section('content')
	@include('partials.flash')

<div class="row">
	  <div class="col-sm-4">
	    	<div class="box box-success box-solid">
		      	<div class="box-header with-border">
		        	<h3 class="box-title">
                Reporte Excel Ventas
		        	</h3>
		      	</div>
	      		<div class="box-body">
              <form action="{{ route('ventasExcel') }}" method="post">
							<input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="form-group">
                  <label for="">Desde</label>
                  <input type="text" class="form-control" id="from" placeholder="inicio" name="desde" required>
                  <!-- <p class="help-block">Help text here.</p> -->
                </div>
                <div class="form-group">
                  <label for="">Hasta</label>
                  <input type="text" class="form-control" id="to" placeholder="fin" name="hasta" required>
                  <!-- <p class="help-block">Help text here.</p> -->
                </div>
                <div class="form-group text-right">
									<span id="rve" style="display:none;">
			                <i class="fa fa-refresh fa-pulse fa-fw text-success"></i>
			            </span>
                  <button type="submit" class="btn btn-success" id="btn_busqueda">
                    <i class="fa fa-search"> Buscar</i>
                  </button>
                </div>
              </form>
				    </div>
			  </div>
		</div>
		<div class="col-sm-8" style="background-color: #ffffff; padding: 1em">
			<table class="table data-table table-bordered table-hover">
				<thead class="label-success">
					<tr>
						<th class="text-center">Nº Contrato</th>
						<th class="text-center">Vendedor</th>
						<th class="text-center">Comprador</th>
						<th class="text-center">Articulo</th>
						<th class="text-center">Precio</th>
						<th class="text-center">Fecha de Venta</th>
						<th class="text-center">Status</th>
					</tr>
				</thead>
				<tbody class="text-center">
					@foreach($ventas as $t)
						<tr>
							<td>{{$t->numero_contrato}}</td>
							<td>{{$t->user->name}}</td>
							<td>{{$t->entrevista->nombre}} {{$t->entrevista->apellido}}</td>
							<td>{{$t->articulo->name}}</td>
							<td>{{$t->precio}} {{$t->unidad->name}}</td>
							<td>{{$t->formatoCreated()}}</td>
							<td>{{$t->status->name}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>
</div>

@endsection

@section("script")
<script>

  $("#form_busqueda").on("submit", function(e) {
      e.preventDefault();
					$("#rve").fadeIn(400);
          var btn = $("#btn_busqueda");
          var token = $("#token").val();
          var ruta = '{{ route('ventasExcel') }}';

          btn.addClass("disabled");

          var form = $(this);

          $.ajax({
              url: ruta,
              headers: {'X-CSRF-TOKEN': token},
              type: 'POST',
              dataType: 'HTML',
              data: form.serialize(),
          })
          .done(function(data) {
              $("#rve").fadeOut(400);
              btn.removeClass("disabled");
          })
          .fail(function(data) {
							$("#rve").fadeOut(400);
              btn.removeClass("disabled");
              alert("error! intente de nuevo");
          })
          .always(function() {
              console.log("complete");
          });

  });
</script>
@endsection
