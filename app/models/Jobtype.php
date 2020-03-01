<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Jobtype extends Model
{
    public function jobs()
    {
        return $this->belongsToMany(Job::class);
    }
}
