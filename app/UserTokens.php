<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTokens extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'id', 'user_id');
    }
}
