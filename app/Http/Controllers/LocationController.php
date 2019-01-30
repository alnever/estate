<?php

namespace App\Http\Controllers;

use App\Location;
use Illuminate\Http\Request;
use Session;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = Location::orderBy('name')->paginate(20);
        return view('locations.index')->withLocations($locations);
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
            'name' => ['required', 'min:1', 'max:255', 'unique:locations,name'],
        ]);

        $location = new Location($request->all());

        $location->save();

        Session::flash('success','The location was created successfully.');

        return redirect()->route('locations.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit(Location $location)
    {
        return view('locations.edit')->withLocation($location);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Location $location)
    {
        if ($request->input('name') != $location->name) {
            $this->validate($request,[
                'name' => ['required', 'min:1', 'max:255', 'unique:locations,name'],
            ]);
        }
        
        $location->update($request->all());

        $location->save();

        Session::flash('success','The location was updated successfully.');

        return redirect()->route('locations.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        $location->delete();
        Session::flash('success','The location was deleted successfully.');
        return redirect()->route('locations.index');
    }
}
