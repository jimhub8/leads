<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    public $with = ['jobtype', 'client', 'staff', 'user'];
    public function jobtype()
    {
        return $this->belongsToMany(Jobtype::class)->withPivot('price', 'status');
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
