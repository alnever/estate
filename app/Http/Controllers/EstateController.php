<?php

namespace App\Http\Controllers;

use App\Estate;
use Illuminate\Http\Request;
use Session;
use Purifier;
use Auth;

use App\Goal;
use App\EstateType;
use App\Location;
use App\User;

class EstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // get search params
        $params = request()->query();

        $this->validate(request(),[
            'min_price' => ['nullable', 'integer'],
            'max_price' => ['nullable', 'integer'],
        ]);

        // initial select
        $estates = Estate::orderBy('created_at','desc');

        if (count($params) > 0) {
            // select deleted or undeleted
            if (isset($params['deleted']) && $params['deleted'] == 1) {
                $estates = $estates->onlyTrashed();
            }
            $params['deleted'] = isset($params['deleted']) ? isset($params['deleted']) : 0;

            // select by goal
            if (!isset($params['sell'])) {
                $estates = $estates->where('goal_id','!=',1);
            }
            if (!isset($params['rent'])) {
                $estates = $estates->where('goal_id','!=',2);
            }
            $params['sell'] = (isset($params['sell']) ? $params['sell'] : 0);
            $params['rent'] = (isset($params['rent']) ? $params['rent'] : 0);

            // select by stage
            if (!isset($params['published'])) {
                $estates = $estates->where('stage_id','!=',1);
            }
            if (!isset($params['process'])) {
                $estates = $estates->where('stage_id','!=',2);
            }
            if (!isset($params['sold'])) {
                $estates = $estates->where('stage_id','!=',3);
            }
            $params['published'] = isset($params['published']) ? $params['published'] : 0;
            $params['process'] = isset($params['process']) ? $params['process'] : 0;
            $params['sold'] = isset($params['sold']) ? $params['sold'] : 0;

            // select by realtor
            if (isset($params['realtor'])) {
                $estates = $estates->where('realtor_id','=',$params['realtor']);
            }

            // search by prices
            if (isset($params['min_price'])) {
                $estates = $estates->where('price','>=',$params['min_price']);
            }
            if (isset($params['max_price'])) {
                $estates = $estates->where('price','<=',$params['max_price']);
            }

            // search by locations
            if (isset($params['locations']) && count($params['locations'])) {
                // $locationsIds = implode(',',$params['locations']);
                $locationsIds = $params['locations'];
                $estates = $estates->whereHas('locations', function($query) use ($locationsIds) {
                    $query->whereIn('locations.id',$locationsIds);
                });
            }

        } else {
            // set default values for search params
            $params['sell'] = 1;
            $params['rent'] = 1;
            $params['published'] = 1;
            $params['process'] = 1;
            $params['sold'] = 1;
            $params['deleted'] = 0;
        }

        // paginate select results
        $estates = $estates->paginate(10);

        // get realtors
        $realtors = [];
        foreach (User::all() as $user) {
            $realtors[$user->id] = $user->name;
        }

        // get locations
        $locations = [];
        foreach (Location::all() as $location) {
            $locations[$location->id] = $location->name;
        }

        return view('estates.index')
            ->withEstates($estates)
            ->withParams($params)
            ->withRealtors($realtors)
            ->withLocations($locations);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // prepare goals for select element
        $goals = [];
        foreach (Goal::all() as $goal) {
            $goals[$goal->id] = $goal->name;
        }

        // prepare estate types for select element
        $estateTypes = [];
        foreach (EstateType::all() as $estateType) {
            $estateTypes[$estateType->id] = $estateType->name;
        }

        // prepare locations list
        $locations = [];
        foreach (Location::all() as $location) {
            $locations[$location->id] = $location->name;
        }

        // prepare realtors lists
        $realtors = [];
        foreach (User::all() as $user) {
            $realtors[$user->id] = $user->name;
        }

        return view('estates.create')
            ->withGoals($goals)
            ->withEstateTypes($estateTypes)
            ->withLocations($locations)
            ->withRealtors($realtors);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation
        $this->validate($request,[
            'estate_type_id' => ['required'],
            'goal_id' => ['required'],
            'address' => ['required','max:255'],
            'rooms' => ['integer','nullable'],
            'square' => ['numeric','nullable'],
            'price' => ['required', 'numeric'],
            'min_price' => ['numeric','nullable'],
            'realtor_id' => ['integer','nullable'],
        ]);

        // create estate with the given information
        $estate = new Estate($request->all());

        // in addition: pusblishing parameters
        $estate->published_at = date('Y-m-d H:i:s');
        $estate->publisher_id = Auth::user()->id;

        // in addition: set realtor and stage
        if ($request->realtor_id && $request->realtor_id != 0) {
            $estate->stage_id = 2; // realtor is set - the estate is in process
            $estate->process_at = date('Y-m-d H:i:s');
        } else {
            $estate->stage_id = 1; // just published estate
        }

        // purify
        $estate->object_info = Purifier::clean($estate->object_info);
        $estate->owner_info  = Purifier::clean($estate->owner_info);
        $estate->final_info  = Purifier::clean($estate->final_info);

        // save
        $estate->save();

        // set Locations
        $estate->locations()->sync($request->input('locations'), false);

        Session::flash('success', 'The estate was successfully created.');

        return redirect()->route('estates.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Estate  $estate
     * @return \Illuminate\Http\Response
     */
    public function show(Estate $estate)
    {
        return view('estates.show')->withEstate($estate);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Estate  $estate
     * @return \Illuminate\Http\Response
     */
    public function edit(Estate $estate)
    {
        // prepare goals for select element
        $goals = [];
        foreach (Goal::all() as $goal) {
            $goals[$goal->id] = $goal->name;
        }

        // prepare estate types for select element
        $estateTypes = [];
        foreach (EstateType::all() as $estateType) {
            $estateTypes[$estateType->id] = $estateType->name;
        }

        // prepare locations list
        $locations = [];
        foreach (Location::all() as $location) {
            $locations[$location->id] = $location->name;
        }

        // prepare realtors lists
        $realtors = [];
        foreach (User::all() as $user) {
            $realtors[$user->id] = $user->name;
        }

        return view('estates.edit')
            ->withEstate($estate)
            ->withGoals($goals)
            ->withEstateTypes($estateTypes)
            ->withLocations($locations)
            ->withRealtors($realtors);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Estate  $estate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estate $estate)
    {
        // validation
        $this->validate($request,[
            'estate_type_id' => ['required'],
            'goal_id' => ['required'],
            'address' => ['required','max:255'],
            'rooms' => ['integer','nullable'],
            'square' => ['numeric','nullable'],
            'price' => ['required', 'numeric'],
            'min_price' => ['numeric','nullable'],
            'final_price' => ['numeric','nullable'],
            'realtor_id' => ['integer','nullable'],
        ]);

        // in addition: set realtor and stage
        if ($request->realtor_id && $request->realtor_id != 0 && $request->realtor_id != $estate->realtor_id) {
            $estate->stage_id = 2; // realtor is set - the estate is in process
            $estate->process_at = date('Y-m-d H:i:s');
        }

        $estate->update($request->all());

        if ($request->final_price && $request->final_price != 0) {
            $estate->stage_id = 3;
            $estate->sold_at = date('Y-m-d H:i:s');
        }

        // purify
        $estate->object_info = Purifier::clean($estate->object_info);
        $estate->owner_info  = Purifier::clean($estate->owner_info);
        $estate->final_info  = Purifier::clean($estate->final_info);

        // set Locations
        $estate->locations()->sync($request->input('locations'), true);

        // save
        $estate->save();

        Session::flash('success', 'The estate was successfully updated.');
        return redirect()->route('estates.show', $estate->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Estate  $estate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Estate $estate)
    {
        $estate->delete();
        Session::flash('success', 'The estate was successfully deleted.');
        return redirect()->route('estates.index');
    }
}
