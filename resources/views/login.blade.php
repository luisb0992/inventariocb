<!DOCTYPE html>
<html>
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ config('app.name') }}</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/ep.css')}}">
    <style>
    	.fondo_login{
    		background-image: url('{{ asset('img/inventario_3.jpg') }}');
    		background-position: center center;
	        background-size: 100%;
    	}
    </style>
  </head>
	<body class="fondo_login img-responsive">
	  <div class="row">
	  		<div class="col-sm-12">
	  			@include('partials.flash')
			  <div class="login-box">
			    <div class="login-logo">
			      <center>
			      	<img class="img-responsive" src="{{ asset('img/logo_login_2.png') }}" style="height:75px">
			      </center>
			      <small class="text-center texto_blanco" style="font-size: 22px;">{{ config('app.name') }}</small>
			    </div>
			    <div class="login-box-body">
			      <p class="login-box-msg">-Login-</p>

			      @if (count($errors) > 0)
			        <div class="alert alert-danger">
			        	<ul>
				          @foreach($errors->all() as $error)
				             <li>{{$error}}</li>
				          @endforeach	
			         	</ul>  
			        </div>
			      @endif

			      <form action="{{route('auth')}}" method="POST" id="form_login">
			          {{ csrf_field() }}
			        <div class="form-group has-feedback">
			          <input  class="form-control" type="email" name="email" placeholder="Email">
			          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
			        </div>
			        <div class="form-group has-feedback">
			          <input id="password" class="form-control" type="password" name="password" placeholder="Password">
			          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
			        </div>

			        <div class="form-group">
			            <button id="btn_login" type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
			        </div>
			         <div class="progress" style="display:none">
					  <div class="progress-bar progress-bar-striped active" role="progressbar"
					  aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width:100%">
					  </div>
					</div> 
			      </form> 
			    </div><!-- /.login-box-body -->
			  </div><!-- /.login-box -->
		  </div>
	  </div>

	  <script type="text/javascript" src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
	  
	  <script>
	  	$("#form_login").on("submit", function(){
	  		$("#btn_login").text("Espere...").addClass("disabled");
	  		$(".progress").fadeIn(400, "linear");
	  	});
	  </script>	
	
	</body>
</html>
