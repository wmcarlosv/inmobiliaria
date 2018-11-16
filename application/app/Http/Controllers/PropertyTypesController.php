<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PropertyType;

class PropertyTypesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $propertytypes = PropertyType::all();
        return view('admin.property-types.home', ['propertytypes' => $propertytypes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.property-types.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $propertytype = PropertyType::create($request->all());

        flash()->overlay('Registro Incluido con Exito!!', 'Alerta!!');

        return redirect()->route('property-types.index');
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
        $propertytype = PropertyType::find($id);
        return view('admin.property-types.update',['propertytype' => $propertytype]);
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

        $request->validate([
            'name' => 'required'
        ]);

        $propertytype = PropertyType::findOrFail($id);

        $propertytype->name = $request->input('name');

        $propertytype->update();

        flash()->overlay('Registro Actualizado con Exito!!', 'Alerta!!');

        return redirect()->route('property-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $propertytype = PropertyType::findOrFail($id);

            $propertytype->delete();

            flash()->overlay('Registro Eliminado con Exito!!', 'Alerta!!');
        }catch(\Illuminate\Database\QueryException $e){
            flash()->overlay('Error al tratar de eliminar, es posible que este registro este asociado a otro!!', 'Alerta!!');
        }

        return redirect()->route('property-types.index');
    }
}
