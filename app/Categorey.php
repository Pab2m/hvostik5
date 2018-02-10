<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorey extends Model
{
    protected $table = 'categorys';
    public $timestamps = false;

public function breeds(){
   return $this->hasMany('App\Breed', 'id_categorys');
}

public function type(){
  return $this->belongsToMany('App\Type','categorys_type','id_categorys','id_type');
}


}
