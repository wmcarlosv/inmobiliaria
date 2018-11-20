<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Zone;
use App\Departament;
use App\City;

class ZonesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $zones = Zone::all();
        return view('admin.zones.home', ['zones' => $zones]);
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
        return view('admin.zones.add',['departaments' => $array]);
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
            'departament_id' => 'required',
            'city_id' => 'required',
            'name' => 'required|unique:zones'
        ]);

        $zone = Zone::create($request->all());

        flash()->overlay('Registro Incluido con Exito!!', 'Alerta!!');

        return redirect()->route('zones.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $zones = Zone::where('city_id','=',$id)->get();
        $array = [];
        $cont = 0;
        foreach($zones as $zone){
            $array[$cont]['id'] = $zone->id;
            $array[$cont]['name'] = $zone->name;
            $cont++;
        }

        print json_encode($array);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $zone = Zone::find($id);

        $departaments = Departament::all();
        $array = [];
        $array[''] = '-';
        foreach($departaments as $departament){
            $array[$departament->id] = $departament->name;
        }
        $cities = City::where('departament_id','=',$zone->city->departament->id)->get();
        $array_cities = [];
        $array_cities[''] = '-';
        foreach($cities as $city){
            $array_cities[$city->id] = $city->name;
        }
        return view('admin.zones.update',['zone' => $zone, 'departaments' => $array,'cities' => $array_cities]);
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
            'departament_id' => 'required',
            'city_id' => 'required',
            'name' => 'required|unique:zones'
        ]);

        $zone = Zone::findOrFail($id);

        $zone->name = $request->input('name');

        $zone->update();

        flash()->overlay('Registro Actualizado con Exito!!', 'Alerta!!');

        return redirect()->route('zones.index');
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
            $zone = Zone::findOrFail($id);
            $zone->delete();
            flash()->overlay('Registro Eliminado con Exito!!', 'Alerta!!');
        }catch(\Illuminate\Database\QueryException $e){
            flash()->overlay('Error al tratar de eliminar, es posible que este registro este asociado a otro!!', 'Alerta!!');
        }

        return redirect()->route('zones.index');
    }
}
