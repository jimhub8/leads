<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function jobs()
    {
        return $this->hasMany(Job::class);
    }
}
