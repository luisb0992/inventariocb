@extends('layouts.app')
@section('title','Inventario - '.config('app.name'))
@section('header','Control e Inventario')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Inventario </li>
	</ol>
@endsection

@section('content')
	@include('partials.flash')

	<!-- Info boxes -->
	<div class="row">
	  	<div class="col-sm-3 col-xs-12">
	      	<div class="info-box">
	        	<span class="info-box-icon bg-red"><i class="fa fa-cubes"></i></span>
	        	<div class="info-box-content">
	          		<span class="info-box-text">Articulos</span>
	          		<span class="info-box-number">{{ $articulos->count() }}</span>
	        	</div>   
	      	</div>
	    </div>
	    <div class="col-sm-3 col-xs-12">
	      	<div class="info-box">
	        	<span class="info-box-icon bg-green"><i class="fa fa-list-alt"></i></span>
	        	<div class="info-box-content">
	          		<span class="info-box-text">Entrevistas</span>
	          		<span class="info-box-number">{{ $entrevistas }}</span>
	        	</div>   
	      	</div>
	    </div>
	    <div class="col-sm-3 col-xs-12">
	      	<div class="info-box">
	        	<span class="info-box-icon bg-blue"><i class="fa fa-check-circle"></i></span>
	        	<div class="info-box-content">
	          		<span class="info-box-text">Ventas</span>
	          		<span class="info-box-number">{{ $ventas }}</span>
	        	</div>   
	      	</div>
	    </div>
	    <div class="col-sm-3 col-xs-12">
	      	<div class="info-box">
	        	<span class="info-box-icon bg-orange"><i class="fa fa-users"></i></span>
	        	<div class="info-box-content">
	          		<span class="info-box-text">Usuarios</span>
	          		<span class="info-box-number">{{ $users->count() }}</span>
	        	</div>   
	      	</div>
	    </div>
	</div>

	<hr>

	<div class="row">
  		<div class="col-sm-3">
      		<div class="box box-solid box-primary">
	            <div class="box-header">
	            	<h3 class="box-title">
	            		Ventas de este mes 
	            		<b>(@php $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); echo $meses[date('n')-1]; @endphp)</b>
	            	</h3>	
	            </div>
	            <div class="box-body">
	                <span class="list-group-item">Entregadas <strong class="pull-right badge">{{ $artMesUno->count() }}</strong> </span>
	                <span class="list-group-item">Separadas <strong class="pull-right badge">{{ $artMesDos->count() }}</strong> </span>
	                <span class="list-group-item">Segumiento <strong class="pull-right badge">{{ $artMesTres->count() }}</strong> </span>
	                <span class="list-group-item">En espera <strong class="pull-right badge">{{ $artMesCuatro->count() }}</strong> </span>
	            </div>			
			</div>
		</div>
		<div class="col-sm-3">
      		<div class="box box-solid box-primary">
	            <div class="box-header">
	            	<h3 class="box-title">
	            		Usuarios con ventas este Mes  
	            		<b>(@php $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); echo $meses[date('n')-1]; @endphp)</b>
	            	</h3>	
	            </div>
	            <div class="box-body">
	                @foreach($users as $user)
	                	<span class="list-group-item">
	                		{{ $user->name }} {{ $user->apellido }} <strong class="pull-right badge">{{ $user->countVentas($user->id)->count() }}</strong> 
	                	</span>
	                	
	                @endforeach
	            </div>			
			</div>
		</div>
		<div class="col-sm-6">
      		<div class="box box-solid box-primary">
	            <div class="box-header">
	            	<h3 class="box-title">
	            		Cantidad de articulos restantes
	            	</h3>	
	            </div>
	            <div class="box-body">
	                @foreach($articulos as $art)
	                	<span class="list-group-item">
	                		{{ $art->name }} <strong class="pull-right badge">{{ $art->cantidad }}</strong> 
	                	</span>
	                @endforeach
	            </div>			
			</div>
		</div>
		<div class="col-sm-12" id="container"></div>
	</div>
@endsection
@section("script")
<script>
	Highcharts.chart('container', {
	    chart: {
	        type: 'column'
	    },
	    exporting:{ enabled:true},
        credits:{ enabled:false},
	    title: {
	        text: 'Articulos mas vendidos (<?php
	        	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); echo $meses[date('n')-1]; ?>)'
	    },

	    xAxis: {
	        categories: [
	        		<?php foreach ($artMes as $a_m) { ?> <?php echo '"'.$a_m->articulo->name.'"'.',';?> <?php } ?>
	        ]
	    },

	    yAxis: {
	        allowDecimals: false,
	        min: 0,
	        title: {
	            text: 'Cantidad'
	        }
	    },

	    tooltip: {
	        /*formatter: function () {
	            return '<b>' + this.x + '</b><br/>' +
	                this.series.name + ': ' + this.y + '<br/>' +
	                'Total: ' + this.point.stackTotal;
	        }*/
	        shared: false,
            useHTML: true
	    },

	    plotOptions: {
	        /*column: {
	            stacking: 'normal'
	        }*/
	        column: {
                pointPadding: 0.4,
                borderWidth: 0,
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true
                },
                showInLegend: true
            }
	    },

	    series: 
	    [ 
	    <?php foreach ($artMes->groupBy("articulo_id") as $a_m) { ?>
	        { name: <?php echo "'".$a_m->pluck('articulo_id')."'" ?>, data: [ <?php echo $a_m->count();?> ] },
	    <?php } ?>
		]
	});
</script>	
@endsection