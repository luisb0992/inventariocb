<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\Entrevista;
use App\Unidad;
use App\Status;

class VentasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$ventas = Venta::all();
        return view("ventas.index",[
        	'ventas' => $ventas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
	        'articulo_id' => 'required',
	        'numero_contrato' => 'required',
	        'precio' => 'required',
	        'unidad_id' => 'required',
	        'descripcion' => 'required',
	        'entrada' => 'required',
	        'salida' => 'required',
	        'deuda' => 'required',
	        'status_id' => 'required'
	    ]);

	    $venta = new Venta();
        $venta->fill($request->all());
        $venta->user_id = \Auth::user()->id;

        if($venta->save()){

	        return redirect("ventas")->with([
	          'flash_message' => 'venta concretada corectamente',
	          'flash_class' => 'alert-success'
	        ]);

	    }else{

	        return redirect("ventas")->with([
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
        //
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

    public function venta($id)
    {
        $entrevista = Entrevista::findOrFail($id);
        $unidades = Unidad::all();
        $status = Status::all();
        return view('ventas.venta', [
        	"entrevista" => $entrevista,
        	"unidades" => $unidades,
        	"status" => $status
        ]);
    }
}
