<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['reason_id','estate_id','email','message','created_at','updated_at'];
}
