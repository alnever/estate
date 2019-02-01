<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Location;
use App\Goal;
use App\Estate;

class PageController extends Controller
{

    /**
     * getIndex - get list of estates and provides search functions
     *
     * @return Illuminate\Http\Responce
     */
    public function getIndex() {

        // get query parameters
        $params = $params = request()->query();

        // get locations list
        $locations = [];
        foreach (Location::all() as $location) {
            $locations[$location->id] = $location->name;
        }

        // get goals list
        $goals = [];
        foreach (Goal::all() as $goal) {
            $goals[$goal->id] = $goal->name;
        }

        // get estates
        $estates = Estate::orderBy('created_at','desc');

        // apply seach parameters
        if (count($params) > 0) {
            // ... goal
            if (isset($params['goal']) && $params['goal'] > 0) {
                $estates = $estates->where('goal_id','=',$params['goal']);
            }

            // ... minimal price
            if (isset($params['min_price'])) {
                $estates = $estates->where('price','>=',$params['min_price']);
            }

            // ... maximal price
            if (isset($params['max_price'])) {
                $estates = $estates->where('price','>=',$params['max_price']);
            }

            // ... selected locations
            if (isset($param['locations']) && count($locations) > 0) {
                $locationsIds = $params['locations'];
                $estates = $estates->whereHas('locations', function($query) use ($locationsIds) {
                    $query->whereIn('locations.id',$locationsIds);
                });
            }
        }

        // paginate results
        $estates = $estates->paginate(12);

        // pass results to view`
        return view('pages.home')
            ->withEstates($estates)
            ->withParams($params)
            ->withGoals($goals)
            ->withLocations($locations);
    }

    public function getAbout() {
        return view('pages.about');
    }

    public function getContact() {
        return view('pages.contact');
    }

    public function getEstate(Estate $estate) {
        return view('pages.estate')->withEstate($estate);
    }
}
