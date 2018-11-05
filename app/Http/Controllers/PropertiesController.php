<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Property;
use App\Direction;
use App\PropertyType;
use App\Management;
use App\Consultant;

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
            $diections_array[$direction->id] = $direction->departament.", ".$direction->zone.", ".$direction->ubication;
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
            $consultants_array[$consultant->id] = $consultant->name.", ".$consultant->phone.", ".$consultant->email;
        }
        return view('admin.properties.add',[
            'directions' => $diections_array,
            'propertytypes' => $propertytypes_array,
            'managements' => $managements_array,
            'consultants' => $consultants_array
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
            'name' => 'required'
        ]);

        $feature = Property::create($request->all());

        flash()->overlay('Record Included with Success', 'Alert!!');

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
        $feature = Property::find($id);
        return view('admin.properties.update',['feature' => $feature]);
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

        $feature = Property::findOrFail($id);

        $feature->name = $request->input('name');

        $feature->update();

        flash()->overlay('Register updated with Success', 'Alert!!');

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
        $feature = Property::findOrFail($id);

        $feature->delete();

        flash()->overlay('Record removed Successfully', 'Alert!!');

        return redirect()->route('properties.index');
    }
}
