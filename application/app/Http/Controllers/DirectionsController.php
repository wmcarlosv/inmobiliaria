<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Direction;

class DirectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $directions = Direction::all();
        return view('admin.directions.home', ['directions' => $directions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.directions.add');
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
            'departament' => 'required',
            'zone' => 'required',
            'ubication' => 'required',
        ]);

        $direction = Direction::create($request->all());

        flash()->overlay('Record Included with Success', 'Alert!!');

        return redirect()->route('directions.index');
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
        $direction = Direction::find($id);
        return view('admin.directions.update',['direction' => $direction]);
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
            'departament' => 'required',
            'zone' => 'required',
            'ubication' => 'required',
        ]);

        $direction = Direction::findOrFail($id);

        $direction->departament = $request->input('departament');
        $direction->zone = $request->input('zone');
        $direction->ubication = $request->input('ubication');

        $direction->update();

        flash()->overlay('Register updated with Success', 'Alert!!');

        return redirect()->route('directions.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $direction = Direction::findOrFail($id);

        $direction->delete();

        flash()->overlay('Record removed Successfully', 'Alert!!');

        return redirect()->route('directions.index');
    }
}
