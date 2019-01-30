<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * public published_estates - list of the objects published by this user
     *
     * @return HasMany
     */
    public function published_estates() {
        return $this->hasMany('App\Estate','publisher_id', 'id' );
    }

    /**
     * public proceeding_estates - list of the objects for which this user is a realtor
     *
     * @return HasMany
     */
    public function proceeding_estates() {
        return $this->hasMany('App\Estate','realtor_id', 'id' );
    }


    /**
     * public remarks - list of remarks done by this user
     *
     * @return HasMany
     */
    public function remarks() {
        return $this->hasMany('App\Remark');
    }

}
