<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Studentclass extends Model
{
    public $table = 'studentclass';
    public $timestamps = false;
    protected $fillable = [
      'studentclass'
    ];
}
