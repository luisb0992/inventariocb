<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venta;
use App\Entrevista;
use App\Articulo;
use App\User;

class InventarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {	
    	$artMensualUno = Venta::whereMonth("created_at", date("m"))->where("status_id", 1)->get();
    	$artMensualDos = Venta::whereMonth("created_at", date("m"))->where("status_id", 2)->get();
    	$artMensualTres = Venta::whereMonth("created_at", date("m"))->where("status_id", 3)->get();
    	$artMensualCuatro = Venta::whereMonth("created_at", date("m"))->where("status_id", 4)->get();
    	$artMes = Venta::whereMonth("created_at", date("m"))->get()->groupBy('articulo_id');

        return view('inventario.index',[
        	'articulos' => Articulo::all(),
        	'entrevistas' => Entrevista::count(),
        	'ventas' => Venta::count(),
        	'users' => User::all(),
        	'artMesUno' => $artMensualUno,
        	'artMesDos' => $artMensualDos,
        	'artMesTres' => $artMensualTres,
        	'artMesCuatro' => $artMensualCuatro,
            'artMes' => $artMes,
            'usersUno' => User::where('status', 1)->count(),
            'usersDos' => User::where('status', 2)->count(),
        	'usersTres' => User::where('status', 3)->count()
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
        //
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
}
