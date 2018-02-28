<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region; use App\Categorey; use App\Pol; use App\Vozrast;
class SelectController extends Controller
{
    public function DataSelectRegions(){
      return json_encode(Region::all()->pluck('name','id'));
    }

    public function DataDelectCitys($id_region){
      return json_encode(\App\City::where('id_region', (int)$id_region)->pluck('name','id'));
    }

    public function DataSelectCategorey(){
      return json_encode(Categorey::all()->pluck('name','id'));
    }
     public function DataSelectBreed($id_categorey){
       $categorey = Categorey::find((int)$id_categorey);
         if($categorey === null){
           return 0;
         }
       $breeds = $categorey->breeds;
       $placeholderArray = $breeds->where('placeholder',true)->all();
       $placeholder = array_shift($placeholderArray)->name;
       $breeds = $breeds->where('placeholder',false);
       return json_encode(['breeds'=>$breeds->pluck('name','id'), 'placeholder'=>$placeholder]);
     }
    public function CategoreyType($id){
      $categorey = Categorey::find($id);
      return json_encode($categorey->type->pluck('name','id'));
    }

    public function CategoreyVozrastPol($id){
      $categorey = Categorey::find($id);
      return json_encode(['pol'=>$categorey->pol, 'vozrast'=>$categorey->vozrast]);
    }

    public function PolAll(){
      return json_encode(Pol::all()->pluck('name','id'));
    }
    public function VozrastAll(){
      return json_encode(Vozrast::all()->pluck('name','id'));
    }

}
