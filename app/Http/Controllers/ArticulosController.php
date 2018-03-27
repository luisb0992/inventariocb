<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Articulo;
use App\Modelo;
use App\Color;

class ArticulosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("articulos.index",["articulos" => Articulo::all()]);      
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("articulos.create",[
            "modelos" => Modelo::all(),
            "colores" => Color::all()
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
            'name' => 'required',
            'cantidad' =>'required',
            'modelo_id' =>'required',
            'color_id' =>'required',
            'imagen' => 'required'
          ]);

          $articulos = new Articulo;
          $articulos->fill($request->all());
          $hasfile = $request->hasFile('imagen') && $request->imagen->isValid();
          if ($hasfile){
          
              $extension = $request->imagen->extension();
              
              if ($extension == 'jpeg' || $extension == 'png' || $extension == 'bmp' || $extension == 'jpg') {
                  
                  $articulos->img = $extension;

                  if($articulos->save()){
                    $request->imagen->storeAs('images',"$articulos->id.$extension");
                    return redirect("articulos")->with([
                      'flash_message' => 'Articulo agregado correctamente.',
                      'flash_class' => 'alert-success'
                      ]);
                  }else{
                    return redirect("articulos")->with([
                      'flash_message' => 'Ha ocurrido un error.',
                      'flash_class' => 'alert-danger',
                      'flash_important' => true
                      ]);
                  }

              }else{

                  return redirect("articulos")->with([
                      'flash_message' => 'La imagen es invalida!',
                      'flash_class' => 'alert-danger',
                      'flash_important' => true
                  ]);

              }
              
          }else{
            dd("no existe la imagen");
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
        return view("articulos.edit",[
            "articulo" => Articulo::findOrFail($id),
            "modelos" => Modelo::all(),
            "colores" => Color::all()
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

          $this->validate($request, [
            'name' => 'required',
            'cantidad' =>'required',
            'modelo_id' =>'required',
            'color_id' =>'required'
          ]);

          $articulos = Articulo::findOrFail($id);
          $articulos->fill($request->all());

          if($articulos->save()){
            return redirect("articulos")->with([
              'flash_message' => 'Articulo actualizado correctamente.',
              'flash_class' => 'alert-success'
              ]);
          }else{
            return redirect("articulos")->with([
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

    public function editImagen($id){
      
      $articulo = Articulo::findOrFail($id);
      return response()->json($articulo);
    }

    public function updateImagen(Request $request, $id)
    {

          $articulos = Articulo::findOrFail($id);
          //$articulos->img = $request->img;

          $hasfile = $request->hasFile('img') && $request->img->isValid();

          if ($hasfile){
          
              $extension = $request->img->extension();
              
              if ($extension == 'jpeg' || $extension == 'png' || $extension == 'bmp' || $extension == 'jpg') {
                  
                  $articulos->img = $extension;

                  if($articulos->save()){
                    
                    $request->img->storeAs('images',"$articulos->id.$extension");

                    return redirect("articulos")->with([
                      'flash_message' => 'Imagen actualizada correctamente.',
                      'flash_class' => 'alert-success'
                      ]);

                  }else{
                    
                    return redirect("articulos")->with([
                      'flash_message' => 'Ha ocurrido un error.',
                      'flash_class' => 'alert-danger',
                      'flash_important' => true
                      ]);

                  }

              }else{

                  return redirect("articulos")->with([
                      'flash_message' => 'La imagen es invalida!',
                      'flash_class' => 'alert-danger',
                      'flash_important' => true
                  ]);

              }
              
          }else{
            dd("no existe la imagen");
          }
    }
}
