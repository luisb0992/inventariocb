<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;

class LoginController extends Controller
{
    public function index()
    {
		return view('dashboard',[
			'users' => User::all()
		]);
 	}

	 public function login(Request $request)
	 {
    	$this->validate($request, [
    		'email' =>'required|email',
    		'password' => 'required',
    	]);

      	if (Auth::attempt($request->only(['email','password']))){

	    	if (\Auth::check()) {
      			if (Auth::user()->status == 2) {
      				Auth::logout();
      				return redirect()->route('login')->with([
			          'flash_message' => 'Usuario Inactivo, contacte con el administrador!',
			          'flash_class' => 'alert-warning'
			          ]);
      			}elseif(Auth::user()->status == 3){
      				Auth::logout();
      				return redirect()->route('login')->with([
			          'flash_message' => 'Usuario Suspendido, contacte con el administrador!',
			          'flash_class' => 'alert-danger'
			          ]);
      			}else{
	      			$id = \Auth::user()->id;
		    		$user = user::findOrFail($id);
		    		$user->online = 1;
		    		$user->save();
      				return redirect()->intended('dashboard');
      			}
	    	}
      	
      	}else{
      		return redirect()->route('login')->withErrors('¡Error!, Revise sus credenciales');
      	}
	 }

	 public function logout()
	 {
 		/*---- funcion de salir/logout/cerrar sesion --*/
 		if (\Auth::check()) {
    		$id = \Auth::user()->id;
	    	$user = user::findOrFail($id);
    		$user->online = 0;
    		$user->save();
    	}
 		Auth::logout();
 		return view('login');
	 }
    
}
