<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Excel;
use App\Venta;
use App\Articulo;
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

    	if (\Auth::check()) {
    		if (\Auth::user()->perfil_id == 1) {
    			$ventas = Venta::all();
    		}else{
    			$user = \Auth::user()->id;
    			$ventas = Venta::where('user_id', $user)->get();
    		}
    	}else{
    		return view('login');
    	}

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

	    //dd("esta llegando");

	    $venta = new Venta();
        $venta->fill($request->all());
        $venta->user_id = \Auth::user()->id;

        if($venta->save()){
        	$articulo = Articulo::findOrFail($venta->articulo_id);
        	$articulo->cantidad = $articulo->cantidad - 1;
        	$articulo->save();

	        return redirect("ventas")->with([
	          'flash_message' => 'venta registrada corectamente',
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
        $venta = Venta::orderBy('id', 'DESC')->value('numero_contrato');

        if ($venta) {
        	$venta = $venta + 1;
        }else{
        	$venta = 51;
        }

        $unidades = Unidad::all();
        $status = Status::all();
        return view('ventas.venta', [
        	"entrevista" => $entrevista,
        	"unidades" => $unidades,
        	"status" => $status,
        	"venta" => $venta
        ]);
    }

    public function pdf($id){

    	$venta = Venta::findOrFail($id);

    	$pdf = PDF::loadView('ventas.pdf', compact('venta'));

        return $pdf->setPaper('a4', 'landscape')->download(date("d-m-Y h:m:s").'.pdf');
    }

    public function ventasReporte(){
      return view("ventas.excel",[
        'ventas' => Venta::all()
      ]);
    }
    public function ventasExcel(Request $request){

      $from = date('Y-m-d 00:00:00',strtotime(str_replace('/', '-', $request->desde)));
      $to = date('Y-m-d 23:59:59',strtotime(str_replace('/', '-', $request->hasta)));
      $ventas = Venta::whereBetween("created_at", [$from, $to])->get();

      if (count($ventas) > 0) {
        Excel::create("Ventas ".date("d-m-Y H:m a"), function($excel) use($ventas){

          $excel->sheet("Reporte", function($sheet) use($ventas) {
            // header
            $sheet->row(1, [
              "Nº Contrato", "Vendedor", "Comprador", "Articulo", "Precio", "Fecha de Venta", "Status"
            ]);

            $sheet->cell("A1:G1", function($cell) {
              $cell->setBackground('#0bb061');
              $cell->setFontWeight('bold');
            });

            // manejo de data
            foreach ($ventas as $v) {
              $row = [];
              $row [0] = $v->numero_contrato;
              $row [1] = $v->user->name;
              $row [2] = $v->entrevista->nombre.' '.$v->entrevista->apellido;
              $row [3] = $v->articulo->name;
              $row [4] = $v->precio.' ('.$v->unidad->name.')';
              $row [5] = $v->formatoCreated();
              $row [6] = $v->status->name;
              $sheet->appendRow($row);
            }


          });

        })->export('xls');
      }else{
        return redirect()->route("ventasReporte")->with([
          'flash_message' => 'No existen ventas en las fechas seleccionadas',
          'flash_class' => 'alert-danger'
        ]);
      }


    }
}
