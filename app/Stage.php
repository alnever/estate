<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{

    /**
     * public estates - a collection of the objects on this stage of proceeding
     *
     * @return HasMany
     */
    public function estates() {
        return $this->hasMany('App\Estate');
    }

}
