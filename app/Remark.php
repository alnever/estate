<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remark extends Model
{

    /**
     * estates - the object for whist this remark was done
     *
     * @return BelongsTo
     */
    public function estate() {
        return $this->belongsTo('App\Estate');
    }


    /**
     * user - the user who has done this remark
     *
     * @return BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
}
