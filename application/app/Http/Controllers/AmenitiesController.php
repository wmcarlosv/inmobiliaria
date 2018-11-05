<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Amenity;

class AmenitiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $amenities = Amenity::all();
        return view('admin.amenities.home', ['amenities' => $amenities]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.amenities.add');
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

        $amenity = Amenity::create($request->all());

        flash()->overlay('Registro Incluido con Exito!!', 'Alerta!!');

        return redirect()->route('amenities.index');
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
        $amenity = Amenity::findOrFail($id);

        return view('admin.amenities.update', ['amenity' => $amenity]);
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

        $amenity = Amenity::findOrFail($id);

        $amenity->name = $request->input('name');

        $amenity->update();

        flash()->overlay('Registro actualizado con Exito!!', 'Alerta!!');

        return redirect()->route('amenities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $amenity = Amenity::findOrFail($id);

        $amenity->delete();
        
        flash()->overlay('Registro eliminado con Exito!!', 'Alerta!!');

        return redirect()->route('amenities.index');
    }
}
