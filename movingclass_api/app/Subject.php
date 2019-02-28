<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    public $table = 'subjects';
    public $timestamps = false;
    protected $fillable = [
      'subject'
    ];
}
