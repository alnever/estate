<?php

namespace App\Http\Controllers;

use App\EstateType;
use Illuminate\Http\Request;
use Session;

class EstateTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estateType = EstateType::orderBy('name')->paginate(20);
        return view('estate-types.index')->withEstateTypes($estateType);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'min:1', 'max:255', 'unique:estate_types,name'],
        ]);

        $estateType = new EstateType($request->all());

        $estateType->save();

        Session::flash('success','The estate type was created successfully.');

        return redirect()->route('estate-types.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\EstateType  $estateType
     * @return \Illuminate\Http\Response
     */
    public function show(EstateType $estateType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\EstateType  $estateType
     * @return \Illuminate\Http\Response
     */
    public function edit(EstateType $estateType)
    {
        return view('estate-types.edit')->withEstateType($estateType);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\EstateType  $estateType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EstateType $estateType)
    {
        if ($request->input('name') != $estateType->name) {
            $this->validate($request,[
                'name' => ['required', 'min:1', 'max:255', 'unique:estate_types,name'],
            ]);
        }

        $estateType->update($request->all());

        $estateType->save();

        Session::flash('success','The estate type was updated successfully.');

        return redirect()->route('estate-types.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\EstateType  $estateType
     * @return \Illuminate\Http\Response
     */
    public function destroy(EstateType $estateType)
    {
        $estateType->delete();
        Session::flash('success','The estate type was deleted successfully.');
        return redirect()->route('estate-types.index');
    }
}
