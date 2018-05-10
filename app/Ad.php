<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Ad extends Model
{
    protected $table = 'ad';
    protected $guarded = array('status');
    private $category_sostav = array('id_category'=>'category','id_breed'=>'breed','id_type'=>'type');
     public static function CreateAd($data, $sostoynia = false){
            $ad = Ad::create($data);
            if($sostoynia){
              $ad -> status = 1;
              $ad->save();
            }
            return $ad->id;
     }
public static function AllAd($sostoynia=1){
    $query = Ad::where('status', '=',(int)$sostoynia)->orderBy("created_at","DESC")->get();
    return $query;
     }

public function region(){
       return $this->belongsTo('App\Region','id_region','id');
}

public function city(){
      return $this->belongsTo('App\City','id_city','id');
}
public function category(){
      return $this->belongsTo('App\Categorey','id_category','id');
}
public function breed(){
      return $this->belongsTo('App\Breed','id_breed','id');
}
public function type(){
      return $this->belongsTo('App\Type','id_type','id');
}

public function GeographyGet(){
      return $this->region->name.', '.$this->city->name;
}

public function CategoryGet($delimiter = ' '){
      $str = '';
      foreach ($this->category_sostav as $key => $value) {
              if($this -> $key !== NULL){
                $str.= $this-> $value -> name.$delimiter;
              }
      }
      return substr($str,0,-strlen($delimiter));
}

public function SlagSet(){

  $str = '';
  foreach ($this->category_sostav as $key => $value) {
          if($this -> $key !== NULL){
            $str.= $this-> $value -> name.$delimiter;
          }
  }

}


}
