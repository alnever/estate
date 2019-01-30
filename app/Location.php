<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = ['name', 'created_at', 'updated_at',];

    /**
     * estates - all objects linked with this locations
     *
     * @return BelongsToMany
     */
    public function estates() {
        return $this->belongsToMany('App\Location','estate_location','location_id','estate_id');
    }
}
