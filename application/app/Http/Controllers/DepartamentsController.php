<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departament;

class DepartamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departaments = Departament::all();
        return view('admin.departaments.home', ['departaments' => $departaments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.departaments.add');
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

        $departament = Departament::create($request->all());

        flash()->overlay('Registro Incluido con Exito!!', 'Alerta!!');

        return redirect()->route('departaments.index');
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
        $departament = Departament::find($id);
        return view('admin.departaments.update',['departament' => $departament]);
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

        $departament = Departament::findOrFail($id);

        $departament->name = $request->input('name');

        $departament->update();

        flash()->overlay('Registro Actualizado con Exito!!', 'Alerta!!');

        return redirect()->route('departaments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $departament = Departament::findOrFail($id);

        $departament->delete();

        flash()->overlay('Registro Eliminado con Exito!!', 'Alerta!!');

        return redirect()->route('departaments.index');
    }
}
