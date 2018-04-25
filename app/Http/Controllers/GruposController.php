<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Grupo;
use App\user;

class GruposController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('grupos.index',[
        	'grupos' => Grupo::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('grupos.create',[
        	'users' => User::whereNotIn('id', Grupo::all(['user_id']))->get()
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
	      $grupo = new Grupo;
	      $grupo->fill($request->all());

	      if($grupo->save()){
	        return redirect("grupos")->with([
	          'flash_message' => 'Grupo asignado a usuario correctamente.',
	          'flash_class' => 'alert-success'
	          ]);
	      }else{
	        return redirect("grupos")->with([
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

    }

    public function mostrar()
    {
        $grupo = Grupo::where('user_id', \Auth::user()->id)->first();

        return view("grupos.show",[
        	'grupo' => $grupo
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    	$grupo = Grupo::findOrFail($id);

        return view('grupos.edit',[
        	'users' => User::all(),
        	'grupo' => $grupo
        ]);
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
          $grupo = Grupo::findOrFail($id);
	      $grupo->fill($request->all());

	      if($grupo->save()){
	        return redirect("grupos")->with([
	          'flash_message' => 'Grupo actualizado correctamente.',
	          'flash_class' => 'alert-success'
	          ]);
	      }else{
	        return redirect("grupos")->with([
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
