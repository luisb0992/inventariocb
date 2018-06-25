<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Red;

class RedesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if (\Auth::user()->perfil_id == 1) {
    		$redes = Red::all();
    	}else{
    		$user = \Auth::user()->id;
    		$redes = Red::where('user_id', $user)->get();	
    	}
    	
        return view('redes.index',[
        	'redes' => $redes
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
            'link_f' =>'required|unique:redes'
        ]);

        $red = new Red();
        $red->fill($request->all());
        $red->user_id = \Auth::user()->id;

        if($red->save()){

	        return redirect("redes")->with([
	          'flash_message' => 'red registrada corectamente',
	          'flash_class' => 'alert-success'
	        ]);

	    }else{

	        return redirect("redes")->with([
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
}
