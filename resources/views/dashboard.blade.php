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
  	</div>
@endsection