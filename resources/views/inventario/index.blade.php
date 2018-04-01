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
	                <span class="list-group-item">Entregadas <strong class="pull-right badge" @if($artMesUno->count() > 0) style="background-color:#34B54F" @endif>{{ $artMesUno->count() }}</strong> </span>
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
		<div class="col-sm-3">
      		<div class="box box-solid box-primary">
	            <div class="box-header">
	            	<h3 class="box-title">
	            		Status de Usuarios  
	            	</h3>	
	            </div>
	            <div class="box-body">
	                <span class="list-group-item">Activos <strong class="pull-right badge" style="background-color: #308B29">{{ $usersUno }}</strong> </span>
	                <span class="list-group-item">Inactivos <strong class="pull-right badge" style="background-color: #F5B00C">{{ $usersDos }}</strong> </span>
	                <span class="list-group-item">Suspendidos <strong class="pull-right badge" style="background-color: #B42929">{{ $usersTres }}</strong> </span>
	            </div>			
			</div>
		</div>
		<div class="col-sm-3">
      		<div class="box box-solid box-primary">
	            <div class="box-header">
	            	<h3 class="box-title">
	            		Articulos restantes
	            	</h3>	
	            </div>
	            <div class="box-body">
	                @foreach($articulos as $art)
	                	<span class="list-group-item">
	                		{{ $art->name }} <strong class="pull-right badge" @if($art->cantidad == 0) style="background-color:#AD1D1D" @endif>{{ $art->cantidad }}</strong> 
	                	</span>
	                @endforeach
	            </div>			
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6" id="container"></div>
		<div class="col-sm-6" id="container2"></div>
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
	        text: 'Articulos vendidos en (<?php
	        	$meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"); echo $meses[date('n')-1]; ?>)'
	    },

	    xAxis: {
	        categories: ['Articulos']
	    },

	    yAxis: {
	        allowDecimals: false,
	        min: 0,
	        title: {
	            text: 'Cantidad de articulos'
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
	        column: {
	        	// stacking: 'normal',
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
	    <?php $data = ''; ?>
        <?php foreach ($artMes as $a_m) { ?>
            <?php foreach ($a_m as $a_m_data) { $data = $a_m_data->articulo->name; }?>
            { name: <?php echo "'".$data."'" ?>, data: [ <?php echo $a_m->count();?> ] },
        <?php }?>
		]
	});

	// grafico tipo torta
    Highcharts.chart('container2', {
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false,
            type: 'pie'
        },
        exporting:{ enabled:true},
        credits:{ enabled:false},
        title: {
            text: 'Articulos restantes (%)'
        },
        subtitle: {
            text: 'Cantidad de articulos restantes en el inventario'
        },
        tooltip: {
            pointFormat: '{series.name}:<b>{point.y}</b>  <b>({point.percentage:.1f}%)</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true
                },
                showInLegend: true
            }
        },
        series: [{
            name: 'Total ',
            colorByPoint: true,
            data:
            [
             	<?php foreach ($articulos as $art) { ?>
                    	['<?php echo $art->name;?>' , <?php echo $art->cantidad; ?>],
            	<?php } ?>
            ]
        }]
    });
</script>	
@endsection