<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Region;
use App\City;
use App\Categorey;
use App\Pol;
use App\Vozrast;
use App\Country;

class SelectController extends Controller
{
    public static function  DataSelectCountrys(){
      return Country::all()->pluck('name','id');
    }

    public static function DataSelectRegions(){
      return Region::all()->pluck('name','id');
    }

    public function RegionsJson(){
      return json_encode($this->DataSelectRegions());
    }

    public function DataDelectCitys($id_region){
      return json_encode(City::where('id_region', (int)$id_region)->pluck('name','id'));
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

    public function FailGet(){
      $fail = file(public_path().'/sterlitamak.txt');

      foreach ($fail as $value) {
        $id_region = 1004565;
        $margins = explode('|', $value);
        $data = array("name"=>$margins[0],"id_region"=>$id_region,"ves"=>$margins[1], "slug"=>$this->Translit($margins[0]));
      //  $city = City::create($data);
    //    $city->save();
      }
      return  dd(City::where('id_region', (int)$id_region)->get());
    }

    public static function ConvertOption($arrayData = []){
          $optin_html = '';
           foreach ($arrayData as $key => $value) {
                $optin_html .= '<option value="'.$key.'">'.$value.'</option>\n';
           }
           return $optin_html;
    }

}
