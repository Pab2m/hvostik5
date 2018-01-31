<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;
class SelectController extends Controller
{
    public function DataSelectRegions(){
      return json_encode(Region::all()->pluck('name','id'));
    }

    public function DataDelectCitys($id_region){
      return json_encode(\App\City::where('id_region', (int)$id_region)->pluck('name','id'));
    }

    public function DataSelectCategorey(){
      return json_encode(\App\Categorey::all()->pluck('name','id'));
    }

    public function CategoreyType($id){
      $categorey = \App\Categorey::find($id);
      return $categorey->type->pluck('name','id');
    }

}
