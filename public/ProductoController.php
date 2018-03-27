<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Producto;
use App\Maquina;
use App\Planta;
use App\Bitacora;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Producto::all();

        return view('producto.index',['productos'=>$productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        $maquina = Maquina::all();
         return view('producto.create',['maquinas'=>$maquina]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $planta = new Producto;
        $planta->nombre = $request->input('name');
        $planta->id_maquina = $request->input('id_maquina');
        $planta->tipo = $request->input('tipo');
        $planta->descripcion = $request->input('descripcion');
        $maquina = $request->input('id_maquina');
        $planta->id_planta = Maquina::where('id', $maquina )->value("id_planta");

        if($planta->save()){
            Bitacora::bitacoraSave('Producto '.$request->name);
            return redirect("producto")->with([
            'flash_message' => 'Producto  agregada correctamente.',
            'flash_class' => 'alert-success'
          ]);
        }else{
             return redirect("producto")->with([
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
      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function producto($id)
    {
        $producto = Producto::findOrfail($id);
        //dd($producto);
        return response()->json(['status' => true, 'mensaje' => 'listo', 'data' => $producto ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $producto = Producto::where('id',$id)->first();
       // dd($planta);
        return view ('producto.edit', ['producto'=>$producto]);
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
        $planta = Producto::findOrFail($id);
        $planta->nombre = $request->input('name');
        $planta->descripcion = $request->input('descripcion');

        if($planta->save()){
            Bitacora::bitacoraSave('Producto '.$request->name);
            return redirect("producto")->with([
            'flash_message' => 'Producto  Actualizado correctamente.',
            'flash_class' => 'alert-success'
          ]);
        }else{
             return redirect("producto")->with([
            'flash_message' => 'Ha ocurrido un error.',
            'flash_class' => 'alert-danger',
            'flash_important' => true
          ]);
        }
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
