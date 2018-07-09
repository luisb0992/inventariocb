<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Entrevista;
use App\Articulo;
use App\Pais;
use App\Comentario;
use App\User;
use App\Venta;
use Excel;

class EntrevistasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	if (\Auth::check()) {
    		$user = \Auth::user()->id;
    		$entrevistas = Entrevista::where('user_id', $user)->where('status', 1)->get();
    	}else{
    		return view('login');
    	}

    	//dd($entrevistas);
        return view("entrevistas.index",[
            "entrevistas" => $entrevistas
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $articulos = Articulo::where("cantidad", ">", 0)->get();
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
	        'nombre' => 'required|unique:entrevistas',
	        'apellido' => 'required',
	        'pais_id' => 'required',
	        'articulo_id' => 'required',
	        'telefono' => 'unique:entrevistas'
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
    	$entrevista->fecha_nac = $request->fecha_nac;
    	$entrevista->hora = $request->hora;
    	$entrevista->precio_ref = $request->precio_ref;
    	$entrevista->status = 1;
    	$entrevista->status_entre = $request->status_entre;
    	$entrevista->link = $request->link;

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
        $entrevista = Entrevista::findOrFail($id);

        return view('entrevistas.edit', [
        	'entrevista' => $entrevista,
        	'articulos' => Articulo::all(),
        	'paises' => Pais::all(),
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
        $entrevista = Entrevista::findOrFail($id);

	      /*$this->validate($request, [
	        'name' => 'required',
	        'email' =>'required|email|unique:users,email,'.$user->id.',id'
	      ]);*/

	      $entrevista->fill($request->all());

	      if($entrevista->save()){
	        return redirect("entrevistas")->with([
	          'flash_message' => 'Entrevista actualizada correctamente.',
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function pdf($id){

    	$entrevista = Entrevista::findOrFail($id);

    	$pdf = PDF::loadView('entrevistas.pdf', compact('entrevista'));

        return $pdf->setPaper('a4', 'landscape')->download(date("d-m-Y h:m:s").'.pdf');
    }

    public function eliminar($id){

    	$entrevista = Entrevista::findOrFail($id);

    	$entrevista->status = 0;

        if($entrevista->save()){
	        return redirect("entrevistas")->with([
	          'flash_message' => 'Entrevista eliminada correctamente.',
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

    public function entrevistasReporte(){

    	return view("entrevistas.excel",[
        "entrevistas" => Entrevista::all()
      ]);
    }

    public function entrevistasExcel(Request $request){

      $from = date('Y-m-d 00:00:00',strtotime(str_replace('/', '-', $request->desde)));
      $to = date('Y-m-d 23:59:59',strtotime(str_replace('/', '-', $request->hasta)));
      $entre = Entrevista::whereBetween("created_at", [$from, $to])->get();

      if (count($entre) > 0) {
        Excel::create("Entrevista ".date("d-m-Y H:m a"), function($excel) use($entre){

          $excel->sheet("Reporte", function($sheet) use($entre) {
            // header
            $sheet->row(1, [
              "Nombre Completo", "Articulo", "Fecha", "Hora", "Status"
            ]);

            $sheet->cell("A1:E1", function($cell) {
              $cell->setBackground('#0bb061');
              $cell->setFontWeight('bold');
            });

            // manejo de data
            foreach ($entre as $v) {
              $row = [];
              $row [0] = $v->nombre.' '.$v->apellido;
              $row [1] = $v->articulo->name;
              $row [2] = $v->fecha;
              $row [3] = $v->hora;
              $row [4] = $v->status_entre;
              $sheet->appendRow($row);
            }


          });

        })->export('xls');
      }else{
        return redirect()->route("entrevistasReporte")->with([
          'flash_message' => 'No existen prospectos de venta en las fechas seleccionadas',
          'flash_class' => 'alert-danger'
        ]);
      }
    }
}
