<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Estate extends Model
{
    use SoftDeletes;

    protected $dates = ['created_at','updated_at','deleted_at'];

    protected $fillable = [
        'estate_type_id',
        'goal_id',
        'stage_id',
        'realtor_id',

        'title',
        'description',

        'address',
        'rooms',
        'floor',

        'total_square',
        'living_square',
        'kitchen_square',
        
        'bathroom',
        'balcony',
        'loggia',
        'condition',

        'price',
        'min_price',
        'final_price',

        'object_info',
        'owner_info',
        'final_info',

        'publisher_id',

        'sold_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * estateType - get type of the estate object
     *
     * @return BelongsTo
     */
    public function estateType() {
        return $this->belongsTo('App\EstateType');
    }

    /**
     * goal - get a goal of object's publishing
     *
     * @return BelongsTo
     */
    public function goal() {
        return $this->belongsTo('App\Goal');
    }

    /**
     * stage - get a stage of the process for the specific object
     *
     * @return BelongsTo
     */
    public function stage() {
        return $this->belongsTo('App\Stage');
    }


    /**
     * publisher - get information about a user has published the information about the object
     *
     * @return BelongsTo
     */
    public function publisher() {
        return $this->belongsTo('App\User','publisher_id','id');
    }

    /**
     * realtor - get information about a user who is signed as a realtor for this object
     *
     * @return BelongsTo
     */
    public function realtor() {
        return $this->belongsTo('App\User','realtor_id','id');
    }


    /**
     * remarks - all remarks for this object
     *
     * @return HasMany
     */
    public function remarks() {
        return $this->hasMany('App\Remark');
    }


    /**
     * locations - all locations which were specified for this object
     *
     * @return BelongsToMany
     */
    public function locations() {
        return $this->belongsToMany('App\Location','estate_location','estate_id','location_id');
    }
}
