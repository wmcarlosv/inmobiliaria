<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Amenity;
use App\Property;
use App\Departament;
use App\City;
use App\Zone;
use App\PropertyType;
use App\Management;
use App\Consultant;
use App\Feature;
use App\PropertyPhoto;

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
        $departaments = Departament::all();
        $departaments_array = [];
        $departaments_array[''] = 'Seleccionar';
        foreach($departaments as $departament) { 
            $departaments_array[$departament->id] = $departament->name;
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
            'departaments' => $departaments_array,
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
            'departament_id' => 'required',
            'city_id' => 'required',
            'zone_id' => 'required',
            'address' => 'required',
            'property_type_id' => 'required',
            'management_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stratum' => 'required',
            'square_meter' => 'required',
            'consultant_id' => 'required'
        ]);

        $property = new Property();

        $property->zone_id = $request->input('zone_id');
        $property->address = $request->input('address');
        $property->property_type_id = $request->input('property_type_id');
        $property->management_id = $request->input('management_id');
        $property->description = $request->input('description');
        $property->price = $request->input('price');
        $property->stratum = $request->input('stratum');
        $property->square_meter = $request->input('square_meter');
        $property->consultant_id = $request->input('consultant_id');

        $property->save();

        $amenities_array = $request->input('amenities');
        $features_array = $request->input('features');

        if(isset($amenities_array) and !empty($amenities_array)){
            $cont = 0;
            for($i=0; $i < count($amenities_array); $i++){
                $amenity[$cont]['property_id'] = $property->id;
                $amenity[$cont]['amenity_id'] = $amenities_array[$i];
                $cont++;
            }
            $property->amenities()->attach($amenity);
        }

        if(isset($features_array) and !empty($features_array)){
            $contf = 0;
            for($i=0; $i < count($features_array); $i++){
                $feature[$contf]['property_id'] = $property->id;
                $feature[$contf]['feature_id'] = $features_array[$i];
                $contf++;
            }
            $property->features()->attach($feature);
        }

        if(isset($request->photos) and !empty($request->photos)){

            foreach ($request->photos as $photo) {

                $data = $photo->store('public/photos');
                $data = explode("/", $data);

                $property_photo = PropertyPhoto::create([
                    'property_id' => $property->id,
                    'name' => $data[2],
                    'url' => $data[2]
                ]);
            }
            
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

        $departaments = Departament::all();
        $departaments_array = [];
        $departaments_array[''] = 'Seleccionar';
        foreach($departaments as $departament) { 
            $departaments_array[$departament->id] = $departament->name;
        }

        $cities = City::where('departament_id','=',$property->zone->city->departament->id)->get();
        $cities_array = [];
        $cities_array[''] = 'Seleccionar';
        foreach($cities as $city) { 
            $cities_array[$city->id] = $city->name;
        }

        $zones = Zone::where('city_id','=',$property->zone->city->id)->get();
        $zones_array = [];
        $zones_array[''] = 'Seleccionar';
        foreach($zones as $zone) { 
            $zones_array[$zone->id] = $zone->name;
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
        $photos = PropertyPhoto::where('property_id','=',$property->id)->get();

        return view('admin.properties.update',[
            'property' => $property,
            'departaments' => $departaments_array,
            'cities' => $cities_array,
            'zones' => $zones_array,
            'propertytypes' => $propertytypes_array,
            'managements' => $managements_array,
            'consultants' => $consultants_array,
            'amenities' => $amenities,
            'features' => $features,
            'photos' => $photos
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
            'departament_id' => 'required',
            'city_id' => 'required',
            'address' => 'required',
            'property_type_id' => 'required',
            'management_id' => 'required',
            'description' => 'required',
            'price' => 'required',
            'stratum' => 'required',
            'square_meter' => 'required',
            'consultant_id' => 'required'
        ]);

        $property = Property::findOrFail($id);
        $property->city_id = $request->input('city_id');
        $property->address = $request->input('address');
        $property->property_type_id = $request->input('property_type_id');
        $property->management_id = $request->input('management_id');
        $property->description = $request->input('description');
        $property->price = $request->input('price');
        $property->stratum = $request->input('stratum');
        $property->square_meter = $request->input('square_meter');
        $property->consultant_id = $request->input('consultant_id');

        $property->amenities()->detach();
        $property->features()->detach();
        $property->update();

        $amenities_array = $request->input('amenities');
        $features_array = $request->input('features');

        if(isset($amenities_array) and !empty($amenities_array)){
            $cont = 0;
            for($i=0; $i < count($amenities_array); $i++){
                $amenity[$cont]['property_id'] = $property->id;
                $amenity[$cont]['amenity_id'] = $amenities_array[$i];
                $cont++;
            }
            $property->amenities()->attach($amenity);
        }

        if(isset($features_array) and !empty($features_array)){
            $contf = 0;
            for($i=0; $i < count($features_array); $i++){
                $feature[$contf]['property_id'] = $property->id;
                $feature[$contf]['feature_id'] = $features_array[$i];
                $contf++;
            }
            $property->features()->attach($feature);
        }

        if(isset($request->photos) and !empty($request->photos)){

            foreach ($request->photos as $photo) {

                $data = $photo->store('public/photos');
                $data = explode("/", $data);

                $property_photo = PropertyPhoto::create([
                    'property_id' => $property->id,
                    'name' => $data[2],
                    'url' => $data[2]
                ]);
            }
            
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
        $property->features()->detach();

        $property->delete();

        flash()->overlay('Registro Eliminado con Exito!!', 'Alerta!!');

        return redirect()->route('properties.index');
    }

    public function deletephoto($id = NULL){

        $photo = PropertyPhoto::find($id);
        $photo->delete();
        Storage::delete('public/photos/'.$photo->url);

        print json_encode(['borrado' => 'si']);
    }
}