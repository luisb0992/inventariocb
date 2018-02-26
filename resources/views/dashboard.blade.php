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
				<h1>Bienvenido {{ \Auth::user()->name }}</h1>
			</div>
		<hr>
		</div>
		<div class="col-sm-4 border_right_1">   
			<img src="{{ asset('img/dashboard_1.png') }}" alt="dashboard" class="img-responsive text-center col-sm-10">
		</div>
		<div class="col-sm-4 border_right_1">   
			<img src="{{ asset('img/dashboard_2.png') }}" alt="dashboard" class="img-responsive text-center col-sm-10">
		</div>
		<div class="col-sm-4">   
			<img src="{{ asset('img/dashboard_3.png') }}" alt="dashboard" class="img-responsive text-center col-sm-10">
		</div>		
  	</div>
@endsection