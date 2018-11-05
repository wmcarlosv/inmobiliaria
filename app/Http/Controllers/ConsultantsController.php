<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Consultant;

class ConsultantsController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consultants = Consultant::all();
        return view('admin.consultants.home', ['consultants' => $consultants]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.consultants.add');
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
            'phone' => 'required',
            'email' => 'required',
            'direction' => 'required'
        ]);

        if($request->hasFile('avatar')){
            $extension = $request->file('avatar')->extension();
            $avatar = "avatar_".Date('mdYHis'). uniqid() .".".$extension;
        }else{
            $avatar = NULL;
        }

        

        $consultant = New Consultant();
        $consultant->name = $request->input('name');
        $consultant->phone = $request->input('phone');
        $consultant->email = $request->input('email');
        $consultant->direction = $request->input('direction');
        $consultant->avatar = $avatar;
        $consultant->save();

        if($request->hasFile('avatar')){
            Storage::putFileAs('public/avatars', new File($request->file('avatar')->path()), $avatar);
        }

        flash()->overlay('Record Included with Success', 'Alert!!');

        return redirect()->route('consultants.index');
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
        $consultant = Consultant::find($id);
        return view('admin.consultants.update',['consultant' => $consultant]);
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
            'phone' => 'required',
            'email' => 'required',
            'direction' => 'required'
        ]);

        $consultant = Consultant::findOrFail($id);

        if($request->hasFile('avatar')){
            $extension = $request->file('avatar')->extension();
            $avatar = "avatar_".Date('mdYHis'). uniqid() .".".$extension;
            $consultant->avatar = $avatar;
        }
        $consultant->name = $request->input('name');
        $consultant->phone = $request->input('phone');
        $consultant->email = $request->input('email');
        $consultant->direction = $request->input('direction');
        $consultant->update();

        if($request->hasFile('avatar')){
            Storage::putFileAs('public/avatars', new File($request->file('avatar')->path()), $avatar);
        }

        flash()->overlay('Register updated with Success', 'Alert!!');

        return redirect()->route('consultants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $consultant = Consultant::findOrFail($id);

        Storage::delete('public/avatars/'.$consultant->avatar);
        
        $consultant->delete();

        flash()->overlay('Record removed Successfully', 'Alert!!');

        return redirect()->route('consultants.index');
    }

    public function destroyimage($id){

        $consultant = Consultant::find($id);
        Storage::delete('public/avatars/'.$consultant->avatar);
        $consultant->avatar = NULL;
        $consultant->save();
        $data = ['message' => 'delete'];
        print json_encode($data);
    }
}
