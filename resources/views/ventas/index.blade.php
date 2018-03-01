@extends('layouts.app')
@section('title','Ventas - '.config('app.name'))
@section('header','Ventas')
@section('breadcrumb')
	<ol class="breadcrumb">
	  <li><a href="{{route('dashboard')}}"><i class="fa fa-home" aria-hidden="true"></i> Inicio</a></li>
	  <li class="active"> Ventas </li>
	</ol>
@endsection
@section('content')
	@include('partials.flash')
	<!-- Info boxes -->
  <div class="row">
  	<div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
        
        <div class="info-box-content">
          <span class="info-box-text">Ventas Totales</span>
          <span class="info-box-number">0</span>
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
		        	<h3 class="box-title"><i class="fa fa-th"></i> Ventas Realizadas</h3>
			        <!-- <span class="pull-right">
						<a href="{{ route('ventas.create') }}" class="btn btn-flat btn-success">
							<i class="fa fa-plus" aria-hidden="true"></i> Nuevo
						</a>
					</span> -->
		      	</div>
	      		<div class="box-body">
						<h2><i class="fa fa-exclamation-circle text-info"></i> En construccion</h2>
				</div>
			</div>
		</div>
	</div>
@endsection