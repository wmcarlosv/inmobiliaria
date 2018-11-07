<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Amenity;
use App\Property;
use App\Direction;
use App\PropertyType;
use App\Management;
use App\Consultant;
use App\Feature;

class PropertiesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $properties = Property::all();
        return view('admin.properties.home', ['properties' => $properties]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $directions = Direction::all();
        $diections_array = [];
        $diections_array[''] = 'Seleccionar';
        foreach($directions as $direction) { 
            $diections_array[$direction->id] = $direction->departament." ".$direction->zone." ".$direction->ubication;
        }

        $propertytypes = PropertyType::all();
        $propertytypes_array = [];
        $propertytypes_array[''] = 'Seleccionar';
        foreach ($propertytypes as $propertytype) {
            $propertytypes_array[$propertytype->id] = $propertytype->name; 
        }

        $managements = Management::all();
        $managements_array = [];
        $managements_array[''] = 'Seleccionar';
        foreach ($managements as $management) {
            $managements_array[$management->id] = $management->name;
        }
        $consultants = Consultant::all();
        $consultants_array = [];
        $consultants_array[''] = 'Seleccionar';
        foreach ($consultants as $consultant) {
            $consultants_array[$consultant->id] = $consultant->name." ".$consultant->phone." ".$consultant->email;
        }

        $amenities = Amenity::all();
        $features = Feature::all();

        return view('admin.properties.add',[
            'directions' => $diections_array,
            'propertytypes' => $propertytypes_array,
            'managements' => $managements_array,
            'consultants' => $consultants_array,
            'amenities' => $amenities,
            'features' => $features
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
        $request->validate([
            'direction_id' => 'required',
            'property_type_id' => 'required',
            'management_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stratum' => 'required',
            'square_meter' => 'required',
            'consultant_id' => 'required'
        ]);

        $property = new Property();

        $property->direction_id = $request->input('direction_id');
        $property->property_type_id = $request->input('property_type_id');
        $property->management_id = $request->input('management_id');
        $property->description = $request->input('description');
        $property->price = $request->input('price');
        $property->stratum = $request->input('stratum');
        $property->square_meter = $request->input('square_meter');
        $property->consultant_id = $request->input('consultant_id');

        $property->save();

        $amenities_array = $request->input('amenities');

        if(isset($amenities_array) and !empty($amenities_array)){
            $cont = 0;
            for($i=0; $i < count($amenities_array); $i++){
                $amenity[$cont]['property_id'] = $property->id;
                $amenity[$cont]['amenity_id'] = $amenities_array[$i];
                $cont++;
            }
            $property->amenities()->attach($amenity);
        }
        
        flash()->overlay('Registro Incluido con Exito!!', 'Alerta!!');

        return redirect()->route('properties.index');
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
        $property = Property::find($id);

        $directions = Direction::all();
        $diections_array = [];
        $diections_array[''] = 'Seleccionar';
        foreach($directions as $direction) { 
            $diections_array[$direction->id] = $direction->departament." ".$direction->zone." ".$direction->ubication;
        }

        $propertytypes = PropertyType::all();
        $propertytypes_array = [];
        $propertytypes_array[''] = 'Seleccionar';
        foreach ($propertytypes as $propertytype) {
            $propertytypes_array[$propertytype->id] = $propertytype->name; 
        }

        $managements = Management::all();
        $managements_array = [];
        $managements_array[''] = 'Seleccionar';
        foreach ($managements as $management) {
            $managements_array[$management->id] = $management->name;
        }
        $consultants = Consultant::all();
        $consultants_array = [];
        $consultants_array[''] = 'Seleccionar';
        foreach ($consultants as $consultant) {
            $consultants_array[$consultant->id] = $consultant->name." ".$consultant->phone." ".$consultant->email;
        }

        $amenities = Amenity::all();
        $features = Feature::all();

        return view('admin.properties.update',[
            'property' => $property,
            'directions' => $diections_array,
            'propertytypes' => $propertytypes_array,
            'managements' => $managements_array,
            'consultants' => $consultants_array,
            'amenities' => $amenities,
            'features' => $features
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

        $request->validate([
            'direction_id' => 'required',
            'property_type_id' => 'required',
            'management_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stratum' => 'required',
            'square_meter' => 'required',
            'consultant_id' => 'required'
        ]);

        $property = Property::findOrFail($id);
        $property->direction_id = $request->input('direction_id');
        $property->property_type_id = $request->input('property_type_id');
        $property->management_id = $request->input('management_id');
        $property->description = $request->input('description');
        $property->price = $request->input('price');
        $property->stratum = $request->input('stratum');
        $property->square_meter = $request->input('square_meter');
        $property->consultant_id = $request->input('consultant_id');

        $property->amenities()->detach();
        
        $property->update();

        $amenities_array = $request->input('amenities');

        if(isset($amenities_array) and !empty($amenities_array)){
            $cont = 0;
            for($i=0; $i < count($amenities_array); $i++){
                $amenity[$cont]['property_id'] = $property->id;
                $amenity[$cont]['amenity_id'] = $amenities_array[$i];
                $cont++;
            }
            $property->amenities()->attach($amenity);
        }

        flash()->overlay('Registro Actualizado con Exito!!', 'Alerta!!');

        return redirect()->route('properties.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $property = Property::findOrFail($id);

        $property->amenities()->detach();

        $property->delete();

        flash()->overlay('Registro Eliminado con Exito!!', 'Alerta!!');

        return redirect()->route('properties.index');
    }
}
