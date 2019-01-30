<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estate extends Model
{
    protected $fillable = [
        'estate_type_id',
        'goal_id',
        'stage_id',
        'address',
        'rooms',
        'floor',
        'square',
        'object_info',
        'price',
        'min_price',
        'owner_info',
        'publisher_id',
        'published_at',
        'realtor_id',
        'process_at',
        'sold_at',
        'final_price',
        'final_info',
        'created_at',
        'updated_at',
        'deleted',
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
