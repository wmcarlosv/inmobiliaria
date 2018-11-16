<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Departament;
use App\City;
class CitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::all();
        return view('admin.cities.home', ['cities' => $cities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departaments = Departament::all();
        $array = [];
        $array[''] = '-';
        foreach($departaments as $departament){
            $array[$departament->id] = $departament->name;
        }

        return view('admin.cities.add',['departaments' => $array]);
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
            'name' => 'required',
            'departament_id' => 'required'
        ]);

        $city = City::create($request->all());

        flash()->overlay('Registro Incluido con Exito!!', 'Alerta!!');

        return redirect()->route('cities.index');
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
        $city = City::find($id);
        $departaments = Departament::all();
        $array = [];
        $array[''] = '-';
        foreach($departaments as $departament){
            $array[$departament->id] = $departament->name;
        }
        return view('admin.cities.update',['city' => $city, 'departaments' => $array]);
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
            'name' => 'required',
            'departament_id' => 'required'
        ]);

        $city = City::findOrFail($id);

        $city->name = $request->input('name');
        $city->departament_id = $request->input('departament_id');

        $city->update();

        flash()->overlay('Registro Actualizado con Exito!!', 'Alerta!!');

        return redirect()->route('cities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $city = City::findOrFail($id);

        $city->delete();

        flash()->overlay('Registro Eliminado con Exito!!', 'Alerta!!');

        return redirect()->route('cities.index');
    }
}
