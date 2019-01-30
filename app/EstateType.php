<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EstateType extends Model
{
    protected $fillable = ['name', 'created_at', 'updated_at',];

    /**
     * public estates - all object of this type
     *
     * @return HasMany
     */
    public function estates() {
        return $this->hasMany('App\Estate');
    }
}
