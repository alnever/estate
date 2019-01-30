<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goal extends Model
{

    /**
     * public estates - all object publised with this specific goal
     *
     * @return HasMany
     */
    public function estates() {
        return $this->hasMany('App\Estate');
    }

}
