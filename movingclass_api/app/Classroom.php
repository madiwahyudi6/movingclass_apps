<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    public $table = 'classroom';
    public $timestamps = false;
    protected $fillable = [
      'room_name'
    ];
}
