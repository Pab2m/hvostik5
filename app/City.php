<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'citys';
    public $timestamps = false;
    protected $guarded = array();
}
