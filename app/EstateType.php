<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstateType extends Model
{

    /**
     * public estates - all object of this type
     *
     * @return HasMany
     */
    public function estates() {
        return $this->hasMany('App\Estate');
    }
}
