<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entrevista;
use App\Articulo;
use App\Pais;
use App\Comentario;
use App\User;

class EntrevistasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("entrevistas.index",[
            "entrevistas" => Entrevista::all(
                ["id", "nombre", "apellido", "articulo_id", "fecha", "hora"])
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articulos = Articulo::all();
        $paises = Pais::all();
        return view("entrevistas.create",[
            "articulos" => $articulos,
            "paises" => $paises
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
	        'nombre' => 'required',
	        'apellido' => 'required',
	        'telefono' => 'required',
	        'contacto' => 'required',
	        'pais_id' => 'required',
	        'articulo_id' => 'required',
	        'fecha' => 'required',
	        'hora' => 'required'
	    ]);

    	$entrevista = new Entrevista();
    	$entrevista->user_id = \Auth()->user()->id;
    	$entrevista->nombre = $request->nombre;
    	$entrevista->apellido = $request->apellido;
    	$entrevista->direccion = $request->direccion;
    	$entrevista->email = $request->email;
    	$entrevista->telefono = $request->telefono;
    	$entrevista->contacto = $request->contacto;
    	$entrevista->pais_id = $request->pais_id;
    	$entrevista->distrito = $request->distrito;
    	$entrevista->provincia = $request->provincia;
    	$entrevista->sexo_bebe = $request->sexo_bebe;
    	$entrevista->articulo_id = $request->articulo_id;
    	$entrevista->fecha = $request->fecha;
    	$entrevista->hora = $request->hora;

    	if ($request->tiempo_embarazo != null) {
    		$entrevista->tiempo_embarazo = $request->tiempo_embarazo.' '.$request->t_embarazo;
    	}else{
    		$entrevista->tiempo_embarazo = $request->tiempo_embarazo;
    	}

    	if ($request->tiempo_nacido != null) {
    		$entrevista->tiempo_nacido = $request->tiempo_nacido.' '.$request->t_nacido;
    	}else{
    		$entrevista->tiempo_nacido = $request->tiempo_nacido;
    	}


	    if($entrevista->save()){
	      	if ($request->comentario != null) {
	      		$comentario = new Comentario();
	      		$comentario->comentario = $request->comentario;
	      		$comentario->entrevista_id = $entrevista->id;
	      		$comentario->save();
	      	}

	        return redirect("entrevistas")->with([
	          'flash_message' => 'Entrevista registrada corectamente',
	          'flash_class' => 'alert-success'
	        ]);

	    }else{

	        return redirect("entrevistas")->with([
	          'flash_message' => 'Ha ocurrido un error.',
	          'flash_class' => 'alert-danger',
	          'flash_important' => true
	        ]);

	    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entrevista = Entrevista::with(['articulo', 'pais', 'comentarios'])->where('id',$id)->first();
        
        if($entrevista->tiempo_embarazo == null){$entrevista->tiempo_embarazo = '...';};
        if($entrevista->tiempo_nacido == null){$entrevista->tiempo_nacido = '...';};
        if($entrevista->sexo_bebe == null){$entrevista->sexo_bebe = '...';};
        if($entrevista->direccion == null){$entrevista->direccion = '...';};

        return response()->json($entrevista);
    }

    public function show_id($id)
    {
        $entrevista = Entrevista::where('id', $id)->value("id");

        return response()->json($entrevista);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
