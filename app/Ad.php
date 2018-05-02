<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Ad extends Model
{
    protected $table = 'ad';
    protected $guarded = array('status');

     public static function CreateAd($data, $sostoynia = false){
            $ad = Ad::create($data);
            if($sostoynia){
              $ad -> status = 1;
            }
            return $ad->id;
     }


}
