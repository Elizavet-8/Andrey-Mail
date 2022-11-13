<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SequencesStages extends Model
{
    public function sequence()
    {
        return $this->belongsTo('App\Sequences', 'id', 'sequence_id');
    }
}
