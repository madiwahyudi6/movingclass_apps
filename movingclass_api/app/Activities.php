<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
    public $table = 'activities';
    protected $fillable = [
      'classroom_id', 'subject_id', 'studentclass_id'
    ];
}
