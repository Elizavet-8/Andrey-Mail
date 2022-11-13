<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sequences extends Model
{
    public function recepients(){
        return $this->hasMany('App\SequencesRecipients', 'sequence_id');
    }

    public function stages(){
        return $this->hasMany('App\SequencesStages', 'sequence_id');
    }
}
