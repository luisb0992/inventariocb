<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Red;
use App\User;
use App\SaveClick;
use App\Provincia;

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
            'redes' => $redes,
        	'prov' => Provincia::all(),
        ]);
    }

    public function reporteClick()
    {
        if (\Auth::user()->perfil_id == 1) {
            $r = SaveClick::all();
        }else{
            $user = \Auth::user()->id;
            $r = SaveClick::where('user_id', $user)->get();
        }
        return view('redes.reportes',[
            'reportes' => $r,
            'users' => User::all()
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
        $red = Red::findOrFail($id);
        if($red->delete()){
            return redirect('redes')->with([
                'flash_class'   => 'alert-success',
                'flash_message' => 'Registro eliminado con exito.'
            ]);
        }else{
            return redirect('redes')->with([
                'flash_class'     => 'alert-danger',
                'flash_message'   => 'Ha ocurrido un error.',
                'flash_important' => true
            ]);
        }
    }

    public function saveClick(Request $request)
    {
        $save = new SaveClick;
        $save->user_id = \Auth::user()->id;
        $save->red_id = $request->red_id;
        $save->fecha = date("d-m-Y");
        $save->hora = date("H:i A");
        $save->save();
        return response()->json($save);
    }

    public function busquedaClick(Request $request)
    {
        // formatemos la fecha recibida
        $fecha = date('d-m-Y',strtotime(str_replace('/', '-', $request->fecha)));
        // construimos la query para el conteo de los clicks
        $reportes = SaveClick::where("fecha", $fecha)->where("user_id", $request->user_id)->get()->groupBy("red_id");
        // dd($reportes);
        return view("redes.busqueda",[
          'reportes' => $reportes,
          'users' => User::all()
        ]);
    }

    public function pdf($id, $fecha){
        $save = SaveClick::where("fecha", $fecha)->where("user_id", $id)->get()->groupBy("red_id");
        $pdf = PDF::loadView('prospectos.pdf', compact('save'));
        return $pdf->setPaper('a4', 'landscape')->download(date("d-m-Y h:m:s").'.pdf');
    }
}
